<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['purchase_entry_module'];
        }
    }

	if(isset($_REQUEST['show_purchase_entry_id'])) { 
        $show_purchase_entry_id = $_REQUEST['show_purchase_entry_id'];
        $show_purchase_entry_id = trim($show_purchase_entry_id);
        $purchase_entry_date = date('Y-m-d');$purchase_bill_date = date('Y-m-d'); $current_date = date('Y-m-d');$purchase_entry_number = "";$gst_option = 0; $tax_type = 0; $tax_option = 0; $overall_tax = "";$purchase_store_ids = ""; $store_type =""; $indv_store_id =array(); $overall_store_id =""; $discount =""; $discount_value=""; $charges_tax =array(); $charges_value=""; $amount =array(); $round_off =""; $round_off_type =""; $round_off_value =""; $store_ids = array(); $product_ids = array(); $product_names = array(); $product_amount = array();$discount = ""; $discount_value = "";$extra_charges = ""; $extra_charges_value = ""; $unit_ids =array(); $unit_names=array(); $charges_id = array(); $charges_type = array(); $charges_value = array();  $product_tax =array(); $draft =0; $discount_name = ""; $charges_tax_array = array(); $bill_number ="";
        if(!empty($show_purchase_entry_id)) {
            $purchase_entry_list = $obj->getTableRecords($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $show_purchase_entry_id, '');   
            if(!empty($purchase_entry_list)) {
                foreach($purchase_entry_list as $data) {
                    if(!empty($data['purchase_entry_date'])) {
                        $purchase_entry_date = date('Y-m-d', strtotime($data['purchase_entry_date']));
                    }
                    if(!empty($data['purchase_bill_date'])) {
                        $purchase_bill_date = date('Y-m-d', strtotime($data['purchase_bill_date']));
                    }
                    if(!empty($data['bill_number'])) {
                        $bill_number = $data['bill_number'];
                    }
                    if(!empty($data['purchase_entry_number']) && $data['purchase_entry_number'] != $GLOBALS['null_value']) {
                        $purchase_entry_number = $data['purchase_entry_number'];
                    }
                    if(!empty($data['store_id']) && $data['store_id'] != $GLOBALS['null_value']) {
                        $purchase_store_ids = $data['store_id'];
                    }
                    if(!empty($data['store_name']) && $data['store_name'] != $GLOBALS['null_value']) {
                        $purchase_store_names = $data['store_name'];
                    }          
                    if(!empty($data['store_type']) && $data['store_type'] != $GLOBALS['null_value']) {
                        $store_type = $data['store_type'];
                    }                
                    if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                        $party_id = $data['party_id'];
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
                    if(!empty($data['store_id']) && $data['store_id'] != $GLOBALS['null_value']) {
                        $store_ids = $data['store_id'];
                        $store_ids = explode(",", $store_ids);
                        $store_ids = array_reverse($store_ids);
                    }         
                    
                    if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                        $product_ids = $data['product_id'];
                        $product_ids = explode(",", $product_ids);
                        $product_count = count($product_ids);
                        $product_ids = array_reverse($product_ids);
                    }
                    if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                        $product_names = $data['product_name'];
                        $product_names = explode(",", $product_names);
                        $product_names = array_reverse($product_names);
                    }
                    if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                        $unit_ids = $data['unit_id'];
                        $unit_ids = explode(",", $unit_ids);
                        $unit_ids = array_reverse($unit_ids);
                    }
                    if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                        $unit_names = $data['unit_name'];
                        $unit_names = explode(",", $unit_names);
                        $unit_names = array_reverse($unit_names);
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
                    if(!empty($data['round_off_type']) && $data['round_off_type'] != $GLOBALS['null_value']) {
                        $round_off_type = $data['round_off_type'];
                    }
                    if(!empty($data['round_off_value']) && $data['round_off_value'] != $GLOBALS['null_value']) {
                        $round_off_value = $data['round_off_value'];
                    }
                    if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                        $total_amount = $data['total_amount'];
                    }
                    if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                        $quantity = $data['quantity'];
                        $quantity = explode(",", $quantity);
                        $quantity = array_reverse($quantity);
                    }
                    if(!empty($data['charges_tax']) && $data['charges_tax'] != $GLOBALS['null_value']) {
                        $charges_tax = $data['charges_tax'];
                    }
                    if(!empty($data['rate']) && $data['rate'] != $GLOBALS['null_value']) {
                        $rates = $data['rate'];
                        $rates = explode(",", $rates);
                        $rates = array_reverse($rates);
                    }
                
                    if(!empty($data['final_rate']) && $data['final_rate'] != $GLOBALS['null_value']) {
                        $final_rate = $data['final_rate'];
                        $final_rate = explode(",", $final_rate);
                        $final_rate = array_reverse($final_rate);
                    }
                    if(!empty($data['product_amount']) && $data['product_amount'] != $GLOBALS['null_value']) {
                        $product_amount = $data['product_amount'];
                        $product_amount = explode(",", $product_amount);
                        $product_amount = array_reverse($product_amount);
                    }
                    if(!empty($data['product_tax']) && $data['product_tax'] != $GLOBALS['null_value']) {
                        $product_tax = $data['product_tax'];
                        $product_tax = explode(",", $product_tax);
                        $product_tax = array_reverse($product_tax);
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
                        for($i=0;$i<count($product_ids);$i++)
                        {
                            $charges_tax_array[]= $overall_tax;
                        }
                    }
                }
                // $party_state = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'state');
                // $party_state = $obj->encode_decode('decrypt',$party_state);
            }
        }
        $charges_tax_array = array_unique($charges_tax_array);
        
		$company_state = "";$country = "India"; $state = "";
		$company_state = $obj->getTableColumnValue($GLOBALS['company_table'], 'company_id', $GLOBALS['bill_company_id'], 'state');
        if(!empty($company_state)) {
			$company_state = $obj->encode_decode('decrypt', $company_state);
		}

        $party_list = array();
        $party_list = $obj->getPartyList('1'); 

        $unit_list = array();
        $unit_list = $obj->getTableRecords($GLOBALS['unit_table'], 'bill_company_id', $GLOBALS['bill_company_id']);

        $product_list = array();
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '');

        $store_list = array();
        $store_list = $obj->getTableRecords($GLOBALS['store_room_table'], 'bill_company_id', $GLOBALS['bill_company_id']);

        ?>
        <form class="poppins pd-20 redirection_form" name="purchase_entry_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<?php if(!empty($show_purchase_entry_id)) {  ?>
						    <div class="h5">Edit Purchase Entry</div>
                            <?php
                        }else{ ?>
						    <div class="h5">Add Purchase Entry</div>
                        <?php

                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('purchase_entry.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_purchase_entry_id)) { echo $show_purchase_entry_id; } ?>">
                <div class="col-lg-2 col-md-4 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="purchase_entry_date" class="form-control shadow-none" placeholder="" required="" value="<?php if(!empty($purchase_entry_date)) { echo $purchase_entry_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                            <label>Date</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="bill_number" name="bill_number"  value="<?php if(!empty($bill_number)){ echo $bill_number; } ?>" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'',25,1);" placeholder="" required>
                            <label>Bill Number</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border chargesaction">
                            <div class="input-group">
                                <select class="select2 select2-danger" name="party_id" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:getPartyState(this.value);Javascript:HideDetails('party');">
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
                            <a href="Javascript:ViewPartyDetails('party');" class="<?php if(empty($show_purchase_entry_id)){?>d-none<?php }?> details_element" style="font-size: 12px;font-weight: bold;">Click to view details</a>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-2 col-md-4 col-6 px-lg-1 py-2">
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="gst_option" class="form-label text-muted smallfnt">GST/Non GST</label>
                            <input class="form-check-input code-switcher" type="checkbox" name="gst_option" onchange="Javascript:ShowGST(this,this.value);"
                            value="<?php echo $gst_option; ?>" <?php if ($gst_option == '1') echo 'checked'; ?> id="gst_option">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 tax_cover <?php if($gst_option !='1'){?>d-none<?php } ?>">
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
            </div>
            <div class="row p-3">
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 <?php if($gst_option !='1'){?>d-none<?php } ?> tax_cover1" id="tax_option_div">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="tax_option" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:getRateByTaxOption();" onchange="Javascript:ShowGST(this,this.value);">
                                <option value="">Select</option>
                                <option value="1" <?php if($tax_option == '1'){ ?>selected<?php } ?>>Exclusive Tax</option>
                                <option value="2" <?php if($tax_option == '2'){ ?>selected<?php } ?>>Inclusive Tax</option>
                            </select>
                            <label>Tax Option <span class="text-danger">*</span></label>
                        </div>
                    </div>  
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2 <?php if($tax_type !='2'){ ?>d-none <?php } ?> tax_cover2">
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
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="store_type" id="store_type" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="getStoreType();" <?php if(!empty($show_purchase_entry_id)){ ?>disabled<?php } ?>>
                                <option value="">Select Store Type</option>
                                <option value="1" <?php if($store_type == '1'){ ?>selected<?php } ?>>Overall store</option>
                                <option value="2" <?php if($store_type == '2'){ ?>selected<?php } ?>>Productwise</option>
                            </select>
                            <label>Store Type</label>
                            <input type="hidden" name="store_type" value = "<?php echo $store_type ?>">
                        </div>
                    </div> 
                </div> 
                <div class="col-lg-2 col-md-3 col-6 py-2 store_cover1 <?php if($store_type != '1'){ ?>d-none<?php } ?>">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                           <select class="select2 select2-danger" name="overall_store_id" data-dropdown-css-class="select2-danger" style="width: 100%!important;"  <?php if(!empty($show_purchase_entry_id)){ ?>disabled<?php } ?>>
                                <option value="">Select</option>
                                <?php
                                    if(!empty($store_list)) {
                                        foreach ($store_list as $data) {
                                            if(!empty($data['store_room_id']) && $data['store_room_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['store_room_id']; ?>" <?php if(!empty($store_ids[0]) && $store_ids[0] == $data['store_room_id']) { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['store_room_name']) && $data['store_room_name'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['store_room_name']);
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Store</label>
                        </div>
                    </div> 
                    <?php
                    if(!empty($show_purchase_entry_id)){
                    ?>                    
                    <input type="hidden" class="form-control shadow-none" name="overall_store_id" value="<?php  if(!empty($store_ids[0])){ echo $store_ids[0]; } ?>">  
                    <?php } ?>
                </div> 
            </div>
            <div class="row justify-content-center p-3">
                <div class="col-lg-2 col-md-3 col-12 px-lg-1 py-2 store_cover2 <?php if($store_type != '2'){ ?>d-none<?php } ?>">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                           <select class="select2 select2-danger" name="indv_store_id" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:getStoreType();" >
                                <option value="">Select</option>
                                <?php
                                    $count = count($store_list);
                                    if(!empty($store_list)) {
                                        foreach ($store_list as $data) {
                                            if(!empty($data['store_room_id']) && $data['store_room_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['store_room_id']; ?>" <?php if((!empty($overall_store_ids) && $overall_store_ids == $data['store_room_id']) || $count == '1') { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['store_room_name']) && $data['store_room_name'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['store_room_name']);
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Store</label>
                        </div>
                    </div> 
                    <!-- <input type="hidden" class="form-control shadow-none" name="overall_store_id" value="">   -->
                </div> 
                <div class="col-lg-3 col-md-3 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border chargesaction">
                            <div class="input-group ">
                                <select class="select2 select2-danger" name="selected_product_id" id="selected_product_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getUnit(this.value);">
                                    <option value="">Select</option>
                                    <?php
                                        if(!empty($product_list)) {
                                            foreach ($product_list as $data) {
                                                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                                                    ?>          
                                                    <option value="<?php echo $data['product_id']; ?>" <?php if(!empty($product_ids) && $product_ids == $data['product_id']) { ?>selected<?php } ?>>
                                                        <?php
                                                            if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                                                                echo $obj->encode_decode('decrypt', $data['product_name']);
                                                            }
                                                        ?>
                                                    </option>
                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <label>Product</label>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="Javascript:CustomAddModalContent('product');" style="background-color:#f06548!important; cursor:pointer; height:100%;"><i class="fa fa-plus text-white"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="selected_unit_id"  id="selected_unit_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange=javascript:getTotalQuantity();>
                                <option value="">Select</option>
                            </select>
                            <label>Unit</label>
                        </div>
                    </div>     
                </div> 
                 <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="selected_quantity" class="form-control shadow-none" onkeyup="javascript:getTotalQuantity();" onfocus="Javascript:KeyboardControls(this,'number',8,'');" required="">
                            <label class="qty_cover">QTY</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="selected_rate" class="form-control shadow-none" onkeyup="javascript:getTotalQuantity();" onfocus="Javascript:KeyboardControls(this,'number',8,'');" required="">
                            <label>Rate</label>
                        </div>
                    </div> 
                </div> 
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="selected_amount" id="selected_amount" class="form-control shadow-none" required="" readonly>
                            <label>Amount</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-2 col-4 py-2 px-lg-1 text-center">
                    <button class="btn btn-danger add_products_button w-100" style="font-size:12px;" type="button" onclick="Javascript:AddDetails();">
                        Add
                    </button>
                </div> 
            </div>                   
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <input type="hidden" name="company_state" value="<?php if(!empty($company_state)) { echo $company_state; } ?>">
                        <input type="hidden" name="party_state" value="<?php if(!empty($party_state)) { echo $party_state; } ?>">
                        <input type="hidden" name="product_count" value="<?php if(!empty($product_count)) { echo $product_count; } else { echo '0'; } ?>">
                        <table class="table nowrap cursor text-center table-bordered smallfnt w-100 purchase_entry_table">
                            <thead class="bg-dark">
                                <tr style="white-space:pre;">
                                    <th style="width: 20px;">#</th>
                                    <th style="width: 20%;" class="store_cover3 <?php if($store_type != '2'){?>d-none<?php } ?>">Store</th>
                                    <th style="width: 220px;">Product</th>
                                    <th style="width: 100px;">Unit</th>
                                    <th style="width: 80px;" class="qty_cover">QTY</th>
                                    <th style="width: 150px;" class="rate_cover">Rate</th>
                                    <th style="width: 10%;" class="<?php if($tax_type != '1'){ ?>d-none <?php }?> tax_element">Tax</th>
                                    <th style="width: 100px;">Amount</th>
                                    <th style="width: 70px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(!empty($product_ids)) {
                                    $index = 0;
                                    for($i=0; $i < count($product_ids); $i++) {    
                                        ?>
                                        <tr class="product_row" id="product_row<?php if(!empty($product_count)) { echo $product_count; } ?>">
                                            <th class="text-center px-2 py-2 sno"><?php if(!empty($product_count)) { echo $product_count; } ?></th>
                                            <th class="text-center px-2 py-2 store_cover2 <?php if($store_type != '2'){?>d-none<?php } ?>">
                                                <?php
                                                    if(!empty($store_ids[$i])) {
                                                        $store_name = "";
                                                        $store_name = $obj->getTableColumnValue($GLOBALS['store_room_table'], 'store_room_id', $store_ids[$i], 'store_room_name');
                                                        if(!empty($store_name) && $store_name != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $store_name);
                                                        }
                                                    }
                                                ?>
                                                <input type="hidden" name="store_id[]" value="<?php if(!empty($store_ids[$i])) { echo $store_ids[$i]; } ?>">
                                            </th>

                                            <th class="text-center px-2 py-2">
                                                <?php
                                                    if(!empty($product_ids[$i])) {
                                                        $product_name = "";
                                                        $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');
                                                        if(!empty($product_name) && $product_name != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $product_name);
                                                        }
                                                    }
                                                ?>
                                                <input type="hidden" name="product_id[]" value="<?php if(!empty($product_ids[$i])) { echo $product_ids[$i]; } ?>"><br>
                                            
                                            </th>
                                            
                                            <th class="text-center px-2 py-2">
                                                <?php 

                                                if(!empty($unit_names[$i]) && $unit_names[$i] !='NULL')
                                                {
                                                    echo $unit_names[$i] = $obj->encode_decode("decrypt",$unit_names[$i]);
                                                }
                                                ?>
                                                <input type="hidden" name="unit_id[]" class="form-control shadow-none" value="<?php if(!empty($unit_ids[$i])) { echo $unit_ids[$i]; } ?>">
                                                <input type="hidden" name="unit_name[]" class="form-control shadow-none" value="<?php if(!empty($unit_names[$i])) { echo $unit_names[$i]; } ?>" >
                                                    
                                            </th>
                                            <th class="text-center px-2 py-2">
                                                <?php
                                                $show_button = 0;$can_delete = 'true';                                                   
                                                $current_inward_stock = 0; $current_outward_stock = 0; $current_unit_stock = 0;
                                                    $current_inward_stock = $obj->getInwardQty($show_purchase_entry_id,$store_ids[$i],$product_ids[$i],$unit_ids[$i]);
                                                    $current_outward_stock = $obj->getOutwardQty($show_purchase_entry_id,$store_ids[$i],$product_ids[$i],$unit_ids[$i]);                                                            
                                                    // echo $current_inward_stock;
                                                    // echo "|||";
                                                    // echo $current_outward_stock;
                                                    if($current_inward_stock >= $current_outward_stock) {
                                                        $show_button = 1;
                                                    }
                                                ?>
                                                <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity[$i])) { echo $quantity[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
                                            </th>
                                            <td>
                                                <div class="form-group mb-1">
                                                    <div class="form-label-group in-border">
                                                        <input type="text" id="name" name="rate[]" onkeyup="ProductRowCheck(this);" class="form-control shadow-none" style="width: 150px;" value="<?php if(!empty($rates[$i])){ echo $rates[$i]; }?>" required>
                                                        <p class="tax_element text-success final_rate inclusiv_final_rate fw-bold"><?php if(!empty($final_rate[$i])){ echo "Final Rate : ".$final_rate[$i]; } ?></p>
                                                        <input type="hidden" name="final_rate[]" class="form-control shadow-none" value="<?php if(!empty($rates[$i])) { echo $rates[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" >
                                                    </div>
                                                </div> 
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
                                                <p class="amount"><?php if(!empty($amount[$i])){ echo number_format($amount[$i],2); } ?></p>
                                                <input type="hidden" id="amount[]" name="amount[]" value="<?php if(!empty($amount[$i])){ echo $amount[$i]; }?>" class="form-control shadow-none">
                                            </td>
                                            <td class="text-center px-2 py-2">
                                                <?php
                                                $current_inward_stock = 0; $current_outward_stock = 0; $current_unit_stock = 0;
                                                if($show_button == '1' && $can_delete == "true") {
                                                        ?>
                                                        <button class="btn btn-danger" type="button" onclick="Javascript:DeletePurchaseRow('<?php if(!empty($product_count)) { echo $product_count; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
                                                        <?php
                                                }else{
                                                    ?>
                                                        <span class="text-danger" style="font-weight:bold!important;">Can't Delete</span>                                                                     
                                                    <?php
                                                }            
                                                ?>                                                
                                            </td>
                                        </tr>
                                        <?php
                                        $product_count --;
                                    }
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right h6 subtotal_amount"> Total : </td>
                                    <td class="text-right h6 sub_total"></td>     
                                    <td></td>                               
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 row ps-4 pt-3">
                    <div class="col-lg-5 border-end fw-bold " style="border: 1px solid #dee2e6;">
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
                                        <input type="text" name="charges_id[]" value="<?php if(!empty($charges_id)) { echo $charges_id; } ?>" class="form-control shadow-none" placeholder="Charges" onchange="Javascript:checkCharges();">
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
                    <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent(event, 'purchase_entry_form', 'purchase_entry_changes.php', 'purchase_entry.php');"> Submit </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script>
                jQuery(document).ready(function(){
                    <?php 
                        if(!empty($show_purchase_entry_id)) { ?>
                            checkDiscount();
                            calTotal();
                            CheckRoundOff('<?php echo $round_off; ?>')
                        <?php }
                    ?>
                });
            </script>
        </form>
		<?php
    } 
    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title']; 
        $from_date = ""; $to_date = ""; $search_text = "";$search_bill_text = ""; $party_id = "";
        $show_bill = 0;$show_draft_bill = 0;$material_type = "";
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }
        if(isset($_POST['show_bill'])) {
            $show_bill = $_POST['show_bill'];
        }
        if(isset($_POST['show_draft_bill'])) {
            $show_draft_bill = $_POST['show_draft_bill'];
        }
        if(isset($_POST['search_bill_text'])) {
            $search_bill_text = $_POST['search_bill_text'];
        }
        if(isset($_POST['search_text'])) {
            $search_text = $_POST['search_text'];
        }

        if(isset($_POST['filter_party_id']))
        {
               $party_id = $_POST['filter_party_id'];
        }

        $total_records_list = array();
        $total_records_list = $obj->getPurchaseList($from_date, $to_date,$show_bill,$party_id);
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['purchase_entry_number']), $search_text) !== false) ) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }
        if(!empty($search_bill_text)) {
            $search_bill_text = strtolower($search_bill_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['purchase_entry_number']), $search_bill_text) !== false) ) {
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
                    <th>#</th>
                    <th>Date</th>
                    <th>Entry Number</th>
                    <th>Bill Number</th>
                    <th>Party Name</th>
                    <th>QTY</th>
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
                                        if(!empty($list['purchase_entry_date'])) {
                                            echo date('d-m-Y', strtotime($list['purchase_entry_date']));
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['purchase_entry_number']) && $list['purchase_entry_number'] != $GLOBALS['null_value']) {
                                            echo $list['purchase_entry_number'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['bill_number']) && $list['bill_number'] != $GLOBALS['null_value']) {
                                            echo $list['bill_number'];
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
                                        if(!empty($list['total_qty'])) {
                                            echo number_format(array_sum(explode(",", $list['total_qty'])),2);
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
                                                <a class="dropdown-item" style="cursor:pointer;"  target="_blank" href="reports/rpt_purchase_entry_a4.php?view_purchase_entry_id=<?php if(!empty($list['purchase_entry_id'])) { echo $list['purchase_entry_id']; } ?>"><i class="fa fa-print"></i>&ensp;Print</a>
                                            </li>
                                            <?php 
                                                if(empty($edit_access_error) && $list['deleted'] == '0') {
                                                    ?>
                                                    <li>
                                                        <a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['purchase_entry_id'])) { echo $list['purchase_entry_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a>
                                                    </li>
                                                    <?php
                                                } 
                                            ?>  
                                                <?php 
                                                if(empty($delete_access_error) && $list['deleted'] == '0') {
                                                    ?>
                                                        <li>
                                                            <a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['purchase_entry_id'])) { echo $list['purchase_entry_id']; } ?>');"><i class="fa fa-trash"></i> &ensp;  Delete</a>
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

    if(isset($_REQUEST['product_row_index'])) {
        $product_id = $_REQUEST['selected_product_id'];
        $selected_unit_id = $_REQUEST['selected_unit_id'];
        $selected_quantity = $_REQUEST['selected_quantity'];
        $rate = $_REQUEST['selected_rate'];
        $amount = $_REQUEST['selected_amount'];
        $product_row_index = $_REQUEST['product_row_index'];
        $final_rate = $_REQUEST['final_rate'];
        $tax_option = $_REQUEST['tax_option'];
        $tax_type =$_REQUEST['tax_type'];
        $store_type  = $_REQUEST['store_type'];
        $store_id = $_REQUEST['store_id'];
        $final_rate_raw = 0;
        $final_rate_raw = $final_rate;

        // $selected_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'unit_id');
        
        $product_tax = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'product_tax');

        if($tax_option == '2' && $tax_type == '1')
        {
            if(!empty($product_tax))
            {
                $tax = str_replace("%","",$product_tax);
                if($tax != "" && $tax != $GLOBALS['null_value']){
                    $final_rate =$final_rate -( ($final_rate * $tax)/(100+$tax));
                }
            }
            
        }
        
        if(!empty($final_rate))
        {
            $final_rate = floor($final_rate * 100) / 100;
            
        }

        $amount =$final_rate * $selected_quantity;
        $product_tax = $product_tax.'%';
        ?>
        <tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
            <th class="text-center px-2 py-2 sno"><?php if(!empty($product_row_index)) { echo $product_row_index; } ?></th>
            <?php if($store_type == '2'){ ?>
                <th class="text-center px-2 py-2 store_data">
                    <?php
                        if(!empty($store_id)) {
                            $store_name = "";
                            $store_name = $obj->getTableColumnValue($GLOBALS['store_room_table'], 'store_room_id', $store_id, 'store_room_name');
                            if(!empty($store_name) && $store_name != $GLOBALS['null_value']) {
                                echo $obj->encode_decode('decrypt', $store_name);
                            }
                        }
                    ?>   
                </th>
            <?php  } ?>
            <input type="hidden" name="store_id[]" value="<?php if(!empty($store_id)) { echo $store_id; } ?>"><br>
            <th class="text-center px-2 py-2">
                <?php
                    if(!empty($product_id)) {
                        $product_name = "";
                        $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
                        if(!empty($product_name) && $product_name != $GLOBALS['null_value']) {
                            echo $obj->encode_decode('decrypt', $product_name);
                        }
                    }
                ?>
                <input type="hidden" name="product_id[]" value="<?php if(!empty($product_id)) { echo $product_id; } ?>"><br>
                
            </th>
            <th class="text-center px-2 py-2">
                <?php
                    if(!empty($selected_unit_id)) {
                        $unit_name = "";
                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $selected_unit_id, 'unit_name');
                        if(!empty($unit_name) && $unit_name != $GLOBALS['null_value']) {
                            echo $obj->encode_decode('decrypt', $unit_name);
                        }
                    }
                ?>

                <input type="hidden" name="unit_id[]" value="<?php if(!empty($selected_unit_id)) { echo $selected_unit_id; } ?>">
            </th>
            <th class="text-center px-2 py-2">
                <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($selected_quantity)) { echo $selected_quantity; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">                
            </th>

            <th class="text-center px-2 py-2" style="width: 100px;">
                <input type="text" name="rate[]" class="form-control shadow-none" value="<?php if(!empty($rate)) { echo $rate; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
                <p class=" text-success inclusiv_final_rate final_rate"><?php if(!empty($final_rate)){ echo "Final Rate : ".$final_rate; }?></p>
                <input type="hidden" name="final_rate[]" class="form-control shadow-none" value="<?php if(!empty($rate)) { echo $rate; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" >
            </th>
            <th class="tax_element text-center px-2 py-2 d-none">
                <div class="form-group">
                    <div class="form-label-group in-border mb-0">
                        <select class="select2 select2-danger" name="product_tax[]" data-dropdown-css-class="select2-danger" style="width: 100%;"  onchange="ProductRowCheck(this);ShowGST();">
                            <option value="">Select</option>
                            <option value="0%" <?php if($product_tax == '0%'){ ?>selected<?php } ?>>0%</option>
                            <option value="5%" <?php if($product_tax == '5%'){ ?>selected<?php } ?>>5%</option>
                            <option value="12%" <?php if($product_tax == '12%'){ ?>selected<?php } ?>>12%</option>
                            <option value="18%" <?php if($product_tax == '18%'){ ?>selected<?php } ?>>18%</option>
                            <option value="28%" <?php if($product_tax == '28%'){ ?>selected<?php } ?>>28%</option>
                        </select>
                        <label>Tax</label>
                    </div>
                </div>
            </th>
            
            <th class="text-center px-2 py-2">
                <p class="amount"><?php if(!empty($amount)){ echo number_format($amount,2); } ?></p>
                <input type="hidden" name="amount[]" class="form-control shadow-none" value="<?php if(!empty($amount)) { echo $amount; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" readonly>
            </th>
            <th class="text-center px-2 py-2">
                <button class="btn btn-danger" type="button" onclick="Javascript:DeletePurchaseRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
            </th>
        </tr>
        <script type="text/javascript">
            if(jQuery('tr#product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>').find('select').length > 0) {
                jQuery('tr#product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>').find('select').select2();
            }
        </script>
        <?php
    }

    if(isset($_REQUEST['edit_id'])) {
        $purchase_entry_date = ""; $bill_number =""; $purchase_entry_date_error = ""; $party_id = ""; $party_id_error = "";  $gst_option_error = ""; $tax_type = ""; $tax_type_error = "";$tax_option = ""; $tax_option_error = ""; $overall_tax =""; $product_ids = array(); $quantity = array(); $total_qty = array();$rates = array();  $final_rate =array(); $product_amount =array(); $product_error = ""; $product_names = array(); $amount =array(); $cgst_value = 0; $sgst_value = 0; $igst_value = 0; $round_off = ""; $sub_total = 0; $total_amount = 0; $total_tax_value = 0; $overall_tax ="";$unit_id = "";$unit_ids = array(); $unit_id_error =""; $gst_option ="";  $product_tax =array(); $charges_tax =array(); $terms_and_condition ="";
        $company_state = ""; $party_state = ""; $draft = 0; $charges_id = array(); $charges_names = array();
        $charges_values = array(); $charges_type = array(); $charges_total = array();  $is_discount =""; $discount_name = "";
        $purchase_balance =0;
        $valid_purchase = ""; $form_name = "purchase_entry_form"; $edit_id = ""; $discount_value =""; $discounted_total = 0; 

        $store_type =""; $store_type_error=""; $store_ids ="";  $store_ids = array(); $store_id_error = "";
        $stock_unique_ids = array();


        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        $purchase_entry_date = $_POST['purchase_entry_date'];
        $purchase_entry_date = trim($purchase_entry_date);
        $purchase_entry_date_error = $valid->common_validation($purchase_entry_date, 'Entry Date', '1');
        if(!empty($purchase_entry_date_error)) {
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'purchase_entry_date', $purchase_entry_date_error, 'text');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'purchase_entry_date', $purchase_entry_date_error, 'text');
            }
        }
        if(isset($_POST['bill_number'])){
            $bill_number = $_POST['bill_number'];
            if(empty($bill_number)){
                $bill_number_error = "Enter Bill Number";
            }
            if(!empty($bill_number_error)){
                if(!empty($valid_purchase)){
                    $valid_purchase = $valid_purchase." ".$valid->error_display($form_name,'bill_number',$bill_number_error,'text');
                }
                else{
                    $valid_purchase = $valid->error_display($form_name,'bill_number',$bill_number_error,'text');
                }
            }
        }

        if(isset($_POST['store_type']))
        {
            $store_type = $_POST['store_type'];
            if(empty($store_type))
            {
                $store_type_error ="Select store Type";
            }
            if(!empty($store_type_error)) {
                if(!empty($valid_purchase)) {
                    $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'store_type', $store_type_error, 'select');
                }
                else {
                    $valid_purchase = $valid->error_display($form_name, 'store_type', $store_type_error, 'select');
                }
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
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'party_id', $party_id_error, 'select');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'party_id', $party_id_error, 'select');
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
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'gst_option', $gst_option_error, 'text');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'gst_option', $gst_option_error, 'text');
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
                if(!empty($valid_purchase)) {
                    $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'tax_type', $tax_type_error, 'select');
                }
                else {
                    $valid_purchase = $valid->error_display($form_name, 'tax_type', $tax_type_error, 'select');
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
                if(!empty($valid_purchase)) {
                    $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'tax_option', $tax_option_error, 'select');
                }
                else {
                    $valid_purchase = $valid->error_display($form_name, 'tax_option', $tax_option_error, 'select');
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

       
        if(isset($_POST['product_id'])) {
            $product_ids = $_POST['product_id'];
        }
        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
        }
        if(isset($_POST['total_qty'])) {
            $total_qty = $_POST['total_qty'];
        }
        if(isset($_POST['rate']))
        {
            $rates = $_POST['rate'];
        }
      
        if(isset($_POST['product_tax']))
        {
            $product_tax = $_POST['product_tax'];
        }
        if(isset($_POST['charges_tax']))
        {
            $charges_tax = $_POST['charges_tax'];
        }
        
        if(isset($_POST['unit_id']))
        {
            $unit_ids = $_POST['unit_id'];
        }
        if(isset($_POST['final_rate']))
        {
            $final_rate = $_POST['final_rate'];
        }
        if(empty($edit_id)){           
            if($store_type == '1')
            {
                $gdwn_id = $_POST['overall_store_id'];
                for($i=0;$i<count($product_ids);$i++)
                {
                    $store_ids[$i] = $gdwn_id;
                }
            }
            else
            {
                if(isset($_POST['store_id']))
                {
                    $store_ids = $_POST['store_id'];
                }
            }
          
            if(!empty($store_id_error)) {
                if(!empty($valid_purchase)) {
                    $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'store_id', $store_id_error, 'select');
                }
                else {
                    $valid_purchase = $valid->error_display($form_name, 'store_id', $store_id_error, 'select');
                }
            }
        }else{
            if(isset($_POST['store_id'])) {
                $store_ids = $_POST['store_id'];
            }
        }      
        $stock_error = 0; $valid_stock = "";
        $final_rate =array(); $unit_names = array();$index=0;
        if(!empty($product_ids)) {
            for($i=0; $i < count($product_ids); $i++) {
                if(!empty($store_ids))
                {
                    $store_name[$i] = $obj->getTableColumnValue($GLOBALS['store_room_table'],'store_room_id',$store_ids[$i],'store_room_name');
                }

                $product_ids[$i] = trim($product_ids[$i]);
                $product_unique_id = "";
                $product_unique_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'id');
                if(preg_match("/^\d+$/", $product_unique_id)) {
                    $product_name = "";
                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');
                    $product_names[$i] = $product_name;
                    $unit_name = "";
                    $unit_ids[$i] = trim($unit_ids[$i]);
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
                    $unit_names[$i] = $unit_name; 
                    
                    $quantity[$i] = trim($quantity[$i]);
                    if(!empty($quantity[$i])) {
                        $change_rate = $rates[$i];
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $quantity[$i]) && $quantity[$i] <= 99999) 
                        {
                            $total_qty[$i] = $quantity[$i]; 

                            $rates[$i] = trim($rates[$i]);
                            if(!empty($rates[$i])) {
                                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $rates[$i]) && $rates[$i] <= 99999) 
                                {  
                                    $final_rate[$i] = $rates[$i];
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

                                    $current_inward_stock = 0; $current_outward_stock = 0; $current_unit_stock = 0;
                                    $current_inward_stock = $obj->getInwardQty($edit_id,$store_ids[$i],$product_ids[$i],$unit_ids[$i]);
                                    $current_outward_stock = $obj->getOutwardQty($edit_id,$store_ids[$i],$product_ids[$i],$unit_ids[$i]);                                                            
                                    $current_inward_stock = $current_inward_stock + $quantity[$i];
                                    $current_unit_stock = $current_inward_stock - $current_outward_stock;     
                                    if($current_unit_stock < 0) {
                                        $valid_stock = "Stock goes to Negative for ".($obj->encode_decode('decrypt', $product_names[$i])). " Unit => ". $obj->encode_decode('decrypt',$unit_names[$i]) . " Stock => ".$current_unit_stock;
                                        $stock_error = 1;                                                                
                                    }                                                                                                                
                                    if(!empty($edit_id)) {
                                        $stock_unique_ids[$i] = $obj->getStockUniqueID($edit_id,$store_ids[$i], $product_ids[$i], $unit_ids[$i]);
                                    }                                                    
                                    
                                }
                                else {
                                    $product_error = "Invalid rate in Product - ".($obj->encode_decode('decrypt', $product_name));
                                }
                            }
                            else {
                                $product_error = "Empty Rate in Product - ".($obj->encode_decode('decrypt', $product_name));
                            } 
                            $rates[$i] = $change_rate;
                        }
                        else {
                            $product_error = "Invalid quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                        }
                    }
                    else {
                        $product_error = "Empty quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                    }  
                }
                else {
                    $product_error = "Invalid Product";
                }
            }
        }
        else {
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
                            if(!empty($purchase_entry_error)) {
                                $purchase_entry_error = $purchase_entry_error."<br>".$charges_error;
                            }
                            else {
                                $purchase_entry_error = $charges_error;
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
                    if(empty($purchase_entry_error)) {
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
                                $purchase_entry_error = "Select Charges tax";
                            }
                            
                        }
                        
                    }
                    $charges_total_amounts[] = $total_amount;
                }
                else{
                    if(!empty($charges_values[$i]))
                        {
                            $purchase_entry_error = "Select Charges";
                        }
                        $charges_values[$i] = "";
                }
            }
        }
        $charged_total = $total_amount;   


        if($gst_option == '1' && empty($product_error) && empty($valid_purchase)) {
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

                for ($a = 0; $a < count($product_ids); $a++) {
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
                        $product_error = "Select tax";
                    }
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
                if(!empty($valid_purchase)) {
                    $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'round_off_value', $round_off_value_error, 'text');
                }
                else {
                    $valid_purchase = $valid->error_display($form_name, 'round_off_value', $round_off_value_error, 'text');
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
        if(empty($valid_purchase) && empty($product_error) && empty($purchase_entry_error) && empty($stock_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $bill_company_id =$GLOBALS['bill_company_id'];
                $bill_company_details = "";
                if (!empty($bill_company_id)) {
                    $bill_company_details = $obj->BillCompanyDetails($bill_company_id, $GLOBALS['purchase_entry_table']);
                }
    
                if(!empty($purchase_entry_date)) {
                    $purchase_entry_date = date('Y-m-d', strtotime($purchase_entry_date));
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
             
                if(!empty($product_ids)) {
                    $product_ids = array_reverse($product_ids);
                    $product_ids = implode(",", $product_ids);
                }else{
                    $product_ids = $GLOBALS['null_value'];
                }
               
                if(!empty($product_names)) {
                    $product_names = array_reverse($product_names);
                    $product_names = implode(",", $product_names);
                }else{
                    $product_names = $GLOBALS['null_value'];
                }
    
                if(!empty($unit_ids)) {
                    $unit_ids = array_reverse($unit_ids);
                    $unit_ids = implode(",", $unit_ids);
                }else{
                    $unit_ids = $GLOBALS['null_value'];
                }
                if(!empty($store_ids)) {
                    $store_ids = array_reverse($store_ids);
                    $store_ids = implode(",", $store_ids);
                }else{
                    $store_ids = $GLOBALS['null_value'];
                }

                if(!empty($store_name)) {
                    $store_name = array_reverse($store_name);
                    $store_name = implode(",", $store_name);
                }else{
                    $store_name = $GLOBALS['null_value'];
                }
                if(!empty($unit_names)) {
                    $unit_names = array_reverse($unit_names);
                    $unit_names = implode(",", $unit_names);
                }else{
                    $unit_names = $GLOBALS['null_value'];
                }
                if(!empty($quantity)) {
                    $quantity = array_reverse($quantity);
                    $quantity = implode(",", $quantity);
                }else{
                    $quantity = $GLOBALS['null_value'];
                }
                if(!empty($total_qty)) {
                    $total_qty = array_reverse($total_qty);
                    $total_qty = implode(",", $total_qty);
                }else{
                    $total_qty = $GLOBALS['null_value'];
                }
                
                if(!empty($rates)) {
                    $rates = array_reverse($rates);
                    $rates = implode(",", $rates);
                }else{
                    $rates = $GLOBALS['null_value'];
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

                if(!empty($amount)) {
                    $amount = array_reverse($amount);
                    $amount = implode(",", $amount);
                }else{
                    $amount = $GLOBALS['null_value'];
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

                $purchase_entry_error = "";$check_bills ="";
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
                $balance = 0; $stock_update = 0; $stock_remove = 0;
                if(empty($edit_id)) {
                    $action = "New Purchase Created. ";
                    $null_value = $GLOBALS['null_value'];
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'bill_company_details', 'purchase_entry_id', 'purchase_entry_number', 'purchase_entry_date','bill_number','party_id', 'party_name_mobile_city', 'party_details', 'gst_option', 'tax_type', 'tax_option', 'overall_tax', 'charges_tax', 'product_tax', 'party_state', 'product_id', 'product_name', 'quantity', 'unit_id' ,'unit_name' , 'total_qty', 'rate','final_rate', 'product_amount', 'amount', 'sub_total', 'discount', 'discount_value', 'discounted_total',  'charges_name','charges',  'charges_value','charges_total',  'cgst_value', 'sgst_value', 'igst_value', 'total_tax_value', 'round_off', 'total_amount', 'round_off_type' , 'round_off_value', 'discount_name', 'deleted','store_id','store_name','store_type');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'",  "'".$null_value."'", "'".$null_value."'", "'".$purchase_entry_date."'","'" . $bill_number . "'" ,"'".$party_id."'", "'".$party_name_mobile_city."'", "'".$party_details."'", "'".$gst_option."'", "'".$tax_type."'", "'".$tax_option."'", "'".$overall_tax."'", "'".$charges_tax."'","'".$product_tax."'","'".$party_state."'", "'".$product_ids."'", "'".$product_names."'","'".$quantity."'", "'".$unit_ids."'","'".$unit_names."'", "'".$total_qty."'","'".$rates."'","'".$final_rate."'", "'".$product_amount."'", "'".$amount."'","'".$sub_total."'", "'".$discount."'", "'".$discount_value."'" , "'".$discounted_total."'",   "'".$charges_id."'",  "'".$charges_values."'", "'".$charges_total."'","'".$charged_total."'", "'".$cgst_value."'", "'".$sgst_value."'", "'".$igst_value."'", "'".$total_tax_value."'", "'".$round_off."'", "'".$total_amount."'", "'".$round_off_type."'", "'".$round_off_value."'", "'".$discount_name."'", "'0'","'".$store_ids."'","'".$store_name."'","'".$store_type."'");

                    $purchase_insert_id = $obj->InsertSQL($GLOBALS['purchase_entry_table'], $columns, $values,'purchase_entry_id','purchase_entry_number',$action);
        
                    if(preg_match("/^\d+$/", $purchase_insert_id)) {
                        $purchase_entry_id = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'],'id',$purchase_insert_id,'purchase_entry_id');
                        $purchase_entry_number = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'],'id',$purchase_insert_id,'purchase_entry_number');
                        $purchase_balance =1;
                        $stock_update = 1;
                        $result = array('number' => '1', 'msg' => 'Purchase Entry Successfully Created','redirection_page' =>'purchase_entry.php');					
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $purchase_insert_id);
                    }
                }
                else
                {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $edit_id, 'id');
                    $purchase_entry_number = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $edit_id, 'purchase_entry_number');
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "Purchase Entry Updated. Bill No. - ".$purchase_entry_number;

                        $columns = array(); $values = array();						
                        $columns = array('creator_name','bill_company_id', 'bill_company_details', 'purchase_entry_date','bill_number','party_id', 'party_name_mobile_city', 'party_details', 'gst_option', 'tax_type', 'tax_option', 'overall_tax', 'product_tax', 'party_state','product_id', 'product_name', 'quantity', 'unit_id' ,'unit_name' ,'total_qty', 'rate','final_rate', 'product_amount', 'amount', 'sub_total', 'discount', 'discount_value', 'discounted_total', 'charges_name',  'charges',  'charges_value', 'charges_total', 'cgst_value', 'sgst_value', 'igst_value', 'total_tax_value', 'round_off', 'total_amount', 'charges_tax', 'round_off_type', 'round_off_value', 'discount_name','store_id','store_name','store_type');
                        $values = array("'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'",  "'".$purchase_entry_date."'","'" . $bill_number . "'" ,"'".$party_id."'", "'".$party_name_mobile_city."'", "'".$party_details."'", "'".$gst_option."'", "'".$tax_type."'", "'".$tax_option."'", "'".$overall_tax."'","'".$product_tax."'", "'".$party_state."'", "'".$product_ids."'", "'".$product_names."'","'".$quantity."'", "'".$unit_ids."'","'".$unit_names."'", "'".$total_qty."'","'".$rates."'","'".$final_rate."'", "'".$product_amount."'", "'".$amount."'","'".$sub_total."'", "'".$discount."'", "'".$discount_value."'" , "'".$discounted_total."'",  "'".$charges_id."'",  "'".$charges_values."'", "'".$charges_total."'","'".$charged_total."'", "'".$cgst_value."'", "'".$sgst_value."'", "'".$igst_value."'", "'".$total_tax_value."'", "'".$round_off."'", "'".$total_amount."'", "'".$charges_tax."'","'".$round_off_type."'", "'".$round_off_value."'", "'".$discount_name."'","'".$store_ids."'","'".$store_name."'","'".$store_type."'");
                        
                        $purchase_update_id = $obj->UpdateSQL($GLOBALS['purchase_entry_table'], $getUniqueID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $purchase_update_id)) {
                            $purchase_entry_id = $edit_id;
                            $purchase_entry_number = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $edit_id, 'purchase_entry_number');
                            $result = array('number' => '1', 'msg' => 'Updated Successfully','redirection_page' =>'purchase_entry.php');
                            $purchase_balance =1; 
                            $stock_remove = 1;
                            $stock_update = 1;
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $purchase_update_id);
                        }							
                    }
                }
                if(!empty($purchase_balance) && $purchase_balance == 1) {
                    $bill_company_id = $GLOBALS['bill_company_id']; $bill_id = $purchase_entry_id; $bill_date = $purchase_entry_date;$credit  = 0; $debit = 0; $bill_type ="Purchase Entry";$bill_number = $purchase_entry_number; $party_name ="";  $payment_mode_id = $GLOBALS['null_value']; $payment_mode_name = $GLOBALS['null_value'];$bank_id =  $GLOBALS['null_value'];$bank_name =  $GLOBALS['null_value']; $open_balance_type = "Credit"; $payment_tax_type = $GLOBALS['null_value'];


                    $credit  = $total_amount; 
                    
                    if(empty($credit)){
                        $credit = 0;
                    }
                    if(empty($debit)){
                        $debit = 0;
                    }
                    if(empty($opening_balance)){
                        $opening_balance = 0;
                    }
                    if(empty($opening_balance_type)){
                        $opening_balance_type = $GLOBALS['null_value'];
                    }
                    if(!empty($party_id)){
                        $party_name = $obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$party_id,'party_name');
                        $party_type = $obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$party_id,'party_type');
                        // if($party_type == '1') {
                        //     $party_type = "Purchase Party";
                        // } else if($party_type == '2') {
                        //     $party_type = "Customer Party";
                        // } else {
                        //     $party_type = "Both";
                        // }
                    }
                    $update_balance ="";
                    $update_balance = $obj->UpdateBalance($bill_company_id,$bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$GLOBALS['null_value'],$GLOBALS['null_value'],$GLOBALS['null_value'],$GLOBALS['null_value'],$opening_balance,$opening_balance_type,$credit,$debit);

                }
                if($stock_remove == '1') {
                    $prev_stock_list = array();
                    $prev_stock_list = $obj->PrevStockList($edit_id);
                    if(!empty($prev_stock_list)) {
                        foreach($prev_stock_list as $data) {
                            $stock_id = ""; 
                            if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                                $stock_id = $data['id'];
                            }
                            if(!in_array($stock_id, $stock_unique_ids)) {
                                $columns = array(); $values = array();
                                $columns = array('deleted');
                                $values = array('"1"');
                                $stock_update_id = $obj->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');                                
                                if(preg_match("/^\d+$/", $stock_update_id)) {
                                }
                            }
                        }
                    }
                }                
                if($stock_update == '1') {
                    if(!empty($purchase_entry_id) && !empty($purchase_entry_number) ) {
                        $product_ids = explode(",", $product_ids);
                        $quantity = explode(",", $quantity);
                        $unit_ids = explode(",", $unit_ids);                        
                        $store_ids = explode(",",$store_ids);
                        $index = 0;
                        for($i=0; $i < count($product_ids); $i++) {
                            $stock_update = $obj->StockUpdate($GLOBALS['purchase_entry_table'], "In", $purchase_entry_id,$purchase_entry_number, $product_ids[$i],$purchase_entry_number, $purchase_entry_date, $store_ids[$i], $unit_ids[$i], $quantity[$i],$party_id);
                        }
                    }
                }                
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }else {
            if(!empty($valid_purchase)) {
                $result = array('number' => '3', 'msg' => $valid_purchase);
            }
            else if(!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);
            }
            else if(!empty($purchase_entry_error)) {
                $result = array('number' => '2', 'msg' => $purchase_entry_error);
            }
            else if(!empty($payment_error)) {
                $result = array('number' => '2', 'msg' => $payment_error);   
            }else if(!empty($valid_stock)) {
                $result = array('number' => '2', 'msg' => $valid_stock);
            }            
        }
        
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;

    }

    if(isset($_REQUEST['delete_purchase_entry_id'])) {
        $delete_purchase_entry_id = $_REQUEST['delete_purchase_entry_id'];
        $delete_purchase_entry_id = trim($delete_purchase_entry_id);
        $msg = "";
        if(!empty($delete_purchase_entry_id)) {	
            $purchase_entry_unique_id = ""; $voucher_unique_id = ""; $voucher_id = "";
            $purchase_entry_unique_id = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $delete_purchase_entry_id, 'id');
            if(preg_match("/^\d+$/", $purchase_entry_unique_id)) {
                $bill_number = "";
                $bill_number = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $delete_purchase_entry_id, 'purchase_entry_number');
            
                $action = "";
                $payment_delete = "";
                $payment_delete = $obj->DeletePurchaseInvoice($delete_purchase_entry_id);
                if($payment_delete == '1') {
                    $payment_bill_list = array(); $payment_unique_id = "";

                    $payment_bill_list = $obj->getTableRecords($GLOBALS['payment_table'], 'bill_id', $delete_purchase_entry_id,'');
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
                    $msg = $obj->UpdateSQL($GLOBALS['purchase_entry_table'], $purchase_entry_unique_id, $columns, $values, $action);


                }
                else {
                    $msg = "Can't Delete.";
                }
            }
            else {
                $msg = "Invalid Purchase";
            }
        }
        else {
            $msg = "Empty Purchase";
        }
        echo $msg;
        exit;	
    } 
    ?>