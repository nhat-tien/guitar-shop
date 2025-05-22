            <header class="section-header">
                <div class="top-bar">
                    <!-- Begin: Nav -->
                    <ul class="main-nav">
                        <li><a href="/collection">SẢN PHẨM</a></li>
                    </ul>
                </div>
                <div class="logo-container">
                    <img src="/public/img/logo.png" alt="Logo">
                </div>

                <div class="user-actions">
                    <a href="/login">Đăng nhập</a>
                    <a href="/checkout">Giỏ hàng</a>
                    <?php
                    if(isset($_SESSION['user'])) {
                        $user = $_SESSION['user']['name'];
                        echo "
                            <p>Xin chào {$user}</p>
                            <a href='/logout'>Đăng xuất</a>
                        ";
                    };
                    ?>
                </div>

            </header>