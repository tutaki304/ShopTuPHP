<?php
//quản lý view và model liên quan: trang chủ,liên hệ, giới thiệu...
//gọi dc: view, model
    include_once 'model/connect.php';
    include_once 'view/template_head.php';
    include_once 'view/template_header.php';

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
                    $ctgiohang = get_cart($makh);
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
                include_once 'model/binhluan.php';
                $ds_binhluan = get_binhluan();
                include_once 'view/product_binhluan.php';
                break;
             case 'delete_binhluan':
               include_once 'model/binhluan.php';
               delete_binhluan($_GET['id']);
               header('Location: admin.php?mod=page&act=admin_binhluan');
            break;
             
            default:
                # 404 - trang web không tồn tại!
                break;
        }
    }
    include_once 'view/template_footer.php';
?>