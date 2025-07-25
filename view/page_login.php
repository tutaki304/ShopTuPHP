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
            <input type="text" name="email" placeholder="Email" required>
            <label for="">Password</label>
            <input type="text" placeholder="Password" name="matkhau" required>
            <p class="quenmk"><a href="">Quên mật khẩu</a></p>
            <?php if(isset($thongbao)): ?>
                <div style="color:red;font-size:18px; margin:10px 0;">
                    <?=$thongbao?>
                </div>
            <?php endif; unset($thongbao); ?>
            <div class="button input-box">
                <input class="submit" type="submit" name="submit-login" value="Submit">
            </div>
            <p class="dktaiday">Bạn chưa có tài khoản<a href="?mod=user&act=signup">đăng ký</a>tại đây!</p>
        </form>
    </div>
</main>