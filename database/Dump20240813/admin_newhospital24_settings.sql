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
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'hospital_name','Sfurti Multispeciality Hospital',NULL,NULL,'2024-04-08 05:00:17'),(2,'hospital_logo','logo.png',NULL,NULL,'2024-04-08 05:06:57'),(3,'doctor_name','Dr. Sudarshan Lamture',NULL,NULL,'2024-04-08 05:00:38'),(4,'uhid_prefix','SMH/',NULL,NULL,'2024-04-08 05:00:52'),(5,'bill_number','00001',NULL,NULL,'2021-03-20 05:27:20'),(6,'bill_pointer','03991',NULL,NULL,'2024-08-10 08:42:10'),(7,'webcam','0',NULL,NULL,'2024-07-30 04:43:27'),(8,'ipd_prefix','SMH/',NULL,NULL,'2024-04-08 05:00:59'),(9,'ipd_bill_prefix','001',NULL,NULL,'2023-03-28 13:59:05'),(10,'twitter_link','twitter.com',NULL,'2021-11-13 08:41:38','2021-11-13 08:41:38'),(11,'appointment_number','98812 04068 / 0251-2690382',NULL,'2021-11-13 08:41:49','2023-03-28 13:59:33'),(12,'openeing_hours','24 Hours',NULL,'2021-11-13 08:42:14','2023-03-28 13:59:39'),(13,'openeing_hours_text','We are Open',NULL,'2021-11-13 08:42:18','2021-11-13 08:42:18'),(14,'insta_link','instagram.com',NULL,'2021-11-13 08:42:30','2021-11-13 08:42:30'),(15,'linkedin_link','linkedin.com',NULL,'2021-11-13 08:42:39','2021-11-13 08:42:39'),(16,'fb_link','https://www.facebook.com/',NULL,'2021-11-13 08:42:46','2021-11-13 08:46:37'),(17,'top_bar','1',NULL,'2021-11-13 08:42:53','2021-11-13 08:42:53'),(18,'ipd_hospital_name','Sfurti Multispeciality Hospital',NULL,'2022-03-06 20:33:55','2024-08-08 12:19:21'),(19,'ipd_advance_receipt_number','001',NULL,'2022-03-06 20:34:00','2024-08-08 12:19:36'),(20,'ipd_payment_receipt_number','0001',NULL,'2022-03-06 20:34:03','2022-03-06 20:34:03'),(21,'ipd_ipd_bill_prefix','SMH/',NULL,'2022-03-06 20:34:08','2024-04-08 04:59:40'),(22,'ipd_uhid_prefix','SMH/',NULL,'2022-03-06 20:34:12','2024-04-08 04:59:51'),(23,'ipd_uhid_number','0001',NULL,'2022-03-06 20:34:16','2022-03-06 20:34:16'),(24,'ipd_ipd_prefix','SMH/',NULL,'2022-03-06 20:34:20','2024-04-08 04:59:55'),(25,'ipd_ipd_number','0001',NULL,'2022-03-06 20:34:24','2022-03-06 20:34:24'),(26,'ipd_ipd_bill_number','0001',NULL,'2022-03-11 06:15:05','2022-03-11 06:15:05'),(27,'ipd_summary_bill_prefix','SMH/',NULL,'2022-03-11 06:15:11','2024-04-08 04:59:47'),(28,'ipd_summary_bill_number','0030',NULL,'2022-03-11 06:15:15','2023-03-23 06:07:00');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
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
