-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                5.7.37 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Versie:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Databasestructuur van jel_bestelt wordt geschreven
DROP DATABASE IF EXISTS `jel_bestelt`;
CREATE DATABASE IF NOT EXISTS `jel_bestelt` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `jel_bestelt`;

-- Structuur van  tabel jel_bestelt.berichten wordt geschreven
DROP TABLE IF EXISTS `berichten`;
CREATE TABLE IF NOT EXISTS `berichten` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `klant_id` int(10) unsigned DEFAULT NULL,
  `onderwerp` varchar(100) DEFAULT NULL,
  `bericht` varchar(256) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_berichten_users` (`klant_id`),
  CONSTRAINT `FK_berichten_users` FOREIGN KEY (`klant_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumpen data van tabel jel_bestelt.berichten: ~3 rows (ongeveer)
DELETE FROM `berichten`;
INSERT INTO `berichten` (`id`, `klant_id`, `onderwerp`, `bericht`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 3, 'test onderwerp', 'test bericht, ik ben een test bericht', '2025-02-06 14:08:35', '2025-02-06 14:08:08', NULL),
	(2, 1, 'test ow', 'asvdsfas', '2025-02-06 14:08:35', '2025-02-06 14:08:08', NULL),
	(3, 1, 'HELLO', 'Yes', '2025-02-07 16:06:10', '2025-02-07 16:06:10', NULL);

-- Structuur van  tabel jel_bestelt.bestellingen wordt geschreven
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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4;

-- Dumpen data van tabel jel_bestelt.bestellingen: ~5 rows (ongeveer)
DELETE FROM `bestellingen`;
INSERT INTO `bestellingen` (`id`, `klant_id`, `status`, `straat`, `huisnr`, `postcode`, `plaats`, `created_at`, `updated_at`, `deleted_at`, `kortingcode_id`) VALUES
	(77, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 12:41:57', '2025-02-06 12:41:57', NULL, 2),
	(78, 3, 'betaald', 'Teststraat', '100', '9999', 'testplaats2', '2025-02-06 20:34:10', '2025-02-06 20:34:10', NULL, 2),
	(79, 1, 'betaald', 'jadpos', '12', '1443MB', 'Purmerend', '2025-02-07 15:49:08', '2025-02-07 15:49:08', NULL, NULL),
	(80, 1, 'betaald', 'jadpos', '12', '1443MB', 'Purmerend', '2025-02-07 16:02:21', '2025-02-07 16:02:21', NULL, 1),
	(81, 1, 'betaald', 'jadpos', '12', '1443MB', 'Purmerend', '2025-02-07 16:04:15', '2025-02-07 16:04:15', NULL, 1);

-- Structuur van  tabel jel_bestelt.bestelregels wordt geschreven
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
  CONSTRAINT `FK_bestelregels_bestellingen` FOREIGN KEY (`bestelling_id`) REFERENCES `bestellingen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_bestelregels_kortingcodes` FOREIGN KEY (`kortingcode_id`) REFERENCES `kortingcodes` (`id`),
  CONSTRAINT `FK_bestelregels_producten` FOREIGN KEY (`product_id`) REFERENCES `producten` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumpen data van tabel jel_bestelt.bestelregels: ~5 rows (ongeveer)
DELETE FROM `bestelregels`;
INSERT INTO `bestelregels` (`bestelling_id`, `product_id`, `aantal`, `maat`, `prijs`, `totaalbedrag`, `kortingcode_id`) VALUES
	(77, 21, 1, 'xs', 20.00, 20.00, 2),
	(77, 22, 1, 'xs', 14.99, 14.99, 2),
	(78, 21, 2, 'm', 20.00, 39.99, 2),
	(79, 43, 2, 'l', 89.95, 179.90, NULL),
	(81, 43, 1, 'm', 71.96, 71.96, 1);

-- Structuur van  tabel jel_bestelt.kortingcodes wordt geschreven
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

-- Dumpen data van tabel jel_bestelt.kortingcodes: ~3 rows (ongeveer)
DELETE FROM `kortingcodes`;
INSERT INTO `kortingcodes` (`id`, `created_at`, `updated_at`, `deleted_at`, `percentage`, `code`) VALUES
	(1, '2025-01-31 17:15:48', '2025-01-31 17:16:57', NULL, 20, 'korting20'),
	(2, '2025-02-04 15:43:07', '2025-02-04 15:43:07', NULL, 50, 'korting50'),
	(3, '2025-02-05 09:45:10', '2025-02-05 09:45:10', NULL, 30, 'korting30');

-- Structuur van  tabel jel_bestelt.producten wordt geschreven
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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4;

-- Dumpen data van tabel jel_bestelt.producten: ~42 rows (ongeveer)
DELETE FROM `producten`;
INSERT INTO `producten` (`id`, `naam`, `beschrijving`, `prijs`, `kleur`, `geslacht`, `type_id`, `afbeelding`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(21, 'Hoodie', 'Comfortabele hoodie voor dagelijks gebruik.', 49.99, 'zwart', 'unisex', 1, 'hoodie.jpg', '2025-02-03 07:26:37', '2025-02-07 11:13:54', NULL),
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
	(33, 'Trainingspak', 'Sportief trainingspak voor actieve dagen.', 69.95, 'grijs', 'unisex', 1, 'trainingspak.jpg', '2025-02-03 07:26:37', '2025-02-07 11:13:51', NULL),
	(34, 'Jumpsuit', 'Trendy jumpsuit voor casual of chique momenten.', 59.99, 'blauw', 'vrouw', 1, 'jumpsuit.jpg', '2025-02-03 07:26:37', '2025-02-07 11:14:03', NULL),
	(35, 'Cargo Broek', 'Stoere cargo broek met veel zakken.', 45.95, 'blauw', 'vrouw', 1, 'cargo.jpg', '2025-02-03 07:26:37', '2025-02-07 11:14:16', NULL),
	(36, 'Gilet', 'Elegant gilet voor formele outfits.', 39.95, 'blauw', 'man', 1, 'gilet.jpg', '2025-02-03 07:26:37', '2025-02-07 14:31:46', NULL),
	(37, 'Pyjama', 'Comfortabele pyjama voor een goede nachtrust.', 24.95, 'zwart', 'unisex', 1, 'pyjama.jpg', '2025-02-03 07:26:37', '2025-02-07 14:31:52', NULL),
	(38, 'Sokken', 'Set van 5 paar katoenen sokken.', 9.99, 'grijs', 'unisex', 1, 'sokken.jpg', '2025-02-03 07:26:37', '2025-02-07 14:31:59', NULL),
	(39, 'Ondergoed', 'Comfortabel ondergoed van katoen.', 14.95, 'wit', 'vrouw', 1, 'ondergoed.jpg', '2025-02-03 07:26:37', '2025-02-07 14:32:11', NULL),
	(40, 'Handschoenen', 'Warme handschoenen voor de winter.', 19.99, 'zwart', 'unisex', 1, 'handschoenen.jpg', '2025-02-03 07:26:37', '2025-02-07 11:15:49', NULL),
	(41, 'Muts', 'Gebreide muts voor koude dagen.', 12.99, 'blauw', 'unisex', 1, 'muts.jpg', '2025-02-03 07:26:37', '2025-02-07 14:32:14', NULL),
	(42, 'Sjaal', 'Zachte wollen sjaal voor extra warmte.', 24.95, 'rood', 'unisex', 1, 'sjaal.jpg', '2025-02-03 07:26:37', '2025-02-07 11:16:29', NULL),
	(43, 'Blazer', 'Nette blazer voor zakelijke gelegenheden.', 89.95, 'zwart', 'man', 1, 'blazer.jpg', '2025-02-03 07:26:37', '2025-02-07 11:16:45', NULL),
	(44, 'Tanktops', 'Set van 3 basic tanktops.', 19.99, 'wit', 'vrouw', 1, 'tanktops.jpg', '2025-02-03 07:26:37', '2025-02-07 14:32:23', NULL),
	(45, 'Regenjas', 'Waterdichte regenjas voor natte dagen.', 79.99, 'rood', 'unisex', 1, 'regenjas.jpg', '2025-02-03 07:26:37', '2025-02-07 11:17:22', NULL),
	(46, 'Strandjurk', 'Lichte strandjurk voor zomervakanties.', 29.99, 'groen', 'vrouw', 1, 'strandjurk.jpg', '2025-02-03 07:26:37', '2025-02-07 11:17:32', NULL),
	(47, 'Broekpak', 'Elegant broekpak voor formele gelegenheden.', 99.95, 'rood', 'vrouw', 1, 'broekpak.jpg', '2025-02-03 07:26:37', '2025-02-07 11:17:40', NULL),
	(48, 'Legging', 'Elastische legging voor sport en casual outfits.', 22.95, 'roze', 'vrouw', 1, 'legging.jpg', '2025-02-03 07:26:37', '2025-02-07 11:17:49', NULL),
	(49, 'Kostuum', 'Compleet kostuum voor zakelijke en formele gelegenheden.', 149.99, 'blauw', 'man', 1, 'kostuum.jpg', '2025-02-03 07:26:37', '2025-02-07 14:32:35', NULL),
	(65, 'Maxi Jurk', 'Lange en elegante jurk voor speciale gelegenheden.', 79.99, NULL, 'vrouw', 1, 'maxi_jurk.jpg', '2025-02-07 13:08:24', '2025-02-07 13:08:24', NULL),
	(66, 'Blouse met Kant', 'Luchtige blouse met kanten details.', 39.95, NULL, 'vrouw', 1, 'blouse_kant.jpg', '2025-02-07 13:08:24', '2025-02-07 13:08:24', NULL),
	(67, 'Denim Rok', 'Trendy spijkerrok met knoopsluiting.', 44.99, NULL, 'vrouw', 1, 'denim_rok.jpg', '2025-02-07 13:08:24', '2025-02-07 13:08:24', NULL),
	(68, 'Flared Broek', 'Modieuze flared broek met hoge taille.', 49.99, NULL, 'vrouw', 1, 'flared_broek.jpg', '2025-02-07 13:08:24', '2025-02-07 13:08:24', NULL),
	(71, 'Poncho', 'Warme poncho met franjes.', 39.99, NULL, 'unisex', 1, 'poncho.jpg', '2025-02-07 13:08:24', '2025-02-07 13:08:24', NULL),
	(72, 'Satijnen Nachtjapon', 'Elegante satijnen nachtjapon.', 54.99, NULL, 'vrouw', 1, 'satijn_nachtjapon.jpg', '2025-02-07 13:08:24', '2025-02-07 13:08:24', NULL),
	(73, 'Linnen Overhemd', 'Casual linnen overhemd voor warme dagen.', 42.95, NULL, 'man', 1, 'linnen_overhemd.jpg', '2025-02-07 13:08:24', '2025-02-07 13:08:24', NULL),
	(75, 'Ribgebreide Trui', 'Warme ribgebreide trui voor koude dagen.', 49.95, NULL, 'unisex', 1, 'rib_trui.jpg', '2025-02-07 13:08:24', '2025-02-07 13:08:24', NULL),
	(76, 'Sportlegging', 'Elastische sportlegging met compressie.', 39.99, NULL, 'unisex', 1, 'sportlegging.jpg', '2025-02-07 13:08:24', '2025-02-07 13:08:24', NULL),
	(77, 'Espadrilles', 'Lichte zomerse schoenen met touwzool.', 59.99, NULL, 'unisex', 1, 'espadrilles.jpg', '2025-02-07 13:08:24', '2025-02-07 13:08:24', NULL),
	(78, 'Gala Jurk', 'Chique gala jurk met glitters.', 129.99, NULL, 'vrouw', 1, 'gala_jurk.jpg', '2025-02-07 13:08:24', '2025-02-07 13:08:24', NULL),
	(79, 'Corduroy Jas', 'Trendy corduroy jas met knopen.', 74.99, NULL, 'man', 1, 'corduroy_jas.jpg', '2025-02-07 13:08:24', '2025-02-07 13:08:24', NULL),
	(80, 'Teddy Jas', 'Zachte en warme teddy jas voor koude dagen.', 89.99, NULL, 'vrouw', 1, 'teddy_jas.jpg', '2025-02-07 13:45:55', '2025-02-07 14:31:35', NULL);

-- Structuur van  tabel jel_bestelt.reactie wordt geschreven
DROP TABLE IF EXISTS `reactie`;
CREATE TABLE IF NOT EXISTS `reactie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bericht_id` int(11) DEFAULT NULL,
  `reactie` varchar(256) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_reactie_berichten` (`bericht_id`),
  CONSTRAINT `FK_reactie_berichten` FOREIGN KEY (`bericht_id`) REFERENCES `berichten` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumpen data van tabel jel_bestelt.reactie: ~2 rows (ongeveer)
DELETE FROM `reactie`;
INSERT INTO `reactie` (`id`, `bericht_id`, `reactie`, `created_at`) VALUES
	(1, 2, 'dit is een test reactie', '2025-02-06 15:04:20'),
	(6, 1, 'test6', '2025-02-06 15:14:34');

-- Structuur van  tabel jel_bestelt.types wordt geschreven
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

-- Dumpen data van tabel jel_bestelt.types: ~2 rows (ongeveer)
DELETE FROM `types`;
INSERT INTO `types` (`id`, `type`, `afkorting`, `beschrijving`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Kleding', 'KLD', 'Kleding en accessoires', '2025-01-12 13:14:07', '2025-01-12 13:14:07', NULL),
	(2, 'Kleding', 'KLD', 'Kleding en accessoires', '2025-01-12 13:15:23', '2025-01-12 13:15:23', NULL);

-- Structuur van  tabel jel_bestelt.users wordt geschreven
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

-- Dumpen data van tabel jel_bestelt.users: ~18 rows (ongeveer)
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
	(43, 'user9@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Laura Janse', 'Spoorlaan', '50', '9012QR', 'Breda', 'klant', '2025-02-03 19:39:26', '2025-02-06 20:36:25', NULL),
	(44, 'user10@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dennis Vermeer', 'Kanaalstraat', '3', '0123ST', 'Maastricht', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(45, 'user11@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sophie van Dam', 'Bomenlaan', '27', '1234UV', 'Amersfoort', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(46, 'user12@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hugo de Boer', 'Merwedestraat', '7', '2345WX', 'Zwolle', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(47, 'user13@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Daan Meijer', 'Havenstraat', '15', '3456YZ', 'Delft', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(48, 'user14@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Mila Kuipers', 'Bosweg', '21', '4567AB', 'Arnhem', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(49, 'user15@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ruben Jacobs', 'Vlietstraat', '33', '5678CD', 'Tilburg', 'klant', '2025-02-03 19:39:26', '2025-02-03 19:39:26', NULL),
	(50, 'hicham@mail.nl', '$2y$10$yNCPhsQy6Ug2Ex4p/4lF9eq18IdYsDOUC3EWa/ivBm2Lzq3uN08/.', 'Hicham Akhajjam', 'scho', '1', '1444', 'purmerend', 'klant', '2025-02-05 10:11:23', '2025-02-06 10:38:17', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
