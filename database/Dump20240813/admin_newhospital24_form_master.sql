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
-- Table structure for table `form_master`
--

DROP TABLE IF EXISTS `form_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` text DEFAULT NULL,
  `form_description` text DEFAULT NULL,
  `view_path` text DEFAULT NULL,
  `add_edit_path` text DEFAULT NULL,
  `print_path` text DEFAULT NULL,
  `index_path` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_master`
--

LOCK TABLES `form_master` WRITE;
/*!40000 ALTER TABLE `form_master` DISABLE KEYS */;
INSERT INTO `form_master` VALUES (1,'ipd_Admission','Admission Paper & Consent letter','ipd_Admission.view','ipd_Admission.addEdit','ipd_Admission.print','ipd_Admission.index','2019-02-03 21:05:01','2019-02-03 21:05:01'),(2,'ipd_SeenByMdDgo','S/B MD, DGO','ipd_SeenByMdDgo.view','ipd_SeenByMdDgo.addEdit','ipd_SeenByMdDgo.print','ipd_SeenByMdDgo.index','2019-02-03 21:05:01','2019-02-03 21:05:01'),(3,'ipd_seenByMdDchLlb','S/B MD, DGO','ipd_seenByMdDchLlb.view','ipd_seenByMdDchLlb.addEdit','ipd_seenByMdDchLlb.print','ipd_seenByMdDchLlb.index','2019-02-03 21:05:01','2019-02-03 21:05:01'),(4,'ipd_surgeryNotes','Surgery Operative Notes','ipd_surgeryNotes.view','ipd_surgeryNotes.addEdit','ipd_surgeryNotes.print','ipd_surgeryNotes.index','2019-02-03 21:05:01','2019-02-03 21:05:01'),(5,'ipd_dailyTreatment','Daily Treatment','ipd_dailyTreatment.view','ipd_dailyTreatment.addEdit','ipd_dailyTreatment.print','ipd_dailyTreatment.index','2019-02-03 21:05:01','2019-02-03 21:05:01'),(6,'squint_evalutation','eye form Squint Evalutaion','EyeForm.squint_view','EyeForm.squint_addEdit','EyeForm.squint_print','EyeForm.squint_index','2019-02-03 00:00:00','2019-02-03 00:00:00'),(7,'Paediatric_Eye_Evaluation','Paediatric Eye Evaluation','EyeForm.Paediatric_view','EyeForm.Paediatric_addEdit','EyeForm.Paediatric_print','EyeForm.Paediatric_index','2019-02-03 00:00:00','2019-02-03 00:00:00'),(8,'Ptosis_Proforma','Ptosis Proforma','EyeForm.PtosisProforma_view','EyeForm.PtosisProforma_addEdit','EyeForm.PtosisProforma_print','EyeForm.PtosisProforma_index','2019-02-03 00:00:00','2019-02-03 00:00:00');
/*!40000 ALTER TABLE `form_master` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:58
