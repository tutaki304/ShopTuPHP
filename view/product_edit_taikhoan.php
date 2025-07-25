<style>
     /* CSS cho thông báo lỗi 1 */
    .container .thongbaoloi-1 {
        background-color: rgb(49, 209, 129); /* Màu nền đỏ */
        color: white; /* Màu chữ trắng */
        padding: 15px; /* Khoảng cách giữa nội dung và viền */
        margin-bottom: 15px; /* Khoảng cách dưới cùng */
        border-radius: 5px; /* Bo tròn viền */
    }

    /* CSS cho thông báo lỗi 2 */
    .container .thongbaoloi-2 {
        background-color: #ff9800; /* Màu nền cam */
        color: white; /* Màu chữ trắng */
        padding: 15px; /* Khoảng cách giữa nội dung và viền */
        margin-bottom: 15px; /* Khoảng cách dưới cùng */
        border-radius: 5px; /* Bo tròn viền */
    }
</style>
<div class="container">
    <h2>Sửa Tài Khoản</h2>
    <?php if(isset($_SESSION['thongbao'])) :?>   
        <div class="thongbaoloi-1" role="alert">
            <?=$_SESSION['thongbao']?>
        </div>
    <?php endif; unset($_SESSION['thongbao']); ?>  
    <?php if(isset($_SESSION['loi'])) :?>   
        <div class="thongbaoloi-2" role="alert">
            <?=$_SESSION['loi']?>
        </div>
    <?php endif; unset($_SESSION['loi']); ?>  
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="anh" id="anh" placeholder="Link Ảnh" value="<?=$tk['anh']?>"><br>
        <input type="text" name="hoten" id="hoten" placeholder="Họ và Tên" value="<?=$tk['hoten']?>"><br>
        <input type="text" name="email" id="email" placeholder="Email" value="<?=$tk['email']?>"><br>
        <input type="text" name="diachi" id="diachi" placeholder="Địa chỉ" value="<?=$tk['diachi']?>"><br>
        <input type="number" name="sdt" id="sdt" placeholder="Số điện thoại" value="<?=$tk['sdt']?>"><br>
        <input type="text" name="matkhau" id="matkhau" placeholder="Mật khẩu" value="<?=$tk['matkhau']?>"><br>
        <input type="text" name="quyen" id="quyen" placeholder="Quyền" value="<?=$tk['quyen']?>"><br>
        <br>
        <input type="submit" name="submit-user" value="Sửa tài khoản">
    </form>
</div>