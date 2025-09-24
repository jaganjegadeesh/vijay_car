

CREATE TABLE `vijay_garage_advance_voucher` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `advance_voucher_id` mediumtext NOT NULL,
  `advance_voucher_number` mediumtext NOT NULL,
  `advance_voucher_date` date NOT NULL,
  `engineer_id` mediumtext NOT NULL,
  `engineer_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `vijay_garage_attendance` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `attendance_id` mediumtext NOT NULL,
  `attendance_date` date NOT NULL,
  `engineer_id` mediumtext NOT NULL,
  `engineer_name` mediumtext NOT NULL,
  `present_status` mediumtext NOT NULL,
  `daily_salary` mediumtext NOT NULL,
  `total_salary` mediumtext NOT NULL,
  `salary_id` mediumtext NOT NULL,
  `is_salaried` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_attendance (id, created_date_time, creator, creator_name, bill_company_id, attendance_id, attendance_date, engineer_id, engineer_name, present_status, daily_salary, total_salary, salary_id, is_salaried, deleted) VALUES ('1','2025-09-19 18:29:44','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','515652555255354551553544525638794d4449314c5441354c544535','2025-09-19','4d5467774f5449774d6a55784d6a55304d7a56664d44453d','5533566959513d3d','P','333.33','333.33','4d6a51774f5449774d6a55784d5455304d444e664d44453d','1','0');

INSERT INTO vijay_garage_attendance (id, created_date_time, creator, creator_name, bill_company_id, attendance_id, attendance_date, engineer_id, engineer_name, present_status, daily_salary, total_salary, salary_id, is_salaried, deleted) VALUES ('2','2025-09-19 18:29:44','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','515652555255354551553544525638794d4449314c5441354c544535','2025-09-19','4d5467774f5449774d6a55784d6a55304d7a56664d44493d','5758563259513d3d','P','500','500','4d6a51774f5449774d6a55784d5455304d444e664d44453d','1','0');

INSERT INTO vijay_garage_attendance (id, created_date_time, creator, creator_name, bill_company_id, attendance_id, attendance_date, engineer_id, engineer_name, present_status, daily_salary, total_salary, salary_id, is_salaried, deleted) VALUES ('3','2025-09-19 18:29:44','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','515652555255354551553544525638794d4449314c5441354c544535','2025-09-19','4d546b774f5449774d6a55784d6a51304e5452664d44513d','5332463261586c68','P','400','400','4d6a51774f5449774d6a55784d5455304d444e664d44453d','1','0');

INSERT INTO vijay_garage_attendance (id, created_date_time, creator, creator_name, bill_company_id, attendance_id, attendance_date, engineer_id, engineer_name, present_status, daily_salary, total_salary, salary_id, is_salaried, deleted) VALUES ('4','2025-09-19 18:29:44','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','515652555255354551553544525638794d4449314c5441354c544535','2025-09-19','4d546b774f5449774d6a55784d6a51304e5452664d44553d','5457396f59573568','P','666.67','666.67','4d6a51774f5449774d6a55784d5455304d444e664d44453d','1','0');

INSERT INTO vijay_garage_attendance (id, created_date_time, creator, creator_name, bill_company_id, attendance_id, attendance_date, engineer_id, engineer_name, present_status, daily_salary, total_salary, salary_id, is_salaried, deleted) VALUES ('5','2025-09-24 11:53:22','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','515652555255354551553544525638794d4449314c5441354c544930','2025-09-24','4d5467774f5449774d6a55784d6a55304d7a56664d44453d','5533566959513d3d','P','333.33','333.33','4d6a51774f5449774d6a55784d5455304d444e664d44453d','1','0');

INSERT INTO vijay_garage_attendance (id, created_date_time, creator, creator_name, bill_company_id, attendance_id, attendance_date, engineer_id, engineer_name, present_status, daily_salary, total_salary, salary_id, is_salaried, deleted) VALUES ('6','2025-09-24 11:53:22','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','515652555255354551553544525638794d4449314c5441354c544930','2025-09-24','4d5467774f5449774d6a55784d6a55304d7a56664d44493d','5758563259513d3d','P','500','500','4d6a51774f5449774d6a55784d5455304d444e664d44453d','1','0');

INSERT INTO vijay_garage_attendance (id, created_date_time, creator, creator_name, bill_company_id, attendance_id, attendance_date, engineer_id, engineer_name, present_status, daily_salary, total_salary, salary_id, is_salaried, deleted) VALUES ('7','2025-09-24 11:53:22','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','515652555255354551553544525638794d4449314c5441354c544930','2025-09-24','4d546b774f5449774d6a55784d6a51304e5452664d44513d','5332463261586c68','P','400','400','4d6a51774f5449774d6a55784d5455304d444e664d44453d','1','0');

INSERT INTO vijay_garage_attendance (id, created_date_time, creator, creator_name, bill_company_id, attendance_id, attendance_date, engineer_id, engineer_name, present_status, daily_salary, total_salary, salary_id, is_salaried, deleted) VALUES ('8','2025-09-24 11:53:22','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','515652555255354551553544525638794d4449314c5441354c544930','2025-09-24','4d546b774f5449774d6a55784d6a51304e5452664d44553d','5457396f59573568','P','666.67','666.67','4d6a51774f5449774d6a55784d5455304d444e664d44453d','1','0');


CREATE TABLE `vijay_garage_bank` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `account_name` mediumtext NOT NULL,
  `account_number` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `ifsc_code` mediumtext NOT NULL,
  `account_type` mediumtext NOT NULL,
  `bank_name_account_number` mediumtext NOT NULL,
  `branch` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_bank (id, created_date_time, creator, creator_name, bill_company_id, bank_id, account_name, account_number, bank_name, ifsc_code, account_type, bank_name_account_number, branch, payment_mode_id, deleted) VALUES ('2','2025-09-18 13:27:23','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d5449334d6a4e664d44493d','55304a4a','4e6a41334f5441334f5441354d413d3d','55304a4a','NULL','553246326157356e63773d3d','55304a4a494367324d4463354d4463354d446b774b513d3d','55326c325957746863326b3d','4d5467774f5449774d6a55774d5449324d7a4a664d444d3d','0');

INSERT INTO vijay_garage_bank (id, created_date_time, creator, creator_name, bill_company_id, bank_id, account_name, account_number, bank_name, ifsc_code, account_type, bank_name_account_number, branch, payment_mode_id, deleted) VALUES ('4','2025-09-22 15:35:18','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a49774f5449774d6a55774d7a4d314d5468664d44513d','566d6c756233526f','4f446b314d7a51354e5451354e5467304e544d304e54493d','5657357062323467596d4675617942765a694270626d527059513d3d','4e6a63354e7a51354e7a6b334e413d3d','59335679636d567564413d3d','5657357062323467596d4675617942765a694270626d52705953416f4f446b314d7a51354e5451354e5467304e544d304e544970','55326c325957746863326b3d','4d6a49774f5449774d6a55774d7a4d314d7a68664d44593d,4d5467774f5449774d6a55774e4449784d5464664d44553d','0');

INSERT INTO vijay_garage_bank (id, created_date_time, creator, creator_name, bill_company_id, bank_id, account_name, account_number, bank_name, ifsc_code, account_type, bank_name_account_number, branch, payment_mode_id, deleted) VALUES ('5','2025-09-23 18:12:56','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a4d774f5449774d6a55774e6a45794e545a664d44553d','5247563261513d3d','4f446b314d7a51354e5451354e5467354d446b3d','56453143','56453143544441774d4449774d7a413d','633246326157356e63773d3d','56453143494367344f54557a4e446b314e446b314f446b774f536b3d','5532463064485679','4d6a49774f5449774d6a55774d7a4d314d7a68664d44593d','0');


CREATE TABLE `vijay_garage_company` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `company_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `pincode` mediumtext NOT NULL,
  `gst_number` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `company_details` mediumtext NOT NULL,
  `logo` mediumtext NOT NULL,
  `watermark` mediumtext NOT NULL,
  `primary_company` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_company (id, created_date_time, creator, creator_name, company_id, name, lower_case_name, email, address, state, district, city, others_city, pincode, gst_number, mobile_number, company_details, logo, watermark, primary_company, deleted) VALUES ('1','2025-08-29 15:21:22','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c','646d6c7159586b675a3246795957646c','646d6c7159586c6e59584a685a3255774d5464415a3231686157777559323974','4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e6862485679','5647467461577767546d466b64513d3d','566d6c796457526f645735685a324679','53323976636d4670613356755a48553d','NULL','4e6a49324d44417a','4d7a4e4253555a5151546b354e5452524d317050','4f5441344d4445794d7a67324f513d3d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b53323976636d4670613356755a4855674c5341324d6a59774d444d6b4a43525761584a315a476831626d466e5958496b4a435255595731706243424f595752314a43516b49453176596d6c735a5341364f5441344d4445794d7a67324f53516b4a43424855315167546d38674f6a4d7a51556c47554545354f54553055544e6154773d3d','logo_18_09_2025_10_45_32.png','watermark_18_09_2025_10_45_38.png','1','0');


CREATE TABLE `vijay_garage_department` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `department_id` mediumtext NOT NULL,
  `department_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_department (id, created_date_time, creator, creator_name, bill_company_id, department_id, department_name, lower_case_name, deleted) VALUES ('1','2025-09-17 15:08:14','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5463774f5449774d6a55774d7a41344d5452664d44453d','5247567759584a306257567564434243','5a47567759584a306257567564434269','1');

INSERT INTO vijay_garage_department (id, created_date_time, creator, creator_name, bill_company_id, department_id, department_name, lower_case_name, deleted) VALUES ('2','2025-09-17 15:08:14','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5463774f5449774d6a55774d7a41344d5456664d44493d','5247567759584a306257567564434242','5a47567759584a306257567564434268','0');

INSERT INTO vijay_garage_department (id, created_date_time, creator, creator_name, bill_company_id, department_id, department_name, lower_case_name, deleted) VALUES ('3','2025-09-18 13:28:17','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d5449344d5464664d444d3d','5247567764434244','5a4756776443426a','0');

INSERT INTO vijay_garage_department (id, created_date_time, creator, creator_name, bill_company_id, department_id, department_name, lower_case_name, deleted) VALUES ('4','2025-09-18 13:28:17','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d5449344d5464664d44513d','5247567764434243','5a47567764434269','0');


CREATE TABLE `vijay_garage_engineer` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `engineer_id` mediumtext NOT NULL,
  `engineer_name` mediumtext NOT NULL,
  `engineer_code` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `salary` mediumtext NOT NULL,
  `engineer_name_code` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `advance_amount` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_engineer (id, created_date_time, creator, creator_name, bill_company_id, engineer_id, engineer_name, engineer_code, mobile_number, salary, engineer_name_code, lower_case_name, advance_amount, deleted) VALUES ('1','2025-09-18 12:54:35','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55784d6a55304d7a56664d44453d','5533566959513d3d','525535484d444179','4f5463774e6a6b774e7a6b774e773d3d','10000','NULL','4e54557a4d7a55324e6a6b314f5455784d32517a5a413d3d','','0');

INSERT INTO vijay_garage_engineer (id, created_date_time, creator, creator_name, bill_company_id, engineer_id, engineer_name, engineer_code, mobile_number, salary, engineer_name_code, lower_case_name, advance_amount, deleted) VALUES ('2','2025-09-18 12:54:35','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55784d6a55304d7a56664d44493d','5758563259513d3d','525535484d444178','4e6a6b324e6a63344f5459334f513d3d','15000','NULL','4e5463314f4455324d7a49314f5455784d32517a5a413d3d','','0');

INSERT INTO vijay_garage_engineer (id, created_date_time, creator, creator_name, bill_company_id, engineer_id, engineer_name, engineer_code, mobile_number, salary, engineer_name_code, lower_case_name, advance_amount, deleted) VALUES ('3','2025-09-18 13:07:57','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d5441334e5464664d444d3d','61586c3062326c76','4d773d3d','4e6a41774f5463774e7a67354d413d3d','10000','NULL','4e6a45314f445a6a4d7a41324d6a4d794e6d4d334e673d3d','','1');

INSERT INTO vijay_garage_engineer (id, created_date_time, creator, creator_name, bill_company_id, engineer_id, engineer_name, engineer_code, mobile_number, salary, engineer_name_code, lower_case_name, advance_amount, deleted) VALUES ('4','2025-09-19 12:44:54','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d546b774f5449774d6a55784d6a51304e5452664d44513d','5332463261586c68','525535484d44417a','4f5463774f5467774e7a6b774f413d3d','12000','NULL','4e544d7a4d6a51324d7a49324d5455344e6d4d324f413d3d','300','0');

INSERT INTO vijay_garage_engineer (id, created_date_time, creator, creator_name, bill_company_id, engineer_id, engineer_name, engineer_code, mobile_number, salary, engineer_name_code, lower_case_name, advance_amount, deleted) VALUES ('5','2025-09-19 12:44:54','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d546b774f5449774d6a55784d6a51304e5452664d44553d','5457396f59573568','525535484d444130','4f5463354e6a6b774e7a6b774e773d3d','20000','NULL','4e5451314e7a4d354e6d59314f5455334d7a55324f413d3d','500','0');


CREATE TABLE `vijay_garage_estimate` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `estimate_id` mediumtext NOT NULL,
  `estimate_date` date NOT NULL,
  `estimate_number` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name_mobile_city` mediumtext NOT NULL,
  `party_details` mediumtext NOT NULL,
  `party_state` mediumtext NOT NULL,
  `vehicle_id` mediumtext NOT NULL,
  `vehicle_number` mediumtext NOT NULL,
  `vehicle_details` mediumtext NOT NULL,
  `gst_option` mediumtext NOT NULL,
  `tax_type` mediumtext NOT NULL,
  `tax_option` mediumtext NOT NULL,
  `job_card_id` mediumtext NOT NULL,
  `job_card_number` mediumtext NOT NULL,
  `store_entry_id` mediumtext NOT NULL,
  `store_entry_number` mediumtext NOT NULL,
  `store_id` mediumtext NOT NULL,
  `store_name` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `hsn_code` mediumtext NOT NULL,
  `product_amount` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_qty` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `final_rate` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `sub_total` mediumtext NOT NULL,
  `discount_name` mediumtext NOT NULL,
  `discount` mediumtext NOT NULL,
  `discount_value` mediumtext NOT NULL,
  `discounted_total` mediumtext NOT NULL,
  `charges_name` mediumtext NOT NULL,
  `charges` mediumtext NOT NULL,
  `charges_value` mediumtext NOT NULL,
  `charges_total` mediumtext NOT NULL,
  `cgst_value` mediumtext NOT NULL,
  `sgst_value` mediumtext NOT NULL,
  `igst_value` mediumtext NOT NULL,
  `total_tax_value` mediumtext NOT NULL,
  `overall_tax` mediumtext NOT NULL,
  `product_tax` mediumtext NOT NULL,
  `charges_tax` mediumtext NOT NULL,
  `round_off` mediumtext NOT NULL,
  `round_off_type` mediumtext NOT NULL,
  `round_off_value` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_estimate (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, estimate_id, estimate_date, estimate_number, party_id, party_name_mobile_city, party_details, party_state, vehicle_id, vehicle_number, vehicle_details, gst_option, tax_type, tax_option, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, final_rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, cgst_value, sgst_value, igst_value, total_tax_value, overall_tax, product_tax, charges_tax, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('1','2025-09-23 12:32:58','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55784d6a4d794e5468664d44453d','2025-09-23','001/25-26','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','Tamil Nadu','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','1','1','1','4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d','JC001/25-26,JC001/25-26,JC001/25-26','4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d','SE001/25-26,SE001/25-26,SE001/25-26','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534244,556d397662534244,556d397662534244','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774d7a55324e444e664d44513d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434242','4f4451344f513d3d,4f4451354f513d3d,4e7a6b774f54593d','1320,8000,1000','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','','132,800,100','132,800,100','1320,8000,1000','10320','','','NULL','10320','NULL','NULL','NULL','10320','898.80','898.80','0','1797.60','','18%,18%,12%','','2','','','12117.6','1');

INSERT INTO vijay_garage_estimate (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, estimate_id, estimate_date, estimate_number, party_id, party_name_mobile_city, party_details, party_state, vehicle_id, vehicle_number, vehicle_details, gst_option, tax_type, tax_option, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, final_rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, cgst_value, sgst_value, igst_value, total_tax_value, overall_tax, product_tax, charges_tax, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('2','2025-09-23 15:32:29','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55774d7a4d794d7a42664d44493d','2025-09-23','002/25-26','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','Tamil Nadu','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','','','','4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d','JC001/25-26,JC001/25-26,JC001/25-26','4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d','SE001/25-26,SE001/25-26,SE001/25-26','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534244,556d397662534244,556d397662534244','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774d7a55324e444e664d44513d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434242','4f4451344f513d3d,4f4451354f513d3d,4e7a6b774f54593d','1320,8000,1000','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','','132,800,100','132,800,100','1320,8000,1000','10320','6333426c59326c686243426b61584e6a','15%','1548.00','8772','Extra','5%','438.60','9210.6','0','0','0','0','NULL','18%,12%,5%','','1','1','40','9211','1');

INSERT INTO vijay_garage_estimate (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, estimate_id, estimate_date, estimate_number, party_id, party_name_mobile_city, party_details, party_state, vehicle_id, vehicle_number, vehicle_details, gst_option, tax_type, tax_option, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, final_rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, cgst_value, sgst_value, igst_value, total_tax_value, overall_tax, product_tax, charges_tax, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('3','2025-09-24 09:40:49','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a51774f5449774d6a55774f5451774e446c664d444d3d','2025-09-24','ES003/25-26','4d546b774f5449774d6a55774e5451304e4452664d444d3d','5457396f595734674b446b344f5467324e7a6b324e445170','5457396f59573438596e492b59584e6d5a57526a63325538596e492b5647467461577767546d466b64547869636a354e62324a70624755674f6941354f446b344e6a63354e6a5130','Tamil Nadu','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','','','','4d6a4d774f5449774d6a55774e4449324d444a664d44493d,4d6a4d774f5449774d6a55774e4449324d444a664d44493d,4d6a4d774f5449774d6a55774e4449324d444a664d44493d','JC002/25-26,JC002/25-26,JC002/25-26','4d6a4d774f5449774d6a55774e4449324e5442664d44493d,4d6a4d774f5449774d6a55774e4449324e5442664d44493d,4d6a4d774f5449774d6a55774e4449324e5442664d44493d','SE002/25-26,SE002/25-26,SE002/25-26','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534244,556d397662534244,556d397662534242','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774e5455314d7a56664d44593d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434244','4f4451344f513d3d,4f4451354f513d3d,4f4451344f513d3d','1320,8000,1320','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','','132,800,132','132,800,132','1320,8000,1320','10640','','','NULL','10640','NULL','NULL','NULL','10640','0','0','0','0','NULL','18%,12%,18%','','2','','','10640','0');


CREATE TABLE `vijay_garage_invoice` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `invoice_id` mediumtext NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_number` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name_mobile_city` mediumtext NOT NULL,
  `party_details` mediumtext NOT NULL,
  `party_state` mediumtext NOT NULL,
  `vehicle_id` mediumtext NOT NULL,
  `vehicle_number` mediumtext NOT NULL,
  `vehicle_details` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `bank_account_number` mediumtext NOT NULL,
  `gst_option` mediumtext NOT NULL,
  `tax_type` mediumtext NOT NULL,
  `tax_option` mediumtext NOT NULL,
  `job_card_id` mediumtext NOT NULL,
  `job_card_number` mediumtext NOT NULL,
  `store_entry_id` mediumtext NOT NULL,
  `store_entry_number` mediumtext NOT NULL,
  `store_id` mediumtext NOT NULL,
  `store_name` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `hsn_code` mediumtext NOT NULL,
  `product_amount` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_qty` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `final_rate` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `sub_total` mediumtext NOT NULL,
  `discount_name` mediumtext NOT NULL,
  `discount` mediumtext NOT NULL,
  `discount_value` mediumtext NOT NULL,
  `discounted_total` mediumtext NOT NULL,
  `charges_name` mediumtext NOT NULL,
  `charges` mediumtext NOT NULL,
  `charges_value` mediumtext NOT NULL,
  `charges_total` mediumtext NOT NULL,
  `cgst_value` mediumtext NOT NULL,
  `sgst_value` mediumtext NOT NULL,
  `igst_value` mediumtext NOT NULL,
  `total_tax_value` mediumtext NOT NULL,
  `overall_tax` mediumtext NOT NULL,
  `product_tax` mediumtext NOT NULL,
  `charges_tax` mediumtext NOT NULL,
  `round_off` mediumtext NOT NULL,
  `round_off_type` mediumtext NOT NULL,
  `round_off_value` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_invoice (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, invoice_id, invoice_date, invoice_number, party_id, party_name_mobile_city, party_details, party_state, vehicle_id, vehicle_number, vehicle_details, bank_id, bank_name, bank_account_number, gst_option, tax_type, tax_option, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, final_rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, cgst_value, sgst_value, igst_value, total_tax_value, overall_tax, product_tax, charges_tax, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('1','2025-09-23 15:32:13','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55774d7a4d794d544e664d44453d','2025-09-23','001/25-26','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','Tamil Nadu','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','4d6a49774f5449774d6a55774d7a4d314d5468664d44513d','5657357062323467596d4675617942765a694270626d527059513d3d','4f446b314d7a51354e5451354e5467304e544d304e54493d','1','1','2','4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d','JC001/25-26,JC001/25-26,JC001/25-26','4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d','SE001/25-26,SE001/25-26,SE001/25-26','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534244,556d397662534244,556d397662534244','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774d7a55324e444e664d44513d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434242','4f4451344f513d3d,4f4451354f513d3d,4e7a6b774f54593d','1118.6,7142.8,952.3','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','','132,800,100','111.86,714.28,95.23','1118.6,7142.8,952.3','9213.7','','','NULL','9213.7','NULL','NULL','NULL','9213.7','553.06','553.06','0','1106.11','','18%,12%,5%','','2','1','89','10320.7','0');

INSERT INTO vijay_garage_invoice (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, invoice_id, invoice_date, invoice_number, party_id, party_name_mobile_city, party_details, party_state, vehicle_id, vehicle_number, vehicle_details, bank_id, bank_name, bank_account_number, gst_option, tax_type, tax_option, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, final_rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, cgst_value, sgst_value, igst_value, total_tax_value, overall_tax, product_tax, charges_tax, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('2','2025-09-23 17:58:15','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55774e5455344d5456664d44493d','2025-09-23','002/25-26','4d546b774f5449774d6a55774e5451304e4452664d444d3d','5457396f595734674b446b344f5467324e7a6b324e445170','5457396f59573438596e492b59584e6d5a57526a63325538596e492b5647467461577767546d466b64547869636a354e62324a70624755674f6941354f446b344e6a63354e6a5130','Tamil Nadu','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','4d5467774f5449774d6a55774d5449334d6a4e664d44493d','55304a4a','4e6a41334f5441334f5441354d413d3d','','','','4d6a4d774f5449774d6a55774e4449324d444a664d44493d,4d6a4d774f5449774d6a55774e4449324d444a664d44493d,4d6a4d774f5449774d6a55774e4449324d444a664d44493d','JC002/25-26,JC002/25-26,JC002/25-26','4d6a4d774f5449774d6a55774e4449324e5442664d44493d,4d6a4d774f5449774d6a55774e4449324e5442664d44493d,4d6a4d774f5449774d6a55774e4449324e5442664d44493d','SE002/25-26,SE002/25-26,SE002/25-26','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534244,556d397662534244,556d397662534242','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774e5455314d7a56664d44593d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434244','4f4451344f513d3d,4f4451354f513d3d,4f4451344f513d3d','1320,8000,1320','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','','132,800,132','132,800,132','1320,8000,1320','10640','','','NULL','10640','NULL','NULL','NULL','10640','0','0','0','0','NULL','18%,12%,18%','','2','','','10640','1');

INSERT INTO vijay_garage_invoice (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, invoice_id, invoice_date, invoice_number, party_id, party_name_mobile_city, party_details, party_state, vehicle_id, vehicle_number, vehicle_details, bank_id, bank_name, bank_account_number, gst_option, tax_type, tax_option, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, final_rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, cgst_value, sgst_value, igst_value, total_tax_value, overall_tax, product_tax, charges_tax, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('3','2025-09-24 10:13:20','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a51774f5449774d6a55784d44457a4d6a42664d444d3d','2025-09-24','IN003/25-26','4d546b774f5449774d6a55774e5451304e4452664d444d3d','5457396f595734674b446b344f5467324e7a6b324e445170','5457396f59573438596e492b59584e6d5a57526a63325538596e492b5647467461577767546d466b64547869636a354e62324a70624755674f6941354f446b344e6a63354e6a5130','Tamil Nadu','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','4d6a49774f5449774d6a55774d7a4d314d5468664d44513d','5657357062323467596d4675617942765a694270626d527059513d3d','4f446b314d7a51354e5451354e5467304e544d304e54493d','1','2','1','4d6a4d774f5449774d6a55774e4449324d444a664d44493d,4d6a4d774f5449774d6a55774e4449324d444a664d44493d,4d6a4d774f5449774d6a55774e4449324d444a664d44493d','JC002/25-26,JC002/25-26,JC002/25-26','4d6a4d774f5449774d6a55774e4449324e5442664d44493d,4d6a4d774f5449774d6a55774e4449324e5442664d44493d,4d6a4d774f5449774d6a55774e4449324e5442664d44493d','SE002/25-26,SE002/25-26,SE002/25-26','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534244,556d397662534244,556d397662534242','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774e5455314d7a56664d44593d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434244','4f4451344f513d3d,4f4451354f513d3d,4f4451344f513d3d','1320,8000,1320','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','','132,800,132','132,800,132','1320,8000,1320','10640','6333426c59326c686243426b61584e6a','5%','532.00','10108','extra','15%','1516.20','11624.2','697.45','697.45','0','1394.90','12%','18%,12%,18%','12%','2','','','13019.1','0');


CREATE TABLE `vijay_garage_job_card` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `job_card_id` mediumtext NOT NULL,
  `job_card_number` mediumtext NOT NULL,
  `job_card_date` date NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name_mobile_city` mediumtext NOT NULL,
  `party_details` mediumtext NOT NULL,
  `department_id` mediumtext NOT NULL,
  `department_name` mediumtext NOT NULL,
  `engineer_id` mediumtext NOT NULL,
  `vehicle_id` mediumtext NOT NULL,
  `vehicle_no` mediumtext NOT NULL,
  `vehicle_details` mediumtext NOT NULL,
  `work_details` mediumtext NOT NULL,
  `quotation_status` mediumtext NOT NULL DEFAULT '0',
  `quotation_id` mediumtext NOT NULL,
  `estimate_status` mediumtext NOT NULL DEFAULT '0',
  `estimate_id` mediumtext NOT NULL,
  `invoice_status` mediumtext NOT NULL DEFAULT '0',
  `invoice_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_job_card (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, job_card_id, job_card_number, job_card_date, party_id, party_name_mobile_city, party_details, department_id, department_name, engineer_id, vehicle_id, vehicle_no, vehicle_details, work_details, quotation_status, quotation_id, estimate_status, estimate_id, invoice_status, invoice_id, deleted) VALUES ('1','2025-09-23 12:04:58','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55784d6a41304e546c664d44453d','JC001/25-26','2025-09-23','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','4d5463774f5449774d6a55774d7a41344d5456664d44493d','5247567759584a306257567564434242','4d5467774f5449774d6a55784d6a55304d7a56664d44493d,4d546b774f5449774d6a55784d6a51304e5452664d44513d','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','63335a6b5a6e513d','Q','4d6a4d774f5449774d6a55774d7a4d7a4d6a5a664d44513d','0','NULL','I','4d6a4d774f5449774d6a55774d7a4d794d544e664d44453d','0');

INSERT INTO vijay_garage_job_card (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, job_card_id, job_card_number, job_card_date, party_id, party_name_mobile_city, party_details, department_id, department_name, engineer_id, vehicle_id, vehicle_no, vehicle_details, work_details, quotation_status, quotation_id, estimate_status, estimate_id, invoice_status, invoice_id, deleted) VALUES ('2','2025-09-23 16:26:01','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55774e4449324d444a664d44493d','JC002/25-26','2025-09-23','4d546b774f5449774d6a55774e5451304e4452664d444d3d','5457396f595734674b446b344f5467324e7a6b324e445170','5457396f59573438596e492b59584e6d5a57526a63325538596e492b5647467461577767546d466b64547869636a354e62324a70624755674f6941354f446b344e6a63354e6a5130','4d5467774f5449774d6a55774d5449344d5464664d444d3d','5247567764434244','4d5467774f5449774d6a55784d6a55304d7a56664d44493d,4d546b774f5449774d6a55784d6a51304e5452664d44513d','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','6132643564513d3d','Q','4d6a51774f5449774d6a55774f544d354d7a4a664d44553d','E','4d6a51774f5449774d6a55774f5451774e446c664d444d3d','I','4d6a51774f5449774d6a55784d44457a4d6a42664d444d3d','0');


CREATE TABLE `vijay_garage_login` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `loginer_name` mediumtext NOT NULL,
  `login_date_time` datetime NOT NULL,
  `logout_date_time` datetime DEFAULT NULL,
  `ip_address` mediumtext NOT NULL,
  `browser` mediumtext NOT NULL,
  `os_detail` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `type` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('1','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-19 17:54:43','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('2','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-20 09:21:39','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('3','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-20 11:07:53','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('4','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-22 09:30:27','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('5','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-22 09:36:34','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('6','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-22 09:36:44','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('7','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-22 14:57:37','2025-09-22 17:29:05','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('8','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-22 17:29:06','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('9','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-23 09:27:12','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('10','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-23 09:27:13','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('11','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-24 09:26:25','2025-09-24 11:21:58','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('12','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-24 11:21:59','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('13','553352685a6d59674b4455794d7a4d7a4d7a4d7a4d7a4d70','2025-09-24 12:46:18','2025-09-24 12:53:46','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a49794d544a664d44493d','Staff','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('14','553352685a6d59674b4455794d7a4d7a4d7a4d7a4d7a4d70','2025-09-24 12:53:57','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a49794d544a664d44493d','Staff','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('15','553352685a6d59674b4455794d7a4d7a4d7a4d7a4d7a4d70','2025-09-24 12:55:19','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a49794d544a664d44493d','Staff','0');


CREATE TABLE `vijay_garage_material_transfer` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `material_transfer_id` mediumtext NOT NULL,
  `material_transfer_number` mediumtext NOT NULL,
  `material_transfer_date` date NOT NULL,
  `from_location_id` mediumtext NOT NULL,
  `from_location_name` mediumtext NOT NULL,
  `to_location_id` mediumtext NOT NULL,
  `to_location_name` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_material_transfer (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, material_transfer_id, material_transfer_number, material_transfer_date, from_location_id, from_location_name, to_location_id, to_location_name, product_id, product_name, unit_id, unit_name, quantity, remarks, deleted) VALUES ('1','2025-09-23 17:37:31','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55774e544d334d7a46664d44453d','MT001/25-26','2025-09-23','4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534244','4d5463774f5449774d6a55774d7a49334d4452664d444d3d','556d397662534243','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d','55484a765a48566a64434244,55484a765a48566a64434243','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d','5132467a5a513d3d,63474e6c','10,10','636e4e6e596d593d','0');


CREATE TABLE `vijay_garage_party` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `party_type` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `pincode` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `party_details` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL,
  `vehicle_number` mediumtext NOT NULL,
  `vehicle_details` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_party (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, lower_case_name, address, city, district, state, pincode, mobile_number, others_city, party_details, opening_balance, opening_balance_type, name_mobile_city, identification, vehicle_number, vehicle_details, deleted) VALUES ('1','2025-09-18 10:21:01','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','1','4d5467774f5449774d6a55784d4449784d4446664d44453d','5533566959534251','6333566959534277','NULL','NULL','NULL','5647467461577767546d466b64513d3d','NULL','4f446b774f5441334f5459774f513d3d','','553356695953425150474a79506c526862576c73494535685a485538596e492b545739696157786c49446f674f446b774f5441334f5459774f513d3d','','','5533566959534251494367344f5441354d4463354e6a41354b513d3d','NULL','NULL','NULL','0');

INSERT INTO vijay_garage_party (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, lower_case_name, address, city, district, state, pincode, mobile_number, others_city, party_details, opening_balance, opening_balance_type, name_mobile_city, identification, vehicle_number, vehicle_details, deleted) VALUES ('2','2025-09-18 11:26:14','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','1','4d5467774f5449774d6a55784d5449324d5456664d44493d','5533566959513d3d','6333566959513d3d','NULL','NULL','NULL','5647467461577767546d466b64513d3d','NULL','4e7a41324f5463774e7a6b774f413d3d','','5533566959547869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494463774e6a6b334d4463354d44673d','','','553356695953416f4e7a41324f5463774e7a6b774f436b3d','NULL','','','0');

INSERT INTO vijay_garage_party (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, lower_case_name, address, city, district, state, pincode, mobile_number, others_city, party_details, opening_balance, opening_balance_type, name_mobile_city, identification, vehicle_number, vehicle_details, deleted) VALUES ('3','2025-09-19 17:44:44','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','2','4d546b774f5449774d6a55774e5451304e4452664d444d3d','5457396f5957343d','6257396f5957343d','59584e6d5a57526a6332553d','NULL','NULL','5647467461577767546d466b64513d3d','NULL','4f5467354f4459334f5459304e413d3d','','5457396f59573438596e492b59584e6d5a57526a63325538596e492b5647467461577767546d466b64547869636a354e62324a70624755674f6941354f446b344e6a63354e6a5130','','','5457396f595734674b446b344f5467324e7a6b324e445170','NULL','','','0');

INSERT INTO vijay_garage_party (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, lower_case_name, address, city, district, state, pincode, mobile_number, others_city, party_details, opening_balance, opening_balance_type, name_mobile_city, identification, vehicle_number, vehicle_details, deleted) VALUES ('4','2025-09-19 17:48:25','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','2','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a3162673d3d','59584a3162673d3d','6332466d5a484d3d','NULL','NULL','5647467461577767546d466b64513d3d','NULL','4e54497a4d7a4d7a4d7a4d7a4d773d3d','','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','40000','Credit','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','5155464249444d304d7a497a4e446b354e4467344e544d30','','','0');


CREATE TABLE `vijay_garage_payment` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_id` mediumtext NOT NULL,
  `bill_number` mediumtext NOT NULL,
  `bill_date` date NOT NULL,
  `bill_type` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `party_type` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `credit` mediumtext NOT NULL,
  `debit` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('1','2025-09-23 12:05:41','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a4d774f5449774d6a55784d6a41314e4446664d44453d','PE001/25-26','2025-09-23','Purchase Entry','4d5467774f5449774d6a55784d5449324d5456664d44493d','5533566959513d3d','1','NULL','NULL','NULL','NULL','0','NULL','5600','0','0');

INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('2','2025-09-23 15:45:36','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a4d774f5449774d6a55774d7a4d794d544e664d44453d','001/25-26','2025-09-23','Invoice','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a3162673d3d','Customer','NULL','NULL','4d6a49774f5449774d6a55774d7a4d314d5468664d44513d','NULL','5657357062323467596d4675617942765a694270626d527059513d3d','NULL','0','10320.7','0');

INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('3','2025-09-23 17:58:15','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a4d774f5449774d6a55774e5455344d5456664d44493d','002/25-26','2025-09-23','Invoice','4d546b774f5449774d6a55774e5451304e4452664d444d3d','5457396f5957343d','Customer','NULL','NULL','4d5467774f5449774d6a55774d5449334d6a4e664d44493d','NULL','55304a4a','NULL','0','10640','1');

INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('4','2025-09-24 10:12:39','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a51774f5449774d6a55784d4445794e4442664d44493d','PE002/25-26','2025-09-24','Purchase Entry','4d5467774f5449774d6a55784d4449784d4446664d44453d','5533566959534251','1','NULL','NULL','NULL','NULL','0','NULL','24999.56','0','0');

INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('5','2025-09-24 10:13:20','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a51774f5449774d6a55784d44457a4d6a42664d444d3d','IN003/25-26','2025-09-24','Invoice','4d546b774f5449774d6a55774e5451304e4452664d444d3d','5457396f5957343d','Customer','NULL','NULL','4d6a49774f5449774d6a55774d7a4d314d5468664d44513d','NULL','5657357062323467596d4675617942765a694270626d527059513d3d','NULL','0','13019.1','0');

INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('6','2025-09-24 11:22:28','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a51774f5449774d6a55784d5449794d6a68664d44453d','VOU001/25-26','2025-09-24','Voucher','4d5467774f5449774d6a55784d5449324d5456664d44493d','5533566959513d3d','2','4d6a49774f5449774d6a55774d7a4d314d7a68664d44593d','55476876626d565159586b3d','4d6a4d774f5449774d6a55774e6a45794e545a664d44553d','56453143','0','NULL','0','2500','0');

INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('7','2025-09-24 11:23:33','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a51774f5449774d6a55784d54497a4d7a4e664d44453d','REC001/25-26','2025-09-24','Receipt','4d546b774f5449774d6a55774e5451304e4452664d444d3d','5457396f5957343d','2','4d6a49774f5449774d6a55774d7a4d314d7a68664d44593d','55476876626d565159586b3d','4d6a4d774f5449774d6a55774e6a45794e545a664d44553d','56453143','0','NULL','4500','0','0');

INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('8','2025-09-24 11:54:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','4d6a51774f5449774d6a55784d5455304d444e664d44453d','SAV001/25-26','2025-09-24','Salary Voucher','4d546b774f5449774d6a55784d6a51304e5452664d44553d','5457396f59573568','4','','','','','','','0','666.67','0');

INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('9','2025-09-24 11:54:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','4d6a51774f5449774d6a55784d5455304d444e664d44493d','SAV002/25-26','2025-09-24','Salary Voucher','4d546b774f5449774d6a55784d6a51304e5452664d44513d','5332463261586c68','4','','','','','','','0','300','0');

INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('10','2025-09-24 11:54:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','4d6a51774f5449774d6a55784d5455304d444e664d444d3d','SAV002/25-26','2025-09-24','Salary Voucher','4d5467774f5449774d6a55784d6a55304d7a56664d44493d','5758563259513d3d','4','','','','','','','0','500','0');

INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('11','2025-09-24 11:54:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','4d6a51774f5449774d6a55784d5455304d444e664d44513d','SAV002/25-26','2025-09-24','Salary Voucher','4d5467774f5449774d6a55784d6a55304d7a56664d44453d','5533566959513d3d','4','','','','','','','0','333.33','0');


CREATE TABLE `vijay_garage_payment_mode` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_payment_mode (id, created_date_time, creator, creator_name, bill_company_id, payment_mode_id, payment_mode_name, lower_case_name, deleted) VALUES ('3','2025-09-18 13:26:32','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d5449324d7a4a664d444d3d','5132467a61413d3d','5932467a61413d3d','0');

INSERT INTO vijay_garage_payment_mode (id, created_date_time, creator, creator_name, bill_company_id, payment_mode_id, payment_mode_name, lower_case_name, deleted) VALUES ('4','2025-09-18 13:26:32','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d5449324d7a4a664d44513d','5132467a61413d3d','5132467a61413d3d','1');

INSERT INTO vijay_garage_payment_mode (id, created_date_time, creator, creator_name, bill_company_id, payment_mode_id, payment_mode_name, lower_case_name, deleted) VALUES ('5','2025-09-18 16:21:17','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a59774f4449774d6a55774d5445314d445a664d44453d','4d5467774f5449774d6a55774e4449784d5464664d44553d','5a33426865513d3d','5a33426865513d3d','1');

INSERT INTO vijay_garage_payment_mode (id, created_date_time, creator, creator_name, bill_company_id, payment_mode_id, payment_mode_name, lower_case_name, deleted) VALUES ('6','2025-09-22 15:35:38','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a49774f5449774d6a55774d7a4d314d7a68664d44593d','55476876626d565159586b3d','55476876626d565159586b3d','0');


CREATE TABLE `vijay_garage_product` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` mediumtext NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `hsn_code` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `product_rate` mediumtext NOT NULL,
  `product_tax` mediumtext NOT NULL,
  `stock_date` mediumtext NOT NULL,
  `store_room_id` mediumtext NOT NULL,
  `store_room_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, product_rate, product_tax, stock_date, store_room_id, store_room_name, quantity, deleted) VALUES ('3','2025-09-18 13:33:11','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d544d7a4d5446664d444d3d','55484a765a48566a64434242','63484a765a48566a64434268','4f5441354d446b3d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d','1000','5','2025-09-19,2025-09-19','4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534242,556d397662534244','15,10','1');

INSERT INTO vijay_garage_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, product_rate, product_tax, stock_date, store_room_id, store_room_name, quantity, deleted) VALUES ('4','2025-09-19 15:56:43','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d546b774f5449774d6a55774d7a55324e444e664d44513d','55484a765a48566a64434242','63484a765a48566a64434268','4e7a6b774f54593d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d','100','5','2025-09-19,2025-09-19,2025-09-19','4d5463774f5449774d6a55774d7a49334d4452664d444d3d,4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534243,556d397662534242,556d397662534244','10,10,10','0');

INSERT INTO vijay_garage_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, product_rate, product_tax, stock_date, store_room_id, store_room_name, quantity, deleted) VALUES ('5','2025-09-19 17:49:40','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d546b774f5449774d6a55774e5451354e4442664d44553d','55484a765a48566a64434243','63484a765a48566a64434269','4f4451354f513d3d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','63474e6c','800','12','2025-09-19,2025-09-19,2025-09-19','4d5463774f5449774d6a55774d7a49334d4452664d444d3d,4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534243,556d397662534242,556d397662534244','100,100,100','0');

INSERT INTO vijay_garage_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, product_rate, product_tax, stock_date, store_room_id, store_room_name, quantity, deleted) VALUES ('6','2025-09-19 17:55:35','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','55484a765a48566a64434244','63484a765a48566a6443426a','4f4451344f513d3d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d','132','18','2025-09-19,2025-09-19,2025-09-19','4d5463774f5449774d6a55774d7a49334d4452664d444d3d,4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534243,556d397662534242,556d397662534244','25,20,50','0');


CREATE TABLE `vijay_garage_purchase_entry` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `purchase_entry_id` mediumtext NOT NULL,
  `purchase_entry_date` date NOT NULL,
  `purchase_entry_number` mediumtext NOT NULL,
  `store_type` mediumtext NOT NULL,
  `store_id` mediumtext NOT NULL,
  `store_name` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name_mobile_city` mediumtext NOT NULL,
  `party_details` mediumtext NOT NULL,
  `party_state` mediumtext NOT NULL,
  `gst_option` mediumtext NOT NULL,
  `tax_type` mediumtext NOT NULL,
  `tax_option` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `product_amount` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_qty` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `final_rate` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `sub_total` mediumtext NOT NULL,
  `discount_name` mediumtext NOT NULL,
  `discount` mediumtext NOT NULL,
  `discount_value` mediumtext NOT NULL,
  `discounted_total` mediumtext NOT NULL,
  `charges_name` mediumtext NOT NULL,
  `charges` mediumtext NOT NULL,
  `charges_value` mediumtext NOT NULL,
  `charges_total` mediumtext NOT NULL,
  `cgst_value` mediumtext NOT NULL,
  `sgst_value` mediumtext NOT NULL,
  `igst_value` mediumtext NOT NULL,
  `total_tax_value` mediumtext NOT NULL,
  `overall_tax` mediumtext NOT NULL,
  `product_tax` mediumtext NOT NULL,
  `charges_tax` mediumtext NOT NULL,
  `round_off` mediumtext NOT NULL,
  `round_off_type` mediumtext NOT NULL,
  `round_off_value` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_purchase_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, purchase_entry_id, purchase_entry_date, purchase_entry_number, store_type, store_id, store_name, party_id, party_name_mobile_city, party_details, party_state, gst_option, tax_type, tax_option, product_id, product_name, product_amount, unit_id, unit_name, quantity, total_qty, rate, final_rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, cgst_value, sgst_value, igst_value, total_tax_value, overall_tax, product_tax, charges_tax, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('1','2025-09-23 12:05:41','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55784d6a41314e4446664d44453d','2025-09-23','PE001/25-26','1','4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534242','4d5467774f5449774d6a55784d5449324d5456664d44493d','553356695953416f4e7a41324f5463774e7a6b774f436b3d','5533566959547869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494463774e6a6b334d4463354d44673d','Tamil Nadu','1','1','1','4d546b774f5449774d6a55774e5451354e4442664d44553d','55484a765a48566a64434243','5000','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','63474e6c','50','50','100','100','5000','5000','','','NULL','5000','NULL','NULL','NULL','5000','300.00','300.00','0','600.00','','12%','','2','','','5600','0');

INSERT INTO vijay_garage_purchase_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, purchase_entry_id, purchase_entry_date, purchase_entry_number, store_type, store_id, store_name, party_id, party_name_mobile_city, party_details, party_state, gst_option, tax_type, tax_option, product_id, product_name, product_amount, unit_id, unit_name, quantity, total_qty, rate, final_rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, cgst_value, sgst_value, igst_value, total_tax_value, overall_tax, product_tax, charges_tax, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('2','2025-09-24 10:12:39','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a51774f5449774d6a55784d4445794e4442664d44493d','2025-09-24','PE002/25-26','1','4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534242,556d397662534242,556d397662534242','4d5467774f5449774d6a55784d4449784d4446664d44453d','5533566959534251494367344f5441354d4463354e6a41354b513d3d','553356695953425150474a79506c526862576c73494535685a485538596e492b545739696157786c49446f674f446b774f5441334f5459774f513d3d','Tamil Nadu','1','2','2','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774d7a55324e444e664d44513d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434242','4761.5,9523.8,9523.8','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','50,10,10','50,10,10','100,1000,1000','95.23,952.38,952.38','4761.5,9523.8,9523.8','23809.1','','','NULL','23809.1','NULL','NULL','NULL','23809.1','595.23','595.23','0','1190.46','5%','18%,12%,5%','','2','','','24999.56','0');


CREATE TABLE `vijay_garage_quotation` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `quotation_id` mediumtext NOT NULL,
  `quotation_date` date NOT NULL,
  `quotation_number` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name_mobile_city` mediumtext NOT NULL,
  `party_details` mediumtext NOT NULL,
  `vehicle_id` mediumtext NOT NULL,
  `vehicle_number` mediumtext NOT NULL,
  `vehicle_details` mediumtext NOT NULL,
  `job_card_id` mediumtext NOT NULL,
  `job_card_number` mediumtext NOT NULL,
  `store_entry_id` mediumtext NOT NULL,
  `store_entry_number` mediumtext NOT NULL,
  `store_id` mediumtext NOT NULL,
  `store_name` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `hsn_code` mediumtext NOT NULL,
  `product_amount` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_qty` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `sub_total` mediumtext NOT NULL,
  `discount_name` mediumtext NOT NULL,
  `discount` mediumtext NOT NULL,
  `discount_value` mediumtext NOT NULL,
  `discounted_total` mediumtext NOT NULL,
  `charges_name` mediumtext NOT NULL,
  `charges` mediumtext NOT NULL,
  `charges_value` mediumtext NOT NULL,
  `charges_total` mediumtext NOT NULL,
  `round_off` mediumtext NOT NULL,
  `round_off_type` mediumtext NOT NULL,
  `round_off_value` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_quotation (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, quotation_id, quotation_date, quotation_number, party_id, party_name_mobile_city, party_details, vehicle_id, vehicle_number, vehicle_details, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('1','2025-09-23 12:09:50','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55784d6a41354e5442664d44453d','2025-09-23','QT001/25-26','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d','JC001/25-26,JC001/25-26,JC001/25-26','4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d','SE001/25-26,SE001/25-26,SE001/25-26','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534244,556d397662534244,556d397662534244','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774d7a55324e444e664d44513d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434242','4f4451344f513d3d,4f4451354f513d3d,4e7a6b774f54593d','','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','','132,800,100','1320,8000,1000','10320','','','NULL','10320','NULL','NULL','NULL','10320','2','','','10320','1');

INSERT INTO vijay_garage_quotation (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, quotation_id, quotation_date, quotation_number, party_id, party_name_mobile_city, party_details, vehicle_id, vehicle_number, vehicle_details, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('2','2025-09-23 12:10:12','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55784d6a45774d544a664d44493d','2025-09-23','QT002/25-26','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d','JC001/25-26,JC001/25-26,JC001/25-26','4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d','SE001/25-26,SE001/25-26,SE001/25-26','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534244,556d397662534244,556d397662534244','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774d7a55324e444e664d44513d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434242','4f4451344f513d3d,4f4451354f513d3d,4e7a6b774f54593d','','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','','132,800,100','1320,8000,1000','10320','','','NULL','10320','NULL','NULL','NULL','10320','2','1','0.77','10320.77','1');

INSERT INTO vijay_garage_quotation (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, quotation_id, quotation_date, quotation_number, party_id, party_name_mobile_city, party_details, vehicle_id, vehicle_number, vehicle_details, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('3','2025-09-23 12:15:26','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55784d6a45314d6a5a664d444d3d','2025-09-23','QT003/25-26','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d','JC001/25-26,JC001/25-26,JC001/25-26','4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d','SE001/25-26,SE001/25-26,SE001/25-26','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534244,556d397662534244,556d397662534244','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774d7a55324e444e664d44513d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434242','4f4451344f513d3d,4f4451354f513d3d,4e7a6b774f54593d','','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','','112,300,101','1120,3000,1010','5130','','','NULL','5130','NULL','NULL','NULL','5130','2','1','99','5130.99','1');

INSERT INTO vijay_garage_quotation (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, quotation_id, quotation_date, quotation_number, party_id, party_name_mobile_city, party_details, vehicle_id, vehicle_number, vehicle_details, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('4','2025-09-23 15:33:26','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55774d7a4d7a4d6a5a664d44513d','2025-09-23','QT004/25-26','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d,4d6a4d774f5449774d6a55784d6a41304e546c664d44453d','JC001/25-26,JC001/25-26,JC001/25-26','4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d,4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d','SE001/25-26,SE001/25-26,SE001/25-26','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534244,556d397662534244,556d397662534244','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774d7a55324e444e664d44513d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434242','4f4451344f513d3d,4f4451354f513d3d,4e7a6b774f54593d','','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','','132,800,100','1320,8000,1000','10320','6333426c59326c686243426b61584e6a','5%','516.00','9804','Extra','5%','490.20','10294.2','2','','','10294.2','0');

INSERT INTO vijay_garage_quotation (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, quotation_id, quotation_date, quotation_number, party_id, party_name_mobile_city, party_details, vehicle_id, vehicle_number, vehicle_details, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('5','2025-09-24 09:39:32','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a51774f5449774d6a55774f544d354d7a4a664d44553d','2025-09-24','QT005/25-26','4d546b774f5449774d6a55774e5451304e4452664d444d3d','5457396f595734674b446b344f5467324e7a6b324e445170','5457396f59573438596e492b59584e6d5a57526a63325538596e492b5647467461577767546d466b64547869636a354e62324a70624755674f6941354f446b344e6a63354e6a5130','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','4d6a4d774f5449774d6a55774e4449324d444a664d44493d,4d6a4d774f5449774d6a55774e4449324d444a664d44493d,4d6a4d774f5449774d6a55774e4449324d444a664d44493d','JC002/25-26,JC002/25-26,JC002/25-26','4d6a4d774f5449774d6a55774e4449324e5442664d44493d,4d6a4d774f5449774d6a55774e4449324e5442664d44493d,4d6a4d774f5449774d6a55774e4449324e5442664d44493d','SE002/25-26,SE002/25-26,SE002/25-26','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534244,556d397662534244,556d397662534242','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774e5455314d7a56664d44593d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434244','4f4451344f513d3d,4f4451354f513d3d,4f4451344f513d3d','','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','','132,800,132','1320,8000,1320','10640','','','NULL','10640','NULL','NULL','NULL','10640','2','','','10640','0');


CREATE TABLE `vijay_garage_receipt` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `receipt_id` mediumtext NOT NULL,
  `receipt_number` mediumtext NOT NULL,
  `receipt_date` date NOT NULL,
  `investment_type` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `party_type` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `sales_bill_id` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_receipt (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, receipt_id, receipt_number, receipt_date, investment_type, party_id, name_mobile_city, party_type, party_name, amount, narration, payment_mode_id, payment_mode_name, bank_id, bank_name, total_amount, sales_bill_id, deleted) VALUES ('1','2025-09-24 11:23:33','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d6a51774f5449774d6a55784d54497a4d7a4e664d44453d','REC001/25-26','2025-09-24','','4d546b774f5449774d6a55774e5451304e4452664d444d3d','5457396f595734674b446b344f5467324e7a6b324e445170','2','5457396f5957343d','4500','5a475a32','4d6a49774f5449774d6a55774d7a4d314d7a68664d44593d','55476876626d565159586b3d','4d6a4d774f5449774d6a55774e6a45794e545a664d44553d','56453143','4500','','0');


CREATE TABLE `vijay_garage_role` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `role_id` mediumtext NOT NULL,
  `role_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `access_pages` mediumtext NOT NULL,
  `access_page_actions` mediumtext NOT NULL,
  `incharger` int(11) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_role (id, created_date_time, creator, creator_name, role_id, role_name, lower_case_name, access_pages, access_page_actions, incharger, deleted) VALUES ('1','2025-08-29 15:22:02','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49794d444a664d44453d','545746755957646c63673d3d','625746755957646c63673d3d','55474635625756756443424e6232526c,516d467561773d3d,5257356e6157356c5a58493d,5247567759584a306257567564413d3d,55335276636d5567556d397662513d3d,5657357064413d3d,55484a765a48566a64413d3d,5547467964486b3d,566d566f61574e735a513d3d,55485679593268686332556752573530636e6b3d,536d396949454e68636d513d,55335276636d556752573530636e6b3d,545746305a584a705957776756484a68626e4e6d5a58493d,55335276593273675157527164584e306257567564413d3d,515852305a57356b5957356a5a513d3d,6332467359584a35,515752325957356a5a5342576233566a61475679,555856766447463061573975,52584e30615731686447553d,5357353262326c6a5a513d3d,566d39315932686c63673d3d,556d566a5a576c7764413d3d,556d567762334a3063773d3d','566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d','0','0');

INSERT INTO vijay_garage_role (id, created_date_time, creator, creator_name, role_id, role_name, lower_case_name, access_pages, access_page_actions, incharger, deleted) VALUES ('2','2025-09-17 11:03:18','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d5463774f5449774d6a55784d54417a4d5468664d44493d','5a6d526e','5a6d526e','55474635625756756443424e6232526c','566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c','0','0');


CREATE TABLE `vijay_garage_salary` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `salary_id` mediumtext NOT NULL,
  `salary_number` mediumtext NOT NULL,
  `salary_date` date NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `engineer_id` mediumtext NOT NULL,
  `engineer_name` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `no_of_days` mediumtext NOT NULL,
  `salary_per_day` mediumtext NOT NULL,
  `ot_salary_amount` mediumtext NOT NULL,
  `salary_amount` mediumtext NOT NULL,
  `advance_amount` mediumtext NOT NULL,
  `deduction_amount` mediumtext NOT NULL,
  `cash_to_paid` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_salary (id, created_date_time, creator, creator_name, bill_company_id, salary_id, salary_number, salary_date, from_date, to_date, engineer_id, engineer_name, remarks, no_of_days, salary_per_day, ot_salary_amount, salary_amount, advance_amount, deduction_amount, cash_to_paid, total_amount, deleted) VALUES ('1','2025-09-24 11:54:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','4d6a51774f5449774d6a55784d5455304d444e664d44453d','SAL001/25-26','2025-09-24','2025-08-25','2025-09-24','4d5467774f5449774d6a55784d6a55304d7a56664d44453d,4d5467774f5449774d6a55784d6a55304d7a56664d44493d,4d546b774f5449774d6a55784d6a51304e5452664d44513d,4d546b774f5449774d6a55784d6a51304e5452664d44553d','5533566959513d3d,5758563259513d3d,5332463261586c68,5457396f59573568',',,,','1,1,1,1','333.33,500,400,666.67','0,0,0,0','333.33,500,400,666.67','0,0,100,0','0,0,100,0','333.33,500,300,666.67','1800','0');


CREATE TABLE `vijay_garage_salary_voucher` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `voucher_id` mediumtext NOT NULL,
  `voucher_number` mediumtext NOT NULL,
  `salary_id` mediumtext NOT NULL,
  `salary_number` mediumtext NOT NULL,
  `salary_date` date NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `engineer_id` mediumtext NOT NULL,
  `engineer_name` mediumtext NOT NULL,
  `no_of_days` mediumtext NOT NULL,
  `salary_amount` mediumtext NOT NULL,
  `advance_amount` mediumtext NOT NULL,
  `deduction_amount` mediumtext NOT NULL,
  `salary_received` mediumtext NOT NULL,
  `ot_salary_amount` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_salary_voucher (id, created_date_time, creator, creator_name, bill_company_id, voucher_id, voucher_number, salary_id, salary_number, salary_date, from_date, to_date, engineer_id, engineer_name, no_of_days, salary_amount, advance_amount, deduction_amount, salary_received, ot_salary_amount, deleted) VALUES ('1','2025-09-24 11:54:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','4d6a51774f5449774d6a55784d5455304d444e664d44453d','SAV001/25-26','4d6a51774f5449774d6a55784d5455304d444e664d44453d','SAL001/25-26','2025-09-24','2025-08-25','2025-09-24','4d546b774f5449774d6a55784d6a51304e5452664d44553d','5457396f59573568','1','666.67','0','0','666.67','0','0');

INSERT INTO vijay_garage_salary_voucher (id, created_date_time, creator, creator_name, bill_company_id, voucher_id, voucher_number, salary_id, salary_number, salary_date, from_date, to_date, engineer_id, engineer_name, no_of_days, salary_amount, advance_amount, deduction_amount, salary_received, ot_salary_amount, deleted) VALUES ('2','2025-09-24 11:54:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','4d6a51774f5449774d6a55784d5455304d444e664d44493d','SAV002/25-26','4d6a51774f5449774d6a55784d5455304d444e664d44453d','SAL001/25-26','2025-09-24','2025-08-25','2025-09-24','4d546b774f5449774d6a55784d6a51304e5452664d44513d','5332463261586c68','1','400','100','100','300','0','0');

INSERT INTO vijay_garage_salary_voucher (id, created_date_time, creator, creator_name, bill_company_id, voucher_id, voucher_number, salary_id, salary_number, salary_date, from_date, to_date, engineer_id, engineer_name, no_of_days, salary_amount, advance_amount, deduction_amount, salary_received, ot_salary_amount, deleted) VALUES ('3','2025-09-24 11:54:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','4d6a51774f5449774d6a55784d5455304d444e664d444d3d','SAV002/25-26','4d6a51774f5449774d6a55784d5455304d444e664d44453d','SAL001/25-26','2025-09-24','2025-08-25','2025-09-24','4d5467774f5449774d6a55784d6a55304d7a56664d44493d','5758563259513d3d','1','500','0','0','500','0','0');

INSERT INTO vijay_garage_salary_voucher (id, created_date_time, creator, creator_name, bill_company_id, voucher_id, voucher_number, salary_id, salary_number, salary_date, from_date, to_date, engineer_id, engineer_name, no_of_days, salary_amount, advance_amount, deduction_amount, salary_received, ot_salary_amount, deleted) VALUES ('4','2025-09-24 11:54:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d4455774f4449774d6a55784d6a4d774d7a5a664d44453d','4d6a51774f5449774d6a55784d5455304d444e664d44513d','SAV002/25-26','4d6a51774f5449774d6a55784d5455304d444e664d44453d','SAL001/25-26','2025-09-24','2025-08-25','2025-09-24','4d5467774f5449774d6a55784d6a55304d7a56664d44453d','5533566959513d3d','1','333.33','0','0','333.33','0','0');


CREATE TABLE `vijay_garage_stock` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` mediumtext NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `stock_date` date NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `store_id` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `inward_unit` mediumtext NOT NULL,
  `outward_unit` mediumtext NOT NULL,
  `stock_type` mediumtext NOT NULL,
  `stock_action` mediumtext NOT NULL,
  `bill_unique_id` mediumtext NOT NULL,
  `bill_unique_number` mediumtext DEFAULT NULL,
  `remarks` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('1','2025-09-23 12:04:22','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d444d3d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','25','0','Opening Stock','Plus','4d546b774f5449774d6a55774e5455314d7a56664d44593d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('2','2025-09-23 12:04:22','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','20','0','Opening Stock','Plus','4d546b774f5449774d6a55774e5455314d7a56664d44593d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('3','2025-09-23 12:04:22','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','50','0','Opening Stock','Plus','4d546b774f5449774d6a55774e5455314d7a56664d44593d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('4','2025-09-23 12:04:28','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d444d3d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','100','0','Opening Stock','Plus','4d546b774f5449774d6a55774e5451354e4442664d44553d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('5','2025-09-23 12:04:28','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','100','0','Opening Stock','Plus','4d546b774f5449774d6a55774e5451354e4442664d44553d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('6','2025-09-23 12:04:28','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','100','0','Opening Stock','Plus','4d546b774f5449774d6a55774e5451354e4442664d44553d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('7','2025-09-23 12:04:33','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d444d3d','4d546b774f5449774d6a55774d7a55324e444e664d44513d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','10','0','Opening Stock','Plus','4d546b774f5449774d6a55774d7a55324e444e664d44513d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('8','2025-09-23 12:04:33','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774d7a55324e444e664d44513d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','10','0','Opening Stock','Plus','4d546b774f5449774d6a55774d7a55324e444e664d44513d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('9','2025-09-23 12:04:33','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774d7a55324e444e664d44513d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','10','0','Opening Stock','Plus','4d546b774f5449774d6a55774d7a55324e444e664d44513d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('10','2025-09-23 12:05:41','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-23','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55784d5449324d5456664d44493d','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','50','0','Purchase Entry','Plus','4d6a4d774f5449774d6a55784d6a41314e4446664d44453d','PE001/25-26','PE001/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('11','2025-09-23 12:09:34','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-23','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','0','10','Store Entry','Minus','4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d','SE001/25-26','SE001/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('12','2025-09-23 12:09:34','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-23','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','0','10','Store Entry','Minus','4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d','SE001/25-26','SE001/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('13','2025-09-23 12:09:34','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-23','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774d7a55324e444e664d44513d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','0','10','Store Entry','Minus','4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d','SE001/25-26','SE001/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('14','2025-09-23 16:26:50','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-23','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','0','10','Store Entry','Minus','4d6a4d774f5449774d6a55774e4449324e5442664d44493d','SE002/25-26','SE002/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('15','2025-09-23 16:26:50','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-23','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','0','10','Store Entry','Minus','4d6a4d774f5449774d6a55774e4449324e5442664d44493d','SE002/25-26','SE002/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('16','2025-09-23 16:26:50','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-23','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','0','10','Store Entry','Minus','4d6a4d774f5449774d6a55774e4449324e5442664d44493d','SE002/25-26','SE002/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('17','2025-09-23 17:37:31','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-23','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','0','10','Material Transfer','Minus','4d6a4d774f5449774d6a55774e544d334d7a46664d44453d','MT001/25-26','MT001/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('18','2025-09-23 17:37:31','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-23','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5463774f5449774d6a55774d7a49334d4452664d444d3d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','10','0','Material Transfer','Plus','4d6a4d774f5449774d6a55774e544d334d7a46664d44453d','MT001/25-26','MT001/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('19','2025-09-23 17:37:31','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-23','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','0','10','Material Transfer','Minus','4d6a4d774f5449774d6a55774e544d334d7a46664d44453d','MT001/25-26','MT001/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('20','2025-09-23 17:37:31','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-23','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5463774f5449774d6a55774d7a49334d4452664d444d3d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','10','0','Material Transfer','Plus','4d6a4d774f5449774d6a55774e544d334d7a46664d44453d','MT001/25-26','MT001/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('21','2025-09-24 10:12:39','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-24','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55784d4449784d4446664d44453d','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','50','0','Purchase Entry','Plus','4d6a51774f5449774d6a55784d4445794e4442664d44493d','PE002/25-26','PE002/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('22','2025-09-24 10:12:39','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-24','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55784d4449784d4446664d44453d','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','10','0','Purchase Entry','Plus','4d6a51774f5449774d6a55784d4445794e4442664d44493d','PE002/25-26','PE002/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('23','2025-09-24 10:12:39','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-24','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55784d4449784d4446664d44453d','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774d7a55324e444e664d44513d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','10','0','Purchase Entry','Plus','4d6a51774f5449774d6a55784d4445794e4442664d44493d','PE002/25-26','PE002/25-26','0');


CREATE TABLE `vijay_garage_stock_adjustment` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `stock_adjustment_id` mediumtext NOT NULL,
  `stock_adjustment_number` mediumtext NOT NULL,
  `stock_adjustment_date` date NOT NULL,
  `store_id` mediumtext NOT NULL,
  `store_name` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `stock_action` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `vijay_garage_store_entry` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `store_entry_id` mediumtext NOT NULL,
  `store_entry_date` date NOT NULL,
  `store_entry_number` mediumtext NOT NULL,
  `job_card_id` mediumtext NOT NULL,
  `job_card_number` mediumtext NOT NULL,
  `store_type` mediumtext NOT NULL,
  `store_id` mediumtext NOT NULL,
  `store_name` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `hsn_code` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_store_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, store_entry_id, store_entry_date, store_entry_number, job_card_id, job_card_number, store_type, store_id, store_name, product_id, product_name, hsn_code, unit_id, unit_name, quantity, remarks, deleted) VALUES ('1','2025-09-23 12:09:34','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55784d6a41354d7a52664d44453d','2025-09-23','SE001/25-26','4d6a4d774f5449774d6a55784d6a41304e546c664d44453d','JC001/25-26','1','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534244,556d397662534244,556d397662534244','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774d7a55324e444e664d44513d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434242','4f4451344f513d3d,4f4451354f513d3d,4e7a6b774f54593d','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','5a32566d646d527a','0');

INSERT INTO vijay_garage_store_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, store_entry_id, store_entry_date, store_entry_number, job_card_id, job_card_number, store_type, store_id, store_name, product_id, product_name, hsn_code, unit_id, unit_name, quantity, remarks, deleted) VALUES ('2','2025-09-23 16:26:50','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a4d774f5449774d6a55774e4449324e5442664d44493d','2025-09-23','SE002/25-26','4d6a4d774f5449774d6a55774e4449324d444a664d44493d','JC002/25-26','2','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534244,556d397662534244,556d397662534242','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774e5455314d7a56664d44593d','55484a765a48566a64434244,55484a765a48566a64434243,55484a765a48566a64434244','4f4451344f513d3d,4f4451354f513d3d,4f4451344f513d3d','4d5467774f5449774d6a55774d544d784d6a42664d44513d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d,63474e6c,5132467a5a513d3d','10,10,10','64586c6961486b3d','0');


CREATE TABLE `vijay_garage_store_room` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `store_room_id` mediumtext NOT NULL,
  `store_room_name` mediumtext NOT NULL,
  `store_room_location` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_store_room (id, created_date_time, creator, creator_name, bill_company_id, store_room_id, store_room_name, store_room_location, lower_case_name, deleted) VALUES ('3','2025-09-17 15:27:04','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5463774f5449774d6a55774d7a49334d4452664d444d3d','556d397662534243','55326c325957746863326b3d','636d397662534269','0');

INSERT INTO vijay_garage_store_room (id, created_date_time, creator, creator_name, bill_company_id, store_room_id, store_room_name, store_room_location, lower_case_name, deleted) VALUES ('4','2025-09-17 15:27:04','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534242','55326c325957746863326b3d','636d397662534268','0');

INSERT INTO vijay_garage_store_room (id, created_date_time, creator, creator_name, bill_company_id, store_room_id, store_room_name, store_room_location, lower_case_name, deleted) VALUES ('5','2025-09-18 15:45:04','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a59774f4449774d6a55774d5445314d445a664d44453d','4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534244','5457466b64584a6861513d3d','636d39766253426a','0');


CREATE TABLE `vijay_garage_unit` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('3','2025-09-18 13:31:20','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','63474e6c','63474e6c','0');

INSERT INTO vijay_garage_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('4','2025-09-18 13:31:20','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d','5132467a5a513d3d','0');


CREATE TABLE `vijay_garage_user` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `role_id` mediumtext NOT NULL,
  `login_id` mediumtext NOT NULL,
  `lower_case_login_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `name_mobile` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `admin` int(100) NOT NULL,
  `type` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, deleted) VALUES ('1','2025-08-29 15:19:19','4d6a59774f4449774d6a55774d5445304d444a664d44453d','','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','NULL','55334a706332396d64486468636d5636','63334a706332396d64486468636d5636','55334a706332396d64486468636d5636','4f5467354f4459334f5459304e413d3d','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','51575274615734784d6a4e41','1','Super Admin','0');

INSERT INTO vijay_garage_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, deleted) VALUES ('2','2025-08-29 15:22:12','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','','4d6a6b774f4449774d6a55774d7a49794d544a664d44493d','4d6a6b774f4449774d6a55774d7a49794d444a664d44453d','553352685a6d593d','633352685a6d593d','553352685a6d593d','4e54497a4d7a4d7a4d7a4d7a4d773d3d','553352685a6d59674b4455794d7a4d7a4d7a4d7a4d7a4d70','553352685a6d59784d6a4e41','0','Staff','0');


CREATE TABLE `vijay_garage_vehicle` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `vehicle_id` mediumtext NOT NULL,
  `vehicle_no` mediumtext NOT NULL,
  `vehicle_details` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_vehicle (id, created_date_time, creator, creator_name, bill_company_id, vehicle_id, vehicle_no, vehicle_details, lower_case_name, deleted) VALUES ('5','2025-09-18 16:47:12','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a59774f4449774d6a55774d5445314d445a664d44453d','4d5467774f5449774d6a55774e4451334d544a664d44553d','564534674d444134','566d4675','644734674d444134','0');

INSERT INTO vijay_garage_vehicle (id, created_date_time, creator, creator_name, bill_company_id, vehicle_id, vehicle_no, vehicle_details, lower_case_name, deleted) VALUES ('6','2025-09-18 16:47:12','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a59774f4449774d6a55774d5445314d445a664d44453d','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','644734674d444135','0');


CREATE TABLE `vijay_garage_voucher` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `voucher_id` mediumtext NOT NULL,
  `voucher_number` mediumtext NOT NULL,
  `voucher_date` date NOT NULL,
  `investment_type` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `party_type` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_voucher (id, created_date_time, creator, creator_name, bill_company_id, voucher_id, voucher_number, voucher_date, investment_type, party_id, name_mobile_city, party_type, party_name, amount, narration, payment_mode_id, payment_mode_name, bank_id, bank_name, total_amount, deleted) VALUES ('1','2025-09-24 11:22:28','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a51774f5449774d6a55784d5449794d6a68664d44453d','VOU001/25-26','2025-09-24','','4d5467774f5449774d6a55784d5449324d5456664d44493d','553356695953416f4e7a41324f5463774e7a6b774f436b3d','1','5533566959513d3d','2500','63325279596d5a6e64673d3d','4d6a49774f5449774d6a55774d7a4d314d7a68664d44593d','55476876626d565159586b3d','4d6a4d774f5449774d6a55774e6a45794e545a664d44553d','56453143','2500','0');
