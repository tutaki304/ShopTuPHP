<?php
// View cảnh báo sản phẩm sắp hết hàng
if (!isset($_SESSION['user']) || $_SESSION['user']['quyen'] != 'admin') {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảnh báo sản phẩm sắp hết hàng - ShopTu Admin</title>
    <link href="https://cdn.tailwindcss.com/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .alert-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .alert-item {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                        Cảnh báo sản phẩm sắp hết hàng
                    </h1>
                    <p class="mt-2 text-gray-600">Danh sách các sản phẩm có số lượng tồn kho thấp</p>
                </div>
                <div class="flex items-center space-x-4">
                    <form method="GET" class="flex items-center space-x-2">
                        <input type="hidden" name="mod" value="order">
                        <input type="hidden" name="act" value="stock_alert">
                        <label class="text-sm text-gray-600">Ngưỡng cảnh báo:</label>
                        <input type="number" name="threshold" value="<?= $threshold ?>" 
                               class="w-20 px-2 py-1 border border-gray-300 rounded text-sm" min="1" max="100">
                        <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600">
                            <i class="fas fa-filter mr-1"></i>Lọc
                        </button>
                    </form>
                    <a href="admin.php?mod=page&act=dashboard" 
                       class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        <i class="fas fa-arrow-left mr-2"></i>Về Dashboard
                    </a>
                </div>
            </div>
        </div>

        <?php if (empty($low_stock_products)): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg text-center">
            <i class="fas fa-check-circle text-2xl mb-2"></i>
            <h3 class="text-lg font-semibold">Tất cả sản phẩm đều có đủ số lượng tồn kho!</h3>
            <p>Không có sản phẩm nào có số lượng thấp hơn <?= $threshold ?> sản phẩm.</p>
        </div>
        <?php else: ?>
        
        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-red-100 border border-red-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-red-500 rounded-full">
                        <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-red-700">Sản phẩm cảnh báo</h3>
                        <p class="text-2xl font-bold text-red-600"><?= count($low_stock_products) ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-orange-100 border border-orange-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-500 rounded-full">
                        <i class="fas fa-box text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-orange-700">Tổng số lượng còn lại</h3>
                        <p class="text-2xl font-bold text-orange-600">
                            <?= array_sum(array_column($low_stock_products, 'soluong')) ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-blue-100 border border-blue-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-500 rounded-full">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-blue-700">Ngưỡng cảnh báo</h3>
                        <p class="text-2xl font-bold text-blue-600">≤ <?= $threshold ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product List -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">
                    Danh sách sản phẩm cần cập nhật (<?= count($low_stock_products) ?> sản phẩm)
                </h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng còn lại</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mức độ cảnh báo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($low_stock_products as $product): ?>
                        <tr class="alert-item hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="upload/product/<?= $product['anh'] ?>" alt="" 
                                         class="w-16 h-16 rounded-lg object-cover">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?= htmlspecialchars($product['tensp']) ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            ID: #<?= $product['masp'] ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-2xl font-bold <?= $product['soluong'] == 0 ? 'text-red-600' : 'text-orange-600' ?>">
                                        <?= $product['soluong'] ?>
                                    </span>
                                    <span class="ml-2 text-gray-500">sản phẩm</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($product['soluong'] == 0): ?>
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>Hết hàng
                                    </span>
                                <?php elseif ($product['soluong'] <= 2): ?>
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>Rất thấp
                                    </span>
                                <?php elseif ($product['soluong'] <= 5): ?>
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">
                                        <i class="fas fa-exclamation-circle mr-1"></i>Thấp
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-info-circle mr-1"></i>Cần chú ý
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="admin.php?mod=product&act=edit&id=<?= $product['masp'] ?>" 
                                   class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    <i class="fas fa-edit mr-1"></i>Cập nhật kho
                                </a>
                                <a href="admin.php?mod=product&act=detail&id=<?= $product['masp'] ?>" 
                                   class="inline-flex items-center px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">
                                    <i class="fas fa-eye mr-1"></i>Xem chi tiết
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 bg-blue-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-900 mb-4">
                <i class="fas fa-lightning-bolt mr-2"></i>Hành động nhanh
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="admin.php?mod=product&act=add" 
                   class="flex items-center p-4 bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                    <div class="p-3 bg-green-500 rounded-full mr-4">
                        <i class="fas fa-plus text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Thêm sản phẩm mới</h4>
                        <p class="text-sm text-gray-600">Bổ sung sản phẩm vào kho</p>
                    </div>
                </a>
                
                <a href="admin.php?mod=product&act=admin" 
                   class="flex items-center p-4 bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                    <div class="p-3 bg-orange-500 rounded-full mr-4">
                        <i class="fas fa-boxes text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Quản lý kho hàng</h4>
                        <p class="text-sm text-gray-600">Cập nhật số lượng sản phẩm</p>
                    </div>
                </a>
                
                <a href="admin.php?mod=order&act=stock_history" 
                   class="flex items-center p-4 bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                    <div class="p-3 bg-purple-500 rounded-full mr-4">
                        <i class="fas fa-history text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Lịch sử kho hàng</h4>
                        <p class="text-sm text-gray-600">Xem lịch sử thay đổi</p>
                    </div>
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script>
        // Auto refresh page every 5 minutes
        setTimeout(() => {
            location.reload();
        }, 300000);
        
        // Highlight critical items
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.alert-item');
            rows.forEach(row => {
                const stockText = row.querySelector('td:nth-child(2) span').textContent;
                const stock = parseInt(stockText);
                
                if (stock === 0) {
                    row.style.backgroundColor = '#fef2f2';
                    row.style.borderLeft = '4px solid #ef4444';
                } else if (stock <= 2) {
                    row.style.backgroundColor = '#fff7ed';
                    row.style.borderLeft = '4px solid #f97316';
                }
            });
        });
    </script>
</body>
</html>
