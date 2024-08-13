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
-- Table structure for table `new_discharge_summary`
--

DROP TABLE IF EXISTS `new_discharge_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `new_discharge_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` varchar(255) NOT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `value_1` longtext DEFAULT NULL,
  `value_2` longtext DEFAULT NULL,
  `value_3` longtext DEFAULT NULL,
  `value_4` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=237 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `new_discharge_summary`
--

LOCK TABLES `new_discharge_summary` WRITE;
/*!40000 ALTER TABLE `new_discharge_summary` DISABLE KEYS */;
INSERT INTO `new_discharge_summary` VALUES (1,'2','date_time',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(2,'2','admission_date_time','2024-03-31 - 12:30 PM',NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(3,'2','discharge_date_time','2024-04-02 - 22:00 PM',NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(4,'2','diagnosis','Enteric Fever with Dehydration with hypovolemic shock',NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(5,'2','clinical_profile',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(6,'2','discharge_investigation','Lab reports attached',NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(7,'2','discharge_operative_labour_notes',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(8,'2','discharge_treatment_given',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(9,'2','discharge_medication_explained_by',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(10,'2','discharge_histopathology',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(11,'2','discharge_condition_at_the_time',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(12,'2','discharge_pulse_1',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(13,'2','discharge_pulse_2',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(14,'2','discharge_bp_1',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(15,'2','discharge_bp_2',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(16,'2','discharge_spo2',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(17,'2','followup_1',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(18,'2','followup_2',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(19,'2','followup_3',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(20,'2','followup_4',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(21,'2','discharge_card_received_by',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(22,'2','discharge_where_to_contact_in_emergency',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(23,'2','discharge_when_to_contact',NULL,NULL,NULL,NULL,'2024-04-08 07:27:04',NULL,NULL,NULL),(24,'2','primary_consultant',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(25,'2','discharge_against_medical_advice',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(26,'2','bp_1',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(27,'2','bp_2',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(28,'2','pulse_1',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(29,'2','pulse_2',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(30,'2','rr_1',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(31,'2','rr_2',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(32,'2','rs',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(33,'2','temperature',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(34,'2','cvs',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(35,'2','consulting_doctor',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(36,'2','chief_complaints',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(37,'2','history_of_present_illness',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(38,'2','medical',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(39,'2','surgical',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(40,'2','course_in_hospital',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(41,'2','hemodynamic_condition',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(42,'2','discharge_temperature',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(43,'2','discharge_rr_1',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(44,'2','discharge_rr_2',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(45,'2','diet',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(46,'2','treatment_advice',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(47,'2','consult_symptoms',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(48,'2','final_notes',NULL,NULL,NULL,NULL,'2024-04-08 12:30:03',NULL,NULL,NULL),(49,'2','discharge_against_medical_advice','5f',NULL,NULL,NULL,'2024-04-08 12:30:51',NULL,NULL,NULL),(50,'2','medical','hhfhfghfg',NULL,NULL,NULL,'2024-04-08 12:42:03',NULL,NULL,NULL),(51,'2','discharge_against_medical_advice','fgfddg   fgfdg fdfdg  fdg',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(52,'2','bp_1','180',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(53,'2','bp_2','160',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(54,'2','pulse_1','100',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(55,'2','pulse_2','kj',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(56,'2','rr_1','5656',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(57,'2','rr_2','hgjgh',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(58,'2','rs','hjhgj',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(59,'2','temperature','hjhgj',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(60,'2','cvs','hjghj',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(61,'2','consulting_doctor','226',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(62,'2','chief_complaints','ghfghgfh\r\ngfhfghfg\r\ngfhfgh',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(63,'2','history_of_present_illness','ghfghfg\r\ngfhfgh\r\nghgfhf',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(64,'2','course_in_hospital','ghfghfg\r\nhgfhgfhgf\r\ngfhgf',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(65,'2','hemodynamic_condition','fdsfsdfdffd fsdfdsf',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(66,'2','discharge_temperature','fdgfdgdf',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(67,'2','discharge_pulse_1','98',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(68,'2','discharge_pulse_2','fgdg',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(69,'2','discharge_bp_1','120',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(70,'2','discharge_bp_2','150',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(71,'2','discharge_rr_1','454',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(72,'2','discharge_rr_2','jhj',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(73,'2','diet','kjhkjhkjh\r\njhkjhkjh\r\njhkhjkjh\r\njhkjhk',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(74,'2','treatment_advice','jhkjhkjh\r\njhkjhk\r\nhjkhjk',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(75,'2','consult_symptoms','jhkjhkjh\r\njhkjhk\r\njkhjhkjh',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(76,'2','followup_1','2024-04-12',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(77,'2','medical','hhfhfghfg\r\njhkjhkhj\r\nhjkjhkjhk',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(78,'2','final_notes','jhkjhkjhkjhk\r\njhkjhk\r\njkhjhkjhk',NULL,NULL,NULL,'2024-04-08 12:46:22',NULL,NULL,NULL),(79,'2','chief_complaints','ghfghgfh gjhgjh gjhgjh gjhg jgjhgjh ghjg jhgjh gjhgjh gjhg jhgjhg jgj gjhg jhgjh gjhgjh gjh\r\ngfhfghfg\r\ngfhfgh',NULL,NULL,NULL,'2024-04-08 12:59:01',NULL,NULL,NULL),(80,'2','consult_symptoms','jhkjhkjh \r\njhkjhk\r\njkhjhkjh',NULL,NULL,NULL,'2024-04-08 12:59:01',NULL,NULL,NULL),(81,'2','followup_2','2024-04-18',NULL,NULL,NULL,'2024-04-08 13:01:00',NULL,NULL,NULL),(82,'2','followup_3','2024-04-27',NULL,NULL,NULL,'2024-04-08 13:01:00',NULL,NULL,NULL),(83,'2','followup_4','2024-04-30',NULL,NULL,NULL,'2024-04-08 13:01:00',NULL,NULL,NULL),(84,'2','date_time','2024-07-05 - 04:44 AM',NULL,NULL,NULL,'2024-07-05 14:27:11',NULL,NULL,NULL),(85,'2','spo2',NULL,NULL,NULL,NULL,'2024-07-05 14:27:11',NULL,NULL,NULL),(86,'2','cns',NULL,NULL,NULL,NULL,'2024-07-05 14:27:11',NULL,NULL,NULL),(87,'2','pa',NULL,NULL,NULL,NULL,'2024-07-05 14:27:11',NULL,NULL,NULL),(88,'2','discharge_notes',NULL,NULL,NULL,NULL,'2024-07-05 14:27:11',NULL,NULL,NULL),(89,'3','date_time',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(90,'3','primary_consultant',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(91,'3','admission_date_time','2024-07-04 - 05:49 AM',NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(92,'3','discharge_date_time','2024-07-05 - 05:49 AM',NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(93,'3','diagnosis',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(94,'3','discharge_against_medical_advice',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(95,'3','bp_1',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(96,'3','bp_2',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(97,'3','pulse_1',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(98,'3','pulse_2',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(99,'3','rr_1',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(100,'3','rr_2',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(101,'3','rs',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(102,'3','temperature',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(103,'3','cvs',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(104,'3','spo2',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(105,'3','cns',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(106,'3','pa',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(107,'3','consulting_doctor',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(108,'3','chief_complaints',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(109,'3','history_of_present_illness',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(110,'3','course_in_hospital',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(111,'3','hemodynamic_condition',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(112,'3','discharge_temperature',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(113,'3','discharge_pulse_1',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(114,'3','discharge_pulse_2',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(115,'3','discharge_bp_1',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(116,'3','discharge_bp_2',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(117,'3','discharge_rr_1',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(118,'3','discharge_rr_2',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(119,'3','discharge_spo2',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(120,'3','discharge_notes',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(121,'3','diet',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(122,'3','treatment_advice',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(123,'3','consult_symptoms',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(124,'3','followup_1',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(125,'3','followup_3',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(126,'3','followup_4',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(127,'3','medical',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(128,'3','final_notes',NULL,NULL,NULL,NULL,'2024-07-05 15:32:04',NULL,NULL,NULL),(129,'3','admission_date_time',NULL,NULL,NULL,NULL,'2024-07-05 15:33:27',NULL,NULL,NULL),(130,'3','discharge_date_time',NULL,NULL,NULL,NULL,'2024-07-05 15:33:27',NULL,NULL,NULL),(131,'3','admission_date_time','2024-07-03 - 05:38 AM',NULL,NULL,NULL,'2024-07-05 15:38:40',NULL,NULL,NULL),(132,'3','discharge_date_time','2024-07-04 - 05:48 AM',NULL,NULL,NULL,'2024-07-05 15:38:40',NULL,NULL,NULL),(133,'3','discharge_date_time','2024-07-06 - 05:48 AM',NULL,NULL,NULL,'2024-07-05 15:39:36',NULL,NULL,NULL),(134,'3','date_time','2024-07-03 - 05:59 AM',NULL,NULL,NULL,'2024-07-05 15:42:04',NULL,NULL,NULL),(135,'10','date_time',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(136,'10','primary_consultant',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(137,'10','admission_date_time',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(138,'10','discharge_date_time',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(139,'10','diagnosis',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(140,'10','discharge_against_medical_advice',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(141,'10','bp_1',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(142,'10','bp_2',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(143,'10','pulse_1',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(144,'10','pulse_2',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(145,'10','rr_1',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(146,'10','rr_2',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(147,'10','rs',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(148,'10','temperature',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(149,'10','cvs',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(150,'10','spo2',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(151,'10','cns',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(152,'10','pa',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(153,'10','consulting_doctor',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(154,'10','chief_complaints',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(155,'10','history_of_present_illness',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(156,'10','course_in_hospital',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(157,'10','hemodynamic_condition',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(158,'10','discharge_temperature',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(159,'10','discharge_pulse_1',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(160,'10','discharge_pulse_2',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(161,'10','discharge_bp_1',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(162,'10','discharge_bp_2',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(163,'10','discharge_rr_1',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(164,'10','discharge_rr_2',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(165,'10','discharge_spo2',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(166,'10','discharge_notes',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(167,'10','diet',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(168,'10','treatment_advice',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(169,'10','consult_symptoms',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(170,'10','followup_1',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(171,'10','followup_3',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(172,'10','followup_4',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(173,'10','medical',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(174,'10','final_notes',NULL,NULL,NULL,NULL,'2024-08-08 13:18:11',NULL,NULL,NULL),(206,'10','child_sex','Male',NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(207,'10','child_date_time',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(208,'10','child_weight',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(209,'10','child_condition_at_birth',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(210,'10','child_blood_grp',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(211,'10','child_cgpd',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(212,'10','child_tsh',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(213,'10','child_bcg',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(214,'10','child_given_on_bcg',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(215,'10','child_hepb',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(216,'10','child_given_on_hepb',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(217,'10','child_opv',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(218,'10','child_given_on_opv',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(219,'10','child_sbill',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(220,'10','child_phototherapy',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(221,'10','child_weightdischarge',NULL,NULL,NULL,NULL,'2024-08-08 13:39:23',NULL,NULL,NULL),(222,'10','child_date_time','2024-08-08 - 19:27 PM',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(223,'10','child_weight','12',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(224,'10','child_condition_at_birth','13',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(225,'10','child_blood_grp','14',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(226,'10','child_cgpd','15',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(227,'10','child_tsh','16',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(228,'10','child_bcg','17',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(229,'10','child_given_on_bcg','1819',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(230,'10','child_hepb','20',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(231,'10','child_given_on_hepb','21',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(232,'10','child_opv','22',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(233,'10','child_given_on_opv','23',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(234,'10','child_sbill','24',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(235,'10','child_phototherapy','25',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL),(236,'10','child_weightdischarge','26',NULL,NULL,NULL,'2024-08-08 13:57:50',NULL,NULL,NULL);
/*!40000 ALTER TABLE `new_discharge_summary` ENABLE KEYS */;
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
