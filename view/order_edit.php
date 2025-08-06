<style>
    .order-edit-container {
        padding: 20px;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .edit-header {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }
    
    .edit-header h2 {
        color: #2c3e50;
        margin: 0;
        font-size: 28px;
        font-weight: 600;
    }
    
    .edit-form {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        max-width: 800px;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
        font-size: 14px;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        text-align: center;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3498db, #2980b9);
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
    
    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #e9ecef;
    }
    
    .info-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #3498db;
        margin-bottom: 25px;
    }
    
    .info-box h4 {
        margin: 0 0 10px 0;
        color: #2c3e50;
        font-size: 16px;
    }
    
    .info-box p {
        margin: 0;
        color: #7f8c8d;
        font-size: 14px;
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
    
    .customer-info {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
    }
    
    .customer-info h4 {
        margin: 0 0 15px 0;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .customer-detail {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }
    
    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .detail-label {
        font-weight: 600;
        color: #555;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .detail-value {
        color: #2c3e50;
        font-size: 14px;
    }
    
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .customer-detail {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="order-edit-container">
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

    <!-- Header -->
    <div class="edit-header">
        <h2><i class="fas fa-edit"></i> Chỉnh sửa Đơn hàng #<?= $order['mahd'] ?></h2>
    </div>

    <!-- Thông tin khách hàng -->
    <div class="customer-info">
        <h4><i class="fas fa-user"></i> Thông tin khách hàng</h4>
        <div class="customer-detail">
            <div class="detail-item">
                <span class="detail-label">Họ tên</span>
                <span class="detail-value"><?= htmlspecialchars($order['hoten']) ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Email</span>
                <span class="detail-value"><?= htmlspecialchars($order['email']) ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Số điện thoại</span>
                <span class="detail-value"><?= htmlspecialchars($order['sdt']) ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Địa chỉ</span>
                <span class="detail-value"><?= $order['diachi'] ? htmlspecialchars($order['diachi']) : 'Chưa có địa chỉ' ?></span>
            </div>
        </div>
    </div>

    <!-- Form chỉnh sửa -->
    <div class="edit-form">
        <div class="info-box">
            <h4><i class="fas fa-info-circle"></i> Lưu ý</h4>
            <p>Bạn có thể chỉnh sửa tổng tiền và ghi chú của đơn hàng. Để thay đổi sản phẩm, vui lòng truy cập trang chi tiết đơn hàng.</p>
        </div>

        <form method="POST" action="admin.php?mod=order&act=edit&id=<?= $order['mahd'] ?>">
            <div class="form-row">
                <div class="form-group">
                    <label for="mahd">Mã đơn hàng</label>
                    <input type="text" id="mahd" value="#<?= $order['mahd'] ?>" class="form-control" readonly>
                </div>
                
                <div class="form-group">
                    <label for="ngaydathang">Ngày đặt hàng</label>
                    <input type="text" id="ngaydathang" value="<?= date('d/m/Y H:i', strtotime($order['ngaydathang'])) ?>" class="form-control" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tongtien">Tổng tiền (nghìn đồng) <span style="color: red;">*</span></label>
                    <input type="number" 
                           id="tongtien" 
                           name="tongtien" 
                           value="<?= $order['tongtien'] ?>" 
                           class="form-control" 
                           required
                           min="0"
                           step="1">
                    <small style="color: #7f8c8d; font-size: 12px;">
                        Hiển thị: <?= number_format($order['tongtien'] * 1000) ?>đ
                    </small>
                </div>
                
                <div class="form-group">
                    <label for="trangthai">Trạng thái hiện tại</label>
                    <input type="text" 
                           id="trangthai" 
                           value="<?php
                               switch($order['trangthai']) {
                                   case 'gio-hang': echo 'Giỏ hàng'; break;
                                   case 'chuan-bi-don-hang': echo 'Chuẩn bị đơn hàng'; break;
                                   case 'dang-giao-hang': echo 'Đang giao hàng'; break;
                                   case 'da-giao': echo 'Đã giao'; break;
                                   default: echo $order['trangthai'];
                               }
                           ?>" 
                           class="form-control" 
                           readonly>
                    <small style="color: #7f8c8d; font-size: 12px;">
                        Để thay đổi trạng thái, vui lòng sử dụng trang chi tiết đơn hàng
                    </small>
                </div>
            </div>

            <div class="form-group">
                <label for="ghichu">Ghi chú đơn hàng</label>
                <textarea id="ghichu" 
                          name="ghichu" 
                          class="form-control" 
                          placeholder="Nhập ghi chú cho đơn hàng..."><?= htmlspecialchars($order['ghichu']) ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Lưu thay đổi
                </button>
                
                <a href="admin.php?mod=order&act=detail&id=<?= $order['mahd'] ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại chi tiết
                </a>
            </div>
        </form>
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

// Cập nhật hiển thị tiền khi thay đổi
document.getElementById('tongtien').addEventListener('input', function() {
    const value = parseInt(this.value) || 0;
    const formatted = new Intl.NumberFormat('vi-VN').format(value * 1000);
    const small = this.parentNode.querySelector('small');
    small.textContent = `Hiển thị: ${formatted}đ`;
});
</script>
