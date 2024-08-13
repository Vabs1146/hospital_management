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
-- Table structure for table `patient_payments`
--

DROP TABLE IF EXISTS `patient_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patient_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) DEFAULT NULL,
  `receipt_number` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `advance_towards` varchar(255) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `advance_amount` varchar(255) DEFAULT NULL,
  `payment_id_number` varchar(255) DEFAULT NULL,
  `date_time` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=320 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_payments`
--

LOCK TABLES `patient_payments` WRITE;
/*!40000 ALTER TABLE `patient_payments` DISABLE KEYS */;
INSERT INTO `patient_payments` VALUES (305,2,'0001','bill_payment',NULL,'221','26200',NULL,'2024-07-05 - 08:23 PM','1','0','2024-07-05 14:53:34',2,NULL,NULL),(306,3,'0002','bill_payment',NULL,'221','2000',NULL,'2024-07-12 - 08:17 PM','1','0','2024-07-12 14:47:12',2,NULL,NULL),(307,3,'0003','bill_payment',NULL,'222','5000','hgftyfhr utyutyjt uit i','2024-07-13 - 02:00 PM','1','0','2024-07-13 08:30:32',2,NULL,NULL),(308,3,'0004','bill_payment',NULL,'221','5000',NULL,'2024-07-13 - 02:11 PM','1','0','2024-07-13 08:41:57',2,NULL,NULL),(309,3,'0005','bill_payment',NULL,'222','2000','5e4etre54v456','2024-07-17 - 03:32 PM','1','0','2024-07-17 10:03:13',2,NULL,NULL),(310,3,'0006','bill_payment',NULL,'221','3500',NULL,'2024-07-17 - 03:33 PM','1','0','2024-07-17 10:04:01',2,NULL,NULL),(311,3,'0007','bill_payment',NULL,'221','26900',NULL,'2024-07-17 - 03:40 PM','1','0','2024-07-17 10:11:05',2,NULL,NULL),(312,4,'000312','advance',NULL,'221','5000',NULL,'2024-07-18 - 05:45 PM','1','0','2024-07-18 12:21:43',2,NULL,NULL),(313,4,'0008','bill_payment',NULL,'222','3500','gyjyug i yuiyiy','2024-07-18 - 05:55 PM','1','0','2024-07-18 12:25:39',2,NULL,NULL),(314,4,'000314','advance',NULL,'221','15000',NULL,'2024-07-18 - 05:45 PM','1','0','2024-07-30 07:47:51',2,NULL,NULL),(315,4,'000315','advance',NULL,'221','15000',NULL,'2024-07-18 - 05:45 PM','1','0','2024-08-07 12:42:08',2,NULL,NULL),(316,4,'000316','advance',NULL,'221','15000',NULL,'2024-07-18 - 05:45 PM','1','0','2024-08-07 12:44:47',2,NULL,NULL),(317,4,'000317','advance',NULL,'221','25000',NULL,'2024-07-18 - 05:45 PM','1','0','2024-08-07 12:45:06',2,NULL,NULL),(318,11,'0009','bill_payment',NULL,'221','5000',NULL,'2024-08-10 - 02:19 PM','1','0','2024-08-10 08:49:51',2,NULL,NULL),(319,11,'0010','bill_payment',NULL,'222','5600','fhgfhfhjfhjf t u','2024-08-10 - 02:19 PM','1','0','2024-08-10 08:50:20',2,NULL,NULL);
/*!40000 ALTER TABLE `patient_payments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:41
