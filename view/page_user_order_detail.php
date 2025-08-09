<style>
    .user-order-detail-container {
        padding: 20px 0;
        max-width: 1200px;
        margin: 0 auto;
        margin-top: 40px; /* Tăng margin để nút Quay lại không bị header che */
    }
    
    .order-header {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 30px;
    }
    
    .order-header h2 {
        color: #2c3e50;
        margin: 0 0 15px 0;
        font-size: 28px;
        font-weight: 600;
    }
    
    .order-meta {
        color: #7f8c8d;
        font-size: 14px;
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .order-content {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }
    
    .order-items {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    .items-header {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        padding: 20px;
        border-radius: 12px 12px 0 0;
    }
    
    .items-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }
    
    .items-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .items-table th,
    .items-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e9ecef;
    }
    
    .items-table thead {
        background: #f8f9fa;
    }
    
    .items-table th {
        font-weight: 600;
        color: #555;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .items-table tbody tr:hover {
        background-color: #f8f9ff;
    }
    
    .product-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e9ecef;
    }
    
    .product-name {
        font-weight: 600;
        color: #2c3e50;
    }
    
    .total-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 0 0 12px 12px;
        border-top: 2px solid #e9ecef;
    }
    
    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
    }
    
    .order-info {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        height: fit-content;
    }
    
    .section-title {
        color: #2c3e50;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f1f2f6;
    }
    
    .info-row:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #555;
    }
    
    .info-value {
        color: #2c3e50;
        text-align: right;
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
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
    
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin: 20px 0;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
        position: relative;
        z-index: 999;
        margin-top: 20px; /* Đảm bảo không bị header che */
    }
    
    .alert-error {
        background: #fee;
        border-left: 4px solid #dc3545;
        color: #721c24;
    }
    
    .alert-success {
        background: #d4edda;
        border-left: 4px solid #28a745;
        color: #155724;
    }
    
    .alert i {
        font-size: 16px;
    }
    
    .back-button {
        background: linear-gradient(135deg, #95a5a6, #7f8c8d);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        margin: 20px 0; /* Thêm margin-top để tránh bị header che */
    }
    
    .back-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
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
        .order-content {
            grid-template-columns: 1fr;
        }
        
        .order-meta {
            flex-direction: column;
            gap: 10px;
        }
        
        .product-info {
            flex-direction: column;
            text-align: center;
        }
        
        .items-table {
            font-size: 12px;
        }
        
        .items-table th,
        .items-table td {
            padding: 8px 6px;
        }
    }
</style>

<div class="user-order-detail-container">
    <!-- Thông báo lỗi -->
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i> <?= $_SESSION['error'] ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?= $_SESSION['success'] ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Nút quay lại -->
    <a href="?mod=user&act=orders" class="back-button">
        <i class="fas fa-arrow-left"></i> Quay lại danh sách đơn hàng
    </a>

    <!-- Header đơn hàng -->
    <div class="order-header">
        <h2><i class="fas fa-receipt"></i> Chi tiết đơn hàng #<?= $order['mahd'] ?></h2>
        <div class="order-meta">
            <span><i class="fas fa-calendar"></i> Ngày đặt: <?= date('d/m/Y H:i', strtotime($order['ngaydathang'])) ?></span>
            <?php if(isset($order['ngaycapnhat']) && $order['ngaycapnhat']): ?>
                <span><i class="fas fa-clock"></i> Cập nhật: <?= date('d/m/Y H:i', strtotime($order['ngaycapnhat'])) ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="order-content">
        <!-- Chi tiết sản phẩm -->
        <div class="order-items">
            <div class="items-header">
                <h3><i class="fas fa-shopping-bag"></i> Sản phẩm đã đặt</h3>
            </div>
            
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach($order_details as $item): 
                        $effective_price = $item['effective_price'] ?? 0;
                        $subtotal = $effective_price * $item['soluong'];
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="upload/product/<?= $item['anh'] ?>" alt="<?= htmlspecialchars($item['tensp']) ?>" class="product-image">
                                <div class="product-name"><?= htmlspecialchars($item['tensp']) ?></div>
                            </div>
                        </td>
                        <td><?= number_format($effective_price * 1000) ?>đ</td>
                        <td><?= $item['soluong'] ?></td>
                        <td><strong><?= number_format($subtotal * 1000) ?>đ</strong></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="total-section">
                <div class="total-row">
                    <span>Tổng cộng:</span>
                    <span><?= number_format($total * 1000) ?>đ</span>
                </div>
            </div>
        </div>

        <!-- Thông tin đơn hàng -->
        <div class="order-info">
            <h3 class="section-title">
                <i class="fas fa-info-circle"></i>
                Thông tin đơn hàng
            </h3>
            
            <div class="info-row">
                <span class="info-label">Mã đơn hàng:</span>
                <span class="info-value">#<?= $order['mahd'] ?></span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Trạng thái:</span>
                <span class="info-value">
                    <span class="status-badge status-<?= $order['trangthai'] ?>">
                        <?php
                        switch($order['trangthai']) {
                            case 'gio-hang': echo 'Giỏ hàng'; break;
                            case 'chuan-bi-don-hang': echo 'Chuẩn bị đơn hàng'; break;
                            case 'dang-giao-hang': echo 'Đang giao hàng'; break;
                            case 'da-giao': echo 'Đã giao'; break;
                            default: echo $order['trangthai'];
                        }
                        ?>
                    </span>
                </span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Tổng tiền:</span>
                <span class="info-value"><strong><?= number_format($order['tongtien']) ?>đ</strong></span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Địa chỉ giao hàng:</span>
                <span class="info-value">
                    <?php 
                    // Hiển thị địa chỉ giao hàng
                    if (isset($order['diachi_giaohang']) && !empty(trim($order['diachi_giaohang']))) {
                        echo htmlspecialchars($order['diachi_giaohang']);
                    } elseif (isset($_SESSION['user']['diachi']) && !empty(trim($_SESSION['user']['diachi']))) {
                        echo htmlspecialchars($_SESSION['user']['diachi']);
                    } else {
                        echo '<span style="color: #e74c3c; font-style: italic;">Chưa cung cấp địa chỉ giao hàng</span>';
                    }
                    ?>
                </span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Ghi chú:</span>
                <span class="info-value"><?= isset($order['ghichu']) && $order['ghichu'] ? htmlspecialchars($order['ghichu']) : 'Không có ghi chú' ?></span>
            </div>
        </div>
    </div>
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
