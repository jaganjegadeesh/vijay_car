<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['quotation_module'];
        }
    } 
	if(isset($_REQUEST['show_quotation_id'])) { 
        $show_quotation_id = $_REQUEST['show_quotation_id'];
        $party_list = array();
        

        $party_list = $obj->getJobCardPartyList('quotation');
        $charges_id = array(); $charges_type = array(); $charges_value = array();  $product_tax =array(); $draft =0; $discount_name = ""; $charges_tax_array = array(); $round_off =""; $round_off_type =""; $round_off_value ="";

        $quotation_date = date('Y-m-d');$quotation_bill_date = date('Y-m-d'); $current_date = date('Y-m-d');$quotation_number = "";$discount =""; $discount_value="";$charges_value=""; $amount =array(); $round_off =""; $round_off_type =""; $round_off_value =""; $store_id = array(); $store_name = array(); $product_id = array(); $product_name = array(); $product_amount = array();$discount = ""; $discount_value = "";$extra_charges = ""; $extra_charges_value = ""; $unit_id =array(); $unit_name=array(); $charges_id = array(); $draft =0; $discount_name = ""; 

        if(!empty($show_quotation_id)) {
            $quotation_list = $obj->getTableRecords($GLOBALS['quotation_table'], 'quotation_id', $show_quotation_id, '');   
            if(!empty($quotation_list)) {
                foreach($quotation_list as $data) {
                    if(!empty($data['quotation_date'])) {
                        $quotation_date = date('Y-m-d', strtotime($data['quotation_date']));
                    }
                    if(!empty($data['quotation_number']) && $data['quotation_number'] != $GLOBALS['null_value']) {
                        $quotation_number = $data['quotation_number'];
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
                    if(!empty($data['rate']) && $data['rate'] != $GLOBALS['null_value']) {
                        $rate = $data['rate'];
                        $rate = explode(",", $rate);
                        $rate = array_reverse($rate);
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
                }
            }
        }


        
        ?>
        <form class="poppins pd-20 redirection_form" name="quotation_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_quotation_id)) {  ?>
						    <div class="h5">Edit Quotation</div>
                            <?php
                        }else{ ?>
						    <div class="h5">Add Quotation</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('quotation.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_quotation_id)) { echo $show_quotation_id; } ?>">
                <div class="col-lg-2 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="quotation_date" class="form-control shadow-none" placeholder="" required="" value="<?php if(!empty($quotation_date)) { echo $quotation_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                            <label>Bill Date</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="party_id" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:HideDetails('party');GetVehicles('quotation');">
                                <?php if(!empty($show_quotation_id)) {  ?>
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
                        <a href="Javascript:ViewPartyDetails('party');" class="<?php if(empty($show_quotation_id)){?>d-none<?php }?> details_element" style="font-size: 12px;font-weight: bold;">Click to view details</a>
                    </div>    
                </div>
                <div class="col-lg-2 col-md-4 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="vehicle_id" onchange="ChangeVehicle(this)" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <?php if(!empty($show_quotation_id)) {  ?>
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
            <div class="row">    
                <div class="col-lg-12">
                    <div class="table-responsive text-center">
                        <table class="table nowrap cursor smallfnt w-100 table-bordered sales_table">
                            <thead class="bg-dark smallfnt">
                                <tr>
                                    <th>#</th>
                                    <th>Store</th>
                                    <th>Product</th>
                                    <th>HSN Code</th>
                                    <th>Unit</th>
                                    <th style="width:90px;">QTY</th>
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
                                        <td>
                                            <input type="text" name="rate[]" class="form-control shadow-none" value="<?php if(!empty($rate[$i])) { echo $rate[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:CalcTotalAmount();">
                                            
                                        </td>
                                        <td class="amount text-end">

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
                                            <input type="text"  name="charges_value[]" onkeyup="Javascript:CheckCharges();" value="<?php if(!empty($charges_value)) { echo $charges_value; } ?>" class="form-control shadow-none">
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
                    <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent(event, 'quotation_form', 'quotation_changes.php', 'quotation.php');"> Submit </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script>
                <?php if(!empty($show_quotation_id)) { ?> 
                    CalcTotalAmount();
                    CheckRoundOff('<?php echo $round_off; ?>');
                <?php } ?>
            </script>
        </form>
		<?php
    } 

    if(isset($_REQUEST['edit_id'])) {
        $quotation_date = ""; $quotation_date_error = ""; $party_id = ""; $party_id_error = "";$product_id = array(); $quantity = array(); $total_qty = array();$rates = array();  $final_rate =array(); $product_amount =array(); $product_error = ""; $product_names = array(); $amount =array();$round_off = ""; $sub_total = 0; $total_amount = 0; $unit_id = "";$unit_ids = array(); $unit_id_error ="";$charges_id = array(); $charges_names = array();
        $charges_values = array(); $charges_type = array(); $charges_total = array();  $is_discount =""; $discount_name = ""; $valid_quotation = ""; $form_name = "quotation_form"; $edit_id = ""; $discount_value =""; $discounted_total = 0;   $store_ids = array();
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        $quotation_date = $_POST['quotation_date'];
        $quotation_date = trim($quotation_date);
        $quotation_date_error = $valid->common_validation($quotation_date, 'Entry Date', '1');
        if(!empty($quotation_date_error)) {
            if(!empty($valid_quotation)) {
                $valid_quotation = $valid_quotation." ".$valid->error_display($form_name, 'quotation_date', $quotation_date_error, 'text');
            }
            else {
                $valid_quotation = $valid->error_display($form_name, 'quotation_date', $quotation_date_error, 'text');
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
            if(!empty($valid_quotation)) {
                $valid_quotation = $valid_quotation." ".$valid->error_display($form_name, 'party_id', $party_id_error, 'select');
            }
            else {
                $valid_quotation = $valid->error_display($form_name, 'party_id', $party_id_error, 'select');
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
            if(!empty($valid_quotation)) {
                $valid_quotation = $valid_quotation." ".$valid->error_display($form_name, 'vehicle_id', $vehicle_id_error, 'select');
            }
            else {
                $valid_quotation = $valid->error_display($form_name, 'vehicle_id', $vehicle_id_error, 'select');
            }
        }
        $vehicle_details = $_POST['vehicle_details'];
        $vehicle_details = trim($vehicle_details);
        $vehicle_details_error = $valid->common_validation($vehicle_details, 'Vehicle Details', '1');
        if(!empty($vehicle_details_error)) {
            if(!empty($valid_quotation)) {
                $valid_quotation = $valid_quotation." ".$valid->error_display($form_name, 'vehicle_details', $vehicle_details_error, 'text');
            }
            else {
                $valid_quotation = $valid->error_display($form_name, 'vehicle_details', $vehicle_details_error, 'text');
            }
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

        $index=0; $sub_total = 0;
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

                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $rate[$i]) && $rate[$i] <= 99999)  {
                    $amount[$i] = (float) $quantity[$i] * (float) $rate[$i];
                    $sub_total += (float) $amount[$i];

                } else {
                    $rate_error = "Invalid Rate";
                    if(!empty($rate_error)) {
                        if(!empty($valid_quotation)) {
                            $valid_quotation = $valid_quotation." ".$valid->row_error_display($form_name, 'rate[]', $rate_error, 'text','product_row', ($i+1));
                        }
                        else {
                            $valid_quotation = $valid->row_error_display($form_name, 'rate[]', $rate_error, 'text','product_row', ($i+1));
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
                            if(!empty($quotation_error)) {
                                $quotation_error = $quotation_error."<br>".$charges_error;
                            }
                            else {
                                $quotation_error = $charges_error;
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
                    if(empty($quotation_error)) {
                        $charges_total[$i] = $charges_value;
                        $total_amount += $charges_value;
                    }
                    $charges_total_amounts[] = $total_amount;
                }
                else{
                    if(!empty($charges_values[$i]))
                        {
                            $quotation_error = "Select Charges";
                        }
                        $charges_values[$i] = "";
                }
            }
        }
        $charged_total = $total_amount;   

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
                if(!empty($valid_quotation)) {
                    $valid_quotation = $valid_quotation." ".$valid->error_display($form_name, 'round_off_value', $round_off_value_error, 'text');
                }
                else {
                    $valid_quotation = $valid->error_display($form_name, 'round_off_value', $round_off_value_error, 'text');
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
        if(empty($valid_quotation) && empty($product_error) && empty($quotation_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $bill_company_id =$GLOBALS['bill_company_id'];
                $bill_company_details = "";
                if (!empty($bill_company_id)) {
                    $bill_company_details = $obj->BillCompanyDetails($bill_company_id, $GLOBALS['quotation_table']);
                }
    
                if(!empty($quotation_date)) {
                    $quotation_date = date('Y-m-d', strtotime($quotation_date));
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

                $quotation_error = "";$check_bills ="";
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
                if(!empty($round_off_value)) {
                    $value = explode('.',$round_off_value);
                    if(isset($value[1])) {
                        $round_off_value = $value[1];
                    }
                }

                if(!empty($discount_name)){
                    $discount_name = $obj->encode_decode('encrypt', $discount_name);
                }
                $mobile_number =""; $city =""; $decrypted_party_name = ""; $decrypted_mbl ="";
  
                $bill_company_id = $GLOBALS['bill_company_id']; 
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $job_update = 0;
                if(empty($edit_id)) {
                    $action = "New Quotation Created. ";
                    $null_value = $GLOBALS['null_value'];
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'bill_company_details', 'quotation_id', 'quotation_number', 'quotation_date','party_id', 'party_name_mobile_city', 'party_details','vehicle_id','vehicle_number','vehicle_details','job_card_id','job_card_number','store_entry_id','store_entry_number','store_id','store_name','product_id', 'product_name', 'hsn_code', 'quantity', 'unit_id' ,'unit_name' ,'rate','amount', 'sub_total', 'discount', 'discount_value', 'discounted_total',  'charges_name','charges',  'charges_value','charges_total','round_off', 'total_amount', 'round_off_type' , 'round_off_value', 'discount_name', 'deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'",  "'".$null_value."'", "'".$null_value."'", "'".$quotation_date."'","'".$party_id."'", "'".$party_name_mobile_city."'", "'".$party_details."'","'".$vehicle_id."'","'".$vehicle_number."'","'".$vehicle_details."'","'".$job_card_id."'","'".$job_card_number."'","'".$store_entry_id."'","'".$store_entry_number."'","'".$store_id."'","'".$store_name."'","'".$product_id."'", "'".$product_name."'","'".$hsn_code."'","'".$quantity."'", "'".$unit_id."'","'".$unit_name."'","'".$rate."'","'".$amount."'","'".$sub_total."'", "'".$discount."'", "'".$discount_value."'" , "'".$discounted_total."'",   "'".$charges_id."'",  "'".$charges_values."'", "'".$charges_total."'","'".$charged_total."'","'".$round_off."'", "'".$total_amount."'", "'".$round_off_type."'", "'".$round_off_value."'", "'".$discount_name."'", "'0'");

                    $quotation_insert_id = $obj->InsertSQL($GLOBALS['quotation_table'], $columns, $values,'quotation_id','quotation_number',$action);
        
                    if(preg_match("/^\d+$/", $quotation_insert_id)) {
                        $quotation_id = $obj->getTableColumnValue($GLOBALS['quotation_table'],'id',$quotation_insert_id,'quotation_id');
                        $quotation_number = $obj->getTableColumnValue($GLOBALS['quotation_table'],'id',$quotation_insert_id,'quotation_number');
                        $quotation_balance =1;
                        $job_update = 1;
                        $result = array('number' => '1', 'msg' => 'Quotation Entry Successfully Created','redirection_page' =>'quotation.php');					
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $quotation_insert_id);
                    }
                } else {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['quotation_table'], 'quotation_id', $edit_id, 'id');
                    $quotation_number = $obj->getTableColumnValue($GLOBALS['quotation_table'], 'quotation_id', $edit_id, 'quotation_number');
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "Quotation Entry Updated. Bill No. - ".$quotation_number;

                        $columns = array(); $values = array();						
                        $columns = array('creator_name','bill_company_id', 'bill_company_details', 'quotation_date','party_id', 'party_name_mobile_city', 'party_details','vehicle_id','vehicle_number','vehicle_details','job_card_id','job_card_number','store_entry_id','store_entry_number','store_id','store_name','product_id', 'product_name', 'hsn_code', 'quantity', 'unit_id' ,'unit_name' ,'rate','amount', 'sub_total', 'discount', 'discount_value', 'discounted_total',  'charges_name','charges',  'charges_value','charges_total','round_off', 'total_amount', 'round_off_type' , 'round_off_value', 'discount_name');
                        $values = array("'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'", "'".$quotation_date."'","'".$party_id."'", "'".$party_name_mobile_city."'", "'".$party_details."'","'".$vehicle_id."'","'".$vehicle_number."'","'".$vehicle_details."'","'".$job_card_id."'","'".$job_card_number."'","'".$store_entry_id."'","'".$store_entry_number."'","'".$store_id."'","'".$store_name."'","'".$product_id."'", "'".$product_name."'","'".$hsn_code."'","'".$quantity."'", "'".$unit_id."'","'".$unit_name."'","'".$rate."'","'".$amount."'","'".$sub_total."'", "'".$discount."'", "'".$discount_value."'" , "'".$discounted_total."'",   "'".$charges_id."'",  "'".$charges_values."'", "'".$charges_total."'","'".$charged_total."'","'".$round_off."'", "'".$total_amount."'", "'".$round_off_type."'", "'".$round_off_value."'", "'".$discount_name."'");
                        
                        $quotation_update_id = $obj->UpdateSQL($GLOBALS['quotation_table'], $getUniqueID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $quotation_update_id)) {
                            $quotation_id = $edit_id;
                            $quotation_number = $obj->getTableColumnValue($GLOBALS['quotation_table'], 'quotation_id', $edit_id, 'quotation_number');
                            $result = array('number' => '1', 'msg' => 'Updated Successfully','redirection_page' =>'quotation.php');
                            $quotation_balance =1; 
                            $stock_remove = 1;
                            $job_update = 1;
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $quotation_update_id);
                        }							
                    }
                }

                if($job_update == 1) {
                    $job_card_id = explode(',',$job_card_id);
                    $job_card_id = array_filter(array_unique($job_card_id));
                    $columns = array('quotation_status','quotation_id');
                    $values =array("'Q'","'".$quotation_id."'");
                    $action = "Updated Quotation. Bill No. - ".$quotation_number;
                    foreach($job_card_id as $job) {
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['job_card_table'],'job_card_id',$job,'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $job_card_update_id = $obj->UpdateSQL($GLOBALS['job_card_table'], $getUniqueID, $columns, $values, $action);
                        }
                    }

                }
            } else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        } else {
            if(!empty($valid_quotation)) {
                $result = array('number' => '3', 'msg' => $valid_quotation);
            }
            else if(!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);
            }
            else if(!empty($quotation_error)) {
                $result = array('number' => '2', 'msg' => $quotation_error);
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
        $total_records_list = $obj->getSalesList($from_date, $to_date,$show_bill,$party_id, 'quotation');
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['quotation_number']), $search_text) !== false) ) {
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
                                        if(!empty($list['quotation_date'])) {
                                            echo date('d-m-Y', strtotime($list['quotation_date']));
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['quotation_number']) && $list['quotation_number'] != $GLOBALS['null_value']) {
                                            echo $list['quotation_number'];
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
                                                <a class="dropdown-item" style="cursor:pointer;"  target="_blank" href="reports/rpt_quotation_a4.php?view_quotation_id=<?php if(!empty($list['quotation_id'])) { echo $list['quotation_id']; } ?>"><i class="fa fa-print"></i>&ensp;Print</a>
                                            </li>
                                            <?php 
                                                if(empty($edit_access_error) && $list['deleted'] == '0') {
                                                    ?>
                                                    <li>
                                                        <a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['quotation_id'])) { echo $list['quotation_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a>
                                                    </li>
                                                    <?php
                                                } 
                                            ?>  
                                                <?php 
                                                if(empty($delete_access_error) && $list['deleted'] == '0') {
                                                    ?>
                                                        <li>
                                                            <a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['quotation_id'])) { echo $list['quotation_id']; } ?>');"><i class="fa fa-trash"></i> &ensp;  Delete</a>
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


    if(isset($_REQUEST['delete_quotation_id'])) {
        $delete_quotation_id = $_REQUEST['delete_quotation_id'];
        $delete_quotation_id = trim($delete_quotation_id);
        $msg = "";
        if(!empty($delete_quotation_id)) {	
            $quotation_unique_id = ""; $voucher_unique_id = ""; $voucher_id = "";
            $quotation_unique_id = $obj->getTableColumnValue($GLOBALS['quotation_table'], 'quotation_id', $delete_quotation_id, 'id');
            if(preg_match("/^\d+$/", $quotation_unique_id)) {
                $bill_number = "";
                $bill_number = $obj->getTableColumnValue($GLOBALS['quotation_table'], 'quotation_id', $delete_quotation_id, 'quotation_number');
            
                $action = "Delete Quotation";
                $columns = array(); $values = array();			
                $columns = array('deleted');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['quotation_table'], $quotation_unique_id, $columns, $values, $action);
                $columns = array(); $values = array();			
                $obj->RevoteJobCard('quotation',$delete_quotation_id);
            }
            else {
                $msg = "Invalid Quotation";
            }
        }
        else {
            $msg = "Empty Quotation";
        }
        echo $msg;
        exit;	
    } 
    ?>