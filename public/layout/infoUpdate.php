<?php
require_once('../../db/dbc.php');
$s_id = "";
if (isset($_GET['id'])) {
    $s_id = $_GET['id'];
}
$s_ten = $s_hinhanh = $s_ngaysinh = $s_sdt = $s_diachi = "";
$s_ngaycapnhat = date('y-m-d');
if (isset($_POST['ten'])) {
    $s_ten = $_POST['ten'];
}
if (isset($_POST['sdt'])) {
    $s_sdt = $_POST['sdt'];
}
if (isset($_POST['ngaysinh'])) {
    $s_ngaysinh = $_POST['ngaysinh'];
}
if (isset($_POST['hinhanh'])) {
    $s_hinhanh = $_POST['hinhanh'];
}
if (isset($_POST['diachi'])) {
    $s_diachi = $_POST['diachi'];
}
if ($s_ten != "" && $s_hinhanh != "" && $s_sdt != "" && $s_diachi != "") {
    $sql = "UPDATE taikhoan set `ten` = '$s_ten', `sdt` = '$s_sdt',`ngaysinh` = '$s_ngaysinh',`hinhanh` = '$s_hinhanh', `diachi` = '$s_diachi',`ngaycapnhat` = '$s_ngaycapnhat' WHERE `id_taikhoan` = " . $s_id;

    execute($sql);
    header("Location: info.php");
    die();
}

$s_id = "";
if (isset($_GET['id'])) {
    $s_id = $_GET['id'];
    $sql = "SELECT * from taikhoan WHERE id_taikhoan = " . $s_id;
    $data = executeResult($sql);
    if ($data !=  null) {
        $taikhoan = $data[0];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
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
    <title>Update account detail</title>
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
    <link rel="stylesheet" href="../css/page/infoUpdate.css">
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
                <p>xin chào: <?= $taikhoan['taikhoan'] ?> [ <a href="info.php">xem thông tin cá nhân</a> ]</p>
            </div>
            <div class="detail-info">
                <form action="" method="post">
                    <h1>CẬP NHẬT THÔNG TIN CÁ NHÂN</h1>
                    <input type="text" name="ten" placeholder="Họ và tên" value="<?= $taikhoan['ten'] ?>">
                    <br>
                    <input type="text" name="sdt" placeholder=" Số điện thoại" value="<?= $taikhoan['sdt'] ?>">
                    <br>
                    <input type="date" name="ngaysinh" id="" placeholder="Ngày sinh" value="<?= $taikhoan['ngaysinh'] ?>">
                    <br>
                    <input type="text" name="hinhanh" src="" alt="" placeholder=" Liên kết ảnh đại diện" value="<?= $taikhoan['hinhanh'] ?>">
                    <br>
                    <input type="text" name="diachi" placeholder=" Nhập địa chỉ nhận hàng" value="<?= $taikhoan['diachi'] ?>">
                    <br>
                    <button>Cập nhật</button>
                </form>
            </div>

        </div>
     <?php
        include('../libLayout/footer.php');
     ?>
    </div>
</body>

</html>