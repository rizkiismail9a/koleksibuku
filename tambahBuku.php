<?php
require 'function.php';
if (isset($_POST['submit'])) {
    // var_dump($_POST);
    // var_dump($_FILES);
    // die;
    if (tambahBuku($_POST) > 0) {
        echo "<script>
        alert('Yey! Buku baru!');
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
    <title>Tambah Koleksi</title>
</head>

<body>
    <h1>Punya Buku Baru?</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="form-wrapper">
                <label for="judul">Judul</label>
                <input required type="text" id="judul" name="judul">
                <label for="pengarang">Pengarang</label>
                <input required type="text" id="pengarang" name="pengarang">
                <label for="penerbit">Penerbit</label>
                <input required type="text" id="penerbit" name="penerbit">
                <label for="tahunterbit">Tahun Terbit</label>
                <input required type="text" id="tahunterbit" name="tahunterbit">
                <label for="sampul">Sampul</label>
                <input required type="file" id="sampul" name="sampul">
                <button type="submit" name="submit">Tambah Buku</button>
            </div>
        </div>

    </form>
</body>

</html>