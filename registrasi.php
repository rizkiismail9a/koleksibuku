<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location: login.php");
    exit;
}
require "function.php";
if (isset($_POST["daftar"])) {
    $username = $_POST['username'];
    $password1 = mysqli_real_escape_string($connect, $_POST['password1']);
    $password2 = mysqli_real_escape_string($connect, $_POST['password2']);
    $checkUsername = mysqli_query($connect, "SELECT username FROM user WHERE username = '$username'");
    if (daftar($_POST) > 0) {
        echo "<script>
        alert('selamat bergabung!'); 
        document.location.href = 'index.php';
        </script>";
    } elseif (mysqli_num_rows($checkUsername) > 0) {
        $usernameUsed = true;
    } elseif ($password1 !== $password2) {
        $passwordUnmatch = true;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css?<?= time(); ?>">
    <title>Daftar Pustakawan</title>
</head>

<body>
    <h1>Daftar Menjadi Pustakawan</h1>
    <div class="form-wrapper">
        <form action="" method="post">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" autocomplete="off" placeholder="Masukkan huruf">
            <?php if (isset($usernameUsed)): ?>
                <p class="usernameUsed">Username-nya udah dipake orang</p>
            <?php endif ?>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" autocomplete="off" pattern="[a-zA-Z0-9-]+"
                placeholder="Masukkan huruf dan/atau angka">

            <label for="password1">Password</label>
            <input type="password" name="password1" id="password1">
            <?php if (isset($passwordUnmatch)): ?>
                <p class="usernameUsed">Hmmm... kok, beda sama yang di atas?</p>
            <?php endif ?>
            <label for="password2">Konfirmasi Password</label>
            <input type="password" name="password2" id="password2">
            <button type="submit" name="daftar">Daftar</button>
        </form>
    </div>
</body>

</html>