<?php
    session_start();
//điều hướng các controller
    // Kiểm tra mod từ GET hoặc POST
    $mod = isset($_GET['mod']) ? $_GET['mod'] : (isset($_POST['mod']) ? $_POST['mod'] : '');
    
    if (!empty($mod)) {
        switch ($mod) {
            case 'page':
                include_once 'controller/page.php';
                    break;
            case 'user':
                include_once 'controller/user.php';
                    break;
            case 'cart':
                include_once 'controller/cart.php';
                    break;
            case 'product':
                include_once 'controller/product.php';
                    break;
            case 'catrgories':
                include_once 'controller/catrgories.php';
                    break;
            default:
                header("Location: ?mod=page&act=home");
                break;
        }
    }else{
        header("Location: ?mod=page&act=home");
    }
?>
