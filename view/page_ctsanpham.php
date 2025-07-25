<main>
    <div class="container-danhmuc">
        <div class="danhmuc-top row">
            <p><a href="?mod=page&act=home">Trang chủ</a></p><i class="fa-solid fa-angle-right"></i><p>Chi tiết sản phẩm</p>
        </div>
    </div>
    <section class="product-2">
        <div class="container-product">
            <div class="product-content row">       
                <div class="product-content-left row">
                    <div class="product-content-left-big-img">
                        <img src="upload/product/<?=$ctsanpham['anh']?>" alt="#">
                        
                    </div>
                    <div class="product-content-left-small-img">
                        <img src="upload/product/<?=$ctsanpham['anh']?>" alt="#">
                        <img src="upload/product/<?=$ctsanpham['anh']?>" alt="#">
                        <img src="assets_user/img/anhnu8.webp" alt="#">
                    </div>  
                </div>
                <div class="product-content-right">
                    <div class="product-content-right-product-name">
                        <h1><?=$ctsanpham['tensp']?></h1>
                        <p>Mã: <?=$ctsanpham['masp']?></p>
                    </div>
                    <div class="product-content-right-product-price">
                        <p>Giá gốc: <del style="color: #949292;"><?=$ctsanpham['dongia']?>đ</del> Giá khuyến mãi: <?=$ctsanpham['khuyenmai']?>đ</p>
                    </div>
                    <!-- <div class="product-content-right-product-color">
                        <p><span style="font-weight: bold">Màu sắc:</span> Xanh cổ vịt nhạt<span style="color: red">*</span></p>
                        <div class="product-content-right-product-color-img">
                            <img src="assets/img/anhcolor.jpg" alt="">
                        </div>
                    </div> -->
                    <div class="product-content-right-product-size">
                        <p style="font-weight: bold">Size: </p>
                        <div class="size">
                            <span>S</span>
                            <span>M</span>
                            <span>L</span>
                            <span>XL</span>
                            <span>XXL</span>
                        </div>
                    </div>
                    <div class="quantity">
                        <p style="font-weight: bold">Sản phẩm còn <?=$ctsanpham['masp']?>: </p>
                        <input type="number" min="0" value="1">
                    </div>
                    
                    <div class="product-content-right-product-button">
                        <a href="?mod=product&act=addToCart&id=<?=$ctsanpham['masp']?>"><button><i class="fas fa-shopping-cart"></i><p>THÊM VÀO GIỎ HÀNG</p></button></a>
                    </div>
                    <?php if(isset($_SESSION['thongbao'])): ?>
                        <div class="thongbaocart">
                            <?=$_SESSION['thongbao']?>
                        </div>
                    <?php endif; unset($_SESSION['thongbao']); ?>
                    <?php if(isset($_SESSION['loi'])): ?>
                        <div class="loicart">
                            <?=$_SESSION['loi']?>
                        </div>
                    <?php endif; unset($_SESSION['loi']); ?>
                    <div class="product-content-right-product-icon">
                        <div class="product-content-right-product-icon-item">
                            <i class="fas fa-phone-alt"></i> <p>Hotline</p>
                        </div> 
                        <div class="product-content-right-product-icon-item">
                            <i class="fas fa-comments"></i> <p>Chat</p>
                        </div>
                        <div class="product-content-right-product-icon-item">
                            <i class="fas fa-envelope"></i> <p>Mail</p>
                        </div>                  
                    </div>
                    <div class="product-content-right-product-rgin-botton">
                        <p style="font-weight: bold; margin-bottom: 10px; margin-top: 24px">Mô tả sản phẩm:</p>
                        <span style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;color: #504f4f; font-size: 15px; line-height: 18px;">
                            <?=$ctsanpham['mota']?>
                        </span><br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-related">
        <h2>COMMENT:</h2> 
        <?php if(isset($_SESSION['user'])): ?>
            <form action="?mod=product&act=comment" method="post" >
                <input type="text" name="noidung" placeholder="Nhận xét sản phẩm!">
                <input type="hidden" name="masp" value="<?=$ctsanpham['masp']?>">
                <button class="comment" tybe="submit">Gửi</button>
            </form>
        <?php endif; ?>
        <?php foreach($dsbinhluan as $bl): ?>
        <div class="khungcomment">
            <div class="khungcomment-col-3">
                <strong><?=$bl['hoten']?></strong><br>
                <br><?=$bl['ngaygui']?><br>
            </div>
            <div class="khungcomment-col-9">
                Nội dung: <?=$bl['noidung']?>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="product-related-title">
            <p>SẢN PHẨM LIÊN QUAN</p>
        </div>
        <div class="product-content row">
        <?php foreach($spcungdanhmuc as $ctsanpham): ?>
            <div class="product-related-item">
                <a href="?mod=product&act=ctsanpham&id=<?=$ctsanpham['masp']?>"><img src="upload/product/<?=$ctsanpham['anh']?>"><br></a>
                <p>Mã: <?=$ctsanpham['masp']?><span><?=$ctsanpham['khuyenmai']?>đ</span></p>
                <a href=""><h3><?=$ctsanpham['tensp']?></h3></a>
            </div>
        <?php endforeach; ?>
        </div>
    </section>
</main>
    <script>
        const bigImg = document.querySelector(".product-content-left-big-img img")
        const smalImg = document.querySelectorAll(".product-content-left-small-img img")
        smalImg.forEach(function(imgItem,X){
        imgItem.addEventListener("click",function(){
            bigImg.src = imgItem.src
        })
    })
    </script>

