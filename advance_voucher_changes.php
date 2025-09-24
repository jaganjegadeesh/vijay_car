<?php
	include("include_files.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['advance_voucher_module'];
        }
    }


	if(isset($_REQUEST['show_advance_voucher_id'])) { 
        $show_advance_voucher_id = $_REQUEST['show_advance_voucher_id'];
        $advance_voucher_date = date("Y-m-d"); 
        $bill_company_id = $GLOBALS['bill_company_id'];
 
        $engineer_list = array();
        $engineer_list = $obj->getTableRecords($GLOBALS['engineer_table'],'','','');
        
        $payment_mode_list = array();
		$payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'],'bill_company_id',$bill_company_id,'');
        
        ?>
        <form class="poppins pd-20 redirection_form" name="advance_voucher_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<div class="h5">Add Advance Voucher</div>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('advance_voucher.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_user_id)) { echo $show_user_id; } ?>">
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" class="form-control shadow-none" name="advance_voucher_date" value="<?php if(!empty($advance_voucher_date)) { echo $advance_voucher_date; } ?>"  max="<?php if(!empty($advance_voucher_date)) { echo $advance_voucher_date; } ?>">
                            <label>Date(*)</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="engineer_id" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2-danger" onchange="javascript:ShowAdvance(this.value);">
                                <option value="">Select</option>
                                <?php 
                                    if(!empty($engineer_list)) {
                                        foreach($engineer_list as $data) { ?>
                                            <option value="<?php if(!empty($data['engineer_id'])) { echo $data['engineer_id']; } ?>">
                                                <?php
                                                    if(!empty($data['engineer_name'])) {
                                                        $data['engineer_name'] = html_entity_decode($obj->encode_decode('decrypt', $data['engineer_name']));
                                                        echo $data['engineer_name'];
                                                    }
                                                    if(!empty($data['mobile_number'])) {
                                                        $data['mobile_number'] = html_entity_decode($obj->encode_decode('decrypt', $data['mobile_number']));
                                                        echo " - ".$data['mobile_number'];
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    } 
                                ?>
                            </select>
                            <label>Employee(*)</label>
                        </div>
                        <div class="d-none text-primary" id="advance"></div>
                    </div>        
                </div>
                
                <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group mb-2">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" id="remarks" name="remarks" placeholder="" onkeydown="Javascript:KeyboardControls(this,'',150,'');InputBoxColor(this,'text');"></textarea>
                            <label>Remarks(*)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-2 col-md-4 col-12">
                    <div class="form-group mb-2">
                        <div class="form-label-group in-border mb-0">
                            <select name="selected_payment_mode_id" class="select2 select2-danger smallfnt" style="width: 100%;" onchange="Javascript:getBankDetails(this.value);">
                                <option value="">Select</option>
                                <?php
                                    if(!empty($payment_mode_list)) {
                                        foreach($payment_mode_list as $data) { ?>
                                            <option value="<?php if(!empty($data['payment_mode_id'])) { echo $data['payment_mode_id']; } ?>">
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
                                ?>
                            </select>
                            <label>Payment Mode</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-2 col-md-3 col-12 d-none" id="bank_list">
                    <div class="form-group">
                        <div class="form-label-group in-border mt-0">
                            <select name="selected_bank_id" class="select2 select2-danger smallfnt form-control" style="width:100% !important;">
                                <option value="">Select Bank</option>
                                <?php 
                                    if(!empty($bank_list)){
                                        foreach($bank_list as $col){
                                            ?>
                                            <option value="<?php if(!empty($col['bank_id'])){echo $col['bank_id'];} ?>" <?php if(!empty($bank_id) && $col['bank_id'] == $bank_id){ ?>selected<?php } ?>>
                                                <?php 
                                                    if(!empty($col['bank_name'])){
                                                        echo $obj->encode_decode('decrypt',$col['bank_name'])." - ".$obj->encode_decode('decrypt',$col['account_number']);
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="form-group mb-2">
                        <div class="form-label-group in-border">
                            <input type="text" name="selected_amount" class="form-control shadow-none" placeholder="" onfocus="Javascript:KeyboardControls(this,'number','',1);" required>
                            <label>Amount</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-12 text-center p-0">
                    <button class="btn btn-success add_payment_button" style="font-size:12px;" type="button" onclick="Javascript:AddPaymentRow();">
                        <i class="fa fa-plus-circle"></i> Add
                    </button>
                </div> 
            </div>
            <div class="row justify-content-center pt-2"> 
                <div class="col-lg-8">
                    <div class="table-responsive text-center">
                    <input type="hidden" name="payment_row_count" value="0">
                        <table class="table nowrap cursor smallfnt w-100 border payment_row_table">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th style="width:400px;">Payment Mode</th>
                                    <th style="width:200px;">Bank Name</th>
                                    <th style="width:200px;">Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total Amount : </th>
                                    <th class="overall_total"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-dark submit_button" type="button" onClick="Javascript:SaveModalContent(event,'advance_voucher_form', 'advance_voucher_changes.php', 'advance_voucher.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script>
                jQuery(document).ready(function(){
                    jQuery('.add_update_form_content').find('select').select2();
                    jQuery(".select2").on("select2:open", function () {
                        // Find the inner search field of the opened dropdown
                        var searchField = "";
                        searchField = document.querySelector(".select2-container--open .select2-search__field");
                        if (searchField) {
                            searchField.focus();
                        }
                    });
                });
            </script>
            <script type="text/javascript">     
                jQuery(document).ready(function(){
                    jQuery('input[name="selected_amount"]').on("keypress", function(e) {
                        if (e.keyCode == 13) {
                            if(jQuery('.add_payment_button').length > 0) {
                                jQuery('.add_payment_button').trigger('click');
                            }
                        }
                    });
                });
            </script>
        </form>
	<?php
    } 

    if(isset($_POST['edit_id'])) {
        $advance_voucher_date = ""; $advance_voucher_date_error = ""; $staff_id = ""; $staff_id_error = "";
        $payment_mode_ids = array(); $bank_ids = array(); $bank_names = array(); $payment_mode_names = array(); $amount = array(); $total_amount = 0; $payment_error = ""; $staff_name = ""; $narration = ""; $narration_error = ""; $staff_type_id="";
        $form_name = "advance_voucher_form"; $valid_advance_voucher = ""; 

        $edit_id = "";
        if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
		}

        if(isset($_POST['advance_voucher_date'])){
            $advance_voucher_date = $_POST['advance_voucher_date'];
            $advance_voucher_date = trim($advance_voucher_date);
            $advance_voucher_date_error = $valid->valid_date($advance_voucher_date, 'Advance Voucher Date', 1);
        }
        if(!empty($advance_voucher_date_error)) {
            $valid_advance_voucher = $valid->error_display($form_name, "advance_voucher_date", $advance_voucher_date_error, 'text');
        }

        if(isset($_POST['engineer_id'])) {
			$engineer_id = $_POST['engineer_id'];
            $engineer_id = trim($engineer_id);
            $engineer_id_error = $valid->common_validation($engineer_id, 'Employee', 'select');
		}
        if(!empty($engineer_id_error)){
            if(!empty($valid_advance_voucher)) {
                $valid_advance_voucher = $valid_advance_voucher." ".$valid->error_display($form_name, "engineer_id", $engineer_id_error, 'select');
            }
            else {
                $valid_advance_voucher = $valid->error_display($form_name, "engineer_id", $engineer_id_error, 'select');
            }
        }

        if(isset($_POST['remarks'])) {
            $remarks = $_POST['remarks'];
            $remarks = trim($remarks);
            $remarks_error = $valid->valid_address($remarks,'Remarks','1','150');
        }
        if(!empty($remarks_error)) {
            if(!empty($valid_advance_voucher)) {
                $valid_advance_voucher = $valid_advance_voucher." ".$valid->error_display($form_name, "remarks", $remarks_error, 'textarea');
            }
            else {
                $valid_advance_voucher = $valid->error_display($form_name, "remarks", $remarks_error, 'textarea');
            }
        }

        if(isset($_POST['selected_payment_mode_id'])){
            $selected_payment_mode_id = $_POST['selected_payment_mode_id'];
        }

        if(!empty($selected_payment_mode_id)){
            $payment_error = "Click Add Button to Append Payment";
        }

        if(isset($_POST['payment_mode_id'])) {
            $payment_mode_ids = $_POST['payment_mode_id'];
            $payment_mode_ids = array_reverse($payment_mode_ids);
        }
        if(isset($_POST['bank_id'])) {
            $bank_ids = $_POST['bank_id'];
            $bank_ids = array_reverse($bank_ids);
        }
        if(isset($_POST['amount'])) {
            $amount = $_POST['amount'];
            $amount = array_reverse($amount);
        }

        if(!empty($payment_mode_ids)) {
            for($i=0; $i < count($payment_mode_ids); $i++) {
                $payment_mode_ids[$i] = trim($payment_mode_ids[$i]);
                $payment_mode_name = "";
                $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_ids[$i], 'payment_mode_name');
                $payment_mode_names[$i] = $payment_mode_name;
                
                $bank_ids[$i] = trim($bank_ids[$i]);
                if(!empty($bank_ids[$i])) {
                    $bank_name = "";
                    $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_ids[$i], 'bank_name');
                    if(!empty($bank_name) && $bank_name != $GLOBALS['null_value']) {
                        $bank_names[$i] = $bank_name;
                    }
                    else {
                        $bank_names[$i] = "";
                    }
                }
                else {
                    $bank_ids[$i] = "";
                    $bank_names[$i] = "";
                }
                $amount[$i] = trim($amount[$i]);
                if(isset($amount[$i])) {
                    $amount_error = "";
                    $amount_error = $valid->valid_price($amount[$i], 'Amount', '1', '');
                    if(!empty($amount_error)) {
                        if(!empty($valid_advance_voucher)) {
                            $valid_advance_voucher = $valid_advance_voucher." ".$valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                        else {
                            $valid_advance_voucher = $valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                    }
                    else {
                        $total_amount += $amount[$i];
                    }
                }
            }
        }
        else {
            $payment_error = "Add Payment";
        }
        
        if(empty($valid_advance_voucher) && empty($payment_error)) {
            $check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
            $bill_company_id = $GLOBALS['bill_company_id'];
            $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
            $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
            
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
				if(!empty($advance_voucher_date)) {
					$advance_voucher_date = date("Y-m-d", strtotime($advance_voucher_date));
				}
                if(!empty($engineer_id)) {
                    $engineer_name = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $engineer_id, 'engineer_name');
                    $engineer_name_code = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $engineer_id, 'engineer_name_code');
                }
                else {
                    $engineer_id = $GLOBALS['null_value'];
                    $engineer_name_code = $GLOBALS['null_value'];
                    $engineer_name = $GLOBALS['null_value'];
                }

                if(!empty($payment_mode_ids)) {
                    $payment_mode_ids = array_reverse($payment_mode_ids);
                    $payment_mode_ids = implode(',', $payment_mode_ids);
                }
                else {
                    $payment_mode_ids = $GLOBALS['null_value'];
                }
                if(!empty($payment_mode_names)) {
                    $payment_mode_names = array_reverse($payment_mode_names);
                    $payment_mode_names = implode(',', $payment_mode_names);
                }
                else {
                    $payment_mode_names = $GLOBALS['null_value'];
                }
                if(!empty($bank_ids)) {
                    $bank_ids = array_reverse($bank_ids);
                    $bank_ids = implode(',', $bank_ids);
                }
                else {
                    $bank_ids = $GLOBALS['null_value'];
                }
                if(!empty($bank_names)) {
                    $bank_names = array_reverse($bank_names);
                    $bank_names = implode(',', $bank_names);
                }
                else {
                    $bank_names = $GLOBALS['null_value'];
                }
                if(!empty($amount)) {
                    $amount = array_reverse($amount);
                    $amount = implode(',', $amount);
                }
                else {
                    $amount = $GLOBALS['null_value'];
                }
                if(!empty($remarks)) {
                    $remarks = $obj->encode_decode('encrypt', $remarks);
                }
                else {
                    $remarks = $GLOBALS['null_value'];
                }

                $balance = 0;
        
                if(empty($edit_id)) {	
                    $action = "";
					if(!empty($engineer_name) && $engineer_name != $GLOBALS['null_value']) {
						$action = "New Advance Voucher Created. Name - ".($obj->encode_decode('decrypt', $engineer_name));
					}
					$null_value = $GLOBALS['null_value'];
					$columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'advance_voucher_id', 'advance_voucher_number', 'advance_voucher_date','engineer_id', 'engineer_name', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount', 'deleted');
					$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$null_value."'", "'".$advance_voucher_date."'", "'".$engineer_id."'", "'".$engineer_name."'", "'".$remarks."'", "'".$amount."'", "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'", "'".$total_amount."'", "'0'");
                    $advance_voucher_insert_id = $obj->InsertSQL($GLOBALS['advance_voucher_table'], $columns, $values, 'advance_voucher_id', 'advance_voucher_number', $action);
                    if(preg_match("/^\d+$/", $advance_voucher_insert_id)) {	
                        $balance = 1;							
                        $advance_voucher_id = $obj->getTableColumnValue($GLOBALS['advance_voucher_table'], 'id', $advance_voucher_insert_id, 'advance_voucher_id');
                        $advance_voucher_number = $obj->getTableColumnValue($GLOBALS['advance_voucher_table'], 'id', $advance_voucher_insert_id, 'advance_voucher_number');							
                        $result = array('number' => '1', 'msg' => 'Advance Voucher Successfully Created');

                        $engineer_advance="";
                        $engineer_advance=$obj->UpdateEngineerAdavncePlus($engineer_id,$total_amount);

                    }
                    else {
                        $result = array('number' => '2', 'msg' => $advance_voucher_insert_id);
                    }
                }

                if(!empty($balance) && $balance == 1) {
                    $credit  = 0; $debit = 0; $bill_type ="Advance Voucher";
                    
                    if(!empty($payment_mode_ids)) {
                        $payment_mode_id = explode(',', $payment_mode_ids);
                        $payment_mode_id = array_reverse($payment_mode_id);
                    }

                    if(!empty($bank_ids)) {
                        $bank_id = explode(',', $bank_ids);
                        $bank_id = array_reverse($bank_id);
                    }
                    if(!empty($payment_mode_names)) {
                        $payment_mode_name = explode(',', $payment_mode_names);
                        $payment_mode_name = array_reverse($payment_mode_name);
                    }
                    if(!empty($bank_names)) {
                        $bank_name = explode(',', $bank_names);
                        $bank_name = array_reverse($bank_name);
                    }
                    if(!empty($amount)) {
                        $amounts = explode(',', $amount);
                        $amounts = array_reverse($amounts);
                    }

                    $bill_id = $advance_voucher_id;
                    $bill_date = $advance_voucher_date;
                    $bill_number = $advance_voucher_number;
                    
                    if(!empty($payment_mode_id)){
                        for($i = 0; $i < count($payment_mode_id); $i++) {
                    
                            $debit = $amounts[$i];
                            $credit = 0;
                            $party_type ='4';

                            if(empty($bank_id[$i])){
                                $bank_id[$i] =$GLOBALS['null_value'];
                            }
                            if(empty($bank_name[$i])){
                                $bank_name[$i] =$GLOBALS['null_value'];
                            }

                            $update_balance ="";
                            $update_balance = $obj->UpdateBalance($bill_company_id,$bill_id,$bill_number,$bill_date,$bill_type,$engineer_id,$engineer_name,$party_type,$payment_mode_id[$i],$payment_mode_name[$i],$bank_id[$i],$bank_name[$i],'','',$credit,$debit);
                        }
                    } 
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_advance_voucher)) {
				$result = array('number' => '3', 'msg' => $valid_advance_voucher);
			}
			else if(!empty($payment_error)) {
				$result = array('number' => '2', 'msg' => $payment_error);
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
		$search_text = ""; $from_date = ""; $to_date = "";

		$filter_engineer_id = "";
		if(isset($_POST['filter_engineer_id'])) {
			$filter_engineer_id = $_POST['filter_engineer_id'];
            $filter_engineer_id = trim($filter_engineer_id);
		} 
		$search_text = "";
		if(isset($_POST['search_text'])) {
			$search_text = $_POST['search_text'];
            $search_text = trim($search_text);
		}
		$from_date = "";
		if(isset($_POST['from_date'])) {
			$from_date = $_POST['from_date'];
		}
		$to_date = "";
		if(isset($_POST['to_date'])) {
			$to_date = $_POST['to_date'];
		}
		$show_bill = 0;
		if(isset($_POST['show_bill'])){
			$show_bill = $_POST['show_bill'];
		}
		$total_records_list = array();
		$total_records_list = $obj->getAdvanceVoucherList($GLOBALS['bill_company_id'],$from_date, $to_date, $show_bill, $filter_engineer_id);
		if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($total_records_list)) {
				foreach($total_records_list as $val) {
					if( (strpos(strtolower($val['advance_voucher_number']), $search_text) !== false) ) {
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
        if($total_pages > $page_limit) { 
            ?>
			<div class="pagination_cover mt-3"> 
				<?php
					include("pagination.php");
				?> 
			</div> 
            <?php 
        } 
        $login_staff_id = "";
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id =  $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
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
                    <th>Date</th>
                    <th>Advance Voucher No</th>
                    <th>Employee</th>
                    <th>Amount</th>
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
                                <td><?php echo $index; ?></td>
                                <td>
                                    <?php
                                    if(!empty($list['advance_voucher_date'])) { 
                                        echo date("d-m-Y",strtotime($list['advance_voucher_date'])); 
                                    } ?>
                                </td>
                                <td>
                                    <?php if(!empty($list['advance_voucher_number'])) { 
                                        echo $list['advance_voucher_number']; 
                                    } ?>
                                    <?php if(!empty($list['deleted'] =='1')) { ?> <br><span style="color: red;">Cancelled</span><?php }	
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['engineer_name'])) {
                                            echo $obj->encode_decode("decrypt", $list['engineer_name']);
                                        }
                                    ?>
                                    
                                </td>
                                <td><?php if(!empty($list['total_amount'])) { echo $obj->numberFormat($list['total_amount'], 2); } ?></td>
                                <td class="text-center px-2 py-2">
                                    <?php
                                        $delete_access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $delete_action;
                                            include('permission_action.php');
                                        }
                                    ?>
                                    <div class="dropdown">
                                        <a role="button" class="btn btn-dark show-button poppins" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <li><a class="dropdown-item" target="_blank" href="reports/rpt_advance_voucher_a5.php?view_advance_voucher_id=<?php if(!empty($list['advance_voucher_id'])) { echo $list['advance_voucher_id']; } ?>&party_type=<?php if(!empty($list['party_type'])) { echo $list['party_type']; } ?>&from="><i class="fa fa-print"></i> &ensp; Print</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="reports/rpt_advance_voucher_a5.php?view_advance_voucher_id=<?php if(!empty($list['advance_voucher_id'])) { echo $list['advance_voucher_id']; } ?>&from=D"><i class="fa fa-download"></i> &ensp; Download</a></li>
                                            
                                            <?php 
                                                $advance_linked_count = 0;
                                                $advance_linked_count = $obj->getAdvanceLinkedCount($GLOBALS['bill_company_id'],$list['engineer_id'],$list['total_amount']);

                                                if(empty($advance_linked_count)){
                                                    if(empty($list['deleted'])){ 
                                                        if(empty($delete_access_error)) { ?>
                                                        <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['advance_voucher_id'])) { echo $list['advance_voucher_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                        <?php }
                                                    }
                                                } else { ?>
                                                   <li><a class="dropdown-item text-secondary" href="#"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                   <?php
                                                }

                                            ?>

                                            <?php  ?>
                                        </ul>
                                    </div> 
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td colspan="5" class="text-center">Sorry! No records found</td>
                        </tr>
                        <?php 
                    } 
                ?>
            </tbody>
        </table>   
        <?php	
        }
	}

    if(isset($_REQUEST['delete_advance_voucher_id'])) {
		$delete_advance_voucher_id = $_REQUEST['delete_advance_voucher_id'];
		$msg = ""; $delete_id = ""; $advance_voucher_engineer_amount = 0;
		if(!empty($delete_advance_voucher_id)) {
			$advance_voucher_unique_id = "";$advance_voucher_engineer_id = ""; $advance_voucher_amount = 0;
			$advance_voucher_unique_id = $obj->getTableColumnValue($GLOBALS['advance_voucher_table'], 'advance_voucher_id', $delete_advance_voucher_id, 'id');
            $advance_voucher_number= $obj->getTableColumnValue($GLOBALS['advance_voucher_table'], 'advance_voucher_id', $delete_advance_voucher_id, 'advance_voucher_number');
            $advance_voucher_engineer_id = $obj->getTableColumnValue($GLOBALS['advance_voucher_table'], 'advance_voucher_id', $delete_advance_voucher_id, 'engineer_id');
            $advance_voucher_engineer_amount = $obj->getTableColumnValue($GLOBALS['advance_voucher_table'], 'advance_voucher_id', $delete_advance_voucher_id, 'total_amount');

            $advance_linked_count = 0;
            $advance_linked_count = $obj->getAdvanceLinkedCount($GLOBALS['bill_company_id'],$advance_voucher_engineer_id,$advance_voucher_engineer_amount);

            if(empty($advance_linked_count)) {
                $advance_voucher_amount = $obj->getTableColumnValue($GLOBALS['advance_voucher_table'], 'advance_voucher_id', $delete_advance_voucher_id, 'total_amount');
                if(!empty($advance_voucher_engineer_id) && !empty($advance_voucher_amount)){
                    $engineer_advance = "";
                    $engineer_advance = $obj->UpdateEngineerAdvanceMinus($advance_voucher_engineer_id, $advance_voucher_amount);
                }
                
                $action = "";
                if(!empty($advance_voucher_number)) {
                    $action = "Advance Voucher Deleted. Number - ".$advance_voucher_number;
                }
                $delete_id = $obj->DeletePayment($delete_advance_voucher_id);
                $columns = array(); $values = array();						
                $columns = array('deleted');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['advance_voucher_table'], $advance_voucher_unique_id, $columns, $values, $action);
            }
            else {
                $msg = "Cannot delete this Advance Voucher";
            }
		}
		echo $msg;
		exit;
	} 

?>
