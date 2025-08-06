<style>
    .container {
        max-width: 600px;
        margin: 20px auto;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .container h2 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
        font-size: 28px;
        font-weight: 600;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
        font-size: 14px;
    }
    
    .container input[type="text"], 
    .container input[type="email"], 
    .container input[type="tel"],
    .container input[type="password"] {
        width: 100%;
        padding: 12px;
        border: 2px solid #e1e5e9;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }
    
    .container input:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
    }
    
    /* CSS cho nút lựa chọn quyền */
    .role-selection {
        margin-bottom: 20px;
    }
    
    .role-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 10px;
    }
    
    .role-btn {
        flex: 1;
        padding: 15px 20px;
        border: 2px solid #e1e5e9;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .role-btn:hover {
        border-color: #007bff;
        background: #f8f9fa;
    }
    
    .role-btn.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
        box-shadow: 0 4px 15px rgba(0,123,255,0.3);
    }
    
    .role-btn input[type="radio"] {
        display: none;
    }
    
    .role-icon {
        font-size: 24px;
        margin-bottom: 8px;
        display: block;
    }
    
    .container input[type="submit"] {
        width: 100%;
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white;
        border: none;
        padding: 15px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        border-radius: 8px;
        transition: all 0.3s ease;
        margin-top: 20px;
    }
    
    .container input[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,123,255,0.4);
    }
    
    /* CSS cho thông báo */
    .container .thongbaoloi-1 {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(40,167,69,0.3);
    }

    .container .thongbaoloi-2 {
        background: linear-gradient(45deg, #dc3545, #fd7e14);
        color: white;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(220,53,69,0.3);
    }
    
    .password-note {
        background: #e7f3ff;
        border: 1px solid #b3d9ff;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 20px;
        font-size: 14px;
        color: #0066cc;
        text-align: center;
    }
</style>
<div class="container">
    <h2>🔐 Thêm Tài Khoản Mới</h2>
    
    <?php if(isset($_SESSION['thongbao'])) :?> 
    <div class="thongbaoloi-1" role="alert">
        ✅ <?=$_SESSION['thongbao']?>
    </div>
    <?php endif; unset($_SESSION['thongbao']); ?>
    
    <?php if(isset($_SESSION['loi'])) :?>   
        <div class="thongbaoloi-2" role="alert">
            ⚠️ <?=$_SESSION['loi']?>
        </div>
    <?php endif; unset($_SESSION['loi']); ?>
    
    <div class="password-note">
        💡 <strong>Lưu ý:</strong> Nếu không nhập mật khẩu, hệ thống sẽ tự động tạo mật khẩu mặc định là <strong>12345</strong>
    </div>
    
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="anh">🖼️ Link Ảnh Đại Diện</label>
            <input type="text" id="anh" name="anh" placeholder="Nhập link ảnh hoặc để trống sử dụng ảnh mặc định">
        </div>
        
        <div class="form-group">
            <label for="hoten">👤 Họ và Tên *</label>
            <input type="text" id="hoten" name="hoten" placeholder="Nhập họ và tên đầy đủ" required>
        </div>
        
        <div class="form-group">
            <label for="email">📧 Email *</label>
            <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email" required>
        </div>
        
        <div class="form-group">
            <label for="diachi">🏠 Địa Chỉ</label>
            <input type="text" id="diachi" name="diachi" placeholder="Nhập địa chỉ">
        </div>
        
        <div class="form-group">
            <label for="sdt">📱 Số Điện Thoại *</label>
            <input type="tel" id="sdt" name="sdt" placeholder="Nhập số điện thoại" required>
        </div>
        
        <div class="form-group">
            <label for="matkhau">🔑 Mật Khẩu</label>
            <input type="password" id="matkhau" name="matkhau" placeholder="Nhập mật khẩu (để trống sẽ dùng mật khẩu mặc định)">
        </div>
        
        <div class="role-selection">
            <label>👥 Chọn Quyền Người Dùng *</label>
            <div class="role-buttons">
                <label class="role-btn" onclick="selectRole(this, 'user')">
                    <input type="radio" name="quyen" value="user" required>
                    <span class="role-icon">👤</span>
                    <div>Khách Hàng</div>
                </label>
                <label class="role-btn" onclick="selectRole(this, 'admin')">
                    <input type="radio" name="quyen" value="admin" required>
                    <span class="role-icon">👑</span>
                    <div>Quản Trị Viên</div>
                </label>
            </div>
        </div>
        
        <input type="submit" name="submit" value="➕ Thêm Tài Khoản">
    </form>
</div>

<script>
function selectRole(element, role) {
    // Xóa class active từ tất cả các button
    document.querySelectorAll('.role-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Thêm class active cho button được chọn
    element.classList.add('active');
    
    // Check radio button tương ứng
    element.querySelector('input[type="radio"]').checked = true;
}

// Xử lý click trực tiếp vào radio button
document.querySelectorAll('input[name="quyen"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.role-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        this.closest('.role-btn').classList.add('active');
    });
});
</script>