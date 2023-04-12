<?php
$connect = mysqli_connect('localhost', 'root', '', 'belajarphpdasar');


//Untuk index.php
function tampilkanData($data)
{
    global $connect;
    $hasil = mysqli_query($connect, $data);
    $books = [];
    while ($book = mysqli_fetch_assoc($hasil)) {
        $books[] = $book;
    }
    ;
    return $books;

}

//Untuk tambahBuku.php
function tambahBuku($books)
{
    global $connect;
    $judul = htmlspecialchars($books['judul']);
    $pengarang = htmlspecialchars($books['pengarang']);
    $penerbit = htmlspecialchars($books['penerbit']);
    $tahunterbit = htmlspecialchars($books['tahunterbit']);
    $sampul = htmlspecialchars($books['sampul']);

    $input = "INSERT INTO koleksibuku VALUES('', '$sampul', '$judul', '$pengarang', '$penerbit', '$tahunterbit')";

    mysqli_query($connect, $input);
    return mysqli_affected_rows($connect);
}

function hapus($id)
{
    global $connect;
    mysqli_query($connect, "DELETE FROM koleksibuku WHERE id=$id");
    return mysqli_affected_rows($connect);
}
;
?>