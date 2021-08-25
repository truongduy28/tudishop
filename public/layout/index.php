<?php
require_once('../../db/dbc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tudishop - Online shopping experience for everyone </title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Boostrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/layout/resetCss.css">
    <link rel="stylesheet" href="../css/page/index.css">
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
            <!-- header -->
            <?php
            include('../libLayout/header.php');
            ?>
            <div class="banner">
                <video muted autoplay>
                    <source src="../../img/banner/y2mate.com - Delivery Man HD Stock Video  Free stock footage  Free HD Videos  No Copyright  Channel PMI_1080p.mp4">
                </video>
                <div class="title">
                    <h1>SHOPPING NOW !</h1>
                    <a href="#start">START</a>
                </div>
                <div class="overlay"></div>
            </div>
        </section>
        <div class="container content-mid" id="start">
            <div class="container-sale">
                <div class="sale__item" style="background-color: #55efc4;">
                    <p><i class="fas fa-truck"></i></p>
                    <h5 class="mobile__hidden">MIỄN PHÍ VẬN CHUYỂN</h5>
                    <a>Miễn phí giao hàng khi đặt hóa đơn trên 250.000vnđ</a>
                </div>
                <div class="sale__item" style="background-color: #fd79a8;">
                    <p> <i class="fas fa-undo-alt"></i></p>
                    <h5 class="mobile__hidden">HOÀN TRẢ SẢN PHẨM LỖI</h5>
                    <a>Đảm bảo hoàn trả tiền nếu sản phẩm lỗi trong 7 ngày!</a>
                </div>
                <div class="sale__item" style="background-color: #fdcb6e;">
                    <p><i class="fas fa-comments"></i></p>
                    <h5 class="mobile__hidden">DỊCH VỤ CHĂM SÓC 24/7</h5>
                    <a>Chúng tôi hỗ trợ trực tuyến 24 giờ 1 ngày</a>
                </div>
            </div>
            <?php
            include('../libLayout/highlightProduct.php');
            include('../libLayout/banner2nd.php');
            include('../libLayout/miniCategory.php');
            include('../libLayout/miniAbout.php');
            ?>
        </div>
        <!-- Footer -->
        <?php
        include('../libLayout/footer.php');
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