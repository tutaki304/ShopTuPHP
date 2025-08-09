<?php
// Tạo ảnh avatar mặc định
$width = 100;
$height = 100;

// Tạo canvas
$image = imagecreate($width, $height);

// Định nghĩa màu
$bg_color = imagecolorallocate($image, 108, 117, 125); // Màu xám
$text_color = imagecolorallocate($image, 255, 255, 255); // Màu trắng

// Vẽ nền
imagefill($image, 0, 0, $bg_color);

// Thêm chữ "USER" ở giữa
$font_size = 5;
$text = "USER";
$text_x = ($width - strlen($text) * imagefontwidth($font_size)) / 2;
$text_y = ($height - imagefontheight($font_size)) / 2;
imagestring($image, $font_size, $text_x, $text_y, $text, $text_color);

// Lưu ảnh
imagepng($image, 'upload/avatar/default.png');
imagedestroy($image);

echo "Avatar mặc định đã được tạo thành công!";
?>
