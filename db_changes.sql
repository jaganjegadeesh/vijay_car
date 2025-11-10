ALTER TABLE `vijay_garage_party` CHANGE `vehicle_number` `vehicle_number` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 
ALTER TABLE `vijay_garage_party` CHANGE `vehicle_details` `vehicle_details` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 
ALTER TABLE `vijay_garage_job_card` CHANGE `quotation_id` `quotation_id` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 
ALTER TABLE `vijay_garage_job_card` CHANGE `estimate_id` `estimate_id` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `invoice_id` `invoice_id` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 
ALTER TABLE `vijay_garage_invoice` CHANGE `total_qty` `total_qty` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0'; 


ALTER TABLE `vijay_garage_quotation` CHANGE `job_card_id` `job_card_id` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `job_card_number` `job_card_number` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `store_entry_id` `store_entry_id` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `store_entry_number` `store_entry_number` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `store_id` `store_id` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `store_name` `store_name` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 

ALTER TABLE `vijay_garage_quotation` CHANGE `product_amount` `product_amount` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 

ALTER TABLE `vijay_garage_quotation` CHANGE `total_qty` `total_qty` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 
ALTER TABLE `vijay_garage_estimate` CHANGE `total_qty` `total_qty` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 


