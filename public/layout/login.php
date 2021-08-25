<?php
    require_once('../../db/dbc.php');
    $s_token = "";
    if (isset($_COOKIE['token'])) {
        $s_token = $_COOKIE['token'];
        $sql  = "select * from taikhoan where token = '$s_token'";
        $data = executeResult($sql);
        if ($data !=  null) {
            if ($data[0]['lv'] == 2) {
                header("Location: ../dashboard/pages/dashboard.php");
                die();
            } 
            else  {
                header("Location: index.php");
                die();
            }
        }
    } else {
    }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login to Tudisoft</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/layout/resetCss.css">
    <link rel="stylesheet" href="../css/page/login.css">
</head>

<body>
    <div class="container">
        <div class="form">
            <h1>LOGIN</h1>
            <?php
            $s_taikhoan = $s_matkhau = "";
            if (isset($_POST['taikhoan'])) {
                $s_taikhoan = $_POST['taikhoan'];
            }
            if (isset($_POST['matkhau'])) {
                $s_matkhau = $_POST['matkhau'];
            }
            $sql = "SELECT * FROM taikhoan where taikhoan = '$s_taikhoan' && matkhau = '$s_matkhau' limit 1";
            if ($s_taikhoan != "" && $s_matkhau != "") {
                $data = executeResult($sql);
                if ($data != null) {
                    if ($data[0]['lv'] == 2) {
                        $token = time() . $data[0]['mail'];
                        setcookie('token', $token, time() + 7 * 24 * 60 * 60, '/');
                        $sql = "update taikhoan set token = '$token' where id_taikhoan =" . $data[0]['id_taikhoan'];
                        execute($sql);
                        header("Location: ../dashboard/pages/dashboard.php");
                    } elseif ($data[0]['lv'] == 0) {
                        $token = time() . $data[0]['mail'];
                        setcookie('token', $token, time() + 7 * 24 * 60 * 60, '/');
                        $sql = "update taikhoan set token = '$token' where id_taikhoan =" . $data[0]['id_taikhoan'];
                        execute($sql);
                        header("Location:index.php");
                    }
                }
            }
            ?>
            <p>Please enter your username and password?</p>
            <form method="post">
                <input type="text" name="taikhoan" placeholder=" Enter your username">
                <br>
                <input type="password" name="matkhau" placeholder=" Enter your password">
                <br>
                <a href="">Foget password ?</a>
                <br>
                <button type="submit">Login</button>
                <br>
                <br>
                <p>If you don't have an account, <a href="register.php">register now</a></p>
                <a href="index.php">Back to home</a>
            </form>
        </div>
    </div>
    <script src="" async defer></script>
</body>

</html>