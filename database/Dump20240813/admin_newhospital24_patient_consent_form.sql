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
-- Table structure for table `patient_consent_form`
--

DROP TABLE IF EXISTS `patient_consent_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patient_consent_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `performance_upon` text DEFAULT NULL,
  `surgery` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `treatment_dr` varchar(255) DEFAULT NULL,
  `required_dr` varchar(255) DEFAULT NULL,
  `patient_name_surg` varchar(255) DEFAULT NULL,
  `patient_signature_surg` varchar(255) DEFAULT NULL,
  `patient_age_surg` varchar(45) DEFAULT NULL,
  `patient_date_surg` varchar(45) DEFAULT NULL,
  `patient_time_surg` varchar(45) DEFAULT NULL,
  `witness_first_surg` varchar(255) DEFAULT NULL,
  `witness_first_sign_surg` varchar(255) DEFAULT NULL,
  `witness_first_surg_age` varchar(45) DEFAULT NULL,
  `witness_first_surg_date` varchar(45) DEFAULT NULL,
  `witness_first_surg_time` varchar(45) DEFAULT NULL,
  `witness_second_surg` varchar(255) DEFAULT NULL,
  `witness_second_sign_surg` varchar(255) DEFAULT NULL,
  `witness_second_surg_age` varchar(45) DEFAULT NULL,
  `witness_second_surg_date` varchar(45) DEFAULT NULL,
  `witness_second_surg_time` varchar(45) DEFAULT NULL,
  `admission_by_surg` varchar(255) DEFAULT NULL,
  `authorized_sign_surg` varchar(255) DEFAULT NULL,
  `patient_gen_name` varchar(255) DEFAULT NULL,
  `patient_gen_age` varchar(45) DEFAULT NULL,
  `patient_address` text DEFAULT NULL,
  `under_care_of_dr` varchar(255) DEFAULT NULL,
  `patient_name_gen` varchar(255) DEFAULT NULL,
  `patient_sign_gen` varchar(255) DEFAULT NULL,
  `patient_date_gen` varchar(45) DEFAULT NULL,
  `patient_time_gen` varchar(45) DEFAULT NULL,
  `witness_name_gen` varchar(255) DEFAULT NULL,
  `witness_sign_gen` varchar(255) DEFAULT NULL,
  `witness_date_gen` varchar(45) DEFAULT NULL,
  `witness_time_gen` varchar(45) DEFAULT NULL,
  `addmission_by_gen` varchar(255) DEFAULT NULL,
  `authorized_sign_gen` varchar(255) DEFAULT NULL,
  `consent` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_consent_form`
--

LOCK TABLES `patient_consent_form` WRITE;
/*!40000 ALTER TABLE `patient_consent_form` DISABLE KEYS */;
INSERT INTO `patient_consent_form` VALUES (1,10,'NA','surgery treatement','Fever','Subhash','Nitin','Sham sundar','NA','35','','','abc','abc sign','35','2024-04-08 - 12:16 PM','12:16','xyz','xyz sign','45','2024-04-08 - 12:16 PM','12','Yadav','Yadav sign','sham sundar','35','dummy','xyz dr','sham sundar','patient sign','2024-04-08 - 12:16 PM','01','jfsk','klfjadl','2024-04-08 - 12:16 PM','11','','','Y','2024-08-10 10:00:39',NULL),(2,11,'Sharad','baburav',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'09:00',NULL,NULL,NULL,NULL,'09:00',NULL,NULL,NULL,NULL,'09:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'12:02',NULL,NULL,NULL,'09:00',NULL,NULL,NULL,'2024-08-10 13:24:26',NULL);
/*!40000 ALTER TABLE `patient_consent_form` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:34
