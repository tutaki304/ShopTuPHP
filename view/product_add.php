
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm - ShopTu Admin</title>
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
            max-width: 1000px;
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
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f9fafb;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        /* Select dropdown */
        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 16px;
            background: #f9fafb;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        /* File input */
        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        
        .file-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            background: #f9fafb;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            color: #6b7280;
        }
        
        .file-input:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }
        
        /* Submit button */
        .btn-submit {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
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
            background: linear-gradient(135deg, #2563eb, #1e40af);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
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
            margin-bottom: 20px;
        }
        
        .btn-submit:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }
        
        /* Grid layout cho form */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .form-grid .form-group.full-width {
            grid-column: 1 / -1;
        }
        
        /* Icon styling */
        .form-icon {
            margin-right: 8px;
            color: #3b82f6;
        }
        
        /* Help text */
        .help-text {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }
        
        /* Responsive design */
        @media (max-width: 992px) {
            .container {
                width: 95%;
                margin: 10px auto;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
                gap: 15px;
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
            
            .form-grid {
                grid-template-columns: 1fr;
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
                <i class="fas fa-plus-circle"></i>
                Thêm sản phẩm mới
            </h2>
            <p>Thêm sản phẩm vào cửa hàng của bạn</p>
        </div>
        
        <!-- Body -->
        <div class="form-body">
            <!-- Back button -->
            <a href="admin.php?mod=product&act=admin" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Quay lại danh sách
            </a>
            
            <!-- Form -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="tensp">
                            <i class="fas fa-tag"></i> Tên sản phẩm *
                        </label>
                        <input type="text" id="tensp" name="tensp" class="form-input" 
                               placeholder="Nhập tên sản phẩm" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="madm">
                            <i class="fas fa-list"></i> Danh mục *
                        </label>
                        <select name="madm" id="madm" class="form-select" required>
                            <option value="">Chọn danh mục</option>
                            <?php foreach($data['dsdm'] as $dm): ?>
                                <option value="<?=$dm['madm']?>">
                                    <?=$dm['tendm']?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="dongia">
                            <i class="fas fa-dollar-sign"></i> Giá gốc *
                        </label>
                        <input type="number" id="dongia" name="dongia" class="form-input" 
                               placeholder="Nhập giá gốc" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="khuyenmai">
                            <i class="fas fa-percent"></i> Giá khuyến mãi
                        </label>
                        <input type="number" id="khuyenmai" name="khuyenmai" class="form-input" 
                               placeholder="Nhập giá khuyến mãi" min="0">
                    </div>
                    
                    <div class="form-group">
                        <label for="soluong">
                            <i class="fas fa-cubes"></i> Số lượng *
                        </label>
                        <input type="number" id="soluong" name="soluong" class="form-input" 
                               placeholder="Nhập số lượng" min="1" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="anh">
                            <i class="fas fa-image"></i> Hình ảnh *
                        </label>
                        <input type="file" id="anh" name="anh" class="file-input" 
                               accept="image/*" required>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="mota">
                            <i class="fas fa-align-left"></i> Mô tả sản phẩm
                        </label>
                        <textarea id="mota" name="mota" class="form-input" rows="4" 
                                  placeholder="Nhập mô tả chi tiết sản phẩm"></textarea>
                    </div>
                </div>
                
                <button type="submit" name="submit" class="btn-submit">
                    <i class="fas fa-save"></i>
                    Thêm sản phẩm
                </button>
            </form>
        </div>
    </div>
</body>
</html>