<?php
	include("basic_functions.php");
	include("creation_functions.php");
	include("attendance_functions.php");
	include("billing_functions.php");
	include("payment_functions.php");
	include("stock_functions.php");
	include("salary_functions.php");
	include("report_functions.php");


	class billing extends Basic_Functions {
		public function getProjectTitle() {
			$string = parent::getProjectTitle();
			return $string;
		}
		
		public function encode_decode($action, $string) {
			$string = parent::encode_decode($action, $string);
			return $string;
		}		
		public function InsertSQL($table, $columns, $values, $custom_id, $unique_number, $action) {
			$last_insert_id = "";		
			$last_insert_id = parent::InsertSQL($table, $columns, $values, $custom_id, $unique_number, $action);
			return $last_insert_id;
		}	
		public function UpdateSQL($table, $update_id, $columns, $values, $action) {
			$msg = "";		
			$msg = parent::UpdateSQL($table, $update_id, $columns, $values, $action);
			return $msg;
		}
		public function getTableColumnValue($table, $column, $value, $return_value) {
			$result = "";
			$result = parent::getTableColumnValue($table, $column, $value, $return_value);
			return $result;
		}
		public function getTableRecords($table, $column, $value) {
			$result = "";		
			$result = parent::getTableRecords($table, $column, $value);
			return $result;
		}
		public function getAllRecords($table, $column, $value) {
			$result = "";		
			$result = parent::getAllRecords($table, $column, $value);
			return $result;
		}
		public function basic_functions_object() {
			$basic_obj = "";		
			$basic_obj = new Basic_Functions();
			return $basic_obj;
		}
		public function numberFormat($number, $decimals) {
			$basic_obj = "";
			$basic_obj = $this->basic_functions_object();
			$msg = "";		
			$msg = $basic_obj->numberFormat($number, $decimals);
			return $msg;
		}

		public function daily_db_backup() {
			$result = "";		
			$result = parent::daily_db_backup();
			return $result;
		}
		public function image_directory() {
			$target_dir = "";		
			$target_dir = parent::image_directory();
			return $target_dir;
		}
		public function temp_image_directory() {
			$temp_dir = "";		
			$temp_dir = parent::temp_image_directory();
			return $temp_dir;
		}
		public function clear_temp_image_directory() {
			$res = "";		
			$res = parent::clear_temp_image_directory();
			return $res;
		}
		
		public function check_user_id_ip_address() {
			$check_login_id = "";			
			$check_login_id = parent::check_user_id_ip_address();			
			return $check_login_id;	
		}
		public function checkUser() {
			$login_user_id = "";			
			$login_user_id = parent::checkUser();			
			return $login_user_id;	
		}
		public function getDailyReport($from_date, $to_date) {
			$list = array();
			$list = parent::getDailyReport($from_date, $to_date);
			return $list;
		}
		
		public function send_mobile_details($phone_number, $msg) {
			$res = "";
			$res = parent::send_mobile_details($phone_number, $msg);
			return true;
		}		
		public function automate_number($table, $column) {
			$next_number = "";
			$next_number = parent::automate_number($table, $column);
			return $next_number;
		}	
		public function getOtherCityList($district) {
			$list = array();
			$list = parent::getOtherCityList($district);
			return $list;
		}
		public function CompanyCount() {
			$list = 0;
			$list = parent::CompanyCount();
			return $list;
		}
		public function CheckRoleAccessPage($role_id,$permission_page) {
			$access = "";
			$access = parent::CheckRoleAccessPage($role_id,$permission_page);
			return $access;
		}
		
		public function billing_function_object() {
			$billobj = "";		
			$billobj = new Billing_Functions();
			return $billobj;
		}

		public function creation_function_object() {
			$create_obj = "";		
			$create_obj = new Creation_functions();
			return $create_obj;
		}

		public function CheckDepartmentAlreadyExists($company_id, $store_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckDepartmentAlreadyExists($company_id, $store_name);
			return $result;
		}

		public function CheckStoreRoomAlreadyExists($company_id, $storeroom_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckStoreRoomAlreadyExists($company_id, $storeroom_name);
			return $result;
		}

		public function CheckEngineerCodeAlreadyExists($company_id, $engineer_code) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckEngineerCodeAlreadyExists($company_id, $engineer_code);
			return $result;
		}

		public function CheckEngineerMobileAlreadyExists($company_id, $mobile_number) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckEngineerMobileAlreadyExists($company_id, $mobile_number);
			return $result;
		}
		
		public function PaymentlinkedParty($party_id){
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->PaymentlinkedParty($party_id);
			return $result;
		}

		public function PartyMobileExists($mobile_number) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->PartyMobileExists($mobile_number);
			return $result;
		}

		public function GetScreenPartyList($bill_company_id,$party_type) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetScreenPartyList($bill_company_id,$party_type);
			return $result;
		}

		public function GetRoleLinkedCount($role_id) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->GetRoleLinkedCount($role_id);
			return $result;
		}
		
		public function CheckPaymentModeAlreadyExists($company_id, $payment_mode_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckPaymentModeAlreadyExists($company_id, $payment_mode_name);
			return $result;
		}

		public function attendance_function_object() {
            $billobj = "";      
            $billobj = new Attendance_Functions();
            return $billobj;
        }

        public function DailyWorkerDetails() {
            $result = "";
            $billobj = "";
            $billobj = $this->attendance_function_object();
            $result = $billobj->DailyWorkerDetails();
            return $result;
        }

        public function getPrevAttendanceID($attendance_date) {
            $result = "";
            $billobj = "";
            $billobj = $this->attendance_function_object();
            $result = $billobj->getPrevAttendanceID($attendance_date);
            return $result;
        }

        public function AttendanceEngineerID($edit_id, $engineer_ids, $attendance_date) {
            $result = "";
            $billobj = "";
            $billobj = $this->attendance_function_object();
            $result = $billobj->AttendanceEngineerID($edit_id, $engineer_ids, $attendance_date);
            return $result;
        }

        public function EngineerAttendanceList($from_date,$to_date)  {
            $result = "";
            $billobj = "";
            $billobj = $this->attendance_function_object();
            $result = $billobj->EngineerAttendanceList($from_date,$to_date) ;
            return $result;
        }

        public function AttendanceDetails($type, $attendance_date)  {
            $result = "";
            $billobj = "";
            $billobj = $this->attendance_function_object();
            $result = $billobj->AttendanceDetails($type, $attendance_date) ;
            return $result;
        }

		public function payment_function_object() {
			$payment_obj = "";		
			$payment_obj = new Payment_functions();
			return $payment_obj;
		}

		public function UpdateBalance($bill_company_id,$bill_id,$bill_number,$bill_date,$bill_type,$customer_id,$customer_name,$customer_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$opening_balance,$opening_balance_type,$credit,$debit) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->UpdateBalance($bill_company_id,$bill_id,$bill_number,$bill_date,$bill_type,$customer_id,$customer_name,$customer_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$opening_balance,$opening_balance_type,$credit,$debit);
			return $list;
		}

		public function DeletePayment($bill_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$result = "";
			$result = $payment_obj->DeletePayment($bill_id);
			return $result;
		}

		public function getPendingList($party_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getPendingList($party_id);
			return $list;
		}

		public function getPartyOpeningBalanceInPaymentExist($party_id, $bill_type) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getPartyOpeningBalanceInPaymentExist($party_id, $bill_type);
			return $list;
		}

		public function getAdvanceVoucherList($bill_company_id,$from_date, $to_date, $show_bill, $filter_employee_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getAdvanceVoucherList($bill_company_id,$from_date, $to_date, $show_bill, $filter_employee_id);
			return $list;
		}

		public function getAdvanceLinkedCount($bill_company_id,$employee_id,$advance_voucher_amount) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$result = "";
			$result = $payment_obj->getAdvanceLinkedCount($bill_company_id,$employee_id,$advance_voucher_amount);
			return $result;
		}

		public function BillCompanyDetails($bill_company_id, $table) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$bill_company_details = "";
			$bill_company_details = $create_obj->BillCompanyDetails($bill_company_id, $table);
			return $bill_company_details;
		}
		public function getPartyList($party_type) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getPartyList($party_type);
			return $list;
		}	
		public function getPurchaseList($from_date, $to_date,$show_bill,$party_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getPurchaseList($from_date, $to_date,$show_bill,$party_id);
			return $list;
		}
		public function stock_function_object() {
			$stock_obj = "";		
			$stock_obj = new Stock_functions();
			return $stock_obj;
		}		
		public function StockUpdate($page_table,$in_out_type,$bill_unique_id,$bill_unique_number,$product_id,$remarks, $stock_date, $store_id, $unit_id, $quantity,$party_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->StockUpdate($page_table,$in_out_type,$bill_unique_id,$bill_unique_number,$product_id,$remarks, $stock_date, $store_id, $unit_id, $quantity,$party_id);
			return $stock_update;
		}
		public function getStockUniqueID($bill_unique_id,$store_id, $product_id, $unit_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->getStockUniqueID($bill_unique_id,$store_id, $product_id, $unit_id);
			return $stock_update;			
		}
		public function PrevStockList($bill_unique_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->PrevStockList($bill_unique_id);
			return $stock_update;
		}
		public function DeletePurchaseInvoice($bill_unique_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->DeletePurchaseInvoice($bill_unique_id);
			return $list;
		}	
		public function getInwardQty($bill_unique_id,$store_id,$product_id,$unit_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->getInwardQty($bill_unique_id,$store_id,$product_id,$unit_id);
			return $stock_update;
		}
		public function getOutwardQty($bill_unique_id,$store_id,$product_id,$unit_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->getOutwardQty($bill_unique_id,$store_id,$product_id,$unit_id);
			return $stock_update;
		}	
		public function salary_function_object() {
			$salary_obj = "";		
			$salary_obj = new Salary_functions();
			return $salary_obj;
		}

		public function EngineerSalaryDetails($from_date,$to_date) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->EngineerSalaryDetails($from_date,$to_date);
			return $result;
		}

		public function EngineerWorkingDays($engineer_id,$edit_id,$from_date,$to_date) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->EngineerWorkingDays($engineer_id,$edit_id,$from_date,$to_date);
			return $result;
		}


		public function EngineerSalaryList($from_date,$to_date) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->EngineerSalaryList($from_date,$to_date);
			return $result;
		}

		public function SalariedEngineer($engineer_ids,$salary_id,$from_date,$to_date,$voucher_advance_amount, $original_advance) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->SalariedEngineer($engineer_ids,$salary_id,$from_date,$to_date,$voucher_advance_amount, $original_advance);
			return $result;
		}

		public function SalariedEngineerList($from_date,$to_date,$engineer_ids) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->SalariedEngineerList($from_date,$to_date,$engineer_ids);
			return $result;
		}

		public function EngineerList() {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->EngineerList();
			return $result;
		}

		public function UpdateEngineerAdavncePlus($engineer_id,$total_amount) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->UpdateEngineerAdavncePlus($engineer_id,$total_amount);
			return $result;
		}

		public function UpdateEngineerAdvanceMinus($advance_voucher_engineer_id,$advance_voucher_amount) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->UpdateEngineerAdvanceMinus($advance_voucher_engineer_id,$advance_voucher_amount);
			return $result;
		}

		public function getSalariedEngineerDate($engineer_id) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->getSalariedEngineerDate($engineer_id);
			return $result;
		}

		

		public function CalculateSalary($from_date, $to_date, $engineer_id) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->CalculateSalary($from_date, $to_date, $engineer_id);
			return $result;
		}

		public function EngineerOtHours($from_date, $to_date, $engineer_id) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->EngineerOtHours($from_date, $to_date, $engineer_id);
			return $result;
		}
		
		public function getOriginalAdvance($engineer_id, $salary_id) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->getOriginalAdvance($engineer_id, $salary_id);
			return $result;
		}

		public function AttendanceCount($from_date, $to_date, $engineer_id) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->AttendanceCount($from_date, $to_date, $engineer_id);
			return $result;
		}

		public function GetSalaryVoucherUniqueID($engineer_id, $salary_id) {
			$salary_obj = "";
			$salary_obj = $this->salary_function_object();
			$result = "";
			$result = $salary_obj->GetSalaryVoucherUniqueID($engineer_id, $salary_id);
			return $result;
		}

		public function report_function_object() {
			$report_obj = "";		
			$report_obj = new Report_functions();
			return $report_obj;
		}

		public function getStockReportList($from_date,$to_date,$product_id,$store_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getStockReportList($from_date,$to_date,$product_id,$store_id);
			return $list;
		}
		

		public function DeleteProduct($bill_unique_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->DeleteProduct($bill_unique_id);
			return $list;
		}
		
		public function getJobCardList($from_date, $to_date,$show_bill,$party_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getJobCardList($from_date, $to_date,$show_bill,$party_id);
			return $list;
		}
		public function getStoreEntryList($from_date, $to_date,$show_bill,$party_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getStoreEntryList($from_date, $to_date,$show_bill,$party_id);
			return $list;
		}

		public function DeleteStoreEntry($bill_unique_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->DeleteStoreEntry($bill_unique_id);
			return $list;
		}

		public function getMaterialTransferList($from_date, $to_date, $from_store,$to_store,$show_bill) {
            $stock_obj = "";
            $stock_obj = $this->stock_function_object();
            $result = "";
            $result = $stock_obj->getMaterialTransferList($from_date, $to_date, $from_store,$to_store,$show_bill);
            return $result;
        }
		public function DeleteMaterialTransfer($bill_unique_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->DeleteMaterialTransfer($bill_unique_id);
			return $list;
		}
		public function getStockAdjustmentList($from_date, $to_date,$show_bill,$product_id,$store_id) {
            $stock_obj = "";
            $stock_obj = $this->stock_function_object();
            $result = "";
            $result = $stock_obj->getStockAdjustmentList($from_date, $to_date,$show_bill,$product_id,$store_id);
            return $result;
        }
		public function DeleteStockAdjustment($bill_unique_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$list = array();
			$list = $stock_obj->DeleteStockAdjustment($bill_unique_id);
			return $list;
		}

		public function getJobCardPartyList($page) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getJobCardPartyList($page);
			return $list;
		}
		public function getVehicleList($party_id,$page) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getVehicleList($party_id,$page);
			return $list;
		}
		public function getProductSalesData($party_id, $vehicle_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getProductSalesData($party_id, $vehicle_id);
			return $list;
		}
		public function getSalesList($from_date, $to_date,$show_bill,$party_id,$page) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getSalesList($from_date, $to_date,$show_bill,$party_id,$page);
			return $list;
		}

		public function getVoucherList($from_date, $to_date, $show_bill, $filter_party_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getVoucherList($from_date, $to_date, $show_bill, $filter_party_id);
			return $list;
		}
		public function getReceiptList($from_date, $to_date, $show_bill, $filter_party_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getReceiptList($from_date, $to_date, $show_bill, $filter_party_id);
			return $list;
		}
		public function getPaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_id,$filter_payment_mode_id,$filter_bank_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getPaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_id,$filter_payment_mode_id,$filter_bank_id);
			return $list;
		}

		public function RevoteJobCard($page,$bill_unique_id){
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->RevoteJobCard($page,$bill_unique_id);
			return $list;
		}

		public function GetPurchaseEntryReport($bill_company_id,$filter_party_id,$from_date, $to_date) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->GetPurchaseEntryReport($bill_company_id,$filter_party_id,$from_date, $to_date);
			return $list;
		}

		public function GetPurchaseTaxReport($filter_party_id,$from_date, $to_date) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->GetPurchaseTaxReport($filter_party_id,$from_date, $to_date);
			return $list;
		}

		public function balance_report($bill_company_id, $party_id,$from_date, $to_date) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->balance_report($bill_company_id, $party_id,$from_date, $to_date);
			return $list;
		}

		public function getOpeningBalance($party_id, $from_date, $to_date, $bill_company_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getOpeningBalance($party_id, $from_date, $to_date, $bill_company_id);
			return $list;
		}
		public function GetSalesEntryReport($bill_company_id,$filter_party_id,$from_date, $to_date) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->GetSalesEntryReport($bill_company_id,$filter_party_id,$from_date, $to_date);
			return $list;
		}
		public function GetSalesTaxReport($filter_party_id,$from_date, $to_date) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->GetSalesTaxReport($filter_party_id,$from_date, $to_date);
			return $list;
		}
		public function getDayBookPaymentReportList($from_date, $filter_party_id, $bill_type) {
			$reportobj = "";
			$reportobj = $this->report_function_object();
			$list = array();
			$list = $reportobj->getDayBookPaymentReportList($from_date, $filter_party_id, $bill_type);
			return $list;
		}

		public function getSalesRecords($page, $sales_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getSalesRecords($page, $sales_id);
			return $list;
		}
		public function getVehicleHistory($vehicle_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getVehicleHistory($vehicle_id);
			return $list;
		}
	}
?>