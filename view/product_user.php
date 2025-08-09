<style>
    .users-container {
        padding: 20px;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .users-header {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }
    
    .users-header h2 {
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
    
    .users-table {
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
    
    .role-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .role-admin {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: white;
    }
    
    .role-user {
        background: linear-gradient(135deg, #27ae60, #229954);
        color: white;
    }
    
    .anhtaikhoan img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #dee2e6;
    }
    
    .avatar-placeholder {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #6c757d, #495057);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 18px;
    }
</style>
<div class="users-container">
    <div class="users-header">
        <h2>👥 Quản lý Tài khoản</h2>
        <a href="admin.php?mod=user&act=add_user" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> THÊM TÀI KHOẢN
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
        
        <!-- Thông báo thành công xóa -->
        <?php if(isset($_SESSION['success_message'])) :?> 
        <div class="alert-success" role="alert">
            <i class="fas fa-check-circle"></i> <?=$_SESSION['success_message']?>
        </div>
        <?php endif; unset($_SESSION['success_message']); ?>
        
        <!-- Thông báo lỗi khi xóa admin -->
        <?php if(isset($_SESSION['error_message'])) :?>   
            <div class="alert-warning" role="alert">
                <i class="fas fa-shield-alt"></i> <?=$_SESSION['error_message']?>
            </div>
        <?php endif; unset($_SESSION['error_message']); ?>  
        <!-- ----------------- -->
    </div>
    
    <div class="users-table">
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Họ tên</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Quyền</th>
                    <th>Hoạt động</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach($dstaikhoan as $tk): ?>
                <tr class="thongtinsp">
                    <td><?=$i?></td>
                    <td class="anhtaikhoan">
                        <?php 
                        $user_id = isset($tk['makh']) ? $tk['makh'] : 0;
                        $user_initial = strtoupper(substr(isset($tk['hoten']) ? $tk['hoten'] : 'User', 0, 1));
                        
                        // Tạo avatar dựa trên ID
                        $avatar_options = ['anhhao.jpg', 'avatar1.jpg', 'avatar2.jpg', 'avatar3.jpg'];
                        $selected_avatar = $avatar_options[$user_id % count($avatar_options)];
                        
                        // Kiểm tra nếu có ảnh riêng
                        $custom_avatar = isset($tk['anh']) && !empty($tk['anh']) ? $tk['anh'] : '';
                        
                        if (!empty($custom_avatar) && file_exists("upload/avatar/" . $custom_avatar)): ?>
                            <img src="upload/avatar/<?= $custom_avatar ?>" alt="Avatar">
                        <?php else: ?>
                            <img src="upload/avatar/<?= $selected_avatar ?>" alt="Avatar" 
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="avatar-placeholder" style="display: none;">
                                <?= $user_initial ?>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div>
                            <strong><?= isset($tk['hoten']) ? $tk['hoten'] : 'N/A' ?></strong><br>
                            <small class="text-muted">ID: <?= isset($tk['makh']) ? $tk['makh'] : 'N/A' ?></small>
                        </div>
                    </td>
                    <td><?= isset($tk['sdt']) ? $tk['sdt'] : 'N/A' ?></td>
                    <td><?= isset($tk['email']) ? $tk['email'] : 'N/A' ?></td>
                    <td>
                        <span class="role-badge <?= (isset($tk['quyen']) && $tk['quyen'] == 'admin') ? 'role-admin' : 'role-user' ?>">
                            <i class="fas fa-<?= (isset($tk['quyen']) && $tk['quyen'] == 'admin') ? 'crown' : 'user' ?>"></i>
                            <?= isset($tk['quyen']) ? strtoupper($tk['quyen']) : 'USER' ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a class="btn btn-warning btn-sm" href="admin.php?mod=user&act=edit_user&id=<?= isset($tk['makh']) ? $tk['makh'] : '' ?>">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <?php if (isset($tk['quyen']) && $tk['quyen'] != 'admin'): ?>
                                <a class="btn btn-danger btn-sm" onclick="deleteProduct(<?= isset($tk['makh']) ? $tk['makh'] : 0 ?>)" href="admin.php?mod=user&act=delete_user&id=<?= isset($tk['makh']) ? $tk['makh'] : '' ?>">
                                    <i class="fas fa-trash"></i> Xóa
                                </a>
                            <?php else: ?>
                                <span class="btn btn-secondary btn-sm" style="cursor: not-allowed; opacity: 0.6;" title="Không thể xóa tài khoản Admin">
                                    <i class="fas fa-shield-alt"></i> Bảo vệ
                                </span>
                            <?php endif; ?>
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
        var kq = confirm("Bạn có muốn xoá tài khoản này không!");
        if (kq) {
            //KQ đúng -> xoá tài khoản
            window.location.search='?mod=user&act=delete_user&id='+id;
        }
    }
    
    // Xử lý lỗi avatar
    document.addEventListener('DOMContentLoaded', function() {
        const avatarImages = document.querySelectorAll('.anhtaikhoan img');
        avatarImages.forEach(function(img) {
            img.addEventListener('error', function() {
                this.style.display = 'none';
                const placeholder = this.nextElementSibling;
                if (placeholder && placeholder.classList.contains('avatar-placeholder')) {
                    placeholder.style.display = 'flex';
                }
            });
            
            // Kiểm tra nếu src trống hoặc không hợp lệ
            if (!img.src || img.src.includes('upload/avatar/') && !img.src.includes('default.png')) {
                // Thử load ảnh, nếu lỗi sẽ trigger error event
                const testImg = new Image();
                testImg.onload = function() {
                    // Ảnh load thành công
                };
                testImg.onerror = function() {
                    img.style.display = 'none';
                    const placeholder = img.nextElementSibling;
                    if (placeholder && placeholder.classList.contains('avatar-placeholder')) {
                        placeholder.style.display = 'flex';
                    }
                };
                testImg.src = img.src;
            }
        });
    });
</script>   