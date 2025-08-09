
<main>
    <div class="container-danhmuc">
        <div class="danhmuc-top row">
            <p><a href="?mod=page&act=home">Trang chủ</a></p><i class="fa-solid fa-angle-right"></i><p>Signup</p>
        </div>
    </div>
    <div class="signup">
        <form action="" method="post">
            <h2>Đăng Ký</h2>
            <label for="">Họ và Tên</label>
            <input type="text" name="hoten" placeholder="Họ và Tên" required>
            <label for="">Email</label>
            <input type="email" name="email" placeholder="Email" required>
            <label for="">Password</label>
            <div class="password-container">
                <input type="password" placeholder="Password" name="matkhau" id="signupPassword" required>
                <span class="toggle-password" onclick="togglePassword('signupPassword', this)">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <?php if(isset($thongbao2)): ?>
                <div style="color:red;font-size:18px; margin:10px 0;">
                    <?=$thongbao2?>
                </div>
            <?php endif; unset($thongbao2); ?>
            <div class="button input-box">
                <input class="submit" type="submit" name="submit-signup" value="Submit">
            </div>
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