-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table dummy.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `deskripsi` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gambar` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `stok` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table dummy.barang: ~0 rows (approximately)
DELETE FROM `barang`;

-- Dumping structure for table dummy.barang_transaksi
CREATE TABLE IF NOT EXISTS `barang_transaksi` (
  `id_barang_transaksi` int unsigned NOT NULL AUTO_INCREMENT,
  `id_barang` int unsigned NOT NULL,
  `tipe` enum('keluar','masuk') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `keterangan` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gambar` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `jumlah` int NOT NULL,
  `stok_awal` int NOT NULL,
  `stok_akhir` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_barang_transaksi`) USING BTREE,
  KEY `FK_barang_transaksi_barang` (`id_barang`),
  CONSTRAINT `FK_barang_transaksi_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table dummy.barang_transaksi: ~2 rows (approximately)
DELETE FROM `barang_transaksi`;

-- Dumping structure for table dummy.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` int unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `alamat` varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_customer`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table dummy.customer: ~2 rows (approximately)
DELETE FROM `customer`;

-- Dumping structure for table dummy.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int unsigned NOT NULL AUTO_INCREMENT,
  `id_customer` int unsigned DEFAULT NULL,
  `tipe` enum('jual','beli') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kode` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nama` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `subtotal` int NOT NULL,
  `total` int NOT NULL,
  `ppn` int NOT NULL,
  `faktur` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `faktur_tgl` date NOT NULL,
  `po` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `alamat` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `FK_transaksi_customer` (`id_customer`),
  CONSTRAINT `FK_transaksi_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dummy.transaksi: ~0 rows (approximately)
DELETE FROM `transaksi`;

-- Dumping structure for table dummy.transaksi_item
CREATE TABLE IF NOT EXISTS `transaksi_item` (
  `id_transaksi_item` int unsigned NOT NULL AUTO_INCREMENT,
  `id_transaksi` int unsigned NOT NULL,
  `id_barang` int unsigned NOT NULL,
  `kode` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `keterangan` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `jumlah` int NOT NULL,
  `harga` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_item`) USING BTREE,
  KEY `FK_transaksi_item_transaksi` (`id_transaksi`),
  KEY `FK_transaksi_item_barang` (`id_barang`),
  CONSTRAINT `FK_transaksi_item_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  CONSTRAINT `FK_transaksi_item_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table dummy.transaksi_item: ~0 rows (approximately)
DELETE FROM `transaksi_item`;

-- Dumping structure for table dummy.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gambar` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `token` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `token_exp` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table dummy.user: ~2 rows (approximately)
DELETE FROM `user`;
INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role`, `gambar`, `token`, `token_exp`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'test', 'admin', 'cc51b81974287ab79cef9e94fe778cc9', 'admin', '/uploads/default.jpg', 'admin_73908595', NULL, '2024-01-19 02:16:40', '2024-01-30 15:58:26', NULL),
	(2, 'test', 'user', 'cc51b81974287ab79cef9e94fe778cc9', 'user', '/uploads/default.jpg', 'admin_69972043', NULL, '2024-01-19 02:16:40', '2024-01-30 16:30:01', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
