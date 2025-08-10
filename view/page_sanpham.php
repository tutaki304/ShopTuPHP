<main>
    <div class="container-danhmuc">
        <div class="danhmuc-top row">
            <p><a href="?mod=page&act=home">Trang chủ</a></p><i class="fa-solid fa-angle-right"></i><p>Sản phẩm</p>
        </div>
    </div>
    <section class="danhmuc">
        <div class="container-danhmuc">
            <div class="row">
                <div class="danhmuc-left">
                    <form action="index.php" method="POST">
                        <input type="hidden" name="mod" value="product">
                        <input type="hidden" name="act" value="search">
                        <input type="text" name="keyword" placeholder="Nhập tên sản phẩm cần tìm">
                        <input type="submit" name="submit" id="search" value="Tìm">
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
                        <p>SẢN PHẨM MỚI</p>
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
                    
                    <?php 
                    // Xác định class CSS dựa trên số lượng sản phẩm
                    $productCount = isset($data['dssp']) ? count($data['dssp']) : 0;
                    $cssClass = '';
                    if ($productCount == 1) {
                        $cssClass = 'single-item';
                    } elseif ($productCount == 2) {
                        $cssClass = 'two-items';
                    } elseif ($productCount == 3) {
                        $cssClass = 'three-items';
                    }
                    ?>
                    
                    <div class="danhmuc-right-content row <?= $cssClass ?>">  
                        <?php 
                            // Hiển thị sản phẩm từ pagination
                            foreach($data['dssp'] as $sp):
                            ?>             
                        <div class="danhmuc-right-content-item">
                            <a href="?mod=product&act=ctsanpham&id=<?=$sp['masp']?>">
                                <img src="upload/product/<?=$sp['anh']?>" alt="<?=$sp['tensp']?>">
                                <h3><?=$sp['tensp']?></h3>
                            </a>
                            <p>
                                <span>Mã: <?=$sp['masp']?></span>
                                <span class="price"><?=number_format(($sp['khuyenmai']??$sp['dongia']) * 1000)?>đ</span>
                            </p>
                        </div>
                        <?php
                            endforeach; 
                        ?>
                    </div>
                    <div class="danhmuc-right-bottom row">
                        <div class="danhmuc-right-bottom-item">
                            <p>Hiển thị <?= $data['pagination']['start_item'] ?><span> - </span><?= $data['pagination']['end_item'] ?> trong <?= $data['pagination']['total_products'] ?> sản phẩm</p>
                        </div>
                        <div class="danhmuc-right-bottom-item">
                            <div class="pagination">
                                <?php
                                $current_page = $data['pagination']['current_page'];
                                $total_pages = $data['pagination']['total_pages'];
                                
                                // Nút Previous
                                if ($current_page > 1): ?>
                                    <a href="?mod=product&act=sanpham&page=<?= $current_page - 1 ?>" class="pagination-btn">&#171;</a>
                                <?php else: ?>
                                    <span class="pagination-btn disabled">&#171;</span>
                                <?php endif; ?>
                                
                                <?php
                                // Hiển thị các trang
                                $start_page = max(1, $current_page - 2);
                                $end_page = min($total_pages, $current_page + 2);
                                
                                // Hiển thị trang đầu nếu cần
                                if ($start_page > 1): ?>
                                    <a href="?mod=product&act=sanpham&page=1" class="pagination-btn">1</a>
                                    <?php if ($start_page > 2): ?>
                                        <span class="pagination-btn disabled">...</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                <?php
                                // Hiển thị các trang gần trang hiện tại
                                for ($i = $start_page; $i <= $end_page; $i++): ?>
                                    <?php if ($i == $current_page): ?>
                                        <span class="pagination-btn active"><?= $i ?></span>
                                    <?php else: ?>
                                        <a href="?mod=product&act=sanpham&page=<?= $i ?>" class="pagination-btn"><?= $i ?></a>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                
                                <?php
                                // Hiển thị trang cuối nếu cần
                                if ($end_page < $total_pages): ?>
                                    <?php if ($end_page < $total_pages - 1): ?>
                                        <span class="pagination-btn disabled">...</span>
                                    <?php endif; ?>
                                    <a href="?mod=product&act=sanpham&page=<?= $total_pages ?>" class="pagination-btn"><?= $total_pages ?></a>
                                <?php endif; ?>
                                
                                <?php
                                // Nút Next
                                if ($current_page < $total_pages): ?>
                                    <a href="?mod=product&act=sanpham&page=<?= $current_page + 1 ?>" class="pagination-btn">&#187;</a>
                                <?php else: ?>
                                    <span class="pagination-btn disabled">&#187;</span>
                                <?php endif; ?>
                            </div>
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