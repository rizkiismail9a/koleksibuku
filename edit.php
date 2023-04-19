<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location: login.php");
    exit;
}
require 'function.php';
$id = $_GET['id'];


$bukuYangAkanDiedit = tampilkanData("SELECT * FROM koleksibuku WHERE id=$id")[0];

if (isset($_POST['submit'])) {
    if (editBuku($_POST, $id) > 0) {
        echo "<script>
        alert('Udah dibenerin, coy!');
        document.location.href = 'index.php';
        </script>";

    } else {
        echo "<p>Ada yang salah, nih</p>";
    }
    ;

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/tambahBuku.css?<?= time(); ?>">
    <title>Edit Buku</title>
</head>

<body>
    <h1>Ada yang salah?</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="form-wrapper">
                <input type="hidden" name="sampulLama" id="" value="<?= $bukuYangAkanDiedit['sampul']; ?>">
                <label for="judul">Judul</label>
                <input required type="text" id="judul" name="judul" value="<?= $bukuYangAkanDiedit['judul']; ?>">
                <label for="pengarang">Pengarang</label>
                <input required type="text" id="pengarang" name="pengarang"
                    value="<?= $bukuYangAkanDiedit['pengarang']; ?>">
                <label for="penerbit">Penerbit</label>
                <input required type="text" id="penerbit" name="penerbit"
                    value="<?= $bukuYangAkanDiedit['penerbit']; ?>">
                <label for="tahunterbit">Tahun Terbit</label>
                <input required type="text" id="tahunterbit" name="tahunterbit"
                    value="<?= $bukuYangAkanDiedit['tahunterbit']; ?>">
                <label for="sampul">Sampul</label>
                <img src="img/<?= $bukuYangAkanDiedit['sampul']; ?>" class="oldImage">
                <input type="file" id="sampul" name="sampul" value="<?= $bukuYangAkanDiedit['sampul']; ?>">
                <button type="submit" name="submit">Edit Buku</button>
            </div>
        </div>

    </form>
</body>

</html>