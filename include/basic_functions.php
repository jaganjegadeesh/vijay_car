<?php
	include("vijay_garage_170925.php");
	class Basic_Functions extends db {
		public $con;
		
		public function connect() {
			$con = parent::connect();
			return $con;
		}

		public function getProjectTitle() {
			$project_title = "";
			$company_name = "";
			$company_name = $this->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'name');
			if(!empty($company_name) && $company_name != $GLOBALS['null_value']) {
				$project_title = $this->encode_decode('decrypt', $company_name);
			}
			if(empty($project_title)) { $project_title = "Vijay Garage"; }

			return $project_title;
		}
		public function select_values($table, $columns, $values, $order)
		{
			$con = parent::connect();
			$select_query = "";
			$check = ''; $data_values = array();
			if(!empty($columns) && !empty($values) && empty($keyword)) {
				if(count($columns) == count($values)) {				
					for($r = 0; $r < count($columns); $r++) {
						$check = $check.$columns[$r]." = ".$values[$r]."";
						if(!empty($columns[$r+1]))
							$check = $check.' AND ';
					}
				}
				$check = trim($check);
				$select_query = "SELECT * FROM ".$table." WHERE ".$check;
			}
			else			
				$select_query = "SELECT * FROM ".$table;
				
			if(!empty($order)) {
				if(!empty($select_query))
					$select_query = $select_query." ORDER BY id ".$order;
			}
			
			//echo $select_query;
			
			if(!empty($select_query)) {
				$data_values = $this->getQueryRecords($table, $select_query);
			}
				
			return $data_values;			
		}

		public function encode_decode($action, $string) {
			$output = "";
			//encode
			if($action == 'encrypt') {
				$output = base64_encode($string);
				$output =  bin2hex($output);
				//$output = gzcompress($output, 9);
			}			
			//decode
			if($action == 'decrypt') {
				//$output = gzuncompress($string);
				$output = hex2bin($string);
				$output = base64_decode($output);
			}
			return $output;
		}
		
		public function InsertSQL($table, $columns, $values, $custom_id, $unique_number, $action) {
			$con = $this->connect(); $last_insert_id = "";
			
			if(!empty($columns) && !empty($values)) {
				if(count($columns) == count($values)) {					
					$columns = implode(",", $columns);
					$values = implode(",", $values);
					$last_record_id = 0;
                	$last_record_id = $this->getLastRecordIDFromTable($table);
					
					$result = "";
					$insert_query = "INSERT INTO ".$table." (".$columns.") VALUES (".$values.")";
					// echo $insert_query."<br>";
					$result = $con->prepare($insert_query);
					if($result->execute() === TRUE) {
						$last_insert_id = $con->lastInsertId();
						$last_query_insert_id = "";
						if(preg_match("/^\d+$/", $last_insert_id)) {
							if(!empty($custom_id)) {
								$unique_number_value = "";
								if(!empty($unique_number)) {
									$unique_number_value = $this->automate_number($table, $unique_number);
									/*if(!empty($unique_number_value)) {                    
										$unique_number_value = $this->encode_decode('encrypt', strtoupper($unique_number_value));
									}*/							
								}
								$custom_id_value = "";
								// if($table == $GLOBALS['receipt_table']) {
								// 	if($last_insert_id < 10) {
								// 		$custom_id_value = date("dmYhis")."_RC_0".$last_insert_id;
								// 	}
								// 	else {
								// 		$custom_id_value = date("dmYhis")."_RC_".$last_insert_id;
								// 	}
								// } else {
									if($last_insert_id < 10) {
										$custom_id_value = date("dmYhis")."_0".$last_insert_id;
									}
									else {
										$custom_id_value = date("dmYhis")."_".$last_insert_id;
									}
								// }
								if(!empty($custom_id_value)) {
									$custom_id_value = $this->encode_decode('encrypt', $custom_id_value);
								}
								$columns = array(); $values = array(); $update_id = "";	
								if(!empty($unique_number) && !empty($unique_number_value)) {
									$columns = array($custom_id, $unique_number);
									$values = array("'".$custom_id_value."'", "'".$unique_number_value."'");
								}	
								else {			
									$columns = array($custom_id);
									$values = array("'".$custom_id_value."'");
								}
								$update_id = $this->UpdateSQL($table, $last_insert_id, $columns, $values, '');
								if(preg_match("/^\d+$/", $update_id)) {
									$last_log_id = $this->add_log($table, $last_insert_id, $insert_query, $action);			
								}
							}
							else {
								$last_log_id = $this->add_log($table, $last_insert_id, $insert_query, $action);
							}
						}
					}
					else {
						$last_insert_id = "Unable to insert the data";
					}
				}
				else {
					$last_insert_id = "Columns are not match";
				}
			}			
					
			return $last_insert_id;
		}

		public function getLastRecordIDFromTable($table) {
			$max_unique_id = ""; $list = array();				
			$select_query = "SELECT id FROM ".$table." ORDER BY id DESC LIMIT 1";
			// echo $table;
			$list = $this->getQueryRecords($table, $select_query);
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id'])) {
						$max_unique_id = $data['id'];
					}
				}
			}
			return $max_unique_id;
		}
		public function automate_number($table, $column) {
            $last_number = 0; $next_number = ""; $last_id_number = "";
            $prefix = "";
			if(!empty($table) && $table == $GLOBALS['advance_voucher_table']) {
                $prefix = 'ADV';
            } 
			elseif(!empty($table) && $table == $GLOBALS['purchase_entry_table']) {
                $prefix = 'PE';
            }
			elseif(!empty($table) && $table == $GLOBALS['store_entry_table']) {
                $prefix = 'SE';
            }
			elseif(!empty($table) && $table == $GLOBALS['salary_table']) {
                $prefix = 'SAL';
            }
			elseif(!empty($table) && $table == $GLOBALS['salary_voucher_table']) {
                $prefix = 'SAV';
            } 
			elseif(!empty($table) && $table == $GLOBALS['job_card_table']) {
                $prefix = 'JC';
            }
			elseif(!empty($table) && $table == $GLOBALS['material_transfer_table']) {
                $prefix = 'MT';
            }
			elseif(!empty($table) && $table == $GLOBALS['stock_adjustment_table']) {
                $prefix = 'SA';
            }
			elseif(!empty($table) && $table == $GLOBALS['voucher_table']) {
                $prefix = 'VOU';
            }
			elseif(!empty($table) && $table == $GLOBALS['receipt_table']) {
                $prefix = 'REC';
            }
			elseif(!empty($table) && $table == $GLOBALS['quotation_table']) {
                $prefix = 'QT';
            }
			elseif(!empty($table) && $table == $GLOBALS['estimate_table']) {
                $prefix = 'ES';
            }
			elseif(!empty($table) && $table == $GLOBALS['invoice_table']) {
                $prefix = 'IN';
            }
			
            $current_year = date("y"); $next_year = date("y")+1;
            
            if(date("m") == date("01") || date("m") == date("02") || date("m") == date("03")) {
                $current_year = date("y") - 1; $next_year = date("y");
            }
            $select_query1 = "SELECT ".$column." as last_number FROM ".$table." where (".$column."!='".$GLOBALS['null_value']."' && ".$column."!='') ORDER BY created_date_time DESC LIMIT 1";
            if(!empty($select_query1)) {
                $automate_number_list = array();
                $automate_number_list = $this->getQueryRecords($table, $select_query1);
                if(!empty($automate_number_list)) {
                    foreach($automate_number_list as $anumber) {
                        if(!empty($anumber['last_number']) && $anumber['last_number'] != $GLOBALS['null_value']) {
                            $last_number = $anumber['last_number'];
                            $last_id_number = $anumber['last_number'];
                        }
                    }
                }
            }
            
            if(strpos($last_number, '/') !== false){
                $last_number_array = array();
                $last_number_array = explode("/", $last_number);
                $last_number = $last_number_array[0];
				$last_number = trim($last_number);
                if(!empty($prefix)){
					if(!empty($table) && $table == $GLOBALS['advance_voucher_table']) {
                        $last_number = str_replace("ADV","",$last_number);
                        $last_number = trim($last_number);
                    } 
					elseif(!empty($table) && $table == $GLOBALS['purchase_entry_table']) {
                        $last_number = str_replace("PE","",$last_number);
                        $last_number = trim($last_number);
                    }
					elseif(!empty($table) && $table == $GLOBALS['store_entry_table']) {
                        $last_number = str_replace("SE","",$last_number);
                        $last_number = trim($last_number);
                    }
					elseif(!empty($table) && $table == $GLOBALS['job_card_table']) {
                        $last_number = str_replace("JC","",$last_number);
                        $last_number = trim($last_number);
                    }
					elseif(!empty($table) && $table == $GLOBALS['salary_table']) {
                        $last_number = str_replace("SAL","",$last_number);
                        $last_number = trim($last_number);
                    }
					elseif(!empty($table) && $table == $GLOBALS['material_transfer_table']) {
                        $last_number = str_replace("MT","",$last_number);
                        $last_number = trim($last_number);
                    }
					elseif(!empty($table) && $table == $GLOBALS['stock_adjustment_table']) {
                        $last_number = str_replace("SA","",$last_number);
                        $last_number = trim($last_number);
                    }
					elseif(!empty($table) && $table == $GLOBALS['voucher_table']) {
                        $last_number = str_replace("VOU","",$last_number);
                        $last_number = trim($last_number);
                    }
					elseif(!empty($table) && $table == $GLOBALS['receipt_table']) {
                        $last_number = str_replace("REC","",$last_number);
                        $last_number = trim($last_number);
                    }
					elseif(!empty($table) && $table == $GLOBALS['quotation_table']) {
                        $last_number = str_replace("QT","",$last_number);
                        $last_number = trim($last_number);
                    }
					elseif(!empty($table) && $table == $GLOBALS['salary_voucher_table']) {
                        $last_number = str_replace("SAV","",$last_number);
                        $last_number = trim($last_number);
                    }
					elseif(!empty($table) && $table == $GLOBALS['estimate_table']) {
                        $last_number = str_replace("ES","",$last_number);
                        $last_number = trim($last_number);
                    }
					elseif(!empty($table) && $table == $GLOBALS['invoice_table']) {
                        $last_number = str_replace("IN","",$last_number);
                        $last_number = trim($last_number);
                    }
                }
                $next_number = $last_number + 1;
            }
            if(empty($last_number)){
                $next_number = 1;
            }
            if(!empty($next_number)) {
                if(date("m") == date("01") || date("m") == date("02") || date("m") == date("03")) {
                    $current_year = date("y") - 1; $next_year = date("y");
                }
                if(date("d-m-Y") >= date("01-04-Y")) {
                    if(strpos($last_id_number,($current_year.'-'.$next_year)) !== false){
                        
                    }
                    else{
                        $next_number = 1;
                    }
                }
                if(strlen($next_number) == "1"){
                    $next_number = '00'.$next_number;
                }
                else if(strlen($next_number) == "2"){
                    $next_number = '0'.$next_number;
                }
                
                if(!empty($prefix)) {
                    $next_number = $prefix.$next_number.'/'.$current_year.'-'.$next_year;
                }
                else{
                    $next_number = $next_number.'/'.$current_year.'-'.$next_year;
                }
            }
            return $next_number;
        }
		
		public function add_log($table, $table_unique_id, $query, $action) {
			$con = $this->connect(); $last_query_insert_id = "";
			if(!empty($query) && !empty($action)) {
				$query = $this->encode_decode('encrypt', $query);
				$action = $this->encode_decode('encrypt', $action);
				$table = $this->encode_decode('encrypt', $table);
			
				$create_date_time = $GLOBALS['create_date_time_label'];
				$creator = "";
				if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
					$creator = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
				}
				$creator_type = "";
				if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
					$creator_type = $this->encode_decode('encrypt', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']);
				}
				$creator_name = "";
				if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_username']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_username'])) {
					$creator_name = $this->encode_decode('encrypt', $_SESSION[$GLOBALS['site_name_user_prefix'].'_username']);
				}
				$creator_mobile_number = "";
				if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_mobile_number']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_mobile_number'])) {
					$creator_mobile_number = $this->encode_decode('encrypt', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_mobile_number']);
				}
				$log_backup_file = $GLOBALS['log_backup_file'];
	
				$columns = array('type', 'created_date_time', 'creator', 'creator_name', 'creator_mobile_number', 'log_table', 'log_table_unique_id', 'action', 'query');	
				$values = array("'".$creator_type."'", "'".$create_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$creator_mobile_number."'", "'".$table."'", "'".$table_unique_id."'", "'".$action."'", "'".$query."'");			
				if(count($columns) == count($values)) {	
					$log_data = array();
					$log_data = array('type' => $creator_type, 'created_date_time' => $create_date_time, 'creator' => $creator, 'creator_name' => $creator_name, 'creator_mobile_number' => $creator_mobile_number, 'table' => $table, 'table_unique_id' => $table_unique_id, 'action' => $action, 'query' => $query);	
					if(!empty($log_data)) {
						$log_data = json_encode($log_data);
						
						if(file_exists($log_backup_file)) {
							file_put_contents($log_backup_file, $log_data, FILE_APPEND | LOCK_EX);
							file_put_contents($log_backup_file, "\n", FILE_APPEND | LOCK_EX);
						}
						else {
							$myfile = fopen($log_backup_file, "a+");
							fwrite($myfile, $log_data."\n");
							fclose($myfile);
						}
					}
				}
			}			
					
			return $last_query_insert_id;
		}
		
		public function UpdateSQL($table, $update_id, $columns, $values, $action) {
			$con = $this->connect(); $updated_data = ''; $msg = "";
			
			if(!empty($columns) && !empty($values)) {
			
				if(count($columns) == count($values)) {					
					for($r = 0; $r < count($columns); $r++) {
						$updated_data = $updated_data.$columns[$r]." = ".$values[$r]."";
						if(!empty($columns[$r+1])) {
							$updated_data = $updated_data.', ';
						}	
					}
					if(!empty($updated_data)) {
						$updated_data = trim($updated_data);
						$update_query = "UPDATE ".$table." SET ".$updated_data." WHERE id='".$update_id."'";
						$result = $con->prepare($update_query);
						if($result->execute() === TRUE) {
							$msg = 1;							
							$last_log_id = $this->add_log($table, $update_id, $update_query, $action);
						}
						else {
							$msg = "Unable to update the data";
						}
					}
					else {
						$msg = "Unable to update the data";
					}
				}
				else {
					$msg = "Columns are not match";
				}
			}
					
			return $msg;	
		}

		public function getTableColumnValue($table, $column, $value, $return_value) {
			$con = $this->connect();
			$table_column_value = ""; $select_query = "";
			if(!empty($column) && !empty($value) && !empty($return_value)) {
				$select_query = "SELECT ".$return_value." FROM ".$table." WHERE ".$column." = '".$value."' AND deleted = '0'";
					
				//echo $select_query."<br>";
				if(!empty($select_query)) {
					$result = 0; $pdo = "";			
					$pdo = $con->prepare($select_query);
					$pdo->execute();	
					$result = $pdo->setFetchMode(PDO::FETCH_ASSOC);
					if(!empty($result)) {
						foreach($pdo->fetchAll() as $row) {
							$table_column_value = $row[$return_value];
						}
					}
				}
			}
			return $table_column_value;
		}

		public function getTableRecords($table, $column, $value) {
			$con = $this->connect();
			$result = ""; $select_query = "";
			if(!empty($table)) {
				if($table == 'user'){
					if(!empty($column) && !empty($value)) {		
						$select_query = "SELECT * FROM ".$table." WHERE ".$column." = '".$value."'  AND deleted = '0' ORDER BY id DESC";	
					}
					else if(empty($column) && empty($value)) {		
						$select_query = "SELECT * FROM ".$table." WHERE deleted = '0' ORDER BY id DESC";	
					}
				}
				else{
					if(!empty($column) && !empty($value)) {		
						$select_query = "SELECT * FROM ".$table." WHERE ".$column." = '".$value."' AND deleted = '0' ORDER BY id DESC";	
					}
					else if(empty($column) && empty($value)) {		
						$select_query = "SELECT * FROM ".$table." WHERE deleted = '0' ORDER BY id DESC";	
					}
				}
				
			}		
			//echo $select_query;
			if(!empty($select_query)) {
				$result = $this->getQueryRecords($table, $select_query);
			}
			return $result;
		}
		public function getQueryRecords($table, $select_query) {
			$con = $this->connect(); $list = array();
			if(!empty($select_query)) {
				$result = 0; $pdo = "";			
				$pdo = $con->prepare($select_query);
				$pdo->execute();	
				$result = $pdo->setFetchMode(PDO::FETCH_ASSOC);
				if(!empty($result)) {
					foreach($pdo->fetchAll() as $row) {
						$table_column_array = "";	
						$table_column_array = array_keys($row);			
						if(!empty($table_column_array)) {
							for($i = 0; $i < count($table_column_array); $i++) {
								if(!empty($table_column_array[$i])) {
									$column = $table_column_array[$i];
									if($table == 'product' && ($column == "name" || $column == "product_code" || $column == "description")){
										$row[$column] = $this -> encode_decode('decrypt',$row[$column]);
										if(strpos($row[$column], '[SA-AS]') !== false) {
											$row[$column] = str_replace('[SA-AS]', "+", $row[$column]);
										} 
										if(strpos($row[$column], '[KA-AK]') !== false) {
											$row[$column] = str_replace('[KA-AK]', '&', $row[$column]);
										}
										if(strpos($row[$column], '[SVL-VSL]') !== false) {
											$row[$column] = str_replace('[SVL-VSL]', '"', $row[$column]);
										}
										if(strpos($row[$column], '[SKK-KSK]') !== false) {
											$row[$column] = str_replace('[SKK-KSK]', "'", $row[$column]);
										}
										if(strpos($row[$column], '[KIKA-KAKI]') !== false) {
											$row[$column] = str_replace('[KIKA-KAKI]', '$', $row[$column]);
										} 
										if(strpos($row[$column], '[AKSL-LSKA]') !== false) {
											$row[$column] = str_replace('[AKSL-LSKA]', '#', $row[$column]);
										} 
										$row[$column] = $this -> encode_decode('encrypt',$row[$column]);
									}
									// $row[$column] = htmlentities($row[$column],ENT_QUOTES);
									// $row[$column] = html_entity_decode($row[$column]);
									
								}
							}
						}
						$list[] = $row;
					}
				}
			}
			return $list;
		}

		public function daily_db_backup() {
			$con = $this->connect();
			$backupAlert = 0; $backup_file = ""; $path = $GLOBALS['backup_folder_name']."/"; $file_name = ""; $dbname = $this->db_name;
			$tables = array();
			//$result = mysqli_query($con, "SHOW TABLES");
			$select_query = "SHOW TABLES";
			$result = 0; $pdo = "";			
			$pdo = $con->prepare($select_query);
			$pdo->execute();	
			$result = $pdo->fetchAll(PDO::FETCH_COLUMN); 
			if (!$result) {
				$backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($con) . 'ERROR NO :' . mysqli_errno($con);
			}
			else {
				$tables = array();
				foreach($result as $table_name) {
					if(!empty($table_name)) {
						$tables[] = $table_name;
					}
				}
				$output = '';
				if(!empty($tables)) {
					foreach($tables as $table) {
						$show_table_query = "SHOW CREATE TABLE " . $table . "";
						$statement = $con->prepare($show_table_query);
						$statement->execute();
						$show_table_result = $statement->fetchAll();

						foreach($show_table_result as $show_table_row) {
							$output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
						}
						$select_query = "SELECT * FROM " . $table . "";
						$statement = $con->prepare($select_query);
						$statement->execute();
						$total_row = $statement->rowCount();
						for($count=0; $count<$total_row; $count++) {
							$single_result = $statement->fetch(\PDO::FETCH_ASSOC);
							$table_column_array = array_keys($single_result);
							$table_value_array = array_values($single_result);
							$output .= "\nINSERT INTO $table (";
							$output .= "" . implode(", ", $table_column_array) . ") VALUES (";
							$output .= "'" . implode("','", $table_value_array) . "');\n";
						}
					}
				}

				if(!empty($output)) {
					$file_name = $dbname.'.sql';
					$backup_file = $path.$file_name;
					file_put_contents($backup_file, $output);
					if(file_exists($backup_file)) {
						$backupAlert = 1;
					}
				}
			}

			$msg = "";
			if(!empty($backupAlert) && $backupAlert == 1) {
				$msg = $backup_file;
			}
			else {
				$msg = $backupAlert;
			}
			return $msg;
		}

		public function image_directory() {
			$target_dir = "include/images/upload/";
			return $target_dir;
		}
		public function temp_image_directory() {
			$temp_dir = "include/images/temp/";
			return $temp_dir;
		}
		public function clear_temp_image_directory() {
			$temp_dir = "include/images/temp/";
			
			$files = glob($temp_dir.'*'); // get all file names
			foreach($files as $file){ // iterate files
			  if(is_file($file))
				unlink($file); // delete file
			}
			
			return true;
		}
		
		public function check_user_id_ip_address() {
			$con = $this->connect();
			$select_query = ""; $check_login_id = "";
			
			if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
				$select_query = "SELECT id FROM ".$GLOBALS['login_table']." WHERE user_id = '".$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']."' AND ip_address = '".$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_ip_address']."' AND logout_date_time = '0000-00-00 00:00:00' ORDER BY id DESC LIMIT 1";
				
				$result = 0; $pdo = "";			
				$pdo = $con->prepare($select_query);
				$pdo->execute();	
				$result = $pdo->setFetchMode(PDO::FETCH_ASSOC);
				if(!empty($result)) {
					foreach($pdo->fetchAll() as $row) {
						$check_login_id = $row['id'];
					}
				}
			}
			return $check_login_id;
		}
		
		public function checkUser() {
			$con = $this->connect();
			
			$user_id = "";
			if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
				$user_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];				
				$today = date('Y-m-d');	
				
				$select_query = "SELECT * FROM ".$GLOBALS['login_table']." WHERE user_id = '".$user_id."' AND DATE(login_date_time) = '".$today."' ORDER BY id DESC LIMIT 1";
				
				$result = 0; $pdo = "";			
				$pdo = $con->prepare($select_query);
				$pdo->execute();	
				$result = $pdo->setFetchMode(PDO::FETCH_ASSOC);
				if(!empty($result)) {
					foreach($pdo->fetchAll() as $row) {
						$login_user_id = $row['user_id'];
					}
				}
			}
			return $login_user_id;
		}

		public function getDailyReport($from_date, $to_date) {
            $log_list = array(); $select_query = ""; $where = "";
			$log_backup_file = $GLOBALS['log_backup_file'];
			if(file_exists($log_backup_file)) {
				$myfile = fopen($log_backup_file, "r");
				while(!feof($myfile)) {
					$log = "";
					$log = fgets($myfile);
					$log = trim($log);
					if(!empty($log)) {
						$log = json_decode($log);
						$log_list[] = $log;
					}
				}
				fclose($myfile);
				if(!empty($log_list)) {
					$list = array();
					foreach($log_list as $row) {							
						if(!empty($from_date) && !empty($to_date)) {
							$success = 0; $action = "";
							foreach($row as $key => $value) {								
								if( (!empty($key) && $key == "action")) {
									$action = $value;
								}
							}
							if(!empty($action)) {
								foreach($row as $key => $value) {
									if( (!empty($key) && $key == "created_date_time")) {
										if( ( date("d-m-Y", strtotime($value)) >= date("d-m-Y", strtotime($from_date)) ) && ( date("d-m-Y", strtotime($value)) <= date("d-m-Y", strtotime($to_date)) ) ) {
											$success = 1;										
										}
									}
								}
							}
							if(!empty($success) && $success == 1) {
								$list[] = $row;
							}
						}
					}
					$log_list = $list;
				}
			}
			return $log_list;
        }

		public function send_mobile_details($phone_number, $msg) {		
			$phone_number = '91'.$phone_number;
			$mailin = new MailinSms($GLOBALS['mailin_sms_api_key']);
			$mailin->addTo($phone_number);
			$mailin->setFrom('ram');
			$mailin->setText($msg);
			$mailin->setTag('');
			$mailin->setType('');
			$mailin->setCallback('');
			$res = $mailin->send();
			return $res;
		}
	
		public function CheckStaffAccessPage($staff_id,$permission_page) {
			$list = array(); $select_query = ""; $acccess_permission = 0;
			$select_query = "SELECT * FROM ".$GLOBALS['branch_staff_table']." WHERE staff_id = '".$staff_id."' AND deleted = '0'";
			$list = $this->getQueryRecords($GLOBALS['branch_staff_table'], $select_query);
			if(!empty($list)) {
				$access_pages = "";
				foreach($list as $data) {
					if(!empty($data['access_pages'])) {
						$access_pages = $data['access_pages'];
					}
				}

				if(!empty($access_pages)) {
					$access_pages = explode(",", $access_pages);
					if(!empty($permission_page)) {
						$permission_page = $this->encode_decode('encrypt', $permission_page);
						if(in_array($permission_page, $access_pages)) {
							$acccess_permission = 1;
						}
					}
				}
			}
			return $acccess_permission;
		}

		public function getOtherCityList($district) {
			$company_query = ""; 
			$select_query = ""; $list = array(); $party_query = ""; $suspense_party_query = "";

			$company_query = "SELECT DISTINCT(city) as others_city FROM ".$GLOBALS['company_table']." WHERE district = '".$district."' AND city != '".$GLOBALS['null_value']."' ORDER BY id DESC";
			$party_query = "SELECT DISTINCT(city) as others_city FROM ".$GLOBALS['party_table']." WHERE district = '".$district."' AND city != '".$GLOBALS['null_value']."' ORDER BY id DESC";
			
			$select_query = " SELECT DISTINCT others_city AS city FROM (($company_query) UNION ALL ($party_query)) AS g ORDER BY city DESC";
			$list = $this->getQueryRecords('', $select_query);

			return $list;
		}

		public function CompanyCount() {
			$select_query = ""; $list = array(); $count = 0;
			$select_query = "SELECT COUNT(id) as company_count FROM ".$GLOBALS['company_table']." WHERE deleted = '0'";
			$list = $this->getQueryRecords($GLOBALS['company_table'], $select_query);
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['company_count'])) {
						$count = $data['company_count'];
						$count = trim($count);
					}
				}
			}
			return $count;
		}
		public function CheckRoleAccessPage($role_id, $permission_page) {
			$list = array(); $select_query = ""; $acccess_permission = 0;
			$select_query = "SELECT * FROM ".$GLOBALS['role_table']." WHERE role_id = '".$role_id."' AND deleted = '0'";
			$list = $this->getQueryRecords($GLOBALS['role_table'], $select_query);
			if(!empty($list)) {
				$access_pages = "";
				foreach($list as $data) {
					if(!empty($data['access_pages'])) {
						$access_pages = $data['access_pages'];
					}
				}

				if(!empty($access_pages)) {
					$access_pages = explode(",", $access_pages);
					if(!empty($permission_page)) {
						$permission_page = $this->encode_decode('encrypt', $permission_page);
						if(in_array($permission_page, $access_pages)) {
							$acccess_permission = 1;
						}
					}
				}
			}

			return $acccess_permission;

		}
		public function getAllRecords($table, $column, $value) {
            $result = ""; $select_query = "";
            if(!empty($table)) {
                if($table == 'user'){
                    if(!empty($column) && !empty($value)) {     
                        $select_query = "SELECT * FROM ".$table." WHERE ".$column." = '".$value."' ORDER BY id DESC";   
                    }
                    else if(empty($column) && empty($value)) {      
                        $select_query = "SELECT * FROM ".$table." ORDER BY id DESC";    
                    }
                }
                else{
                    if(!empty($column) && !empty($value)) {     
                        $select_query = "SELECT * FROM ".$table." WHERE ".$column." = '".$value."' ORDER BY id DESC";   
                    }
                    else if(empty($column) && empty($value)) {      
                        $select_query = "SELECT * FROM ".$table." ORDER BY id DESC";    
                    }
                }
            }   
			
            if(!empty($select_query)) {
                $result = $this->getQueryRecords($table, $select_query);
            }
            return $result;
        }

		public function numberFormat($number, $decimals) {
            $is_negative = 0;
            if(strpos($number,'-') !== false) {
                $number = trim(substr($number, 1));
                $is_negative = 1;
            }
            $number = number_format($number, $decimals);
            $number = trim(str_replace(",", "", $number));
            
            if (strpos($number,'.') != null) {
                $decimalNumbers = substr($number, strpos($number,'.'));
                $decimalNumbers = substr($decimalNumbers, 1, $decimals);
            }
            else {
                $decimalNumbers = 0;
                for ($i = 2; $i <=$decimals ; $i++) {
                    $decimalNumbers = $decimalNumbers.'0';
                }
            }    
            $number = (int) $number;
            // reverse
            $number = strrev($number);    
            $n = '';
            $stringlength = strlen($number);
        
            for ($i = 0; $i < $stringlength; $i++) {
                if ($i%2==0 && $i!=$stringlength-1 && $i>1) {
                    $n = $n.$number[$i].',';
                }
                else {
                    $n = $n.$number[$i];
                }
            }
        
            $number = $n;
            // reverse
            $number = strrev($number);
                
            ($decimals!=0)? $number=$number.'.'.$decimalNumbers : $number ;
        
            $number = $number;
            if($is_negative == '1') {
                $number = '- '.$number;
            }
            return $number;
        }
		
	}	
?>