-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.37 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for jel_bestelt
DROP DATABASE IF EXISTS `jel_bestelt`;
CREATE DATABASE IF NOT EXISTS `jel_bestelt` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `jel_bestelt`;

-- Dumping structure for table jel_bestelt.bestellingen
DROP TABLE IF EXISTS `bestellingen`;
CREATE TABLE IF NOT EXISTS `bestellingen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `klant_id` int(10) unsigned DEFAULT NULL COMMENT 'Verwijzing naar user_id',
  `status` enum('aangemaakt','betaald','verzonden','afgehandeld','verwijderd') DEFAULT 'aangemaakt',
  `straat` varchar(100) DEFAULT NULL COMMENT 'Adres voor bezorging',
  `huisnr` varchar(20) DEFAULT NULL COMMENT 'Adres voor bezorging',
  `postcode` varchar(7) DEFAULT NULL COMMENT 'Adres voor bezorging',
  `plaats` varchar(100) DEFAULT NULL COMMENT 'Adres voor bezorging',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `kortingcode_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bestellingen_users` (`klant_id`),
  KEY `FK_bestellingen_kortingcodes` (`kortingcode_id`),
  CONSTRAINT `FK_bestellingen_kortingcodes` FOREIGN KEY (`kortingcode_id`) REFERENCES `kortingcodes` (`id`),
  CONSTRAINT `FK_bestellingen_users` FOREIGN KEY (`klant_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_klant_bestelling` FOREIGN KEY (`klant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table jel_bestelt.bestellingen: ~32 rows (approximately)
DELETE FROM `bestellingen`;
INSERT INTO `bestellingen` (`id`, `klant_id`, `status`, `straat`, `huisnr`, `postcode`, `plaats`, `created_at`, `updated_at`, `deleted_at`, `kortingcode_id`) VALUES
	(41, 3, 'verwijderd', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-03 18:29:32', '2025-02-05 09:44:11', '2025-02-05 09:44:11', 1),
	(42, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-03 18:30:51', '2025-02-03 18:30:51', NULL, 1),
	(43, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-03 19:04:15', '2025-02-03 19:04:15', NULL, NULL),
	(44, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-04 14:41:10', '2025-02-04 14:41:10', NULL, 1),
	(45, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-04 15:18:22', '2025-02-04 15:18:22', NULL, 1),
	(46, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-04 15:18:57', '2025-02-04 15:18:57', NULL, 1),
	(47, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-04 15:25:29', '2025-02-04 15:25:29', NULL, 1),
	(48, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-04 15:31:55', '2025-02-04 15:31:55', NULL, 1),
	(49, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-04 15:40:19', '2025-02-04 15:40:19', NULL, 1),
	(50, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-04 15:41:27', '2025-02-04 15:41:27', NULL, 1),
	(51, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-04 15:44:20', '2025-02-04 15:44:20', NULL, 2),
	(52, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-04 15:47:46', '2025-02-04 15:47:46', NULL, NULL),
	(53, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-04 15:50:51', '2025-02-04 15:50:51', NULL, NULL),
	(54, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-04 15:55:58', '2025-02-04 15:55:58', NULL, NULL),
	(55, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-05 09:41:46', '2025-02-05 09:41:46', NULL, NULL),
	(56, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-05 09:46:05', '2025-02-05 09:46:05', NULL, NULL),
	(57, 50, 'betaald', 'school', '1', '1444', 'purmerend', '2025-02-05 10:13:34', '2025-02-05 10:13:34', NULL, NULL),
	(58, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-05 10:36:44', '2025-02-05 10:36:44', NULL, NULL),
	(59, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-05 10:40:57', '2025-02-05 10:40:57', NULL, NULL),
	(60, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-05 10:47:04', '2025-02-05 10:47:04', NULL, NULL),
	(61, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-05 11:16:54', '2025-02-05 11:16:54', NULL, NULL),
	(62, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-05 11:44:36', '2025-02-05 11:44:36', NULL, NULL),
	(63, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-05 11:46:16', '2025-02-05 11:46:16', NULL, NULL),
	(64, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 09:12:13', '2025-02-06 09:12:13', NULL, NULL),
	(65, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 09:19:00', '2025-02-06 09:19:00', NULL, NULL),
	(66, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 09:22:26', '2025-02-06 09:22:26', NULL, NULL),
	(67, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 09:24:18', '2025-02-06 09:24:18', NULL, NULL),
	(68, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 09:25:51', '2025-02-06 09:25:51', NULL, NULL),
	(69, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 09:27:15', '2025-02-06 09:27:15', NULL, NULL),
	(70, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 09:30:08', '2025-02-06 09:30:08', NULL, NULL),
	(71, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 09:35:08', '2025-02-06 09:35:08', NULL, NULL),
	(72, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 09:58:16', '2025-02-06 09:58:16', NULL, NULL),
	(73, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 10:04:09', '2025-02-06 10:04:09', NULL, NULL),
	(74, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 10:06:01', '2025-02-06 10:06:01', NULL, NULL);

-- Dumping structure for table jel_bestelt.bestelregels
DROP TABLE IF EXISTS `bestelregels`;
CREATE TABLE IF NOT EXISTS `bestelregels` (
  `bestelling_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `aantal` int(11) DEFAULT NULL,
  `maat` enum('xs','s','m','l','xl') DEFAULT NULL,
  `prijs` float(6,2) unsigned NOT NULL DEFAULT '0.00',
  `totaalbedrag` float(8,2) unsigned NOT NULL DEFAULT '0.00',
  `kortingcode_id` int(10) unsigned DEFAULT NULL COMMENT 'Hiermee zou je een product als aanbieding kunnen doen',
  PRIMARY KEY (`bestelling_id`,`product_id`) USING BTREE,
  KEY `FK_bestelregels_etenswaren` (`product_id`) USING BTREE,
  KEY `FK_bestelregels_kortingcodes` (`kortingcode_id`),
  CONSTRAINT `FK_bestelregels_bestellingen` FOREIGN KEY (`bestelling_id`) REFERENCES `bestellingen` (`id`),
  CONSTRAINT `FK_bestelregels_kortingcodes` FOREIGN KEY (`kortingcode_id`) REFERENCES `kortingcodes` (`id`),
  CONSTRAINT `FK_bestelregels_producten` FOREIGN KEY (`product_id`) REFERENCES `producten` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table jel_bestelt.bestelregels: ~14 rows (approximately)
DELETE FROM `bestelregels`;
INSERT INTO `bestelregels` (`bestelling_id`, `product_id`, `aantal`, `maat`, `prijs`, `totaalbedrag`, `kortingcode_id`) VALUES
	(41, 24, NULL, NULL, 79.96, 0.00, NULL),
	(42, 25, 1, NULL, 39.99, 75.95, 1),
	(42, 26, 1, NULL, 35.96, 75.95, 1),
	(43, 22, 1, NULL, 29.99, 29.99, NULL),
	(44, 21, 1, NULL, 39.99, 69.98, 1),
	(44, 22, 1, NULL, 29.99, 69.98, 1),
	(45, 21, 1, NULL, 39.99, 39.99, 1),
	(46, 21, 1, NULL, 39.99, 39.99, 1),
	(47, 21, 1, NULL, 39.99, 39.99, 1),
	(48, 22, 1, NULL, 29.99, 29.99, 1),
	(50, 21, 1, NULL, 31.99, 31.99, 1),
	(51, 22, 1, NULL, 14.99, 14.99, 2),
	(52, 22, 1, NULL, 29.99, 29.99, NULL),
	(72, 21, 2, 'xs', 39.99, 79.98, NULL),
	(73, 25, 1, 'l', 49.99, 49.99, NULL),
	(74, 31, 1, 's', 19.95, 19.95, NULL);

-- Dumping structure for table jel_bestelt.kortingcodes
DROP TABLE IF EXISTS `kortingcodes`;
CREATE TABLE IF NOT EXISTS `kortingcodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `percentage` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table jel_bestelt.kortingcodes: ~3 rows (approximately)
DELETE FROM `kortingcodes`;
INSERT INTO `kortingcodes` (`id`, `created_at`, `updated_at`, `deleted_at`, `percentage`, `code`) VALUES
	(1, '2025-01-31 17:15:48', '2025-01-31 17:16:57', NULL, 20, 'korting20'),
	(2, '2025-02-04 15:43:07', '2025-02-04 15:43:07', NULL, 50, 'korting50'),
	(3, '2025-02-05 09:45:10', '2025-02-05 09:45:10', NULL, 30, 'korting30');

-- Dumping structure for table jel_bestelt.producten
DROP TABLE IF EXISTS `producten`;
CREATE TABLE IF NOT EXISTS `producten` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naam` varchar(200) NOT NULL,
  `beschrijving` varchar(255) NOT NULL,
  `prijs` float(6,2) NOT NULL,
  `kleur` varchar(20) DEFAULT NULL,
  `geslacht` enum('man','vrouw','unisex') DEFAULT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `afbeelding` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_producten_types` (`type_id`),
  CONSTRAINT `FK_producten_types` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table jel_bestelt.producten: ~29 rows (approximately)
DELETE FROM `producten`;
INSERT INTO `producten` (`id`, `naam`, `beschrijving`, `prijs`, `kleur`, `geslacht`, `type_id`, `afbeelding`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(21, 'Hoodie', 'Comfortabele hoodie voor dagelijks gebruik.', 39.99, 'zwart', 'unisex', 1, 'hoodie.jpg', '2025-02-03 07:26:37', '2025-02-06 09:42:27', NULL),
	(22, 'Coltrui', 'Warme coltrui voor de winter.', 29.99, 'zwart', 'man', 1, 'coltrui.jpg', '2025-02-03 07:26:37', '2025-02-06 09:42:34', NULL),
	(23, 'Joggingbroek', 'Casual joggingbroek voor sport of ontspanning.', 34.95, 'grijs', 'unisex', 1, 'joggingbroek.jpg', '2025-02-03 07:26:37', '2025-02-06 09:42:39', NULL),
	(24, 'Parka', 'Stijlvolle parka voor koude dagen.', 99.95, 'groen', 'man', 1, 'parka.jpg', '2025-02-03 07:26:37', '2025-02-06 09:42:42', NULL),
	(25, 'Bodywarmer', 'Lichte bodywarmer voor extra warmte.', 49.99, 'zwart', 'unisex', 1, 'bodywarmer.jpg', '2025-02-03 07:26:37', '2025-02-06 09:42:47', NULL),
	(26, 'Vest', 'Fijn gebreid vest voor extra comfort.', 44.95, 'beige', 'vrouw', 1, 'vest.jpg', '2025-02-03 07:26:37', '2025-02-06 09:43:03', NULL),
	(27, 'Leren Jas', 'Stoere leren jas voor een modieuze look.', 129.99, 'zwart', 'man', 1, 'leren_jas.jpg', '2025-02-03 07:26:37', '2025-02-06 09:43:08', NULL),
	(28, 'Polo Shirt', 'Casual polo shirt voor een nette uitstraling.', 24.99, 'blauw', 'vrouw', 1, 'polo.jpg', '2025-02-03 07:26:37', '2025-02-06 09:43:12', NULL),
	(29, 'Chino Broek', 'Stijlvolle chino broek voor een nette look.', 39.99, 'beige', 'unisex', 1, 'chino.jpg', '2025-02-03 07:26:37', '2025-02-06 09:43:17', NULL),
	(30, 'Winterjas', 'Dikke winterjas voor extreme kou.', 149.99, 'zwart', 'man', 1, 'winterjas.jpg', '2025-02-03 07:26:37', '2025-02-06 09:43:20', NULL),
	(31, 'Zwemshort', 'Zwemshort voor zomerse dagen.', 19.95, 'blauw', 'man', 1, 'zwemshort.jpg', '2025-02-03 07:26:37', '2025-02-06 09:43:24', NULL),
	(32, 'Overhemd', 'Net overhemd voor zakelijke gelegenheden.', 34.95, 'wit', 'man', 1, 'overhemd.jpg', '2025-02-03 07:26:37', '2025-02-06 09:44:57', NULL),
	(33, 'Trainingspak', 'Sportief trainingspak voor actieve dagen.', 69.95, NULL, NULL, 1, 'trainingspak.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(34, 'Jumpsuit', 'Trendy jumpsuit voor casual of chique momenten.', 59.99, NULL, NULL, 1, 'jumpsuit.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(35, 'Cargo Broek', 'Stoere cargo broek met veel zakken.', 45.95, NULL, NULL, 1, 'cargo.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(36, 'Gilet', 'Elegant gilet voor formele outfits.', 39.95, NULL, NULL, 1, 'gilet.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(37, 'Pyjama', 'Comfortabele pyjama voor een goede nachtrust.', 24.95, NULL, NULL, 1, 'pyjama.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(38, 'Sokken', 'Set van 5 paar katoenen sokken.', 9.99, NULL, NULL, 1, 'sokken.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(39, 'Ondergoed', 'Comfortabel ondergoed van katoen.', 14.95, NULL, NULL, 1, 'ondergoed.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(40, 'Handschoenen', 'Warme handschoenen voor de winter.', 19.99, NULL, NULL, 1, 'handschoenen.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(41, 'Muts', 'Gebreide muts voor koude dagen.', 12.99, NULL, NULL, 1, 'muts.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(42, 'Sjaal', 'Zachte wollen sjaal voor extra warmte.', 24.95, NULL, NULL, 1, 'sjaal.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(43, 'Blazer', 'Nette blazer voor zakelijke gelegenheden.', 89.95, NULL, NULL, 1, 'blazer.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(44, 'Tanktops', 'Set van 3 basic tanktops.', 19.99, NULL, NULL, 1, 'tanktops.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(45, 'Regenjas', 'Waterdichte regenjas voor natte dagen.', 79.99, NULL, NULL, 1, 'regenjas.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(46, 'Strandjurk', 'Lichte strandjurk voor zomervakanties.', 29.99, NULL, NULL, 1, 'strandjurk.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(47, 'Broekpak', 'Elegant broekpak voor formele gelegenheden.', 99.95, NULL, NULL, 1, 'broekpak.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(48, 'Legging', 'Elastische legging voor sport en casual outfits.', 22.95, NULL, NULL, 1, 'legging.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL),
	(49, 'Kostuum', 'Compleet kostuum voor zakelijke en formele gelegenheden.', 149.99, NULL, NULL, 1, 'kostuum.jpg', '2025-02-03 07:26:37', '2025-02-03 07:26:37', NULL);

-- Dumping structure for table jel_bestelt.types
DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `afkorting` varchar(10) DEFAULT NULL,
  `beschrijving` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table jel_bestelt.types: ~2 rows (approximately)
DELETE FROM `types`;
INSERT INTO `types` (`id`, `type`, `afkorting`, `beschrijving`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Kleding', 'KLD', 'Kleding en accessoires', '2025-01-12 13:14:07', '2025-01-12 13:14:07', NULL),
	(2, 'Kleding', 'KLD', 'Kleding en accessoires', '2025-01-12 13:15:23', '2025-01-12 13:15:23', NULL);

-- Dumping structure for table jel_bestelt.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `straat` varchar(100) DEFAULT NULL,
  `huisnr` varchar(20) DEFAULT NULL,
  `postcode` varchar(7) DEFAULT NULL,
  `plaats` varchar(100) DEFAULT NULL,
  `role` enum('klant','admin','medewerker') DEFAULT 'klant',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table jel_bestelt.users: ~18 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `email`, `password`, `name`, `straat`, `huisnr`, `postcode`, `plaats`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'admin@jel-bestelt.nl', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', NULL, NULL, NULL, NULL, 'admin', '2025-02-03 16:25:08', '2025-02-03 16:25:26', NULL),
	(3, 'john.doe@gmail.com', '$2y$10$G3TVefEDoo.n7pXd/hvWDeWtS3hKCsoffF/bm5HqfWiLsmXgJ5VNu', 'John Doe', 'Teststraat', '100', '9999', 'testplaats2', 'klant', '2023-11-07 08:27:24', '2025-02-03 19:57:38', NULL),
	(35, 'medewerker@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jan Jansen', '(NULL)', '(NULL)', '(NULL)', '(NULL)', 'medewerker', '2025-02-03 19:39:26', '2025-02-03 19:52:02', NULL),
	(36, 'user2@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Piet Pietersen', 'Hoofdweg', '22', '2345CD', 'Rotterdam', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:51:44', NULL),
	(37, 'user3@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Klaas Klaassen', 'Kerkstraat', '5', '3456EF', 'Utrecht', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(38, 'user4@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lisa de Vries', 'Marktplein', '12', '4567GH', 'Den Haag', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(39, 'user5@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Eva Bak', 'Bergweg', '8', '5678IJ', 'Eindhoven', 'klant', '2025-02-03 19:39:26', '2025-02-05 09:44:34', NULL),
	(40, 'user6@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Tom Smit', 'Lindelaan', '30', '6789KL', 'Groningen', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(41, 'user7@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sanne Visser', 'Zeeweg', '45', '7890MN', 'Haarlem', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(42, 'user8@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Mark de Groot', 'Dijkstraat', '18', '8901OP', 'Leiden', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(43, 'user9@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Laura Jansen', 'Spoorlaan', '50', '9012QR', 'Breda', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(44, 'user10@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dennis Vermeer', 'Kanaalstraat', '3', '0123ST', 'Maastricht', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(45, 'user11@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sophie van Dam', 'Bomenlaan', '27', '1234UV', 'Amersfoort', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(46, 'user12@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hugo de Boer', 'Merwedestraat', '7', '2345WX', 'Zwolle', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(47, 'user13@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Daan Meijer', 'Havenstraat', '15', '3456YZ', 'Delft', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(48, 'user14@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Mila Kuipers', 'Bosweg', '21', '4567AB', 'Arnhem', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(49, 'user15@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ruben Jacobs', 'Vlietstraat', '33', '5678CD', 'Tilburg', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(50, 'hicham@mail.nl', '$2y$10$yNCPhsQy6Ug2Ex4p/4lF9eq18IdYsDOUC3EWa/ivBm2Lzq3uN08/.', 'Hicham Akhajjam', 'scho', '1', '1444', 'purmerend', 'klant', '2025-02-05 10:11:23', '2025-02-05 10:14:52', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
