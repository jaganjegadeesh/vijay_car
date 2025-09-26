<?php
    include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['vehicle_module'];
        }
    }

    if(isset($_REQUEST['show_vehicle_id'])) {
        $add_custom = 0;
        if(isset($_REQUEST['add_custom'])) {
            $add_custom = $_REQUEST['add_custom'];
        }

        $show_vehicle_id = "";
        $show_vehicle_id = $_REQUEST['show_vehicle_id'];
        $vehicle_no = "";
        $vehicle_details = ""; 
        if(!empty($show_vehicle_id)) {
            $vehicle_list = array();
            $vehicle_list = $obj->getTableRecords($GLOBALS['vehicle_table'], 'vehicle_id', $show_vehicle_id, '');
            if(!empty($vehicle_list)) {
                foreach ($vehicle_list as $data) {
                    if(!empty($data['vehicle_no'])) {
                        $vehicle_no = $obj->encode_decode('decrypt', $data['vehicle_no']);
                        $vehicle_details = $obj->encode_decode('decrypt', $data['vehicle_details']);
                    }
                }
            }
        } 
        ?>
        <form class="poppins pd-20 redirection_form" name="vehicle_form" method="POST">
            <?php if(empty($add_custom) && $add_custom == 0) { ?>
                <div class="card-header">
                    <div class="row p-2">
                        <div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_vehicle_id)){ ?>
                            <div class="h5">Edit Vehcile</div>
                        <?php 
                        } else{ ?>
                            <div class="h5">Add Vehicle</div>
                        <?php
                        } ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-4">
                            <button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('vehicle.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row justify-content-center p-2">
                <input type="hidden" name="add_custom" value="<?php if(!empty($add_custom)) { echo $add_custom; } ?>">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_vehicle_id)) {  echo $show_vehicle_id; } ?>">
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="vehicle_no" name="vehicle_no" class="form-control shadow-none" placeholder="" value="<?php if(!empty($vehicle_no)) { echo $vehicle_no; } ?>" onkeydown="Javascript:KeyboardControls(this,'',30,'');" onkeyup="Javascript:InputBoxColor(this,'');" required>
                            <label>Vehicle Number<span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="vehicle_detail" name="vehicle_detail" class="form-control shadow-none" placeholder="" value="<?php if(!empty($vehicle_details)) { echo $vehicle_details; } ?>" onkeydown="Javascript:KeyboardControls(this,'',100,'');" onkeyup="Javascript:InputBoxColor(this,'',100);" required>
                            <label>vehicle Details<span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-12 py-2 text-center">
                <?php if(empty($show_vehicle_id)) { ?>
                    <button class="btn btn-danger add_products_button" style="font-size:12px;" type="button" onclick="Javascript:addVehicleFormDetails('vehicle', 30);">
                        Add
                    </button>
                <?php } ?>                    
                </div> 
            </div>
            <div class="row justify-content-center"> 
                <?php if(empty($show_vehicle_id)) { ?>
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="table-responsive text-center">
                        <input type="hidden" name="vehicle_count" value="0">                        
                        <table class="table nowrap cursor smallfnt w-100 table-bordered added_vehicle_table">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th>Vehicle Number</th>
                                    <th>Details</th>
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
                    <button class="btn btn-danger submit_button" type="button" onClick="Javascript:SaveModalContent(event, 'vehicle_form', 'vehicle_changes.php', 'vehicle.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    jQuery('#vehicle_no').on("keypress", function(e) {
                        if(e.keyCode == 13) {
                            addVehicleFormDetails('vehicle', 30);
                            return false;
                        }
                    });
                });
            </script>            
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    }

    if(isset($_POST['edit_id'])) {
        $vehicle_no = array(); $vehicle_no_error = ""; $single_lower_case_name = "";
        $valid_vehicle = ""; $form_name = "vehicle_form"; $vehicle_error = "";
        $single_vehicle_no = ""; $prev_vehicle_id = ""; $lower_case_name = array(); $single_vehicle_details = "";
        $vehicle_details_array = array(); $add_custom = 0;
        if(isset($_POST['vehicle_count'])){
            $vehicle_count = $_POST['vehicle_count'];
        }else{
            $vehicle_count = 0;
        }
        $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        if(isset($_POST['add_custom'])) {
            $add_custom = $_POST['add_custom'];
        }
        if(!empty($edit_id)) {
            if (isset($_POST['vehicle_no'])) {
                $single_vehicle_no = trim($_POST['vehicle_no']);
                $vehicle_no_error = $valid->common_validation($single_vehicle_no, "Vehicle Number", "1", "30");
            }
            
            if (isset($_POST['vehicle_detail'])) {
                $single_vehicle_details = trim($_POST['vehicle_detail']);
                $vehicle_details_error = $valid->common_validation($single_vehicle_details, "Vehicle Details", "1", "30");
            }
            
            if (!empty($vehicle_no_error)) {
                $valid_vehicle .= $valid->error_display($form_name, "vehicle_no", $vehicle_no_error, 'text');
            }
            
            if (!empty($vehicle_details_error)) {
                $valid_vehicle .= $valid->error_display($form_name, "vehicle_detail", $vehicle_details_error, 'text');
            }
            
            if (empty($valid_vehicle)) {
                $single_lower_case_name = strtolower($single_vehicle_no);
                $single_vehicle_no = $obj->encode_decode("encrypt", $single_vehicle_no);
                $single_vehicle_details = $obj->encode_decode("encrypt", $single_vehicle_details);
                $single_lower_case_name = $obj->encode_decode("encrypt", $single_lower_case_name);
            
                if (!empty($single_lower_case_name)) {
                    $prev_vehicle_id = $obj->CheckStoreRoomAlreadyExists($GLOBALS['bill_company_id'], $single_lower_case_name);
                    if (!empty($prev_vehicle_id) && $prev_vehicle_id != $edit_id) {
                        $vehicle_error = "This Vehicle name - " . $obj->encode_decode("decrypt", $single_lower_case_name) . " already exists";
                    }
                }
            }    
        }
        
    
        if(empty($edit_id)) {
            if(isset($_POST['vehicle_nos'])) {
                $vehicle_no = $_POST['vehicle_nos'];
            }
            if(isset($_POST['vehicle_details'])) {
                $vehicle_details = $_POST['vehicle_details'];
            }

            $inputbox_vehicle_no = "";
            $inputbox_vehicle_no = $_POST['vehicle_no'];
            $inputbox_vehicle_details = $_POST['vehicle_detail'];                        
    
            if(!empty($inputbox_vehicle_no) && empty($vehicle_no)) {
                $vehicle_add_error = "Click Add Button to Append Vehicle";
                if(!empty($vehicle_add_error)) {
                    $valid_vehicle = $valid->error_display($form_name, "vehicle_no", $vehicle_add_error, 'text');
                }
            } else if(empty($inputbox_vehicle_no) && empty($vehicle_no) || empty($inputbox_vehicle_number) || empty($inputbox_vehicle_details)){
                $vehicle_add_error = "Enter Vehicle Number";
                if(empty($vehicle_count) && empty($edit_id)){
                    if(!empty($vehicle_add_error)) {
                        $valid_vehicle .= $valid->error_display($form_name, "vehicle_no", $vehicle_add_error, 'text');
                    }
                    if(empty($inputbox_vehicle_details)) {
                        $vehicle_add_error = "Enter Vehicle Details";                    
                        $valid_vehicle .= $valid->error_display($form_name, "vehicle_detail", $vehicle_add_error, 'text');
                    }                                    
                }
                if(!empty($edit_id)){
                    if(!empty($vehicle_add_error)) {
                        $valid_vehicle .= $valid->error_display($form_name, "vehicle_no", $vehicle_add_error, 'text');
                    }
                    if(empty($inputbox_vehicle_details)) {
                        $vehicle_add_error = "Enter Vechicle Details";                    
                        $valid_vehicle .= $valid->error_display($form_name, "vehicle_detail", $vehicle_add_error, 'text');
                    }                                    
                }                
            } else if(!empty($inputbox_vehicle_no)) {
                $vehicle_add_error = "Click Add Button to Append Vehicle";
                if(!empty($vehicle_add_error)) {
                    $valid_vehicle = $valid->error_display($form_name, "vehicle_no", $vehicle_add_error, 'text');
                }
            }
            if(!empty($vehicle_no)) {
                for ($p = 0; $p < count($vehicle_no); $p++) {
                    $vehicle_no_error = $valid->common_validation($vehicle_no[$p], "Invalid Vehicle Number - ". $vehicle_no[$p], "1", "30");
                    $vehicle_details_error = $valid->common_validation($vehicle_details[$p], "Invalid Vehicle Details - ". $vehicle_details[$p], "1", "100");
                    if(!empty($vehicle_no_error || !empty($vehicle_details_error))) {
                        if(!empty($vehicle_no_error)){
                            $vehicle_no_error = "Invalid Vehicle Number- " . $vehicle_no[$p];                            
                        }                    
                        if(!empty($vehicle_details_error)){
                            $vehicle_details_error = "Invalid Vehicle Details- " . $vehicle_details[$p];                            
                        }                                            
                    }
                    else {
                        $lower_case_name[$p] = strtolower($vehicle_no[$p]);
                        $vehicle_no[$p] = $obj->encode_decode('encrypt', $vehicle_no[$p]);
                        $lower_case_name[$p] = $obj->encode_decode('encrypt', $lower_case_name[$p]);
                        $vehicle_details[$p] = $obj->encode_decode('encrypt', $vehicle_details[$p]);
                    } 
                }
            }
        }
    
        $result = "";
        if(empty($valid_vehicle) && empty($vehicle_no_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();
            $bill_company_id = $GLOBALS['bill_company_id'];
    
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                for ($i = 0; $i < count($lower_case_name); $i++) {
                    if(!empty($lower_case_name[$i])) {
                        $prev_vehicle_id = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'lower_case_name', $lower_case_name[$i], 'vehicle_id');
                        if(!empty($prev_vehicle_id)) {
                            $vehicle_error = "This Vehicle Number - " . $obj->encode_decode("decrypt", $lower_case_name[$i]) . " is already exist";
                        }
                    }
                }
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
    
                if(empty($vehicle_error)) {
                    if(empty($edit_id)) {
                        $action = array();
                        for ($p = 0; $p < count($vehicle_no); $p++) {
                            if(empty($prev_vehicle_id)) {
                                if(!empty($vehicle_no[$p])) {
                                    $action[$p] = "New Vehicle Created. Number - " . $obj->encode_decode('decrypt', $vehicle_no[$p]);
                                }
    
                                $null_value = $GLOBALS['null_value'];
                                $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'vehicle_id', 'vehicle_no', 'lower_case_name', 'deleted','vehicle_details');
                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$vehicle_no[$p]."'", "'".$lower_case_name[$p]."'", "'0'", "'".$vehicle_details[$p]."'");
    
                                $vehicle_insert_id = $obj->InsertSQL($GLOBALS['vehicle_table'], $columns, $values, 'vehicle_id', '', $action[$p]);		
                                if(preg_match("/^\d+$/", $vehicle_insert_id)) {		
                                    if(!empty($add_custom) && $add_custom == 1) { 
                                        $result = array('number' => '1', 'msg' => 'Vehicle Successfully Created', 'addcustom'=>'vehicle');
                                    } else { 			
                                        $result = array('number' => '1', 'msg' => 'Vehicle Successfully Created','vehicle_id' => $vehicle_id);
                                    }						
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $vehicle_insert_id);
                                }
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $vehicle_error);
                            }
                        }
                    } 
                    else if(!empty($edit_id)) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'vehicle_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($single_vehicle_no)) {
                                $action = "vehicle Updated. Number - " . $obj->encode_decode('decrypt', $single_vehicle_no);
                            }
    
                            $columns = array(); $values = array();
                            $columns = array('creator_name', 'vehicle_no', 'lower_case_name', 'vehicle_details');
                            $values = array("'".$creator_name."'", "'".$single_vehicle_no."'", "'".$single_lower_case_name."'", "'".$single_vehicle_details."'",);
                            $vehicle_update_id = $obj->UpdateSQL($GLOBALS['vehicle_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $vehicle_update_id)) {
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $vehicle_update_id);
                            }
                        }
                    }
                } 
                else {
                    $result = array('number' => '2', 'msg' => $vehicle_error);
                }
            } 
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_vehicle)) {
                $result = array('number' => '3', 'msg' => $valid_vehicle);
            }
             if(!empty($vehicle_no_error)) {
                $result = array('number' => '2', 'msg' => $vehicle_no_error);		
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
            $search_text = trim($search_text);
        }
    
        $total_records_list = array();
        $total_records_list = $obj->getTableRecords($GLOBALS['vehicle_table'], '', '','');
    
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if((strpos(strtolower(html_entity_decode($obj->encode_decode('decrypt', $val['vehicle_no']))), $search_text) !== false)) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }
    
        $total_pages = 0;
        $total_pages = count($total_records_list);
    
        $page_start = 0;
        $page_end = 0;
        if(!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
            if($total_pages > $page_limit) {
                if($page_number) {
                    $page_start = ($page_number - 1) * $page_limit;
                    $page_end = $page_start + $page_limit;
                }
            } else {
                $page_start = 0;
                $page_end = $page_limit;
            }
        }
    
        $show_records_list = array();
        if(!empty($total_records_list)) {
            foreach ($total_records_list as $key => $val) {
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
                <?php
                include("pagination.php");
                ?>
            </div>
            <?php 
        } 
        $view_access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if(empty($view_access_error)) { 
            ?>
            <table class="table nowrap cursor text-center smallfnt">
                <thead class="bg-light">
                    <tr>
                        <th>S.No</th>
                        <th>Vehicle Number</th>
                        <th>Details</th>                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($show_records_list)) {
                            $count_vehicle = 0;
                            foreach ($show_records_list as $key => $list) {
                                $index = $key + 1;
    
                                if(!empty($prefix)) {
                                    $index = $index + $prefix;
                                } 
                                ?>
                                <tr style="cursor:default;">
                                    <td><?php echo $index; ?></td>
    
                                    <td class="text-center">
                                        <?php
                                            $vehicle_no = "";
                                            if(!empty($list['vehicle_no'])) {
                                                $vehicle_no = $list['vehicle_no'];
                                                $vehicle_no = $obj->encode_decode('decrypt', $vehicle_no);
                                                echo $vehicle_no;
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                            $vehicle_details = "";
                                            if(!empty($list['vehicle_details'])) {
                                                $vehicle_details = $list['vehicle_details'];
                                                $vehicle_details = $obj->encode_decode('decrypt', $vehicle_details);
                                                echo $vehicle_details;
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
                                    ?>
                                <?php if (empty($edit_access_error) || empty($delete_access_error)) { ?>
                                    
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink1" class="btn btn-dark show-button py-1 px-2"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <?php if(empty($edit_access_error)) { 
                                                ?>
                                            <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['vehicle_id'])) { echo $list['vehicle_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a></li>
                                            <?php } 
                                            
                                            if(empty($delete_access_error)) {
                                                $linked_count = 0;
                                                // $linked_count = $obj->GetLinkedCount($list['vehicle_id'], $GLOBALS['stock_table'], 'vehicle_id');
                                                if(!empty($linked_count)) { ?>
                                                    <li><a class="dropdown-item text-secondary"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                <?php }else{  ?>
                                                    <li><a class="dropdown-item" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title;} ?>', '<?php if(!empty($list['vehicle_id'])) { echo $list['vehicle_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                <?php } 
                                                    } ?>
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
                                <td colspan="3" class="text-center">Sorry! No records found</td>
                            </tr>
                            <?php 
                        }  
                    ?>
                </tbody>
            </table>
            <?php
        }
    }

    if (isset($_REQUEST['vehicle_row_index'])) {
        $vehicle_row_index = $_REQUEST['vehicle_row_index'];
        $selected_vehicle_no = $_REQUEST['selected_vehicle_no'];
        $selected_vehicle_details = $_REQUEST['selected_vehicle_details'];
        ?>
        <tr class="vehicle_row" id="vehicle_row<?php echo $vehicle_row_index; ?>">
            <td class="text-center sno"><?php echo $vehicle_row_index; ?></td>
    
            <td class="text-center">
                <?php
                 $selected_vehicle_no = str_replace("@@@", "&", $selected_vehicle_no);
                 echo $selected_vehicle_no; 
                ?>
                <input type="hidden" name="vehicle_nos[]" value="<?php echo $selected_vehicle_no; ?>">
            </td>
            <td class="text-center">
                <?php 
                     $selected_vehicle_details = str_replace("@@@", "&", $selected_vehicle_details);                
                    echo $selected_vehicle_details; 
                ?>
                <input type="hidden" name="vehicle_details[]" value="<?php echo $selected_vehicle_details; ?>">
            </td>
    
            <td class="text-center product_pad">
                <button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteCreationRow('vehicle', '<?php echo $vehicle_row_index; ?>');"> 
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </td>
        </tr>
        <?php
    }

    if(isset($_REQUEST['delete_vehicle_id'])) {
        $delete_vehicle_id = $_REQUEST['delete_vehicle_id'];
        $msg = "";
        if(!empty($delete_vehicle_id)) {
            $vehicle_unique_id = "";
            $vehicle_unique_id = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'vehicle_id', $delete_vehicle_id, 'id');
            if(preg_match("/^\d+$/", $vehicle_unique_id)) {
                $vehicle_no = "";
                $vehicle_no = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'vehicle_id', $delete_vehicle_id, 'vehicle_no');
    
                $action = "";
                if(!empty($vehicle_no)) {
                    $action = "Store Room Deleted. Name - " . $obj->encode_decode('decrypt', $vehicle_no);
                }
                $linked_count = 0;
                $linked_count = $obj->getTableRecords($GLOBALS['job_card_table'],'vehicle_id', $delete_vehicle_id);
                if(empty($linked_count)) {
                    $columns = array();
                    $values = array();
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['vehicle_table'], $vehicle_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "This Vehicle is associated with other screens";
                }
            }
        }
        echo $msg;
        exit;
    }    
?>    