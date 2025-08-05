<style>
    .danhmuc-right-top-item .tendanhmuc{
        text-transform: uppercase;
        font-size: 20px;
        font-weight: 500;
        color: #333;
        margin: 0;
    }
    
    /* Đảm bảo các product item có styling đồng nhất */
    .danhmuc-right-content-item {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 12px 0;
    }

    .danhmuc-right-content-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .danhmuc-right-content-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 8px 8px 0 0;
    }

    .danhmuc-right-content-item a h3 {
        font-size: 15px;
        font-weight: 400;
        color: #333333;
        padding: 0 12px;
        margin: 10px 0 5px 0;
    }

    .danhmuc-right-content-item p {
        display: flex;
        font-size: 14px;
        padding: 5px 12px;
        justify-content: space-between;
        color: #666666;
        margin: 0;
    }

    .danhmuc-right-content-item .price {
        color: #e74c3c;
        font-weight: bold;
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
                            <li class="danhmuc-left-li <?= ($dm['madm'] == $category_id) ? 'active' : '' ?>">
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
                            // Hiển thị sản phẩm theo danh mục
                            if (!empty($dssanpham)):
                                foreach($dssanpham as $sp):
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
                            else:
                            ?>
                            <div class="no-products">
                                <p style="text-align: center; color: #999; padding: 50px; width: 100%;">
                                    <i class="fa-solid fa-box-open" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                                    Không có sản phẩm nào trong danh mục này.
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                    </div>
                    <?php if (!empty($dssanpham) && $data['pagination']['total_pages'] > 1): ?>
                    <div class="danhmuc-right-bottom row">
                        <div class="danhmuc-right-bottom-item">
                            <p>Hiển thị <?= $data['pagination']['start_item'] ?><span> - </span><?= $data['pagination']['end_item'] ?> trong <?= $data['pagination']['total_products'] ?> sản phẩm</p>
                        </div>
                        <div class="danhmuc-right-bottom-item">
                            <div class="pagination">
                                <?php
                                $current_page = $data['pagination']['current_page'];
                                $total_pages = $data['pagination']['total_pages'];
                                $category_id = $data['pagination']['category_id'];
                                
                                // Nút Previous
                                if ($current_page > 1): ?>
                                    <a href="?mod=product&act=detail&id=<?= $category_id ?>&page=<?= $current_page - 1 ?>" class="pagination-btn">&#171;</a>
                                <?php else: ?>
                                    <span class="pagination-btn disabled">&#171;</span>
                                <?php endif; ?>
                                
                                <?php
                                // Hiển thị các trang
                                $start_page = max(1, $current_page - 2);
                                $end_page = min($total_pages, $current_page + 2);
                                
                                // Hiển thị trang đầu nếu cần
                                if ($start_page > 1): ?>
                                    <a href="?mod=product&act=detail&id=<?= $category_id ?>&page=1" class="pagination-btn">1</a>
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
                                        <a href="?mod=product&act=detail&id=<?= $category_id ?>&page=<?= $i ?>" class="pagination-btn"><?= $i ?></a>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                
                                <?php
                                // Hiển thị trang cuối nếu cần
                                if ($end_page < $total_pages): ?>
                                    <?php if ($end_page < $total_pages - 1): ?>
                                        <span class="pagination-btn disabled">...</span>
                                    <?php endif; ?>
                                    <a href="?mod=product&act=detail&id=<?= $category_id ?>&page=<?= $total_pages ?>" class="pagination-btn"><?= $total_pages ?></a>
                                <?php endif; ?>
                                
                                <?php
                                // Nút Next
                                if ($current_page < $total_pages): ?>
                                    <a href="?mod=product&act=detail&id=<?= $category_id ?>&page=<?= $current_page + 1 ?>" class="pagination-btn">&#187;</a>
                                <?php else: ?>
                                    <span class="pagination-btn disabled">&#187;</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
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