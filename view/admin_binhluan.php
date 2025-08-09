<?php
// Kiểm tra quyền admin
if (!isset($_SESSION['user']) || $_SESSION['user']['quyen'] != 'admin') {
    header('Location: index.php?mod=page&act=home');
    exit();
}

// Dữ liệu bình luận đã được tải từ controller
if (!isset($ds_binhluan)) {
    $ds_binhluan = [];
}
?>

<style>
    /* Ẩn hoàn toàn header của user nếu có */
    .header-user,
    .main-header,
    .user-navigation,
    header nav.main-nav,
    .nav-main,
    .khung,
    .container-header {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        overflow: hidden !important;
    }
    
    /* Đảm bảo body không có margin/padding từ header user */
    body {
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 14px;
    }

    .comment-content {
        max-width: 300px;
        word-wrap: break-word;
        line-height: 1.4;
        text-align: left;
    }

    .product-name {
        color: #7c3aed;
        font-style: italic;
        font-weight: 500;
    }

    @keyframes fadeOut {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(-20px); }
    }
    
    .comment-deleting {
        animation: fadeOut 0.5s ease-out;
    }

    .stats-info {
        background: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        border-left: 4px solid #6c757d;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .stats-info h4 {
        margin: 0 0 15px 0;
        color: #2c3e50;
        font-size: 18px;
        font-weight: 600;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
        background: #f8f9ff;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
    }

    .stat-number {
        font-size: 28px;
        font-weight: 700;
        color: #6c757d;
        display: block;
    }

    .stat-label {
        font-size: 13px;
        color: #6c757d;
        margin-top: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .thongbaoloi-1 {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .thongbaoloi-2 {
        background: linear-gradient(45deg, #dc3545, #e74c3c);
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .xoa {
        background: linear-gradient(45deg, #dc3545, #e74c3c);
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .xoa:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .xoa:disabled {
        background: #6c757d;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .empty-message {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .empty-message i {
        font-size: 64px;
        color: #dee2e6;
        margin-bottom: 15px;
        display: block;
    }

    .empty-message h3 {
        margin-bottom: 10px;
        color: #495057;
    }

    /* CSS cho table và header */
    #comment-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-top: 20px;
    }

    #comment-table thead {
        background: linear-gradient(45deg, #6c757d, #495057);
    }

    #comment-table thead th {
        color: black !important;
        padding: 16px 12px;
        text-align: center;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
    }

    #comment-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #e9ecef;
    }

    #comment-table tbody tr:hover {
        background-color: #f8f9ff;
    }

    #comment-table tbody td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
        font-size: 14px;
    }
</style>

<div class="sanpham">
    <h2><i class="fa fa-comments"></i> Quản lý Bình luận</h2>
</div>

<!-- Thống kê -->
<div class="stats-info">
    <h4><i class="fa fa-chart-bar"></i> Thống kê bình luận</h4>
    <div class="stats-grid">
        <div class="stat-item">
            <span class="stat-number" id="total-comments"><?= count($ds_binhluan) ?></span>
            <div class="stat-label">Tổng bình luận</div>
        </div>
        <div class="stat-item">
            <span class="stat-number" id="total-customers"><?= count(array_unique(array_column($ds_binhluan, 'makh'))) ?></span>
            <div class="stat-label">Khách hàng</div>
        </div>
        <div class="stat-item">
            <span class="stat-number" id="total-products"><?= count(array_unique(array_column($ds_binhluan, 'masp'))) ?></span>
            <div class="stat-label">Sản phẩm</div>
        </div>
    </div>
</div>

<!-- Thông báo -->
<div id="notification-container">
    <?php if(isset($_SESSION['thongbao'])): ?> 
        <div class="thongbaoloi-1">
            <i class="fa fa-check-circle"></i>
            <?=$_SESSION['thongbao']?>
        </div>
        <?php unset($_SESSION['thongbao']); ?>
    <?php endif; ?>
</div>

<?php if(!empty($ds_binhluan)): ?>
<table id="comment-table">
    <thead>
        <tr>
            <th>STT</th>
            <th>Người dùng</th>
            <th>Email</th>
            <th>Sản phẩm</th>
            <th>Nội dung</th>
            <th>Ngày gửi</th>
            <th>Hoạt động</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($ds_binhluan as $bl): ?>
            <tr class="thongtinsp" id="comment-<?=$bl['mabl']?>">
                <td><?=$i?></td>
                <td>
                    <div class="user-info">
                        <div class="user-avatar">
                            <?= strtoupper(substr($bl['hoten'], 0, 1)) ?>
                        </div>
                        <strong><?=htmlspecialchars($bl['hoten'])?></strong>
                    </div>
                </td>
                <td><?=htmlspecialchars($bl['email'])?></td>
                <td class="product-name"><?=htmlspecialchars($bl['tensp'])?></td>
                <td>
                    <div class="comment-content">
                        <?=htmlspecialchars($bl['noidung'])?>
                    </div>
                </td>
                <td><?=date('d/m/Y H:i', strtotime($bl['ngaygui']))?></td>
                <td>
                    <button class="xoa" onclick="deleteComment(<?=$bl['mabl']?>)">
                        <i class="fa fa-trash"></i> Xóa
                    </button>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<div class="empty-message">
    <i class="fa fa-comment-slash"></i>
    <h3>Chưa có bình luận nào</h3>
    <p>Các bình luận của khách hàng sẽ hiển thị tại đây</p>
</div>
<?php endif; ?>

<script>
    function deleteComment(id){
        var kq = confirm("Bạn có muốn xóa bình luận này không?");
        if (kq) {
            const button = event.target.closest('.xoa');
            const originalHTML = button.innerHTML;
            
            // Hiển thị loading
            button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang xóa...';
            button.disabled = true;
            
            // Sử dụng fetch API để xóa bình luận
            fetch('admin.php?mod=page&act=delete_binhluan&id=' + id, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(data => {
                if(data.includes('success') || data === 'success') {
                    // Xóa dòng bình luận khỏi bảng
                    const row = document.getElementById('comment-' + id);
                    if (row) {
                        row.classList.add('comment-deleting');
                        setTimeout(() => {
                            row.remove();
                            // Cập nhật lại số thứ tự
                            updateRowNumbers();
                            updateStats();
                            showMessage('Xóa bình luận thành công!', 'success');
                            
                            // Kiểm tra nếu không còn bình luận nào
                            checkEmptyState();
                        }, 500);
                    }
                } else {
                    // Khôi phục button nếu lỗi
                    button.innerHTML = originalHTML;
                    button.disabled = false;
                    showMessage('Có lỗi xảy ra khi xóa bình luận!', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Khôi phục button nếu lỗi
                button.innerHTML = originalHTML;
                button.disabled = false;
                showMessage('Có lỗi xảy ra khi xóa bình luận!', 'error');
            });
        }
    }

    function updateRowNumbers() {
        const rows = document.querySelectorAll('#comment-table tbody tr');
        rows.forEach((row, index) => {
            const firstCell = row.querySelector('td:first-child');
            if (firstCell && !firstCell.getAttribute('colspan')) {
                firstCell.textContent = index + 1;
            }
        });
    }

    function updateStats() {
        const table = document.getElementById('comment-table');
        if (!table) return;
        
        const rows = document.querySelectorAll('#comment-table tbody tr');
        const totalComments = rows.length;
        
        const uniqueEmails = new Set();
        const uniqueProducts = new Set();
        
        rows.forEach(row => {
            const emailCell = row.children[2];
            const productCell = row.children[3];
            if (emailCell) uniqueEmails.add(emailCell.textContent.trim());
            if (productCell) uniqueProducts.add(productCell.textContent.trim());
        });
        
        document.getElementById('total-comments').textContent = totalComments;
        document.getElementById('total-customers').textContent = uniqueEmails.size;
        document.getElementById('total-products').textContent = uniqueProducts.size;
    }

    function checkEmptyState() {
        const table = document.getElementById('comment-table');
        const rows = document.querySelectorAll('#comment-table tbody tr');
        
        if (rows.length === 0 && table) {
            table.style.display = 'none';
            
            const emptyDiv = document.createElement('div');
            emptyDiv.className = 'empty-message';
            emptyDiv.innerHTML = `
                <i class="fa fa-comment-slash"></i>
                <h3>Chưa có bình luận nào</h3>
                <p>Các bình luận của khách hàng sẽ hiển thị tại đây</p>
            `;
            
            table.parentNode.insertBefore(emptyDiv, table.nextSibling);
        }
    }

    function showMessage(message, type) {
        // Xóa thông báo cũ
        const existingMessage = document.querySelector('.thongbaoloi-1, .thongbaoloi-2');
        if (existingMessage) {
            existingMessage.remove();
        }
        
        // Tạo thông báo mới
        const messageDiv = document.createElement('div');
        messageDiv.className = type === 'success' ? 'thongbaoloi-1' : 'thongbaoloi-2';
        messageDiv.innerHTML = `<i class="fa fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${message}`;
        
        const container = document.getElementById('notification-container');
        container.appendChild(messageDiv);
        
        // Tự động ẩn sau 4 giây
        setTimeout(() => {
            messageDiv.style.opacity = '0';
            messageDiv.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                messageDiv.remove();
            }, 300);
        }, 4000);
    }
</script>
