<style>
    .danhmuc-right-top-item .tendanhmuc{
    text-transform: uppercase;
}
</style>
<main>
    <div class="container-danhmuc">
        <div class="danhmuc-top row">
            <p><a href="?mod=page&act=home">Trang chủ</a></p><i class="fa-solid fa-angle-right"></i><p>Danh mục</p>
        </div>
    </div>
    <section class="danhmuc">
        <div class="container-danhmuc">
            <div class="row">
                <div class="danhmuc-left">
                    <form action="" id="search" method="get">
                        <input type="hidden" name="mod" value="product">
                        <input type="hidden" name="act" value="search">
                        <input type="text" name="keyword" placeholder="Nhập tên sãn phẩm cần tìm">
                        <input type="submit" name="submit" value="Tìm">
                    </form>
                    <ul>
                        <h4>DANH MỤC</h4>
                        <?php foreach($data['dsdm'] as $dm): ?>
                            <li class="danhmuc-left-li">
                                <a href="index.php?mod=product&act=detail&id=<?=$dm['madm']?>">
                                    <?=$dm['tendm']?>
                                </a> <hr color="#ddd">
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="danhmuc-right row">
                    <div class="danhmuc-right-top-item">
                        <p class="tendanhmuc"><?=$ctdanhmuc['tendm']?></p>
                    </div>
                    <div class="danhmuc-right-top-item">
                        <button><span>Bộ lọc</span><i class="fa-solid fa-caret-down"></i></button>
                    </div>
                    <div class="danhmuc-right-top-item">
                        <select name="" id="">
                            <option value="">Sắp xếp</option>
                            <option value="">giá cao - thấp</option>
                            <option value="">giá thấp - cao</option>
                        </select>
                    </div>
                    <div class="danhmuc-right-content row">  
                        <?php 
                            usort($dssanpham, function($a, $b) {
                                return strtotime($b['ngaytao']) - strtotime($a['ngaytao']);
                            });
                            $count = 0; // Biến đếm số sản phẩm
                            foreach($dssanpham as $sp):
                                if ($count < 8): // Hiển thị chỉ khi số lượng sản phẩm chưa đạt 4
                            ?>             
                        <div class="danhmuc-right-content-item">
                            <a href="?mod=product&act=ctsanpham&id=<?=$sp['masp']?>"><img src="upload/product/<?=$sp['anh']?>"><br></a>
                            <p>Mã: <?=$sp['masp']?><span><?=$sp['khuyenmai']?>đ</span></p>
                            <a href=""><h3><?=$sp['tensp']?></h3></a>
                        </div>
                        <?php
                            $count++; // Tăng biến đếm sau mỗi sản phẩm
                            endif;
                            endforeach; 
                        ?>
                    </div>
                    <div class="danhmuc-right-bottom row">
                        <div class="danhmuc-right-bottom-item">
                            <p>Hiển thị 2<span> | </span>4 sản phẩm</p>
                        </div>
                        <div class="danhmuc-right-bottom-item">
                            <p><span>&#171;</span> 1 2 3 4 5 <span>&#187;</span> Trang cuối</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    const itemslidebar = document.querySelectorAll(".danhmuc-left-li")
    itemslidebar.forEach(function(menu,index){
    menu.addEventListener("click",function(){
        menu.classList.toggle("block")
    })
})
</script>