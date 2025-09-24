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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
  `monthly_salary` mediumtext NOT NULL,
  `total_salary` mediumtext NOT NULL,
  `salary_id` mediumtext NOT NULL,
  `is_salaried` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `vijay_garage_attendance` CHANGE `monthly_salary` `daily_salary` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL; 


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `vijay_garage_engineer` ADD `advance_amount` MEDIUMTEXT NOT NULL AFTER `lower_case_name`; 



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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `vijay_garage_salary_voucher` ADD `ot_salary_amount` MEDIUMTEXT NOT NULL AFTER `salary_received`; 




/* ***** YUVA ***** */

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
 `deleted` int(100) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `vijay_garage_product` ADD `stock_date` MEDIUMTEXT NOT NULL AFTER `product_tax`, ADD `store_room_id` MEDIUMTEXT NOT NULL AFTER `stock_date`, ADD `store_room_name` MEDIUMTEXT NOT NULL AFTER `store_room_id`, ADD `quantity` MEDIUMTEXT NOT NULL AFTER `store_room_name`;


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/* ***** JAGAN ***** */

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
);

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
) 