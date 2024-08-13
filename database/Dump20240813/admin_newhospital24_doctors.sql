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
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_name` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `doctorDegree` varchar(500) DEFAULT NULL,
  `mobile_no` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `doctorFee` decimal(10,0) DEFAULT NULL,
  `formViewName` text DEFAULT NULL,
  `reg_number` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
INSERT INTO `doctors` VALUES (151,'Dr. Sudarshan Lamture',1,'M.D. (Medicine)','1111111111','2024-04-08 04:58:00','2024-07-12 14:42:05',NULL,'patientDetails.CasHisFemale','M.M.C.Reg. No. 2016/12/5203',NULL),(152,'Dr Sharad Nikhate',1,'MBBS','7676767676','2024-07-13 08:12:29','2024-07-13 08:12:29',NULL,'patientDetails.CasHisFemale','Reg.1222',NULL),(153,'Dr. Vaibhav Paithankar',1,'MD','2345678765','2024-07-18 12:02:47','2024-07-18 12:02:47',NULL,'patientDetails.CasHisFemale','Reg No. 1223',NULL),(154,'pawar',1,'bams','sd','2024-07-19 04:26:14','2024-07-30 04:34:05',NULL,'case_masters.add','sds','uploads/LIAqpMCOgsAmyURAGWq3G33Qnh27zIlSbvjb57bc.jpeg'),(155,'abc',1,NULL,NULL,'2024-08-07 13:35:26','2024-08-07 13:35:26',NULL,'patientDetails.CasHisFemale',NULL,NULL),(156,'abc',1,NULL,NULL,'2024-08-07 13:36:16','2024-08-07 13:36:16',NULL,'patientDetails.CasHisFemale',NULL,NULL);
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:50
