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
-- Table structure for table `new_events`
--

DROP TABLE IF EXISTS `new_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `new_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('general') DEFAULT 'general',
  `img_url` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `read_more_link` text DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `displayed_in` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `google_map_link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `new_events`
--

LOCK TABLES `new_events` WRITE;
/*!40000 ALTER TABLE `new_events` DISABLE KEYS */;
INSERT INTO `new_events` VALUES (1,'general','uploads/kowVOHyCFZ3vsYjUIHm0hu37QrsWqmxlRD9FtMV4.jpeg,uploads/JgTMKbgxnRjrvvRyuAn7kbvp7kjpTQzNpSfH8v4G.png,uploads/sEIgihfrI6aF1eXjV1MLYYshUd2D5utNrDzXnJju.png','asdsad','a sd da','asd sd','1','2022-04-05 06:02:37','2022-04-13 16:04:11',NULL,'2022-04-05',NULL,NULL,NULL,NULL,NULL),(2,'general','uploads/QqUXLM1dOPxgpppd7zQl1zxVPqL0aWsdsnzKPCAp.jpeg','Happy Holi','Holi is a popular ancient Hindu festival, also known as the Festival of Spring, the Festival of Colours or the Festival of Love. The festival celebrates the eternal and divine love of Radha Krishna.','https://google.com','1','2022-04-08 05:37:58','2022-04-08 05:37:58',NULL,'2022-04-08','2022-04-09',NULL,NULL,NULL,NULL),(3,'general','uploads/dxxzjZYxLe7frihbu97R0zvTV0OYwnlhsRjnMHCO.png,uploads/258wl7FWHfOehK4yo4YZyBr09nw7Bf4QaWF2iyuF.png','dsfsdfsd','dsfdsf',NULL,NULL,'2022-04-13 16:03:27','2022-04-13 16:03:27',NULL,'2022-04-13',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `new_events` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:49
