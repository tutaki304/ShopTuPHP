# ShopTu - Hệ thống Thương mại Điện tử

Một website bán hàng trực tuyến được xây dựng bằng PHP với kiến trúc MVC, hỗ trợ đầy đủ các tính năng của một cửa hàng trực tuyến hiện đại.

## 📋 Mục lục
- [Tổng quan dự án](#tổng-quan-dự-án)
- [Tính năng chính](#tính-năng-chính)
- [Yêu cầu hệ thống](#yêu-cầu-hệ-thống)
- [Cài đặt và cấu hình](#cài-đặt-và-cấu-hình)
- [Cấu trúc dự án](#cấu-trúc-dự-án)
- [Cơ sở dữ liệu](#cơ-sở-dữ-liệu)
- [Hướng dẫn sử dụng](#hướng-dẫn-sử-dụng)
- [API và chức năng](#api-và-chức-năng)
- [Bảo mật](#bảo-mật)
- [Khắc phục sự cố](#khắc-phục-sự-cố)

## 🎯 Tổng quan dự án

ShopTu là một hệ thống thương mại điện tử hoàn chỉnh được phát triển bằng PHP và MySQL, sử dụng kiến trúc MVC (Model-View-Controller) để đảm bảo code dễ bảo trì và mở rộng.

### Đặc điểm nổi bật:
- 🏗️ **Kiến trúc MVC**: Tách biệt rõ ràng logic xử lý, dữ liệu và giao diện
- 🛡️ **Bảo mật cao**: PDO prepared statements, validation dữ liệu đầu vào
- 📱 **Responsive Design**: Giao diện thân thiện trên mọi thiết bị
- ⚡ **Hiệu suất tối ưu**: CSS/JS được tối ưu hóa cho tốc độ tải nhanh
- 🎨 **UI/UX hiện đại**: Sử dụng Bootstrap 5.3 và Font Awesome 6

## ✨ Tính năng chính

### Phía người dùng:
- **Xem sản phẩm**: Duyệt sản phẩm theo danh mục, tìm kiếm, lọc
- **Giỏ hàng**: Thêm/xóa sản phẩm, cập nhật số lượng
- **Đặt hàng**: Quy trình thanh toán đơn giản, theo dõi đơn hàng
- **Tài khoản**: Đăng ký, đăng nhập, quản lý thông tin cá nhân
- **Bình luận**: Đánh giá và bình luận sản phẩm
- **Trang thông tin**: Giới thiệu, liên hệ

### Phía quản trị:
- **Dashboard**: Thống kê tổng quan, biểu đồ doanh thu, đơn hàng gần đây
- **Quản lý sản phẩm**: CRUD sản phẩm, upload hình ảnh, quản lý kho
- **Quản lý đơn hàng**: Xem, cập nhật trạng thái đơn hàng, thống kê doanh thu, top khách hàng
- **Quản lý người dùng**: Quản lý tài khoản khách hàng và admin
- **Quản lý danh mục**: Tổ chức sản phẩm theo danh mục
- **Quản lý bình luận**: Duyệt và xóa bình luận

## 🖥️ Yêu cầu hệ thống

### Máy chủ:
- **PHP**: Phiên bản 7.4 trở lên (khuyến nghị PHP 8.0+)
- **MySQL**: Phiên bản 5.7 trở lên (hoặc MariaDB 10.2+)
- **Web Server**: Apache 2.4+ hoặc Nginx 1.18+
- **Extensions PHP cần thiết**:
  - PDO và PDO_MySQL
  - GD library (xử lý hình ảnh)
  - mbstring
  - session

### Máy khách:
- **Trình duyệt**: Chrome 90+, Firefox 88+, Safari 14+, Edge 90+
- **JavaScript**: Được bật để sử dụng các tính năng tương tác

## 🔧 Cài đặt và cấu hình

### Bước 1: Tải xuống dự án
```bash
# Clone repository (nếu sử dụng Git)
git clone [repository-url] ShopTuPHP

# Hoặc giải nén file zip vào thư mục web server
# Ví dụ: C:\xampp\htdocs\ShopTuPHP (Windows)
# Hoặc: /var/www/html/ShopTuPHP (Linux)
```

### Bước 2: Cài đặt môi trường phát triển

#### Sử dụng XAMPP (Khuyến nghị cho Windows):
1. Tải và cài đặt XAMPP từ https://www.apachefriends.org/
2. Khởi động Apache và MySQL từ XAMPP Control Panel
3. Copy dự án vào thư mục `C:\xampp\htdocs\ShopTuPHP`

#### Sử dụng WAMP:
1. Tải và cài đặt WAMP từ http://www.wampserver.com/
2. Khởi động WAMP server
3. Copy dự án vào thư mục `C:\wamp64\www\ShopTuPHP`

#### Sử dụng LAMP (Linux):
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install apache2 mysql-server php libapache2-mod-php php-mysql php-gd

# CentOS/RHEL
sudo yum install httpd mariadb-server php php-mysqlnd php-gd

# Khởi động dịch vụ
sudo systemctl start apache2 mysql  # Ubuntu/Debian
sudo systemctl start httpd mariadb  # CentOS/RHEL
```

### Bước 3: Cấu hình cơ sở dữ liệu

#### 3.1 Tạo cơ sở dữ liệu:
```sql
-- Truy cập phpMyAdmin (http://localhost/phpmyadmin)
-- Hoặc sử dụng command line:

mysql -u root -p
CREATE DATABASE shoptu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 3.2 Tạo bảng và dữ liệu mẫu:
```sql
USE shoptu;

-- Bảng danh mục sản phẩm
CREATE TABLE `danhmuc` (
  `madm` int(11) NOT NULL AUTO_INCREMENT,
  `tendm` varchar(255) NOT NULL,
  `soluongsp` int(11) DEFAULT 0,
  `thutu` int(11) DEFAULT 0,
  `trangthai` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`madm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Bảng sản phẩm
CREATE TABLE `sanpham` (
  `masp` int(11) NOT NULL AUTO_INCREMENT,
  `tensp` varchar(255) NOT NULL,
  `dongia` decimal(15,3) DEFAULT 0.000,
  `khuyenmai` decimal(15,3) DEFAULT 0.000,
  `soluong` int(11) DEFAULT 0,
  `soluotxem` int(11) DEFAULT 0,
  `mota` text,
  `anh` varchar(255) DEFAULT NULL,
  `madm` int(11) DEFAULT NULL,
  `trangthai` tinyint(1) DEFAULT 1,
  `ngaytao` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`masp`),
  KEY `fk_sanpham_danhmuc` (`madm`),
  CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`madm`) REFERENCES `danhmuc` (`madm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Bảng tài khoản
CREATE TABLE `taikhoan` (
  `makh` int(11) NOT NULL AUTO_INCREMENT,
  `hoten` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `diachi` text,
  `sdt` varchar(20) DEFAULT NULL,
  `anh` varchar(255) DEFAULT 'upload/avatar/default.jpg',
  `quyen` enum('admin','user') DEFAULT 'user',
  `ngaytao` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`makh`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Bảng hóa đơn
CREATE TABLE `hoadon` (
  `mahd` int(11) NOT NULL AUTO_INCREMENT,
  `makh` int(11) NOT NULL,
  `tongtien` decimal(15,3) DEFAULT 0.000,
  `trangthai` enum('gio-hang','cho-xac-nhan','dang-giao','hoan-thanh','huy') DEFAULT 'gio-hang',
  `ngaydathang` timestamp DEFAULT CURRENT_TIMESTAMP,
  `diachi_giaohang` text,
  `ghichu` text,
  PRIMARY KEY (`mahd`),
  KEY `fk_hoadon_taikhoan` (`makh`),
  CONSTRAINT `fk_hoadon_taikhoan` FOREIGN KEY (`makh`) REFERENCES `taikhoan` (`makh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Bảng chi tiết hóa đơn
CREATE TABLE `chitiethoadon` (
  `mahd` int(11) NOT NULL,
  `masp` int(11) NOT NULL,
  `soluong` int(11) NOT NULL DEFAULT 1,
  `dongia` decimal(15,3) DEFAULT 0.000,
  PRIMARY KEY (`mahd`, `masp`),
  KEY `fk_cthd_sanpham` (`masp`),
  CONSTRAINT `fk_cthd_hoadon` FOREIGN KEY (`mahd`) REFERENCES `hoadon` (`mahd`) ON DELETE CASCADE,
  CONSTRAINT `fk_cthd_sanpham` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Bảng bình luận
CREATE TABLE `binhluan` (
  `mabl` int(11) NOT NULL AUTO_INCREMENT,
  `makh` int(11) NOT NULL,
  `masp` int(11) NOT NULL,
  `noidung` text NOT NULL,
  `ngaygui` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mabl`),
  KEY `fk_bl_taikhoan` (`makh`),
  KEY `fk_bl_sanpham` (`masp`),
  CONSTRAINT `fk_bl_taikhoan` FOREIGN KEY (`makh`) REFERENCES `taikhoan` (`makh`),
  CONSTRAINT `fk_bl_sanpham` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Thêm tài khoản admin mặc định
INSERT INTO `taikhoan` (`hoten`, `email`, `matkhau`, `quyen`) 
VALUES ('Admin', 'admin@shoptu.com', 'admin123', 'admin');

-- Thêm danh mục mẫu
INSERT INTO `danhmuc` (`tendm`, `soluongsp`, `thutu`) VALUES
('Thời trang nam', 0, 1),
('Thời trang nữ', 0, 2),
('Phụ kiện', 0, 3),
('Giày dép', 0, 4);
```

### Bước 4: Cấu hình kết nối database

Mở file `model/connect.php` và kiểm tra thông tin kết nối:

```php
<?php
// Cấu hình kết nối database
$servername = "localhost";      // Địa chỉ server MySQL
$username = "root";             // Tên đăng nhập MySQL
$password = "";                 // Mật khẩu MySQL (để trống với XAMPP mặc định)
$dbname = "shoptu";            // Tên database

function pdo_get_connection() {
    global $servername, $username, $password, $dbname;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", 
                       $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        die("Kết nối thất bại: " . $e->getMessage());
    }
}
?>
```

**Lưu ý**: Nếu MySQL có mật khẩu, hãy cập nhật biến `$password`.

### Bước 5: Cấu hình quyền thư mục

```bash
# Linux/Mac - Đặt quyền cho thư mục upload
chmod 755 upload/
chmod 755 upload/product/
chmod 755 upload/avatar/

# Windows - Đảm bảo IIS_IUSRS có quyền ghi vào thư mục upload
```

### Bước 6: Truy cập website

- **Trang chủ người dùng**: http://localhost/ShopTuPHP/
- **Trang quản trị**: http://localhost/ShopTuPHP/admin.php
- **Tài khoản admin**: 
  - Email: admin@shoptu.com
  - Mật khẩu: admin123

## 📁 Cấu trúc dự án

```
ShopTuPHP/
├── index.php                 # Entry point cho giao diện người dùng
├── admin.php                 # Entry point cho giao diện admin
├── global.php                # File cấu hình global
├── README.md                 # File hướng dẫn này
├── fix_cart_database.sql     # Script fix database giỏ hàng
│
├── controller/               # Tầng Controller (xử lý logic)
│   ├── page.php             # Controller cho các trang tĩnh
│   ├── product.php          # Controller cho sản phẩm
│   └── user.php             # Controller cho người dùng
│
├── model/                    # Tầng Model (xử lý dữ liệu)
│   ├── connect.php          # Kết nối database
│   ├── products.php         # Model sản phẩm
│   ├── user.php             # Model người dùng
│   ├── cart.php             # Model giỏ hàng
│   ├── categories.php       # Model danh mục
│   ├── binhluan.php         # Model bình luận
│   └── dashboard.php        # Model dashboard admin
│
├── view/                     # Tầng View (giao diện)
│   ├── template_head.php    # Header chung cho user
│   ├── template_header.php  # Navigation cho user
│   ├── template_footer.php  # Footer chung cho user
│   ├── template_admin_*.php # Template cho admin
│   ├── page_*.php           # Các trang user
│   └── product_*.php        # Các trang admin
│
├── assets_user/              # Assets cho giao diện user
│   ├── css/                 # File CSS
│   ├── img/                 # Hình ảnh giao diện
│   └── js/                  # File JavaScript
│
├── assets_admin/             # Assets cho giao diện admin
│   ├── css/                 # CSS cho admin
│   └── img/                 # Hình ảnh admin
│
└── upload/                   # Thư mục chứa file upload
    ├── product/             # Hình ảnh sản phẩm
    └── avatar/              # Avatar người dùng
```

### Giải thích kiến trúc MVC:

1. **Model** (`model/`): Chứa logic xử lý dữ liệu, kết nối database
2. **View** (`view/`): Chứa giao diện HTML/PHP hiển thị cho người dùng
3. **Controller** (`controller/`): Xử lý yêu cầu từ user, điều phối giữa Model và View

## 🗄️ Cơ sở dữ liệu

### Sơ đồ quan hệ các bảng:

```
taikhoan (1) -----> (n) hoadon (1) -----> (n) chitiethoadon (n) <----- (1) sanpham
    |                                                                        |
    |                                                                        |
    v                                                                        |
binhluan (n) <----------------------------------------------------------------
    |
    |
danhmuc (1) -----> (n) sanpham
```

### Mô tả các bảng:

#### 1. `taikhoan` - Quản lý người dùng
- `makh`: ID tài khoản (Primary Key)
- `hoten`: Họ và tên
- `email`: Email đăng nhập (Unique)
- `matkhau`: Mật khẩu
- `diachi`: Địa chỉ
- `sdt`: Số điện thoại
- `anh`: Đường dẫn avatar
- `quyen`: Quyền truy cập ('admin'/'user')
- `ngaytao`: Ngày tạo tài khoản

#### 2. `danhmuc` - Danh mục sản phẩm
- `madm`: ID danh mục (Primary Key)
- `tendm`: Tên danh mục
- `soluongsp`: Số lượng sản phẩm trong danh mục
- `thutu`: Thứ tự hiển thị
- `trangthai`: Trạng thái hoạt động

#### 3. `sanpham` - Sản phẩm
- `masp`: ID sản phẩm (Primary Key)
- `tensp`: Tên sản phẩm
- `dongia`: Giá gốc
- `khuyenmai`: Giá khuyến mãi
- `soluong`: Số lượng tồn kho
- `soluotxem`: Số lượt xem
- `mota`: Mô tả sản phẩm
- `anh`: Hình ảnh sản phẩm
- `madm`: ID danh mục (Foreign Key)
- `trangthai`: Trạng thái hoạt động
- `ngaytao`: Ngày tạo

#### 4. `hoadon` - Đơn hàng
- `mahd`: ID hóa đơn (Primary Key)
- `makh`: ID khách hàng (Foreign Key)
- `tongtien`: Tổng tiền
- `trangthai`: Trạng thái đơn hàng
- `ngaydathang`: Ngày đặt hàng
- `diachi_giaohang`: Địa chỉ giao hàng
- `ghichu`: Ghi chú

#### 5. `chitiethoadon` - Chi tiết đơn hàng
- `mahd`: ID hóa đơn (Foreign Key)
- `masp`: ID sản phẩm (Foreign Key)
- `soluong`: Số lượng
- `dongia`: Đơn giá tại thời điểm mua

#### 6. `binhluan` - Bình luận sản phẩm
- `mabl`: ID bình luận (Primary Key)
- `makh`: ID khách hàng (Foreign Key)
- `masp`: ID sản phẩm (Foreign Key)
- `noidung`: Nội dung bình luận
- `ngaygui`: Ngày gửi

## 📖 Hướng dẫn sử dụng

### Phía người dùng:

#### 1. Đăng ký/Đăng nhập:
- Truy cập: http://localhost/ShopTuPHP/index.php?mod=user&act=login
- Click "Đăng ký" để tạo tài khoản mới
- Nhập thông tin và submit form

#### 2. Duyệt sản phẩm:
- Xem tất cả sản phẩm: Trang chủ
- Xem theo danh mục: Click vào menu danh mục
- Tìm kiếm: Sử dụng ô tìm kiếm
- Xem chi tiết: Click vào sản phẩm

#### 3. Mua hàng:
- Thêm vào giỏ: Click "Thêm vào giỏ hàng"
- Xem giỏ hàng: Click icon giỏ hàng
- Cập nhật số lượng: Thay đổi và click "Cập nhật"
- Thanh toán: Click "Thanh toán" và điền thông tin

#### 4. Quản lý tài khoản:
- Xem thông tin: Menu "Tài khoản"
- Cập nhật profile: Chỉnh sửa và lưu
- Xem lịch sử đơn hàng: Tab "Đơn hàng"

### Phía quản trị:

#### 1. Truy cập admin:
- URL: http://localhost/ShopTuPHP/admin.php
- Đăng nhập với tài khoản admin

#### 2. Quản lý sản phẩm:
- **Xem danh sách**: Menu "Sản phẩm"
- **Thêm mới**: Click "Thêm sản phẩm"
- **Chỉnh sửa**: Click "Edit" trên từng sản phẩm
- **Xóa**: Click "Delete" (có xác nhận)

#### 3. Quản lý đơn hàng:
- **Xem đơn hàng**: Menu "Đơn hàng"
- **Cập nhật trạng thái**: Select trạng thái mới
- **Xem chi tiết**: Click vào mã đơn hàng

#### 4. Quản lý người dùng:
- **Danh sách**: Menu "Người dùng"
- **Thêm admin**: Click "Thêm tài khoản"
- **Chỉnh sửa**: Click "Edit" (trừ tài khoản admin)
- **Xóa**: Click "Delete" (trừ tài khoản admin)

#### 5. Dashboard:
- **Thống kê tổng quan**: Doanh thu, đơn hàng, sản phẩm
- **Biểu đồ**: Theo dõi xu hướng bán hàng
- **Sản phẩm hot**: Top sản phẩm bán chạy

## 🔗 API và chức năng

### Routing System:

Website sử dụng URL routing dạng: `?mod=module&act=action&id=value`

#### User Routes (index.php):
```
GET  /?mod=page&act=home                 # Trang chủ
GET  /?mod=page&act=sanpham              # Danh sách sản phẩm
GET  /?mod=page&act=ctsanpham&id=123     # Chi tiết sản phẩm
GET  /?mod=page&act=giohang              # Giỏ hàng
POST /?mod=user&act=login                # Đăng nhập
POST /?mod=user&act=signup               # Đăng ký
GET  /?mod=user&act=logout               # Đăng xuất
POST /?mod=product&act=search            # Tìm kiếm sản phẩm
```

#### Admin Routes (admin.php):
```
GET  /admin.php?mod=page&act=dashboard   # Dashboard admin
GET  /admin.php?mod=product&act=admin    # Quản lý sản phẩm
POST /admin.php?mod=product&act=add      # Thêm sản phẩm
POST /admin.php?mod=product&act=edit     # Sửa sản phẩm
GET  /admin.php?mod=order&act=list       # Danh sách đơn hàng
GET  /admin.php?mod=order&act=detail&id=123  # Chi tiết đơn hàng
POST /admin.php?mod=order&act=update_status  # Cập nhật trạng thái
GET  /admin.php?mod=order&act=statistics # Thống kê đơn hàng
GET  /admin.php?mod=user&act=admin       # Quản lý người dùng
```

### AJAX Functions:

#### Giỏ hàng:
```javascript
// Thêm vào giỏ hàng
function addToCart(productId, quantity) {
    // AJAX call to controller/product.php
}

// Cập nhật số lượng
function updateCartQuantity(productId, newQuantity) {
    // AJAX call to update cart
}
```

#### Admin functions:
```javascript
// Xóa sản phẩm với SweetAlert
function deleteProduct(id) {
    Swal.fire({
        title: 'Bạn có chắc chắn?',
        text: "Không thể hoàn tác sau khi xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `admin.php?mod=product&act=delete&id=${id}`;
        }
    });
}
```

## 🔐 Bảo mật

### 1. SQL Injection Protection:
```php
// Sử dụng PDO Prepared Statements
function getProduct($id) {
    $sql = "SELECT * FROM sanpham WHERE masp = ?";
    $conn = pdo_get_connection();
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}
```

### 2. XSS Protection:
```php
// Escape output data
echo htmlspecialchars($user_input, ENT_QUOTES, 'UTF-8');
```

### 3. Authentication:
```php
// Session management
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['quyen'] !== 'admin') {
    header('Location: index.php');
    exit;
}
```

### 4. File Upload Security:
```php
// Validate file type and size
$allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
$max_size = 5 * 1024 * 1024; // 5MB

if (!in_array($file_extension, $allowed_types)) {
    die("File type not allowed");
}
```

### 5. Password Hashing (Khuyến nghị):
```php
// Trong tương lai nên sử dụng password hashing
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$is_valid = password_verify($input_password, $hashed_password);
```

## 🛠️ Khắc phục sự cố

### 1. Lỗi kết nối database:
```
SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost'
```
**Giải pháp**:
- Kiểm tra username/password trong `model/connect.php`
- Đảm bảo MySQL service đang chạy
- Kiểm tra tên database có tồn tại

### 2. Lỗi không hiển thị hình ảnh:
**Giải pháp**:
- Kiểm tra quyền thư mục `upload/`
- Đảm bảo đường dẫn hình ảnh đúng
- Kiểm tra PHP GD extension được bật

### 3. Session lỗi:
```
Warning: session_start(): Cannot send session cookie
```
**Giải pháp**:
- Đảm bảo `session_start()` được gọi trước khi có output
- Kiểm tra quyền ghi vào thư mục session PHP

### 4. Upload file không thành công:
**Giải pháp**:
```php
// Kiểm tra cấu hình PHP
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_execution_time', 300);
```

### 5. CSS/JS không load:
**Giải pháp**:
- Kiểm tra đường dẫn tương đối
- Clear browser cache
- Kiểm tra file tồn tại trong thư mục assets

### 6. Lỗi 404 trên các route:
**Giải pháp**:
- Đảm bảo mod_rewrite được bật (Apache)
- Kiểm tra file .htaccess
- Sử dụng URL đầy đủ với query parameters

### 7. Performance optimization:
```php
// Bật compression
if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
    ob_start('ob_gzhandler');
}

// Cache headers cho static files
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico)$/', $_SERVER['REQUEST_URI'])) {
    header('Cache-Control: public, max-age=31536000');
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
}
```

## 📞 Hỗ trợ

### Cấu hình phát triển:
- **PHP Version**: 7.4+ (khuyến nghị 8.0+)
- **MySQL Version**: 5.7+ (khuyến nghị 8.0+)
- **Web Server**: Apache với mod_rewrite
- **Extensions**: PDO, GD, mbstring, session

### Debugging:
```php
// Bật error reporting cho development
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', 'php_errors.log');
}
```

### Log Files:
- **Apache Error Log**: `/var/log/apache2/error.log` (Linux)
- **PHP Error Log**: Xem cấu hình `error_log` trong php.ini
- **MySQL Error Log**: `/var/log/mysql/error.log` (Linux)

---

## 📝 Ghi chú phát triển

- Code được viết theo chuẩn PSR-4 cho autoloading
- Sử dụng PDO thay vì mysqli để tăng bảo mật
- CSS sử dụng Flexbox và Grid cho responsive design
- JavaScript ES6+ với async/await cho AJAX
- Tất cả user input đều được validate và sanitize

**Version**: 1.0.0
**Last Updated**: 2024
**Developer**: ShopTu Team

---

*Để được hỗ trợ thêm, vui lòng tạo issue trong repository hoặc liên hệ qua email.*
