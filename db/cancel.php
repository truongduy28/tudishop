<?php
require_once('dbc.php');
$s_token = "";
if (isset($_COOKIE['token'])) {
    $s_token = $_COOKIE['token'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "select * from donhang, taikhoan where taikhoan.token = '$s_token' && id_donhang = " . $id;
        $list = executeResult($sql);
        if ($list != null) {
            if ($list[0]['trangthai'] == 1) {
                $sqlUpdate = "update donhang set trangthai = 4 where id_donhang = '$id'";
                execute($sqlUpdate);
                header("Location: ../public/layout/cancel.php");
                die();
            }
            if ($list[0]['trangthai'] == 2) {
                $sqlUpdate = "update donhang set trangthai = 3 where id_donhang = '$id'";
                execute($sqlUpdate);
                header("Location: ../public/layout/order.php");
                die();
            }
            if ($list[0]['trangthai'] == 3) {
                echo ' Đơn hàng đã được nhận, không thể hủy!';
                echo ' <a href="../cart.php">Trở về quản lý đon hàng</a>';
            }
            if ($list[0]['trangthai'] == 4) {
                echo ' Đơn hàng đã hủy!';
                echo ' <a href="../cart.php">Trở về quản lý đon hàng</a>';
            }
        }
    }
} else {
    echo ' k cos cookie';
}
