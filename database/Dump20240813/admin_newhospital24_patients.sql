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
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_date_time` varchar(255) DEFAULT NULL,
  `ipd_number` varchar(255) DEFAULT NULL,
  `uhid_number` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `responsible_realtive_name` varchar(255) DEFAULT NULL,
  `responsible_realtive_relation` varchar(255) DEFAULT NULL,
  `relative_address` varchar(255) DEFAULT NULL,
  `relative_contact_number` varchar(255) DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `admission_date_time` varchar(255) DEFAULT NULL,
  `consulting_doctor` varchar(255) DEFAULT NULL,
  `referring_doctor` varchar(255) DEFAULT NULL,
  `ward_type` varchar(255) DEFAULT NULL,
  `bed_number` varchar(255) DEFAULT NULL,
  `advance_amount` double(10,2) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `payment_id_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `icu_out_date` varchar(255) DEFAULT NULL,
  `discharge_date_time` varchar(255) DEFAULT NULL,
  `provisional_diagnosis` varchar(255) DEFAULT NULL,
  `transfered` varchar(255) DEFAULT NULL,
  `transferred_date_time` varchar(255) DEFAULT NULL,
  `ipd_number_used` int(11) DEFAULT NULL,
  `uhid_number_used` varchar(255) DEFAULT NULL,
  `ipd_number_format` varchar(255) DEFAULT NULL,
  `ipd_number_prefix` varchar(255) DEFAULT NULL,
  `uhid_number_format` varchar(255) DEFAULT NULL,
  `uhid_number_prefix` varchar(255) DEFAULT NULL,
  `ipd_bill_number_format` varchar(255) DEFAULT NULL,
  `ipd_bill_prefix` varchar(255) DEFAULT NULL,
  `ipd_summary_bill_number_format` varchar(255) DEFAULT NULL,
  `ipd_bill_number_used` varchar(255) DEFAULT NULL,
  `ipd_summary_bill_number_used` varchar(255) DEFAULT NULL,
  `ipd_summary_bill_prefix` varchar(255) DEFAULT NULL,
  `estimated_bill_diagnosis` longtext DEFAULT NULL,
  `ipd_bill_number` varchar(255) DEFAULT NULL,
  `ipd_summary_bill_number` varchar(255) DEFAULT NULL,
  `ipd_bill_date_time` varchar(255) DEFAULT NULL,
  `ipd_bill_summary_date_time` varchar(255) DEFAULT NULL,
  `adhar_card_number` varchar(255) DEFAULT NULL,
  `admission_type` varchar(255) DEFAULT NULL,
  `tpa_company` varchar(255) DEFAULT NULL,
  `insurance_company` varchar(255) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `registration_year` varchar(255) DEFAULT NULL,
  `uhid_suggested` varchar(255) DEFAULT NULL,
  `ipd_number_suggested` varchar(255) DEFAULT NULL,
  `consultant` varchar(20) NOT NULL,
  `admission_month` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (2,'2024-04-08 - 12:16 PM','SMH//0351/2024','SMH/2024/2650','Shamika',NULL,'Raikar',NULL,'26','Female','Room no 102, Maruti Meadows, I wing,',NULL,'Badlapur','Thane',NULL,'9923734179','Mahesh Raikar','Husband',NULL,'9923734179',NULL,'Married',NULL,NULL,'2024-06-07 - 12:30 PM','226',NULL,'227',NULL,NULL,NULL,NULL,'2024-04-08 06:49:39',2,'2024-04-08 12:19:39',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0030',NULL,'30','SMH/',NULL,NULL,'SMH/0030',NULL,'2024-04-02 - 22:00 PM',NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'',NULL),(3,'2024-07-05 - 08:49 PM','SMH/0001','SMH/0001','Radha','S','Mane',NULL,'46','Female','hgjhgjgj','jghj','hjghg','hgj',NULL,'5454215452','hgjghj','hjghgj',NULL,'6542578452',NULL,'ghjghj','45','67','2024-07-03 - 05:38 AM','226',NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-05 15:20:26',2,'2024-07-05 20:50:26',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0030',NULL,'31','SMH/',NULL,NULL,'SMH/0031',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'',NULL),(4,'2024-07-18 - 05:45 PM','VH 2024-25/00001','SMH/0001','gjghjgj','jgjgj','jhgfjgj',NULL,NULL,'Male','utygj','yytyutuy','uytyutu','tutu',NULL,'4567894567','tuytuytut jgigjkbm iyuiyi','hhjghjghj',NULL,'6756434567',NULL,'MARRIED',NULL,NULL,'2024-07-18 - 06:00 AM','226','ytyutyut','227',NULL,25000.00,'221',NULL,'2024-07-18 12:21:43',2,'2024-07-18 17:51:43',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0030',NULL,'32','SMH/',NULL,NULL,'SMH/0032',NULL,NULL,NULL,'General',NULL,NULL,'0',NULL,NULL,NULL,'',NULL),(5,'2024-08-01 - 02:25 PM','SMH/0001','SMH/0001','hfgh','gfhfg','hgfhfg',NULL,'30','Male','gfhfgh','gfh','gfh','ghh','santosh@tejasinfotech.in','7276124085','gfhfghfgh','ggfhfgh',NULL,'08485079273',NULL,'Married',NULL,NULL,'2024-07-26 - 14:33 PM','226',NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-01 08:55:53',2,'2024-08-01 14:25:53',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0030',NULL,'33','SMH/',NULL,NULL,'SMH/0033',NULL,NULL,NULL,'FTND',NULL,NULL,'0',NULL,NULL,NULL,'',NULL),(6,'07/08/2024 - 06:22 PM','SMH/0001','SMH/0001','vaibhav',NULL,'patole','2024-08-12','-1','Male',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-07 12:52:58',2,'2024-08-07 18:22:58',NULL,'1',NULL,NULL,NULL,NULL,NULL,1,'1','0001','SMH/','0001','SMH/',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'',NULL),(7,'07/08/2024 - 06:23 PM','SMH/0002','SMH/0002','vabs',NULL,'patole',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-07 12:55:16',2,'2024-08-07 18:25:16',NULL,'1',NULL,NULL,NULL,NULL,NULL,2,'2','0001','SMH/','0001','SMH/',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'',NULL),(8,'07/08/2024 - 06:28 PM','SMH/0003','SMH/0003','abc',NULL,'xyz',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-07 12:58:38',2,'2024-08-07 18:28:38',NULL,'1',NULL,NULL,NULL,NULL,NULL,3,'3','0001','SMH/','0001','SMH/',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'',NULL),(9,'07/08/2024 - 06:30 PM','SMH/0004','SMH/0004','xyz',NULL,'pqr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-07 13:01:03',2,'2024-08-07 18:31:03',NULL,'1',NULL,NULL,NULL,NULL,NULL,4,'4','0001','SMH/','0001','SMH/',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'',NULL),(10,'07/08/2024 - 06:34 PM','SMH/0005','SMH/0005','sham',NULL,'sundar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'9763012002',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-07 13:05:01',2,'2024-08-07 18:35:01',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'',NULL),(11,'10/08/2024 - 02:18 PM','SMH/0001','SMH/0001','Sid',NULL,NULL,'2019-06-11','5','Baby',NULL,NULL,NULL,NULL,NULL,'9763012002',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'226',NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-10 08:48:26',2,'2024-08-10 14:18:26',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0030',NULL,'34','SMH/',NULL,NULL,'SMH/0034',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'','2');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:47
