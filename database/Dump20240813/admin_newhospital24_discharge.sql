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
-- Table structure for table `discharge`
--

DROP TABLE IF EXISTS `discharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `discharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` bigint(20) NOT NULL,
  `case_number` text DEFAULT NULL,
  `IPD_no` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `admission_date_time` text DEFAULT NULL,
  `discharge_date_time` text DEFAULT NULL,
  `surgery_date_time` text DEFAULT NULL,
  `systemic_diseases` text DEFAULT NULL,
  `general_condition` text DEFAULT NULL,
  `anesthesia_procedure` text DEFAULT NULL,
  `procedures` text DEFAULT NULL,
  `name_of_iol` text DEFAULT NULL,
  `post_operative` text DEFAULT NULL,
  `advice` text DEFAULT NULL,
  `review` text DEFAULT NULL,
  `surgeon_name` text DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `surgery` text DEFAULT NULL,
  `brief_history` text DEFAULT NULL,
  `cataract_thru` text DEFAULT NULL,
  `diminished_vision_in` text DEFAULT NULL,
  `re_dv` text DEFAULT NULL,
  `lf_dv` text DEFAULT NULL,
  `re_iop` text DEFAULT NULL,
  `lf_iop` text DEFAULT NULL,
  `re_io` text DEFAULT NULL,
  `lf_io` text DEFAULT NULL,
  `bsf` text DEFAULT NULL,
  `bspp` text DEFAULT NULL,
  `hb` text DEFAULT NULL,
  `cbc` text DEFAULT NULL,
  `esr` text DEFAULT NULL,
  `hiv` text DEFAULT NULL,
  `hbsag` text DEFAULT NULL,
  `urinal_analysis` text DEFAULT NULL,
  `ecg` text DEFAULT NULL,
  `medical_fitness` text DEFAULT NULL,
  `treatment_advised` text DEFAULT NULL,
  `investigation` text DEFAULT NULL,
  `followup` text DEFAULT NULL,
  `dischargeimg` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `discharge_history` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discharge`
--

LOCK TABLES `discharge` WRITE;
/*!40000 ALTER TABLE `discharge` DISABLE KEYS */;
/*!40000 ALTER TABLE `discharge` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:43
