<?php
    include_once 'model/connect.php';

    //kiểm tra có giỏ hàng hay chưa
    function get_hasCart($makh){
        return pdo_query_one("SELECT * FROM hoadon WHERE makh=? AND trangthai=?",$makh, 'gio-hang');
    }
    
    // chưa có thì thêm vào giỏ hàng
    function get_cartAdd($makh){
        pdo_execute("INSERT INTO hoadon(`makh`,`ngaydathang`,`tongtien`,`ghichu`,`trangthai`) VALUES(?,?,?,?,?)", $makh, date('Y-m-d H:i:s'), 0, '', 'gio-hang');
    }
    
    // thêm sản phẩm vào giỏ hàng với quantity
    function get_addToCart($mahd, $masp, $soluong = 1){
        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $existing = pdo_query_one("SELECT * FROM chitiethoadon WHERE mahd=? AND masp=?", $mahd, $masp);
        
        if($existing) {
            // Nếu đã có, cập nhật số lượng
            $newQuantity = $existing['soluong'] + $soluong;
            pdo_execute("UPDATE chitiethoadon SET soluong=? WHERE mahd=? AND masp=?", $newQuantity, $mahd, $masp);
        } else {
            // Nếu chưa có, thêm mới
            pdo_execute("INSERT INTO chitiethoadon(`mahd`,`masp`,`soluong`) VALUES(?,?,?)", $mahd, $masp, $soluong);
        }
    }
    
    // cập nhật số lượng sản phẩm trong giỏ hàng
    function get_updateCartQuantity($mahd, $masp, $soluong){
        if($soluong <= 0) {
            // Nếu số lượng <= 0, xóa sản phẩm khỏi giỏ hàng
            get_removeFromCart($mahd, $masp);
        } else {
            pdo_execute("UPDATE chitiethoadon SET soluong=? WHERE mahd=? AND masp=?", $soluong, $mahd, $masp);
        }
    }

    //hiển thị chi tiết giỏ hàng với số lượng
    function get_Cart($makh){
        return pdo_query("SELECT hd.*, ct.soluong, sp.* FROM hoadon hd 
                         INNER JOIN chitiethoadon ct ON hd.mahd = ct.mahd 
                         INNER JOIN sanpham sp ON ct.masp = sp.masp 
                         WHERE hd.makh=? AND hd.trangthai=?",$makh, 'gio-hang');
    }
    
    // lấy tổng số lượng sản phẩm trong giỏ hàng
    function get_cartTotalQuantity($makh){
        $result = pdo_query_one("SELECT SUM(ct.soluong) as total FROM hoadon hd 
                                INNER JOIN chitiethoadon ct ON hd.mahd = ct.mahd 
                                WHERE hd.makh=? AND hd.trangthai=?", $makh, 'gio-hang');
        return $result ? (int)$result['total'] : 0;
    }
    
    // lấy tổng tiền giỏ hàng
    function get_cartTotalPrice($makh){
        $result = pdo_query_one("SELECT SUM(ct.soluong * sp.giasp) as total FROM hoadon hd 
                                INNER JOIN chitiethoadon ct ON hd.mahd = ct.mahd 
                                INNER JOIN sanpham sp ON ct.masp = sp.masp
                                WHERE hd.makh=? AND hd.trangthai=?", $makh, 'gio-hang');
        return $result ? (int)$result['total'] : 0;
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
