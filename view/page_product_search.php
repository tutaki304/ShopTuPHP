<main>
    <div class="container-danhmuc">
        <div class="danhmuc-top row">
            <p><a href="?mod=page&act=home">Trang chủ</a></p><i class="fa-solid fa-angle-right"></i>
            <p>Tìm kiếm: "<?= htmlspecialchars($data['keyword'] ?? '') ?>"</p>
        </div>
    </div>
    <section class="danhmuc">
        <div class="container-danhmuc">
            <div class="row">
                <div class="danhmuc-left">
                    <form action="index.php" method="POST">
                        <input type="hidden" name="mod" value="product">
                        <input type="hidden" name="act" value="search">
                        <input type="text" name="keyword" placeholder="Nhập tên sản phẩm cần tìm" 
                               value="<?= htmlspecialchars($data['keyword'] ?? '') ?>">
                        <input type="submit" name="submit" id="search" value="Tìm">
                    </form>
                    <ul>
                        <h4>DANH MỤC</h4>
                        <?php if(isset($data['dsdm']) && !empty($data['dsdm'])): ?>
                            <?php foreach($data['dsdm'] as $dm): ?>
                                <li class="danhmuc-left-li">
                                    <a href="index.php?mod=product&act=detail&id=<?=$dm['madm']?>">
                                        <?=$dm['tendm']?>
                                    </a> <hr color="#ddd">
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="danhmuc-right row">
                    <div class="danhmuc-right-top-item">
                        <?php if(isset($data['keyword']) && !empty($data['keyword'])): ?>
                            <p>KẾT QUẢ TÌM KIẾM CHO: "<?= htmlspecialchars($data['keyword']) ?>"</p>
                        <?php else: ?>
                            <p>KẾT QUẢ TÌM KIẾM</p>
                        <?php endif; ?>
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
                        <?php if(isset($data['dssp']) && !empty($data['dssp'])): ?>
                            <?php foreach($data['dssp'] as $sp): ?>
                                <div class="danhmuc-right-content-item">
                                    <a href="?mod=product&act=ctsanpham&id=<?= $sp['masp'] ?>">
                                        <img src="upload/product/<?= $sp['anh'] ?>" alt="<?= htmlspecialchars($sp['tensp']) ?>">
                                        <h3><?= htmlspecialchars($sp['tensp']) ?></h3>
                                    </a>
                                    <p>
                                        <span>Mã: <?= $sp['masp'] ?></span>
                                        <span class="price"><?= number_format(($sp['khuyenmai'] ?? $sp['dongia']) * 1000) ?>đ</span>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="no-results">
                                <div style="text-align: center; padding: 50px; color: #666;">
                                    <i class="fa-solid fa-search" style="font-size: 48px; margin-bottom: 20px; color: #ddd;"></i>
                                    <h3>Không tìm thấy sản phẩm nào</h3>
                                    <?php if(isset($data['keyword']) && !empty($data['keyword'])): ?>
                                        <p>Không có sản phẩm nào phù hợp với từ khóa "<strong><?= htmlspecialchars($data['keyword']) ?></strong>"</p>
                                    <?php else: ?>
                                        <p>Vui lòng nhập từ khóa để tìm kiếm sản phẩm</p>
                                    <?php endif; ?>
                                    <p><a href="?mod=page&act=home" style="color: #007bff;">← Quay về trang chủ</a></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
