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
-- Table structure for table `patients_history_sheet`
--

DROP TABLE IF EXISTS `patients_history_sheet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patients_history_sheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` varchar(255) NOT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `value_1` longtext DEFAULT NULL,
  `value_2` longtext DEFAULT NULL,
  `value_3` longtext DEFAULT NULL,
  `value_4` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients_history_sheet`
--

LOCK TABLES `patients_history_sheet` WRITE;
/*!40000 ALTER TABLE `patients_history_sheet` DISABLE KEYS */;
INSERT INTO `patients_history_sheet` VALUES (1,'3','date_time','2024-07-05 - 06:04 AM',NULL,NULL,NULL,'2024-07-05 15:46:38',NULL,NULL,NULL),(2,'3','chief_complaints',NULL,NULL,NULL,NULL,'2024-07-05 15:46:38',NULL,NULL,NULL),(3,'3','systemic_examination',NULL,NULL,NULL,NULL,'2024-07-05 15:46:38',NULL,NULL,NULL),(4,'3','local_examination',NULL,NULL,NULL,NULL,'2024-07-05 15:46:38',NULL,NULL,NULL),(5,'3','past_history',NULL,NULL,NULL,NULL,'2024-07-05 15:46:38',NULL,NULL,NULL),(6,'3','personal_history',NULL,NULL,NULL,NULL,'2024-07-05 15:46:38',NULL,NULL,NULL),(7,'3','drug_allergies',NULL,NULL,NULL,NULL,'2024-07-05 15:46:38',NULL,NULL,NULL),(8,'3','family_history',NULL,NULL,NULL,NULL,'2024-07-05 15:46:38',NULL,NULL,NULL),(9,'3','proctoscopy',NULL,NULL,NULL,NULL,'2024-07-05 15:46:38',NULL,NULL,NULL),(10,'3','menstrual_history',NULL,NULL,NULL,NULL,'2024-07-05 15:46:38',NULL,NULL,NULL),(11,'3','treatment_history',NULL,NULL,NULL,NULL,'2024-07-05 15:46:38',NULL,NULL,NULL),(12,'3','final_notes',NULL,NULL,NULL,NULL,'2024-07-05 15:46:38',NULL,NULL,NULL),(13,'3','chief_complaints','hjtuyyf8d7ify\r\nfg\r\nfdg\r\ndf\r\n\r\nfd',NULL,NULL,NULL,'2024-07-13 08:50:59',NULL,NULL,NULL),(14,'3','systemic_examination','fysfgyusrguydgf\r\nfdg\r\nxgxd\r\ngzdg\r\nz',NULL,NULL,NULL,'2024-07-13 08:50:59',NULL,NULL,NULL);
/*!40000 ALTER TABLE `patients_history_sheet` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:38
