<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

include('koneksi.php');

$query_kategori = "SELECT DISTINCT kategori FROM daftar";
$result_kategori = $koneksi->query($query_kategori);

$selected_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$selected_sort = isset($_GET['sort']) ? $_GET['sort'] : '';

$where_clause = $selected_kategori ? "WHERE kategori='$selected_kategori'" : '';
$order_clause = '';

if ($selected_sort == 'nama_asc') {
    $order_clause = "ORDER BY judul ASC";
} elseif ($selected_sort == 'nama_desc') {
    $order_clause = "ORDER BY judul DESC";
} elseif ($selected_sort == 'stok_desc') {
    $order_clause = "ORDER BY jumlah DESC";
} elseif ($selected_sort == 'stok_asc') {
    $order_clause = "ORDER BY jumlah ASC";
}

$q = "SELECT * FROM daftar $where_clause $order_clause";
$hasil = $koneksi->query($q);

$query_total = "SELECT COUNT(*) as total_buku, SUM(jumlah) as total_stok FROM daftar $where_clause";
$result_total = $koneksi->query($query_total);
$total_buku = $result_total->fetch_assoc();

$query_per_kategori = "SELECT kategori, COUNT(*) as jumlah_buku, SUM(jumlah) as stok_per_kategori FROM daftar $where_clause GROUP BY kategori";
$result_per_kategori = $koneksi->query($query_per_kategori);
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
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        h2, h3 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 3px rgba(0,0,0,0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: justify;
        }
        th {
            background-color: cadetblue;
            text-align: center;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
            margin: 5px;
        }
        .button:hover {background-color: #3e8e41}
        .button:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
        .button-red {
            background-color: #f44336;
        }
        .button-red:hover {background-color: #da190b}
        .button-red:active {
            background-color: #da190b;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
        .button-container {
            text-align: center;
            margin: 20px 0;
        }
        .isbn-column {
            width: 150px; 
            text-align: center;
        }
        .all-column {
            text-align: center;
        }
        .foto-column {
            width: 100px;
            text-align: center;
        }
        .foto {
            width: 150px;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus data ini?");
        }
    </script>
</head>
<body>
    <?php
    if (isset($_SESSION['welcome_message'])) {
        echo '<script>alert("Selamat datang, ' . $_SESSION['user'] . '!");</script>';
        unset($_SESSION['welcome_message']); 
    }
    ?>
    <div class="container">
        <h2>Daftar Buku</h2>
        <hr>

        <form method="GET" action="">
            <label for="kategori">Pilih Kategori:</label>
            <select name="kategori" id="kategori">
                <option value="">Semua Kategori</option>
                <?php
                while ($row = $result_kategori->fetch_assoc()) {
                    $selected = ($row['kategori'] == $selected_kategori) ? 'selected' : '';
                    echo "<option value='{$row['kategori']}' $selected>{$row['kategori']}</option>";
                }
                ?>
            </select>

            <label for="sort">Urutkan Berdasarkan:</label>
            <select name="sort" id="sort">
                <option value="">Pilih</option>
                <option value="nama_asc" <?php if ($selected_sort == 'nama_asc') echo 'selected'; ?>>Nama A-Z</option>
                <option value="nama_desc" <?php if ($selected_sort == 'nama_desc') echo 'selected'; ?>>Nama Z-A</option>
                <option value="stok_desc" <?php if ($selected_sort == 'stok_desc') echo 'selected'; ?>>Stok Terbanyak</option>
                <option value="stok_asc" <?php if ($selected_sort == 'stok_asc') echo 'selected'; ?>>Stok Terdikit</option>
            </select>

            <input type="submit" value="Filter">
        </form>
        <br>

        <table>
            <tr>
                <th class="isbn-column">ISBN</th>
                <th>Sampul</th>
                <th>Judul</th>
                <th>Sinopsis</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Jumlah Halaman</th>
                <th>Kategori</th>
                <th>Tersedia</th>
                <th>Dipinjam</th>
                <th>Jumlah</th>
                <th></th>
            </tr>

            <?php
            while ($row = $hasil->fetch_assoc()) {
                echo "
                <tr>
                <td class='isbn-column'>{$row['isbn']}</td>
                <td class='foto-column'><img src='foto/{$row['sampul']}' class='foto'></td>
                <td class='all-column'>{$row['judul']}</td>
                <td>{$row['sinopsis']}</td>
                <td class='all-column'>{$row['pengarang']}</td>
                <td class='all-column'>{$row['penerbit']}</td>
                <td class='all-column'>{$row['terbit']}</td>
                <td class='all-column'>{$row['halaman']}</td>
                <td class='all-column'>{$row['kategori']}</td>
                <td class='all-column'>{$row['tersedia']}</td>
                <td class='all-column'>{$row['dipinjam']}</td>
                <td class='all-column'>{$row['jumlah']}</td>
                <td>
                <form action='proses.php' method='POST' style='display:inline-block;' onsubmit='return confirmDelete()'>
                    <input type='hidden' name='isbn' value='{$row['isbn']}'>
                    <input type='hidden' name='proses' value='Hapus'>
                    <input type='submit' value='Hapus' class='button button-red'>
                </form>
                <form action='input.php' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='isbn' value='{$row['isbn']}'>
                    <input type='hidden' name='edit' value='1'>
                    <input type='submit' value='Edit' class='button'>
                </form>
                </td>
                </tr>";
            }
            ?>
        </table>

        <hr>
        <h3>Total Keseluruhan:</h3>
        <p>Total Buku: <?php echo $total_buku['total_buku']; ?></p>
        <p>Total Stok: <?php echo $total_buku['total_stok']; ?></p>
        <br>

        <h3>Detail Berdasarkan Kategori:</h3>
        <table>
            <tr>
                <th>Kategori</th>
                <th>Jumlah Buku</th>
                <th>Total Stok</th>
            </tr>
            <?php
            while ($row = $result_per_kategori->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['kategori'] . "</td>";
                echo "<td>" . $row['jumlah_buku'] . "</td>";
                echo "<td>" . $row['stok_per_kategori'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <div class="button-container">
            <a href="input.php" class="button">Input Data Baru</a>
            <a href="logout.php" class="button button-red">Logout</a>
        </div>
    </div>
</body>
</html>