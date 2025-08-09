<main>
<div class="container-danhmuc">
    <div class="danhmuc-top row">
        <p><a href="?mod=page&act=home">Trang chủ</a></p><i class="fa-solid fa-angle-right"></i><p>Login</p>
    </div>
</div>
    <div class="login">
        <form action="" method="post">
            <h2>Đăng Nhập</h2>
            <label for="">Email</label>
            <input type="email" name="email" placeholder="Email" required>
            <label for="">Password</label>
            <div class="password-container">
                <input type="password" placeholder="Password" name="matkhau" id="loginPassword" required>
                <span class="toggle-password" onclick="togglePassword('loginPassword', this)">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <p class="quenmk"><a href="">Quên mật khẩu</a></p>
            <?php if(isset($thongbao)): ?>
                <div style="color:red;font-size:18px; margin:10px 0;">
                    <?=$thongbao?>
                </div>
            <?php endif; unset($thongbao); ?>
            <div class="button input-box">
                <input class="submit" type="submit" name="submit-login" value="Đăng Nhập">
            </div>
            <p class="dktaiday">Bạn chưa có tài khoản<a href="?mod=user&act=signup">đăng ký</a>tại đây!</p>
        </form>
    </div>
    
    <style>
        .password-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            font-size: 16px;
        }
        
        .toggle-password:hover {
            color: #333;
        }
        
        .password-container input {
            padding-right: 35px;
            width: 100%;
            box-sizing: border-box;
        }
    </style>
    
    <script>
        function togglePassword(inputId, toggleElement) {
            const passwordInput = document.getElementById(inputId);
            const icon = toggleElement.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                icon.className = 'fas fa-eye';
            }
        }
    </script>
</main>