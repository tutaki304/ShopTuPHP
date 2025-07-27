<div class="user-profile-container">
    <div class="profile-wrapper">
        <div class="profile-header">
            <div class="profile-avatar">
                <?php if(!empty($user['anh']) && file_exists('upload/avatar/' . $user['anh'])): ?>
                    <img src="upload/avatar/<?= htmlspecialchars($user['anh']) ?>" alt="Avatar" class="avatar-image">
                <?php else: ?>
                    <div class="avatar-placeholder">
                        <i class="fas fa-user"></i>
                    </div>
                <?php endif; ?>
            </div>
            <div class="profile-info">
                <h2><?= htmlspecialchars($user['hoten'] ?? 'Chưa cập nhật') ?></h2>
                <p class="user-role">
                    <i class="fas fa-<?= ($user['quyen'] == 'admin') ? 'crown' : 'user' ?>"></i>
                    <?= ucfirst($user['quyen']) ?>
                </p>
                <div class="profile-actions">
                    <a href="?mod=user&act=edit_profile" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        Chỉnh sửa thông tin
                    </a>
                    <a href="?mod=user&act=change_password" class="btn btn-secondary">
                        <i class="fas fa-key"></i>
                        Đổi mật khẩu
                    </a>
                </div>
            </div>
        </div>

        <div class="profile-details">
            <div class="detail-section">
                <h3><i class="fas fa-user-circle"></i> Thông tin cá nhân</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Họ tên:</label>
                        <span><?= htmlspecialchars($user['hoten'] ?? 'Chưa cập nhật') ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Email:</label>
                        <span><?= htmlspecialchars($user['email'] ?? 'Chưa cập nhật') ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Số điện thoại:</label>
                        <span><?= htmlspecialchars($user['sdt'] ?? 'Chưa cập nhật') ?></span>
                    </div>
                    <div class="detail-item full-width">
                        <label>Địa chỉ:</label>
                        <span><?= htmlspecialchars($user['diachi'] ?? 'Chưa cập nhật') ?></span>
                    </div>
                    <?php if(!empty($user['ngaysinh']) && $user['ngaysinh'] != '0000-00-00'): ?>
                    <div class="detail-item">
                        <label>Ngày sinh:</label>
                        <span><?= date('d/m/Y', strtotime($user['ngaysinh'])) ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="detail-item">
                        <label>Quyền:</label>
                        <span class="role-badge role-<?= $user['quyen'] ?>">
                            <?= ucfirst($user['quyen']) ?>
                        </span>
                    </div>
                </div>
            </div>

            <?php if($user['quyen'] == 'admin'): ?>
            <div class="detail-section">
                <h3><i class="fas fa-cogs"></i> Quản trị</h3>
                <div class="admin-actions">
                    <a href="admin.php" class="admin-btn">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard Admin</span>
                    </a>
                    <a href="admin.php?mod=product&act=admin" class="admin-btn">
                        <i class="fas fa-box"></i>
                        <span>Quản lý sản phẩm</span>
                    </a>
                    <a href="admin.php?mod=user&act=user" class="admin-btn">
                        <i class="fas fa-users"></i>
                        <span>Quản lý người dùng</span>
                    </a>
                    <a href="admin.php?mod=product&act=admin_danhmuc" class="admin-btn">
                        <i class="fas fa-tags"></i>
                        <span>Quản lý danh mục</span>
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <div class="detail-section">
                <h3><i class="fas fa-shopping-cart"></i> Hoạt động mua sắm</h3>
                <div class="activity-stats">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number"><?= $order_count ?? 0 ?></span>
                            <span class="stat-label">Đơn hàng</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number">0</span>
                            <span class="stat-label">Yêu thích</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number"><?= $comment_count ?? 0 ?></span>
                            <span class="stat-label">Bình luận</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number">
                                <?php 
                                // Tính số ngày từ khi tạo tài khoản
                                if(isset($user['created_at'])) {
                                    echo ceil((time() - strtotime($user['created_at'])) / (60*60*24));
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </span>
                            <span class="stat-label">Ngày thành viên</span>
                        </div>
                    </div>
                </div>
                
                <div class="quick-actions">
                    <a href="?mod=page&act=home" class="quick-action">
                        <i class="fas fa-home"></i>
                        <span>Trang chủ</span>
                    </a>
                    <a href="?mod=product&act=sanpham" class="quick-action">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Mua sắm</span>
                    </a>
                    <a href="?mod=cart&act=showcart" class="quick-action">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Giỏ hàng</span>
                    </a>
                    <a href="?mod=user&act=logout" class="quick-action logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Đăng xuất</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.user-profile-container {
    min-height: 80vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px 20px;
}

.profile-wrapper {
    max-width: 1000px;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    overflow: hidden;
}

.profile-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px;
    display: flex;
    align-items: center;
    gap: 30px;
    color: white;
}

.profile-avatar {
    flex-shrink: 0;
}

.avatar-image {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid rgba(255,255,255,0.3);
    object-fit: cover;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.avatar-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid rgba(255,255,255,0.3);
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    color: rgba(255,255,255,0.8);
}

.profile-info h2 {
    margin: 0 0 10px 0;
    font-size: 32px;
    font-weight: 600;
}

.user-role {
    margin: 0 0 20px 0;
    font-size: 16px;
    opacity: 0.9;
}

.user-role i {
    margin-right: 8px;
}

.profile-actions {
    display: flex;
    gap: 15px;
}

.btn {
    padding: 12px 20px;
    border: none;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-primary {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 2px solid rgba(255,255,255,0.3);
}

.btn-primary:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
}

.btn-secondary {
    background: transparent;
    color: white;
    border: 2px solid rgba(255,255,255,0.5);
}

.btn-secondary:hover {
    background: rgba(255,255,255,0.1);
    transform: translateY(-2px);
}

.profile-details {
    padding: 40px;
}

.detail-section {
    margin-bottom: 40px;
}

.detail-section h3 {
    color: #333;
    margin-bottom: 20px;
    font-size: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.detail-section h3 i {
    color: #667eea;
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.detail-item.full-width {
    grid-column: 1 / -1;
}

.detail-item label {
    font-weight: 600;
    color: #666;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-item span {
    color: #333;
    font-size: 16px;
    padding: 10px 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.role-badge {
    display: inline-block !important;
    padding: 8px 16px !important;
    border-radius: 20px !important;
    font-weight: 600 !important;
    font-size: 14px !important;
    text-transform: uppercase !important;
}

.role-admin {
    background: linear-gradient(135deg, #e74c3c, #c0392b) !important;
    color: white !important;
}

.role-user {
    background: linear-gradient(135deg, #3498db, #2980b9) !important;
    color: white !important;
}

.admin-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.admin-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px 20px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.admin-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.activity-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
}

.stat-info {
    display: flex;
    flex-direction: column;
}

.stat-number {
    font-size: 24px;
    font-weight: 700;
    color: #333;
}

.stat-label {
    font-size: 12px;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.quick-actions {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.quick-action {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 25px;
    text-decoration: none;
    color: #333;
    transition: all 0.3s ease;
    font-weight: 500;
}

.quick-action:hover {
    border-color: #667eea;
    color: #667eea;
    transform: translateY(-2px);
}

.quick-action.logout {
    border-color: #e74c3c;
    color: #e74c3c;
}

.quick-action.logout:hover {
    background: #e74c3c;
    color: white;
}

@media (max-width: 768px) {
    .profile-header {
        flex-direction: column;
        text-align: center;
        gap: 20px;
    }
    
    .profile-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .detail-grid {
        grid-template-columns: 1fr;
    }
    
    .activity-stats {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .admin-actions {
        grid-template-columns: 1fr;
    }
    
    .quick-actions {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .user-profile-container {
        padding: 20px 10px;
    }
    
    .profile-wrapper {
        border-radius: 15px;
    }
    
    .profile-header {
        padding: 30px 20px;
    }
    
    .profile-details {
        padding: 30px 20px;
    }
    
    .activity-stats {
        grid-template-columns: 1fr;
    }
    
    .stat-item {
        flex-direction: column;
        text-align: center;
    }
}
</style>
