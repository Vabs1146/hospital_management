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
-- Table structure for table `ipd_patients_dropdowns`
--

DROP TABLE IF EXISTS `ipd_patients_dropdowns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ipd_patients_dropdowns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT 0,
  `type` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=258 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipd_patients_dropdowns`
--

LOCK TABLES `ipd_patients_dropdowns` WRITE;
/*!40000 ALTER TABLE `ipd_patients_dropdowns` DISABLE KEYS */;
INSERT INTO `ipd_patients_dropdowns` VALUES (221,'Cash',NULL,0,'ipd_payment_mode','1'),(222,'UPI',NULL,0,'ipd_payment_mode','1'),(223,'Card',NULL,0,'ipd_payment_mode','1'),(224,'Online',NULL,0,'ipd_payment_mode','1'),(225,'Hospital',NULL,0,'ipd_particulars','1'),(226,'Dr Sudarshan Lamture',NULL,0,'ipd_doctor','1'),(227,'Single AC',NULL,0,'ipd_ward_type','1'),(228,'Emergency','2500',225,'ipd_particulars','1'),(229,'Special Room','3500',225,'ipd_particulars','1'),(230,'Doctor visit','1500',225,'ipd_particulars','1'),(231,'Surgeon visit','2000',225,'ipd_particulars','1'),(232,'ECG','500',225,'ipd_particulars','1'),(233,'X-ray','1000',225,'ipd_particulars','1'),(234,'BSL','200',225,'ipd_particulars','1'),(235,'Pathology',NULL,0,'ipd_particulars','1'),(236,'CBC','400',235,'ipd_particulars','1'),(237,'CBC ESR','600',235,'ipd_particulars','1'),(238,'Dengue IgG IgM NS1','1600',235,'ipd_particulars','1'),(239,'CRP','1000',235,'ipd_particulars','1'),(240,'HIV HbsAg','1450',235,'ipd_particulars','1'),(241,'LFT','1200',235,'ipd_particulars','1'),(242,'Widal PSMP','850',235,'ipd_particulars','1'),(243,'Urine RM','200',235,'ipd_particulars','1'),(244,'RBS','200',235,'ipd_particulars','1'),(245,'Pharmacy',NULL,0,'ipd_particulars','1'),(246,'Pharmacy','0',245,'ipd_particulars','1'),(247,'RFT','1500',235,'ipd_particulars','1'),(248,'Dr. Sangeeta',NULL,0,'ipd_doctor','1'),(249,'GGGG','700',225,'ipd_particulars','1'),(250,'ddd','400',225,'ipd_particulars','1'),(251,'ttt','500',235,'ipd_particulars','1'),(252,'Admission Fees','500',225,'ipd_particulars','1'),(253,'Paithankar',NULL,0,'ipd_particulars','1'),(254,'XYZ','200',253,'ipd_particulars','1'),(255,'HHHT','400',253,'ipd_particulars','1'),(256,'xyz','1000',225,'ipd_particulars','1'),(257,'vaibhav','10',253,'ipd_particulars','1');
/*!40000 ALTER TABLE `ipd_patients_dropdowns` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:44
