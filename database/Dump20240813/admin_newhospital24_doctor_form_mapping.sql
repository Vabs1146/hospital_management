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
-- Table structure for table `doctor_form_mapping`
--

DROP TABLE IF EXISTS `doctor_form_mapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctor_form_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formViewName` varchar(500) NOT NULL,
  `displayText` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_form_mapping`
--

LOCK TABLES `doctor_form_mapping` WRITE;
/*!40000 ALTER TABLE `doctor_form_mapping` DISABLE KEYS */;
INSERT INTO `doctor_form_mapping` VALUES (1,'patientDetails.caseHistory','MD'),(2,'patientDetails.CasHisFemale','Gynecologist'),(3,'case_masters.add','General Practictioner'),(4,'EyeForm.EyeForm','Eye Specialist'),(5,'dentist.add','Dentist'),(6,'skin.addUpdate','Skin'),(7,'ent.index','ENT'),(8,'EyeForm.EyeFormold','EyeFormold'),(9,'EyeForm.UploadCaseForm','Upload Case Paper'),(10,'Psychiatrist.add','Psychiatrist Case Paper'),(11,'anxious_for_Issue.anxious_for_Issue','Anxious for Issue'),(12,'obg.obg','OBG'),(13,'follow.follow','Follow\r\n');
/*!40000 ALTER TABLE `doctor_form_mapping` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:48
