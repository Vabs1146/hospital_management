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
-- Table structure for table `eyeform`
--

DROP TABLE IF EXISTS `eyeform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eyeform` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `case_id` bigint(20) DEFAULT NULL,
  `case_number` text DEFAULT NULL,
  `dvn_od` text DEFAULT NULL,
  `dvn_os` text DEFAULT NULL,
  `nvn_od` text DEFAULT NULL,
  `nvn_os` text DEFAULT NULL,
  `lids_od` text DEFAULT NULL,
  `lids_os` text DEFAULT NULL,
  `conjunctive_od` text DEFAULT NULL,
  `conjunctive_os` text DEFAULT NULL,
  `iris_od` text DEFAULT NULL,
  `iris_os` text DEFAULT NULL,
  `pupil_od` text DEFAULT NULL,
  `pupil_os` text DEFAULT NULL,
  `fundus_od` text DEFAULT NULL,
  `fundus_os` text DEFAULT NULL,
  `k1_od` text DEFAULT NULL,
  `k1_os` text DEFAULT NULL,
  `k2_od` text DEFAULT NULL,
  `k2_os` text DEFAULT NULL,
  `lenspower_od` text DEFAULT NULL,
  `lenspower_os` text DEFAULT NULL,
  `axial_length_OD` text DEFAULT NULL,
  `axial_length_OS` text DEFAULT NULL,
  `sac_od` text DEFAULT NULL,
  `sac_os` text DEFAULT NULL,
  `generalExamination` text DEFAULT NULL,
  `Other` text DEFAULT NULL,
  `otherDetailsDiagnosis` text DEFAULT NULL,
  `otherDetailsAnteriorSegment` text DEFAULT NULL,
  `otherDetailsPosteriorSegment` text DEFAULT NULL,
  `systanicExamination` text DEFAULT NULL,
  `CNS` text DEFAULT NULL,
  `localExamReport` text DEFAULT NULL,
  `treatmentAdvice` text DEFAULT NULL,
  `OdImg1` text DEFAULT NULL,
  `OsImg1` text DEFAULT NULL,
  `OdImg2` text DEFAULT NULL,
  `OsImg2` text DEFAULT NULL,
  `IOP_OD` text DEFAULT NULL,
  `IOP_OS` text DEFAULT NULL,
  `opticdisc_OD` text DEFAULT NULL,
  `opticdisc_OS` text DEFAULT NULL,
  `withglasses_OD` text DEFAULT NULL,
  `withglasses_OS` text DEFAULT NULL,
  `withpinhole_OD` text DEFAULT NULL,
  `withpinhole_OS` text DEFAULT NULL,
  `colour_vision_OS` text DEFAULT NULL,
  `colour_vision_OD` text DEFAULT NULL,
  `perimetry_sp_os` text DEFAULT NULL,
  `perimetry_sp_od` text DEFAULT NULL,
  `laser_sp_os` text DEFAULT NULL,
  `laser_sp_od` text DEFAULT NULL,
  `oculizer_sp_os` text DEFAULT NULL,
  `oculizer_sp_od` text DEFAULT NULL,
  `ffa_sp_os` text DEFAULT NULL,
  `ffa_sp_od` text DEFAULT NULL,
  `visualacuity_OD` text DEFAULT NULL,
  `visualacuity_OS` text DEFAULT NULL,
  `colour_OD` text DEFAULT NULL,
  `colour_OS` text DEFAULT NULL,
  `shape_OD` text DEFAULT NULL,
  `shape_OS` text DEFAULT NULL,
  `size_OS` text DEFAULT NULL,
  `size_OD` text DEFAULT NULL,
  `Ratio_OD` text DEFAULT NULL,
  `Ratio_OS` text DEFAULT NULL,
  `Pachymetry_OD` text DEFAULT NULL,
  `Pachymetry_OS` text DEFAULT NULL,
  `schimerTest1_OD` text DEFAULT NULL,
  `schimerTest1_OS` text DEFAULT NULL,
  `schimerTest2_OD` text DEFAULT NULL,
  `schimerTest2_OS` text DEFAULT NULL,
  `surgery` text DEFAULT NULL,
  `advance_amount` text DEFAULT NULL,
  `advance_payment_type` int(11) DEFAULT NULL,
  `advance_payment_reference` varchar(255) DEFAULT NULL,
  `advance_date` timestamp NULL DEFAULT NULL,
  `sph_r_undi` text DEFAULT NULL,
  `sph_r_di` text DEFAULT NULL,
  `sph_l_undi` text DEFAULT NULL,
  `sph_l_di` text DEFAULT NULL,
  `cyl_r_undi` text DEFAULT NULL,
  `cyl_r_di` text DEFAULT NULL,
  `cyl_l_undi` text DEFAULT NULL,
  `cyl_l_di` text DEFAULT NULL,
  `Axis_r_undi` text DEFAULT NULL,
  `Axis_r_di` text DEFAULT NULL,
  `Axis_l_undi` text DEFAULT NULL,
  `Axis_l_di` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `retino_scopy_OD` text DEFAULT NULL,
  `retino_scopy_OS` text DEFAULT NULL,
  `CCT_OD` text DEFAULT NULL,
  `CCT_OS` text DEFAULT NULL,
  `Advice_OD` text DEFAULT NULL,
  `Advice_OS` text DEFAULT NULL,
  `BloodInvestigation` text DEFAULT NULL,
  `uveiitis_chk` int(10) NOT NULL,
  `preoperative_chk` int(11) NOT NULL,
  `KC_OD` text DEFAULT NULL,
  `KC_OS` text DEFAULT NULL,
  `vision_l_sa` text DEFAULT NULL,
  `vision_r_sa` text DEFAULT NULL,
  `vision_l_pga` text DEFAULT NULL,
  `vision_r_pga` text DEFAULT NULL,
  `Add_l_sa` text DEFAULT NULL,
  `Add_r_sa` text DEFAULT NULL,
  `Add_l_pga` text DEFAULT NULL,
  `Add_r_pga` text DEFAULT NULL,
  `Nvision_l_sa` text DEFAULT NULL,
  `Nvision_r_sa` text DEFAULT NULL,
  `Nvision_l_pga` text DEFAULT NULL,
  `Nvision_r_pga` text DEFAULT NULL,
  `gonio_od` text DEFAULT NULL,
  `gonio_os` text DEFAULT NULL,
  `familyHistory` text DEFAULT NULL,
  `birthHistory` text DEFAULT NULL,
  `lens_type_OD` text DEFAULT NULL,
  `lens_type_OS` text DEFAULT NULL,
  `sph_r_undi_sub` text DEFAULT NULL,
  `cyl_r_undi_sub` text DEFAULT NULL,
  `Axis_r_undi_sub` text DEFAULT NULL,
  `sph_l_undi_sub` text DEFAULT NULL,
  `cyl_l_undi_sub` text DEFAULT NULL,
  `Axis_l_undi_sub` text DEFAULT NULL,
  `sph_r_di_sub` text DEFAULT NULL,
  `cyl_r_di_sub` text DEFAULT NULL,
  `Axis_r_di_sub` text DEFAULT NULL,
  `sph_l_di_sub` text DEFAULT NULL,
  `cyl_l_di_sub` text DEFAULT NULL,
  `Axis_l_di_sub` text DEFAULT NULL,
  `iop_od_time` varchar(255) DEFAULT NULL,
  `iop_os_time` varchar(255) DEFAULT NULL,
  `Vision_r_undi` varchar(255) DEFAULT NULL,
  `Vision_l_undi` varchar(255) DEFAULT NULL,
  `Vision_r_undi_sub` varchar(255) DEFAULT NULL,
  `Vision_l_undi_sub` varchar(255) DEFAULT NULL,
  `Vision_r_di` varchar(255) DEFAULT NULL,
  `Vision_l_di` varchar(255) DEFAULT NULL,
  `Vision_r_di_sub` varchar(255) DEFAULT NULL,
  `Vision_l_di_sub` varchar(255) DEFAULT NULL,
  `r_retinoscopy_sph` varchar(255) DEFAULT NULL,
  `r_retinoscopy_cyl` varchar(255) DEFAULT NULL,
  `r_retinoscopy_axi` varchar(255) DEFAULT NULL,
  `r_retinoscopy_vision` varchar(255) DEFAULT NULL,
  `l_retinoscopy_sph` varchar(255) DEFAULT NULL,
  `l_retinoscopy_cyl` varchar(255) DEFAULT NULL,
  `l_retinoscopy_axi` varchar(255) DEFAULT NULL,
  `l_retinoscopy_vision` varchar(255) DEFAULT NULL,
  `pastTreatmentHistory` longtext DEFAULT NULL,
  `other_details_comment` longtext DEFAULT NULL,
  `with_glass_dilated_os` varchar(255) DEFAULT NULL,
  `with_glass_dilated_od` varchar(255) DEFAULT NULL,
  `OdImg1_comment` text DEFAULT NULL,
  `OsImg1_comment` text DEFAULT NULL,
  `OdImg2_comment` text DEFAULT NULL,
  `OsImg2_comment` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eyeform`
--

LOCK TABLES `eyeform` WRITE;
/*!40000 ALTER TABLE `eyeform` DISABLE KEYS */;
/*!40000 ALTER TABLE `eyeform` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 19:27:50
