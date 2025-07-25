<style>
    .edit{
        background-color: darkcyan;
        color: white;
        padding: 3px;
        font-size: 12px;
        border-radius: 2px;
    }
    .xoa{
        background-color: rgb(236, 18, 18);
        color: rgb(255, 255, 255);
        font-size: 12px;
        padding: 3px;
        border-radius: 2px;
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .pagination a {
        display: inline-block;
        padding: 8px 12px;
        margin: 0 5px;
        text-decoration: none;
        color: black;
        border: 1px solid black;
        border-radius: 5px;
    }

    .pagination a.active {
        background-color: #007BFF;
        color: #fff;
    }
</style>
<div class="sanpham"> 
    
    <h2>Sản phẩm</h2>
    <a href="admin.php?mod=product&act=add">THÊM SẢN PHẨM</a>
    <?php if(isset($_SESSION['thongbao'])): ?>
        <div style="color:red">
            <?=$_SESSION['thongbao'];?>
        </div>
    <?php endif; unset($_SESSION['thongbao']);?>
</div>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá/khuyến mãi</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach($data['dssp'] as $sp): ?>
        <tr class="thongtinsp">
            <td><?=$i?></td>
            <td class="anhsanpham">
                <img src="upload/product/<?=$sp['anh']?>"><br>
            </td>
            <td>
                <?=$sp['tensp']?>
            </td>
            <td>
                <?=$sp['soluong']?>
            </td>
            <td>
                <del><?=$sp['dongia']?>đ</del>
                <?=$sp['khuyenmai']?>đ <br>
            </td>
            <td>
                <a class="edit" href="admin.php?mod=product&act=edit&id=<?=$sp['masp']?>">Edit</a>
                <a class="xoa" onclick="deleteProduct(<?=$sp['masp']?>)" href="admin.php?mod=product&act=delete&id=<?=$sp['masp']?>"> Delete</a>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>
<div class="pagination">
    <?php for($i=1;$i<=$sotrang;$i++): ?>
        <a href="admin.php?mod=product&act=admin&page=<?=$i?>">
            <?=$i?>
        </a>
    <?php endfor; ?>
</div>
<script>
    function deleteProduct(id){
        var kq = confirm("Bạn có muốn xoá sản phẩm này không!");
        if (kq) {
            //KQ đúng -> xoá SP
            window.location.search='?mod=product&act=delete&id='+id;
        }
    }
</script>   