<?php
require 'function.php';
$dataBuku = tampilkanData('SELECT * FROM koleksibuku');
if (isset($_POST['cari'])) {
    $dataBuku = cariBuku($_POST["keyword"]);
}
;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css?v=<?php echo time(); ?>">
    <title>Koleksi Buku</title>
</head>

<body>
    <h1>Perpustakaanku</h1>
    <div class="addOrSearch">
        <a class="tambah" href="tambahBuku.php">Tambah Buku</a>
        <form action="" method="post">
            <input type="text" name="keyword" autocomplete="off" placeholder="cari judul, pengarang, atau penerbit"
                required>
            <button type="submit" name="cari">Cari Buku</button>
        </form>
    </div>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Sampul</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($dataBuku as $buku): ?>
            <tr class="baris">
                <td class="nomor">1</td>
                <td><img src="img/<?= $buku['sampul']; ?> " alt="" srcset=""></td>
                <td>
                    <?= $buku['judul']; ?>
                </td>
                <td>
                    <?= $buku['pengarang']; ?>
                </td>
                <td>
                    <?= $buku['penerbit']; ?>
                </td>
                <td>
                    <?= $buku['tahunterbit']; ?>
                </td>
                <td><a href="hapus.php?id=<?= $buku['id']; ?>" onclick="confirm('yakin mau dibuang?');">Hapus</a> | <a
                        href="edit.php?id=<?= $buku['id']; ?>">Edit</a> </td>
            </tr>
        <?php endforeach ?>
    </table>

    <script src="script/script.js"></script>
</body>

</html>