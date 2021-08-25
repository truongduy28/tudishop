<?php
require_once('dbc.php');
$s_token = '';
$s_id = '';
if (isset($_COOKIE['token'])) {
    $s_token = $_COOKIE['token'];
    $sql = "select * from taikhoan where token = '$s_token'";
    $Accs = executeResult($sql);
    if ($Accs !=  null) {
        $taikhoan = $Accs[0]['id_taikhoan'];
        if (isset($_GET['id'])) {
            $s_id = $_GET['id'];
            $sql = "SELECT * FROM `giohang` WHERE id_taikhoan_fk = $taikhoan && id_sanpham_fk = " . $s_id;
            $dem = executeResult($sql);
            if ($dem !=  null && $dem > 0) {
                if ($taikhoan != '' && $s_id != '') {
                    $demsoluong = $dem[0]['soluong'];
                    $demsoluong++;
                    $sql = "UPDATE giohang set soluong = '$demsoluong' WHERE id_taikhoan_fk = '$taikhoan' && id_sanpham_fk = '$s_id'";
                    execute($sql);
                    header("Location: ../public/layout/cart.php");
                    die();
                }
            } else {
                if ($taikhoan != '' && $s_id != '') {
                    $sql = "INSERT INTO giohang(id_taikhoan_fk, id_sanpham_fk, soluong) VALUES ('$taikhoan','$s_id',1)";
                    execute($sql);
                    echo $sql;
                    header("Location: ../public/layout/cart.php");
                    die();
                }
            }
        }
    }
} else {
    header("Location: ../page/login.php");
}
