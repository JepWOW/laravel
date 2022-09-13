-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.18-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table exam1.item_masters
CREATE TABLE IF NOT EXISTS `item_masters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_masters_item_types` (`type_id`),
  CONSTRAINT `FK_item_masters_item_types` FOREIGN KEY (`type_id`) REFERENCES `item_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table exam1.item_masters: ~5 rows (approximately)
/*!40000 ALTER TABLE `item_masters` DISABLE KEYS */;
INSERT INTO `item_masters` (`id`, `type_id`, `code`, `description`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'ITEM 1', 'ITEM1 DESC', 1, '2021-10-13 21:33:08', NULL, NULL),
	(2, 1, 'ITEM 2', 'ITEM2 DESC', 1, '2021-10-13 21:33:38', NULL, NULL),
	(3, 2, 'ITEM 3', 'ITEM3 DESC', 1, '2021-10-13 21:33:52', NULL, NULL),
	(4, 3, 'test1', 'test1 test1', 1, '2021-10-16 13:05:41', '2021-10-16 15:37:51', '2021-10-16 15:37:51'),
	(5, 3, 'type 2 item master 1', 'type1 item master 1 desc', 1, '2021-10-18 09:03:03', '2021-10-18 09:05:58', '2021-10-18 09:05:58');
/*!40000 ALTER TABLE `item_masters` ENABLE KEYS */;

-- Dumping structure for table exam1.item_types
CREATE TABLE IF NOT EXISTS `item_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table exam1.item_types: ~5 rows (approximately)
/*!40000 ALTER TABLE `item_types` DISABLE KEYS */;
INSERT INTO `item_types` (`id`, `code`, `description`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'FF', 'Firefly', 1, '2021-10-13 19:09:12', '2021-10-18 08:49:31', NULL),
	(2, 'RU', 'ROYU', 1, '2021-10-13 21:32:20', NULL, NULL),
	(3, 'test1', 'desc1', 1, '2021-10-16 12:59:33', '2021-10-18 09:06:01', '2021-10-18 09:06:01'),
	(4, 'test2', 'desc2', 1, '2021-10-16 15:28:23', '2021-10-16 15:35:59', '2021-10-16 15:35:59'),
	(5, 'Type2', 'Type1 Desc', 1, '2021-10-18 09:02:44', '2021-10-18 09:03:44', NULL);
/*!40000 ALTER TABLE `item_types` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
