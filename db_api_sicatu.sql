/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.24-MariaDB : Database - db_api_sicatu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_api_sicatu` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_api_sicatu`;

/*Table structure for table `bayar` */

DROP TABLE IF EXISTS `bayar`;

CREATE TABLE `bayar` (
  `bayar_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `desa_id` bigint(20) unsigned NOT NULL,
  `pelanggan_id` bigint(20) unsigned NOT NULL,
  `operator_id` bigint(20) unsigned NOT NULL,
  `tanggal` datetime NOT NULL,
  `nominal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bayar_id`),
  KEY `desa_id` (`desa_id`),
  KEY `pelanggan_id` (`pelanggan_id`),
  KEY `operator_id` (`operator_id`),
  CONSTRAINT `bayar_ibfk_1` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`desa_id`),
  CONSTRAINT `bayar_ibfk_2` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`pelanggan_id`),
  CONSTRAINT `bayar_ibfk_3` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`operator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `bayar` */

insert  into `bayar`(`bayar_id`,`desa_id`,`pelanggan_id`,`operator_id`,`tanggal`,`nominal`,`created_at`,`updated_at`) values 
(4,4,1,5,'2022-10-23 11:24:26',5000,'2022-10-23 03:26:46','2022-10-23 03:28:46'),
(5,4,1,5,'2022-10-23 11:24:26',10000,'2022-10-23 03:26:47','2022-10-23 03:26:47');

/*Table structure for table `desa` */

DROP TABLE IF EXISTS `desa`;

CREATE TABLE `desa` (
  `desa_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_desa` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`desa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `desa` */

insert  into `desa`(`desa_id`,`nama_desa`,`created_at`,`updated_at`) values 
(1,'Pecatu',NULL,NULL),
(4,'Mengwitani','2022-10-09 14:58:29','2022-10-13 17:41:47'),
(5,'Panjer','2022-10-09 15:33:56','2022-10-09 15:33:56');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `jabatan_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `desa_id` bigint(20) unsigned NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`jabatan_id`),
  KEY `desa_id` (`desa_id`),
  CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`desa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jabatan` */

insert  into `jabatan`(`jabatan_id`,`desa_id`,`nama_jabatan`,`created_at`,`updated_at`) values 
(1,1,'Kepala Desa','2022-10-09 14:40:09','2022-10-09 14:40:09'),
(4,1,'Sekretaris Desa','2022-10-09 15:33:52','2022-10-09 15:33:52'),
(5,1,'Bendahara Desa','2022-10-13 17:52:48','2022-10-13 18:00:44'),
(6,4,'Bendahara Desa','2022-10-28 04:24:59','2022-10-28 04:24:59');

/*Table structure for table `jadwal_pelanggan` */

DROP TABLE IF EXISTS `jadwal_pelanggan`;

CREATE TABLE `jadwal_pelanggan` (
  `jadwal_pelanggan_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shift_id` bigint(20) unsigned NOT NULL,
  `pelanggan_id` bigint(20) unsigned NOT NULL,
  `desa_id` bigint(20) unsigned NOT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`jadwal_pelanggan_id`),
  KEY `pelanggan_id` (`pelanggan_id`),
  KEY `shift_id` (`shift_id`),
  KEY `desa_id` (`desa_id`),
  CONSTRAINT `jadwal_pelanggan_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`pelanggan_id`),
  CONSTRAINT `jadwal_pelanggan_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`shift_id`),
  CONSTRAINT `jadwal_pelanggan_ibfk_3` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`desa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jadwal_pelanggan` */

insert  into `jadwal_pelanggan`(`jadwal_pelanggan_id`,`shift_id`,`pelanggan_id`,`desa_id`,`hari`,`created_at`,`updated_at`) values 
(2,1,1,1,'rabu','2022-10-21 16:59:10','2022-10-21 17:00:16'),
(4,1,2,4,'sabtu','2022-10-21 16:59:41','2022-10-21 16:59:41');

/*Table structure for table `jadwal_petugas` */

DROP TABLE IF EXISTS `jadwal_petugas`;

CREATE TABLE `jadwal_petugas` (
  `jadwal_petugas_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shift_id` bigint(20) unsigned NOT NULL,
  `petugas_id` bigint(20) unsigned NOT NULL,
  `desa_id` bigint(20) unsigned NOT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`jadwal_petugas_id`),
  KEY `petugas_id` (`petugas_id`),
  KEY `shift_id` (`shift_id`),
  KEY `desa_id` (`desa_id`),
  CONSTRAINT `jadwal_petugas_ibfk_1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`petugas_id`),
  CONSTRAINT `jadwal_petugas_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`shift_id`),
  CONSTRAINT `jadwal_petugas_ibfk_3` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`desa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jadwal_petugas` */

insert  into `jadwal_petugas`(`jadwal_petugas_id`,`shift_id`,`petugas_id`,`desa_id`,`hari`,`created_at`,`updated_at`) values 
(1,1,3,1,'senin','2022-10-16 15:43:35','2022-10-16 15:43:35'),
(2,1,3,4,'rabu','2022-10-16 15:44:12','2022-10-16 15:47:33');

/*Table structure for table `jenis_langganan` */

DROP TABLE IF EXISTS `jenis_langganan`;

CREATE TABLE `jenis_langganan` (
  `jenis_langganan_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `desa_id` bigint(20) unsigned NOT NULL,
  `nama_jenis_langganan` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`jenis_langganan_id`),
  KEY `desa_id` (`desa_id`),
  CONSTRAINT `jenis_langganan_ibfk_1` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`desa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jenis_langganan` */

insert  into `jenis_langganan`(`jenis_langganan_id`,`desa_id`,`nama_jenis_langganan`,`harga`,`created_at`,`updated_at`) values 
(1,4,'Reguler',10000,'2022-10-17 06:22:58','2022-10-17 06:22:58'),
(2,4,'Hemat',5000,'2022-10-17 06:23:32','2022-10-17 06:23:32'),
(4,4,'Sultan',18000,'2022-10-17 06:26:27','2022-10-17 06:27:43');

/*Table structure for table `keluhan` */

DROP TABLE IF EXISTS `keluhan`;

CREATE TABLE `keluhan` (
  `keluhan_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `desa_id` bigint(20) unsigned NOT NULL,
  `pelanggan_id` bigint(20) unsigned NOT NULL,
  `keluhan` varchar(255) NOT NULL,
  `respon` varchar(255) DEFAULT NULL,
  `status_keluhan` enum('Menunggu Verifikasi','Sedang Diproses','Sudah Ditangani','Gagal Diproses','Keluhan Ditolak') NOT NULL,
  `before_photo` varchar(255) DEFAULT NULL,
  `after_photo` varchar(255) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`keluhan_id`),
  KEY `desa_id` (`desa_id`),
  KEY `pelanggan_id` (`pelanggan_id`),
  CONSTRAINT `keluhan_ibfk_1` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`desa_id`),
  CONSTRAINT `keluhan_ibfk_2` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`pelanggan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `keluhan` */

insert  into `keluhan`(`keluhan_id`,`desa_id`,`pelanggan_id`,`keluhan`,`respon`,`status_keluhan`,`before_photo`,`after_photo`,`lat`,`lng`,`created_at`,`updated_at`) values 
(1,4,1,'Sampah rumah tangga',NULL,'Sedang Diproses',NULL,NULL,NULL,NULL,'2022-10-23 04:20:00','2022-10-23 04:20:00'),
(2,4,1,'Sampah rumah tangga 1',NULL,'Menunggu Verifikasi',NULL,NULL,NULL,NULL,'2022-10-23 04:20:53','2022-10-23 04:20:53'),
(3,4,1,'Sampah rumah tangga 2',NULL,'Menunggu Verifikasi',NULL,NULL,NULL,NULL,'2022-10-23 04:20:58','2022-10-23 04:20:58'),
(4,4,1,'Sampah rumah tangga 3','baik sampah akan segera diatasi','Menunggu Verifikasi',NULL,NULL,-8.67814,115.221,'2022-10-23 04:21:02','2022-10-23 06:37:57');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_100000_create_password_resets_table',1),
(2,'2019_08_19_000000_create_failed_jobs_table',1),
(3,'2019_12_14_000001_create_personal_access_tokens_table',1),
(4,'2013_09_21_065857_create_roles_table',2),
(5,'2014_10_12_000000_create_users_table',2);

/*Table structure for table `operator` */

DROP TABLE IF EXISTS `operator`;

CREATE TABLE `operator` (
  `operator_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `desa_id` bigint(20) unsigned NOT NULL,
  `users_id` bigint(20) unsigned NOT NULL,
  `jabatan_id` bigint(20) unsigned DEFAULT NULL,
  `nama_operator` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`operator_id`),
  KEY `desa_id` (`desa_id`),
  KEY `jabatan_id` (`jabatan_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `operator_ibfk_2` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`desa_id`),
  CONSTRAINT `operator_ibfk_3` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`jabatan_id`),
  CONSTRAINT `operator_ibfk_4` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `operator` */

insert  into `operator`(`operator_id`,`desa_id`,`users_id`,`jabatan_id`,`nama_operator`,`alamat`,`hp`,`created_at`,`updated_at`) values 
(2,4,8,1,'Arta Kusuma','Jalan Waturenggong No 104','085536553592','2022-10-09 15:53:21','2022-10-13 18:07:50'),
(4,4,28,NULL,'Dede Budhi Arta K','Jalan Waturenggong No 104',NULL,'2022-10-21 05:10:29','2022-10-21 05:10:29'),
(5,4,29,NULL,'Dede Budhi Arta K','Jalan Waturenggong No 104',NULL,'2022-10-21 05:23:04','2022-10-21 05:23:04');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `pelanggan_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) unsigned NOT NULL,
  `desa_id` bigint(20) unsigned NOT NULL,
  `jenis_langganan_id` bigint(20) unsigned DEFAULT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pelanggan_id`),
  KEY `desa_id` (`desa_id`),
  KEY `users_id` (`users_id`),
  KEY `jenis_pelanggan_id` (`jenis_langganan_id`),
  CONSTRAINT `pelanggan_ibfk_2` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`desa_id`),
  CONSTRAINT `pelanggan_ibfk_3` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  CONSTRAINT `pelanggan_ibfk_4` FOREIGN KEY (`jenis_langganan_id`) REFERENCES `jenis_langganan` (`jenis_langganan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`pelanggan_id`,`users_id`,`desa_id`,`jenis_langganan_id`,`nama_pelanggan`,`alamat`,`hp`,`lat`,`lng`,`created_at`,`updated_at`) values 
(1,21,1,1,'Dede Budhi Arta K','Jalan Waturenggong No 104',NULL,NULL,NULL,'2022-10-21 04:53:59','2022-10-21 04:53:59'),
(2,22,4,2,'Dede Budhi Arta K2','Jalan Waturenggong No 104','085536553592',-8.67814,115.221,'2022-10-21 04:56:16','2022-10-21 16:26:53'),
(4,29,4,4,'Dede Budhi Arta Kw','Jalan Waturenggong 104','085536553596',-8.67814,115.221,'2022-10-21 16:25:05','2022-10-21 16:25:05');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

insert  into `personal_access_tokens`(`id`,`tokenable_type`,`tokenable_id`,`name`,`token`,`abilities`,`last_used_at`,`expires_at`,`created_at`,`updated_at`) values 
(1,'App\\Models\\User',3,'token','a9a21441b74b38f5cafd6d1fbf7439ab6d20a6139644ad9d44b2a0a91f4e4458','[\"*\"]',NULL,NULL,'2022-10-04 17:36:11','2022-10-04 17:36:11'),
(2,'App\\Models\\User',4,'token','46d47ca0c64e24608971411c5f0312614c61cb7b1ad5741585ba52b02cf2bd6e','[\"*\"]',NULL,NULL,'2022-10-06 14:00:27','2022-10-06 14:00:27'),
(3,'App\\Models\\User',4,'token','596cbd5efaec05d608ef6da878938c2e18f16590839ad1a9ac91558c2604e27a','[\"*\"]',NULL,NULL,'2022-10-06 14:12:25','2022-10-06 14:12:25'),
(6,'App\\Models\\User',3,'token','582e79d5991a232dc9263bcd50fcf2a6c89012f0413efe6f28eb469a58280ec4','[\"*\"]','2022-11-08 17:08:49',NULL,'2022-10-07 04:55:30','2022-11-08 17:08:49'),
(7,'App\\Models\\User',3,'token','32c4c8a37b1c812cb0bbc089049c42a6960a948650e03fb01694f08c938ed932','[\"*\"]','2022-10-07 05:49:15',NULL,'2022-10-07 05:47:11','2022-10-07 05:49:15'),
(9,'App\\Models\\User',7,'token','6dd4e0bf077dfb3dc70cb24117892b5a31a37edacb92a95785256f27a1dc639a','[\"*\"]','2022-10-07 05:55:02',NULL,'2022-10-07 05:50:54','2022-10-07 05:55:02'),
(10,'App\\Models\\User',8,'token','d00eedc31a394ec26b3db7634209ec437759576f4e3c34b71301b0a353bc007e','[\"*\"]',NULL,NULL,'2022-10-07 06:01:28','2022-10-07 06:01:28'),
(11,'App\\Models\\User',3,'token','5574966df576e007815d649474df734e6c8924ce077b00ee303c03d617a492f7','[\"*\"]','2022-10-07 06:01:57',NULL,'2022-10-07 06:01:39','2022-10-07 06:01:57'),
(12,'App\\Models\\User',8,'token','e4b46116e19e0a5bdcadac6bc2a30cd180e7603a5c4129043f1480444c6fdec6','[\"*\"]','2022-10-07 06:05:11',NULL,'2022-10-07 06:02:36','2022-10-07 06:05:11'),
(13,'App\\Models\\User',11,'token','1eba2f10b405c3e895a50de4c12b90381f8ed74ffb88dfa2c0abddff3587a87f','[\"*\"]','2022-10-07 06:07:01',NULL,'2022-10-07 06:06:08','2022-10-07 06:07:01'),
(14,'App\\Models\\User',3,'token','efc9c6ca597832eb4811f6aba7cdb6b035588c1072cbcb34b55953b5af318c71','[\"*\"]','2022-10-07 06:07:45',NULL,'2022-10-07 06:07:32','2022-10-07 06:07:45'),
(15,'App\\Models\\User',3,'token','7d97997bfd520d6e79a78bf550d1b875d4cf27f8868036e26fb659e12df5ed2b','[\"*\"]',NULL,NULL,'2022-10-07 06:09:02','2022-10-07 06:09:02'),
(17,'App\\Models\\User',3,'token','a32fc6c9002ecaeb04c86f399e761969c093e2e84e50da9d493791b9d7cab92a','[\"*\"]','2022-10-09 14:02:32',NULL,'2022-10-09 14:00:31','2022-10-09 14:02:32'),
(18,'App\\Models\\User',8,'token','cd9421b5ba518ebda2bc835255324d8f4e27039f866f8e724060232035c6b312','[\"*\"]','2022-10-09 14:04:57',NULL,'2022-10-09 14:02:45','2022-10-09 14:04:57'),
(19,'App\\Models\\User',3,'token','7ecc065f80821c252bce58f9316fc1d4f5dffc194bcc3552afc5933b1773cbbd','[\"*\"]','2022-10-09 15:53:59',NULL,'2022-10-09 14:03:56','2022-10-09 15:53:59'),
(20,'App\\Models\\User',3,'token','c26371f4ecbf9f301510dab58448047dbd12a72c161455047f042eeb29f33a80','[\"*\"]','2022-10-09 14:54:45',NULL,'2022-10-09 14:20:17','2022-10-09 14:54:45'),
(21,'App\\Models\\User',3,'token','3c90f7d073be49e5bda5313afc5287e35d18e97339a58b3b03d818c00ad83e93','[\"*\"]',NULL,NULL,'2022-10-09 14:31:24','2022-10-09 14:31:24'),
(22,'App\\Models\\User',8,'token','963eeb4fc72428688c81e3d8a738747b9e218dc12ac71fb2be8412316d751576','[\"*\"]','2022-10-28 04:24:59',NULL,'2022-10-09 14:42:17','2022-10-28 04:24:59'),
(23,'App\\Models\\User',8,'token','b59ff127e7a4c0676edc45fa0aea88c5bc9d07e879abb86901fdd0a337b64e1c','[\"*\"]','2022-10-23 06:37:57',NULL,'2022-10-09 15:56:24','2022-10-23 06:37:57'),
(24,'App\\Models\\User',3,'token','9648dddeebe822792674cd0c67563405db547c1725480fdad0e160e59966080d','[\"*\"]','2022-10-23 03:28:56',NULL,'2022-10-09 15:56:39','2022-10-23 03:28:56'),
(25,'App\\Models\\User',8,'token','7eb6dd93af0fe71dde34e64fed4e99f09e1e827e688e8c2f88f7b3c92027a916','[\"*\"]','2022-10-13 17:41:14',NULL,'2022-10-13 17:32:39','2022-10-13 17:41:14'),
(26,'App\\Models\\User',3,'token','9d3add2688d1f2a0d5a624ba893a49fd81fbd964d8eb7387870f8b8ea756d809','[\"*\"]','2022-10-13 18:07:50',NULL,'2022-10-13 17:41:36','2022-10-13 18:07:50'),
(27,'App\\Models\\User',8,'token','cfa72ae7c5d87f3cf1497617752e66379a3cdec98568a06ddf547998c0bc5126','[\"*\"]','2022-10-16 06:57:31',NULL,'2022-10-16 06:55:50','2022-10-16 06:57:31'),
(28,'App\\Models\\User',8,'token','dc92f685cf756ad09fd4e2d031f2ef112e73d21fa04779a8d5750ecc7c92aa67','[\"*\"]','2022-10-29 14:36:28',NULL,'2022-10-16 14:40:46','2022-10-29 14:36:28'),
(29,'App\\Models\\User',8,'token','1fdd490cee87c0b84eda637df19b41bbab64b0c5059737717baa33bacc68b1be','[\"*\"]','2022-10-17 06:47:38',NULL,'2022-10-17 06:42:35','2022-10-17 06:47:38'),
(30,'App\\Models\\User',3,'token','5d822826437a5461a2bb454345aa93a15e5e90225bcb359f81ce81e0179ea3c8','[\"*\"]','2022-11-08 17:08:43',NULL,'2022-10-28 04:10:37','2022-11-08 17:08:43'),
(31,'App\\Models\\User',17,'token','a59a6de6c5b0bf5897db4b2b278c222c75ac2e77015b7b3ffc0cc7b20104105a','[\"*\"]','2022-10-28 04:25:41',NULL,'2022-10-28 04:11:14','2022-10-28 04:25:41'),
(32,'App\\Models\\User',8,'token','56b407b932a638ac9be16927c34dbd28496a9662c8374436f81b481a4189b2be','[\"*\"]','2022-10-28 05:35:12',NULL,'2022-10-28 04:12:22','2022-10-28 05:35:12'),
(33,'App\\Models\\User',16,'token','33c93ef82a138f7cdc1a11296ecf7090aa69fbcb7a5a51f48076419fac95a54b','[\"*\"]','2022-10-28 06:39:46',NULL,'2022-10-28 06:13:37','2022-10-28 06:39:46'),
(34,'App\\Models\\User',29,'token','dc416a76e585c18e396ab3946f07c2b9ad8147e8f2a4bb0d559e638cb7e3ce26','[\"*\"]','2022-10-29 15:19:12',NULL,'2022-10-29 14:28:49','2022-10-29 15:19:12'),
(35,'App\\Models\\User',21,'token','cf61d4cc4a8cca9eda33beb548dea64cdf7d852c3ee0695ea81d9ecb9f8caa2c','[\"*\"]','2022-10-29 15:14:27',NULL,'2022-10-29 14:51:59','2022-10-29 15:14:27'),
(36,'App\\Models\\User',8,'token','ee8876f15bc01b122be30e0cf78954c00a3d9c2514b5cb0ff771cfb37e6fad99','[\"*\"]','2022-10-29 15:17:52',NULL,'2022-10-29 15:16:58','2022-10-29 15:17:52'),
(37,'App\\Models\\User',3,'token','153fafa1ed129239f367823f8239df3b4cfefef885673e72575d0c3f0a4c2540','[\"*\"]','2022-10-29 15:38:13',NULL,'2022-10-29 15:19:51','2022-10-29 15:38:13'),
(38,'App\\Models\\User',11,'token','1e1406e2011bf3b66995ba1e761e0e044da43d88e7ef15620278d190e241d2b3','[\"*\"]','2022-10-29 15:37:42',NULL,'2022-10-29 15:20:16','2022-10-29 15:37:42'),
(39,'App\\Models\\User',26,'token','c013f62e5836be1cbac5230ccca9da3d9e981e1af540d1db338af4b14bc71e75','[\"*\"]','2022-10-29 15:37:34',NULL,'2022-10-29 15:20:52','2022-10-29 15:37:34'),
(40,'App\\Models\\User',15,'token','fe2829ca82ef454af4b4955507c995c7ae6e6577b97e7c961cb98ff06b0a7c56','[\"*\"]','2022-10-29 15:37:14',NULL,'2022-10-29 15:21:37','2022-10-29 15:37:14'),
(41,'App\\Models\\User',3,'token','f75f182dbc491649cb9ed85f39e1e91eb55a09370eb239fe0bfee60359866a64','[\"*\"]','2022-10-29 15:41:21',NULL,'2022-10-29 15:38:26','2022-10-29 15:41:21'),
(42,'App\\Models\\User',29,'token','fc8977014f85f5f17f425ee29302a87466cebf2180c235bb92e3eda6bd95dae3','[\"*\"]','2022-10-29 15:46:05',NULL,'2022-10-29 15:44:45','2022-10-29 15:46:05'),
(43,'App\\Models\\User',21,'token','56857cd8789952589435043ada73343d2fec870a54da3fb04d4881d9f9bdcd8c','[\"*\"]','2022-10-29 15:51:58',NULL,'2022-10-29 15:47:53','2022-10-29 15:51:58'),
(44,'App\\Models\\User',22,'token','7b2152e973b8dadd2dd61afa70e11bb87f9035e2d4c8956a7824abab14de1f86','[\"*\"]','2022-10-30 04:20:12',NULL,'2022-10-30 04:19:58','2022-10-30 04:20:12'),
(45,'App\\Models\\User',23,'token','fea0f33b03b7395062bf64efde8b94f97d9198546ec2f45595fc8bac02ed8ae1','[\"*\"]','2022-10-30 04:21:58',NULL,'2022-10-30 04:21:20','2022-10-30 04:21:58');

/*Table structure for table `petugas` */

DROP TABLE IF EXISTS `petugas`;

CREATE TABLE `petugas` (
  `petugas_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) unsigned NOT NULL,
  `desa_id` bigint(20) unsigned NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`petugas_id`),
  KEY `desa_id` (`desa_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `petugas_ibfk_2` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`desa_id`),
  CONSTRAINT `petugas_ibfk_3` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `petugas` */

insert  into `petugas`(`petugas_id`,`users_id`,`desa_id`,`nama_petugas`,`alamat`,`hp`,`created_at`,`updated_at`) values 
(3,16,1,'Dede Budhi','Jalan Waturenggong No 104','085536553592','2022-10-16 14:42:08','2022-10-16 14:52:27'),
(5,17,1,'Dede Budhi Arta','Jalan Waturenggong No 104','085536553593','2022-10-17 06:50:57','2022-10-17 06:50:57'),
(6,23,4,'Dede Budhi Arta K23','Jalan Waturenggong No 104',NULL,'2022-10-21 05:01:06','2022-10-21 05:01:06'),
(7,24,4,'Dede Budhi Arta K','Jalan Waturenggong No 104',NULL,'2022-10-21 05:03:24','2022-10-21 05:03:24'),
(8,25,4,'Dede Budhi Arta K','Jalan Waturenggong No 104',NULL,'2022-10-21 05:03:42','2022-10-21 05:03:42');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `roles_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`roles_id`,`nama_role`,`created_at`,`updated_at`) values 
(1,'super admin',NULL,NULL),
(2,'admin desa',NULL,NULL),
(3,'perangkat desa',NULL,NULL),
(4,'petugas',NULL,NULL),
(5,'user',NULL,NULL);

/*Table structure for table `shift` */

DROP TABLE IF EXISTS `shift`;

CREATE TABLE `shift` (
  `shift_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shift` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`shift_id`),
  KEY `desa_id` (`shift`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `shift` */

insert  into `shift`(`shift_id`,`shift`,`created_at`,`updated_at`) values 
(1,'Ya','2022-10-16 06:56:41','2022-10-21 03:31:03'),
(2,'Tidak','2022-10-16 06:57:04','2022-10-21 03:30:53');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `users_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roles_id` bigint(20) unsigned DEFAULT NULL,
  `desa_id` bigint(20) unsigned DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`users_id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_roles_id_foreign` (`roles_id`),
  KEY `users_desa_id_foreign` (`desa_id`),
  CONSTRAINT `users_desa_id_foreign` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`desa_id`),
  CONSTRAINT `users_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`users_id`,`roles_id`,`desa_id`,`nama`,`email`,`password`,`address`,`photo`,`remember_token`,`created_at`,`updated_at`) values 
(3,1,1,'Budhi Arta','budhi@gmail.com','$2y$10$JxxVWFrEmBfckU6aMqGbeO7MNC25hwIg059tErlh8WCXOsIxKmYja','Jalan Waturenggong No 104',NULL,NULL,'2022-10-04 17:32:12','2022-10-04 17:32:12'),
(8,2,1,'Arta Kusuma','artakusuma2@gmail.com','$2y$10$.nfTceF8qSvlZnnKkW3.1Orhdkq7qAtp6ZiM1eUBuKv0/DRc.46wi','Jalan Waturenggong No 104',NULL,NULL,'2022-10-07 06:00:35','2022-10-07 06:00:35'),
(11,2,1,'Arta Kusuma','artakusuma2@gmail2.com','$2y$10$/L.pi74uECjX02QNv5yDJ.p6b6grhA/bM/8uTimhnFTZDQVnD/UmO','Jalan Waturenggong No 104',NULL,NULL,'2022-10-07 06:05:36','2022-10-07 06:05:36'),
(15,2,1,'Arta Kusuma','artakusuma24@gmail.com','$2y$10$KGkY20nxqFoWiOh..6P7D.u6L58xYHQ896YR7jSPMfewIksRJ77am','Jalan Waturenggong No 104',NULL,NULL,'2022-10-09 14:03:44','2022-10-09 14:03:44'),
(16,4,1,'Dede Budhi','dedebudhi@gmail.com','$2y$10$Gc9JbroVvzGkuRnA6RGAYOeEhdI.prh08VnDEzT5eDfK3kdafQo4a','Jalan Waturenggong No 104',NULL,NULL,'2022-10-16 14:40:10','2022-10-16 14:40:10'),
(17,4,4,'Dede Budhi Arta','dedebudhiarta@gmail.com','$2y$10$gQLAOJoON7K0s2sKxJsFO./SHgJ5OFKHw98dmG/JI9vYjd012Ggwe','Jalan Waturenggong No 104',NULL,NULL,'2022-10-16 14:43:43','2022-10-16 14:43:43'),
(18,5,4,'Dede Budhi Arta K','dedebudhiartak@gmail.com','$2y$10$FNDUX3Al4f47OhYSwU34/.QDDaQRqtVZaARnm2U2/Ww0WbRRU241a','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 04:43:18','2022-10-21 04:43:18'),
(19,5,4,'Dede Budhi Arta K','dedebudhiartak2@gmail.com','$2y$10$I6Fc3e0KOt4dK.2qDIGcduh6bhmaiRYp7FjZuJtvze29g4G/mVFlG','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 04:52:21','2022-10-21 04:52:21'),
(20,5,4,'Dede Budhi Arta K','dedebudhiartak3@gmail.com','$2y$10$S7vyTbaPrRMp5iLFO.oV..VNDieLh1ZxlB5GqvkcQx9KqXQYCBaka','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 04:53:27','2022-10-21 04:53:27'),
(21,5,4,'Dede Budhi Arta K','dedebudhiartak4@gmail.com','$2y$10$ww926NocT/XEB2iBRzbSneEnBysbV6KIHoK.fbazWddYIF/eu1u8u','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 04:53:59','2022-10-21 04:53:59'),
(22,5,4,'Dede Budhi Arta K','dedebudhiartak5@gmail.com','$2y$10$Jb5Jal/.PdkX.EKXdXWcUOzIJLIs7TvqEIWxgEqn0/MXI4LBSUhvW','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 04:56:16','2022-10-21 04:56:16'),
(23,4,4,'Dede Budhi Arta K','dedebudhiartak6@gmail.com','$2y$10$pMDyv98zPP534wIQceiNLOaYHd4M6SoXM51bgWoQoPL0OO0WngI8q','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 05:01:06','2022-10-21 05:01:06'),
(24,4,4,'Dede Budhi Arta K','dedebudhiartak7@gmail.com','$2y$10$cuIybGCrWIYbHrlXY9uaK.B55373R2yhTRCxR/hQs/pPUOkug2bnS','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 05:03:24','2022-10-21 05:03:24'),
(25,4,4,'Dede Budhi Arta K','dedebudhiartak8@gmail.com','$2y$10$Dt0ssMTgZ9KbE2tNzgc/pOjSqW0x.7bFydLYRKN9.0OIAlCxyQhZ.','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 05:03:42','2022-10-21 05:03:42'),
(26,3,4,'Dede Budhi Arta K','dedebudhiartak9@gmail.com','$2y$10$vrvo74XweRInX.J2RxFqyeh7L56h..xc1krv1vH6ziXSoYTA8Mn6a','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 05:09:25','2022-10-21 05:09:25'),
(27,3,4,'Dede Budhi Arta K','dedebudhiartak10@gmail.com','$2y$10$En186gZs0t94PNaIpNO6oO7WwbxQD3PxOMSFmX.7NnXJ86oEiO5Ja','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 05:10:03','2022-10-21 05:10:03'),
(28,3,4,'Dede Budhi Arta K','dedebudhiartak11@gmail.com','$2y$10$rFqtZXMpVtPRnTlwv4vOoe5sqRtS7MjpegBc1hoWYhvO9pg4y952C','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 05:10:29','2022-10-21 05:10:29'),
(29,2,4,'Dede Budhi Arta K','dedebudhiartak12@gmail.com','$2y$10$RuGy1lSjbvCT6VWprmr6O.HqTe7AkP2VWl.FgCFh7/.8hMkAN7zey','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 05:23:04','2022-10-21 05:23:04'),
(30,1,4,'Dede Budhi Arta Kq','dedebudhiartak13@gmail.com','$2y$10$j90ab1R4Rlq2.eb4iTiRPeF4JY5O0sZZeh6fkoA65P2qCeFk06qwO','Jalan Waturenggong No 104',NULL,NULL,'2022-10-21 05:23:56','2022-10-21 05:23:56'),
(31,NULL,NULL,'Postman Budhi','postmanbudhi@gmail.com','1','waturenggong',NULL,NULL,'2022-11-09 07:26:10','2022-11-09 07:26:10'),
(32,NULL,NULL,'Budhi Flutter','asd2as@asd.com','1','a',NULL,NULL,'2022-11-09 10:18:23','2022-11-09 10:18:23'),
(33,NULL,NULL,'Budhi Flutter 2','asdasd@qewe.com','1','qwe',NULL,NULL,'2022-11-09 14:24:37','2022-11-09 14:24:37'),
(34,NULL,NULL,'Budhi Flutter 3','asdasd@qwew.com','1','23231',NULL,NULL,'2022-11-09 14:31:41','2022-11-09 14:31:41'),
(35,NULL,NULL,'Budhi Flutter 4','wewe@asd.com','1','adasd2',NULL,NULL,'2022-11-09 14:33:17','2022-11-09 14:33:17'),
(36,NULL,NULL,'Budhi Flutter 5','asdas@sds.com','1','sdadas',NULL,NULL,'2022-11-11 16:33:45','2022-11-11 16:33:45');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
