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
-- Table structure for table `gyn_form_dropdowns`
--

DROP TABLE IF EXISTS `gyn_form_dropdowns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gyn_form_dropdowns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formName` varchar(200) NOT NULL,
  `fieldName` varchar(200) NOT NULL,
  `ddText` varchar(200) NOT NULL,
  `ddValue` varchar(200) NOT NULL,
  `isdefault` bit(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gyn_form_dropdowns`
--

LOCK TABLES `gyn_form_dropdowns` WRITE;
/*!40000 ALTER TABLE `gyn_form_dropdowns` DISABLE KEYS */;
INSERT INTO `gyn_form_dropdowns` VALUES (1,'gyn','InvestigationAdvice','ffyhjgukyk','ffyhjgukyk',NULL,'2024-07-12 14:42:46',NULL),(2,'gyn','SysExamCVS','bcbcbcbcb','bcbcbcbcb',NULL,'2024-07-21 04:25:21',NULL),(3,'gyn','SysExamCVS','ss','ss',NULL,'2024-07-21 04:25:21',NULL),(4,'gyn','SysExamCVS','','',NULL,'2024-07-21 04:25:21',NULL),(5,'gyn','History','xcxc','xcxc',NULL,'2024-07-24 15:38:33',NULL),(6,'gyn','History','','',NULL,'2024-07-24 15:38:33',NULL),(7,'gyn','SysExamRS','xcxasd','xcxasd',NULL,'2024-07-24 15:38:53',NULL),(8,'gyn','PastPersonalHistory','3434','3434',NULL,'2024-07-24 15:40:19',NULL),(9,'gyn','menarch','fd34','fd34',NULL,'2024-07-24 15:40:29',NULL);
/*!40000 ALTER TABLE `gyn_form_dropdowns` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:28:01
