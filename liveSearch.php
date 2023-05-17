<?php
session_start();
require 'function.php';
$keyword = $_GET['keyword'];
$_SESSION["keyword"] = $_GET['keyword'];

$query = "SELECT * FROM koleksibuku WHERE judul LIKE '%$keyword%' OR pengarang LIKE '%$keyword%' OR penerbit LIKE '%$keyword%' OR tahunterbit LIKE '%$keyword%' ";
$booksFound = mysqli_num_rows(mysqli_query($connect, $query));

$dataBuku = tampilkanData($query);
$nomor = 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Cari</title>
</head>

<body>
    <div class="table-wrapper">
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
                    <td class="nomor">
                        <?php echo $nomor; ?>
                        <?php $nomor++; ?>
                    </td>
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
                    <td><a href="hapus.php?id=<?= $buku['id']; ?>" onclick="return confirm('yakin mau dibuang?');">Hapus</a>
                        |
                        <a href="edit.php?id=<?= $buku['id']; ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?php if ($booksFound < 1): ?>
            <h1>Belum Punya Buku Itu 😭</h1>

        <?php endif ?>
    </div>


</body>

</html>