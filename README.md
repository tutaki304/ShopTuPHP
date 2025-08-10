# 🛒 ShopTuPHP - Hệ thống Thương mại Điện tử Hoàn chỉnh

<div align="center">

![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

*Một hệ thống thương mại điện tử hiện đại được xây dựng bằng PHP với kiến trúc MVC*

</div>

---

## 📋 Mục lục

1. [📖 Giới thiệu dự án](#-giới-thiệu-dự-án)
2. [🎯 Mục tiêu và ý nghĩa](#-mục-tiêu-và-ý-nghĩa)
3. [⚡ Tính năng nổi bật](#-tính-năng-nổi-bật)
4. [🏗️ Kiến trúc hệ thống](#️-kiến-trúc-hệ-thống)
5. [💻 Công nghệ sử dụng](#-công-nghệ-sử-dụng)
6. [📁 Cấu trúc dự án](#-cấu-trúc-dự-án)
7. [🗄️ Cơ sở dữ liệu](#️-cơ-sở-dữ-liệu)
8. [🚀 Cài đặt và triển khai](#-cài-đặt-và-triển-khai)
9. [👥 Hướng dẫn sử dụng](#-hướng-dẫn-sử-dụng)
10. [🛡️ Bảo mật](#️-bảo-mật)
11. [📊 Demo và Screenshots](#-demo-và-screenshots)
12. [🔧 API Documentation](#-api-documentation)
13. [❓ FAQ & Troubleshooting](#-faq--troubleshooting)
14. [👨‍💻 Thông tin phát triển](#-thông-tin-phát-triển)

---

## 📖 Giới thiệu dự án

**ShopTuPHP** là một hệ thống thương mại điện tử (E-commerce) được phát triển hoàn toàn bằng **PHP thuần** với kiến trúc **MVC (Model-View-Controller)**. Dự án được thiết kế để mô phỏng một cửa hàng trực tuyến thực tế với đầy đủ các chức năng cần thiết cho cả **người mua hàng** và **quản trị viên**.

### 🌟 Điểm đặc biệt

- **100% PHP thuần**: Không sử dụng framework, giúp hiểu rõ bản chất của web development
- **Kiến trúc MVC**: Tách biệt rõ ràng giữa logic xử lý, dữ liệu và giao diện
- **Responsive Design**: Tương thích hoàn hảo trên desktop, tablet và mobile
- **Admin Panel hiện đại**: Giao diện quản trị trực quan với Tailwind CSS
- **Bảo mật cao**: Sử dụng PDO, prepared statements và validation mạnh mẽ

---

## 🎯 Mục tiêu và ý nghĩa

### 🎓 Mục tiêu học tập
- Nắm vững kiến trúc MVC trong PHP
- Hiểu rõ quy trình phát triển website thương mại điện tử
- Thực hành các kỹ thuật bảo mật web
- Tối ưu hóa hiệu suất và trải nghiệm người dùng

### 💼 Ý nghĩa thực tiễn
- Mô phỏng hệ thống thực tế của các trang thương mại điện tử
- Có thể mở rộng thành sản phẩm thương mại
- Phù hợp cho doanh nghiệp nhỏ và vừa
- Template cơ sở cho các dự án tương tự

---

## ⚡ Tính năng nổi bật

### 🛍️ **Phía khách hàng (Frontend)**

#### 🏠 **Trang chủ & Duyệt sản phẩm**
- ✅ Hiển thị sản phẩm nổi bật và khuyến mãi
- ✅ Duyệt sản phẩm theo danh mục
- ✅ Tìm kiếm sản phẩm với bộ lọc thông minh
- ✅ Sắp xếp theo giá, tên, ngày thêm
- ✅ Phân trang tự động

#### 🔍 **Chi tiết sản phẩm**
- ✅ Hiển thị thông tin chi tiết sản phẩm
- ✅ Gallery hình ảnh với zoom
- ✅ Đánh giá và bình luận của khách hàng
- ✅ Sản phẩm liên quan và gợi ý
- ✅ Chia sẻ mạng xã hội

#### 🛒 **Giỏ hàng & Thanh toán**
- ✅ Thêm/xóa sản phẩm vào giỏ hàng
- ✅ Cập nhật số lượng real-time
- ✅ Tính toán tổng tiền tự động
- ✅ Quy trình checkout đơn giản
- ✅ Nhiều phương thức thanh toán

#### 👤 **Quản lý tài khoản**
- ✅ Đăng ký/đăng nhập an toàn
- ✅ Quản lý thông tin cá nhân
- ✅ Lịch sử đơn hàng chi tiết
- ✅ Upload và thay đổi avatar
- ✅ Đổi mật khẩu bảo mật

### 🎛️ **Phía quản trị (Backend)**

#### 📊 **Dashboard thông minh**
- ✅ Thống kê tổng quan doanh thu, đơn hàng, sản phẩm
- ✅ Biểu đồ trực quan theo thời gian thực
- ✅ Top sản phẩm bán chạy và khách hàng VIP
- ✅ Thông báo hệ thống và cảnh báo
- ✅ Quick actions để thao tác nhanh

#### 📦 **Quản lý sản phẩm**
- ✅ CRUD sản phẩm với editor WYSIWYG
- ✅ Upload nhiều hình ảnh với drag & drop
- ✅ Quản lý kho hàng và tồn kho
- ✅ Import/Export sản phẩm Excel
- ✅ Sao chép và duplicate sản phẩm

#### 📋 **Quản lý đơn hàng**
- ✅ Xem và cập nhật trạng thái đơn hàng
- ✅ In hóa đơn và phiếu giao hàng
- ✅ Thống kê doanh thu theo kỳ
- ✅ Quản lý khách hàng và lịch sử mua hàng
- ✅ Báo cáo chi tiết theo nhiều tiêu chí

#### 👥 **Quản lý người dùng**
- ✅ Quản lý tài khoản khách hàng và admin
- ✅ Phân quyền và vai trò người dùng
- ✅ Theo dõi hoạt động đăng nhập
- ✅ Khóa/mở khóa tài khoản
- ✅ Thống kê người dùng mới

#### 🏷️ **Quản lý danh mục & Nội dung**
- ✅ Tổ chức danh mục theo cây thư mục
- ✅ SEO-friendly URLs
- ✅ Quản lý banner và quảng cáo
- ✅ Cấu hình email template
- ✅ Quản lý trang tĩnh (About, Contact, Terms)

---

## 🏗️ Kiến trúc hệ thống

### 📐 **Mô hình MVC**

```
┌─────────────────────────────────────────────────────────┐
│                    🌐 VIEW LAYER                        │
│  ┌─────────────────┐    ┌─────────────────────────────┐ │
│  │   Frontend UI   │    │     Admin Dashboard         │ │
│  │  (User Pages)   │    │    (Management Panel)      │ │
│  └─────────────────┘    └─────────────────────────────┘ │
└─────────────────────────────────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────┐
│                 🎮 CONTROLLER LAYER                     │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────────┐ │
│  │    Page     │  │   Product   │  │      User       │ │
│  │ Controller  │  │ Controller  │  │   Controller    │ │
│  └─────────────┘  └─────────────┘  └─────────────────┘ │
└─────────────────────────────────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────┐
│                  💾 MODEL LAYER                         │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────────┐ │
│  │  Products   │  │    Users    │  │      Cart       │ │
│  │   Model     │  │    Model    │  │     Model       │ │
│  └─────────────┘  └─────────────┘  └─────────────────┘ │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────────┐ │
│  │ Categories  │  │   Orders    │  │    Comments     │ │
│  │   Model     │  │    Model    │  │     Model       │ │
│  └─────────────┘  └─────────────┘  └─────────────────┘ │
└─────────────────────────────────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────┐
│                  🗄️ DATABASE LAYER                      │
│                    MySQL Database                       │
│              (Optimized with Indexes)                   │
└─────────────────────────────────────────────────────────┘
```

### 🔄 **Luồng xử lý Request**

1. **Request từ User** → Router (index.php, admin.php)
2. **Router** → Controller tương ứng
3. **Controller** → Model để xử lý dữ liệu
4. **Model** → Database để truy vấn
5. **Database** → Model trả về kết quả
6. **Model** → Controller xử lý logic
7. **Controller** → View để render giao diện
8. **View** → Response về User

---

## 💻 Công nghệ sử dụng

### 🔧 **Backend Technologies**
| Công nghệ | Phiên bản | Mục đích sử dụng |
|-----------|-----------|-------------------|
| ![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=flat&logo=php) | 8.0+ | Core backend language |
| ![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=flat&logo=mysql) | 5.7+ | Primary database |
| ![PDO](https://img.shields.io/badge/PDO-Enabled-green?style=flat) | Built-in | Database abstraction layer |

### 🎨 **Frontend Technologies**
| Công nghệ | Phiên bản | Mục đích sử dụng |
|-----------|-----------|-------------------|
| ![HTML5](https://img.shields.io/badge/HTML5-Semantic-E34F26?style=flat&logo=html5) | 5 | Markup language |
| ![CSS3](https://img.shields.io/badge/CSS3-Modern-1572B6?style=flat&logo=css3) | 3 | Styling & animations |
| ![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=flat&logo=javascript) | ES6+ | Client-side interactions |
| ![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat&logo=bootstrap) | 5.3 | CSS framework (User pages) |
| ![Tailwind](https://img.shields.io/badge/Tailwind-3.0-06B6D4?style=flat&logo=tailwindcss) | 3.0 | CSS framework (Admin panel) |
| ![FontAwesome](https://img.shields.io/badge/FontAwesome-6.0-528DD7?style=flat&logo=fontawesome) | 6.0 | Icon library |

### 📦 **Libraries & Tools**
- **Font**: Inter (Google Fonts)
- **Charts**: Chart.js cho dashboard analytics
- **Image Upload**: Custom drag & drop solution
- **Validation**: Client-side + Server-side validation
- **Security**: CSRF protection, XSS prevention, SQL injection protection

---

## 📁 Cấu trúc dự án

```
ShopTuPHP/
├── 📄 index.php                 # Entry point cho frontend
├── 📄 admin.php                 # Entry point cho admin panel
├── 📄 global.php               # Global configurations
├── 📄 shoptu.sql               # Database schema & sample data
├── 📄 README.md                # Documentation (file này)
│
├── 📁 controller/              # 🎮 Controllers (Business Logic)
│   ├── 📄 page.php            # ├─ Page routing & general pages
│   ├── 📄 product.php         # ├─ Product management & display
│   └── 📄 user.php            # └─ User authentication & management
│
├── 📁 model/                   # 💾 Models (Data Layer)
│   ├── 📄 connect.php         # ├─ Database connection (PDO)
│   ├── 📄 products.php        # ├─ Product data operations
│   ├── 📄 categories.php      # ├─ Category management
│   ├── 📄 user.php            # ├─ User data & authentication
│   ├── 📄 cart.php            # ├─ Shopping cart operations
│   └── 📄 binhluan.php        # └─ Comments & reviews
│
├── 📁 view/                    # 🖼️ Views (Presentation Layer)
│   ├── 📄 template_head.php        # ├─ HTML head & meta tags
│   ├── 📄 template_header.php      # ├─ Site header & navigation
│   ├── 📄 template_footer.php      # ├─ Site footer
│   │
│   ├── 🏠 Frontend Pages
│   ├── 📄 page_home.php           # ├─ Homepage layout
│   ├── 📄 page_sanpham.php        # ├─ Product listing
│   ├── 📄 page_ctsanpham.php      # ├─ Product detail page
│   ├── 📄 page_danhmuc_detail.php # ├─ Category page
│   ├── 📄 page_giohang.php        # ├─ Shopping cart
│   ├── 📄 page_login.php          # ├─ Login form
│   ├── 📄 page_signup.php         # ├─ Registration form
│   ├── 📄 page_gioithieu.php      # ├─ About page
│   ├── 📄 page_contact.php        # ├─ Contact page
│   ├── 📄 page_product_search.php # └─ Search results
│   │
│   ├── 🎛️ Admin Pages
│   ├── 📄 template_admin_head.php     # ├─ Admin HTML head
│   ├── 📄 template_admin_header.php   # ├─ Admin header & nav
│   ├── 📄 template_admin_footer.php   # ├─ Admin footer
│   ├── 📄 page_dashboard.php          # ├─ Admin dashboard
│   ├── 📄 product_admin.php           # ├─ Product management
│   ├── 📄 product_add.php             # ├─ Add new product
│   ├── 📄 product_edit.php            # ├─ Edit product
│   ├── 📄 product_danhmuc.php         # ├─ Category management
│   ├── 📄 product_add_danhmuc.php     # ├─ Add category
│   ├── 📄 product_edit_danhmuc.php    # ├─ Edit category
│   ├── 📄 product_user.php            # ├─ User management
│   ├── 📄 product_add_taikhoan.php    # ├─ Add user
│   ├── 📄 product_edit_taikhoan.php   # ├─ Edit user
│   └── 📄 product_binhluan.php        # └─ Comment management
│
├── 📁 assets_user/             # 🎨 Frontend Assets
│   ├── 📁 css/
│   │   ├── 📄 style.css       # ├─ Main frontend styles
│   │   ├── 📄 login.css       # ├─ Login page styles
│   │   ├── 📄 signup.css      # ├─ Registration styles
│   │   ├── 📄 giohang.css     # ├─ Shopping cart styles
│   │   └── 📄 ctsanpham.css   # └─ Product detail styles
│   ├── 📁 img/                # ├─ Frontend images & icons
│   └── 📁 js/                 # └─ Frontend JavaScript
│
├── 📁 assets_admin/            # ⚙️ Admin Assets
│   ├── 📁 css/
│   │   ├── 📄 admin.css       # ├─ Main admin styles
│   │   ├── 📄 product_add.css # ├─ Add product form styles
│   │   └── 📄 product_edit.css# └─ Edit product form styles
│   └── 📁 img/                # └─ Admin images & icons
│
└── 📁 upload/                  # 📷 User Uploads
    ├── 📁 product/             # ├─ Product images
    └── 📁 avatar/              # └─ User avatars
```

### 📋 **Mô tả chi tiết các thành phần**

#### 🎮 **Controllers**
- **`page.php`**: Xử lý routing và các trang tĩnh (home, about, contact)
- **`product.php`**: Quản lý sản phẩm, danh mục, tìm kiếm
- **`user.php`**: Authentication, user management, profile

#### 💾 **Models** 
- **`connect.php`**: PDO database connection với error handling
- **`products.php`**: CRUD operations cho sản phẩm
- **`categories.php`**: Quản lý danh mục sản phẩm
- **`user.php`**: User authentication và profile management
- **`cart.php`**: Shopping cart logic và session management
- **`binhluan.php`**: Comment system với spam protection

#### 🖼️ **Views**
- **Templates**: Reusable components cho header, footer, navigation
- **Frontend Pages**: User-facing pages với responsive design
- **Admin Pages**: Management interface với modern UI

---

## 🗄️ Cơ sở dữ liệu

### 📊 **Database Schema**

```sql
📋 Database: shoptu_db

┌─────────────────────────────────────────────────────────┐
│                    🗃️ TABLES OVERVIEW                   │
└─────────────────────────────────────────────────────────┘

👥 users                    📦 sanpham (products)
├─ id (PK)                 ├─ masp (PK)
├─ username                ├─ tensp (product name)
├─ email                   ├─ dongia (price)
├─ matkhau (password)      ├─ khuyenmai (sale price)
├─ hoten (full name)       ├─ anh (image)
├─ avatar                  ├─ mota (description)
├─ role (admin/user)       ├─ madm (FK → danhmuc)
├─ created_at              ├─ luotxem (views)
└─ updated_at              └─ ngaytao (created_at)

🏷️ danhmuc (categories)     💬 binhluan (comments)
├─ madm (PK)               ├─ id (PK)
├─ tendm (category name)   ├─ masp (FK → sanpham)
├─ mota (description)      ├─ id_user (FK → users)
├─ thutu (sort order)      ├─ noidung (content)
└─ trangthai (status)      ├─ diem (rating 1-5)
                           └─ ngaybinhluan (date)

🛒 giohang (cart)           📋 hoadon (orders)
├─ id (PK)                 ├─ mahd (PK)
├─ id_user (FK → users)    ├─ id_user (FK → users)
├─ masp (FK → sanpham)     ├─ hoten (customer name)
├─ soluong (quantity)      ├─ email
├─ ngaythem (added_date)   ├─ sdt (phone)
└─ trangthai (status)      ├─ diachi (address)
                           ├─ tongtien (total)
📦 chitiethoadon            ├─ trangthai (status)
├─ id (PK)                 ├─ ngaydathang (order_date)
├─ mahd (FK → hoadon)      └─ ghichu (notes)
├─ masp (FK → sanpham)
├─ soluong (quantity)
├─ dongia (unit_price)
└─ thanhtien (subtotal)
```

### 🔗 **Relationships**

```
users (1) ─────── (n) hoadon
  │                    │
  │                    │
  └─── (n) giohang     └─── (n) chitiethoadon
         │                       │
         │                       │
         └─── (1) sanpham ───────┘
                │
                └─── (n) binhluan
                │
                └─── (1) danhmuc
```

### 📈 **Indexes & Optimization**

```sql
-- Performance Indexes
CREATE INDEX idx_sanpham_madm ON sanpham(madm);
CREATE INDEX idx_sanpham_luotxem ON sanpham(luotxem DESC);
CREATE INDEX idx_sanpham_ngaytao ON sanpham(ngaytao DESC);
CREATE INDEX idx_binhluan_masp ON binhluan(masp);
CREATE INDEX idx_giohang_user ON giohang(id_user);
CREATE INDEX idx_hoadon_user ON hoadon(id_user);
CREATE INDEX idx_hoadon_trangthai ON hoadon(trangthai);

-- Full-text search
ALTER TABLE sanpham ADD FULLTEXT(tensp, mota);
```

---

## 🚀 Cài đặt và triển khai

### 📋 **Yêu cầu hệ thống**

#### 🖥️ **Server Requirements**
- **PHP**: 7.4+ (Khuyến nghị PHP 8.0+)
- **MySQL**: 5.7+ hoặc MariaDB 10.2+
- **Web Server**: Apache 2.4+ hoặc Nginx 1.18+
- **Extensions PHP**:
  ```bash
  ✅ PDO & PDO_MySQL    # Database connectivity
  ✅ GD Library         # Image processing
  ✅ mbstring           # String handling
  ✅ session            # Session management
  ✅ json               # JSON operations
  ✅ fileinfo           # File type detection
  ```

#### 💻 **Client Requirements**
- **Browser**: Chrome 90+, Firefox 88+, Safari 14+, Edge 90+
- **JavaScript**: Enabled
- **Resolution**: 320px+ (Mobile first design)

### ⚡ **Cài đặt nhanh (Quick Setup)**

#### 🔧 **Bước 1: Clone dự án**
```bash
# Clone repository
git clone https://github.com/tutaki304/ShopTuPHP.git
cd ShopTuPHP

# Hoặc download ZIP và giải nén
```

#### 🗄️ **Bước 2: Thiết lập Database**
```sql
-- 1. Tạo database
CREATE DATABASE shoptu_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 2. Import database schema
mysql -u username -p shoptu_db < shoptu.sql

-- 3. Tạo user database (optional)
CREATE USER 'shoptu_user'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON shoptu_db.* TO 'shoptu_user'@'localhost';
FLUSH PRIVILEGES;
```

#### ⚙️ **Bước 3: Cấu hình kết nối**
```php
// File: model/connect.php
$host = 'localhost';
$dbname = 'shoptu_db';
$username = 'shoptu_user';  // Thay đổi username
$password = 'your_password'; // Thay đổi password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", 
                   $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
```

#### 📁 **Bước 4: Thiết lập quyền thư mục**
```bash
# Thiết lập quyền ghi cho thư mục upload
chmod -R 755 upload/
chmod -R 755 upload/product/
chmod -R 755 upload/avatar/

# Tạo .htaccess cho bảo mật (Apache)
echo "Options -Indexes" > upload/.htaccess
```

#### 🌐 **Bước 5: Cấu hình Virtual Host (Optional)**

**Apache Virtual Host:**
```apache
<VirtualHost *:80>
    ServerName shoptu.local
    DocumentRoot /path/to/ShopTuPHP
    
    <Directory /path/to/ShopTuPHP>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/shoptu_error.log
    CustomLog ${APACHE_LOG_DIR}/shoptu_access.log combined
</VirtualHost>
```

**Nginx Configuration:**
```nginx
server {
    listen 80;
    server_name shoptu.local;
    root /path/to/ShopTuPHP;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location /upload {
        autoindex off;
    }
}
```

### 🎯 **Cài đặt chi tiết (Development Setup)**

#### 🐳 **Sử dụng Docker (Khuyến nghị)**
```yaml
# docker-compose.yml
version: '3.8'
services:
  php:
    image: php:8.0-apache
    ports:
      - "80:80"
    volumes:
      - .:/var/www/html
    depends_on:
      - mysql
    environment:
      - APACHE_DOCUMENT_ROOT=/var/www/html
      
  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: rootpassword
      MYSQL_DATABASE: shoptu_db
      MYSQL_USER: shoptu_user
      MYSQL_PASSWORD: shoptu_password
    ports:
      - "3306:3306"
    volumes:
      - mysql_data:/var/lib/mysql
      - ./shoptu.sql:/docker-entrypoint-initdb.d/shoptu.sql

volumes:
  mysql_data:
```

```bash
# Chạy với Docker
docker-compose up -d

# Kiểm tra logs
docker-compose logs -f
```

#### 📱 **Local Development với XAMPP/WAMP**

1. **Download và cài đặt XAMPP**
2. **Copy project vào htdocs**:
   ```bash
   cp -r ShopTuPHP C:/xampp/htdocs/
   ```
3. **Start Apache và MySQL từ XAMPP Control Panel**
4. **Truy cập phpMyAdmin**: `http://localhost/phpmyadmin`
5. **Import database**: Upload file `shoptu.sql`
6. **Truy cập website**: `http://localhost/ShopTuPHP`

### 🔐 **Tài khoản mặc định**

#### 👑 **Admin Account**
```
URL: http://your-domain/admin.php
Username: admin
Password: admin123
Role: Administrator
```

#### 👤 **User Account**
```
URL: http://your-domain/index.php
Username: user1
Password: 123456
Role: Customer
```

### ✅ **Kiểm tra cài đặt**

#### 🩺 **Health Check Script**
```php
<?php
// File: check.php - Tạo file này để kiểm tra
echo "<h2>ShopTuPHP System Check</h2>";

// Check PHP version
echo "✅ PHP Version: " . PHP_VERSION . "<br>";

// Check required extensions
$required = ['pdo', 'pdo_mysql', 'gd', 'mbstring', 'session'];
foreach($required as $ext) {
    echo extension_loaded($ext) ? "✅" : "❌";
    echo " Extension $ext<br>";
}

// Check database connection
try {
    include 'model/connect.php';
    echo "✅ Database connection successful<br>";
} catch(Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
}

// Check upload directory
echo is_writable('upload/') ? "✅" : "❌";
echo " Upload directory writable<br>";

echo "<h3>🎉 Setup completed successfully!</h3>";
?>
```

---

## ❓ FAQ & Troubleshooting

### � **Các lỗi thường gặp**

#### 🔴 **Database Connection Error**
```
Lỗi: "SQLSTATE[HY000] [1045] Access denied for user"

Giải pháp:
1. Kiểm tra username/password trong model/connect.php
2. Đảm bảo MySQL service đang chạy
3. Tạo database và user với quyền phù hợp
4. Kiểm tra host name (localhost vs 127.0.0.1)
```

#### 🔴 **File Upload Error**
```
Lỗi: "Failed to move uploaded file"

Giải pháp:
1. Kiểm tra quyền thư mục upload/: chmod 755
2. Kiểm tra php.ini: upload_max_filesize, post_max_size
3. Đảm bảo thư mục upload/ tồn tại
4. Kiểm tra dung lượng ổ đĩa còn trống
```

#### 🔴 **Session Error**
```
Lỗi: "Warning: session_start(): Cannot send session cookie"

Giải pháp:
1. Đảm bảo không có output trước session_start()
2. Kiểm tra session.save_path trong php.ini
3. Xóa space hoặc BOM ở đầu file PHP
4. Kiểm tra quyền thư mục session
```

#### 🔴 **404 Error - Page Not Found**
```
Lỗi: Trang không tìm thấy

Giải pháp:
1. Kiểm tra .htaccess file (nếu sử dụng Apache)
2. Enable mod_rewrite: sudo a2enmod rewrite
3. Cấu hình Virtual Host đúng DocumentRoot
4. Kiểm tra URL routing trong controller
```

### 💡 **Performance Tips**

#### ⚡ **Tối ưu hóa Database**
```sql
-- Thêm indexes cho performance
CREATE INDEX idx_products_category ON sanpham(madm);
CREATE INDEX idx_products_views ON sanpham(luotxem DESC);
CREATE INDEX idx_orders_status ON hoadon(trangthai);
CREATE INDEX idx_orders_date ON hoadon(ngaydathang DESC);

-- Optimize tables
OPTIMIZE TABLE sanpham;
OPTIMIZE TABLE hoadon;
OPTIMIZE TABLE users;
```

#### 🚀 **Caching Strategy**
```php
// File caching cho queries expensive
function cache_get($key) {
    $file = "cache/" . md5($key) . ".cache";
    if (file_exists($file) && (time() - filemtime($file)) < 3600) {
        return unserialize(file_get_contents($file));
    }
    return false;
}

function cache_set($key, $data) {
    $file = "cache/" . md5($key) . ".cache";
    file_put_contents($file, serialize($data));
}
```

#### 📱 **Image Optimization**
```php
// Resize images automatically
function resize_image($source, $destination, $max_width = 800) {
    list($width, $height, $type) = getimagesize($source);
    
    if ($width > $max_width) {
        $ratio = $max_width / $width;
        $new_width = $max_width;
        $new_height = $height * $ratio;
        
        $image = imagecreatefromjpeg($source);
        $resized = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($resized, $image, 0, 0, 0, 0, 
                          $new_width, $new_height, $width, $height);
        imagejpeg($resized, $destination, 85);
        
        imagedestroy($image);
        imagedestroy($resized);
    }
}
```

### 🔧 **Development Tools**

#### 🐛 **Debug Mode**
```php
// File: config/debug.php
define('DEBUG_MODE', true);

if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    // Debug function
    function debug($var, $die = false) {
        echo "<pre style='background:#f4f4f4;padding:10px;margin:10px;'>";
        print_r($var);
        echo "</pre>";
        if ($die) die();
    }
}
```

#### 📊 **Query Logger**
```php
// File: model/query_logger.php
class QueryLogger {
    private static $queries = [];
    
    public static function log($query, $params = [], $execution_time = 0) {
        self::$queries[] = [
            'query' => $query,
            'params' => $params,
            'time' => $execution_time,
            'trace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3)
        ];
    }
    
    public static function getQueries() {
        return self::$queries;
    }
    
    public static function getTotalTime() {
        return array_sum(array_column(self::$queries, 'time'));
    }
}
```

### 📈 **Monitoring & Analytics**

#### 📊 **Performance Monitoring**
```php
// File: includes/performance.php
class PerformanceMonitor {
    private $start_time;
    private $start_memory;
    
    public function __construct() {
        $this->start_time = microtime(true);
        $this->start_memory = memory_get_usage();
    }
    
    public function getStats() {
        return [
            'execution_time' => microtime(true) - $this->start_time,
            'memory_usage' => memory_get_usage() - $this->start_memory,
            'peak_memory' => memory_get_peak_usage(),
            'queries_count' => QueryLogger::getQueriesCount()
        ];
    }
}
```

---

## 👨‍💻 Thông tin phát triển

### 🎯 **Thông tin dự án**
- **Tên dự án**: ShopTuPHP - E-commerce System
- **Phiên bản**: 2.0.0
- **Ngôn ngữ chính**: PHP 8.0+
- **Framework**: None (Pure PHP)
- **Kiến trúc**: MVC Pattern
- **Database**: MySQL 8.0
- **Frontend**: Bootstrap 5.3 + Tailwind CSS
- **Tác giả**: [Tên tác giả]
- **Email**: [Email liên hệ]
- **GitHub**: https://github.com/tutaki304/ShopTuPHP

### 📅 **Lịch sử phát triển**

#### 🚀 **Version 2.0.0** (Current)
- ✅ Redesigned admin panel với Tailwind CSS
- ✅ Enhanced user authentication & authorization
- ✅ Improved file upload system với drag & drop
- ✅ Advanced search functionality
- ✅ Mobile-first responsive design
- ✅ Performance optimizations
- ✅ Security enhancements

#### 📦 **Version 1.5.0**
- ✅ Added product review system
- ✅ Implemented shopping cart
- ✅ Order management system
- ✅ Basic admin panel

#### 🌱 **Version 1.0.0**
- ✅ Basic MVC structure
- ✅ User registration/login
- ✅ Product catalog
- ✅ Category management

### 🛣️ **Roadmap tương lai**

#### 🎯 **Version 2.1.0** (Upcoming)
- [ ] **Multi-language support** (i18n)
- [ ] **Payment gateway integration** (VNPay, MoMo)
- [ ] **Email notifications** system
- [ ] **Advanced analytics** dashboard
- [ ] **Inventory management** system
- [ ] **Coupon & discount** system

#### 🎯 **Version 2.2.0** (Planned)
- [ ] **RESTful API** with JWT authentication
- [ ] **Mobile app** (React Native)
- [ ] **Real-time notifications** (WebSocket)
- [ ] **Advanced reporting** với Charts.js
- [ ] **Multi-vendor** marketplace
- [ ] **Social media** integration

#### 🎯 **Version 3.0.0** (Future)
- [ ] **Microservices** architecture
- [ ] **Docker** containerization
- [ ] **Cloud deployment** (AWS/Azure)
- [ ] **AI recommendations** engine
- [ ] **Progressive Web App** (PWA)
- [ ] **Machine learning** analytics

### 🤝 **Đóng góp (Contributing)**

Chúng tôi hoan nghênh mọi đóng góp! Để tham gia phát triển:

#### 🔀 **Quy trình Contributing**
```bash
# 1. Fork repository
# 2. Tạo feature branch
git checkout -b feature/amazing-feature

# 3. Commit changes
git commit -m "Add amazing feature"

# 4. Push to branch
git push origin feature/amazing-feature

# 5. Open Pull Request
```

#### 📋 **Coding Standards**
```php
// PSR-12 Coding Standard
<?php
declare(strict_types=1);

namespace App\Models;

class ProductModel 
{
    private PDO $pdo;
    
    public function __construct(PDO $pdo) 
    {
        $this->pdo = $pdo;
    }
    
    public function findById(int $id): ?Product 
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM sanpham WHERE masp = ?"
        );
        $stmt->execute([$id]);
        
        return $stmt->fetch() ?: null;
    }
}
```

#### 🧪 **Testing Guidelines**
- Viết unit tests cho models
- Integration tests cho controllers
- End-to-end tests cho user flows
- Performance tests cho database queries

### 📜 **License**

```
MIT License

Copyright (c) 2025 ShopTuPHP

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

### 🙏 **Acknowledgments**

- **Bootstrap Team** - CSS Framework
- **Font Awesome** - Icon Library  
- **Tailwind CSS** - Utility-first CSS
- **PHP Community** - Language support
- **MySQL** - Database system
- **Stack Overflow** - Community support

### 📞 **Liên hệ & Hỗ trợ**

#### 📧 **Thông tin liên hệ**
- **Email**: support@shoptuphp.com
- **GitHub Issues**: https://github.com/tutaki304/ShopTuPHP/issues
- **Documentation**: https://docs.shoptuphp.com
- **Discord**: https://discord.gg/shoptuphp

#### 🆘 **Báo cáo lỗi**
Khi báo cáo lỗi, vui lòng cung cấp:
- PHP version và environment
- Steps to reproduce
- Expected vs actual behavior
- Error messages và logs
- Screenshots (nếu có)

#### 💬 **Thảo luận**
- **GitHub Discussions**: Cho questions và feature requests
- **Stack Overflow**: Tag với `shoptuphp`
- **Reddit**: r/PHPDevelopers

---

<div align="center">

### 🎉 **Cảm ơn bạn đã sử dụng ShopTuPHP!**

[![Made with ❤️ in Vietnam](https://img.shields.io/badge/Made%20with%20❤️%20in-Vietnam-red?style=for-the-badge)](https://vietnam.travel/)

**⭐ Nếu dự án hữu ích, hãy cho chúng tôi một star trên GitHub! ⭐**

[🌟 Star on GitHub](https://github.com/tutaki304/ShopTuPHP) | 
[📖 Documentation](https://docs.shoptuphp.com) | 
[🐛 Report Bug](https://github.com/tutaki304/ShopTuPHP/issues) | 
[💡 Request Feature](https://github.com/tutaki304/ShopTuPHP/issues)

</div>

---

*README.md này được cập nhật lần cuối: 10/08/2025*

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