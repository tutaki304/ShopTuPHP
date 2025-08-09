<style>
    .products-container {
        padding: 20px;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .products-header {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }
    
    .products-header h2 {
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
    
    .products-table {
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
    
    .anhsanpham img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 5px;
    }
    
    .pagination a {
        display: inline-block;
        padding: 10px 15px;
        text-decoration: none;
        color: #6c757d;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    
    .pagination a:hover {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        transform: translateY(-2px);
    }
    
    .pagination a.active {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        border-color: #3498db;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }
</style>
<div class="products-container">
    <div class="products-header">
        <h2>🛍️ Quản lý Sản phẩm</h2>
        <a href="admin.php?mod=product&act=add" class="btn btn-primary">
            <i class="fas fa-plus"></i> THÊM SẢN PHẨM
        </a>
        <?php if(isset($_SESSION['thongbao'])): ?>
            <div class="alert-success">
                <?=$_SESSION['thongbao'];?>
            </div>
        <?php endif; unset($_SESSION['thongbao']);?>
    </div>
    
    <div class="products-table">
        <table class="table">
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
                        <img src="upload/product/<?= isset($sp['anh']) && !empty($sp['anh']) ? $sp['anh'] : 'default.jpg' ?>"><br>
                    </td>
                    <td>
                        <?= isset($sp['tensp']) ? $sp['tensp'] : 'N/A' ?>
                    </td>
                    <td>
                        <?= isset($sp['soluong']) ? $sp['soluong'] : '0' ?>
                    </td>
                    <td>
                        <del><?= isset($sp['dongia']) ? number_format($sp['dongia'] * 1000) : '0' ?>đ</del><br>
                        <strong><?= isset($sp['khuyenmai']) ? number_format($sp['khuyenmai'] * 1000) : '0' ?>đ</strong>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a class="btn btn-warning btn-sm" href="admin.php?mod=product&act=edit&id=<?= isset($sp['masp']) ? $sp['masp'] : '' ?>">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <a class="btn btn-danger btn-sm" onclick="deleteProduct(<?= isset($sp['masp']) ? $sp['masp'] : 0 ?>)" href="admin.php?mod=product&act=delete&id=<?= isset($sp['masp']) ? $sp['masp'] : '' ?>">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        </div>
                    </td>
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="pagination">
        <?php for($i=1;$i<=$sotrang;$i++): ?>
            <a href="admin.php?mod=product&act=admin&page=<?=$i?>" <?= ($i == (isset($_GET['page']) ? $_GET['page'] : 1)) ? 'class="active"' : '' ?>>
                <?=$i?>
            </a>
        <?php endfor; ?>
    </div>
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