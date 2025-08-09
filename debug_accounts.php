<?php
// Test script để kiểm tra dữ liệu tài khoản
include_once 'model/connect.php';
include_once 'model/user.php';

echo "<h3>Debug - Dữ liệu tài khoản:</h3>";

try {
    $accounts = getAllAccounts();
    echo "<p>Tổng số tài khoản: " . count($accounts) . "</p>";
    
    if (!empty($accounts)) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background: #f0f0f0;'>";
        echo "<th>STT</th><th>ID (makh)</th><th>Họ tên</th><th>Email</th><th>SĐT</th><th>Ảnh</th><th>Quyền</th>";
        echo "</tr>";
        
        $i = 1;
        foreach($accounts as $account) {
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . (isset($account['makh']) ? $account['makh'] : 'N/A') . "</td>";
            echo "<td>" . (isset($account['hoten']) ? $account['hoten'] : 'N/A') . "</td>";
            echo "<td>" . (isset($account['email']) ? $account['email'] : 'N/A') . "</td>";
            echo "<td>" . (isset($account['sdt']) ? $account['sdt'] : 'N/A') . "</td>";
            echo "<td>" . (isset($account['anh']) ? $account['anh'] : 'N/A') . "</td>";
            echo "<td>" . (isset($account['quyen']) ? $account['quyen'] : 'N/A') . "</td>";
            echo "</tr>";
            $i++;
        }
        echo "</table>";
        
        echo "<h4>Chi tiết tài khoản đầu tiên:</h4>";
        echo "<pre>";
        print_r($accounts[0]);
        echo "</pre>";
    } else {
        echo "<p>Không có dữ liệu tài khoản nào.</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>Lỗi: " . $e->getMessage() . "</p>";
}
?>
