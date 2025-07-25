<?php
    //hiển thị danh mục
    include_once 'model/connect.php';
    function get_categories(){
        global $conn;
        $sql="SELECT * FROM danhmuc";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function get_categoriesID($id){
        return pdo_query_one("SELECT * FROM danhmuc WHERE madm = ?",$id);
    }
    //hiển thị danh mục admin
    function get_danhmuc(){
        return pdo_query("SELECT * FROM danhmuc");

    }

       //thêm danh mục
    function add_danhmuc($tendm, $soluongsp, $thutu){
        global $conn;
        $sql = "INSERT INTO danhmuc (`tendm`,`soluongsp`,`thutu`) VALUES (:tendm, :soluongsp, :thutu)";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":tendm", $tendm);
        $stmt->bindParam(":soluongsp", $soluongsp);
        $stmt->bindParam(":thutu", $thutu);
        return $stmt->execute();
    }

    function edit_danhmuc($madm, $tendm, $soluongsp, $thutu){
        pdo_execute("UPDATE danhmuc SET tendm=?, soluongsp=?, thutu=? WHERE madm=?",$tendm, $soluongsp, $thutu,  $madm);
    }

    function get_adminDanhmuc($madm){
        global $conn;//Sử dụng từ khóa global để sử dụng biến $conn  
        //Định nghĩa một câu truy vấn SQL để lấy thông tin của tài khoản từ bảng taikhoan
        $sql = "SELECT * FROM danhmuc WHERE madm=:madm";
        $conn = pdo_get_connection();//lấy kết nối đến cơ sở dữ liêu 
        $stmt = $conn->prepare($sql);//câu truy vấn
        // Liên kết tham số trong câu truy vấn với giá trị của biến $makh
        $stmt->bindParam(":madm", $madm, PDO::PARAM_INT);
        $stmt->execute();//thực hiện câu truy vấn
        return $stmt->fetch(); // chỉ lấy 1 makh
    }

    function delete_danhmuc($madm){
        pdo_execute("DELETE FROM danhmuc WHERE madm=?",$madm);
    }
?>