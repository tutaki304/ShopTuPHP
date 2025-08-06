<?php
// Test tìm kiếm sản phẩm
include_once 'model/connect.php';
include_once 'model/products.php';

echo "=== TEST TÌM KIẾM SẢN PHẨM ===\n";

// Test function product_search
echo "1. Test function product_search:\n";
try {
    $results = product_search("áo");
    echo "Tìm kiếm 'áo': " . count($results) . " kết quả\n";
    
    if(count($results) > 0) {
        foreach(array_slice($results, 0, 3) as $product) {
            echo "  - {$product['tensp']} (Danh mục: {$product['tendm']})\n";
        }
    }
    
    echo "\n";
    
    $results2 = product_search("test123xyz");
    echo "Tìm kiếm 'test123xyz': " . count($results2) . " kết quả\n";
    
} catch(Exception $e) {
    echo "Lỗi: " . $e->getMessage() . "\n";
}

echo "\nTest hoàn tất!\n";
?>
