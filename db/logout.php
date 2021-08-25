<?php
    require_once('dbc.php');
    $s_token = "";
    if(isset($_COOKIE['token'])){
        $s_token = $_COOKIE['token'];
        $sql = "update taikhoan set token = '' where token = '$s_token'";
        echo $sql;
        execute($sql);
    }
    else{
        echo ' k cos cookie';
    }
   
    setcookie('token', '', time()-10, '/');
    header("Location:../public/layout/login.php");
?>