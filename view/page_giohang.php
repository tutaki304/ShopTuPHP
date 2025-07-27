<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng - ShopTu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f5f5;
        color: #333;
        line-height: 1.6;
    }

    .cart-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background: white;
        min-height: 100vh;
    }

    .breadcrumb {
        margin-bottom: 20px;
        color: #666;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .breadcrumb a {
        color: #3498db;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb a:hover {
        color: #2980b9;
    }

    .cart-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #333;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .checkout-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-top: 20px;
    }

    /* Alert Success */
    .alert-success {
        background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Chi tiết đơn hàng */
    .order-details {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        height: fit-content;
    }

    .order-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 25px;
        color: #333;
        text-align: center;
        padding-bottom: 10px;
        border-bottom: 2px solid #3498db;
    }

    .product-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
        position: relative;
    }

    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 15px;
        border: 2px solid #f0f0f0;
    }

    .product-info {
        flex: 1;
    }

    .product-name {
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
        line-height: 1.4;
    }

    .product-details {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .product-quantity {
        color: #666;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 5px;
    }

    .quantity-btn {
        width: 30px;
        height: 30px;
        border: 1px solid #ddd;
        background: #f8f9fa;
        border-radius: 4px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .quantity-btn:hover {
        background: #3498db;
        color: white;
        border-color: #3498db;
    }

    .quantity-input {
        width: 50px;
        height: 30px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-weight: 600;
    }

    .product-price {
        margin-top: 8px;
    }

    .original-price {
        text-decoration: line-through;
        color: #999;
        margin-right: 10px;
        font-size: 14px;
    }

    .sale-price {
        color: #e74c3c;
        font-weight: bold;
        font-size: 16px;
    }

    .savings {
        color: #27ae60;
        font-size: 12px;
        font-weight: 500;
        margin-left: 5px;
    }

    .remove-item {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #e74c3c;
        color: white;
        border: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .remove-item:hover {
        background: #c0392b;
        transform: scale(1.1);
    }

    .shipping-fee {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .shipping-text {
        color: #666;
    }

    .shipping-amount {
        color: #e74c3c;
        font-weight: 600;
    }

    .free-shipping {
        font-size: 12px;
        color: #27ae60;
        margin-top: 2px;
        font-style: italic;
    }

    .total-section {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #eee;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        font-size: 20px;
        font-weight: bold;
        color: #e74c3c;
        margin-bottom: 15px;
    }

    .vip-button {
        background: linear-gradient(45deg, #3498db, #2980b9);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        margin-top: 15px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
    }

    .vip-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(52, 152, 219, 0.3);
    }

    /* Thông tin khách hàng */
    .customer-info {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 25px;
        color: #333;
        text-align: center;
        padding-bottom: 10px;
        border-bottom: 2px solid #3498db;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e1e8ed;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #fafbfc;
    }

    .form-input:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        background: white;
        transform: scale(1.02);
    }

    .form-select {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e1e8ed;
        border-radius: 6px;
        font-size: 14px;
        background: #fafbfc;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        background: white;
    }

    .delivery-options {
        margin: 20px 0;
    }

    .radio-group {
        margin: 15px 0;
    }

    .radio-item {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        padding: 12px 16px;
        border: 2px solid #e1e8ed;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafbfc;
        position: relative;
    }

    .radio-item:hover {
        background: #f0f8ff;
        border-color: #3498db;
        transform: translateX(3px);
    }

    .radio-item input[type="radio"] {
        margin-right: 12px;
        width: 18px;
        height: 18px;
        accent-color: #3498db;
        cursor: pointer;
    }

    /* Custom radio button styling */
    .radio-item input[type="radio"]:checked {
        background-color: #3498db;
        border-color: #3498db;
    }

    .radio-item.selected {
        background: #e3f2fd;
        border-color: #3498db;
        box-shadow: 0 2px 8px rgba(52, 152, 219, 0.2);
    }

    .radio-item.selected::before {
        content: '';
        position: absolute;
        left: -2px;
        top: -2px;
        bottom: -2px;
        width: 4px;
        background: linear-gradient(45deg, #3498db, #2980b9);
        border-radius: 0 8px 8px 0;
    }

    .payment-methods {
        margin-top: 25px;
    }

    .payment-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }

    .cod-icon {
        background: linear-gradient(45deg, #3498db, #2980b9);
        color: white;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: bold;
        margin-right: 10px;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 4px rgba(52, 152, 219, 0.3);
    }

    .momo-icon {
        background: linear-gradient(45deg, #d91a72, #b8185e);
        color: white;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: bold;
        margin-right: 10px;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 4px rgba(217, 26, 114, 0.3);
    }

    .checkbox-group {
        margin: 25px 0;
    }

    .checkbox-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
        padding: 12px 16px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e1e8ed;
        transition: all 0.3s ease;
    }

    .checkbox-item:hover {
        background: #f0f8ff;
        border-color: #3498db;
    }

    .checkbox-item input[type="checkbox"] {
        margin-right: 12px;
        margin-top: 2px;
        width: 18px;
        height: 18px;
        accent-color: #3498db;
        cursor: pointer;
    }

    /* Custom checkbox styling */
    .checkbox-item input[type="checkbox"]:checked {
        background-color: #3498db;
        border-color: #3498db;
    }

    .checkbox-text {
        font-size: 14px;
        color: #555;
        line-height: 1.5;
        cursor: pointer;
        user-select: none;
    }

    .order-button {
        width: 100%;
        background: linear-gradient(45deg, #2ecc71, #27ae60);
        color: white;
        border: none;
        padding: 18px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 20px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .order-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
    }

    .order-button:disabled {
        background: #95a5a6;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .note-text {
        font-size: 12px;
        color: #666;
        font-style: italic;
        margin-top: 10px;
        line-height: 1.4;
        text-align: center;
    }

    .empty-cart {
        text-align: center;
        padding: 60px 20px;
        color: #666;
        grid-column: 1 / -1;
    }

    .empty-cart i {
        font-size: 4rem;
        margin-bottom: 20px;
        color: #bdc3c7;
    }

    .continue-shopping {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 30px;
        background: #3498db;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.3s ease;
        font-weight: 600;
    }

    .continue-shopping:hover {
        background-color: #2980b9;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .checkout-container {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .cart-container {
            padding: 10px;
        }

        .order-details,
        .customer-info {
            padding: 15px;
        }

        .product-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .product-image {
            margin-bottom: 10px;
        }
    }
</style>

<main>
    <div class="cart-container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb">
            <span>🏠</span> / <a href="?mod=page&act=home">Trang chủ</a> / <span>Thông tin giỏ hàng của bạn</span>
        </nav>

        <h1 class="cart-title">🛒 Giỏ Hàng Của Bạn</h1>

        <!-- Success Message -->
        <?php if(isset($_SESSION['thongbao'])): ?>
            <div class="alert-success">
                <i class="fas fa-check-circle"></i>
                <span><?=$_SESSION['thongbao']?></span>
            </div>
            <?php unset($_SESSION['thongbao']); ?>
        <?php endif; ?>

        <?php if(!empty($ctgiohang)): ?>
        <form action="?mod=product&act=updateCart" method="post" id="checkout-form">
            <input type="hidden" name="tongtien" id="tongtien">
            <input type="hidden" name="phivanchuyen" id="phivanchuyen" value="19000">
            
            <div class="checkout-container">
                <!-- Chi tiết đơn hàng -->
                <div class="order-details">
                    <h2 class="order-title">CHI TIẾT ĐƠN HÀNG</h2>
                    
                    <?php foreach($ctgiohang as $index => $item): ?>
                    <div class="product-item" data-product-id="<?=$item['masp']?>">
                        <button type="button" class="remove-item" onclick="removeItem(<?=$item['masp']?>)" title="Xóa sản phẩm">
                            ✕
                        </button>
                        
                        <img src="upload/product/<?=$item['anh']?>" alt="<?=$item['tensp']?>" class="product-image">
                        
                        <div class="product-info">
                            <div class="product-name"><?=$item['tensp']?></div>
                            <div class="product-details">
                                <div class="product-quantity">
                                    Số lượng: 
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn" onclick="changeQuantity(<?=$item['masp']?>, -1)">-</button>
                                        <input type="number" 
                                               class="quantity-input" 
                                               min="1" 
                                               max="99" 
                                               value="<?=isset($item['soluong']) ? (int)$item['soluong'] : 1?>"
                                               data-price="<?=(float)$item['khuyenmai']?>"
                                               onchange="updateQuantity(this, <?=$item['masp']?>)"
                                               readonly>
                                        <button type="button" class="quantity-btn" onclick="changeQuantity(<?=$item['masp']?>, 1)">+</button>
                                    </div>
                                </div>
                                
                                <div class="product-price">
                                    <span class="original-price"><?=number_format($item['dongia'])?>đ</span>
                                    <span class="sale-price"><?=number_format($item['khuyenmai'])?>đ</span>
                                    <span class="savings">(Tiết kiệm: <?=number_format($item['dongia'] - $item['khuyenmai'])?>đ)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <div class="shipping-fee">
                        <div>
                            <div class="shipping-text">Phí giao hàng</div>
                            <div class="free-shipping">(Miễn phí với đơn hàng trên 300,000đ)</div>
                        </div>
                        <div class="shipping-amount" id="shipping-display">19,000đ</div>
                    </div>

                    <div class="total-section">
                        <div class="total-row">
                            <span>Tổng thanh toán:</span>
                            <span id="grand-total">0đ</span>
                        </div>
                    </div>

                    <button type="button" class="vip-button" onclick="showVipDiscount()">
                        ĐĂNG NHẬP/TẠO THẺ VIP
                    </button>
                    <div class="note-text">để được giảm giá hoặc Miễn phí giao hàng</div>
                </div>

                <!-- Thông tin người nhận -->
                <div class="customer-info">
                    <h2 class="section-title">NGƯỜI NHẬN HÀNG</h2>
                    
                    <div class="form-group">
                        <label class="form-label">Tên người nhận *</label>
                        <input type="text" name="ten_nguoi_nhan" class="form-input" placeholder="Nhập tên người nhận" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Điện thoại liên lạc *</label>
                        <input type="tel" name="sdt" class="form-input" placeholder="Nhập số điện thoại" required>
                    </div>

                    <div class="delivery-options">
                        <div class="radio-group">
                            <div class="radio-item selected">
                                <input type="radio" name="delivery_type" value="home" checked>
                                <span>📦 Nhận hàng tại nhà/công ty/cửa hàng</span>
                            </div>
                        </div>
                    </div>

                    <div class="note-text">
                        * Hiện tại hệ thống vận chuyển sử dụng địa chỉ tỉnh thành, quận huyện. Vui lòng nhập chính xác để hệ thống có thể tự động tính phí vận chuyển.
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tỉnh/Thành phố *</label>
                        <select name="tinh" class="form-select" onchange="updateShippingFee()" required>
                            <option value="">- Chọn Tỉnh/Thành phố -</option>
                            <option value="hcm">TP. Hồ Chí Minh</option>
                            <option value="hn">Hà Nội</option>
                            <option value="dn">Đà Nẵng</option>
                            <option value="ct">Cần Thơ</option>
                            <option value="other">Tỉnh khác</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Quận/Huyện *</label>
                        <select name="quan" class="form-select" required>
                            <option value="">- Chọn Quận/Huyện -</option>
                            <option value="q1">Quận 1</option>
                            <option value="q3">Quận 3</option>
                            <option value="q7">Quận 7</option>
                            <option value="tb">Tân Bình</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Xã/Phường/Thị trấn *</label>
                        <select name="phuong" class="form-select" required>
                            <option value="">- Chọn Xã/Phường/Thị trấn -</option>
                            <option value="p1">Phường 1</option>
                            <option value="p2">Phường 2</option>
                            <option value="p3">Phường 3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Địa chỉ chi tiết *</label>
                        <input type="text" name="diachi_chitiet" class="form-input" placeholder="Số nhà, Tên đường" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ghi chú giao hàng</label>
                        <textarea name="ghichu" class="form-input" placeholder="Ghi chú cho đơn hàng (không bắt buộc)" rows="3"></textarea>
                    </div>

                    <div class="payment-methods">
                        <h3 class="payment-title">Phương thức thanh toán:</h3>
                        
                        <div class="radio-group">
                            <div class="radio-item selected">
                                <input type="radio" name="payment_method" value="cod" checked>
                                <span class="cod-icon">COD</span>
                                <span>Thanh toán khi nhận hàng (COD)</span>
                            </div>
                            
                            <div class="radio-item">
                                <input type="radio" name="payment_method" value="momo">
                                <span class="momo-icon">MoMo</span>
                                <span>Thanh toán bằng ví MoMo</span>
                            </div>
                        </div>
                    </div>

                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="terms" name="agree_terms" required>
                            <label for="terms" class="checkbox-text">Tôi đã đọc và đồng ý với điều kiện giao dịch chung của Website</label>
                        </div>
                    </div>

                    <button type="submit" class="order-button" id="order-btn">
                        ĐẶT HÀNG: GIAO HÀNG VÀ THU TIỀN TẬN NƠI
                    </button>
                </div>
            </div>
        </form>

        <?php else: ?>
        <!-- Empty Cart -->
        <div class="checkout-container">
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h3>Giỏ hàng của bạn đang trống</h3>
                <p>Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
                <a href="?mod=page&act=sanpham" class="continue-shopping">
                    <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</main>
<script>
    // Enhanced Shopping Cart System
    class AdvancedShoppingCart {
        constructor() {
            this.shippingFee = 19000;
            this.freeShippingThreshold = 300000;
            this.init();
        }

        init() {
            // Đợi DOM load hoàn toàn
            setTimeout(() => {
                this.calculateTotal();
                this.attachEventListeners();
                this.initializeSelects();
                console.log('Shopping cart initialized');
            }, 100);
        }

        attachEventListeners() {
            // Radio button handlers
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', (e) => {
                    this.handleRadioChange(e.target);
                });
            });

            // Form select handlers
            document.querySelectorAll('.form-select').forEach(select => {
                select.addEventListener('change', (e) => {
                    this.handleSelectChange(e.target);
                });
            });

            // Form submission
            const form = document.getElementById('checkout-form');
            if (form) {
                form.addEventListener('submit', (e) => {
                    if (!this.validateForm()) {
                        e.preventDefault();
                    }
                });
            }

            // Input animations
            document.querySelectorAll('.form-input').forEach(input => {
                input.addEventListener('focus', (e) => {
                    e.target.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', (e) => {
                    e.target.style.transform = 'scale(1)';
                });
            });
        }

        handleRadioChange(radio) {
            // Reset all radio items in the same group
            document.querySelectorAll(`input[name="${radio.name}"]`).forEach(r => {
                r.closest('.radio-item').classList.remove('selected');
            });
            // Add selected class to chosen item
            radio.closest('.radio-item').classList.add('selected');

            // Update payment method display
            if (radio.name === 'payment_method') {
                this.updatePaymentMethod(radio.value);
            }
        }

        handleSelectChange(select) {
            if (select.value) {
                select.style.color = '#333';
            } else {
                select.style.color = '#999';
            }

            // Update shipping fee based on location
            if (select.name === 'tinh') {
                this.updateShippingFee();
            }
        }

        initializeSelects() {
            document.querySelectorAll('.form-select').forEach(select => {
                if (!select.value) {
                    select.style.color = '#999';
                }
            });
        }

        changeQuantity(productId, change) {
            const productRow = document.querySelector(`[data-product-id="${productId}"]`);
            if (!productRow) {
                console.error('Product row not found for ID:', productId);
                return;
            }
            
            const quantityInput = productRow.querySelector('.quantity-input');
            if (!quantityInput) {
                console.error('Quantity input not found for product:', productId);
                return;
            }
            
            let currentQuantity = parseInt(quantityInput.value) || 1;
            let newQuantity = currentQuantity + change;

            if (newQuantity < 1) newQuantity = 1;
            if (newQuantity > 99) newQuantity = 99;

            quantityInput.value = newQuantity;
            console.log('Changed quantity for product', productId, 'from', currentQuantity, 'to', newQuantity);
            
            this.updateQuantity(quantityInput, productId);
        }

        updateQuantity(input, productId) {
            const row = input.closest('.product-item');
            const price = parseFloat(input.dataset.price) || 0;
            const quantity = parseInt(input.value) || 1;
            
            console.log('Update quantity:', {productId, price, quantity});
            
            if (quantity < 1) {
                input.value = 1;
                return;
            }
            
            if (quantity > 99) {
                input.value = 99;
                this.showNotification('Số lượng tối đa là 99', 'warning');
                return;
            }

            // Recalculate totals immediately
            this.calculateTotal();
            this.showNotification('Đã cập nhật số lượng', 'success');
        }

        removeItem(productId) {
            if (this.showConfirmDialog('Xác nhận xóa', 'Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                const row = document.querySelector(`[data-product-id="${productId}"]`);
                if (row) {
                    row.style.opacity = '0.5';
                    row.style.pointerEvents = 'none';
                }
                window.location.href = `?mod=product&act=removeFromCart&id=${productId}`;
            }
        }

        calculateTotal() {
            const productItems = document.querySelectorAll('.product-item');
            let subtotal = 0;

            console.log('Calculating total for', productItems.length, 'items');

            productItems.forEach(item => {
                const quantityInput = item.querySelector('.quantity-input');
                if (quantityInput) {
                    const price = parseFloat(quantityInput.dataset.price) || 0;
                    const quantity = parseInt(quantityInput.value) || 1;
                    const itemTotal = price * quantity;
                    
                    console.log(`Item: Price=${price}, Quantity=${quantity}, Total=${itemTotal}`);
                    subtotal += itemTotal;
                }
            });

            console.log('Subtotal:', subtotal);

            // Calculate shipping
            const shippingFee = subtotal >= this.freeShippingThreshold ? 0 : this.shippingFee;
            const total = subtotal + shippingFee;

            console.log('Final total:', total, 'Shipping:', shippingFee);

            // Update displays
            this.updateShippingDisplay(shippingFee);
            this.updateTotalDisplay(total);

            // Update hidden inputs
            document.getElementById('tongtien').value = total;
            document.getElementById('phivanchuyen').value = shippingFee;

            return total;
        }

        updateShippingDisplay(shippingFee) {
            const shippingDisplay = document.getElementById('shipping-display');
            if (shippingDisplay) {
                if (shippingFee === 0) {
                    shippingDisplay.innerHTML = '<span style="color: #27ae60; font-weight: bold;">Miễn phí</span>';
                } else {
                    shippingDisplay.textContent = this.formatCurrency(shippingFee);
                }
            }
        }

        updateTotalDisplay(total) {
            const totalDisplay = document.getElementById('grand-total');
            if (totalDisplay) {
                totalDisplay.textContent = this.formatCurrency(total);
            }
        }

        updateShippingFee() {
            const provinceSelect = document.querySelector('select[name="tinh"]');
            if (provinceSelect && provinceSelect.value) {
                // Different shipping fees for different provinces
                const shippingRates = {
                    'hcm': 15000,
                    'hn': 15000,
                    'dn': 18000,
                    'ct': 20000,
                    'other': 25000
                };
                
                this.shippingFee = shippingRates[provinceSelect.value] || 19000;
                this.calculateTotal();
                this.showNotification('Đã cập nhật phí vận chuyển', 'info');
            }
        }

        updatePaymentMethod(method) {
            const orderBtn = document.getElementById('order-btn');
            if (method === 'cod') {
                orderBtn.textContent = 'ĐẶT HÀNG: GIAO HÀNG VÀ THU TIỀN TẬN NƠI';
            } else if (method === 'momo') {
                orderBtn.textContent = 'ĐẶT HÀNG: THANH TOÁN BẰNG MOMO';
            }
        }

        validateForm() {
            const requiredFields = [
                { name: 'ten_nguoi_nhan', label: 'Tên người nhận' },
                { name: 'sdt', label: 'Số điện thoại' },
                { name: 'tinh', label: 'Tỉnh/Thành phố' },
                { name: 'quan', label: 'Quận/Huyện' },
                { name: 'phuong', label: 'Phường/Xã' },
                { name: 'diachi_chitiet', label: 'Địa chỉ chi tiết' }
            ];

            let isValid = true;
            const errors = [];

            // Check required fields
            requiredFields.forEach(field => {
                const element = document.querySelector(`[name="${field.name}"]`);
                if (!element || !element.value.trim()) {
                    this.highlightError(element);
                    errors.push(`${field.label} là bắt buộc`);
                    isValid = false;
                } else {
                    this.clearError(element);
                }
            });

            // Validate phone number
            const phoneField = document.querySelector('[name="sdt"]');
            if (phoneField && phoneField.value) {
                const phoneRegex = /^[0-9]{10}$/;
                if (!phoneRegex.test(phoneField.value.replace(/\s/g, ''))) {
                    this.highlightError(phoneField);
                    errors.push('Số điện thoại phải có 10 chữ số');
                    isValid = false;
                }
            }

            // Check terms agreement
            const termsCheckbox = document.getElementById('terms');
            if (!termsCheckbox || !termsCheckbox.checked) {
                errors.push('Vui lòng đồng ý với điều kiện giao dịch');
                isValid = false;
            }

            // Show errors
            if (errors.length > 0) {
                this.showNotification(errors.join('<br>'), 'error');
            }

            return isValid;
        }

        highlightError(element) {
            if (element) {
                element.style.borderColor = '#e74c3c';
                element.style.boxShadow = '0 0 0 3px rgba(231, 76, 60, 0.1)';
            }
        }

        clearError(element) {
            if (element) {
                element.style.borderColor = '#e1e8ed';
                element.style.boxShadow = 'none';
            }
        }

        formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN').format(amount) + 'đ';
        }

        showNotification(message, type = 'info') {
            // Remove existing notifications
            document.querySelectorAll('.notification').forEach(n => n.remove());

            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.innerHTML = `
                <div style="
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: ${this.getNotificationColor(type)};
                    color: white;
                    padding: 15px 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    z-index: 9999;
                    animation: slideInRight 0.3s ease;
                    max-width: 300px;
                    font-weight: 500;
                ">
                    <i class="fas fa-${this.getNotificationIcon(type)}"></i>
                    ${message}
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        getNotificationColor(type) {
            const colors = {
                'success': '#27ae60',
                'error': '#e74c3c',
                'warning': '#f39c12',
                'info': '#3498db'
            };
            return colors[type] || colors.info;
        }

        getNotificationIcon(type) {
            const icons = {
                'success': 'check-circle',
                'error': 'exclamation-circle',
                'warning': 'exclamation-triangle',
                'info': 'info-circle'
            };
            return icons[type] || icons.info;
        }

        showConfirmDialog(title, message) {
            return confirm(`${title}\n\n${message}`);
        }

        processOrder() {
            if (!this.validateForm()) {
                return;
            }

            const orderBtn = document.getElementById('order-btn');
            const originalText = orderBtn.textContent;
            
            orderBtn.textContent = 'ĐANG XỬ LÝ...';
            orderBtn.disabled = true;

            // Simulate processing time
            setTimeout(() => {
                this.showNotification('Đơn hàng đã được đặt thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.', 'success');
                orderBtn.textContent = originalText;
                orderBtn.disabled = false;
            }, 1500);
        }
    }

    // Global functions
    function changeQuantity(productId, change) {
        window.cart.changeQuantity(productId, change);
    }

    function updateQuantity(input, productId) {
        window.cart.updateQuantity(input, productId);
    }

    function removeItem(productId) {
        window.cart.removeItem(productId);
    }

    function updateShippingFee() {
        window.cart.updateShippingFee();
    }

    function showVipDiscount() {
        window.cart.showNotification('Chức năng đăng nhập/tạo thẻ VIP sẽ được phát triển trong phiên bản tới!', 'info');
    }

    function processOrder() {
        window.cart.processOrder();
    }

    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        
        .product-item {
            transition: all 0.3s ease;
        }
        
        .product-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .form-input, .form-select {
            transition: all 0.3s ease;
        }

        .radio-item, .checkbox-item {
            transition: all 0.3s ease;
        }

        .radio-item:active, .checkbox-item:active {
            transform: scale(0.98);
        }

        .quantity-btn:active {
            transform: scale(0.95);
        }

        .order-button:active {
            transform: translateY(-1px);
        }

        /* Smooth icon transitions */
        .cod-icon, .momo-icon {
            transition: all 0.3s ease;
        }

        .radio-item:hover .cod-icon,
        .radio-item:hover .momo-icon {
            transform: scale(1.05);
        }
    `;
    document.head.appendChild(style);

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        // Debug: Check cart data
        console.log('=== CART DEBUG INFO ===');
        const productItems = document.querySelectorAll('.product-item');
        console.log('Found', productItems.length, 'products in cart');
        
        productItems.forEach((item, index) => {
            const quantityInput = item.querySelector('.quantity-input');
            if (quantityInput) {
                console.log(`Product ${index + 1}:`, {
                    productId: item.dataset.productId,
                    quantity: quantityInput.value,
                    price: quantityInput.dataset.price,
                    itemTotal: (parseFloat(quantityInput.dataset.price) || 0) * (parseInt(quantityInput.value) || 1)
                });
            }
        });
        console.log('=== END DEBUG ===');
        
        window.cart = new AdvancedShoppingCart();
        
        // Form submission handler
        const form = document.getElementById('checkout-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                window.cart.processOrder();
            });
        }
    });
</script>
</body>
</html>

