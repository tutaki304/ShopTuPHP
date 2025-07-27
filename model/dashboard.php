<?php
// Dashboard Model - Lấy dữ liệu thống kê cho trang dashboard admin
require_once 'connect.php';

function getDashboardStats() {
    $stats = array();
    
    try {
        $conn = pdo_get_connection();
        
        // Tổng số sản phẩm
        $sql = "SELECT COUNT(*) as total FROM sanpham WHERE trangthai = 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['total_products'] = $row['total'];
        
        // Đơn hàng hôm nay
        $sql = "SELECT COUNT(*) as total FROM hoadon WHERE DATE(ngaydathang) = CURDATE()";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['orders_today'] = $row['total'];
        
        // Doanh thu tháng này
        $sql = "SELECT SUM(tongtien) as total FROM hoadon WHERE MONTH(ngaydathang) = MONTH(CURDATE()) AND YEAR(ngaydathang) = YEAR(CURDATE())";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['revenue_month'] = $row['total'] ? $row['total'] : 0;
        
        // Doanh thu hôm nay
        $sql = "SELECT SUM(tongtien) as total FROM hoadon WHERE DATE(ngaydathang) = CURDATE()";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['revenue_today'] = $row['total'] ? $row['total'] : 0;
        
        // Tổng số người dùng
        $sql = "SELECT COUNT(*) as total FROM taikhoan WHERE quyen = 'user'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['total_users'] = $row['total'];
        
        // Sản phẩm sắp hết hàng (< 10)
        $sql = "SELECT COUNT(*) as total FROM sanpham WHERE soluong < 10 AND trangthai = 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['low_stock'] = $row['total'];
        
        // Sản phẩm bán chạy (tính theo tháng)
        $sql = "SELECT COUNT(DISTINCT sp.masp) as total 
                FROM sanpham sp 
                INNER JOIN hoadon_chitiet hdct ON sp.masp = hdct.masp 
                INNER JOIN hoadon hd ON hdct.mahd = hd.mahd 
                WHERE MONTH(hd.ngaydathang) = MONTH(CURDATE()) 
                AND YEAR(hd.ngaydathang) = YEAR(CURDATE())";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['best_sellers'] = $row['total'];
        
        // Số danh mục
        $sql = "SELECT COUNT(*) as total FROM danhmuc WHERE trangthai = 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['categories'] = $row['total'];
        
    } catch (Exception $e) {
        // Nếu có lỗi, trả về dữ liệu mặc định
        $stats = array(
            'total_products' => 0,
            'orders_today' => 0,
            'revenue_month' => 0,
            'revenue_today' => 0,
            'total_users' => 0,
            'low_stock' => 0,
            'best_sellers' => 0,
            'categories' => 0
        );
    }
    
    return $stats;
}

function getRecentOrders($limit = 10) {
    $orders = array();
    
    try {
        $conn = pdo_get_connection();
        $sql = "SELECT hd.mahd, tk.hoten, sp.tensp, hd.tongtien, hd.trangthai, hd.ngaydathang
                FROM hoadon hd
                LEFT JOIN taikhoan tk ON hd.makh = tk.matk
                LEFT JOIN hoadon_chitiet hdct ON hd.mahd = hdct.mahd
                LEFT JOIN sanpham sp ON hdct.masp = sp.masp
                ORDER BY hd.ngaydathang DESC
                LIMIT $limit";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $orders[] = $row;
        }
    } catch (Exception $e) {
        // Trả về mảng rỗng nếu có lỗi
        $orders = array();
    }
    
    return $orders;
}

function getRecentActivities($limit = 5) {
    $activities = array();
    
    try {
        $conn = pdo_get_connection();
        
        // Hoạt động sản phẩm mới
        $sql = "SELECT 'plus' as icon, CONCAT('Đã thêm sản phẩm: ', tensp) as description, 
                       ngaytao as time
                FROM sanpham 
                WHERE ngaytao >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                ORDER BY ngaytao DESC
                LIMIT $limit";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['time'] = timeAgo($row['time']);
            $activities[] = $row;
        }
        
        // Thêm hoạt động đơn hàng mới
        $remaining = $limit - count($activities);
        if ($remaining > 0) {
            $sql = "SELECT 'shopping-cart' as icon, 
                           CONCAT('Đơn hàng mới #', mahd) as description,
                           ngaydathang as time
                    FROM hoadon 
                    WHERE ngaydathang >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                    ORDER BY ngaydathang DESC
                    LIMIT $remaining";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $row['time'] = timeAgo($row['time']);
                $activities[] = $row;
            }
        }
        
    } catch (Exception $e) {
        // Hoạt động mặc định nếu có lỗi
        $activities = array(
            array(
                'icon' => 'info-circle',
                'description' => 'Hệ thống khởi động thành công',
                'time' => 'Vừa xong'
            )
        );
    }
    
    return $activities;
}

function timeAgo($datetime) {
    $time = time() - strtotime($datetime);
    
    if ($time < 60) {
        return 'Vừa xong';
    } elseif ($time < 3600) {
        return floor($time/60) . ' phút trước';
    } elseif ($time < 86400) {
        return floor($time/3600) . ' giờ trước';
    } elseif ($time < 2592000) {
        return floor($time/86400) . ' ngày trước';
    } else {
        return date('d/m/Y', strtotime($datetime));
    }
}

function getBestSellingProducts($limit = 5) {
    $products = array();
    
    try {
        $conn = pdo_get_connection();
        $sql = "SELECT sp.masp, sp.tensp, sp.gia, sp.hinhanh, 
                       SUM(hdct.soluong) as total_sold
                FROM sanpham sp
                INNER JOIN hoadon_chitiet hdct ON sp.masp = hdct.masp
                INNER JOIN hoadon hd ON hdct.mahd = hd.mahd
                WHERE MONTH(hd.ngaydathang) = MONTH(CURDATE())
                AND YEAR(hd.ngaydathang) = YEAR(CURDATE())
                GROUP BY sp.masp, sp.tensp, sp.gia, sp.hinhanh
                ORDER BY total_sold DESC
                LIMIT $limit";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $row;
        }
    } catch (Exception $e) {
        $products = array();
    }
    
    return $products;
}

function getLowStockProducts($limit = 10) {
    $products = array();
    
    try {
        $conn = pdo_get_connection();
        $sql = "SELECT masp, tensp, soluong, gia, hinhanh
                FROM sanpham 
                WHERE soluong < 10 AND trangthai = 1
                ORDER BY soluong ASC
                LIMIT $limit";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $row;
        }
    } catch (Exception $e) {
        $products = array();
    }
    
    return $products;
}

function getTopCustomers($limit = 5) {
    $customers = array();
    
    try {
        $conn = pdo_get_connection();
        $sql = "SELECT tk.hoten, tk.email, COUNT(hd.mahd) as total_orders, 
                       SUM(hd.tongtien) as total_spent
                FROM taikhoan tk
                INNER JOIN hoadon hd ON tk.matk = hd.makh
                WHERE tk.quyen = 'user'
                GROUP BY tk.matk, tk.hoten, tk.email
                ORDER BY total_spent DESC
                LIMIT $limit";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $customers[] = $row;
        }
    } catch (Exception $e) {
        $customers = array();
    }
    
    return $customers;
}

?>
