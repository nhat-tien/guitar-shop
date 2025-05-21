<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chi tiết sản phẩm</title>
        <link rel="stylesheet" href="/public/css/style-login.css">
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
                
                <form action="/search">
                    <div class="search-box">
                        <svg class="icon-search" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M21.38 13.847c0-2.07-.733-3.837-2.2-5.304s-3.245-2.21-5.334-2.23c-2.09-.02-3.868.723-5.335 2.23-1.467 1.507-2.2 3.275-2.2 5.304 0 2.03.733 3.807 2.2 5.334 1.467 1.527 3.245 2.26 5.335 2.2 2.09-.06 3.867-.794 5.334-2.2 1.467-1.406 2.2-3.184 2.2-5.334ZM30 27.86c0 .583-.221 1.085-.663 1.507-.442.422-.954.633-1.537.633a1.961 1.961 0 0 1-1.477-.633l-5.756-5.756c-2.01 1.386-4.25 2.08-6.722 2.08a11.68 11.68 0 0 1-4.61-.935c-1.468-.622-2.723-1.466-3.768-2.531-1.045-1.065-1.889-2.32-2.532-3.767a10.886 10.886 0 0 1-.934-4.611c.02-1.627.331-3.154.934-4.58a12.088 12.088 0 0 1 2.532-3.798 11.12 11.12 0 0 1 3.767-2.531c1.427-.583 2.964-.894 4.611-.935 1.648-.04 3.185.272 4.612.935a14.084 14.084 0 0 1 3.767 2.531c1.085 1.025 1.929 2.29 2.532 3.797a12.69 12.69 0 0 1 .934 4.581c0 2.471-.693 4.711-2.08 6.72l5.757 5.756c.422.422.633.935.633 1.537Z" fill="#A48D3A"/></svg>
                        <input type="text" placeholder="Tìm kiếm sản phẩm hoặc thương hiệu" name="" id="">
                        <pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre>
                        
                        <select name="brand">
                            <option value="">-- Hãng đàn --</option>
                            <option value="yamaha">Yamaha</option>
                            <option value="fender">Fender</option>
                            <option value="ibanez">Ibanez</option>
                            <option value="gretsch">Gretsch</option>
                        </select>

                        <select name="category">
                            <option value="">-- Danh mục --</option>
                            <option value="guitar-dien">Guitar Điện</option>
                            <option value="guitar-acoustic">Guitar Acoustic</option>
                            <option value="guitar-bass">Guitar Bass</option>
                            <option value="phu-kien">Phụ kiện</option>
                        </select>
                        <select name="bodyshape">
                            <option value="">-- Dáng đàn --</option>
                            <option value="stratocaster">Stratocaster</option>
                            <option value="telecaster">Telecaster</option>
                            <option value="les-paul">Les Paul</option>
                            <option value="hollow">Hollow Body</option>
                            <option value="superstrat">Super Strat</option>
                        </select>

                        <button type="submit">Tìm</button>


                    </div>
                </form>

                <div class="login-container">
                    <div class="login-box">
                    <h2>ĐĂNG NHẬP</h2>
                    <p>Chưa đăng ký thành viên? <a href="#">Đăng ký</a> tại đây</p>
                    <label>Địa chỉ email</label>
                    <input type="email" placeholder="Địa chỉ email">
                    <label>Mật Khẩu</label>
                    <input type="password" placeholder="Mật khẩu">
                    <button>Đăng nhập</button>
                    <a href="#" class="forgot">Quên mật khẩu?</a>
                    </div>

                    <div class="register-reason">
                    <h2>LÝ DO ĐĂNG KÝ?</h2>
                    <p>
                        Tạo tài khoản nhanh chóng, dễ dàng và miễn phí! Hơn nữa, bạn sẽ được truy cập vào những tính năng tuyệt vời chỉ dành riêng cho thành viên:
                    </p>
                    <ul>
                        <li>📦 Theo dõi đơn hàng online dễ dàng</li>
                        <li>🎁 Tích điểm, nhận thưởng độc quyền và nhiều lợi ích chỉ dành cho thành viên</li>
                        <li>💳 Thao tác thanh toán nhanh gọn</li>
                    </ul>
                    </div>
                </div>
                
          </main>
      </div>
    </body>
  
</html>
