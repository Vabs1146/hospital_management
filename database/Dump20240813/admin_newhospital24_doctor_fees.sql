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
-- Table structure for table `doctor_fees`
--

DROP TABLE IF EXISTS `doctor_fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctor_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) DEFAULT NULL,
  `fees_details` varchar(255) DEFAULT NULL,
  `fees_amount` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_fees`
--

LOCK TABLES `doctor_fees` WRITE;
/*!40000 ALTER TABLE `doctor_fees` DISABLE KEYS */;
INSERT INTO `doctor_fees` VALUES (203,151,'Consulting Charges','500','1','2024-07-12 14:44:01','2024-07-12 14:44:01',2),(204,151,'Followup','300','1','2024-07-12 14:44:01','2024-07-12 14:44:01',2),(205,152,'Consulting Charges','800','1','2024-07-13 08:13:15','2024-07-13 08:13:15',2),(206,152,'Follow-up','800','1','2024-07-13 08:13:15','2024-07-13 08:13:15',2),(207,153,'Consulting Charges','500','1','2024-07-18 12:03:30','2024-07-18 12:03:30',2),(208,153,'Follow-up','300','1','2024-07-18 12:03:30','2024-07-18 12:03:30',2),(209,153,'Ing','00','1','2024-07-18 12:03:30','2024-07-18 12:03:30',2),(210,154,'Consultation Charges','1500','1','2024-07-19 04:26:36','2024-07-19 04:26:36',2),(211,156,'gfghfgh','677','1','2024-08-10 08:41:18','2024-08-10 08:41:18',2),(212,156,'hjfhgfhg','676','1','2024-08-10 08:41:18','2024-08-10 08:41:18',2);
/*!40000 ALTER TABLE `doctor_fees` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:36
