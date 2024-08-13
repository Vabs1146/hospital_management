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
-- Table structure for table `glass_prescriptions`
--

DROP TABLE IF EXISTS `glass_prescriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `glass_prescriptions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `case_id` bigint(20) DEFAULT NULL,
  `case_number` text DEFAULT NULL,
  `r_dv_sph` text DEFAULT NULL,
  `r_dv_cyl` text DEFAULT NULL,
  `r_dv_axi` text DEFAULT NULL,
  `r_dv_vision` text DEFAULT NULL,
  `l_dv_sph` text DEFAULT NULL,
  `l_dv_cyl` text DEFAULT NULL,
  `l_dv_axi` text DEFAULT NULL,
  `l_dv_vision` text DEFAULT NULL,
  `r_nv_sph` text DEFAULT NULL,
  `r_nv_cyl` text DEFAULT NULL,
  `r_nv_axi` text DEFAULT NULL,
  `r_nv_vision` text DEFAULT NULL,
  `l_nv_sph` text DEFAULT NULL,
  `l_nv_cyl` text DEFAULT NULL,
  `l_nv_axi` text DEFAULT NULL,
  `l_nv_vision` text DEFAULT NULL,
  `Report_1` text DEFAULT NULL,
  `Report_2` text DEFAULT NULL,
  `Report_3` text DEFAULT NULL,
  `retino_scopy_OD` text DEFAULT NULL,
  `retino_scopy_OS` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `r_add_sph` varchar(255) DEFAULT NULL,
  `l_add_sph` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `glass_prescriptions`
--

LOCK TABLES `glass_prescriptions` WRITE;
/*!40000 ALTER TABLE `glass_prescriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `glass_prescriptions` ENABLE KEYS */;
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
