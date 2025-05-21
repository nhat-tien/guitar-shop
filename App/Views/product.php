<!DOCTYPE html>
  <html lang="vi">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="/public/css/style2.css">
  </head>
      <body>
      <div class="main">
          <header class="section-header">
                  <div class="top-bar">
                  <!-- Begin: Nav -->
                      <ul class="main-nav">
                          <li><a href="">CÓ GÌ MỚI</a></li>
                          <li><a href="">DEALS</a></li>
                          <li><a href="">THƯƠNG HIỆU</a></li>
                          <li><a href="">SẢN PHẨM</a></li>
                      </ul>
                  </div>
                  <div class="logo-container">
                      <img src="/public/img/SWEELEE logo.png" alt="Logo">
                  </div>

                  <div class="user-actions">
                      <a href="">Đăng nhập</a>

                  </div>
                  
          </header>
          <main class="main-content">
                  <div class="search-box">
                      <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-search" width="18" height="18" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M21.38 13.847c0-2.07-.733-3.837-2.2-5.304s-3.245-2.21-5.334-2.23c-2.09-.02-3.868.723-5.335 2.23-1.467 1.507-2.2 3.275-2.2 5.304 0 2.03.733 3.807 2.2 5.334 1.467 1.527 3.245 2.26 5.335 2.2 2.09-.06 3.867-.794 5.334-2.2 1.467-1.406 2.2-3.184 2.2-5.334ZM30 27.86c0 .583-.221 1.085-.663 1.507-.442.422-.954.633-1.537.633a1.961 1.961 0 0 1-1.477-.633l-5.756-5.756c-2.01 1.386-4.25 2.08-6.722 2.08a11.68 11.68 0 0 1-4.61-.935c-1.468-.622-2.723-1.466-3.768-2.531-1.045-1.065-1.889-2.32-2.532-3.767a10.886 10.886 0 0 1-.934-4.611c.02-1.627.331-3.154.934-4.58a12.088 12.088 0 0 1 2.532-3.798 11.12 11.12 0 0 1 3.767-2.531c1.427-.583 2.964-.894 4.611-.935 1.648-.04 3.185.272 4.612.935a14.084 14.084 0 0 1 3.767 2.531c1.085 1.025 1.929 2.29 2.532 3.797a12.69 12.69 0 0 1 .934 4.581c0 2.471-.693 4.711-2.08 6.72l5.757 5.756c.422.422.633.935.633 1.537Z" fill="#231E18"></path></svg>
                      <input type="text" name="" id="" >
                      <a href="https://www.google.com/?hl=vi">Google</a>
                  </div>


                  <div class="product-container">
                    <div class="product-images">
                      <div class="main-image">
                        <img src="public/img/Product/main-guitar.jpg" alt="Guitar chính">
                      </div>
                      <div class="thumbnail-images">
                        <img src="public/img/Product/thumb1.jpg" alt="">
                        <img src="public/img/Product/thumb2.jpg" alt="">
                        <img src="public/img/Product/thumb3.jpg" alt="">
                        <img src="public/img/Product/thumb4.jpg" alt="">
                      </div>
                    </div>
                    <div class="product-info">
                      <h2 class="product-title">
                        <?= $product->product_name ?>
                      </h2>
                      <p class="product-price"><?= number_format($product->base_price, 0, '', '.') ?> ₫</p>
                      </h2>
                      <p class="product-installment">hoặc <strong>7.260.000₫</strong> hàng tháng</p>
                      <button class="add-to-cart">🛒 Thêm vào giỏ hàng</button>
                      <div class="product-description">
                        <h3>Về Sản Phẩm</h3>
                        <p><?= $product->description ?></p>
                      </div>
                    </div>
                  </div>
          </main>


      </div>
    </body>
  
</html>
