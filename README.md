# ShopTu - Hệ thống Website Bán Hàng

## 📋 Giới thiệu

ShopTu là một hệ thống website bán hàng được phát triển bằng PHP thuần với kiến trúc MVC (Model-View-Controller). Dự án cung cấp đầy đủ các tính năng cơ bản của một website thương mại điện tử, bao gồm quản lý sản phẩm, giỏ hàng, đơn hàng và hệ thống quản trị.

## 🚀 Tính năng chính

### Phía người dùng:
- 🏠 **Trang chủ**: Hiển thị sản phẩm nổi bật và sản phẩm mới
- 📦 **Xem sản phẩm**: Danh sách sản phẩm theo danh mục, chi tiết sản phẩm
- 🛒 **Giỏ hàng**: Thêm, sửa, xóa sản phẩm trong giỏ hàng
- 👤 **Tài khoản**: Đăng ký, đăng nhập, quản lý thông tin cá nhân
- 🔍 **Tìm kiếm**: Tìm kiếm sản phẩm theo từ khóa
- 💬 **Bình luận**: Đánh giá và bình luận sản phẩm
- 📞 **Liên hệ**: Thông tin liên hệ và giới thiệu

### Phía quản trị:
- 📊 **Dashboard**: Tổng quan hệ thống
- 🏷️ **Quản lý danh mục**: Thêm, sửa, xóa danh mục sản phẩm
- 📦 **Quản lý sản phẩm**: CRUD sản phẩm với upload hình ảnh
- 👥 **Quản lý người dùng**: Quản lý tài khoản khách hàng
- 💬 **Quản lý bình luận**: Duyệt và quản lý bình luận

## 🏗️ Kiến trúc hệ thống

Dự án sử dụng mô hình MVC với cấu trúc thư mục như sau:

```
ShopTuPHP/
├── 📁 controller/          # Controllers - Xử lý logic điều hướng
│   ├── page.php           # Controller trang chính
│   ├── product.php        # Controller sản phẩm
│   └── user.php           # Controller người dùng
├── 📁 model/              # Models - Xử lý dữ liệu
│   ├── connect.php        # Kết nối cơ sở dữ liệu
│   ├── products.php       # Model sản phẩm
│   ├── categories.php     # Model danh mục
│   ├── user.php          # Model người dùng
│   ├── cart.php          # Model giỏ hàng
│   └── binhluan.php      # Model bình luận
├── 📁 view/               # Views - Giao diện người dùng
│   ├── template_*.php     # Template chung
│   ├── page_*.php        # Các trang chính
│   └── product_*.php     # Trang quản lý sản phẩm
├── 📁 assets_user/        # Tài nguyên cho người dùng
│   ├── css/              # File CSS
│   ├── img/              # Hình ảnh
│   └── js/               # JavaScript
├── 📁 assets_admin/       # Tài nguyên cho admin
│   ├── css/              # File CSS admin
│   └── img/              # Hình ảnh admin
├── 📁 upload/             # Thư mục upload
│   ├── avatar/           # Avatar người dùng
│   └── product/          # Hình ảnh sản phẩm
├── index.php             # Điểm vào chính
├── admin.php             # Trang quản trị
├── global.php            # Cấu hình toàn cục
└── shoptu.sql           # Cơ sở dữ liệu
```

## 🛠️ Công nghệ sử dụng

- **Backend**: PHP thuần (không framework)
- **Database**: MySQL/MariaDB
- **Frontend**: HTML, CSS, JavaScript
- **Server**: Apache/Nginx + PHP
- **Database Connection**: PDO (PHP Data Objects)

## ⚙️ Cài đặt và cấu hình

### Yêu cầu hệ thống:
- PHP 7.4 trở lên
- MySQL 5.7 trở lên hoặc MariaDB
- Apache/Nginx web server
- XAMPP/WAMP/LAMP (khuyến nghị cho development)

### Hướng dẫn cài đặt:

1. **Clone dự án**:
   ```bash
   git clone https://github.com/tutaki304/ShopTuPHP.git
   cd ShopTuPHP
   ```

2. **Cấu hình database**:
   - Tạo database tên `shoptu`
   - Import file `shoptu.sql` vào database
   ```sql
   CREATE DATABASE shoptu;
   USE shoptu;
   SOURCE shoptu.sql;
   ```

3. **Cấu hình kết nối database**:
   Chỉnh sửa file `model/connect.php`:
   ```php
   $dburl = "mysql:host=localhost; dbname=shoptu;charset=utf8";
   $username = 'root';        // Tên đăng nhập MySQL
   $password = '';            // Mật khẩu MySQL
   ```

4. **Cấu hình web server**:
   - Đặt thư mục dự án vào document root của web server
   - Đảm bảo thư mục `upload/` có quyền ghi (chmod 755)

5. **Truy cập website**:
   - Trang chủ: `http://localhost/ShopTuPHP/`
   - Trang quản trị: `http://localhost/ShopTuPHP/admin.php`

## 📊 Cơ sở dữ liệu

Hệ thống sử dụng các bảng chính:
- `sanpham`: Thông tin sản phẩm
- `danhmuc`: Danh mục sản phẩm
- `taikhoan`: Tài khoản người dùng
- `binhluan`: Bình luận sản phẩm
- `cart`: Giỏ hàng

## 🔧 Cấu hình

### File cấu hình chính:
- `global.php`: Các hằng số và biến toàn cục
- `model/connect.php`: Cấu hình kết nối database

### Phân quyền:
- **Guest**: Xem sản phẩm, đăng ký tài khoản
- **User**: Đăng nhập, mua hàng, bình luận
- **Admin**: Quản lý toàn bộ hệ thống

## 🚀 Sử dụng

### Điều hướng URL:
- Trang chủ: `?mod=page&act=home`
- Sản phẩm: `?mod=product&act=list`
- Đăng nhập: `?mod=user&act=login`
- Giỏ hàng: `?mod=cart&act=view`

### Quản trị:
- Dashboard: `admin.php?mod=page&act=dashboard`
- Quản lý sản phẩm: `admin.php?mod=product&act=list`

## 📝 Tính năng nổi bật

1. **Kiến trúc MVC rõ ràng**: Tách biệt logic, dữ liệu và giao diện
2. **Responsive design**: Tương thích đa thiết bị
3. **Upload file**: Hỗ trợ upload hình ảnh sản phẩm
4. **Phân trang**: Hiển thị sản phẩm có phân trang
5. **Tìm kiếm**: Tìm kiếm sản phẩm theo từ khóa
6. **Giỏ hàng session**: Lưu trữ giỏ hàng trong session

## 🤝 Đóng góp

Mọi đóng góp đều được chào đón! Vui lòng:
1. Fork dự án
2. Tạo branch mới (`git checkout -b feature/AmazingFeature`)
3. Commit thay đổi (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Mở Pull Request

## 📄 License

Dự án này được phát hành dưới giấy phép MIT. Xem file `LICENSE` để biết thêm chi tiết.

## 👨‍💻 Tác giả

- **tutaki304** - TuCodeDao - [GitHub](https://github.com/tutaki304)

## 📞 Liên hệ

Nếu có bất kỳ câu hỏi nào, vui lòng liên hệ qua:
- GitHub Issues: [ShopTuPHP Issues](https://github.com/tutaki304/ShopTuPHP/issues)
- Email: tobatu3004@gmail.com

---

⭐ Nếu dự án hữu ích, hãy ủng hộ qua stk 9999999787979 Tô Bá Tú MB Bank!
