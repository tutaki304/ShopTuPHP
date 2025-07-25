<?php
// tương tác với bảng user/taikhoan tong CSDL
// hàm, lệnh SQL để tương tác vs CSDL
    // include_once 'model/connect.php';
    //đăng nhập
    function login($email,$password){
        global $conn;
        $sql = "SELECT * FROM taikhoan WHERE email='".$email."' AND matkhau='".$password."'";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }  
    //đăng ký
    function signup($hoten,$email,$matkhau){
        global $conn;
        $sql = "INSERT INTO taikhoan(`hoten`,`email`,`matkhau`) VALUES (:hoten,  :email, :matkhau)";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":hoten",$hoten);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":matkhau",$matkhau);
        return $stmt->execute();
    }
    //check sdt tồn tại
    function user_checkPhone($sdt){
        $sql = "SELECT * FROM taikhoan WHERE sdt=:sdt";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':sdt', $sdt, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(); // lấy 1 tài khoản
    } 
    //thêm tài khoản
    function add_user($hoten, $anh, $email, $diachi, $sdt,$matkhau ,$quyen){
        pdo_execute("INSERT INTO taikhoan(`hoten`,`anh`,`email`,`diachi`,`sdt`,`matkhau`,`quyen`)
        VALUES(?,?,?,?,?,?,?)",$hoten, $anh, $email, $diachi, $sdt,$matkhau ,$quyen);
    }
    //SỬA TÀI KHOẢN
    function edit_user($makh, $hoten, $anh, $email, $diachi, $sdt, $matkhau, $quyen){
        pdo_execute("UPDATE taikhoan SET hoten=?, anh=?, email=?, diachi=?, sdt=?, matkhau=?, quyen=? 
        WHERE makh=?",$hoten, $anh, $email, $diachi, $sdt, $matkhau, $quyen, $makh);
    }
    //xoá tài khoản
    function delete_user($makh){
        pdo_execute("DELETE FROM taikhoan WHERE makh=?",$makh);
    }
    // hiển thị tất cả tk
    function getAllAccounts(){
        return pdo_query("SELECT * FROM taikhoan");

    }
    // lấy id makh
    function get_taikhoan($makh){
        global $conn;//Sử dụng từ khóa global để sử dụng biến $conn  
        //Định nghĩa một câu truy vấn SQL để lấy thông tin của tài khoản từ bảng taikhoan
        $sql = "SELECT * FROM taikhoan WHERE makh=:makh";
        $conn = pdo_get_connection();//lấy kết nối đến cơ sở dữ liêu 
        $stmt = $conn->prepare($sql);//câu truy vấn
        // Liên kết tham số trong câu truy vấn với giá trị của biến $makh
        $stmt->bindParam(":makh", $makh, PDO::PARAM_INT);
        $stmt->execute();//thực hiện câu truy vấn
        return $stmt->fetch(); // chỉ lấy 1 makh
    }
    
    // check email đã tồn tại 
    function checkMail($email){
        global $conn;
        $sql = "SELECT * FROM taikhoan WHERE email='".$email."'";
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
?>