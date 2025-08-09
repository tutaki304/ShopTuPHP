<style>
    .user-orders-container {
        padding: 20px 0;
        max-width: 1200px;
        margin: 0 auto;
        margin-top: 40px; /* Tăng margin để không bị header che */
    }
    
    .orders-header {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 30px;
        text-align: center;
    }
    
    .orders-header h2 {
        color: #2c3e50;
        margin: 0 0 10px 0;
        font-size: 32px;
        font-weight: 600;
    }
    
    .orders-header p {
        color: #7f8c8d;
        margin: 0;
        font-size: 16px;
    }
    
    .orders-grid {
        display: grid;
        gap: 20px;
    }
    
    .order-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    
    .order-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .order-id {
        font-size: 18px;
        font-weight: 600;
    }
    
    .order-date {
        font-size: 14px;
        opacity: 0.9;
    }
    
    .order-body {
        padding: 20px;
    }
    
    .order-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .info-icon {
        width: 20px;
        height: 20px;
        color: #667eea;
    }
    
    .info-label {
        font-weight: 600;
        color: #555;
    }
    
    .info-value {
        color: #2c3e50;
    }
    
    .order-status {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-gio-hang {
        background: #ecf0f1;
        color: #7f8c8d;
    }
    
    .status-chuan-bi-don-hang {
        background: #fef9e7;
        color: #f39c12;
    }
    
    .status-dang-giao-hang {
        background: #ebf3fd;
        color: #3498db;
    }
    
    .status-da-giao {
        background: #eafaf1;
        color: #27ae60;
    }
    
    .order-total {
        font-size: 24px;
        font-weight: 700;
        color: #e74c3c;
        text-align: center;
        margin: 15px 0;
    }
    
    .order-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    
    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
    }
    
    .empty-orders {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    .empty-orders h3 {
        color: #7f8c8d;
        margin-bottom: 15px;
        font-size: 24px;
    }
    
    .empty-orders p {
        color: #bdc3c7;
        margin-bottom: 30px;
    }
    
    .btn-shop {
        background: linear-gradient(135deg, #27ae60, #229954);
        color: white;
        padding: 15px 30px;
        font-size: 16px;
    }
    
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 4px solid;
    }
    
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border-left-color: #e74c3c;
    }
    
    @media (max-width: 768px) {
        .order-info {
            grid-template-columns: 1fr;
        }
        
        .order-header {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }
        
        .order-actions {
            flex-direction: column;
        }
    }
</style>

<div class="user-orders-container">
    <!-- Thông báo lỗi -->
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i> <?= $_SESSION['error'] ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Header -->
    <div class="orders-header">
        <h2><i class="fas fa-shopping-bag"></i> Đơn hàng của tôi</h2>
        <p>Theo dõi trạng thái các đơn hàng bạn đã đặt</p>
    </div>

    <!-- Danh sách đơn hàng -->
    <?php if (!empty($user_orders)): ?>
        <div class="orders-grid">
            <?php foreach($user_orders as $order): ?>
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">Đơn hàng #<?= $order['mahd'] ?></div>
                        <div class="order-date"><?= date('d/m/Y H:i', strtotime($order['ngaydathang'])) ?></div>
                    </div>
                    
                    <div class="order-body">
                        <div class="order-info">
                            <div class="info-item">
                                <i class="fas fa-calendar info-icon"></i>
                                <span class="info-label">Ngày đặt:</span>
                                <span class="info-value"><?= date('d/m/Y', strtotime($order['ngaydathang'])) ?></span>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-info-circle info-icon"></i>
                                <span class="info-label">Trạng thái:</span>
                                <span class="order-status status-<?= $order['trangthai'] ?>">
                                    <?php
                                    switch($order['trangthai']) {
                                        case 'gio-hang': echo 'Giỏ hàng'; break;
                                        case 'chuan-bi-don-hang': echo 'Chuẩn bị'; break;
                                        case 'dang-giao-hang': echo 'Đang giao'; break;
                                        case 'da-giao': echo 'Hoàn thành'; break;
                                        default: echo $order['trangthai'];
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="order-total">
                            <?= number_format(isset($order['calculated_total']) ? $order['calculated_total'] : $order['tongtien']) ?>đ
                        </div>
                        
                        <div class="order-actions">
                            <a href="?mod=user&act=order_detail&id=<?= $order['mahd'] ?>" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-orders">
            <h3><i class="fas fa-shopping-cart"></i> Chưa có đơn hàng nào</h3>
            <p>Bạn chưa đặt đơn hàng nào. Hãy khám phá các sản phẩm tuyệt vời của chúng tôi!</p>
            <a href="?mod=page&act=sanpham" class="btn btn-shop">
                <i class="fas fa-shopping-bag"></i> Mua sắm ngay
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
// Tự động ẩn thông báo sau 5 giây
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        alert.style.opacity = '0';
        setTimeout(function() {
            alert.remove();
        }, 300);
    });
}, 5000);
</script>
