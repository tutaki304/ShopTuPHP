<style>
        .khungdanhmuc {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 5px;
            z-index: 1; /* Đảm bảo nó hiển thị trên các phần khác nếu có */
        }

        /* Hiển thị danh sách khi hover vào liên kết "SẢN PHẨM" */
        .nav-left a:hover.khungdanhmuc {
            display: block;
        }

        .khungdanhmuc a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 5px;
        }

        /* User Menu Styles */
        .user-menu {
            position: relative;
            display: inline-block;
        }

        .user-info-link {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: inherit;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .user-info-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .user-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            min-width: 280px;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            padding: 8px 0;
        }

        .user-menu:hover .user-dropdown {
            display: block;
        }

        .user-profile {
            padding: 16px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin: -8px 0 8px 0;
            border-radius: 8px 8px 0 0;
        }

        .user-profile p {
            margin: 0;
            line-height: 1.4;
        }

        .user-email {
            opacity: 0.9;
            font-size: 0.9em;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #667eea;
        }

        .dropdown-item.logout:hover {
            background-color: #fee;
            color: #dc3545;
        }

        .dropdown-divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 8px 0;
        }

        .dropdown-item i {
            width: 16px;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .user-dropdown {
                min-width: 250px;
                right: -20px;
            }
            
            .user-info-link {
                font-size: 14px;
            }
        }
    </style>
<body>
    <header>
            <!-- <div class="nav1">
                <p>Theo giõi shop để nhận nhiều ưu đãi</p>
            </div> -->
        <div class="nav">
            <div class="nav-left">
                <a href="?mod=page&act=home">TRANG CHỦ</a>
                <a href="?mod=product&act=sanpham">SẢN PHẨM</a>
                <a href="?mod=page&act=gioithieu">GIỚI THIỆU</a>
                <a href="?mod=page&act=contact">LIÊN HỆ</a>
            </div>
            <div class="logo">
                <a href="?mod=page&act=home"><img src="assets_user/img/anhlogo_preview_rev_1.png" alt=""></a>
            </div>
            <div class="nav-right">
                <a href="#">HƯỚNG DẪN MUA HÀNG</a>
                <?php if(isset($_SESSION['user'])): ?>
                    <!-- Menu người dùng đã đăng nhập -->
                    <div class="user-menu">
                        <a href="#" class="user-info-link">
                            <i class="fas fa-user"></i>
                            <?= isset($_SESSION['user']['hoten']) ? $_SESSION['user']['hoten'] : 'Người dùng' ?>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="user-dropdown">
                            <div class="user-profile">
                                <p><strong><?= isset($_SESSION['user']['hoten']) ? $_SESSION['user']['hoten'] : 'Người dùng' ?></strong></p>
                                <p class="user-email"><?= isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '' ?></p>
                            </div>
                            <div class="dropdown-divider"></div>
                            <?php if(isset($_SESSION['user']['quyen']) && $_SESSION['user']['quyen'] == 'admin'): ?>
                                <a href="admin.php?mod=page&act=dashboard" class="dropdown-item">
                                    <i class="fas fa-cog"></i> Trang quản lý
                                </a>
                                <div class="dropdown-divider"></div>
                            <?php endif; ?>
                            <a href="?mod=user&act=change_password" class="dropdown-item">
                                <i class="fas fa-key"></i> Đổi mật khẩu
                            </a>
                            <a href="?mod=user&act=profile" class="dropdown-item">
                                <i class="fas fa-user-edit"></i> Thông tin cá nhân
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="?mod=user&act=logout" class="dropdown-item logout">
                                <i class="fas fa-sign-out-alt"></i> Đăng xuất
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Menu cho người dùng chưa đăng nhập -->
                    <a href="?mod=user&act=login">TÀI KHOẢN</a>
                <?php endif; ?>
                <a href="?mod=page&act=giohang">GIỎ HÀNG</a>
            </div>
        </div>
    </header>
