<?php
    //lấy tất cả sản phẩm
    function get_products($madm=0,$start=0,$limit=0){
        global $conn;
        $sql = "SELECT s.*, d.tendm FROM sanpham s INNER JOIN danhmuc d ON s.madm = d.madm";
        if($madm!=0){
            $sql .= " WHERE s.madm=".$madm;
        }
        if ($limit!=0) {
            $sql .= " LIMIT ".$start.",".$limit;
        }
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    // lấy id
    function get_product($id){
        global $conn;
        $sql = "SELECT s.*, d.tendm FROM sanpham s INNER JOIN danhmuc d ON s.madm = d.madm WHERE s.masp=".$id;
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();//chỉ lấy 1 sẩn phẩm
    }
    // hiển thị sản phẩm mới nhất
    function get_productNew($limit){
        global $conn;
        $sql = "SELECT * FROM sanpham ORDER BY masp DESC LIMIT $limit";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    // hiển thị sản phẩm có lượt xem nhìu nhất
    function get_productView($limit){
        global $conn;
        $sql = "SELECT * FROM sanpham ORDER BY soluotxem DESC LIMIT $limit";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //hiển thị 1 san pham
    function count_products(){
        global $conn;
        $sql = "SELECT count(*) AS soluong FROM sanpham";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();//chỉ lấy 1 sẩn phẩm
    }
    // hiển thị theo danh sách sản phẩm:
    function get_ByCategories($id){
        return pdo_query("SELECT * FROM sanpham WHERE madm=$id");
    }

    // hiển thị sản phẩm cùng danh mục
    function get_randomByCategories($id){
        global $conn;
        $sql = "SELECT * FROM sanpham WHERE madm = $id ORDER BY rand() LIMIT 4 ";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(); // Sử dụng getAll để lấy tất cả các hàng đã chọn
    }
    
    //thêm sản phẩm
    function add_product($tensp,$dongia,$khuyenmai,$soluong,$mota,$anh,$madm){
        global $conn;
        $sql = "INSERT INTO sanpham (`tensp`,`dongia`,`khuyenmai`,`soluong`,`mota`,`anh`,`madm`) VALUES (:tensp, :dongia, :khuyenmai, :soluong, :mota, :anh, :madm)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":tensp", $tensp);
        $stmt->bindParam(":dongia", $dongia);
        $stmt->bindParam(":khuyenmai", $khuyenmai);
        $stmt->bindParam(":soluong", $soluong);
        $stmt->bindParam(":mota", $mota);
        $stmt->bindParam(":anh", $anh);
        $stmt->bindParam(":madm", $madm);
        return $stmt->execute();
    }
 
   
   //sửa sản phẩm
    function edit_product($masp, $tensp, $dongia, $khuyenmai, $soluong, $mota, $anh, $madm){
        global $conn;
        $sql = "UPDATE sanpham SET `tensp`=:tensp, `dongia`=:dongia,
         `khuyenmai`=:khuyenmai, `soluong`=:soluong, `mota`=:mota, `anh`=:anh, `madm`=:madm WHERE masp=:masp";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":masp", $masp);
        $stmt->bindParam(":tensp", $tensp);
        $stmt->bindParam(":dongia", $dongia);
        $stmt->bindParam(":khuyenmai", $khuyenmai);
        $stmt->bindParam(":soluong", $soluong);
        $stmt->bindParam(":mota", $mota);
        $stmt->bindParam(":anh", $anh);
        $stmt->bindParam(":madm", $madm);
        return $stmt->execute();
    }
    //xoá sản phẩm
    function delete_product($masp){
        global $conn;
        $sql = "DELETE FROM sanpham WHERE masp=:masp";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":masp",$masp);
        return $stmt->execute();
    }

    // function product_search($keyword){
    //     return pdo_query("SELECT * FROM sanpham WHERE tensp LIKE '%$keyword%'");
    // }

?>
