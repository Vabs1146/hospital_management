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
-- Table structure for table `case_master`
--

DROP TABLE IF EXISTS `case_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `case_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_type` enum('opd','ipd') DEFAULT 'opd',
  `patient_priority` varchar(255) DEFAULT NULL,
  `is_opd` enum('0','1') NOT NULL DEFAULT '1',
  `is_ipd` enum('0','1') NOT NULL DEFAULT '0',
  `patient_name` varchar(500) DEFAULT NULL,
  `patient_pic` varchar(255) DEFAULT NULL,
  `patient_age` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `pan` varchar(255) DEFAULT NULL,
  `adhar_number` varchar(255) DEFAULT NULL,
  `alternate_number` varchar(255) DEFAULT NULL,
  `patient_address` varchar(500) DEFAULT NULL,
  `patient_emailId` varchar(100) DEFAULT NULL,
  `patient_mobile` varchar(45) DEFAULT NULL,
  `male_female` varchar(45) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `complaint` text DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `infection` varchar(255) DEFAULT NULL,
  `miscellaneous_history` varchar(255) DEFAULT NULL,
  `patient_weight` text DEFAULT NULL,
  `patient_height` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `ReportfilePath` text DEFAULT NULL,
  `BeforeImagePath` text DEFAULT NULL,
  `AfterImagePath` text DEFAULT NULL,
  `diagnosis_filePath` text DEFAULT NULL,
  `FollowUpDate` text DEFAULT NULL,
  `FollowUpTimeSlot` text DEFAULT NULL,
  `FollowUpDoctor_Id` int(11) DEFAULT NULL,
  `case_number` text DEFAULT NULL,
  `uhid_no` text DEFAULT NULL,
  `blood_pressure` varchar(200) DEFAULT NULL,
  `referedby` varchar(1000) DEFAULT NULL,
  `billAmount` text DEFAULT NULL,
  `sub_total` varchar(255) DEFAULT NULL,
  `bill_discount` varchar(255) DEFAULT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `paidAmount` text DEFAULT NULL,
  `bill_created_by` int(11) DEFAULT NULL,
  `tax_percentage` decimal(10,2) DEFAULT 0.00,
  `visit_time` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` bit(1) DEFAULT b'0',
  `payment_mode` varchar(100) NOT NULL,
  `pdfname` text NOT NULL,
  `admission_date_time` text NOT NULL,
  `surgery_complete_date_time` datetime DEFAULT NULL,
  `discharge_date_time` text NOT NULL,
  `surgery_date_time` text NOT NULL,
  `reporting_date_time` varchar(255) DEFAULT NULL,
  `posted_for_doctor` int(11) DEFAULT NULL,
  `Surgeon` text NOT NULL,
  `final_diagnosis` text NOT NULL,
  `discharge_sts` text NOT NULL,
  `IPD_no` text NOT NULL,
  `classes` text NOT NULL,
  `elective_emergency` text DEFAULT NULL,
  `admission_reason` text DEFAULT NULL,
  `case_type` varchar(255) DEFAULT NULL,
  `case_appointment_time` varchar(255) DEFAULT NULL,
  `discharge_history` longtext DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `casehistory_followup_notes` longtext DEFAULT NULL,
  `mr_mrs_ms` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `is_followup` enum('0','1') DEFAULT '0',
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `accompanied_by` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `daily_travel_time` varchar(255) DEFAULT NULL,
  `screen_time` varchar(255) DEFAULT NULL,
  `ivf_form` varchar(255) DEFAULT NULL,
  `registration_year` varchar(255) DEFAULT NULL,
  `uhid_suggested` varchar(255) DEFAULT NULL,
  `admission_month` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `case_master`
--

LOCK TABLES `case_master` WRITE;
/*!40000 ALTER TABLE `case_master` DISABLE KEYS */;
INSERT INTO `case_master` VALUES (2,'opd','Regular','1','0','Vaibhav',NULL,46,'1970-01-01',NULL,NULL,NULL,'gjfgj',NULL,'5454545452','Male',151,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'p_00000004','SMH/2654/2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,'20:53','2024-07-10 20:54:18','2024-07-10 20:54:18',_binary '\0','1','','',NULL,'','',NULL,NULL,'','','','','',NULL,NULL,'walkin','',NULL,2,NULL,NULL,'N','Paithankar','fgjhf',NULL,'gh','dfg',NULL,NULL,NULL,NULL,NULL,'2024','SMH/2654/2024',NULL),(3,'opd','Regular','1','0','Shamika',NULL,NULL,'1970-01-01',NULL,NULL,NULL,'Room no 102, Maruti Meadows, I wing,',NULL,'9923734179','Female',151,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-26','0',NULL,'p_00000005','SMH/2024/2650',NULL,NULL,'500','500',NULL,'03987',NULL,'500.00',2,NULL,'20:09','2024-07-12 20:10:33','2024-07-24 21:10:49',_binary '\0','2','','',NULL,'','',NULL,NULL,'','','','','',NULL,NULL,'walkin','',NULL,2,NULL,NULL,NULL,'Raikar',NULL,NULL,'Badlapur','Thane',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'opd','Regular','1','0','Deepak',NULL,43,'1970-01-01',NULL,NULL,NULL,'fhgyj',NULL,'6754328976','Male',152,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'p_00000006','SMH/2655/2024',NULL,'SELF','1600','1600',NULL,'03989',NULL,'1600.00',2,NULL,'13:47','2024-07-13 13:48:44','2024-07-17 15:35:40',_binary '\0','3','','',NULL,'','',NULL,NULL,'','','','','',NULL,NULL,'walkin','',NULL,2,NULL,NULL,'M','Patil','KANAKIA',NULL,'MIRAROAD','THANE',NULL,NULL,NULL,NULL,NULL,'2024','SMH/2655/2024',NULL),(5,'opd','Regular','1','0','Rakesh',NULL,28,'1970-01-01',NULL,NULL,NULL,'yttuytuy',NULL,'4534567867','Male',153,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'p_00000007','SMH/2656/2024',NULL,'Self','800','800',NULL,'03990',NULL,'800.00',2,NULL,'17:33','2024-07-18 17:36:10','2024-07-18 17:37:30',_binary '\0','5','','',NULL,'','',NULL,NULL,'','','','','',NULL,NULL,'walkin','',NULL,2,NULL,NULL,'M','Pai',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024','SMH/2656/2024',NULL),(6,'opd',NULL,'1','0','Siddhesh',NULL,30,'1970-01-01',NULL,NULL,NULL,'hgh',NULL,'9665613368','Male',152,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'p_00000010','SMH/2657/2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,'16:34','2024-07-28 16:35:07','2024-07-30 10:39:30',_binary '','6','','',NULL,'','',NULL,NULL,'','','','','',NULL,NULL,'walkin','',NULL,2,NULL,NULL,'S','Karkare','gh',NULL,'gh',NULL,NULL,NULL,NULL,NULL,NULL,'2024','SMH/2657/2024',NULL),(7,'opd',NULL,'1','0','Siddhesh',NULL,27,'1997-07-30',NULL,NULL,NULL,'Mumbai',NULL,'9999999999','Male',152,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'p_00000011','SMH/2658/2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,'20:59','2024-07-30 21:00:20','2024-07-30 21:00:20',_binary '\0','7','','',NULL,'','',NULL,NULL,'','','','','',NULL,NULL,'walkin','',NULL,2,NULL,NULL,'Sudhakar','Karkare',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024','SMH/2658/2024',NULL),(8,'opd',NULL,'1','0','vaibhav',NULL,NULL,'1970-01-01',NULL,NULL,NULL,'pune',NULL,'9763012002','Male',152,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'p_00000012','SMH/2663/2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,'18:46','2024-08-07 18:46:38','2024-08-07 18:46:38',_binary '\0','','','',NULL,'','',NULL,NULL,'','','','','',NULL,NULL,'walkin','',NULL,2,NULL,NULL,NULL,'patole',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024','SMH/2663/2024',NULL),(9,'opd',NULL,'1','0','sham',NULL,NULL,NULL,NULL,NULL,NULL,'Dombivali',NULL,'9763012002','Male',152,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'p_00000013','SMH/2664/2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,'18:50','2024-08-07 18:50:45','2024-08-07 18:58:09',_binary '\0','','','',NULL,'','',NULL,NULL,'','','','','',NULL,NULL,'walkin','',NULL,2,NULL,NULL,NULL,'sundar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024','SMH/2664/2024',NULL),(10,'opd',NULL,'1','0','Siddhesh',NULL,27,'1997-07-30',NULL,NULL,NULL,'Mumbai',NULL,'9999999999','Male',152,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'p_00000011','SMH/2658/2024',NULL,NULL,'800','800',NULL,'03991',NULL,'1000.00',2,NULL,'19:18','2024-08-07 19:18:07','2024-08-12 18:27:36',_binary '\0','0','','',NULL,'','',NULL,NULL,'','','','','',NULL,NULL,'walkin','',NULL,2,NULL,NULL,'Sudhakar','Karkare',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'March'),(11,'opd',NULL,'1','0','narayan',NULL,30,'1994-08-21',NULL,NULL,NULL,'mumbai',NULL,'8687687687','Baby',155,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'p_00000014','SMH/2665/2024',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,'19:41','2024-08-10 19:43:45','2024-08-10 19:53:23',_binary '\0','','','',NULL,'','',NULL,NULL,'','','','','',NULL,NULL,'walkin','',NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024','SMH/2665/2024','0');
/*!40000 ALTER TABLE `case_master` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:35
