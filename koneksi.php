<?php
$dbhost='localhost';
$dbuser='root';
$dbpass='abcde';
$db='perpustakaan';

$koneksi =  new mysqli($dbhost,$dbuser,$dbpass,$db);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

?>
