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

    // Tìm kiếm sản phẩm theo từ khóa
    function product_search($keyword){
        $sql = "SELECT s.*, d.tendm FROM sanpham s 
                INNER JOIN danhmuc d ON s.madm = d.madm 
                WHERE s.tensp LIKE ? OR d.tendm LIKE ?
                ORDER BY s.masp DESC";
        $search_term = "%$keyword%";
        return pdo_query($sql, $search_term, $search_term);
    }

    // Lấy sản phẩm với pagination
    function get_products_with_pagination($limit, $offset) {
        global $conn;
        $sql = "SELECT s.*, d.tendm FROM sanpham s INNER JOIN danhmuc d ON s.madm = d.madm ORDER BY s.masp DESC LIMIT :limit OFFSET :offset";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Đếm tổng số sản phẩm
    function count_total_products() {
        global $conn;
        $sql = "SELECT COUNT(*) as total FROM sanpham";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    // Cập nhật số lượng sản phẩm
    function update_product_quantity($masp, $quantity_change, $reason = '') {
        try {
            $conn = pdo_get_connection();
            $conn->beginTransaction();
            
            // Lấy số lượng hiện tại
            $current = pdo_query_one("SELECT soluong FROM sanpham WHERE masp = ?", $masp);
            if (!$current) {
                throw new Exception("Không tìm thấy sản phẩm với mã: " . $masp);
            }
            
            $new_quantity = $current['soluong'] + $quantity_change;
            
            // Kiểm tra số lượng không được âm
            if ($new_quantity < 0) {
                throw new Exception("Số lượng sản phẩm không đủ. Hiện có: " . $current['soluong'] . ", cần: " . abs($quantity_change));
            }
            
            // Cập nhật số lượng
            $sql = "UPDATE sanpham SET soluong = ? WHERE masp = ?";
            pdo_execute($sql, $new_quantity, $masp);
            
            // Ghi log thay đổi
            $log_sql = "INSERT INTO stock_log (masp, quantity_change, reason) VALUES (?, ?, ?)";
            pdo_execute($log_sql, $masp, $quantity_change, $reason);
            
            $conn->commit();
            return true;
            
        } catch (Exception $e) {
            if (isset($conn)) {
                $conn->rollback();
            }
            throw $e;
        }
    }

    // Kiểm tra số lượng tồn kho
    function check_stock_availability($masp, $required_quantity) {
        $product = pdo_query_one("SELECT soluong FROM sanpham WHERE masp = ?", $masp);
        if (!$product) {
            return false;
        }
        return $product['soluong'] >= $required_quantity;
    }

    // Lấy sản phẩm sắp hết hàng
    function get_low_stock_products($threshold = 10) {
        $sql = "SELECT s.*, d.tendm FROM sanpham s 
                INNER JOIN danhmuc d ON s.madm = d.madm 
                WHERE s.soluong <= ? 
                ORDER BY s.soluong ASC";
        return pdo_query($sql, $threshold);
    }

    // Lấy lịch sử thay đổi số lượng
    function get_stock_history($masp = null, $limit = 50) {
        $sql = "SELECT sl.*, s.tensp FROM stock_log sl 
                INNER JOIN sanpham s ON sl.masp = s.masp";
        $params = [];
        
        if ($masp) {
            $sql .= " WHERE sl.masp = ?";
            $params[] = $masp;
        }
        
        $sql .= " ORDER BY sl.created_at DESC LIMIT ?";
        $params[] = $limit;
        
        return pdo_query($sql, ...$params);
    }

    // Cập nhật số lượng hàng loạt (dùng cho nhập kho)
    function bulk_update_stock($products_data) {
        try {
            $conn = pdo_get_connection();
            $conn->beginTransaction();
            
            foreach ($products_data as $data) {
                update_product_quantity($data['masp'], $data['quantity_change'], $data['reason']);
            }
            
            $conn->commit();
            return true;
            
        } catch (Exception $e) {
            if (isset($conn)) {
                $conn->rollback();
            }
            throw $e;
        }
    }

?>
