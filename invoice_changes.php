<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['invoice_module'];
        }
    } 
	if(isset($_REQUEST['show_invoice_id'])) { 
        $show_invoice_id = $_REQUEST['show_invoice_id'];
        $party_list = array();
        

        $party_list = $obj->getJobCardPartyList('invoice');
        $charges_id = array(); $charges_type = array(); $charges_value = array();  $product_tax =array(); $draft =0; $discount_name = ""; $charges_tax_array = array(); $round_off =""; $round_off_type =""; $round_off_value ="";

        $invoice_date = date('Y-m-d');$invoice_bill_date = date('Y-m-d'); $current_date = date('Y-m-d');$invoice_number = "";$discount =""; $discount_value="";$charges_value=""; $amount =array(); $round_off =""; $round_off_type =""; $round_off_value =""; $store_id = array(); $store_name = array(); $product_id = array(); $product_name = array(); $product_amount = array();$discount = ""; $discount_value = "";$extra_charges = ""; $extra_charges_value = ""; $unit_id =array(); $unit_name=array(); $charges_id = array(); $draft =0; $discount_name = ""; $gst_option = 0; $tax_type = 0; $tax_option = 0; $overall_tax = "";$charges_tax =array();$product_tax =array(); $charges_tax_array = array(); $bank_id = ''; $bank_name = ''; $bank_account_number = '';

        if(!empty($show_invoice_id)) {
            $invoice_list = $obj->getTableRecords($GLOBALS['invoice_table'], 'invoice_id', $show_invoice_id, '');   
            if(!empty($invoice_list)) {
                foreach($invoice_list as $data) {
                    if(!empty($data['invoice_date'])) {
                        $invoice_date = date('Y-m-d', strtotime($data['invoice_date']));
                    }
                    if(!empty($data['invoice_number']) && $data['invoice_number'] != $GLOBALS['null_value']) {
                        $invoice_number = $data['invoice_number'];
                    }   
                    if(!empty($data['bank_id']) && $data['bank_id'] != $GLOBALS['null_value']) {
                        $bank_id = $data['bank_id'];
                    }
                    if(!empty($data['bank_name']) && $data['bank_name'] != $GLOBALS['null_value']) {
                        $bank_name = $data['bank_name'];
                    }
                    if(!empty($data['bank_account_number']) && $data['bank_account_number'] != $GLOBALS['null_value']) {
                        $bank_account_number = $data['bank_account_number'];
                    }            
                    if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                        $party_id = $data['party_id'];
                    }
                    if(!empty($data['party_name_mobile_city']) && $data['party_name_mobile_city'] != $GLOBALS['null_value']) {
                        $party_name = $data['party_name_mobile_city'];
                    }
                    if(!empty($data['vehicle_id']) && $data['vehicle_id'] != $GLOBALS['null_value']) {
                        $vehicle_id = $data['vehicle_id'];
                    }
                    if(!empty($data['vehicle_number']) && $data['vehicle_number'] != $GLOBALS['null_value']) {
                        $vehicle_number = $data['vehicle_number'];
                    }
                    if(!empty($data['vehicle_details']) && $data['vehicle_details'] != $GLOBALS['null_value']) {
                        $vehicle_details = $obj->encode_decode('decrypt', $data['vehicle_details']);
                    }
                    if(!empty($data['gst_option']) && $data['gst_option'] != $GLOBALS['null_value']) {
                        $gst_option = $data['gst_option'];
                    }
                    if(!empty($data['tax_type']) && $data['tax_type'] != $GLOBALS['null_value']) {
                        $tax_type = $data['tax_type'];
                    } 
                    if(!empty($data['tax_option']) && $data['tax_option'] != $GLOBALS['null_value']) {
                        $tax_option = $data['tax_option'];
                    }
                    if(!empty($data['party_state']) && $data['party_state'] != $GLOBALS['null_value']) {
                        $party_state = $data['party_state'];
                    }
                    if(!empty($data['charges_tax']) && $data['charges_tax'] != $GLOBALS['null_value']) {
                        $charges_tax = $data['charges_tax'];
                    }
                    if(!empty($data['job_card_id']) && $data['job_card_id'] != $GLOBALS['null_value']) {
                        $job_card_id = $data['job_card_id'];
                        $job_card_id = explode(",", $job_card_id);
                        $job_card_id = array_reverse($job_card_id);
                    }  
                    if(!empty($data['job_card_number']) && $data['job_card_number'] != $GLOBALS['null_value']) {
                        $job_card_number = $data['job_card_number'];
                        $job_card_number = explode(",", $job_card_number);
                        $job_card_number = array_reverse($job_card_number);
                    }   
                    if(!empty($data['store_entry_id']) && $data['store_entry_id'] != $GLOBALS['null_value']) {
                        $store_entry_id = $data['store_entry_id'];
                        $store_entry_id = explode(",", $store_entry_id);
                        $store_entry_id = array_reverse($store_entry_id);
                    }  
                    if(!empty($data['store_entry_number']) && $data['store_entry_number'] != $GLOBALS['null_value']) {
                        $store_entry_number = $data['store_entry_number'];
                        $store_entry_number = explode(",", $store_entry_number);
                        $store_entry_number = array_reverse($store_entry_number);
                    } 
                    if(!empty($data['store_id']) && $data['store_id'] != $GLOBALS['null_value']) {
                        $store_id = $data['store_id'];
                        $store_id = explode(",", $store_id);
                        $store_id = array_reverse($store_id);
                    }  
                    if(!empty($data['store_name']) && $data['store_name'] != $GLOBALS['null_value']) {
                        $store_name = $data['store_name'];
                        $store_name = explode(",", $store_name);
                        $store_name = array_reverse($store_name);
                    }   
                    if(!empty($data['hsn_code']) && $data['hsn_code'] != $GLOBALS['null_value']) {
                        $hsn_code = $data['hsn_code'];
                        $hsn_code = explode(",", $hsn_code);
                        $hsn_code = array_reverse($hsn_code);
                    }       
                    
                    if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                        $product_id = $data['product_id'];
                        $product_id = explode(",", $product_id);
                        $product_count = count($product_id);
                        $product_id = array_reverse($product_id);
                    }
                    if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                        $product_name = $data['product_name'];
                        $product_name = explode(",", $product_name);
                        $product_name = array_reverse($product_name);
                    }
                    if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                        $unit_id = $data['unit_id'];
                        $unit_id = explode(",", $unit_id);
                        $unit_id = array_reverse($unit_id);
                    }
                    if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                        $unit_name = $data['unit_name'];
                        $unit_name = explode(",", $unit_name);
                        $unit_name = array_reverse($unit_name);
                    }
                    if(!empty($data['amount']) && $data['amount'] != $GLOBALS['null_value']) {
                        $amount = $data['amount'];
                        $amount = explode(",", $amount);
                        $amount = array_reverse($amount);
                    }
                    if(!empty($data['discount_value']) && $data['discount_value'] != $GLOBALS['null_value']) {
                        $discount_value = $data['discount_value'];
                    }
                    if(!empty($data['charges']) && $data['charges'] != $GLOBALS['null_value']) {
                        $charges = $data['charges'];
                    }
                    if(!empty($data['charges_name']) && $data['charges_name'] != $GLOBALS['null_value']) {
                        $charges_name = $data['charges_name'];
                    }
                    if(!empty($data['charges_value']) && $data['charges_value'] != $GLOBALS['null_value']) {
                        $charges_value = $data['charges_value'];
                    }
                    if(!empty($data['round_off']) && $data['round_off'] != $GLOBALS['null_value']) {
                        $round_off = $data['round_off'];
                    }
                    if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                        $total_amount = $data['total_amount'];
                    }
                    if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                        $quantity = $data['quantity'];
                        $quantity = explode(",", $quantity);
                        $quantity = array_reverse($quantity);
                    }
                    if(!empty($data['rate']) && $data['rate'] != $GLOBALS['null_value']) {
                        $rate = $data['rate'];
                        $rate = explode(",", $rate);
                        $rate = array_reverse($rate);
                    }
                    if(!empty($data['final_rate']) && $data['final_rate'] != $GLOBALS['null_value']) {
                        $final_rate = $data['final_rate'];
                        $final_rate = explode(",", $final_rate);
                        $final_rate = array_reverse($final_rate);
                    }
                    if(!empty($data['product_tax']) && $data['product_tax'] != $GLOBALS['null_value']) {
                        $product_tax = $data['product_tax'];
                        $product_tax = explode(",", $product_tax);
                        $product_tax = array_reverse($product_tax);
                    }
                
                    if(!empty($data['product_amount']) && $data['product_amount'] != $GLOBALS['null_value']) {
                        $product_amount = $data['product_amount'];
                        $product_amount = explode(",", $product_amount);
                        $product_amount = array_reverse($product_amount);
                    }
                    if(!empty($data['discount_name']) && $data['discount_name'] != $GLOBALS['null_value']) {
                        $discount_name = $data['discount_name'];
                        $discount_name = $obj->encode_decode('decrypt', $discount_name);
                    }
                    if(!empty($data['discount']) && $data['discount'] != $GLOBALS['null_value']) {
                        $discount = $data['discount'];
                    }
                    if(!empty($data['charges_name']) && $data['charges_name'] != $GLOBALS['null_value']) {
                        $charges_id = $data['charges_name'];
                    }
                    if(!empty($data['charges_type']) && $data['charges_type'] != $GLOBALS['null_value']) {
                        $charges_type = $data['charges_type'];
                        $charges_type = explode(",", $charges_type);
                    }
                    if(!empty($data['charges_value']) && $data['charges_value'] != $GLOBALS['null_value']) {
                        $charges_value = $data['charges_value'];
                    }
                    if(!empty($data['round_off_type']) && $data['round_off_type'] != $GLOBALS['null_value']) {
                        $round_off_type = $data['round_off_type'];
                    }
                    if(!empty($data['round_off_value']) && $data['round_off_value'] != $GLOBALS['null_value']) {
                        $round_off_value = $data['round_off_value'];
                    }
                    if(!empty($data['overall_tax']) && $data['overall_tax'] != $GLOBALS['null_value'])
                    {
                        $overall_tax =$data['overall_tax'];
                    }
                    if($tax_type == '1')
                    {
                        for($i=0;$i<count($product_tax);$i++)
                        {
                            $charges_tax_array[$i] = $product_tax[$i];
                        }
                    }
                    else
                    {
                        for($i=0;$i<count($product_id);$i++)
                        {
                            $charges_tax_array[]= $overall_tax;
                        }
                    }
                }
            }
        }

        $charges_tax_array = array_unique($charges_tax_array);
        $bank_list = array();
        $bank_list = $obj->getTableRecords($GLOBALS['bank_table'],'','');
		$company_state = "";$country = "India"; $state = "";
		$company_state = $obj->getTableColumnValue($GLOBALS['company_table'], 'company_id', $GLOBALS['bill_company_id'], 'state');
        if(!empty($company_state)) {
			$company_state = $obj->encode_decode('decrypt', $company_state);
		}

        
        ?>
        <form class="poppins pd-20 redirection_form" name="invoice_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_invoice_id)) {  ?>
						    <div class="h5">Edit Invoice</div>
                            <?php
                        }else{ ?>
						    <div class="h5">Add Invoice</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('invoice.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_invoice_id)) { echo $show_invoice_id; } ?>">
                <div class="col-lg-2 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="invoice_date" class="form-control shadow-none" placeholder="" required="" value="<?php if(!empty($invoice_date)) { echo $invoice_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                            <label>Bill Date</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="party_id" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:HideDetails('party');GetVehicles('invoice');getPartyState(this.value);">
                                <?php if(!empty($show_invoice_id)) {  ?>
                                    <option value="<?php echo $party_id; ?>" selected><?php echo $obj->encode_decode('decrypt', $party_name); ?> </option>
                                <?php } else { ?>
                                    <option value="">Select</option>
                                    <?php if(!empty($party_list)) {
                                        foreach ($party_list as $data) {
                                            if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                                            ?>
                                                <option value="<?php echo $data['party_id']; ?>" <?php if(!empty($party_id) && $party_id == $data['party_id']) { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['party_name_mobile_city']) && $data['party_name_mobile_city'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['party_name_mobile_city']);
                                                        }
                                                    ?>
                                                </option>
                                            <?php
                                            }
                                        }
                                    }
                                } ?>
                            </select>
                            <label>Select Party</label>
                        </div>
                        <a href="Javascript:ViewPartyDetails('party');" class="<?php if(empty($show_invoice_id)){?>d-none<?php }?> details_element" style="font-size: 12px;font-weight: bold;">Click to view details</a>
                    </div>    
                </div>
                <div class="col-lg-2 col-md-4 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="vehicle_id" onchange="ChangeVehicle(this)" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <?php if(!empty($show_invoice_id)) {  ?>
                                    <option value="<?php echo $vehicle_id; ?>" selected><?php echo $obj->encode_decode('decrypt', $vehicle_number); ?> </option>
                                <?php } else { ?>
                                    <option value="">Select Vehicle</option>
                                <?php } ?>
                            </select>
                            <label>Select Vehicle</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-4 col-6 px-lg-1 py-2" style="pointer-events: none;">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control shadow-none" name="vehicle_details" tabindex="1" value="<?php if(!empty($vehicle_details)) { echo $vehicle_details; } ?>">
                            <label>Vehicle Details</label>
                        </div>
                    </div> 
                </div>
            </div>   
            <div class= "row p-3">
                <div class="col-lg-3 col-md-3 col-6" id="bank_list">
                    <div class="form-group">
                        <div class="form-label-group in-border mt-0">
                            <select name="bank_id" class="select2 select2-danger smallfnt form-control" style="width:100% !important;">
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
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="gst_option" class="form-label text-muted smallfnt">GST/Non GST</label>
                            <input class="form-check-input code-switcher" type="checkbox" name="gst_option" onchange="Javascript:ShowGST(this,this.value);"
                            value="<?php echo $gst_option; ?>" <?php if ($gst_option == '1') echo 'checked'; ?> id="gst_option">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2 tax_cover <?php if($gst_option !='1'){?>d-none<?php } ?>">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" name="tax_type" style="width: 100%;" onchange="Javascript:ShowGST(this,this.value);changeChargesTax();">
                                <option value="">Select</option>
                                <option value="1" <?php if($tax_type == '1'){ ?>selected<?php } ?>>Product</option>
                                <option value="2" <?php if($tax_type == '2'){ ?>selected<?php } ?>>Overall</option>
                            </select>
                            <label>Tax Type</label>
                        </div>
                    </div> 
                </div> 
                <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2 <?php if($gst_option !='1'){?>d-none<?php } ?> tax_cover1" id="tax_option_div">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="tax_option" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:ShowGST(this,this.value);getRateByTaxOption();">
                                <option value="">Select</option>
                                <option value="1" <?php if($tax_option == '1'){ ?>selected<?php } ?>>Exclusive Tax</option>
                                <option value="2" <?php if($tax_option == '2'){ ?>selected<?php } ?>>Inclusive Tax</option>
                            </select>
                            <label>Tax Option <span class="text-danger">*</span></label>
                        </div>
                    </div>  
                </div>
                <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2 <?php if($tax_type !='2'){ ?>d-none <?php } ?> tax_cover2">
                    <div class="form-group">
                        <div class="form-label-group in-border mb-0">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" name="overall_tax" style="width: 100%;" onchange="Javascript:ShowGST(this,this.value);getRateByTaxOption();">
                                <option value="">Select</option>
                                <option value="0%" <?php if($overall_tax == '0%'){ ?>selected<?php } ?>>0%</option>
                                <option value="5%" <?php if($overall_tax == '5%'){ ?>selected<?php } ?>>5%</option>
                                <option value="12%" <?php if($overall_tax == '12%'){ ?>selected<?php } ?>>12%</option>
                                <option value="18%" <?php if($overall_tax == '18%'){ ?>selected<?php } ?>>18%</option>
                                <option value="28%" <?php if($overall_tax == '28%'){ ?>selected<?php } ?>>28%</option>
                            </select>
                            <label>Tax</label>
                        </div>
                    </div> 
                </div>
            </div> 
            <div class="row">    
                <div class="col-lg-12">
                    <div class="table-responsive text-center">
                        <input type="hidden" name="company_state" value="<?php if(!empty($company_state)) { echo $company_state; } ?>">
                        <input type="hidden" name="party_state" value="<?php if(!empty($party_state)) { echo $party_state; } ?>">
                        <table class="table nowrap cursor smallfnt w-100 table-bordered sales_table">
                            <thead class="bg-dark smallfnt">
                                <tr>
                                    <th>#</th>
                                    <th>Store</th>
                                    <th>Product</th>
                                    <th>HSN Code</th>
                                    <th>Unit</th>
                                    <th style="width:90px;">QTY</th>
                                    <th style="width: 10%;" class="<?php if($tax_type != '1'){ ?>d-none <?php }?> tax_element">Tax</th>
                                    <th style="width:90px;">Rate</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($product_id)) {
                                $prev_job_card = ''; $prev_store_entry = '';
                                for($i=0; $i < count($product_id); $i++) {
                                    $index = $i+1;
                                    if($prev_job_card != $job_card_id[$i]) { ?>
                                        <!-- <tr>
                                            <th colspan="8">
                                                <?php if(!empty($job_card_number[$i])) {
                                                    echo $job_card_number[$i];
                                                } ?>
                                            </th>
                                        </tr> -->
                                    <?php } 
                                    if($prev_store_entry != $store_entry_id[$i]) { ?>
                                        <tr>
                                            <th colspan="8" class="text-center">
                                                <?php echo $store_entry_number[$i]; ?>
                                            </th>
                                        </tr>
                                    <?php } ?>
                                    <tr class="product_row" id="product_row<?php  echo $index; ?>">
                                        <td class="text-center px-2 py-2 sno"><?php  echo $index; ?></td>
                                        <td class="text-center px-2 py-2 store_cover2">
                                            <input type="hidden" name="job_card_id[]" value="<?php if(!empty($job_card_id[$i])) { echo $job_card_id[$i]; } ?>">
                                            <input type="hidden" name="job_card_number[]" value="<?php if(!empty($job_card_number[$i])) { echo $job_card_number[$i]; } ?>">
                                            <input type="hidden" name="store_entry_id[]" value="<?php if(!empty($store_entry_id[$i])) { echo $store_entry_id[$i]; } ?>">
                                            <input type="hidden" name="store_entry_number[]" value="<?php if(!empty($store_entry_number[$i])) { echo $store_entry_number[$i]; } ?>">
                                            <?php
                                                if(!empty($store_id[$i])) {
                                                    if(!empty($store_name[$i]) && $store_name[$i] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $store_name[$i]);
                                                    }
                                                }
                                            ?>
                                            <input type="hidden" name="store_id[]" value="<?php if(!empty($store_id[$i])) { echo $store_id[$i]; } ?>">
                                            <input type="hidden" name="store_name[]" value="<?php if(!empty($store_name[$i])) { echo $store_name[$i]; } ?>">
                                        </td>

                                        <td class="text-center px-2 py-2">
                                            <?php
                                                if(!empty($product_id[$i])) {
                                                    if(!empty($product_name[$i]) && $product_name[$i] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $product_name[$i]);
                                                    }
                                                }
                                            ?>
                                            <input type="hidden" name="product_id[]" value="<?php if(!empty($product_id[$i])) { echo $product_id[$i]; } ?>"><br>
                                            <input type="hidden" name="product_name[]" value="<?php if(!empty($product_name[$i])) { echo $product_name[$i]; } ?>"><br>
                                        
                                        </td>
                                        <td>
                                            <?php if(!empty($hsn_code[$i])) {
                                                echo $obj->encode_decode('decrypt', $hsn_code[$i]);
                                            } ?>
                                            <input type="hidden" name="hsn_code[]" value="<?php if(!empty($hsn_code[$i])) { echo $hsn_code[$i]; } ?>">
                                        </td>
                                        
                                        <td class="text-center px-2 py-2">
                                            <?php 

                                            if(!empty($unit_name[$i]) && $unit_name[$i] !='NULL')
                                            {
                                                echo $obj->encode_decode("decrypt",$unit_name[$i]);
                                            }
                                            ?>
                                            <input type="hidden" name="unit_id[]" class="form-control shadow-none" value="<?php if(!empty($unit_id[$i])) { echo $unit_id[$i]; } ?>">
                                            <input type="hidden" name="unit_name[]" class="form-control shadow-none" value="<?php if(!empty($unit_name[$i])) { echo $unit_name[$i]; } ?>" >
                                                
                                        </td>
                                        <td class="text-center px-2 py-2">
                                            <?php if(!empty($quantity[$i]))
                                            {
                                                echo $quantity[$i];
                                            } ?>
                                            <input type="hidden" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity[$i])) { echo $quantity[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:CalcTotalQuantity();">
                                        </td>
                                        <td class="tax_element <?php if($tax_option != '1'){ ?> d-none  <?php }?>">
                                            <div class="form-group">
                                                <div class="form-label-group in-border mb-0">
                                                    <select class="select2 select2-danger" name="product_tax[]" data-dropdown-css-class="select2-danger" style="width: 100%;"  onchange="ProductRowCheck(this);ShowGST();">
                                                        <option value="">Select</option>
                                                        <option value="0%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '0%'){ ?>selected<?php } } ?>>0%</option>
                                                        <option value="5%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '5%'){ ?>selected<?php } } ?>>5%</option>
                                                        <option value="12%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '12%'){ ?>selected<?php } } ?>>12%</option>
                                                        <option value="18%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '18%'){ ?>selected<?php } } ?>>18%</option>
                                                        <option value="28%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '28%'){ ?>selected<?php } } ?>>28%</option>
                                                    </select>
                                                    <label>Tax</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td>
                                            <input type="text" name="rate[]" class="form-control shadow-none" value="<?php if(!empty($rate[$i])) { echo $rate[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
                                            <p class="tax_element text-success final_rate inclusiv_final_rate fw-bold"><?php if(!empty($final_rate[$i])){ echo "Final Rate : ".$final_rate[$i]; } ?></p>
                                            <input type="hidden" name="final_rate[]" class="form-control shadow-none" value="<?php if(!empty($final_rate[$i])) { echo $final_rate[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" >
                                            <input type="hidden" name="amount[]" class="form-control shadow-none" value="<?php if(!empty($amount[$i])){ echo $amount[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
                                            
                                        </td>
                                        <td class="amount text-end">
                                            <?php if(!empty($amount[$i])){ echo number_format($amount[$i],2); } ?>
                                        </td>
                                    </tr>
                                    <?php $index++; 
                                    $prev_job_card = $job_card_id[$i];
                                    $prev_store_entry = $store_entry_id[$i];
                                }
                            } ?>
                            </tbody> 
                            <tfoot>
                                <tr>
                                    <td colspan="7" class="text-end h6 subtotal_amount"> Total : </td>
                                    <td class="text-end h6 sub_total"></td>     
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 row ps-4 pt-3">
                    <div class="col-lg-6 border-end fw-bold " style="border: 1px solid #dee2e6;">
                    </div>
                    <div class="col-lg-6 fw-bold p-3 " style="border: 1px solid #dee2e6;">
                        <div class="ps-lg-2 pl-2 pe-2 pt-3 pb-3" >
                            <div class="row">
                                <div class="col-4 col-lg-4 col-md-2 mb-2">
                                    <div class="form-group">
                                        <div class="form-label-group in-border">
                                            <input type="text" name="discount_name" class="form-control"
                                                value="<?php if (!empty($discount_name)) echo $discount_name; ?>" 
                                                placeholder="Discount Name">
                                            <label class="f-10">Enter Discount</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4 col-lg-4 col-md-2 mb-2">
                                    <div class="form-group">
                                        <div class="form-label-group in-border">
                                            <input type="text" id="discount" name="discount" onkeyup="Javascript:checkDiscount();" 
                                                class="form-control shadow-none" 
                                                value="<?php if (!empty($discount)) echo $discount; ?>" 
                                                placeholder="Rupees / %" required>
                                            <label class="f-10">Rs / %</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4 col-lg-4 col-md-3 mb-2 ps-3 d-flex align-items-center justify-content-end">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-currency-rupee me-1"></i>
                                        <p class="mb-0 discount_value"></p>
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <div class="d-flex justify-content-between align-items-center border-top pt-2">
                                        <div class="font-weight-bold">Total Amount</div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-currency-rupee me-1"></i>
                                            <p class="mb-0 discounted_total"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row charges_row border-top my-2 div_charges">
                                <div class="col-4 col-lg-4 pt-2">
                                    <div class="form-group">
                                        <input type="text" name="charges_id[]" value="<?php if(!empty($charges_id)) { echo $charges_id; } ?>" class="form-control shadow-none" placeholder="Charges" >
                                    </div>
                                </div>
                                <div class="col-4 col-lg-5 pt-2">
                                    <div class="form-label-group in-border">
                                        <div class="input-group">
                                            <input type='hidden' name='hidden_charges[]' id='hidden_charges' value="<?php if(!empty($charges_tax)){ echo $charges_tax; } ?>">                                        
                                            <input type="text"  name="charges_value[]" onkeyup="Javascript:CheckCharges();" value="<?php if(!empty($charges)) { echo $charges; } ?>" class="form-control shadow-none">
                                            <div class="input-group-append charges_tax <?php if($gst_option == 0) { ?> d-none <?php } ?>" style="width:50%!important;">
                                                    <select name="charges_tax[]"  class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onChange="Javascript:checkGST();">
                                                        <option value="" >select tax</option>       
                                                        <?php
                                                        for($c=0; $c < count($charges_tax_array); $c++) {
                                                            if(!empty($charges_tax_array[$c]) && $charges_tax_array[$c] != $GLOBALS['null_value']) {
                                                                ?>
                                                                <option value="<?php echo $charges_tax_array[$c]; ?>" <?php if(isset($charges_tax)){ if(!empty($charges_tax_array[$c]) && $charges_tax_array[$c] == $charges_tax) { ?>selected<?php } } ?>>
                                                                    <?php
                                                                        echo $charges_tax_array[$c];
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
                                </div>
                                <div class="col-lg-3 col-4 pt-3 pb-3">
                                    <div class="form-group">
                                        <div class="form-label-group in-border d-flex justify-content-end">
                                            <!-- <input type="text" id="discounted_total" name="discounted_total" class="form-control shadow-none discounted_total" placeholder="" required> -->
                                            <i class="bi bi-currency-rupee"></i><p class="charges_total"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 d-flex">
                                    <div class="col-lg-8 col-8 p-2 font-weight-bold">
                                        Total Amount
                                    </div>
                                    <div class="col-lg-4 col-4 d-flex justify-content-end pb-2 text-right">
                                        <i class="bi bi-currency-rupee"></i><p class="charges_sub_total"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="sgst d-none">
                                <div class="col-lg-12 col-12 d-flex p-0">
                                    <div class="col-lg-8 col-8 cgst_tax_value  font-weight-bold">
                                        CGST
                                    </div>
                                    <div class="col-lg-4 col-4 text-right d-flex justify-content-end p-0 d-flex">
                                        <i class="bi bi-currency-rupee"></i> <p class="sgst_value"> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="cgst d-none">
                                <div class="col-lg-12 col-12 d-flex p-0">
                                    <div class="col-lg-8 col-8 sgst_tax_value  font-weight-bold">
                                        SGST
                                    </div>
                                    <div class="col-lg-4 col-4 text-right d-flex justify-content-end p-0 d-flex" >
                                        <i class="bi bi-currency-rupee"></i> <p class="cgst_value"> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="igst d-none">
                                <div class="col-lg-12 col-12 d-flex p-0">
                                    <div class="col-lg-8 col-8 igst_tax_value  font-weight-bold">
                                        IGST
                                    </div>
                                    <div class="col-lg-4 col-4 text-right justify-content-end p-0 d-flex">
                                        <i class="bi bi-currency-rupee"></i> <p class="igst_value"> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top my-2"></div>
                            <div class="total_tax d-none ">
                                <div class="col-lg-12 col-12 d-flex p-0">
                                    <div class="col-lg-8 col-8  font-weight-bold">Total Tax  </div>
                                    <div class="col-lg-4 col-4 text-right justify-content-end p-0 d-flex">
                                        <i class="bi bi-currency-rupee"></i><p class="total_tax_value"> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 d-flex p-0">
                                <div class="col-lg-6 col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" onclick="Javascript:CheckRoundOff(this)" name="round_off" type="checkbox" value="<?php if(!empty($round_off)){ echo $round_off; } ?>" id="flexCheckDefault1" <?php if($round_off == '1'){ ?>checked<?php } ?>>
                                        <label class="form-check-label" for="flexCheckDefault1">Auto Round Off</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-4 text-right" id="round_off_div">
                                    <div class="form-group">
                                        <div class="form-label-group in-border">
                                            <div class="input-group">
                                                <div class="input-group-append" style="width:50%!important;">
                                                    <select name="round_off_type" onchange="Javascript:CalRoundOff();" class="select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                        <option value="">Select</option>
                                                        <option value="1" <?php if($round_off_type == '1'){ ?>selected<?php } ?>>Add</option>
                                                        <option value="2" <?php if($round_off_type == '2'){ ?>selected<?php } ?>>Subtract</option>
                                                    </select>
                                                </div>
                                                <input type="text" id="" onKeyup="Javascript:CalRoundOff()" onfocus="Javascript:KeyboardControls(this,'number','2',1);" name="round_off_value" value="<?php if(!empty($round_off_type)){ echo $round_off_value; } ?>" class="form-control shadow-none">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 d-flex p-0">
                                <div class="col-lg-8 col-8 p-2 font-weight-bold">
                                    Total Amount
                                </div>
                                <div class="col-lg-4 col-4 d-flex justify-content-end p-0 text-right">
                                    <i class="bi bi-currency-rupee"></i><p class="overall_total"></p>
                                    <input type="hidden" name="overall_total" class="overall_totalround_off" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent(event, 'invoice_form', 'invoice_changes.php', 'invoice.php');"> Submit </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script>
                <?php if(!empty($show_invoice_id)) { ?> 
                    calTotal();
                    checkDiscount();
                    getGST();
                    CheckRoundOff('<?php echo $round_off; ?>');
                <?php } ?>
            </script>
        </form>
		<?php
    } 

    if(isset($_REQUEST['edit_id'])) {
        $invoice_date = ""; $invoice_date_error = ""; $party_id = ""; $party_id_error = "";$product_id = array(); $quantity = array(); $total_qty = array();$rate = array();  $final_rate =array(); $product_amount =array(); $product_error = ""; $product_names = array(); $amount =array();$round_off = ""; $sub_total = 0; $total_amount = 0; $unit_id = "";$unit_ids = array(); $unit_id_error ="";$charges_id = array(); $charges_names = array();
        $charges_values = array(); $charges_type = array(); $charges_total = array();  $is_discount =""; $discount_name = ""; $valid_invoice = ""; $form_name = "invoice_form"; $edit_id = ""; $discount_value =""; $discounted_total = 0;   $store_ids = array(); $gst_option_error = ""; $tax_type = ""; $tax_type_error = "";$tax_option = ""; $tax_option_error = ""; $overall_tax ="";$final_rate =array();$cgst_value = 0; $sgst_value = 0; $igst_value = 0; $gst_option ="";  $invoice_error = '';$product_tax =array(); $charges_tax =array();$company_state = ""; $party_state = ""; $total_tax_value = 0; $bank_id = $bank_name = $bank_account_number = '';
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        $invoice_date = $_POST['invoice_date'];
        $invoice_date = trim($invoice_date);
        $invoice_date_error = $valid->common_validation($invoice_date, 'Entry Date', '1');
        if(!empty($invoice_date_error)) {
            if(!empty($valid_invoice)) {
                $valid_invoice = $valid_invoice." ".$valid->error_display($form_name, 'invoice_date', $invoice_date_error, 'text');
            }
            else {
                $valid_invoice = $valid->error_display($form_name, 'invoice_date', $invoice_date_error, 'text');
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
            if(!empty($valid_invoice)) {
                $valid_invoice = $valid_invoice." ".$valid->error_display($form_name, 'party_id', $party_id_error, 'select');
            }
            else {
                $valid_invoice = $valid->error_display($form_name, 'party_id', $party_id_error, 'select');
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
            if(!empty($valid_invoice)) {
                $valid_invoice = $valid_invoice." ".$valid->error_display($form_name, 'vehicle_id', $vehicle_id_error, 'select');
            }
            else {
                $valid_invoice = $valid->error_display($form_name, 'vehicle_id', $vehicle_id_error, 'select');
            }
        }
        if(isset($_POST['bank_id']))
        {
            $bank_id = $_POST['bank_id'];
            $bank_id = trim($bank_id);
            if(!empty($bank_id)) {
                $bank_unique_id = '';
                $bank_unique_id = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id, 'id');
                if(!preg_match("/^\d+$/", $bank_unique_id)) {
                    $bank_id_error = "Invalid bank";
                }
            } else {
                $bank_id_error = "Select the bank ";
            }
        }
        if(!empty($bank_id_error)) {
            if(!empty($valid_invoice)) {
                $valid_invoice = $valid_invoice." ".$valid->error_display($form_name, 'bank_id', $bank_id_error, 'select');
            }
            else {
                $valid_invoice = $valid->error_display($form_name, 'bank_id', $bank_id_error, 'select');
            }
        }
        $vehicle_details = $_POST['vehicle_details'];
        $vehicle_details = trim($vehicle_details);
        $vehicle_details_error = $valid->common_validation($vehicle_details, 'Vehicle Details', '1');
        if(!empty($vehicle_details_error)) {
            if(!empty($valid_invoice)) {
                $valid_invoice = $valid_invoice." ".$valid->error_display($form_name, 'vehicle_details', $vehicle_details_error, 'text');
            }
            else {
                $valid_invoice = $valid->error_display($form_name, 'vehicle_details', $vehicle_details_error, 'text');
            }
        }
        if(isset($_POST['gst_option']))
        {
            $gst_option = $_POST['gst_option'];
            $gst_option = trim($gst_option);
            $gst_option_error = $valid->common_validation($gst_option, 'GST option', 'select');
            if(empty($gst_option_error)) {
                if($gst_option != '1' && $gst_option != '2') {
                    $gst_option_error = "Invalid GST option";
                }
            }
        }
        
        if(!empty($gst_option_error)) {
            if(!empty($valid_invoice)) {
                $valid_invoice = $valid_invoice." ".$valid->error_display($form_name, 'gst_option', $gst_option_error, 'text');
            }
            else {
                $valid_invoice = $valid->error_display($form_name, 'gst_option', $gst_option_error, 'text');
            }
        }

        if($gst_option == '1') {
            $tax_type = $_POST['tax_type'];
            $tax_type = trim($tax_type);
            $tax_type_error = $valid->common_validation($tax_type, 'Tax Type', 'select');
            if(empty($tax_type_error)) {
                if($tax_type != '1' && $tax_type != '2') {
                    $tax_type_error = "Invalid Tax Type";
                }
            }
            if(!empty($tax_type_error)) {
                if(!empty($valid_invoice)) {
                    $valid_invoice = $valid_invoice." ".$valid->error_display($form_name, 'tax_type', $tax_type_error, 'select');
                }
                else {
                    $valid_invoice = $valid->error_display($form_name, 'tax_type', $tax_type_error, 'select');
                }
            }

            $tax_option = $_POST['tax_option'];
            $tax_option = trim($tax_option);
            $tax_option_error = $valid->common_validation($tax_option, 'Tax Option', 'select');
            if(empty($tax_option_error)) {
                if($tax_option != '1' && $tax_option != '2') {
                    $tax_option_error = "Invalid Tax Option";
                }
            }
            if(!empty($tax_option_error)) {
                if(!empty($valid_invoice)) {
                    $valid_invoice = $valid_invoice." ".$valid->error_display($form_name, 'tax_option', $tax_option_error, 'select');
                }
                else {
                    $valid_invoice = $valid->error_display($form_name, 'tax_option', $tax_option_error, 'select');
                }
            }

            if($tax_type == '2') {
                if(isset($_POST['overall_tax'])) {
                    $overall_tax = $_POST['overall_tax'];
                    $overall_tax = trim($overall_tax);
                }
            }
        }else{
            $overall_tax = $GLOBALS['null_value']; 
        }

        if(isset($_POST['company_state'])) {
            $company_state = $_POST['company_state'];
            $company_state = trim($company_state);
        }
        if(isset($_POST['party_state'])) {
            $party_state = $_POST['party_state'];
            $party_state = trim($party_state);
        }


        if(isset($_POST['job_card_id'])) {
            $job_card_id = $_POST['job_card_id'];
        }
        if(isset($_POST['job_card_number'])) {
            $job_card_number = $_POST['job_card_number'];
        }
        if(isset($_POST['store_entry_id'])) {
            $store_entry_id = $_POST['store_entry_id'];
        }
        if(isset($_POST['store_entry_number'])) {
            $store_entry_number = $_POST['store_entry_number'];
        }
        if(isset($_POST['store_id'])) {
            $store_id = $_POST['store_id'];
        }

        if(isset($_POST['store_name'])) {
            $store_name = $_POST['store_name'];
        }
        if(isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
        }
        if(isset($_POST['product_name'])) {
            $product_name = $_POST['product_name'];
        }
        if(isset($_POST['hsn_code'])) {
            $hsn_code = $_POST['hsn_code'];
        }
        if(isset($_POST['unit_id'])) {
            $unit_id = $_POST['unit_id'];
        }
        if(isset($_POST['unit_name'])) {
            $unit_name = $_POST['unit_name'];
        }
        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
        }
        if(isset($_POST['rate'])) {
            $rate = $_POST['rate'];
        }
         if(isset($_POST['product_tax']))
        {
            $product_tax = $_POST['product_tax'];
        }
         if(isset($_POST['charges_tax']))
        {
            $charges_tax = $_POST['charges_tax'];
        }
        

        $index=0; $sub_total = 0; $final_rate =array();
        if(!empty($product_id)) {
            for($i=0;$i<count($product_id); $i++) {
                $product_id[$i] = trim($product_id[$i]);
                $product_name[$i] = trim($product_name[$i]);
                $store_id[$i] = trim($store_id[$i]);
                $store_name[$i] = trim($store_name[$i]);
                $unit_id[$i] = trim($unit_id[$i]);
                $unit_name[$i] = trim($unit_name[$i]);
                $hsn_code[$i] = trim($hsn_code[$i]);
                $quantity[$i] = trim($quantity[$i]);
                $rate[$i] = trim($rate[$i]);
                if(!empty($rate[$i])) {
                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $rate[$i]) && $rate[$i] <= 99999) 
                    {  
                        $final_rate[$i] = $rate[$i];
                        if($gst_option == '1')
                        {
                            if($tax_option == '2')
                            {
                                
                                $tax ="";
                                if($tax_type == '1')
                                {
                                    $tax= $product_tax[$i];
                                }
                                else
                                {
                                    $tax = $overall_tax;
                                }
                                if($tax != ''){
                                    $tax = trim(str_replace("%", "",$tax));
                                    $final_rate[$i] = $final_rate[$i]-($final_rate[$i] * $tax)/($tax + 100);                                            
                                }
                                else{
                                    $product_error = "Invalid Tax in Product - ".($obj->encode_decode('decrypt', $product_name));                                                          
                                }
                            }
                        }
                        if(!empty($final_rate[$i]))
                        {
                            $final_rate[$i] = floor($final_rate[$i] * 100) / 100;
                            
                        }
                        if(!empty($final_rate[$i]) && !empty($quantity[$i]))
                        {
                            $product_amount[$i] = $final_rate[$i] * $quantity[$i];
                            $amount[$i] = $product_amount[$i];
                        }
                        $sub_total += $product_amount[$i];
                    }
                } else {
                    $rate_error = "Invalid Rate";
                    if(!empty($rate_error)) {
                        if(!empty($valid_invoice)) {
                            $valid_invoice = $valid_invoice." ".$valid->row_error_display($form_name, 'rate[]', $rate_error, 'text','product_row', ($i+1));
                        }
                        else {
                            $valid_invoice = $valid->row_error_display($form_name, 'rate[]', $rate_error, 'text','product_row', ($i+1));
                        }
                    }
                }
            }
        } else {
            $product_error = "Add Products";
        }

        $total_amount = $sub_total;
        if(empty($product_error) && empty($total_amount)) {
            $product_error = "Bill value cannot be 0";
        }
        if(isset($_POST['charges_id'])) {
            $charges_id = $_POST['charges_id'];
        }
      
        if(isset($_POST['charges_value'])) {
            $charges_values = $_POST['charges_value'];
        }

        $discount_option =""; $discount_option_error ="";  $discount =""; $discount_error ="";  

        if(isset($_POST['discount_name'])) {
            $discount_name = $_POST['discount_name'];
        }
        if(isset($_POST['charges_value'])) {
            $charges_values = $_POST['charges_value'];
        }
        
        if(isset($_POST['discount'])) {
            $discount = $_POST['discount'];
            $discount = trim($discount);
        }
        if(!empty($discount_name) && empty($discount) && empty($product_error)){
            $product_error = "Enter Discount Value";
        }
        if(!empty($discount) && empty($product_error)) {
            if(empty($discount_name)){
                $product_error = "Enter Discount Name";
            }
            else{
                if(empty($discount)){
                    $product_error = "Enter Discount Value";
                }
                if(strpos($discount, '%') !== false) {
                    $discount_percent = str_replace('%', '', $discount);
                    $discount_percent = trim($discount_percent);
                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $discount_percent) && ($discount_percent > 0) && ($discount_percent < 100)){
                        $discount_value = ($discount_percent * $sub_total) / 100;
                    }
                    else {
                        $product_error = "Invalid Discount";
                    }
                }
                else {
                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $discount) && ($discount > 0) && ($discount <= $sub_total)){
                        $discount_value = $discount;
                    }
                    else {
                        $product_error = "Invalid Discount";
                    }
                }
                if($discount_value >= $sub_total) {
                    $product_error = "Discount should not be greater than Sub total";
                }
                if(!empty($discount_value)) {
                    $discount_value = number_format($discount_value, 2);
                    $discount_value = str_replace(",", "", $discount_value);
                    $total_amount = $total_amount - $discount_value;
                }
            } 
                
            
            
        }
        $discounted_total = $total_amount;   
        
        $charges_total_amounts = array();
        if(!empty($charges_id) && empty($product_error)) {
            for($i=0; $i < count($charges_id); $i++) {
                $charges_id[$i] = trim($charges_id[$i]);
                if(!empty($charges_id[$i])) {
                    $charges_name = ""; $charges_value = 0;
                    $charges_name = $charges_id[$i];
                    $charges_names[$i] = $charges_name;
                    $charges_values[$i] = trim($charges_values[$i]);
                    if(isset($charges_values[$i])) {
                        $charges_error = "";
                        if(strpos($charges_values[$i], '%') !== false) {
                            $charges_value = str_replace('%', '', $charges_values[$i]);
                            $charges_value = trim($charges_value);
                        }
                        else {
                            $charges_value = $charges_values[$i];
                        }
                        $charges_error = $valid->valid_price($charges_value, ( $charges_name), 1, '');
                        if(!empty($charges_error)) {
                            if(!empty($invoice_error)) {
                                $invoice_error = $invoice_error."<br>".$charges_error;
                            }
                            else {
                                $invoice_error = $charges_error;
                            }
                        }
                        else {
                            if(strpos($charges_values[$i], '%') !== false) {
                                $charges_value = ($charges_value * $total_amount) / 100;
                                $charges_value = number_format($charges_value, 2);
                                $charges_value = str_replace(",", "", $charges_value);
                            }
                        }
                    }
                    if(empty($invoice_error)) {
                        $charges_total[$i] = $charges_value;
                        $total_amount += $charges_value;
                        if($gst_option == '1')
                        {
                            if(!empty($charges_tax[$i])) {
                                $chrg_tax[$i] = str_replace('%', '', $charges_tax[$i]);
                                $charges_tax_value[$i] = ($charges_value * $chrg_tax[$i]) / 100;
                                if(!empty($charges_tax_value[$i])) {
                                    $total_tax_value += $charges_tax_value[$i];
                                    $total_tax_value = round($total_tax_value, 2);
                                }
                            }
                            else
                            {
                                $invoice_error = "Select Charges tax";
                            }
                            
                        }
                    }
                    $charges_total_amounts[] = $total_amount;
                }
                else{
                    if(!empty($charges_values[$i]))
                        {
                            $invoice_error = "Select Charges";
                        }
                        $charges_values[$i] = "";
                }
            }
        }
        $charged_total = $total_amount;   

        if($gst_option == '1' && empty($product_error) && empty($valid_invoice)) {
            $percentage = 100;
            if($tax_type == '1')
            {
                if(!empty($discount))
                {
                    if (strpos($discount, '%') !== false) {
                        $final_discount = str_replace("%",'',$discount);
                    }
                    else
                    {
                        $final_discount = ($discount/$sub_total) * 100;
                    }
                    
                }
                $t_index = count($product_id);
                for ($a = 0; $a < count($product_id); $a++) {
                    $indv_discount = 0;
                    if(!empty($final_discount))
                    {
                        $indv_discount = ($final_rate[$a] * $final_discount) / 100;
                        $prd_rate[$a] = $final_rate[$a]- $indv_discount;
                        $prd_amount[$a] = $prd_rate[$a]*$quantity[$a];
                    }
                    else
                    {
                        $prd_amount[$a] = $final_rate[$a]*$quantity[$a];
                    }
                    $prd_amount[$a] = number_format($prd_amount[$a], 2, '.', '');
                    $tax = trim(str_replace("%", "",$product_tax[$a]));
                    if ($product_tax[$a] != '' && $tax != '%') {
                        $tax_plus_value = ($prd_amount[$a] * $tax) / 100;
                        $tax_plus_value = round($tax_plus_value, 2);
                        $total_tax_value += $tax_plus_value;
                        $total_tax_amount = $total_tax_value;
                    } else {
                        $tax_error = "Select tax";
                        if(!empty($tax_error)) {
                            if(!empty($valid_invoice)) {
                                $valid_invoice = $valid_invoice." ".$valid->row_error_display($form_name, 'product_tax[]', $tax_error, 'select','product_row', $t_index);
                            }
                            else {
                                $valid_invoice = $valid->row_error_display($form_name, 'product_tax[]', $tax_error, 'select','product_row', ($t_index));
                            }
                        }
                    }
                    $t_index--;
                }
            }
            elseif($tax_type == '2') {
                $tax = "";
                $tax = str_replace("%", "", $overall_tax);
                $tax = trim($tax);
                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $tax)) {
                    $total_tax_value = ($tax * $total_amount) / $percentage;
                }
                else {
                    $product_error = "Invalid Overall tax";
                }
            }
            if(!empty($total_tax_value)) {
                $total_tax_value = number_format($total_tax_value, 2);
                $total_tax_value = str_replace(",", "", $total_tax_value);
                if($company_state == $party_state) {
                    $cgst_value = $total_tax_value / 2;
                    $cgst_value = number_format($cgst_value, 2);
                    $cgst_value = str_replace(",", "", $cgst_value);
                    $sgst_value = $total_tax_value / 2;
                    $sgst_value = number_format($sgst_value, 2);
                    $sgst_value = str_replace(",", "", $sgst_value);
                }
                else {
                    $igst_value = $total_tax_value;
                    $igst_value = number_format($igst_value, 2);
                    $igst_value = str_replace(",", "", $igst_value);
                }
                $total_amount = $total_amount + $total_tax_value;
            }
        }

        $round_off =0;  $round_off_type =""; $round_off_value ="";
        if(!empty($total_amount)) {	
            if(isset($_POST['round_off']))
            {
                $round_off = $_POST['round_off'];
            }
            else
            {
                $round_off ="2";
            }
            if(isset($_POST['round_off_type']))
            {
                $round_off_type = $_POST['round_off_type'];
            }
            if(isset($_POST['round_off_value']))
            {
                $round_off_value = $_POST['round_off_value'];
                if (preg_match('/\.\D*$/', $round_off_value)) {
                    $round_off_value_error =  "Error (decimal point with no digit after it)";
                } 
                if(!empty($round_off_value)) {
                    $value = explode('.',$round_off_value);
                    if(isset($value[1])) {
                        $round_off_value = $value[1];
                    }
                }
            }
            if(!empty($round_off_value_error)) {
                if(!empty($valid_invoice)) {
                    $valid_invoice = $valid_invoice." ".$valid->error_display($form_name, 'round_off_value', $round_off_value_error, 'text');
                }
                else {
                    $valid_invoice = $valid->error_display($form_name, 'round_off_value', $round_off_value_error, 'text');
                }
            } else {
                if($round_off == '2')
                {
                    $round_off_calculation = 0; $final_round_off = 0;
                    if (!empty($round_off_value)) {
                        $round_off_calculation = $round_off_value;
                    
                        if($round_off_calculation != "00") {
                            if(strlen($round_off_calculation) == 1) {
                                $round_off_calculation = ".0".$round_off_calculation;
                                $final_round_off = $round_off_calculation;
                                $round_off_value = "0".$round_off_calculation;
                            }else{
                                $final_round_off = "0.".$round_off_calculation;
                                $round_off_value = "0.".$round_off_calculation;
                            }
                        }
                    }
            
            
                    if($round_off_type == '1')
                    {
                        
                        $total_amount = $total_amount+$final_round_off;
                
                    }
                    else if($round_off_type == '2')
                    {
                
                        $total_amount = $total_amount-$final_round_off;
                    }
                
                }
                else
                {
                    if(!empty($total_amount)) {	
                        if (strpos( $total_amount, "." ) !== false) {
                            $pos = strpos($total_amount, ".");
                            $decimal = substr($total_amount, ($pos + 1), strlen($total_amount));
                            if($decimal != "00") {
                                if(strlen($decimal) == 1) {
                                    $decimal = $decimal."0";
                                }
                                if($decimal >= 50) {				
                                    $rnd_off = 100 - $decimal;
                                    if($rnd_off < 10) {
                                        $rnd_off = "0.0".$rnd_off;
                                    }
                                    else {
                                        $rnd_off = "0.".$rnd_off;
                                    }
                                    $round_off_type = 1;
                                    $round_off_value = $rnd_off;
                                    $total_amount = $total_amount + $rnd_off;
                                }
                                else {
                                    $decimal = "0.".$decimal;
                                    $rnd_off = "-".$decimal;
                                    $round_off_type = 2;
                                    $round_off_value = $decimal;
                                    $total_amount = $total_amount - $decimal;
                                }
                            }
                        }
                    }
                }
            }
        }
        $grand_total = $total_amount;
        $result = "";

        if(empty($valid_invoice) && empty($product_error) && empty($invoice_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $bill_company_id =$GLOBALS['bill_company_id'];
                $bill_company_details = "";
                if (!empty($bill_company_id)) {
                    $bill_company_details = $obj->BillCompanyDetails($bill_company_id, $GLOBALS['invoice_table']);
                }
    
                if(!empty($invoice_date)) {
                    $invoice_date = date('Y-m-d', strtotime($invoice_date));
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
                $vehicle_number = '';
                if(!empty($vehicle_id)) {
                    $vehicle_number = $obj->getTableColumnValue($GLOBALS['vehicle_table'],'vehicle_id', $vehicle_id, 'vehicle_no');
                } else {
                    $vehicle_id = $GLOBALS['null_value'];
                    $vehicle_number = $GLOBALS['null_value'];
                }
                if(!empty($vehicle_details)) {
                    $vehicle_details = $obj->encode_decode('encrypt', $vehicle_details);
                } else {
                    $vehicle_details = $GLOBALS['null_value'];
                }

                if(!empty($product_id)) {
                    $product_id = array_reverse($product_id);
                    $product_id = implode(",", $product_id);
                }else{
                    $product_id = $GLOBALS['null_value'];
                }
               
                if(!empty($product_name)) {
                    $product_name = array_reverse($product_name);
                    $product_name = implode(",", $product_name);
                }else{
                    $product_name = $GLOBALS['null_value'];
                }
                if(!empty($bank_id)) {
                    $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'],'id',$bank_unique_id,'bank_name');
                    $bank_account_number = $obj->getTableColumnValue($GLOBALS['bank_table'],'id',$bank_unique_id,'account_number');
                } else {
                    $bank_name = $GLOBALS['null_value'];
                    $bank_account_number = $GLOBALS['null_value'];
                    $bank_id = $GLOBALS['null_value'];
                }
    
                if(!empty($unit_id)) {
                    $unit_id = array_reverse($unit_id);
                    $unit_id = implode(",", $unit_id);
                }else{
                    $unit_id = $GLOBALS['null_value'];
                }
                if(!empty($store_id)) {
                    $store_id = array_reverse($store_id);
                    $store_id = implode(",", $store_id);
                }else{
                    $store_id = $GLOBALS['null_value'];
                }

                if(!empty($store_name)) {
                    $store_name = array_reverse($store_name);
                    $store_name = implode(",", $store_name);
                }else{
                    $store_name = $GLOBALS['null_value'];
                }
                if(!empty($job_card_id)) {
                    $job_card_id = array_reverse($job_card_id);
                    $job_card_id = implode(",", $job_card_id);
                }else{
                    $job_card_id = $GLOBALS['null_value'];
                }

                if(!empty($job_card_number)) {
                    $job_card_number = array_reverse($job_card_number);
                    $job_card_number = implode(",", $job_card_number);
                }else{
                    $job_card_number = $GLOBALS['null_value'];
                }
                if(!empty($store_entry_id)) {
                    $store_entry_id = array_reverse($store_entry_id);
                    $store_entry_id = implode(",", $store_entry_id);
                }else{
                    $store_entry_id = $GLOBALS['null_value'];
                }

                if(!empty($store_entry_number)) {
                    $store_entry_number = array_reverse($store_entry_number);
                    $store_entry_number = implode(",", $store_entry_number);
                }else{
                    $store_entry_number = $GLOBALS['null_value'];
                }
                if(!empty($unit_name)) {
                    $unit_name = array_reverse($unit_name);
                    $unit_name = implode(",", $unit_name);
                }else{
                    $unit_name = $GLOBALS['null_value'];
                }
                if(!empty($quantity)) {
                    $quantity = array_reverse($quantity);
                    $quantity = implode(",", $quantity);
                }else{
                    $quantity = $GLOBALS['null_value'];
                }
                if(!empty($rate)) {
                    $rate = array_reverse($rate);
                    $rate = implode(",", $rate);
                }else{
                    $rate = $GLOBALS['null_value'];
                }
                if(!empty($hsn_code)) {
                    $hsn_code = array_reverse($hsn_code);
                    $hsn_code = implode(",", $hsn_code);
                }else{
                    $hsn_code = $GLOBALS['null_value'];
                }

                if(!empty($amount)) {
                    $amount = array_reverse($amount);
                    $amount = implode(",", $amount);
                }else{
                    $amount = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($charges_id, fn($value) => $value !== ""))) {
                    $charges_id = implode(",", $charges_id);
                }
                else {
                    $charges_id = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($charges_values, fn($value) => $value !== ""))) {
                    $charges_values = implode(",", $charges_values);
                }
                else {
                    $charges_values = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($charges_total, fn($value) => $value !== ""))) {
                    $charges_total = implode(",", $charges_total);
                }
                else {
                    $charges_total = $GLOBALS['null_value'];
                }

                if(!empty($charges_total_amounts)) {
                    $charges_total_amounts = implode(",", $charges_total_amounts);
                }else{
                    $charges_total_amounts = $GLOBALS['null_value'];
                }
                if(!empty($final_rate)) {
                    $final_rate = array_reverse($final_rate);
                    $final_rate = implode(",", $final_rate);
                }else{
                    $final_rate = $GLOBALS['null_value'];
                }
                if(!empty($product_amount)) {
                    $product_amount = array_reverse($product_amount);
                    $product_amount = implode(",", $product_amount);
                }else{
                    $product_amount = $GLOBALS['null_value'];
                }
                if(!empty($product_tax)) {
                    $product_tax = array_reverse($product_tax);
                    $product_tax = implode(",", $product_tax);
                }else{
                    $product_tax = $GLOBALS['null_value'];
                }
                if(!empty($charges_tax)) {
                    $charges_tax = array_reverse($charges_tax);
                    $charges_tax = implode(",", $charges_tax);
                }else{
                    $charges_tax = $GLOBALS['null_value'];
                }
                if(!empty($round_off_value)) {
                    $value = explode('.',$round_off_value);
                    if(isset($value[1])) {
                        $round_off_value = $value[1];
                    }
                }

                $invoice_error = "";$check_bills ="";
                if(!empty($party_id)){
                    $party_type = $obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$party_id,'party_type');
                }

                if(empty($discount_value))
                {
                    $discount_value = $GLOBALS['null_value'];
                }
                if(empty($discounted_total))
                {
                    $discounted_total = $GLOBALS['null_value'];
                }

                if(!empty($discount_name)){
                    $discount_name = $obj->encode_decode('encrypt', $discount_name);
                }
                $mobile_number =""; $city =""; $decrypted_party_name = ""; $decrypted_mbl ="";
  
                $bill_company_id = $GLOBALS['bill_company_id']; 
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $job_update = 0;
                $balance = 0;
                if(empty($edit_id)) {
                    $action = "New Invoice Created. ";
                    $null_value = $GLOBALS['null_value'];
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'bill_company_details', 'invoice_id', 'invoice_number', 'invoice_date','party_id', 'party_name_mobile_city', 'party_details', 'gst_option', 'tax_type', 'tax_option', 'overall_tax', 'charges_tax', 'product_tax', 'party_state','vehicle_id','vehicle_number','vehicle_details','job_card_id','job_card_number','store_entry_id','store_entry_number','store_id','store_name','product_id', 'product_name', 'hsn_code', 'quantity', 'unit_id' ,'unit_name' ,'rate','final_rate', 'product_amount','amount', 'sub_total', 'discount', 'discount_value', 'discounted_total',  'charges_name','charges',  'charges_value','charges_total','cgst_value', 'sgst_value', 'igst_value', 'total_tax_value','round_off', 'total_amount', 'round_off_type' , 'round_off_value', 'discount_name', 'bank_id','bank_name','bank_account_number','deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'",  "'".$null_value."'", "'".$null_value."'", "'".$invoice_date."'","'".$party_id."'", "'".$party_name_mobile_city."'", "'".$party_details."'","'".$gst_option."'", "'".$tax_type."'", "'".$tax_option."'", "'".$overall_tax."'", "'".$charges_tax."'","'".$product_tax."'","'".$party_state."'","'".$vehicle_id."'","'".$vehicle_number."'","'".$vehicle_details."'","'".$job_card_id."'","'".$job_card_number."'","'".$store_entry_id."'","'".$store_entry_number."'","'".$store_id."'","'".$store_name."'","'".$product_id."'", "'".$product_name."'","'".$hsn_code."'","'".$quantity."'", "'".$unit_id."'","'".$unit_name."'","'".$rate."'","'".$final_rate."'", "'".$product_amount."'","'".$amount."'","'".$sub_total."'", "'".$discount."'", "'".$discount_value."'" , "'".$discounted_total."'",   "'".$charges_id."'",  "'".$charges_values."'", "'".$charges_total."'","'".$charged_total."'", "'".$cgst_value."'", "'".$sgst_value."'", "'".$igst_value."'", "'".$total_tax_value."'","'".$round_off."'", "'".$total_amount."'", "'".$round_off_type."'", "'".$round_off_value."'", "'".$discount_name."'","'".$bank_id."'","'".$bank_name."'","'".$bank_account_number."'", "'0'");

                    $invoice_insert_id = $obj->InsertSQL($GLOBALS['invoice_table'], $columns, $values,'invoice_id','invoice_number',$action);
        
                    if(preg_match("/^\d+$/", $invoice_insert_id)) {
                        $invoice_id = $obj->getTableColumnValue($GLOBALS['invoice_table'],'id',$invoice_insert_id,'invoice_id');
                        $invoice_number = $obj->getTableColumnValue($GLOBALS['invoice_table'],'id',$invoice_insert_id,'invoice_number');
                        $invoice_balance =1;
                        $job_update = 1;
                        $balance = 1;
                        $result = array('number' => '1', 'msg' => 'Invoice Entry Successfully Created','redirection_page' =>'invoice.php');					
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $invoice_insert_id);
                    }
                } else {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['invoice_table'], 'invoice_id', $edit_id, 'id');
                    $invoice_number = $obj->getTableColumnValue($GLOBALS['invoice_table'], 'invoice_id', $edit_id, 'invoice_number');
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "Invoice Entry Updated. Bill No. - ".$invoice_number;

                        $columns = array(); $values = array();						
                        $columns = array('creator_name','bill_company_id', 'bill_company_details', 'invoice_date','party_id', 'party_name_mobile_city', 'party_details', 'gst_option', 'tax_type', 'tax_option', 'overall_tax', 'charges_tax', 'product_tax', 'party_state','vehicle_id','vehicle_number','vehicle_details','job_card_id','job_card_number','store_entry_id','store_entry_number','store_id','store_name','product_id', 'product_name', 'hsn_code', 'quantity', 'unit_id' ,'unit_name' ,'rate','final_rate', 'product_amount','amount', 'sub_total', 'discount', 'discount_value', 'discounted_total',  'charges_name','charges',  'charges_value','charges_total','cgst_value', 'sgst_value', 'igst_value', 'total_tax_value','round_off', 'total_amount', 'round_off_type' , 'round_off_value', 'discount_name','bank_id','bank_name','bank_account_number');
                        $values = array("'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'", "'".$invoice_date."'","'".$party_id."'", "'".$party_name_mobile_city."'", "'".$party_details."'","'".$gst_option."'", "'".$tax_type."'", "'".$tax_option."'", "'".$overall_tax."'", "'".$charges_tax."'","'".$product_tax."'","'".$party_state."'","'".$vehicle_id."'","'".$vehicle_number."'","'".$vehicle_details."'","'".$job_card_id."'","'".$job_card_number."'","'".$store_entry_id."'","'".$store_entry_number."'","'".$store_id."'","'".$store_name."'","'".$product_id."'", "'".$product_name."'","'".$hsn_code."'","'".$quantity."'", "'".$unit_id."'","'".$unit_name."'","'".$rate."'","'".$final_rate."'", "'".$product_amount."'","'".$amount."'","'".$sub_total."'", "'".$discount."'", "'".$discount_value."'" , "'".$discounted_total."'",   "'".$charges_id."'",  "'".$charges_values."'", "'".$charges_total."'","'".$charged_total."'", "'".$cgst_value."'", "'".$sgst_value."'", "'".$igst_value."'", "'".$total_tax_value."'","'".$round_off."'", "'".$total_amount."'", "'".$round_off_type."'", "'".$round_off_value."'", "'".$discount_name."'","'".$bank_id."'","'".$bank_name."'","'".$bank_account_number."'");
                        
                        $invoice_update_id = $obj->UpdateSQL($GLOBALS['invoice_table'], $getUniqueID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $invoice_update_id)) {
                            $invoice_id = $edit_id;
                            $invoice_number = $obj->getTableColumnValue($GLOBALS['invoice_table'], 'invoice_id', $edit_id, 'invoice_number');
                            $result = array('number' => '1', 'msg' => 'Updated Successfully','redirection_page' =>'invoice.php');
                            $invoice_balance =1; 
                            $balance = 1;
                            $job_update = 1;
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $invoice_update_id);
                        }							
                    }
                }

                if($job_update == 1) {
                    $job_card_id = explode(',',$job_card_id);
                    $job_card_id = array_filter(array_unique($job_card_id));
                    $columns = array('invoice_status','invoice_id');
                    $values =array("'I'","'".$invoice_id."'");
                    $action = "Updated invoice. Bill No. - ".$invoice_number;
                    foreach($job_card_id as $job) {
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['job_card_table'],'job_card_id',$job,'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $job_card_update_id = $obj->UpdateSQL($GLOBALS['job_card_table'], $getUniqueID, $columns, $values, $action);
                        }
                    }
                }
                if(!empty($balance) && $balance == 1) {
                    $credit  = 0; $debit = 0; $bill_type ="Invoice";
                    $bill_id = $invoice_id;
                    $bill_date = $invoice_date;
                    $bill_number =  $invoice_number;

                    $debit  = $total_amount; 
                    
                    if(empty($credit)){
                        $credit = 0;
                    }
                    if(empty($debit)){
                        $debit = 0;
                    }
                    if(!empty($party_id)){
                        $party_name = $obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$party_id,'party_name');
                        $party_type = "Customer";
                    }
                    $update_balance ="";
                    $update_balance = $obj->UpdateBalance($bill_company_id,$bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$GLOBALS['null_value'],$GLOBALS['null_value'],$bank_id,$GLOBALS['null_value'],$bank_name,$GLOBALS['null_value'],$credit,$debit);
                        
                }
            } else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        } else {
            if(!empty($valid_invoice)) {
                $result = array('number' => '3', 'msg' => $valid_invoice);
            }
            else if(!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);
            }
            else if(!empty($invoice_error)) {
                $result = array('number' => '2', 'msg' => $invoice_error);
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
        $show_bill = 0;$material_type = "";
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
        $total_records_list = $obj->getSalesList($from_date, $to_date,$show_bill,$party_id, 'invoice');
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['invoice_number']), $search_text) !== false) ) {
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
                    <th>Bill Number</th>
                    <th>Party Name</th>
                    <th>Vehicle Number</th>
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
                                <td class="ribbon-header" style="cursor:default;">
                                    <?php echo $index; ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['invoice_date'])) {
                                            echo date('d-m-Y', strtotime($list['invoice_date']));
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['invoice_number']) && $list['invoice_number'] != $GLOBALS['null_value']) {
                                            echo $list['invoice_number'];
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
                                        if(!empty($list['vehicle_number'])) {
                                            echo $obj->encode_decode('decrypt', $list['vehicle_number']);
                                        }
                                        else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['total_amount'])) {
                                            echo number_format($list['total_amount'],2);
                                        }
                                        else {
                                            echo '-';
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

                                    <div class="dropdown">
                                        <button class="btn btn-dark show-button py-1 px-2" type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <li>
                                                <a class="dropdown-item" style="cursor:pointer;"  target="_blank" href="reports/rpt_invoice_a4.php?view_invoice_id=<?php if(!empty($list['invoice_id'])) { echo $list['invoice_id']; } ?>"><i class="fa fa-print"></i>&ensp;Print</a>
                                            </li>
                                            <?php 
                                                if(empty($edit_access_error) && $list['deleted'] == '0') {
                                                    ?>
                                                    <li>
                                                        <a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['invoice_id'])) { echo $list['invoice_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a>
                                                    </li>
                                                    <?php
                                                } 
                                            ?>  
                                                <?php 
                                                if(empty($delete_access_error) && $list['deleted'] == '0') {
                                                    ?>
                                                        <li>
                                                            <a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['invoice_id'])) { echo $list['invoice_id']; } ?>');"><i class="fa fa-trash"></i> &ensp;  Delete</a>
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
		<?php	
        }
	}

    if(isset($_REQUEST['delete_invoice_id'])) {
        $delete_invoice_id = $_REQUEST['delete_invoice_id'];
        $delete_invoice_id = trim($delete_invoice_id);
        $msg = "";
        if(!empty($delete_invoice_id)) {	
            $invoice_unique_id = ""; $voucher_unique_id = ""; $voucher_id = "";
            $invoice_unique_id = $obj->getTableColumnValue($GLOBALS['invoice_table'], 'invoice_id', $delete_invoice_id, 'id');
            if(preg_match("/^\d+$/", $invoice_unique_id)) {
                $bill_number = "";
                $bill_number = $obj->getTableColumnValue($GLOBALS['invoice_table'], 'invoice_id', $delete_invoice_id, 'invoice_number');
            
                $action = "Delete Invoice";
                $payment_delete = "1";
                if($payment_delete == '1') {
                    $payment_bill_list = array(); $payment_unique_id = "";

                    $payment_bill_list = $obj->getTableRecords($GLOBALS['payment_table'], 'bill_id', $delete_invoice_id,'');
                    if(!empty($payment_bill_list)){
                        foreach($payment_bill_list as $value){
                            if(!empty($value['id'])){
                                $payment_unique_id = $value['id'];
                            }
                            if(preg_match("/^\d+$/", $payment_unique_id)) {
                                $action = "Payment Deleted.";
                            
                                $columns = array(); $values = array();						
                                $columns = array('deleted');
                                $values = array("'1'");
                                $msg = $obj->UpdateSQL($GLOBALS['payment_table'], $payment_unique_id, $columns, $values, $action);
                            }
                        }
                    }
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['invoice_table'], $invoice_unique_id, $columns, $values, $action);
                    $columns = array(); $values = array();			
                    $obj->RevoteJobCard('invoice',$delete_invoice_id);
                }
            }
            else {
                $msg = "Invalid invoice";
            }
        }
        else {
            $msg = "Empty invoice";
        }
        echo $msg;
        exit;	
    } 
    ?>