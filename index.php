<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location: login.php");
    exit;
}



require 'function.php';

$query = mysqli_query($connect, "SELECT * FROM koleksibuku");
$booksAvailable = mysqli_num_rows($query); // ada 10
$booksPerPage = 4;
$totalOfPages = ceil($booksAvailable / $booksPerPage); //3 halaman
$indexStart = 0;
if (isset($_GET['halaman'])) {
    $activePage = $_GET['halaman'];
} else {
    $activePage = 1;
}
if ($activePage == 1) {
    $indexStart = 0;
} else {
    $indexStart = 0 + ($activePage - 1) * 4;
}
;

$dataBuku = tampilkanData("SELECT * FROM koleksibuku LIMIT $indexStart, $booksPerPage");


if (isset($_POST['keyword'])) {
    $dataBuku = cariBuku($_POST["keyword"]);

}
;

$nomor = 1;
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
    <div class="logout-wrapper">
        <a class="logout" href="logout.php">Keluar</a>
    </div>
    <h1>Perpustakaanku</h1>
    <div class="addOrSearch">
        <a class="tambah" href="tambahBuku.php">Tambah Buku</a>
        <form action="" method="post">
            <input type="text" name="keyword" autocomplete="off" placeholder="cari judul, pengarang, atau penerbit"
                class="pencarian" required>
            <button type="submit" name="cari" class="tombol-cari">Cari Buku</button>
        </form>
    </div>
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
    </div>
    <?php if (count($dataBuku) < 1): ?>
        <h1>Belum punya buku itu 😭</h1>
    <?php endif ?>

    <div class="bottom-wrapper">
        <div>
            <?php if ($activePage > 1): ?>
                <a class="navigasi blue" href="?halaman=<?= $activePage - 1; ?>">
                    &leftarrow;
                </a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalOfPages; $i++): ?>
                <?php if ($i == $activePage): ?>
                    <a class="navigasi blue" href="?halaman=<?= $i + 1; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php else: ?>
                    <a class="navigasi" href="?halaman=<?= $i; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($activePage < 3): ?>
                <a class="navigasi blue" href="?halaman=<?= $activePage + 1; ?>">
                    &rightarrow;
                </a>
            <?php endif; ?>
        </div>
        <a href="cetakpdf.php" class="cetak" target="_blank">Cetak PDF</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="script/liveSearch.js"></script>

</body>

</html>