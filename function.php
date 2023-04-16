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
    $sampul = upload();
    if ($sampul == false) {
        return false;
    }
    ;

    $input = "INSERT INTO koleksibuku VALUES('', '$sampul', '$judul', '$pengarang', '$penerbit', '$tahunterbit')";

    mysqli_query($connect, $input);
    return mysqli_affected_rows($connect);
}
//Untuk handle gambar
function upload()
{
    $namaFile = $_FILES['sampul']['name'];
    $sizeFile = $_FILES['sampul']['size'];
    $namaTmp = $_FILES['sampul']['tmp_name'];
    $error = $_FILES['sampul']['error'];

    if ($error === 4) {
        echo "<script> alert('sampulnya mana?') </script>";
        return false;
    }

    $fileValid = ['jpg', 'jpeg', 'png', 'gif'];
    $separator = explode('.', $namaFile);
    $separator = strtolower(end($separator));

    if (!in_array($separator, $fileValid)) {
        echo "<scipt> alert('gambarnya mana?') </script>";
        return false;
    }
    ;
    if ($sizeFile > 3000000) {
        echo "<scipt> alert('kegedean gambarnya?') </script>";
        return false;
    }
    ;
    $namaFileBaru = uniqid() . "." . $separator;
    move_uploaded_file($namaTmp, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}
;
//Ini untuk hapus.php
function hapus($id)
{
    global $connect;
    mysqli_query($connect, "DELETE FROM koleksibuku WHERE id=$id");
    return mysqli_affected_rows($connect);
}


//Ini untuk edit.php
function editBuku($books, $id)
{
    global $connect;
    $judul = htmlspecialchars($books['judul']);
    $pengarang = htmlspecialchars($books['pengarang']);
    $penerbit = htmlspecialchars($books['penerbit']);
    $tahunterbit = htmlspecialchars($books['tahunterbit']);
    $sampul = htmlspecialchars($books['sampul']);

    $input = "UPDATE koleksibuku SET sampul='$sampul', judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahunterbit='$tahunterbit' WHERE id=$id";

    mysqli_query($connect, $input);
    return mysqli_affected_rows($connect);
}
//Ini untuk cariBuku
function cariBuku($keyword)
{
    $query = "SELECT * FROM koleksibuku WHERE judul LIKE '%$keyword%' OR pengarang LIKE '%$keyword%' OR penerbit LIKE '%$keyword%' OR tahunterbit LIKE '%$keyword%'";
    return tampilkanData($query);
}
;
?>