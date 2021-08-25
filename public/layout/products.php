<!DOCTYPE html>
<html lang="en">
<?php
require_once('../../db/dbc.php');

$s_token = "";
if (isset($_COOKIE['token'])) {
    $s_token = $_COOKIE['token'];
    $sql = "SELECT * from taikhoan WHERE token ='$s_token'";

    $tokenData = executeResult($sql);
    if ($tokenData != null) {
    }
}
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All products</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Boostrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/layout/resetCss.css">
    <link rel="stylesheet" href="../css/page/products.css">
    <link rel="stylesheet" href="../css/layout/header.css">
    <link rel="stylesheet" href="../css/layout/highlightProduct.css">
    <link rel="stylesheet" href="../css/layout/banner2nd.css">
    <link rel="stylesheet" href="../css/layout/miniCategory.css">
    <link rel="stylesheet" href="../css/layout/miniAbout.css">
    <link rel="stylesheet" href="../css/layout/footer.css">

</head>
<?php
$s_search = "";
if (isset($_GET['search'])) {
    $s_search = $_GET['search'];
}
// 
$limit = 20;
$startpage = 1;
if (isset($_GET['page'])) {
    $startpage = $_GET['page'];
}
$firstIndexProductInPage = ($startpage - 1) * $limit;
if ($s_search != "") {
    $sqlSP = 'Select * from sanpham where tensanpham like "%' . $s_search . '%"  limit ' . $firstIndexProductInPage . ',' . $limit;
    // page
    $sqlpage = 'SELECT COUNT(id_sanpham) as total FROM sanpham';
    $countResult = executeResult($sqlpage);
    if ($countResult != null) {
        $count = $countResult[0];
        $number = ceil($count['total'] / $limit);
    } else {
        echo 'kh có page';
    }
} else {
    $sqlSP = 'SELECT * from sanpham where 1 limit ' . $firstIndexProductInPage . ',' . $limit;
    // page
    $sqlpage = 'SELECT COUNT(id_sanpham) as total FROM sanpham';
    $countResult = executeResult($sqlpage);
    if ($countResult != null) {
        $count = $countResult[0];
        $number = ceil($count['total'] / $limit);
    } else {
        echo 'kh có page';
    }
}
?>

<body>
    <!-- Please copy styles from <style></style> to your file styles -->
    <!-- Container  -->
    <div class="container-fluid">
        <section class="header">
            <?php
            include('../libLayout/header.php');
            ?>
            <div class="header-banner">

                <video autoplay muted loop>
                    <source src="../../img/banner/y2mate.com - Product Advertisement  Motion graphics_1080p.mp4">
                </video>

                <div class="search">
                    <form method="get">
                        <input name="search" type="search" placeholder=" Tìm tất cả sản phẩm ..." value="<?= $s_search ?>">
                        <button type="submit">Tìm kiếm</button>
                    </form>

                </div>
                <div class="overlay"></div>
            </div>
        </section>

    </div>
    <div class="container content-mid" id="start">
        <!-- sanpham -->

        <div class="container-products" id="product">
            <?php
            if ($s_search != "") {
                echo '
                        <p>Tìm kiếm cho từ khóa: " ' . $s_search . ' "</p>
                    ';
            }
            ?>
            <!-- <h1>SẢN PHẨM NỔI BẬT</h1> -->
            <div class="product">
                <?php
                $list_sanpham = executeResult($sqlSP);
                if ($list_sanpham != null) {
                    foreach ($list_sanpham as $sanpham) {
                        echo ' 
                            <div class="product__element">
                                <a href="product.php?id=' . $sanpham['id_sanpham'] . '"><img src="' . $sanpham['img'] . '" alt=""></a>
                                <br>
                                <h5>' . $sanpham['tensanpham'] . '</h5>
                                <p>' . number_format($sanpham['gia']) . ' vnđ</p>
                                <br>
                                <a href="../../db/addtocard.php?id=' . $sanpham['id_sanpham'] . '" class="addcart"> Thêm vào giỏ</a>
                            </div>
                            ';
                    }
                } else {
                    echo ' 
                        <p style="margin: 100px 0px;">Không tìm thấy sản phẩm có từ khóa " ' . $s_search . ' " </p>';
                }
                ?>
            </div>
            <div class="pagination">
                <?php

                ?>
                <ul>
                    <?php
                    if ($startpage > 1) {
                        echo '
                                <li><a href="?search=' . $s_search . '&page=' . ($startpage - 1) . '">Previous</a></li>
                            ';
                    }
                    ?>
                    <?php
                    for ($i = 1; $i <= $number; $i++) {
                        if ($startpage == ($i)) {
                            echo ' 
                                <li class = "page_active"><a href=""> ' . ($i) . ' </a></li>
                                ';
                        } else {
                            echo ' 
                                <li><a href="products.php?search=' . $s_search . '&page=' . ($i) . '"> ' . ($i) . ' </a></li>
                               ';
                        }
                    }
                    ?>
                    <?php
                    if ($startpage < $number) {
                        echo '
                                <li><a href="?search=' . $s_search . '&page=' . ($startpage + 1) . '">Next</a></li>
                            ';
                    }
                    ?>
                </ul>
            </div>
        </div>

        <?php
        include('../libLayout/banner2nd.php');
        include('../libLayout/miniCategory.php');
        include('../libLayout/miniAbout.php');
        ?>
    </div>
    <?php
    include('../libLayout/footer.php')
    ?>
    </div>
    <script src="../../js/vanillaTil.js"></script>
    <script type="text/javascript">
        VanillaTilt.init(document.querySelector(".product__element"), {
            max: 25,
            speed: 400
        });

        //It also supports NodeList
        VanillaTilt.init(document.querySelectorAll(".product__element"));
    </script>
</body>

</html>