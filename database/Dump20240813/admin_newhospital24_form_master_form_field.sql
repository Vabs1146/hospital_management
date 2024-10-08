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
-- Table structure for table `form_master_form_field`
--

DROP TABLE IF EXISTS `form_master_form_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_master_form_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_master_id` bigint(20) DEFAULT NULL,
  `form_field_code` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_master_form_field`
--

LOCK TABLES `form_master_form_field` WRITE;
/*!40000 ALTER TABLE `form_master_form_field` DISABLE KEYS */;
INSERT INTO `form_master_form_field` VALUES (1,1,97),(2,1,98),(3,1,99),(4,1,100),(5,2,101),(6,2,102),(7,2,103),(8,2,104),(9,2,105),(10,2,106),(11,2,107),(12,2,108),(13,2,109),(14,2,110),(15,2,111),(16,2,112),(17,2,113),(18,2,114),(19,2,115),(20,2,116),(21,2,117),(22,2,118),(23,2,119),(24,2,120),(25,2,121),(26,2,122),(27,2,123),(28,2,124),(29,2,125),(30,2,126),(31,2,127),(32,2,128),(33,2,129),(34,2,130),(35,2,131),(36,2,132),(37,2,133),(38,2,134),(39,2,135),(40,2,136),(41,2,137),(42,2,138),(43,3,108),(44,3,109),(45,3,112),(46,3,114),(47,3,115),(48,3,116),(49,3,117),(50,3,118),(51,3,119),(52,3,122),(53,3,123),(54,3,124),(55,3,126),(56,3,127),(57,3,128),(58,3,129),(59,3,130),(60,3,131),(61,3,133),(62,3,134),(63,3,135),(64,3,139),(65,3,140),(66,3,141),(67,3,142),(68,3,143),(69,3,144),(70,3,145),(71,3,146),(72,3,147),(73,3,148),(74,3,149),(75,3,150),(76,3,151),(77,3,152),(78,3,153),(79,3,154),(80,3,155),(81,3,156),(82,3,157),(83,3,158),(84,3,159),(85,3,160),(86,3,161),(87,3,162),(88,3,120),(89,3,132),(90,3,138),(91,4,39),(92,4,106),(93,4,176),(94,4,173),(95,4,40),(96,4,177),(97,4,169),(98,4,168),(99,4,167),(100,4,170),(101,4,171),(102,4,172),(103,4,175),(104,4,174),(105,4,178),(106,4,179),(107,4,180),(108,4,181),(109,4,182),(110,5,183),(111,5,184),(112,5,109),(113,5,146),(114,5,185),(115,5,147),(116,5,111),(117,5,186),(118,5,113),(119,5,187),(120,5,188),(121,5,189),(122,5,190),(123,6,194),(124,6,195),(125,6,196),(126,6,197),(127,6,198),(128,6,199),(129,6,200),(130,6,201),(131,6,202),(132,6,203),(133,6,204),(134,6,205),(135,6,206),(136,6,207),(137,6,208),(138,6,209),(139,6,210),(140,6,211),(141,6,212),(142,6,213),(143,6,214),(144,6,215),(145,6,216),(146,6,217),(147,6,218),(148,6,219),(149,6,220),(150,6,221),(151,6,222),(152,6,223),(153,6,224),(154,6,225),(155,7,226),(156,7,227),(157,7,228),(158,7,229),(159,7,230),(160,7,231),(161,7,232),(162,7,233),(163,7,234),(164,7,235),(165,7,236),(166,7,237),(167,7,238),(168,7,239),(169,7,240),(170,7,241),(171,8,242),(172,8,243),(173,8,244),(174,8,245),(175,8,246),(176,8,247),(177,8,248),(178,8,249),(179,8,250),(180,8,251),(181,8,252),(182,8,253),(183,8,254),(184,8,255),(185,8,256),(186,8,257),(187,8,258),(188,8,259),(189,8,260),(190,8,261),(191,8,262),(192,8,263),(193,8,264),(194,8,265),(195,8,266),(196,8,267),(197,8,268),(198,8,269),(199,8,270),(200,8,271),(201,8,272),(202,8,273);
/*!40000 ALTER TABLE `form_master_form_field` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:28:03
