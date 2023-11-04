-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.34 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for studyglobe
CREATE DATABASE IF NOT EXISTS `studyglobe` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `studyglobe`;

-- Dumping structure for table studyglobe.country
CREATE TABLE IF NOT EXISTS `country` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.country: ~0 rows (approximately)
INSERT INTO `country` (`id`, `country`) VALUES
	(1, 'singapore');

-- Dumping structure for table studyglobe.country_has_university
CREATE TABLE IF NOT EXISTS `country_has_university` (
  `country_id` int NOT NULL,
  `university_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_country_has_university_university1_idx` (`university_id`),
  KEY `fk_country_has_university_country1_idx` (`country_id`),
  CONSTRAINT `fk_country_has_university_country1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  CONSTRAINT `fk_country_has_university_university1` FOREIGN KEY (`university_id`) REFERENCES `university` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.country_has_university: ~0 rows (approximately)
INSERT INTO `country_has_university` (`country_id`, `university_id`, `id`) VALUES
	(1, 2, 2),
	(1, 4, 4);

-- Dumping structure for table studyglobe.document
CREATE TABLE IF NOT EXISTS `document` (
  `id` int NOT NULL AUTO_INCREMENT,
  `path` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.document: ~0 rows (approximately)

-- Dumping structure for table studyglobe.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.gender: ~0 rows (approximately)
INSERT INTO `gender` (`id`, `gender`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table studyglobe.level
CREATE TABLE IF NOT EXISTS `level` (
  `id` int NOT NULL AUTO_INCREMENT,
  `level` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.level: ~0 rows (approximately)
INSERT INTO `level` (`id`, `level`) VALUES
	(1, 'Certificate'),
	(2, 'Diploma'),
	(3, 'Special Diploma'),
	(4, 'Advance Diploma'),
	(5, 'Bachelor');

-- Dumping structure for table studyglobe.marital
CREATE TABLE IF NOT EXISTS `marital` (
  `id` int NOT NULL AUTO_INCREMENT,
  `marital` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.marital: ~0 rows (approximately)
INSERT INTO `marital` (`id`, `marital`) VALUES
	(1, 'Married'),
	(2, 'Unmarried');

-- Dumping structure for table studyglobe.mode
CREATE TABLE IF NOT EXISTS `mode` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mode` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.mode: ~0 rows (approximately)
INSERT INTO `mode` (`id`, `mode`) VALUES
	(1, 'Full time');

-- Dumping structure for table studyglobe.payment
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `amount` varchar(45) DEFAULT NULL,
  `discountpr` int DEFAULT NULL,
  `discription` longtext,
  `date` date DEFAULT NULL,
  `path` varchar(45) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  `uniqid` varchar(45) DEFAULT NULL,
  `studentdata_id` int NOT NULL,
  `paymenttype_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_studentdata1_idx` (`studentdata_id`),
  KEY `fk_payment_paymenttype1_idx` (`paymenttype_id`),
  CONSTRAINT `fk_payment_paymenttype1` FOREIGN KEY (`paymenttype_id`) REFERENCES `paymenttype` (`id`),
  CONSTRAINT `fk_payment_studentdata1` FOREIGN KEY (`studentdata_id`) REFERENCES `studentdata` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.payment: ~0 rows (approximately)

-- Dumping structure for table studyglobe.paymenttype
CREATE TABLE IF NOT EXISTS `paymenttype` (
  `id` int NOT NULL AUTO_INCREMENT,
  `paymenttype` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.paymenttype: ~0 rows (approximately)
INSERT INTO `paymenttype` (`id`, `paymenttype`) VALUES
	(1, 'Cash'),
	(2, 'Bank deposit');

-- Dumping structure for table studyglobe.program
CREATE TABLE IF NOT EXISTS `program` (
  `id` int NOT NULL AUTO_INCREMENT,
  `program` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.program: ~0 rows (approximately)
INSERT INTO `program` (`id`, `program`) VALUES
(1, 'Civil engineering\n'),
(2, 'Mechanical engineering\n'),
(3, 'Electrical engineering\n'),
(4, 'Hospitality  management\n'),
(5, 'Yoga and human excellence\n'),
(6, 'Accounting'),
(7, 'Human resource management'),
(8, 'Web technology\n'),
(9, 'Computer science\n'),
(10, 'Quantity surveying'),
(11, 'Hospitality And Tourism Management'),
(12, 'Business Management'),
(13, 'Information Technology'),
(14, 'Project Management'),
(15, 'Leadership Management'),
(16, 'Retail Management'),
(17, 'Logistic And Supply Chain Management');

-- Dumping structure for table studyglobe.program_has_level
CREATE TABLE IF NOT EXISTS `program_has_level` (
  `program_id` int NOT NULL,
  `level_id` int NOT NULL,
  `id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_program_has_level_level1_idx` (`level_id`),
  KEY `fk_program_has_level_program1_idx` (`program_id`),
  CONSTRAINT `fk_program_has_level_level1` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`),
  CONSTRAINT `fk_program_has_level_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.program_has_level: ~0 rows (approximately)

-- Dumping structure for table studyglobe.studentdata
CREATE TABLE IF NOT EXISTS `studentdata` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nic` varchar(45) NOT NULL,
  `passportnumber` varchar(50) NOT NULL,
  `passport_exday` date NOT NULL,
  `race` varchar(45) NOT NULL,
  `religion` varchar(45) NOT NULL,
  `student_contact` varchar(45) NOT NULL,
  `address` mediumtext NOT NULL,
  `pname` varchar(150) NOT NULL,
  `pcontact` varchar(45) NOT NULL,
  `einformation` longtext,
  `gender_id` int NOT NULL,
  `marital_id` int NOT NULL,
  `country_id` int NOT NULL,
  `university_id` int NOT NULL,
  `program_id` int NOT NULL,
  `level_id` int NOT NULL,
  `mode_id` int NOT NULL,
  `imagepath` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_studentdata_gender_idx` (`gender_id`),
  KEY `fk_studentdata_marital1_idx` (`marital_id`),
  KEY `fk_studentdata_country1_idx` (`country_id`),
  KEY `fk_studentdata_university1_idx` (`university_id`),
  KEY `fk_studentdata_program1_idx` (`program_id`),
  KEY `fk_studentdata_level1_idx` (`level_id`),
  KEY `fk_studentdata_mode1_idx` (`mode_id`),
  CONSTRAINT `fk_studentdata_country1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  CONSTRAINT `fk_studentdata_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_studentdata_level1` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`),
  CONSTRAINT `fk_studentdata_marital1` FOREIGN KEY (`marital_id`) REFERENCES `marital` (`id`),
  CONSTRAINT `fk_studentdata_mode1` FOREIGN KEY (`mode_id`) REFERENCES `mode` (`id`),
  CONSTRAINT `fk_studentdata_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`),
  CONSTRAINT `fk_studentdata_university1` FOREIGN KEY (`university_id`) REFERENCES `university` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.studentdata: ~0 rows (approximately)

-- Dumping structure for table studyglobe.studentdata_has_document
CREATE TABLE IF NOT EXISTS `studentdata_has_document` (
  `studentdata_id` int NOT NULL,
  `document_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_studentdata_has_document_document1_idx` (`document_id`),
  KEY `fk_studentdata_has_document_studentdata1_idx` (`studentdata_id`),
  CONSTRAINT `fk_studentdata_has_document_document1` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`),
  CONSTRAINT `fk_studentdata_has_document_studentdata1` FOREIGN KEY (`studentdata_id`) REFERENCES `studentdata` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.studentdata_has_document: ~0 rows (approximately)

-- Dumping structure for table studyglobe.university
CREATE TABLE IF NOT EXISTS `university` (
  `id` int NOT NULL AUTO_INCREMENT,
  `university` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.university: ~0 rows (approximately)
INSERT INTO `university` (`id`, `university`) VALUES
	(2, 'Academies Australasia College'),
	(4, 'Eversafe academy');

-- Dumping structure for table studyglobe.university_has_program
CREATE TABLE IF NOT EXISTS `university_has_program` (
  `university_id` int NOT NULL,
  `program_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_university_has_program_program1_idx` (`program_id`),
  KEY `fk_university_has_program_university1_idx` (`university_id`),
  CONSTRAINT `fk_university_has_program_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`),
  CONSTRAINT `fk_university_has_program_university1` FOREIGN KEY (`university_id`) REFERENCES `university` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.university_has_program: ~0 rows (approximately)
INSERT INTO `university_has_program` (`university_id`, `program_id`, `id`) VALUES
	(2, 11, 11),
	(2, 12, 12),
	(2, 13, 13),
	(2, 14, 14),
	(2, 15, 15),
	(2, 16, 16),
	(2, 17, 17),
	(4, 1, 18),
	(4, 2, 19),
	(4, 3, 20),
	(4, 4, 21),
	(4, 5, 22),
	(4, 6, 23),
	(4, 7, 24),
	(4, 8, 25),
	(4, 9, 26),
	(4, 10, 27),
	(4, 18, 28);

-- Dumping structure for table studyglobe.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table studyglobe.user: ~0 rows (approximately)
INSERT INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'admin', '$2y$10$yCb3zUgsYDc7sHhKg1SQhu3p5JAODj86NR4WNrGrIB0L4Llel68zO');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
