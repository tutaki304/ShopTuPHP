<style>
    .xoa{
        background-color: rgb(236, 18, 18);
        color: rgb(255, 255, 255);
        font-size: 12px;
        padding: 3px;
        border-radius: 2px;
    }
</style>
<div class="sanpham">
    <h2>Danh sách bình luận</h2>
    <!-- thông báo  -->
    <?php if(isset($_SESSION['thongbao'])) :?> 
    <div class="thongbaoloi-1" role="alert">
        <?=$_SESSION['thongbao']?>
    </div>
    <?php endif; unset($_SESSION['thongbao']); ?>
 
</div>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã Khách Hàng</th>
            <th>Nội Dung</th>
            <th>Ngày Bình Luận</th>
            <th>Hoạt động</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach($ds_binhluan as $bl): ?>
        <tr class="thongtinsp">
            <td><?=$i?></td>
            <td>
                <?=$bl['makh']?>
            </td>
            <td>
                <?=$bl['noidung']?>
            </td>
            <td>
                <?=$bl['ngaygui']?>
            </td>
            <td>
                <a class="xoa" onclick="deleteProduct(<?=$bl['mabl']?>)" href="admin.php?mod=page&act=delete_binhluan&id=<?=$bl['mabl']?>"> Delete</a>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>
<script>
    function deleteProduct(id){
        var kq = confirm("Bạn có muốn xoá bình luận này không!");
        if (kq) {
            //KQ đúng -> xoá SP
            window.location.search='?mod=product&act=delete_binhluan&id='+id;
        }
    }
</script>   