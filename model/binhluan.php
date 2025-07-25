<?php
    //Bình luận
    include_once 'model/connect.php';
    function comment_add($makh, $masp, $noidung){
        pdo_execute("INSERT INTO binhluan(`makh`,`masp`,`noidung`) VALUES(?,?,?)",$makh, $masp, $noidung);
    }

    //hiển thị bình luận
    function comment_Sanpham($masp){
        return pdo_query("SELECT * FROM binhluan bl INNER JOIN taikhoan tk ON bl.makh = tk.makh 
        WHERE bl.masp=?",$masp);
    }
    // lấy cả bình luận hiển thị trong admin
    function get_binhluan(){
        return pdo_query("SELECT * FROM binhluan");

    }
    //xóa bình luận
    function delete_binhluan($mabl){
        pdo_execute("DELETE FROM binhluan WHERE mabl=?",$mabl);
    }
?>