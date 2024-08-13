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
-- Table structure for table `anxious_for_issue`
--

DROP TABLE IF EXISTS `anxious_for_issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anxious_for_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` int(11) DEFAULT NULL,
  `case_number` varchar(255) DEFAULT NULL,
  `wife_name` varchar(255) DEFAULT NULL,
  `wife_age` varchar(50) DEFAULT NULL,
  `husband_name` varchar(255) DEFAULT NULL,
  `husband_age` varchar(50) DEFAULT NULL,
  `married_since` varchar(255) DEFAULT NULL,
  `menstrual_history` text DEFAULT NULL,
  `lmp` text DEFAULT NULL,
  `obstetric_history` text DEFAULT NULL,
  `other_medical_surgical_illness` text DEFAULT NULL,
  `other_art_procedure_past` text DEFAULT NULL,
  `hsg` text DEFAULT NULL,
  `laproscopy` text DEFAULT NULL,
  `hsf` varchar(255) DEFAULT NULL,
  `lh` varchar(255) DEFAULT NULL,
  `fsh` varchar(255) DEFAULT NULL,
  `tsh` varchar(255) DEFAULT NULL,
  `prolactin` varchar(255) DEFAULT NULL,
  `amh` varchar(255) DEFAULT NULL,
  `folliculometry` text DEFAULT NULL,
  `adviced` text DEFAULT NULL,
  `complaints` text DEFAULT NULL,
  `lab_investigation` text DEFAULT NULL,
  `pulse` varchar(50) DEFAULT NULL,
  `BP1` varchar(20) DEFAULT NULL,
  `BP2` varchar(20) DEFAULT NULL,
  `temp` varchar(30) DEFAULT NULL,
  `rs` varchar(50) DEFAULT NULL,
  `cvs` varchar(50) DEFAULT NULL,
  `cns` varchar(50) DEFAULT NULL,
  `P_A` varchar(100) DEFAULT NULL,
  `L_E` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anxious_for_issue`
--

LOCK TABLES `anxious_for_issue` WRITE;
/*!40000 ALTER TABLE `anxious_for_issue` DISABLE KEYS */;
/*!40000 ALTER TABLE `anxious_for_issue` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:28:02
