<!DOCTYPE html>
<html>

<head>
    <?php require "App/Views/components/head.php" ?>
    <title>Wee Lee Web</title>
    <link rel="stylesheet" href="/public/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/public/css/swiper-custom.css" />
</head>
<body>
        <?php require "App/Views/components/admin/header.php" ?>
    <main>
        <?php require "App/Views/components/admin/sidemenu.php" ?>
        <div class="main-center">
            <h2>Chi tiết sản phẩm</h2>
            <div class="container mt-2 p-2">
                <div class="flex flex-col">
                    <div class="field__label my-1">Hình minh họa</div>
                    <div class="show-slide">
                        <div style="--swiper-navigation-color: #000; --swiper-pagination-color: #000" class="swiper mySwiper show-product-main-swiper">
                            <div class="swiper-wrapper">
                                <?php foreach($product->images as $image): ?>
                                    <div class="swiper-slide">
                                        <img src="<?= $image->url ?>" />
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <div thumbsSlider="" class="swiper mySwiper2 show-product-secondary-swiper">
                            <div class="swiper-wrapper">
                                <?php foreach($product->images as $image): ?>
                                    <div class="swiper-slide">
                                        <img src="<?= $image->url ?>" />
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div>
                            <div class="field">
                                <div class="field__label">Tên mặt hàng</div>
                                <div class="field__content"><?= $product->product_name ?></div>
                            </div>
                            <div class="field">
                                <div class="field__label">Giá</div>
                                <div class="field__content"><?= $product->base_price ?> <?= $product->price_unit ?></div>
                            </div>
                            <div class="field">
                                <div class="field__label">Số dây</div>
                                <div class="field__content"><?= $product->number_of_string ?></div>
                            </div>
                            <div class="field">
                                <div class="field__label">Danh mục</div>
                                <div class="field__content"><?= $product->category_name ?></div>
                            </div>
                        </div>
                        <div>
                            <div class="field">
                                <div class="field__label">Số lượng</div>
                                <div class="field__content"><?= $product->quantity ?></div>
                            </div>
                            <div class="field">
                                <div class="field__label">Deal</div>
                                <div class="field__content"><?= $product->discount ?> <?= $product->discount_unit ?></div>
                            </div>
                            <div class="field">
                                <div class="field__label">Thương hiệu</div>
                                <div class="field__content"><?= $product->brand_name ?></div>
                            </div>
                            <div class="field">
                                <div class="field__label">Dáng đàn</div>
                                <div class="field__content"><?= $product->body_shape_name ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="my-2">
                        <div class="field">
                            <div class="field__label">Mô tả</div>
                            <div class="field__description"><?= $product->description ?></div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div>
                            <div class="field">
                                <div class="field__label">Chất liệu thân đàn</div>
                                <div class="field__content"><?= $product->body_material ?></div>
                            </div>
                            <div class="field">
                                <div class="field__label">Chiều dài</div>
                                <div class="field__content"><?= $product->scale_length ?></div>
                            </div>
                        </div>
                        <div>
                            <div class="field">
                                <div class="field__label">Chất liệu cần đàn</div>
                                <div class="field__content"><?= $product->fretboard_material ?></div>
                            </div>
                            <div class="field">
                                <div class="field__label">Số lượng phím</div>
                                <div class="field__content"><?= $product->no_of_fret ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="/public/js/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper2", {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper", {
            loop: true,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
</body>

</html>