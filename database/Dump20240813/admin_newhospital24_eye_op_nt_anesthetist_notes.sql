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
-- Table structure for table `eye_op_nt_anesthetist_notes`
--

DROP TABLE IF EXISTS `eye_op_nt_anesthetist_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eye_op_nt_anesthetist_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eye_op_nt_id` bigint(20) NOT NULL,
  `an_history` text DEFAULT NULL,
  `an_allergies` text DEFAULT NULL,
  `an_pulse` text DEFAULT NULL,
  `an_cardiac_history` text DEFAULT NULL,
  `an_bp` text DEFAULT NULL,
  `an_investigations` text DEFAULT NULL,
  `an_nbm_notnbm` text DEFAULT NULL,
  `an_dentition` text DEFAULT NULL,
  `ion_anesthesia_topical_peribular_given_by` text DEFAULT NULL,
  `ion_pulse` text DEFAULT NULL,
  `ion_o_saturation` text DEFAULT NULL,
  `ion_bp` text DEFAULT NULL,
  `pon_pulse` text DEFAULT NULL,
  `pon_bp` text DEFAULT NULL,
  `pon_o_saturation` text DEFAULT NULL,
  `pon_additional_note` text DEFAULT NULL,
  `anesthetist_name` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eye_op_nt_anesthetist_notes`
--

LOCK TABLES `eye_op_nt_anesthetist_notes` WRITE;
/*!40000 ALTER TABLE `eye_op_nt_anesthetist_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `eye_op_nt_anesthetist_notes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:28:00
