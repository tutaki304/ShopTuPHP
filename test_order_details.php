<?php
// Test order details
include_once 'model/connect.php';
include_once 'model/orders.php';

echo "=== TESTING ORDER DETAILS ===\n";

// Test order #16 from the screenshot
$order_details = get_order_details(16);

echo "Order #16 details:\n";
foreach($order_details as $item) {
    echo "Product: {$item['tensp']}\n";
    echo "  - Cart price (dongia): {$item['dongia']}\n";
    echo "  - Product price (gia_goc): {$item['gia_goc']}\n";
    echo "  - Effective price: {$item['effective_price']}\n";
    echo "  - Quantity: {$item['soluong']}\n";
    echo "  - Subtotal: " . ($item['effective_price'] * $item['soluong']) . "\n";
    echo "  - Formatted price: " . number_format($item['effective_price'] * 1000) . "đ\n\n";
}

echo "Test completed!\n";
?>
