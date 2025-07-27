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
            
            //đổi mật khẩu
            case 'change_password':
                if (!isset($_SESSION['user'])) {
                    header('Location: ?mod=user&act=login');
                    exit();
                }
                include_once 'model/user.php';
                
                if(isset($_POST['submit-change-password'])){
                    $old_password = $_POST['old_password'];
                    $new_password = $_POST['new_password'];
                    $confirm_password = $_POST['confirm_password'];
                    
                    // Kiểm tra mật khẩu cũ
                    $user = login($_SESSION['user']['email'], $old_password);
                    if(!$user){
                        $error = "Mật khẩu cũ không đúng!";
                    } elseif($new_password !== $confirm_password) {
                        $error = "Mật khẩu mới không khớp!";
                    } elseif(strlen($new_password) < 6) {
                        $error = "Mật khẩu mới phải có ít nhất 6 ký tự!";
                    } else {
                        // Cập nhật mật khẩu
                        change_password($_SESSION['user']['makh'], $new_password);
                        $success = "Đổi mật khẩu thành công!";
                    }
                }
                
                include_once 'view/template_head.php';
                include_once 'view/template_header.php';
                include_once 'view/page_change_password.php';
                include_once 'view/template_footer.php';
                break;
                
            //hiển thị thông tin cá nhân
            case 'profile':
                if (!isset($_SESSION['user'])) {
                    header('Location: ?mod=user&act=login');
                    exit();
                }
                include_once 'model/user.php';
                
                // Lấy thông tin user hiện tại
                $user = get_taikhoan($_SESSION['user']['makh']);
                
                // Lấy thống kê hoạt động
                $order_count = get_user_order_count($_SESSION['user']['makh']);
                $comment_count = get_user_comment_count($_SESSION['user']['makh']);
                
                include_once 'view/template_head.php';
                include_once 'view/template_header.php';
                include_once 'view/page_user_profile.php';
                include_once 'view/template_footer.php';
                break;
                
            //chỉnh sửa thông tin cá nhân
            case 'edit_profile':
                if (!isset($_SESSION['user'])) {
                    header('Location: ?mod=user&act=login');
                    exit();
                }
                include_once 'model/user.php';
                
                // Lấy thông tin user hiện tại
                $user = get_taikhoan($_SESSION['user']['makh']);
                
                if(isset($_POST['submit-profile'])){
                    $ho = trim($_POST['ho']);
                    $ten = trim($_POST['ten']);
                    $hoten = $ho . ' ' . $ten; // Ghép họ và tên
                    $email = trim($_POST['email']);
                    $so_dien_thoai = trim($_POST['so_dien_thoai']);
                    $dia_chi = trim($_POST['dia_chi']);
                    
                    // Kiểm tra email trùng
                    if($email != $user['email']) {
                        $check_email = user_checkEmail($email);
                        if($check_email && $check_email['makh'] != $_SESSION['user']['makh']){
                            $error = "Email đã được sử dụng!";
                        }
                    }
                    
                    // Kiểm tra số điện thoại trùng
                    if($so_dien_thoai != $user['sdt']) {
                        $check_phone = user_checkPhone($so_dien_thoai);
                        if($check_phone && $check_phone['makh'] != $_SESSION['user']['makh']){
                            $error = "Số điện thoại đã được sử dụng!";
                        }
                    }
                    
                    // Xử lý upload avatar
                    $avatar = $user['anh']; // Giữ avatar cũ mặc định
                    if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                        $max_size = 2 * 1024 * 1024; // 2MB
                        
                        if(!in_array($_FILES['avatar']['type'], $allowed_types)) {
                            $error = "Định dạng file không được hỗ trợ!";
                        } elseif($_FILES['avatar']['size'] > $max_size) {
                            $error = "File quá lớn! Tối đa 2MB.";
                        } else {
                            $upload_dir = "upload/avatar/";
                            if(!file_exists($upload_dir)) {
                                mkdir($upload_dir, 0755, true);
                            }
                            
                            $file_extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                            $avatar = time() . "_" . $_SESSION['user']['makh'] . "." . $file_extension;
                            $upload_path = $upload_dir . $avatar;
                            
                            if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_path)) {
                                $error = "Lỗi khi upload file!";
                                $avatar = $user['anh']; // Giữ avatar cũ
                            }
                        }
                    }
                    
                    if(!isset($error)) {
                        // Cập nhật thông tin
                        update_profile($_SESSION['user']['makh'], $hoten, $email, $dia_chi, $so_dien_thoai, $avatar);
                        
                        // Cập nhật session
                        $_SESSION['user']['hoten'] = $hoten;
                        $_SESSION['user']['email'] = $email;
                        $_SESSION['user']['sdt'] = $so_dien_thoai;
                        $_SESSION['user']['diachi'] = $dia_chi;
                        $_SESSION['user']['anh'] = $avatar;
                        
                        // Lấy lại thông tin user để hiển thị
                        $user = get_taikhoan($_SESSION['user']['makh']);
                        $success = "Cập nhật thông tin thành công!";
                    }
                }
                
                include_once 'view/template_head.php';
                include_once 'view/template_header.php';
                include_once 'view/page_profile.php';
                include_once 'view/template_footer.php';
                break;
            default:
                # 404 - trang web không tồn tại!
                break;
        }
    }
?>  