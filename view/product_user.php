<style>
    /* CSS cho thông báo lỗi 1 */
    .thongbaoloi-1 {
        background-color: #f44336; /* Màu nền đỏ */
        color: white; /* Màu chữ trắng */
        padding: 15px; /* Khoảng cách giữa nội dung và viền */
        margin-bottom: 15px; /* Khoảng cách dưới cùng */
        border-radius: 5px; /* Bo tròn viền */
    }

    /* CSS cho thông báo lỗi 2 */
    .thongbaoloi-2 {
        background-color: #ff9800; /* Màu nền cam */
        color: white; /* Màu chữ trắng */
        padding: 15px; /* Khoảng cách giữa nội dung và viền */
        margin-bottom: 15px; /* Khoảng cách dưới cùng */
        border-radius: 3px; /* Bo tròn viền */
    }
    .quyenadmin{
        background-color: crimson;
        border-radius: 10px;
        padding: 3px;
        color: white;
        font-size:12px;
    }
    .quyenuser{
        background-color:green;
        border-radius: 10px;
        padding: 5px;
        color: white;
        font-size:12px;
    }
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
</style>
<div class="sanpham">
    <h2>Tài khoản</h2>
    <a href="admin.php?mod=user&act=add_user">THÊM TÀI KHOẢN</a>
    <!-- thông báo  -->
    <?php if(isset($_SESSION['thongbao'])) :?> 
    <div class="thongbaoloi-1" role="alert">
        <?=$_SESSION['thongbao']?>
    </div>
     <!-- thông báo lỗi -->
    <?php endif; unset($_SESSION['thongbao']); ?>
    <?php if(isset($_SESSION['loi'])) :?>   
        <div class="thongbaoloi-2" role="alert">
            <?=$_SESSION['loi']?>
        </div>
    <?php endif; unset($_SESSION['loi']); ?>  
    <!-- ----------------- -->
</div>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Ảnh</th>
            <th>Họ tên</th>
            <th>SĐT</th>
            <th>Quyền</th>
            <th>Hoạt động</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach($dstaikhoan as $tk): ?>
        <tr class="thongtinsp">
            <td><?=$i?></td>
            <td class="anhtaikhoan">
                <img src="<?=$tk['anh']?>"><br>
            </td>
            <td><?=$tk['hoten']?></td>
            <td>
                <?=$tk['sdt']?>
            </td>
            <td>
                <?php
                    switch($tk['quyen']){
                        case 'admin':
                            echo '<span class="quyenadmin">Quản lý</span>';
                            break;
                        case 'user':
                            echo '<span class="quyenuser">Khách hàng</span>';
                            break;
                        default:
                        break;
                    }
                ?>
            </td>
            <td>
                <a class="edit" href="admin.php?mod=user&act=edit_user&id=<?=$tk['makh']?>">Edit</a>
                <a class="xoa" onclick="deleteProduct(<?=$tk['makh']?>)" href="admin.php?mod=user&act=delete_user&id=<?=$tk['makh']?>"> Delete</a>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>
<script>
    function deleteProduct(id){
        var kq = confirm("Bạn có muốn xoá sản phẩm này không!");
        if (kq) {
            //KQ đúng -> xoá SP
            window.location.search='?mod=user&act=delete_user&id='+id;
        }
    }
</script>   