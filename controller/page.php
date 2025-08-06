<?php
//quản lý view và model liên quan: trang chủ,liên hệ, giới thiệu...
//gọi dc: view, model
    include_once 'model/connect.php';
    
    // Chỉ load template cho trang user, không load cho admin pages
    $admin_pages = ['dashboard', 'admin_binhluan', 'quan_ly_binh_luan', 'delete_binhluan'];
    if (!isset($_GET['act']) || !in_array($_GET['act'], $admin_pages)) {
        include_once 'view/template_head.php';
        include_once 'view/template_header.php';
    }

    if ( $_GET['act'] ) {
        switch ($_GET['act']) {
            case 'home':
                include_once 'model/products.php';
                include_once 'model/categories.php';
                $data['dssp']= get_products();
                $dsNew = get_productNew(4);
                
                include_once 'view/page_home.php';
                
                break;
            case 'giohang':
                include_once 'model/cart.php';
                include_once 'model/products.php';
                if (isset($_SESSION['user']) && isset($_SESSION['user']['makh'])) {
                    $makh = $_SESSION['user']['makh'];
                }
                $giohang = get_hasCart($makh);
                if( $giohang ){
                    $ctgiohang = get_Cart($makh);
                }else{
                    $ctgiohang = [];
                }


                include_once 'view/page_giohang.php';
                break;
            case 'about':
                include_once 'view/page_abuot.php';
                break;
            case 'contact':
                include_once 'view/page_contact.php';
                break;
            case 'gioithieu':
                include_once 'view/page_gioithieu.php';
                break;
            case 'dashboard':
                if ( !(isset($_SESSION['user']) && $_SESSION['user']['quyen']='admin')) {
                    header('Location: index.php');
                }
                include_once 'view/page_dashboard.php';
                break;
            case 'admin_binhluan':
                if (!isset($_SESSION['user']) || $_SESSION['user']['quyen'] != 'admin') {
                    header('Location: index.php');
                    exit;
                }
                include_once 'model/binhluan.php';
                try {
                    $ds_binhluan = get_binhluan();
                    if(empty($ds_binhluan)) {
                        $_SESSION['thongbao'] = "Chưa có bình luận nào!";
                    }
                } catch(Exception $e) {
                    $_SESSION['thongbao'] = "Lỗi khi tải danh sách bình luận: " . $e->getMessage();
                    $ds_binhluan = [];
                }
                include_once 'view/template_admin_head.php';
                include_once 'view/template_admin_header.php';
                include_once 'view/admin_binhluan.php';
                include_once 'view/template_admin_footer.php';
                break;
            case 'quan_ly_binh_luan':
                // Trang quản lý bình luận mới với giao diện đẹp
                if (!isset($_SESSION['user']) || $_SESSION['user']['quyen'] != 'admin') {
                    header('Location: index.php');
                    exit;
                }
                include_once 'model/binhluan.php';
                try {
                    $ds_binhluan = get_binhluan();
                    if(empty($ds_binhluan)) {
                        $_SESSION['thongbao'] = "Chưa có bình luận nào!";
                    }
                } catch(Exception $e) {
                    $_SESSION['thongbao'] = "Lỗi khi tải danh sách bình luận: " . $e->getMessage();
                    $ds_binhluan = [];
                }
                include_once 'view/template_admin_head.php';
                include_once 'view/template_admin_header.php';
                include_once 'view/admin_binhluan.php';
                include_once 'view/template_admin_footer.php';
                break;
             case 'delete_binhluan':
               include_once 'model/binhluan.php';
               if(isset($_GET['id']) && !empty($_GET['id'])) {
                   try {
                       delete_binhluan($_GET['id']);
                       // Kiểm tra nếu là AJAX request thì chỉ trả về status
                       if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                           echo "success";
                           exit;
                       }
                       $_SESSION['thongbao'] = "Xóa bình luận thành công!";
                   } catch(Exception $e) {
                       if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                           echo "error";
                           exit;
                       }
                       $_SESSION['thongbao'] = "Lỗi khi xóa bình luận: " . $e->getMessage();
                   }
               } else {
                   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                       echo "error";
                       exit;
                   }
                   $_SESSION['thongbao'] = "Không tìm thấy ID bình luận!";
               }
               header('Location: admin.php?mod=page&act=quan_ly_binh_luan');
            break;
             
            default:
                # 404 - trang web không tồn tại!
                break;
        }
    }
    
    // Chỉ load footer cho trang user, không load cho dashboard admin
    if (!isset($_GET['act']) || $_GET['act'] !== 'dashboard') {
        include_once 'view/template_footer.php';
    }
?>