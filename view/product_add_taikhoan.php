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
    <h2>Thêm Tài Khoản</h2>
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
        <input type="text" name="anh" placeholder="Link Ảnh"><br>
        <input type="text" name="hoten" placeholder="Họ và Tên"><br>
        <input type="text" name="email" placeholder="Email"><br>
        <input type="text" name="diachi" placeholder="Địa chỉ"><br>
        <input type="number" name="sdt" placeholder="Số điện thoại"><br>
        <input type="text" name="matkhau" placeholder="Mật khẩu"><br>
        <input type="text" name="quyen" placeholder="Quyền"><br>
        <br>
        <input type="submit" name="submit" value="Thêm sản phẩm">
    </form>
</div>