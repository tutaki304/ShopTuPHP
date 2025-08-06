<style>
    .order-detail-container {
        padding: 20px;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .order-header {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }
    
    .order-header h2 {
        color: #2c3e50;
        margin: 0 0 10px 0;
        font-size: 28px;
        font-weight: 600;
    }
    
    .order-meta {
        color: #7f8c8d;
        font-size: 14px;
    }
    
    .order-content {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
    }
    
    .order-info,
    .customer-info {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
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
    }
    
    .status-form {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
    }
    
    .status-form select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        margin-bottom: 15px;
    }
    
    .order-items {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }
    
    .items-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .items-table thead {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }
    
    .items-table th,
    .items-table td {
        padding: 15px 12px;
        text-align: left;
        border-bottom: 1px solid #e9ecef;
    }
    
    .items-table th {
        font-weight: 600;
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
    
    .btn-success {
        background: linear-gradient(135deg, #27ae60, #229954);
        color: white;
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #95a5a6, #7f8c8d);
        color: white;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .order-actions {
        display: flex;
        gap: 15px;
        margin-top: 25px;
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
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
    
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 4px solid;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border-left-color: #27ae60;
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
        
        .order-actions {
            flex-direction: column;
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

<div class="order-detail-container">
    <!-- Thông báo -->
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?= $_SESSION['success'] ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i> <?= $_SESSION['error'] ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Header đơn hàng -->
    <div class="order-header">
        <h2>Chi tiết Đơn hàng #<?= $order['mahd'] ?></h2>
        <div class="order-meta">
            Ngày đặt: <?= date('d/m/Y H:i', strtotime($order['ngaydathang'])) ?> | 
            Cập nhật lần cuối: <?= isset($order['ngaycapnhat']) ? date('d/m/Y H:i', strtotime($order['ngaycapnhat'])) : 'Chưa có' ?>
        </div>
    </div>

    <!-- Chi tiết sản phẩm -->
    <div class="order-items">
        <div style="padding: 25px 25px 0 25px;">
            <h3 class="section-title">
                <i class="fas fa-shopping-bag"></i>
                Sản phẩm đã đặt
            </h3>
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

    <!-- Thông tin chi tiết -->
    <div class="order-content">
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
                <span class="info-value"><strong><?= number_format($order['tongtien'] * 1000) ?>đ</strong></span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Ghi chú:</span>
                <span class="info-value"><?= $order['ghichu'] ? htmlspecialchars($order['ghichu']) : 'Không có ghi chú' ?></span>
            </div>
            
            <!-- Form cập nhật trạng thái -->
            <div class="status-form">
                <h4><i class="fas fa-edit"></i> Cập nhật trạng thái</h4>
                <form method="POST" action="admin.php?mod=order&act=update_status">
                    <input type="hidden" name="mahd" value="<?= $order['mahd'] ?>">
                    <input type="hidden" name="redirect" value="1">
                    
                    <select name="trangthai" required>
                        <option value="">Chọn trạng thái</option>
                        <option value="gio-hang" <?= $order['trangthai'] == 'gio-hang' ? 'selected' : '' ?>>Giỏ hàng</option>
                        <option value="chuan-bi-don-hang" <?= $order['trangthai'] == 'chuan-bi-don-hang' ? 'selected' : '' ?>>Chuẩn bị đơn hàng</option>
                        <option value="dang-giao-hang" <?= $order['trangthai'] == 'dang-giao-hang' ? 'selected' : '' ?>>Đang giao hàng</option>
                        <option value="da-giao" <?= $order['trangthai'] == 'da-giao' ? 'selected' : '' ?>>Đã giao</option>
                    </select>
                    
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Cập nhật trạng thái
                    </button>
                </form>
            </div>
        </div>

        <div class="customer-info">
            <h3 class="section-title">
                <i class="fas fa-user"></i>
                Thông tin khách hàng
            </h3>
            
            <div class="info-row">
                <span class="info-label">Họ tên:</span>
                <span class="info-value"><?= htmlspecialchars($order['hoten']) ?></span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value"><?= htmlspecialchars($order['email']) ?></span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Số điện thoại:</span>
                <span class="info-value"><?= htmlspecialchars($order['sdt']) ?></span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Địa chỉ:</span>
                <span class="info-value"><?= $order['diachi'] ? htmlspecialchars($order['diachi']) : 'Chưa có địa chỉ' ?></span>
            </div>
        </div>
    </div>

    <!-- Các nút hành động -->
    <div class="order-actions">
        <a href="admin.php?mod=order&act=list" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
        
        <a href="admin.php?mod=order&act=edit&id=<?= $order['mahd'] ?>" class="btn btn-primary">
            <i class="fas fa-edit"></i> Chỉnh sửa đơn hàng
        </a>
        
        <a href="admin.php?mod=order&act=delete&id=<?= $order['mahd'] ?>" 
           class="btn btn-danger"
           onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này? Hành động này không thể hoàn tác!')">
            <i class="fas fa-trash"></i> Xóa đơn hàng
        </a>
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
