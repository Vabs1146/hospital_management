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
-- Table structure for table `insurance_bill`
--

DROP TABLE IF EXISTS `insurance_bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `insurance_bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` bigint(20) DEFAULT NULL,
  `case_number` text DEFAULT NULL,
  `name_of_patient` text DEFAULT NULL,
  `procedure_surgery_done` text DEFAULT NULL,
  `ipd_no` text DEFAULT NULL,
  `bill_no` text DEFAULT NULL,
  `uhid_no` text DEFAULT NULL,
  `bill_date` text DEFAULT NULL,
  `admission_date_time` text DEFAULT NULL,
  `classes` text DEFAULT NULL,
  `discharge_date_time` text DEFAULT NULL,
  `surgon_name` text DEFAULT NULL,
  `tpa_company` text DEFAULT NULL,
  `referedby` text DEFAULT NULL,
  `left_eye` tinyint(2) DEFAULT NULL,
  `right_eye` tinyint(2) DEFAULT NULL,
  `final_diagnosis` text DEFAULT NULL,
  `discharge_sts` text DEFAULT NULL,
  `surgery_date_time` text DEFAULT NULL,
  `insurance_company` text DEFAULT NULL,
  `advance_amount` text DEFAULT NULL,
  `discount_amount` text DEFAULT NULL,
  `sub_total` double(10,2) DEFAULT NULL,
  `total_bill_amount` text DEFAULT NULL,
  `amount_senction_by_tpa` text DEFAULT NULL,
  `balance_amount_by_patient` text DEFAULT NULL,
  `declaration_patient_balance_amt` text DEFAULT NULL,
  `balance_paid_by_patient` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insurance_bill`
--

LOCK TABLES `insurance_bill` WRITE;
/*!40000 ALTER TABLE `insurance_bill` DISABLE KEYS */;
/*!40000 ALTER TABLE `insurance_bill` ENABLE KEYS */;
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
