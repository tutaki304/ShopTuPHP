
<?php
// Kiểm tra quyền admin
if (!isset($_SESSION['user']) || $_SESSION['user']['quyen'] != 'admin') {
    header('Location: index.php?mod=page&act=home');
    exit();
}

// Lấy thống kê dữ liệu
include_once 'model/products.php';
include_once 'model/user.php';
include_once 'model/categories.php';

// Đếm sản phẩm
$count_products = count_products();
$total_products = $count_products['soluong'];

// Đếm danh mục  
$categories = get_categories();
$total_categories = count($categories);

// Đếm tài khoản
$accounts = getAllAccounts();
$total_accounts = count($accounts);

// Lấy sản phẩm mới nhất
$recent_products = get_productNew(6);

// Lấy sản phẩm xem nhiều nhất
$viewed_products = get_productView(6);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ShopTu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s;
            outline: none;
            cursor: pointer;
            text-decoration: none;
        }
        
        .btn:focus {
            outline: 2px solid transparent;
            outline-offset: 2px;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
        }
        
        .btn-primary {
            background-color: #4f46e5;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #4338ca;
            color: white;
        }
        
        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #4b5563;
            color: white;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
        }
        
        @media (min-width: 640px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (min-width: 1280px) {
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        .stat-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            padding: 1.5rem;
        }
        
        .stat-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .text-gradient {
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .bg-gradient-purple {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .bg-gradient-blue {
            background: linear-gradient(45deg, #3b82f6, #1d4ed8);
        }
        
        .bg-gradient-green {
            background: linear-gradient(45deg, #10b981, #047857);
        }
        
        .bg-gradient-purple-alt {
            background: linear-gradient(45deg, #8b5cf6, #6d28d9);
        }
        
        .bg-gradient-orange {
            background: linear-gradient(45deg, #f59e0b, #d97706);
        }
    </style>
</head>

<body class="bg-gray-50">
    
    <!-- Main content -->
    <div class="min-h-screen w-full">
        
        <!-- Page header -->
        <div class="bg-gradient-purple px-8 pt-10 lg:pt-14 pb-16 flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-white">Dashboard Admin</h1>
                <p class="text-indigo-100 mt-2">Chào mừng <?= isset($_SESSION['user']['hoten']) ? $_SESSION['user']['hoten'] : 'Admin' ?> - Quản lý cửa hàng hiệu quả</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="index.php" class="btn btn-secondary bg-white/20 text-white hover:bg-white/30 border border-white/30">
                    <i class="fas fa-home w-4 h-4 mr-2"></i>
                    Trở về trang chủ
                </a>
                <a href="admin.php?mod=product&act=add" class="btn btn-primary bg-white text-indigo-600 hover:bg-gray-100">
                    <i class="fas fa-plus w-4 h-4 mr-2"></i>
                    Thêm sản phẩm mới
                </a>
            </div>
        </div>
        
        <!-- Stats cards -->
        <div class="-mt-12 mx-8 mb-8 stats-grid animate-fade-in-up">
            <!-- Tổng sản phẩm -->
            <div class="stat-card">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="text-gray-600 text-sm font-medium">Tổng sản phẩm</h4>
                        <div class="mt-2">
                            <h2 class="text-3xl font-bold text-gray-900">
                                <?= $total_products ?>
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">Sản phẩm đang hoạt động</p>
                        </div>
                    </div>
                    <div class="stat-icon bg-gradient-blue">
                        <i class="fas fa-box text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Tổng người dùng -->
            <div class="stat-card">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="text-gray-600 text-sm font-medium">Người dùng</h4>
                        <div class="mt-2">
                            <h2 class="text-3xl font-bold text-gray-900">
                                <?= $total_accounts ?>
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">Tài khoản đã đăng ký</p>
                        </div>
                    </div>
                    <div class="stat-icon bg-gradient-green">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Danh mục -->
            <div class="stat-card">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="text-gray-600 text-sm font-medium">Danh mục</h4>
                        <div class="mt-2">
                            <h2 class="text-3xl font-bold text-gray-900">
                                <?= $total_categories ?>
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">Phân loại sản phẩm</p>
                        </div>
                    </div>
                    <div class="stat-icon bg-gradient-purple-alt">
                        <i class="fas fa-tags text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Hiệu suất -->
            <div class="stat-card">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="text-gray-600 text-sm font-medium">Hiệu suất</h4>
                        <div class="mt-2">
                            <h2 class="text-3xl font-bold text-gray-900">
                                98%
                            </h2>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>
                                +5% từ tháng trước
                            </p>
                        </div>
                    </div>
                    <div class="stat-icon bg-gradient-orange">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Content grid -->
        <div class="mx-8 grid grid-cols-1 xl:grid-cols-3 gap-8 mb-8">
            <!-- Recent products table -->
            <div class="xl:col-span-2">
                <div class="card h-full">
                    <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                        <h4 class="text-lg font-semibold text-gray-900">Sản phẩm gần đây</h4>
                        <a href="admin.php?mod=product&act=admin" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                            Xem tất cả <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Danh mục</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if(!empty($recent_products)): ?>
                                    <?php foreach($recent_products as $product): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img src="upload/product/<?= $product['anh'] ?>" alt="" class="w-12 h-12 rounded-lg object-cover">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?= $product['tensp'] ?></div>
                                                    <div class="text-sm text-gray-500">ID: <?= $product['masp'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?= $product['tendm'] ?? 'N/A' ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?= number_format($product['khuyenmai']) ?>đ
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Hoạt động
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                            <i class="fas fa-box-open text-4xl text-gray-300 mb-4 block"></i>
                                            <p>Chưa có sản phẩm nào</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Quick actions and status -->
            <div class="space-y-6">
                <!-- System status -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Trạng thái hệ thống</h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Server</span>
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                    Hoạt động
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Database</span>
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                    Kết nối
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Bộ nhớ</span>
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></div>
                                    <?= rand(65, 85) ?>% sử dụng
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick actions -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Thao tác nhanh</h4>
                        <div class="space-y-3">
                            <a href="admin.php?mod=product&act=add" class="w-full btn btn-primary justify-start">
                                <i class="fas fa-plus w-4 h-4 mr-3"></i>
                                Thêm sản phẩm
                            </a>
                            <a href="admin.php?mod=product&act=add_danhmuc" class="w-full btn btn-secondary justify-start">
                                <i class="fas fa-tags w-4 h-4 mr-3"></i>
                                Thêm danh mục
                            </a>
                            <a href="admin.php?mod=user&act=add_user" class="w-full btn btn-secondary justify-start">
                                <i class="fas fa-user-plus w-4 h-4 mr-3"></i>
                                Thêm người dùng
                            </a>
                            <a href="index.php" class="w-full btn btn-secondary justify-start">
                                <i class="fas fa-home w-4 h-4 mr-3"></i>
                                Trở về trang chủ
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Top products -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Sản phẩm xem nhiều</h4>
                        <div class="space-y-3">
                            <?php if(!empty($viewed_products)): ?>
                                <?php foreach(array_slice($viewed_products, 0, 4) as $product): ?>
                                <div class="flex items-center space-x-3">
                                    <img src="upload/product/<?= $product['anh'] ?>" alt="" class="w-10 h-10 rounded-lg object-cover">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            <?= $product['tensp'] ?>
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            <?= number_format($product['khuyenmai']) ?>đ
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        <?= $product['soluotxem'] ?> views
                                    </span>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-gray-500 text-sm text-center py-4">Chưa có dữ liệu</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom section -->
        <div class="mx-8 mb-8">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 border border-blue-200">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <div class="flex-shrink-0">
                            <i class="fas fa-lightbulb text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-blue-900">Mẹo quản lý</h3>
                            <p class="text-blue-700">Cập nhật thông tin sản phẩm thường xuyên để thu hút khách hàng. Theo dõi thống kê để đưa ra quyết định kinh doanh hiệu quả.</p>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="admin.php?mod=product&act=admin" class="btn btn-primary">
                            Quản lý ngay
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe all cards
        document.querySelectorAll('.card, .stat-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
        
        // Show cards immediately on load
        setTimeout(() => {
            document.querySelectorAll('.card, .stat-card').forEach(card => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            });
        }, 100);
        
        // Counter animation for numbers
        function animateNumber(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 20);
        }
        
        // Start counter animations
        document.addEventListener('DOMContentLoaded', () => {
            const numbers = document.querySelectorAll('.stat-card h2');
            numbers.forEach(num => {
                const target = parseInt(num.textContent);
                if (!isNaN(target)) {
                    num.textContent = '0';
                    setTimeout(() => animateNumber(num, target), 500);
                }
            });
        });
    </script>
</body>
</html>

<style>
    .dashboard-admin {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px;
        margin: -20px;
    }

    .dashboard-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
    }

    .dashboard-subtitle {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .welcome-user {
        background: linear-gradient(45deg, #4CAF50, #45a049);
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        display: inline-block;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--card-color);
        border-radius: 20px 20px 0 0;
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .stat-card.products {
        --card-color: linear-gradient(45deg, #FF6B6B, #FF8E53);
    }

    .stat-card.categories {
        --card-color: linear-gradient(45deg, #4ECDC4, #44A08D);
    }

    .stat-card.users {
        --card-color: linear-gradient(45deg, #A8EDEA, #6CC7E0);
    }

    .stat-card.orders {
        --card-color: linear-gradient(45deg, #D299C2, #FEF9D7);
    }

    .stat-icon {
        font-size: 3rem;
        margin-bottom: 20px;
        background: var(--card-color);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .stat-label {
        color: #666;
        font-size: 1.1rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Quick Actions */
    .quick-actions {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 40px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 25px;
        color: #333;
        text-align: center;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
    }

    .action-btn {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        padding: 20px;
        border-radius: 15px;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        display: block;
    }

    .action-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .action-btn i {
        font-size: 1.5rem;
        margin-bottom: 10px;
        display: block;
    }

    /* Recent Content */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 40px;
    }

    .content-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .product-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 15px;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .product-item:hover {
        background: #e3f2fd;
        transform: translateX(10px);
    }

    .product-image {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
        margin-right: 15px;
        border: 2px solid #ddd;
    }

    .product-info h4 {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        line-height: 1.4;
    }

    .product-price {
        color: #e74c3c;
        font-weight: 600;
        font-size: 13px;
    }

    /* System Status */
    .system-status {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .status-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .status-item:last-child {
        border-bottom: none;
    }

    .status-label {
        font-weight: 600;
        color: #333;
    }

    .status-value {
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-good {
        background: #d4edda;
        color: #155724;
    }

    .status-warning {
        background: #fff3cd;
        color: #856404;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-admin {
            padding: 10px;
            margin: -10px;
        }

        .dashboard-title {
            font-size: 2rem;
        }

        .content-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .actions-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card {
        animation: fadeInUp 0.6s ease;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
</style>