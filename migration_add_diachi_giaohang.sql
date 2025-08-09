-- Migration: Thêm cột diachi_giaohang vào bảng hoadon
-- Chạy script này trong phpMyAdmin để cập nhật database

-- Thêm cột diachi_giaohang (chỉ chạy nếu cột chưa tồn tại)
SET @sql = (
    SELECT 
        CASE 
            WHEN COUNT(*) = 0 THEN 'ALTER TABLE `hoadon` ADD COLUMN `diachi_giaohang` TEXT NULL AFTER `ghichu`;'
            ELSE 'SELECT ''Cột diachi_giaohang đã tồn tại'' as message;'
        END
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_NAME = 'hoadon' 
      AND COLUMN_NAME = 'diachi_giaohang'
      AND TABLE_SCHEMA = DATABASE()
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Kiểm tra kết quả
DESCRIBE `hoadon`;
