-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for lms
CREATE DATABASE IF NOT EXISTS `lms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lms`;

-- Dumping structure for table lms.user_account
CREATE TABLE IF NOT EXISTS `user_account` (
  `EmployeeID` varchar(50) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `Full Name` varchar(50) NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Mobile_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Joining Date` date DEFAULT NULL,
  `Nickname` varchar(100) NOT NULL,
  `DOB` date DEFAULT NULL,
  `Position` varchar(50) NOT NULL,
  `Department` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Source_of_Hire` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table lms.user_details_data
CREATE TABLE IF NOT EXISTS `user_details_data` (
  `User_ID` varchar(50) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `EmployeeID` varchar(50) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Role` tinyint NOT NULL DEFAULT '0',
  `reset_password_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`User_ID`) USING BTREE,
  UNIQUE KEY `User_ID` (`User_ID`),
  KEY `FK_user_details_data_user_account` (`EmployeeID`) USING BTREE,
  CONSTRAINT `FK_user_details_data_user_account` FOREIGN KEY (`EmployeeID`) REFERENCES `user_account` (`EmployeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
