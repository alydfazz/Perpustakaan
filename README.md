# 📚 Aplikasi CRUD Perpustakaan

Aplikasi ini adalah sistem manajemen perpustakaan berbasis web yang dibangun menggunakan PHP dan MySQL. Tujuannya adalah memudahkan pengelolaan data buku secara digital dengan fitur CRUD (Create, Read, Update, Delete) lengkap.

---

## 🚀 Fitur Lengkap

### 1. **Input Data Buku**
Pengguna dapat menambahkan buku baru melalui form di `input.php` yang memuat:
- ISBN
- Judul
- Sinopsis
- Pengarang
- Penerbit
- Tahun terbit (dropdown dari 1900 - sekarang)
- Jumlah halaman
- Kategori (radio button: Fiksi / Nonfiksi)
- Jumlah tersedia
- Jumlah dipinjam
- Total buku
- Upload gambar sampul (file input)

### 2. **Edit Data Buku**
Tiap buku dalam daftar memiliki tombol **Edit** yang mengarah ke halaman `edit.php`. Data akan ditampilkan dalam form yang otomatis terisi. Setelah diperbarui, sistem menyimpan perubahan ke database.

### 3. **Hapus Data Buku**
Tiap entri buku memiliki tombol **Hapus**. Sistem akan menampilkan konfirmasi sebelum menghapus data buku beserta file gambar yang terkait dari folder `foto/`.

### 4. **Statistik Buku**
Di bagian bawah halaman utama (`index.php`), aplikasi menampilkan:
- Jumlah total buku
- Jumlah stok buku tersedia
- Statistik per kategori (jumlah buku Fiksi dan Nonfiksi + stoknya)
Data ini diperbarui otomatis mengikuti filter yang sedang diterapkan.

### 5. **Filtering Kategori Buku**
Tersedia dropdown untuk memilih kategori:
- Fiksi
- Nonfiksi
- Semua Kategori  
Filter akan mempengaruhi daftar buku dan statistik yang ditampilkan.

### 6. **Sorting Data Buku**
Dropdown sorting menyediakan pilihan urutan:
- Judul A-Z / Z-A
- Stok terbanyak / tersedikit  
Fitur ini dapat dikombinasikan dengan filter untuk pencarian yang lebih akurat.

### 7. **Jenis Inputan**
Sistem memverifikasi bahwa semua field wajib diisi. Validasi dilakukan untuk:
- Field kosong
- Format angka pada ISBN, jumlah halaman, stok, dll.  
Jika ada error, pesan ditampilkan spesifik untuk tiap field dan data lama ditampilkan ulang agar pengguna tidak perlu mengisi ulang semuanya.

### 8. **Cek Kelengkapan Input**
Sistem memastikan semua field wajib diisi dan valid sebelum data disimpan. Error ditampilkan jika ada field yang kosong atau format salah, dan input yang sudah diisi sebelumnya tetap ditampilkan.

### 9. **Error Handling**
- Jika input gagal (field kosong atau format salah), sistem:
- Menyimpan input sebelumnya (old input) ke dalam session.
- Menampilkan pesan error spesifik untuk tiap field.
- Melakukan redirect ke halaman yang sesuai (input.php atau edit.php) dengan parameter yang menjaga konteks.
Semua error ditampilkan secara jelas di atas form agar pengguna bisa segera memperbaikinya tanpa mengisi ulang data.

### 10. **Tampilkan Gambar Sampul**
Gambar yang diupload akan disimpan di folder `foto/` dan ditampilkan di tabel buku pada halaman utama. Ukuran gambar disesuaikan secara proporsional agar tidak merusak layout.

### 11. **Upload Gambar Sampul**
Form input dan edit dilengkapi dengan upload gambar. Jika proses upload berhasil, nama file disimpan di database. Sistem memberi notifikasi jika upload gagal.

### 12. **Login Salah**
- Login divalidasi melalui tabel `user`.
- Jika gagal, sistem menampilkan pesan "Login Anda salah!" menggunakan session.
- Pesan otomatis dihapus setelah ditampilkan agar tidak muncul kembali saat refresh.

### 13. **Cookies (Remember Me)**
Jika opsi **Remember Me** dipilih saat login, sistem menyimpan username dan password dalam cookie selama 10 menit untuk kemudahan akses.

### 14. **Session Management**
- Session login digunakan untuk mengakses halaman utama.
- Jika user tidak login, akan diarahkan ke `login.php`.
- Session juga digunakan untuk pesan selamat datang, validasi input, dan error feedback.
- Semua session akan dihapus saat pengguna logout.

---

## 🗃️ Struktur Database

Database `perpustakaan` terdiri dari dua tabel utama:

- `user` (id, username, password)  
- `daftar` (isbn, sampul, judul, sinopsis, pengarang, penerbit, tahun, halaman, kategori, tersedia, dipinjam, total)

---

## 🔐 Akun Login Default

| Username | Password |
|----------|----------|
| admin    | 12345    |
| user1    | 44456    |
| user2    | 25678    |

> Semua akun memiliki hak akses yang sama.

---

## ▶️ Cara Menjalankan Aplikasi

1. Clone repository ini atau unduh source code.
2. Import file `perpustakaan.sql` ke database MySQL.
3. Ubah konfigurasi koneksi database di `koneksi.php`.
4. Jalankan aplikasi di server lokal (XAMPP/Laragon/dll).
5. Akses melalui browser ke:  
   `http://localhost/nama_folder/`

---

## 📄 Lisensi

Aplikasi ini menggunakan [MIT License](https://choosealicense.com/licenses/mit/), yang berarti kamu bebas menggunakan, memodifikasi, dan mendistribusikan ulang kode ini selama mencantumkan lisensi dan hak cipta asli.

---

