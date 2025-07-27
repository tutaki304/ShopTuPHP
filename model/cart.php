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
            // Nếu đã có, chỉ cộng thêm 1 (không cộng thêm $soluong để tránh tăng quá nhiều)
            $newQuantity = $existing['soluong'] + 1;
            pdo_execute("UPDATE chitiethoadon SET soluong=? WHERE mahd=? AND masp=?", $newQuantity, $mahd, $masp);
            
            // Log để debug
            error_log("Updated cart: Product $masp quantity from {$existing['soluong']} to $newQuantity");
        } else {
            // Nếu chưa có, thêm mới với số lượng = 1
            pdo_execute("INSERT INTO chitiethoadon(`mahd`,`masp`,`soluong`) VALUES(?,?,?)", $mahd, $masp, 1);
            
            // Log để debug
            error_log("Added new to cart: Product $masp with quantity 1");
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
        return pdo_query("SELECT hd.mahd, ct.soluong, sp.masp, sp.tensp, sp.anh, sp.dongia, sp.khuyenmai 
                         FROM hoadon hd 
                         INNER JOIN chitiethoadon ct ON hd.mahd = ct.mahd 
                         INNER JOIN sanpham sp ON ct.masp = sp.masp 
                         WHERE hd.makh=? AND hd.trangthai=?
                         GROUP BY ct.masp",$makh, 'gio-hang');
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
    
    // Dọn dẹp giỏ hàng duplicate (fix bug số lượng sai)
    function clean_duplicate_cart_items($makh) {
        // Lấy mahd của giỏ hàng
        $cart = get_hasCart($makh);
        if (!$cart) return;
        
        $mahd = $cart['mahd'];
        
        // Lấy tất cả items trùng lặp
        $duplicates = pdo_query("SELECT masp, COUNT(*) as count, SUM(soluong) as total_qty 
                                FROM chitiethoadon 
                                WHERE mahd=? 
                                GROUP BY masp 
                                HAVING COUNT(*) > 1", $mahd);
        
        foreach($duplicates as $dup) {
            // Xóa tất cả records cũ
            pdo_execute("DELETE FROM chitiethoadon WHERE mahd=? AND masp=?", $mahd, $dup['masp']);
            
            // Thêm lại 1 record với tổng số lượng
            pdo_execute("INSERT INTO chitiethoadon(mahd, masp, soluong) VALUES(?,?,?)", 
                       $mahd, $dup['masp'], $dup['total_qty']);
        }
    }
?>
