
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

<div class="dashboard-admin">
    <!-- Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard Quản Trị
        </h1>
        <p class="dashboard-subtitle">Tổng quan hệ thống quản lý ShopTu</p>
        <div class="welcome-user">
            <i class="fas fa-user-shield"></i>
            Chào mừng, <?= isset($_SESSION['user']['hoten']) ? $_SESSION['user']['hoten'] : 'Admin' ?>!
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card products">
            <div class="stat-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-number"><?= $total_products ?></div>
            <div class="stat-label">Sản phẩm</div>
        </div>

        <div class="stat-card categories">
            <div class="stat-icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-number"><?= $total_categories ?></div>
            <div class="stat-label">Danh mục</div>
        </div>

        <div class="stat-card users">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-number"><?= $total_accounts ?></div>
            <div class="stat-label">Tài khoản</div>
        </div>

        <div class="stat-card orders">
            <div class="stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-number">0</div>
            <div class="stat-label">Đơn hàng</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2 class="section-title">
            <i class="fas fa-bolt"></i>
            Thao tác nhanh
        </h2>
        <div class="actions-grid">
            <a href="admin.php?mod=product&act=add" class="action-btn">
                <i class="fas fa-plus"></i>
                Thêm sản phẩm
            </a>
            <a href="admin.php?mod=product&act=add_danhmuc" class="action-btn">
                <i class="fas fa-folder-plus"></i>
                Thêm danh mục
            </a>
            <a href="admin.php?mod=user&act=add" class="action-btn">
                <i class="fas fa-user-plus"></i>
                Thêm tài khoản
            </a>
            <a href="admin.php?mod=product&act=admin" class="action-btn">
                <i class="fas fa-list"></i>
                Quản lý sản phẩm
            </a>
            <a href="admin.php?mod=product&act=admin_danhmuc" class="action-btn">
                <i class="fas fa-sitemap"></i>
                Quản lý danh mục
            </a>
            <a href="admin.php?mod=user&act=user" class="action-btn">
                <i class="fas fa-users-cog"></i>
                Quản lý tài khoản
            </a>
        </div>
    </div>

    <!-- Recent Content -->
    <div class="content-grid">
        <!-- Recent Products -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-clock"></i>
                Sản phẩm mới nhất
            </h2>
            <?php if (!empty($recent_products)): ?>
                <?php foreach($recent_products as $product): ?>
                    <div class="product-item">
                        <img src="upload/product/<?= $product['anh'] ?>" alt="<?= $product['tensp'] ?>" class="product-image">
                        <div class="product-info">
                            <h4><?= substr($product['tensp'], 0, 30) ?><?= strlen($product['tensp']) > 30 ? '...' : '' ?></h4>
                            <div class="product-price"><?= number_format($product['khuyenmai']) ?>đ</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; color: #999; padding: 20px;">Chưa có sản phẩm nào</p>
            <?php endif; ?>
        </div>

        <!-- Most Viewed Products -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-fire"></i>
                Sản phẩm xem nhiều
            </h2>
            <?php if (!empty($viewed_products)): ?>
                <?php foreach($viewed_products as $product): ?>
                    <div class="product-item">
                        <img src="upload/product/<?= $product['anh'] ?>" alt="<?= $product['tensp'] ?>" class="product-image">
                        <div class="product-info">
                            <h4><?= substr($product['tensp'], 0, 30) ?><?= strlen($product['tensp']) > 30 ? '...' : '' ?></h4>
                            <div class="product-price">
                                <?= number_format($product['khuyenmai']) ?>đ 
                                <small>(<?= $product['soluotxem'] ?> lượt xem)</small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; color: #999; padding: 20px;">Chưa có dữ liệu xem</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- System Status -->
    <div class="system-status">
        <h2 class="section-title">
            <i class="fas fa-server"></i>
            Trạng thái hệ thống
        </h2>
        <div class="status-item">
            <span class="status-label">Kết nối Database</span>
            <span class="status-value status-good">Hoạt động tốt</span>
        </div>
        <div class="status-item">
            <span class="status-label">Dung lượng upload</span>
            <span class="status-value status-good">Bình thường</span>
        </div>
        <div class="status-item">
            <span class="status-label">Bảo mật</span>
            <span class="status-value status-good">An toàn</span>
        </div>
        <div class="status-item">
            <span class="status-label">Phiên bản PHP</span>
            <span class="status-value status-good"><?= phpversion() ?></span>
        </div>
        <div class="status-item">
            <span class="status-label">Thời gian hoạt động</span>
            <span class="status-value status-good"><?= date('d/m/Y H:i:s') ?></span>
        </div>
    </div>
</div>

<script>
    // Add interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        // Animate numbers
        const numberElements = document.querySelectorAll('.stat-number');
        numberElements.forEach(element => {
            const finalNumber = parseInt(element.textContent);
            if (!isNaN(finalNumber)) {
                animateNumber(element, 0, finalNumber, 1000);
            }
        });
        
        // Add click effects to action buttons
        const actionBtns = document.querySelectorAll('.action-btn');
        actionBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                // Create ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
                ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
                ripple.classList.add('ripple');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.3)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple-animation 0.6s linear';
                ripple.style.pointerEvents = 'none';
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    });

    function animateNumber(element, start, end, duration) {
        const startTime = performance.now();
        const animate = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const current = Math.floor(start + (end - start) * progress);
            element.textContent = current;
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        };
        requestAnimationFrame(animate);
    }
</script>

<style>
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
</style>
