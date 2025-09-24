<?php

    include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['bank_module'];
        }
    }

	if(isset($_REQUEST['show_engineer_id'])) { 
        $show_engineer_id = "";
        $show_engineer_id = $_REQUEST['show_engineer_id'];

        $engineer_name = ""; $mobile_number = ""; $salary = ""; $engineer_code = ""; 

        if(!empty($show_engineer_id)) {
            $engineer_list = array();
            $engineer_list = $obj->getTableRecords($GLOBALS['engineer_table'], 'engineer_id', $show_engineer_id, '');
            if(!empty($engineer_list)) {
                foreach ($engineer_list as $data) {
                    if(!empty($data['engineer_name']) && ($data['engineer_name'] != $GLOBALS['null_value'])) {
                        $engineer_name = $obj->encode_decode('decrypt', $data['engineer_name']);
                    }
                    if(!empty($data['engineer_code']) && ($data['engineer_code'] != $GLOBALS['null_value'])) {
                        $engineer_code = $obj->encode_decode('decrypt', $data['engineer_code']);
                    }
                    if(!empty($data['mobile_number']) && ($data['mobile_number'] != $GLOBALS['null_value'])) {
                        $mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
                    }
                    if(!empty($data['salary']) && ($data['salary'] != $GLOBALS['null_value'])) {
                        $salary = $data['salary'];
                    }
                }
            }
        } 
        
        
        
        ?>
        <form class="poppins pd-20 redirection_form" name="engineer_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<?php if(!empty($show_engineer_id)){ ?>
                            <div class="h5">Edit Engineer</div>
                        <?php 
                        } else{ ?>
                            <div class="h5">Add Engineer</div>
                        <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('engineer.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_engineer_id)) { echo $show_engineer_id; } ?>">
                <div class="col-lg-2 col-md-4 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="selected_engineer_code" name="selected_engineer_code" class="form-control shadow-none" placeholder="" value="<?php if(!empty($engineer_code)) { echo $engineer_code; } ?>" onkeydown="Javascript:KeyboardControls(this,'',10,'');" onkeyup="Javascript:InputBoxColor(this,'text');" required>
                            <label>Engineer Code<span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="selected_engineer_name" name="selected_engineer_name" class="form-control shadow-none" placeholder="" value="<?php if(!empty($engineer_name)) { echo $engineer_name; } ?>" onkeydown="Javascript:KeyboardControls(this,'text',30,'');" onkeyup="Javascript:InputBoxColor(this,'text');" required>
                            <label>Engineer Name<span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="selected_mobile_number" name="selected_mobile_number" class="form-control shadow-none" placeholder="" value="<?php if(!empty($mobile_number)) { echo $mobile_number; } ?>" onkeydown="Javascript:KeyboardControls(this,'number',10,'');" onkeyup="Javascript:InputBoxColor(this,'text');" required>
                            <label>Mobile Number<span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group mb-1">
                                <input type="text" id="selected_salary" name="selected_salary" class="form-control shadow-none" placeholder="" value="<?php if(!empty($salary)) { echo $salary; } ?>" onkeydown="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:InputBoxColor(this,'text');" required>
                                <label>Salary<span class="text-danger">*</span></label>
                                <div class="input-group-append">
                                    <?php if(empty($show_engineer_id)) { ?>
                                        <button class="btn btn-danger" type="button" onclick="Javascript:addEngineerFormDetails();" ><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center"> 
                <?php if(empty($show_engineer_id)) { ?>
                    <div class="col-lg-9">
                        <div class="table-responsive text-center">
                            <input type="hidden" name="engineer_count" value="0">
                            <table class="table nowrap cursor smallfnt w-100 table-bordered added_engineer_table">
                                <thead class="bg-dark smallfnt">
                                    <tr style="white-space:pre;">
                                        <th>#</th>
                                        <th>Engineer Code</th>
                                        <th>Engineer Name</th>
                                        <th>Mobile Number</th>
                                        <th>Salary</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>    
                            </table>
                        </div>
                    </div>
                <?php } ?>    
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-danger submit_button" type="button" onClick="Javascript:SaveModalContent(event, 'engineer_form', 'engineer_changes.php', 'engineer.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 

    if(isset($_POST['edit_id'])) {
        $engineer_name = array(); $engineer_name_error = ""; $single_lower_case_name = "";
        $valid_engineer = ""; $form_name = "engineer_form"; $engineer_error = "";
        $single_engineer_name = "";  $lower_case_name = array();

        if(isset($_POST['engineer_count'])){
            $engineer_count = $_POST['engineer_count'];
        }else{
            $engineer_count = 0;
        }

        $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        if(!empty($edit_id)) {
            if (isset($_POST['selected_engineer_name'])) {
                $single_engineer_name = trim($_POST['selected_engineer_name']);
                $engineer_name_error = $valid->valid_name($single_engineer_name, "Engineer Name", "1");
            }
            
            if (isset($_POST['selected_engineer_code'])) {
                $single_engineer_code = trim($_POST['selected_engineer_code']);
                $engineer_code_error = $valid->valid_text_number($single_engineer_code, "Engineer Code", "1");
            }

            if (isset($_POST['selected_mobile_number'])) {
                $single_mobile_number = trim($_POST['selected_mobile_number']);
                $mobile_number_error = $valid->valid_mobile_number($single_mobile_number, "Mobile Number", "1");
            }
            
            if (isset($_POST['selected_salary'])) {
                $single_engineer_salary = trim($_POST['selected_salary']);
                $engineer_salary_error = $valid->valid_price($single_engineer_salary, "Salary", "1");
            }
            
            if (!empty($engineer_code_error)) {
                $valid_engineer .= $valid->error_display($form_name, "selected_engineer_code", $engineer_code_error, 'text');
            }
            
            if (!empty($engineer_name_error)) {
                $valid_engineer .= $valid->error_display($form_name, "selected_engineer_name", $engineer_name_error, 'text');
            }

            if (!empty($mobile_number_error)) {
                $valid_engineer .= $valid->error_display($form_name, "selected_mobile_number", $mobile_number_error, 'text');
            }
            
            if (!empty($engineer_salary_error)) {
                $valid_engineer .= $valid->error_display($form_name, "selected_salary", $engineer_salary_error, 'text');
            }
            
            if (empty($valid_engineer)) {
                $single_lower_case_name = strtolower($single_engineer_name);
                $single_engineer_name = $obj->encode_decode("encrypt", $single_engineer_name);
                $single_engineer_code = $obj->encode_decode("encrypt", $single_engineer_code);
                $single_mobile_number = $obj->encode_decode("encrypt", $single_mobile_number);
                $single_lower_case_name = $obj->encode_decode("encrypt", $single_lower_case_name);
            
                if (!empty($single_engineer_code)) {
                    $prev_code_id = $obj->CheckEngineerCodeAlreadyExists($GLOBALS['bill_company_id'], $single_engineer_code);
                    if (!empty($prev_code_id) && $prev_code_id != $edit_id) {
                        $engineer_error = "This Code - " . $obj->encode_decode("decrypt", $single_engineer_code) . " already exists";
                    }
                }

                if (!empty($single_mobile_number)) {
                    $prev_mobile_id = $obj->CheckEngineerMobileAlreadyExists($GLOBALS['bill_company_id'], $single_mobile_number);
                    if (!empty($prev_mobile_id) && $prev_mobile_id != $edit_id) {
                        $engineer_error = "This Mobile Number - " . $obj->encode_decode("decrypt", $single_mobile_number) . " already exists";
                    }
                }
            }    
        }
        
    
        if(empty($edit_id)){

            if(isset($_POST['engineer_name'])) {
                $engineer_name = $_POST['engineer_name'];
                $engineer_name = array_reverse($engineer_name);
            }

            if(isset($_POST['engineer_code'])) {
                $engineer_code = $_POST['engineer_code'];
                $engineer_code = array_reverse($engineer_code);
            }

            if(isset($_POST['engineer_mobile_number'])) {
                $engineer_mobile_number = $_POST['engineer_mobile_number'];
                $engineer_mobile_number = array_reverse($engineer_mobile_number);
            }

            if(isset($_POST['engineer_salary'])) {
                $engineer_salary = $_POST['engineer_salary'];
                $engineer_salary = array_reverse($engineer_salary);
            }

            if(!empty($engineer_name)) {
                for($i=0; $i < count($engineer_name); $i++) {
                    $engineer_name[$i] = trim($engineer_name[$i]);  
                    if(!empty($engineer_name[$i])) {
                        $engineer_name_error = $valid->valid_name($engineer_name[$i], "Engineer Name", "1");

                        if(!empty($engineer_name_error)) {
                            if(!empty($valid_engineer)) {
                                $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_name[]', $engineer_name_error, 'text', 'engineer_row', ($i+1));
                            }
                            else {
                                $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_name[]', $engineer_name_error, 'text', 'engineer_row', ($i+1));
                            }
                        }

                        if(!empty($engineer_code[$i])) {
                            $engineer_code_error = $valid->valid_text_number($engineer_code[$i], "Engineer Code", "1");

                            if(!empty($engineer_code_error)) {
                                if(!empty($valid_engineer)) {
                                    $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_code[]', $engineer_code_error, 'text', 'engineer_row', ($i+1));
                                }
                                else {
                                    $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_code[]', $engineer_code_error, 'text', 'engineer_row', ($i+1));
                                }
                            }
                            
                        } else {
                            $engineer_code_error = $valid->valid_text_number($engineer_code[$i], "Engineer Code", "1");

                            if(!empty($engineer_code_error)) {
                                if(!empty($valid_engineer)) {
                                    $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_code[]', $engineer_code_error, 'text', 'engineer_row', ($i+1));
                                }
                                else {
                                    $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_code[]', $engineer_code_error, 'text', 'engineer_row', ($i+1));
                                }
                            }
                        }

                        if(!empty($engineer_mobile_number[$i])) {
                            $engineer_mobile_number_error = $valid->valid_mobile_number($engineer_mobile_number[$i], "Mobile Number", "1");

                            if(!empty($engineer_mobile_number_error)) {
                                if(!empty($valid_engineer)) {
                                    $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_mobile_number[]', $engineer_mobile_number_error, 'text', 'engineer_row', ($i+1));
                                }
                                else {
                                    $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_mobile_number[]', $engineer_mobile_number_error, 'text', 'engineer_row', ($i+1));
                                }
                            }
                            
                        } else {
                            $engineer_mobile_number_error = $valid->valid_mobile_number($engineer_mobile_number[$i], "Mobile Number", "1");

                            if(!empty($engineer_mobile_number_error)) {
                                if(!empty($valid_engineer)) {
                                    $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_mobile_number[]', $engineer_mobile_number_error, 'text', 'engineer_row', ($i+1));
                                }
                                else {
                                    $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_mobile_number[]', $engineer_mobile_number_error, 'text', 'engineer_row', ($i+1));
                                }
                            }
                        }

                        if(!empty($engineer_salary[$i])) {
                            $engineer_salary_error = $valid->valid_price($engineer_salary[$i], "Salary", "1");

                            if(!empty($engineer_salary_error)) {
                                if(!empty($valid_engineer)) {
                                    $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_salary[]', $engineer_salary_error, 'text', 'engineer_row', ($i+1));
                                }
                                else {
                                    $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_salary[]', $engineer_salary_error, 'text', 'engineer_row', ($i+1));
                                }
                            }
                            
                        } else {
                            $engineer_salary_error = $valid->valid_price($engineer_salary[$i], "Salary", "1");

                            if(!empty($engineer_salary_error)) {
                                if(!empty($valid_engineer)) {
                                    $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_salary[]', $engineer_salary_error, 'text', 'engineer_row', ($i+1));
                                }
                                else {
                                    $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_salary[]', $engineer_salary_error, 'text', 'engineer_row', ($i+1));
                                }
                            }
                        }
                        
                    } else {
                        $engineer_name_error = $valid->valid_name($engineer_name[$i], "Engineer Name", "1");

                        if(!empty($engineer_name_error)) {
                            if(!empty($valid_engineer)) {
                                $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_name[]', $engineer_name_error, 'text', 'engineer_row', ($i+1));
                            }
                            else {
                                $valid_engineer = $valid_engineer." ".$valid->row_error_display($form_name, 'engineer_name[]', $engineer_name_error, 'text', 'engineer_row', ($i+1));
                            }
                        }
                    }
                }
            }
            else {
                $engineer_error = "Add Employee Details";
            }
        }
    
        $result = "";
        if(empty($valid_engineer) && empty($engineer_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();
            $bill_company_id = $GLOBALS['bill_company_id'];
    
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {

                if(!empty($engineer_name)) {
                    for ($i = 0; $i < count($engineer_name); $i++) {
                        $engineer_name[$i] = $obj->encode_decode('encrypt', $engineer_name[$i]);
                        $engineer_code[$i] = $obj->encode_decode('encrypt', $engineer_code[$i]);
                        $engineer_mobile_number[$i] = $obj->encode_decode('encrypt', $engineer_mobile_number[$i]);
                        $lower_case_name[$i] = strtolower($engineer_name[$i]);
                        $lower_case_name[$i] = $obj->encode_decode("encrypt", $lower_case_name[$i]);
                    }
                }

                if(!empty($engineer_code)) {    
                    for ($i = 0; $i < count($engineer_code); $i++) {
                        $prev_code_id = $obj->CheckEngineerCodeAlreadyExists($bill_company_id, $engineer_code[$i]);
                        if(!empty($prev_code_id)) {
                            $engineer_error = "This Code - " . $obj->encode_decode("decrypt", $engineer_code[$i]) . " is already exist";
                        }
                    }
                }

                if(!empty($engineer_mobile_number)) {    
                    for ($i = 0; $i < count($engineer_mobile_number); $i++) {
                        $prev_mobile_id = $obj->CheckEngineerMobileAlreadyExists($bill_company_id, $engineer_mobile_number[$i]);
                        if(!empty($prev_mobile_id)) {
                            $engineer_error = "This Mobile Number - " . $obj->encode_decode("decrypt", $engineer_mobile_number[$i]) . " is already exist";
                        }
                    }
                }

                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
    
                if(empty($engineer_error)) {
                    if(empty($edit_id)) {
                        $action = array();
                        for ($p = 0; $p < count($engineer_name); $p++) {
                            if(empty($prev_code_id) && (empty($prev_mobile_id))) {
                                if(!empty($engineer_name[$p])) {
                                    $action[$p] = "New Engineer Created. Name - " . $obj->encode_decode('decrypt', $engineer_name[$p]);
                                }
    
                                $null_value = $GLOBALS['null_value'];
                                $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'engineer_id', 'engineer_name', 'engineer_code', 'mobile_number','salary','engineer_name_code','lower_case_name','deleted');
                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$engineer_name[$p]."'", "'".$engineer_code[$p]."'", "'".$engineer_mobile_number[$p]."'", "'".$engineer_salary[$p]."'", "'".$null_value."'", "'".$lower_case_name[$p]."'", "'0'");
    
                                $engineer_insert_id = $obj->InsertSQL($GLOBALS['engineer_table'], $columns, $values, 'engineer_id', '', $action[$p]);		
                                if(preg_match("/^\d+$/", $engineer_insert_id)) {								
                                    $result = array('number' => '1', 'msg' => 'Engineer Successfully Created');						
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $engineer_insert_id);
                                }
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $engineer_error);
                            }
                        }
                    } 
                    else if(!empty($edit_id)) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($single_engineer_name)) {
                                $action = "Engineer Updated. Name - " . $obj->encode_decode('decrypt', $single_engineer_name);
                            }
    
                            $columns = array(); $values = array();
                            $columns = array('creator_name','engineer_name', 'engineer_code', 'mobile_number','salary');
                            $values = array("'".$creator_name."'", "'".$single_engineer_name."'", "'".$single_engineer_code."'", "'".$single_mobile_number."'", "'".$single_engineer_salary."'");
                            $engineer_update_id = $obj->UpdateSQL($GLOBALS['engineer_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $engineer_update_id)) {
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $engineer_update_id);
                            }
                        }
                    }
                } 
                else {
                    $result = array('number' => '2', 'msg' => $engineer_error);
                }
            } 
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_engineer)) {
                $result = array('number' => '3', 'msg' => $valid_engineer);
            }
            if(!empty($engineer_error)) {
                $result = array('number' => '2', 'msg' => $engineer_error);
            }
        }
    
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result;
        exit;
    }

    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title'];

        $search_text = "";
		if(isset($_POST['search_text'])) {
		   $search_text = $_POST['search_text'];
		}

        $total_records_list = array();
        $total_records_list = $obj->getTableRecords($GLOBALS['engineer_table'],'','','DESC');
        

        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if(strpos(strtolower($obj->encode_decode('decrypt', $val['engineer_name'])), $search_text) !== false) {
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
         if($total_pages > $page_limit) { ?>
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
            if(empty($access_error)) {  ?>
        
		<table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr style="white-space:pre;">
                    <th>S.No</th>
                    <th>Engineer Code</th>
                    <th>Engineer Name</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        if(!empty($show_records_list)) { 
                            foreach($show_records_list as $key => $data) {
                                $index = $key + 1;
                                if(!empty($prefix)) { $index = $index + $prefix; } 
                    ?>
                                <tr>
                                    <td class="ribbon-header" style="cursor:default;">   
                                        <?php  echo $index; ?>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['engineer_code']) && $data['engineer_code'] != "NULL") {
                                                $data['engineer_code'] = $obj->encode_decode('decrypt', $data['engineer_code']);
                                                echo $data['engineer_code'];
                                            }
                                        ?>
                                        <div class="w-100 py-2">
                                            Creator :
                                            <?php
                                                if(!empty($data['creator_name'])) {
                                                    $data['creator_name'] = $obj->encode_decode('decrypt', $data['creator_name']);
                                                    echo $data['creator_name'];
                                                }
                                            ?>                                        
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['engineer_name'])) {
                                                $data['engineer_name'] = $obj->encode_decode('decrypt', $data['engineer_name']);
                                                echo $data['engineer_name'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['mobile_number']) && $data['mobile_number'] != "NULL") {
                                                $data['mobile_number'] = $obj->encode_decode('decrypt', $data['mobile_number']);
                                                echo $data['mobile_number'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
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
                                        if(empty($edit_access_error) || empty($delete_access_error)){ ?>
                                        <div class="dropdown">
                                           <a href="#" role="button" id="dropdownMenuLink1" class="btn btn-dark show-button" class="btn btn-dark show-button poppins" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <?php if(empty($edit_access_error)) {  ?>
                                                    <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['engineer_id'])) { echo $data['engineer_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a></li>
                                                
                                                <?php }
                                                       
                                                if(empty($delete_access_error)) {
                                                    $linked_count = 0;
                                                    // $linked_count = $obj->GetPartyLinkedCount($data['engineer_id']); 
                                                    if($linked_count > 0) {
                                                    ?>                             
                                                <li><a class="dropdown-item text-secondary" href="#"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                <?php 
                                                    }
                                                    else {
                                                ?>
                                                <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['engineer_id'])) { echo $data['engineer_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                            
                                                <?php 
                                                        }
                                                    } 
                                                ?>
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
                    <?php 
                        } 
                    ?>
                </tbody>
        </table>   
                      
		<?php	
        }
	}

    if(isset($_REQUEST['engineer_row_index'])) {
        $engineer_row_index = $_REQUEST['engineer_row_index'];
        $engineer_name = $_REQUEST['engineer_name'];
        $engineer_code = $_REQUEST['engineer_code'];
        $engineer_mobile_number = $_REQUEST['engineer_mobile_number'];
        $engineer_salary = $_REQUEST['engineer_salary'];
        ?>
        <tr class="engineer_row" id="engineer_row<?php if(!empty($engineer_row_index)) { echo $engineer_row_index; } ?>">
            <td class="text-center sno"><?php if(!empty($engineer_row_index)) { echo $engineer_row_index; } ?></td>
            <td class="text-center">
                <?php
                    /*
                    if(!empty($engineer_code)) {
                        echo $engineer_code;
                    } 
                        */   
                ?>
                <input type="text" name="engineer_code[]" class="form-control shadow-none" value="<?php if(!empty($engineer_code)) { echo $engineer_code; } ?>">
            </td>
            <td class="text-center">
                <?php
                    /*
                    if(!empty($engineer_name)) {
                        echo $engineer_name;
                    } 
                        */   
                ?>
                <input type="text" name="engineer_name[]" class="form-control shadow-none" value="<?php if(!empty($engineer_name)) { echo $engineer_name; } ?>">
            </td>
            <td class="text-center">
                <?php
                    /*
                    if(!empty($engineer_mobile_number)) {
                        echo $engineer_mobile_number;
                    } 
                        */   
                ?>
                <input type="text" name="engineer_mobile_number[]" maxlength="10" class="form-control shadow-none" value="<?php if(!empty($engineer_mobile_number)) { echo $engineer_mobile_number; } ?>">
            </td>
            <td class="text-center">
                <?php /*
                    if(!empty($engineer_salary)) {
                        echo $engineer_salary;
                    }   
                    */ 
                ?>
                <input type="text" name="engineer_salary[]" class="form-control shadow-none" value="<?php if(!empty($engineer_salary)) { echo $engineer_salary; } ?>">
            </td>
            <td class="text-center product_pad">
                <button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteCreationRow('engineer', '<?php if(!empty($engineer_row_index)) { echo $engineer_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
        <?php
    }

    if(isset($_REQUEST['delete_engineer_id'])) {
        $delete_engineer_id = $_REQUEST['delete_engineer_id'];
        $msg = "";
        if(!empty($delete_engineer_id)) {
            $engineer_unique_id = "";
            $engineer_unique_id = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $delete_engineer_id, 'id');
            if(preg_match("/^\d+$/", $engineer_unique_id)) {
                $engineer_name = "";
                $engineer_name = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $delete_engineer_id, 'engineer_name');
    
                $action = "";
                if(!empty($engineer_name)) {
                    $action = "Engineer Deleted. Name - " . $obj->encode_decode('decrypt', $engineer_name);
                }
                // $linked_count = 0;
                // $linked_count = $obj->GetEngineerLinkedCount($delete_engineer_id);
                // if(empty($linked_count)) {
                    $columns = array();
                    $values = array();
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['engineer_table'], $engineer_unique_id, $columns, $values, $action);
                // // }
                // else {
                //     $msg = "This Engineer is associated with other screens";
                // }
            }
        }
        echo $msg;
        exit;
    }
?>