<?php
include_once 'model/connect.php';
if($titl){

}else{
    
}
include_once 'view/template_head.php';
include_once 'view/template_header.php';

if ($_GET['act']) {
    switch ($_GET['act']) {
        //trang chi tiết sản phẩm
        case 'ctsanpham':
            include_once 'model/connect.php';
            include_once 'model/products.php';
            
            $ctsanpham = get_product($_GET['id']);
            $spcungdanhmuc = get_randomByCategories($ctsanpham['madm']);
            ($ctsanpham['madm']);
            include_once 'model/binhluan.php';
            $dsbinhluan = comment_Sanpham($_GET['id']);

            include_once 'view/template_head.php';
            include_once 'view/template_header.php';
            include_once 'view/page_ctsanpham.php';
            include_once 'view/template_footer.php';
            break;
            //hiển thị sản phẩm
        case 'sanpham':
            include_once 'model/connect.php';
            include_once 'model/categories.php';
            include_once 'model/products.php';
            $data['dsdm']= get_categories();
            $data['dssp']= get_products();
           
            include_once 'view/page_sanpham.php';
            include_once 'view/template_footer.php';
            break;
         case 'admin_danhmuc':
            include_once 'model/connect.php';
            include_once 'model/categories.php';
            include_once 'model/products.php';
            $ds_admin_danhmuc = get_danhmuc();
            include_once 'view/template_admin_head.php';
            include_once 'view/template_admin_header.php';
            include_once 'view/product_danhmuc.php';
            include_once 'view/template_admin_footer.php';
            break;
        case 'add_danhmuc':
                if ( !(isset($_SESSION['user']) && $_SESSION['user']['quyen']='admin')) {
                    header('Location: index.php');
                }
                include_once 'model/connect.php';
                include_once 'model/categories.php';
                if(isset($_POST['submit'])){
                    $dm = add_danhmuc(
                        $_POST['tendm'],
                        $_POST['soluongsp'],
                        $_POST['thutu']
                    );
                    $_SESSION['thongbao'] = 'Đã thêm danh mục';
                }

                include_once 'view/template_admin_head.php';
                include_once 'view/template_admin_header.php';
                include_once 'view/product_add_danhmuc.php';
                include_once 'view/template_admin_footer.php';
                break;
        case 'edit_danhmuc':
                if ( !(isset($_SESSION['user']) && $_SESSION['user']['quyen']='admin')) {
                    header('Location: index.php');
                }
                include_once 'model/connect.php';
                include_once 'model/categories.php';
                $madm = $_GET['id'];
                if(isset($_POST['submit'])){
                    $tendm= $_POST['tendm'];
                    $soluongsp = $_POST['soluongsp'];
                    $thutu= $_POST['thutu'];
                    edit_danhmuc($madm, $tendm, $soluongsp, $thutu);
                    $_SESSION['thongbao']='Đã lưu thông tin thay đổi';
                }
                $dsdm = get_adminDanhmuc($madm);
            include_once 'view/template_admin_head.php';
            include_once 'view/template_admin_header.php';
            include_once 'view/product_edit_danhmuc.php';
            include_once 'view/template_admin_footer.php';
            break;
        case 'delete_danhmuc':
               include_once 'model/categories.php';
               include_once 'model/connect.php';
               delete_danhmuc($_GET['id']);
               header('Location: admin.php?mod=product&act=admin_danhmuc');
            break;
            // hiển thị theo danh mục
        case 'detail':
            include_once 'model/connect.php';
            include_once 'model/categories.php';   
            include_once 'model/products.php'; 
            $data['dsdm']= get_categories();
            $ctdanhmuc = get_categoriesID($_GET['id']);
            $dssanpham = get_ByCategories($_GET['id']);

            include_once 'view/template_head.php';
            include_once 'view/template_header.php';
            include_once 'view/page_danhmuc_detail.php';
            include_once 'view/template_footer.php';
            break;       
        case 'addToCart':
            include_once 'model/products.php';
            include_once 'model/cart.php';
            $masp = $_GET['id'];
            $makh = null; // Khởi tạo $makh để tránh cảnh báo
            if (isset($_SESSION['user']) && isset($_SESSION['user']['makh'])) {
                $makh = $_SESSION['user']['makh'];
            }
            try {
                if ($makh !== null) {
                    //kiểm tra có giỏ hàng hay chưa
                    $kq = get_hasCart($makh);
                    if ($kq) {
                        //đúng, có giỏ hàng, thêm sản phẩm vào
                        get_addToCart($kq['mahd'], $masp);
                    } else {
                        //sai, chưa có giỏ hàng
                        get_cartAdd($makh);
                        $kq = get_hasCart($makh);
                            get_addToCart($kq['mahd'], $masp);
                    }
                $_SESSION['thongbao'] = 'Sản phẩm đã được thêm vào giỏ hàng';
                header('Location: ?mod=product&act=ctsanpham&id='.$masp);
                } else {
                    // Xử lý khi không có thông tin khách hàng
                 $_SESSION['thongbao'] = 'Không thể thêm sản phẩm vào giỏ hàng. Vui lòng đăng nhập.';
                header('Location: ?mod=product&act=ctsanpham&id='.$masp);
            }
            } catch (\Throwable $th) {
                $_SESSION['loi'] = 'Sản phẩm đã có trong giỏ hàng';
                header('Location: ?mod=product&act=ctsanpham&id='.$masp);
            }
       
            break;
            
        case 'removeFromCart':
            include_once 'model/products.php';
            include_once 'model/cart.php';
            if (isset($_SESSION['user']) && isset($_SESSION['user']['makh'])) {
                $makh = $_SESSION['user']['makh'];
            }
            $masp = $_GET['id'];
            $giohang = get_hasCart($makh);
            if( $giohang ){
                get_removeFromCart($giohang['mahd'],$masp);
            }
            header('Location: ?mod=page&act=giohang');
            break;

        case 'removeCart':
            include_once 'model/products.php';
            include_once 'model/cart.php';
            if (isset($_SESSION['user']) && isset($_SESSION['user']['makh'])) {
                $makh = $_SESSION['user']['makh'];
            }
            $giohang = get_hasCart($makh);
            if( $giohang ){
                get_removeCart($giohang['mahd']);
            }
            header('Location: ?mod=page&act=giohang');
            break;
        case 'updateCart':
            include_once 'model/products.php';
            include_once 'model/cart.php';
            if (isset($_SESSION['user']) && isset($_SESSION['user']['makh'])) {
                $makh = $_SESSION['user']['makh'];
            }
            $giohang = get_hasCart($makh);
            if( $giohang ){
                $ngaydathang = date_format(date_create($_POST['ngaydathang']), "Y-m-d H:i:s");
                $tongtien = $_POST['tongtien'];
                $ghichu = $_POST['ghichu'];
                $trangthai = 'chuan-bi-don-hang';
                get_updateCart($giohang['mahd'], $makh, $ngaydathang, $tongtien, $ghichu, $trangthai);
                $_SESSION['thongbao']='Đơn hàng của bạn đang được chuẩn bị!';
            }
            header('Location: ?mod=page&act=giohang');
            break;
            //quản lý sản phẩm
        case 'admin':
            if ( !(isset($_SESSION['user']) && $_SESSION['user']['quyen']='admin')) {
                header('Location: index.php');
            }
            include_once 'model/connect.php';
            include_once 'model/products.php';
            $page = 1;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }
            $data['dssp'] = get_products(0, ($page-1)*4, 4);
            $soluongsp = count_products()['soluong'];
            $sotrang =ceil( $soluongsp / 4);

            include_once 'view/template_admin_head.php';
            include_once 'view/template_admin_header.php';
            include_once 'view/product_admin.php';
            include_once 'view/template_admin_footer.php';
            break;
            //bình luận
        case 'comment':
            include_once 'model/connect.php';
            include_once 'model/binhluan.php';
            comment_add($_SESSION['user']['makh'], $_POST['masp'], $_POST['noidung']);
            header("Location: ?mod=product&act=ctsanpham&id=".$_POST['masp']);
            break;
            //thêm sản phẩm
        case 'add':
            if ( !(isset($_SESSION['user']) && $_SESSION['user']['quyen']='admin')) {
                header('Location: index.php');
            }
            include_once 'model/connect.php';
            include_once 'model/products.php';
            include_once 'model/categories.php';
            $data['dsdm'] = get_categories();

            if (isset($_POST['submit'])) {
                $kq = add_product(
                    $_POST['tensp'],
                    $_POST['dongia'],
                    $_POST['khuyenmai'],
                    $_POST['soluong'],
                    $_POST['mota'],
                    $_FILES['anh']['name'],
                    $_POST['madm'],
                );

                if ($kq) {
                    if (isset($_FILES['anh']) && $_FILES['anh']['error'] == 0)  {
                        $kq = move_uploaded_file(
                            $_FILES['anh']['tmp_name'], "upload/product/".$_FILES['anh']['name']
                        );
                    }
                    if ($kq) {
                        header("Location: admin.php?mod=product&act=admin");
                    } else {
                        $thongbao = "Có lỗi không mong muốn xảy ra! Vui lòng thử lại.";
                    }
                }else{
                    $thongbao = "Có lỗi không mong muốn xảy ra! Vui lòng thử lại.";
                }
            }
            include_once 'view/template_admin_head.php';
            include_once 'view/template_admin_header.php';
            include_once 'view/product_add.php';
            include_once 'view/template_admin_footer.php';
            break;
        case 'edit':
                if ( !(isset($_SESSION['user']) && $_SESSION['user']['quyen']='admin')) {
                    header('Location: index.php');
                }
                include_once 'model/connect.php';
                include_once 'model/products.php';
                include_once 'model/categories.php';

                $data['dsdm'] = get_categories();
                
                if(isset($_GET['id'])){
                    $data['sp'] = get_product($_GET['id']);
                }
                if (isset($_POST['submit'])) {  
                    // print_r($_FILES);
                    $anh = $_FILES['anh']['name'];
                    if($_FILES['anh']['error']!=0){
                        $anh = $data['sp']['anh'];
                    }

                // if (isset($_POST['submit'])) {
                    $kq = edit_product(
                        $_GET['id'],
                        $_POST['tensp'],
                        $_POST['dongia'],
                        $_POST['khuyenmai'],
                        $_POST['soluong'],
                        $_POST['mota'],
                        $anh,
                        $_POST['madm']
                    );
    
                    if ($kq) {
                        if (isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
                            $kq = move_uploaded_file(
                                $_FILES['anh']['tmp_name'], "upload/product/".$_FILES['anh']['name']
                            );
                        }
                        if ($kq) {
                            header("Location: admin.php?mod=product&act=admin");
                        } else {
                            $thongbao = "Có lỗi không mong muốn xảy ra! Vui lòng thử lại.";
                        }
                    }else{
                        $thongbao = "Có lỗi không mong muốn xảy ra! Vui lòng thử lại.";
                    }
                }
                include_once 'view/template_admin_head.php';
                include_once 'view/template_admin_header.php';
                include_once 'view/product_edit.php';
                include_once 'view/template_admin_footer.php';
                break;
        
        case 'delete':
            // Kiểm tra đã đăng nhập là admin
            if (!(isset($_SESSION['user']) && $_SESSION['user']['quyen'] == 'admin')) {
                header('Location: index.php');
            }
            include_once 'model/connect.php';
            include_once 'model/products.php';

            if (isset($_GET['id'])) {
                $kq = delete_product($_GET['id']);
                if ($kq) {
                    //KQ đúng, đã xoá thành công
                    $thongbao = "Đã xoá sản phẩm [".$_GET['id']."] thành công";
                    header("Location: admin.php?mod=product&act=admin");
                }else{
                    $thongbao = "Có lỗi xảy ra. Vui lòng thử lại sao!";
                }
            }

            break;
        default:
            # 404 - trang web không tồn tại!
            break;
    }
}
?>
