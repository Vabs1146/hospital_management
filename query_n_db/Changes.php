Discharge changes

ALTER TABLE `case_master` ADD `discharge_history` LONGTEXT NULL AFTER `case_appointment_time`;

==========================================
22 jan 2022
CREATE TABLE `ent_prescription_templates` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT 0,
  `template_name` varchar(255) DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `generic_medicine_id` int(11) DEFAULT NULL,
  `medicine_timing` text DEFAULT NULL,
  `frequency` text DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
ALTER TABLE `ent_prescription_templates`
  ADD PRIMARY KEY (`id`); 

ALTER TABLE `ent_prescription_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  ==============================================================

  ALTER TABLE `paymentfor` ADD `payment_mode` VARCHAR(255) NULL DEFAULT NULL AFTER `amountPaid`;

  ALTER TABLE `dentist_bill` ADD `payment_mode` VARCHAR(255) NULL DEFAULT NULL AFTER `balance`;