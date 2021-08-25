<?php
require_once('../../db/dbc.php');
$s_token = "";
if (isset($_COOKIE['token'])) {
    $s_token = $_COOKIE['token'];
    $sql = "select * from taikhoan where token ='$s_token'";
    $tokenData = executeResult($sql);
    if ($tokenData != null) {
        $data = $tokenData[0];
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
    <title>Personal Account: <?= $data['taikhoan'] ?></title>
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
    <link rel="stylesheet" href="../css/page/info.css">
    <link rel="stylesheet" href="../css/layout/footer.css">
</head>

<body>
    <!-- Please copy styles from <style></style> to your file styles -->
    <!-- Container  -->
    <div class="container-fluid">
        <?php
        include('../libLayout/header.php');
        ?>
        <?php
        $sql = "SELECT * FROM taikhoan where  id_taikhoan = " . $data['id_taikhoan'];
        $listtaikhoan = executeResult($sql);
        if ($listtaikhoan !=  null) {
            $taikhoan =  $listtaikhoan[0];
        } else {
            echo 'k cso';
        }
        ?>
        <div class="container-link">
            <div class="container-hello">
                <p>xin chào: <?= $data['taikhoan'] ?> [ <?php
                    if ($data['lv'] == 2) {
                         echo '<a href="../dashboard/pages/dashboard.php">Đến trang quản trị</a>';
                     } else {
                         echo '<a href="infoupdate.php?id=' . $taikhoan['id_taikhoan'] . '">Cập nhật thông tin cá nhân</a>';
                     }
                     ?> ]
                </p>
            </div>
            <div class="detail-info">
                <div class="info_img">
                    <img src="<?= $taikhoan['hinhanh'] ?>" alt="">
                </div>
                <div class="info_title">
                    <p>Họ tên: <?= $taikhoan['ten'] ?></p>
                    <p>Ngày sinh: <?= $taikhoan['ngaysinh'] ?></p>
                    <p>Số điện thoại: <?= $taikhoan['sdt'] ?></p>
                    <p>Email: <?= $taikhoan['mail'] ?></p>
                    <p>Địa chỉ: <?= $taikhoan['diachi'] ?>
                    </p>
                    <h5>Lưu ý: Để hạn chế gặp phải các sự cố ngoài ý muốn, chúng tôi khuyến cáo nên đặt các thông tin sát với sự thật và cam kết không để lộ dữ liệu khách hàng. </h5>
                    <a href="infoupdate.php?id=<?= $taikhoan['id_taikhoan'] ?>">Cập nhật thông tin</a>
                    <p class="pc__hidden"></p>
                    <a class="logout" href="../../db/logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
        <?php
        include('../libLayout/footer.php');
        ?>
    </div>
</body>

</html>