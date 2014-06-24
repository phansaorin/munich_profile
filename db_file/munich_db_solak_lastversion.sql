-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.24-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for munich_db
DROP DATABASE IF EXISTS `munich_db`;
CREATE DATABASE IF NOT EXISTS `munich_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `munich_db`;


-- Dumping structure for table munich_db.accommodation
DROP TABLE IF EXISTS `accommodation`;
CREATE TABLE IF NOT EXISTS `accommodation` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_subof` int(11) DEFAULT '0',
  `acc_name` varchar(100) DEFAULT NULL,
  `acc_bookingtext` text,
  `acc_texteticket` text,
  `acc_purchaseprice` float DEFAULT '0',
  `acc_saleprice` float DEFAULT '0',
  `acc_originalstock` int(11) DEFAULT '0',
  `acc_actualstock` int(11) DEFAULT '0',
  `acc_hoteldate` date DEFAULT NULL,
  `acc_payeddate` date DEFAULT NULL,
  `acc_deadline` date DEFAULT NULL,
  `acc_admintext` text,
  `location_id` int(11) DEFAULT '0',
  `photo_id` int(11) DEFAULT NULL,
  `acc_rt_id` int(11) DEFAULT NULL,
  `acc_ftv_id` int(11) DEFAULT NULL,
  `classification_id` int(11) DEFAULT NULL,
  `acc_supplier_id` int(11) DEFAULT NULL,
  `acc_status` tinyint(1) DEFAULT '0',
  `acc_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`acc_id`),
  KEY `fk_accomodations_photo1` (`photo_id`),
  KEY `fk_accomodations_classification1` (`classification_id`),
  KEY `fk_accomodations_festival1` (`acc_ftv_id`),
  KEY `fk_accomodations_room_types1` (`acc_rt_id`),
  KEY `acc_supplier_id` (`acc_supplier_id`),
  KEY `fk_accommodation_location1` (`location_id`),
  CONSTRAINT `fk_accommodation_location1` FOREIGN KEY (`location_id`) REFERENCES `location` (`lt_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_accommodation_supplier1` FOREIGN KEY (`acc_supplier_id`) REFERENCES `supplier` (`sup_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_accomodations_classification1` FOREIGN KEY (`classification_id`) REFERENCES `classification` (`clf_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_accomodations_festival1` FOREIGN KEY (`acc_ftv_id`) REFERENCES `festival` (`ftv_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_accomodations_photo1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`photo_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_accomodations_room_types1` FOREIGN KEY (`acc_rt_id`) REFERENCES `room_types` (`rt_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.accommodation: ~7 rows (approximately)
/*!40000 ALTER TABLE `accommodation` DISABLE KEYS */;
INSERT INTO `accommodation` (`acc_id`, `acc_subof`, `acc_name`, `acc_bookingtext`, `acc_texteticket`, `acc_purchaseprice`, `acc_saleprice`, `acc_originalstock`, `acc_actualstock`, `acc_hoteldate`, `acc_payeddate`, `acc_deadline`, `acc_admintext`, `location_id`, `photo_id`, `acc_rt_id`, `acc_ftv_id`, `classification_id`, `acc_supplier_id`, `acc_status`, `acc_deleted`) VALUES
	(12, 0, 'test', 'test', 'test', 21, 23, 32, 34, '2014-03-14', '2014-03-14', '2014-03-14', 'test', 4, 2, NULL, 1, 3, 2, 1, 1),
	(13, 0, 'test', 'test', 'test', 21, 23, 32, 34, '2014-03-14', '2014-03-14', '2014-03-14', 'test', 4, 2, NULL, 1, 3, 2, 1, 0),
	(15, 0, 'ggg', 'gggg', 'ggg', 21, 12, 32, 45, '2014-03-13', '2014-03-13', '2014-03-14', 'ggg', 4, 1, NULL, 1, 2, 1, 1, 0),
	(16, 0, 'bbb', 'bbbb', 'bbbb', 21, 300, 32, 22, '2014-03-14', '2014-03-15', '2014-03-15', 'bbbb', 4, 1, 1, 1, 2, 2, 1, 0),
	(17, 16, 'ccc', 'bbbb', 'bbbb', 21, 300, 32, 22, '2014-03-14', '2014-03-15', '2014-03-15', 'bbbb', 4, 1, 1, 1, 2, 2, 1, 0),
	(18, 15, 'ddd', 'bbbb', 'bbbb', 21, 300, 32, 22, '2014-03-14', '2014-03-15', '2014-03-15', 'bbbb', 4, 1, 1, 1, 2, 2, 1, 0),
	(19, 13, 'eee', 'bbbb', 'bbbb', 21, 300, 32, 22, '2014-03-14', '2014-03-15', '2014-03-15', 'bbbb', 4, 1, 1, 1, 2, 2, 1, 0);
/*!40000 ALTER TABLE `accommodation` ENABLE KEYS */;


-- Dumping structure for table munich_db.acc_calendar
DROP TABLE IF EXISTS `acc_calendar`;
CREATE TABLE IF NOT EXISTS `acc_calendar` (
  `accca_id` int(11) NOT NULL AUTO_INCREMENT,
  `accomodations_id` int(11) DEFAULT NULL,
  `calendar_available_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`accca_id`),
  KEY `fk_acc_calendar_accomodations1` (`accomodations_id`),
  KEY `fk_acc_calendar_calendar_available1` (`calendar_available_id`),
  CONSTRAINT `fk_acc_calendar_accomodations1` FOREIGN KEY (`accomodations_id`) REFERENCES `accommodation` (`acc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_acc_calendar_calendar_available1` FOREIGN KEY (`calendar_available_id`) REFERENCES `calendar_available` (`ca_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.acc_calendar: ~7 rows (approximately)
/*!40000 ALTER TABLE `acc_calendar` DISABLE KEYS */;
INSERT INTO `acc_calendar` (`accca_id`, `accomodations_id`, `calendar_available_id`) VALUES
	(1, 13, 6),
	(2, 15, 8),
	(3, 16, 9),
	(4, 17, 2),
	(5, 18, 3),
	(6, 19, 4),
	(7, 13, 2);
/*!40000 ALTER TABLE `acc_calendar` ENABLE KEYS */;


-- Dumping structure for table munich_db.acc_fac
DROP TABLE IF EXISTS `acc_fac`;
CREATE TABLE IF NOT EXISTS `acc_fac` (
  `accfac_id` int(11) NOT NULL AUTO_INCREMENT,
  `accomodations_id` int(11) DEFAULT NULL,
  `facilities_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`accfac_id`),
  KEY `fk_acc_fac_accomodations1` (`accomodations_id`),
  KEY `fk_acc_fac_facilities1` (`facilities_id`),
  CONSTRAINT `fk_acc_fac_accomodations1` FOREIGN KEY (`accomodations_id`) REFERENCES `accommodation` (`acc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_acc_fac_facilities1` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`facilities_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.acc_fac: ~2 rows (approximately)
/*!40000 ALTER TABLE `acc_fac` DISABLE KEYS */;
INSERT INTO `acc_fac` (`accfac_id`, `accomodations_id`, `facilities_id`) VALUES
	(1, 13, 1),
	(2, 13, 2);
/*!40000 ALTER TABLE `acc_fac` ENABLE KEYS */;


-- Dumping structure for table munich_db.activities
DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `act_id` int(11) NOT NULL AUTO_INCREMENT,
  `act_subof` int(11) DEFAULT '0',
  `act_cherge_subact` tinyint(1) DEFAULT NULL,
  `act_name` varchar(100) DEFAULT NULL,
  `act_bookingtext` text,
  `act_texteticket` text,
  `act_purchaseprice` float DEFAULT NULL,
  `act_saleprice` float DEFAULT '0',
  `act_originalstock` int(5) DEFAULT '0',
  `act_actualstock` int(5) DEFAULT '0',
  `act_choiceitem` tinyint(1) DEFAULT NULL,
  `act_organiserdate` varchar(45) DEFAULT NULL,
  `act_payeddate` varchar(45) DEFAULT NULL,
  `act_deadline` varchar(45) DEFAULT NULL,
  `act_admintext` text,
  `photo_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `act_ftv_id` int(11) DEFAULT NULL,
  `act_supplier_id` tinyint(1) DEFAULT NULL,
  `act_status` tinyint(1) DEFAULT '0',
  `act_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`act_id`),
  KEY `fk_activities_photo1` (`photo_id`),
  KEY `fk_activities_location1` (`location_id`),
  KEY `fk_activities_festival1` (`act_ftv_id`),
  CONSTRAINT `fk_activities_festival1` FOREIGN KEY (`act_ftv_id`) REFERENCES `festival` (`ftv_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_activities_location1` FOREIGN KEY (`location_id`) REFERENCES `location` (`lt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_activities_photo1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`photo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.activities: ~17 rows (approximately)
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` (`act_id`, `act_subof`, `act_cherge_subact`, `act_name`, `act_bookingtext`, `act_texteticket`, `act_purchaseprice`, `act_saleprice`, `act_originalstock`, `act_actualstock`, `act_choiceitem`, `act_organiserdate`, `act_payeddate`, `act_deadline`, `act_admintext`, `photo_id`, `location_id`, `act_ftv_id`, `act_supplier_id`, `act_status`, `act_deleted`) VALUES
	(1, 0, NULL, 'test', 'rrrr', 'rrr', 34, 33, 44, 67, 1, '2014-03-13', '2014-03-13', '2014-03-13', 'rrrr', 2, 4, 1, 1, 1, 0),
	(2, 0, NULL, 'sreynak', 'cccc', 'ccccc', 111, 300, 32, 45, 1, '2014-03-13', '2014-03-13', '2014-03-13', 'ccc', 1, 4, 1, 2, 1, 0),
	(3, 0, NULL, 'Cambodia1', 'dddd', 'dddd', 12, 23, 35, 34, 0, '2014-03-12', '2014-03-12', '2014-03-13', 'dddd', 1, 4, 1, 2, 1, 0),
	(4, 0, NULL, 'sokeara', 'fffff', 'fffff', 12, 300, 32, 45, 1, '2014-03-12', '2014-03-12', '2014-03-13', 'ffffff', 2, 4, 1, 2, 1, 0),
	(21, 0, NULL, 'aaaaaaaaaaaa', 'aaaa', 'aaaa', 23, 34, 23, 34, 1, '2014-03-14', '2014-03-14', '2014-03-15', 'aaaa', 1, 4, 1, 2, 1, 0),
	(22, 0, NULL, 'ssss', 'sssss', 'sssss', 21, 12, 32, 67, 1, '2014-03-14', '2014-03-14', '2014-03-15', 'ssss', 1, 4, 1, 2, 1, 0),
	(23, 0, NULL, 'dddd', 'ddddd', 'ddddd', 12, 12, 32, 34, 1, '2014-03-14', '2014-03-15', '2014-03-14', 'ddddd', 1, 4, 1, 2, 1, 0),
	(24, 3, NULL, 'fffffff', 'fff', 'ffff', 12, 12, 35, 34, 1, '2014-03-14', '2014-03-14', '2014-03-15', 'fff', 2, 4, 1, 2, 1, 0),
	(25, 4, NULL, 'ggggg', 'ggggg', 'ggggg', 12, 23, 34, 22, 1, '2014-03-14', '2014-03-14', '2014-03-15', 'ggggg', 2, 4, 1, 1, 1, 0),
	(26, 3, NULL, 'hhhhh', 'hhhh', 'hhhh', 12, 23, 23, 45, 1, '2014-03-14', '2014-03-15', '2014-03-16', 'hhhh', 2, 4, 1, 3, 1, 0),
	(27, 0, NULL, 'jjjjj', 'jjjj', 'jjjj', 21, 12, 35, 50, 1, '2014-03-15', '2014-03-15', '2014-03-16', 'jjjj', 2, 4, 1, 2, 1, 0),
	(28, 0, NULL, 'kkkkkkk', 'kkkkk', 'kkkk', 21, 300, 32, 22, 1, '2014-03-14', '2014-03-15', '2014-03-16', 'kkkkkk', 2, 4, 1, 2, 1, 0),
	(29, 0, NULL, 'lllllll', 'llllll', 'llllll', 12, 12, 23, 22, 0, '2014-03-14', '2014-03-15', '2014-03-21', 'llllll', 2, 4, 1, 2, 1, 0),
	(30, 0, NULL, 'zzzzz', 'zzzzz', 'zzzzz', 12, 300, 11, 45, 0, '2014-03-14', '2014-03-14', '2014-03-15', 'zzzzz', 2, 4, 1, 3, 1, 0),
	(31, 0, NULL, 'xxxxx', 'xxxx', 'xxxx', 12, 12, 35, 45, 1, '2014-03-14', '2014-03-30', '2014-03-23', 'xxxx', 2, 4, 1, 2, 1, 0),
	(32, 0, NULL, 'cccc', 'cccc', 'cccc', 44, 44, 44, 44, 1, '2014-03-15', '2014-03-16', '2014-03-23', 'cccc', 3, 4, 1, 3, 1, 0),
	(33, 29, 1, '3 day and 2 night', 'Zxczc', 'zxcZ', 12, 15, 10, 10, 1, '2014-03-18', '2014-03-20', '2014-03-21', 'Zxc', 2, 4, 1, 2, 1, 0);
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;


-- Dumping structure for table munich_db.acti_calendar
DROP TABLE IF EXISTS `acti_calendar`;
CREATE TABLE IF NOT EXISTS `acti_calendar` (
  `actcca_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_available_id` int(11) DEFAULT NULL,
  `activities_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`actcca_id`),
  KEY `fk_acc_calendar_calendar_available10` (`calendar_available_id`),
  KEY `fk_acti_calendar_activities1` (`activities_id`),
  CONSTRAINT `fk_acc_calendar_calendar_available10` FOREIGN KEY (`calendar_available_id`) REFERENCES `calendar_available` (`ca_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_acti_calendar_activities1` FOREIGN KEY (`activities_id`) REFERENCES `activities` (`act_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.acti_calendar: ~9 rows (approximately)
/*!40000 ALTER TABLE `acti_calendar` DISABLE KEYS */;
INSERT INTO `acti_calendar` (`actcca_id`, `calendar_available_id`, `activities_id`) VALUES
	(1, 1, 1),
	(2, 2, 2),
	(3, 3, 3),
	(4, 4, 4),
	(5, 10, 21),
	(6, 11, 22),
	(7, 1, 24),
	(8, 2, 25),
	(9, 2, 26);
/*!40000 ALTER TABLE `acti_calendar` ENABLE KEYS */;


-- Dumping structure for table munich_db.booking
DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `bk_id` int(11) NOT NULL AUTO_INCREMENT,
  `bk_type` varchar(50) DEFAULT NULL,
  `bk_date` date DEFAULT NULL,
  `bk_arrival_date` date DEFAULT NULL,
  `bk_total_people` int(11) DEFAULT '0',
  `bk_pay_date` date DEFAULT NULL,
  `bk_addmoreservice` longtext,
  `bk_pay_price` float DEFAULT '0',
  `bk_pay_status` tinyint(1) DEFAULT '0',
  `bk_status` tinyint(1) DEFAULT '0',
  `bk_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`bk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.booking: ~6 rows (approximately)
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` (`bk_id`, `bk_type`, `bk_date`, `bk_arrival_date`, `bk_total_people`, `bk_pay_date`, `bk_addmoreservice`, `bk_pay_price`, `bk_pay_status`, `bk_status`, `bk_deleted`) VALUES
	(1, 'package', '2014-04-03', '2014-04-06', 2, '2014-04-03', NULL, 100, 1, 1, 1),
	(2, 'customize', '2014-04-05', '2014-04-08', 4, '2014-04-05', NULL, 150, 1, 1, 0),
	(3, 'package', '2014-04-04', '2014-04-08', 3, '2014-04-04', NULL, 200, 1, 1, 0),
	(4, 'package', '2014-04-02', '2014-04-03', 2, '2014-04-03', NULL, 3, 1, 1, 0),
	(5, 'package', '2014-04-03', '2014-04-03', 10, '2014-04-03', 'a:2:{i:4;a:55:{s:5:"ep_id";s:1:"4";s:7:"ep_name";s:6:"ticket";s:12:"ep_perperson";s:1:"1";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:6:"ticket";s:14:"ep_etickettext";s:6:"ticket";s:8:"photo_id";s:1:"2";s:11:"supplier_id";s:1:"3";s:16:"ep_purchaseprice";s:2:"23";s:12:"ep_saleprice";s:2:"45";s:16:"ep_originalstock";s:2:"65";s:14:"ep_actualstock";s:3:"144";s:15:"ep_providerdate";s:10:"2014-03-06";s:12:"ep_payeddate";s:10:"2014-03-06";s:11:"ep_deadline";s:10:"2014-03-06";s:12:"ep_admintext";s:6:"ticket";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";N;s:9:"sup_fname";N;s:9:"sup_lname";N;s:16:"sup_company_name";N;s:14:"sup_occupation";N;s:10:"sup_sector";N;s:21:"sup_service_provision";N;s:11:"sup_country";N;s:8:"sup_city";N;s:11:"sup_address";N;s:12:"sup_postcode";N;s:9:"sup_email";N;s:11:"sup_website";N;s:9:"sup_phone";N;s:14:"sup_home_phone";N;s:11:"sup_deleted";N;s:8:"ep_cl_id";s:1:"4";s:21:"calendar_available_id";s:1:"4";s:15:"extraproduct_id";s:1:"4";s:5:"ca_id";s:1:"4";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"3:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}i:5;a:55:{s:5:"ep_id";s:1:"5";s:7:"ep_name";s:6:"toktok";s:12:"ep_perperson";s:1:"0";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:6:"toktok";s:14:"ep_etickettext";s:6:"toktok";s:8:"photo_id";s:1:"2";s:11:"supplier_id";s:1:"4";s:16:"ep_purchaseprice";s:2:"12";s:12:"ep_saleprice";s:2:"32";s:16:"ep_originalstock";s:2:"33";s:14:"ep_actualstock";s:2:"23";s:15:"ep_providerdate";s:10:"2014-03-06";s:12:"ep_payeddate";s:10:"2014-03-06";s:11:"ep_deadline";s:10:"2014-03-06";s:12:"ep_admintext";s:6:"toktok";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";s:1:"4";s:9:"sup_fname";s:4:"rany";s:9:"sup_lname";s:2:"ra";s:16:"sup_company_name";s:4:"Rany";s:14:"sup_occupation";s:6:"tester";s:10:"sup_sector";s:2:"IT";s:21:"sup_service_provision";s:4:"test";s:11:"sup_country";s:2:"pp";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"899";s:9:"sup_email";s:14:"rany@gmail.com";s:11:"sup_website";s:8:"rany.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:8:"09876542";s:11:"sup_deleted";s:1:"0";s:8:"ep_cl_id";N;s:21:"calendar_available_id";N;s:15:"extraproduct_id";N;s:5:"ca_id";N;s:6:"monday";N;s:7:"tuesday";N;s:9:"wednesday";N;s:8:"thursday";N;s:6:"friday";N;s:8:"saturday";N;s:6:"sunday";N;s:10:"start_date";N;s:8:"end_date";N;s:10:"start_time";N;s:8:"end_time";N;s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}', 154, 0, 1, 0),
	(6, 'package', '2014-04-04', '2014-04-05', 23, '2014-04-05', NULL, 65, 1, 1, 0);
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;


-- Dumping structure for table munich_db.calendar_available
DROP TABLE IF EXISTS `calendar_available`;
CREATE TABLE IF NOT EXISTS `calendar_available` (
  `ca_id` int(11) NOT NULL AUTO_INCREMENT,
  `monday` tinyint(1) DEFAULT '0',
  `tuesday` tinyint(1) DEFAULT '0',
  `wednesday` tinyint(1) DEFAULT '0',
  `thursday` tinyint(1) DEFAULT '0',
  `friday` tinyint(1) DEFAULT '0',
  `saturday` tinyint(1) DEFAULT '0',
  `sunday` tinyint(1) DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` varchar(45) DEFAULT NULL,
  `end_time` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.calendar_available: ~26 rows (approximately)
/*!40000 ALTER TABLE `calendar_available` DISABLE KEYS */;
INSERT INTO `calendar_available` (`ca_id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `start_date`, `end_date`, `start_time`, `end_time`) VALUES
	(1, 1, 1, 1, 1, 1, 1, 1, '2014-03-17', '2014-03-21', '1:00 AM', '6:00 PM'),
	(2, 1, 1, 1, 1, 1, 1, 1, '2014-03-17', '2014-03-21', '1:00 AM', '2:00 AM'),
	(3, 1, 1, 1, 1, 1, 1, 1, '2014-03-17', '2014-03-21', '1:00 AM', '3:00 AM'),
	(4, 1, 1, 1, 1, 1, 1, 1, '2014-03-17', '2014-03-21', '1:00 AM', '3:00 AM'),
	(5, 1, 1, 1, 1, 1, 1, 1, '2014-03-17', '2014-03-21', '1:00 AM', '3:00 AM'),
	(6, 1, 1, 1, 1, 1, 1, 1, '2014-03-13', '2014-03-30', '1:00 AM', '3:00 AM'),
	(7, 1, 1, 1, 1, 1, 1, 1, '2014-03-13', '2014-03-14', '1:00 AM', '4:00 AM'),
	(8, 1, 1, 1, 1, 1, 1, 1, '2014-03-13', '2014-03-30', '1:00 AM', '4:00 AM'),
	(9, 0, 1, 0, 0, 0, 0, 0, '2014-03-13', '2014-03-30', '1:00 AM', '9:00 AM'),
	(10, 1, 1, 1, 1, 1, 1, 1, '2014-03-13', '2014-03-27', '2:00 AM', '5:00 AM'),
	(11, 1, 1, 1, 1, 1, 1, 1, '2014-03-10', '2014-03-16', '2:00 AM', '11:00 PM'),
	(12, 1, 1, 1, 1, 1, 1, 1, '2014-03-13', '2014-03-15', '1:00 AM', '5:00 AM'),
	(13, 1, 1, 1, 1, 1, 1, 1, '2014-03-13', '2014-03-14', '1:00 AM', '4:00 AM'),
	(14, 1, 1, 1, 1, 1, 1, 1, '2014-03-20', '2014-03-22', '1:00 AM', '7:00 AM'),
	(15, 1, 1, 0, 0, 0, 0, 0, '2014-03-14', '2014-03-14', '1:00 AM', '4:00 AM'),
	(16, 1, 1, 1, 1, 1, 1, 1, '2014-03-14', '2014-03-16', '1:00 AM', '4:00 AM'),
	(17, 0, 0, 0, 0, 0, 1, 1, '2014-03-14', '2014-03-16', '1:00 AM', '8:00 AM'),
	(18, 1, 1, 1, 1, 1, 1, 1, '2014-03-15', '2014-03-23', '1:00 AM', '8:00 AM'),
	(19, 1, 1, 1, 1, 1, 1, 1, '2014-03-20', '2014-03-28', '1:00 AM', '5:00 AM'),
	(20, 1, 1, 1, 1, 1, 1, 1, '2014-03-15', '2014-03-16', '1:00 AM', '5:00 AM'),
	(21, 1, 1, 1, 1, 1, 1, 1, '2014-03-14', '2014-03-14', '1:00 AM', '5:00 AM'),
	(22, 1, 1, 1, 1, 1, 1, 1, '2014-03-15', '2014-03-30', '1:00 AM', '1:00 AM'),
	(23, 1, 1, 1, 1, 1, 1, 1, '2014-03-15', '2014-03-30', '1:00 AM', '3:00 AM'),
	(24, 1, 1, 1, 1, 1, 1, 1, '2014-03-15', '2014-03-30', '1:00 AM', '6:00 AM'),
	(25, 1, 1, 1, 1, 1, 1, 1, '2014-03-15', '2014-03-30', '1:00 AM', '4:00 AM'),
	(26, 1, 1, 1, 1, 1, 1, 1, '2014-03-17', '2014-03-22', '10:45 AM', '11:00 AM');
/*!40000 ALTER TABLE `calendar_available` ENABLE KEYS */;


-- Dumping structure for table munich_db.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.category: ~0 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;


-- Dumping structure for table munich_db.classification
DROP TABLE IF EXISTS `classification`;
CREATE TABLE IF NOT EXISTS `classification` (
  `clf_id` int(11) NOT NULL AUTO_INCREMENT,
  `clf_name` varchar(45) DEFAULT NULL,
  `clf_value` smallint(6) DEFAULT NULL,
  `clf_deleted` int(11) NOT NULL,
  PRIMARY KEY (`clf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.classification: ~8 rows (approximately)
/*!40000 ALTER TABLE `classification` DISABLE KEYS */;
INSERT INTO `classification` (`clf_id`, `clf_name`, `clf_value`, `clf_deleted`) VALUES
	(1, 'One Star', 1, 1),
	(2, 'Two Star', 2, 0),
	(3, 'Three Star', 3, 0),
	(4, 'Four Star', 41, 0),
	(5, 'Five Star', 5, 1),
	(6, 'Six Star', 6, 1),
	(7, 'Seven Star', 7, 1),
	(8, 'test', 2, 0);
/*!40000 ALTER TABLE `classification` ENABLE KEYS */;


-- Dumping structure for table munich_db.content
DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_title` varchar(100) DEFAULT NULL,
  `con_text` text,
  `con_template` varchar(40) DEFAULT NULL,
  `con_status` int(1) DEFAULT NULL,
  `con_delete` int(1) DEFAULT '0',
  `meta_key` varchar(100) DEFAULT NULL,
  `meta_describe` varchar(100) DEFAULT NULL,
  `con_menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`con_id`),
  KEY `fk_content_menu1` (`con_menu_id`),
  CONSTRAINT `fk_content_menu1` FOREIGN KEY (`con_menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.content: ~5 rows (approximately)
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` (`con_id`, `con_title`, `con_text`, `con_template`, `con_status`, `con_delete`, `meta_key`, `meta_describe`, `con_menu_id`) VALUES
	(1, 'test', '<p>fsfdsfsdfsdfsdf</p>', 'sideright', 1, 0, 'test', 'test', 2),
	(2, 'test11', '<p>test</p>', 'fullwidth', 1, 0, 'test', 'test', 2),
	(3, 'ssss', '<p>sssss</p>', 'fullwidth', 1, 0, 'sssss', 'ssss', 2),
	(4, 'bbbbb', '<p>bbbbb</p>', 'fullwidth', 1, 0, 'bbbb', 'bbbb', 2),
	(5, '', '<p>Hello world in My Country has a lots of People that lovely and Crazy and Famous too. But they are not poor people mean that they are rich people.</p>', '', 0, 0, '', '', NULL);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;


-- Dumping structure for table munich_db.content_photo
DROP TABLE IF EXISTS `content_photo`;
CREATE TABLE IF NOT EXISTS `content_photo` (
  `cp_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  PRIMARY KEY (`cp_id`),
  KEY `fk_content-photo_photo1` (`photo_id`),
  KEY `fk_content-photo_content1` (`con_id`),
  CONSTRAINT `fk_content-photo_content1` FOREIGN KEY (`con_id`) REFERENCES `content` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_content-photo_photo1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`photo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.content_photo: ~5 rows (approximately)
/*!40000 ALTER TABLE `content_photo` DISABLE KEYS */;
INSERT INTO `content_photo` (`cp_id`, `photo_id`, `con_id`) VALUES
	(3, 1, 3),
	(4, 2, 4),
	(12, 1, 2),
	(13, 2, 2),
	(23, 2, 1);
/*!40000 ALTER TABLE `content_photo` ENABLE KEYS */;


-- Dumping structure for table munich_db.customize_conjection
DROP TABLE IF EXISTS `customize_conjection`;
CREATE TABLE IF NOT EXISTS `customize_conjection` (
  `cuscon_id` int(11) NOT NULL DEFAULT '0',
  `cuscon_status` tinyint(1) DEFAULT NULL,
  `cuscon_deleted` tinyint(1) DEFAULT NULL,
  `cuscon_accomodation` text,
  `cuscon_activities` text,
  `cuscon_transportation` text,
  PRIMARY KEY (`cuscon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.customize_conjection: ~0 rows (approximately)
/*!40000 ALTER TABLE `customize_conjection` DISABLE KEYS */;
/*!40000 ALTER TABLE `customize_conjection` ENABLE KEYS */;


-- Dumping structure for table munich_db.extraproduct
DROP TABLE IF EXISTS `extraproduct`;
CREATE TABLE IF NOT EXISTS `extraproduct` (
  `ep_id` int(11) NOT NULL AUTO_INCREMENT,
  `ep_name` varchar(100) DEFAULT NULL,
  `ep_perperson` tinyint(1) DEFAULT NULL,
  `ep_perbooking` tinyint(1) DEFAULT NULL,
  `ep_bookingtext` text,
  `ep_etickettext` text,
  `photo_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `ep_purchaseprice` float DEFAULT NULL,
  `ep_saleprice` float DEFAULT NULL,
  `ep_originalstock` int(11) DEFAULT NULL,
  `ep_actualstock` int(11) DEFAULT NULL,
  `ep_providerdate` date DEFAULT NULL,
  `ep_payeddate` date DEFAULT NULL,
  `ep_deadline` date DEFAULT NULL,
  `ep_admintext` text,
  `ep_status` tinyint(1) DEFAULT '0',
  `ep_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ep_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.extraproduct: ~15 rows (approximately)
/*!40000 ALTER TABLE `extraproduct` DISABLE KEYS */;
INSERT INTO `extraproduct` (`ep_id`, `ep_name`, `ep_perperson`, `ep_perbooking`, `ep_bookingtext`, `ep_etickettext`, `photo_id`, `supplier_id`, `ep_purchaseprice`, `ep_saleprice`, `ep_originalstock`, `ep_actualstock`, `ep_providerdate`, `ep_payeddate`, `ep_deadline`, `ep_admintext`, `ep_status`, `ep_deleted`) VALUES
	(1, 'test1', 1, 1, 'test', 'test', 2, 3, 20, 20, 20, 20, '2014-03-06', '2013-03-06', '2014-03-06', 'test', 1, 0),
	(2, 'test1', 1, 0, 'test1', 'test1', 2, 4, 23, 34, 43, 45, '2014-03-06', '2014-03-06', '2014-03-06', 'test1', 1, 0),
	(3, 'lux', 0, 1, 'lux', 'lux', 1, 2, 23, 76, 21, 25, '2014-03-06', '2014-03-06', '2014-03-06', 'lux', 1, 0),
	(4, 'ticket', 1, 1, 'ticket', 'ticket', 2, 3, 23, 45, 65, 144, '2014-03-06', '2014-03-06', '2014-03-06', 'ticket', 1, 0),
	(5, 'toktok', 0, 1, 'toktok', 'toktok', 2, 4, 12, 32, 33, 23, '2014-03-06', '2014-03-06', '2014-03-06', 'toktok', 1, 0),
	(9, 'aaa', 1, 0, 'aaaa', 'aaaa', 1, 1, 222, 2222, 333, 333, '2014-03-06', '2014-03-15', '2014-03-15', '0', 1, 1),
	(10, 'sssssssssss', 0, 0, 'sssssssssss', 'ssssssssssssss', 2, 3, 33, 12, 23, 34, '2014-03-07', '2014-03-08', '2014-03-15', '1', 1, 1),
	(12, 'vvv', 1, 1, 'vvv', 'vvv', 2, 3, 200, 300, 22, 34, '2014-03-07', '2014-03-07', '2014-03-07', 'vvv', 1, 1),
	(13, 'dasdsa', 0, 1, 'asdsadsa', 'dsadasd', 1, 1, 21, 23, 22, 45, '2014-03-08', '2014-03-08', '2014-03-08', 'assdasd', 1, 1),
	(14, 'xxxxxxxxxx', 1, 1, '', 'rteettew', 2, 2, 111, 13, 32, 50, '2014-03-07', '2014-03-07', '2014-03-07', 'test', 1, 1),
	(18, 'ffffff', 1, 1, 'ffff', '1', 2, 1, 111, 300, 35, 50, '2014-03-12', '2014-03-12', '2014-03-13', 'fffff', 1, 1),
	(19, 'mmmmmmmmmmmmmmm', 0, 1, 'mmmmmmmmmmmmmmmmm', '4', 2, 1, 111, 300, 32, 45, '2014-03-12', '2014-03-12', '2014-03-13', 'mmmmmmmmmmmmmmmmmm', 1, 1),
	(31, 'saorinkkk', 0, 1, 'jkkhgj', 'hkkhk', 1, 2, 12, 23, 22, 22, '2014-03-12', '2014-03-12', '2014-03-13', 'kjhkh', 1, 0),
	(32, 'rrrrrrr', 1, 1, 'rrrrrrr', 'rrrrr', 2, 4, 12, 23, 32, 45, '2014-03-12', '2014-03-13', '2014-03-13', 'rrrr', 1, 0),
	(33, 'hhh', 1, 1, 'rerrrr', 'terttt', 3, 4, 21, 12, 32, 45, '2014-03-12', '2014-03-12', '2014-03-13', 'rrrrrr', 1, 0);
/*!40000 ALTER TABLE `extraproduct` ENABLE KEYS */;


-- Dumping structure for table munich_db.extraproduct_calendar
DROP TABLE IF EXISTS `extraproduct_calendar`;
CREATE TABLE IF NOT EXISTS `extraproduct_calendar` (
  `ep_cl_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_available_id` int(11) DEFAULT NULL,
  `extraproduct_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`ep_cl_id`),
  KEY `fk_extraproduct_calendar_calendar_available1` (`calendar_available_id`),
  KEY `fk_extraproduct_calendar_extraproduct1` (`extraproduct_id`),
  CONSTRAINT `fk_extraproduct_calendar_calendar_available1` FOREIGN KEY (`calendar_available_id`) REFERENCES `calendar_available` (`ca_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_extraproduct_calendar_extraproduct1` FOREIGN KEY (`extraproduct_id`) REFERENCES `extraproduct` (`ep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.extraproduct_calendar: ~7 rows (approximately)
/*!40000 ALTER TABLE `extraproduct_calendar` DISABLE KEYS */;
INSERT INTO `extraproduct_calendar` (`ep_cl_id`, `calendar_available_id`, `extraproduct_id`) VALUES
	(1, 1, 1),
	(2, 2, 2),
	(3, 3, 3),
	(4, 4, 4),
	(5, 2, 3),
	(6, 3, 18),
	(7, 2, 33);
/*!40000 ALTER TABLE `extraproduct_calendar` ENABLE KEYS */;


-- Dumping structure for table munich_db.extra_acc
DROP TABLE IF EXISTS `extra_acc`;
CREATE TABLE IF NOT EXISTS `extra_acc` (
  `exacc_id` int(11) NOT NULL AUTO_INCREMENT,
  `extraproduct_ep_id` int(11) DEFAULT NULL,
  `accomodations_ad_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`exacc_id`),
  KEY `fk_extra_acc_extraproduct1` (`extraproduct_ep_id`),
  KEY `fk_extra_acc_accomodations1` (`accomodations_ad_id`),
  CONSTRAINT `fk_extra_acc_accomodations1` FOREIGN KEY (`accomodations_ad_id`) REFERENCES `accommodation` (`acc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_extra_acc_extraproduct1` FOREIGN KEY (`extraproduct_ep_id`) REFERENCES `extraproduct` (`ep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.extra_acc: ~3 rows (approximately)
/*!40000 ALTER TABLE `extra_acc` DISABLE KEYS */;
INSERT INTO `extra_acc` (`exacc_id`, `extraproduct_ep_id`, `accomodations_ad_id`) VALUES
	(1, 3, 13),
	(2, 18, 15),
	(3, 33, 16);
/*!40000 ALTER TABLE `extra_acc` ENABLE KEYS */;


-- Dumping structure for table munich_db.extra_acti
DROP TABLE IF EXISTS `extra_acti`;
CREATE TABLE IF NOT EXISTS `extra_acti` (
  `exact_id` int(11) NOT NULL AUTO_INCREMENT,
  `extraproduct_id` int(11) DEFAULT NULL,
  `activities_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`exact_id`),
  KEY `fk_extra_acti_extraproduct1` (`extraproduct_id`),
  KEY `fk_extra_acti_activities1` (`activities_id`),
  CONSTRAINT `fk_extra_acti_activities1` FOREIGN KEY (`activities_id`) REFERENCES `activities` (`act_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_extra_acti_extraproduct1` FOREIGN KEY (`extraproduct_id`) REFERENCES `extraproduct` (`ep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.extra_acti: ~4 rows (approximately)
/*!40000 ALTER TABLE `extra_acti` DISABLE KEYS */;
INSERT INTO `extra_acti` (`exact_id`, `extraproduct_id`, `activities_id`) VALUES
	(1, 3, 3),
	(2, 1, 1),
	(3, 2, 2),
	(4, 4, 4);
/*!40000 ALTER TABLE `extra_acti` ENABLE KEYS */;


-- Dumping structure for table munich_db.extra_transport
DROP TABLE IF EXISTS `extra_transport`;
CREATE TABLE IF NOT EXISTS `extra_transport` (
  `extr_id` int(11) NOT NULL AUTO_INCREMENT,
  `extraproduct_id` int(11) DEFAULT NULL,
  `transport_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`extr_id`),
  KEY `fk_extra_transport_extraproduct1` (`extraproduct_id`),
  KEY `fk_extra_transport_transport1` (`transport_id`),
  CONSTRAINT `fk_extra_transport_extraproduct1` FOREIGN KEY (`extraproduct_id`) REFERENCES `extraproduct` (`ep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_extra_transport_transport1` FOREIGN KEY (`transport_id`) REFERENCES `transportation` (`tp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.extra_transport: ~2 rows (approximately)
/*!40000 ALTER TABLE `extra_transport` DISABLE KEYS */;
INSERT INTO `extra_transport` (`extr_id`, `extraproduct_id`, `transport_id`) VALUES
	(1, 3, 4),
	(2, 33, 3);
/*!40000 ALTER TABLE `extra_transport` ENABLE KEYS */;


-- Dumping structure for table munich_db.facilities
DROP TABLE IF EXISTS `facilities`;
CREATE TABLE IF NOT EXISTS `facilities` (
  `facilities_id` int(11) NOT NULL AUTO_INCREMENT,
  `facilities_title` varchar(45) DEFAULT NULL,
  `facilities_value` varchar(45) DEFAULT NULL,
  `facilities_deleted` int(11) DEFAULT NULL,
  PRIMARY KEY (`facilities_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.facilities: ~2 rows (approximately)
/*!40000 ALTER TABLE `facilities` DISABLE KEYS */;
INSERT INTO `facilities` (`facilities_id`, `facilities_title`, `facilities_value`, `facilities_deleted`) VALUES
	(1, 'tttt', '3', 0),
	(2, 'tttt', '3', 0);
/*!40000 ALTER TABLE `facilities` ENABLE KEYS */;


-- Dumping structure for table munich_db.feedback
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `fb_id` int(11) NOT NULL AUTO_INCREMENT,
  `fb_name` varchar(100) DEFAULT NULL,
  `fb_email` varchar(100) DEFAULT NULL,
  `fb_text` tinytext,
  `fb_subject` varchar(100) DEFAULT NULL,
  `fb_date` varchar(100) DEFAULT NULL,
  `fb_status` tinyint(1) DEFAULT NULL,
  `fb_deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`fb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.feedback: ~2 rows (approximately)
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` (`fb_id`, `fb_name`, `fb_email`, `fb_text`, `fb_subject`, `fb_date`, `fb_status`, `fb_deleted`) VALUES
	(1, 'test', 'test@gmail.com', 'test', 'Test Mail', '10/03/12', 1, 0),
	(2, 'my message hello.', 'lannsolak@gmail.com', 'asdfasdfa', 'How are you today', '2014-03-18', 1, 0);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;


-- Dumping structure for table munich_db.festival
DROP TABLE IF EXISTS `festival`;
CREATE TABLE IF NOT EXISTS `festival` (
  `ftv_id` int(11) NOT NULL AUTO_INCREMENT,
  `ftv_name` varchar(100) DEFAULT NULL,
  `ftv_photo_id` int(11) DEFAULT NULL,
  `ftv_lt_id` int(11) DEFAULT NULL,
  `ftv_detail` varchar(245) DEFAULT NULL,
  `ftv_deleted` tinyint(1) DEFAULT '0',
  `ftv_status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ftv_id`),
  KEY `ftv_photo_id` (`ftv_photo_id`),
  KEY `ftv_lt_id` (`ftv_lt_id`),
  CONSTRAINT `ftv_location_fk` FOREIGN KEY (`ftv_lt_id`) REFERENCES `location` (`lt_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `ftv_photo_fk` FOREIGN KEY (`ftv_photo_id`) REFERENCES `photo` (`photo_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.festival: ~10 rows (approximately)
/*!40000 ALTER TABLE `festival` DISABLE KEYS */;
INSERT INTO `festival` (`ftv_id`, `ftv_name`, `ftv_photo_id`, `ftv_lt_id`, `ftv_detail`, `ftv_deleted`, `ftv_status`) VALUES
	(1, 'Festival 2', 2, 2, 'Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ', 0, 1),
	(2, 'Festival 1', 1, 1, 'Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ', 0, 1),
	(3, 'Festival 3', 2, 2, 'Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ', 0, 1),
	(4, 'Festival 4', 2, 1, 'Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Displ', 0, 1),
	(5, 'Festival 5', 2, 2, 'Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ', 0, 1),
	(6, 'Festival 6', 2, 2, 'Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ', 0, 1),
	(7, 'Festival 7', 2, 1, 'Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ', 0, 1),
	(8, 'Festival 8', 2, 1, 'Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ', 0, 1),
	(9, 'Festival 9', 2, 1, 'Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ', 0, 1),
	(10, 'Festival 10', 2, 2, 'Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ', 0, 1);
/*!40000 ALTER TABLE `festival` ENABLE KEYS */;


-- Dumping structure for table munich_db.location
DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `lt_id` int(11) NOT NULL AUTO_INCREMENT,
  `lt_name` varchar(100) DEFAULT NULL,
  `lt_status` int(11) DEFAULT NULL,
  `lt_deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.location: ~5 rows (approximately)
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` (`lt_id`, `lt_name`, `lt_status`, `lt_deleted`) VALUES
	(1, 'pampluma', 1, 0),
	(2, 'munich', 1, 0),
	(3, 'somewhere', 1, 0),
	(4, 'anywhere', 1, 0),
	(5, 'here', 1, 0);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;


-- Dumping structure for table munich_db.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(100) DEFAULT NULL,
  `menu_aliase` varchar(100) DEFAULT NULL,
  `menu_status` varchar(100) DEFAULT '0',
  `menu_delete` tinyint(4) DEFAULT '0',
  `menu_menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `fk_menu_menu1` (`menu_menu_id`),
  CONSTRAINT `fk_menu_menu1` FOREIGN KEY (`menu_menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.menu: ~1 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`menu_id`, `menu_title`, `menu_aliase`, `menu_status`, `menu_delete`, `menu_menu_id`) VALUES
	(2, 'test', 'test', '1', 0, NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Dumping structure for table munich_db.package_conjection
DROP TABLE IF EXISTS `package_conjection`;
CREATE TABLE IF NOT EXISTS `package_conjection` (
  `pkcon_id` int(11) NOT NULL AUTO_INCREMENT,
  `pkcon_start_date` date DEFAULT NULL,
  `pkcon_end_date` date DEFAULT NULL,
  `pkcon_description` text,
  `pkcon_name` varchar(150) DEFAULT NULL,
  `pkcon_actualstock` int(11) DEFAULT '0',
  `pkcon_originalstock` int(11) DEFAULT '0',
  `pkcon_purchaseprice` float DEFAULT '0',
  `pkcon_saleprice` float DEFAULT '0',
  `pk_accomodation` longtext,
  `pk_activities` longtext,
  `pk_transportation` longtext,
  `pkconl_ftv_id` int(11) DEFAULT NULL,
  `pkcon_lt_id` int(11) DEFAULT NULL,
  `phoid` int(11) DEFAULT NULL,
  `pkcon_status` tinyint(1) DEFAULT '1',
  `pkcon_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pkcon_id`),
  KEY `fk_package_conjection_festival1` (`pkconl_ftv_id`),
  KEY `fk_package_conjection_location1` (`pkcon_lt_id`),
  KEY `pkcon_photo_id` (`phoid`),
  CONSTRAINT `fk_package_conjection_photo1` FOREIGN KEY (`phoid`) REFERENCES `photo` (`photo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_package_conjection_festival1` FOREIGN KEY (`pkconl_ftv_id`) REFERENCES `festival` (`ftv_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_package_conjection_location1` FOREIGN KEY (`pkcon_lt_id`) REFERENCES `location` (`lt_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.package_conjection: ~6 rows (approximately)
/*!40000 ALTER TABLE `package_conjection` DISABLE KEYS */;
INSERT INTO `package_conjection` (`pkcon_id`, `pkcon_start_date`, `pkcon_end_date`, `pkcon_description`, `pkcon_name`, `pkcon_actualstock`, `pkcon_originalstock`, `pkcon_purchaseprice`, `pkcon_saleprice`, `pk_accomodation`, `pk_activities`, `pk_transportation`, `pkconl_ftv_id`, `pkcon_lt_id`, `phoid`, `pkcon_status`, `pkcon_deleted`) VALUES
	(1, '2014-03-17', '2014-03-21', 'qwerw', 'Hello', 10, 10, 12, 14, NULL, NULL, NULL, 1, 4, 2, 1, 0),
	(2, '2014-03-17', '2014-03-21', 'qwerw', 'Hello', 10, 10, 12, 14, NULL, NULL, NULL, 1, 4, 4, 1, 0),
	(3, '2014-03-17', '2014-03-21', 'qwerw', 'Hello', 10, 10, 12, 14, NULL, NULL, NULL, 1, 4, 1, 1, 0),
	(4, '2014-04-05', '2014-04-30', 'Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today', 'Hello how are you today Hello how are you today', 10, 10, 12, 14, 'a:3:{s:18:"main-accommodation";a:1:{i:13;a:77:{s:6:"acc_id";s:2:"13";s:9:"acc_subof";s:1:"0";s:8:"acc_name";s:4:"test";s:15:"acc_bookingtext";s:4:"test";s:15:"acc_texteticket";s:4:"test";s:17:"acc_purchaseprice";s:2:"21";s:13:"acc_saleprice";s:2:"23";s:17:"acc_originalstock";s:2:"32";s:15:"acc_actualstock";s:2:"34";s:13:"acc_hoteldate";s:10:"2014-03-14";s:13:"acc_payeddate";s:10:"2014-03-14";s:12:"acc_deadline";s:10:"2014-03-14";s:13:"acc_admintext";s:4:"test";s:11:"location_id";s:1:"4";s:8:"photo_id";s:1:"2";s:9:"acc_rt_id";N;s:10:"acc_ftv_id";s:1:"1";s:17:"classification_id";s:1:"3";s:15:"acc_supplier_id";s:1:"2";s:10:"acc_status";s:1:"1";s:11:"acc_deleted";s:1:"0";s:5:"rt_id";N;s:7:"rt_name";N;s:9:"rt_status";N;s:10:"rt_deleted";N;s:6:"clf_id";s:1:"3";s:8:"clf_name";s:10:"Three Star";s:9:"clf_value";s:1:"3";s:11:"clf_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:8:"accca_id";s:1:"7";s:16:"accomodations_id";s:2:"13";s:21:"calendar_available_id";s:1:"2";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}s:17:"sub-accommodation";a:1:{i:13;a:1:{i:19;a:77:{s:6:"acc_id";s:2:"19";s:9:"acc_subof";s:2:"13";s:8:"acc_name";s:3:"eee";s:15:"acc_bookingtext";s:4:"bbbb";s:15:"acc_texteticket";s:4:"bbbb";s:17:"acc_purchaseprice";s:2:"21";s:13:"acc_saleprice";s:3:"300";s:17:"acc_originalstock";s:2:"32";s:15:"acc_actualstock";s:2:"22";s:13:"acc_hoteldate";s:10:"2014-03-14";s:13:"acc_payeddate";s:10:"2014-03-15";s:12:"acc_deadline";s:10:"2014-03-15";s:13:"acc_admintext";s:4:"bbbb";s:11:"location_id";s:1:"4";s:8:"photo_id";s:1:"1";s:9:"acc_rt_id";s:1:"1";s:10:"acc_ftv_id";s:1:"1";s:17:"classification_id";s:1:"2";s:15:"acc_supplier_id";s:1:"2";s:10:"acc_status";s:1:"1";s:11:"acc_deleted";s:1:"0";s:5:"rt_id";s:1:"1";s:7:"rt_name";s:5:"room1";s:9:"rt_status";s:1:"1";s:10:"rt_deleted";s:1:"1";s:6:"clf_id";s:1:"2";s:8:"clf_name";s:8:"Two Star";s:9:"clf_value";s:1:"2";s:11:"clf_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:8:"accca_id";s:1:"6";s:16:"accomodations_id";s:2:"19";s:21:"calendar_available_id";s:1:"4";s:5:"ca_id";s:1:"4";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"3:00 AM";s:8:"pho_name";s:5:"j.jpg";s:10:"pho_detail";s:4:"test";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}}s:15:"extraproduct-pk";a:1:{i:13;a:1:{i:3;a:55:{s:5:"ep_id";s:1:"3";s:7:"ep_name";s:3:"lux";s:12:"ep_perperson";s:1:"0";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:3:"lux";s:14:"ep_etickettext";s:3:"lux";s:8:"photo_id";s:1:"1";s:11:"supplier_id";s:1:"2";s:16:"ep_purchaseprice";s:2:"23";s:12:"ep_saleprice";s:2:"76";s:16:"ep_originalstock";s:2:"21";s:14:"ep_actualstock";s:2:"25";s:15:"ep_providerdate";s:10:"2014-03-06";s:12:"ep_payeddate";s:10:"2014-03-06";s:11:"ep_deadline";s:10:"2014-03-06";s:12:"ep_admintext";s:3:"lux";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:8:"ep_cl_id";s:1:"5";s:21:"calendar_available_id";s:1:"2";s:15:"extraproduct_id";s:1:"3";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:5:"j.jpg";s:10:"pho_detail";s:4:"test";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}}}', 'a:3:{s:15:"main-activities";a:3:{i:3;a:69:{s:6:"act_id";s:1:"3";s:9:"act_subof";s:1:"0";s:17:"act_cherge_subact";N;s:8:"act_name";s:9:"Cambodia1";s:15:"act_bookingtext";s:4:"dddd";s:15:"act_texteticket";s:4:"dddd";s:17:"act_purchaseprice";s:2:"12";s:13:"act_saleprice";s:2:"23";s:17:"act_originalstock";s:2:"35";s:15:"act_actualstock";s:2:"34";s:14:"act_choiceitem";s:1:"0";s:17:"act_organiserdate";s:10:"2014-03-12";s:13:"act_payeddate";s:10:"2014-03-12";s:12:"act_deadline";s:10:"2014-03-13";s:13:"act_admintext";s:4:"dddd";s:8:"photo_id";s:1:"1";s:11:"location_id";s:1:"4";s:10:"act_ftv_id";s:1:"1";s:15:"act_supplier_id";s:1:"2";s:10:"act_status";s:1:"1";s:11:"act_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"actcca_id";s:1:"3";s:21:"calendar_available_id";s:1:"3";s:13:"activities_id";s:1:"3";s:5:"ca_id";s:1:"3";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"3:00 AM";s:8:"pho_name";s:5:"j.jpg";s:10:"pho_detail";s:4:"test";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}i:4;a:69:{s:6:"act_id";s:1:"4";s:9:"act_subof";s:1:"0";s:17:"act_cherge_subact";N;s:8:"act_name";s:7:"sokeara";s:15:"act_bookingtext";s:5:"fffff";s:15:"act_texteticket";s:5:"fffff";s:17:"act_purchaseprice";s:2:"12";s:13:"act_saleprice";s:3:"300";s:17:"act_originalstock";s:2:"32";s:15:"act_actualstock";s:2:"45";s:14:"act_choiceitem";s:1:"1";s:17:"act_organiserdate";s:10:"2014-03-12";s:13:"act_payeddate";s:10:"2014-03-12";s:12:"act_deadline";s:10:"2014-03-13";s:13:"act_admintext";s:6:"ffffff";s:8:"photo_id";s:1:"2";s:11:"location_id";s:1:"4";s:10:"act_ftv_id";s:1:"1";s:15:"act_supplier_id";s:1:"2";s:10:"act_status";s:1:"1";s:11:"act_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"actcca_id";s:1:"4";s:21:"calendar_available_id";s:1:"4";s:13:"activities_id";s:1:"4";s:5:"ca_id";s:1:"4";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"3:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}i:1;a:69:{s:6:"act_id";s:1:"1";s:9:"act_subof";s:1:"0";s:17:"act_cherge_subact";N;s:8:"act_name";s:4:"test";s:15:"act_bookingtext";s:4:"rrrr";s:15:"act_texteticket";s:3:"rrr";s:17:"act_purchaseprice";s:2:"34";s:13:"act_saleprice";s:2:"33";s:17:"act_originalstock";s:2:"44";s:15:"act_actualstock";s:2:"67";s:14:"act_choiceitem";s:1:"1";s:17:"act_organiserdate";s:10:"2014-03-13";s:13:"act_payeddate";s:10:"2014-03-13";s:12:"act_deadline";s:10:"2014-03-13";s:13:"act_admintext";s:4:"rrrr";s:8:"photo_id";s:1:"2";s:11:"location_id";s:1:"4";s:10:"act_ftv_id";s:1:"1";s:15:"act_supplier_id";s:1:"1";s:10:"act_status";s:1:"1";s:11:"act_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"1";s:9:"sup_fname";s:7:"sreynak";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:7:"sreynak";s:14:"sup_occupation";N;s:10:"sup_sector";s:2:"IT";s:21:"sup_service_provision";s:6:"Webapp";s:11:"sup_country";s:15:"Kampong Chhnang";s:8:"sup_city";s:15:"Kampong Chhnang";s:11:"sup_address";s:10:"Phnom Penh";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:17:"sreynak@gmail.com";s:11:"sup_website";s:15:"www.sreynak.com";s:9:"sup_phone";s:10:"0123456789";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"actcca_id";s:1:"1";s:21:"calendar_available_id";s:1:"1";s:13:"activities_id";s:1:"1";s:5:"ca_id";s:1:"1";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"6:00 PM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}s:14:"sub-activities";a:2:{i:3;a:2:{i:24;a:69:{s:6:"act_id";s:2:"24";s:9:"act_subof";s:1:"3";s:17:"act_cherge_subact";N;s:8:"act_name";s:7:"fffffff";s:15:"act_bookingtext";s:3:"fff";s:15:"act_texteticket";s:4:"ffff";s:17:"act_purchaseprice";s:2:"12";s:13:"act_saleprice";s:2:"12";s:17:"act_originalstock";s:2:"35";s:15:"act_actualstock";s:2:"34";s:14:"act_choiceitem";s:1:"1";s:17:"act_organiserdate";s:10:"2014-03-14";s:13:"act_payeddate";s:10:"2014-03-14";s:12:"act_deadline";s:10:"2014-03-15";s:13:"act_admintext";s:3:"fff";s:8:"photo_id";s:1:"2";s:11:"location_id";s:1:"4";s:10:"act_ftv_id";s:1:"1";s:15:"act_supplier_id";s:1:"2";s:10:"act_status";s:1:"1";s:11:"act_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"actcca_id";s:1:"7";s:21:"calendar_available_id";s:1:"1";s:13:"activities_id";s:2:"24";s:5:"ca_id";s:1:"1";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"6:00 PM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}i:26;a:69:{s:6:"act_id";s:2:"26";s:9:"act_subof";s:1:"3";s:17:"act_cherge_subact";N;s:8:"act_name";s:5:"hhhhh";s:15:"act_bookingtext";s:4:"hhhh";s:15:"act_texteticket";s:4:"hhhh";s:17:"act_purchaseprice";s:2:"12";s:13:"act_saleprice";s:2:"23";s:17:"act_originalstock";s:2:"23";s:15:"act_actualstock";s:2:"45";s:14:"act_choiceitem";s:1:"1";s:17:"act_organiserdate";s:10:"2014-03-14";s:13:"act_payeddate";s:10:"2014-03-15";s:12:"act_deadline";s:10:"2014-03-16";s:13:"act_admintext";s:4:"hhhh";s:8:"photo_id";s:1:"2";s:11:"location_id";s:1:"4";s:10:"act_ftv_id";s:1:"1";s:15:"act_supplier_id";s:1:"3";s:10:"act_status";s:1:"1";s:11:"act_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";N;s:9:"sup_fname";N;s:9:"sup_lname";N;s:16:"sup_company_name";N;s:14:"sup_occupation";N;s:10:"sup_sector";N;s:21:"sup_service_provision";N;s:11:"sup_country";N;s:8:"sup_city";N;s:11:"sup_address";N;s:12:"sup_postcode";N;s:9:"sup_email";N;s:11:"sup_website";N;s:9:"sup_phone";N;s:14:"sup_home_phone";N;s:11:"sup_deleted";N;s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"actcca_id";s:1:"9";s:21:"calendar_available_id";s:1:"2";s:13:"activities_id";s:2:"26";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}i:4;a:1:{i:25;a:69:{s:6:"act_id";s:2:"25";s:9:"act_subof";s:1:"4";s:17:"act_cherge_subact";N;s:8:"act_name";s:5:"ggggg";s:15:"act_bookingtext";s:5:"ggggg";s:15:"act_texteticket";s:5:"ggggg";s:17:"act_purchaseprice";s:2:"12";s:13:"act_saleprice";s:2:"23";s:17:"act_originalstock";s:2:"34";s:15:"act_actualstock";s:2:"22";s:14:"act_choiceitem";s:1:"1";s:17:"act_organiserdate";s:10:"2014-03-14";s:13:"act_payeddate";s:10:"2014-03-14";s:12:"act_deadline";s:10:"2014-03-15";s:13:"act_admintext";s:5:"ggggg";s:8:"photo_id";s:1:"2";s:11:"location_id";s:1:"4";s:10:"act_ftv_id";s:1:"1";s:15:"act_supplier_id";s:1:"1";s:10:"act_status";s:1:"1";s:11:"act_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"1";s:9:"sup_fname";s:7:"sreynak";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:7:"sreynak";s:14:"sup_occupation";N;s:10:"sup_sector";s:2:"IT";s:21:"sup_service_provision";s:6:"Webapp";s:11:"sup_country";s:15:"Kampong Chhnang";s:8:"sup_city";s:15:"Kampong Chhnang";s:11:"sup_address";s:10:"Phnom Penh";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:17:"sreynak@gmail.com";s:11:"sup_website";s:15:"www.sreynak.com";s:9:"sup_phone";s:10:"0123456789";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"actcca_id";s:1:"8";s:21:"calendar_available_id";s:1:"2";s:13:"activities_id";s:2:"25";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}}s:15:"extraproduct-pk";a:3:{i:3;a:1:{i:3;a:55:{s:5:"ep_id";s:1:"3";s:7:"ep_name";s:3:"lux";s:12:"ep_perperson";s:1:"0";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:3:"lux";s:14:"ep_etickettext";s:3:"lux";s:8:"photo_id";s:1:"1";s:11:"supplier_id";s:1:"2";s:16:"ep_purchaseprice";s:2:"23";s:12:"ep_saleprice";s:2:"76";s:16:"ep_originalstock";s:2:"21";s:14:"ep_actualstock";s:2:"25";s:15:"ep_providerdate";s:10:"2014-03-06";s:12:"ep_payeddate";s:10:"2014-03-06";s:11:"ep_deadline";s:10:"2014-03-06";s:12:"ep_admintext";s:3:"lux";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:8:"ep_cl_id";s:1:"5";s:21:"calendar_available_id";s:1:"2";s:15:"extraproduct_id";s:1:"3";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:5:"j.jpg";s:10:"pho_detail";s:4:"test";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}i:4;a:1:{i:4;a:55:{s:5:"ep_id";s:1:"4";s:7:"ep_name";s:6:"ticket";s:12:"ep_perperson";s:1:"1";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:6:"ticket";s:14:"ep_etickettext";s:6:"ticket";s:8:"photo_id";s:1:"2";s:11:"supplier_id";s:1:"3";s:16:"ep_purchaseprice";s:2:"23";s:12:"ep_saleprice";s:2:"45";s:16:"ep_originalstock";s:2:"65";s:14:"ep_actualstock";s:3:"144";s:15:"ep_providerdate";s:10:"2014-03-06";s:12:"ep_payeddate";s:10:"2014-03-06";s:11:"ep_deadline";s:10:"2014-03-06";s:12:"ep_admintext";s:6:"ticket";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";N;s:9:"sup_fname";N;s:9:"sup_lname";N;s:16:"sup_company_name";N;s:14:"sup_occupation";N;s:10:"sup_sector";N;s:21:"sup_service_provision";N;s:11:"sup_country";N;s:8:"sup_city";N;s:11:"sup_address";N;s:12:"sup_postcode";N;s:9:"sup_email";N;s:11:"sup_website";N;s:9:"sup_phone";N;s:14:"sup_home_phone";N;s:11:"sup_deleted";N;s:8:"ep_cl_id";s:1:"4";s:21:"calendar_available_id";s:1:"4";s:15:"extraproduct_id";s:1:"4";s:5:"ca_id";s:1:"4";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"3:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}i:1;a:1:{i:1;a:55:{s:5:"ep_id";s:1:"1";s:7:"ep_name";s:5:"test1";s:12:"ep_perperson";s:1:"1";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:4:"test";s:14:"ep_etickettext";s:4:"test";s:8:"photo_id";s:1:"2";s:11:"supplier_id";s:1:"3";s:16:"ep_purchaseprice";s:2:"20";s:12:"ep_saleprice";s:2:"20";s:16:"ep_originalstock";s:2:"20";s:14:"ep_actualstock";s:2:"20";s:15:"ep_providerdate";s:10:"2014-03-06";s:12:"ep_payeddate";s:10:"2013-03-06";s:11:"ep_deadline";s:10:"2014-03-06";s:12:"ep_admintext";s:4:"test";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";N;s:9:"sup_fname";N;s:9:"sup_lname";N;s:16:"sup_company_name";N;s:14:"sup_occupation";N;s:10:"sup_sector";N;s:21:"sup_service_provision";N;s:11:"sup_country";N;s:8:"sup_city";N;s:11:"sup_address";N;s:12:"sup_postcode";N;s:9:"sup_email";N;s:11:"sup_website";N;s:9:"sup_phone";N;s:14:"sup_home_phone";N;s:11:"sup_deleted";N;s:8:"ep_cl_id";s:1:"1";s:21:"calendar_available_id";s:1:"1";s:15:"extraproduct_id";s:1:"1";s:5:"ca_id";s:1:"1";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"6:00 PM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}}}', 'a:3:{s:14:"main-transport";a:2:{i:3;a:68:{s:5:"tp_id";s:1:"3";s:8:"tp_subof";s:1:"0";s:7:"tp_name";s:4:"bbbb";s:14:"tp_textbooking";s:4:"bbbb";s:14:"tp_texteticket";s:4:"bbbb";s:16:"tp_purchaseprice";s:3:"111";s:12:"tp_saleprice";s:2:"23";s:16:"tp_originalstock";s:2:"32";s:14:"tp_actualstock";s:2:"22";s:15:"tp_providerdate";s:10:"2014-03-15";s:12:"tp_payeddate";s:10:"2014-03-16";s:11:"tp_deadline";s:10:"2014-03-23";s:12:"tp_admintext";s:3:"bbb";s:17:"tp_pickuplocation";s:1:"4";s:15:"tp_arrival_date";s:10:"2014-03-29";s:8:"photo_id";s:1:"2";s:9:"tp_ftv_id";s:1:"1";s:14:"tp_supplier_id";s:1:"2";s:9:"tp_status";s:1:"1";s:10:"tp_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"tp_cal_id";s:1:"3";s:21:"calendar_available_id";s:2:"24";s:12:"transport_id";s:1:"3";s:5:"ca_id";s:2:"24";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-15";s:8:"end_date";s:10:"2014-03-30";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"6:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}i:4;a:68:{s:5:"tp_id";s:1:"4";s:8:"tp_subof";s:1:"0";s:7:"tp_name";s:4:"nnnn";s:14:"tp_textbooking";s:4:"nnnn";s:14:"tp_texteticket";s:4:"nnnn";s:16:"tp_purchaseprice";s:2:"12";s:12:"tp_saleprice";s:2:"12";s:16:"tp_originalstock";s:2:"35";s:14:"tp_actualstock";s:2:"67";s:15:"tp_providerdate";s:10:"2014-03-22";s:12:"tp_payeddate";s:10:"2014-03-20";s:11:"tp_deadline";s:10:"2014-03-31";s:12:"tp_admintext";s:4:"nnnn";s:17:"tp_pickuplocation";s:1:"4";s:15:"tp_arrival_date";s:10:"2014-03-17";s:8:"photo_id";s:1:"2";s:9:"tp_ftv_id";s:1:"1";s:14:"tp_supplier_id";s:1:"2";s:9:"tp_status";s:1:"1";s:10:"tp_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"tp_cal_id";s:1:"4";s:21:"calendar_available_id";s:2:"25";s:12:"transport_id";s:1:"4";s:5:"ca_id";s:2:"25";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-15";s:8:"end_date";s:10:"2014-03-30";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"4:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}s:13:"sub-transport";a:2:{i:3;a:1:{i:6;a:68:{s:5:"tp_id";s:1:"6";s:8:"tp_subof";s:1:"3";s:7:"tp_name";s:4:"pppp";s:14:"tp_textbooking";s:4:"pppp";s:14:"tp_texteticket";s:4:"nnnn";s:16:"tp_purchaseprice";s:2:"12";s:12:"tp_saleprice";s:2:"12";s:16:"tp_originalstock";s:2:"35";s:14:"tp_actualstock";s:2:"67";s:15:"tp_providerdate";s:10:"2014-03-22";s:12:"tp_payeddate";s:10:"2014-03-20";s:11:"tp_deadline";s:10:"2014-03-31";s:12:"tp_admintext";s:4:"nnnn";s:17:"tp_pickuplocation";s:1:"4";s:15:"tp_arrival_date";s:10:"2014-03-17";s:8:"photo_id";s:1:"2";s:9:"tp_ftv_id";s:1:"1";s:14:"tp_supplier_id";s:1:"2";s:9:"tp_status";s:1:"1";s:10:"tp_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"tp_cal_id";s:1:"6";s:21:"calendar_available_id";s:2:"24";s:12:"transport_id";s:1:"6";s:5:"ca_id";s:2:"24";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-15";s:8:"end_date";s:10:"2014-03-30";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"6:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}i:4;a:1:{i:5;a:68:{s:5:"tp_id";s:1:"5";s:8:"tp_subof";s:1:"4";s:7:"tp_name";s:4:"oooo";s:14:"tp_textbooking";s:4:"0000";s:14:"tp_texteticket";s:4:"nnnn";s:16:"tp_purchaseprice";s:2:"12";s:12:"tp_saleprice";s:2:"12";s:16:"tp_originalstock";s:2:"35";s:14:"tp_actualstock";s:2:"67";s:15:"tp_providerdate";s:10:"2014-03-22";s:12:"tp_payeddate";s:10:"2014-03-20";s:11:"tp_deadline";s:10:"2014-03-31";s:12:"tp_admintext";s:4:"nnnn";s:17:"tp_pickuplocation";s:1:"4";s:15:"tp_arrival_date";s:10:"2014-03-17";s:8:"photo_id";s:1:"2";s:9:"tp_ftv_id";s:1:"1";s:14:"tp_supplier_id";s:1:"2";s:9:"tp_status";s:1:"1";s:10:"tp_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"tp_cal_id";s:1:"5";s:21:"calendar_available_id";s:2:"25";s:12:"transport_id";s:1:"5";s:5:"ca_id";s:2:"25";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-15";s:8:"end_date";s:10:"2014-03-30";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"4:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}}s:15:"extraproduct-pk";a:2:{i:3;a:1:{i:33;a:55:{s:5:"ep_id";s:2:"33";s:7:"ep_name";s:3:"hhh";s:12:"ep_perperson";s:1:"1";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:6:"rerrrr";s:14:"ep_etickettext";s:6:"terttt";s:8:"photo_id";s:1:"3";s:11:"supplier_id";s:1:"4";s:16:"ep_purchaseprice";s:2:"21";s:12:"ep_saleprice";s:2:"12";s:16:"ep_originalstock";s:2:"32";s:14:"ep_actualstock";s:2:"45";s:15:"ep_providerdate";s:10:"2014-03-12";s:12:"ep_payeddate";s:10:"2014-03-12";s:11:"ep_deadline";s:10:"2014-03-13";s:12:"ep_admintext";s:6:"rrrrrr";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";s:1:"4";s:9:"sup_fname";s:4:"rany";s:9:"sup_lname";s:2:"ra";s:16:"sup_company_name";s:4:"Rany";s:14:"sup_occupation";s:6:"tester";s:10:"sup_sector";s:2:"IT";s:21:"sup_service_provision";s:4:"test";s:11:"sup_country";s:2:"pp";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"899";s:9:"sup_email";s:14:"rany@gmail.com";s:11:"sup_website";s:8:"rany.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:8:"09876542";s:11:"sup_deleted";s:1:"0";s:8:"ep_cl_id";s:1:"7";s:21:"calendar_available_id";s:1:"2";s:15:"extraproduct_id";s:2:"33";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:4:"test";s:10:"pho_detail";s:4:"test";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}i:4;a:1:{i:3;a:55:{s:5:"ep_id";s:1:"3";s:7:"ep_name";s:3:"lux";s:12:"ep_perperson";s:1:"0";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:3:"lux";s:14:"ep_etickettext";s:3:"lux";s:8:"photo_id";s:1:"1";s:11:"supplier_id";s:1:"2";s:16:"ep_purchaseprice";s:2:"23";s:12:"ep_saleprice";s:2:"76";s:16:"ep_originalstock";s:2:"21";s:14:"ep_actualstock";s:2:"25";s:15:"ep_providerdate";s:10:"2014-03-06";s:12:"ep_payeddate";s:10:"2014-03-06";s:11:"ep_deadline";s:10:"2014-03-06";s:12:"ep_admintext";s:3:"lux";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:8:"ep_cl_id";s:1:"5";s:21:"calendar_available_id";s:1:"2";s:15:"extraproduct_id";s:1:"3";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:5:"j.jpg";s:10:"pho_detail";s:4:"test";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}}}', 2, 1, 1, 1, 0),
	(5, '2014-03-31', '2014-04-03', 'Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today', 'Hello how are you today Hello how are you today', 10, 10, 12, 14, 'a:3:{s:18:"main-accommodation";a:1:{i:13;a:77:{s:6:"acc_id";s:2:"13";s:9:"acc_subof";s:1:"0";s:8:"acc_name";s:4:"test";s:15:"acc_bookingtext";s:4:"test";s:15:"acc_texteticket";s:4:"test";s:17:"acc_purchaseprice";s:2:"21";s:13:"acc_saleprice";s:2:"23";s:17:"acc_originalstock";s:2:"32";s:15:"acc_actualstock";s:2:"34";s:13:"acc_hoteldate";s:10:"2014-03-14";s:13:"acc_payeddate";s:10:"2014-03-14";s:12:"acc_deadline";s:10:"2014-03-14";s:13:"acc_admintext";s:4:"test";s:11:"location_id";s:1:"4";s:8:"photo_id";s:1:"2";s:9:"acc_rt_id";N;s:10:"acc_ftv_id";s:1:"1";s:17:"classification_id";s:1:"3";s:15:"acc_supplier_id";s:1:"2";s:10:"acc_status";s:1:"1";s:11:"acc_deleted";s:1:"0";s:5:"rt_id";N;s:7:"rt_name";N;s:9:"rt_status";N;s:10:"rt_deleted";N;s:6:"clf_id";s:1:"3";s:8:"clf_name";s:10:"Three Star";s:9:"clf_value";s:1:"3";s:11:"clf_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:8:"accca_id";s:1:"7";s:16:"accomodations_id";s:2:"13";s:21:"calendar_available_id";s:1:"2";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}s:17:"sub-accommodation";a:1:{i:13;a:1:{i:19;a:77:{s:6:"acc_id";s:2:"19";s:9:"acc_subof";s:2:"13";s:8:"acc_name";s:3:"eee";s:15:"acc_bookingtext";s:4:"bbbb";s:15:"acc_texteticket";s:4:"bbbb";s:17:"acc_purchaseprice";s:2:"21";s:13:"acc_saleprice";s:3:"300";s:17:"acc_originalstock";s:2:"32";s:15:"acc_actualstock";s:2:"22";s:13:"acc_hoteldate";s:10:"2014-03-14";s:13:"acc_payeddate";s:10:"2014-03-15";s:12:"acc_deadline";s:10:"2014-03-15";s:13:"acc_admintext";s:4:"bbbb";s:11:"location_id";s:1:"4";s:8:"photo_id";s:1:"1";s:9:"acc_rt_id";s:1:"1";s:10:"acc_ftv_id";s:1:"1";s:17:"classification_id";s:1:"2";s:15:"acc_supplier_id";s:1:"2";s:10:"acc_status";s:1:"1";s:11:"acc_deleted";s:1:"0";s:5:"rt_id";s:1:"1";s:7:"rt_name";s:5:"room1";s:9:"rt_status";s:1:"1";s:10:"rt_deleted";s:1:"1";s:6:"clf_id";s:1:"2";s:8:"clf_name";s:8:"Two Star";s:9:"clf_value";s:1:"2";s:11:"clf_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:8:"accca_id";s:1:"6";s:16:"accomodations_id";s:2:"19";s:21:"calendar_available_id";s:1:"4";s:5:"ca_id";s:1:"4";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"3:00 AM";s:8:"pho_name";s:5:"j.jpg";s:10:"pho_detail";s:4:"test";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}}s:15:"extraproduct-pk";a:1:{i:13;a:1:{i:3;a:55:{s:5:"ep_id";s:1:"3";s:7:"ep_name";s:3:"lux";s:12:"ep_perperson";s:1:"0";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:3:"lux";s:14:"ep_etickettext";s:3:"lux";s:8:"photo_id";s:1:"1";s:11:"supplier_id";s:1:"2";s:16:"ep_purchaseprice";s:2:"23";s:12:"ep_saleprice";s:2:"76";s:16:"ep_originalstock";s:2:"21";s:14:"ep_actualstock";s:2:"25";s:15:"ep_providerdate";s:10:"2014-03-06";s:12:"ep_payeddate";s:10:"2014-03-06";s:11:"ep_deadline";s:10:"2014-03-06";s:12:"ep_admintext";s:3:"lux";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:8:"ep_cl_id";s:1:"5";s:21:"calendar_available_id";s:1:"2";s:15:"extraproduct_id";s:1:"3";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:5:"j.jpg";s:10:"pho_detail";s:4:"test";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}}}', 'a:3:{s:15:"main-activities";a:3:{i:3;a:69:{s:6:"act_id";s:1:"3";s:9:"act_subof";s:1:"0";s:17:"act_cherge_subact";N;s:8:"act_name";s:9:"Cambodia1";s:15:"act_bookingtext";s:4:"dddd";s:15:"act_texteticket";s:4:"dddd";s:17:"act_purchaseprice";s:2:"12";s:13:"act_saleprice";s:2:"23";s:17:"act_originalstock";s:2:"35";s:15:"act_actualstock";s:2:"34";s:14:"act_choiceitem";s:1:"0";s:17:"act_organiserdate";s:10:"2014-03-12";s:13:"act_payeddate";s:10:"2014-03-12";s:12:"act_deadline";s:10:"2014-03-13";s:13:"act_admintext";s:4:"dddd";s:8:"photo_id";s:1:"1";s:11:"location_id";s:1:"4";s:10:"act_ftv_id";s:1:"1";s:15:"act_supplier_id";s:1:"2";s:10:"act_status";s:1:"1";s:11:"act_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"actcca_id";s:1:"3";s:21:"calendar_available_id";s:1:"3";s:13:"activities_id";s:1:"3";s:5:"ca_id";s:1:"3";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"3:00 AM";s:8:"pho_name";s:5:"j.jpg";s:10:"pho_detail";s:4:"test";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}i:4;a:69:{s:6:"act_id";s:1:"4";s:9:"act_subof";s:1:"0";s:17:"act_cherge_subact";N;s:8:"act_name";s:7:"sokeara";s:15:"act_bookingtext";s:5:"fffff";s:15:"act_texteticket";s:5:"fffff";s:17:"act_purchaseprice";s:2:"12";s:13:"act_saleprice";s:3:"300";s:17:"act_originalstock";s:2:"32";s:15:"act_actualstock";s:2:"45";s:14:"act_choiceitem";s:1:"1";s:17:"act_organiserdate";s:10:"2014-03-12";s:13:"act_payeddate";s:10:"2014-03-12";s:12:"act_deadline";s:10:"2014-03-13";s:13:"act_admintext";s:6:"ffffff";s:8:"photo_id";s:1:"2";s:11:"location_id";s:1:"4";s:10:"act_ftv_id";s:1:"1";s:15:"act_supplier_id";s:1:"2";s:10:"act_status";s:1:"1";s:11:"act_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"actcca_id";s:1:"4";s:21:"calendar_available_id";s:1:"4";s:13:"activities_id";s:1:"4";s:5:"ca_id";s:1:"4";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"3:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}i:1;a:69:{s:6:"act_id";s:1:"1";s:9:"act_subof";s:1:"0";s:17:"act_cherge_subact";N;s:8:"act_name";s:4:"test";s:15:"act_bookingtext";s:4:"rrrr";s:15:"act_texteticket";s:3:"rrr";s:17:"act_purchaseprice";s:2:"34";s:13:"act_saleprice";s:2:"33";s:17:"act_originalstock";s:2:"44";s:15:"act_actualstock";s:2:"67";s:14:"act_choiceitem";s:1:"1";s:17:"act_organiserdate";s:10:"2014-03-13";s:13:"act_payeddate";s:10:"2014-03-13";s:12:"act_deadline";s:10:"2014-03-13";s:13:"act_admintext";s:4:"rrrr";s:8:"photo_id";s:1:"2";s:11:"location_id";s:1:"4";s:10:"act_ftv_id";s:1:"1";s:15:"act_supplier_id";s:1:"1";s:10:"act_status";s:1:"1";s:11:"act_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"1";s:9:"sup_fname";s:7:"sreynak";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:7:"sreynak";s:14:"sup_occupation";N;s:10:"sup_sector";s:2:"IT";s:21:"sup_service_provision";s:6:"Webapp";s:11:"sup_country";s:15:"Kampong Chhnang";s:8:"sup_city";s:15:"Kampong Chhnang";s:11:"sup_address";s:10:"Phnom Penh";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:17:"sreynak@gmail.com";s:11:"sup_website";s:15:"www.sreynak.com";s:9:"sup_phone";s:10:"0123456789";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"actcca_id";s:1:"1";s:21:"calendar_available_id";s:1:"1";s:13:"activities_id";s:1:"1";s:5:"ca_id";s:1:"1";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"6:00 PM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}s:14:"sub-activities";a:2:{i:3;a:2:{i:24;a:69:{s:6:"act_id";s:2:"24";s:9:"act_subof";s:1:"3";s:17:"act_cherge_subact";N;s:8:"act_name";s:7:"fffffff";s:15:"act_bookingtext";s:3:"fff";s:15:"act_texteticket";s:4:"ffff";s:17:"act_purchaseprice";s:2:"12";s:13:"act_saleprice";s:2:"12";s:17:"act_originalstock";s:2:"35";s:15:"act_actualstock";s:2:"34";s:14:"act_choiceitem";s:1:"1";s:17:"act_organiserdate";s:10:"2014-03-14";s:13:"act_payeddate";s:10:"2014-03-14";s:12:"act_deadline";s:10:"2014-03-15";s:13:"act_admintext";s:3:"fff";s:8:"photo_id";s:1:"2";s:11:"location_id";s:1:"4";s:10:"act_ftv_id";s:1:"1";s:15:"act_supplier_id";s:1:"2";s:10:"act_status";s:1:"1";s:11:"act_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"actcca_id";s:1:"7";s:21:"calendar_available_id";s:1:"1";s:13:"activities_id";s:2:"24";s:5:"ca_id";s:1:"1";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"6:00 PM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}i:26;a:69:{s:6:"act_id";s:2:"26";s:9:"act_subof";s:1:"3";s:17:"act_cherge_subact";N;s:8:"act_name";s:5:"hhhhh";s:15:"act_bookingtext";s:4:"hhhh";s:15:"act_texteticket";s:4:"hhhh";s:17:"act_purchaseprice";s:2:"12";s:13:"act_saleprice";s:2:"23";s:17:"act_originalstock";s:2:"23";s:15:"act_actualstock";s:2:"45";s:14:"act_choiceitem";s:1:"1";s:17:"act_organiserdate";s:10:"2014-03-14";s:13:"act_payeddate";s:10:"2014-03-15";s:12:"act_deadline";s:10:"2014-03-16";s:13:"act_admintext";s:4:"hhhh";s:8:"photo_id";s:1:"2";s:11:"location_id";s:1:"4";s:10:"act_ftv_id";s:1:"1";s:15:"act_supplier_id";s:1:"3";s:10:"act_status";s:1:"1";s:11:"act_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";N;s:9:"sup_fname";N;s:9:"sup_lname";N;s:16:"sup_company_name";N;s:14:"sup_occupation";N;s:10:"sup_sector";N;s:21:"sup_service_provision";N;s:11:"sup_country";N;s:8:"sup_city";N;s:11:"sup_address";N;s:12:"sup_postcode";N;s:9:"sup_email";N;s:11:"sup_website";N;s:9:"sup_phone";N;s:14:"sup_home_phone";N;s:11:"sup_deleted";N;s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"actcca_id";s:1:"9";s:21:"calendar_available_id";s:1:"2";s:13:"activities_id";s:2:"26";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}i:4;a:1:{i:25;a:69:{s:6:"act_id";s:2:"25";s:9:"act_subof";s:1:"4";s:17:"act_cherge_subact";N;s:8:"act_name";s:5:"ggggg";s:15:"act_bookingtext";s:5:"ggggg";s:15:"act_texteticket";s:5:"ggggg";s:17:"act_purchaseprice";s:2:"12";s:13:"act_saleprice";s:2:"23";s:17:"act_originalstock";s:2:"34";s:15:"act_actualstock";s:2:"22";s:14:"act_choiceitem";s:1:"1";s:17:"act_organiserdate";s:10:"2014-03-14";s:13:"act_payeddate";s:10:"2014-03-14";s:12:"act_deadline";s:10:"2014-03-15";s:13:"act_admintext";s:5:"ggggg";s:8:"photo_id";s:1:"2";s:11:"location_id";s:1:"4";s:10:"act_ftv_id";s:1:"1";s:15:"act_supplier_id";s:1:"1";s:10:"act_status";s:1:"1";s:11:"act_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"1";s:9:"sup_fname";s:7:"sreynak";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:7:"sreynak";s:14:"sup_occupation";N;s:10:"sup_sector";s:2:"IT";s:21:"sup_service_provision";s:6:"Webapp";s:11:"sup_country";s:15:"Kampong Chhnang";s:8:"sup_city";s:15:"Kampong Chhnang";s:11:"sup_address";s:10:"Phnom Penh";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:17:"sreynak@gmail.com";s:11:"sup_website";s:15:"www.sreynak.com";s:9:"sup_phone";s:10:"0123456789";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"actcca_id";s:1:"8";s:21:"calendar_available_id";s:1:"2";s:13:"activities_id";s:2:"25";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}}s:15:"extraproduct-pk";a:3:{i:3;a:1:{i:3;a:55:{s:5:"ep_id";s:1:"3";s:7:"ep_name";s:3:"lux";s:12:"ep_perperson";s:1:"0";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:3:"lux";s:14:"ep_etickettext";s:3:"lux";s:8:"photo_id";s:1:"1";s:11:"supplier_id";s:1:"2";s:16:"ep_purchaseprice";s:2:"23";s:12:"ep_saleprice";s:2:"76";s:16:"ep_originalstock";s:2:"21";s:14:"ep_actualstock";s:2:"25";s:15:"ep_providerdate";s:10:"2014-03-06";s:12:"ep_payeddate";s:10:"2014-03-06";s:11:"ep_deadline";s:10:"2014-03-06";s:12:"ep_admintext";s:3:"lux";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:8:"ep_cl_id";s:1:"5";s:21:"calendar_available_id";s:1:"2";s:15:"extraproduct_id";s:1:"3";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:5:"j.jpg";s:10:"pho_detail";s:4:"test";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}i:4;a:1:{i:4;a:55:{s:5:"ep_id";s:1:"4";s:7:"ep_name";s:6:"ticket";s:12:"ep_perperson";s:1:"1";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:6:"ticket";s:14:"ep_etickettext";s:6:"ticket";s:8:"photo_id";s:1:"2";s:11:"supplier_id";s:1:"3";s:16:"ep_purchaseprice";s:2:"23";s:12:"ep_saleprice";s:2:"45";s:16:"ep_originalstock";s:2:"65";s:14:"ep_actualstock";s:3:"144";s:15:"ep_providerdate";s:10:"2014-03-06";s:12:"ep_payeddate";s:10:"2014-03-06";s:11:"ep_deadline";s:10:"2014-03-06";s:12:"ep_admintext";s:6:"ticket";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";N;s:9:"sup_fname";N;s:9:"sup_lname";N;s:16:"sup_company_name";N;s:14:"sup_occupation";N;s:10:"sup_sector";N;s:21:"sup_service_provision";N;s:11:"sup_country";N;s:8:"sup_city";N;s:11:"sup_address";N;s:12:"sup_postcode";N;s:9:"sup_email";N;s:11:"sup_website";N;s:9:"sup_phone";N;s:14:"sup_home_phone";N;s:11:"sup_deleted";N;s:8:"ep_cl_id";s:1:"4";s:21:"calendar_available_id";s:1:"4";s:15:"extraproduct_id";s:1:"4";s:5:"ca_id";s:1:"4";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"3:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}i:1;a:1:{i:1;a:55:{s:5:"ep_id";s:1:"1";s:7:"ep_name";s:5:"test1";s:12:"ep_perperson";s:1:"1";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:4:"test";s:14:"ep_etickettext";s:4:"test";s:8:"photo_id";s:1:"2";s:11:"supplier_id";s:1:"3";s:16:"ep_purchaseprice";s:2:"20";s:12:"ep_saleprice";s:2:"20";s:16:"ep_originalstock";s:2:"20";s:14:"ep_actualstock";s:2:"20";s:15:"ep_providerdate";s:10:"2014-03-06";s:12:"ep_payeddate";s:10:"2013-03-06";s:11:"ep_deadline";s:10:"2014-03-06";s:12:"ep_admintext";s:4:"test";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";N;s:9:"sup_fname";N;s:9:"sup_lname";N;s:16:"sup_company_name";N;s:14:"sup_occupation";N;s:10:"sup_sector";N;s:21:"sup_service_provision";N;s:11:"sup_country";N;s:8:"sup_city";N;s:11:"sup_address";N;s:12:"sup_postcode";N;s:9:"sup_email";N;s:11:"sup_website";N;s:9:"sup_phone";N;s:14:"sup_home_phone";N;s:11:"sup_deleted";N;s:8:"ep_cl_id";s:1:"1";s:21:"calendar_available_id";s:1:"1";s:15:"extraproduct_id";s:1:"1";s:5:"ca_id";s:1:"1";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"6:00 PM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}}}', 'a:3:{s:14:"main-transport";a:2:{i:3;a:68:{s:5:"tp_id";s:1:"3";s:8:"tp_subof";s:1:"0";s:7:"tp_name";s:4:"bbbb";s:14:"tp_textbooking";s:4:"bbbb";s:14:"tp_texteticket";s:4:"bbbb";s:16:"tp_purchaseprice";s:3:"111";s:12:"tp_saleprice";s:2:"23";s:16:"tp_originalstock";s:2:"32";s:14:"tp_actualstock";s:2:"22";s:15:"tp_providerdate";s:10:"2014-03-15";s:12:"tp_payeddate";s:10:"2014-03-16";s:11:"tp_deadline";s:10:"2014-03-23";s:12:"tp_admintext";s:3:"bbb";s:17:"tp_pickuplocation";s:1:"4";s:15:"tp_arrival_date";s:10:"2014-03-29";s:8:"photo_id";s:1:"2";s:9:"tp_ftv_id";s:1:"1";s:14:"tp_supplier_id";s:1:"2";s:9:"tp_status";s:1:"1";s:10:"tp_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"tp_cal_id";s:1:"3";s:21:"calendar_available_id";s:2:"24";s:12:"transport_id";s:1:"3";s:5:"ca_id";s:2:"24";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-15";s:8:"end_date";s:10:"2014-03-30";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"6:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}i:4;a:68:{s:5:"tp_id";s:1:"4";s:8:"tp_subof";s:1:"0";s:7:"tp_name";s:4:"nnnn";s:14:"tp_textbooking";s:4:"nnnn";s:14:"tp_texteticket";s:4:"nnnn";s:16:"tp_purchaseprice";s:2:"12";s:12:"tp_saleprice";s:2:"12";s:16:"tp_originalstock";s:2:"35";s:14:"tp_actualstock";s:2:"67";s:15:"tp_providerdate";s:10:"2014-03-22";s:12:"tp_payeddate";s:10:"2014-03-20";s:11:"tp_deadline";s:10:"2014-03-31";s:12:"tp_admintext";s:4:"nnnn";s:17:"tp_pickuplocation";s:1:"4";s:15:"tp_arrival_date";s:10:"2014-03-17";s:8:"photo_id";s:1:"2";s:9:"tp_ftv_id";s:1:"1";s:14:"tp_supplier_id";s:1:"2";s:9:"tp_status";s:1:"1";s:10:"tp_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"tp_cal_id";s:1:"4";s:21:"calendar_available_id";s:2:"25";s:12:"transport_id";s:1:"4";s:5:"ca_id";s:2:"25";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-15";s:8:"end_date";s:10:"2014-03-30";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"4:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}s:13:"sub-transport";a:2:{i:3;a:1:{i:6;a:68:{s:5:"tp_id";s:1:"6";s:8:"tp_subof";s:1:"3";s:7:"tp_name";s:4:"pppp";s:14:"tp_textbooking";s:4:"pppp";s:14:"tp_texteticket";s:4:"nnnn";s:16:"tp_purchaseprice";s:2:"12";s:12:"tp_saleprice";s:2:"12";s:16:"tp_originalstock";s:2:"35";s:14:"tp_actualstock";s:2:"67";s:15:"tp_providerdate";s:10:"2014-03-22";s:12:"tp_payeddate";s:10:"2014-03-20";s:11:"tp_deadline";s:10:"2014-03-31";s:12:"tp_admintext";s:4:"nnnn";s:17:"tp_pickuplocation";s:1:"4";s:15:"tp_arrival_date";s:10:"2014-03-17";s:8:"photo_id";s:1:"2";s:9:"tp_ftv_id";s:1:"1";s:14:"tp_supplier_id";s:1:"2";s:9:"tp_status";s:1:"1";s:10:"tp_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"tp_cal_id";s:1:"6";s:21:"calendar_available_id";s:2:"24";s:12:"transport_id";s:1:"6";s:5:"ca_id";s:2:"24";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-15";s:8:"end_date";s:10:"2014-03-30";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"6:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}i:4;a:1:{i:5;a:68:{s:5:"tp_id";s:1:"5";s:8:"tp_subof";s:1:"4";s:7:"tp_name";s:4:"oooo";s:14:"tp_textbooking";s:4:"0000";s:14:"tp_texteticket";s:4:"nnnn";s:16:"tp_purchaseprice";s:2:"12";s:12:"tp_saleprice";s:2:"12";s:16:"tp_originalstock";s:2:"35";s:14:"tp_actualstock";s:2:"67";s:15:"tp_providerdate";s:10:"2014-03-22";s:12:"tp_payeddate";s:10:"2014-03-20";s:11:"tp_deadline";s:10:"2014-03-31";s:12:"tp_admintext";s:4:"nnnn";s:17:"tp_pickuplocation";s:1:"4";s:15:"tp_arrival_date";s:10:"2014-03-17";s:8:"photo_id";s:1:"2";s:9:"tp_ftv_id";s:1:"1";s:14:"tp_supplier_id";s:1:"2";s:9:"tp_status";s:1:"1";s:10:"tp_deleted";s:1:"0";s:5:"lt_id";s:1:"4";s:7:"lt_name";s:8:"anywhere";s:9:"lt_status";s:1:"1";s:10:"lt_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:6:"ftv_id";s:1:"1";s:8:"ftv_name";s:10:"Festival 2";s:12:"ftv_photo_id";s:1:"2";s:9:"ftv_lt_id";s:1:"2";s:10:"ftv_detail";s:152:"Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display Display ";s:11:"ftv_deleted";s:1:"0";s:10:"ftv_status";s:1:"1";s:9:"tp_cal_id";s:1:"5";s:21:"calendar_available_id";s:2:"25";s:12:"transport_id";s:1:"5";s:5:"ca_id";s:2:"25";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-15";s:8:"end_date";s:10:"2014-03-30";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"4:00 AM";s:8:"pho_name";s:5:"k.jpg";s:10:"pho_detail";s:5:"test1";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}}s:15:"extraproduct-pk";a:2:{i:3;a:1:{i:33;a:55:{s:5:"ep_id";s:2:"33";s:7:"ep_name";s:3:"hhh";s:12:"ep_perperson";s:1:"1";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:6:"rerrrr";s:14:"ep_etickettext";s:6:"terttt";s:8:"photo_id";s:1:"3";s:11:"supplier_id";s:1:"4";s:16:"ep_purchaseprice";s:2:"21";s:12:"ep_saleprice";s:2:"12";s:16:"ep_originalstock";s:2:"32";s:14:"ep_actualstock";s:2:"45";s:15:"ep_providerdate";s:10:"2014-03-12";s:12:"ep_payeddate";s:10:"2014-03-12";s:11:"ep_deadline";s:10:"2014-03-13";s:12:"ep_admintext";s:6:"rrrrrr";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";s:1:"4";s:9:"sup_fname";s:4:"rany";s:9:"sup_lname";s:2:"ra";s:16:"sup_company_name";s:4:"Rany";s:14:"sup_occupation";s:6:"tester";s:10:"sup_sector";s:2:"IT";s:21:"sup_service_provision";s:4:"test";s:11:"sup_country";s:2:"pp";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"899";s:9:"sup_email";s:14:"rany@gmail.com";s:11:"sup_website";s:8:"rany.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:8:"09876542";s:11:"sup_deleted";s:1:"0";s:8:"ep_cl_id";s:1:"7";s:21:"calendar_available_id";s:1:"2";s:15:"extraproduct_id";s:2:"33";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:4:"test";s:10:"pho_detail";s:4:"test";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}i:4;a:1:{i:3;a:55:{s:5:"ep_id";s:1:"3";s:7:"ep_name";s:3:"lux";s:12:"ep_perperson";s:1:"0";s:13:"ep_perbooking";s:1:"1";s:14:"ep_bookingtext";s:3:"lux";s:14:"ep_etickettext";s:3:"lux";s:8:"photo_id";s:1:"1";s:11:"supplier_id";s:1:"2";s:16:"ep_purchaseprice";s:2:"23";s:12:"ep_saleprice";s:2:"76";s:16:"ep_originalstock";s:2:"21";s:14:"ep_actualstock";s:2:"25";s:15:"ep_providerdate";s:10:"2014-03-06";s:12:"ep_payeddate";s:10:"2014-03-06";s:11:"ep_deadline";s:10:"2014-03-06";s:12:"ep_admintext";s:3:"lux";s:9:"ep_status";s:1:"1";s:10:"ep_deleted";s:1:"0";s:6:"sup_id";s:1:"2";s:9:"sup_fname";s:8:"sreynich";s:9:"sup_lname";s:4:"chet";s:16:"sup_company_name";s:8:"sreynich";s:14:"sup_occupation";s:4:"Tour";s:10:"sup_sector";s:4:"Tour";s:21:"sup_service_provision";s:4:"tour";s:11:"sup_country";s:2:"PP";s:8:"sup_city";s:2:"pp";s:11:"sup_address";s:2:"pp";s:12:"sup_postcode";s:3:"855";s:9:"sup_email";s:18:"sreynich@gmail.com";s:11:"sup_website";s:12:"sreynich.com";s:9:"sup_phone";s:9:"098765432";s:14:"sup_home_phone";s:9:"012345678";s:11:"sup_deleted";s:1:"0";s:8:"ep_cl_id";s:1:"5";s:21:"calendar_available_id";s:1:"2";s:15:"extraproduct_id";s:1:"3";s:5:"ca_id";s:1:"2";s:6:"monday";s:1:"1";s:7:"tuesday";s:1:"1";s:9:"wednesday";s:1:"1";s:8:"thursday";s:1:"1";s:6:"friday";s:1:"1";s:8:"saturday";s:1:"1";s:6:"sunday";s:1:"1";s:10:"start_date";s:10:"2014-03-17";s:8:"end_date";s:10:"2014-03-21";s:10:"start_time";s:7:"1:00 AM";s:8:"end_time";s:7:"2:00 AM";s:8:"pho_name";s:5:"j.jpg";s:10:"pho_detail";s:4:"test";s:10:"pho_source";s:25:"2014-02-23_18.03_.47_.jpg";s:10:"pho_status";s:1:"1";s:10:"pho_delete";s:1:"0";s:5:"pt_id";s:1:"1";}}}}', 2, 1, 1, 1, 0),
	(6, '2014-03-31', '2014-04-06', 'Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today Hello how are you today', 'Hello', 10, 10, 12, 14, NULL, NULL, NULL, 2, 1, 1, 1, 0);
/*!40000 ALTER TABLE `package_conjection` ENABLE KEYS */;


-- Dumping structure for table munich_db.passenger
DROP TABLE IF EXISTS `passenger`;
CREATE TABLE IF NOT EXISTS `passenger` (
  `pass_id` int(11) NOT NULL AUTO_INCREMENT,
  `pass_addby` int(11) DEFAULT '0',
  `pass_fname` varchar(50) DEFAULT NULL,
  `pass_lname` varchar(50) DEFAULT NULL,
  `pass_email` varchar(150) DEFAULT NULL,
  `pass_phone` varchar(30) DEFAULT NULL,
  `pass_address` tinytext,
  `pass_company` varchar(70) DEFAULT NULL,
  `pass_password` varchar(100) DEFAULT NULL,
  `pass_gender` char(1) DEFAULT NULL,
  `pass_status` int(11) DEFAULT NULL,
  `pass_deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pass_id`),
  UNIQUE KEY `pass_email_UNIQUE` (`pass_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.passenger: ~2 rows (approximately)
/*!40000 ALTER TABLE `passenger` DISABLE KEYS */;
INSERT INTO `passenger` (`pass_id`, `pass_addby`, `pass_fname`, `pass_lname`, `pass_email`, `pass_phone`, `pass_address`, `pass_company`, `pass_password`, `pass_gender`, `pass_status`, `pass_deleted`) VALUES
	(1, 0, 'sreynak', 'chet', 'sreynak.chet@gmail.com', '098765432', 'Kampong Chhnang', 'Codingate', '123456789', 'F', 1, 0),
	(2, 0, 'test', 'test', 'test@gmail.com', '0987654321', 'phnom penh', 'Codingate', '123456789', 'F', 1, 0);
/*!40000 ALTER TABLE `passenger` ENABLE KEYS */;


-- Dumping structure for table munich_db.passenger_booking
DROP TABLE IF EXISTS `passenger_booking`;
CREATE TABLE IF NOT EXISTS `passenger_booking` (
  `pbk_id` int(11) NOT NULL AUTO_INCREMENT,
  `pbk_pass_come_with` tinytext,
  `pbk_pass_id` int(11) DEFAULT NULL,
  `pbk_bk_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pbk_id`),
  KEY `fk_passenger_booking_passenger1` (`pbk_pass_id`),
  KEY `fk_passenger_booking_booking1` (`pbk_bk_id`),
  CONSTRAINT `fk_passenger_booking_booking1` FOREIGN KEY (`pbk_bk_id`) REFERENCES `booking` (`bk_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_passenger_booking_passenger1` FOREIGN KEY (`pbk_pass_id`) REFERENCES `passenger` (`pass_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.passenger_booking: ~3 rows (approximately)
/*!40000 ALTER TABLE `passenger_booking` DISABLE KEYS */;
INSERT INTO `passenger_booking` (`pbk_id`, `pbk_pass_come_with`, `pbk_pass_id`, `pbk_bk_id`) VALUES
	(1, 'a:1:{i:2;s:1:"2";}', 1, 5),
	(2, NULL, 1, 6),
	(3, NULL, 1, NULL);
/*!40000 ALTER TABLE `passenger_booking` ENABLE KEYS */;


-- Dumping structure for table munich_db.photo
DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `pho_name` varchar(100) DEFAULT NULL,
  `pho_detail` tinytext,
  `pho_source` varchar(100) DEFAULT NULL,
  `pho_status` tinyint(1) DEFAULT NULL,
  `pho_delete` tinyint(1) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `fk_photo_photo_type1` (`pt_id`),
  CONSTRAINT `pt_photo_fk` FOREIGN KEY (`pt_id`) REFERENCES `photo_type` (`pt_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.photo: ~5 rows (approximately)
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` (`photo_id`, `pho_name`, `pho_detail`, `pho_source`, `pho_status`, `pho_delete`, `pt_id`) VALUES
	(1, 'j.jpg', 'test', '2014-02-23_18.03_.47_.jpg', 1, 0, 5),
	(2, 'k.jpg', 'test1', '2014-02-23_18.03_.47_.jpg', 1, 0, 1),
	(3, 'test', 'test', '2014-02-23_18.03_.47_.jpg', 1, 0, 1),
	(4, 'k.jpg', 'test1', '2014-02-23_18.03_.47_.jpg', 1, 0, 1),
	(5, 'k.jpg', 'test', '2014-02-23_18.03_.47_.jpg', 1, 0, 5);
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;


-- Dumping structure for table munich_db.photo_type
DROP TABLE IF EXISTS `photo_type`;
CREATE TABLE IF NOT EXISTS `photo_type` (
  `pt_id` int(11) NOT NULL AUTO_INCREMENT,
  `pt_title` varchar(100) NOT NULL,
  `pt_delete` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.photo_type: ~3 rows (approximately)
/*!40000 ALTER TABLE `photo_type` DISABLE KEYS */;
INSERT INTO `photo_type` (`pt_id`, `pt_title`, `pt_delete`) VALUES
	(1, 'extra product', 0),
	(2, 'activities', 0),
	(5, 'slideshow', 0);
/*!40000 ALTER TABLE `photo_type` ENABLE KEYS */;


-- Dumping structure for table munich_db.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_title` varchar(100) DEFAULT NULL,
  `role_status` tinyint(1) DEFAULT '0',
  `role_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_title_UNIQUE` (`role_title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.roles: ~1 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`role_id`, `role_title`, `role_status`, `role_deleted`) VALUES
	(1, 'super admin', 1, 0);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table munich_db.room_types
DROP TABLE IF EXISTS `room_types`;
CREATE TABLE IF NOT EXISTS `room_types` (
  `rt_id` int(1) NOT NULL AUTO_INCREMENT,
  `rt_name` varchar(100) DEFAULT NULL,
  `rt_status` varchar(45) DEFAULT NULL,
  `rt_deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`rt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.room_types: ~2 rows (approximately)
/*!40000 ALTER TABLE `room_types` DISABLE KEYS */;
INSERT INTO `room_types` (`rt_id`, `rt_name`, `rt_status`, `rt_deleted`) VALUES
	(1, 'room1', '1', 1),
	(3, 'room2a', '1', 0);
/*!40000 ALTER TABLE `room_types` ENABLE KEYS */;


-- Dumping structure for table munich_db.sale_customize
DROP TABLE IF EXISTS `sale_customize`;
CREATE TABLE IF NOT EXISTS `sale_customize` (
  `salecus_id` int(11) NOT NULL AUTO_INCREMENT,
  `salecus_bk_id` int(11) DEFAULT NULL,
  `salecus_cuscon_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`salecus_id`),
  KEY `fk_sale_customize_booking1` (`salecus_bk_id`),
  KEY `fk_sale_customize_customize_conjections1` (`salecus_cuscon_id`),
  CONSTRAINT `fk_sale_customize_booking1` FOREIGN KEY (`salecus_bk_id`) REFERENCES `booking` (`bk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sale_customize_customize_conjections1` FOREIGN KEY (`salecus_cuscon_id`) REFERENCES `customize_conjection` (`cuscon_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.sale_customize: ~0 rows (approximately)
/*!40000 ALTER TABLE `sale_customize` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale_customize` ENABLE KEYS */;


-- Dumping structure for table munich_db.sale_packages
DROP TABLE IF EXISTS `sale_packages`;
CREATE TABLE IF NOT EXISTS `sale_packages` (
  `salepk_id` int(11) NOT NULL AUTO_INCREMENT,
  `salepk_pkcon_id` int(11) DEFAULT NULL,
  `salepk_bk_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`salepk_id`),
  KEY `fk_sale_packages_package_conjection1` (`salepk_pkcon_id`),
  KEY `fk_sale_packages_booking1` (`salepk_bk_id`),
  CONSTRAINT `fk_sale_packages_booking1` FOREIGN KEY (`salepk_bk_id`) REFERENCES `booking` (`bk_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_sale_packages_package_conjection1` FOREIGN KEY (`salepk_pkcon_id`) REFERENCES `package_conjection` (`pkcon_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.sale_packages: ~3 rows (approximately)
/*!40000 ALTER TABLE `sale_packages` DISABLE KEYS */;
INSERT INTO `sale_packages` (`salepk_id`, `salepk_pkcon_id`, `salepk_bk_id`) VALUES
	(1, 4, 5),
	(2, 2, 6),
	(3, 6, NULL);
/*!40000 ALTER TABLE `sale_packages` ENABLE KEYS */;


-- Dumping structure for table munich_db.subscriber
DROP TABLE IF EXISTS `subscriber`;
CREATE TABLE IF NOT EXISTS `subscriber` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_fname` varchar(100) DEFAULT NULL,
  `sub_lname` varchar(100) DEFAULT NULL,
  `sub_email` varchar(100) DEFAULT NULL,
  `sub_status` tinyint(1) DEFAULT NULL,
  `sub_deleted` tinyint(1) DEFAULT NULL,
  `roles_role_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_id`),
  KEY `fk_subscriber_roles1` (`roles_role_id`),
  CONSTRAINT `fk_subscriber_roles1` FOREIGN KEY (`roles_role_id`) REFERENCES `roles` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.subscriber: ~2 rows (approximately)
/*!40000 ALTER TABLE `subscriber` DISABLE KEYS */;
INSERT INTO `subscriber` (`sub_id`, `sub_fname`, `sub_lname`, `sub_email`, `sub_status`, `sub_deleted`, `roles_role_id`) VALUES
	(1, 'sreynak', 'chet', 'sreynak@gmail.com', 1, 0, 1),
	(2, 'sokry', 'sat', 'sokry@gmail.com', 1, 0, 1);
/*!40000 ALTER TABLE `subscriber` ENABLE KEYS */;


-- Dumping structure for table munich_db.supplier
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `sup_id` int(11) NOT NULL AUTO_INCREMENT,
  `sup_fname` varchar(45) DEFAULT NULL,
  `sup_lname` varchar(45) DEFAULT NULL,
  `sup_company_name` varchar(100) DEFAULT NULL,
  `sup_occupation` varchar(100) DEFAULT NULL,
  `sup_sector` varchar(70) DEFAULT NULL,
  `sup_service_provision` varchar(100) DEFAULT NULL,
  `sup_country` varchar(45) DEFAULT NULL,
  `sup_city` varchar(45) DEFAULT NULL,
  `sup_address` tinytext,
  `sup_postcode` varchar(45) DEFAULT NULL,
  `sup_email` varchar(150) DEFAULT NULL,
  `sup_website` varchar(150) DEFAULT NULL,
  `sup_phone` varchar(30) DEFAULT NULL,
  `sup_home_phone` varchar(45) DEFAULT NULL,
  `sup_deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.supplier: ~3 rows (approximately)
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`sup_id`, `sup_fname`, `sup_lname`, `sup_company_name`, `sup_occupation`, `sup_sector`, `sup_service_provision`, `sup_country`, `sup_city`, `sup_address`, `sup_postcode`, `sup_email`, `sup_website`, `sup_phone`, `sup_home_phone`, `sup_deleted`) VALUES
	(1, 'sreynak', 'chet', 'sreynak', NULL, 'IT', 'Webapp', 'Kampong Chhnang', 'Kampong Chhnang', 'Phnom Penh', '855', 'sreynak@gmail.com', 'www.sreynak.com', '0123456789', '012345678', 0),
	(2, 'sreynich', 'chet', 'sreynich', 'Tour', 'Tour', 'tour', 'PP', 'pp', 'pp', '855', 'sreynich@gmail.com', 'sreynich.com', '098765432', '012345678', 0),
	(4, 'rany', 'ra', 'Rany', 'tester', 'IT', 'test', 'pp', 'pp', 'pp', '899', 'rany@gmail.com', 'rany.com', '098765432', '09876542', 0);
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;


-- Dumping structure for table munich_db.temp_table
DROP TABLE IF EXISTS `temp_table`;
CREATE TABLE IF NOT EXISTS `temp_table` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tmpt_id` int(11) DEFAULT '0',
  `tmpt_name` varchar(50) DEFAULT NULL,
  `tmpt_value` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.temp_table: ~2 rows (approximately)
/*!40000 ALTER TABLE `temp_table` DISABLE KEYS */;
INSERT INTO `temp_table` (`ID`, `tmpt_id`, `tmpt_name`, `tmpt_value`) VALUES
	(21, 32, 'act', 'a:2:{i:0;a:19:{s:8:"act_name";s:17:"3 day and 2 night";s:14:"act_choiceitem";s:1:"1";s:11:"location_id";s:1:"1";s:10:"act_ftv_id";s:1:"3";s:15:"act_supplier_id";s:1:"2";s:13:"act_admintext";s:12:"asdfsadfsdaf";s:8:"photo_id";s:1:"2";s:13:"act_saleprice";s:2:"14";s:17:"act_purchaseprice";s:2:"12";s:15:"act_bookingtext";s:10:"sdfasdfsda";s:15:"act_texteticket";s:10:"asdfsadfsd";s:17:"act_originalstock";s:2:"10";s:15:"act_actualstock";s:2:"10";s:17:"act_organiserdate";s:10:"2014-03-21";s:13:"act_payeddate";s:10:"2014-03-30";s:12:"act_deadline";s:10:"2014-03-30";s:10:"act_status";s:1:"1";s:9:"act_subof";s:2:"32";s:17:"act_cherge_subact";s:1:"2";}i:1;a:11:{s:10:"start_date";s:10:"2014-03-21";s:8:"end_date";s:10:"2014-03-30";s:10:"start_time";s:7:"6:30 PM";s:8:"end_time";s:7:"4:15 PM";s:6:"monday";s:1:"1";s:7:"tuesday";i:0;s:9:"wednesday";i:0;s:8:"thursday";i:0;s:6:"friday";s:1:"1";s:8:"saturday";i:0;s:6:"sunday";s:1:"1";}}'),
	(22, 32, 'act', 'a:2:{i:0;a:19:{s:8:"act_name";s:17:"3 day and 2 night";s:14:"act_choiceitem";s:1:"1";s:11:"location_id";s:1:"1";s:10:"act_ftv_id";s:1:"3";s:15:"act_supplier_id";s:1:"2";s:13:"act_admintext";s:12:"asdfsadfsdaf";s:8:"photo_id";s:1:"2";s:13:"act_saleprice";s:2:"14";s:17:"act_purchaseprice";s:2:"12";s:15:"act_bookingtext";s:10:"sdfasdfsda";s:15:"act_texteticket";s:10:"asdfsadfsd";s:17:"act_originalstock";s:2:"10";s:15:"act_actualstock";s:2:"10";s:17:"act_organiserdate";s:10:"2014-03-21";s:13:"act_payeddate";s:10:"2014-03-30";s:12:"act_deadline";s:10:"2014-03-30";s:10:"act_status";s:1:"1";s:9:"act_subof";s:2:"32";s:17:"act_cherge_subact";s:1:"2";}i:1;a:11:{s:10:"start_date";s:10:"2014-03-21";s:8:"end_date";s:10:"2014-03-30";s:10:"start_time";s:7:"6:30 PM";s:8:"end_time";s:7:"4:15 PM";s:6:"monday";s:1:"1";s:7:"tuesday";i:0;s:9:"wednesday";i:0;s:8:"thursday";i:0;s:6:"friday";s:1:"1";s:8:"saturday";i:0;s:6:"sunday";s:1:"1";}}');
/*!40000 ALTER TABLE `temp_table` ENABLE KEYS */;


-- Dumping structure for table munich_db.tp_calendar
DROP TABLE IF EXISTS `tp_calendar`;
CREATE TABLE IF NOT EXISTS `tp_calendar` (
  `tp_cal_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_available_id` int(11) DEFAULT NULL,
  `transport_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tp_cal_id`),
  KEY `fk_tp_calendar_calendar_available1` (`calendar_available_id`),
  KEY `fk_tp_calendar_transport1` (`transport_id`),
  CONSTRAINT `fk_tp_calendar_calendar_available1` FOREIGN KEY (`calendar_available_id`) REFERENCES `calendar_available` (`ca_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tp_calendar_transport1` FOREIGN KEY (`transport_id`) REFERENCES `transportation` (`tp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.tp_calendar: ~6 rows (approximately)
/*!40000 ALTER TABLE `tp_calendar` DISABLE KEYS */;
INSERT INTO `tp_calendar` (`tp_cal_id`, `calendar_available_id`, `transport_id`) VALUES
	(1, 22, 1),
	(2, 23, 2),
	(3, 24, 3),
	(4, 25, 4),
	(5, 25, 5),
	(6, 24, 6);
/*!40000 ALTER TABLE `tp_calendar` ENABLE KEYS */;


-- Dumping structure for table munich_db.transportation
DROP TABLE IF EXISTS `transportation`;
CREATE TABLE IF NOT EXISTS `transportation` (
  `tp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tp_subof` int(11) DEFAULT '0',
  `tp_name` varchar(100) DEFAULT NULL,
  `tp_textbooking` text,
  `tp_texteticket` text,
  `tp_purchaseprice` float DEFAULT NULL,
  `tp_saleprice` float DEFAULT NULL,
  `tp_originalstock` int(11) DEFAULT NULL,
  `tp_actualstock` int(11) DEFAULT NULL,
  `tp_providerdate` varchar(45) DEFAULT NULL,
  `tp_payeddate` varchar(45) DEFAULT NULL,
  `tp_deadline` varchar(45) DEFAULT NULL,
  `tp_admintext` text,
  `tp_pickuplocation` int(11) DEFAULT NULL,
  `tp_arrival_date` date DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `tp_ftv_id` int(11) DEFAULT NULL,
  `tp_supplier_id` int(11) DEFAULT NULL,
  `tp_status` tinyint(1) DEFAULT '0',
  `tp_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`tp_id`),
  KEY `fk_transport_photo1` (`photo_id`),
  KEY `fk_transport_festival1` (`tp_ftv_id`),
  KEY `tp_supplier_id` (`tp_supplier_id`),
  KEY `tp_pickuplocation` (`tp_pickuplocation`),
  CONSTRAINT `fk_transportation_location1` FOREIGN KEY (`tp_pickuplocation`) REFERENCES `location` (`lt_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_transportation_festival1` FOREIGN KEY (`tp_ftv_id`) REFERENCES `festival` (`ftv_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_transportation_photo1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`photo_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_transportation_supplier1` FOREIGN KEY (`tp_supplier_id`) REFERENCES `supplier` (`sup_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.transportation: ~6 rows (approximately)
/*!40000 ALTER TABLE `transportation` DISABLE KEYS */;
INSERT INTO `transportation` (`tp_id`, `tp_subof`, `tp_name`, `tp_textbooking`, `tp_texteticket`, `tp_purchaseprice`, `tp_saleprice`, `tp_originalstock`, `tp_actualstock`, `tp_providerdate`, `tp_payeddate`, `tp_deadline`, `tp_admintext`, `tp_pickuplocation`, `tp_arrival_date`, `photo_id`, `tp_ftv_id`, `tp_supplier_id`, `tp_status`, `tp_deleted`) VALUES
	(1, 0, 'test', 'test', 'test', 21, 33, 35, 45, '2014-03-14', '2014-03-15', '2014-03-16', 'test', 4, '2014-03-15', 2, 1, 1, 1, 0),
	(2, 0, 'fff', 'ffff', 'ffff', 12, 23, 32, 67, '2014-03-15', '2014-03-16', '2014-03-16', 'fff', 4, '2014-03-15', 2, 1, 2, 1, 0),
	(3, 0, 'bbbb', 'bbbb', 'bbbb', 111, 23, 32, 22, '2014-03-15', '2014-03-16', '2014-03-23', 'bbb', 4, '2014-03-29', 2, 1, 2, 1, 0),
	(4, 0, 'nnnn', 'nnnn', 'nnnn', 12, 12, 35, 67, '2014-03-22', '2014-03-20', '2014-03-31', 'nnnn', 4, '2014-03-17', 2, 1, 2, 1, 0),
	(5, 4, 'oooo', '0000', 'nnnn', 12, 12, 35, 67, '2014-03-22', '2014-03-20', '2014-03-31', 'nnnn', 4, '2014-03-17', 2, 1, 2, 1, 0),
	(6, 3, 'pppp', 'pppp', 'nnnn', 12, 12, 35, 67, '2014-03-22', '2014-03-20', '2014-03-31', 'nnnn', 4, '2014-03-17', 2, 1, 2, 1, 0);
/*!40000 ALTER TABLE `transportation` ENABLE KEYS */;


-- Dumping structure for table munich_db.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(100) DEFAULT NULL,
  `user_lname` varchar(100) DEFAULT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_mail` varchar(150) DEFAULT NULL,
  `user_telone` varchar(40) DEFAULT NULL,
  `user_teltwo` varchar(40) DEFAULT NULL,
  `user_fax` varchar(100) DEFAULT NULL,
  `user_mobile` varchar(100) DEFAULT NULL,
  `user_address` tinytext,
  `user_website` tinytext,
  `user_company` varchar(45) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `user_status` tinyint(1) DEFAULT '0',
  `user_deleted` tinyint(1) DEFAULT '0',
  `user_name` varchar(100) DEFAULT NULL,
  `user_gender` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_mail_UNIQUE` (`user_mail`),
  KEY `fk_user_roles` (`role_id`),
  CONSTRAINT `fk_user_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table munich_db.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_password`, `user_mail`, `user_telone`, `user_teltwo`, `user_fax`, `user_mobile`, `user_address`, `user_website`, `user_company`, `role_id`, `user_status`, `user_deleted`, `user_name`, `user_gender`) VALUES
	(1, 'sreynak', 'chet', '123456789', 'sreynak.chet@gmail.com', '123456789', NULL, NULL, NULL, 'pp', NULL, 'Codingate', 1, 1, 0, 'sreynak', 'female'),
	(2, 'saorin', 'phan', '123456789', 'phansaorin@gmail.com', '0987654321', '09876543', NULL, NULL, 'pp', NULL, 'codingate', 1, 1, 0, 'saorin', 'female');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
