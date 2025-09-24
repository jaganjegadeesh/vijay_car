<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['paymentmode_module'];
        }
    }

	if(isset($_REQUEST['show_payment_mode_id'])) { 
        $show_payment_mode_id = $_REQUEST['show_payment_mode_id'];
        $show_payment_mode_id = trim($show_payment_mode_id);

        $payment_mode_name = "";

        if(!empty($show_payment_mode_id)) {
            $payment_mode_list = array();
            $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], 'payment_mode_id', $show_payment_mode_id,'');
            if(!empty($payment_mode_list)) {
                foreach($payment_mode_list as $data) {
                    if(!empty($data['payment_mode_name'])) {
                        $payment_mode_name = $obj->encode_decode('decrypt', $data['payment_mode_name']);
                    }
                }
            }
        }
?>
        <div class="card-header">
            <div class="row p-2">
                <div class="col-lg-8 col-md-8 col-8 align-self-center">
                    <?php if(!empty($show_payment_mode_id)) { ?>
                        <div class="h5">Edit Payment Mode</div>
                    <?php } else { ?>
                        <div class="h5">Add Payment Mode</div>
                    <?php } ?>
                </div>
                <div class="col-lg-4 col-md-4 col-4">
                    <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="window.open('payment_mode.php','_self')"> <i class="bi bi-arrow-left-circle"></i> &ensp; Back </button>
                </div>
            </div>
        </div>
        <form class="poppins pd-20" name="payment_mode_form" method="POST">
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_payment_mode_id)) { echo $show_payment_mode_id; } ?>">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" id="payment_mode_name" name="payment_mode_name" class="form-control shadow-none" value="<?php if(!empty($payment_mode_name)){echo $payment_mode_name;} ?>" onkeydown="Javascript:KeyboardControls(this,'text',15,'');" onkeyup="Javascript:InputBoxColor(this,'text');" placeholder="" required="">
                                <label>Payment Mode</label>
                                <?php if(empty($show_payment_mode_id)){ ?>
                                    <div class="input-group-append">
                                        <button class="btn btn btn-danger" type="button" onClick="Javascript:addCreationDetails('payment_mode', 15);"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php if(empty($show_payment_mode_id)) { ?> 
                <div class="col-lg-6">
                    <div class="table-responsive text-center">
                        <input type="hidden" name="payment_mode_count" value="0">
                        <table id="payment_mode_table" class="table nowrap cursor smallfnt w-100 border added_payment_mode_table">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th>Payment Mode</th>
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
                    <button class="btn btn-dark submit_button" type="button" onClick="Javascript:SaveModalContent(event, 'payment_mode_form', 'payment_mode_changes.php', 'payment_mode.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    jQuery('#payment_mode_name').on("keypress", function(e) {
                        if (e.keyCode == 13) {
                            addCreationDetails('payment_mode', 15);
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
		$payment_mode_name = array(); $payment_mode_name_error = ""; $edit_id = ""; $single_payment_mode_name = ""; $single_lower_case_name = ""; $valid_payment_mode = ""; $form_name = "payment_mode_form";

        if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
		}
		if(isset($_POST['payment_mode_name']))
		{
			$single_payment_mode_name = $_POST['payment_mode_name'];
            if(!empty($edit_id)){
                if(empty($single_payment_mode_name)){
                    $payment_mode_name_error = "Enter payment mode";
                }
                else{
                    // $payment_mode_name_error = $valid->valid_text($single_payment_mode_name,'Payment Mode Name','1','15');
                    if(!preg_match("/^(?=.*[a-zA-Z])[^?!<>$+=`~_|?;^{}]*$/", $single_payment_mode_name) || strlen($single_payment_mode_name) > 15) {
                        $payment_mode_name_error = "Invalid Payment Mode name";
                    }
                }
                if(!empty($payment_mode_name_error)) {
                    $valid_payment_mode = $valid->error_display($form_name, "payment_mode_name", $payment_mode_name_error, 'text');			
                }
            }
            if(empty($payment_mode_name_error)){
                $single_lower_case_name = strtolower($single_payment_mode_name);
                $single_payment_mode_name = $obj->encode_decode("encrypt", $single_payment_mode_name);
                $single_lower_case_name = $obj->encode_decode("encrypt", $single_lower_case_name);
            }
		}
		if(empty($edit_id)) {
            if(isset($_POST['payment_mode_names'])) {
                $payment_mode_name = $_POST['payment_mode_names'];
                if(!empty($payment_mode_name_error)) {
                    $valid_payment_mode = $valid->error_display($form_name, "payment_mode_name", $payment_mode_name_error, 'text');			
                }
            }
            if(empty($single_payment_mode_name) && empty($payment_mode_name)){
                $payment_mode_name_error = "Enter payment mode";
            }
            if(!empty($single_payment_mode_name) && empty($payment_mode_name))
            {
                $payment_mode_name_error = "Click append button";
            }
            if(!empty($single_payment_mode_name) && !empty($payment_mode_name)){
                $payment_mode_name_error = "Click append button";
            }
            if(!empty($payment_mode_name_error)) {
                $valid_payment_mode = $valid->error_display($form_name, "payment_mode_name", $payment_mode_name_error, 'text');			
            }
            if(!empty($payment_mode_name)) {
                for($p = 0; $p < count($payment_mode_name); $p++) {    
                    if(empty($payment_mode_name[$p])){
                        $payment_mode_name_error = "Enter payment mode";
                    }
                    else{
                        // $payment_mode_name_error = $valid->valid_text($payment_mode_name[$p],'Payment Mode Name','1','15');
                        if(!preg_match("/^(?=.*[a-zA-Z])[^?!<>$+=`~_|?;^{}]*$/", $payment_mode_name[$p]) || strlen($payment_mode_name[$p]) > 15) {
                            $payment_mode_name_error = "Invalid Payment Mode name";
                        }
                    }
                    if(!empty($payment_mode_name_error)) {
                        $valid_payment_mode = $valid->error_display($form_name, "payment_mode_name", $payment_mode_name_error, 'text');			
                    }
                }
            }
        }
		$result = "";
		if(empty($valid_payment_mode)) {
			$check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
            $bill_company_id = $GLOBALS['bill_company_id'];

			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
				$lower_case_name = array();
                for($p = 0; $p < count($payment_mode_name); $p++) {
                    if(!empty($payment_mode_name[$p])) {
                        $lower_case_name[$p] = strtolower($payment_mode_name[$p]);
                        $lower_case_name[$p] = trim($payment_mode_name[$p]);
                        $payment_mode_name[$p] = $obj->encode_decode('encrypt', $payment_mode_name[$p]);
                        $lower_case_name[$p] = $obj->encode_decode('encrypt', $lower_case_name[$p]);
                    }
                }
                $prev_payment_mode_id = ""; $payment_mode_error = "";
                for($i = 0; $i< count($lower_case_name); $i++) {	
                    if(!empty($lower_case_name[$i])) {
                        $prev_payment_mode_id = $obj->CheckPaymentModeAlreadyExists($bill_company_id, $lower_case_name[$i]);
                        if(!empty($prev_payment_mode_id)) {
                            $payment_mode_error = "This payment mode name - ".$obj->encode_decode("decrypt", $lower_case_name[$i])." is already exist";
                        }
                    }
                }
                if(!empty($edit_id))
                {
                    // $prev_payment_mode_id = $obj->CheckPaymentModeAlreadyExists($bill_company_id, $single_lower_case_name);
                    $prev_payment_mode_id = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_name', $single_lower_case_name, 'payment_mode_id');

                    if(!empty($prev_payment_mode_id)) {
                        $payment_mode_error = "This payment_mode name - ".$obj->encode_decode("decrypt", $single_lower_case_name)." is already exist";
                    }
                }
				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                // echo $creator_name."-creator<br>";
                // echo $GLOBALS['creator_name']."-Create<br>";
				if(empty($edit_id)) {
					for($p= 0; $p < count($payment_mode_name); $p++) {
						if(empty($payment_mode_error)) {						
							$action = "";
							if(!empty($payment_mode_name[$p])) {
								$action = "New payment mode Created. Name - ".$obj->encode_decode('decrypt', $payment_mode_name[$p]);
							}
							$null_value = $GLOBALS['null_value'];
							$columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'payment_mode_id', 'payment_mode_name', 'lower_case_name', 'deleted');
							$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$payment_mode_name[$p]."'", "'".$lower_case_name[$p]."'", "'0'");
                            $payment_mode_insert_id = $obj->InsertSQL($GLOBALS['payment_mode_table'], $columns, $values, 'payment_mode_id', '', $action);		
                            if(preg_match("/^\d+$/", $payment_mode_insert_id)) {								
                                $result = array('number' => '1', 'msg' => 'Payment Mode Successfully Created');						
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $payment_mode_insert_id);
                            }
						}
						else {
							$result = array('number' => '2', 'msg' => $payment_mode_error);
						}
					}
				}
				else {
					if(empty($prev_payment_mode_id) || $prev_payment_mode_id == $edit_id) {
						$getUniqueID = "";
						$getUniqueID = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $edit_id, 'id');
						if(preg_match("/^\d+$/", $getUniqueID)) {
							$action = "";
							if(!empty($single_payment_mode_name)) {
                                $action = "Payment mode Updated. Name - ".$obj->encode_decode('decrypt', $single_payment_mode_name);
                            }
							$columns = array(); $values = array();						
							$columns = array('creator_name', 'payment_mode_name', 'lower_case_name');
							$values = array("'".$creator_name."'", "'".$single_payment_mode_name."'", "'".$single_lower_case_name."'");
							$payment_mode_update_id = $obj->UpdateSQL($GLOBALS['payment_mode_table'], $getUniqueID, $columns, $values, $action);
							if(preg_match("/^\d+$/", $payment_mode_update_id)) {
								$result = array('number' => '1', 'msg' => 'Updated Successfully');						
							}
							else {
								$result = array('number' => '2', 'msg' => $payment_mode_update_id);
							}							
						}
					}
					else {
						$result = array('number' => '2', 'msg' => $payment_mode_error);
					}
                }
			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_payment_mode)) {
				$result = array('number' => '3', 'msg' => $valid_payment_mode);
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
        $search_text = "";
		if(isset($_POST['search_text'])) {
			$search_text = $_POST['search_text'];
            $search_text = trim($search_text);
		}
        $total_records_list = array();
        $total_records_list = $obj->getTableRecords($GLOBALS['payment_mode_table'],'','','');
        if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($total_records_list)) {
				foreach($total_records_list as $val) {
					if( (strpos(strtolower($obj->encode_decode('decrypt', $val['payment_mode_name'])), $search_text) !== false) ) {
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
		} ?>
		<?php if($total_pages > $page_limit) { ?>
			<div class="pagination_cover mt-3"> 
				<?php
					include("pagination.php");
				?> 
			</div> 
		<?php }
        $login_staff_id = "";
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id =  $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
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
                        <th>Payment Mode</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($show_records_list)) {
                            foreach($show_records_list as $key => $list) {
                                $index = $key + 1;
                                if(!empty($prefix)) { $index = $index + $prefix; } ?>
                                <tr>
                                    <td style="cursor:default;"><?php echo $index; ?></td>
                                    <td>
                                        <?php
                                            if(!empty($list['payment_mode_name']) && $list['payment_mode_name'] != $GLOBALS['null_value']) {
                                                $list['payment_mode_name'] = $obj->encode_decode('decrypt', $list['payment_mode_name']);
                                                echo($list['payment_mode_name']);
                                            }
                                        ?>
                                        <div class="w-100 py-2">
                                        
                                        <?php
                                            if(!empty($list['creator_name'])) {
                                                $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                                echo " Creator : ". $list['creator_name'];
                                            }
                                        ?>
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
                                            <a href="#" role="button" class="btn btn-dark" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <?php 
                                                $edit_access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $edit_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($edit_access_error)) { ?> 
                                                <!-- <li><a class="dropdown-item" href="#">View</a></li> -->
                                                <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['payment_mode_id'])) { echo $list['payment_mode_id']; } ?>');"> <i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                                <?php } 
                                                $delete_access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $delete_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($delete_access_error)) {
                                                $linked_count = 0;
                                                // $linked_count = $obj->GetPaymentmodeLinkedCount($list['payment_mode_id']); 

                                                /*if($linked_count > 0) {?>
                                                    <li><a class="dropdown-item" style="cursor:pointer; color: #22223057 !important" href="#"><i class="fa fa-trash"></i> &ensp;Delete</a></li>
                                                <?php }else{ */?>
                                                    <li><a class="dropdown-item" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['payment_mode_id'])) { echo $list['payment_mode_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                <?php /*}*/  }?>
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
                    <?php }  ?>
                </tbody>
            </table>                   
		 <?php	
        }
	}

    if(isset($_REQUEST['delete_payment_mode_id'])) {
        $delete_payment_mode_id = $_REQUEST['delete_payment_mode_id'];
        $msg = "";
        if(!empty($delete_payment_mode_id)) {	
            $payment_mode_unique_id = "";
            $payment_mode_unique_id = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $delete_payment_mode_id, 'id');
            if(preg_match("/^\d+$/", $payment_mode_unique_id)) {
                $action = "";
                if(!empty($payment_mode_name)) {
                    $action = "Payment Mode Deleted - ".$obj->encode_decode("decrypt",$payment_mode_name);
                }
                // $linked_count = 0;
                // $linked_count = $obj->GetPaymentmodeLinkedCount($delete_payment_mode_id); 
            
                // if(empty($linked_count)) {
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['payment_mode_table'], $payment_mode_unique_id, $columns, $values, $action);
                // }
                // else {
                //     $msg = "This payment mode is associated with other screens";
                // }
            }
        }
        echo $msg;
        exit;	
    }
    if(isset($_REQUEST['payment_mode_row_index'])) {
		$payment_mode_row_index = $_REQUEST['payment_mode_row_index'];
		$selected_payment_mode_name = $_REQUEST['selected_payment_mode_name'];
		?>
		<tr class="payment_mode_row" id="payment_mode_row<?php if(!empty($payment_mode_row_index)) { echo $payment_mode_row_index; } ?>">
			<td class="text-center sno"></td> 
			<td class="text_center">
				<?php
					if(!empty($selected_payment_mode_name)) {
						echo $selected_payment_mode_name; 
                    }	
                ?>	
                <input type="hidden" name="payment_mode_names[]" value="<?php if(!empty($selected_payment_mode_name)) { echo $selected_payment_mode_name; } ?>">
			</td>		
			<td class="text-center product_pad">
				<button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteCreationRow('payment_mode', '<?php if(!empty($payment_mode_row_index)) { echo $payment_mode_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
			</td>    
		</tr>
		<?php        
	}
?>