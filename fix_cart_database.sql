-- Fix for cart quantity bug
-- Add soluong (quantity) column to chitiethoadon table

ALTER TABLE `chitiethoadon` ADD COLUMN `soluong` INT(11) NOT NULL DEFAULT 1 AFTER `masp`;

-- Update existing cart items to have quantity = 1
UPDATE `chitiethoadon` SET `soluong` = 1 WHERE `soluong` = 0 OR `soluong` IS NULL;

-- Remove duplicate cart items and consolidate quantities
-- First, create a temporary table with consolidated quantities
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
