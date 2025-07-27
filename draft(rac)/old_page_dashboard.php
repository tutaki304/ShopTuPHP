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
