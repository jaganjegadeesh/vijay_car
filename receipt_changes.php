<?php
	include("include_files.php");
    
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['receipt_module'];
        }
    }
    
	if(isset($_REQUEST['show_receipt_id'])) {
        $show_receipt_id = $_REQUEST['show_receipt_id'];
        $receipt_date = date("Y-m-d"); 
        $selected_payment_mode = "";

        $payment_mode_list = array();
		$payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], '','','');
        
        $payment_mode_count = 0;
        $payment_mode_count = count($payment_mode_list);  

        $party_list = array();
        $party_list =$obj->getPartyList('2');
        
        ?>
        <form class="poppins pd-20 redirection_form" name="receipt_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<div class="h5">Add Receipt</div>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('receipt.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_receipt_id)) { echo $show_receipt_id; } ?>">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-md-3 col-6">
                            <div class="form-group pb-2">
                                <div class="form-label-group in-border">
                                <input type="date" class="form-control shadow-none" name="receipt_date" value="<?php if(!empty($receipt_date)) { echo $receipt_date; } ?>"  max="<?php if(!empty($receipt_date)) { echo $receipt_date; } ?>">
                                <label>Date(*)</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 party_display">
                            <div class="form-group pb-2">
                                <div class="form-label-group in-border mb-0">
                                    <select name="party_id" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2 select2-danger" onchange="Javascript:HideDetails('Party');">
                                        <option value="">Select</option>
                                        <?php
                                        if(!empty($party_list)) {
                                            foreach($party_list as $data) { ?>
                                                <option value="<?php if(!empty($data['party_id'])) { echo $data['party_id']; } ?>"> <?php
                                                    if(!empty($data['name_mobile_city'])) {
                                                        $data['name_mobile_city'] = html_entity_decode($obj->encode_decode('decrypt', $data['name_mobile_city']));
                                                        echo $data['name_mobile_city'];
                                                    } ?>
                                                </option> <?php
                                            }
                                        } ?>
                                    </select>
                                    <label>Party(*)</label> 
                                </div>
                                <a href="Javascript:ViewPartyDetails('party');" class="d-none details_element" style="font-size: 12px;font-weight: bold;">Click to view details</a>
                            </div>        
                            <div class="col-lg-12 col-md-4 col-12">
                                <div class="form-group pb-2">
                                    <div class="form-label-group in-border">
                                        <a href="Javascript:ViewPendingDetails('party');" class="d-none details_element" style="font-size: 12px;font-weight: bold;">Click to view Pending details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="form-group pb-2">
                                <div class="form-label-group in-border">
                                <textarea class="form-control" id="narration" name="narration" placeholder="" onkeydown="Javascript:InputBoxColor(this,'text');return event.key !== 'Enter';" maxlength="150"></textarea>
                                    <label>Narration(*)</label>
                                </div>
                                <div class="new_smallfnt">Max Char: 150(Except <>?{}!*^%$)</div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="form-group pb-2">
                                <div class="form-label-group in-border mb-0">
                                    <select name="selected_payment_mode_id" class="select2 select2-danger smallfnt" style="width: 100%;" onchange="Javascript:getBankDetails(this.value);">
                                        <option value="">Select</option>
                                        <?php
                                            if(!empty($payment_mode_list)) {
                                                foreach($payment_mode_list as $data) { ?>
                                                    <option value="<?php if(!empty($data['payment_mode_id'])) { echo $data['payment_mode_id']; } ?>" <?php if(!empty($payment_mode_count) && $payment_mode_count == 1){ ?> selected <?php } ?>>
                                                        <?php
                                                            $selected_payment_mode = $data['payment_mode_id'];

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
                        <div class="col-lg-3 col-md-3 col-6 d-none" id="bank_list">
                            <div class="form-group pb-2">
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
                                    <label>Bank</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="form-group pb-2">
                                <div class="form-label-group in-border">
                                <input type="text" name="selected_amount" class="form-control shadow-none" value="" placeholder="" onfocus="Javascript:KeyboardControls(this,'number','',1);" required>
                                <label>Amount</label>
                                </div>
                                <!-- <span class="payment text-success fw-bold"></span> -->
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <button class="btn btn-danger add_payment_button" style="font-size:12px;" type="button" onclick="Javascript:AddPaymentRow();" name="append_button">
                                Add To Bill
                            </button>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center pt-3"> 
                        <div class="col-lg-8">
                            <div class="table-responsive text-center">
                            <input type="hidden" name="payment_row_count" value="0">
                                <table class="table nowrap cursor smallfnt w-100 table-bordered payment_row_table fw-bold">
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
                    </div>
                    <div class="col-md-12 py-3 text-center">
                        <button class="btn btn-dark submit_button" type="button" onClick="Javascript:SaveModalContent(event,'receipt_form', 'receipt_changes.php', 'receipt.php');">
                            Submit
                        </button>
                    </div>
                </div>     
            </div>
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    <?php 
                    if($payment_mode_count == 1){ ?>
                            getBankDetails('<?php if(!empty($selected_payment_mode)){ echo $selected_payment_mode; } ?>');
                    <?php } 

                   /* if(empty($show_receipt_id)){ ?>
                        GetPayment();
                        <?php 
                    }*/ ?>
                    
                    jQuery('.add_update_form_content').find('select').select2();
                    jQuery(".select2").on("select2:open", function () {
                        // Find the inner search field of the opened dropdown
                        var searchField = "";
                        searchField = document.querySelector(".select2-container--open .select2-search__field");
                        if (searchField) {
                            searchField.focus();
                        }
                    });

                    jQuery('input[name="selected_amount"]').on("keypress", function(e) {
                        if (e.keyCode == 13) {
                            if(jQuery('.add_payment_button').length > 0) {
                                jQuery('.add_payment_button').trigger('click');
                            }
                        }
                    });
                });
            </script>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script type="text/javascript" src="include/js/creation_modules.js"></script>
            <script type="text/javascript" src="include/js/payment.js"></script>
        </form>
	<?php
    } 

    if(isset($_POST['edit_id'])) {
        $receipt_date = ""; $receipt_date_error = "";$investment_type="";$investment_type_error=""; $party_id = ""; $party_id_error = "";$party_type = "";$payment_mode_ids = array(); $bank_ids = array(); $bank_names = array(); $payment_mode_names = array(); $amount = array(); $total_amount = 0; $payment_error = ""; $party_name = ""; $narration = ""; $narration_error = ""; $name_mobile_city = ""; $selected_payment_mode_id = "";  $selected_amount = ""; $selected_amount_error = ""; $selected_bank_id = ""; $selected_payment_mode_id = ""; $selected_payment_mode_id_error = "";
        $form_name = "receipt_form"; $valid_receipt = ""; 

        $edit_id = "";
        if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
		}

        if(isset($_POST['receipt_date'])){
            $receipt_date = $_POST['receipt_date'];
            $receipt_date = trim($receipt_date);
            $receipt_date_error = $valid->valid_date($receipt_date, 'Receipt Date', 1);
        }
        if(!empty($receipt_date_error)) {
            $valid_receipt = $valid->error_display($form_name, "receipt_date", $receipt_date_error, 'text');
        }

        if(isset($_POST['investment_type'])) {
			$investment_type = $_POST['investment_type'];
            $investment_type = trim($investment_type);
            $investment_type_error = $valid->common_validation($investment_type, 'Investment Type', 'select');
		}
        if(!empty($investment_type_error)){
            if(!empty($valid_receipt)) {
                $valid_receipt = $valid_receipt." ".$valid->error_display($form_name, "investment_type", $investment_type_error, 'select');
            }
            else {
                $valid_receipt = $valid->error_display($form_name, "investment_type", $investment_type_error, 'select');
            }
        }

        if(isset($_POST['party_id'])) {
			$party_id = $_POST['party_id'];
            $party_id = trim($party_id);
            $party_id_error = $valid->common_validation($party_id, 'party', 'select');
		}
        if(!empty($party_id_error)){
            if(!empty($valid_receipt)) {
                $valid_receipt = $valid_receipt." ".$valid->error_display($form_name, "party_id", $party_id_error, 'select');
            }
            else {
                $valid_receipt = $valid->error_display($form_name, "party_id", $party_id_error, 'select');
            }
        }

        if(isset($_POST['selected_payment_mode_id'])){
            $selected_payment_mode_id = $_POST['selected_payment_mode_id'];
        }

        if(!empty($selected_payment_mode_id)){
            $payment_error = "Click Add Button to Append Payment";
        }

        if(isset($_POST['narration'])) {
            $narration = $_POST['narration'];
            $narration = trim($narration);
            
            if(empty($narration)) {
                $narration_error = "Enter Narration";
            }
        }
        if(!empty($narration_error)) {
            if(!empty($valid_receipt)) {
                $valid_receipt = $valid_receipt." ".$valid->error_display($form_name, "narration", $narration_error, 'textarea');
            }
            else {
                $valid_receipt = $valid->error_display($form_name, "narration", $narration_error, 'textarea');
            }
        }

        if(!empty($narration)) {
            $narration = htmlspecialchars($narration, ENT_QUOTES, 'UTF-8');
        }

        if(isset($_POST['selected_amount'])) {
            $selected_amount = $_POST['selected_amount'];
        }

        if(isset($_POST['selected_payment_mode_id'])) {
            $selected_payment_mode_id = $_POST['selected_payment_mode_id'];
        }

        if(isset($_POST['selected_bank_id'])) {
            $selected_bank_id = $_POST['selected_bank_id'];
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
                        if(!empty($valid_receipt)) {
                            $valid_receipt = $valid_receipt." ".$valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                        else {
                            $valid_receipt = $valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                    }
                    else {
                        $total_amount += $amount[$i];
                    }
                }
            }
        }
        else {
           if(count($payment_mode_ids) <= 0) {
                $selected_payment_mode_id_error = $valid->common_validation($selected_payment_mode_id, 'payment mode', 'select');
    
                if(!empty($valid_receipt)) {
                    $valid_receipt = $valid_receipt." ".$valid->error_display($form_name, "selected_payment_mode_id", $selected_payment_mode_id_error, 'select');
                }
                else {
                    $valid_receipt = $valid->error_display($form_name, "selected_payment_mode_id", $selected_payment_mode_id_error, 'select');
                }
            }

            if(count($amount) == 0) {
                $selected_amount_error = $valid->common_validation($selected_amount, 'Amount', 'text');
    
                if(!empty($valid_receipt)) {
                    $valid_receipt = $valid_receipt." ".$valid->error_display($form_name, "selected_amount", $selected_amount_error, 'text');
                }
                else {
                    $valid_receipt = $valid->error_display($form_name, "selected_amount", $selected_amount_error, 'text');
                }
            }
        }
        
        if(empty($valid_receipt) && empty($payment_error)) {
            $check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();
            $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
            $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
            $bill_company_id = $GLOBALS['bill_company_id']; 
            
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
				if(!empty($receipt_date)) {
					$receipt_date = date("Y-m-d", strtotime($receipt_date));
				}

                if(!empty($party_id)){
                    $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_name');
                    $name_mobile_city = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'name_mobile_city');
                    $party_type = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_type');
                } else {
                    $party_id = $GLOBALS['null_value'];
                    $party_name = $GLOBALS['null_value'];
                    $name_mobile_city = $GLOBALS['null_value'];
                    $party_type = $GLOBALS['null_value'];
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
                if(!empty($narration)) {
                    $narration = $obj->encode_decode('encrypt', $narration);
                }
                else {
                    $narration = $GLOBALS['null_value'];
                }

                $balance = 0;	
                if(empty($edit_id)) {	
                    $action = "";
					if(!empty($party_name) && $party_name != $GLOBALS['null_value']) {
						$action = "New Receipt Created. Name - ".($obj->encode_decode('decrypt', $party_name));
					}
					$null_value = $GLOBALS['null_value'];
					$columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'receipt_id', 'receipt_number', 'receipt_date', 'party_id', 'party_name','party_type','investment_type', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount', 'deleted','name_mobile_city');
					$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$null_value."'", "'".$receipt_date."'", "'".$party_id."'", "'".$party_name."'","'".$party_type."'", "'".$investment_type."'", "'".$narration."'", "'".$amount."'", "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'", "'".$total_amount."'", "'0'","'".$name_mobile_city."'");
                    $receipt_insert_id = $obj->InsertSQL($GLOBALS['receipt_table'], $columns, $values, 'receipt_id', 'receipt_number', $action);	
                    if(preg_match("/^\d+$/", $receipt_insert_id)) {
                        $balance = 1;							
                        $receipt_id = $obj->getTableColumnValue($GLOBALS['receipt_table'], 'id', $receipt_insert_id, 'receipt_id');
                        $receipt_number = $obj->getTableColumnValue($GLOBALS['receipt_table'], 'id', $receipt_insert_id, 'receipt_number');
                        $result = array('number' => '1', 'msg' => 'Receipt Successfully Created');						
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $receipt_insert_id);
                    }
                }
                
                
                if(!empty($balance) && $balance == 1) {
                    $credit  = 0; $debit = 0; $bill_type ="Receipt";
                    
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

                    $bill_id = $receipt_id;
                    $bill_date = $receipt_date;
                    $bill_number = $receipt_number;
                    
                    if(!empty($payment_mode_id)){
                        for($i = 0; $i < count($payment_mode_id); $i++) {
                            $imploded_amount = $amounts[$i];
                    
                            $credit = $amounts[$i];
                            $debit = 0;

                            if(empty($bank_id[$i])){
                                $bank_id[$i] =$GLOBALS['null_value'];
                            }
                            if(empty($bank_name[$i])){
                                $bank_name[$i] =$GLOBALS['null_value'];
                            }

                            $update_balance ="";
                            $update_balance = $obj->UpdateBalance($bill_company_id,$bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$payment_mode_id[$i],$payment_mode_name[$i],$bank_id[$i],$bank_name[$i],'0','NULL',$credit,$debit, $investment_type);
                        }
                    } 
                }
                
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_receipt)) {
				$result = array('number' => '3', 'msg' => $valid_receipt);
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

		$filter_party_id = "";
		if(isset($_POST['filter_party_id'])) {
			$filter_party_id = $_POST['filter_party_id'];
            $filter_party_id = trim($filter_party_id);
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
		$total_records_list = $obj->getReceiptList($from_date, $to_date, $show_bill, $filter_party_id);
		
        if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($total_records_list)) {
				foreach($total_records_list as $val) {
					if( (strpos(strtolower($val['receipt_number']), $search_text) !== false) ) {
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

        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
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
                    <th>Receipt No<br>Date</th>
                    <th>Party</th>
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
                                    <?php if(!empty($list['receipt_number'])) { echo $list['receipt_number']." <br>".date("d-m-Y",strtotime($list['receipt_date'])); } ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['name_mobile_city'])) {
                                            $party_name = "";
                                            $party_name = $list['name_mobile_city'];
                                            if(!empty($party_name)) { 
                                                echo $obj->encode_decode("decrypt", $party_name);
                                            }
                                        }else{
                                            if(!empty($list['party_name'])) {
                                                $party_name = "";
                                                $party_name = $list['party_name'];
                                                if(!empty($party_name)) { 
                                                    echo $obj->encode_decode("decrypt", $party_name);
                                                }
                                            }
                                        } ?>
                                        <div class="w-100 py-2">
                                        <?php
                                            if(!empty($list['creator_name'])) {
                                                $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                                echo " Creator : ". $list['creator_name'];
                                            }
                                        ?>                                        
                                        </div>
                                        <?php if(!empty($list['deleted'] =='1')) { ?> <span style="color: red;">Cancelled</span><?php }	
                                    ?>
                                </td>
                                <td>
                                    <?php if(!empty($list['total_amount'])) { echo $obj->numberFormat($list['total_amount'], 2); } ?>
                                </td> 
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
                                            <li><a class="dropdown-item" target="_blank" href="reports/rpt_receipt_a5.php?view_receipt_id=<?php if(!empty($list['receipt_id'])) { echo $list['receipt_id']; } ?>&party_type=<?php if(!empty($list['party_type'])) { echo $list['party_type']; } ?>&from="><i class="fa fa-print"></i> &ensp; Print</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="reports/rpt_receipt_a5.php?view_receipt_id=<?php if(!empty($list['receipt_id'])) { echo $list['receipt_id']; } ?>&from=D"><i class="fa fa-download"></i> &ensp; Download</a></li>
                                            <?php if(empty($list['deleted'])){ 
                                                if(empty($delete_access_error)) { ?>
                                                <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['receipt_id'])) { echo $list['receipt_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                <?php }
                                            } ?>
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

	if(isset($_REQUEST['delete_receipt_id'])) {
		$delete_receipt_id = $_REQUEST['delete_receipt_id'];
		$msg = ""; $delete_id = "";
		if(!empty($delete_receipt_id)) {	
            $delete_id = $obj->DeletePayment($delete_receipt_id);
			$receipt_unique_id = "";
			$receipt_unique_id = $obj->getTableColumnValue($GLOBALS['receipt_table'], 'receipt_id', $delete_receipt_id, 'id');
            $receipt_number= $obj->getTableColumnValue($GLOBALS['receipt_table'], 'receipt_id', $delete_receipt_id, 'receipt_number');
            $action = "";
            if(!empty($receipt_number)) {
                $action = "Receipt Deleted. Number - ".$receipt_number;
            }

            $columns = array(); $values = array();						
            $columns = array('deleted');
            $values = array("'1'");
            $msg = $obj->UpdateSQL($GLOBALS['receipt_table'], $receipt_unique_id, $columns, $values, $action); 
		}
		echo $msg;
		exit;
	}