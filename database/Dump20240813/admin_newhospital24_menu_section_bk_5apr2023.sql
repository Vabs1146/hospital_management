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
-- Table structure for table `menu_section_bk_5apr2023`
--

DROP TABLE IF EXISTS `menu_section_bk_5apr2023`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_section_bk_5apr2023` (
  `sectionid` int(100) NOT NULL AUTO_INCREMENT,
  `sectionname` varchar(200) NOT NULL,
  `menu_title` varchar(255) DEFAULT NULL,
  `parent_menu` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sectionid`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_section_bk_5apr2023`
--

LOCK TABLES `menu_section_bk_5apr2023` WRITE;
/*!40000 ALTER TABLE `menu_section_bk_5apr2023` DISABLE KEYS */;
INSERT INTO `menu_section_bk_5apr2023` VALUES (1,'1_AddPatient_Details/0','Add Patient Details','1','1','2021-02-14 09:36:53',NULL),(2,'1_appointmentlist/0','Appointment Details','1','1','2021-02-14 09:36:53',NULL),(3,'1_followupappoinment/0','Follow-up Appointment','1','1','2021-02-14 09:36:53',NULL),(4,'1_appointmentslot','Appointment Time Slot','1','1','2021-02-14 09:36:53',NULL),(5,'1_appointment','Create Appointment','1','1','2021-02-14 09:36:53',NULL),(6,'1_stop_appointments','Stopped Appointment','1','1','2021-02-14 09:36:53',NULL),(7,'1_bill_details','OPD Patient Bill','1','1','2021-02-14 09:36:53',NULL),(8,'1_MedicineStock','Medicine Stock','1','1','2021-02-14 09:36:53',NULL),(9,'2_case_masters','Add Patient Details','2','1','2021-02-14 09:36:53',NULL),(10,'2_case_masters/prescriptionlst','Eye Prescription','2','1','2021-02-14 09:36:53',NULL),(11,'2_glassPrescription','Glass Prescription','2','1','2021-02-14 09:36:53',NULL),(12,'2_report_files','Add Report','2','1','2021-02-14 09:36:53',NULL),(13,'2_patient/report','Patient Report','2','1','2021-02-14 09:36:53',NULL),(14,'2_LogoAddEdit/4','Add Letter Head Top','2','1','2021-02-14 09:36:53',NULL),(15,'2_LogoAddEdit/5','Add Letter Head Footer','2','1','2021-02-14 09:36:53',NULL),(16,'2_bill_details','OPD Patient Bill / Report','2','1','2021-02-14 09:36:53',NULL),(17,'2_MedicineStock','Medicine Stock','2','1','2021-02-14 09:36:53',NULL),(18,'2_admin/doctor/create','Add Doctor','2','1','2021-02-14 09:36:53',NULL),(19,'3_ipd_details','IPD Patient','3','1','2021-02-14 09:36:53',NULL),(20,'3_operation_rec','Operation Record','3','1','2021-02-14 09:36:53',NULL),(21,'3_eyeipd_operation_rec','Operation Theater Notes','3','1','2021-02-14 09:36:53',NULL),(22,'3_ipdbill_index','IPD Patient Bill','3','1','2021-02-14 09:36:53',NULL),(23,'3_discharge_index','Discharge(1)','3','1','2021-02-14 09:36:53',NULL),(24,'3_discharge2','Discharge(2)','3','1','2021-02-14 09:36:53',NULL),(25,'3_doctorbill/report/SurgeryReport','Surgery Report','3','1','2021-02-14 09:36:53',NULL),(26,'3_operative_notes','Operative Notes','3','1','2021-02-14 09:36:53',NULL),(27,'4_case_masters','Patient Details','4','1','2021-02-14 09:36:53',NULL),(28,'4_case_masters/prescriptionlstother','Prescription','4','1','2021-02-14 09:36:53',NULL),(29,'4_glassPrescription','Glass Prescription','4','1','2021-02-14 09:36:53',NULL),(30,'4_report_files','Add Report','4','1','2021-02-14 09:36:53',NULL),(31,'4_patient/report','Patient Report','4','1','2021-02-14 09:36:53',NULL),(32,'4_dynamicForm/4','Add Letter Head Top','4','1','2021-02-14 09:36:53',NULL),(33,'4_dynamicForm/5','Add Letter Head Footer','4','1','2021-02-14 09:36:53',NULL),(34,'4_bill_details','OPD Patient Bill / Report','4','1','2021-02-14 09:36:53',NULL),(35,'4_MedicineStock','Medicine Stock','4','1','2021-02-14 09:36:53',NULL),(36,'4_admin/doctor/create','Add Doctor','4','1','2021-02-14 09:36:53',NULL),(37,'5_ipd_patient_details','IPD Patient','5','1','2021-02-14 09:36:53',NULL),(38,'5_consent_letter','CONSENT LETTER','5','1','2021-02-14 09:36:53',NULL),(39,'5_IPD/patientBill','IPD Patient Bill','5','1','2021-02-14 09:36:53',NULL),(40,'5_medicine_details','Medicine Details','5','1','2021-02-14 09:36:53',NULL),(41,'5_medicine_presction','Medicine Prescription','5','1','2021-02-14 09:36:53',NULL),(42,'5_IPD/Discharge','Discharges','5','1','2021-02-14 09:36:53',NULL),(43,'5_dynamicForm/4','Surgery Notes','5','1','2021-02-14 09:36:53',NULL),(44,'5_dynamicForm/5','Treatment Chart','5','1','2021-02-14 09:36:53',NULL),(45,'5_dynamicForm/2','Seen By','5','1','2021-02-14 09:36:53',NULL),(46,'website','Website','6','1','2021-02-14 09:36:53',NULL),(47,'rating/list','Approve Ratings','6','1','2021-02-14 09:36:53',NULL),(48,'staff_member','Add Member Contact','7','1','2021-02-14 09:36:53',NULL),(49,'member_sms','Member SMS','7','1','2021-02-14 09:36:53',NULL),(50,'bulk_sms','Send Bulk SMS','7','1','2021-02-14 09:36:53',NULL),(51,'users','Add User','8','1','2021-02-14 09:36:53',NULL),(52,'user_permissions','User Access','8','1','2021-02-14 09:36:53',NULL),(53,'downloaddatabase','Back-up  Databse','8','1','2021-02-14 09:36:53',NULL),(54,'settings','Settings','9','1','2021-02-17 06:39:31',NULL),(55,'10_opd-bill-report','Opd Bill Report','10','1','2022-07-30 19:34:09',NULL),(56,'10_opd-bill-payment-report','Opd Bill Payment Report','10','1','2022-07-30 19:34:09',NULL),(57,'10_opd-bill-balance-report','Opd Bill Balance Report','10','1','2022-07-30 19:34:09',NULL),(58,'11_register','Register','11','1','2022-07-30 19:34:09',NULL),(59,'11_patients-listing','Listing','11','1','2022-07-30 19:34:09',NULL),(60,'11_ipd-settings','Ipd Settings','11','1','2022-07-30 19:34:09',NULL),(61,'12_new-ipd-bill-report','Ipd Bill Report','12','1','2022-07-30 19:34:09',NULL),(62,'12_new-ipd-bill-payment-report','Ipd Bill Payment Report','12','1','2022-07-30 19:34:09',NULL),(63,'12_new-ipd-bill-balance-report','Ipd Bill Balance Report','12','1','2022-07-30 19:34:09',NULL),(64,'10_opd-bill-balance-report','Opd Bill Balance Report','10','1','2022-07-30 14:04:09',NULL),(65,'10_opd-bill-payment-report','Opd Bill Payment Report','10','1','2022-07-30 14:04:09',NULL),(66,'10_opd-bill-report','Opd Bill Report','10','1','2022-07-30 14:04:09',NULL),(67,'13_covid-consent-form','Covid 19 Consent Form','13','1','2023-03-12 23:09:10',NULL),(68,'14_patient-activity','Patient View','14','1','2023-03-12 23:10:49',NULL),(69,'1_dilation','Dilation','1','1','2023-03-12 23:33:30',NULL),(70,'2_certificate','Certificate','2','1','2023-03-12 23:44:57',NULL),(71,'3_upload-document-listing','Upload Documents','3','1','2023-03-12 23:57:52',NULL),(72,'3_cataract-operative-notes','Cataract Operative Notes','3','1','2023-03-13 00:05:19',NULL),(73,'3_cataract-consent-form','Cataract Consent Form','3','1','2023-03-13 00:05:51',NULL),(74,'3_cataract-surgey','Cataract Surgery','3','1','2023-03-13 00:06:18',NULL),(75,'15_settings','General Settings','15','1','2023-03-13 00:39:23',NULL),(76,'15_set-dropdown-options','Set Dropdowns','15','1','2023-03-13 00:40:16',NULL),(77,'15_prescription-templates-listing','Prescription Template','15','1','2023-03-13 00:40:52',NULL),(78,'15_list-finding-templates','Finding Templates','15','1','2023-03-13 00:41:14',NULL),(79,'16_new_website','New Website','16','1','2023-03-13 00:51:38',NULL),(80,'2_admin/payment-modes','Payment Modes','2','1','2021-02-14 04:06:53',NULL);
/*!40000 ALTER TABLE `menu_section_bk_5apr2023` ENABLE KEYS */;
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
