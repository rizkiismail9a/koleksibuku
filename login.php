<?php
session_start();
require "function.php";
if (isset($_COOKIE['x']) && isset($_COOKIE['kimi'])) {
    $id = $_COOKIE['x'];
    $username = $_COOKIE['kimi'];
    $query = mysqli_query($connect, "SELECT username FROM user WHERE id = $id");
    if (mysqli_num_rows($query) == 1) {
        $_SESSION['login'] = true;
    }

}
if (isset($_SESSION['login'])) {
    header("location: index.php");
    exit;
}
;


if (isset($_POST["login"])) {
    echo login($_POST);

}
;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css?<?= time(); ?>">
    <title>Pustakawan Masuk</title>
</head>

<body>
    <h1>Masuk Sebagai Pustakawan</h1>
    <div class="form-wrapper">
        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" autocomplete="off">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ingat Saya</label>
            </div>
            <button type="submit" name="login">Masuk</button>
        </form>
    </div>
</body>

</html>