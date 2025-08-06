
<body>
    <nav>
        <strong>Trang quản trị</strong>
        <div class="khungadmin">
            <button id="admin-dropdown-btn" onclick="toggleAdminDropdown()">
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
                <i class="fa-solid fa-caret-down" id="admin-dropdown-arrow"></i>
            </button>
            <ul class="dangxuat" id="admin-dropdown-menu">
                <li>
                    <a class="khungadmin-item" href="?mod=user&act=logout">
                        <i class="fa-solid fa-sign-out-alt"></i> Sign Out
                    </a>
                </li>
                <li>
                    <a class="khungadmin-item" href="index.php">
                        <i class="fa-solid fa-home"></i> Về trang chủ
                    </a>
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
                    <a href="admin.php?mod=order&act=list"><i class="fa-solid fa-shopping-cart"></i> Đơn hàng</a>
                </li>
                <li>
                    <a href="admin.php?mod=user&act=user"><i class="fa-solid fa-user"></i> Tài khoản</a>
                </li>
                <li>
                    <a  href="admin.php?mod=page&act=quan_ly_binh_luan"><i class="fa-solid fa-comment"></i> Bình Luận</a>
                </li>
            </ul>
        </div>
        <div class="col-9">

<script>
function toggleAdminDropdown() {
    const dropdown = document.getElementById('admin-dropdown-menu');
    const arrow = document.getElementById('admin-dropdown-arrow');
    
    dropdown.classList.toggle('show');
    arrow.classList.toggle('rotate');
}

// Đóng dropdown khi click bên ngoài
document.addEventListener('click', function(event) {
    const khungadmin = document.querySelector('.khungadmin');
    const dropdown = document.getElementById('admin-dropdown-menu');
    const arrow = document.getElementById('admin-dropdown-arrow');
    
    if (!khungadmin.contains(event.target)) {
        dropdown.classList.remove('show');
        arrow.classList.remove('rotate');
    }
});
</script>