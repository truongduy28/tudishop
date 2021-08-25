<!DOCTYPE html>
<html lang="en">
<?php
require_once('../../db/dbc.php');
$s_token = "";
if (isset($_COOKIE['token'])) {
    $s_token = $_COOKIE['token'];
    $sql = "SELECT * from taikhoan WHERE taikhoan.token ='$s_token' ";
    $tokenData = executeResult($sql);
    if ($tokenData != null) {
        $data = $tokenData[0];
    }
} else {
    header("Location: login.php");
}
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tudisoft order</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Boostrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/layout/resetCss.css">
    <link rel="stylesheet" href="../css/page/order.css">
    <link rel="stylesheet" href="../css/layout/header.css">
    <link rel="stylesheet" href="../css/layout/orderStatus.css">
    <link rel="stylesheet" href="../css/layout/highlightProduct.css">
    <link rel="stylesheet" href="../css/layout/banner2nd.css">
    <link rel="stylesheet" href="../css/layout/miniCategory.css">
    <link rel="stylesheet" href="../css/layout/miniAbout.css">
    <link rel="stylesheet" href="../css/layout/footer.css">
</head>

<body>
    <!-- Please copy styles from <style></style> to your file styles -->
    <!-- Container  -->
    <div class="container-fluid">
       <?php
            include('../libLayout/header.php');
       ?>
        <div class="container-link">
            <div class="container-hello">
                <p>xin chào: <?= $tokenData[0]['ten'] ?> [ <a href="info.php">xem thông tin cá nhân</a> ]</p>
            </div>
            <?php
                include('../libLayout/orderStatus.php');
            ?>
            <div class="detail">
                <?php
                $sql = "SELECT * from taikhoan, donhang WHERE taikhoan.id_taikhoan = donhang.id_taikhoan_fk && taikhoan.token ='$s_token' ORDER BY donhang.ngaycapnhat DESC";
                $all = executeResult($sql);
                if ($all != null) {
                    foreach ($all as $data) {
                        echo '
                            <div class="detail_element">
                                <div class="element_title">
                                    <div>
                                        <img src="' . $data['hinhanh'] . '" alt="">
                                    </div>
                                    <div>
                                        <p>Đơn hàng ' . $data['magiaodich'] . ' </p>
                                        <p>Ngày đặt hàng: ' . $data['ngaycapnhat'] . '</p>
                                        ';
                        echo ' 
                                        <br class="mobile__hidden">
                                        <br class="mobile__hidden">

                                        <p style="color: red;
                                        font-style: italic;
                                        margin: 20px;"
                                        >Mọi thắc mắc về đơn hàng vui lòng liên hệ ngay với chúng tôi trong vòng 24h để được xử lý kịp thời!</p>
                                    </div>
                                </div>
                                ';
                        if ($data['trangthai'] == 1) {
                            echo '
                                    <div class="shutdown">
                                            <ul style=" background-color: #ffcccc;line-height: 25px;">
                                                <li>Trạng thái đơn:  Chờ xác nhận </li>    
                                                <ul><li><a style="background: #fffa65;" href="../../db/cancel.php?id=' . $data['id_donhang'] . '">Hủy đơn</a> </li>
                                                <li><a href="orderDetail.php?id=' . $data['id_donhang'] . '">Chi tiết đơn hàng</a></li></ul>
                                            </ul>
                                            
                                        </div>
                                    </div>
                                    ';
                        }
                        if ($data['trangthai'] == 2) {
                            echo '
                            <div class="shutdown">
                                    <ul style=" background-color: #ffeaa7;line-height: 25px;">
                                        <li>Trạng thái đơn:  Đang giao </li>
                                        <ul>
                                            <li><a style="background: #7bed9f" href="../db/cancel.php?id=' . $data['id_donhang'] . '">Đã nhận được hàng</a></li>
                                            <li><a href="orderDetail.php?id=' . $data['id_donhang'] . '">Chi tiết đơn hàng</a></li>                                        </ul>
                                        
                                    </ul>
                                </div>
                            </div>
                            ';
                        }
                        if ($data['trangthai'] == 3) {
                            echo '
                            <div class="shutdown">
                                    <ul style=" background-color: #97ffb8;line-height: 25px;">
                                        <li>Trạng thái đơn:  Đã giao </li>
                                        <li><a href="orderDetail.php?id=' . $data['id_donhang'] . '">Chi tiết đơn hàng</a></li>                                    </ul>
                                </div>
                            </div>
                            ';
                        }
                        if ($data['trangthai'] == 4) {
                            echo '
                            <div class="shutdown">
                                    <ul style=" background-color: #ff6b6b;line-height: 25px;">
                                        <li>Trạng thái đơn:  Đã hủy</li>
                                        <li><a href="orderDetail.php?id=' . $data['id_donhang'] . '">Chi tiết đơn hàng</a></li>                                    </ul>
                                </div>
                            </div>
                            ';;
                        }
                    }
                } else {
                    echo ' <p style="text-align: center; margin: 150px;">Không có đơn hàng nào!</p> 
                   ';
                }
                ?>


            </div>
         <?php
            include('../libLayout/banner2nd.php');
            include('../libLayout/miniCategory.php');
            include('../libLayout/miniAbout.php');
         ?>
        </div>
      <?php
            include('../libLayout/footer.php');
      ?>
    </div>
</body>

</html>