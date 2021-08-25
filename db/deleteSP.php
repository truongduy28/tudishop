<?php
ob_start();
require_once ('../db/dbc.php');
if (isset($_POST['id_sanpham'])) {
	$id = $_POST['id_sanpham'];
	$sql = 'delete from sanpham where id_sanpham = '.$id;
	execute($sql);
	echo 'Xoá sản phẩm thành công';
	echo $sql;
}