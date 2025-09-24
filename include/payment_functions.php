<?php 
    class Payment_Functions extends Basic_Functions {
        
		public function DeletePayment($bill_id){
			$payment_bill_list = array(); $payment_unique_id = "";

            $payment_bill_list = $this->getTableRecords($GLOBALS['payment_table'], 'bill_id', $bill_id,'');
            if(!empty($payment_bill_list)){
                foreach($payment_bill_list as $value){
                    if(!empty($value['id'])){
                        $payment_unique_id = $value['id'];
                    }
                    if(preg_match("/^\d+$/", $payment_unique_id)) {
                        $action = "Payment Deleted.";
                    
                        $columns = array(); $values = array();						
                        $columns = array('deleted');
                        $values = array("'1'");
                        $msg = $this->UpdateSQL($GLOBALS['payment_table'], $payment_unique_id, $columns, $values, $action);
                    }
                }
            }
		}

		public function getPendingList($party_id) {
        	$select_query = ""; $list = array();
			if(!empty($party_id)) {
				
				$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE (party_id = '" . $party_id . "') AND deleted = '0' ORDER BY bill_date ASC";
				
				$list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
			}
			return $list;
		}


		public function getPartyOpeningBalanceInPaymentExist($party_id, $bill_type) {
			$list = array(); $select_query = ""; $id = ""; $where = ""; $payment_id = "";
		
			if(!empty($party_id)){
				if(!empty($where)) {
					$where = $where." party_id = '".$party_id."' AND ";
				}
				else {
					$where = "party_id = '".$party_id."' AND ";
				}
			}
			if(!empty($bill_type)){
				if(!empty($where)) {
					$where = $where." bill_type = '".$bill_type."' AND ";
				}
				else {
					$where = "bill_type = '".$bill_type."' AND ";
				}
			}
			if(!empty($where)) {
				$select_query = "SELECT id FROM ".$GLOBALS['payment_table']." WHERE ".$where." deleted='0'";    
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
						$payment_id = $data['id'];
					}
				}
			}
			return $payment_id;
		}

		public function getAdvanceVoucherList($bill_company_id,$from_date, $to_date, $show_bill, $filter_engineer_id) {
            $list = array(); $select_query = ""; $where = "";

			if(!empty($bill_company_id)) {
				$where = " bill_company_id = '".$bill_company_id."'";
			}

            if(!empty($filter_engineer_id)) {
                if(!empty($where)) {
                    $where = $where." AND engineer_id = '".$filter_engineer_id."'";
                } 
                else {
                    $where = "engineer_id = '".$filter_engineer_id."'";
                }
            }
            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where." AND advance_voucher_date >= '".$from_date."'";
                } else {
                    $where = "advance_voucher_date >= '".$from_date."'";
                }
            }
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where." AND advance_voucher_date <= '".$to_date."'";
                } else {
                    $where = "advance_voucher_date <= '".$to_date."'";
                }
            }
            if($show_bill == '0' || $show_bill == '1') {
                if(!empty($where)) {
                    $where = $where." AND deleted = '".$show_bill."' ";
                } else {
                    $where = "deleted = '".$show_bill."' ";
                }
            }
            if(!empty($where)) {
                $select_query = "SELECT * FROM ".$GLOBALS['advance_voucher_table']." WHERE ".$where." ORDER BY id DESC";
            } 
            else {
                $select_query = "SELECT * FROM ".$GLOBALS['advance_voucher_table']." WHERE deleted = '0' ORDER BY id DESC";
            }
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['advance_voucher_table'], $select_query);
            }
            return $list;
        }

		public function getAdvanceLinkedCount($bill_company_id,$engineer_id,$advance_amount) {
            $select_query = ""; $list = array(); $linked_count = 0; $advance_query = ""; $advance_list = array(); $empl_advance_amount = 0;

			$advance_query = "SELECT advance_amount FROM ".$GLOBALS['engineer_table']." WHERE engineer_id = '".$engineer_id."' AND bill_company_id = '".$bill_company_id."' AND deleted = '0'";
			$advance_list = $this->getQueryRecords('', $advance_query);

			if(!empty($advance_list)) {
                foreach($advance_list as $alist) {
                    if(!empty($alist['advance_amount']) && $alist['advance_amount'] != $GLOBALS['null_value']) {
                        $empl_advance_amount = $alist['advance_amount'];
                    }
                }
            }

			if($empl_advance_amount < $advance_amount){
				$linked_count = 1;
			}

            // if(!empty($engineer_id)) {

            //     $select_query = "SELECT COUNT(id) as linked_count FROM ".$GLOBALS['salary_voucher_table']." WHERE bill_company_id = '".$bill_company_id."' AND engineer_id = '".$engineer_id."' AND advance_amount > 0 AND advance_amount != '".$GLOBALS['null_value']."' AND deleted = '0'";
            //     $list = $this->getQueryRecords('', $select_query);
            // }
            // if(!empty($list)) {
            //     foreach($list as $data) {
            //         if(!empty($data['linked_count']) && $data['linked_count'] != $GLOBALS['null_value']) {
            //             $linked_count = $data['linked_count'];
            //         }
            //     }
            // }

            return $linked_count;
        }

		public function UpdateBalance($bill_company_id,$bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,	$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$opening_balance,$opening_balance_type,$credit,$debit){
			$select_query = ""; $lists = array(); $unique_id = "";

			if($bill_type == "Purchase Entry" || $bill_type == "Sales Bill" || $bill_type == "Salary Voucher"){
				$select_query = "SELECT id FROM ".$GLOBALS['payment_table']." WHERE bill_company_id = '".$bill_company_id."' AND bill_id = '".$bill_id."' AND deleted = '0'";
			}
			elseif ($bill_type == 'Advance Voucher' || $bill_type == 'Receipt' || $bill_type == 'Voucher' || $bill_type == 'Salary Voucher') {
                $select_query = "SELECT id FROM ".$GLOBALS['payment_table']." WHERE bill_company_id = '".$bill_company_id."' AND bill_id = '".$bill_id."' AND payment_mode_id = '".$payment_mode_id."' AND (bank_id = 'NULL' OR bank_id = '".$bank_id."') AND deleted = '0'";
            }
			else {
				$select_query = "SELECT id FROM ".$GLOBALS['payment_table']." WHERE bill_company_id = '".$bill_company_id."' AND bill_id = '".$bill_id."' AND payment_mode_id = '".$payment_mode_id."' AND deleted = '0'";
			} 			
            
			$lists = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
			if(!empty($lists)) {
				foreach($lists as $data) {
					if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
						$unique_id = $data['id'];
					}
				}
			}
        
			$created_date_time = $GLOBALS['create_date_time_label'];
            $creator = $GLOBALS['creator'];
            $creator_name = $GLOBALS['creator_name'];
			if(preg_match("/^\d+$/", $unique_id)) {
				$action = "Updated Successfully";
				$columns = array(); $values = array();
				$columns = array('creator_name','bill_date','party_id','party_name','party_type','bank_id','bank_name','payment_mode_id','payment_mode_name','opening_balance','opening_balance_type','credit','debit');
				$values = array("'".$creator_name."'","'".$bill_date."'","'".$party_id."'","'".$party_name."'","'".$party_type."'","'".$bank_id."'","'".$bank_name."'","'".$payment_mode_id."'","'".$payment_mode_name."'","'".$opening_balance."'","'".$opening_balance_type."'","'".$credit."'","'".$debit."'");
				$payment_update_id = $this->UpdateSQL($GLOBALS['payment_table'], $unique_id, $columns, $values, $action);
			}
			else {
				$action = "Inserted Successfully";
				$null_value = $GLOBALS['null_value'];
				$columns = array(); $values = array();
				$columns = array('created_date_time','creator', 'creator_name', 'bill_company_id','bill_id','bill_number','bill_date','bill_type','party_id','party_name','party_type','bank_id','bank_name','payment_mode_id','payment_mode_name','opening_balance','opening_balance_type','credit','debit','deleted');
				$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'","'".$bill_id."'","'".$bill_number."'","'".$bill_date."'","'".$bill_type."'","'".$party_id."'","'".$party_name."'","'".$party_type."'","'".$bank_id."'","'".$bank_name."'","'".$payment_mode_id."'","'".$payment_mode_name."'","'".$opening_balance."'","'".$opening_balance_type."'","'".$credit."'","'".$debit."'","'0'");
				$payment_insert_id = $this->InsertSQL($GLOBALS['payment_table'], $columns, $values, '', '', $action);
			}
		}
		public function getVoucherList($from_date, $to_date, $show_bill, $filter_party_id) {
			$list = array(); $select_query = ""; $where = "";

			if(!empty($filter_party_id)) {
				$where = "party_id = '" . $filter_party_id . "'";
			}

			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where . " AND voucher_date >= '" . $from_date . "'";
				} else {
					$where = "voucher_date >= '" . $from_date . "'";
				}
			}

			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where . " AND voucher_date <= '" . $to_date . "'";
				} else {
					$where = "voucher_date <= '" . $to_date . "'";
				}
			}

			if($show_bill == '0' || $show_bill == '1') {
				if(!empty($where)) {
					$where = $where . " AND deleted = '" . $show_bill . "' ";
				} else {
					$where = "deleted = '" . $show_bill . "' ";
				}
			}

			if(!empty($where)) {
				$select_query = "SELECT * FROM " . $GLOBALS['voucher_table'] . " WHERE " . $where . " ORDER BY id DESC";
			} 
			else {
				$select_query = "SELECT * FROM " . $GLOBALS['voucher_table'] . " WHERE deleted = '0' ORDER BY id DESC";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['voucher_table'], $select_query);
			}
			return $list;
		}
		public function getReceiptList($from_date, $to_date, $show_bill, $filter_party_id) {
			$list = array(); $select_query = ""; $where = "";

			if(!empty($filter_party_id)) {
				$where = "party_id = '" . $filter_party_id . "'";
			}

			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where . " AND receipt_date >= '" . $from_date . "'";
				} else {
					$where = "receipt_date >= '" . $from_date . "'";
				}
			}

			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where . " AND receipt_date <= '" . $to_date . "'";
				} else {
					$where = "receipt_date <= '" . $to_date . "'";
				}
			}

			if($show_bill == '0' || $show_bill == '1') {
				if(!empty($where)) {
					$where = $where . " AND deleted = '" . $show_bill . "' ";
				} else {
					$where = "deleted = '" . $show_bill . "' ";
				}
			}

			if(!empty($where)) {
				$select_query = "SELECT * FROM " . $GLOBALS['receipt_table'] . " WHERE " . $where . " ORDER BY id DESC";
			} 
			else {
				$select_query = "SELECT * FROM " . $GLOBALS['receipt_table'] . " WHERE deleted = '0' ORDER BY id DESC";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['receipt_table'], $select_query);
			}
			return $list;
		}

	
    }
?>
