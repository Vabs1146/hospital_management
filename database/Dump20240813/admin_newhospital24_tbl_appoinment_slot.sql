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
-- Table structure for table `tbl_appoinment_slot`
--

DROP TABLE IF EXISTS `tbl_appoinment_slot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_appoinment_slot` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `doctor_id` text NOT NULL,
  `day` text NOT NULL,
  `starttime` text NOT NULL,
  `endtime` text NOT NULL,
  `time_diff_minute` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `slotime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_appoinment_slot`
--

LOCK TABLES `tbl_appoinment_slot` WRITE;
/*!40000 ALTER TABLE `tbl_appoinment_slot` DISABLE KEYS */;
INSERT INTO `tbl_appoinment_slot` VALUES (1,'152','1','11:00 AM','11:15 AM','15','2024-07-13 08:16:29',NULL,'Afternoon'),(2,'152','1','11:15 AM','11:30 AM','15','2024-07-13 08:16:29',NULL,'Afternoon'),(3,'152','1','11:30 AM','11:45 AM','15','2024-07-13 08:16:29',NULL,'Afternoon'),(4,'152','1','11:45 AM','12:00 PM','15','2024-07-13 08:16:29',NULL,'Afternoon'),(5,'152','1','12:00 PM','12:15 PM','15','2024-07-13 08:16:29',NULL,'Afternoon'),(6,'152','1','12:15 PM','12:30 PM','15','2024-07-13 08:16:29',NULL,'Afternoon'),(7,'152','1','12:30 PM','12:45 PM','15','2024-07-13 08:16:29',NULL,'Afternoon'),(8,'152','1','12:45 PM','1:00 PM','15','2024-07-13 08:16:29',NULL,'Afternoon'),(9,'152','1','1:00 PM','1:15 PM','15','2024-07-13 08:16:29',NULL,'Afternoon'),(10,'152','1','1:15 PM','1:30 PM','15','2024-07-13 08:16:29',NULL,'Afternoon'),(11,'152','1','1:30 PM','1:45 PM','15','2024-07-13 08:16:29',NULL,'Afternoon'),(12,'152','1','1:45 PM','2:00 PM','15','2024-07-13 08:16:29',NULL,'Afternoon'),(13,'152','1','6:00 PM','6:15 PM','15','2024-07-13 08:16:29',NULL,'Evening'),(14,'152','1','6:15 PM','6:30 PM','15','2024-07-13 08:16:29',NULL,'Evening'),(15,'152','1','6:30 PM','6:45 PM','15','2024-07-13 08:16:29',NULL,'Evening'),(16,'152','1','6:45 PM','7:00 PM','15','2024-07-13 08:16:29',NULL,'Evening'),(17,'152','1','7:00 PM','7:15 PM','15','2024-07-13 08:16:29',NULL,'Evening'),(18,'152','1','7:15 PM','7:30 PM','15','2024-07-13 08:16:29',NULL,'Evening'),(19,'152','1','7:30 PM','7:45 PM','15','2024-07-13 08:16:29',NULL,'Evening'),(20,'152','1','7:45 PM','8:00 PM','15','2024-07-13 08:16:29',NULL,'Evening'),(49,'153','1','9:00 AM','9:30 AM','30','2024-07-27 15:02:15',NULL,'Morning'),(50,'153','1','9:30 AM','10:00 AM','30','2024-07-27 15:02:15',NULL,'Morning'),(51,'153','1','10:00 AM','10:30 AM','30','2024-07-27 15:02:15',NULL,'Morning'),(52,'153','1','10:30 AM','11:00 AM','30','2024-07-27 15:02:15',NULL,'Morning');
/*!40000 ALTER TABLE `tbl_appoinment_slot` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:57
