<?php
require_once('../../db/dbc.php');
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$sql = "SELECT * from sanpham, danhmuc WHERE sanpham.id_danhmuc_fk = danhmuc.id_danhmuc and sanpham.id_sanpham =
    " . $id;
$list_sanpham = executeResult($sql);
if ($list_sanpham != null) {
    $sanpham = $list_sanpham[0];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=$sanpham['tensanpham']?>  - Tudishop</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Boostrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/layout/resetCss.css">
    <link rel="stylesheet" href="../css/layout/header.css">
    <link rel="stylesheet" href="../css/layout/highlightProduct.css">
    <link rel="stylesheet" href="../css/page/product.css">
    <link rel="stylesheet" href="../css/layout/banner2nd.css">
    <link rel="stylesheet" href="../css/layout/miniCategory.css">
    <link rel="stylesheet" href="../css/layout/miniAbout.css">
    <link rel="stylesheet" href="../css/layout/footer.css">
</head>

<body>
    <!-- Container  -->
    <div class="container-fluid">
        <section class="header">
            <?php
            include('../libLayout/header.php');
            ?>
        </section>
        <div class="container-link">
            <?php
            // kiemtra cokkie
            if (isset($_POST)) {
                $s_token = "";
                if (isset($_COOKIE['token'])) {
                    $s_token = $_COOKIE['token'];
                    $sql = "select * from taikhoan where token ='$s_token'";
                    $tokenData = executeResult($sql);
                    if ($tokenData != null) {
                        $data = $tokenData[0];
                    }
                }
                // get du lieu
                $s_id_taikhoan = '';
                $s_id_sanpham = '';
                if (isset($_POST['id_taikhoan'])) {
                    $s_id_taikhoan = $_POST['id_taikhoan'];
                }
                if (isset($_POST['id_sanpham'])) {
                    $s_id_sanpham = $_POST['id_sanpham'];
                }
                // Kiem tra gio hàng(Up/In)
                if (isset($_POST)) {
                    $sql = "SELECT * FROM `giohang` WHERE id_taikhoan_fk = $s_id_taikhoan && id_sanpham_fk = " . $s_id_sanpham;
                    $dem = executeResult($sql);
                    if ($dem !=  null && $dem > 0) {
                        if ($s_id_taikhoan != '' && $s_id_sanpham != '') {
                            $demsoluong = $dem[0]['soluong'];
                            $demsoluong++;
                            $sql = "UPDATE giohang set soluong = '$demsoluong' WHERE id_taikhoan_fk = '$s_id_taikhoan' && id_sanpham_fk = '$s_id_sanpham'";
                            execute($sql);
                            header("Location: cart.php");
                        }
                    } else {
                        if ($s_id_taikhoan != '' && $s_id_sanpham != '') {
                            $sql = "INSERT INTO giohang(id_taikhoan_fk, id_sanpham_fk, soluong) VALUES ('$s_id_taikhoan','$s_id_sanpham',1)";
                            execute($sql);
                            echo $sql;
                            header("Location: cart.php");
                        }
                    }
                }
            }
            ?>
            <a href="">Home</a> / <a href="category.php?id=<?= $sanpham['id_danhmuc'] ?>"><?= $sanpham['tendanhmuc'] ?></a> / <a> <?= $sanpham['tensanpham'] ?></a>
        </div>
        <div class="container content-mid" id="start">
            <!-- sanpham -->
            <div class="container-product">
                <div class="main">
                    <div class="main__img">
                        <img src="<?= $sanpham['img'] ?>" alt="">
                    </div>
                    <div class="main__title">
                        <h1><?= $sanpham['tensanpham'] ?></h1>
                        <h4>Giá: <?= number_format($sanpham['gia']) ?> vnđ</h4>
                        <p class="mobile__hidden">Tổng quan nhanh: </p>
                        <a class="mobile__hidden">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam a optio ipsum, velit et ratione quaerat asperiores voluptates non eveniet laborum sunt magni perferendis hic repudiandae? Quidem nostrum necessitatibus magnam?
                            <br>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto reiciendis dolorem velit! Molestias nesciunt nihil quidem, vero iusto minima reprehenderit eveniet reiciendis enim. Vitae velit eveniet molestias illum reprehenderit excepturi.
                        </a>

                        <form action="" method="post">
                            <input type="text" value="<?= $data['id_taikhoan'] ?>" name="id_taikhoan">
                            <input type="text" value="<?= $sanpham['id_sanpham'] ?>" name="id_sanpham">
                            <button class="mobile__hidden">Thêm vào giỏ hàng</button>

                        </form>
                    </div>
                </div>
                <div class="detail">
                    <h2>Chi tiết sản phẩm: </h2>
                    <p>
                        <?= $sanpham['chitiet'] ?>
                    </p>
                </div>
            </div>
            <?php
            include('../libLayout/highlightProduct.php');
            include('../libLayout/banner2nd.php');
            include('../libLayout/miniCategory.php');
            include('../libLayout/miniAbout.php');
            ?>
        </div>
        <footer>
            <div class="footer">
                <video autoplay loop muted>
                    <source src="../img/banner/People Using Phone HD Stock Video 2 _Free stock footage _Free HD Videos - No Copyright _Channel PMI.mp4">
                </video>
                <div class="title">
                    <h1>TUDISHOP</h1>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui, soluta ipsum minus, molestias incidunt repellendus amet neque corporis eius reiciendis ratione, aut molestiae dolorem veniam doloribus autem fugit. Fugiat, magni?</p>
                </div>
                <div class="copyright">
                    <p>Copyright © 2021 Tudisoft
                    </p>
                    <p><a href="">Điều khoản dịch vụ </a> | <a href=""> Chính sách bảo mật</a></p>
                </div>
                <div class="overlay"></div>
            </div>

        </footer>
        <div class="fix-mobile">
            <form action="" method="post">
                <input type="text" value="<?= $data['id_taikhoan'] ?>" name="id_taikhoan" hidden>
                <input type="text" value="<?= $sanpham['id_sanpham'] ?>" name="id_sanpham" hidden>
                <p><button class="pc__hidden"> <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</button></p>
            </form>
        </div>
    </div>

    <script src="../../js/vanillaTil.js"></script>
    <script type="text/javascript">
        VanillaTilt.init(document.querySelector(".main__img"), {
            max: 25,
            speed: 400
        });

        //It also supports NodeList
        VanillaTilt.init(document.querySelectorAll(".main__img"));
    </script>
</body>

</html>