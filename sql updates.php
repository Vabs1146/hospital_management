06 feb 2021

ALTER TABLE `eyeform` ADD `otherDetailsDiagnosis` TEXT NULL DEFAULT NULL AFTER `Other`;
	
	ALTER TABLE `eyeform` ADD `perimetry_sp_os` TEXT NULL DEFAULT NULL AFTER `colour_vision_OD`, ADD `perimetry_sp_od` TEXT NULL DEFAULT NULL AFTER `perimetry_sp_os`, ADD `laser_sp_os` TEXT NULL DEFAULT NULL AFTER `perimetry_sp_od`, ADD `laser_sp_od` TEXT NULL DEFAULT NULL AFTER `laser_sp_os`, ADD `oculizer_sp_os` TEXT NULL DEFAULT NULL AFTER `laser_sp_od`, ADD `oculizer_sp_od` TEXT NULL DEFAULT NULL AFTER `oculizer_sp_os`, ADD `ffa_sp_os` TEXT NULL DEFAULT NULL AFTER `oculizer_sp_od`, ADD `ffa_sp_od` TEXT NULL DEFAULT NULL AFTER `ffa_sp_os`;

===========================================================================

CREATE TABLE `eyform_refraction` ( 
	`refration_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`form_id` INT(11) NOT NULL , 
	`retinaCopy_refration_dv_sph_r` VARCHAR(255) NULL DEFAULT NULL , 
	`retinaCopy_refration_dv_cyl_r` VARCHAR(255) NULL DEFAULT NULL , 
	`retinaCopy_refration_dv_axis_r` VARCHAR(255) NULL DEFAULT NULL , 
	`retinaCopy_refration_dv_vision_r` VARCHAR(255) NULL DEFAULT NULL , 
	
	`retinaCopy_refration_dv_sph_l` VARCHAR(255) NULL DEFAULT NULL , 
	`retinaCopy_refration_dv_cyl_l` VARCHAR(255) NULL DEFAULT NULL , 
	`retinaCopy_refration_dv_axis_l` VARCHAR(255) NULL DEFAULT NULL , 
	`retinaCopy_refration_dv_vision_l` VARCHAR(255) NULL DEFAULT NULL , 
	
	
	`retinaCopy_refration_nv_sph_r` VARCHAR(255) NULL DEFAULT NULL , 
	`retinaCopy_refration_nv_cyl_r` VARCHAR(255) NULL DEFAULT NULL , 
	`retinaCopy_refration_nv_axis_r` VARCHAR(255) NULL DEFAULT NULL , 
	`retinaCopy_refration_nv_sph_r` VARCHAR(255) NULL DEFAULT NULL , 
	
	`retinaCopy_refration_nv_sph_r` VARCHAR(255) NULL DEFAULT NULL , 
	`retinaCopy_refration_nv_sph_r` VARCHAR(255) NULL DEFAULT NULL , 
	`retinaCopy_refration_nv_sph_r` VARCHAR(255) NULL DEFAULT NULL , 
	`retinaCopy_refration_nv_sph_r` VARCHAR(255) NULL DEFAULT NULL , 
	PRIMARY KEY (`refration_id`)) ENGINE = InnoDB;

======================21feb2021=======================================

INSERT INTO `settings` (`id`, `name`, `value`, `updated_by`, `created_at`, `updated_at`) VALUES (NULL, 'bill_number', '00001', NULL, NULL, NULL);

ALTER TABLE `settings` CHANGE `value` `value` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

INSERT INTO `settings` (`id`, `name`, `value`, `updated_by`, `created_at`, `updated_at`) VALUES (NULL, 'bill_pointer', '', NULL, NULL, NULL)

==========================22feb2021======================================================
CREATE TABLE `devgadehospital`.`anxious_for_issue` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `case_id` INT(11) NULL , `case_number` VARCHAR(255) NULL , `wife_name` VARCHAR(255) NULL , `wife_age` VARCHAR(50) NULL , `husband_name` VARCHAR(255) NULL , `husband_age` VARCHAR(50) NULL , `married_since` VARCHAR(255) NULL , `menstrual_history` TEXT NULL , `lmp` TEXT NULL , `obstetric_history` TEXT NULL , `other_medical_surgical_illness` TEXT NULL , `other_art_procedure_past` TEXT NULL , `hsg` TEXT NULL , `laproscopy` TEXT NULL , `hsf` VARCHAR(255) NULL , `lh` VARCHAR(255) NULL , `fsh` VARCHAR(255) NULL , `tsh` VARCHAR(255) NULL , `prolactin` VARCHAR(255) NULL , `amh` VARCHAR(255) NULL , `folliculometry` TEXT NULL , `adviced` TEXT NULL , `created_by` INT(11) NULL , `created_at` TIMESTAMP NULL , `updated_at` TIMESTAMP NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
==================================================================
18 aug 2021

CREATE TABLE `covid_consent_form` (
  `id` int(11) NOT NULL,
  `case_id` int(11) DEFAULT NULL,
  `consent_date` date DEFAULT NULL,
  `name_of_attendant` varchar(255) DEFAULT NULL,
  `attendant_signature_date` date DEFAULT NULL,
  `name_of_doctor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
=========================================================
19 aug 2021

ALTER TABLE `case_master` ADD `surgery_complete_date_time` DATETIME NULL AFTER `admission_date_time`;

==============================================

24 aug 2021

CREATE TABLE `procedure_template_data` (
  `id` int(11) NOT NULL,
  `template_id` varchar(255) DEFAULT NULL,
  `key_text` varchar(255) DEFAULT NULL,
  `od` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `duration_od` varchar(255) DEFAULT NULL,
  `duration_os` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `procedure_template_data`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `procedure_template_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

----------------------------------------------------

CREATE TABLE `procedure_template` (
  `id` int(11) NOT NULL,
  `template_type` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `procedure_template`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `procedure_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
===================================================================

25 aug 2021

ALTER TABLE `case_master` ADD `reporting_date_time` TIMESTAMP NULL AFTER `surgery_date_time`;

====================================================
27 aug 2021

ALTER TABLE `medical_store` ADD `is_generic` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `generic_name`;
==================================================
28 aug 2021

ALTER TABLE `prescription_lists` ADD `medicine_timing` TEXT NULL AFTER `to_date`;
ALTER TABLE `prescription_lists` ADD `generic_medicine_id` INT(11) NULL AFTER `medicine_id`;

ALTER TABLE `prescription_templates` ADD `generic_medicine_id` INT(11) NULL AFTER `medicine_id`, ADD `medicine_timing` TEXT NULL AFTER `generic_medicine_id`;

ALTER TABLE `case_master` ADD `discharge_history` LONGTEXT NULL AFTER `case_appointment_time`;

ALTER TABLE `discharge` ADD `discharge_history` LONGTEXT NULL AFTER `updated_at`;
=================================================================================
29 aug 2021

ALTER TABLE `case_master` ADD `is_ipd` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `patient_type`;
==================================================================================
2 sept 2021

CREATE TABLE `ipdbill_item_template` (
  `id` int(11) NOT NULL,
  `template_type` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `ipdbill_item_template`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ipdbill_item_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `ipdbill_item_template_data` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `template_id` INT(11) NULL , `label` VARCHAR(255) NULL , `value` VARCHAR(255) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

====================================
4 sept 2021

CREATE TABLE `patient_activity` (
  `id` int(11) NOT NULL,
  `case_id` varchar(255) DEFAULT NULL,
  `activity_type` varchar(255) DEFAULT NULL,
  `status` enum('In','Out') DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `patient_activity`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `patient_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
=====================================================
10-09-2021
ALTER TABLE `eyeform` ADD `advance_payment_type` INT(11) NULL AFTER `advance_amount`, ADD `advance_date` TIMESTAMP NULL AFTER `advance_payment_type`;
======================================================
11-09-2021

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `roles` (`id`, `role`, `status`) VALUES
(1, 'Admin', '0'),
(2, 'Doctor', '1'),
(3, 'Receptionist', '1'),
(4, 'Ophtometry ', '1'),
(5, 'Counselor', '1');

ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--------------------------------------------------------------------
ALTER TABLE `case_master` ADD `created_by` INT(11) NULL AFTER `discharge_history`;
=========================================================================================
16-09-2021

CREATE TABLE `certificate` (
  `id` int(11) NOT NULL,
  `case_id` varchar(255) DEFAULT NULL,
  `diagnosis` longtext DEFAULT NULL,
  `show_is_opd_ipd` enum('0','1') NOT NULL DEFAULT '0',
  `is_opd_ipd` varchar(255) DEFAULT NULL,
  `show_opd` enum('0','1') NOT NULL DEFAULT '0',
  `opd_from` date DEFAULT NULL,
  `opd_to` date DEFAULT NULL,
  `show_ipd` enum('0','1') DEFAULT '0',
  `ipd_on` date DEFAULT NULL,
  `discharge_on` date DEFAULT NULL,
  `show_operated` enum('0','1') NOT NULL DEFAULT '0',
  `operated_for` longtext DEFAULT NULL,
  `operated_date` date DEFAULT NULL,
  `show_advised` enum('0','1') NOT NULL DEFAULT '0',
  `rest_from` date DEFAULT NULL,
  `rest_days` int(11) DEFAULT NULL,
  `show_further_advised` enum('0','1') NOT NULL DEFAULT '0',
  `further_rest_from` date DEFAULT NULL,
  `further_rest_days` int(11) DEFAULT NULL,
  `show_resume_work` enum('0','1') NOT NULL DEFAULT '0',
  `is_nominal_or_light_work` varchar(255) DEFAULT NULL,
  `nominal_or_light_work_from` date DEFAULT NULL,
  `show_identification_mark` enum('0','1') NOT NULL DEFAULT '0',
  `identification_mark` longtext DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
=============================================================================
18-09-2021

ALTER TABLE `patient_activity` ADD `in_created_date` DATE NULL AFTER `created_date`, ADD `in_created_time` VARCHAR(255) NULL AFTER `in_created_date`, ADD `in_created_by` INT(11) NULL AFTER `in_created_time`, ADD `out_created_date` DATE NULL AFTER `in_created_by`, ADD `out_created_time` VARCHAR(255) NULL AFTER `out_created_date`, ADD `out_created_by` INT(11) NULL AFTER `out_created_time`;
===============================================================
19-09-2021
ALTER TABLE `case_master` ADD `posted_for_doctor` INT(11) NULL AFTER `reporting_date_time`;
ALTER TABLE `eyeform` ADD `advance_payment_reference` VARCHAR(255) NULL AFTER `advance_payment_type`;
====================================================================
26-09-2021

CREATE TABLE `prescription_data` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) DEFAULT NULL,
  `case_id` varchar(255) DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `date_from` varchar(255) DEFAULT NULL,
  `date_to` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `prescription_data`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `prescription_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
========================

ALTER TABLE `eyeform` ADD `other_details_comment` LONGTEXT NULL AFTER `pastTreatmentHistory`;
ALTER TABLE `eyeform` ADD `advance_payment_reference` VARCHAR(255) NULL AFTER `other_details_comment`;

==============================================================================
7-10-2021

ALTER TABLE `case_master` ADD `patient_priority` VARCHAR(255) NULL AFTER `patient_type`;
====================================================
2 jane 2022

ALTER TABLE `case_master` ADD `mr_mrs_ms` VARCHAR(255) NULL DEFAULT NULL AFTER `casehistory_followup_notes`, ADD `middle_name` VARCHAR(255) NULL DEFAULT NULL AFTER `mr_mrs_ms`, ADD `last_name` VARCHAR(255) NULL DEFAULT NULL AFTER `middle_name`, ADD `area` VARCHAR(255) NULL DEFAULT NULL AFTER `last_name`, ADD `is_followup` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `area`;

ALTER TABLE `patient_activity` ADD `in_timestamp` TIMESTAMP NULL AFTER `out_created_by`, ADD `out_timestamp` TIMESTAMP NULL AFTER `in_timestamp`;

============================================================================================
25 jan 2022
ALTER TABLE `dentist_pain_in` ADD `case_id` VARCHAR(255) NULL DEFAULT NULL AFTER `pain_in_teeth`;

ALTER TABLE `paymentfor` ADD `payment_mode` VARCHAR(255) NULL DEFAULT NULL AFTER `amountPaid`;

CREATE TABLE `ent_prescription_templates` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT '0',
  `template_name` varchar(255) DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `medicine_Quntity` text,
  `numberoftimes` text,
  `no_of_days` text,
  `strength` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `ent_prescription_templates`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ent_prescription_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
