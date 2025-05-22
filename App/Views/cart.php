<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chi tiết sản phẩm</title>
        <link rel="stylesheet" href="/public/css/main.css">
        <link rel="stylesheet" href="/public/css/style-cart.css">
        <style>
            body {
                overflow: auto;
            }
        </style>
    </head>
    <body>
        <div class="main">
        <?php include "App/Views/components/header.php" ?>
          <main style="margin-bottom: 100px" class="main-content">
                
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


                <h1>Giỏ Hàng</h1>

                    <div class="container">
                    <div id="cart-cnt" class="left">
                    </div>

                    <div class="right">
                        <div class="shipping-info">Chi phí vận chuyển: <span style="color: teal;">Miễn phí</span></div>
                        <div class="delivery-info">Thời gian giao: 3-5 ngày</div>
                        <button id="btn-send" class="order-button"></button>
                        <p style="text-align: center; font-size: 13px;">(Đã bao gồm thuế)</p>
                        <div class="note">
                            Bằng việc tiến hành kiểm tra, bạn đã đồng ý với
                        <a href="#">Bảo mật</a> của chúng tôi.
                        </div>
                    </div>
                    </div>
                    
          </main>
      </div>
    <div id="toast-container"></div>
    <script src="/public/js/toast.js"></script>
      <script>
        let btn = document.getElementById("btn-send");

        if(localStorage.getItem("cart") != undefined) {
            let cnt = document.getElementById("cart-cnt");
            let cart = JSON.parse(localStorage.getItem("cart"));
            let str = ``;
            let total = 0;
            cart.forEach(e => {
                str += `
                        <img src="${e.url}" class="product-image" alt="Pedalboard">
                        <div class="product-info">
                        <h2>${e.product_name}</h2>
                        <p class="stock">Có hàng</p>
                        <a href=""><p class="price">${numberWithCommas(e.price)}₫</p></a>
                        <div class="quantity">
                            Số lượng:
                            <input type="number" value="1" min="1" />
                        </div>
                        <button onclick="deleteCart('${e.product_id}')">Xóa</button>
                        </div>
                `;
                total += e.price;
            });
            cnt.innerHTML = str;
            btn.innerText = `Đặt hàng - ${numberWithCommas(total)}₫`
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function deleteCart(id) {
            if(localStorage.getItem("cart") != undefined) {
                let cart = JSON.parse(localStorage.getItem("cart"));
                cart = cart.filter(e => e["product_id"] != id)
                localStorage.setItem("cart", JSON.stringify(cart));
                location.reload();
            }
        }

        btn.addEventListener("click", () => {
            if(localStorage.getItem("cart") != undefined) {
                let formData = new FormData();
                formData.append("cart", localStorage.getItem("cart"));
                fetch("/stores", {
                    method: "POST",
                    body: formData
                }).then(e => e.json())
                .then(e => {
                    if(e.status) {
                        window.location.href = "/admin/products";
                        showToast(`Đặt thành công`)
                    } else {
                        console.log(e.message)
                        showToast(`Có lỗi xảy ra: ${e.message}`, "error")
                    }
                });
            }
        });


      </script>
    </body>
  
</html>
