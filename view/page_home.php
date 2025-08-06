<main>
    <style>
        .anhchay1{
            margin-bottom:20px;
        }
        .anhchay4 img{
            width: 100%;
            margin-bottom:15px;
        }
    </style>
    <div class="anhchay1">
        <div class="anhchay4">
            <img id="img" onclick="anhdoi()" class="hinhBanner" src="assets_user/img/1.png" alt="">
        </div>
        <script>
            var index = 1;
            anhdoi = function() {
                var imgs =["assets_user/img/1.png","assets_user/img/2.png"];
                document.getElementById('img').src = imgs[index];
                index++;
                if(index == 2){
                    index = 0;
                }
            }
            //3 giây sẽ gọi anh đổi 1 lần
            setInterval(anhdoi,3500);
        </script>
    </div>
    <h2>Sản phẩm nổi bật</h2>
    <div class="icon">
        <img src="https://www.kkfashion.vn/themes/kkfashion/assets/img//icon-heading.png" alt="">
    </div>
    <section class="product-container">
        <?php foreach($dsNew as $sp): ?>
            <div class="product">
                <a href="?mod=product&act=ctsanpham&id=<?=$sp['masp']?>"><img src="upload/product/<?=$sp['anh']?>"></a><br>
                <p>Mã: <?=$sp['masp']?><span><?=number_format($sp['khuyenmai'] * 1000)?>đ</span></p>
                <a href="?mod=product&act=ctsanpham&id=<?=$sp['masp']?>"><h3><?=$sp['tensp']?></h3></a>
            </div>
        <?php  endforeach; ?>
    </section>
    <h2>Gợi ý dành riêng cho bạn</h2>
    <section class="product-container-2">
        <?php 
        // Sắp xếp mảng sản phẩm theo thứ tự giảm dần của ngày thêm vào
        usort($data['dssp'], function($a, $b) {
            return strtotime($b['ngaytao']) - strtotime($a['ngaytao']);
        });

        $count = 0; // Biến đếm số sản phẩm
        foreach($data['dssp'] as $sp):
            if ($count < 6): // Hiển thị chỉ khi số lượng sản phẩm chưa đạt 4
        ?>
            <div class="product-3">
                <a href="?mod=product&act=ctsanpham&id=<?=$sp['masp']?>">
                    <img src="upload/product/<?=$sp['anh']?>"><br>
                </a>
                <p>Mã: <?=$sp['masp']?><span><?=number_format($sp['khuyenmai'] * 1000)?>đ</span></p>
                <a href="?mod=product&act=ctsanpham&id=<?=$sp['masp']?>"><h3><?=$sp['tensp']?></h3></a>
            </div>
        <?php
            $count++; // Tăng biến đếm sau mỗi sản phẩm
            endif;
        endforeach; 
        ?>
    </section>
    <div class="background-block">
        <div class="background-block-left">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/YKaiXY7zHxk?si=_efWL3OqigB_1hkX" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <div class="background-block-right">
            <h2>ENDLESS FIELD</h2>
            <p>Bước vào mùa thời trang thu đông, tủ đồ của nàng cũng đang cần được F5 lại. BST “Endless Field” chính là “luồng gió” mới giúp nàng tỏa sáng hơn trong mọi hoàn cảnh, từ công sở thanh lịch, dạo phố nhẹ nhàng, cho đến những buổi tiệc lung linh.</p>
        </div>
    </div>
</main>