<?php
    include_once 'model/connect.php';

    //kiểm tra có giỏ hàng hay chưa
    function get_hasCart($makh){
        return pdo_query_one("SELECT * FROM hoadon WHERE makh=? AND trangthai=?",$makh, 'gio-hang');
    }
    // chưa có thì thêm vào giỏ hàng
    function get_cartAdd($makh){
        pdo_execute("INSERT INTO hoadon(`makh`,`ngaydathang`,`tongtien`,`ghichu`,`trangthai`) VALUES(?,?,?,?,?)", $makh, date('Y-m-d H:i:s'),'int', 'text', 'gio-hang');
    }
    // thêm sản phẩm vào ctsanpham
    function get_addToCart($mahd, $masp){
        pdo_execute("INSERT INTO chitiethoadon(`mahd`,`masp`) VALUES(?,?)", $mahd, $masp);
    }

    //hiển thị chi tiết giỏ hàng
    function get_Cart($makh){
        return pdo_query("SELECT * FROM hoadon hd INNER JOIN chitiethoadon ct ON hd.mahd = 
        ct.mahd INNER JOIN sanpham sp ON ct.masp = sp.masp WHERE hd.makh=? AND hd.trangthai=?",$makh, 'gio-hang');
    }
    // xoá 1 sản phẩm trong giỏ hàng
    function get_removeFromCart($mahd, $masp){
        pdo_execute("DELETE FROM chitiethoadon WHERE mahd=? AND masp=?",$mahd, $masp);
    }
   // xoá tất cả sản phẩm trong giỏ hàng
    function get_removeCart($mahd){
        pdo_execute("DELETE FROM chitiethoadon WHERE mahd=?",$mahd);
    }

    //update giỏ hàng
    function get_updateCart($mahd, $makh, $ngaydathang, $tongtien, $ghichu, $trangthai){
        pdo_execute("UPDATE hoadon SET makh=?, ngaydathang=?, tongtien=?, ghichu=?, trangthai=? WHERE mahd=?",$makh, $ngaydathang, $tongtien, $ghichu, $trangthai, $mahd);
    }
?>
