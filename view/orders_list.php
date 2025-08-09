<style>
    .orders-container {
        padding: 20px;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .orders-header {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }
    
    .orders-header h2 {
        color: #2c3e50;
        margin: 0 0 20px 0;
        font-size: 28px;
        font-weight: 600;
    }
    
    .orders-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 25px;
    }
    
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        text-align: center;
        border-left: 4px solid #3498db;
    }
    
    .stat-card.pending { border-left-color: #f39c12; }
    .stat-card.processing { border-left-color: #3498db; }
    .stat-card.shipping { border-left-color: #9b59b6; }
    .stat-card.completed { border-left-color: #27ae60; }
    
    .stat-number {
        font-size: 24px;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    
    .stat-label {
        color: #7f8c8d;
        font-size: 14px;
    }
    
    .orders-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .search-form {
        display: flex;
        gap: 10px;
    }
    
    .search-form input {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        width: 250px;
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
    
    .filter-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .orders-table {
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
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-gio-hang {
        background: #ecf0f1;
        color: #7f8c8d;
    }
    
    .status-chuan-bi-don-hang {
        background: #fef9e7;
        color: #f39c12;
    }
    
    .status-dang-giao-hang {
        background: #ebf3fd;
        color: #3498db;
    }
    
    .status-da-giao {
        background: #eafaf1;
        color: #27ae60;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #7f8c8d;
    }
    
    .empty-state i {
        font-size: 64px;
        margin-bottom: 20px;
        color: #bdc3c7;
    }
    
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 4px solid;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border-left-color: #27ae60;
    }
    
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border-left-color: #e74c3c;
    }
    
    @media (max-width: 768px) {
        .orders-actions {
            flex-direction: column;
            align-items: stretch;
        }
        
        .filter-buttons {
            justify-content: center;
        }
        
        .search-form {
            justify-content: center;
        }
        
        .search-form input {
            width: 100%;
        }
        
        .table {
            font-size: 12px;
        }
        
        .table th,
        .table td {
            padding: 8px 6px;
        }
        
        .action-buttons {
            flex-direction: column;
        }
    }
    
    /* CSS cho thông báo alert */
    .alert {
        padding: 15px 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        border: 1px solid #b8dacc;
        color: #155724;
    }
    
    .alert-error {
        background: linear-gradient(135deg, #f8d7da, #f1b0b7);
        border: 1px solid #f1b0b7;
        color: #721c24;
    }
</style>

<div class="orders-container">
    <div class="orders-header">
        <h2><i class="fas fa-shopping-cart"></i> Quản lý Đơn hàng</h2>
        
        <!-- Thống kê nhanh -->
        <div class="orders-stats">
            <?php 
            $stats_array = [];
            foreach($statistics as $stat) {
                $stats_array[$stat['trangthai']] = $stat;
            }
            ?>
            <div class="stat-card pending">
                <div class="stat-number"><?= $stats_array['gio-hang']['so_luong'] ?? 0 ?></div>
                <div class="stat-label">Giỏ hàng</div>
            </div>
            <div class="stat-card processing">
                <div class="stat-number"><?= $stats_array['chuan-bi-don-hang']['so_luong'] ?? 0 ?></div>
                <div class="stat-label">Chuẩn bị</div>
            </div>
            <div class="stat-card shipping">
                <div class="stat-number"><?= $stats_array['dang-giao-hang']['so_luong'] ?? 0 ?></div>
                <div class="stat-label">Đang giao</div>
            </div>
            <div class="stat-card completed">
                <div class="stat-number"><?= $stats_array['da-giao']['so_luong'] ?? 0 ?></div>
                <div class="stat-label">Hoàn thành</div>
            </div>
        </div>
    </div>

    <!-- Thông báo -->
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?= $_SESSION['success'] ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i> <?= $_SESSION['error'] ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Các nút hành động -->
    <div class="orders-actions">
        <div class="filter-buttons">
            <a href="admin.php?mod=order&act=list" class="btn btn-primary">
                <i class="fas fa-list"></i> Tất cả
            </a>
            <a href="admin.php?mod=order&act=filter&status=gio-hang" class="btn btn-warning">
                <i class="fas fa-shopping-cart"></i> Giỏ hàng
            </a>
            <a href="admin.php?mod=order&act=filter&status=chuan-bi-don-hang" class="btn btn-primary">
                <i class="fas fa-clock"></i> Chuẩn bị
            </a>
            <a href="admin.php?mod=order&act=filter&status=dang-giao-hang" class="btn btn-warning">
                <i class="fas fa-truck"></i> Đang giao
            </a>
            <a href="admin.php?mod=order&act=filter&status=da-giao" class="btn btn-success">
                <i class="fas fa-check"></i> Hoàn thành
            </a>
        </div>

        <form method="POST" action="admin.php?mod=order&act=search" class="search-form">
            <input type="text" name="keyword" placeholder="Tìm kiếm theo mã đơn, tên khách hàng, email..." 
                   value="<?= isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : '' ?>">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Tìm kiếm
            </button>
        </form>
    </div>

    <!-- Bảng đơn hàng -->
    <div class="orders-table">
        <?php if(!empty($orders)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Mã ĐH</th>
                    <th>Khách hàng</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders as $order): ?>
                <tr>
                    <td><strong>#<?= $order['mahd'] ?></strong></td>
                    <td><?= htmlspecialchars($order['hoten']) ?></td>
                    <td><?= htmlspecialchars($order['email']) ?></td>
                    <td><?= htmlspecialchars($order['sdt']) ?></td>
                    <td><?= date('d/m/Y', strtotime($order['ngaydathang'])) ?></td>
                    <td><strong><?= number_format(isset($order['calculated_total']) ? $order['calculated_total'] : $order['tongtien']) ?>đ</strong></td>
                    <td>
                        <span class="status-badge status-<?= $order['trangthai'] ?>">
                            <?php
                            switch($order['trangthai']) {
                                case 'gio-hang': echo 'Giỏ hàng'; break;
                                case 'chuan-bi-don-hang': echo 'Chuẩn bị'; break;
                                case 'dang-giao-hang': echo 'Đang giao'; break;
                                case 'da-giao': echo 'Hoàn thành'; break;
                                default: echo $order['trangthai'];
                            }
                            ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="admin.php?mod=order&act=detail&id=<?= $order['mahd'] ?>" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> Chi tiết
                            </a>
                            <a href="admin.php?mod=order&act=edit&id=<?= $order['mahd'] ?>" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <a href="admin.php?mod=order&act=delete&id=<?= $order['mahd'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-shopping-cart"></i>
            <h3>Không có đơn hàng nào</h3>
            <p>Chưa có đơn hàng nào trong hệ thống hoặc không tìm thấy kết quả phù hợp.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Tự động ẩn thông báo sau 5 giây
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        alert.style.opacity = '0';
        setTimeout(function() {
            alert.remove();
        }, 300);
    });
}, 5000);
</script>
