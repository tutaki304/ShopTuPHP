
<div class="container">
    <h2>Thêm sản phẩm</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="tensp" placeholder="Tên sản phẩm"><br>
        <input type="number" name="dongia" placeholder="Giá sản phẩm"><br>
        <input type="number" name="khuyenmai" placeholder="Giá khuyến mãi"><br>
        <input type="number" name="soluong" placeholder="Số lượng"><br>
        <input type="text" name="mota" placeholder="Mô tả"><br>
        <input type="file" name="anh" placeholder="Link Ảnh"><br>
        <select name="madm">
            <?php foreach($data['dsdm'] as $dm): ?>
                <option value="<?=$dm['madm']?>">
                    <?=$dm['tendm']?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" name="submit" value="Thêm sản phẩm">
    </form>
</div>