-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: admin_newhospital24
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `psychiatrist_case_paper`
--

DROP TABLE IF EXISTS `psychiatrist_case_paper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `psychiatrist_case_paper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` varchar(255) DEFAULT NULL,
  `patient_registration` varchar(255) DEFAULT NULL,
  `patient_registration_date` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `patient_age` varchar(255) DEFAULT NULL,
  `patient_gender` varchar(255) DEFAULT NULL,
  `patient_address_1` text DEFAULT NULL,
  `patient_address_2` text DEFAULT NULL,
  `patient_address_3` text DEFAULT NULL,
  `patient_education` varchar(255) DEFAULT NULL,
  `patient_occupation` varchar(255) DEFAULT NULL,
  `patient_contact_number` varchar(255) DEFAULT NULL,
  `patient_marital_status` varchar(255) DEFAULT NULL,
  `relative_first_name` varchar(255) DEFAULT NULL,
  `relative_middle_name` varchar(255) DEFAULT NULL,
  `relative_last_name` varchar(255) DEFAULT NULL,
  `question_1` text DEFAULT NULL,
  `question_2` text DEFAULT NULL,
  `question_1_duration` varchar(255) DEFAULT NULL,
  `question_2_duration` varchar(255) DEFAULT NULL,
  `question_3` text DEFAULT NULL,
  `question_4` text DEFAULT NULL,
  `question_5` text DEFAULT NULL,
  `question_6` text DEFAULT NULL,
  `question_7` text DEFAULT NULL,
  `question_8` text DEFAULT NULL,
  `question_9` text DEFAULT NULL,
  `undersigned_first_name` varchar(255) DEFAULT NULL,
  `undersigned_middle_name` varchar(255) DEFAULT NULL,
  `undersigned_last_name` varchar(255) DEFAULT NULL,
  `about_person` varchar(255) DEFAULT NULL,
  `about_person_first_name` varchar(255) DEFAULT NULL,
  `about_person_middle_name` varchar(255) DEFAULT NULL,
  `about_person_last_name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `is_deleted` enum('0','1') DEFAULT '0',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `psychiatrist_case_paper`
--

LOCK TABLES `psychiatrist_case_paper` WRITE;
/*!40000 ALTER TABLE `psychiatrist_case_paper` DISABLE KEYS */;
/*!40000 ALTER TABLE `psychiatrist_case_paper` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:58
