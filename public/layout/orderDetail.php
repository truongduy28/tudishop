<!DOCTYPE html>
<html lang="en">
<?php
require_once('../../db/dbc.php');
$s_token = "";
if (isset($_COOKIE['token'])) {
    $s_token = $_COOKIE['token'];
    $sql = "SELECT * from taikhoan, donhang WHERE taikhoan.id_taikhoan = donhang.id_taikhoan_fk && taikhoan.token ='$s_token' ";
    $tokenData = executeResult($sql);
    if ($tokenData != null) {
        $data = $tokenData[0];
        $e_token = $data['token'];
    }
} else {
    header("Location: login.php");
}
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My order detail</title>
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
                <p>xin ch??o:
                    <?= $tokenData[0]['ten'] ?> [ <a href="info.php">xem th??ng tin c?? nh??n</a> ]</p>
            </div>
            <?php
                include('../libLayout/orderStatus.php');
            ?>
            <div class="content-detail">
                <?php
                if (isset($_GET['id'])) {
                    $s_id = $_GET['id'];
                    $sql = "SELECT * FROM taikhoan, donhang, chitietdonhang, sanpham WHERE taikhoan.id_taikhoan = donhang.id_taikhoan_fk && chitietdonhang.id_donhang_fk = donhang.id_donhang && chitietdonhang.id_sanpham_fk = sanpham.id_sanpham && taikhoan.token ='$e_token' && donhang.id_donhang = " . $s_id;
                    // echo $sql;
                    $list = executeResult($sql);
                    if ($list != null) {
                        $detail = $list[0];
                    }
                }

                ?>
                <div class="info_account">
                    <h6>Th??ng tin kh??ch h??ng</h6>
                    <p>T??i kho???n: <?= $detail['taikhoan'] ?></p>
                    <p>T??n kh??ch h??ng: <?= $detail['ten'] ?></p>
                    <p>S??? ??i???n tho???i: <?= $detail['sdt'] ?></p>
                    <p>?????a ch???: <?= $detail['diachi'] ?></p>
                    <p style="color: red; font-weight: bold;">M?? ????n h??ng: <?= $detail['magiaodich'] ?> </p>
                </div>
                <div class="info_order">
                    <table>
                        <thead>

                            <tr>
                                <td width=50px;>STT</td>
                                <td style="width: 100px; ">H??nh ???nh</td>
                                <td>T??n s???n ph???m</td>
                                <td width=50px;>S??? l?????ng</td>
                                <td width=100px;>Gi??</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($list != null) {
                                $index = 1;
                                $total = 0;
                                foreach ($list as $detail) {
                                    echo '
                                        <tr>
                                            <td>' . ($index++) . '</td>
                                            <td ><img src="' . $detail['img'] . '"></td>
                                            <td>' . $detail['tensanpham'] . '</td>
                                            <td>' . $detail['soluongsp'] . '</td>
                                            <td>' . number_format($detail['gia'] * $detail['soluongsp']) . ' vn??</td>
                                        </tr>
                                        ';
                                    $total += ($detail['gia'] * $detail['soluongsp']);
                                }
                            }
                            ?>

                        </tbody>
                        <tr>
                            <td style="background-color: aliceblue;" colspan="5">
                                <ul>
                                    <li>Tr???ng th??i ????n h??ng: <?php
                                                                if ($detail['trangthai'] == 1) {
                                                                    echo '  <a style="color: #f1c40f;">Ch??? x??c nh???n</a>';
                                                                }
                                                                if ($detail['trangthai'] == 2) {
                                                                    echo '  <a style="color: #2ed573;">??ang giao h??ng</a>';
                                                                }
                                                                if ($detail['trangthai'] == 3) {
                                                                    echo '  <a style="color: #1e90ff;">???? nh???n h??ng</a>';
                                                                }
                                                                if ($detail['trangthai'] == 4) {
                                                                    echo '  <a style="color: #e55039;">???? h???y</a>';
                                                                }
                                                                ?></li>
                                    <li>T???ng ti???n thanh to??n:
                                        <a style="color: red; font-weight: bold; font-size: 17px;"> <?= number_format($total) ?> vn??</a>
                                    </li>

                                </ul>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="link">
                    <a href="order.php">Tr??? v??? trang ????n h??ng c???a t??i</a> | <a href="index.php">Trang ch???</a>
                </div>
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