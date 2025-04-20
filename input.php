<?php
include('koneksi.php');

$edit = isset($_GET['edit']) ? $_GET['edit'] : false;
$isbn = isset($_GET['isbn']) ? $_GET['isbn'] : '';

if ($edit) {
    $q = "SELECT * FROM daftar WHERE isbn='$isbn'";
    $hasil = $koneksi->query($q);
    $row = $hasil->fetch_assoc();

    $sampul = $row['sampul'];
    $judul = $row['judul'];
    $sinopsis = $row['sinopsis'];
    $pengarang = $row['pengarang'];
    $penerbit = $row['penerbit'];
    $terbit = $row['terbit'];
    $halaman = $row['halaman'];
    $kategori = $row['kategori'];
    $tersedia = $row['tersedia'];
    $dipinjam = $row['dipinjam'];
    $jumlah = $row['jumlah'];
} else {
    $isbn = "";
    $sampul = "";
    $judul = "";
    $sinopsis = "";
    $pengarang = "";
    $penerbit = "";
    $terbit = "";
    $halaman = "";
    $kategori = "";
    $tersedia = "";
    $dipinjam = "";
    $jumlah = "";
}

session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old = isset($_SESSION['old']) ? $_SESSION['old'] : [];
unset($_SESSION['errors']);
unset($_SESSION['old']);
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .form-container h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
        }
        .form-container label {
            margin-bottom: 5px;
            color: #333;
        }
        .form-container input[type="text"],
        .form-container input[type="file"],
        .form-container select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container .radio-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .form-container .radio-group label {
            margin-right: 10px;
        }
        .form-container input[type="radio"] {
            margin-right: 5px;
        }
        .form-container input[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <?php
        if ($edit) {
            echo "<h2>Edit Data</h2>";
        } else {
            echo "<h2>Input Data Baru</h2>";
        }
        ?>

        <?php if (count($errors) > 0): ?>
            <div class="error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="proses.php" method="POST" enctype="multipart/form-data">
            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn" value="<?php echo isset($old['isbn']) ? $old['isbn'] : $isbn; ?>">

            <label for="sampul">Sampul</label>
            <input type="file" id="sampul" name="sampul">

            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul" value="<?php echo isset($old['judul']) ? $old['judul'] : $judul; ?>">

            <label for="sinopsis">Sinopsis</label>
            <input type="text" id="sinopsis" name="sinopsis" value="<?php echo isset($old['sinopsis']) ? $old['sinopsis'] : $sinopsis; ?>">

            <label for="pengarang">Pengarang</label>
            <input type="text" id="pengarang" name="pengarang" value="<?php echo isset($old['pengarang']) ? $old['pengarang'] : $pengarang; ?>">

            <label for="penerbit">Penerbit</label>
            <input type="text" id="penerbit" name="penerbit" value="<?php echo isset($old['penerbit']) ? $old['penerbit'] : $penerbit; ?>">

            <label for="terbit">Tahun Terbit</label>
            <select id="terbit" name="terbit">
                <?php
                $current_year = date("Y");
                for ($year = $current_year; $year >= 1900; $year--) {
                    $selected = ($year == (isset($old['terbit']) ? $old['terbit'] : $terbit)) ? 'selected' : '';
                    echo "<option value='$year' $selected>$year</option>";
                }
                ?>
            </select>

            <label for="halaman">Jumlah Halaman</label>
            <input type="text" id="halaman" name="halaman" value="<?php echo isset($old['halaman']) ? $old['halaman'] : $halaman; ?>">

            <div class="radio-group">
                <label>Kategori</label>
                <label for="fiksi">
                    <input type="radio" id="fiksi" name="kategori" value="Fiksi" <?php if ((isset($old['kategori']) && $old['kategori'] == 'Fiksi') || $kategori == 'Fiksi') echo 'checked'; ?>> Fiksi
                </label>
                <label for="nonfiksi">
                    <input type="radio" id="nonfiksi" name="kategori" value="Nonfiksi" <?php if ((isset($old['kategori']) && $old['kategori'] == 'Nonfiksi') || $kategori == 'Nonfiksi') echo 'checked'; ?>> Nonfiksi
                </label>
            </div>

            <label for="tersedia">Tersedia</label>
            <input type="text" id="tersedia" name="tersedia" value="<?php echo isset($old['tersedia']) ? $old['tersedia'] : $tersedia; ?>">

            <label for="dipinjam">Dipinjam</label>
            <input type="text" id="dipinjam" name="dipinjam" value="<?php echo isset($old['dipinjam']) ? $old['dipinjam'] : $dipinjam; ?>">

            <label for="jumlah">Jumlah</label>
            <input type="text" id="jumlah" name="jumlah" value="<?php echo isset($old['jumlah']) ? $old['jumlah'] : $jumlah; ?>">

            <input type="submit" name="proses" value="<?php echo $edit ? 'Perbaharui' : 'Simpan'; ?>">
        </form>
    </div>
</body>
</html>