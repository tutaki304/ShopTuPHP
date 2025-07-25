
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
                <a href="?mod=user&act=login">TÀI KHOẢN</a>
                <a href="?mod=page&act=giohang">GIỎ HÀNG</a>
            </div>
        </div>
    </header>