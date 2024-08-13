ALTER TABLE `appointments` ADD `existing_patient` BOOLEAN NOT NULL DEFAULT FALSE COMMENT '1: true, 0: false' AFTER `appointment_dt`;

-- 2 tables created one doctor_Charges, procedures
