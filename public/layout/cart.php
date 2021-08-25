<?php
require_once('../../db/dbc.php');
$s_token = "";
if (isset($_COOKIE['token'])) {
    $s_token = $_COOKIE['token'];
    $sql = "SELECT * from sanpham, taikhoan, giohang WHERE sanpham.id_sanpham = giohang.id_sanpham_fk && taikhoan.id_taikhoan = giohang.id_taikhoan_fk && taikhoan.token ='$s_token'";
    $tokenData = executeResult($sql);
    if ($tokenData != null) {
    }
} else {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tudishop cart</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Boostrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- CSS -->
    <!-- <link rel="stylesheet" href="../css/product.css"> -->
    <link rel="stylesheet" href="../css/layout/resetCss.css">
    <link rel="stylesheet" href="../css/page/cart.css">
    <link rel="stylesheet" href="../css/layout/header.css">
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

        <div class="container content-mid" id="start">
            <!-- sanpham -->
            <div class="content-header">
                <img src="https://c8.alamy.com/comp/MT6A21/shopping-cart-empty-with-red-handle-and-details-on-wooden-background-banner-copy-space-view-from-above-3d-illustration-MT6A21.jpg" alt="">
                <h1>Giỏ hàng</h1>
            </div>
            <div class="content--mid">
                <?php
                if (isset($_POST['capnhatgiohang'])) {
                    for ($i = 0; $i < count($_POST['sl_update']); $i++) {
                        $sanpham_update = $_POST['id_sanpham_update'][$i];
                        $taikhoan_update = $_POST['id_taikhoan_update'][$i];
                        $soluong_update = $_POST['sl_update'][$i];
                        if ($taikhoan_update != "" && $sanpham_update != "" && $soluong_update != "") {
                            $sqlUpdate = "UPDATE giohang set soluong = $soluong_update where id_taikhoan_fk = $taikhoan_update && id_sanpham_fk = $sanpham_update ";
                            execute($sqlUpdate);
                        }
                    }
                    header("Location: navigation.php");
                    die();
                }
                if (isset($_POST['thanhtoan'])) {
                    if ($tokenData != null) {
                        echo $tokenData[0]['id_taikhoan'];
                        if ($tokenData[0]['ten']  != null || $tokenData[0]['diachi'] != null || $tokenData[0]['sdt'] != null) {
                            $magiaodich = 'DH' . rand(0, 99999999) . 'VN';
                            $ngaycapnhat = date('y-m-d');
                            $id_donhang = rand(0, 99999999);
                            if ($tokenData != null) {
                                $data =  $tokenData[0];
                                $data_id_taikhoan = $tokenData[0]['id_taikhoan'];
                            } else {
                                echo ' Login';
                            }
                            $sqlInsertDonhang  = "INSERT INTO donhang (id_donhang, id_taikhoan_fk, magiaodich, trangthai, ngaycapnhat ) VALUES ('$id_donhang','$data_id_taikhoan','$magiaodich','1','$ngaycapnhat')";
                            execute($sqlInsertDonhang);
                            echo $sqlInsertDonhang;
                            for ($i = 0; $i < count($_POST['sl_update']); $i++) {
                                $sanpham_update = $_POST['id_sanpham_update'][$i];
                                $taikhoan_update = $_POST['id_taikhoan_update'][$i];
                                $soluong_update = $_POST['sl_update'][$i];
                                if ($taikhoan_update != "" && $sanpham_update != "" && $soluong_update != "") {
                                    $sqlInsertChitietdonhang = "INSERT INTO chitietdonhang(id_donhang_fk, id_sanpham_fk, soluongsp) VALUES ('$id_donhang','$sanpham_update','$soluong_update')";
                                    execute($sqlInsertChitietdonhang);
                                    echo '<br>' . $sqlInsertChitietdonhang;
                                    $sqlDelete = "DELETE from giohang WHERE id_taikhoan_fk = $taikhoan_update && id_sanpham_fk = $sanpham_update ";
                                    execute($sqlDelete);
                                }
                            }
                            header("Location: order.php");
                            die();
                        } else {
                            $id_taikhoan = $tokenData[0]['id_taikhoan'];
                            header("Location: infoupdate.php?id=$id_taikhoan");
                            die();
                        }
                    }
                }
                ?>
                <form method="post">
                    <?php
                    if (isset($_COOKIE['token'])) {
                        $s_token = $_COOKIE['token'];
                        $sql = "SELECT * from sanpham, taikhoan, giohang WHERE sanpham.id_sanpham = giohang.id_sanpham_fk && taikhoan.id_taikhoan = giohang.id_taikhoan_fk && taikhoan.token ='$s_token'";
                        $tokenData = executeResult($sql);
                        if ($tokenData != null) {
                            $total = 0;
                            $index = 1;
                            echo '
                            <table>
                                <thead>
                                    <tr>
                                        <td width="25px">STT</td>
                                        <td width="180px">Hình ảnh</td>
                                        <td>Tên sản phẩm</td>
                                        <td width="70px">Số lượng</td>
                                        <td>Giá</td>
                                        <td width="25px">Xóa</td>
                                    </tr>
                                </thead>
                                <tbody>';
                            foreach ($tokenData as $data) {
                                echo '
                            <tr>
                                <td>' . ($index++) . '</td>
                                <td><img src="' . $data['img'] . '" alt=""></td>
                                <td><a href="product.php?id=' . $data['id_sanpham'] . '">' . $data['tensanpham'] . '</a></td>
                                <td> 
                                    <input value="' . $data['id_taikhoan'] . '" name="id_taikhoan_update[]" type="hidden">
                                    <input value="' . $data['id_sanpham'] . '" name="id_sanpham_update[]" type="hidden">  
                                    <input style = "width:60px; text-align: center;" type="number" value="' . $data['soluong'] . '" min="1" name="sl_update[]">
                                </td>
                                <td>' . number_format($data['soluong'] * $data['gia']) . 'vnđ</td>
                                <td>X</td>
                            </tr>
                            ';
                                $total += ($data['soluong'] * $data['gia']);
                            }
                            echo '
                                    <tr style="height: 25px;
                                    font-weight: bold;
                                    font-style: italic;">
                                        <td colspan="6" style="color: red;">Tổng tiền: ' . number_format($total) . 'vnđ</td>
                                    </tr>
                                    <tr style="height: 25px;
                                    font-weight: bold;
                                    font-style: italic;">
                                        <td colspan="6">      
                                            <input class="submit" type="submit" value = "Cập nhật giỏ hàng" name="capnhatgiohang">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        ';
                            echo '
                        </div>
                        <div class="content-khach">
                            <h5>Thông tin thanh toán</h5>
                            <hr>
                            <p>Tài khoản:  ' . $data['taikhoan'] . '</p>
                            <p>Tên khách hàng: ' . $data['ten'] . '</p>
                            <p>Emai: ' . $data['mail'] . '</p>
                            <p>Số điện thoại: ' . $data['sdt'] . '</p>
                            <p>Địa chỉ: ' . $data['diachi'] . ' </p>
                            <a href="infoupdate.php?id=' . $data['id_taikhoan'] . '" >Thay đổi thông tin</a>
                            <input class="dathang" type="submit" name="thanhtoan" value="Thanh toán đến địa chỉ này">
                            <a style="background-color:#ffcccc" href="order.php">Đơn hàng của tôi</a>
                        </div>
                        </form>
                        ';
                        } else
                            echo ' <p style="text-align: center; margin-top: 100px;"> Không có sản phẩm trong giỏ hàng! <a href="products.php">Mua hàng ngay</a> </p>';
                    }
                    ?>
            </div>
        </div>
        <?php
        include('../libLayout/footer.php')
        ?>
    </div>
</body>

</html>