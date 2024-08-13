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
-- Table structure for table `patient_details`
--

DROP TABLE IF EXISTS `patient_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patient_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` bigint(20) NOT NULL,
  `case_number` text DEFAULT NULL,
  `Complaints` text DEFAULT NULL,
  `History` text DEFAULT NULL,
  `PastPersonalHistory` text DEFAULT NULL,
  `ObstetricMenstruution` text DEFAULT NULL,
  `ObstetricMarriedSice` text DEFAULT NULL,
  `ObstetricCMP` text DEFAULT NULL,
  `ObstetricEDD` text DEFAULT NULL,
  `MensturationHistory` text DEFAULT NULL,
  `menarch` text DEFAULT NULL,
  `menarch_two` text DEFAULT NULL,
  `ObstetricG` text DEFAULT NULL,
  `ObstetricP` text DEFAULT NULL,
  `ObstetricL` text DEFAULT NULL,
  `ObstetricA` text DEFAULT NULL,
  `ObstetricD` text DEFAULT NULL,
  `ObstetricText` text DEFAULT NULL,
  `presentPregnecyLMP` text DEFAULT NULL,
  `presentPregnencyEDD` text DEFAULT NULL,
  `presentPregnencyUSG` text DEFAULT NULL,
  `presentPregnencyDate` text DEFAULT NULL,
  `Education` text DEFAULT NULL,
  `GenExamBuild` text DEFAULT NULL,
  `GenExamHeight` text DEFAULT NULL,
  `GenExamWeight` text DEFAULT NULL,
  `GenExamPulse` text DEFAULT NULL,
  `GenExamBP` text DEFAULT NULL,
  `GenExamBP_lower` text DEFAULT NULL,
  `GenExamRR` text DEFAULT NULL,
  `GenExamPallor` text DEFAULT NULL,
  `GenExamCyanosis` text DEFAULT NULL,
  `GenExamIcterus` text DEFAULT NULL,
  `GenExamEdema` text DEFAULT NULL,
  `GenExamSkin` text DEFAULT NULL,
  `SysExamCVS` text DEFAULT NULL,
  `SysExamRS` text DEFAULT NULL,
  `SysExamPA` text DEFAULT NULL,
  `SysExamLocalExam` text DEFAULT NULL,
  `ProvisionalDiagnosis` text DEFAULT NULL,
  `InvestigationAdvice` text DEFAULT NULL,
  `TreatmentAdvice` text DEFAULT NULL,
  `Remark` text DEFAULT NULL,
  `Text` text DEFAULT NULL,
  `reportFilePath` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `BMI` text DEFAULT NULL,
  `Temp` text DEFAULT NULL,
  `AG` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_details`
--

LOCK TABLES `patient_details` WRITE;
/*!40000 ALTER TABLE `patient_details` DISABLE KEYS */;
INSERT INTO `patient_details` VALUES (1,3,'p_00000005',NULL,NULL,'Select',NULL,NULL,NULL,NULL,NULL,'fd34',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'xcxasd',NULL,NULL,NULL,'ffyhjgukyk','fg','fgf',NULL,NULL,'2024-07-24 15:39:02','2024-07-24 15:40:49',NULL,NULL,NULL),(2,2,'p_00000004',NULL,NULL,'Select',NULL,NULL,NULL,NULL,NULL,'Select',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Select',NULL,NULL,NULL,'Select',NULL,NULL,NULL,NULL,'2024-07-29 18:47:41','2024-07-29 18:47:41',NULL,NULL,NULL),(3,5,'p_00000007','cbxcbxb','xcxc','Select',NULL,NULL,NULL,NULL,NULL,'Select',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Select',NULL,NULL,NULL,'Select',NULL,NULL,NULL,NULL,'2024-07-30 05:29:42','2024-07-30 05:29:42',NULL,NULL,NULL);
/*!40000 ALTER TABLE `patient_details` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:42
