<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm tài khoản - ShopTu Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Import font Google Inter cho giao diện hiện đại */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        /* CSS cơ bản */
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
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
        font-size: 14px;
    }
    
    .container input[type="text"], 
    .container input[type="email"], 
    .container input[type="tel"],
    .container input[type="password"] {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #f9fafb;
        box-sizing: border-box;
    }
    
    .container input:focus {
        outline: none;
        border-color: #3b82f6;
        background: white;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .role-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 10px;
    }
    
    .role-btn {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #f9fafb;
        position: relative;
    }
    
    .role-btn:hover {
        border-color: #3b82f6;
        background: #eff6ff;
        transform: translateY(-2px);
    }
    
    .role-btn.active {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        border-color: #3b82f6;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    
    .role-btn input[type="radio"] {
        display: none;
    }
    
    .role-icon {
        font-size: 24px;
        margin-bottom: 8px;
        display: block;
    }
    
    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        border: none;
        padding: 15px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        border-radius: 8px;
        transition: all 0.3s ease;
        margin-top: 20px;
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
    
    /* File input styling */
    .file-input-wrapper {
        position: relative;
        display: block;
        width: 100%;
        margin-bottom: 12px;
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
        box-sizing: border-box;
        font-size: 14px;
    }
    
    .file-input:hover {
        border-color: #3b82f6;
        background: #eff6ff;
        color: #3b82f6;
    }
    
    .file-input:focus {
        outline: none;
        border-color: #3b82f6;
        background: #eff6ff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .file-preview {
        margin-top: 12px;
        text-align: center;
    }
    
    .file-preview img {
        max-width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #e5e7eb;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .file-preview p {
        margin: 8px 0 0 0;
        font-size: 12px;
        color: #6b7280;
    }
    
    .upload-option {
        margin-bottom: 16px;
    }
    
    .upload-tabs {
        display: flex;
        background: #f3f4f6;
        border-radius: 8px;
        padding: 4px;
        margin-bottom: 16px;
    }
    
    .upload-tab {
        flex: 1;
        padding: 8px 16px;
        background: transparent;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
        color: #6b7280;
    }
    
    .upload-tab.active {
        background: white;
        color: #3b82f6;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .upload-content {
        display: none;
    }
    
    .upload-content.active {
        display: block;
    }
    
    /* Grid layout */
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
        
        .form-grid, .role-grid {
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
        
        .upload-tabs {
            flex-direction: column;
            gap: 5px;
        }
        
        .upload-tab {
            padding: 12px;
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
    
    .password-note {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border: 2px solid #3b82f6;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 24px;
        font-size: 14px;
        color: #1e40af;
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="form-header">
            <h2>
                <i class="fas fa-user-plus"></i>
                Thêm tài khoản mới
            </h2>
            <p>Tạo tài khoản người dùng hoặc admin</p>
        </div>
        
        <!-- Body -->
        <div class="form-body">
            <!-- Back button -->
            <a href="admin.php?mod=user&act=user" class="btn-back">
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
            
            <!-- Ghi chú mật khẩu -->
            <div class="password-note">
                <i class="fas fa-info-circle"></i>
                <strong>Lưu ý:</strong> Nếu không nhập mật khẩu, hệ thống sẽ tự động tạo mật khẩu mặc định là <strong>12345</strong>
            </div>
            
            <!-- Form -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="hoten">
                            <i class="fas fa-user form-icon"></i>
                            Họ và tên *
                        </label>
                        <input type="text" id="hoten" name="hoten" class="form-input" 
                               placeholder="Nhập họ và tên đầy đủ" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope form-icon"></i>
                            Email *
                        </label>
                        <input type="email" id="email" name="email" class="form-input" 
                               placeholder="Nhập địa chỉ email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="sdt">
                            <i class="fas fa-phone form-icon"></i>
                            Số điện thoại *
                        </label>
                        <input type="tel" id="sdt" name="sdt" class="form-input" 
                               placeholder="Nhập số điện thoại" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="matkhau">
                            <i class="fas fa-lock form-icon"></i>
                            Mật khẩu
                        </label>
                        <input type="password" id="matkhau" name="matkhau" class="form-input" 
                               placeholder="Nhập mật khẩu (để trống dùng mặc định)">
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="diachi">
                            <i class="fas fa-map-marker-alt form-icon"></i>
                            Địa chỉ
                        </label>
                        <input type="text" id="diachi" name="diachi" class="form-input" 
                               placeholder="Nhập địa chỉ">
                    </div>
                    
                    <div class="form-group full-width">
                        <label>
                            <i class="fas fa-image form-icon"></i>
                            Ảnh đại diện
                        </label>
                        
                        <!-- Upload tabs -->
                        <div class="upload-tabs">
                            <button type="button" class="upload-tab active" onclick="switchUploadType('file')">
                                <i class="fas fa-upload"></i> Tải ảnh lên
                            </button>
                            <button type="button" class="upload-tab" onclick="switchUploadType('link')">
                                <i class="fas fa-link"></i> Dùng link
                            </button>
                        </div>
                        
                        <!-- File upload option -->
                        <div class="upload-content active" id="file-upload">
                            <div class="file-input-wrapper">
                                <input type="file" id="anh" name="anh" class="file-input" 
                                       accept="image/*" onchange="previewImage(this)">
                                <label for="anh" style="cursor: pointer; display: block; text-align: center; padding: 20px;">
                                    <i class="fas fa-cloud-upload-alt" style="font-size: 24px; margin-bottom: 8px; display: block;"></i>
                                    Nhấp để chọn ảnh hoặc kéo thả ảnh vào đây
                                    <br><small>Hỗ trợ: JPG, PNG, GIF (Tối đa 5MB)</small>
                                </label>
                            </div>
                            <div class="file-preview" id="image-preview" style="display: none;">
                                <img id="preview-img" src="" alt="Preview">
                                <p>Ảnh đã chọn</p>
                                <button type="button" onclick="removeImage()" 
                                        style="background: #ef4444; color: white; border: none; padding: 4px 8px; border-radius: 4px; font-size: 12px; margin-top: 8px;">
                                    <i class="fas fa-trash"></i> Xóa ảnh
                                </button>
                            </div>
                        </div>
                        
                        <!-- Link input option -->
                        <div class="upload-content" id="link-upload">
                            <input type="text" id="anh_link" name="anh_link" class="form-input" 
                                   placeholder="Nhập link ảnh đại diện">
                            <div class="help-text">Dán URL ảnh từ internet hoặc để trống để dùng avatar mặc định</div>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label>
                            <i class="fas fa-user-shield form-icon"></i>
                            Chọn quyền người dùng *
                        </label>
                        <div class="role-grid">
                            <label class="role-btn" onclick="selectRole(this, 'user')">
                                <input type="radio" name="quyen" value="user" required>
                                <span class="role-icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <div>Khách hàng</div>
                            </label>
                            <label class="role-btn" onclick="selectRole(this, 'admin')">
                                <input type="radio" name="quyen" value="admin" required>
                                <span class="role-icon">
                                    <i class="fas fa-crown"></i>
                                </span>
                                <div>Quản trị viên</div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <button type="submit" name="submit" class="btn-submit">
                    <i class="fas fa-user-plus"></i>
                    Thêm tài khoản
                </button>
            </form>
        </div>
    </div>

<script>
function selectRole(element, role) {
    // Xóa class active từ tất cả các button
    document.querySelectorAll('.role-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Thêm class active cho button được chọn
    element.classList.add('active');
    
    // Check radio button tương ứng
    element.querySelector('input[type="radio"]').checked = true;
}

// Xử lý click trực tiếp vào radio button
document.querySelectorAll('input[name="quyen"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.role-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        this.closest('.role-btn').classList.add('active');
    });
});

// Switch between upload types
function switchUploadType(type) {
    // Update tabs
    document.querySelectorAll('.upload-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Update content
    document.querySelectorAll('.upload-content').forEach(content => {
        content.classList.remove('active');
    });
    
    if (type === 'file') {
        document.querySelector('.upload-tab:first-child').classList.add('active');
        document.getElementById('file-upload').classList.add('active');
        // Clear link input
        document.getElementById('anh_link').value = '';
    } else {
        document.querySelector('.upload-tab:last-child').classList.add('active');
        document.getElementById('link-upload').classList.add('active');
        // Clear file input
        document.getElementById('anh').value = '';
        removeImage();
    }
}

// Preview selected image
function previewImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Check file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('Kích thước ảnh quá lớn! Vui lòng chọn ảnh nhỏ hơn 5MB.');
            input.value = '';
            return;
        }
        
        // Check file type
        if (!file.type.match('image.*')) {
            alert('Vui lòng chọn file ảnh!');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

// Remove selected image
function removeImage() {
    document.getElementById('anh').value = '';
    document.getElementById('image-preview').style.display = 'none';
    document.getElementById('preview-img').src = '';
}

// Drag and drop functionality
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('anh');
    const fileWrapper = document.querySelector('.file-input-wrapper');
    
    if (fileWrapper) {
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileWrapper.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });
        
        // Highlight drop area when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            fileWrapper.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            fileWrapper.addEventListener(eventName, unhighlight, false);
        });
        
        // Handle dropped files
        fileWrapper.addEventListener('drop', handleDrop, false);
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        function highlight(e) {
            fileWrapper.style.borderColor = '#3b82f6';
            fileWrapper.style.backgroundColor = '#eff6ff';
        }
        
        function unhighlight(e) {
            fileWrapper.style.borderColor = '#d1d5db';
            fileWrapper.style.backgroundColor = '#f9fafb';
        }
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                fileInput.files = files;
                previewImage(fileInput);
            }
        }
    }
});
</script>
</body>
</html>