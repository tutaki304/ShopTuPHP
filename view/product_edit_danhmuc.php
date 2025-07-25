<style>
     /* CSS cho thông báo lỗi 1 */
    .container .thongbaoloi-1 {
        background-color: rgb(49, 209, 129); /* Màu nền đỏ */
        color: white; /* Màu chữ trắng */
        padding: 15px; /* Khoảng cách giữa nội dung và viền */
        margin-bottom: 15px; /* Khoảng cách dưới cùng */
        border-radius: 5px; /* Bo tròn viền */
    }
</style>
<div class="container">
    <h2>Thêm Danh Mục</h2>
    <?php if(isset($_SESSION['thongbao'])) :?> 
    <div class="thongbaoloi-1" role="alert">
        <?=$_SESSION['thongbao']?>
    </div>
    <?php endif; unset($_SESSION['thongbao']); ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="tendm" id="tendm" placeholder="Tên Danh Mục"  value="<?=$dsdm['tendm']?>"><br>
        <input type="text" name="soluongsp" id="soluongsp" placeholder="Số Lượng Sản Phẩm"  value="<?=$dsdm['soluongsp']?>"><br>
        <input type="text" name="thutu" id="thutu" placeholder="Thứ tự"  value="<?=$dsdm['thutu']?>"><br>
        <br>
        <input type="submit" name="submit" value="Thêm Danh Mục">
    </form>
</div>