<?php
// quản lý view và model liên quan đến user
    include_once 'model/connect.php';
    if ( $_GET['act'] ) {
        switch ($_GET['act']) {
            //quản lý đăng nhập 
            case 'login':
                include_once 'model/connect.php';;
                include_once 'model/user.php';
                if(isset($_POST['submit-login'])){
                    $kq = login($_POST['email'], $_POST['matkhau']);
                    if($kq){
                        $_SESSION['user'] = $kq;
                        if( $kq['quyen']=='admin'){
                            header("Location: admin.php");
                        }else{
                            header("Location: index.php"); 
                        }
                    }else{
                        $thongbao = "tài khoản hoặc mật khẩu chưa đúng! vui lòng nhập lại";
                    }
                }
                include_once 'view/template_head.php';
                include_once 'view/template_header.php';
                include_once 'view/page_login.php';
                include_once 'view/template_footer.php';
                break;
            case 'signup':
                include_once 'model/connect.php';;
                include_once 'model/user.php';
                if(isset($_POST['submit-signup'])){
                    $kq = checkMail($_POST['email']);
                    if ($kq) {
                        $thongbao2 = "Email tồn tại. không thể đăng ký!";
                    }
                    else{
                        $kq = signup($_POST['hoten'], $_POST['email'], $_POST['matkhau']);
                        if($kq){
                            header("Location: ?mod=user&act=login");    
                        }
                        else{
                            $thongbao2 = "Có lỗi xảy ra! vui lòng thử lại sao!";
                        }
                    }
                }
                
                include_once 'view/template_head.php';
                include_once 'view/template_header.php';
                include_once 'view/page_signup.php';
                include_once 'view/template_footer.php';
                break;
                //đăng xuất
            case 'logout':
                unset($_SESSION['user']);
                header("Location: index.php");
                break;
                //tài khoản
            case 'user':   
                if (!(isset($_SESSION['user']) && $_SESSION['user']['quyen'] == 'admin')) {
                    header('Location: index.php');
                }
                include_once 'model/user.php'; 
                include_once 'model/connect.php';

                $dstaikhoan = getAllAccounts();

                include_once 'view/template_admin_head.php';
                include_once 'view/template_admin_header.php';
                include_once 'view/product_user.php';
                include_once 'view/template_admin_footer.php';
                break;
                //thêm tài khoản
            case 'add_user':
                if ( !(isset($_SESSION['user']) && $_SESSION['user']['quyen']='admin')) {
                    header('Location: index.php');
                }
                include_once 'model/connect.php';
                include_once 'model/products.php';
                include_once 'model/user.php';
                if(isset($_POST['submit'])){
                    $hoten= $_POST['hoten'];
                    $email= $_POST['email'];
                    $diachi= $_POST['diachi'];
                    $sdt= $_POST['sdt'];
                    $quyen= $_POST['quyen'];
                    $kq = user_checkPhone($sdt);
                    if($kq){//đúng /bị trùng /khong thêm
                        $_SESSION['loi']='không thể tạo tài khoản số điện thoại <strong>'.$sdt.'</strong> này đã tồn tại!';
                    } else{
                        $matkhau = 12345;
                        $anh = 'upload/avatar/default.png';
                        add_user($hoten,$anh,$email,$diachi,$sdt,$matkhau,$quyen);
                        $_SESSION['thongbao']='Đã tạo tài khoản với sdt <strong>'.$sdt.'</strong> và mật khẩu mặc định là <strong>'.$matkhau.'</strong>;';
                    }

                }
                include_once 'view/template_admin_head.php';
                include_once 'view/template_admin_header.php';
                include_once 'view/product_add_taikhoan.php';
                include_once 'view/template_admin_footer.php';
                break;
                //sửa tài khoản
            case 'edit_user':
                if ( !(isset($_SESSION['user']) && $_SESSION['user']['quyen']='admin')) {
                    header('Location: index.php');
                }
                include_once 'model/connect.php';
                include_once 'model/products.php';
                include_once 'model/user.php';
                $makh = $_GET['id'];
                if(isset($_POST['submit-user'])){
                    $hoten= $_POST['hoten'];
                    $anh = $_POST['anh'];
                    $email= $_POST['email'];
                    $diachi= $_POST['diachi'];
                    $sdt= $_POST['sdt'];
                    $matkhau= $_POST['matkhau'];
                    $quyen= $_POST['quyen'];
                    $kq = user_checkPhone($sdt);
                    if($kq && $kq['makh']!=$makh){//đúng /bị trùng /khong sửa 
                        //$kq['makh']!=$makh dc sửa trùng sdt của mình ko dc trùng vs sdt ng khác
                        $_SESSION['loi']='Đã tồn tại số điện thoại <strong>'.$sdt.'</strong>';
                        } else{//đúng /bị trùng / sửa
                            edit_user($makh, $hoten, $anh, $email, $diachi, $sdt, $matkhau, $quyen);
                            $_SESSION['thongbao']='Đã lưu thông tin thay đổi';
                        }

                }
                $tk = get_taikhoan($makh);
                include_once 'view/template_admin_head.php';
                include_once 'view/template_admin_header.php';
                include_once 'view/product_edit_taikhoan.php';
                include_once 'view/template_admin_footer.php';
                break;
                //xoá tài khoản
            case 'delete_user':
               include_once 'model/user.php';
               include_once 'model/connect.php';
               delete_user($_GET['id']);
               header('Location: admin.php?mod=user&act=user');
            break;
            default:
                # 404 - trang web không tồn tại!
                break;
        }
    }
?>  