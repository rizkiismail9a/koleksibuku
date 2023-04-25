<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

require 'function.php';
// require 'index.php';

$dataBuku = tampilkanData("SELECT * FROM koleksibuku ");
$nomorList = 1;
$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css?' . time() . '"> 
    <title>Daftar Buku</title>
</head>

<body>
    <h1>Koleksi Buku</h1>
    <p> Jumlah data:' . $jumlahBuku . '  </p>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr style="background-color: brown; color: white;"  >
            <th>No.</th>
            <th>Sampul</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
        </tr>';
foreach ($dataBuku as $buku) {
    $html .= ' <tr class="baris">
    <td class="nomor">
       ' . $nomorList++ . '
    </td>
    <td><img width="50" src="img/' . $buku["sampul"] . ' " ></td>
    <td>
        ' . $buku["judul"] . '
    </td>
    <td>
        ' . $buku["pengarang"] . '
    </td>
    <td>
        ' . $buku["penerbit"] . '
    </td>
    <td>
      ' . $buku["tahunterbit"] . '
    </td>
    </tr>';

}
;


$html .= '</table>
</body>

</html>';
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);

$mpdf->Output('koleksibuku.pdf', \Mpdf\Output\Destination::INLINE);

?>