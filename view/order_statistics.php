<style>
    .statistics-container {
        padding: 20px;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .stats-header {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }
    
    .stats-header h2 {
        color: #2c3e50;
        margin: 0;
        font-size: 28px;
        font-weight: 600;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border-left: 4px solid;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    
    .stat-card.total { border-left-color: #3498db; }
    .stat-card.pending { border-left-color: #f39c12; }
    .stat-card.processing { border-left-color: #9b59b6; }
    .stat-card.completed { border-left-color: #27ae60; }
    
    .stat-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
    }
    
    .stat-card.total .stat-icon { background: #3498db; }
    .stat-card.pending .stat-icon { background: #f39c12; }
    .stat-card.processing .stat-icon { background: #9b59b6; }
    .stat-card.completed .stat-icon { background: #27ae60; }
    
    .stat-content h3 {
        margin: 0;
        color: #2c3e50;
        font-size: 16px;
        font-weight: 600;
    }
    
    .stat-number {
        font-size: 32px;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    
    .stat-subtitle {
        color: #7f8c8d;
        font-size: 14px;
        margin: 0;
    }
    
    .charts-section {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
        margin-bottom: 30px;
    }
    
    .chart-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    .chart-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .chart-header h3 {
        margin: 0;
        color: #2c3e50;
        font-size: 20px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .revenue-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .revenue-table th,
    .revenue-table td {
        padding: 12px 8px;
        text-align: left;
        border-bottom: 1px solid #f1f2f6;
    }
    
    .revenue-table th {
        background: #f8f9fa;
        font-weight: 600;
        color: #555;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .revenue-table tbody tr:hover {
        background-color: #f8f9ff;
    }
    
    .tables-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }
    
    .table-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .table-header {
        padding: 20px 25px;
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
    }
    
    .table-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .table-content {
        padding: 0;
        max-height: 400px;
        overflow-y: auto;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .data-table th,
    .data-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #f1f2f6;
        font-size: 13px;
    }
    
    .data-table tbody tr:hover {
        background-color: #f8f9ff;
    }
    
    .customer-info {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    
    .customer-name {
        font-weight: 600;
        color: #2c3e50;
    }
    
    .customer-email {
        color: #7f8c8d;
        font-size: 12px;
    }
    
    .product-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .product-image {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #e9ecef;
    }
    
    .product-details {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    
    .product-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 12px;
    }
    
    .product-sales {
        color: #7f8c8d;
        font-size: 11px;
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
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .actions-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #7f8c8d;
    }
    
    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        color: #bdc3c7;
    }
    
    @media (max-width: 768px) {
        .charts-section,
        .tables-section {
            grid-template-columns: 1fr;
        }
        
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
        
        .actions-bar {
            flex-direction: column;
            gap: 15px;
        }
    }
</style>

<div class="statistics-container">
    <!-- Header -->
    <div class="stats-header">
        <h2><i class="fas fa-chart-bar"></i> Thống kê Đơn hàng</h2>
    </div>

    <!-- Actions -->
    <div class="actions-bar">
        <div>
            <a href="admin.php?mod=order&act=list" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
        <div style="color: #7f8c8d; font-size: 14px;">
            Cập nhật lần cuối: <?= date('d/m/Y H:i') ?>
        </div>
    </div>

    <!-- Thống kê tổng quan -->
    <div class="stats-grid">
        <?php 
        $total_orders = 0;
        $total_revenue = 0;
        $stats_breakdown = [];
        
        foreach($statistics as $stat) {
            $total_orders += $stat['so_luong'];
            $total_revenue += $stat['tong_tien'] ?? 0;
            $stats_breakdown[$stat['trangthai']] = $stat;
        }
        ?>
        
        <div class="stat-card total">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-content">
                    <h3>Tổng đơn hàng</h3>
                </div>
            </div>
            <div class="stat-number"><?= $total_orders ?></div>
            <p class="stat-subtitle">Tổng doanh thu: <?= number_format($total_revenue * 1000) ?>đ</p>
        </div>

        <div class="stat-card pending">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>Chờ xử lý</h3>
                </div>
            </div>
            <div class="stat-number"><?= $stats_breakdown['chuan-bi-don-hang']['so_luong'] ?? 0 ?></div>
            <p class="stat-subtitle">Cần xử lý sớm</p>
        </div>

        <div class="stat-card processing">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="stat-content">
                    <h3>Đang giao</h3>
                </div>
            </div>
            <div class="stat-number"><?= $stats_breakdown['dang-giao-hang']['so_luong'] ?? 0 ?></div>
            <p class="stat-subtitle">Đang vận chuyển</p>
        </div>

        <div class="stat-card completed">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>Hoàn thành</h3>
                </div>
            </div>
            <div class="stat-number"><?= $stats_breakdown['da-giao']['so_luong'] ?? 0 ?></div>
            <p class="stat-subtitle">Giao hàng thành công</p>
        </div>
    </div>

    <!-- Biểu đồ và doanh thu -->
    <div class="charts-section">
        <div class="chart-card">
            <div class="chart-header">
                <h3><i class="fas fa-calendar-week"></i> Doanh thu 7 ngày gần đây</h3>
            </div>
            <?php if(!empty($revenue_data)): ?>
            <table class="revenue-table">
                <thead>
                    <tr>
                        <th>Ngày</th>
                        <th>Số đơn</th>
                        <th>Doanh thu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($revenue_data as $data): ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($data['ngay'])) ?></td>
                        <td><?= $data['so_don'] ?> đơn</td>
                        <td><strong><?= number_format($data['doanh_thu'] * 1000) ?>đ</strong></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-chart-line"></i>
                <p>Chưa có dữ liệu doanh thu</p>
            </div>
            <?php endif; ?>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <h3><i class="fas fa-pie-chart"></i> Phân bố trạng thái</h3>
            </div>
            <div style="padding: 20px 0;">
                <?php foreach($statistics as $stat): ?>
                <?php 
                $percentage = $total_orders > 0 ? round(($stat['so_luong'] / $total_orders) * 100, 1) : 0;
                $status_name = '';
                $color = '';
                switch($stat['trangthai']) {
                    case 'gio-hang': 
                        $status_name = 'Giỏ hàng';
                        $color = '#95a5a6';
                        break;
                    case 'chuan-bi-don-hang': 
                        $status_name = 'Chuẩn bị';
                        $color = '#f39c12';
                        break;
                    case 'dang-giao-hang': 
                        $status_name = 'Đang giao';
                        $color = '#9b59b6';
                        break;
                    case 'da-giao': 
                        $status_name = 'Hoàn thành';
                        $color = '#27ae60';
                        break;
                }
                ?>
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 12px; height: 12px; border-radius: 50%; background: <?= $color ?>;"></div>
                        <span style="font-size: 14px; color: #555;"><?= $status_name ?></span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-weight: 600; color: #2c3e50;"><?= $stat['so_luong'] ?></span>
                        <span style="font-size: 12px; color: #7f8c8d;">(<?= $percentage ?>%)</span>
                    </div>
                </div>
                <div style="width: 100%; height: 4px; background: #ecf0f1; border-radius: 2px; margin-bottom: 15px;">
                    <div style="width: <?= $percentage ?>%; height: 100%; background: <?= $color ?>; border-radius: 2px;"></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Bảng top khách hàng và sản phẩm -->
    <div class="tables-section">
        <div class="table-card">
            <div class="table-header">
                <h3><i class="fas fa-users"></i> Top khách hàng</h3>
            </div>
            <div class="table-content">
                <?php if(!empty($top_customers)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Khách hàng</th>
                            <th>Số đơn</th>
                            <th>Tổng chi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($top_customers as $customer): ?>
                        <tr>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-name"><?= htmlspecialchars($customer['hoten']) ?></div>
                                    <div class="customer-email"><?= htmlspecialchars($customer['email']) ?></div>
                                </div>
                            </td>
                            <td><?= $customer['so_don'] ?></td>
                            <td><strong><?= number_format($customer['tong_chi_tieu'] * 1000) ?>đ</strong></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-user-slash"></i>
                    <p>Chưa có dữ liệu khách hàng</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="table-card">
            <div class="table-header">
                <h3><i class="fas fa-fire"></i> Sản phẩm bán chạy</h3>
            </div>
            <div class="table-content">
                <?php if(!empty($best_products)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Đã bán</th>
                            <th>Doanh thu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($best_products as $product): ?>
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="upload/product/<?= $product['anh'] ?>" alt="" class="product-image">
                                    <div class="product-details">
                                        <div class="product-name"><?= htmlspecialchars($product['tensp']) ?></div>
                                        <div class="product-sales">ID: <?= $product['masp'] ?></div>
                                    </div>
                                </div>
                            </td>
                            <td><?= $product['tong_ban'] ?></td>
                            <td><strong><?= number_format($product['doanh_thu'] * 1000) ?>đ</strong></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <p>Chưa có dữ liệu bán hàng</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
