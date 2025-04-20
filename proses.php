<?php
include('koneksi.php');

$proses = $_POST['proses'];
$isbn = $_POST['isbn'];

if ($proses == 'Hapus') {

    $q = "SELECT sampul FROM daftar WHERE isbn='$isbn'";
    $result = $koneksi->query($q);
    $row = $result->fetch_assoc();
    $sampul = $row['sampul'];

    if (file_exists("foto/$sampul")) {
        unlink("foto/$sampul");
    }

    $q = "DELETE FROM daftar WHERE isbn='$isbn'";
    $koneksi->query($q);
    header("Location: utama.php");
    exit();
}

$errors = [];

if (empty($isbn)) {
    $errors['isbn'] = "ISBN harus diisi.";
}
if (empty($_POST['judul'])) {
    $errors['judul'] = "Judul harus diisi.";
}
if (empty($_POST['sinopsis'])) {
    $errors['sinopsis'] = "Sinopsis harus diisi.";
}
if (empty($_POST['pengarang'])) {
    $errors['pengarang'] = "Pengarang harus diisi.";
}
if (empty($_POST['penerbit'])) {
    $errors['penerbit'] = "Penerbit harus diisi.";
}
if (empty($_POST['terbit'])) {
    $errors['terbit'] = "Tahun terbit harus diisi.";
}
if (empty($_POST['halaman'])) {
    $errors['halaman'] = "Jumlah halaman harus diisi.";
}
if (empty($_POST['kategori'])) {
    $errors['kategori'] = "Kategori harus dipilih.";
}
if (empty($_POST['tersedia'])) {
    $errors['tersedia'] = "Jumlah tersedia harus diisi.";
}
if (empty($_POST['dipinjam'])) {
    $errors['dipinjam'] = "Jumlah dipinjam harus diisi.";
}
if (empty($_POST['jumlah'])) {
    $errors['jumlah'] = "Jumlah harus diisi.";
}

if (!empty($isbn) && !is_numeric($isbn)) {
    $errors['isbn'] = "ISBN harus berupa angka.";
}
if (!empty($_POST['halaman']) && !is_numeric($_POST['halaman'])) {
    $errors['halaman'] = "Jumlah halaman harus berupa angka.";
}
if (!empty($_POST['tersedia']) && !is_numeric($_POST['tersedia'])) {
    $errors['tersedia'] = "Tersedia harus berupa angka.";
}
if (!empty($_POST['dipinjam']) && !is_numeric($_POST['dipinjam'])) {
    $errors['dipinjam'] = "Dipinjam harus berupa angka.";
}
if (!empty($_POST['jumlah']) && !is_numeric($_POST['jumlah'])) {
    $errors['jumlah'] = "Jumlah harus berupa angka.";
}

if (!empty($errors)) {
    session_start();
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST; 
    header("Location: input.php?isbn=$isbn&edit=" . ($proses == 'Perbaharui' ? '1' : '0'));
    exit();
}

if ($proses == 'Simpan' || $proses == 'Perbaharui') {
    $sampul = $_FILES['sampul']['name'];
    $target_dir = 'foto/';
    $target_file = $target_dir . basename($_FILES["sampul"]["name"]);

    if (move_uploaded_file($_FILES["sampul"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["sampul"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $judul = $_POST['judul'];
    $sinopsis = $_POST['sinopsis'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $terbit = $_POST['terbit'];
    $halaman = $_POST['halaman'];
    $kategori = $_POST['kategori'];
    $tersedia = $_POST['tersedia'];
    $dipinjam = $_POST['dipinjam'];
    $jumlah = $_POST['jumlah'];

    if ($proses == 'Simpan') {
        $q = "INSERT INTO daftar (isbn, sampul, judul, sinopsis, pengarang, penerbit, terbit, halaman, kategori, tersedia, dipinjam, jumlah) 
              VALUES ('$isbn', '$sampul', '$judul', '$sinopsis', '$pengarang', '$penerbit', '$terbit', '$halaman', '$kategori', '$tersedia', '$dipinjam', '$jumlah')";
    } else {
        $q = "UPDATE daftar 
              SET sampul='$sampul', judul='$judul', sinopsis='$sinopsis', pengarang='$pengarang', penerbit='$penerbit', terbit='$terbit', halaman='$halaman', kategori='$kategori', tersedia='$tersedia', dipinjam='$dipinjam', jumlah='$jumlah' 
              WHERE isbn='$isbn'";
    }

    $koneksi->query($q);
    header("Location: utama.php");
    exit();
}
?>