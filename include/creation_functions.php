<?php 
    class Creation_functions extends Basic_Functions {
        public function CheckDepartmentAlreadyExists($company_id, $department_name) {
			$list = array(); $select_query = ""; $department_id = ""; $where = "";
			if(!empty($bill_company_id)) {
				$where = " bill_company_id = '".$company_id."' AND ";
			}
			if(!empty($department_name)) {
				$select_query = "SELECT department_id FROM ".$GLOBALS['department_table']." WHERE ".$where." lower_case_name = '".$department_name."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['department_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['department_id'])) {
							$department_id = $data['department_id'];
						}
					}
				}
			}
			return $department_id;
		}

		public function CheckStoreRoomAlreadyExists($company_id, $store_room_name) {
			$list = array(); $select_query = ""; $store_room_id = ""; $where = "";
			if(!empty($bill_company_id)) {
				$where = " bill_company_id = '".$company_id."' AND ";
			}
			if(!empty($store_room_name)) {
				$select_query = "SELECT store_room_id FROM ".$GLOBALS['store_room_table']." WHERE ".$where." lower_case_name = '".$store_room_name."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['store_room_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['store_room_id'])) {
							$store_room_id = $data['store_room_id'];
						}
					}
				}
			}
			return $store_room_id;
		}

		public function CheckEngineerCodeAlreadyExists($company_id, $engineer_code) {
			$list = array(); $select_query = ""; $engineer_id = ""; $where = "";
			if(!empty($bill_company_id)) {
				$where = " bill_company_id = '".$company_id."' AND ";
			}
			if(!empty($engineer_code)) {
				$select_query = "SELECT engineer_id FROM ".$GLOBALS['engineer_table']." WHERE ".$where." engineer_code = '".$engineer_code."' AND deleted = '0'";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['engineer_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['engineer_id'])) {
							$engineer_id = $data['engineer_id'];
						}
					}
				}
			}
			return $engineer_id;
		}

		public function CheckEngineerMobileAlreadyExists($company_id, $mobile_number) {
			$list = array(); $select_query = ""; $engineer_id = ""; $where = "";
			if(!empty($bill_company_id)) {
				$where = " bill_company_id = '".$company_id."' AND ";
			}
			if(!empty($mobile_number)) {
				$select_query = "SELECT engineer_id FROM ".$GLOBALS['engineer_table']." WHERE ".$where." mobile_number = '".$mobile_number."' AND deleted = '0'";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['engineer_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['engineer_id'])) {
							$engineer_id = $data['engineer_id'];
						}
					}
				}
			}
			return $engineer_id;
		}

		public function PaymentlinkedParty($party_id){
			$list = array(); $select_query = "";  $count = 0;
			if(!empty($party_id)){
				$where = " FIND_IN_SET('" . $party_id . "', party_id) AND ";
			}

			if(!empty($where)){
				$select_query = "SELECT count(id) as id_count FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " bill_type !='Party Opening Balance' AND deleted = '0'";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}

		public function PartyMobileExists($mobile_number) {
			$list = array(); $select_query = ""; $party_id = ""; $where = "";
			
			if(!empty($mobile_number)) {
				$select_query = "SELECT party_id FROM ".$GLOBALS['party_table']." WHERE mobile_number = '".$mobile_number."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['party_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['party_id'])) {
							$party_id = $data['party_id'];
						}
					}
				}
			}
			return $party_id;
		}

		public function GetScreenPartyList($bill_company_id,$party_type){
			$list = array(); $select_query = ""; $where = ""; 

			if(!empty($bill_company_id)){
				$where = "bill_company_id = '".$bill_company_id."'";
			}
			
			if(!empty($party_type)){
				if(!empty($where)) {
					$where = $where." AND party_type = '".$party_type."'";
				}
				else {
					$where = "party_type = '".$party_type."'";
				}
			}
			
			
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['party_table']." WHERE ".$where." AND deleted='0' ORDER BY id DESC";    
			} else {
				$select_query = "SELECT * FROM ".$GLOBALS['party_table']." WHERE deleted='0' ORDER BY id DESC";
			}

			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['party_table'], $select_query);
			}
			
			return $list;
		}

		public function GetRoleLinkedCount($role_id) {
			$list = array(); $select_query = ""; $count = 0;
			if(!empty($role_id)) {
				$select_query = "SELECT id_count FROM ((SELECT count(id) as id_count FROM ".$GLOBALS['user_table']." WHERE FIND_IN_SET('".$role_id."', role_id) AND deleted = '0')) as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}

		
		public function CheckPaymentModeAlreadyExists($company_id, $payment_mode_name) {
			$list = array(); $select_query = ""; $payment_mode_id = ""; $where = "";
			if(!empty($bill_company_id)) {
				$where = " bill_company_id = '".$company_id."' AND ";
			}
			if(!empty($payment_mode_name)) {
				$select_query = "SELECT payment_mode_id FROM ".$GLOBALS['payment_mode_table']." WHERE ".$where." lower_case_name = '".$payment_mode_name."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['payment_mode_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['payment_mode_id'])) {
							$payment_mode_id = $data['payment_mode_id'];
						}
					}
				}
			}
			return $payment_mode_id;
		}

		 public function BillCompanyDetails($bill_company_id, $table) {
			$bill_company_details = "";
			if(!empty($bill_company_id)) {
				$check_company = array();
				$check_company = $this->getTableRecords($GLOBALS['company_table'], 'company_id', $bill_company_id,'');
				if(!empty($check_company)) {
					foreach($check_company as $data) {
						
						if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
							$bill_company_details = $this->encode_decode('decrypt', $data['name']);
						}
						if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['address']);
						}
						if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['state']);
						}
						if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['district']);
						}
						if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['city']);
						}
						if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['mobile_number']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$data['email'];
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['gst_in']) && $data['gst_in'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$"."GST IN : ".$this->encode_decode('decrypt', $data['gst_in']);
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
		public function getPartyList($type) {
			$select_query = ''; $where = '';
			if(!empty($type)) {
				if($type == '1' || $type == '2') {
					$where = "(party_type = '" .$type."' OR party_type = '3')";
				} else {
					$where = "party_type = '" .$type."'";
				}
			}

			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['party_table']." WHERE ".$where." AND deleted = '0' ORDER BY id DESC";
			} 
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['party_table']." WHERE deleted = '0' ORDER BY id DESC";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['party_table'], $select_query);
			}
			return $list;
		} 
		public function getPurchaseList($from_date, $to_date,$show_bill,$party_id) {
            $list = array(); $select_query = ""; $where = "";
            $bill_company_id = $GLOBALS['bill_company_id'];
            if(!empty($bill_company_id)) {
				$where = "bill_company_id = '".$bill_company_id."' ";
			}
            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where." AND purchase_entry_date >= '".$from_date."'";
                }
                else {
                    $where = "purchase_entry_date >= '".$from_date."'";
                }
            }
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where." AND purchase_entry_date <= '".$to_date."'";
                }
                else {
                    $where = "purchase_entry_date <= '".$to_date."'";
                }
            }
            if($show_bill == '0' || $show_bill == '1'){
                if(!empty($where)) {
                    $where = $where." AND deleted = '".$show_bill."' ";
                }
                else {
                    $where = "deleted = '".$show_bill."' ";
                }
            }

			if(!empty($party_id))
			{
				if(!empty($where)){
					$where = $where." AND party_id = '".$party_id."' ";
				}
				else
				{
					$where = "party_id = '".$party_id."' ";
				}
			}
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['purchase_entry_table']." WHERE ".$where." ORDER BY id DESC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['purchase_entry_table']." WHERE ORDER BY id DESC";
			}
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['purchase_entry_table'], $select_query);
            }
            return $list;
        }
		public function getJobCardList($from_date, $to_date,$show_bill,$party_id) {
            $list = array(); $select_query = ""; $where = "";
            $bill_company_id = $GLOBALS['bill_company_id'];
            if(!empty($bill_company_id)) {
				$where = "bill_company_id = '".$bill_company_id."' ";
			}
            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where." AND job_card_date >= '".$from_date."'";
                }
                else {
                    $where = "job_card_date >= '".$from_date."'";
                }
            }
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where." AND job_card_date <= '".$to_date."'";
                }
                else {
                    $where = "job_card_date <= '".$to_date."'";
                }
            }
            if($show_bill == '0' || $show_bill == '1'){
                if(!empty($where)) {
                    $where = $where." AND deleted = '".$show_bill."' ";
                }
                else {
                    $where = "deleted = '".$show_bill."' ";
                }
            }

			if(!empty($party_id))
			{
				if(!empty($where)){
					$where = $where." AND party_id = '".$party_id."' ";
				}
				else
				{
					$where = "party_id = '".$party_id."' ";
				}
			}
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['job_card_table']." WHERE ".$where." ORDER BY id DESC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['job_card_table']." WHERE ORDER BY id DESC";
			}
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['job_card_table'], $select_query);
            }
            return $list;
        }

		public function getStoreEntryList($from_date, $to_date,$show_bill,$job_card_id) {
            $list = array(); $select_query = ""; $where = "";
            $bill_company_id = $GLOBALS['bill_company_id'];
            if(!empty($bill_company_id)) {
				$where = "bill_company_id = '".$bill_company_id."' ";
			}
            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where." AND store_entry_date >= '".$from_date."'";
                }
                else {
                    $where = "store_entry_date >= '".$from_date."'";
                }
            }
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where." AND store_entry_date <= '".$to_date."'";
                }
                else {
                    $where = "store_entry_date <= '".$to_date."'";
                }
            }
            if($show_bill == '0' || $show_bill == '1'){
                if(!empty($where)) {
                    $where = $where." AND deleted = '".$show_bill."' ";
                }
                else {
                    $where = "deleted = '".$show_bill."' ";
                }
            }

			if(!empty($job_card_id))
			{
				if(!empty($where)){
					$where = $where." AND job_card_id = '".$job_card_id."' ";
				}
				else
				{
					$where = "job_card_id = '".$job_card_id."' ";
				}
			}
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['store_entry_table']." WHERE ".$where." ORDER BY id DESC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['store_entry_table']." WHERE ORDER BY id DESC";
			}
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['store_entry_table'], $select_query);
            }
            return $list;
        }

		public function getJobCardPartyList($page) {
			$select_query = ''; $list = array();

			$select_query = "SELECT party_id, party_name_mobile_city FROM " . $GLOBALS['job_card_table'] . " WHERE deleted = '0' AND ".$page."_status = '0' GROUP BY party_id";
			if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['job_card_table'], $select_query);
            }
			
            return $list;
		}

		public function getVehicleList($party_id,$page) {
			$list = array(); $select_query = ''; $where = '';

			if(!empty($party_id)) {
				$select_query = "SELECT vehicle_id,vehicle_no,vehicle_details FROM " . $GLOBALS['job_card_table'] . " WHERE party_id = '". $party_id ."' AND deleted = '0' AND ".$page."_status = '0' GROUP BY vehicle_id";
				if(!empty($select_query)) {
					$list = $this->getQueryRecords($GLOBALS['job_card_table'], $select_query);
				}
			}
			return $list;
		}

		public function getProductSalesData($party_id, $vehicle_id) {
			$list = array(); $select_query = ''; $final_data = array();
			if(!empty($party_id) && $vehicle_id) {
				$select_query = "SELECT * FROM " . $GLOBALS['job_card_table'] . " WHERE party_id = '". $party_id ."' AND vehicle_id = '". $vehicle_id ."' AND deleted = '0' AND invoice_status ='0' GROUP BY job_card_id";
				if(!empty($select_query)) {
					$list = $this->getQueryRecords($GLOBALS['job_card_table'], $select_query);
				}

				if(!empty($list)) {
					foreach ($list as $data) {
						if(!empty($data['job_card_id'])) {
							$job_card_id = $data['job_card_id'];
						}
						if(!empty($data['job_card_number'])) {
							$job_card_number = $data['job_card_number'];
						}

						$details = array();

						$select_query = "SELECT * FROM " . $GLOBALS['store_entry_table'] . " WHERE job_card_id = '" . $job_card_id . "' AND deleted = '0'";
						if(!empty($select_query)) {
							$details = $this->getQueryRecords($GLOBALS['store_entry_table'], $select_query);
						}
						$final_data[] = [
							"job_card_id" => $job_card_id,
							"job_card_number" => $job_card_number,
							"store_details" => $details
						];
						
					}
				}
			}
			return $final_data;
		}

		public function getSalesList($from_date, $to_date,$show_bill,$party_id,$page) {
            $list = array(); $select_query = ""; $where = "";
            $bill_company_id = $GLOBALS['bill_company_id'];
            if(!empty($bill_company_id)) {
				$where = "bill_company_id = '".$bill_company_id."' ";
			}
            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where." AND ".$page."_date >= '".$from_date."'";
                }
                else {
                    $where = "".$page."_date >= '".$from_date."'";
                }
            }
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where." AND ".$page."_date <= '".$to_date."'";
                }
                else {
                    $where = "".$page."_date <= '".$to_date."'";
                }
            }
            if($show_bill == '0' || $show_bill == '1'){
                if(!empty($where)) {
                    $where = $where." AND deleted = '".$show_bill."' ";
                }
                else {
                    $where = "deleted = '".$show_bill."' ";
                }
            }

			if(!empty($party_id))
			{
				if(!empty($where)){
					$where = $where." AND party_id = '".$party_id."' ";
				}
				else
				{
					$where = "party_id = '".$party_id."' ";
				}
			}
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS[$page.'_table']." WHERE ".$where." ORDER BY id DESC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS[$page.'_table']." WHERE ORDER BY id DESC";
			}
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS[$page.'_table'], $select_query);
            }
            return $list;
        }

		public function RevoteJobCard($page,$bill_unique_id) {
			$select_query = ''; $list = array();
			$select_query = "SELECT * FROM ". $GLOBALS['job_card_table'] . " WHERE ".$page."_id = '".$bill_unique_id."' AND deleted = '0'";

			if(!empty($select_query)) {
				$list =  $this->getQueryRecords($GLOBALS['job_card_table'], $select_query);
				$columns = array(); $values = array();			
                $columns = array($page."_id",$page."_status");
                $values = array("'".$GLOBALS['null_value']."'","'0'");
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['id'])) {
                			$msg = $this->UpdateSQL($GLOBALS['job_card_table'], $data['id'], $columns, $values, 'revote '.$page);
						}
					}
				}
			}
		}
		public function getSalesRecords($page, $unique_id) {
			$list = array(); $select_query = ""; $where = ""; $table = "";
			if(!empty($unique_id)) {
				if($page == 'estimate') {
					$table = $GLOBALS['estimate_table'];
				} else if($page == 'quotation') {
					$table = $GLOBALS['quotation_table'];
				} else if($page == 'invoice') {
					$table = $GLOBALS['invoice_table'];
				}
				if(!empty($table)) {
					$where = " ".$page."_id = '".$unique_id."'";
					$select_query = "SELECT * FROM ".$table." WHERE ".$where;
				}
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($table, $select_query);
			}
			return $list;
		}
		public function getVehicleHistory($vehicle_id) {
			$list = array(); $select_query = ''; $final_data = array(); $where = '';
			
			if(!empty($vehicle_id)) {
				if(!empty($where)) {
					$where .= " AND vehicle_id = '" . $vehicle_id ."'"; 
				} else {
					$where = " vehicle_id = '" . $vehicle_id ."'";
				}
			}
			
			$select_query = "SELECT * FROM " . $GLOBALS['job_card_table'] . " WHERE ". $where ." AND deleted = '0' GROUP BY job_card_id";
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['job_card_table'], $select_query);
			}

			if(!empty($list)) {
				foreach ($list as $data) {
					if(!empty($data['job_card_id'])) {
						$job_card_id = $data['job_card_id'];
					}
					if(!empty($data['job_card_number'])) {
						$job_card_number = $data['job_card_number'];
					}
					if(!empty($data['job_card_date'])) {
						$job_card_date = date('Y-m-d', strtotime($data['job_card_date']));
					}
					if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
						$party_id = $data['party_id'];
					}
					if(!empty($data['department_id']) && $data['department_id'] != $GLOBALS['null_value']) {
						$department_id = $data['department_id'];
					}
					if(!empty($data['department_name']) && $data['department_name'] != $GLOBALS['null_value']) {
						$department_name = $data['department_name'];
					}
					if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']) {
						$engineer_id = $data['engineer_id'];
					}
					if(!empty($data['work_details']) && $data['work_details'] != $GLOBALS['null_value']) {
						$work_details = $data['work_details'];
					}

					$details = array();

					$select_query = "SELECT * FROM " . $GLOBALS['store_entry_table'] . " WHERE job_card_id = '" . $job_card_id . "' AND deleted = '0'";
					if(!empty($select_query)) {
						$details = $this->getQueryRecords($GLOBALS['store_entry_table'], $select_query);
					}
					$final_data[] = [
						"job_card_id" => $job_card_id,
						"job_card_number" => $job_card_number,
						"job_card_date" => $job_card_date,
						"party_id" => $party_id,
						"department_id" => $department_id,
						"department_name" => $department_name,
						"engineer_id" => $engineer_id,
						"work_details" => $work_details,
						"store_details" => $details
					];
					
				}
			}
			return $final_data;
		}
		public function setClearTableRecords($tables) {
			$success = 0; $con = $this->connect();
			if(!empty($tables)) {
				foreach($tables as $table) {
					if(!empty($table)) {
						if($table == $GLOBALS['product_table']) {
							$list = array(); $success++;
							$list = $this->getTableRecords($GLOBALS['product_table'], '', '', '');
							if(!empty($list)) {
								foreach($list as $data) {
									$linked_count = 0;
									if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
										$linked_count = '0';
										if($linked_count == '0') {
											$columns = array(); 
											$values = array();
											$columns = array('deleted'); 
											$values = array("'1'");
											$product_update_id = $this->UpdateSQL($GLOBALS['product_table'], $data['id'], $columns, $values, '');
										}
									}
								}
							}
						}
						else {
							$table = trim(str_replace("'", "", $table));
							$update_query = "";
							$update_query = "UPDATE ".$table." SET deleted = '1'";
							if(!empty($update_query)) {							
								$result = $con->prepare($update_query);
								if($result->execute() === TRUE) {
									$success++;	
								}
							}
						}
					}
				}
				if($success == count($tables)) {
					$success = 1;
				}
				else {
					$success = "Unable to clear";
				}
			}
			return $success;
		}
    }
?>