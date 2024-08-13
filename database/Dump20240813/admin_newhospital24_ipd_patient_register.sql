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
-- Table structure for table `ipd_patient_register`
--

DROP TABLE IF EXISTS `ipd_patient_register`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ipd_patient_register` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `case_id` bigint(20) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `guardian_name` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `mobile_no` text DEFAULT NULL,
  `phone_no` text DEFAULT NULL,
  `email_id` text DEFAULT NULL,
  `blood_group` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `age` text DEFAULT NULL,
  `weight` text DEFAULT NULL,
  `maritial_status` text DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `registration_time` text DEFAULT NULL,
  `discharge_date` text DEFAULT NULL,
  `discharge_time` text DEFAULT NULL,
  `room_no` text DEFAULT NULL,
  `package` text DEFAULT NULL,
  `uhid_no` text DEFAULT NULL,
  `ipd_no` text DEFAULT NULL,
  `case` text DEFAULT NULL,
  `ref_doctor` text DEFAULT NULL,
  `consultant_doctor` text DEFAULT NULL,
  `department` text DEFAULT NULL,
  `specialisation` text DEFAULT NULL,
  `presenting_complaint` text DEFAULT NULL,
  `drug_sensitivity` text DEFAULT NULL,
  `family_history` text DEFAULT NULL,
  `past_history` text DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `advance` text DEFAULT NULL,
  `payment_mode` text DEFAULT NULL,
  `debit_ac` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipd_patient_register`
--

LOCK TABLES `ipd_patient_register` WRITE;
/*!40000 ALTER TABLE `ipd_patient_register` DISABLE KEYS */;
/*!40000 ALTER TABLE `ipd_patient_register` ENABLE KEYS */;
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
