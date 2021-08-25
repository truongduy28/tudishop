<?php
require_once('../../db/dbc.php');
$s_taikhoan = $s_email = $s_matkhau = "";
$s_ngaycapnhat = date('y-m-d');
if (isset($_POST['taikhoan'])) {
    $s_taikhoan = $_POST['taikhoan'];
}
if (isset($_POST['email'])) {
    $s_email = $_POST['email'];
}
if (isset($_POST['matkhau'])) {
    $s_matkhau = $_POST['matkhau'];
}

$sql = "insert into taikhoan (taikhoan, mail, matkhau, ngaycapnhat) values ('$s_taikhoan','$s_email','$s_matkhau','$s_ngaycapnhat')";
if ($s_taikhoan != "" && $s_matkhau != "" && $s_email != "") {
    execute($sql);
    header("Location: login.php");
} else {
    echo '<p style="background-color: red; color:white;">Vui lòng nhập đủ các thông tin</p> <br>
                    ';
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register Tudishop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/layout/resetCss.css">
    <link rel="stylesheet" href="../css/page/login.css">
</head>

<body>
    <div class="container">
        <div class="form">
            <h1>REGISTER</h1>
            <p>Please enter your username and password?</p>
            <form method="post">
                <input type="text" name="taikhoan" placeholder=" Enter your username">
                <br>
                <input type="email" name="email" id="" placeholder=" Enter your mail">
                <br>
                <input type="password" name="matkhau" placeholder=" Enter your password">
                <br><br>
                <a>By pressing the registration button, you agree with our terms and policies.</a>
                <br>
                <button type="submit">Register</button>
            </form>
            <p>
                You already have an account,<a href="login.php">login here</a>
            </p>
            <a href="">Privacy Policy</a> | <a href="">Terms of service</a>
            <br>
            <br>
            <a href="index.php">Back to home</a>
        </div>
    </div>
</body>

</html>