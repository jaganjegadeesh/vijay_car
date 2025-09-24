<?php 
	include("include_files.php");

    if(isset($_REQUEST['get_party_vehicle'])) {
        $party_id = $_REQUEST['get_party_vehicle'];
        $page = $_REQUEST['page'];
        if(!empty($party_id)) {
            $vehicle_list = array();
            $vehicle_list = $obj->getVehicleList($party_id,$page); ?>
            <option value = ''>Select Vehicle</option>
            <?php if(!empty($vehicle_list)) {
                foreach($vehicle_list as $list) { ?>
                    <option value="<?php if(!empty($list['vehicle_id'])){ echo $list['vehicle_id']; } ?> " data-vehicle_datails="<?php if(!empty($list['vehicle_details'])) { echo $obj->encode_decode('decrypt', $list['vehicle_details']); } ?>" <?php if(count($vehicle_list) == 1) { echo "selected"; } ?> ><?php if(!empty($list['vehicle_no'])) { echo $obj->encode_decode('decrypt', $list['vehicle_no']); } ?> </option>
                <?php }
            }
        }
    }

    if(isset($_REQUEST['product_row_vehicle_id'])) {
        $vehicle_id = $_REQUEST['product_row_vehicle_id'];
        $party_id = $_REQUEST['party_id'];
        

        $sales_list = $obj->getProductSalesData($party_id, $vehicle_id);

        if(!empty($sales_list)) {
            $index = 1;
            foreach($sales_list as $key => $list) {
                if(!empty($list['store_details'])) {?>
                    <!-- <tr>
                        <th colspan="8">
                            <?php if(!empty($list['job_card_number'])) {
                                echo $list['job_card_number'];
                            } ?>
                        </th>
                    </tr> -->
                    <?php foreach($list['store_details'] as $ids => $data) { 
                        if(!empty($data['store_entry_number'])) { ?>
                            <tr>
                                <th colspan="8" class="text-center">
                                    <?php echo $data['store_entry_number']; ?>
                                </th>
                            </tr>
                        <?php } 
                        if(!empty($data['store_id']) && $data['store_id'] != $GLOBALS['null_value']) {
                                $store_store_ids = $data['store_id'];
                            }
                            if(!empty($data['store_name']) && $data['store_name'] != $GLOBALS['null_value']) {
                                $store_store_names = $data['store_name'];
                            }          
                            if(!empty($data['store_type']) && $data['store_type'] != $GLOBALS['null_value']) {
                                $store_type = $data['store_type'];
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
                            if(!empty($data['hsn_code']) && $data['hsn_code'] != $GLOBALS['null_value']) {
                                $hsn_codes = $data['hsn_code'];
                                $hsn_codes = explode(",", $hsn_codes);
                                $hsn_codes = array_reverse($hsn_codes);
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
                            if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                                $quantity = $data['quantity'];
                                $quantity = explode(",", $quantity);
                                $quantity = array_reverse($quantity);
                            }
                            $total_qty = 0;
                            if(!empty($product_ids)) {
                                for($i=0; $i < count($product_ids); $i++) {    
                                    ?>
                                    <tr class="product_row" id="product_row<?php  echo $index; ?>">
                                        <td class="text-center px-2 py-2 sno"><?php  echo $index; ?></td>
                                        <td class="text-center px-2 py-2 store_cover2">
                                            <input type="hidden" name="job_card_id[]" value="<?php if(!empty($list['job_card_id'])) { echo $list['job_card_id']; } ?>">
                                            <input type="hidden" name="job_card_number[]" value="<?php if(!empty($list['job_card_number'])) { echo $list['job_card_number']; } ?>">
                                            <input type="hidden" name="store_entry_id[]" value="<?php if(!empty($data['store_entry_id'])) { echo $data['store_entry_id']; } ?>">
                                            <input type="hidden" name="store_entry_number[]" value="<?php if(!empty($data['store_entry_number'])) { echo $data['store_entry_number']; } ?>">
                                            <?php
                                                $store_name = "";
                                                if(!empty($store_ids[$i])) {
                                                    $store_name = $obj->getTableColumnValue($GLOBALS['store_room_table'], 'store_room_id', $store_ids[$i], 'store_room_name');
                                                    if(!empty($store_name) && $store_name != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $store_name);
                                                    }
                                                }
                                            ?>
                                            <input type="hidden" name="store_id[]" value="<?php if(!empty($store_ids[$i])) { echo $store_ids[$i]; } ?>">
                                            <input type="hidden" name="store_name[]" value="<?php if(!empty($store_name)) { echo $store_name; } ?>">
                                        </td>

                                        <td class="text-center px-2 py-2">
                                            <?php
                                                if(!empty($product_ids[$i])) {
                                                    if(!empty($product_names[$i]) && $product_names[$i] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $product_names[$i]);
                                                    }
                                                }
                                            ?>
                                            <input type="hidden" name="product_id[]" value="<?php if(!empty($product_ids[$i])) { echo $product_ids[$i]; } ?>"><br>
                                            <input type="hidden" name="product_name[]" value="<?php if(!empty($product_names[$i])) { echo $product_names[$i]; } ?>"><br>
                                        
                                        </td>
                                        <td>
                                            <?php if(!empty($hsn_codes[$i])) {
                                                echo $obj->encode_decode('decrypt', $hsn_codes[$i]);
                                            } ?>
                                            <input type="hidden" name="hsn_code[]" value="<?php if(!empty($hsn_codes[$i])) { echo $hsn_codes[$i]; } ?>">
                                        </td>
                                        
                                        <td class="text-center px-2 py-2">
                                            <?php 

                                            if(!empty($unit_names[$i]) && $unit_names[$i] !='NULL')
                                            {
                                                echo $obj->encode_decode("decrypt",$unit_names[$i]);
                                            }
                                            ?>
                                            <input type="hidden" name="unit_id[]" class="form-control shadow-none" value="<?php if(!empty($unit_ids[$i])) { echo $unit_ids[$i]; } ?>">
                                            <input type="hidden" name="unit_name[]" class="form-control shadow-none" value="<?php if(!empty($unit_names[$i])) { echo $unit_names[$i]; } ?>" >
                                                
                                        </td>
                                        <td class="text-center px-2 py-2">
                                            <?php if(!empty($quantity[$i]))
                                            {
                                                echo $quantity[$i];
                                            } ?>
                                            <input type="hidden" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity[$i])) { echo $quantity[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:CalcTotalQuantity();">
                                        </td>
                                        <td class="tax_element <?php if($tax_option != '1'){ ?> d-none  <?php }?>">
                                            <?php if(!empty($product_ids[$i])) { 
                                                $product_tax[$i] = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'product_tax');
                                            } ?>
                                            <div class="form-group">
                                                <div class="form-label-group in-border mb-0">
                                                    <select class="select2 select2-danger" name="product_tax[]" data-dropdown-css-class="select2-danger" style="width: 100%;"  onchange="ProductRowCheck(this);ShowGST();">
                                                        <option value="">Select</option>
                                                        <option value="0%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '0'){ ?>selected<?php } } ?>>0%</option>
                                                        <option value="5%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '5'){ ?>selected<?php } } ?>>5%</option>
                                                        <option value="12%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '12'){ ?>selected<?php } } ?>>12%</option>
                                                        <option value="18%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '18'){ ?>selected<?php } } ?>>18%</option>
                                                        <option value="28%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '28'){ ?>selected<?php } } ?>>28%</option>
                                                    </select>
                                                    <label>Tax</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td>
                                            <?php if(!empty($product_ids[$i])) {
                                                $product_amount = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id', $product_ids[$i], 'product_rate');
                                                $product_amount = rtrim($product_amount);
                                            } ?>
                                            <input type="text" name="rate[]" class="form-control shadow-none" value="<?php if(!empty($product_amount)) { echo $product_amount; } ?> " onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:CalcTotalAmount();">
                                            <p class="tax_element text-success final_rate inclusiv_final_rate fw-bold d-none"><?php if(!empty($product_amount)){ echo "Final Rate : ".$product_amount; } ?></p>
                                            <input type="hidden" name="final_rate[]" class="form-control shadow-none" value="<?php if(!empty($product_amount)) { echo $product_amount; } ?> " onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:CalcTotalAmount();">
                                            <input type="hidden" name="amount[]" class="form-control shadow-none" value="" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:CalcTotalAmount();">
                                        </td>
                                        <td class="amount text-end">

                                        </td>
                                    </tr>
                                     <script type="text/javascript">
                                        if(jQuery('tr#product_row<?php if(!empty($index)) { echo $index; } ?>').find('select').length > 0) {
                                            jQuery('tr#product_row<?php if(!empty($index)) { echo $index; } ?>').find('select').select2();
                                        }
                                    </script>
                                <?php $index++; }
                            } ?>
                    <?php }
                }
            } ?>
           
        <?php }
    }