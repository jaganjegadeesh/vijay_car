<?php
	include("include_files.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['department_module'];
        }
    }

    if(isset($_REQUEST['show_department_id'])) {
        $show_department_id = "";
        $show_department_id = $_REQUEST['show_department_id'];

        $department_name = "";
        if(!empty($show_department_id)) {
            $department_list = array();
            $department_list = $obj->getTableRecords($GLOBALS['department_table'], 'department_id', $show_department_id, '');
            if(!empty($department_list)) {
                foreach ($department_list as $data) {
                    if(!empty($data['department_name'])) {
                        $department_name = $obj->encode_decode('decrypt', $data['department_name']);
                    }
                }
            }
        } 
        ?>
        <form class="poppins pd-20" name="department_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<?php if(!empty($show_department_id)){ ?>
                            <div class="h5">Edit Department</div>
                        <?php 
                        } else{ ?>
                            <div class="h5">Add Department</div>
                        <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('department.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_department_id)) { echo $show_department_id; } ?>">
                <div class="col-lg-3 col-md-6 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" id="department_name" name="department_name" value="<?php if(!empty($department_name)) { echo $department_name; } ?>" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',15,'');" onkeyup="Javascript:InputBoxColor(this,'text');" placeholder="" required="">
                                <label>Department</label>
                                <?php if(empty($show_department_id)) { ?>
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" type="button" onclick="Javascript:addCreationDetails('department', 15);"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center"> 
                <?php if(empty($show_department_id)) { ?>
                <div class="col-lg-6">
                    <div class="table-responsive text-center">
                        <input type="hidden" name="department_count" value="0">
                        <table class="table nowrap cursor smallfnt w-100 table-bordered added_department_table">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th>Department Name</th>
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
                    <button class="btn btn-danger" type="button" onClick="Javascript:SaveModalContent(event,'department_form', 'department_changes.php', 'department.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    jQuery('#department_name').on("keypress", function(e) {
                        if(e.keyCode == 13) {
                            addCreationDetails('department', 15);
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
        $department_name = array(); $department_name_error = ""; $single_lower_case_name = "";
        $valid_department = ""; $form_name = "department_form"; $department_error = "";
        $single_department_name = ""; $prev_department_id = ""; $lower_case_name = array();

        $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        if(!empty($edit_id)) {
            if(isset($_POST['department_name'])) {
                $single_department_name = $_POST['department_name'];
                $single_department_name = trim($single_department_name);
                $department_name_error = $valid->valid_text($single_department_name, "Department Name", "1", "15");
            }
            if(!empty($department_name_error)) {
                $valid_department = $valid->error_display($form_name, "department_name", $department_name_error, 'text');
            }
            else {
                $single_lower_case_name = strtolower($single_department_name);
                $single_department_name = $obj->encode_decode("encrypt", $single_department_name);
                $single_lower_case_name = $obj->encode_decode("encrypt", $single_lower_case_name);
                if(!empty($single_lower_case_name)) {
                    $prev_department_id = $obj->CheckDepartmentAlreadyExists('', $single_lower_case_name);
                    if(!empty($prev_department_id)) {
                        if($prev_department_id != $edit_id) {
                            $department_error = "This Department name - " . $obj->encode_decode("decrypt", $single_lower_case_name) . " is already exist";
                        }
                    }
                }
            }
        }

        if(empty($edit_id)) {
            if(isset($_POST['department_names'])) {
                $department_name = $_POST['department_names'];
            }
            $inputbox_department_name = "";
            $inputbox_department_name = $_POST['department_name'];

            if(!empty($inputbox_department_name) && empty($department_name)) {
                $department_add_error = "Click Add Button to Append Department";
                if(!empty($department_add_error)) {
                    $valid_department = $valid->error_display($form_name, "department_name", $department_add_error, 'text');
                }
            } else if(empty($inputbox_department_name) && empty($department_name)) {
                $department_add_error = "Enter Department Name";
                if(!empty($department_add_error)) {
                    $valid_department = $valid->error_display($form_name, "department_name", $department_add_error, 'text');
                }
            } else if(!empty($inputbox_department_name)) {
                $department_add_error = "Click Add Button to Append Department";
                if(!empty($department_add_error)) {
                    $valid_department = $valid->error_display($form_name, "department_name", $department_add_error, 'text');
                }
            }
            if(!empty($department_name)) {
                for ($p = 0; $p < count($department_name); $p++) {
                    if(!preg_match("/^[a-zA-Z\s ]+$/", $department_name[$p]) || strlen($department_name[$p]) > 15) {
                        $department_name_error = "Invalid Department name - " . $department_name[$p];
                    }
                    else {
                        $lower_case_name[$p] = strtolower($department_name[$p]);
                        $department_name[$p] = $obj->encode_decode('encrypt', $department_name[$p]);
                        $lower_case_name[$p] = $obj->encode_decode('encrypt', $lower_case_name[$p]);
                    }

                    if(!empty($department_name_error)) {
                        if(!empty($valid_department)) {
                            $valid_department = $valid_department." ".$valid->error_display($form_name, "department_name", $department_name_error, 'text');
                        }
                        else {
                            $valid_department = $valid->error_display($form_name, "department_name", $department_name_error, 'text');
                        }
                    }
                }
            }
        }

        $result = "";
        if(empty($valid_department) && empty($department_name_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();
            $bill_company_id = $GLOBALS['bill_company_id']; 

            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                for ($i = 0; $i < count($lower_case_name); $i++) {
                    if(!empty($lower_case_name[$i])) {
                        $prev_department_id = $obj->CheckDepartmentAlreadyExists('', $lower_case_name[$i]);
                        if(!empty($prev_department_id)) {
                            $department_error = "This Department name - " . $obj->encode_decode("decrypt", $lower_case_name[$i]) . " is already exist";
                        }
                    }
                }
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);

                if(empty($department_error)) {
                    if(empty($edit_id)) {
                        $action = array();
                        for ($p = 0; $p < count($department_name); $p++) {
                            if(empty($prev_department_id)) {
                                if(!empty($department_name[$p])) {
                                    $action[$p] = "New Department Created. Name - " . $obj->encode_decode('decrypt', $department_name[$p]);
                                }

                                $null_value = $GLOBALS['null_value'];
                                $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id','department_id', 'department_name', 'lower_case_name', 'deleted');
                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$department_name[$p]."'", "'".$lower_case_name[$p]."'", "'0'");

                                $department_insert_id = $obj->InsertSQL($GLOBALS['department_table'], $columns, $values, 'department_id', '', $action[$p]);		
                                if(preg_match("/^\d+$/", $department_insert_id)) {								
                                    $result = array('number' => '1', 'msg' => 'Department Successfully Created');						
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $department_insert_id);
                                }
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $department_error);
                            }
                        }
                    } 
                    else if(!empty($edit_id)) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['department_table'], 'department_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($single_department_name)) {
                                $action = "Department Updated. Name - " . $obj->encode_decode('decrypt', $single_department_name);
                            }

                            $columns = array(); $values = array();
                            $columns = array('creator_name', 'department_name', 'lower_case_name');
                            $values = array("'".$creator_name."'", "'".$single_department_name."'", "'".$single_lower_case_name."'");
                            $department_update_id = $obj->UpdateSQL($GLOBALS['department_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $department_update_id)) {
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $department_update_id);
                            }
                        }
                    }
                } 
                else {
                    $result = array('number' => '2', 'msg' => $department_error);
                }
            } 
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_department)) {
                $result = array('number' => '3', 'msg' => $valid_department);
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
        $total_records_list = $obj->getTableRecords($GLOBALS['department_table'], '', '','');

        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if((strpos(strtolower(html_entity_decode($obj->encode_decode('decrypt', $val['department_name']))), $search_text) !== false)) {
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
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if(empty($access_error)) { 
        ?>
        
		<table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($show_records_list)) {
                        $count_department = 0;
                        foreach ($show_records_list as $key => $list) {
                            $index = $key + 1;

                            if(!empty($prefix)) {
                                $index = $index + $prefix;
                            } 
                            ?>
                            <tr style="cursor:default;">
                                <td><?php echo $index; ?></td>
                                <td>
                                    <?php
                                        $department_name = "";
                                        if(!empty($list['department_name'])) {
                                            $department_name = $list['department_name'];
                                            $department_name = $obj->encode_decode('decrypt', $department_name);
                                            echo $department_name;
                                        }
                                    ?>
                                    <div class="w-100 py-2">
                                        
                                        <?php
                                            if(!empty($list['creator_name'])) {
                                                $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                                echo "Creator : ". $list['creator_name'];
                                            }
                                        ?>                                        
                                    </div>
                                </td>
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
                                    <?php if(empty($edit_access_error) || empty($delete_access_error)){ ?>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" role="button" class="btn btn-dark py-1 px-2" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <?php
                                                if(empty($edit_access_error)) { 
                                                    ?>
                                                    <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['department_id'])) { echo $list['department_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                                <?php } 
                                                if(empty($delete_access_error)) {
                                                    $linked_count = 0;
                                                    // $linked_count = $obj->GetDepartmentLinkedCount($list['department_id']);
                                                    if(!empty($linked_count)) {
                                                        ?>
                                                        <li><a class="dropdown-item text-secondary"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                    <?php }else{ ?>
                                                        <li><a class="dropdown-item" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title;} ?>', '<?php if(!empty($list['department_id'])) { echo $list['department_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                        <?php } 
                                                }
                                                ?>                                             
                                            </ul>
                                        </div>
                                    </td>
                                     <?php } ?>
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
    
    if(isset($_REQUEST['department_row_index'])) {
        $department_row_index = $_REQUEST['department_row_index'];
        $selected_department_name = $_REQUEST['selected_department_name'];
        ?>
        <tr class="department_row" id="department_row<?php if(!empty($department_row_index)) { echo $department_row_index; } ?>">
            <td class="text-center sno"><?php if(!empty($department_row_index)) { echo $department_row_index; } ?></td>
            <td class="text-center">
                <?php
                    if(!empty($selected_department_name)) {
                        echo $selected_department_name;
                    }    
                ?>
                <input type="hidden" name="department_names[]" value="<?php if(!empty($selected_department_name)) { echo $selected_department_name; } ?>">
            </td>
            <td class="text-center product_pad">
                <button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteCreationRow('department', '<?php if(!empty($department_row_index)) { echo $department_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
        <?php
    }

    if(isset($_REQUEST['delete_department_id'])) {
        $delete_department_id = $_REQUEST['delete_department_id'];
        $msg = "";
        if(!empty($delete_department_id)) {
            $department_unique_id = "";
            $department_unique_id = $obj->getTableColumnValue($GLOBALS['department_table'], 'department_id', $delete_department_id, 'id');
            if(preg_match("/^\d+$/", $department_unique_id)) {
                $department_name = "";
                $department_name = $obj->getTableColumnValue($GLOBALS['department_table'], 'department_id', $delete_department_id, 'department_name');

                $action = "";
                if(!empty($department_name)) {
                    $action = "Department Deleted. Name - " . $obj->encode_decode('decrypt', $department_name);
                }
                $linked_count = 0;
                $linked_count = $obj->getTableRecords($GLOBALS['job_card_table'],'department_id', $delete_department_id);
                if(empty($linked_count)) {
                    $columns = array();
                    $values = array();
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['department_table'], $department_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "This Department is associated with other screens";
                }
            }
        }
        echo $msg;
        exit;
    }
    ?>