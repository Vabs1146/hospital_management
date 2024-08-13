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
-- Table structure for table `ent_prescription_templates`
--

DROP TABLE IF EXISTS `ent_prescription_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ent_prescription_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT 0,
  `template_name` varchar(255) DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `medicine_Quntity` text DEFAULT NULL,
  `numberoftimes` text DEFAULT NULL,
  `no_of_days` text DEFAULT NULL,
  `strength` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ent_prescription_templates`
--

LOCK TABLES `ent_prescription_templates` WRITE;
/*!40000 ALTER TABLE `ent_prescription_templates` DISABLE KEYS */;
INSERT INTO `ent_prescription_templates` VALUES (19,0,'Medicine given',236,'5 DAYS ONLY','BEFORE MEAL TWICE IN A DAY',NULL,'1 TAB AT A TIME','1'),(20,0,'Rabedif',NULL,NULL,NULL,NULL,NULL,'1'),(21,0,'gjgjgjh',299,'5 DAYS ONLY','AFTER MEAL TWICE IN A DAY',NULL,'2 SPOON AT A TIME','1'),(22,21,'gjgjgjh',299,'3 DAYS ONLY','BEFORE MEAL TWICE IN A DAY',NULL,'1 TAB AT A TIME','1'),(23,0,'Vaibhav123',300,'5 DAYS ONLY','BEFORE MEAL TWICE IN A DAY',NULL,NULL,'1'),(24,23,'Vaibhav123',299,'3 DAYS ONLY','AFTER MEAL TWICE IN A DAY',NULL,'1 CAP AT A TIME','1');
/*!40000 ALTER TABLE `ent_prescription_templates` ENABLE KEYS */;
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
