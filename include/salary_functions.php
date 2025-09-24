<?php
    class Salary_functions extends Basic_Functions{
        public function EngineerSalaryDetails($from_date,$to_date) {
            $list = array(); $select_query = ""; $where = "";
            if (!empty($from_date)) {

                $from_date = date("Y-m-d", strtotime($from_date));

                if (!empty($where)) {

                    $where = $where . " AND a.attendance_date >= '" . $from_date . "'";
                } else {

                    $where = "a.attendance_date >= '" . $from_date . "'";
                }
            }

			if(!empty($to_date)) {

                $to_date = date("Y-m-d", strtotime($to_date));

                if (!empty($where)) {

                    $where = $where . " AND a.attendance_date <= '" . $to_date . "'";
                } else {

                    $where = "a.attendance_date <= '" . $to_date . "'";
                }
            }

            $select_query = "
                    SELECT a.*
                    FROM ".$GLOBALS['attendance_table']." a
                    JOIN ".$GLOBALS['engineer_table']." s ON a.engineer_id = s.engineer_id
                    WHERE ".$where." 
                    AND a.is_salaried = '0' 
                    AND a.deleted = '0' 
                    GROUP BY a.engineer_id 
                    ASC";
            
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['attendance_table'], $select_query);
			}
			return $list;
        }

        public function EngineerWorkingDays($engineer_id,$edit_id,$from_date,$to_date) {
			$list = array(); $select_query = ""; $id = ""; $where = "";
            if (!empty($from_date)) {

                $from_date = date("Y-m-d", strtotime($from_date));

                if (!empty($where)) {

                    $where = $where . " AND attendance_date >= '" . $from_date . "'";
                } else {

                    $where = "attendance_date >= '" . $from_date . "'";
                }
            }

			if (!empty($to_date)) {

                $to_date = date("Y-m-d", strtotime($to_date));

                if (!empty($where)) {

                    $where = $where . " AND attendance_date <= '" . $to_date . "'";
                } else {

                    $where = "attendance_date <= '" . $to_date . "'";
                }
            }

			if(!empty($engineer_id)) {
                if (!empty($where)) {
                    $where = $where . " AND engineer_id = '" . $engineer_id . "'";
                } else {

                    $where = "engineer_id = '" . $engineer_id . "'";
                }
			}
            if(empty($edit_id)){ 
                $full_present_query = "SELECT COUNT(id) AS id_count FROM ".$GLOBALS['attendance_table']." WHERE ".$where." AND  present_status = 'P' AND is_salaried ='0' AND deleted = '0'";	

                $select_query = "SELECT SUM(id_count) as total_count FROM ((".$full_present_query.") ) as g";
            }
            else {
                $full_present_query = "SELECT COUNT(id) AS id_count FROM ".$GLOBALS['attendance_table']." WHERE ".$where." AND  present_status = 'P' AND is_salaried ='1' AND deleted = '0'";		

                $select_query = "SELECT SUM(id_count) as total_count FROM ((".$full_present_query.")) as g";
            }		
			
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['attendance_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['total_count'])) {
							$id = $data['total_count'];
						}
					}
				}
			}
			return $id;
		}

        public function EngineerSalaryList($from_date,$to_date) {
            $list = array(); $select_query = ""; $where = "";
            if (!empty($from_date)) {

                $from_date = date("Y-m-d", strtotime($from_date));

                if(!empty($where)) {
                    $where = $where . " AND salary_date >= '" . $from_date . "'";
                }else{
                    $where = "salary_date >= '" . $from_date . "'";
                }
            }

			if (!empty($to_date)) {

                $to_date = date("Y-m-d", strtotime($to_date));

                if (!empty($where)) {

                    $where = $where . " AND salary_date <= '" . $to_date . "'";
                } else {

                    $where = "salary_date <= '" . $to_date . "'";
                }
            }  

			$select_query = "SELECT * FROM ".$GLOBALS['salary_table']." WHERE  ".$where." AND  deleted = '0'";	
			
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['salary_table'], $select_query);

			}

			return $list;

        }

        public function SalariedEngineer($engineer_ids,$salary_id,$from_date,$to_date,$voucher_advance_amount, $original_advance) {
            $list = array(); $select_query = ""; $where = "";
            if (!empty($from_date)) {

                $from_date = date("Y-m-d", strtotime($from_date));

                if (!empty($where)) {

                    $where = $where . " AND attendance_date >= '" . $from_date . "'";
                } else {

                    $where = "attendance_date >= '" . $from_date . "'";
                }
            }

			if (!empty($to_date)) {

                $to_date = date("Y-m-d", strtotime($to_date));

                if (!empty($where)) {

                    $where = $where . " AND attendance_date <= '" . $to_date . "'";
                } else {

                    $where = "attendance_date <= '" . $to_date . "'";
                }
            }

            if(!empty($engineer_ids)) {
                if (!empty($where)) {

                    $where = $where . " AND engineer_id = '" . $engineer_ids . "'";
                } else {

                    $where = "engineer_id = '" . $engineer_ids . "'";
                }
			}

			$select_query = "SELECT id FROM ".$GLOBALS['attendance_table']." WHERE  ".$where." AND deleted = '0'";
			$list = $this->getQueryRecords('', $select_query);
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
						$attendance_update_id = ""; $action = "";
						$action = "Attendance Updated";
						$columns = array();
						$values = array();
						$columns = array('is_salaried','salary_id');
						$values = array('"1"',"'".$salary_id."'");
						$attendance_update_id = $this->UpdateSQL($GLOBALS['attendance_table'], $data['id'], $columns, $values, $action);
					}
				}
			}

            if(!empty($voucher_advance_amount) && !empty($engineer_ids)){
                $where = "";
                $engineer_id = "";$engineer_advance_amount = 0;
                $engineer_id = $this->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$engineer_ids,'id');
                $engineer_advance_amount = $this->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$engineer_ids,'advance_amount');
                if(!empty($engineer_advance_amount) && $engineer_advance_amount != $GLOBALS['null_value']){
                    if(!empty($original_advance) && $original_advance != $GLOBALS['null_value']) {
                        $engineer_advance_amount = $engineer_advance_amount + $original_advance;
                    }
                    $engineer_advance_amount = $engineer_advance_amount - $voucher_advance_amount;
                }

                $engineer_update_id = ""; $action = "";
                $action = "Engineer Updated";
                $columns = array();
                $values = array();
                $columns = array('advance_amount');
                $values = array("'".$engineer_advance_amount."'");
                $engineer_update_id = $this->UpdateSQL($GLOBALS['engineer_table'], $engineer_id, $columns, $values, $action);
            }
			
        }

        public function SalariedEngineerList($from_date,$to_date,$engineer_id) {
            $list = array(); $select_query = ""; $where = "";
            if (!empty($from_date)) {

                 $from_date = date("Y-m-d", strtotime($from_date));

                if (!empty($where)) {

                    $where = $where . " AND salary_date >= '" . $from_date . "'";
                } else {

                    $where = "salary_date >= '" . $from_date . "'";
                }
            }

			if (!empty($to_date)) {

                $to_date = date("Y-m-d", strtotime($to_date));

                if (!empty($where)) {

                    $where = $where . " AND salary_date <= '" . $to_date . "'";
                } else {

                    $where = "salary_date <= '" . $to_date . "'";
                }
            }

            if(!empty($engineer_id)) {
                if (!empty($where)) {

                    $where = $where . " AND engineer_id = '" . $engineer_id . "'";
                } else {

                    $where = "engineer_id = '" . $engineer_id . "'";
                }
			}

		 $select_query = "SELECT * FROM ".$GLOBALS['salary_voucher_table']." WHERE  ".$where."  AND deleted = '0'";
			$list = $this->getQueryRecords('', $select_query);

            return $list;
		
        }

        public function EngineerList() {
			$list = array(); $select_query = "";  $where = "";
			
			$select_query = "SELECT * FROM ".$GLOBALS['engineer_table']." WHERE deleted = '0'";	
			
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['engineer_table'], $select_query);

			}
			return $list;
		}

        public function UpdateEngineerAdavncePlus($engineer_ids,$total_amount) {
            $list = array(); $select_query = ""; $where = "";
            
            $engineer_id = "";$engineer_advance_amount = 0;
            $engineer_id = $this->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$engineer_ids,'id');
            $engineer_advance_amount = $this->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$engineer_ids,'advance_amount');
            if(!empty($engineer_advance_amount) && $engineer_advance_amount !=$GLOBALS['null_value']){
                $engineer_advance_amount = $engineer_advance_amount + $total_amount;
            }else{
                $engineer_advance_amount = $total_amount;
            }
            $engineer_update_id = ""; $action = "";
            $action = "Engineer Updated";
            $columns = array();
            $values = array();
            $columns = array('advance_amount');
            $values = array("'".$engineer_advance_amount."'");
            $engineer_update_id = $this->UpdateSQL($GLOBALS['engineer_table'], $engineer_id, $columns, $values, $action);			
        }

        public function UpdateEngineerAdvanceMinus($advance_voucher_engineer_id,$advance_voucher_amount) {
            $list = array(); $select_query = ""; $where = "";
            
            $engineer_id = "";$engineer_advance_amount = 0;
            $engineer_id = $this->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$advance_voucher_engineer_id,'id');
            $engineer_advance_amount = $this->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$advance_voucher_engineer_id,'advance_amount');
            if(!empty($engineer_advance_amount) && $engineer_advance_amount !=$GLOBALS['null_value']){
                $engineer_advance_amount = $engineer_advance_amount - $advance_voucher_amount;
            }
            $engineer_update_id = ""; $action = "";
            $action = "Engineer Updated";
            $columns = array();
            $values = array();
            $columns = array('advance_amount');
            $values = array("'".$engineer_advance_amount."'");
            $engineer_update_id = $this->UpdateSQL($GLOBALS['engineer_table'], $engineer_id, $columns, $values, $action);
					
        }

        public function getSalariedEngineerDate($engineer_id) {
            $list = array(); $select_query = ""; $where = "";
            $select_query = "SELECT * FROM ".$GLOBALS['salary_voucher_table']." WHERE engineer_id = '".$engineer_id."' AND deleted = '0' LIMIT 4";
			$list = $this->getQueryRecords('', $select_query);
            return $list;
        }

        public function CalculateSalary($from_date, $to_date, $engineer_id) {
            $select_query = ""; $list = array(); $total_salary = 0;
            $select_query = "SELECT SUM(total_salary) AS total_salary FROM ".$GLOBALS['attendance_table']." WHERE attendance_date >= '".$from_date."' AND attendance_date <= '".$to_date."' AND engineer_id = '".$engineer_id."' AND is_salaried='0' AND deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['total_salary'])) {
                        $total_salary = $data['total_salary'];
                    }
                }
            }
            return $total_salary;
        }

        public function EngineerOtHours($from_date, $to_date, $engineer_id) {
            $select_query = ""; $list = array(); $ot_hours = 0;
          $select_query = "SELECT ot_hours FROM ".$GLOBALS['attendance_table']." WHERE attendance_date >= '".$from_date."' AND attendance_date <= '".$to_date."' AND engineer_id = '".$engineer_id."' AND is_salaried = '0' AND deleted = '0'";
            if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['attendance_table'], $select_query);
			}

			return $list;
        }

        public function getOriginalAdvance($engineer_id, $salary_id) {
            $select_query = ""; $list = array();$where = ""; $advance_amount = 0;
            if(!empty($engineer_id) && !empty($salary_id)) {
                $select_query = " SELECT advance_amount FROM ".$GLOBALS['salary_voucher_table']." WHERE engineer_id = '".$engineer_id."' AND salary_id = '".$salary_id."' AND deleted = '0'";
            }
            if(!empty($select_query)) {
                $list = $this->getQueryRecords('', $select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['advance_amount']) && $data['advance_amount'] != $GLOBALS['null_value']) {
                        $advance_amount = $data['advance_amount'];
                    }
                }
            }
            return $advance_amount;
        }

        public function AttendanceCount($from_date, $to_date, $engineer_id){
			$select_query = ""; $list = array(); $where = ""; $count = 0;
            if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND attendance_date >= '".$from_date."'";
				}
				else {
					$where = "attendance_date >= '".$from_date."'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND attendance_date <= '".$to_date."'";
				}
				else {
					$where = "attendance_date <= '".$to_date."'";
				}
			}
            if(!empty($engineer_id)) {
                if(!empty($where)) {
                    $where = $where." AND engineer_id = '".$engineer_id."'";
                } 
                else {
                    $where = "engineer_id = '".$engineer_id."'";
                }
            }
			if (!empty($where)) {
				$select_query = "
					SELECT COUNT(id) AS attendance_count
					FROM ".$GLOBALS['attendance_table']." 
					WHERE ".$where." 
					AND present_status != 'AA'
					AND deleted = '0'
				";
			} else {
				$select_query = "
					SELECT COUNT(id) AS attendance_count
					FROM ".$GLOBALS['attendance_table']." 
					WHERE ".$where." 
					AND present_status != 'AA'
					AND deleted = '0'
				";
			}
			
			if (!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['engineer_table'], $select_query);
			}
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['attendance_count']) && $data['attendance_count'] != $GLOBALS['null_value']) {
                        $count = $data['attendance_count'];
                    }
                }
            }
            return $count;
		}

        public function GetSalaryVoucherUniqueID($engineer_id, $salary_id) {
            $select_query = ""; $list = array(); $unique_id = "";
            if(!empty($engineer_id) && !empty($salary_id)) {
                $select_query = "SELECT id FROM ".$GLOBALS['salary_voucher_table']." WHERE engineer_id = '".$engineer_id."' AND salary_id = '".$salary_id."' AND deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $unique_id = $data['id'];
                    }
                }
            }
            return $unique_id;
        }
    }
?>     