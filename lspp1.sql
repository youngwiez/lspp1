-- --------------------------------------------------------
-- Host:                         192.168.1.7
-- Server version:               10.11.3-MariaDB-1 - Debian 12
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for lspp1
CREATE DATABASE IF NOT EXISTS `lspp1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `lspp1`;

-- Dumping structure for table lspp1.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `merk` varchar(30) DEFAULT NULL,
  `seri` varchar(40) DEFAULT NULL,
  `spesifikasi` text DEFAULT NULL,
  `stok` smallint(6) NOT NULL DEFAULT 0,
  `kategori_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barang_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `barang_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lspp1.barang: ~5 rows (approximately)
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`id`, `merk`, `seri`, `spesifikasi`, `stok`, `kategori_id`, `created_at`, `updated_at`) VALUES
	(2, 'Trendnet', 'TC-CT68', 'Crimping Tool', 30, 4, '2023-12-07 10:59:28', '2023-12-07 10:59:28'),
	(7, 'Cisco', 'C891FK9', '9 GE interfaces, 1 FE interface, 1 SFP port, 1 Serial interface', 10, 9, '2023-12-08 02:15:44', '2023-12-08 02:15:44'),
	(8, 'Lenovo', 'IdeaPad 5 14ITL05', '11th Gen Intel(R) Core(TM) i7-1165G7', 20, 3, '2023-12-08 02:29:25', '2023-12-08 02:29:25'),
	(9, 'Lenovaa', 'IdeaPad 5 14ITL056', '11th Gen Intel(R) Core(TM) i7-1165G7', 20, 2, '2023-12-08 02:56:59', '2023-12-08 06:37:04');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- Dumping structure for table lspp1.barangkeluar
CREATE TABLE IF NOT EXISTS `barangkeluar` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tgl_keluar` date NOT NULL,
  `qty_keluar` smallint(6) NOT NULL DEFAULT 1,
  `barang_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barangkeluar_barang_id_foreign` (`barang_id`),
  CONSTRAINT `barangkeluar_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lspp1.barangkeluar: ~1 rows (approximately)
/*!40000 ALTER TABLE `barangkeluar` DISABLE KEYS */;
INSERT INTO `barangkeluar` (`id`, `tgl_keluar`, `qty_keluar`, `barang_id`, `created_at`, `updated_at`) VALUES
	(3, '2023-12-08', 1, 8, '2023-12-08 05:43:57', '2023-12-08 05:44:05');
/*!40000 ALTER TABLE `barangkeluar` ENABLE KEYS */;

-- Dumping structure for table lspp1.barangmasuk
CREATE TABLE IF NOT EXISTS `barangmasuk` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tgl_masuk` date NOT NULL,
  `qty_masuk` smallint(6) NOT NULL DEFAULT 1,
  `barang_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barangmasuk_barang_id_foreign` (`barang_id`),
  CONSTRAINT `barangmasuk_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lspp1.barangmasuk: ~3 rows (approximately)
/*!40000 ALTER TABLE `barangmasuk` DISABLE KEYS */;
INSERT INTO `barangmasuk` (`id`, `tgl_masuk`, `qty_masuk`, `barang_id`, `created_at`, `updated_at`) VALUES
	(4, '2023-12-08', 4, 9, '2023-12-08 05:43:24', '2023-12-08 05:43:34'),
	(5, '2023-12-08', 5, 9, '2023-12-08 06:30:23', '2023-12-08 06:30:34'),
	(6, '2023-12-08', 5, 9, '2023-12-08 06:39:26', '2023-12-08 06:39:38');
/*!40000 ALTER TABLE `barangmasuk` ENABLE KEYS */;

-- Dumping structure for table lspp1.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lspp1.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table lspp1.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(255) DEFAULT NULL,
  `kategori` enum('M','A','BHP','BTHP') NOT NULL DEFAULT 'A',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lspp1.kategori: ~5 rows (approximately)
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` (`id`, `deskripsi`, `kategori`, `created_at`, `updated_at`) VALUES
	(1, 'Pendingin Ruang', 'M', NULL, NULL),
	(2, 'Alat Praktik Jaringan Komputer', 'A', NULL, NULL),
	(3, 'Bahan Praktik Habis Pakai', 'BHP', NULL, NULL),
	(4, 'Bahan Praktik Tidak Habis Pakai', 'BTHP', NULL, NULL),
	(9, 'Bahan Praktik Jaringan', 'BTHP', '2023-12-07 15:39:25', '2023-12-07 22:52:09');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;

-- Dumping structure for table lspp1.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lspp1.migrations: ~16 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_12_06_025138_create_kategori_table', 2),
	(7, '2023_12_07_030139_create_barang_table', 3),
	(8, '2023_12_07_031525_create_barangmasuk_table', 4),
	(10, '2023_12_07_104926_create_kategori_table', 5),
	(11, '2023_12_07_105225_create_barang_table', 6),
	(12, '2023_12_07_105300_create_barangmasuk_table', 7),
	(13, '2023_12_07_105333_create_barangkeluar_table', 8),
	(16, '2023_12_07_233337_create_barangmasuk_trigger', 9),
	(17, '2023_12_07_233939_create_barangkeluar_trigger', 9),
	(18, '2023_12_08_053333_create_delete_barangmasuk_trigger', 10),
	(19, '2023_12_08_053718_create_delete_barangkeluar_trigger', 11),
	(20, '2023_12_08_053940_create_edit_barangmasuk_trigger', 12),
	(21, '2023_12_08_054113_create_edit_barangkeluar_trigger', 13);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table lspp1.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lspp1.password_reset_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

-- Dumping structure for table lspp1.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lspp1.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table lspp1.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lspp1.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Muhammad Raka', 'm.raka248@gmail.com', NULL, '$2y$12$mPxj6afZsSqObNQDvXayL.6CxlhoSQo0X.u4DhdzmiqyeBuXIX/pa', NULL, '2023-12-07 11:29:39', '2023-12-07 11:29:39'),
	(2, 'aku', 'm.raka@gmail.com', NULL, '$2y$12$07/Zl6k/JH1vMN4jyUFmj.zpIGxHIK1PIu/HHUBpIo.1wFFRlkeVq', NULL, '2023-12-08 06:35:50', '2023-12-08 06:35:50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for trigger lspp1.barang_down_stokminus
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER barang_down_stokminus
        AFTER INSERT ON barangkeluar
        FOR EACH ROW
        BEGIN
            UPDATE barang SET barang.stok = barang.stok - NEW.qty_keluar 
            WHERE barang.id=NEW.barang_id; 
        END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger lspp1.barang_edit_keluar_stok_adjust
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER barang_edit_keluar_stok_adjust
        BEFORE UPDATE ON barangkeluar
        FOR EACH ROW
        BEGIN
            DECLARE qty_diff INT;

            SET qty_diff = NEW.qty_keluar - OLD.qty_keluar;

            IF qty_diff > 0 THEN
                UPDATE barang
                SET barang.stok = barang.stok - qty_diff
                WHERE barang.id = NEW.barang_id AND barang.stok - qty_diff >= 0;
            ELSE
                UPDATE barang
                SET barang.stok = barang.stok - qty_diff
                WHERE barang.id = NEW.barang_id;
            END IF;
        END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger lspp1.barang_edit_masuk_stok_adjust
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER barang_edit_masuk_stok_adjust
        BEFORE UPDATE ON barangmasuk
        FOR EACH ROW
        BEGIN
            DECLARE qty_diff INT;

            SET qty_diff = NEW.qty_masuk - OLD.qty_masuk;

            IF qty_diff > 0 THEN
                UPDATE barang
                SET barang.stok = barang.stok + qty_diff
                WHERE barang.id = NEW.barang_id;
            ELSE
                UPDATE barang
                SET barang.stok = barang.stok + qty_diff
                WHERE barang.id = NEW.barang_id AND barang.stok + qty_diff >= 0;
            END IF;
        END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger lspp1.barang_undo_stokdel
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER barang_undo_stokdel
        BEFORE DELETE ON barangkeluar
        FOR EACH ROW
        BEGIN
            UPDATE barang
            SET barang.stok = barang.stok + OLD.qty_keluar
            WHERE barang.id = OLD.barang_id;
        END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger lspp1.barang_undo_stokdelete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER barang_undo_stokdelete
        BEFORE DELETE ON barangmasuk
        FOR EACH ROW
        BEGIN
            UPDATE barang
            SET barang.stok = barang.stok - OLD.qty_masuk
            WHERE barang.id = OLD.barang_id;
        END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger lspp1.barang_up_stokplus
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER barang_up_stokplus
        AFTER INSERT ON barangmasuk
        FOR EACH ROW
        BEGIN
            UPDATE barang SET barang.stok = barang.stok + NEW.qty_masuk 
            WHERE barang.id=NEW.barang_id; 
        END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
