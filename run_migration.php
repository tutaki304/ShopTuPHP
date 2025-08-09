<?php
// File: run_migration.php
// Chạy file này để tự động thêm cột diachi_giaohang vào bảng hoadon

include_once 'model/connect.php';

echo "<h2>Migration: Thêm cột diachi_giaohang</h2>";

try {
    // Kiểm tra kết nối database
    echo "<p>✅ Kết nối database thành công</p>";
    
    // Kiểm tra xem cột đã tồn tại chưa
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_NAME = 'hoadon' 
            AND COLUMN_NAME = 'diachi_giaohang'
            AND TABLE_SCHEMA = DATABASE()";
    $result = pdo_query($sql);
    
    if (empty($result)) {
        echo "<p>⚠️ Cột 'diachi_giaohang' chưa tồn tại, đang thêm...</p>";
        
        // Thêm cột
        $sql = "ALTER TABLE `hoadon` ADD COLUMN `diachi_giaohang` TEXT NULL AFTER `ghichu`";
        pdo_execute($sql);
        
        echo "<p>✅ Đã thêm cột 'diachi_giaohang' thành công!</p>";
    } else {
        echo "<p>ℹ️ Cột 'diachi_giaohang' đã tồn tại, không cần thêm</p>";
    }
    
    // Hiển thị cấu trúc bảng sau khi cập nhật
    echo "<h3>Cấu trúc bảng hoadon hiện tại:</h3>";
    $sql = "DESCRIBE `hoadon`";
    $columns = pdo_query($sql);
    
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr style='background: #f0f0f0;'>";
    echo "<th style='padding: 8px;'>Cột</th>";
    echo "<th style='padding: 8px;'>Kiểu dữ liệu</th>";
    echo "<th style='padding: 8px;'>Null</th>";
    echo "<th style='padding: 8px;'>Key</th>";
    echo "<th style='padding: 8px;'>Default</th>";
    echo "</tr>";
    
    foreach($columns as $col) {
        echo "<tr>";
        echo "<td style='padding: 8px; font-weight: " . ($col['Field'] == 'diachi_giaohang' ? 'bold; background: #e8f5e8;' : 'normal;') . "'>" . $col['Field'] . "</td>";
        echo "<td style='padding: 8px;'>" . $col['Type'] . "</td>";
        echo "<td style='padding: 8px;'>" . $col['Null'] . "</td>";
        echo "<td style='padding: 8px;'>" . $col['Key'] . "</td>";
        echo "<td style='padding: 8px;'>" . ($col['Default'] ?? 'NULL') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Đếm số đơn hàng
    $sql = "SELECT COUNT(*) as total FROM `hoadon`";
    $count = pdo_query_one($sql);
    echo "<p>📊 Tổng số đơn hàng trong database: <strong>" . $count['total'] . "</strong></p>";
    
    echo "<h3>✅ Migration hoàn tất!</h3>";
    echo "<p>Bây giờ bạn có thể sử dụng tính năng lưu địa chỉ giao hàng.</p>";
    echo "<p><a href='index.php'>← Quay lại trang chủ</a></p>";
    
} catch(Exception $e) {
    echo "<p style='color: red;'>❌ Lỗi: " . $e->getMessage() . "</p>";
    echo "<p>Vui lòng kiểm tra lại kết nối database hoặc chạy script SQL thủ công.</p>";
}
?>
