<?php
include_once 'model/orders.php';

echo "=== DEBUG ORDERS PRICING ===\n\n";

// Test get_all_orders_with_calculated_total
$orders = get_all_orders_with_calculated_total();

echo "Số đơn hàng: " . count($orders) . "\n\n";

foreach($orders as $order) {
    echo "Đơn hàng #{$order['mahd']}:\n";
    echo "  - tongtien từ DB: {$order['tongtien']}\n";
    echo "  - calculated_total: {$order['calculated_total']}\n";
    echo "  - Hiển thị: " . number_format($order['calculated_total']) . "đ\n";
    echo "  - Với *1000: " . number_format($order['calculated_total'] * 1000) . "đ\n\n";
    
    if(count($orders) >= 3) break; // Chỉ test 3 đơn đầu
}
?>
