<?php 
    class Attendance_Functions extends Basic_Functions {
		public function DailyWorkerDetails() {
			$list = array(); $select_query = "";  $where = "";
			$select_query = "SELECT * FROM ".$GLOBALS['engineer_table']." WHERE deleted = '0'";	
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['engineer_table'], $select_query);
			}
			return $list;
		}

        public function getPrevAttendanceID($attendance_date){
			$select_query = ""; $list = array(); $unique_id = "";
			if (!empty($attendance_date)) {
                $attendance_date = date("Y-m-d", strtotime($attendance_date));
				$select_query = "SELECT attendance_id FROM ".$GLOBALS['attendance_table']." WHERE attendance_date = '".$attendance_date."' AND deleted = '0'";
				$list = $this->getQueryRecords('', $select_query);
			} 
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['attendance_id']) && $data['attendance_id'] != $GLOBALS['null_value']) {
						$unique_id = $data['attendance_id'];
					}
				}
			}
			return $unique_id;
		}

        public function AttendanceEngineerID($edit_id, $engineer_ids, $attendance_date) {
			$list = array(); $select_query = ""; $id = "";
			
			if(!empty($attendance_date) && $attendance_date != "0000-00-00") {
				$attendance_date = date('Y-m-d', strtotime($attendance_date));
				$select_query = "SELECT id FROM ".$GLOBALS['attendance_table']." WHERE attendance_date = '".$attendance_date."' AND attendance_id = '".$edit_id."' AND engineer_id = '".$engineer_ids."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['attendance_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['id'])) {
							$id = $data['id'];
						}
					}
				}
			}
			return $id;
		}

        public function EngineerAttendanceList($from_date,$to_date) {
			$list = array(); $select_query = "";
			if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if (!empty($where)) {
                    $where = $where." AND attendance_date >= '".$from_date."'";
                } 
				else {
                    $where = "attendance_date >= '" . $from_date . "'";
                }
            }
			if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if (!empty($where)) {
                    $where = $where." AND attendance_date <= '".$to_date."'";
                } 
				else {
                    $where = "attendance_date <= '".$to_date."'";
                }
            }
			if(!empty($where)) {
				$select_query = "SELECT DISTINCT(attendance_date) as attendance_date, attendance_id FROM ".$GLOBALS['attendance_table']." WHERE ".$where." AND deleted = '0' GROUP BY attendance_date ORDER BY attendance_date DESC";
			}
			else {
				$select_query = "SELECT DISTINCT(attendance_date) as attendance_date, attendance_id FROM ".$GLOBALS['attendance_table']." WHERE deleted = '0' GROUP BY attendance_date ORDER BY attendance_date DESC";
			}
            $list = $this->getQueryRecords('', $select_query);
            return $list;
		}
        public function AttendanceDetails($type, $attendance_date) {
			$where = ""; $list = array(); $select_query = ""; $count = 0;

            if($type == 'P') {
                $where = "present_status = 'P' AND ";
            }
            else if($type == 'A') {
                $where = "present_status = 'A' AND ";
            }

			if(!empty($type) && !empty($attendance_date) && $attendance_date != "0000-00-00") {
				$attendance_date = date('Y-m-d', strtotime($attendance_date));
				$select_query = "SELECT COUNT(id) AS id_count FROM ".$GLOBALS['attendance_table']." WHERE ".$where." attendance_date = '".$attendance_date."' AND deleted = '0'";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count'])) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
    }
?>