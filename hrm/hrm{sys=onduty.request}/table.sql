-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.26 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table dbhr_sfbiznet_training.hrdondutycancelrequest
CREATE TABLE IF NOT EXISTS `hrdondutycancelrequest` (
  `request_no` varchar(50) NOT NULL,
  `onduty_reqno` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `requestedby` varchar(50) DEFAULT NULL,
  `requestfor` varchar(50) DEFAULT NULL,
  `requestdate` datetime DEFAULT NULL,
  `purpose_code` varchar(50) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`request_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbhr_sfbiznet_training.hrdondutycancelrequest: ~0 rows (approximately)
INSERT IGNORE INTO `hrdondutycancelrequest` (`request_no`, `onduty_reqno`, `company_id`, `requestedby`, `requestfor`, `requestdate`, `purpose_code`, `remark`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
	('ODCR2018100002', 'ODR-2018-10-0004273', 13576, 'DO177712', 'DO1711160', '2018-10-18 00:00:00', 'KLKTM', 'Pergantian personil yang tugas', '13-0495', '2018-10-18 16:29:15', '13-0495', '2018-10-18 16:29:15');

-- Dumping structure for table dbhr_sfbiznet_training.hrdondutydeclaration
CREATE TABLE IF NOT EXISTS `hrdondutydeclaration` (
  `request_no` varchar(50) NOT NULL,
  `onduty_reqno` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `requestedby` varchar(50) DEFAULT NULL,
  `requestfor` varchar(50) DEFAULT NULL,
  `requestdate` datetime DEFAULT NULL,
  `purpose_code` varchar(50) NOT NULL,
  `total_destination` int(11) NOT NULL,
  `remark` longtext,
  `created_by` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_date` datetime NOT NULL,
  `upload_filename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`company_id`,`request_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbhr_sfbiznet_training.hrdondutydeclaration: ~0 rows (approximately)

-- Dumping structure for table dbhr_sfbiznet_training.hrdondutydeclarationdtl
CREATE TABLE IF NOT EXISTS `hrdondutydeclarationdtl` (
  `request_no` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `destination_no` int(11) NOT NULL,
  `destination_code` varchar(50) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`company_id`,`destination_no`,`request_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbhr_sfbiznet_training.hrdondutydeclarationdtl: ~0 rows (approximately)

-- Dumping structure for table dbhr_sfbiznet_training.hrdondutydeclarationdtl_atd
CREATE TABLE IF NOT EXISTS `hrdondutydeclarationdtl_atd` (
  `request_no` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `destination_no` int(11) NOT NULL,
  `attend_date` datetime NOT NULL,
  `shiftdailycode` varchar(50) NOT NULL,
  `shiftstarttime` datetime NOT NULL,
  `shiftendtime` datetime NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_date` datetime NOT NULL,
  `other_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`attend_date`,`company_id`,`destination_no`,`request_no`,`shiftdailycode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbhr_sfbiznet_training.hrdondutydeclarationdtl_atd: ~0 rows (approximately)

-- Dumping structure for table dbhr_sfbiznet_training.hrdondutydeclarationdtl_item
CREATE TABLE IF NOT EXISTS `hrdondutydeclarationdtl_item` (
  `request_no` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `destination_no` int(11) NOT NULL,
  `onduty_date` datetime NOT NULL,
  `standard_value` decimal(18,4) DEFAULT NULL,
  `allowance_value` decimal(18,4) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `item_code` varchar(50) NOT NULL,
  `currency_code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`company_id`,`destination_no`,`item_code`,`onduty_date`,`request_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbhr_sfbiznet_training.hrdondutydeclarationdtl_item: ~0 rows (approximately)

-- Dumping structure for table dbhr_sfbiznet_training.hrdondutydeclarationdtl_item_remark
CREATE TABLE IF NOT EXISTS `hrdondutydeclarationdtl_item_remark` (
  `request_no` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `destination_no` int(11) NOT NULL,
  `remark` longtext,
  `item_code` varchar(50) NOT NULL,
  PRIMARY KEY (`company_id`,`destination_no`,`item_code`,`request_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbhr_sfbiznet_training.hrdondutydeclarationdtl_item_remark: ~0 rows (approximately)

-- Dumping structure for table dbhr_sfbiznet_training.hrdondutyrequest
CREATE TABLE IF NOT EXISTS `hrdondutyrequest` (
  `request_no` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `requestedby` varchar(50) DEFAULT NULL,
  `requestfor` varchar(50) DEFAULT NULL,
  `requestdate` datetime DEFAULT NULL,
  `purpose_code` varchar(50) NOT NULL,
  `total_destination` int(11) NOT NULL,
  `remark` longtext,
  `created_by` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_date` datetime NOT NULL,
  `cancelsts` varchar(1) DEFAULT NULL,
  `upload_filename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`company_id`,`request_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbhr_sfbiznet_training.hrdondutyrequest: ~0 rows (approximately)
INSERT IGNORE INTO `hrdondutyrequest` (`request_no`, `company_id`, `requestedby`, `requestfor`, `requestdate`, `purpose_code`, `total_destination`, `remark`, `created_by`, `created_date`, `modified_by`, `modified_date`, `cancelsts`, `upload_filename`) VALUES
	('ODR-2018-01-0000001', 13576, 'DO1715846', '3402202208000001', '2018-01-16 00:00:00', 'BTRP', 1, 'Tugas Polychem', '91-0535', '2018-01-16 15:40:16', '87-0279', '2018-01-17 14:34:16', NULL, NULL);

-- Dumping structure for table dbhr_sfbiznet_training.hrdondutyrequestdtl
CREATE TABLE IF NOT EXISTS `hrdondutyrequestdtl` (
  `request_no` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `destination_no` int(11) NOT NULL,
  `destination_code` varchar(50) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  PRIMARY KEY (`company_id`,`destination_no`,`request_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbhr_sfbiznet_training.hrdondutyrequestdtl: ~0 rows (approximately)
INSERT IGNORE INTO `hrdondutyrequestdtl` (`request_no`, `company_id`, `destination_no`, `destination_code`, `startdate`, `enddate`) VALUES
	('ODR-2018-01-0000001', 13576, 0, 'JAKARTA', '2018-01-16 00:00:00', '2018-01-16 00:00:00');

-- Dumping structure for table dbhr_sfbiznet_training.hrdondutyrequestdtl_atd
CREATE TABLE IF NOT EXISTS `hrdondutyrequestdtl_atd` (
  `request_no` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `destination_no` int(11) NOT NULL,
  `attend_date` datetime NOT NULL,
  `shiftdailycode` varchar(50) NOT NULL,
  `shiftstarttime` datetime NOT NULL,
  `shiftendtime` datetime NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `other_status` varchar(255) DEFAULT NULL,
  `old_starttime` datetime DEFAULT NULL,
  `old_endtime` datetime DEFAULT NULL,
  PRIMARY KEY (`attend_date`,`company_id`,`destination_no`,`request_no`,`shiftdailycode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbhr_sfbiznet_training.hrdondutyrequestdtl_atd: ~0 rows (approximately)
INSERT IGNORE INTO `hrdondutyrequestdtl_atd` (`request_no`, `company_id`, `destination_no`, `attend_date`, `shiftdailycode`, `shiftstarttime`, `shiftendtime`, `starttime`, `endtime`, `other_status`, `old_starttime`, `old_endtime`) VALUES
	('ODR-2018-01-0000001', 13576, 1, '2018-01-16 00:00:00', 'S1B', '2018-01-16 07:00:00', '2018-01-16 15:00:00', '2018-01-16 08:00:00', '2018-01-16 15:00:00', 'ABSN', NULL, NULL);

-- Dumping structure for table dbhr_sfbiznet_training.hrdondutyrequestdtl_item
CREATE TABLE IF NOT EXISTS `hrdondutyrequestdtl_item` (
  `request_no` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `destination_no` int(11) NOT NULL,
  `onduty_date` datetime NOT NULL,
  `standard_value` decimal(18,4) DEFAULT NULL,
  `allowance_value` decimal(18,4) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `item_code` varchar(50) NOT NULL,
  `currency_code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`company_id`,`destination_no`,`item_code`,`onduty_date`,`request_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbhr_sfbiznet_training.hrdondutyrequestdtl_item: ~3 rows (approximately)
INSERT IGNORE INTO `hrdondutyrequestdtl_item` (`request_no`, `company_id`, `destination_no`, `onduty_date`, `standard_value`, `allowance_value`, `remark`, `item_code`, `currency_code`, `type`) VALUES
	('ODR-2018-01-0000001', 13576, 1, '2018-01-16 00:00:00', 0.0000, 0.0000, NULL, 'ITEM01', 'IDR', 'DAILY'),
	('ODR-2018-01-0000001', 13576, 1, '2018-01-16 00:00:00', 0.0000, 0.0000, NULL, 'ITEM02', 'IDR', 'DAILY'),
	('ODR-2018-01-0000001', 13576, 1, '2018-01-16 00:00:00', 60000.0000, 0.0000, NULL, 'ITEM03', 'IDR', 'DAILY');

-- Dumping structure for table dbhr_sfbiznet_training.hrdondutyrequestdtl_item_remark
CREATE TABLE IF NOT EXISTS `hrdondutyrequestdtl_item_remark` (
  `request_no` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `destination_no` int(11) NOT NULL,
  `remark` longtext,
  `item_code` varchar(50) NOT NULL,
  PRIMARY KEY (`company_id`,`destination_no`,`item_code`,`request_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbhr_sfbiznet_training.hrdondutyrequestdtl_item_remark: ~3 rows (approximately)
INSERT IGNORE INTO `hrdondutyrequestdtl_item_remark` (`request_no`, `company_id`, `destination_no`, `remark`, `item_code`) VALUES
	('ODR-2018-01-0000001', 13576, 1, '', 'ITEM01'),
	('ODR-2018-01-0000001', 13576, 1, '', 'ITEM02'),
	('ODR-2018-01-0000001', 13576, 1, '', 'ITEM03');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
