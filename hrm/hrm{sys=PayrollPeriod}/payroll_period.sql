-- --------------------------------------------------------
-- Host:                         hris.pralon.co.id
-- Server version:               10.3.39-MariaDB - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table pralonco_hris_dev.pay_period
CREATE TABLE IF NOT EXISTS `pay_period` (
  `period_id` varchar(50) NOT NULL,
  `period_name` varchar(50) DEFAULT NULL,
  `pay_date` datetime DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `interval_period` enum('Y','M','D') DEFAULT 'M',
  `status` enum('0','1') DEFAULT '1',
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`period_id`),
  KEY `Index 2` (`pay_date`,`period_id`,`end_date`,`start_date`,`period_name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table pralonco_hris_dev.pay_period: 2 rows
/*!40000 ALTER TABLE `pay_period` DISABLE KEYS */;
INSERT IGNORE INTO `pay_period` (`period_id`, `period_name`, `pay_date`, `start_date`, `end_date`, `interval_period`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
	('MTH01', 'Monthly Process', '2023-02-25 00:00:00', '2023-01-16 00:00:00', '2023-02-15 00:00:00', 'M', '1', '100138', '2023-03-10 02:12:37', '100138', '2023-05-12 09:47:26'),
	('HRIS', 'HRIS DEV', '2023-04-17 00:00:00', '2023-04-17 00:00:00', '2023-04-17 00:00:00', 'D', '0', '100138', '2023-04-17 08:40:15', '100138', '2023-05-29 01:43:41');
/*!40000 ALTER TABLE `pay_period` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
