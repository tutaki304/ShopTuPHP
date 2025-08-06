<?php
// Kiểm tra có thông tin đơn hàng trong session không
if (!isset($_SESSION['order_info'])) {
    header('Location: ?mod=page&act=home');
    exit();
}

$order_info = $_SESSION['order_info'];
?>

<div class="success-container">
    <div class="success-content">
        <!-- Header thành công -->
        <div class="success-header">
            <div class="check-animation">
                <svg class="check-mark" viewBox="0 0 100 100">
                    <circle class="check-circle" cx="50" cy="50" r="45"/>
                    <path class="check-path" d="M25,50 L40,65 L75,30"/>
                </svg>
            </div>
            <h1 class="success-title">Đặt hàng thành công!</h1>
            <p class="success-subtitle">Cảm ơn bạn đã tin tưởng và mua sắm tại Fashion Store</p>
        </div>

        <!-- Thông tin đơn hàng -->
        <div class="order-summary">
            <div class="order-header">
                <h2><i class="fas fa-receipt"></i> Chi tiết đơn hàng</h2>
            </div>
            
            <div class="order-info-grid">
                <div class="info-item">
                    <div class="info-label">Mã đơn hàng</div>
                    <div class="info-value order-id">#<?php echo $order_info['mahd']; ?></div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Ngày đặt hàng</div>
                    <div class="info-value"><?php echo date('d/m/Y - H:i', strtotime($order_info['ngaydathang'])); ?></div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Tổng thanh toán</div>
                    <div class="info-value price"><?php echo number_format($order_info['tongtien']); ?>đ</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Trạng thái</div>
                    <div class="info-value">
                        <span class="status-badge preparing">
                            <i class="fas fa-clock"></i> Đang chuẩn bị
                        </span>
                    </div>
                </div>
            </div>
            
            <?php if (!empty($order_info['ghichu'])): ?>
            <div class="order-note">
                <div class="note-label"><i class="fas fa-sticky-note"></i> Ghi chú đơn hàng:</div>
                <div class="note-content"><?php echo htmlspecialchars($order_info['ghichu']); ?></div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Thông tin quan trọng -->
        <div class="important-info">
            <div class="info-header">
                <i class="fas fa-info-circle"></i>
                <span>Thông tin quan trọng</span>
            </div>
            <div class="info-list">
                <div class="info-point">
                    <i class="fas fa-clock text-primary"></i>
                    <span>Đơn hàng sẽ được xử lý trong vòng <strong>24 giờ</strong></span>
                </div>
                <div class="info-point">
                    <i class="fas fa-envelope text-success"></i>
                    <span>Bạn sẽ nhận được email xác nhận khi đơn hàng được giao</span>
                </div>
                <div class="info-point">
                    <i class="fas fa-shipping-fast text-warning"></i>
                    <span>Thời gian giao hàng dự kiến: <strong>3-5 ngày làm việc</strong></span>
                </div>
                <div class="info-point">
                    <i class="fas fa-phone text-info"></i>
                    <span>Hotline hỗ trợ: <strong>1900-1234</strong> (8:00 - 22:00)</span>
                </div>
            </div>
        </div>

        <!-- Action buttons -->
        <div class="action-buttons">
            <button onclick="continueShopping()" class="btn btn-continue">
                <i class="fas fa-shopping-bag"></i>
                <span>Tiếp tục mua sắm</span>
            </button>
            
            <a href="?mod=page&act=home" class="btn btn-home">
                <i class="fas fa-home"></i>
                <span>Về trang chủ</span>
            </a>
        </div>

        <!-- Countdown timer -->
        <div class="auto-redirect">
            <p>Tự động chuyển về trang chủ sau <span id="countdown">30</span> giây</p>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>
    </div>
</div>

<script>
function continueShopping() {
    // Xóa thông tin đơn hàng khỏi session
    fetch('?mod=product&act=clear_order_session', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(() => {
        // Chuyển về trang sản phẩm
        window.location.href = '?mod=product&act=sanpham';
    });
}

// Countdown timer
let countdown = 30;
const countdownElement = document.getElementById('countdown');
const progressFill = document.querySelector('.progress-fill');

const timer = setInterval(() => {
    countdown--;
    countdownElement.textContent = countdown;
    
    // Update progress bar
    const progress = ((30 - countdown) / 30) * 100;
    progressFill.style.width = progress + '%';
    
    if (countdown <= 0) {
        clearInterval(timer);
        // Xóa session và chuyển về trang chủ
        fetch('?mod=product&act=clear_order_session', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(() => {
            window.location.href = '?mod=page&act=home';
        });
    }
}, 1000);
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.success-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #66cbeaff 0%, #4b98a2ff 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.success-content {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    width: 100%;
    overflow: hidden;
    animation: slideUp 0.8s ease-out;
}

/* Header thành công */
.success-header {
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
    text-align: center;
    padding: 40px 20px;
    position: relative;
    overflow: hidden;
}

.success-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="70" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="70" cy="30" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
    animation: float 20s linear infinite;
}

.check-animation {
    margin-bottom: 20px;
}

.check-mark {
    width: 80px;
    height: 80px;
    display: block;
    margin: 0 auto;
}

.check-circle {
    fill: none;
    stroke: white;
    stroke-width: 3;
    stroke-dasharray: 283;
    stroke-dashoffset: 283;
    animation: circle-animation 1s ease-in-out forwards;
}

.check-path {
    fill: none;
    stroke: white;
    stroke-width: 4;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-dasharray: 60;
    stroke-dashoffset: 60;
    animation: check-animation 0.6s ease-in-out 0.6s forwards;
}

.success-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.success-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    font-weight: 300;
}

/* Thông tin đơn hàng */
.order-summary {
    padding: 30px;
}

.order-header {
    text-align: center;
    margin-bottom: 25px;
}

.order-header h2 {
    color: #333;
    font-size: 1.5rem;
    font-weight: 600;
}

.order-header i {
    color: #4CAF50;
    margin-right: 8px;
}

.order-info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 25px;
}

.info-item {
    background: #f8f9fc;
    padding: 20px;
    border-radius: 12px;
    border-left: 4px solid #4CAF50;
    transition: transform 0.2s ease;
}

.info-item:hover {
    transform: translateY(-2px);
}

.info-label {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 8px;
    font-weight: 500;
}

.info-value {
    font-size: 1.1rem;
    color: #333;
    font-weight: 600;
}

.info-value.order-id {
    color: #4CAF50;
    font-family: 'Courier New', monospace;
}

.info-value.price {
    color: #e91e63;
    font-size: 1.3rem;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.status-badge.preparing {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.order-note {
    background: #e3f2fd;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #2196F3;
}

.note-label {
    font-weight: 600;
    color: #1976D2;
    margin-bottom: 8px;
}

.note-content {
    color: #333;
    line-height: 1.5;
}

/* Thông tin quan trọng */
.important-info {
    background: #f8f9fc;
    margin: 0 30px 30px;
    border-radius: 12px;
    overflow: hidden;
}

.info-header {
    background: #4CAF50;
    color: white;
    padding: 15px 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.info-list {
    padding: 20px;
}

.info-point {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 15px;
}

.info-point:last-child {
    margin-bottom: 0;
}

.info-point i {
    margin-top: 2px;
    font-size: 1rem;
}

.info-point span {
    line-height: 1.5;
    color: #333;
}

/* Action buttons */
.action-buttons {
    display: flex;
    gap: 15px;
    padding: 0 30px 30px;
}

.btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 15px 20px;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-continue {
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
}

.btn-continue:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(76, 175, 80, 0.3);
}

.btn-home {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    color: white;
}

.btn-home:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(108, 117, 125, 0.3);
    text-decoration: none;
    color: white;
}

/* Auto redirect */
.auto-redirect {
    background: #f8f9fc;
    padding: 20px 30px;
    text-align: center;
    border-top: 1px solid #e9ecef;
}

.auto-redirect p {
    color: #666;
    margin-bottom: 10px;
}

#countdown {
    color: #4CAF50;
    font-weight: 600;
}

.progress-bar {
    width: 100%;
    height: 4px;
    background: #e9ecef;
    border-radius: 2px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #4CAF50, #45a049);
    width: 0%;
    transition: width 1s linear;
}

/* Animations */
@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes circle-animation {
    to {
        stroke-dashoffset: 0;
    }
}

@keyframes check-animation {
    to {
        stroke-dashoffset: 0;
    }
}

@keyframes float {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}

/* Responsive */
@media (max-width: 768px) {
    .success-container {
        padding: 10px;
    }
    
    .success-title {
        font-size: 2rem;
    }
    
    .order-info-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .info-item {
        padding: 15px;
    }
}

/* Text colors */
.text-primary { color: #007bff !important; }
.text-success { color: #28a745 !important; }
.text-warning { color: #ffc107 !important; }
.text-info { color: #17a2b8 !important; }
</style>
