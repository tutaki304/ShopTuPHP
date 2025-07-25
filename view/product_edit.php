
<div class="container">
    <h2>Sửa sản phẩm</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="tensp" placeholder="Tên sản phẩm" value="<?=$data['sp']['tensp']?>"><br>
        <input type="number" name="dongia" placeholder="Giá sản phẩm" value="<?=$data['sp']['dongia']?>"><br>
        <input type="number" name="khuyenmai" placeholder="Giá khuyến mãi" value="<?=$data['sp']['khuyenmai']?>"><br>
        <input type="number" name="soluong" placeholder="Số lượng" value="<?=$data['sp']['soluong']?>"><br>
        <input type="text" name="mota" placeholder="Mô tả" value="<?=$data['sp']['mota']?>"><br>
        <img src="upload/product/<?=$data['sp']['anh']?>" width="100px" alt=""><br>
        <input type="file" name="anh" placeholder="Link Ảnh" value="<?=$data['sp']['anh']?>"><br>
        <select name="madm">
            <?php foreach($data['dsdm'] as $dm): ?>
                <option value="<?=$dm['madm']?>" <?=($data['sp']['madm'] == $dm['madm']) ? 'selected' : ''?>>
                    <?=$dm['tendm']?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" name="submit" value="Lưu thay đổi">
    </form>
</div>
