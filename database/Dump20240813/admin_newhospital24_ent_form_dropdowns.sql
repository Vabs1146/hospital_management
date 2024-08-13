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
-- Table structure for table `ent_form_dropdowns`
--

DROP TABLE IF EXISTS `ent_form_dropdowns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ent_form_dropdowns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formName` text DEFAULT NULL,
  `fieldName` text DEFAULT NULL,
  `ddText` text DEFAULT NULL,
  `ddValue` text DEFAULT NULL,
  `isdefault` bit(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ent_form_dropdowns`
--

LOCK TABLES `ent_form_dropdowns` WRITE;
/*!40000 ALTER TABLE `ent_form_dropdowns` DISABLE KEYS */;
INSERT INTO `ent_form_dropdowns` VALUES (58,'ent_prescription','Times a day','BEFORE MEAL TWICE IN A DAY','BEFORE MEAL TWICE IN A DAY',NULL,'2023-06-19 09:24:42',NULL),(59,'ent_prescription','Times a day','AFTER MEAL TWICE IN A DAY','AFTER MEAL TWICE IN A DAY',NULL,'2023-06-19 09:24:42',NULL),(60,'ent_prescription','Times a day','AFTER MEAL ONLY AT NIGHT','AFTER MEAL ONLY AT NIGHT',NULL,'2023-06-19 09:24:42',NULL),(61,'ent_prescription','Times a day','AFTER MEAL AT AFTERNOON','AFTER MEAL AT AFTERNOON',NULL,'2023-06-19 09:24:42',NULL),(62,'ent_prescription','Times a day','BEFORE BREKFEST','BEFORE BREKFEST',NULL,'2023-06-19 09:24:42',NULL),(63,'ent_prescription','Times a day','AFTER BREAKFEST','AFTER BREAKFEST',NULL,'2023-06-19 09:24:42',NULL),(64,'ent_prescription','Strength','1 TAB AT A TIME','1 TAB AT A TIME',NULL,'2023-06-19 09:26:23',NULL),(65,'ent_prescription','Strength','1 CAP AT A TIME','1 CAP AT A TIME',NULL,'2023-06-19 09:26:23',NULL),(66,'ent_prescription','Strength','2 SPOON AT A TIME','2 SPOON AT A TIME',NULL,'2023-06-19 09:26:23',NULL),(67,'ent_prescription','Strength','2 SPOON TWICE IN ADY','2 SPOON TWICE IN ADY',NULL,'2023-06-19 09:26:23',NULL),(68,'ent_prescription','Strength','2 SPOON 3 TIMES IN DAY','2 SPOON 3 TIMES IN DAY',NULL,'2023-06-19 09:26:23',NULL),(69,'ent_prescription','Quantity','3 DAYS ONLY','3 DAYS ONLY',NULL,'2023-06-19 09:26:56',NULL),(70,'ent_prescription','Quantity','5 DAYS ONLY','5 DAYS ONLY',NULL,'2023-06-19 09:26:56',NULL),(71,'ent_prescription','Times a day','3 TIMES AFTER MEAL','3 TIMES AFTER MEAL',NULL,'2023-06-19 09:31:22',NULL),(72,'ent_prescription','Times a day','','',NULL,'2023-06-19 09:31:22',NULL),(73,'ent_prescription','Times a day','AFTER DINNER ONLY','AFTER DINNER ONLY',NULL,'2023-06-19 10:14:48',NULL),(74,'ent_prescription','Times a day','AFTER  LUNCH ONLY','AFTER  LUNCH ONLY',NULL,'2023-06-19 10:14:48',NULL),(75,'ent_prescription','Times a day','AFTER  BREAKFAST ONLY','AFTER  BREAKFAST ONLY',NULL,'2023-06-19 10:14:48',NULL),(76,'ent_prescription','Times a day','','',NULL,'2023-06-19 10:14:48',NULL),(77,'ent_prescription','Times a day','दिवसातून दोन वेळा','दिवसातून दोन वेळा',NULL,'2024-03-29 13:27:05',NULL),(78,'ent_prescription','Strength','1/2 TABLET AT A TIME','1/2 TABLET AT A TIME',NULL,'2024-04-02 08:12:44',NULL),(79,'ent_prescription','Quantity','1 MONTH','1 MONTH',NULL,'2024-04-03 06:52:23',NULL),(80,'ent_prescription','Times a day','Before breakfast','Before breakfast',NULL,'2024-04-03 06:52:39',NULL),(81,'ent_prescription','Times a day','दिवसातून तीन वेळा','दिवसातून तीन वेळा',NULL,'2024-04-03 14:40:57',NULL),(82,'ent_prescription','Times a day','दुखत त्या जागी लावणे','दुखत त्या जागी लावणे',NULL,'2024-04-03 14:41:28',NULL),(83,'ent_prescription','Times a day','ONCE A DAY BEFORE BREAKFAST','ONCE A DAY BEFORE BREAKFAST',NULL,'2024-04-03 15:02:42',NULL),(84,'ent_prescription','Times a day','ONCE A DAY BEFORE LUNCH','ONCE A DAY BEFORE LUNCH',NULL,'2024-04-03 15:03:14',NULL),(85,'ent_prescription','Times a day','ONCE A DAY BEFORE DINNER','ONCE A DAY BEFORE DINNER',NULL,'2024-04-03 15:04:17',NULL),(86,'ent_prescription','Times a day','ONCE A DAY AFTER BREAKFAST','ONCE A DAY AFTER BREAKFAST',NULL,'2024-04-03 15:04:38',NULL),(87,'ent_prescription','Times a day','ONCE A DAY AFTER LUNCH','ONCE A DAY AFTER LUNCH',NULL,'2024-04-03 15:05:07',NULL),(88,'ent_prescription','Times a day','ONCE A DAY AFTER DINNER','ONCE A DAY AFTER DINNER',NULL,'2024-04-03 15:05:45',NULL),(89,'ent_prescription','Quantity','CONTINUE','CONTINUE',NULL,'2024-04-03 15:06:41',NULL),(90,'ent_prescription','Quantity','7 DAYS','7 DAYS',NULL,'2024-04-04 07:44:39',NULL),(91,'ent_prescription','Quantity','Sos','Sos',NULL,'2024-04-04 07:48:42',NULL),(92,'ent_prescription','Times a day','दिन में दो बार भोजन से पहले','दिन में दो बार भोजन से पहले',NULL,'2024-07-23 13:15:01',NULL);
/*!40000 ALTER TABLE `ent_form_dropdowns` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:45
