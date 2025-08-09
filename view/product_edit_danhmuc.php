<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục - ShopTu Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Import font Google Inter cho giao diện hiện đại */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        /* CSS cơ bản cho body */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            margin: 0;
            padding: 20px 0;
            min-height: 100vh;
        }
        
        /* Container chính */
        .container {
            max-width: 800px;
            width: 90%;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        /* Header của form */
        .form-header {
            background: linear-gradient(135deg, #84fab0, #8fd3f4);
            padding: 30px;
            text-align: center;
            color: #1a202c;
        }
        
        .form-header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        
        .form-header p {
            margin: 8px 0 0 0;
            opacity: 0.8;
            font-size: 16px;
        }
        
        /* Body của form */
        .form-body {
            padding: 30px 40px 40px 40px;
        }
        
        /* Back button */
        .btn-back {
            background: #6b7280;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-bottom: 25px;
        }
        
        .btn-back:hover {
            background: #4b5563;
            transform: translateY(-1px);
            color: white;
            text-decoration: none;
        }
        
        /* Thông báo */
        .alert-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 16px 20px;
            margin-bottom: 24px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        
        .alert-error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 16px 20px;
            margin-bottom: 24px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }
        
        /* Styling cho form groups */
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }
        
        /* Input fields */
        .form-input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f9fafb;
            box-sizing: border-box;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        /* Submit button */
        .btn-submit {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 14px 32px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-submit:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }
        
        /* Help text */
        .help-text {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }
        
        /* Icon styling */
        .form-icon {
            margin-right: 8px;
            color: #10b981;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 8px;
            }
            
            .form-header {
                padding: 20px;
            }
            
            .form-body {
                padding: 20px;
            }
        }
        
        /* Responsive design */
        @media (max-width: 992px) {
            .container {
                width: 95%;
                margin: 10px auto;
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 10px 0;
            }
            
            .container {
                width: 98%;
                border-radius: 8px;
            }
            
            .form-header {
                padding: 20px;
            }
            
            .form-header h2 {
                font-size: 24px;
            }
            
            .form-body {
                padding: 20px;
            }
        }
        
        /* Animation */
        .container {
            animation: slideInUp 0.6s ease-out;
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="form-header">
            <h2>
                <i class="fas fa-edit"></i>
                Sửa danh mục
            </h2>
            <p>Cập nhật thông tin danh mục sản phẩm</p>
        </div>
        
        <!-- Body -->
        <div class="form-body">
            <!-- Back button -->
            <a href="admin.php?mod=product&act=danhmuc" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Quay lại danh sách
            </a>
            
            <!-- Thông báo thành công -->
            <?php if(isset($_SESSION['thongbao'])) :?> 
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?=$_SESSION['thongbao']?>
                </div>
            <?php endif; unset($_SESSION['thongbao']); ?>
            
            <!-- Thông báo lỗi -->
            <?php if(isset($_SESSION['loi'])) :?>   
                <div class="alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?=$_SESSION['loi']?>
                </div>
            <?php endif; unset($_SESSION['loi']); ?>
            
            <!-- Form -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="tendm">
                        <i class="fas fa-tag form-icon"></i>
                        Tên danh mục *
                    </label>
                    <input type="text" id="tendm" name="tendm" class="form-input" 
                           placeholder="Nhập tên danh mục" value="<?=$dsdm['tendm']?>" required>
                    <div class="help-text">Ví dụ: Thời trang nam, Điện tử, Gia dụng...</div>
                </div>
                
                <div class="form-group">
                    <label for="soluongsp">
                        <i class="fas fa-cubes form-icon"></i>
                        Số lượng sản phẩm
                    </label>
                    <input type="number" id="soluongsp" name="soluongsp" class="form-input" 
                           placeholder="Nhập số lượng sản phẩm" value="<?=$dsdm['soluongsp']?>" min="0">
                    <div class="help-text">Số lượng sản phẩm hiện có trong danh mục này</div>
                </div>
                
                <div class="form-group">
                    <label for="thutu">
                        <i class="fas fa-sort-numeric-down form-icon"></i>
                        Thứ tự hiển thị
                    </label>
                    <input type="number" id="thutu" name="thutu" class="form-input" 
                           placeholder="Nhập thứ tự" value="<?=$dsdm['thutu']?>" min="1">
                    <div class="help-text">Thứ tự hiển thị danh mục trên website (số nhỏ hiển thị trước)</div>
                </div>
                
                <button type="submit" name="submit" class="btn-submit">
                    <i class="fas fa-save"></i>
                    Lưu thay đổi
                </button>
            </form>
        </div>
    </div>
</body>
</html>