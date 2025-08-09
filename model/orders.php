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

// Cập nhật trạng thái đơn hàng
function update_order_status($mahd, $trangthai) {
    $sql = "UPDATE hoadon SET trangthai = ?, ngaycapnhat = NOW() WHERE mahd = ?";
    return pdo_execute($sql, $trangthai, $mahd);
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
?>
