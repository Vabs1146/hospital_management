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
-- Table structure for table `opd_bill_payments`
--

DROP TABLE IF EXISTS `opd_bill_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `opd_bill_payments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `case_number` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `paid_Amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `case_id` bigint(20) NOT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opd_bill_payments`
--

LOCK TABLES `opd_bill_payments` WRITE;
/*!40000 ALTER TABLE `opd_bill_payments` DISABLE KEYS */;
INSERT INTO `opd_bill_payments` VALUES (1,'p_00000005',500.00,'2024-07-12','2024-07-12 08:14:43',NULL,3,'1',2,NULL,'0',NULL),(2,'p_00000006',800.00,'2024-07-13','2024-07-13 01:49:48',NULL,4,'1',2,NULL,'0',NULL),(3,'p_00000006',800.00,'2024-07-17','2024-07-17 03:35:37',NULL,4,'3',2,NULL,'0',NULL),(4,'p_00000007',400.00,'2024-07-18','2024-07-18 05:37:08',NULL,5,'1',2,NULL,'0',NULL),(5,'p_00000007',400.00,'2024-07-19','2024-07-18 05:37:28',NULL,5,'3',2,NULL,'0',NULL),(6,'p_00000011',800.00,'2024-08-10','2024-08-10 02:12:04',NULL,10,'1',2,NULL,'0',NULL),(7,'p_00000011',200.00,'2024-08-12','2024-08-12 06:27:14',NULL,10,'3',2,NULL,'0',NULL);
/*!40000 ALTER TABLE `opd_bill_payments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:59
