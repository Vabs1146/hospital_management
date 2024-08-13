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
-- Table structure for table `new_settings`
--

DROP TABLE IF EXISTS `new_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `new_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `new_settings`
--

LOCK TABLES `new_settings` WRITE;
/*!40000 ALTER TABLE `new_settings` DISABLE KEYS */;
INSERT INTO `new_settings` VALUES (1,'top_slider_text','VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV',NULL,NULL,NULL),(2,'twitter_link','twitter.com',NULL,NULL,NULL),(3,'fb_link','https://www.facebook.com',NULL,NULL,NULL),(4,'linkedin_link','linkedin.com',NULL,NULL,NULL),(5,'insta_link','instagram.com',NULL,NULL,NULL),(6,'hospital_logo','new_logo.jpeg',NULL,NULL,NULL),(7,'call_now','93705 64323',NULL,NULL,NULL),(8,'whatsapp','93705 64323',NULL,NULL,NULL),(9,'google_map','<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d235.52960083421533!2d73.23871636174187!3d19.174505539071774!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7938d4d84e1d1%3A0x2570bb247a8bc834!2snew%20life%20multispeciality%20hospital%20(%20Multispeciality%20Hospital%20In%20Badlapur%2CBest%20Hospital%20In%20Badlapur)!5e0!3m2!1sen!2sin!4v1690360594820!5m2!1sen!2sin\" width=\"300\" height=\"225\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>',NULL,NULL,NULL),(10,'call_us','93705 64323',NULL,NULL,NULL),(11,'email','info@newlifemultispecialityhospital.in',NULL,NULL,NULL),(12,'appointment_link','https://newlifemultispecialityhospital.in/appointment',NULL,NULL,NULL),(13,'address','Katrap area, opposite Prasad Divine hotel, Badlapur, Maharashtra 421503',NULL,NULL,NULL),(14,'copyright','Copyright Â© 2022 Hospital All rights reserved',NULL,NULL,NULL),(15,'hospital_name ','hospital',NULL,NULL,NULL),(16,'hospital_logo','new_logo.jpeg',NULL,NULL,NULL),(17,'footer_color','#00BFFF',NULL,NULL,NULL),(18,'header_color','#25D366',NULL,NULL,NULL);
/*!40000 ALTER TABLE `new_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:54
