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
    $fileExtension = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $fileValid)) {
        echo "<script> alert('Harus gambar, ya');</script>";
        return false;
    }
    ;
    if ($sizeFile > 3000000) {
        echo "<script> alert('Harus gambar, ya');</script>";
        return false;
    }
    ;
    $namaBaru = uniqid() . "." . $fileExtension;
    move_uploaded_file($namaTmp, "img/" . $namaBaru);
    return $namaBaru;
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
    if ($_FILES['sampul']['error'] === 4) {
        $sampul = htmlspecialchars($books['sampulLama']);
    } else {
        $sampul = upload();
    }
    ;

    $input = "UPDATE koleksibuku SET sampul='$sampul', judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahunterbit='$tahunterbit' WHERE id=$id";

    mysqli_query($connect, $input);
    return mysqli_affected_rows($connect);
}
//Ini untuk cariBuku
function cariBuku($keyword)
{
    global $connect;
    $indexStart = 0;
    $booksPerPage = 4;
    $query = "SELECT * FROM koleksibuku WHERE judul LIKE '%$keyword%' OR pengarang LIKE '%$keyword%' OR penerbit LIKE '%$keyword%' OR tahunterbit LIKE '%$keyword%'";
    $cariBuku = mysqli_query($connect, $query);
    $hasilCari = mysqli_num_rows($cariBuku);
    if($hasilCari > 4){
        $query . "LIMIT $indexStart, $booksPerPage";
    }

    return tampilkanData($query);
}
;
//Ini untuk mendaftarkan diri
function daftar($data)
{
    global $connect;
    $namaLengkap = $data['name'];
    $username = $data['username'];
    $password1 = mysqli_real_escape_string($connect, $data['password1']);
    $password2 = mysqli_real_escape_string($connect, $data['password2']);

    //Cek, apakah username pernah ada;
    $checkUsername = mysqli_query($connect, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_num_rows($checkUsername) > 0) {
        // echo "<script>
        // alert('Username-nya udah dipake');
        // </script>";

        return false;
    }
    ;

    //Cek konfirmasi password
    if ($password1 !== $password2) {
        // echo "<script>alert('konfirmasi password salah');</script>";

        return false;
    }

    $password1 = password_hash($password1, PASSWORD_DEFAULT);
    $result = "INSERT INTO user VALUES('', '$username', '$password1', '$namaLengkap')";
    $_SESSION['login'];
    mysqli_query($connect, $result);
    return mysqli_affected_rows($connect);
}
;

// Ini login.php
function login($data)
{
    global $connect;
    $username = $data["username"];
    $password = $data["password"];


    $query = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($query) === 1) {
        $fetch = mysqli_fetch_assoc($query);
        if (password_verify($password, $fetch["password"])) {
            $_SESSION['login'] = true;
            if (isset($data['remember'])) {
                setcookie('x', $fetch['id'], time() + 3600);
                setcookie('kimi', hash('sha256', $fetch['username']), time() + 3600);
            }
            header("location: index.php");
            exit;
        } else {
            return "<p style='color: red; font-style: italic; text-align: center;'> password atau sandi salah </p>";
        }
        ;
    } else {
        return "<p style='color: red; font-style: italic; text-align: center;'> password atau sandi salah </p>";
    }
    ;

}
;

?>