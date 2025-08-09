<style>
    .categories-container {
        padding: 20px;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .categories-header {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }
    
    .categories-header h2 {
        color: #2c3e50;
        margin: 0 0 20px 0;
        font-size: 28px;
        font-weight: 600;
    }
    
    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #27ae60, #229954);
        color: white;
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #f39c12, #e67e22);
        color: white;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: white;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .categories-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    
    .table thead {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
    }
    
    .table th,
    .table td {
        padding: 15px 12px;
        text-align: left;
        border-bottom: 1px solid #e9ecef;
    }
    
    .table th {
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9ff;
        transform: scale(1.005);
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }
    
    .alert-warning {
        background: #fff3cd;
        color: #856404;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #ffeaa7;
    }
    
    .category-count {
        display: inline-block;
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }
</style>
<div class="categories-container">
    <div class="categories-header">
        <h2>📂 Quản lý Danh Mục</h2>
        <a href="admin.php?mod=product&act=add_danhmuc" class="btn btn-primary">
            <i class="fas fa-plus"></i> THÊM DANH MỤC
        </a>
        <!-- thông báo  -->
        <?php if(isset($_SESSION['thongbao'])) :?> 
        <div class="alert-success" role="alert">
            <i class="fas fa-check-circle"></i> <?=$_SESSION['thongbao']?>
        </div>
         <!-- thông báo lỗi -->
        <?php endif; unset($_SESSION['thongbao']); ?>
        <?php if(isset($_SESSION['loi'])) :?>   
            <div class="alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?=$_SESSION['loi']?>
            </div>
        <?php endif; unset($_SESSION['loi']); ?>  
        <!-- ----------------- -->
    </div>
    
    <div class="categories-table">
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Danh Mục</th>
                    <th>Số Lượng Sản Phẩm</th>
                    <th>Hoạt động</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach($ds_admin_danhmuc as $dm): ?>
                <tr class="thongtinsp">
                    <td><?=$i?></td>
                    <td>
                        <i class="fas fa-folder"></i> <?= isset($dm['tendm']) ? $dm['tendm'] : 'N/A' ?>
                    </td>
                    <td>
                        <span class="category-count"><?= isset($dm['soluongsp']) ? $dm['soluongsp'] : '0' ?> sản phẩm</span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a class="btn btn-warning btn-sm" href="admin.php?mod=product&act=edit_danhmuc&id=<?= isset($dm['madm']) ? $dm['madm'] : '' ?>">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <a class="btn btn-danger btn-sm" onclick="deleteProduct(<?= isset($dm['madm']) ? $dm['madm'] : 0 ?>)" href="admin.php?mod=product&act=delete_danhmuc&id=<?= isset($dm['madm']) ? $dm['madm'] : '' ?>">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        </div>
                    </td>
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function deleteProduct(id){
        var kq = confirm("Bạn có muốn xoá danh mục này không!");
        if (kq) {
            //KQ đúng -> xoá SP
            window.location.search='?mod=product&act=delete_danhmuc&id='+id;
        }
    }
</script>   