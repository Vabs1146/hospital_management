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
-- Table structure for table `homepage_data`
--

DROP TABLE IF EXISTS `homepage_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `homepage_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('section_slider_footer','section_departments','section_work','section_paper_cutting','section_welcome','section_slider_footer2','section_slider2') DEFAULT NULL,
  `img_url` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `read_more_link` text DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `displayed_in` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homepage_data`
--

LOCK TABLES `homepage_data` WRITE;
/*!40000 ALTER TABLE `homepage_data` DISABLE KEYS */;
INSERT INTO `homepage_data` VALUES (1,'section_slider_footer','uploads/hh4EsZ8HnlkYXOEgG2tKqyKIOvdSMSLiQ39s8LJ4.png',NULL,NULL,NULL,'1','2022-04-07 10:59:04','2022-04-07 10:59:04',NULL),(2,'section_departments','uploads/IACFOkEVhBbrG6K2VYD1Gal7y46IZ0aUqYbBULda.png','vnvbn','bvnnbvnvb       ffg hfh fgh',NULL,'1','2022-04-07 15:42:44','2022-04-07 15:42:44',NULL),(3,'section_departments','uploads/DkcfLlEWkdOhPrYCQQsNFkuVQ4mgy1iGpifSdbP8.gif','5t45','Shri Sai Baba Bhandara and Sai Palkhi Ceremony',NULL,'1','2022-04-07 15:43:28','2022-04-07 15:43:28',NULL),(4,'section_slider_footer','uploads/QiMYGfo4Vk7D0zG6x8iPgJIu2qcXbaakhZm83xMI.gif','test','bvnnbvnvb       ffg hfh fgh',NULL,'1','2022-04-07 15:48:26','2022-04-07 15:48:26',NULL),(5,'section_work','uploads/BRPxLzX0dUHf8908KxVEUVWSPnm0k3b1uIzfyNSe.jpeg','Work 1','asd asd a','https://google.com','1','2022-04-10 14:26:47','2022-04-10 14:26:47',NULL),(6,'section_work','uploads/AVTutXGlVaRTI2xF6ldXXM9zctrTqcyxuHKv5JRK.jpeg','Work 2','asad sad a','https://google.com','1','2022-04-10 14:27:02','2022-04-10 14:27:02',NULL),(7,'section_paper_cutting','uploads/eYDpR0G2bp3XHdFqUASxoQ4RhVSz85lS3CxmpCWD.jpeg,uploads/9mGmIeN4X0qssDQyGknOl4ceatjEzAmADbZ3Orxi.jpeg,uploads/KukVtGJDWkiwIZywQPtk5Dk5dH4OJYXWyrH7rSJT.jpeg,uploads/2ucaR3KTLLxyvwV6BueIm5P38b9Lu7wIUMZ6BpZ4.jpeg','Cutting 1','aaa','https://google.com','1','2022-04-10 14:27:39','2022-04-10 14:27:39',NULL),(8,'section_paper_cutting','uploads/Dvkt1CbSojE295pLgQyFcKA7s9QgrfbO2uOrUbI4.jpeg,uploads/XCYBJkOS1hB4j9E0CtiHcUaETDTFDTY9PYbC9nU0.jpeg,uploads/7K8lMNDY4xbQYhCVmwglUyNKDzlLfckOyu4ecKgH.jpeg,uploads/snmd6A7ID2LBPP7nQ03rmLMq9rtYDqZVEHgqHjf7.jpeg','Cutting 2','hhh','https://google.com','1','2022-04-10 14:27:58','2022-04-10 14:27:58',NULL),(9,'section_welcome','uploads/WnKQHxcQudpIeHPq0yQxLcymH7RYJ6nQTLbVzKoa.png','rrr','gfhfghgfhfgcvcxv dfh dfh df hdhfhfhfhgfhf hfhf h rd fj gg jkg jguj gy gjh fhg fh fhf hgf hgf hgfhg fh fgh fh fgh f fhgf  dhdfhdfhdfvcbhvbcv yuggjgjgjgjg jgjgjh gjgjg jgjh gjgjh gjg jghj gjg jghj gjg jggj ghjg jgj gjh gjhg jhg jhg jg jgj ghj ghj gjh hgjh gjhg jgj gjh gjg jgjh gjg jg jg jhg jg jg jg hjg j g jg jg hj ghj gjhg jg hjg jg g yur r yrty t d fhg fjfj  jg dhfhdfhd','https://google.com','1','2022-04-19 16:10:50','2022-06-09 06:32:45',NULL),(10,'section_slider_footer',NULL,'ccvbc','bvcbvcbcv','https://www.google.com/','1','2022-05-05 05:00:11','2022-05-05 05:00:11',NULL),(11,'section_slider_footer2','uploads/h7hWD3kCb7SDDKikkLD6xPFedYL9XjrpWA4qUr95.png','SSS','As you navigate our website, I hope you learn more about the qualities that make our Laboratory an outstanding provider of various essential services with Fastest diagnostic reports all around  15+ Years of experience Highly Equipped Clinic Laboratory Good quality care & service','https://www.google.com/','1','2022-05-06 13:53:10','2022-05-08 06:46:07',NULL),(12,'section_slider_footer2','uploads/W5wWST4zBn5wt8rF1qVSVR9hHd4dkzpEQMWRlt8J.jpeg','bbbb','gfhfghgfhfgcvcxv dfh dfh df hd dhdfhdfhdf dhfhdfhd',NULL,'1','2022-05-06 13:54:01','2022-05-06 13:54:01',NULL),(13,'section_slider_footer2','uploads/5fdSID3iE7qNpm5nTvb51qkOUWj6dh5JTHDuioru.jpeg','ppppp','gfhfghgfhfgcvcxv dfh dfh df hd dhdfhdfhdf dhfhdfhd',NULL,'1','2022-05-06 13:55:03','2022-05-06 13:55:03',NULL),(14,'section_slider2','uploads/y45bse74jHLgMCU8T53aIjitrJK6d3jYlcr8n1L4.jpeg','One','test description',NULL,'1','2022-05-12 04:50:38','2022-05-12 04:50:38',NULL),(15,'section_slider2','uploads/bZANZgw4TAEiHIaIDswOej0WBQY51OrJXT7luueM.jpeg','Two','Another testimonial',NULL,'1','2022-05-12 04:51:05','2022-05-12 04:51:05',NULL);
/*!40000 ALTER TABLE `homepage_data` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:37
