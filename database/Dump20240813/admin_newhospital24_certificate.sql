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
-- Table structure for table `certificate`
--

DROP TABLE IF EXISTS `certificate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` varchar(255) DEFAULT NULL,
  `diagnosis` longtext DEFAULT NULL,
  `show_is_opd_ipd` enum('0','1') NOT NULL DEFAULT '0',
  `is_opd_ipd` varchar(255) DEFAULT NULL,
  `show_opd` enum('0','1') NOT NULL DEFAULT '0',
  `opd_from` date DEFAULT NULL,
  `opd_to` date DEFAULT NULL,
  `show_ipd` enum('0','1') DEFAULT '0',
  `ipd_on` date DEFAULT NULL,
  `discharge_on` date DEFAULT NULL,
  `show_operated` enum('0','1') NOT NULL DEFAULT '0',
  `operated_for` longtext DEFAULT NULL,
  `operated_date` date DEFAULT NULL,
  `show_advised` enum('0','1') NOT NULL DEFAULT '0',
  `rest_from` date DEFAULT NULL,
  `rest_days` int(11) DEFAULT NULL,
  `show_further_advised` enum('0','1') NOT NULL DEFAULT '0',
  `further_rest_from` date DEFAULT NULL,
  `further_rest_days` int(11) DEFAULT NULL,
  `show_resume_work` enum('0','1') NOT NULL DEFAULT '0',
  `is_nominal_or_light_work` varchar(255) DEFAULT NULL,
  `nominal_or_light_work_from` date DEFAULT NULL,
  `show_identification_mark` enum('0','1') NOT NULL DEFAULT '0',
  `identification_mark` longtext DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificate`
--

LOCK TABLES `certificate` WRITE;
/*!40000 ALTER TABLE `certificate` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificate` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:28:02
