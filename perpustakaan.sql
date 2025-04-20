# Host: localhost  (Version 5.5.5-10.4.32-MariaDB)
# Date: 2024-11-25 16:08:07
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "daftar"
#

DROP TABLE IF EXISTS `daftar`;
CREATE TABLE `daftar` (
  `isbn` double NOT NULL,
  `sampul` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `sinopsis` longtext DEFAULT NULL,
  `pengarang` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `terbit` varchar(255) DEFAULT NULL,
  `halaman` double DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `tersedia` double DEFAULT NULL,
  `dipinjam` double DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  PRIMARY KEY (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "daftar"
#

INSERT INTO `daftar` VALUES (9746237046868,'inspirasi&motivasi B.J. Habibie.jpg','Inspirasi&Motivasi B.J. Habibie','Buku ini menapak tilas perjalanan hidup B.J. Habibie, mulai dari masa kecilnya hingga menjelang akhir hayatnya. Dari kisah sang insinyur ini, kita bisa mengambil banyak pesan dan hikmah yang sangat bermanfaat bagi hidup kita.','Punto Ali Fahmi','Cheklist','2024',200,'Nonfiksi',1,9,10),(9766020382180,'Imperfect.jpg','Imperfect','Buku ini bukanlah buku motivasi, melainkan kumpulan cerita seorang perempuan, istri, sekaligus ibu yang sedang berjuang agar bisa mengatakan kepada diri sendiri: Aku tidak sempurna, tapi tidak apa-apa. Karena aku bahagia.','Meira Anastasia','Gramedia Pustaka Utama','2024',172,'Fiksi',5,20,25),(9786020565678,'Pangeran Cilik Le Petit Prince.jpg','Pangeran Cilik: Le Petit Prince','Buku dimulai dengan cerita ketika tokoh cerita ini masih kecil. Suatu kali ia menggambar ular boa yang memakan seekor gajah. Namun, saat ia menunjukkan gambar itu ke orang dewasa, mereka menyuruhnya untuk berhenti menggambar dan mulai belajar hal-hal lain, seperti geometri, aritmetika, geografi, tata bahasa, dan lain-lain. Akhirnya sang tokoh ini berhenti menggambar dan tumbuh besar menjadi seorang pilot. Sebagai pilot, ia terus membawa gambarnya yang pertama, dan kadang membahas gambar itu bersama teman-temannya. Namun tidak ada satu orang dewasa pun yang memahami gambar buatannya.','Antoine de Saint-Exupéry','Gramedia Pustaka Utama','2024',120,'Fiksi',1,19,20),(9796024125189,'filosofi teras.jpg','Filosofi Teras','Filosofi Teras adalah sebuah buku pengantar filsafat Stoa yang dibuat khusus sebagai panduan moral anak muda. Buku ini ditulis untuk menjawab permasalahan tentang tingkat kekhawatiran yang cukup tinggi dalam skala nasional, terutama yang dialami oleh anak muda.','Henry Manampiring','Kompas','2024',320,'Nonfiksi',2,13,15);

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` double NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `pass` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'admin',12345),(2,'user1',44456),(3,'user2',25678);
