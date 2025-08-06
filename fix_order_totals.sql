-- SQL Script để sửa lỗi giá đơn hàng bằng 0
-- Chạy script này để tính lại tổng tiền cho các đơn hàng

-- Hiển thị số đơn hàng bị lỗi trước khi sửa
SELECT 'Số đơn hàng có giá 0đ:' as thong_tin, COUNT(*) as so_luong 
FROM hoadon 
WHERE tongtien = 0 OR tongtien IS NULL;

-- Cập nhật tổng tiền cho các đơn hàng có giá = 0
UPDATE hoadon hd 
SET tongtien = (
    SELECT COALESCE(SUM(ct.soluong * ct.dongia), 0)
    FROM chitiethoadon ct 
    WHERE ct.mahd = hd.mahd
)
WHERE hd.tongtien = 0 OR hd.tongtien IS NULL;

-- Hiển thị kết quả sau khi sửa
SELECT 'Số đơn hàng còn lại có giá 0đ:' as thong_tin, COUNT(*) as so_luong 
FROM hoadon 
WHERE tongtien = 0 OR tongtien IS NULL;

-- Hiển thị các đơn hàng đã được sửa
SELECT mahd, makh, ngaydathang, tongtien, trangthai
FROM hoadon 
WHERE mahd IN (
    SELECT DISTINCT hd.mahd 
    FROM hoadon hd 
    INNER JOIN chitiethoadon ct ON hd.mahd = ct.mahd 
    WHERE hd.tongtien > 0
)
ORDER BY ngaydathang DESC
LIMIT 10;
