
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
        /* Import font Google Inter cho giao diện hiện đại */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        /* CSS cơ bản cho body - thiết lập font chữ */
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* CSS cho các thẻ card - khung nội dung chính */
        .card {
            background: white;                          /* Nền trắng */
            border-radius: 0.5rem;                     /* Bo góc 8px */
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
            border: 1px solid #e5e7eb;                 /* Viền xám nhạt */
        }
        
        /* CSS cho nội dung bên trong card */
        .card-body {
            padding: 1.5rem;                           /* Khoảng cách trong 24px */
        }
        
        /* CSS cơ bản cho tất cả các nút bấm */
        .btn {
            display: inline-flex;                       /* Hiển thị nút dạng flex */  
            align-items: center;                        /* Căn giữa theo chiều dọc */
            justify-content: center;                    /* Căn giữa theo chiều ngang */
            padding: 0.5rem 1rem;                      /* Khoảng cách trong: 8px 16px */
            font-size: 0.875rem;                       /* Cỡ chữ 14px */
            font-weight: 500;                          /* Độ đậm chữ medium */
            border-radius: 0.5rem;                     /* Bo góc 8px */
            transition: all 0.2s;                      /* Hiệu ứng chuyển động 0.2s */
            outline: none;                             /* Bỏ viền focus mặc định */
            cursor: pointer;                           /* Con trỏ dạng tay khi hover */
            text-decoration: none;                     /* Bỏ gạch chân link */
        }
        
        /* CSS cho hiệu ứng focus của nút - khi nhấn Tab */
        .btn:focus {
            outline: 2px solid transparent;            /* Viền trong suốt */
            outline-offset: 2px;                       /* Khoảng cách viền */
            box-shadow: 0 0 0 2px rgba(34, 117, 194, 0.5); /* Viền xanh khi focus */
        }
        
        /* CSS cho nút chính (primary button) - màu xanh */
        .btn-primary {
            background-color: #1100ffff;               /* Nền xanh đậm */
            color: white;                              /* Chữ trắng */
        }
        
        /* CSS cho hiệu ứng hover của nút chính */
        .btn-primary:hover {
            background-color: #4338ca;                 /* Nền xanh nhạt hơn khi hover */
            color: white;                              /* Chữ vẫn trắng */
        }
        
        /* CSS cho nút phụ (secondary button) - màu xám */
        .btn-secondary {
            background-color: #6b7280;                 /* Nền xám */
            color: white;                              /* Chữ trắng */
        }
        
        /* CSS cho hiệu ứng hover của nút phụ */
        .btn-secondary:hover {
            background-color: #4b5563;                 /* Nền xám đậm hơn khi hover */
            color: white;                              /* Chữ vẫn trắng */
        }
        
        /* CSS cho lưới thống kê - hiển thị các card số liệu */
        .stats-grid {
            display: grid;                             /* Sử dụng CSS Grid */
            grid-template-columns: repeat(1, 1fr);     /* 1 cột trên mobile */
            gap: 1.5rem;                              /* Khoảng cách giữa các item: 24px */
        }
        
        /* Responsive: Hiển thị 2 cột trên tablet (640px+) */
        @media (min-width: 640px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);  /* 2 cột trên tablet */
            }
        }
        
        /* Responsive: Hiển thị 4 cột trên desktop (1280px+) */
        @media (min-width: 1280px) {
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);  /* 4 cột trên desktop */
            }
        }
        
        /* CSS cho từng card thống kê - hiển thị số liệu */
        .stat-card {
            background: white;                          /* Nền trắng */
            border-radius: 0.5rem;                     /* Bo góc 8px */
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
            border: 1px solid #e5e7eb;                 /* Viền xám nhạt */
            padding: 1.5rem;                           /* Khoảng cách trong: 24px */
        }
        
        /* CSS cho icon trong card thống kê */
        .stat-icon {
            width: 3rem;                               /* Chiều rộng: 48px */
            height: 3rem;                              /* Chiều cao: 48px */
            border-radius: 0.5rem;                     /* Bo góc 8px */
            display: flex;                             /* Hiển thị flex để căn giữa */
            align-items: center;                       /* Căn giữa theo chiều dọc */
            justify-content: center;                   /* Căn giữa theo chiều ngang */
            color: white;                              /* Màu chữ trắng */
        }
        
        /* CSS cho hiệu ứng xuất hiện từ dưới lên */
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;         /* Animation 0.6s với easing */
        }
        
        /* Định nghĩa keyframes cho animation fadeInUp */
        @keyframes fadeInUp {
            from {
                opacity: 0;                            /* Bắt đầu trong suốt */
                transform: translateY(20px);           /* Dịch chuyển xuống 20px */
            }
            to {
                opacity: 1;                            /* Kết thúc hiển thị đầy đủ */
                transform: translateY(0);              /* Về vị trí ban đầu */
            }
        }
        
        /* CSS cho text gradient - chữ có hiệu ứng màu chuyển */
        .text-gradient {
            background: linear-gradient(45deg, #84fab0 , #8fd3f4); /* Gradient xanh lá -> xanh da trời */
            -webkit-background-clip: text;             /* Clip background theo text (Webkit) */
            background-clip: text;                     /* Clip background theo text */
            -webkit-text-fill-color: transparent;      /* Làm chữ trong suốt để hiện gradient */
        }
        
        /* CSS cho nền gradient màu tím/xanh - dùng cho header */
        .bg-gradient-purple {
            background: linear-gradient(135deg, #84fab0 , #8fd3f4 100%); /* Gradient 135 độ */
        }
        
        /* CSS cho nền gradient màu xanh da trời - dùng cho icon */
        .bg-gradient-blue {
            background: linear-gradient(45deg, #3b82f6, #1d4ed8); /* Gradient xanh nhạt -> xanh đậm */
        }
        
        /* CSS cho nền gradient màu xanh lá - dùng cho icon */
        .bg-gradient-green {
            background: linear-gradient(45deg, #10b981, #047857); /* Gradient xanh lá nhạt -> đậm */
        }
        
        /* CSS cho nền gradient màu tím thay thế - dùng cho icon */
        .bg-gradient-purple-alt {
            background: linear-gradient(45deg, #8b5cf6, #6d28d9); /* Gradient tím nhạt -> tím đậm */
        }
        
        /* CSS cho nền gradient màu cam - dùng cho icon */
        .bg-gradient-orange {
            background: linear-gradient(45deg, #f59e0b, #d97706); /* Gradient cam nhạt -> cam đậm */
        }
    </style>
</head>

<body class="bg-gray-50">
    
    <!-- Main content -->
    <div class="min-h-screen w-full">
        
        <!-- Page header -->
        <div class="bg-gradient-purple px-8 pt-10 lg:pt-14 pb-16 flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-black">Dashboard Admin</h1>
                <p class="text-gray-800 mt-2">Chào mừng <?= isset($_SESSION['user']['hoten']) ? $_SESSION['user']['hoten'] : 'Admin' ?> - Quản lý cửa hàng hiệu quả</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="index.php" class="btn btn-secondary bg-white/20 text-gray-800 hover:bg-white/30 border border-white/30">
                    <i class="fas fa-home w-4 h-4 mr-2"></i>
                    Trở về trang chủ
                </a>
                <!-- <a href="admin.php?mod=product&act=add" class="btn btn-primary bg-white text-indigo-600 hover:bg-gray-100">
                    <i class="fas fa-plus w-4 h-4 mr-2"></i>
                    Thêm sản phẩm mới
                </a> -->
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
                <!-- 
                ===== PHẦN TRẠNG THÁI HỆ THỐNG =====
                
                Mục đích: Giám sát và hiển thị tình trạng hoạt động của các thành phần quan trọng trong hệ thống
                
                Các thành phần được theo dõi:
                1. SERVER (Máy chủ web): Kiểm tra xem web server (Apache/Nginx) có đang chạy không
                2. DATABASE (Cơ sở dữ liệu): Kiểm tra kết nối đến MySQL/MariaDB
                3. MEMORY (Bộ nhớ): Theo dõi mức sử dụng RAM của server
                
                Hệ thống màu sắc:
                - XANH LÁ: Tình trạng tốt, hoạt động bình thường (bg-green-100)
                - VÀNG: Cảnh báo, cần theo dõi (bg-yellow-100) 
                - ĐỎ: Lỗi nghiêm trọng, cần xử lý ngay (bg-red-100)
                
                Ứng dụng thực tế:
                - Admin có thể nhanh chóng phát hiện sự cố
                - Đưa ra quyết định kịp thời khi có vấn đề
                - Theo dõi hiệu suất để tối ưu hóa hệ thống
                -->
                
                <!-- System status - Trạng thái hệ thống -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">
                            Trạng thái hệ thống
                            <!-- Tiêu đề chính của phần monitoring -->
                        </h4>
                        <div class="space-y-4">
                            
                            <!-- 1. KIỂM TRA TRẠNG THÁI SERVER -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Server</span>
                                <!-- Nhãn hiển thị: Web Server (Apache/Nginx) -->
                                
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    <!-- Badge màu xanh = server hoạt động tốt -->
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                    <!-- Chấm tròn màu xanh = indicator trạng thái -->
                                    Hoạt động
                                    <!-- Text hiển thị: Server đang chạy bình thường -->
                                </span>
                            </div>
                            
                            <!-- 2. KIỂM TRA KẾT NỐI DATABASE -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Database</span>
                                <!-- Nhãn hiển thị: Cơ sở dữ liệu MySQL/MariaDB -->
                                
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    <!-- Badge màu xanh = database kết nối thành công -->
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                    <!-- Chấm tròn xanh = kết nối ổn định -->
                                    Kết nối
                                    <!-- Text hiển thị: Database đang kết nối bình thường -->
                                </span>
                            </div>
                            
                            <!-- 3. THEO DÕI SỬ DỤNG BỘ NHỚ -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Bộ nhớ</span>
                                <!-- Nhãn hiển thị: Memory/RAM usage -->
                                
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    <!-- Badge màu vàng = cảnh báo mức sử dụng cao -->
                                    <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></div>
                                    <!-- Chấm tròn vàng = trạng thái cảnh báo -->
                                    <?= rand(65, 85) ?>% sử dụng
                                    <!-- 
                                    Hiển thị % sử dụng RAM (hiện tại dùng random 65-85%)
                                    Trong thực tế có thể thay bằng: memory_get_usage() 
                                    -->
                                </span>
                            </div>
                            
                            <!-- 
                            THUYẾT TRÌNH: 
                            "Phần trạng thái hệ thống này giúp chúng ta theo dõi website. 
                            Hiện tại server đang hoạt động tốt (màu xanh), database kết nối ổn định, 
                            và bộ nhớ đang sử dụng khoảng 70% - mức an toàn nhưng cần theo dõi."
                            -->
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
    /* CSS tùy chỉnh cho trang Dashboard Admin */
    
    /* CSS cho container chính của dashboard */
    .dashboard-admin {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Nền gradient tím/xanh */
        min-height: 100vh;                      /* Chiều cao tối thiểu full màn hình */
        padding: 20px;                          /* Khoảng cách trong 20px */
        margin: -20px;                          /* Margin âm để full width */
    }

    /* CSS cho header của dashboard */
    .dashboard-header {
        background: rgba(255, 255, 255, 0.95);  /* Nền trắng trong suốt 95% */
        backdrop-filter: blur(10px);            /* Hiệu ứng blur nền phía sau */
        border-radius: 20px;                    /* Bo góc 20px */
        padding: 30px;                          /* Khoảng cách trong 30px */
        margin-bottom: 30px;                    /* Khoảng cách dưới 30px */
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); /* Đổ bóng mềm */
        text-align: center;                     /* Căn giữa text */
    }

    /* CSS cho tiêu đề chính của dashboard */
    .dashboard-title {
        font-size: 2.5rem;                      /* Cỡ chữ 40px */
        font-weight: 700;                       /* Độ đậm chữ bold */
        background: linear-gradient(45deg, #667eea, #764ba2); /* Gradient cho chữ */
        -webkit-background-clip: text;          /* Clip gradient theo text (Webkit) */
        background-clip: text;                  /* Clip gradient theo text */
        -webkit-text-fill-color: transparent;   /* Làm chữ trong suốt để hiện gradient */
        margin-bottom: 10px;                    /* Khoảng cách dưới 10px */
    }

    /* CSS cho phụ đề của dashboard */
    .dashboard-subtitle {
        color: #666;                            /* Màu xám */
        font-size: 1.1rem;                      /* Cỡ chữ 17.6px */
        margin-bottom: 20px;                    /* Khoảng cách dưới 20px */
    }

    /* CSS cho thông báo chào mừng người dùng */
    .welcome-user {
        background: linear-gradient(45deg, #4CAF50, #45a049); /* Gradient xanh lá */
        color: white;                           /* Chữ trắng */
        padding: 12px 25px;                     /* Khoảng cách trong: 12px dọc, 25px ngang */
        border-radius: 25px;                    /* Bo góc tròn */
        display: inline-block;                  /* Hiển thị inline-block */
        font-weight: 600;                       /* Độ đậm chữ semi-bold */
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3); /* Đổ bóng xanh */
    }

    /* === CSS CHO CÁC CARD THỐNG KÊ === */
    
    /* CSS cho lưới hiển thị các card thống kê */
    .stats-grid {
        display: grid;                                  /* Sử dụng CSS Grid */
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Tự động fit, tối thiểu 250px */
        gap: 25px;                                      /* Khoảng cách giữa các card: 25px */
        margin-bottom: 40px;                            /* Khoảng cách dưới: 40px */
    }

    /* CSS cho từng card thống kê số liệu */
    .stat-card {
        background: rgba(255, 255, 255, 0.95);          /* Nền trắng trong suốt 95% */
        backdrop-filter: blur(10px);                    /* Hiệu ứng blur nền phía sau */
        border-radius: 20px;                            /* Bo góc 20px */
        padding: 30px;                                  /* Khoảng cách trong 30px */
        text-align: center;                             /* Căn giữa nội dung */
        transition: all 0.3s ease;                      /* Hiệu ứng chuyển động 0.3s */
        position: relative;                             /* Vị trí tương đối để tạo pseudo-element */
        overflow: hidden;                               /* Ẩn phần tràn */
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);     /* Đổ bóng mềm */
    }

    /* CSS cho đường viền trên của card (sử dụng pseudo-element) */
    .stat-card::before {
        content: '';                                    /* Nội dung rỗng */
        position: absolute;                             /* Vị trí tuyệt đối */
        top: 0;                                         /* Đặt ở đầu card */
        left: 0;                                        /* Căn trái */
        right: 0;                                       /* Căn phải */
        height: 4px;                                    /* Chiều cao 4px */
        background: var(--card-color);                  /* Màu từ CSS variable */
        border-radius: 20px 20px 0 0;                  /* Bo góc trên */
    }

    /* CSS cho hiệu ứng hover của card thống kê */
    .stat-card:hover {
        transform: translateY(-10px);                   /* Nâng card lên 10px */
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);   /* Tăng độ đổ bóng */
    }

    /* CSS Variables cho màu sắc các card khác nhau */
    .stat-card.products {
        --card-color: linear-gradient(45deg, #FF6B6B, #FF8E53); /* Gradient đỏ-cam cho sản phẩm */
    }

    .stat-card.categories {
        --card-color: linear-gradient(45deg, #4ECDC4, #44A08D); /* Gradient xanh ngọc cho danh mục */
    }

    .stat-card.users {
        --card-color: linear-gradient(45deg, #A8EDEA, #6CC7E0); /* Gradient xanh da trời cho user */
    }

    .stat-card.orders {
        --card-color: linear-gradient(45deg, #D299C2, #FEF9D7); /* Gradient hồng-vàng cho đơn hàng */
    }

    /* CSS cho icon trong card thống kê (được định nghĩa lại ở đây) */
    .stat-icon {
        font-size: 3rem;                                /* Cỡ icon: 48px */
        margin-bottom: 20px;                            /* Khoảng cách dưới: 20px */
        background: var(--card-color);                  /* Nền từ CSS variable */
        -webkit-background-clip: text;                  /* Clip gradient theo text (Webkit) */
        background-clip: text;                          /* Clip gradient theo text */
        -webkit-text-fill-color: transparent;           /* Làm chữ trong suốt để hiện gradient */
    }

    /* CSS cho số liệu thống kê */
    .stat-number {
        font-size: 2.5rem;                              /* Cỡ chữ: 40px */
        font-weight: 700;                               /* Độ đậm: bold */
        color: #333;                                    /* Màu xám đậm */
        margin-bottom: 10px;                            /* Khoảng cách dưới: 10px */
    }

    /* CSS cho nhãn mô tả thống kê */
    .stat-label {
        color: #666;                                    /* Màu xám nhạt */
        font-size: 1.1rem;                              /* Cỡ chữ: 17.6px */
        font-weight: 500;                               /* Độ đậm: medium */
        text-transform: uppercase;                       /* Chữ hoa */
        letter-spacing: 1px;                            /* Khoảng cách giữa các chữ cái */
    }

    /* === CSS CHO PHẦN THAO TÁC NHANH === */
    
    /* CSS cho container của quick actions */
    .quick-actions {
        background: rgba(255, 255, 255, 0.95);          /* Nền trắng trong suốt 95% */
        backdrop-filter: blur(10px);                    /* Hiệu ứng blur nền phía sau */
        border-radius: 20px;                            /* Bo góc 20px */
        padding: 30px;                                  /* Khoảng cách trong 30px */
        margin-bottom: 40px;                            /* Khoảng cách dưới 40px */
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);     /* Đổ bóng mềm */
    }

    /* CSS cho tiêu đề section */
    .section-title {
        font-size: 1.8rem;                              /* Cỡ chữ: 28.8px */
        font-weight: 600;                               /* Độ đậm: semi-bold */
        margin-bottom: 25px;                            /* Khoảng cách dưới: 25px */
        color: #333;                                    /* Màu xám đậm */
        text-align: center;                             /* Căn giữa */
    }

    /* CSS cho lưới hiển thị các nút thao tác */
    .actions-grid {
        display: grid;                                  /* Sử dụng CSS Grid */
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); /* Tự động fit, tối thiểu 180px */
        gap: 20px;                                      /* Khoảng cách giữa các nút: 20px */
    }

    /* CSS cho từng nút thao tác */
    .action-btn {
        background: linear-gradient(45deg, #667eea, #764ba2); /* Gradient tím/xanh */
        color: white;                                   /* Chữ trắng */
        padding: 20px;                                  /* Khoảng cách trong 20px */
        border-radius: 15px;                            /* Bo góc 15px */
        text-decoration: none;                          /* Bỏ gạch chân */
        text-align: center;                             /* Căn giữa text */
        transition: all 0.3s ease;                      /* Hiệu ứng chuyển động 0.3s */
        font-weight: 600;                               /* Độ đậm: semi-bold */
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3); /* Đổ bóng tím */
        display: block;                                 /* Hiển thị dạng block */
    }

    /* CSS cho hiệu ứng hover của nút thao tác */
    .action-btn:hover {
        transform: translateY(-5px);                    /* Nâng nút lên 5px */
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4); /* Tăng độ đổ bóng */
        color: white;                                   /* Giữ màu chữ trắng */
        text-decoration: none;                          /* Bỏ gạch chân */
    }

    /* CSS cho icon trong nút thao tác */
    .action-btn i {
        font-size: 1.5rem;                              /* Cỡ icon: 24px */
        margin-bottom: 10px;                            /* Khoảng cách dưới: 10px */
        display: block;                                 /* Hiển thị dạng block để icon xuống dòng */
    }

    /* === CSS CHO PHẦN NỘI DUNG GẦN ĐÂY === */
    
    /* CSS cho lưới hiển thị nội dung (2 cột) */
    .content-grid {
        display: grid;                                  /* Sử dụng CSS Grid */
        grid-template-columns: 1fr 1fr;                /* 2 cột bằng nhau */
        gap: 30px;                                      /* Khoảng cách giữa các cột: 30px */
        margin-bottom: 40px;                            /* Khoảng cách dưới: 40px */
    }

    /* CSS cho từng section nội dung */
    .content-section {
        background: rgba(255, 255, 255, 0.95);          /* Nền trắng trong suốt 95% */
        backdrop-filter: blur(10px);                    /* Hiệu ứng blur nền phía sau */
        border-radius: 20px;                            /* Bo góc 20px */
        padding: 30px;                                  /* Khoảng cách trong 30px */
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);     /* Đổ bóng mềm */
    }

    /* CSS cho từng item sản phẩm */
    .product-item {
        display: flex;                                  /* Hiển thị flex */
        align-items: center;                            /* Căn giữa theo chiều dọc */
        padding: 15px;                                  /* Khoảng cách trong 15px */
        border-radius: 12px;                            /* Bo góc 12px */
        margin-bottom: 15px;                            /* Khoảng cách dưới 15px */
        background: #f8f9fa;                            /* Nền xám nhạt */
        transition: all 0.3s ease;                      /* Hiệu ứng chuyển động 0.3s */
    }

    /* CSS cho hiệu ứng hover của product item */
    .product-item:hover {
        background: #e3f2fd;                            /* Nền xanh nhạt khi hover */
        transform: translateX(10px);                    /* Dịch chuyển sang phải 10px */
    }

    /* CSS cho hình ảnh sản phẩm */
    .product-image {
        width: 60px;                                    /* Chiều rộng: 60px */
        height: 60px;                                   /* Chiều cao: 60px */
        border-radius: 10px;                            /* Bo góc 10px */
        object-fit: cover;                              /* Cắt ảnh vừa khung */
        margin-right: 15px;                             /* Khoảng cách phải: 15px */
        border: 2px solid #ddd;                         /* Viền xám nhạt 2px */
    }

    /* CSS cho tiêu đề sản phẩm */
    .product-info h4 {
        font-size: 14px;                                /* Cỡ chữ: 14px */
        font-weight: 600;                               /* Độ đậm: semi-bold */
        color: #333;                                    /* Màu xám đậm */
        margin-bottom: 5px;                             /* Khoảng cách dưới: 5px */
        line-height: 1.4;                               /* Chiều cao dòng: 1.4 */
    }

    /* CSS cho giá sản phẩm */
    .product-price {
        color: #e74c3c;                                 /* Màu đỏ */
        font-weight: 600;                               /* Độ đậm: semi-bold */
        font-size: 13px;                                /* Cỡ chữ: 13px */
    }

    /* === CSS CHO PHẦN TRẠNG THÁI HỆ THỐNG === */
    
    /* CSS cho container trạng thái hệ thống */
    .system-status {
        background: rgba(255, 255, 255, 0.95);          /* Nền trắng trong suốt 95% */
        backdrop-filter: blur(10px);                    /* Hiệu ứng blur nền phía sau */
        border-radius: 20px;                            /* Bo góc 20px */
        padding: 30px;                                  /* Khoảng cách trong 30px */
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);     /* Đổ bóng mềm */
    }

    /* CSS cho từng item trạng thái */
    .status-item {
        display: flex;                                  /* Hiển thị flex */
        justify-content: space-between;                 /* Căn đều 2 đầu */
        align-items: center;                            /* Căn giữa theo chiều dọc */
        padding: 15px 0;                                /* Khoảng cách dọc: 15px */
        border-bottom: 1px solid #eee;                  /* Viền dưới xám nhạt */
    }

    /* CSS để bỏ viền dưới cho item cuối cùng */
    .status-item:last-child {
        border-bottom: none;                            /* Không có viền dưới */
    }

    /* CSS cho nhãn trạng thái */
    .status-label {
        font-weight: 600;                               /* Độ đậm: semi-bold */
        color: #333;                                    /* Màu xám đậm */
    }

    /* CSS cho giá trị trạng thái */
    .status-value {
        padding: 5px 15px;                              /* Khoảng cách trong: 5px dọc, 15px ngang */
        border-radius: 20px;                            /* Bo góc tròn */
        font-size: 12px;                                /* Cỡ chữ: 12px */
        font-weight: 600;                               /* Độ đậm: semi-bold */
    }

    /* CSS cho trạng thái tốt (màu xanh) */
    .status-good {
        background: #d4edda;                            /* Nền xanh nhạt */
        color: #155724;                                 /* Chữ xanh đậm */
    }

    /* CSS cho trạng thái cảnh báo (màu vàng) */
    .status-warning {
        background: #fff3cd;                            /* Nền vàng nhạt */
        color: #856404;                                 /* Chữ vàng đậm */
    }

    /* === CSS RESPONSIVE CHO MOBILE === */
    
    /* CSS cho màn hình nhỏ hơn 768px (tablet và mobile) */
    @media (max-width: 768px) {
        /* Giảm padding cho dashboard chính */
        .dashboard-admin {
            padding: 10px;                              /* Giảm padding xuống 10px */
            margin: -10px;                              /* Giảm margin âm xuống -10px */
        }

        /* Giảm cỡ chữ tiêu đề trên mobile */
        .dashboard-title {
            font-size: 2rem;                           /* Giảm cỡ chữ xuống 32px */
        }

        /* Chuyển content grid thành 1 cột */
        .content-grid {
            grid-template-columns: 1fr;                /* 1 cột thay vì 2 cột */
        }

        /* Chuyển stats grid thành 1 cột */
        .stats-grid {
            grid-template-columns: 1fr;                /* 1 cột thay vì auto-fit */
        }

        /* Giảm số cột actions grid */
        .actions-grid {
            grid-template-columns: repeat(2, 1fr);     /* 2 cột thay vì auto-fit */
        }
    }

    /* === CSS ANIMATIONS === */
    
    /* Định nghĩa keyframe cho hiệu ứng fadeInUp */
    @keyframes fadeInUp {
        from {
            opacity: 0;                                 /* Bắt đầu trong suốt */
            transform: translateY(30px);               /* Dịch chuyển xuống 30px */
        }
        to {
            opacity: 1;                                 /* Kết thúc hiển thị đầy đủ */
            transform: translateY(0);                   /* Về vị trí ban đầu */
        }
    }

    /* Áp dụng animation cho các stat card */
    .stat-card {
        animation: fadeInUp 0.6s ease;                  /* Animation 0.6s với easing */
    }

    /* Tạo delay khác nhau cho từng card để hiệu ứng đẹp hơn */
    .stat-card:nth-child(1) { animation-delay: 0.1s; } /* Card đầu tiên delay 0.1s */
    .stat-card:nth-child(2) { animation-delay: 0.2s; } /* Card thứ 2 delay 0.2s */
    .stat-card:nth-child(3) { animation-delay: 0.3s; } /* Card thứ 3 delay 0.3s */
    .stat-card:nth-child(4) { animation-delay: 0.4s; } /* Card thứ 4 delay 0.4s */
</style>