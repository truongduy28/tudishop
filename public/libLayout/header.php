<section class="header">
    <div class="header-top welcome">
        <p>Welcome to Tudishop online shoping</p>
        <nav>
            <ul>
                <li class="mobile__hidden">
                    <a href=""><i class="fab fa-facebook-f"></i> Facebook</a>
                </li>
                <li class="mobile__hidden">
                    <a href="#"><i class="far fa-envelope"></i> Email</a>
                </li>
                <li class="mobile__hidden">
                    <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                </li>
                <li>
                    <a> <i class="fas fa-user-alt"></i>
                        <?php
                        $s_token = "";
                        if (isset($_COOKIE['token'])) {
                            $s_token = $_COOKIE['token'];
                            $sql = "select * from taikhoan where token ='$s_token'";
                            $tokenData = executeResult($sql);
                            if ($tokenData != null) {
                                echo $tokenData[0]['taikhoan'];
                            } else {
                                echo ' <a href="../layout/login.php">Login</a>';
                            }
                        } else {
                            echo '<a href="../layout/login.php">Login</a>';
                        }
                        ?>
                    </a>
                    <?php
                    $s_token = "";
                    if (isset($_COOKIE['token'])) {
                        $s_token = $_COOKIE['token'];
                        $sql = "select * from taikhoan where token ='$s_token'";
                        $tokenData = executeResult($sql);
                        if ($tokenData != null) {
                            echo '
                                        <ul>
                                            <li><a href="../layout/info.php"><i class="fas fa-info-circle"></i> Thông tin cá nhân</a></li>
                                            <li><a href="../layout/order.php"> <i class="fas fa-list-ul"></i> Đơn hàng của tôi</a></li>
                                            <li><a href="../../db/logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                                        </ul>
                                        ';
                        }
                    }
                    ?>
                </li>
            </ul>
        </nav>
    </div>
    <div class="header-mid header-logo">
        <h1>tudishop</h1>
        <nav class="mobile__hidden">
            <ul>
                <li>
                    <a href="../layout/index.php">TRANG CHỦ</a>
                </li>
                <li>
                    <a href="#category">DANH MỤC</a>
                </li>
                <li>
                    <a href="../layout/products.php">SẢN PHẨM</a>
                </li>
                <li>
                    <a href="#about">VỀ CHÚNG TÔI</a>
                </li>
                <li>
                    <a href="#">LIÊN HỆ</a>
                </li>
            </ul>

        </nav>
        <div class="cart ">
            <a class="mobile__hidden" href="../layout/cart.php"><i class="fas fa-cart-arrow-down"></i></a>
            <br class="mobile__hidden">
            <p class="mobile__hidden"> Giỏ hàng</p>
            <input type="checkbox" hidden name="" id="menu_nav">
            <label for="menu_nav"><i class="fas fa-bars"></i></label>
            <label for="menu_nav" class="overlay"></label>
            <nav class="nav_mobile">
                <p>Xin chào: Tudisoft</p>
                <ul>
                    <li>
                        <a href="../layout/index.php"> <i class="fas fa-home"></i> TRANG CHỦ</a>
                    </li>
                    <li>
                        <a href="#category"><i class="fas fa-stream"></i> DANH MỤC</a>
                    </li>
                    <li>
                        <a href="../layout/products.php"> <i class="fas fa-cubes"></i> SẢN PHẨM</a>
                    </li>
                    <li>
                        <a href="#about"> <i class="fas fa-code"></i> VỀ CHÚNG TÔI</a>
                    </li>
                    <li>
                        <a href="#"> <i class="far fa-envelope"></i> LIÊN HỆ</a>
                    </li>

                </ul>
                <ul>
                    <li><a href="../layout/cart.php"> <i class="fas fa-cart-plus"></i> Giỏ hàng</a></li>
                    <li><a href="../layout/order.php"> <i class="fab fa-first-order"></i> Đơn hàng của tôi</a></li>
                    <li><a href="../layout/info.php"> <i class="far fa-user"></i> Thông tin cá nhân</a></li>
                    <li><a href="../../db/logout.php"> <i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                </ul>
            </nav>

        </div>

    </div>
</section>