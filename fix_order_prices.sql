-- SQL Script to Fix Order Total Prices
-- This script calculates order totals from product prices when cart prices are 0

-- Update all orders where tongtien is 0 or NULL
UPDATE hoadon hd 
SET tongtien = (
    SELECT COALESCE(SUM(ct.soluong * 
        CASE 
            WHEN ct.dongia > 0 THEN ct.dongia
            WHEN sp.khuyenmai > 0 THEN sp.khuyenmai  
            ELSE sp.dongia
        END
    ), 0)
    FROM chitiethoadon ct 
    INNER JOIN sanpham sp ON ct.masp = sp.masp
    WHERE ct.mahd = hd.mahd
)
WHERE hd.tongtien = 0 OR hd.tongtien IS NULL;

-- Show statistics
SELECT 
    COUNT(*) as total_orders,
    COUNT(CASE WHEN tongtien > 0 THEN 1 END) as orders_with_price,
    COUNT(CASE WHEN tongtien = 0 THEN 1 END) as orders_without_price,
    SUM(tongtien) as total_revenue
FROM hoadon;

-- Show recent orders with prices
SELECT mahd, tongtien, ngaydathang 
FROM hoadon 
ORDER BY ngaydathang DESC 
LIMIT 10;
