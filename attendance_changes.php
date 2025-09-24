<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['attendance_module'];
        }
    }
	if(isset($_REQUEST['show_attendance_id'])) {
        $show_attendance_id = "";
        $show_attendance_id = $_REQUEST['show_attendance_id'];

        $attendance_date = date("Y-m-d"); $current_date = date("Y-m-d");$is_salaried = 0;
        if(!empty($show_attendance_id)) {
            $attendance_list = array();
			$attendance_list = $obj->getTableRecords($GLOBALS['attendance_table'], 'attendance_id', $show_attendance_id);
            if(!empty($attendance_list)) {
                foreach($attendance_list as $data) {
                    if(!empty($data['attendance_date']) && $data['attendance_date'] != "0000-00-00") {
                        $attendance_date = date('Y-m-d', strtotime($data['attendance_date']));
                    }
                    if($data['is_salaried'] == '1') {
                        $is_salaried = 1;
                    }
                }
            }
		}
        
        $daily_worker_list = array();
        $daily_worker_list = $obj->DailyWorkerDetails(); 
        
        ?>

        <form class="poppins pd-20" name="attendance_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<div class="h5">Add Attendance</div>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('attendance.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_attendance_id)) { echo $show_attendance_id; } ?>">
                <div class="col-lg-2 col-md-3 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" id="attendance_date" value="<?php if(!empty($attendance_date)){ echo $attendance_date; } ?>" name="attendance_date" class="form-control shadow-none" max="<?php if(!empty($current_date)) { echo $current_date; } ?>" placeholder="" required>
                            <label>Date</label>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="row justify-content-center p-1">  
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="table-responsive">
                        <table class="table nowrap cursor text-center smallfnt table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>S.No</th>
                                    <th>Engineer Name</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(empty($show_attendance_id)){
                                        if(!empty($daily_worker_list)) { 
                                            foreach($daily_worker_list as $key => $data) {
                                                $index = $key + 1; 
                                                ?>  
                                                <tr class="attendance_row" style="vertical-align:middle;">
                                                    <td class="text-center"><?php echo $index; ?></td>
                                                    <td class="text-center">
                                                        <?php 
                                                            if(!empty($data['engineer_name'])) {
                                                                $data['engineer_name'] = $obj->encode_decode('decrypt', $data['engineer_name']);
                                                                echo $data['engineer_name'];
                                                            } 
                                                        ?>
                                                        <input name="engineer_id[]" type="hidden" value="<?php if(!empty($data['engineer_id'])){ echo $data['engineer_id'] ; } ?>">
                                                    </td>
                                                    <td class="text-center">
                                                        <input name="<?php echo $data['engineer_id']; ?>_full_present" type="checkbox" class="form-check-input full_present"
                                                        value="1" checked onclick="presentCheck(this)">
                                                    </td>
                                                </tr>
                                                <?php       
                                            }
                                        }
                                    }
                                    else{
                                        if(!empty($attendance_list)) {
                                            $attendance_list = array_reverse($attendance_list);
                                            foreach($attendance_list as $key => $data) { 
                                                $index = $key + 1;
                                                $is_salaried = 0;
                                                if($data['is_salaried'] == '1') {
                                                    $is_salaried = 1;
                                                }
                                                ?>
                                                <tr class="attendance_row" style="vertical-align:middle;">
                                                    <td class="text-center"><?php echo $index; ?></td>
                                                    <td class="text-center">
                                                        <?php 
                                                            if(!empty($data['engineer_name']) && $data['engineer_name'] != $GLOBALS['null_value']) {
                                                                $data['engineer_name'] = $obj->encode_decode('decrypt', $data['engineer_name']);
                                                                echo $data['engineer_name'];
                                                            }
                                                        ?>
                                                        <input name="engineer_id[]" type="hidden" value="<?php if(!empty($data['engineer_id'])){ echo $data['engineer_id'] ; } ?>">
                                                    </td class="text-center">
                                                    <td class="text-center">
                                                        <input name="<?php echo $data['engineer_id']; ?>_full_present" type="checkbox"  class="form-check-input full_present" value="<?php 
                                                                if (!empty($data['present_status'])) { 

                                                                    if ($data['present_status'] != 'A') { 
                                                                        echo '1'; 
                                                                        
                                                                    } else{
                                                                        echo '0';
                                                                    }

                                                                    
                                                                } 
                                                            ?>" 
                                                            <?php 
                                                                if (!empty($data['present_status'])) { 
                                                                    if ($data['present_status'] != 'A') { 
                                                                        echo 'checked'; 
                                                                    } 
                                                                } 
                                                            ?> onclick="presentCheck(this)" <?php if($is_salaried == '1') { ?>disabled<?php } ?>>
                                                        <?php
                                                            if($is_salaried == '1') {
                                                                ?>
                                                                <input type="hidden" name="<?php echo $data['engineer_id']; ?>_full_present" value="<?php 
                                                                    if (!empty($data['present_status'])) { 
                                                                        if ($data['present_status'] != 'A') { 
                                                                            echo '1'; 
                                                                        } else{
                                                                            echo '0';
                                                                        }
                                                                    } 
                                                                ?>">
                                                                <?php
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                                <!-- <tr style="vertical-align:middle;">
                                    <td>01</td>
                                    <td>Mahesh Prabhu</td>
                                    <td><input type="checkbox" class="form-check-input" id="exampleCheck1"> </td>
                                    <td> <input type="checkbox" class="form-check-input" id="exampleCheck2"></td>
                                    <td> <input type="checkbox" class="form-check-input" id="exampleCheck3"></td>
                                </tr> -->
                            </tbody>
                        </table> 
                    </div>
                </div>
                <div class="col-md-12 pt-3 text-center">
                <button class="btn btn-danger btnwidth submit_button" type="button" onClick="Javascript:SaveModalContent(event, 'attendance_form', 'attendance_changes.php', 'attendance.php');">Submit</button>
            </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    }

    if(isset($_POST['edit_id'])) {	
		$attendance_date = ""; $attendance_date_error = "";$engineer_ids = array(); $engineer_name = array();
        $full_present = array(); $fn_present = array(); $an_present = array(); $full_presents = array();$fn_presents = array(); $an_presents = array();  $attendance_error = ""; $per_day_salary =0; 
        $edit_id = ""; $valid_attendance = ""; $form_name = "attendance_form"; $current_date = date("d-m-Y");
        
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        
        if(isset($_POST['attendance_date'])) {
            $attendance_date = $_POST['attendance_date'];
            $attendance_date = trim($attendance_date);
            $attendance_date = date('Y-m-d', strtotime($attendance_date));
            $attendance_date_error = $valid->valid_date($attendance_date, "Date", "1");
            if(empty($attendance_date_error)) {
                if(strtotime($attendance_date) > strtotime($current_date)) {
                    $attendance_date_error = "Future Date not allowed";
                }
            }
            if(!empty($attendance_date_error)) {
                $valid_attendance = $valid->error_display($form_name, "attendance_date", $attendance_date_error, 'text');	
            }
        }
        
        if(isset($_POST['engineer_id'])) {
            $engineer_ids = $_POST['engineer_id'];
        }
        
		$engineer_daily_salaries = array(); $total_salaries = array(); $full_value = 0; $full_presents = array();
    
        if(!empty($engineer_ids)) {
            for($i=0; $i < count($engineer_ids); $i++) {
                $engineer_ids[$i] = trim($engineer_ids[$i]);  
                $total_salary =0;

                if(!empty($engineer_ids[$i])) {
                    $engineer_name = "";
                    $engineer_name = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $engineer_ids[$i], 'engineer_name');
                    $engineer_names[$i] = $engineer_name;
                
                    $engineer_monthly_salary = 0;
                    $engineer_monthly_salary = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $engineer_ids[$i], 'salary');
                    
                    $timestamp = strtotime($attendance_date);
                    
                    $month = date("m", $timestamp);
                    $year  = date("Y", $timestamp);

                    // Get number of days in that month
                    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                    // Per day salary
                    $per_day_salary = $engineer_monthly_salary / $days_in_month;

                    
                    
                    if (isset($_POST[$engineer_ids[$i].'_full_present']) && $_POST[$engineer_ids[$i].'_full_present'] == '1') {
                        $full_presents[$i] = 'P';
                        $per_day_salary = $per_day_salary;
                    } else {
                        $full_presents[$i] = 'A';
                        $per_day_salary = 0;
                    }

                    $engineer_daily_salaries[$i] = round($per_day_salary,2);
                }
            }
        }
        else{
            $attendance_error = "No Engineer Available";
        }

        $prev_present_id = "";$prev_engineer_name = "";
        if(!empty($attendance_date) && $attendance_date != $GLOBALS['null_value'] && empty($attendance_error)) {
            $prev_attendance_id = $obj->getPrevAttendanceID($attendance_date);
            if(!empty($prev_attendance_id) && $prev_attendance_id != $edit_id) {
                $attendance_error = "This Attendance Date is already Exists";
            }
        }
        if(!empty($attendance_date) && empty($attendance_error)){
            if(strtotime($attendance_date) > strtotime($current_date)){
                $attendance_error ="Attendance Date is Greater than today's Date ";
            }
        }
   

		$result = "";
		if(empty($valid_attendance) && empty($attendance_error)) {
			$check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {

				if(!empty($attendance_date)) {
                    $attendance_date = date('Y-m-d', strtotime($attendance_date));
                }

                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $bill_company_id =$GLOBALS['bill_company_id'];

                $attendance_id = date("dmYhis");
                $attendance_id = $obj->encode_decode('encrypt', $attendance_id);
                for($i=0;$i < count($engineer_ids);$i++) {
                    if(empty($edit_id)) {
                        if(empty($prev_attendance_id)) {						
                            $action = "";
                            if(!empty($engineer_names[$i])) {
                                $action = "New Attendance Created. Name - ". $engineer_names[$i];
                            }
                            $null_value = $GLOBALS['null_value'];
                            $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'attendance_id', 'attendance_date', 'engineer_id', 'engineer_name', 'present_status','daily_salary','total_salary','salary_id', 'is_salaried', 'deleted');
                            $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$attendance_date."'","'".$engineer_ids[$i]."'", "'".$engineer_names[$i]."'","'".$full_presents[$i]."'", "'".$engineer_daily_salaries[$i]."'","'".$engineer_daily_salaries[$i]."'", "'".$null_value."'", "'0'", "'0'");
                            $attendance_insert_id = $obj->InsertSQL($GLOBALS['attendance_table'], $columns, $values, 'attendance_id', '', $action);						
                            if(preg_match("/^\d+$/", $attendance_insert_id)) {
                                $attendance_id = "";
                                if($attendance_insert_id < 10) {
                                    $attendance_id = "ATTENDANCE_".$attendance_date;
                                }
                                else {
                                    $attendance_id = "ATTENDANCE_".$attendance_date;
                                }
                                if(!empty($attendance_id)) {
                                    $attendance_id = $obj->encode_decode('encrypt', $attendance_id);
                                }
                               
                                $columns = array(); $values = array();						
                                $columns = array('attendance_id');
                                $values = array("'".$attendance_id."'");
                                $attendance_update_id = $obj->UpdateSQL($GLOBALS['attendance_table'], $attendance_insert_id, $columns, $values, '');
                                if(preg_match("/^\d+$/", $attendance_update_id)) {	
                                    $update_attendance_id = $attendance_id;	
                                    $result = array('number' => '1', 'msg' => 'Attendance Successfully Created');					
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $attendance_update_id);
                                }
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $attendance_insert_id);
                            }
                        } else {
                            if(!empty($attendance_error)) {
                                $result = array('number' => '2', 'msg' => $attendance_error);
                            }
                        }
                    }
                    else {
                        if(empty($prev_attendance_id) || $prev_attendance_id == $edit_id) {
                            $getUniqueID = "";
                            $getUniqueID = $obj->AttendanceEngineerID($edit_id,$engineer_ids[$i],$attendance_date);
                            if(preg_match("/^\d+$/", $getUniqueID)) {
                                $action = "";
                                if(!empty($engineer_names[$i])) {
                                        $action = "Attendance Updated. Name - ". $engineer_names[$i];
                                }
                            
                                $columns = array(); $values = array();						
                                
                                $columns = array('creator_name','bill_company_id', 'attendance_date', 'engineer_name', 'present_status','daily_salary','total_salary');
                                $values = array("'".$creator_name."'", "'".$bill_company_id."'", "'".$attendance_date."'", "'".$engineer_names[$i]."'","'".$full_presents[$i]."'", "'".$engineer_daily_salaries[$i]."'","'".$engineer_daily_salaries[$i]."'");
                                $attendance_update_id = $obj->UpdateSQL($GLOBALS['attendance_table'], $getUniqueID, $columns, $values, $action);
                                if(preg_match("/^\d+$/", $attendance_update_id)) {
                                    $result = array('number' => '1', 'msg' => 'Updated Successfully');						
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $engineer_update_id);
                                }							
                            }else{
                                $result = array('number' => '2', 'msg' => 'Attendance ID Not Found');
                            }
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $engineer_error);
                        }
                    }
                }

			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_attendance)) {
				$result = array('number' => '3', 'msg' => $valid_attendance);
			}
            if(!empty($attendance_error)) {
				$result = array('number' => '2', 'msg' => $attendance_error);
			}
		}
		
		if(!empty($result)) {
			$result = json_encode($result);
		}
		echo $result; exit;
	}
    
    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title'];

		$from_date ="";
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }

        $to_date ="";
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }

        $total_records_list = array();
        $total_records_list = $obj->EngineerAttendanceList($from_date,$to_date);

		$total_pages = 0;	
		$total_pages = count($total_records_list);
		
		$page_start = 0; $page_end = 0;
		if(!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
			if($total_pages > $page_limit) {
				if($page_number) {
					$page_start = ($page_number - 1) * $page_limit;
					$page_end = $page_start + $page_limit;
				}
			}
			else {
				$page_start = 0;
				$page_end = $page_limit;
			}
		}

		$show_records_list = array();
        if(!empty($total_records_list)) {
            foreach($total_records_list as $key => $val) {
                if($key >= $page_start && $key < $page_end) {
                    $show_records_list[] = $val;
                }
            }
        }
		
		$prefix = 0;
		if(!empty($page_number) && !empty($page_limit)) {
			$prefix = ($page_number * $page_limit) - $page_limit;
        } ?>
        
		<?php if($total_pages > $page_limit) { ?>
			<div class="pagination_cover mt-3"> 
				<?php
					include("pagination.php");
				?> 
			</div> 
		<?php } ?>

		<table class="table cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Attendance Date</th>
                    <th>No.Of Engineer</th>
                    <th>No.Of Engineer (Present)</th>
                    <th>No.Of Engineer (Absent)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($show_records_list)) {
                        // $edit_action = $obj->encode_decode('encrypt', 'edit_action');
                        foreach($show_records_list as $key => $data) {
							$index = $key + 1;
							if(!empty($prefix)) { $index = $index + $prefix; } ?>
                            <tr>
                                <td class="text-center px-2 py-2"><?php echo $index; ?></td>
                                
                                <td class="text-center px-2 py-2">
                                    <?php
                                        if(!empty($data['attendance_date'])) {
                                        echo date('d-m-Y', strtotime($data['attendance_date']));
                                        }
                                    ?>    
                                </td>
                                <td class="text-center px-2 py-2">
                                    <?php
                                        $total_present =0;
                                        $total_present =$obj-> AttendanceDetails('total',$data['attendance_date']);
                                        echo $total_present;
                                    ?>    
                                </td>
                                <td class="text-center px-2 py-2">
                                    <?php
                                        $total_present =0;
                                        $total_present =$obj-> AttendanceDetails('P', $data['attendance_date']);
                                        echo $total_present;
                                    ?>    
                                </td>
                                <td class="text-center px-2 py-2">
                                    <?php
                                        $total_present =0;
                                        $total_present =$obj-> AttendanceDetails('A', $data['attendance_date']);
                                        echo $total_present;
                                    ?>    
                                </td>
                                <?php 
                                    $edit_access_error = "";
                                    if(!empty($login_staff_id)) {
                                        
                                        $permission_action = $edit_action;
                                        $permission_module = $GLOBALS['attendance_module'];
                                        
                                        include('permission_action.php');
                                    }

                                    $delete_access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_module = $GLOBALS['attendance_module'];
                                        $permission_action = $delete_action;
                                        include('permission_action.php');
                                    }

                                ?>
								<td class="text-center px-2 py-2">
                                    <?php 
                                    if(empty($edit_access_error)) {
                                         ?>
                                        <div class="dropdown">
                                            <a href="#" role="button" class="btn btn-dark py-1 px-1" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <?php $edit_access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $edit_action;
                                                    $permission_module = $GLOBALS['attendance_module'];
                                                    include('permission_action.php');
                                                }
                                                if(empty($edit_access_error) && empty($list['cancelled'])) {
                                                ?> 
                                                    <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['attendance_id'])) { echo $data['attendance_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a></li>
                                                <?php } ?>

                                                <?php  $delete_access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $delete_action;
                                                    $permission_module = $GLOBALS['attendance_module'];
                                                    include('permission_action.php');
                                                }
                                                if(empty($delete_access_error) && empty($list['cancelled'])) {
                                                    ?> 
                                                    <!-- <li><a class="dropdown-item" href="#">Delete</a></li> -->
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
								</td>
							</tr>
                <?php
                        }
                    }
                    else {
                ?>
                        <tr>
                            <td colspan="6" class="text-center">Sorry! No records found</td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php	
	}
    ?>