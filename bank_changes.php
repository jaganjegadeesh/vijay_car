<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['bank_module'];
        }
    }

	if(isset($_REQUEST['show_bank_id'])) { 
         $show_bank_id = $_REQUEST['show_bank_id'];
        $account_number = ""; $bank_name = ""; $ifsc_code = ""; $account_type = ""; $account_name = ""; $branch = "";$payment_mode_ids = array();
        if(!empty($show_bank_id)) {
            $bank_list = array();
			$bank_list = $obj->getTableRecords($GLOBALS['bank_table'], 'bank_id', $show_bank_id,'');
            if(!empty($bank_list)) {
                foreach($bank_list as $data) {
                    if(!empty($data['account_name'])) {
                        $account_name = $obj->encode_decode('decrypt', $data['account_name']);
					}
                    if(!empty($data['account_number']) && $data['account_number']!=$GLOBALS['null_value']){
                        $account_number = $obj->encode_decode('decrypt',$data['account_number']);
                    }
                    if(!empty($data['bank_name']) && $data['bank_name']!=$GLOBALS['null_value']){
                        $bank_name = $obj->encode_decode('decrypt',$data['bank_name']);
                    }
                    if(!empty($data['ifsc_code']) && $data['ifsc_code']!=$GLOBALS['null_value']){
                        $ifsc_code = $obj->encode_decode('decrypt',$data['ifsc_code']);
                    }
                    if(!empty($data['account_type']) && $data['account_type']!=$GLOBALS['null_value']){
                        $account_type = $obj->encode_decode('decrypt',$data['account_type']);
                    }
                    if(!empty($data['branch']) && $data['branch'] != $GLOBALS['null_value']) {
						$branch = $obj->encode_decode('decrypt',$data['branch']);
					}
                    if(!empty($data['payment_mode_id'])) {
                        $payment_mode_ids = explode(',', $data['payment_mode_id']);
					}
                }
            }
		}
        
        $payment_mode_list = array();
        $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'],'','','');

        ?>
        <form  name="bank_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_bank_id)){ ?>
                            <div class="h5">Edit Bank Details</div>
                        <?php 
                        } else{ ?>
                            <div class="h5">Add Bank Details</div>
                        <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('bank.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_bank_id)) { echo $show_bank_id; } ?>">
                <div class="col-lg-3 col-md-4 col-12 px-lg-1">
                    <div class="form-group pb-2">
                        <div class="form-label-group in-border">
                            <input type="text" name="account_name" value="<?php if(!empty($account_name)) { echo $account_name; } ?>" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',25,1);" placeholder="" required>
                            <label>Bank Account Name</label>
                        </div>
                        <div class="new_smallfnt">Contains Text only</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 px-lg-1">
                    <div class="form-group pb-2">
                        <div class="form-label-group in-border">
                            <input type="text" id="account_number" name="account_number" value="<?php if(!empty($account_number)) { echo $account_number; } ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',18,'1');" placeholder="" required>
                            <label>Bank Account Number</label>
                        </div>
                        <div class="new_smallfnt">Contains Number Only</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 px-lg-1">
                    <div class="form-group pb-2">
                        <div class="form-label-group in-border">
                            <input type="text" id="account_type" name="account_type" value="<?php if(!empty($account_type)) { echo $account_type; } ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'text',18,'1');" placeholder="" required>
                            <label>Account Type</label>
                        </div>
                        <div class="new_smallfnt">Contains Number Only</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 px-lg-1">
                    <div class="form-group pb-2">
                        <div class="form-label-group in-border">
                            <input type="text" name="bank_name" value="<?php if(!empty($bank_name)) { echo $bank_name; } ?>"  class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',25,1);" placeholder="" required>
                            <label>Bank Name</label>
                        </div>
                        <div class="new_smallfnt">Contains Text only</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 px-lg-1">
                    <div class="form-group pb-2">
                        <div class="form-label-group in-border">
                            <input type="text" id="ifsc_code" name="ifsc_code" value="<?php if(!empty($ifsc_code)) { echo $ifsc_code; } ?>" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'',150,'1');InputBoxColor(this,'text');" placeholder="" required>
                            <label>Bank IFSC Code</label>
                        </div>
                        <div class="new_smallfnt">Contains Text &amp; Number Only</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 px-lg-1 py-2">
                    <div class="form-group pb-2">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="branch" value="<?php if(!empty($branch)) { echo $branch; } ?>" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',25,1);" placeholder="" required>
                            <label>Branch</label>
                        </div>
                        <div class="new_smallfnt">Contains Text Only</div>
                    </div>
                </div>
                    <div class="col-lg-3 col-md-4 col-12 py-2">
                    <div class="form-group pb-2">
                        <div class="form-label-group in-border mb-0">
                        <select name="payment_mode_id[]" class="select2 select2-danger" multiple style="width: 100%!important;" onchange="Javascript:InputBoxColor(this,'select');">
                                <?php
                                    if(!empty($payment_mode_list)) {
                                        foreach($payment_mode_list as $data) {
                                            if(!empty($data['payment_mode_id']) && strtolower($obj->encode_decode('decrypt',$data['payment_mode_name'])) != 'cash') {
                                                if(!empty($data['payment_mode_id'])) {
                                                    $selected = 0;
                                                    if(!empty($payment_mode_ids) && in_array($data['payment_mode_id'], $payment_mode_ids)) {
                                                        $selected = 1;
                                                    }
                                    ?>
                                                    <option value="<?php echo $data['payment_mode_id']; ?>" <?php if(!empty($selected) && $selected == 1) { ?>selected="selected"<?php } ?> >
                                                        <?php
                                                            if(!empty($data['payment_mode_name'])) {
                                                                $data['payment_mode_name'] = $obj->encode_decode('decrypt', $data['payment_mode_name']);
                                                                echo $data['payment_mode_name'];
                                                            }
                                                        ?>
                                                    </option>
                                    <?php
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Select Payment Mode<span class="text-danger">*</span></label>
                        </div>
                    </div>        
                </div> 
                <!-- <div class="col-lg-3 col-md-4 col-12 px-lg-1">
                    <div class="form-group pb-2">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="name" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',,'1');" placeholder="" required>
                            <label>Opening Balance</label>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-danger submit_button" type="button" onClick="Javascript:SaveModalContent(event,'bank_form', 'bank_changes.php', 'bank.php');">
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
        $account_number = ""; $bank_name = ""; $ifsc_code = ""; $account_name = ""; $account_type = ""; 
        $account_name_error = ""; $account_number_error = ""; $bank_name_error = ""; $ifsc_code_error = ""; $account_type_error = ""; $branch = "";$branch = "";
        $valid_bank = ""; $payment_mode_ids = array(); $payment_mode_error = ""; $form_name = "bank_form";

        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
    
        if(isset($_POST['account_name'])) {
            $account_name = $_POST['account_name'];
            $account_name = $valid->clean_value($account_name);
            $account_name_error = $valid->valid_name($account_name,'Account Name','1','35');
        }
		if(!empty($account_name_error)) {
            $valid_bank = $valid->error_display($form_name, "account_name", $account_name_error, 'text');			            
        }
  
        if(isset($_POST['account_number'])){
            $account_number = $_POST['account_number'];
            $account_number = trim($account_number);
            // $account_number_error = $valid->valid_number($account_number, 'Account Number', '1', '18');
            if(!empty($account_number)){
                if(!preg_match("/^([0-9]{9,18})$/", $account_number)) {
                    $account_number_error ="Invalid Account Number";
                }
            }else{
                $account_number_error ="Enter Account Number";
            }

        }
        if(!empty($account_number_error)) {
            if(!empty($valid_bank)) {
                $valid_bank = $valid_bank." ".$valid->error_display($form_name, "account_number", $account_number_error, 'text');
            }
            else {
                $valid_bank = $valid->error_display($form_name, "account_number", $account_number_error, 'text');
            }
        }

        

        if(isset($_POST['bank_name'])){
            $bank_name = $_POST['bank_name'];
            $bank_name = trim($bank_name);
            $bank_name_error = $valid->valid_name($bank_name,'Bank Name','1', '25');
        }
        if(!empty($bank_name_error)) {
            if(!empty($valid_bank)) {
                $valid_bank = $valid_bank." ".$valid->error_display($form_name, "bank_name", $bank_name_error, 'text');
            }
            else {	
                $valid_bank = $valid->error_display($form_name, "bank_name", $bank_name_error, 'text');
            }
        }
       
        if(isset($_POST['ifsc_code'])){
            $ifsc_code = $_POST['ifsc_code'];
            $ifsc_code = trim($ifsc_code);
            if(!empty($ifsc_code)) {
                $ifsc_code_error = $valid->common_validation($ifsc_code,'IFSC code','text');
            }
        }
        if(!empty($ifsc_code_error)){
            if(!empty($valid_bank)) {
                $valid_bank = $valid_bank." ".$valid->error_display($form_name, "ifsc_code", $ifsc_code_error, 'text');
            }
            else {
                $valid_bank = $valid->error_display($form_name, "ifsc_code", $ifsc_code_error, 'text');
            }
        }
      
        if(isset($_POST['account_type'])){
            $account_type = $_POST['account_type'];
            $account_type = trim($account_type);
            $account_type_error = $valid->valid_name($account_type,'Account Type','1','20');
        } 
        if(!empty($account_type_error)){
            if(!empty($valid_bank)) {
                $valid_bank = $valid_bank." ".$valid->error_display($form_name, "account_type", $account_type_error, 'text');
            }
            else {
                $valid_bank = $valid->error_display($form_name, "account_type", $account_type_error, 'text');
            }
        }
        if(isset($_POST['branch'])) {
            $branch = $_POST['branch'];
            $branch = $valid->clean_value($branch);
            $branch_error = $valid->valid_name($branch,'Branch','1','35');
        }
	
        if(!empty($branch_error)){
            if(!empty($valid_bank)) {
                $valid_bank = $valid_bank." ".$valid->error_display($form_name, "branch", $branch_error, 'text');
            }
            else {
                $valid_bank = $valid->error_display($form_name, "branch", $branch_error, 'text');
            }
        }
        if(isset($_POST['payment_mode_id'])) {
            $payment_mode_ids = $_POST['payment_mode_id'];
        }
        if(count($payment_mode_ids) == '0') {
            $payment_mode_error = "Select the payment mode";
        }
        if(!empty($payment_mode_error)) {
            if(!empty($valid_bank)) {
                $valid_bank = $valid_bank." ".$valid->error_display($form_name, "payment_mode_id[]", $payment_mode_error, 'select');
            }
            else {
                $valid_bank = $valid->error_display($form_name, "payment_mode_id[]", $payment_mode_error, 'select');
            }
        }

        

        $result = "";

        if(empty($valid_bank)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            $bill_company_id = $GLOBALS['bill_company_id'];

            if(preg_match("/^\d+$/", $check_user_id_ip_address)) { 
                $bank_name_account_number = "";
                if(!empty($bank_name)) {
                    $bank_name_account_number = $bank_name;
                    if(!empty($account_number)) {
                        $bank_name_account_number = $bank_name_account_number." (".$account_number.")";
                    }
                    if(!empty($bank_name_account_number)) {
                        $bank_name_account_number = $obj->encode_decode('encrypt', $bank_name_account_number);
                    }
                }
                if(!empty($account_name)){
                    $account_name = $obj->encode_decode("encrypt",$account_name);
                }
                else {
                    $account_name = $GLOBALS['null_value'];
                }
                // echo $account_name;
                if(!empty($branch)){
                    $branch = $obj->encode_decode("encrypt",$branch);
                }
                else {
                    $branch = $GLOBALS['null_value'];
                }
                if(!empty($account_number)){
                    $account_number = $obj->encode_decode("encrypt",$account_number);
                }
                else {
                    $account_number = $GLOBALS['null_value'];
                }
                if(!empty($bank_name)){
                    $bank_name = $obj->encode_decode("encrypt",$bank_name);
                }
                else {
                    $bank_name = $GLOBALS['null_value'];
                }
                if(!empty($ifsc_code)){
                    $ifsc_code = $obj->encode_decode("encrypt",$ifsc_code);
                }
                else {
                    $ifsc_code = $GLOBALS['null_value'];
                }
                if(!empty($account_type)){
                    $account_type = $obj->encode_decode("encrypt",$account_type);
                }
                else {
                    $account_type = $GLOBALS['null_value'];
                }
                if(!empty($payment_mode_ids)) {
					$payment_mode_ids = implode(",", $payment_mode_ids);
				}
                else {
                    $payment_mode_ids = $GLOBALS['null_value'];
                }
                $prev_account_number = ""; $check_users = array(); $bank_error = "";			
                if(!empty($account_number)) {
                    $prev_account_number = $obj->getTableColumnValue($GLOBALS['bank_table'], 'account_number', $account_number, 'bank_id');
                    if(!empty($prev_account_number)) {
                        $bank_error = "This account Number is already exist";
                    }
                }
                
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                if(empty($edit_id)) {
                    if(empty($prev_account_number)) {						
                        $action = "";
                        if(!empty($account_name)) {
                            $action = "New Bank Account Created. Name - ".$obj->encode_decode('decrypt', $account_name);
                        }
                        $null_value = $GLOBALS['null_value'];
                        $columns = array(); $values = array();
                        $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'bank_id','account_name', 'account_number', 'bank_name', 'ifsc_code','account_type','bank_name_account_number','branch','payment_mode_id','deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$account_name."'", "'".$account_number."'","'".$bank_name."'","'".$ifsc_code."'","'".$account_type."'","'".$bank_name_account_number."'","'".$branch."'","'".$payment_mode_ids."'","0");
                        $bank_insert_id = $obj->InsertSQL($GLOBALS['bank_table'], $columns, $values, 'bank_id', '', $action);
                        if(preg_match("/^\d+$/", $bank_insert_id)) {	
                            $bank_id = "";
                            $bank_id = $obj->getTableColumnValue($GLOBALS['bank_table'],'id',$bank_insert_id,'bank_id');							
                            $result = array('number' => '1', 'msg' => 'Bank Account Successfully Created');						
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $bank_insert_id);
                        }
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $bank_error);
                    }
                }
                else {
                    if(empty($prev_bank_id) || $prev_bank_id == $edit_id) {
						if(empty($prev_account_number) || $prev_account_number == $edit_id){
                            $getUniqueID = "";
                            $getUniqueID = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $edit_id, 'id');
                            if(preg_match("/^\d+$/", $getUniqueID)) {
                                $action = "";
                                if(!empty($account_name)) {
                                    $action = "Bank Account Updated. Name - ".$obj->encode_decode('decrypt', $account_name);
                                }
                                $columns = array(); $values = array();						
                                $columns = array('creator_name','account_name', 'account_number', 'bank_name', 'ifsc_code','account_type','bank_name_account_number','branch','payment_mode_id');
                                $values = array("'".$creator_name."'","'".$account_name."'", "'".$account_number."'","'".$bank_name."'","'".$ifsc_code."'","'".$account_type."'","'".$bank_name_account_number."'","'".$branch."'","'".$payment_mode_ids."'");
                                $bank_update_id = $obj->UpdateSQL($GLOBALS['bank_table'], $getUniqueID, $columns, $values, $action);
                                if(preg_match("/^\d+$/", $bank_update_id)) {
                                    $bank_id = "";
                                    $bank_id = $edit_id;
                                    $result = array('number' => '1', 'msg' => 'Updated Successfully');					
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $bank_update_id);
                                }							
                            }
                        }else{
                            $result = array('number' => '2', 'msg' => $bank_error);
                        }
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $bank_error);
                    }
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_bank)) {
                $result = array('number' => '3', 'msg' => $valid_bank);
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
        $total_records_list = $obj->getTableRecords($GLOBALS['bank_table'], 'bill_company_id',$GLOBALS['bill_company_id'],'');
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($obj->encode_decode('decrypt', $val['bank_name'])), $search_text) !== false) || (strpos(strtolower($obj->encode_decode('decrypt', $val['account_number'])), $search_text) !== false) || (strpos(strtolower($obj->encode_decode('decrypt', $val['branch'])), $search_text) !== false) ) {
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
                    <th>Bank Name</th>
                    <th>Bank Account No</th>
                    <th>Branch</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // print_r($show_records_list);
                        if(!empty($show_records_list)) {
                            foreach($show_records_list as $key => $list) {
                                $index = $key + 1;
                                if(!empty($prefix)) { $index = $index + $prefix; }
                                ?>
                                <tr>
                                    <td><?php echo $index; ?></td>
                                    <td>
                                        <?php
                                        if(!empty($list['bank_name'])) {
                                            $list['bank_name'] = $obj->encode_decode('decrypt', $list['bank_name']);
                                            echo $list['bank_name'];
                                        }
                                        ?>
                                        <div class="w-100 py-2">
                                        
                                            <?php
                                                if(!empty($list['creator_name'])) {
                                                    $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                                    echo " Creator : ". $list['creator_name'];
                                                }
                                            ?>                                        
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        if(!empty($list['account_number'])) {
                                            $list['account_number'] = $obj->encode_decode('decrypt', $list['account_number']);
                                            echo $list['account_number'];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($list['branch']))
                                            {
                                                echo $branch = $obj->encode_decode("decrypt",$list['branch']);
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
                                        if(empty($edit_access_error) || empty($delete_access_error)) {  
                                        ?>
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-dark" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <!-- <li><a class="dropdown-item" href="#">View</a></li> -->
                                                    <?php if(empty($edit_access_error)) {  ?>
                                                    <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['bank_id'])) { echo $list['bank_id']; } ?>');"> <i class="fa fa-pencil"></i> &ensp;Edit</a></li>
                                                    <?php }
                                                    if(empty($delete_access_error)) { 
                                                    /*$linked_count = 0;
                                                    $linked_count = $obj->GetBankLinkedCount($list['bank_id']); 

                                                    if($linked_count > 0) {
                                                    ?>    
                                                        <li><a class="dropdown-item" style="cursor:pointer; color: #22223057 !important" href="#"><i class="fa fa-trash"></i> &ensp;Delete</a></li>
                                                    <?php }else{ */?>
                                                        <li><a class="dropdown-item" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['bank_id'])) { echo $list['bank_id']; } ?>');"> <i class="fa fa-trash"></i> &ensp;Delete</a></li>
                                                    <?php  /*}*/ 
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
    if(isset($_REQUEST['delete_bank_id'])) {
        $delete_bank_id = $_REQUEST['delete_bank_id'];
        $msg = "";
        if(!empty($delete_bank_id)) {	
            $bank_unique_id = "";
            $bank_unique_id = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $delete_bank_id, 'id');
            if(preg_match("/^\d+$/", $bank_unique_id)) {
                $account_name = "";
                $account_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $delete_bank_id, 'account_name');
                $action = "";
                if(!empty($account_name)) {
                    $action = "Bank Account Deleted. Name - ".$obj->encode_decode('decrypt', $account_name);
                }
                
                $linked_count = 0;
                $linked_count = $obj->getTableRecords($GLOBALS['payment_table'],'bank_id', $delete_bank_id); 
            
                if(empty($linked_count)) {
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['bank_table'], $bank_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "This Bank Account is associated with other screens";
                }
            }
        }
        echo $msg;
        exit;	
    }