<style>
    .sanpham {
        margin: 20px 0;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    
    .sanpham h2 {
        margin: 0 0 15px 0;
        color: #333;
        font-size: 24px;
    }
    
    .thongbaoloi-1 {
        padding: 10px 15px;
        margin: 10px 0;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 4px;
    }
    
    .thongbaoloi-error {
        padding: 10px 15px;
        margin: 10px 0;
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 4px;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    table th, table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    table th {
        background-color: #007bff;
        color: white;
        font-weight: 600;
    }
    
    table tr:hover {
        background-color: #f5f5f5;
    }
    
    .xoa {
        background-color: #dc3545;
        color: white;
        text-decoration: none;
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .xoa:hover:not(:disabled) {
        background-color: #c82333;
        color: white;
        text-decoration: none;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .xoa:disabled {
        background-color: #6c757d;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
    
    @keyframes fadeOut {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(-20px); }
    }
    
    .comment-deleting {
        animation: fadeOut 0.5s ease-out;
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
<table id="comment-table">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã KH</th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Sản phẩm</th>
            <th>Nội Dung</th>
            <th>Ngày Bình Luận</th>
            <th>Hoạt động</th>
        </tr>
    </thead>
    <tbody>
    <?php if(!empty($ds_binhluan)): ?>
        <?php $i=1; foreach($ds_binhluan as $bl): ?>
            <tr class="thongtinsp" id="comment-<?=$bl['mabl']?>">
                <td><?=$i?></td>
                <td><?=$bl['makh']?></td>
                <td><strong><?=htmlspecialchars($bl['hoten'])?></strong></td>
                <td><?=htmlspecialchars($bl['email'])?></td>
                <td><em><?=htmlspecialchars($bl['tensp'])?></em></td>
                <td><?=htmlspecialchars($bl['noidung'])?></td>
                <td><?=date('d/m/Y H:i', strtotime($bl['ngaygui']))?></td>
                <td>
                    <button class="xoa" onclick="deleteComment(<?=$bl['mabl']?>)">Delete</button>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8" style="text-align: center; padding: 20px; color: #666;">
                Chưa có bình luận nào
            </td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
<script>
    function deleteComment(id){
        var kq = confirm("Bạn có muốn xóa bình luận này không?");
        if (kq) {
            const button = event.target;
            const originalText = button.textContent;
            
            // Hiển thị loading
            button.textContent = 'Đang xóa...';
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
                        row.style.animation = 'fadeOut 0.5s';
                        setTimeout(() => {
                            row.remove();
                            // Cập nhật lại số thứ tự
                            updateRowNumbers();
                            showMessage('Xóa bình luận thành công!', 'success');
                        }, 500);
                    }
                } else {
                    // Khôi phục button nếu lỗi
                    button.textContent = originalText;
                    button.disabled = false;
                    showMessage('Có lỗi xảy ra khi xóa bình luận!', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Khôi phục button nếu lỗi
                button.textContent = originalText;
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

    function showMessage(message, type) {
        const messageDiv = document.createElement('div');
        messageDiv.className = type === 'success' ? 'thongbaoloi-1' : 'thongbaoloi-error';
        messageDiv.textContent = message;
        
        const container = document.querySelector('.sanpham');
        const existingMessage = container.querySelector('.thongbaoloi-1, .thongbaoloi-error');
        if (existingMessage) {
            existingMessage.remove();
        }
        
        container.appendChild(messageDiv);
        
        // Tự động ẩn sau 3 giây
        setTimeout(() => {
            messageDiv.remove();
        }, 3000);
    }
</script>   