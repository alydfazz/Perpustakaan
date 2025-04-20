<?php
session_start();
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $q = "SELECT * FROM user WHERE user='$user' AND pass='$pass'";
    $hasil = $koneksi->query($q);

    if ($hasil->num_rows > 0) {
        $row = $hasil->fetch_assoc();

        $_SESSION['user'] = $row['user'];
        $_SESSION['pass'] = $row['pass'];
        $_SESSION['welcome_message'] = true;

        if (isset($_POST['remember'])) {
            setcookie('user', $row['user'], time() + 600);
            setcookie('pass', $row['pass'], time() + 600);
        }

        header("Location: utama.php");
        exit();
    } else {
        $_SESSION['error'] = "Login Anda salah!";
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>