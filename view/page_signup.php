
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
            <input type="text" name="email" placeholder="Email" required>
            <label for="">Password</label>
            <input type="text" placeholder="Password" name="matkhau" required>
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
</main>