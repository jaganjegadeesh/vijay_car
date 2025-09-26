<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['job_card_module'];
        }
    }
	if(isset($_REQUEST['show_job_card_id'])) { 
        $show_job_card_id = $_REQUEST['show_job_card_id'];
        $show_job_card_id = trim($show_job_card_id);
        $job_card_date = date('Y-m-d'); $current_date = date('Y-m-d');
        
        $job_card_list = $obj->getTableRecords($GLOBALS['job_card_table'], 'job_card_id', $show_job_card_id, '');   
        if(!empty($job_card_list)) {
            foreach($job_card_list as $data) {
                if(!empty($data['job_card_date'])) {
                    $job_card_date = date('Y-m-d', strtotime($data['job_card_date']));
                }
                if(!empty($data['job_card_number']) && $data['job_card_number'] != $GLOBALS['null_value']) {
                    $job_card_number = $data['job_card_number'];
                }
                if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                    $party_id = $data['party_id'];
                }
                if(!empty($data['department_id']) && $data['department_id'] != $GLOBALS['null_value']) {
                    $department_id = $data['department_id'];
                }
                if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']) {
                    $engineer_id = $data['engineer_id'];
                    $engineer_id = explode(",", $engineer_id);
                    $product_count = count($engineer_id);
                    $engineer_id = array_reverse($engineer_id);
                }
                if(!empty($data['vehicle_id']) && $data['vehicle_id'] != $GLOBALS['null_value']) {
                    $vehicle_id = $data['vehicle_id'];
                }
                if(!empty($data['vehicle_details']) && $data['vehicle_details'] != $GLOBALS['null_value']) {
                    $vehicle_details = $data['vehicle_details'];
                }
                if(!empty($data['work_details']) && $data['work_details'] != $GLOBALS['null_value']) {
                    $work_details = $data['work_details'];
                }
            }
        }
        $party_list = array();
        $party_list = $obj->getPartyList('2'); 
        $department_list = array();
        $department_list = $obj->getTableRecords($GLOBALS['department_table'],'', '');
        $engineer_list = array();
        $engineer_list = $obj->getTableRecords($GLOBALS['engineer_table'],'','');
        $vehicle_list = array();
        $vehicle_list = $obj->getTableRecords($GLOBALS['vehicle_table'],'','');
        ?>
        <form class="poppins pd-20 redirection_form" name="job_card_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_job_card_id)) {  ?>
						    <div class="h5">Edit Job Card</div>
                            <?php
                        }else{ ?>
						    <div class="h5">Add Job Card</div>
                        <?php

                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('job_card.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_job_card_id)) { echo $show_job_card_id; } ?>">
                <div class="col-lg-2 col-md-3 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="job_card_date" class="form-control shadow-none" placeholder="" required="" value="<?php if(!empty($job_card_date)) { echo $job_card_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                            <label>Date</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border chargesaction">
                            <div class="input-group">
                                <select class="select2 select2-danger" name="party_id" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:HideDetails('party');">
                                    <option value="">Select</option>
                                    <?php if(!empty($party_list)) {
                                        foreach ($party_list as $data) {
                                            if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                                            ?>
                                                <option value="<?php echo $data['party_id']; ?>" <?php if(!empty($party_id) && $party_id == $data['party_id']) { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['name_mobile_city']) && $data['name_mobile_city'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['name_mobile_city']);
                                                        }
                                                    ?>
                                                </option>
                                            <?php
                                            }
                                        }
                                    } ?>
                                </select>
                                <label>Select Party</label>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="Javascript:CustomAddModalContent('party');" style="background-color:#f06548!important; cursor:pointer; height:100%;"><i class="fa fa-plus text-white"></i></span>
                                </div>
                            </div>
                            <a href="Javascript:ViewPartyDetails('party');" class="<?php if(empty($show_job_card_id)){?>d-none<?php }?> details_element" style="font-size: 12px;font-weight: bold;">Click to view details</a>
                        </div>
                    </div>    
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="department_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Department</option>
                                <?php if(!empty($department_list)) {
                                    foreach ($department_list as $data) {
                                        if(!empty($data['department_id']) && $data['department_id'] != $GLOBALS['null_value']) {
                                        ?>
                                            <option value="<?php echo $data['department_id']; ?>" <?php if(!empty($department_id) && $department_id == $data['department_id']) { ?>selected<?php } ?>>
                                                <?php
                                                    if(!empty($data['department_name']) && $data['department_name'] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt',$data['department_name']);
                                                    }
                                                ?>
                                            </option>
                                        <?php
                                        }
                                    }
                                } ?>
                            </select>
                            <label>Select Department</label>
                        </div>
                    </div>    
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border mb-0">
                            <select class="select2 select2-danger" name="engineer_id[]" data-dropdown-css-class="select2-danger" style="width: 100%;" multiple placeholder="select">
                                <option value="">Select Engineer</option> 
                                <?php if(!empty($engineer_list)) {
                                    foreach ($engineer_list as $data) {
                                        if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']) {
                                        ?>
                                            <option value="<?php echo $data['engineer_id']; ?>" <?php if(!empty($engineer_id) && in_array($data['engineer_id'], $engineer_id)) { ?>selected<?php } ?>>
                                                <?php
                                                    if(!empty($data['engineer_name']) && $data['engineer_name'] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt',$data['engineer_name']);
                                                    }
                                                ?>
                                            </option>
                                        <?php
                                        }
                                    }
                                } ?>
                            </select>
                            <label>Select Engineer</label>
                        </div>
                    </div>        
                </div> 
                <div class="col-lg-3 col-md-4 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border chargesaction">
                            <div class="input-group">
                                <select class="select2 select2-danger" name="vehicle_id" onchange="GetVehicleDetails();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="">Select Vehicle No</option>
                                    <?php if(!empty($vehicle_list)) {
                                        foreach ($vehicle_list as $data) {
                                            if(!empty($data['vehicle_id']) && $data['vehicle_id'] != $GLOBALS['null_value']) {
                                            ?>
                                                <option value="<?php echo $data['vehicle_id']; ?>" <?php if(!empty($vehicle_id) && $vehicle_id == $data['vehicle_id']) { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['vehicle_no']) && $data['vehicle_no'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['vehicle_no']);
                                                        }
                                                    ?>
                                                </option>
                                            <?php
                                            }
                                        }
                                    } ?>
                                    <label>Vehicle No</label>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="Javascript:CustomAddModalContent('vehicle');" style="background-color:#f06548!important; cursor:pointer; height:100%;"><i class="fa fa-plus text-white"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 px-lg-1 py-2" style="pointer-events: none;">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="vehicle_details" name="vehicle_details" tabindex="1" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',25,1);" placeholder="" value="<?php if(!empty($vehicle_details) && $vehicle_details != $GLOBALS['null_value']) { echo $obj->encode_decode('decrypt', $vehicle_details); } ?>" >
                            <label>Vehicle Details</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" id="work_details" name="work_details" onkeydown="Javascript:KeyboardControls(this,'',150,'1')"; placeholder="Enter Your Details"><?php if(!empty($work_details) && $work_details != $GLOBALS['null_value']) { echo trim( $obj->encode_decode('decrypt', $work_details)); } ?></textarea>
                            <label>Work Details </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent(event, 'job_card_form', 'job_card_changes.php', 'job_card.php');"> Submit </button>
                </div>
            </div>    
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 
    if(isset($_REQUEST['edit_id'])) {
        $job_card_date = ""; $job_card_date_error = ""; $party_id = ""; $party_id_error = "";
        $form_name = "job_card_form"; $edit_id = ""; $valid_job_card = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        $job_card_date = $_POST['job_card_date'];
        $job_card_date = trim($job_card_date);
        $job_card_date_error = $valid->common_validation($job_card_date, 'Entry Date', '1');
        if(!empty($job_card_date_error)) {
            if(!empty($valid_job_card)) {
                $valid_job_card = $valid_job_card." ".$valid->error_display($form_name, 'job_card_date', $job_card_date_error, 'text');
            }
            else {
                $valid_job_card = $valid->error_display($form_name, 'job_card_date', $job_card_date_error, 'text');
            }
        }

        if(isset($_POST['party_id']))
        {
            $party_id = $_POST['party_id'];
            $party_id = trim($party_id);
            if(!empty($party_id)) {
                $party_unique_id = '';
                $party_unique_id = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'id');
                if(!preg_match("/^\d+$/", $party_unique_id)) {
                    $party_id_error = "Invalid Party";
                }
            }
            else
            {
                $party_id_error ="Select the party ";
            }   
        }
        
        if(!empty($party_id_error)) {
            if(!empty($valid_job_card)) {
                $valid_job_card = $valid_job_card." ".$valid->error_display($form_name, 'party_id', $party_id_error, 'select');
            }
            else {
                $valid_job_card = $valid->error_display($form_name, 'party_id', $party_id_error, 'select');
            }
        }

        if(isset($_POST['department_id']))
        {
            $department_id = $_POST['department_id'];
            $department_id = trim($department_id);
            if(!empty($department_id)) {
                $department_unique_id = "";
                $department_unique_id = $obj->getTableColumnValue($GLOBALS['department_table'], 'department_id', $department_id, 'id');
                if(!preg_match("/^\d+$/", $department_unique_id)) {
                    $department_id_error = "Invalid Department";
                }
            } else {
                $department_id_error = "Select the department ";
            }
        }
        if(!empty($department_id_error)) {
            if(!empty($valid_job_card)) {
                $valid_job_card = $valid_job_card." ".$valid->error_display($form_name, 'department_id', $department_id_error, 'select');
            }
            else {
                $valid_job_card = $valid->error_display($form_name, 'department_id', $department_id_error, 'select');
            }
        }
        if(isset($_POST['engineer_id']))
        {
            $engineer_id = $_POST['engineer_id'];
            if(!empty($engineer_id) && is_array($engineer_id)) {
                $engineer_id = array_map('trim', $engineer_id);
                $engineer_id = array_filter($engineer_id);
                $engineer_id = array_unique($engineer_id);
                $engineer_id = array_values($engineer_id);
                $engineer_count = count($engineer_id);
                if($engineer_count > 0) {
                    foreach($engineer_id as $key => $value) {
                        $engineer_unique_id = '';
                        $engineer_unique_id = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $value, 'id');
                        if(!preg_match("/^\d+$/", $engineer_unique_id)) {
                            $engineer_id_error = "Invalid Engineer";
                            break;
                        }
                    }
                }
            }
        }
        if(empty($engineer_id)) {
            $engineer_id_error = "Select the engineer ";
        }
        if(!empty($engineer_id_error)) {
            if(!empty($valid_job_card)) {
                $valid_job_card = $valid_job_card." ".$valid->error_display($form_name, 'engineer_id[]', $engineer_id_error, 'select');
            }
            else {
                $valid_job_card = $valid->error_display($form_name, 'engineer_id[]', $engineer_id_error, 'select');
            }
        }

        if(isset($_POST['vehicle_id']))
        {
            $vehicle_id = $_POST['vehicle_id'];
            $vehicle_id = trim($vehicle_id);
            if(!empty($vehicle_id)) {
                $vehicle_unique_id = '';
                $vehicle_unique_id = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'vehicle_id', $vehicle_id, 'id');
                if(!preg_match("/^\d+$/", $vehicle_unique_id)) {
                    $vehicle_id_error = "Invalid Vehicle";
                }
            } else {
                $vehicle_id_error = "Select the vehicle ";
            }
        }
        if(!empty($vehicle_id_error)) {
            if(!empty($valid_job_card)) {
                $valid_job_card = $valid_job_card." ".$valid->error_display($form_name, 'vehicle_id', $vehicle_id_error, 'select');
            }
            else {
                $valid_job_card = $valid->error_display($form_name, 'vehicle_id', $vehicle_id_error, 'select');
            }
        }
        $vehicle_details = $_POST['vehicle_details'];
        $vehicle_details = trim($vehicle_details);
        $vehicle_details_error = $valid->common_validation($vehicle_details, 'Vehicle Details', '1');
        if(!empty($vehicle_details_error)) {
            if(!empty($valid_job_card)) {
                $valid_job_card = $valid_job_card." ".$valid->error_display($form_name, 'vehicle_details', $vehicle_details_error, 'text');
            }
            else {
                $valid_job_card = $valid->error_display($form_name, 'vehicle_details', $vehicle_details_error, 'text');
            }
        }
        $work_details = $_POST['work_details'];
        $work_details = trim($work_details);
        if(!empty($work_details)) {
            $work_details_error = $valid->common_validation($work_details, 'Work Details', '0');
            if(!empty($work_details_error)) {
                if(!empty($valid_job_card)) {
                    $valid_job_card = $valid_job_card." ".$valid->error_display($form_name, 'work_details', $work_details_error, 'textarea');
                }
                else {
                    $valid_job_card = $valid->error_display($form_name, 'work_details', $work_details_error, 'textarea');
                }
            }
        }

        $result = "";
        if(empty($valid_job_card)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $bill_company_id =$GLOBALS['bill_company_id'];
                $bill_company_details = "";
                if (!empty($bill_company_id)) {
                    $bill_company_details = $obj->BillCompanyDetails($bill_company_id, $GLOBALS['job_card_table']);
                }
    
                if(!empty($job_card_date)) {
                    $job_card_date = date('Y-m-d', strtotime($job_card_date));
                }
                $party_name ="";
                if(!empty($party_id)) {
                    $party_name_mobile_city = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'name_mobile_city');
                    $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_name');
                    $party_details = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_details');
                }
                else {
                    $party_id = $GLOBALS['null_value'];
                    $party_name = $GLOBALS['null_value'];
                    $party_name_mobile_city = $GLOBALS['null_value'];
                    $party_details = $GLOBALS['null_value'];
                }
                if(!empty($department_id)) {
                    $department_name = $obj->getTableColumnValue($GLOBALS['department_table'], 'department_id', $department_id, 'department_name');
                }
                else {
                    $department_id = $GLOBALS['null_value'];
                    $department_name = $GLOBALS['null_value'];
                }
                if(!empty($vehicle_id)) {
                    $vehicle_no = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'vehicle_id', $vehicle_id, 'vehicle_no');
                }
                else {
                    $vehicle_id = $GLOBALS['null_value'];
                    $vehicle_no = $GLOBALS['null_value'];
                }
                if(!empty($vehicle_details)) {
                    $vehicle_details = $obj->encode_decode('encrypt', $vehicle_details);
                } else {
                    $vehicle_details = $GLOBALS['null_value'];
                }
                if(!empty($engineer_id)) {
                    $engineer_id = array_reverse($engineer_id);
                    $engineer_id = implode(",", $engineer_id);
                }else{
                    $engineer_id = $GLOBALS['null_value'];
                }
                if(!empty($work_details)) {
                    $work_details = trim($work_details);
                    $work_details = $obj->encode_decode('encrypt', $work_details);
                } else {
                    $work_details = $GLOBALS['null_value'];
                }
                $bill_company_id = $GLOBALS['bill_company_id']; 
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                if(empty($edit_id)) {
                    $action = "New Job Card Created. ";
                    $null_value = $GLOBALS['null_value'];
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'bill_company_details', 'job_card_id', 'job_card_number', 'job_card_date','party_id', 'party_name_mobile_city', 'party_details', 'department_id', 'department_name', 'engineer_id', 'vehicle_id', 'vehicle_no', 'vehicle_details', 'work_details','deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$bill_company_details."'", "'".$null_value."'", "'".$null_value."'", "'".$job_card_date."'", "'".$party_id."'", "'".$party_name_mobile_city."'", "'".$party_details."'", "'".$department_id."'", "'".$department_name."'", "'".$engineer_id."'", "'".$vehicle_id."'", "'".$vehicle_no."'", "'".$vehicle_details."'", "'".$work_details."'", "'0'");

                    $job_card_insert_id = $obj->InsertSQL($GLOBALS['job_card_table'], $columns, $values,'job_card_id','job_card_number',$action);
        
                    if(preg_match("/^\d+$/", $job_card_insert_id)) {
                        $job_card_id = $obj->getTableColumnValue($GLOBALS['job_card_table'],'id',$job_card_insert_id,'job_card_id');
                        $job_card_number = $obj->getTableColumnValue($GLOBALS['job_card_table'],'id',$job_card_insert_id,'job_card_number');

                        $result = array('number' => '1', 'msg' => 'Job Card Successfully Created','redirection_page' =>'job_card.php');					
                    }  else {
                        $result = array('number' => '2', 'msg' => $job_card_insert_id);
                    }
                } else {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['job_card_table'], 'job_card_id', $edit_id, 'id');
                    $job_card_number = $obj->getTableColumnValue($GLOBALS['job_card_table'], 'job_card_id', $edit_id, 'job_card_number');
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "Job Card Updated. Bill No. - ".$job_card_number;
                        $columns = array(); $values = array();						
                        $columns = array('creator_name','bill_company_id', 'bill_company_details', 'job_card_date','party_id', 'party_name_mobile_city', 'party_details', 'department_id', 'department_name', 'engineer_id', 'vehicle_id', 'vehicle_no', 'vehicle_details', 'work_details');
                        $values = array("'".$creator_name."'", "'".$bill_company_id."'", "'".$bill_company_details."'", "'".$job_card_date."'", "'".$party_id."'", "'".$party_name_mobile_city."'", "'".$party_details."'", "'".$department_id."'", "'".$department_name."'", "'".$engineer_id."'", "'".$vehicle_id."'", "'".$vehicle_no."'", "'".$vehicle_details."'", "'".$work_details."'");

                         $job_card_update_id = $obj->UpdateSQL($GLOBALS['job_card_table'], $getUniqueID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $job_card_update_id)) {
                            $job_card_id = $edit_id;
                            $job_card_number = $obj->getTableColumnValue($GLOBALS['job_card_table'], 'job_card_id', $edit_id, 'job_card_number');
                            $result = array('number' => '1', 'msg' => 'Updated Successfully','redirection_page' =>'job_card.php');
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $job_card_update_id);
                        }	
                    }
                }
            } else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }  else {
            if(!empty($valid_job_card)) {
                $result = array('number' => '3', 'msg' => $valid_job_card);
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
        $from_date = ""; $to_date = ""; $search_text = ""; $party_id = "";
        $show_bill = 0;$show_draft_bill = 0;
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }
        if(isset($_POST['show_bill'])) {
            $show_bill = $_POST['show_bill'];
        }
        if(isset($_POST['search_text'])) {
            $search_text = $_POST['search_text'];
        }

        if(isset($_POST['filter_party_id']))
        {
               $party_id = $_POST['filter_party_id'];
        }

        $total_records_list = array();
        $total_records_list = $obj->getJobCardList($from_date, $to_date,$show_bill,$party_id);
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['job_card_number']), $search_text) !== false) ) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }

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
		}
        ?> 
        <?php if($total_pages > $page_limit) { ?>
            <div class="pagination_cover mt-3"> 
                <?php include("pagination.php"); ?> 
            </div> 
        <?php } ?>
        <?php
   
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if(empty($access_error)) { ?>
        <table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Date</th>
                    <th>Job Number</th>
                    <th>Party</th>
                    <th>Department</th>
                    <th>Vehicle No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($show_records_list)) {
                        foreach($show_records_list as $key => $list) {
                            $index = $key + 1;
                            if(!empty($prefix)) { $index = $index + $prefix; }   
                            ?>
                            <tr>
                                <td class="ribbon-header" style="cursor:default;">
                                    <?php echo $index; ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['job_card_date'])) {
                                            echo date('d-m-Y', strtotime($list['job_card_date']));
                                        }
                                        if($list['invoice_status'] == "I") { 
                                            $invoice_number = $obj->getTableColumnValue($GLOBALS['invoice_table'],'invoice_id',$list['invoice_id'],'invoice_number'); ?>
                                            <br><span class="badge fs-12 text-bg-success text-dark">Invoice: <?php echo $invoice_number; ?></span>
                                        <?php } else if($list['estimate_status'] == "E") { 
                                            $estimate_number = $obj->getTableColumnValue($GLOBALS['estimate_table'],'estimate_id',$list['estimate_id'],'estimate_number'); ?>
                                            <br><span class="badge fs-12 text-bg-info text-dark">Estimate: <?php echo $estimate_number; ?></span>
                                        <?php } else if($list['quotation_status'] == "Q") { 
                                            $quotation_number = $obj->getTableColumnValue($GLOBALS['quotation_table'],'quotation_id',$list['quotation_id'],'quotation_number'); ?>
                                            <br><span class="badge fs-12 text-bg-warning text-dark">Quotation: <?php echo $quotation_number; ?></span>
                                        <?php }
                                        
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['job_card_number']) && $list['job_card_number'] != $GLOBALS['null_value']) {
                                            echo $list['job_card_number'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['party_name_mobile_city']) && $list['party_name_mobile_city'] != $GLOBALS['null_value']) {
                                            echo ($obj->encode_decode('decrypt', $list['party_name_mobile_city']));
                                        }
                                        else {
                                            echo '-';
                                        }
                                    
                                    if(!empty($list['deleted']) && $list['deleted'] == '1') {
                                        ?>
                                                <br><span style="color: red;">Cancelled</span>
                                        <?php	
                                    }	 
                                    ?>
                                    <p style="padding-top:10px;font-size:10px;">
                                        <?php
                                        if(!empty($list['creator_name'])) {
                                            $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                            echo " Creator : ". $list['creator_name'];
                                        }
                                        ?>   
                                    </p>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['department_name']) && $list['department_name'] != $GLOBALS['null_value']) {
                                            echo $obj->encode_decode('decrypt', $list['department_name']);
                                        }
                                        else {
                                            echo '-';
                                        }
                                    ?>
                                <td>
                                    <?php
                                        if(!empty($list['vehicle_no']) && $list['vehicle_no'] != $GLOBALS['null_value']) {
                                            echo $obj->encode_decode('decrypt', $list['vehicle_no']);
                                        }
                                        else {
                                            echo '-';
                                        }
                                    ?>
                                <td>
                                <?php 
                                    $edit_access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $edit_action;
                                        include('permission_action.php');
                                    }
                                    $delete_access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $delete_action;
                                        include('permission_action.php');
                                    }
                                ?>

                                    <div class="dropdown">
                                        <button class="btn btn-dark show-button py-1 px-2" type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <?php 
                                                if(empty($edit_access_error) && $list['deleted'] == '0') {
                                                    ?>
                                                    <li>
                                                        <a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['job_card_id'])) { echo $list['job_card_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a>
                                                    </li>
                                                    <?php
                                                } 
                                            ?>  
                                                <?php 
                                                if(empty($delete_access_error) && $list['deleted'] == '0') {
                                                    ?>
                                                        <li>
                                                            <a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['job_card_id'])) { echo $list['job_card_id']; } ?>');"><i class="fa fa-trash"></i> &ensp;  Delete</a>
                                                        </li>  
                                                    <?php
                                                } 
                                            ?>  
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" class="text-center">Sorry! No records found</td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>                  
		<?php }
    } 

    if(isset($_REQUEST['get_vehicle_details'])) {
        $vehicle_id = $_REQUEST['get_vehicle_details'];
        $vehicle_id = trim($vehicle_id);
        $vehicle_details = "";
        if(!empty($vehicle_id)) {
            $vehicle_list = array();
            $vehicle_list = $obj->getTableRecords($GLOBALS['vehicle_table'], 'vehicle_id', $vehicle_id);
            if(!empty($vehicle_list)) {
                foreach($vehicle_list as $data) {
                    if(!empty($data['vehicle_details']) && $data['vehicle_details'] != $GLOBALS['null_value']) {
                        $vehicle_details = $obj->encode_decode('decrypt', $data['vehicle_details']);
                    }
                }
            }
        }
        echo $vehicle_details;
        exit;
    }

    if(isset($_REQUEST['delete_job_card_id'])) {
        $delete_job_card_id = $_REQUEST['delete_job_card_id'];
        $delete_job_card_id = trim($delete_job_card_id);
        $msg = "";
        if(!empty($delete_job_card_id)) {	
            $job_card_unique_id = ""; $voucher_unique_id = ""; $voucher_id = "";
            $job_card_list = $obj->getTableRecords($GLOBALS['job_card_table'], 'job_card_id', $delete_job_card_id);
            $job_card_unique_id = $job_card_list[0]['id'];
            if(preg_match("/^\d+$/", $job_card_unique_id)) {
                $bill_number = "";
                $bill_number = $job_card_list[0]['job_card_number'];
            
                $action = "";
                $invoice_delete = $job_card_list[0]['invoice_status'];
                $estimate_delete = $job_card_list[0]['estimate_status'];
                $quotation_delete = $job_card_list[0]['quotation_status'];
                $store_delete = $obj->getTableRecords($GLOBALS['store_entry_table'],'job_card_id',$delete_job_card_id);
                if($quotation_delete == '0' && $estimate_delete == '0' && $invoice_delete == '0' && empty($store_delete))  {
                    $action = "Job Card Deleted. Job Card No. - ".$bill_number;
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['job_card_table'], $job_card_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "Can't Delete.";
                }
            }
            else {
                $msg = "Invalid Job Card";
            }
        }
        else {
            $msg = "Empty Job Card";
        }
        echo $msg;
        exit;	
    } 
    ?>