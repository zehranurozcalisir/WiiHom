-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 29, 2023 at 01:29 PM
-- Server version: 8.0.31
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wihom`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `update_sensortetik`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_sensortetik` (IN `deger_value` INT)   BEGIN
    DECLARE tetik_value INT;

    IF deger_value > 30 THEN
        SET tetik_value = 1;
    ELSE
        SET tetik_value = 0;
    END IF;

    UPDATE sensortetik
    SET deger = deger_value,
        tetik = tetik_value
    WHERE id = 1; -- Burada gerekli olan id değerini kullanmalısınız
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `genel_elektrik`
--

DROP TABLE IF EXISTS `genel_elektrik`;
CREATE TABLE IF NOT EXISTS `genel_elektrik` (
  `id` int NOT NULL,
  `durum` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Dumping data for table `genel_elektrik`
--

INSERT INTO `genel_elektrik` (`id`, `durum`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `odalar`
--

DROP TABLE IF EXISTS `odalar`;
CREATE TABLE IF NOT EXISTS `odalar` (
  `oda_id` int NOT NULL AUTO_INCREMENT,
  `odalar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`oda_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Dumping data for table `odalar`
--

INSERT INTO `odalar` (`oda_id`, `odalar`) VALUES
(1, 'Yatak Odası'),
(2, 'Çocuk Odası'),
(3, 'Bodrum'),
(4, 'Koridor');

-- --------------------------------------------------------

--
-- Table structure for table `senaryolar`
--

DROP TABLE IF EXISTS `senaryolar`;
CREATE TABLE IF NOT EXISTS `senaryolar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `senaryolar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `durum` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Dumping data for table `senaryolar`
--

INSERT INTO `senaryolar` (`id`, `senaryolar`, `durum`) VALUES
(1, 'Lamba Durumu', 0),
(2, 'Mevcut Durum', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sensorler`
--

DROP TABLE IF EXISTS `sensorler`;
CREATE TABLE IF NOT EXISTS `sensorler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sensor` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Dumping data for table `sensorler`
--

INSERT INTO `sensorler` (`id`, `sensor`) VALUES
(1, 'Taşkın'),
(2, 'Hareket'),
(3, 'Sıcaklık');

-- --------------------------------------------------------

--
-- Table structure for table `sensortetik`
--

DROP TABLE IF EXISTS `sensortetik`;
CREATE TABLE IF NOT EXISTS `sensortetik` (
  `id` int NOT NULL,
  `sensor_id` int NOT NULL,
  `oda_id` int NOT NULL,
  `deger` int NOT NULL,
  `tetik` int NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `borderColor` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sensor_id` (`sensor_id`),
  KEY `oda_id` (`oda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Dumping data for table `sensortetik`
--

INSERT INTO `sensortetik` (`id`, `sensor_id`, `oda_id`, `deger`, `tetik`, `img`, `borderColor`) VALUES
(1, 3, 1, 24, 0, 'assests/img/pngwing.com.png', '#CCCCCC'),
(2, 1, 3, 22, 0, 'assests/img/haraket.png', '#CCCCCC'),
(3, 2, 4, 32, 1, 'assests/img/haraket.png', '#f34236');

--
-- Triggers `sensortetik`
--
DROP TRIGGER IF EXISTS `update_triggeree`;
DELIMITER $$
CREATE TRIGGER `update_triggeree` BEFORE UPDATE ON `sensortetik` FOR EACH ROW BEGIN
    DECLARE tetik INT;
    DECLARE borderColor VARCHAR(7);

    IF NEW.deger > 30 THEN
        SET tetik = 1;
        SET borderColor = '#f34236';
    ELSE
        SET tetik = 0;
        SET borderColor = '#CCCCCC';
    END IF;

    SET NEW.tetik = tetik;
    SET NEW.borderColor = borderColor;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sicaklik`
--

DROP TABLE IF EXISTS `sicaklik`;
CREATE TABLE IF NOT EXISTS `sicaklik` (
  `sicaklik_id` int NOT NULL,
  `mevcut_sicaklik` int NOT NULL,
  `istenilen_sicaklik` float NOT NULL,
  `oda_id` int NOT NULL,
  KEY `oda_id` (`oda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Dumping data for table `sicaklik`
--

INSERT INTO `sicaklik` (`sicaklik_id`, `mevcut_sicaklik`, `istenilen_sicaklik`, `oda_id`) VALUES
(1, 25, 15.5, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sensortetik`
--
ALTER TABLE `sensortetik`
  ADD CONSTRAINT `odaa` FOREIGN KEY (`oda_id`) REFERENCES `odalar` (`oda_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sensor` FOREIGN KEY (`sensor_id`) REFERENCES `sensorler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sicaklik`
--
ALTER TABLE `sicaklik`
  ADD CONSTRAINT `oda_id` FOREIGN KEY (`oda_id`) REFERENCES `odalar` (`oda_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
