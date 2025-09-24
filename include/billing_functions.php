<?php
    class Billing_Functions extends Basic_Functions {
		public function CheckUnitNameAlreadyExists($bill_company_id, $unit_name) {
			$list = array(); $select_query = ""; $unit_id = "";
			if(!empty($bill_company_id) && !empty($unit_name)) {
				$select_query = "SELECT unit_id FROM ".$GLOBALS['unit_table']." WHERE lower_case_name = '".$unit_name."' AND deleted = '0'";	
			}
			//echo $select_query;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['unit_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['unit_id'])) {
							$unit_id = $data['unit_id'];
						}
					}
				}
			}
			return $unit_id;
		}
		public function CheckProductCodeAlreadyExists($bill_company_id, $product_code) {
			$list = array(); $select_query = ""; $product_id = "";
			if(!empty($bill_company_id) && !empty($product_code)) {
				$select_query = "SELECT product_id FROM ".$GLOBALS['product_table']." WHERE bill_company_id = '".$bill_company_id."' AND product_code = '".$product_code."' AND deleted = '0'";	
			}
			//echo $select_query;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['product_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['product_id'])) {
							$product_id = $data['product_id'];
						}
					}
				}
			}
			return $product_id;
		}

		public function CheckProductNameAlreadyExists($bill_company_id, $product_name) {
			$list = array(); $select_query = ""; $product_id = "";
			if(!empty($bill_company_id) && !empty($product_name)) {
				$select_query = "SELECT product_id FROM ".$GLOBALS['product_table']." WHERE bill_company_id = '".$bill_company_id."' AND lower_case_name = '".$product_name."' AND deleted = '0'";	
			}
			//echo $select_query;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['product_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['product_id'])) {
							$product_id = $data['product_id'];
						}
					}
				}
			}
			return $product_id;
		}

		public function BillCompanyDetails($bill_company_id, $table) {
			$bill_company_details = "";
			if(!empty($bill_company_id)) {
				$check_company = array();
				$check_company = $this->getTableRecords($GLOBALS['company_table'], '','');
				if(!empty($check_company)) {
					foreach($check_company as $data) {
						/*if(!empty($table) && $table == $GLOBALS['invoice_table']) {
							if(!empty($data['invoice_company_name'])) {
								$bill_company_details = $this->encode_decode('decrypt', $data['invoice_company_name']);
							}
							if(!empty($data['invoice_address'])) {
								$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['invoice_address']);
							}
						}
						else {*/
							if(!empty($data['name'])) {
								$bill_company_details = $this->encode_decode('decrypt', $data['name']);
							}
							if(!empty($data['address'])) {
								$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['address']);
							}
						//}
						if(!empty($data['state'])) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['state']);
						}
						if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['mobile_number']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['email']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['gst_number']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
					}
				}
				if(!empty($bill_company_details)) {
					$bill_company_details = $this->encode_decode('encrypt', $bill_company_details);
				}
			}
			return $bill_company_details;
		}
	

		public function PartyDetails($party_id) {
			$party_details = "";
			if(!empty($party_id)) {
				$check_party = array();
				$check_party = $this->getTableRecords($GLOBALS['purchase_party_table'], 'purchase_party_id', $party_id);
				if(!empty($check_party)) {
					foreach($check_party as $data) {
						if(!empty($data['name'])) {
							$party_details = $this->encode_decode('decrypt', $data['name']);
						}
						if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
							$party_details = $party_details."$$$".$this->encode_decode('decrypt', $data['address']);
						}
						if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
							$party_details = $party_details."$$$".$this->encode_decode('decrypt', $data['city']);
						}
						if(!empty($data['state'])) {
							$party_details = $party_details."$$$".$this->encode_decode('decrypt', $data['state']);
						}
						if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
							$party_details = $party_details."$$$".$this->encode_decode('decrypt', $data['mobile_number']);
						}
						else {
							$party_details = $party_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
							$party_details = $party_details."$$$".$this->encode_decode('decrypt', $data['email']);
						}
						else {
							$party_details = $party_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']) {
							$party_details = $party_details."$$$".$this->encode_decode('decrypt', $data['gst_number']);
						}
						else {
							$party_details = $party_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
							$party_details = $party_details."$$$".$this->encode_decode('decrypt', $data['identification']);
						}
						else {
							$party_details = $party_details."$$$".$GLOBALS['null_value'];
						}
					}
				}
				if(!empty($party_details)) {
					$party_details = $this->encode_decode('encrypt', $party_details);
				}
			}
			return $party_details;
		}

    }
?>