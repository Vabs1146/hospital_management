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
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `section` (
  `sectionid` int(100) NOT NULL AUTO_INCREMENT,
  `sectionname` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sectionid`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section`
--

LOCK TABLES `section` WRITE;
/*!40000 ALTER TABLE `section` DISABLE KEYS */;
INSERT INTO `section` VALUES (1,'doctor','2020-02-08 06:40:17','2020-02-08 06:40:17'),(2,'aptpatientDetails1','2020-02-08 06:40:17','2020-02-08 06:40:17'),(3,'appointmentlist','2020-02-08 06:41:12','2020-02-08 06:41:12'),(4,'followupappoinment','2020-02-08 06:41:26','2020-02-08 06:41:26'),(5,'appointment','2020-02-08 06:41:36','2020-02-08 06:41:36'),(6,'stop_appointments','2020-02-08 06:41:55','2020-02-08 06:41:55'),(7,'appointmentslot','2020-02-08 06:42:10','2020-02-08 06:42:10'),(8,'case_masters','2020-02-08 06:42:36','2020-02-08 06:42:36'),(9,'patient/report','2020-02-08 06:43:09','2020-02-08 06:43:09'),(10,'case_masters/prescriptionlst','2020-02-08 06:55:43','2020-02-08 06:55:43'),(11,'report_files','2020-02-08 06:55:43','2020-02-08 06:55:43'),(12,'formDropDown','2020-02-11 07:31:00','2020-02-11 07:31:00'),(13,'bill_details','2020-02-11 07:31:00','2020-02-11 07:31:00'),(14,'doctorbill','2020-02-11 07:32:54','2020-02-11 07:32:54'),(15,'insuranceBill','2020-02-11 07:32:54','2020-02-11 07:32:54'),(16,'glassPrescription','2020-02-11 07:34:53','2020-02-11 07:34:53'),(17,'Medicine','2020-02-11 07:34:53','2020-02-11 07:34:53'),(18,'rating/list','2020-02-11 07:36:39','2020-02-11 07:36:39'),(19,'oldregister','2020-02-11 07:36:39','2020-02-11 07:36:39'),(20,'seo/add','2020-02-12 11:58:40','2020-02-12 11:58:40'),(21,'menu_lists','2020-02-12 11:59:46','2020-02-12 11:59:46'),(22,'bulk_sms','2020-02-12 11:59:46','2020-02-12 11:59:46'),(23,'member_sms','2020-02-12 12:00:16','2020-02-12 12:00:16'),(24,'staff_users','2020-02-12 12:00:16','2020-02-12 12:00:16'),(25,'downloaddatabase','2020-02-12 12:00:34','2020-02-12 12:00:34'),(26,'EyeDetails_Complaint','2020-02-13 11:16:03','2020-02-13 11:16:03'),(27,'EyeDetails_Vision','2020-02-13 11:16:03','2020-02-13 11:16:03'),(28,'EyeDetails_Refraction','2020-02-13 11:16:32','2020-02-13 11:16:32'),(29,'EyeDetails_Findings','2020-02-13 11:16:32','2020-02-13 11:16:32'),(30,'EyeDetails_Glaucoma','2020-02-13 11:17:00','2020-02-13 11:17:00'),(31,'EyeDetails_AScan','2020-02-13 11:17:00','2020-02-13 11:17:00'),(32,'EyeDetails_SPTests','2020-02-13 11:17:20','2020-02-13 11:17:20'),(33,'doctor/edit','2020-02-13 12:22:36','2020-02-13 12:22:36'),(34,'doctor/create','2020-02-13 12:27:24','2020-02-13 12:27:24'),(35,'useraccess','2020-02-13 12:33:37','2020-02-13 12:33:37'),(36,'appointment/acceptdeny','2020-02-13 12:48:43','2020-02-13 12:48:43'),(37,'aptpatientDetails','2020-02-13 13:22:12','2020-02-13 13:22:12'),(38,'stop_appointments/create','2020-02-13 13:58:49','2020-02-13 13:58:49'),(39,'stop_appointments/edit','2020-02-13 13:58:49','2020-02-13 13:58:49'),(40,'patient/report','2020-02-13 13:59:51','2020-02-13 13:59:51'),(41,'case_masters/edit','2020-02-13 14:00:35','2020-02-13 14:00:35'),(42,'patientreport/AddEditEyeDetails','2020-02-13 14:01:28','2020-02-13 14:01:28'),(43,'AddEdit/prescription','2020-02-13 14:01:54','2020-02-13 14:01:54'),(44,'print/prescription','2020-02-13 14:02:08','2020-02-13 14:02:08'),(45,'report_files/edit','2020-02-13 14:02:31','2020-02-13 14:02:31'),(46,'bill_details/edit','2020-02-13 14:02:40','2020-02-13 14:02:40'),(47,'bill_details/print','2020-02-13 14:02:49','2020-02-13 14:02:49'),(48,'opdpatientbill/report','2020-02-13 14:02:58','2020-02-13 14:02:58'),(49,'doctordetail/doctorbill/report/BillReport','2020-02-13 14:03:10','2020-02-13 14:03:10'),(50,'doctordetail/doctorbill/report/SurgeryReport','2020-02-13 14:03:19','2020-02-13 14:03:19'),(51,'doctordetail/doctorbill/AddBill','2020-02-13 14:03:33','2020-02-13 14:03:33'),(52,'Eyeipdbill/insuranceBill/edit','2020-02-13 14:03:41','2020-02-13 14:03:41'),(53,'Eyeipdbill/insuranceBill/print','2020-02-13 14:03:50','2020-02-13 14:03:50'),(54,'Eyeglass/glassPrescription/edit','2020-02-13 14:03:57','2020-02-13 14:03:57'),(55,'Eyeglass/glassPrescription/print','2020-02-13 14:04:12','2020-02-13 14:04:12'),(56,'Medicine/create','2020-02-13 14:04:21','2020-02-13 14:04:21'),(57,'Medicine/edit','2020-02-13 14:04:30','2020-02-13 14:04:30'),(58,'rating/list/ApproveRejectRating','2020-02-13 14:05:01','2020-02-13 14:05:01'),(59,'oldregister/edit','2020-02-13 14:05:13','2020-02-13 14:05:13'),(60,'oldregister/create','2020-02-13 14:05:57','2020-02-13 14:05:57'),(61,'menu_lists/create','2020-02-13 14:06:10','2020-02-13 14:06:10'),(62,'menu_lists/edit','2020-02-13 14:06:27','2020-02-13 14:06:27'),(63,'menu_lists/dynamic_text','2020-02-13 14:06:37','2020-02-13 14:06:37'),(64,'bulk_sms/create','2020-02-13 14:06:48','2020-02-13 14:06:48'),(65,'membercontact/staff_users/create','2020-02-13 14:06:57','2020-02-13 14:06:57'),(66,'membercontact/staff_users/edit','2020-02-13 14:07:10','2020-02-13 14:07:10'),(67,'followupacceptdenyappointment','2020-02-14 06:12:13','2020-02-14 06:12:13'),(68,'followuppatientDetails','2020-02-14 06:12:13','2020-02-14 06:12:13'),(69,'case_master/AddPatient_Details','2020-02-14 07:16:35','2020-02-14 07:16:35'),(70,'patientDetails/patient/report','2020-02-14 07:38:24','2020-02-14 07:38:24'),(71,'case_master/patientno_info','2020-02-14 08:05:08','2020-02-14 08:05:08'),(73,'menu_lists/number','2020-02-15 10:12:46','2020-02-15 10:12:46'),(74,'homepage/image_galleries','2020-02-15 12:00:37','2020-02-15 12:00:37'),(75,'homepage/LogoAddEdit','2020-02-15 12:01:08','2020-02-15 12:01:08'),(76,'homepage/editletterhead','2020-02-15 12:02:02','2020-02-15 12:02:02'),(77,'homepage/editletterfooter','2020-02-15 12:02:27','2020-02-15 12:02:27'),(78,'homepage/body_editor','2020-02-15 12:03:08','2020-02-15 12:03:08'),(79,'homepage/body_layer2editor','2020-02-15 12:05:30','2020-02-15 12:05:30'),(80,'homepage/body_layer3editor\r\n','2020-02-15 12:05:51','2020-02-15 12:05:51'),(81,'homepage/body_layer4editor','2020-02-15 12:06:12','2020-02-15 12:06:12'),(82,'homepage/body_layer5editor','2020-02-15 12:06:22','2020-02-15 12:06:22'),(83,'homepage/body_layer6editor','2020-02-15 12:06:31','2020-02-15 12:06:31'),(84,'homepage/body_layer7editor','2020-02-15 12:06:40','2020-02-15 12:06:40'),(85,'homepage/body_layer8editor','2020-02-15 12:06:48','2020-02-15 12:06:48'),(86,'homepage/footer_editor','2020-02-15 12:06:56','2020-02-15 12:06:56'),(87,'bulk_sms/send_sms','2020-02-19 08:29:16','2020-02-19 08:29:16'),(88,'bulk_sms/edit','2020-02-19 08:29:16','2020-02-19 08:29:16'),(89,'patientdetails/casemaster/editPatientDetials','2020-02-19 10:46:59','2020-02-19 10:46:59'),(93,'writingCasePaper','2020-02-22 10:43:26','2020-02-22 10:43:26'),(94,'writingCasePaper/edit','2020-02-22 10:43:26','2020-02-22 10:43:26'),(95,'writingCasePaper/print','2020-02-22 10:43:45','2020-02-22 10:43:45'),(96,'writingCasePaper/view','2020-02-22 10:43:45','2020-02-22 10:43:45'),(99,'staff_member','2020-02-25 05:36:03','2020-02-25 05:36:03'),(100,'staff_member/create','2020-02-25 05:38:15','2020-02-25 05:38:15'),(101,'staff_member/edit','2020-02-25 05:38:15','2020-02-25 05:38:15'),(102,'imagegallary','2020-03-04 11:40:47','2020-03-04 11:40:47');
/*!40000 ALTER TABLE `section` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:38
