<?php
    include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['store_room_module'];
        }
    }

    if(isset($_REQUEST['show_store_room_id'])) {
        $show_store_room_id = "";
        $show_store_room_id = $_REQUEST['show_store_room_id'];
        $store_room_name = "";
        $store_room_location = ""; 
        if(!empty($show_store_room_id)) {
            $store_room_list = array();
            $store_room_list = $obj->getTableRecords($GLOBALS['store_room_table'], 'store_room_id', $show_store_room_id, '');
            if(!empty($store_room_list)) {
                foreach ($store_room_list as $data) {
                    if(!empty($data['store_room_name'])) {
                        $store_room_name = $obj->encode_decode('decrypt', $data['store_room_name']);
                        $store_room_location = $obj->encode_decode('decrypt', $data['store_room_location']);
                    }
                }
            }
        } 
        ?>
        <form class="poppins pd-20 redirection_form" name="store_room_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                    <?php if(!empty($show_store_room_id)){ ?>
                        <div class="h5">Edit Store Room</div>
                    <?php 
                    } else{ ?>
                        <div class="h5">Add Store Room</div>
                    <?php
                    } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('store_room.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-2">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_store_room_id)) {  echo $show_store_room_id; } ?>">
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="store_room_name" name="store_room_name" class="form-control shadow-none" placeholder="" value="<?php if(!empty($store_room_name)) { echo $store_room_name; } ?>" onkeydown="Javascript:KeyboardControls(this,'',30,'');" onkeyup="Javascript:InputBoxColor(this,'text');" required>
                            <label>Store Room Name<span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="store_room_location" name="store_room_location" class="form-control shadow-none" placeholder="" value="<?php if(!empty($store_room_location)) { echo $store_room_location; } ?>" onkeydown="Javascript:KeyboardControls(this,'text',30,'');" onkeyup="Javascript:InputBoxColor(this,'text');" required>
                            <label>Location<span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-12 py-2 text-center">
                <?php if(empty($show_store_room_id)) { ?>
                    <button class="btn btn-danger add_products_button" style="font-size:12px;" type="button" onclick="Javascript:addCreationFormDetails('store_room', 30);">
                        Add
                    </button>
                <?php } ?>                    
                </div> 
            </div>
            <div class="row justify-content-center"> 
                <?php if(empty($show_store_room_id)) { ?>
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="table-responsive text-center">
                        <input type="hidden" name="store_room_count" value="0">                        
                        <table class="table nowrap cursor smallfnt w-100 table-bordered added_store_room_table">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th>Store Room Name</th>
                                    <th>Location</th>
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
                    <button class="btn btn-danger submit_button" type="button" onClick="Javascript:SaveModalContent(event, 'store_room_form', 'store_room_changes.php', 'store_room.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    jQuery('#store_room_name').on("keypress", function(e) {
                        if(e.keyCode == 13) {
                            addCreationFormDetails('store_room', 30);
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
        $store_room_name = array(); $store_room_name_error = ""; $single_lower_case_name = "";
        $valid_store_room = ""; $form_name = "store_room_form"; $store_room_error = "";
        $single_store_room_name = ""; $prev_store_room_id = ""; $lower_case_name = array();
        $store_room_location_array = array();
        if(isset($_POST['store_room_count'])){
            $store_room_count = $_POST['store_room_count'];
        }else{
            $store_room_count = 0;
        }
        $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        if(!empty($edit_id)) {
            if (isset($_POST['store_room_name'])) {
                $single_store_room_name = trim($_POST['store_room_name']);
                $store_room_name_error = $valid->common_validation($single_store_room_name, "Store Room Name", "1", "30");
            }
            
            if (isset($_POST['store_room_location'])) {
                $single_store_room_location = trim($_POST['store_room_location']);
                $store_room_location_error = $valid->common_validation($single_store_room_location, "Store Room Location", "1", "30");
            }
            
            if (!empty($store_room_name_error)) {
                $valid_store_room .= $valid->error_display($form_name, "store_room_name", $store_room_name_error, 'text');
            }
            
            if (!empty($store_room_location_error)) {
                $valid_store_room .= $valid->error_display($form_name, "store_room_location", $store_room_location_error, 'text');
            }
            
            if (empty($valid_store_room)) {
                $single_lower_case_name = strtolower($single_store_room_name);
                $single_store_room_name = $obj->encode_decode("encrypt", $single_store_room_name);
                $single_store_room_location = $obj->encode_decode("encrypt", $single_store_room_location);
                $single_lower_case_name = $obj->encode_decode("encrypt", $single_lower_case_name);
            
                if (!empty($single_lower_case_name)) {
                    $prev_store_room_id = $obj->CheckStoreRoomAlreadyExists($GLOBALS['bill_company_id'], $single_lower_case_name);
                    if (!empty($prev_store_room_id) && $prev_store_room_id != $edit_id) {
                        $store_room_error = "This Store Room name - " . $obj->encode_decode("decrypt", $single_lower_case_name) . " already exists";
                    }
                }
            }    
        }
        
    
        if(empty($edit_id)) {
            if(isset($_POST['store_room_names'])) {
                $store_room_name = $_POST['store_room_names'];
            }
            $inputbox_store_room_name = "";
            $inputbox_store_room_name = $_POST['store_room_name'];
            $inputbox_store_room_location = $_POST['store_room_location'];                        
    
            if(!empty($inputbox_store_room_name) && empty($store_room_name)) {
                $store_room_add_error = "Click Add Button to Append Store Room";
                if(!empty($store_room_add_error)) {
                    $valid_store_room = $valid->error_display($form_name, "store_room_name", $store_room_add_error, 'text');
                }
            } else if(empty($inputbox_store_room_name) && empty($store_room_name) || empty($inputbox_store_room_number) || empty($inputbox_store_room_location)) {
                $store_room_add_error = "Enter Store Room Name";
                if(empty($store_room_count) && empty($edit_id)){
                    if(!empty($store_room_add_error)) {
                        $valid_store_room .= $valid->error_display($form_name, "store_room_name", $store_room_add_error, 'text');
                    }
                    if(empty($inputbox_store_room_location)) {
                        $store_room_add_error = "Enter Store Room Location";                    
                        $valid_store_room .= $valid->error_display($form_name, "store_room_location", $store_room_add_error, 'text');
                    }                                    
                }
                if(!empty($edit_id)){
                    if(!empty($store_room_add_error)) {
                        $valid_store_room .= $valid->error_display($form_name, "store_room_name", $store_room_add_error, 'text');
                    }
                    if(empty($inputbox_store_room_location)) {
                        $store_room_add_error = "Enter Store Room Location";                    
                        $valid_store_room .= $valid->error_display($form_name, "store_room_location", $store_room_add_error, 'text');
                    }                                    
                }                
            } else if(!empty($inputbox_store_room_name)) {
                $store_room_add_error = "Click Add Button to Append Store Room";
                if(!empty($store_room_add_error)) {
                    $valid_store_room = $valid->error_display($form_name, "store_room_name", $store_room_add_error, 'text');
                }
            }
            if(!empty($store_room_name)) {
                for ($p = 0; $p < count($store_room_name); $p++) {
                    $store_room_name_error = $valid->common_validation($store_room_name[$p], "Invalid Store Room name - ". $store_room_name[$p], "1", "30");
                    $store_room_location_error = $valid->common_validation($inputbox_store_room_location[$p], "Invalid Store Room Location - ". $inputbox_store_room_location[$p], "1", "30");
                    if(!empty($store_room_name_error || !empty($store_room_location_error))) {
                        if(!empty($store_room_name_error)){
                            $store_room_name_error = "Invalid Store Room name - " . $store_room_name[$p];                            
                        }                    
                        if(!empty($store_room_location_error)){
                            $store_room_location_error = "Invalid Store Room Location - " . $store_room_name[$p];                            
                        }                                            
                    }
                    else {
                        $lower_case_name[$p] = strtolower($store_room_name[$p]);
                        $store_room_name[$p] = $obj->encode_decode('encrypt', $store_room_name[$p]);
                        $lower_case_name[$p] = $obj->encode_decode('encrypt', $lower_case_name[$p]);
                        $store_room_location_array[$p] = $obj->encode_decode('encrypt', $inputbox_store_room_location[$p]);
                    }
    
                                        
                }
            }
        }
    
        $result = "";
        if(empty($valid_store_room) && empty($store_room_name_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();
            $bill_company_id = $GLOBALS['bill_company_id'];
    
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                for ($i = 0; $i < count($lower_case_name); $i++) {
                    if(!empty($lower_case_name[$i])) {
                        $prev_store_room_id = $obj->CheckStoreRoomAlreadyExists($bill_company_id, $lower_case_name[$i]);
                        if(!empty($prev_store_room_id)) {
                            $store_room_error = "This Store Room name - " . $obj->encode_decode("decrypt", $lower_case_name[$i]) . " is already exist";
                        }
                    }
                }
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
    
                if(empty($store_room_error)) {
                    if(empty($edit_id)) {
                        $action = array();
                        for ($p = 0; $p < count($store_room_name); $p++) {
                            if(empty($prev_store_room_id)) {
                                if(!empty($store_room_name[$p])) {
                                    $action[$p] = "New Store Room Created. Name - " . $obj->encode_decode('decrypt', $store_room_name[$p]);
                                }
    
                                $null_value = $GLOBALS['null_value'];
                                $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'store_room_id', 'store_room_name', 'lower_case_name', 'deleted','store_room_location');
                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$store_room_name[$p]."'", "'".$lower_case_name[$p]."'", "'0'", "'".$store_room_location_array[$p]."'");
    
                                $store_room_insert_id = $obj->InsertSQL($GLOBALS['store_room_table'], $columns, $values, 'store_room_id', '', $action[$p]);		
                                if(preg_match("/^\d+$/", $store_room_insert_id)) {								
                                    $result = array('number' => '1', 'msg' => 'Store Room Successfully Created');						
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $store_room_insert_id);
                                }
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $store_room_error);
                            }
                        }
                    } 
                    else if(!empty($edit_id)) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['store_room_table'], 'store_room_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($single_store_room_name)) {
                                $action = "Store Room Updated. Name - " . $obj->encode_decode('decrypt', $single_store_room_name);
                            }
    
                            $columns = array(); $values = array();
                            $columns = array('creator_name', 'store_room_name', 'lower_case_name', 'store_room_location');
                            $values = array("'".$creator_name."'", "'".$single_store_room_name."'", "'".$single_lower_case_name."'", "'".$single_store_room_location."'",);
                            $store_room_update_id = $obj->UpdateSQL($GLOBALS['store_room_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $store_room_update_id)) {
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $store_room_update_id);
                            }
                        }
                    }
                } 
                else {
                    $result = array('number' => '2', 'msg' => $store_room_error);
                }
            } 
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_store_room)) {
                $result = array('number' => '3', 'msg' => $valid_store_room);
            }
             if(!empty($store_room_name_error)) {
                $result = array('number' => '2', 'msg' => $store_room_name_error);		
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
        $total_records_list = $obj->getTableRecords($GLOBALS['store_room_table'], '', '','');
    
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if((strpos(strtolower(html_entity_decode($obj->encode_decode('decrypt', $val['store_room_name']))), $search_text) !== false)) {
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
                        <th>Store Room Name</th>
                        <th>Location</th>                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($show_records_list)) {
                            $count_store_room = 0;
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
                                            $store_room_name = "";
                                            if(!empty($list['store_room_name'])) {
                                                $store_room_name = $list['store_room_name'];
                                                $store_room_name = $obj->encode_decode('decrypt', $store_room_name);
                                                echo $store_room_name;
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                            $store_room_location = "";
                                            if(!empty($list['store_room_location'])) {
                                                $store_room_location = $list['store_room_location'];
                                                $store_room_location = $obj->encode_decode('decrypt', $store_room_location);
                                                echo $store_room_location;
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
                                            <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['store_room_id'])) { echo $list['store_room_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a></li>
                                            <?php } 
                                            
                                            if(empty($delete_access_error)) {
                                                $linked_count = 0;
                                                // $linked_count = $obj->GetLinkedCount($list['store_room_id'], $GLOBALS['stock_table'], 'store_room_id');
                                                if(!empty($linked_count)) { ?>
                                                    <li><a class="dropdown-item text-secondary"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                <?php }else{  ?>
                                                    <li><a class="dropdown-item" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title;} ?>', '<?php if(!empty($list['store_room_id'])) { echo $list['store_room_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
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

    if (isset($_REQUEST['store_room_row_index'])) {
        $store_room_row_index = $_REQUEST['store_room_row_index'];
        $selected_store_room_name = $_REQUEST['selected_store_room_name'];
        $selected_store_room_location = $_REQUEST['selected_store_room_location'];
        ?>
        <tr class="store_room_row" id="store_room_row<?php echo $store_room_row_index; ?>">
            <td class="text-center sno"><?php echo $store_room_row_index; ?></td>
    
            <td class="text-center">
                <?php
                 $selected_store_room_name = str_replace("@@@", "&", $selected_store_room_name);
                 echo $selected_store_room_name; 
                ?>
                <input type="hidden" name="store_room_names[]" value="<?php echo $selected_store_room_name; ?>">
            </td>
            <td class="text-center">
                <?php 
                     $selected_store_room_location = str_replace("@@@", "&", $selected_store_room_location);                
                    echo $selected_store_room_location; 
                ?>
                <input type="hidden" name="store_room_location[]" value="<?php echo $selected_store_room_location; ?>">
            </td>
    
            <td class="text-center product_pad">
                <button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteCreationRow('store_room', '<?php echo $store_room_row_index; ?>');"> 
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </td>
        </tr>
        <?php
    }

    if(isset($_REQUEST['delete_store_room_id'])) {
        $delete_store_room_id = $_REQUEST['delete_store_room_id'];
        $msg = "";
        if(!empty($delete_store_room_id)) {
            $store_room_unique_id = "";
            $store_room_unique_id = $obj->getTableColumnValue($GLOBALS['store_room_table'], 'store_room_id', $delete_store_room_id, 'id');
            if(preg_match("/^\d+$/", $store_room_unique_id)) {
                $store_room_name = "";
                $store_room_name = $obj->getTableColumnValue($GLOBALS['store_room_table'], 'store_room_id', $delete_store_room_id, 'store_room_name');
    
                $action = "";
                if(!empty($store_room_name)) {
                    $action = "Store Room Deleted. Name - " . $obj->encode_decode('decrypt', $store_room_name);
                }
                $linked_count = 0;
                $linked_count = $obj->getTableRecords($GLOBALS['stock_table'],'store_id',$delete_store_room_id);
                if(empty($linked_count)) {
                    $columns = array();
                    $values = array();
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['store_room_table'], $store_room_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "This Store Room is associated with other screens";
                }
            }
        }
        echo $msg;
        exit;
    }    
?>    