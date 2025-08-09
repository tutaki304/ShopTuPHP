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
                if ( !(isset($_SESSION['user']) && $_SESSION['user']['quyen']=='admin')) {
                    header('Location: index.php');
                    exit();
                }
                include_once 'model/connect.php';
                include_once 'model/user.php';
                if(isset($_POST['submit'])){
                    $hoten = trim($_POST['hoten']);
                    $email = trim($_POST['email']);
                    $diachi = trim($_POST['diachi']);
                    $sdt = trim($_POST['sdt']);
                    $matkhau = !empty($_POST['matkhau']) ? $_POST['matkhau'] : '12345';
                    $quyen = $_POST['quyen'];
                    
                    // Xử lý ảnh đại diện
                    $anh = 'assets_user/img/default-avatar.png'; // Ảnh mặc định
                    
                    // Kiểm tra upload file
                    if(isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
                        $upload_dir = 'upload/avatar/';
                        if (!file_exists($upload_dir)) {
                            mkdir($upload_dir, 0777, true);
                        }
                        
                        $file_name = $_FILES['anh']['name'];
                        $file_tmp = $_FILES['anh']['tmp_name'];
                        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                        
                        // Kiểm tra định dạng file
                        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
                        if(in_array($file_ext, $allowed_exts)) {
                            // Kiểm tra kích thước file (5MB)
                            if($_FILES['anh']['size'] <= 5 * 1024 * 1024) {
                                $new_file_name = 'avatar_' . time() . '_' . uniqid() . '.' . $file_ext;
                                $upload_path = $upload_dir . $new_file_name;
                                
                                if(move_uploaded_file($file_tmp, $upload_path)) {
                                    $anh = $upload_path;
                                } else {
                                    $_SESSION['loi'] = 'Không thể tải lên ảnh!';
                                }
                            } else {
                                $_SESSION['loi'] = 'Kích thước ảnh quá lớn! Tối đa 5MB.';
                            }
                        } else {
                            $_SESSION['loi'] = 'Chỉ chấp nhận file ảnh JPG, PNG, GIF!';
                        }
                    } 
                    // Kiểm tra link ảnh
                    else if(!empty($_POST['anh_link'])) {
                        $anh = trim($_POST['anh_link']);
                    }
                    
                    // Validate dữ liệu
                    if(empty($hoten) || empty($email) || empty($sdt) || empty($quyen)) {
                        $_SESSION['loi'] = 'Vui lòng điền đầy đủ thông tin bắt buộc!';
                    } else if(!isset($_SESSION['loi'])) { // Chỉ kiểm tra nếu không có lỗi upload
                        // Kiểm tra email đã tồn tại
                        $check_email = user_checkEmail($email);
                        if($check_email) {
                            $_SESSION['loi'] = 'Email <strong>'.$email.'</strong> đã tồn tại trong hệ thống!';
                        } else {
                            // Kiểm tra số điện thoại đã tồn tại
                            $kq = user_checkPhone($sdt);
                            if($kq) {
                                $_SESSION['loi'] = 'Số điện thoại <strong>'.$sdt.'</strong> đã tồn tại trong hệ thống!';
                            } else {
                                // Tạo tài khoản thành công
                                add_user($hoten, $anh, $email, $diachi, $sdt, $matkhau, $quyen);
                                $role_text = ($quyen == 'admin') ? 'Quản trị viên' : 'Khách hàng';
                                $_SESSION['thongbao'] = 'Đã tạo tài khoản <strong>'.$role_text.'</strong> thành công!<br>Email: <strong>'.$email.'</strong><br>Mật khẩu: <strong>'.$matkhau.'</strong>';
                            }
                        }
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
                    $hoten = trim($_POST['hoten']);
                    $email = trim($_POST['email']);
                    $diachi = trim($_POST['diachi']);
                    $sdt = trim($_POST['sdt']);
                    $matkhau = $_POST['matkhau'];
                    $quyen = $_POST['quyen'];
                    
                    // Lấy thông tin tài khoản hiện tại
                    $current_user = get_taikhoan($makh);
                    $anh = $current_user['anh']; // Mặc định giữ ảnh cũ
                    
                    // Xử lý ảnh đại diện
                    if(isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
                        // Upload file mới
                        $upload_dir = 'upload/avatar/';
                        if (!file_exists($upload_dir)) {
                            mkdir($upload_dir, 0777, true);
                        }
                        
                        $file_name = $_FILES['anh']['name'];
                        $file_tmp = $_FILES['anh']['tmp_name'];
                        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                        
                        // Kiểm tra định dạng file
                        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
                        if(in_array($file_ext, $allowed_exts)) {
                            // Kiểm tra kích thước file (5MB)
                            if($_FILES['anh']['size'] <= 5 * 1024 * 1024) {
                                $new_file_name = 'avatar_' . time() . '_' . uniqid() . '.' . $file_ext;
                                $upload_path = $upload_dir . $new_file_name;
                                
                                if(move_uploaded_file($file_tmp, $upload_path)) {
                                    // Xóa ảnh cũ nếu không phải ảnh mặc định
                                    if($current_user['anh'] && !strpos($current_user['anh'], 'default') && file_exists($current_user['anh'])) {
                                        unlink($current_user['anh']);
                                    }
                                    $anh = $upload_path;
                                } else {
                                    $_SESSION['loi'] = 'Không thể tải lên ảnh mới!';
                                }
                            } else {
                                $_SESSION['loi'] = 'Kích thước ảnh quá lớn! Tối đa 5MB.';
                            }
                        } else {
                            $_SESSION['loi'] = 'Chỉ chấp nhận file ảnh JPG, PNG, GIF!';
                        }
                    } 
                    // Kiểm tra link ảnh mới
                    else if(!empty($_POST['anh_link'])) {
                        $anh = trim($_POST['anh_link']);
                    }
                    // Nếu không có lỗi, tiếp tục validate và cập nhật
                    if(!isset($_SESSION['loi'])) {
                        $kq = user_checkPhone($sdt);
                        if($kq && $kq['makh']!=$makh){//đúng /bị trùng /khong sửa 
                            //$kq['makh']!=$makh dc sửa trùng sdt của mình ko dc trùng vs sdt ng khác
                            $_SESSION['loi']='Đã tồn tại số điện thoại <strong>'.$sdt.'</strong>';
                        } else{//đúng /bị trùng / sửa
                            edit_user($makh, $hoten, $anh, $email, $diachi, $sdt, $matkhau, $quyen);
                            $_SESSION['thongbao']='Đã lưu thông tin thay đổi';
                        }
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
               $result = delete_user($_GET['id']);
               if ($result === false) {
                   // Thông báo lỗi nếu cố gắng xóa admin
                   $_SESSION['error_message'] = "Không thể xóa tài khoản Admin!";
               } else {
                   $_SESSION['success_message'] = "Đã xóa tài khoản thành công!";
               }
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
                
            case 'orders':
                // Xem đơn hàng đã đặt
                if (!isset($_SESSION['user'])) {
                    header('Location: ?mod=user&act=login');
                    exit();
                }
                include_once 'model/orders.php';
                
                // Lấy danh sách đơn hàng của user
                $user_orders = get_user_orders($_SESSION['user']['makh']);
                
                include_once 'view/template_head.php';
                include_once 'view/template_header.php';
                include_once 'view/page_user_orders.php';
                include_once 'view/template_footer.php';
                break;
                
            case 'order_detail':
                // Xem chi tiết đơn hàng
                if (!isset($_SESSION['user'])) {
                    header('Location: ?mod=user&act=login');
                    exit();
                }
                
                if (isset($_GET['id'])) {
                    include_once 'model/orders.php';
                    $mahd = $_GET['id'];
                    $order = get_order_by_id($mahd);
                    
                    // Kiểm tra quyền xem đơn hàng (chỉ được xem đơn hàng của mình)
                    if ($order && $order['makh'] == $_SESSION['user']['makh']) {
                        $order_details = get_order_details($mahd);
                        
                        include_once 'view/template_head.php';
                        include_once 'view/template_header.php';
                        include_once 'view/page_user_order_detail.php';
                        include_once 'view/template_footer.php';
                    } else {
                        $_SESSION['error'] = "Bạn không có quyền xem đơn hàng này!";
                        header('Location: ?mod=user&act=orders');
                    }
                } else {
                    header('Location: ?mod=user&act=orders');
                }
                break;
                
            default:
                # 404 - trang web không tồn tại!
                break;
        }
    }
?>  