-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2025 at 03:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `obatnih`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `created_at`) VALUES
(5, 'admin', 'admin@gmail.com', '$2y$10$6w1yMD/Wf/ZsNmNJ5yVbcOufeVT0OywQujaYyd1NGEAQetPhmGfZi', '2025-05-24 19:34:51'),
(8, 'Faiz Rizqullah', 'marunaradelta@gmail.com', '$2y$10$E9ve1EbrfUb9xdi5VIaZo.gVnkbEKntqSFiPfoPVsz7RrIjU.X2dO', '2025-06-11 03:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `apoteker`
--

CREATE TABLE `apoteker` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apoteker`
--

INSERT INTO `apoteker` (`id`, `nama`, `email`, `password`, `created_at`) VALUES
(3, 'apoteker', 'apoteker@gmail.com', '$2y$10$QJ8dnSebbxWlK41bB46TRugoNHtx/wnydGxHL/uIrRmXei7yPEhsi', '2025-05-24 19:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender_role` enum('user','apoteker') NOT NULL,
  `sender_id` int(11) NOT NULL,
  `thread_id` varchar(50) DEFAULT NULL,
  `recipient_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender_role`, `sender_id`, `thread_id`, `recipient_id`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'user', 51, 'user_51', NULL, 'hai', '2025-06-17 21:19:19', '2025-06-17 21:19:19', NULL),
(13, 'user', 51, 'user_51', NULL, 'tes', '2025-06-17 21:23:30', '2025-06-17 21:23:30', NULL),
(14, 'apoteker', 3, 'user_51', 51, 'oi', '2025-06-17 21:41:38', '2025-06-17 21:41:38', NULL),
(15, 'apoteker', 3, 'user_51', 51, 'gimanaa', '2025-06-17 21:41:44', '2025-06-17 21:41:44', NULL),
(16, 'user', 51, 'user_51', NULL, 'apa kabar dik', '2025-06-17 21:42:05', '2025-06-17 21:42:05', NULL),
(17, 'user', 50, 'user_50', NULL, 'hi bantu aku', '2025-06-17 21:43:24', '2025-06-17 21:43:24', NULL),
(18, 'apoteker', 3, 'user_50', 50, 'bantu apa kocak', '2025-06-17 21:43:37', '2025-06-17 21:43:37', NULL),
(19, 'user', 50, 'user_50', NULL, 'apa aja bowleh', '2025-06-17 21:43:45', '2025-06-17 21:43:45', NULL),
(20, 'user', 50, 'user_50', NULL, 'hei', '2025-06-18 02:31:46', '2025-06-18 02:31:46', NULL),
(21, 'apoteker', 3, 'user_50', 50, 'halo', '2025-06-18 02:31:56', '2025-06-18 02:31:56', NULL),
(22, 'user', 52, 'user_52', NULL, 'hii', '2025-06-18 02:43:48', '2025-06-18 02:43:48', NULL),
(23, 'apoteker', 3, 'user_52', 52, 'halo', '2025-06-18 02:43:56', '2025-06-18 02:43:56', NULL),
(24, 'user', 50, 'user_50', NULL, 'heii kamu', '2025-06-18 03:40:34', '2025-06-18 03:40:34', NULL),
(25, 'user', 53, 'user_53', NULL, 'hai aku kibo', '2025-06-18 03:43:32', '2025-06-18 03:43:32', NULL),
(26, 'apoteker', 3, 'user_53', 53, 'halo kibo', '2025-06-18 03:43:42', '2025-06-18 03:43:42', NULL),
(27, 'user', 54, 'user_54', NULL, 'hii aku azriel', '2025-06-18 04:39:30', '2025-06-18 04:39:30', NULL),
(28, 'apoteker', 3, 'user_54', 54, 'iyh knp', '2025-06-18 04:39:48', '2025-06-18 04:39:48', NULL),
(29, 'user', 55, 'user_55', NULL, 'hi aku mau pesen tm', '2025-06-18 04:41:00', '2025-06-18 04:41:00', NULL),
(30, 'apoteker', 3, 'user_55', 55, 'boleh', '2025-06-18 04:41:07', '2025-06-18 04:41:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_obat` int(10) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `harga_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-05-19-092358', 'App\\Database\\Migrations\\Obat', 'default', 'App', 1748072382, 1),
(2, '2025-06-17-211222', 'App\\Database\\Migrations\\AddThreadSupportToChat', 'default', 'App', 1750194777, 2);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(5) UNSIGNED NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `dosis` varchar(100) NOT NULL,
  `kemasan` varchar(100) NOT NULL,
  `komposisi` varchar(100) NOT NULL,
  `golongan_obat` varchar(100) NOT NULL,
  `kontra_indikasi` varchar(100) NOT NULL,
  `harga_satuan` int(100) NOT NULL,
  `stok` varchar(100) NOT NULL,
  `cara_pakai` varchar(100) NOT NULL,
  `efek_samping` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `gambar_obat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `dosis`, `kemasan`, `komposisi`, `golongan_obat`, `kontra_indikasi`, `harga_satuan`, `stok`, `cara_pakai`, `efek_samping`, `deskripsi`, `gambar_obat`) VALUES
(6, 'Poldanmig', 'Dewasa dan anak >12 tahun : 1-2 kaplet tiap 6 jam', 'Kaplet', 'Tiap kaplet mengandung Parasetamol 400 mg, asetosal 250 mg, kafein 65 mg', 'Bebas', 'Gangguan fungsi hati dan ginjal, asma, trombositopenia, tukak lambung, haemofilia, pasien dengan pen', 1500, '200', 'Diberikan sesuai dengan petunjuk dosis penggunaan, leaflet/brosur, dokter atau apoteker', 'Gangguan hati, iritasi lambung, mual, muntah.', 'Poldanmig mengandung kombinasi beberapa obat yang bisa digunakan untuk meringankan sakit kepala akib', 'poldanmig.jpg'),
(8, 'Vermox', '1 tablet sebagai dosis tunggal', 'Tablet', 'Tiap tablet mengandung mebendazole 500 mg', 'Obat Bebas Terbatas', 'Pasien yang memiliki riwayat alergi/hipersensitifitas terhadap kandungan obat didalamnya', 5000, '502', 'Diberikan sesuai dengan petunjuk dosis penggunaan, leaflet/brosur, dokter atau apoteker', 'Pusing, sakit kepala, mual, muntah, nyeri di bagian perut, diare, rasa kantuk, gatal, demam, angioed', 'Merupakan obat cacing yang efektif mengobati penyakit cacing akibat cacing gelang atau cacing tamban', 'vermox.jpg'),
(9, 'Voltadex', 'Dioleskan 3-4 kali sehari pada bagian-bagian yang sakit sambil digosok secara perlahan-lahan', 'Tube 20 gram gel', 'Tiap gram emulgel mengandung Diclofenac sodium 1%', 'Obat Bebas Terbatas', 'Hipersensitif terhadap kandungan obat, luka terbuka', 9000, '198', 'Diberikan sesuai dengan petunjuk dosis penggunaan, leaflet/brosur, dokter atau apoteker', 'Dermatitis kontak alergik atau non alergik. Ruam kulit, reaksi hipersensitivitas & fotosensitivitas.', 'Voltadex gel digunakan untuk Inflamasi karena trauma pada tendon, ligamen, otot dan persendian seper', 'voltadex.jpg'),
(11, 'Bintang Toedjoe', 'Anak-anak: 3-4 x sehari 1/2 - 1 sachet. Dewasa: 3-4 x sehari 1 sachet. Diminum 2 jam setelah makan.', 'Sachet', 'Tiap bungkus mengandung Hydrotalcite 200 mg, Magnesium Hidroxida 150 mg dan simetikon 50 mg', 'Obat Bebas', 'Hindari pemberian pada pasien yang memiliki Hipersensitif (reaksi berlebihan atau sangat sensitif) t', 2500, '540', 'Diberikan sesuai dengan petunjuk dosis penggunaan, leaflet/brosur, dokter atau apoteker', 'Waisan tidak dianjurkan untuk diberikan pada penderita gangguan ginjal. Obat ini mengandung magnesiu', 'Waisan merupakan obat yang dapat digunakan untuk meredakan gejala yang berhubungan dengan peningkata', 'waisan.jpg'),
(20, 'Provelyn 150MG', '1) Kejang: dosis awal 150 mg/hari, dapat ditingkatkan hingga 300 mg/hari setelah 1 minggu. Dosis mak', '1 Kapsul', 'Tiap kapsul mengandung pregabalin 150 mg', 'Obat Keras', 'Pasien hipersensitif terhadap pregabalin.', 50000, '365', 'Dapat diberikan sebelum atau sesudah makan', 'Cedera tidak disengaja, kembung atau bengkak pada wajah, lengan, tangan, kaki bagian bawah, atau kak', 'Untuk pengobatan nyeri neuropatik, epilepsi, gangguan ansietas generalisata pada orang dewasa, dan m', 'provelyn.jpg'),
(21, 'Prorenal Tablet', 'Pada pasien dewasa dengan insufisiensi ginjal kronik dengan berat >70 kg Â 4-8 tablet 3 kali sehari.', '1 tablet', 'Tiap tablet mengandung DL-3-metil-2-oxo-valeric acid 67 mg, 4-metil-2-oxo-valeric acid 101 mg, 2-oxo', 'Obat Keras', 'Tidak boleh diberikan kepada pasien dengan riwayat hipersensitif terhadap salah satu atau beberapa k', 4500, '498', 'Obat diberikan sesuai dengan petunjuk dari dokter/apoteker', 'Dapat menyebabkan hiperkalsemia.', 'Prorenal merupakan obat yang digunakan Untuk terapi insufisiensi ginjal kronik dalam hubungan dengan', 'prorenal.jpg'),
(22, 'Propepsa Suspensi', '1) peptic ulcer (luka peptik), gastrik kronis : 1 g 4 kali sehari selama 4-8 minggu hingga 12 minggu', 'Botol 100 mL suspensi', 'Tiap 5 mL suspensi mengandung sucralfate 500 mg', 'Obat Keras', 'Pasien yang hipersensitif terhadap komponen obat ini', 6000, '583', 'Sebaiknya diberikan pada saat perut kosong. Berikan pada saat perut kosong 1 jam sebelum atau 2 jam ', 'Konstipasi, mulut kering, diare, mual, muntah, rasa tidak nyaman pada abdomen/perut, kembung, prurit', 'Untuk terapi ulkus peptikum dan gastritis kronik, namun tidak bisa mencegah luka tersebut datang kem', 'propepsa.jpg'),
(23, 'Fenris sirup', '1) Mengobati rheumatoid arthritis (rematik); Osteoarthritis (peradangan pada tulang): 400-800 mg 3-4', 'Dus, 1 botol@ 60 mL', 'Tiap 5 mL suspensi mengandung ibuprofen 100 mg', 'Obat Bebas Terbatas', '-', 7000, '267', 'Dapat diberikan bersama atau tanpa makanan', 'Rasa nyeri pada perut, diare, konstipasi dan feses berwarna gelap.', 'Digunakan sebagai suplemen nutrisi untuk hamil dan menyusui, terutama untuk mencegah defisiensi zat ', 'fenris.jpg'),
(28, 'Paramex', 'lorem', 'ipsum', 'dolor', 'sit', 'amet', 5000, '234', 'Diberikan sesuai dengan petunjuk dosis penggunaan, leaflet/brosur, dokter atau apoteker', 'Gangguan hati, iritasi lambung, mual, muntah.', 'Untuk terapi ulkus peptikum dan gastritis kronik, namun tidak bisa mencegah luka tersebut datang kem', '1749614191_fce7dece79ffcd566219.png');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id` int(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `detail_alamat` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `kode_pos` int(15) NOT NULL,
  `no_hp` int(15) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id`, `id_user`, `nama`, `alamat`, `detail_alamat`, `provinsi`, `kota`, `kode_pos`, `no_hp`, `tanggal`) VALUES
(1, 47, 'Faiz Rizqullah Update', 'Bandung Jawabarat', 'sjdshshdu', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(2, 47, 'Faiz Rizqullah Update', 'Bandung Jawabarat', 'Tes lagiiii', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(3, 47, 'Faiz Rizqullah Update', 'Bandung Jawabarat', 'kesini', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(4, 47, 'Faiz Rizqullah Update', 'Bandung Jawabarat', 'sipisip', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(5, 47, 'Faiz Rizqullah Update', 'Bandung Jawabarat', 'poki', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(6, 47, 'Faiz Rizqullah Update', 'Bandung Jawabarat', 'vvv', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(7, 47, 'Faiz Rizqullah Update', 'Bandung Jawabarat', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(8, 47, 'Faiz Rizqullah Update', 'Bandung Jawabarat', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(9, 50, 'Faiz Rizqullah', '', 'kdnkfnkdnfkd', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(10, 50, 'Faiz Rizqullah', '', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(11, 50, 'Faiz Rizqullah', '', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(12, 50, 'Faiz Rizqullah', '', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(13, 50, 'Faiz Rizqullah', '', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(14, 50, 'Faiz Rizqullah', '', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(15, 50, 'Faiz Rizqullah', '', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(16, 50, 'Faiz Rizqullah', '', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(17, 50, 'Faiz Rizqullah', '', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(18, 50, 'Faiz Rizqullah Nich', 'Bandung Jawabarat', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(19, 50, 'Faiz Rizqullah testis', 'Bandung Jawabarat', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-17'),
(20, 50, 'Faiz Rizqullah ahayy', 'Bandung Jawabarat', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-18'),
(21, 52, 'alif', '', '', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-18'),
(22, 53, 'azriel', '', 'cibeber weh', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-18'),
(23, 54, 'Faiz Rizqullah', '', 'cibeber', 'Jawa Barat', 'Bandung', 40111, 2147483647, '2025-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_harga` decimal(10,0) NOT NULL,
  `status` enum('pending','selesai','dibatalkan','') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_user`, `tanggal_transaksi`, `total_harga`, `status`) VALUES
(9, 50, '2025-06-17', 2500, 'selesai'),
(10, 50, '2025-06-17', 5000, 'dibatalkan'),
(11, 50, '2025-06-17', 5000, 'selesai'),
(12, 50, '2025-06-17', 18000, 'selesai'),
(13, 50, '2025-06-17', 3000, 'selesai'),
(14, 50, '2025-06-17', 1500, 'selesai'),
(15, 50, '2025-06-18', 9000, 'dibatalkan'),
(16, 52, '2025-06-18', 725000, 'selesai'),
(17, 53, '2025-06-18', 150000, 'selesai'),
(18, 54, '2025-06-18', 990000, 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expire` datetime DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tanggal_lahir` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `reset_token`, `reset_token_expire`, `no_hp`, `alamat`, `tanggal_lahir`, `created_at`) VALUES
(50, 'Faiz Rizqullah ahayy', 'user@gmail.com', '$2y$10$9RaWgcNANuJN89zfT3RhSOQg89Xa3smjMbKcaQpcbTzZShwWCKDoC', 'd632254a88dc30bf73cf66a89e91b9fee68bfc52c425e75ac29d40775483777e', '2025-06-18 04:37:12', '08678901234', 'Bandung Jawabarat', '1313-12-13 00:00:00', '2025-06-17 21:53:24'),
(51, 'Dandi kocak', 'dandi@gmail.com', '$2y$10$QhWSzaQHxS8EwiTOqdlPMu8G1LHoGnLkwe9alJ.Nkini1bSzRWti.', NULL, NULL, '08881669524', NULL, '1414-12-14 00:00:00', '2025-06-18 03:52:56'),
(52, 'alif', 'alif@gmail.com', '$2y$10$HFEdX/.O4Mn14CBZBrs.Qu9nE/MSXwBuKlOPRbprxPac4ZtVZov.e', NULL, NULL, '08881669524', NULL, '1414-12-14 00:00:00', '2025-06-18 09:42:06'),
(53, 'azriel', 'azriel@gmail.com', '$2y$10$fuBrS0s2Jwf48qKeh38xbOWb5Klf25KIBhOi3Io.0nci6DMxfc8o.', NULL, NULL, '08881669524', 'Cibeber', '1212-12-12 00:00:00', '2025-06-18 10:43:09'),
(54, 'Faiz Rizqullah', 'coba@gmail.com', '$2y$10$xYcHy3MYBT5P84qODtMQruF35Lfe8i/ZzGVl4.CrgImliOmzw8/MO', NULL, NULL, '08881669524', 'Bandung Jawabarat', '1212-12-12 00:00:00', '2025-06-18 11:33:41'),
(55, 'ahnaf', 'ahnaf@gmail.com', '$2y$10$qGd78OktM6bWxLZ5wGKwDOKGTcAoupY0YRUTo6HD6Rm96VIJWLVjO', NULL, NULL, '08881669524', NULL, '0000-00-00 00:00:00', '2025-06-18 11:40:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `apoteker`
--
ALTER TABLE `apoteker`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_thread_id` (`thread_id`),
  ADD KEY `idx_sender` (`sender_id`,`sender_role`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keranjang_id_obat_foreign` (`id_obat`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_2` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `apoteker`
--
ALTER TABLE `apoteker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_id_obat_foreign` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
