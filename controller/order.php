<?php
// Controller quản lý đơn hàng
include_once 'model/connect.php';
include_once 'model/orders.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['user']) || $_SESSION['user']['quyen'] != 'admin') {
    header('Location: index.php');
    exit;
}

if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'list':
            // Hiển thị danh sách đơn hàng
            $orders = get_all_orders();
            $statistics = get_order_statistics();
            
            include_once 'view/template_admin_head.php';
            include_once 'view/template_admin_header.php';
            include_once 'view/orders_list.php';
            include_once 'view/template_admin_footer.php';
            break;
            
        case 'detail':
            // Xem chi tiết đơn hàng
            if (isset($_GET['id'])) {
                $mahd = $_GET['id'];
                $order = get_order_by_id($mahd);
                $order_details = get_order_details($mahd);
                
                if ($order) {
                    include_once 'view/template_admin_head.php';
                    include_once 'view/template_admin_header.php';
                    include_once 'view/order_detail.php';
                    include_once 'view/template_admin_footer.php';
                } else {
                    $_SESSION['error'] = "Không tìm thấy đơn hàng!";
                    header('Location: admin.php?mod=order&act=list');
                }
            } else {
                header('Location: admin.php?mod=order&act=list');
            }
            break;
            
        case 'update_status':
            // Cập nhật trạng thái đơn hàng
            if (isset($_POST['mahd']) && isset($_POST['trangthai'])) {
                $mahd = $_POST['mahd'];
                $trangthai = $_POST['trangthai'];
                
                if (update_order_status($mahd, $trangthai)) {
                    $_SESSION['success'] = "Cập nhật trạng thái đơn hàng thành công!";
                } else {
                    $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật trạng thái!";
                }
            }
            
            if (isset($_GET['redirect'])) {
                header('Location: admin.php?mod=order&act=detail&id=' . $mahd);
            } else {
                header('Location: admin.php?mod=order&act=list');
            }
            break;
            
        case 'delete':
            // Xóa đơn hàng
            if (isset($_GET['id'])) {
                $mahd = $_GET['id'];
                
                if (delete_order($mahd)) {
                    $_SESSION['success'] = "Xóa đơn hàng thành công!";
                } else {
                    $_SESSION['error'] = "Có lỗi xảy ra khi xóa đơn hàng!";
                }
            }
            header('Location: admin.php?mod=order&act=list');
            break;
            
        case 'search':
            // Tìm kiếm đơn hàng
            $orders = [];
            $statistics = get_order_statistics();
            
            if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
                $keyword = $_POST['keyword'];
                $orders = search_orders($keyword);
            }
            
            include_once 'view/template_admin_head.php';
            include_once 'view/template_admin_header.php';
            include_once 'view/orders_list.php';
            include_once 'view/template_admin_footer.php';
            break;
            
        case 'filter':
            // Lọc đơn hàng theo trạng thái
            $statistics = get_order_statistics();
            
            if (isset($_GET['status'])) {
                $status = $_GET['status'];
                $orders = get_orders_by_status($status);
            } else {
                $orders = get_all_orders();
            }
            
            include_once 'view/template_admin_head.php';
            include_once 'view/template_admin_header.php';
            include_once 'view/orders_list.php';
            include_once 'view/template_admin_footer.php';
            break;
            
        case 'edit':
            // Chỉnh sửa thông tin đơn hàng
            if (isset($_GET['id'])) {
                $mahd = $_GET['id'];
                $order = get_order_by_id($mahd);
                
                if (isset($_POST['submit'])) {
                    $ghichu = $_POST['ghichu'];
                    $tongtien = $_POST['tongtien'];
                    
                    if (update_order_info($mahd, $ghichu, $tongtien)) {
                        $_SESSION['success'] = "Cập nhật thông tin đơn hàng thành công!";
                        header('Location: admin.php?mod=order&act=detail&id=' . $mahd);
                        exit;
                    } else {
                        $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật thông tin!";
                    }
                }
                
                if ($order) {
                    include_once 'view/template_admin_head.php';
                    include_once 'view/template_admin_header.php';
                    include_once 'view/order_edit.php';
                    include_once 'view/template_admin_footer.php';
                } else {
                    $_SESSION['error'] = "Không tìm thấy đơn hàng!";
                    header('Location: admin.php?mod=order&act=list');
                }
            } else {
                header('Location: admin.php?mod=order&act=list');
            }
            break;
            
        case 'statistics':
            // Thống kê đơn hàng
            $statistics = get_order_statistics();
            $top_customers = get_top_customers(10);
            $best_products = get_best_selling_products(10);
            
            // Doanh thu 7 ngày gần đây
            $end_date = date('Y-m-d');
            $start_date = date('Y-m-d', strtotime('-7 days'));
            $revenue_data = get_revenue_by_period($start_date, $end_date);
            
            include_once 'view/template_admin_head.php';
            include_once 'view/template_admin_header.php';
            include_once 'view/order_statistics.php';
            include_once 'view/template_admin_footer.php';
            break;
            
        default:
            header('Location: admin.php?mod=order&act=list');
            break;
    }
} else {
    header('Location: admin.php?mod=order&act=list');
}
?>
