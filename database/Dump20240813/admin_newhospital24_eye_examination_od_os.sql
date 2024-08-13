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
-- Table structure for table `eye_examination_od_os`
--

DROP TABLE IF EXISTS `eye_examination_od_os`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eye_examination_od_os` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` bigint(20) DEFAULT NULL,
  `od_os` text DEFAULT NULL,
  `vertical` text DEFAULT NULL,
  `horizontal` text DEFAULT NULL,
  `axis` text DEFAULT NULL,
  `ugva_1` text DEFAULT NULL,
  `ugva_2` text DEFAULT NULL,
  `va_1` text DEFAULT NULL,
  `va_2` text DEFAULT NULL,
  `phva` text DEFAULT NULL,
  `bcva_1` text DEFAULT NULL,
  `bcva_2` text DEFAULT NULL,
  `old_glass_spherical` text DEFAULT NULL,
  `old_glass_cylendrical` text DEFAULT NULL,
  `old_glass_axis` text DEFAULT NULL,
  `old_glass_add` text DEFAULT NULL,
  `new_glass_spherical` text DEFAULT NULL,
  `new_glass_cylendrical` text DEFAULT NULL,
  `new_glass_axis` text DEFAULT NULL,
  `new_glass_add` text DEFAULT NULL,
  `dialated_retrac_1` text DEFAULT NULL,
  `dialated_retrac_2` text DEFAULT NULL,
  `dialated_retrac_3` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eye_examination_od_os`
--

LOCK TABLES `eye_examination_od_os` WRITE;
/*!40000 ALTER TABLE `eye_examination_od_os` DISABLE KEYS */;
/*!40000 ALTER TABLE `eye_examination_od_os` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:40
