# Hướng dẫn khắc phục lỗi số lượng giỏ hàng

## Vấn đề
Khi thêm 1 sản phẩm vào giỏ hàng nhưng hiển thị hàng trăm sản phẩm do thiết kế database không có trường `soluong` (quantity) trong bảng `chitiethoadon`.

## Giải pháp

### Bước 1: Chạy script SQL để sửa database
1. Mở phpMyAdmin hoặc công cụ quản lý MySQL
2. Chọn database `shoptu`
3. Chạy script SQL trong file `fix_cart_database.sql`:

```sql
-- Add soluong (quantity) column to chitiethoadon table
ALTER TABLE `chitiethoadon` ADD COLUMN `soluong` INT(11) NOT NULL DEFAULT 1 AFTER `masp`;

-- Update existing cart items to have quantity = 1
UPDATE `chitiethoadon` SET `soluong` = 1 WHERE `soluong` = 0 OR `soluong` IS NULL;

-- Remove duplicate cart items and consolidate quantities
CREATE TEMPORARY TABLE temp_cart AS
SELECT `mahd`, `masp`, COUNT(*) as total_quantity
FROM `chitiethoadon`
GROUP BY `mahd`, `masp`;

-- Clear the original table
DELETE FROM `chitiethoadon`;

-- Insert consolidated data back
INSERT INTO `chitiethoadon` (`mahd`, `masp`, `soluong`)
SELECT `mahd`, `masp`, `total_quantity`
FROM temp_cart;

-- Drop the temporary table
DROP TEMPORARY TABLE temp_cart;

-- Add primary key to prevent duplicates
ALTER TABLE `chitiethoadon` ADD PRIMARY KEY (`mahd`, `masp`);
```

### Bước 2: Kiểm tra cấu trúc database mới
Sau khi chạy script, bảng `chitiethoadon` sẽ có cấu trúc:
- `mahd` (int) - Primary Key
- `masp` (int) - Primary Key 
- `soluong` (int) - Số lượng sản phẩm

### Bước 3: Test chức năng
1. Đăng nhập vào website
2. Thêm sản phẩm vào giỏ hàng
3. Kiểm tra số lượng hiển thị đúng
4. Test tăng/giảm số lượng trong giỏ hàng
5. Test xóa sản phẩm khỏi giỏ hàng

## Cải tiến đã thực hiện

### 1. Model cart.php
- Thêm hàm `get_updateCartQuantity()` để cập nhật số lượng
- Thêm hàm `get_cartTotalQuantity()` và `get_cartTotalPrice()`
- Cải thiện hàm `get_addToCart()` để xử lý số lượng thay vì tạo duplicate rows

### 2. Controller product.php
- Thêm endpoint AJAX `updateQuantity` để cập nhật số lượng real-time
- Trả về JSON response cho frontend

### 3. View page_giohang.php
- Sử dụng AJAX để cập nhật số lượng không reload page
- Hiển thị số lượng từ database field `soluong`
- Improved error handling

### 4. Performance Admin CSS
- Thêm GPU acceleration với `backface-visibility` và `transform`
- Optimized transitions và animations
- Modern gradient designs
- Responsive improvements
- Better scrollbar styling

## Kết quả mong đợi
- Thêm 1 sản phẩm chỉ hiển thị số lượng 1
- Có thể tăng/giảm số lượng trực tiếp trong giỏ hàng
- Tính tổng tiền chính xác theo số lượng
- Admin page chạy mượt mà hơn, giảm lag
- Không có duplicate entries trong database

## Lưu ý
- Backup database trước khi chạy script SQL
- Test trên môi trường development trước
- Clear browser cache sau khi update
