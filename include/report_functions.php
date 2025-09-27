<?php 
    class Report_functions extends Basic_Functions{

        public function getStockReportList($from_date,$to_date,$product_id,$store_id) {
			$select_query = ""; $list = array(); $where = "";$groupby="";

			
			if(!empty($store_id))
			{
				if(!empty($where))
				{
					$where .="store_id = '".$store_id."' AND "; 
				}
				else
				{
					$where = "store_id = '".$store_id."' AND ";
				}
			}
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." stock_date >= '".$from_date."'  AND";
				}
				else {
					$where = "stock_date >= '".$from_date."'  AND";
				}
			}

			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where."  stock_date <= '".$to_date."' AND";
				}
				else {
					$where = "stock_date <= '".$to_date."' AND";
				}
			}
			
			if(!empty($product_id)) {
				if(!empty($where)) {
					$where = $where." product_id = '".$product_id."' AND ";
				}
				else {
					$where = "product_id = '".$product_id."' AND ";
				}
			}
			if(!empty($party_id)) {
				if(!empty($where)) {
					$where = $where." party_id = '".$party_id."' AND ";
				}
				else {
					$where = "party_id = '".$party_id."' AND ";
				}
			}

			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['stock_table']." WHERE ".$where."  deleted = '0' ". (!empty($product_id) ? '' : 'GROUP BY product_id') ." ORDER BY id ASC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['stock_table']." WHERE deleted = '0' ". (!empty($product_id) ? '' : 'GROUP BY product_id') ." ORDER BY id ASC";
			}
			// echo $select_query;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['stock_table'], $select_query);
			}
			return $list;
		}

		public function getPaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_id,$payment_mode_id,$bank_id){
			$reports = array();
			$where ="";
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where . " AND bill_date >= '" . $from_date . "'";
				} else {
					$where = "bill_date >= '" . $from_date . "'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where . " AND bill_date <= '" . $to_date . "'";
				} else {
					$where = "bill_date <= '" . $to_date . "'";
				}
			}
			if(!empty($filter_party_id)){ 
				if(!empty($where)) {
					$where = $where . " AND party_id = '" . $filter_party_id . "' ";
				} else {
					$where = "party_id = '" . $filter_party_id . "'";
				}
			}
			if(!empty($filter_category_id)){ 
				if(!empty($where)) {
					$where = $where . " AND party_id = '" . $filter_category_id . "' ";
				} else {
					$where = "party_id = '" . $filter_category_id . "'";
				}
			}
			if(!empty($bank_id)){ 
				if(!empty($where)) {
					$where = $where . " AND bank_id = '" . $bank_id . "' ";
				} else {
					$where = "bank_id = '" . $bank_id . "'";
				}
			}
			if(!empty($payment_mode_id)){ 
				if(!empty($where)) {
					$where = $where . " AND payment_mode_id = '" . $payment_mode_id . "' ";
				} else {
					$where = "payment_mode_id = '" . $payment_mode_id . "'";
				}
			}
			if($filter_bill_type == 1) {
				if(!empty($where)) {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND bill_type = 'Voucher' AND deleted = '0' ORDER BY bill_date ASC";
				} else {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE bill_type = 'Voucher' AND deleted = '0' ORDER BY bill_date ASC";
				}
			} else if($filter_bill_type == 2) {
				if(!empty($where)) {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND bill_type = 'Receipt' AND deleted = '0' ORDER BY bill_date ASC"; 	
				} else {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE bill_type = 'Receipt' AND deleted = '0' ORDER BY bill_date ASC"; 	
				}
			} else if($filter_bill_type == 4) {
				if(!empty($where)) {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND bill_type = 'Salary Voucher' AND deleted = '0' ORDER BY bill_date ASC"; 	
				} else {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE bill_type = 'Salary Voucher' AND deleted = '0' ORDER BY bill_date ASC"; 	
				}
			}else if($filter_bill_type == 3) {
				if(!empty($where)) {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND bill_type = 'Advance Voucher' AND deleted = '0' ORDER BY bill_date ASC"; 	
				} else {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE bill_type = 'Advance Voucher' AND deleted = '0' ORDER BY bill_date ASC"; 	
				}
			}
			else {
				if(!empty($where)) {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND bill_number != '" . $GLOBALS['null_value'] . "' AND bill_type IN ('Voucher', 'Salary Voucher', 'Receipt', 'Advance Voucher')  AND deleted = '0' ORDER BY bill_date ASC";
				} else {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE bill_number != '" . $GLOBALS['null_value'] . "' AND bill_type IN ('voucher', 'Salary Voucher', 'Receipt', 'Advance Voucher')  AND deleted = '0' ORDER BY bill_date ASC";
				}
			}
			$reports = $this->getQueryRecords('', $select_query);
			return $reports;
		}
		public function GetPurchaseEntryReport($bill_company_id,$filter_party_id,$from_date, $to_date) {
			$list = array(); $select_query = ""; $where = ""; 

			$bill_company_id=$GLOBALS['bill_company_id'];
			
			if(!empty($bill_company_id)) {
				$where = "bill_company_id = '".$bill_company_id."'";
			}

			if(!empty($filter_party_id)) {
				if(!empty($where)) {
					$where = $where." AND party_id = '".$filter_party_id."'";
				}
				else {
					$where = "party_id = '".$filter_party_id."'";
				}
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

			$select_query = "";
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['purchase_entry_table']."  WHERE ".$where."  ORDER BY created_date_time ASC";
			} else {
				$select_query = "SELECT * FROM ".$GLOBALS['purchase_entry_table']." ORDER BY created_date_time ASC";
			}

			if(!empty($select_query)) {
				$list = $this->getQueryRecords('', $select_query);
			}
			return $list;
		}

		public function GetPurchaseTaxReport($filter_party_id,$from_date, $to_date) {
            $list = array(); $select_query = ""; $where = "";
            if(!empty($filter_party_id)) {
                if(!empty($where)) {
                    $where = $where . " party_id = '" . $filter_party_id . "' AND ";
                } else {
                    $where = "party_id = '" . $filter_party_id . "' AND ";
                }
            }

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where . " purchase_entry_date >= '" . $from_date . "' AND";
                } else {
                    $where = "purchase_entry_date >= '" . $from_date . "' AND ";
                }
            }

            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where . " purchase_entry_date <= '" . $to_date . "' AND ";     
                } else {
                    $where = "purchase_entry_date <= '" . $to_date . "' AND ";
                }
            }
            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['purchase_entry_table'] . " WHERE " . $where . " gst_option = '1' ORDER BY id DESC";    
            } else {
                $select_query = "SELECT * FROM " . $GLOBALS['purchase_entry_table'] . " WHERE gst_option ='1' ORDER BY id DESC";    
            }
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['purchase_entry_table'], $select_query);
            }
            return $list;
        }

		public function balance_report($bill_company_id, $party_id, $from_date, $to_date){
			$con = $this->connect();
			$select_query = "";
			$list = array();
			$reports = array();
			$purchase_query = "";
			$voucher_query = "";
			$receipt_query = "";
			$sales_query = "";
			$receipt_where = "";
			$purchase_where = "";
			$voucher_where = "";
			$sales_where = "";

			if (!empty($party_id)) {
				if (!empty($from_date)) {
					$from_date = date("Y-m-d", strtotime($from_date));
					$bill_where = "bill_date >='" . $from_date . "' AND ";
				}
				if (!empty($to_date)) {
					$to_date = date("Y-m-d", strtotime($to_date));

					if (empty($bill_where)) {
						$bill_where = "bill_date <= '" . $to_date . "' AND ";
					} else {
						$bill_where = $bill_where . "bill_date <='" . $to_date . "' AND ";
					}
				}

				$party_select_query = "SELECT party_id, party_name,party_type, mobile_number, opening_balance, opening_balance_type 
						FROM " . $GLOBALS['party_table'] . " WHERE party_id = '" . $party_id . "' AND deleted = '0' AND bill_company_id = '" . $bill_company_id . "' ";
				$list = $this->getQueryRecords($GLOBALS['party_table'], $party_select_query);
				if (!empty($list)) {
					foreach ($list as $data) {
						if (!empty($data['party_id'])) {

							$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $bill_where . " party_id = '" . $party_id . "' AND deleted = '0'";

							$reports = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
						}
					}
				}
				

				// $reports = array_merge($party_reports, $outsource_reports);

			} else {

				$customer_reports = array();
				$party_reports = array();
				if (!empty($from_date)) {
					$from_date = date("Y-m-d", strtotime($from_date));

					$bill_where = "bill_date >='" . $from_date . "' AND ";
				}
				if (!empty($to_date)) {
					$to_date = date("Y-m-d", strtotime($to_date));

					if (empty($bill_where)) {
						$bill_where = "bill_date <= '" . $to_date . "' AND ";
					} else {
						$bill_where = $bill_where . "bill_date <='" . $to_date . "' AND ";
					}
				}


				$sales_query = "SELECT sp.party_type, sp.party_id, sp.party_name, 
					sp.mobile_number as party_mobile_number, sp.opening_balance, sp.opening_balance_type,
					
					(SELECT SUM(p.credit) FROM " . $GLOBALS['payment_table'] . " as p 
					WHERE " . $bill_where . " p.party_id = sp.party_id  AND p.deleted = '0' AND p.bill_type != 'Party Opening Balance' AND bill_company_id = '" . $bill_company_id . "' GROUP BY p.party_id) as credit,

					(SELECT SUM(p.debit) FROM " . $GLOBALS['payment_table'] . " as p 
					WHERE " . $bill_where . " p.party_id = sp.party_id  AND p.deleted = '0'  AND p.bill_type != 'Party Opening Balance' AND  bill_company_id = '" . $bill_company_id . "' GROUP BY p.party_id) as debit

					FROM " . $GLOBALS['party_table'] . " as sp WHERE sp.deleted = '0' AND bill_company_id = '" . $bill_company_id . "'";
				$select_query = "SELECT party_type, party_id, party_name, party_mobile_number, opening_balance, opening_balance_type, 
										credit, debit FROM ( (" . $sales_query . ") ) as g";

				if (!empty($select_query)) {
					$list = $this->getQueryRecords('', $select_query);
					if (!empty($list)) {
						foreach ($list as $data) {
							// echo $data['party_type']." hai ".$data['party_id']."<br>";
							if (!empty($data['party_type']) && !empty($data['party_id'])) {
								$total_credit = 0;
								$total_debit = 0;
								$balance = 0;
								if (!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 'Credit')) {
									$total_credit = $total_credit + $data['opening_balance'];
								}
								if (!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 'Debit')) {
									$total_debit = $total_debit + $data['opening_balance'];
								}
								if (!empty($data['credit'])) {
									$total_credit = $total_credit + $data['credit'];
								}
								if (!empty($data['debit'])) {
									$total_debit = $total_debit + $data['debit'];
								}

								if (!empty($total_credit)) {
									$balance = $balance + $total_credit;
								}
								if (!empty($total_debit)) {
									$balance = $balance - $total_debit;
								}
								if (!empty($balance)) {
									$party_reports[] = array('party_type' => $data['party_type'], 'party_id' => $data['party_id'], 'party_name' => $data['party_name'], 'party_mobile_number' => $data['party_mobile_number'], "balance" => $balance, "credit" => $data['credit'], "debit" => $data['debit'], "opening_balance" => $data['opening_balance'], "opening_balance_type" => $data['opening_balance_type']);
								}
							}
						}
					}
				}

				$reports = $party_reports;
			}

			return $reports;
		}

		public function getOpeningBalance($party_id, $from_date, $to_date, $bill_company_id){
			$bill_where = "";
			if (!empty($to_date)) {
				$bill_where = "bill_date < '" . date("Y-m-d", strtotime($from_date)) . "' AND";
			}

			if (!empty($party_id)) {
				$party_where = "sp.party_id = '" . $party_id . "' AND";
			}

			$party_query = "SELECT  sp.party_type, sp.party_id as party_id, sp.party_name as party_name, 
						sp.mobile_number as party_mobile_number, sp.opening_balance, sp.opening_balance_type,
						(SELECT SUM(p.credit) FROM " . $GLOBALS['payment_table'] . " as p 
						WHERE " . $bill_where . " p.party_id = sp.party_id  AND p.deleted = '0' AND p.bill_company_id = '" . $bill_company_id . "'  GROUP BY p.party_id) as credit,

						(SELECT SUM(p.debit) FROM " . $GLOBALS['payment_table'] . " as p 
						WHERE " . $bill_where . " p.party_id = sp.party_id  AND p.deleted = '0' AND p.bill_company_id = '" . $bill_company_id . "'  GROUP BY p.party_id) as debit

						FROM " . $GLOBALS['party_table'] . " as sp WHERE " . $party_where . " sp.deleted = '0' AND bill_company_id = '" . $bill_company_id . "'  ";

			$select_query = "SELECT party_type, party_id, party_name, party_mobile_number, opening_balance, opening_balance_type, 
											credit, debit FROM (  (" . $party_query . ") ) as g";

			if (!empty($select_query)) {
				$list = $this->getQueryRecords('', $select_query);
				if (!empty($list)) {
					foreach ($list as $data) {
						if (!empty($data['party_type']) && !empty($data['party_id'])) {
							$total_credit = 0;
							$total_debit = 0;
							$balance = 0;
							if (!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 1)) {
								$total_credit = $total_credit + $data['opening_balance'];
							}
							if (!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 2)) {
								$total_debit = $total_debit + $data['opening_balance'];
							}

							if (!empty($data['credit'])) {
								$total_credit = $total_credit + $data['credit'];
							}
							if (!empty($data['debit'])) {
								$total_debit = $total_debit + $data['debit'];
							}

							if (!empty($total_credit)) {
								$balance = $balance + $total_credit;
							}
							if (!empty($total_debit)) {
								$balance = $balance - $total_debit;
							}
							if (!empty($balance)) {
								$reports[] = array('party_type' => $data['party_type'], 'party_id' => $data['party_id'], 'party_name' => $data['party_name'], 'party_mobile_number' => $data['party_mobile_number'], "balance" => $balance, "credit" => $data['credit'], "debit" => $data['debit'], "opening_balance" => $data['opening_balance'], "opening_balance_type" => $data['opening_balance_type']);
							}
						}
					}
				}
			}
			return $list;
		}

		public function GetSalesEntryReport($bill_company_id,$filter_party_id,$from_date, $to_date) {
			$list = array(); $select_query = ""; $where = ""; 

			$bill_company_id=$GLOBALS['bill_company_id'];
			
			if(!empty($bill_company_id)) {
				$where = "bill_company_id = '".$bill_company_id."'";
			}

			if(!empty($filter_party_id)) {
				if(!empty($where)) {
					$where = $where." AND party_id = '".$filter_party_id."'";
				}
				else {
					$where = "party_id = '".$filter_party_id."'";
				}
			}
			
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND estimate_date >= '".$from_date."'"; 
				}
				else {
					$where = "estimate_date >= '".$from_date."'";
				}
			}
			
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND estimate_date <= '".$to_date."'"; 	
				}
				else {
					$where = "estimate_date <= '".$to_date."'";
				}
			}

			$select_query = "";
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['estimate_table']."  WHERE ".$where."  ORDER BY created_date_time ASC";
			} else {
				$select_query = "SELECT * FROM ".$GLOBALS['estimate_table']." ORDER BY created_date_time ASC";
			}

			if(!empty($select_query)) {
				$list = $this->getQueryRecords('', $select_query);
			}
			return $list;
		}
		public function GetSalesTaxReport($filter_party_id,$from_date, $to_date) {
            $list = array(); $select_query = ""; $where = "";
            if(!empty($filter_party_id)) {
                if(!empty($where)) {
                    $where = $where . " party_id = '" . $filter_party_id . "' AND ";
                } else {
                    $where = "party_id = '" . $filter_party_id . "' AND ";
                }
            }

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where . " invoice_date >= '" . $from_date . "' AND";
                } else {
                    $where = "invoice_date >= '" . $from_date . "' AND ";
                }
            }

            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where . " invoice_date <= '" . $to_date . "' AND ";     
                } else {
                    $where = "invoice_date <= '" . $to_date . "' AND ";
                }
            }
            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['invoice_table'] . " WHERE " . $where . " gst_option = '1' ORDER BY id DESC";    
            } else {
                $select_query = "SELECT * FROM " . $GLOBALS['invoice_table'] . " WHERE gst_option ='1' ORDER BY id DESC";    
            }
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['invoice_table'], $select_query);
            }
            return $list;
        }
		public function getDayBookPaymentReportList($from_date, $filter_party_id, $bill_type){
			$list = array(); $where = ''; $deleted = 0;
	
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND DATE(bill_date) = '".$from_date."'";
				}
				else {
					$where = "DATE(bill_date) = '".$from_date."'";
				}
			}
			if(!empty($filter_party_id)) {
				if(!empty($where)) {
					$where = $where . " AND party_id = '". $filter_party_id . "'";
				} else {
					$where = " party_id = '". $filter_party_id . "'";
				}
			}
	
			
			if(!empty($bill_type)) {
				if(!empty($where)) {
					$where = $where . " AND bill_type = '". $bill_type . "'";
				} else {
					$where = " bill_type = '". $bill_type . "'";
				}
			}
			if(!empty($where)) {
				$where = $where . " AND deleted = '". $deleted . "'";
			} else {
				$where = " deleted = '". $deleted . "'";
			}
			$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['stock_table'], $select_query);
			}
			return $list;			
		}
    }