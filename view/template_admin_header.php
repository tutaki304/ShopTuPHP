
<body>
    <nav>
        <strong>Trang quản trị</strong>
        <div class="khungadmin">
            <button>
                    <span class="sa-toolbar-use-img">
                        <img src="<?=$_SESSION['user']['anh']?>" alt="" width="40px">
                    </span>
                    <span class="sa-toolbar-user-thongtin">
                        <span class="sa-toolbar-user-ten">
                            <?=$_SESSION['user']['hoten']?>
                        </span>
                        <small class="sa-toolbar-user-email">
                            <?=$_SESSION['user']['email']?>
                        </small>
                    </span>
                    <i class="fa-solid fa-caret-down"></i>
            </button>
            <ul class="dangxuat">
                <li>
                    <a class="khungadmin-item" href="?mod=user&act=logout">Sign Out</a><br>
                    <a class="khungadmin-item" href="index.php?mod=product&act=sanpham">Về trang chủ</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-3">
            <ul>
                <li>
                    <a href="admin.php"><i class="fa-solid fa-gauge"></i> Tổng quan</a>
                </li>
                <li>
                    <a href="admin.php?mod=product&act=admin"><i class="fa-solid fa-inbox"></i> Sản phẩm</a>
                </li>
                <li>
                    <a href="admin.php?mod=product&act=admin_danhmuc"><i class="fa-solid fa-layer-group"></i> Danh mục</a>
                </li>
                <li>
                    <a href="admin.php?mod=user&act=user"><i class="fa-solid fa-user"></i> Tài khoản</a>
                </li>
                <li>
                    <a  href="admin.php?mod=page&act=admin_binhluan"><i class="fa-solid fa-comment"></i> Bình Luận</a>
                </li>
            </ul>
        </div>
        <div class="col-9">