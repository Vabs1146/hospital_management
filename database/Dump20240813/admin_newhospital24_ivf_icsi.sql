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
-- Table structure for table `ivf_icsi`
--

DROP TABLE IF EXISTS `ivf_icsi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ivf_icsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` varchar(255) DEFAULT NULL,
  `pre_ivf_hysteroscopy` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `lmp_date` date DEFAULT NULL,
  `amh` varchar(255) DEFAULT NULL,
  `opu_date_time` datetime DEFAULT NULL,
  `ivf_followup_1` date DEFAULT NULL,
  `ivf_followup_2` date DEFAULT NULL,
  `ivf_followup_3` date DEFAULT NULL,
  `ivf_followup_4` date DEFAULT NULL,
  `stimulated` varchar(255) DEFAULT NULL,
  `ivf_icsi_ovary_date` date DEFAULT NULL,
  `ivf_icsi_ovary_right` varchar(255) DEFAULT NULL,
  `ivf_icsi_ovary_left` varchar(255) DEFAULT NULL,
  `ivf_icsi_ovary_mi` varchar(255) DEFAULT NULL,
  `embryology_formed` longtext DEFAULT NULL,
  `fresh_et` longtext DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `ivf_followup_time_1` varchar(255) DEFAULT NULL,
  `ivf_followup_time_2` varchar(255) DEFAULT NULL,
  `ivf_followup_time_3` varchar(255) DEFAULT NULL,
  `ivf_followup_time_4` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ivf_icsi`
--

LOCK TABLES `ivf_icsi` WRITE;
/*!40000 ALTER TABLE `ivf_icsi` DISABLE KEYS */;
/*!40000 ALTER TABLE `ivf_icsi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:37
