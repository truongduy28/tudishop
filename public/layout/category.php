<?php
require_once('../../db/dbc.php');
$s_token = "";
if (isset($_COOKIE['token'])) {
    $s_token = $_COOKIE['token'];
    $sql = "SELECT * from taikhoan WHERE token ='$s_token'";

    $tokenData = executeResult($sql);
    if ($tokenData != null) {
        $id = '';
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                }
                $sql = 'SELECT * FROM `danhmuc` WHERE id_danhmuc = ' . $id;
                $list_danhmuc = executeResult($sql);
                if ($list_danhmuc != null) {
                    $danhmuc = $list_danhmuc[0];
                }
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $danhmuc['tendanhmuc'] ?> - Tudishop</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Boostrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/layout/resetCss.css">
    <link rel="stylesheet" href="../css/page/category.css">
    <link rel="stylesheet" href="../css/layout/header.css">
    <link rel="stylesheet" href="../css/layout/highlightProduct.css">
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
            <div class="header-banner">
                <?php
                $id = '';
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                }
                $sql = 'SELECT * FROM `danhmuc` WHERE id_danhmuc = ' . $id;
                $list_danhmuc = executeResult($sql);
                if ($list_danhmuc != null) {
                    $danhmuc = $list_danhmuc[0];
                }
                ?>
                <img src="<?= $danhmuc['banner'] ?>" alt="">
                <div class="search">
                    <h1><?= $danhmuc['tendanhmuc'] ?></h1>
                    <?php
                    $s_search = "";
                    if (isset($_GET['search'])) {
                        $s_search = $_GET['search'];
                    }
                    if ($s_search != "") {
                        $sql = 'SELECT * from sanpham, danhmuc WHERE sanpham.id_danhmuc_fk  = danhmuc.id_danhmuc and sanpham.tensanpham like "%' . $s_search . '%" and sanpham.id_danhmuc_fk = ' . $id;
                    } else {
                        $sql = 'SELECT * from sanpham, danhmuc WHERE sanpham.id_danhmuc_fk  = danhmuc.id_danhmuc and sanpham.id_danhmuc_fk = ' . $id;
                    }
                    ?>
                    <form action="" method="get">
                        <input type="text" name="id" value="<?= $id ?>" style="display: none;">
                        <input type="text" name="search" placeholder="T??m ki???m trong <?= $danhmuc['tendanhmuc'] ?>" value="<?= $s_search ?>">
                        <button type="submit">T??m ki???m</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
    <div class="container content-mid" id="start">
        <!-- sanpham -->

        <div class="container-products" id="product">
            <?php
            if ($s_search != "") {
                echo '
                    <br>
                        <p>T??m ki???m cho t??? kh??a: " ' . $s_search . ' "</p>
                    ';
            }
            ?>
            <!-- <h1>S???N PH???M N???I B???T</h1> -->
            <div class="product">
                <?PHP

                $list_sanpham = executeResult($sql);
                if ($list_sanpham != null) {
                    foreach ($list_sanpham as $sanpham) {
                        echo ' 
                            <div class="product__element">
                                <a href="product.php?id=' . $sanpham['id_sanpham'] . '"><img src="' . $sanpham['img'] . '" alt=""></a>
                                <br>
                                <h5>' . $sanpham['tensanpham'] . '</h5>
                                <p>' . number_format($sanpham['gia']) . ' vn??</p>
                                <br>
                                <a href="../../db/addtocard.php?id='.$sanpham['id_sanpham'].'" class="addcart"> Th??m v??o gi???</a>
                            </div>
                            ';
                    }
                } else {
                    echo ' 
                        <p style="margin: 100px 0px;">Kh??ng t??m th???y s???n ph???m c?? t??? kh??a " ' . $s_search . ' " </p>';
                }
                ?>



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