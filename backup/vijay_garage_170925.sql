

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_advance_voucher (id, created_date_time, creator, creator_name, bill_company_id, advance_voucher_id, advance_voucher_number, advance_voucher_date, engineer_id, engineer_name, amount, narration, payment_mode_id, payment_mode_name, bank_id, bank_name, total_amount, deleted) VALUES ('1','2025-09-24 13:10:15','4d6a6b774f4449774d6a55774d7a49794d544a664d44493d','553352685a6d593d','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a51774f5449774d6a55774d5445774d5456664d44453d','ADV001/25-26','2025-09-24','4d546b774f5449774d6a55784d6a51304e5452664d44553d','5457396f59573568','100,100','6332466b59336836','4d6a49774f5449774d6a55774d7a4d314d7a68664d44593d,4d5467774f5449774d6a55774d5449324d7a4a664d444d3d','55476876626d565159586b3d,5132467a61413d3d','4d6a4d774f5449774d6a55774e6a45794e545a664d44553d,4d5467774f5449774d6a55774d5449334d6a4e664d44493d','56453143,55304a4a','200','1');


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


INSERT INTO vijay_garage_bank (id, created_date_time, creator, creator_name, bill_company_id, bank_id, account_name, account_number, bank_name, ifsc_code, account_type, bank_name_account_number, branch, payment_mode_id, deleted) VALUES ('2','2025-09-18 13:27:23','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d5449334d6a4e664d44493d','55304a4a','4e6a41334f5441334f5441354d413d3d','55304a4a','NULL','553246326157356e63773d3d','55304a4a494367324d4463354d4463354d446b774b513d3d','55326c325957746863326b3d','4d5467774f5449774d6a55774d5449324d7a4a664d444d3d','1');

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


INSERT INTO vijay_garage_company (id, created_date_time, creator, creator_name, company_id, name, lower_case_name, email, address, state, district, city, others_city, pincode, gst_number, mobile_number, company_details, logo, watermark, primary_company, deleted) VALUES ('1','2025-08-29 15:21:22','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c','646d6c7159586b675a3246795957646c','646d6c7159586c6e59584a685a3255774d5464415a3231686157777559323974','4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e6862485679','5647467461577767546d466b64513d3d','566d6c796457526f645735685a324679','53323976636d4670613356755a48553d','NULL','4e6a49324d44417a','4d7a4e4253555a5151546b354e5452524d317050','4f5441344d4445794d7a67324f513d3d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b53323976636d4670613356755a4855674c5341324d6a59774d444d6b4a43525761584a315a476831626d466e5958496b4a435255595731706243424f595752314a43516b49453176596d6c735a5341364f5441344d4445794d7a67324f53516b4a43424855315167546d38674f6a4d7a51556c47554545354f54553055544e6154773d3d','logo_24_09_2025_04_21_54.png','watermark_24_09_2025_04_22_05.png','1','0');


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

INSERT INTO vijay_garage_department (id, created_date_time, creator, creator_name, bill_company_id, department_id, department_name, lower_case_name, deleted) VALUES ('2','2025-09-17 15:08:14','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5463774f5449774d6a55774d7a41344d5456664d44493d','55474670626e5270626d633d','63474670626e5270626d633d','1');

INSERT INTO vijay_garage_department (id, created_date_time, creator, creator_name, bill_company_id, department_id, department_name, lower_case_name, deleted) VALUES ('3','2025-09-18 13:28:17','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d5449344d5464664d444d3d','515778705a3235745a573530','595778705a3235745a573530','0');

INSERT INTO vijay_garage_department (id, created_date_time, creator, creator_name, bill_company_id, department_id, department_name, lower_case_name, deleted) VALUES ('4','2025-09-18 13:28:17','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d5449344d5464664d44513d','563246305a5849675632467a61413d3d','643246305a5849676432467a61413d3d','0');


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_invoice (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, invoice_id, invoice_date, invoice_number, party_id, party_name_mobile_city, party_details, party_state, vehicle_id, vehicle_number, vehicle_details, bank_id, bank_name, bank_account_number, gst_option, tax_type, tax_option, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, final_rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, cgst_value, sgst_value, igst_value, total_tax_value, overall_tax, product_tax, charges_tax, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('1','2025-09-25 16:45:29','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a55774f5449774d6a55774e4451314d6a6c664d44453d','2025-09-25','IN001/25-26','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','Tamil Nadu','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','4d6a49774f5449774d6a55774d7a4d314d5468664d44513d','5657357062323467596d4675617942765a694270626d527059513d3d','4f446b314d7a51354e5451354e5467304e544d304e54493d','1','1','1','4d6a55774f5449774d6a55774e444d344e5442664d44493d,4d6a55774f5449774d6a55774e444d314d7a5a664d44453d,4d6a55774f5449774d6a55774e444d314d7a5a664d44453d','JC002/25-26,JC001/25-26,JC001/25-26','4d6a55774f5449774d6a55774e4451774d6a68664d44493d,4d6a55774f5449774d6a55774e444d324d7a42664d44453d,4d6a55774f5449774d6a55774e444d324d7a42664d44453d','SE002/25-26,SE001/25-26,SE001/25-26','4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534242,556d397662534244,556d397662534244','4d6a55774f5449774d6a55774e4451774d446c664d446b3d,4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d6a55774f5449774d6a55774e444d344d4452664d44673d','5157356e62475567556d396b,63334276626d4e6f,526d7876636d6c755a513d3d','4e7a51324d673d3d,4f4451344f513d3d,4f4451334f513d3d','1820,1320,9000','4d6a55774f5449774d6a55774e444d784d6a4a664d44553d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','6132633d,63474e6c,62476c3064475679','2,10,50','','910,132,180','910,132,180','1820,1320,9000','12140','','','NULL','12140','NULL','NULL','NULL','12140','974.30','974.30','0','1948.60','','5%,18%,18%','','1','1','40','14089','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_job_card (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, job_card_id, job_card_number, job_card_date, party_id, party_name_mobile_city, party_details, department_id, department_name, engineer_id, vehicle_id, vehicle_no, vehicle_details, work_details, quotation_status, quotation_id, estimate_status, estimate_id, invoice_status, invoice_id, deleted) VALUES ('1','2025-09-25 16:35:36','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a55774f5449774d6a55774e444d314d7a5a664d44453d','JC001/25-26','2025-09-25','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','4d5467774f5449774d6a55774d5449344d5464664d44513d','563246305a5849675632467a61413d3d','4d546b774f5449774d6a55784d6a51304e5452664d44513d,4d546b774f5449774d6a55784d6a51304e5452664d44553d','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','6432467a6143423061475567593246794948646f61574e6f494864686379426a62335a6c636d566b49476c75494731315a413d3d','Q','4d6a55774f5449774d6a55774e4451784d6a4e664d44453d','0','','I','4d6a55774f5449774d6a55774e4451314d6a6c664d44453d','0');

INSERT INTO vijay_garage_job_card (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, job_card_id, job_card_number, job_card_date, party_id, party_name_mobile_city, party_details, department_id, department_name, engineer_id, vehicle_id, vehicle_no, vehicle_details, work_details, quotation_status, quotation_id, estimate_status, estimate_id, invoice_status, invoice_id, deleted) VALUES ('2','2025-09-25 16:38:50','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a55774f5449774d6a55774e444d344e5442664d44493d','JC002/25-26','2025-09-25','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','4d5467774f5449774d6a55774d5449344d5464664d444d3d','515778705a3235745a573530','4d5467774f5449774d6a55784d6a55304d7a56664d44493d,4d546b774f5449774d6a55784d6a51304e5452664d44513d','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','5a6e4a76626e51676432686c5a577767596d56755a413d3d','Q','4d6a55774f5449774d6a55774e4451784d6a4e664d44453d','0','','I','4d6a55774f5449774d6a55774e4451314d6a6c664d44453d','0');

INSERT INTO vijay_garage_job_card (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, job_card_id, job_card_number, job_card_date, party_id, party_name_mobile_city, party_details, department_id, department_name, engineer_id, vehicle_id, vehicle_no, vehicle_details, work_details, quotation_status, quotation_id, estimate_status, estimate_id, invoice_status, invoice_id, deleted) VALUES ('3','2025-09-25 17:16:00','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a55774f5449774d6a55774e5445324d4442664d444d3d','JC003/25-26','2025-09-25','4d546b774f5449774d6a55774e5451304e4452664d444d3d','5457396f595734674b446b344f5467324e7a6b324e445170','5457396f59573438596e492b59584e6d5a57526a63325538596e492b5647467461577767546d466b64547869636a354e62324a70624755674f6941354f446b344e6a63354e6a5130','4d5467774f5449774d6a55774d5449344d5464664d444d3d','515778705a3235745a573530','4d5467774f5449774d6a55784d6a55304d7a56664d44453d,4d5467774f5449774d6a55784d6a55304d7a56664d44493d','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','5a48707a5a6d5679','0','','0','','0','','1');

INSERT INTO vijay_garage_job_card (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, job_card_id, job_card_number, job_card_date, party_id, party_name_mobile_city, party_details, department_id, department_name, engineer_id, vehicle_id, vehicle_no, vehicle_details, work_details, quotation_status, quotation_id, estimate_status, estimate_id, invoice_status, invoice_id, deleted) VALUES ('4','2025-09-26 11:15:16','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a59774f5449774d6a55784d5445314d5464664d44513d','JC004/25-26','2025-09-26','4d546b774f5449774d6a55774e5451304e4452664d444d3d','5457396f595734674b446b344f5467324e7a6b324e445170','5457396f59573438596e492b59584e6d5a57526a63325538596e492b5647467461577767546d466b64547869636a354e62324a70624755674f6941354f446b344e6a63354e6a5130','4d5467774f5449774d6a55774d5449344d5464664d44513d','563246305a5849675632467a61413d3d','4d546b774f5449774d6a55784d6a51304e5452664d44513d','4d5467774f5449774d6a55774e4451334d544a664d44553d','564534674d444134','566d4675','646e6c6f5a773d3d','0','','0','','0','','0');

INSERT INTO vijay_garage_job_card (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, job_card_id, job_card_number, job_card_date, party_id, party_name_mobile_city, party_details, department_id, department_name, engineer_id, vehicle_id, vehicle_no, vehicle_details, work_details, quotation_status, quotation_id, estimate_status, estimate_id, invoice_status, invoice_id, deleted) VALUES ('5','2025-09-26 11:16:41','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a59774f5449774d6a55784d5445324e4446664d44553d','JC005/25-26','2025-09-26','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','4d5467774f5449774d6a55774d5449344d5464664d44513d','563246305a5849675632467a61413d3d','4d5467774f5449774d6a55784d6a55304d7a56664d44493d','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','NULL','0','','0','','0','','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('1','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-25 16:26:32','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('2','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-26 09:26:37','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('3','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-26 11:16:46','2025-09-26 15:27:16','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('4','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-26 15:27:17','2025-09-26 17:15:22','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('5','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-26 17:15:23','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');

INSERT INTO vijay_garage_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, user_id, type, deleted) VALUES ('6','55334a706332396d64486468636d5636494367354f446b344e6a63354e6a51304b513d3d','2025-09-27 09:46:42','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','Windows NT JAGAN 10.0 build 26100 (Windows 11) AMD64','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','Super Admin','0');


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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

INSERT INTO vijay_garage_party (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, lower_case_name, address, city, district, state, pincode, mobile_number, others_city, party_details, opening_balance, opening_balance_type, name_mobile_city, identification, vehicle_number, vehicle_details, deleted) VALUES ('2','2025-09-18 11:26:14','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','1','4d5467774f5449774d6a55784d5449324d5456664d44493d','5533566959513d3d','6333566959513d3d','NULL','NULL','NULL','5647467461577767546d466b64513d3d','NULL','4e7a41324f5463774e7a6b774f413d3d','','5533566959547869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494463774e6a6b334d4463354d44673d','','','553356695953416f4e7a41324f5463774e7a6b774f436b3d','NULL','','','1');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('1','2025-09-25 16:45:29','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a55774f5449774d6a55774e4451314d6a6c664d44453d','IN001/25-26','2025-09-25','Invoice','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a3162673d3d','Customer','NULL','NULL','4d6a49774f5449774d6a55774d7a4d314d5468664d44513d','NULL','5657357062323467596d4675617942765a694270626d527059513d3d','NULL','0','14089','0');

INSERT INTO vijay_garage_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, opening_balance, opening_balance_type, credit, debit, deleted) VALUES ('2','2025-09-26 15:27:54','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a59774f5449774d6a55774d7a49334e5452664d44453d','PE001/25-26','2025-09-26','Purchase Entry','4d5467774f5449774d6a55784d4449784d4446664d44453d','5533566959534251','1','NULL','NULL','NULL','NULL','0','NULL','52368.99','0','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, product_rate, product_tax, stock_date, store_room_id, store_room_name, quantity, deleted) VALUES ('3','2025-09-18 13:33:11','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d544d7a4d5446664d444d3d','55484a765a48566a64434242','63484a765a48566a64434268','4f5441354d446b3d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','5132467a5a513d3d','1000','5','2025-09-19,2025-09-19','4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534242,556d397662534244','15,10','1');

INSERT INTO vijay_garage_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, product_rate, product_tax, stock_date, store_room_id, store_room_name, quantity, deleted) VALUES ('4','2025-09-19 15:56:43','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d546b774f5449774d6a55774d7a55324e444e664d44513d','64326c755a43427a614756735a413d3d','64326c755a43427a614756735a413d3d','4e7a6b774f54593d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','63474e6c','100','5','2025-09-19,2025-09-19,2025-09-19','4d5463774f5449774d6a55774d7a49334d4452664d444d3d,4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534243,556d397662534242,556d397662534244','10,10,10','0');

INSERT INTO vijay_garage_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, product_rate, product_tax, stock_date, store_room_id, store_room_name, quantity, deleted) VALUES ('5','2025-09-19 17:49:40','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d546b774f5449774d6a55774e5451354e4442664d44553d','636d56686369427461584a796233493d','636d56686369427461584a796233493d','4f4451354f513d3d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','63474e6c','800','12','2025-09-19,2025-09-19,2025-09-19','4d5463774f5449774d6a55774d7a49334d4452664d444d3d,4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534243,556d397662534242,556d397662534244','100,100,100','0');

INSERT INTO vijay_garage_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, product_rate, product_tax, stock_date, store_room_id, store_room_name, quantity, deleted) VALUES ('6','2025-09-19 17:55:35','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','63334276626d4e6f','63334276626d4e6f','4f4451344f513d3d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','63474e6c','132','18','2025-09-19,2025-09-19,2025-09-19','4d5463774f5449774d6a55774d7a49334d4452664d444d3d,4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534243,556d397662534242,556d397662534244','25,20,50','0');

INSERT INTO vijay_garage_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, product_rate, product_tax, stock_date, store_room_id, store_room_name, quantity, deleted) VALUES ('7','2025-09-25 16:32:21','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a55774f5449774d6a55774e444d794d6a46664d44633d','4d5449674969423065584a6c','4d5449674969423065584a6c','4f5467304f513d3d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','63474e6c','800','12','2025-09-25,2025-09-25','4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534242,556d397662534244','50,25','0');

INSERT INTO vijay_garage_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, product_rate, product_tax, stock_date, store_room_id, store_room_name, quantity, deleted) VALUES ('8','2025-09-25 16:38:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a55774f5449774d6a55774e444d344d4452664d44673d','526d7876636d6c755a513d3d','5a6d7876636d6c755a513d3d','4f4451334f513d3d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','62476c3064475679','180','18','2025-09-25,2025-09-25,2025-09-25','4d5463774f5449774d6a55774d7a49334d4452664d444d3d,4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534243,556d397662534242,556d397662534244','50,80,100','0');

INSERT INTO vijay_garage_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, product_rate, product_tax, stock_date, store_room_id, store_room_name, quantity, deleted) VALUES ('9','2025-09-25 16:40:09','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a55774f5449774d6a55774e4451774d446c664d446b3d','5157356e62475567556d396b','5957356e62475567636d396b','4e7a51324d673d3d','4d6a55774f5449774d6a55774e444d784d6a4a664d44553d','6132633d','910','5','2025-09-25,2025-09-25,2025-09-25','4d5463774f5449774d6a55774d7a49334d4452664d444d3d,4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534243,556d397662534242,556d397662534244','20,15,10','0');

INSERT INTO vijay_garage_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, product_rate, product_tax, stock_date, store_room_id, store_room_name, quantity, deleted) VALUES ('10','2025-09-26 11:01:32','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a59774f5449774d6a55784d5441784d7a4a664d54413d','4d6a55674969426862476c6e626942436232786b','4d6a55674969426862476c6e626942696232786b','4e7a597a4f413d3d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','63474e6c','700','12','2025-09-26','4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534242','11','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_purchase_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, purchase_entry_id, purchase_entry_date, purchase_entry_number, store_type, store_id, store_name, party_id, party_name_mobile_city, party_details, party_state, gst_option, tax_type, tax_option, product_id, product_name, product_amount, unit_id, unit_name, quantity, total_qty, rate, final_rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, cgst_value, sgst_value, igst_value, total_tax_value, overall_tax, product_tax, charges_tax, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('1','2025-09-26 15:27:54','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a59774f5449774d6a55774d7a49334e5452664d44453d','2025-09-26','PE001/25-26','1','4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534242','4d5467774f5449774d6a55784d4449784d4446664d44453d','5533566959534251494367344f5441354d4463354e6a41354b513d3d','553356695953425150474a79506c526862576c73494535685a485538596e492b545739696157786c49446f674f446b774f5441334f5459774f513d3d','Tamil Nadu','1','2','1','4d6a55774f5449774d6a55774e4451774d446c664d446b3d','5157356e62475567556d396b','50000','4d6a55774f5449774d6a55774e444d784d6a4a664d44553d','6132633d','50','50','1000','1000','50000','50000','6333426c59326c686243426b61584e6a','5%','2500.00','47500','Extra','5%','2375.00','49875','1246.88','1246.88','0','2493.75','5%','5%','5%','2','1','24','52368.99','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_quotation (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, quotation_id, quotation_date, quotation_number, party_id, party_name_mobile_city, party_details, vehicle_id, vehicle_number, vehicle_details, job_card_id, job_card_number, store_entry_id, store_entry_number, store_id, store_name, product_id, product_name, hsn_code, product_amount, unit_id, unit_name, quantity, total_qty, rate, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_name, charges, charges_value, charges_total, round_off, round_off_type, round_off_value, total_amount, deleted) VALUES ('1','2025-09-25 16:41:23','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a55774f5449774d6a55774e4451784d6a4e664d44453d','2025-09-25','QT001/25-26','4d546b774f5449774d6a55774e5451344d6a56664d44513d','59584a316269416f4e54497a4d7a4d7a4d7a4d7a4d796b3d','59584a31626a7869636a357a59575a6b637a7869636a3555595731706243424f5957523150474a79506b3176596d6c735a534136494455794d7a4d7a4d7a4d7a4d7a4d38596e492b5155464249444d304d7a497a4e446b354e4467344e544d30','4d5467774f5449774d6a55774e4451334d544a664d44593d','564534674d444135','54473979636e6b3d','4d6a55774f5449774d6a55774e444d344e5442664d44493d,4d6a55774f5449774d6a55774e444d314d7a5a664d44453d,4d6a55774f5449774d6a55774e444d314d7a5a664d44453d','JC002/25-26,JC001/25-26,JC001/25-26','4d6a55774f5449774d6a55774e4451774d6a68664d44493d,4d6a55774f5449774d6a55774e444d324d7a42664d44453d,4d6a55774f5449774d6a55774e444d324d7a42664d44453d','SE002/25-26,SE001/25-26,SE001/25-26','4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534242,556d397662534244,556d397662534244','4d6a55774f5449774d6a55774e4451774d446c664d446b3d,4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d6a55774f5449774d6a55774e444d344d4452664d44673d','5157356e62475567556d396b,63334276626d4e6f,526d7876636d6c755a513d3d','4e7a51324d673d3d,4f4451344f513d3d,4f4451334f513d3d','','4d6a55774f5449774d6a55774e444d784d6a4a664d44553d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','6132633d,63474e6c,62476c3064475679','2,10,50','','910,132,180','1820,1320,9000','12140','6333426c59326c686243426b61584e6a','5%','607.00','11533','Extra','5%','576.65','12109.65','1','1','35','12110','0');


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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


INSERT INTO vijay_garage_role (id, created_date_time, creator, creator_name, role_id, role_name, lower_case_name, access_pages, access_page_actions, incharger, deleted) VALUES ('1','2025-08-29 15:22:02','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49794d444a664d44453d','545746755957646c63673d3d','625746755957646c63673d3d','55474635625756756443424e6232526c,516d467561773d3d,5257356e6157356c5a58493d,5247567759584a306257567564413d3d,55335276636d5567556d397662513d3d,5657357064413d3d,55484a765a48566a64413d3d,5547467964486b3d,566d566f61574e735a513d3d,55485679593268686332556752573530636e6b3d,536d396949454e68636d513d,55335276636d556752573530636e6b3d,545746305a584a705957776756484a68626e4e6d5a58493d,55335276593273675157527164584e306257567564413d3d,515852305a57356b5957356a5a513d3d,6332467359584a35,515752325957356a5a5342576233566a61475679,555856766447463061573975,52584e30615731686447553d,5357353262326c6a5a513d3d,566d39315932686c63673d3d,556d566a5a576c7764413d3d','566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d$$$524756735a58526c,566d6c6c64773d3d,566d6c6c64773d3d','0','0');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('1','2025-09-25 16:27:08','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d444d3d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','25','0','Opening Stock','Plus','4d546b774f5449774d6a55774e5455314d7a56664d44593d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('2','2025-09-25 16:27:08','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','20','0','Opening Stock','Plus','4d546b774f5449774d6a55774e5455314d7a56664d44593d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('3','2025-09-25 16:27:08','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','50','0','Opening Stock','Plus','4d546b774f5449774d6a55774e5455314d7a56664d44593d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('4','2025-09-25 16:28:10','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d444d3d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','100','0','Opening Stock','Plus','4d546b774f5449774d6a55774e5451354e4442664d44553d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('5','2025-09-25 16:28:10','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','100','0','Opening Stock','Plus','4d546b774f5449774d6a55774e5451354e4442664d44553d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('6','2025-09-25 16:28:10','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','100','0','Opening Stock','Plus','4d546b774f5449774d6a55774e5451354e4442664d44553d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('7','2025-09-25 16:28:44','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d444d3d','4d546b774f5449774d6a55774d7a55324e444e664d44513d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','10','0','Opening Stock','Plus','4d546b774f5449774d6a55774d7a55324e444e664d44513d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('8','2025-09-25 16:28:44','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774d7a55324e444e664d44513d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','10','0','Opening Stock','Plus','4d546b774f5449774d6a55774d7a55324e444e664d44513d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('9','2025-09-25 16:28:44','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-19','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774d7a55324e444e664d44513d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','10','0','Opening Stock','Plus','4d546b774f5449774d6a55774d7a55324e444e664d44513d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('10','2025-09-25 16:32:21','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d6a55774f5449774d6a55774e444d794d6a46664d44633d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','50','0','Opening Stock','Plus','4d6a55774f5449774d6a55774e444d794d6a46664d44633d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('11','2025-09-25 16:32:21','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d6a55774f5449774d6a55774e444d794d6a46664d44633d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','25','0','Opening Stock','Plus','4d6a55774f5449774d6a55774e444d794d6a46664d44633d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('12','2025-09-25 16:36:30','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774e5455314d7a56664d44593d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','0','10','Store Entry','Minus','4d6a55774f5449774d6a55774e444d324d7a42664d44453d','SE001/25-26','SE001/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('13','2025-09-25 16:38:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d444d3d','4d6a55774f5449774d6a55774e444d344d4452664d44673d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','50','0','Opening Stock','Plus','4d6a55774f5449774d6a55774e444d344d4452664d44673d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('14','2025-09-25 16:38:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d6a55774f5449774d6a55774e444d344d4452664d44673d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','80','0','Opening Stock','Plus','4d6a55774f5449774d6a55774e444d344d4452664d44673d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('15','2025-09-25 16:38:03','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d6a55774f5449774d6a55774e444d344d4452664d44673d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','100','0','Opening Stock','Plus','4d6a55774f5449774d6a55774e444d344d4452664d44673d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('16','2025-09-25 16:38:18','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d6a55774f5449774d6a55774e444d344d4452664d44673d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','0','50','Store Entry','Minus','4d6a55774f5449774d6a55774e444d324d7a42664d44453d','SE001/25-26','SE001/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('17','2025-09-25 16:40:09','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d444d3d','4d6a55774f5449774d6a55774e4451774d446c664d446b3d','4d6a55774f5449774d6a55774e444d784d6a4a664d44553d','20','0','Opening Stock','Plus','4d6a55774f5449774d6a55774e4451774d446c664d446b3d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('18','2025-09-25 16:40:09','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d6a55774f5449774d6a55774e4451774d446c664d446b3d','4d6a55774f5449774d6a55774e444d784d6a4a664d44553d','15','0','Opening Stock','Plus','4d6a55774f5449774d6a55774e4451774d446c664d446b3d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('19','2025-09-25 16:40:09','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d6a55774f5449774d6a55774e4451774d446c664d446b3d','4d6a55774f5449774d6a55774e444d784d6a4a664d44553d','10','0','Opening Stock','Plus','4d6a55774f5449774d6a55774e4451774d446c664d446b3d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('20','2025-09-25 16:40:27','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d6a55774f5449774d6a55774e4451774d446c664d446b3d','4d6a55774f5449774d6a55774e444d784d6a4a664d44553d','0','2','Store Entry','Minus','4d6a55774f5449774d6a55774e4451774d6a68664d44493d','SE002/25-26','SE002/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('21','2025-09-25 17:16:28','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','0','1','Store Entry','Minus','4d6a55774f5449774d6a55774e5445324d6a68664d444d3d','SE003/25-26','SE003/25-26','1');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('22','2025-09-25 17:16:28','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774d7a55324e444e664d44513d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','0','2','Store Entry','Minus','4d6a55774f5449774d6a55774e5445324d6a68664d444d3d','SE003/25-26','SE003/25-26','1');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('23','2025-09-25 17:16:28','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-25','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d6a55774f5449774d6a55774e4451774d446c664d446b3d','4d6a55774f5449774d6a55774e444d784d6a4a664d44553d','0','2','Store Entry','Minus','4d6a55774f5449774d6a55774e5445324d6a68664d444d3d','SE003/25-26','SE003/25-26','1');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('24','2025-09-26 10:24:37','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-26','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','0','10','Store Entry','Minus','4d6a59774f5449774d6a55784d4449304d7a64664d44513d','SE004/25-26','SE004/25-26','1');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('25','2025-09-26 11:01:32','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-26','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','NULL','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d6a59774f5449774d6a55784d5441784d7a4a664d54413d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','11','0','Opening Stock','Plus','4d6a59774f5449774d6a55784d5441784d7a4a664d54413d','NULL','Opening Stock','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('26','2025-09-26 11:17:53','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-26','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','','4d5467774f5449774d6a55774d7a51314d4452664d44553d','4d546b774f5449774d6a55774e5451354e4442664d44553d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','0','10','Store Entry','Minus','4d6a59774f5449774d6a55784d5445334e544e664d44553d','SE005/25-26','SE005/25-26','0');

INSERT INTO vijay_garage_stock (id, created_date_time, creator, creator_name, stock_date, bill_company_id, party_id, store_id, product_id, unit_id, inward_unit, outward_unit, stock_type, stock_action, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('27','2025-09-26 15:27:54','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','2025-09-26','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55784d4449784d4446664d44453d','4d5463774f5449774d6a55774d7a49334d4452664d44513d','4d6a55774f5449774d6a55774e4451774d446c664d446b3d','4d6a55774f5449774d6a55774e444d784d6a4a664d44553d','50','0','Purchase Entry','Plus','4d6a59774f5449774d6a55774d7a49334e5452664d44453d','PE001/25-26','PE001/25-26','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_store_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, store_entry_id, store_entry_date, store_entry_number, job_card_id, job_card_number, store_type, store_id, store_name, product_id, product_name, hsn_code, unit_id, unit_name, quantity, remarks, deleted) VALUES ('1','2025-09-25 16:36:30','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a55774f5449774d6a55774e444d324d7a42664d44453d','2025-09-25','SE001/25-26','4d6a55774f5449774d6a55774e444d314d7a5a664d44453d','JC001/25-26','1','4d5467774f5449774d6a55774d7a51314d4452664d44553d,4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534244,556d397662534244','4d546b774f5449774d6a55774e5455314d7a56664d44593d,4d6a55774f5449774d6a55774e444d344d4452664d44673d','63334276626d4e6f,526d7876636d6c755a513d3d','4f4451344f513d3d,4f4451334f513d3d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d44513d','63474e6c,62476c3064475679','10,50','644746725a53426d623349676432467a614342306147556759324679','0');

INSERT INTO vijay_garage_store_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, store_entry_id, store_entry_date, store_entry_number, job_card_id, job_card_number, store_type, store_id, store_name, product_id, product_name, hsn_code, unit_id, unit_name, quantity, remarks, deleted) VALUES ('2','2025-09-25 16:40:27','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a55774f5449774d6a55774e4451774d6a68664d44493d','2025-09-25','SE002/25-26','4d6a55774f5449774d6a55774e444d344e5442664d44493d','JC002/25-26','1','4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534242','4d6a55774f5449774d6a55774e4451774d446c664d446b3d','5157356e62475567556d396b','4e7a51324d673d3d','4d6a55774f5449774d6a55774e444d784d6a4a664d44553d','6132633d','2','NULL','0');

INSERT INTO vijay_garage_store_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, store_entry_id, store_entry_date, store_entry_number, job_card_id, job_card_number, store_type, store_id, store_name, product_id, product_name, hsn_code, unit_id, unit_name, quantity, remarks, deleted) VALUES ('3','2025-09-25 17:16:28','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a55774f5449774d6a55774e5445324d6a68664d444d3d','2025-09-25','SE003/25-26','4d6a55774f5449774d6a55774e5445324d4442664d444d3d','JC003/25-26','1','4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5463774f5449774d6a55774d7a49334d4452664d44513d,4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534242,556d397662534242,556d397662534242','4d546b774f5449774d6a55774e5451354e4442664d44553d,4d546b774f5449774d6a55774d7a55324e444e664d44513d,4d6a55774f5449774d6a55774e4451774d446c664d446b3d','636d56686369427461584a796233493d,64326c755a43427a614756735a413d3d,5157356e62475567556d396b','4f4451354f513d3d,4e7a6b774f54593d,4e7a51324d673d3d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d5467774f5449774d6a55774d544d784d6a42664d444d3d,4d6a55774f5449774d6a55774e444d784d6a4a664d44553d','63474e6c,63474e6c,6132633d','1,2,2','65474e365a475a335a513d3d','1');

INSERT INTO vijay_garage_store_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, store_entry_id, store_entry_date, store_entry_number, job_card_id, job_card_number, store_type, store_id, store_name, product_id, product_name, hsn_code, unit_id, unit_name, quantity, remarks, deleted) VALUES ('4','2025-09-26 10:24:37','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a59774f5449774d6a55784d4449304d7a64664d44513d','2025-09-26','SE004/25-26','4d6a55774f5449774d6a55774e5445324d4442664d444d3d','JC003/25-26','1','4d5463774f5449774d6a55774d7a49334d4452664d44513d','556d397662534242','4d546b774f5449774d6a55774e5451354e4442664d44553d','636d56686369427461584a796233493d','4f4451354f513d3d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','63474e6c','10','NULL','1');

INSERT INTO vijay_garage_store_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, store_entry_id, store_entry_date, store_entry_number, job_card_id, job_card_number, store_type, store_id, store_name, product_id, product_name, hsn_code, unit_id, unit_name, quantity, remarks, deleted) VALUES ('5','2025-09-26 11:17:53','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','566d6c7159586b67523246795957646c4a43516b4d6938784e6a49764e797767546d3979644767674d6d356b49464e30636d566c644377675543424c64573168636d46736157356e59584231636d46744945316c5a584e68624856794a43516b5647467461577767546d466b6453516b4a465a70636e566b61485675595764686369516b4a45747662334a6861577431626d52314a43516b4f5441344d4445794d7a67324f53516b4a4459304e6d5132597a63784e546b314f445a6a4e6d55314f5455344e4745324f4456684d7a49314e5463334e4751314e4459304e44453159544d794d7a45324f4459784e5463334e7a63314e546b7a4d6a4d354e7a516b4a43524f5655784d','4d6a59774f5449774d6a55784d5445334e544e664d44553d','2025-09-26','SE005/25-26','4d6a59774f5449774d6a55784d5445314d5464664d44513d','JC004/25-26','1','4d5467774f5449774d6a55774d7a51314d4452664d44553d','556d397662534244','4d546b774f5449774d6a55774e5451354e4442664d44553d','636d56686369427461584a796233493d','4f4451354f513d3d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','63474e6c','10','NULL','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO vijay_garage_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('3','2025-09-18 13:31:20','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d544d784d6a42664d444d3d','63474e6c','63474e6c','0');

INSERT INTO vijay_garage_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('4','2025-09-18 13:31:20','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d5467774f5449774d6a55774d544d784d6a42664d44513d','62476c3064475679','62476c3064475679','0');

INSERT INTO vijay_garage_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('5','2025-09-25 16:31:22','4d6a6b774f4449774d6a55774d7a45354d546c664d44453d','55334a706332396d64486468636d5636','4d6a6b774f4449774d6a55774d7a49784d6a4a664d44453d','4d6a55774f5449774d6a55774e444d784d6a4a664d44553d','6132633d','6132633d','0');


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

