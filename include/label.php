<?php
	/*require 'mailin_sms/sms_api.php';
	$GLOBALS['mailin_sms_api_key'] = "zaG0R7cJBhkUbf54";*/

	date_default_timezone_set('Asia/Calcutta');
	$GLOBALS['create_date_time_label'] = date('Y-m-d H:i:s');
	$GLOBALS['site_name_user_prefix'] = "vijay_garage_".date("d-m-Y"); $GLOBALS['user_id'] = ""; $GLOBALS['creator'] = "";
	$GLOBALS['creator_name'] = ""; $GLOBALS['bill_company_id'] = ""; $GLOBALS['null_value'] = "NULL";

	$GLOBALS['page_number'] = 1; $GLOBALS['page_limit'] = 10; $GLOBALS['page_limit_list'] = array("10", "25", "50", "100");

	$GLOBALS['backup_folder_name'] = 'backup';
	$GLOBALS['log_backup_file'] = $GLOBALS['backup_folder_name']."/logs/".date("Y").".csv"; 

	$GLOBALS['max_company_count'] = 1;
	$GLOBALS['max_user_count'] = 10; 
	$GLOBALS['max_role_count'] = 5;
	
	// Tables
	$GLOBALS['user_table'] = ""; $GLOBALS['company_table'] = "company";

	$GLOBALS['table_prefix'] = "vijay_garage_";

	$GLOBALS['user_table'] = $GLOBALS['table_prefix'].'user';
	$GLOBALS['login_table'] = $GLOBALS['table_prefix'].'login';
	$GLOBALS['role_table'] = $GLOBALS['table_prefix'].'role';
	$GLOBALS['company_table'] = $GLOBALS['table_prefix'].'company';
	$GLOBALS['bank_table'] = $GLOBALS['table_prefix'].'bank';
	$GLOBALS['payment_mode_table'] = $GLOBALS['table_prefix'].'payment_mode';
	$GLOBALS['payment_table'] = $GLOBALS['table_prefix'].'payment';
	$GLOBALS['department_table'] = $GLOBALS['table_prefix'].'department';
	$GLOBALS['store_room_table'] = $GLOBALS['table_prefix'].'store_room';
	$GLOBALS['engineer_table'] = $GLOBALS['table_prefix'].'engineer';
	$GLOBALS['party_table'] = $GLOBALS['table_prefix'].'party';
	$GLOBALS['product_table'] = $GLOBALS['table_prefix'].'product';
	$GLOBALS['unit_table'] = $GLOBALS['table_prefix'].'unit';
	$GLOBALS['attendance_table'] = $GLOBALS['table_prefix'].'attendance';
	$GLOBALS['vehicle_table'] = $GLOBALS['table_prefix'].'vehicle';
	$GLOBALS['advance_voucher_table'] = $GLOBALS['table_prefix'].'advance_voucher';
	$GLOBALS['purchase_entry_table'] = $GLOBALS['table_prefix'].'purchase_entry';
    $GLOBALS['stock_table'] = $GLOBALS['table_prefix'].'stock';
    $GLOBALS['salary_table'] = $GLOBALS['table_prefix'].'salary';
    $GLOBALS['salary_voucher_table'] = $GLOBALS['table_prefix'].'salary_voucher';
	$GLOBALS['job_card_table'] = $GLOBALS['table_prefix'].'job_card';
	$GLOBALS['store_entry_table'] = $GLOBALS['table_prefix'].'store_entry';
	$GLOBALS['material_transfer_table'] = $GLOBALS['table_prefix'].'material_transfer';
	$GLOBALS['stock_adjustment_table'] = $GLOBALS['table_prefix'].'stock_adjustment';
	$GLOBALS['invoice_table'] = $GLOBALS['table_prefix'].'invoice';
	$GLOBALS['estimate_table'] = $GLOBALS['table_prefix'].'estimate';
	$GLOBALS['quotation_table'] = $GLOBALS['table_prefix'].'quotation';
	$GLOBALS['voucher_table'] = $GLOBALS['table_prefix'].'voucher';
	$GLOBALS['receipt_table'] = $GLOBALS['table_prefix'].'receipt';
	


	$GLOBALS['Reset_to_one'] = "Reset To 1"; $GLOBALS['continue_last_number'] = "Continue from last number"; $GLOBALS['custom_number'] = "Custom Number";
	
	$GLOBALS['admin_user_type'] = "Super Admin"; $GLOBALS['staff_user_type'] = "Staff"; $GLOBALS['user_type'] = "";

	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		$GLOBALS['creator'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
	}

	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name'])) {
		$GLOBALS['creator_name'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name'];
	}

	if(!empty($_SESSION['bill_company_id']) && isset($_SESSION['bill_company_id'])) {
		$GLOBALS['bill_company_id'] = $_SESSION['bill_company_id'];
	}

	$GLOBALS['paymentmode_module'] = "Payment Mode";
	$GLOBALS['bank_module'] = "Bank";
	$GLOBALS['engineer_module'] = "Engineer";
	$GLOBALS['department_module'] = "Department";
	$GLOBALS['store_room_module'] = "Store Room";
	$GLOBALS['unit_module'] = "Unit";
	$GLOBALS['product_module'] = "Product";
	$GLOBALS['vehicle_module'] = "Vehicle";
	$GLOBALS['party_module'] = "Party";
	$GLOBALS['purchase_entry_module'] = "Purchase Entry";
	$GLOBALS['job_card_module'] = "Job Card";
	$GLOBALS['store_entry_module'] = "Store Entry";
	$GLOBALS['reports_module'] = "Reports";
	$GLOBALS['quotation_module'] = "Quotation";
	$GLOBALS['invoice_module'] = "Invoice";
	$GLOBALS['estimate_module'] = "Estimate";
	$GLOBALS['store_entry_module'] = "Store Entry";
	$GLOBALS['material_transfer_module'] = "Material Transfer";
	$GLOBALS['attendance_module'] = "Attendance";
	$GLOBALS['salary_module'] = "salary";
	$GLOBALS['advance_voucher_module'] = "Advance Voucher";
	$GLOBALS['voucher_module'] = "Voucher";
	$GLOBALS['receipt_module'] = "Receipt";
	$GLOBALS['quotation_module'] = "Quotation";
	$GLOBALS['estimate_module'] = "Estimate";
	$GLOBALS['invoice_module'] = "Invoice";
	$GLOBALS['stock_adjustment_module'] = "Stock Adjustment";

	$access_pages_list = array();
	$access_pages_list[] = $GLOBALS['paymentmode_module'];
	$access_pages_list[] = $GLOBALS['bank_module'];
	$access_pages_list[] = $GLOBALS['engineer_module'];
	$access_pages_list[] = $GLOBALS['department_module'];
	$access_pages_list[] = $GLOBALS['store_room_module'];
	$access_pages_list[] = $GLOBALS['unit_module'];
	$access_pages_list[] = $GLOBALS['product_module'];
	$access_pages_list[] = $GLOBALS['party_module'];
	$access_pages_list[] = $GLOBALS['vehicle_module'];
	$access_pages_list[] = $GLOBALS['purchase_entry_module'];
	$access_pages_list[] = $GLOBALS['job_card_module'];
	$access_pages_list[] = $GLOBALS['store_entry_module'];
	$access_pages_list[] = $GLOBALS['material_transfer_module'];
	$access_pages_list[] = $GLOBALS['stock_adjustment_module'];
	$access_pages_list[] = $GLOBALS['attendance_module'];
	$access_pages_list[] = $GLOBALS['salary_module'];
	$access_pages_list[] = $GLOBALS['advance_voucher_module'];
	$access_pages_list[] = $GLOBALS['quotation_module'];
	$access_pages_list[] = $GLOBALS['estimate_module'];
	$access_pages_list[] = $GLOBALS['invoice_module'];
	$access_pages_list[] = $GLOBALS['voucher_module'];
	$access_pages_list[] = $GLOBALS['receipt_module'];
	$access_pages_list[] = $GLOBALS['reports_module'];
	$GLOBALS['access_pages_list'] = $access_pages_list;

	// Stock Actions
	$GLOBALS['stock_action_plus'] = "Plus"; $GLOBALS['stock_action_minus'] = "Minus";
?>