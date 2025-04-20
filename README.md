# 📚 Aplikasi CRUD Perpustakaan

Aplikasi ini adalah sistem manajemen perpustakaan berbasis web yang dibangun menggunakan PHP dan MySQL. Tujuannya adalah memudahkan pengelolaan data buku secara digital dengan fitur CRUD (Create, Read, Update, Delete) lengkap.

## 🚀 Fitur Utama

- **Input Buku**: Tambahkan data buku lengkap (ISBN, judul, sinopsis, pengarang, penerbit, tahun terbit, halaman, kategori, stok, gambar sampul).
- **Edit Buku**: Perbarui informasi buku yang sudah ada melalui form pre-filled.
- **Hapus Buku**: Hapus data buku dan file gambar terkait secara permanen, dengan konfirmasi terlebih dahulu.
- **Statistik Jumlah Buku**: Menampilkan total koleksi, jumlah stok, dan statistik per kategori (Fiksi/Nonfiksi).
- **Filtering & Sorting**: Cari dan urutkan buku berdasarkan kategori, nama, atau jumlah stok.
- **Validasi Input**: Cek kelengkapan dan tipe data sebelum data disimpan. Pesan error ditampilkan untuk field yang tidak valid.
- **Upload & Tampilkan Foto**: Unggah dan tampilkan sampul buku dalam daftar.
- **Login & Session**: Sistem login dengan validasi session. Akses halaman dibatasi untuk pengguna terautentikasi.
- **Remember Me (Cookies)**: Login otomatis selama 10 menit jika pengguna mencentang "Remember Me".
- **Error Handling**: Jika terjadi error, data input disimpan sementara untuk memudahkan perbaikan.

## 🛠️ Teknologi yang Digunakan

- **Frontend**: HTML, CSS (basic)
- **Backend**: PHP native
- **Database**: MySQL
- **Web Server**: Apache (XAMPP/Laragon)

## 🗃️ Struktur Database

### Tabel `user`
| Field     | Tipe     | Keterangan     |
|-----------|----------|----------------|
| id        | INT      | Primary key    |
| username  | VARCHAR  | Username login |
| password  | VARCHAR  | Password login |

### Tabel `daftar`
| Field          | Tipe     | Keterangan                  |
|----------------|----------|-----------------------------|
| isbn           | VARCHAR  | Primary key                 |
| judul          | VARCHAR  | Judul buku                  |
| sinopsis       | TEXT     | Ringkasan buku              |
| pengarang      | VARCHAR  | Nama pengarang              |
| penerbit       | VARCHAR  | Nama penerbit               |
| tahun_terbit   | INT      | Tahun terbit                |
| jumlah_halaman | INT      | Jumlah halaman              |
| kategori       | ENUM     | Fiksi / Nonfiksi            |
| jumlah         | INT      | Jumlah total                |
| tersedia       | INT      | Jumlah tersedia             |
| dipinjam       | INT      | Jumlah sedang dipinjam      |
| sampul         | VARCHAR  | Nama file gambar sampul     |

## 🔐 Akun Login Default

| Username | Password |
|----------|----------|
| admin    | 12345    |
| user1    | 44456    |
| user2    | 25678    |

## 📄 Lisensi

Aplikasi ini menggunakan [MIT License](https://choosealicense.com/licenses/mit/), yang berarti kamu bebas menggunakan, memodifikasi, dan mendistribusikan ulang kode ini selama mencantumkan lisensi dan hak cipta asli.

---

