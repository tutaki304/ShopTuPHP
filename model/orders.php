<?php
// Model quản lý đơn hàng
include_once 'connect.php';

// Lấy tất cả đơn hàng với thông tin khách hàng
function get_all_orders() {
    $sql = "SELECT hd.*, tk.hoten, tk.email, tk.sdt 
            FROM hoadon hd 
            INNER JOIN taikhoan tk ON hd.makh = tk.makh 
            ORDER BY hd.ngaydathang DESC";
    return pdo_query($sql);
}

// Tính tổng tiền của một đơn hàng từ chi tiết
function calculate_order_total($mahd) {
    $sql = "SELECT SUM(ct.soluong * 
                CASE 
                    WHEN ct.dongia > 0 THEN ct.dongia
                    WHEN sp.khuyenmai > 0 THEN sp.khuyenmai  
                    ELSE sp.dongia
                END
            ) * 1000 as total 
            FROM chitiethoadon ct
            INNER JOIN sanpham sp ON ct.masp = sp.masp
            WHERE ct.mahd = ?";
    $result = pdo_query_one($sql, $mahd);
    return $result['total'] ?? 0;
}

// Lấy tất cả đơn hàng với tổng tiền được tính toán
function get_all_orders_with_calculated_total() {
    $sql = "SELECT hd.*, tk.hoten, tk.email, tk.sdt,
            CASE 
                WHEN hd.tongtien > 0 THEN hd.tongtien
                ELSE (
                    SELECT COALESCE(SUM(ct.soluong * 
                        CASE 
                            WHEN ct.dongia > 0 THEN ct.dongia
                            WHEN sp.khuyenmai > 0 THEN sp.khuyenmai  
                            ELSE sp.dongia
                        END
                    ) * 1000, 0) 
                    FROM chitiethoadon ct 
                    INNER JOIN sanpham sp ON ct.masp = sp.masp
                    WHERE ct.mahd = hd.mahd
                )
            END as calculated_total
            FROM hoadon hd 
            INNER JOIN taikhoan tk ON hd.makh = tk.makh 
            ORDER BY hd.ngaydathang DESC";
    return pdo_query($sql);
}

// Lấy đơn hàng theo ID
function get_order_by_id($mahd) {
    $sql = "SELECT hd.*, tk.hoten, tk.email, tk.sdt, tk.diachi 
            FROM hoadon hd 
            INNER JOIN taikhoan tk ON hd.makh = tk.makh 
            WHERE hd.mahd = ?";
    return pdo_query_one($sql, $mahd);
}

// Lấy chi tiết đơn hàng
function get_order_details($mahd) {
    $sql = "SELECT ct.*, sp.tensp, sp.anh, sp.dongia as gia_goc,
            CASE 
                WHEN ct.dongia > 0 THEN ct.dongia
                WHEN sp.khuyenmai > 0 THEN sp.khuyenmai  
                ELSE sp.dongia
            END as effective_price
            FROM chitiethoadon ct 
            INNER JOIN sanpham sp ON ct.masp = sp.masp 
            WHERE ct.mahd = ?";
    return pdo_query($sql, $mahd);
}

// Cập nhật trạng thái đơn hàng và xử lý số lượng sản phẩm
function update_order_status($mahd, $trangthai) {
    try {
        // Bắt đầu transaction
        pdo_execute("START TRANSACTION");
        
        // Lấy trạng thái hiện tại của đơn hàng
        $current_order = pdo_query_one("SELECT trangthai FROM hoadon WHERE mahd = ?", $mahd);
        $old_status = $current_order['trangthai'];
        
        // Cập nhật trạng thái đơn hàng
        $sql = "UPDATE hoadon SET trangthai = ?, ngaycapnhat = NOW() WHERE mahd = ?";
        pdo_execute($sql, $trangthai, $mahd);
        
        // Xử lý số lượng sản phẩm dựa trên thay đổi trạng thái
        handle_product_stock_on_status_change($mahd, $old_status, $trangthai);
        
        // Commit transaction
        pdo_execute("COMMIT");
        return true;
    } catch (Exception $e) {
        // Rollback nếu có lỗi
        pdo_execute("ROLLBACK");
        error_log("Error updating order status: " . $e->getMessage());
        return false;
    }
}

// Xử lý số lượng sản phẩm khi thay đổi trạng thái đơn hàng
function handle_product_stock_on_status_change($mahd, $old_status, $new_status) {
    // Lấy chi tiết đơn hàng
    $order_details = pdo_query("SELECT masp, soluong FROM chitiethoadon WHERE mahd = ?", $mahd);
    
    foreach ($order_details as $detail) {
        $masp = $detail['masp'];
        $soluong = $detail['soluong'];
        
        // Kiểm tra trạng thái cũ và mới để quyết định hành động
        $should_decrease_stock = should_decrease_stock($old_status, $new_status);
        $should_increase_stock = should_increase_stock($old_status, $new_status);
        
        if ($should_decrease_stock) {
            // Trừ số lượng sản phẩm (khi đơn hàng được duyệt/xác nhận)
            decrease_product_stock($masp, $soluong);
        } elseif ($should_increase_stock) {
            // Cộng lại số lượng sản phẩm (khi đơn hàng bị hủy/trả lại)
            increase_product_stock($masp, $soluong);
        }
    }
}

// Kiểm tra có nên trừ số lượng không
function should_decrease_stock($old_status, $new_status) {
    // Các trạng thái chưa trừ kho: 'gio-hang', 'cho-xac-nhan'
    $not_processed_statuses = ['gio-hang', 'cho-xac-nhan'];
    // Các trạng thái đã trừ kho: 'chuan-bi-don-hang', 'dang-giao-hang', 'da-giao'
    $processed_statuses = ['chuan-bi-don-hang', 'dang-giao-hang', 'da-giao'];
    
    return in_array($old_status, $not_processed_statuses) && 
           in_array($new_status, $processed_statuses);
}

// Kiểm tra có nên cộng lại số lượng không
function should_increase_stock($old_status, $new_status) {
    // Các trạng thái đã trừ kho
    $processed_statuses = ['chuan-bi-don-hang', 'dang-giao-hang', 'da-giao'];
    // Các trạng thái hủy/trả lại
    $cancelled_statuses = ['da-huy', 'tra-hang'];
    
    return in_array($old_status, $processed_statuses) && 
           in_array($new_status, $cancelled_statuses);
}

// Trừ số lượng sản phẩm
function decrease_product_stock($masp, $quantity) {
    try {
        // Kiểm tra số lượng hiện tại
        $current_stock = pdo_query_one("SELECT soluong FROM sanpham WHERE masp = ?", $masp);
        
        if ($current_stock && $current_stock['soluong'] >= $quantity) {
            // Trừ số lượng
            pdo_execute("UPDATE sanpham SET soluong = soluong - ? WHERE masp = ?", $quantity, $masp);
            
            // Log hoạt động (optional)
            log_stock_change($masp, -$quantity, "Order processing");
        } else {
            throw new Exception("Insufficient stock for product ID: $masp");
        }
    } catch (Exception $e) {
        error_log("Error decreasing product stock: " . $e->getMessage());
        throw $e;
    }
}

// Cộng lại số lượng sản phẩm
function increase_product_stock($masp, $quantity) {
    try {
        // Cộng lại số lượng
        pdo_execute("UPDATE sanpham SET soluong = soluong + ? WHERE masp = ?", $quantity, $masp);
        
        // Log hoạt động (optional)
        log_stock_change($masp, $quantity, "Order cancelled/returned");
    } catch (Exception $e) {
        error_log("Error increasing product stock: " . $e->getMessage());
        throw $e;
    }
}

// Log thay đổi số lượng sản phẩm (optional - để theo dõi)
function log_stock_change($masp, $quantity_change, $reason) {
    try {
        // Tạo bảng stock_log nếu chưa có
        $create_table = "CREATE TABLE IF NOT EXISTS stock_log (
            id INT AUTO_INCREMENT PRIMARY KEY,
            masp INT NOT NULL,
            quantity_change INT NOT NULL,
            reason VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (masp) REFERENCES sanpham(masp)
        )";
        pdo_execute($create_table);
        
        // Insert log record
        pdo_execute(
            "INSERT INTO stock_log (masp, quantity_change, reason) VALUES (?, ?, ?)",
            $masp, $quantity_change, $reason
        );
    } catch (Exception $e) {
        // Log error nhưng không throw để không ảnh hưởng đến flow chính
        error_log("Error logging stock change: " . $e->getMessage());
    }
}

// Xóa đơn hàng
function delete_order($mahd) {
    try {
        // Xóa chi tiết đơn hàng trước
        pdo_execute("DELETE FROM chitiethoadon WHERE mahd = ?", $mahd);
        // Xóa đơn hàng
        pdo_execute("DELETE FROM hoadon WHERE mahd = ?", $mahd);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Thống kê đơn hàng theo trạng thái
function get_order_statistics() {
    $sql = "SELECT trangthai, COUNT(*) as so_luong, SUM(tongtien) as tong_tien 
            FROM hoadon 
            GROUP BY trangthai";
    return pdo_query($sql);
}

// Lấy đơn hàng theo trạng thái
function get_orders_by_status($trangthai) {
    $sql = "SELECT hd.*, tk.hoten, tk.email, tk.sdt 
            FROM hoadon hd 
            INNER JOIN taikhoan tk ON hd.makh = tk.makh 
            WHERE hd.trangthai = ? 
            ORDER BY hd.ngaydathang DESC";
    return pdo_query($sql, $trangthai);
}

// Tìm kiếm đơn hàng
function search_orders($keyword) {
    $sql = "SELECT hd.*, tk.hoten, tk.email, tk.sdt 
            FROM hoadon hd 
            INNER JOIN taikhoan tk ON hd.makh = tk.makh 
            WHERE hd.mahd LIKE ? OR tk.hoten LIKE ? OR tk.email LIKE ? 
            ORDER BY hd.ngaydathang DESC";
    $search_term = "%$keyword%";
    return pdo_query($sql, $search_term, $search_term, $search_term);
}

// Lấy doanh thu theo khoảng thời gian
function get_revenue_by_period($start_date, $end_date) {
    $sql = "SELECT DATE(ngaydathang) as ngay, SUM(tongtien) as doanh_thu, COUNT(*) as so_don 
            FROM hoadon 
            WHERE ngaydathang BETWEEN ? AND ? 
            AND trangthai != 'gio-hang' 
            GROUP BY DATE(ngaydathang) 
            ORDER BY ngay DESC";
    return pdo_query($sql, $start_date, $end_date);
}

// Cập nhật thông tin đơn hàng
function update_order_info($mahd, $ghichu, $tongtien) {
    $sql = "UPDATE hoadon SET ghichu = ?, tongtien = ?, ngaycapnhat = NOW() WHERE mahd = ?";
    return pdo_execute($sql, $ghichu, $tongtien, $mahd);
}

// Lấy top khách hàng mua nhiều nhất
function get_top_customers($limit = 10) {
    $sql = "SELECT tk.makh, tk.hoten, tk.email, 
            COUNT(hd.mahd) as so_don, 
            SUM(hd.tongtien) as tong_chi_tieu
            FROM taikhoan tk 
            INNER JOIN hoadon hd ON tk.makh = hd.makh 
            WHERE hd.trangthai != 'gio-hang'
            GROUP BY tk.makh, tk.hoten, tk.email 
            ORDER BY tong_chi_tieu DESC 
            LIMIT ?";
    return pdo_query($sql, $limit);
}

// Lấy sản phẩm bán chạy từ đơn hàng
function get_best_selling_products($limit = 10) {
    $sql = "SELECT sp.masp, sp.tensp, sp.anh,
            SUM(ct.soluong) as tong_ban,
            SUM(ct.soluong * ct.dongia) as doanh_thu
            FROM sanpham sp 
            INNER JOIN chitiethoadon ct ON sp.masp = ct.masp 
            INNER JOIN hoadon hd ON ct.mahd = hd.mahd 
            WHERE hd.trangthai != 'gio-hang'
            GROUP BY sp.masp, sp.tensp, sp.anh 
            ORDER BY tong_ban DESC 
            LIMIT ?";
    return pdo_query($sql, $limit);
}

// Cập nhật tổng tiền cho một đơn hàng
function update_order_total($mahd) {
    $total = calculate_order_total($mahd);
    $sql = "UPDATE hoadon SET tongtien = ? WHERE mahd = ?";
    return pdo_execute($sql, $total, $mahd);
}

// Sửa tất cả đơn hàng có tổng tiền = 0
function fix_all_order_totals() {
    $sql = "UPDATE hoadon hd 
            SET tongtien = (
                SELECT COALESCE(SUM(ct.soluong * 
                    CASE 
                        WHEN ct.dongia > 0 THEN ct.dongia
                        WHEN sp.khuyenmai > 0 THEN sp.khuyenmai  
                        ELSE sp.dongia
                    END
                ), 0)
                FROM chitiethoadon ct 
                INNER JOIN sanpham sp ON ct.masp = sp.masp
                WHERE ct.mahd = hd.mahd
            )
            WHERE hd.tongtien = 0 OR hd.tongtien IS NULL";
    return pdo_execute($sql);
}

// Lấy đơn hàng của user cụ thể
function get_user_orders($makh) {
    $sql = "SELECT hd.*, 
            CASE 
                WHEN hd.tongtien > 0 THEN hd.tongtien
                ELSE (
                    SELECT COALESCE(SUM(ct.soluong * 
                        CASE 
                            WHEN ct.dongia > 0 THEN ct.dongia
                            WHEN sp.khuyenmai > 0 THEN sp.khuyenmai  
                            ELSE sp.dongia
                        END
                    ) * 1000, 0) 
                    FROM chitiethoadon ct 
                    INNER JOIN sanpham sp ON ct.masp = sp.masp
                    WHERE ct.mahd = hd.mahd
                )
            END as calculated_total
            FROM hoadon hd 
            WHERE hd.makh = ?
            ORDER BY hd.ngaydathang DESC";
    return pdo_query($sql, $makh);
}

// Kiểm tra số lượng tồn kho của sản phẩm
function check_product_stock($masp) {
    $sql = "SELECT soluong FROM sanpham WHERE masp = ?";
    $result = pdo_query_one($sql, $masp);
    return $result ? $result['soluong'] : 0;
}

// Lấy danh sách sản phẩm sắp hết hàng (số lượng <= ngưỡng cảnh báo)
function get_low_stock_products($threshold = 10) {
    $sql = "SELECT masp, tensp, soluong, anh 
            FROM sanpham 
            WHERE soluong <= ? AND soluong >= 0
            ORDER BY soluong ASC";
    return pdo_query($sql, $threshold);
}

// Kiểm tra có đủ số lượng để thực hiện đơn hàng không
function validate_order_stock($mahd) {
    $sql = "SELECT ct.masp, ct.soluong as order_quantity, sp.soluong as stock_quantity, sp.tensp
            FROM chitiethoadon ct
            INNER JOIN sanpham sp ON ct.masp = sp.masp
            WHERE ct.mahd = ?";
    
    $order_details = pdo_query($sql, $mahd);
    $insufficient_products = [];
    
    foreach ($order_details as $detail) {
        if ($detail['stock_quantity'] < $detail['order_quantity']) {
            $insufficient_products[] = [
                'masp' => $detail['masp'],
                'tensp' => $detail['tensp'],
                'order_quantity' => $detail['order_quantity'],
                'stock_quantity' => $detail['stock_quantity'],
                'shortage' => $detail['order_quantity'] - $detail['stock_quantity']
            ];
        }
    }
    
    return [
        'valid' => empty($insufficient_products),
        'insufficient_products' => $insufficient_products
    ];
}

// Lấy lịch sử thay đổi số lượng sản phẩm
function get_stock_history($masp = null, $limit = 50) {
    $sql = "SELECT sl.*, sp.tensp 
            FROM stock_log sl
            INNER JOIN sanpham sp ON sl.masp = sp.masp";
    
    $params = [];
    if ($masp) {
        $sql .= " WHERE sl.masp = ?";
        $params[] = $masp;
    }
    
    $sql .= " ORDER BY sl.created_at DESC LIMIT ?";
    $params[] = $limit;
    
    return pdo_query($sql, ...$params);
}
?>
