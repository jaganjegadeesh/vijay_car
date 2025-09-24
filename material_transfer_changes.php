<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['material_transfer_module'];
        }
    }   
	if(isset($_REQUEST['show_material_transfer_id'])) {
        
        $show_material_transfer_id = $_REQUEST['show_material_transfer_id'];
        $show_material_transfer_id = trim($show_material_transfer_id);
        $material_transfer_date = date('Y-m-d'); $current_date = date('Y-m-d');$material_transfer_number = "";$from_location_ids = "";$from_location_names = "";$to_location_ids = "";$to_location_names = "";$item_ids = array();$item_names = array();$subunit_contains = array();$unit_id = "";$unit_names = array();$quantity = array();$total_quantity = array();$unit_ids = array();  $total_qty =0 ;
        $stock_adjustment_list = array();
        $from_store_ids = $to_store_ids = "";
        $stock_adjustment_list = $obj->getTableRecords($GLOBALS['material_transfer_table'], 'material_transfer_id', $show_material_transfer_id, '');
        if(!empty($stock_adjustment_list)) {
            foreach($stock_adjustment_list as $data) {
                if(!empty($data['from_location_id'])) {
                    $from_store_ids = $data['from_location_id'];
                }
                if(!empty($data['to_location_id'])) {
                    $to_store_ids = $data['to_location_id'];
                }                
                if(!empty($data['material_transfer_date'])) {
                    $material_transfer_date = date('Y-m-d', strtotime($data['material_transfer_date']));
                }
                if(!empty($data['material_transfer_number']) && $data['material_transfer_number'] != $GLOBALS['null_value']) {
                    $material_transfer_number = $data['material_transfer_number'];
                }

                if(!empty($data['store_name'])) {
                    $store_names = explode(",", $data['store_name']);
                }
                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                    $product_ids = $data['product_id'];
                    $product_ids = explode(",", $product_ids);
                    $product_count = count($product_ids);
                    $product_ids = array_reverse($product_ids);
                }
                if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                    $unit_ids = $data['unit_id'];
                    $unit_ids = explode(",", $unit_ids);
                    $unit_ids = array_reverse($unit_ids);
                }
                if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                    $product_names = $data['product_name'];
                    $product_names = explode(",", $product_names);
                    $product_names = array_reverse($product_names);
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
                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                    $remarks = $obj->encode_decode('decrypt', $data['remarks']);
                }
            }
        }
        $store_list = array();
        $store_list = $obj->getTableRecords($GLOBALS['store_room_table'], '', '', '');
        ?>
        <form class="poppins pd-20 redirection_form" name="material_transfer_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<?php if(!empty($show_material_transfer_id)) { ?>
	    					<div class="h5">Edit Material Transfer</div>
                        <?php }
						else { ?>
    						<div class="h5">Add Material Transfer</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('material_transfer.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_material_transfer_id)) { echo $show_material_transfer_id; } ?>">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-md-3 col-6 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="date" class="form-control shadow-none" name="material_transfer_date" value="<?php if(!empty($material_transfer_date)) { echo $material_transfer_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>" placeholder="" required="">
                                    <label>Date</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-2 col-md-3 col-6 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="from_store_id" id="from_store_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:show_to_store(this.value);" <?php if(!empty($show_material_transfer_id)){ echo "disabled"; } ?>>
                                        <option value="">Select From store</option>
                                        <?php
                                            if(!empty($store_list)) {
                                                foreach ($store_list as $data) {
                                                    if(!empty($data['store_room_id']) && $data['store_room_id'] != $GLOBALS['null_value']) {
                                                        ?>
                                                        <option value="<?php echo $data['store_room_id']; ?>" <?php if(!empty($from_store_ids) && $from_store_ids == $data['store_room_id']) { ?>selected<?php } ?>>
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
                                    <label>Select From Store</label>
                                </div>
                            </div>       
                        </div>
                        <input type="hidden" name='from_store' id='from_store' value='<?php if(!empty($from_store_ids)){ echo $from_store_ids; }?>'>
                        <div class="col-lg-2 col-md-3 col-6 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="to_store_id" data-dropdown-css-class="select2-danger" style="width: 100%;" <?php if(!empty($show_material_transfer_id)){ echo "disabled"; } ?>>
                                        <option value="">Select To store</option>
                                            <?php 
                                                if(!empty($store_list)) {
                                                    foreach ($store_list as $data) {
                                                        if(!empty($data['store_room_id']) && $data['store_room_id'] != $GLOBALS['null_value']) { ?>
                                                            <option value="<?php echo $data['store_room_id']; ?>" <?php if(!empty($to_store_ids) && $to_store_ids == $data['store_room_id']) { ?>selected<?php } ?>>
                                                                <?php
                                                                    if(!empty($data['store_room_name']) && $data['store_room_name'] != $GLOBALS['null_value']) {
                                                                        echo $obj->encode_decode('decrypt', $data['store_room_name']);
                                                                    }
                                                                ?>
                                                            </option>
                                                            <?php 
                                                        }
                                                    } 
                                                } ?>
                                    </select>
                                    <label>Select To Store</label>
                                </div>
                            </div>        
                        </div>
                        <input type="hidden" name='to_store' id='to_store' value='<?php if(!empty($to_store_ids)){ echo $to_store_room_ids; }?>'>
                        <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <textarea class="form-control" id="remarks" name="remarks" onkeydown="Javascript:KeyboardControls(this,'',150,'1');" placeholder="Remarks"><?php if(!empty($remarks)) { echo $remarks; } ?></textarea>
                                    <label>Remarks</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center pt-3">
                        <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="selected_product_id" id="selected_product_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="getUnit(this);">
                                        <option value="">Select Product</option>
                                        
                                    </select>
                                    <label>Select Product Name</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" name="selected_quantity" id="selected_quantity" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" required="" >
                                    <label>QTY</label>
                                </div>
                                <span class="text-danger current_stock_span"></span>
                            </div> 
                        </div>
                        <input type="hidden" name="current_stock" class="form-control shadow-none" value="">
                        <div class="col-lg-2 col-md-3 col-6 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="selected_unit_id" id="selected_unit_id">
                                        <option value="">Select Unit</option>
                                    </select>
                                    <label>Select Unit</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-1 col-md-3 col-12 text-center py-2 px-lg-1">
                            <button class="btn btn-danger add_products_button" style="font-size:12px;" type="button" onclick="Javascript:AddStockProducts('material_transfer_form');">
                                Add
                            </button>
                        </div> 
                    </div>
                    <div class="row justify-content-center"> 
                        <div class="col-lg-8">
                            <div class="table-responsive text-center">
                                <input type="hidden" name="product_count" value="<?php if(!empty($product_count)) { echo $product_count; } else { echo '0'; } ?>">                                
                                <table class="table nowrap cursor smallfnt table-bordered stock_adjustment_table">
                                    <thead class="bg-dark smallfnt">
                                        <tr style="white-space:pre;">
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th style="width: 150px;">Qty</th>
                                            <th>Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                            if(!empty($product_ids)) {                                                
                                                for($i=0; $i < count($product_ids); $i++) {
                                                    ?>
                                                        <tr class="product_row" id="product_row<?php if(!empty($product_count)) { echo $product_count; } ?>">
                                                            <td class="sno"><?php if(!empty($product_count)) { echo $product_count; } ?></td>
                                                            <td>
                                                                <?php
                                                                    if(!empty($product_ids[$i])) {
                                                                        $product_name = "";
                                                                        $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');
                                                                        if(!empty($product_name) && $product_name != $GLOBALS['null_value']) {
                                                                            echo $obj->encode_decode('decrypt', $product_name);
                                                                        }
                                                                    }
                                                                ?>
                                                                <input type="hidden" name="product_id[]" value="<?php if(!empty($product_ids[$i])) { echo $product_ids[$i]; } ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity[$i])) { echo $quantity[$i]; }else{
                                                                    echo "0";
                                                                } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:CalcTotalQuantity();" style="width: 100px;">
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if(!empty($unit_ids[$i])) {
                                                                        $unit_name = "";
                                                                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
                                                                        if(!empty($unit_name) && $unit_name != $GLOBALS['null_value']) {
                                                                            echo $obj->encode_decode('decrypt', $unit_name);
                                                                        }
                                                                    }
                                                                ?>
                                                                <input type="hidden" name="unit_id[]" value="<?php if(!empty($unit_ids[$i])) { echo $unit_ids[$i]; } ?>">
                                                            </td>
                                                            
                                                            <td>
                                                                <?php
                                                                $current_inward_stock = 0; $current_outward_stock = 0; $current_unit_stock = 0;
                                                                $current_inward_stock = $obj->getInwardQty($show_material_transfer_id,$to_store_ids,$product_ids[$i],$unit_ids[$i]);
                                                                $current_outward_stock = $obj->getOutwardQty($show_material_transfer_id,$to_store_ids,$product_ids[$i],$unit_ids[$i]);
                                                                if($current_inward_stock >= $current_outward_stock) {
                                                                     ?>
                                                                        <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('<?php if(!empty($product_count)) { echo $product_count; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>                                                                    
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
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-right h6 subtotal_amount"> Total : </td>
                                            <td class="text-right h6 total_qty"><?php echo $total_qty; ?></td>     
                                            <td></td>                               
                                            <td></td>                               
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 py-3 text-center">
                            <button class="btn btn-danger" type="button" onClick="Javascript:SaveModalContent(event,'material_transfer_form', 'material_transfer_changes.php', 'material_transfer.php');">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>     
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script>
                <?php if(!empty($show_material_transfer_id)) { ?>
                    CalcTotalQuantity(); GetStoreProduct();
                <?php } ?>
            </script>
        </form>
	<?php
    } 

    if(isset($_POST['edit_id'])){
        $stock_adjustment_date = ""; $stock_adjustment_date_error = "";
        $store_id = ""; $store_id_error = ""; $product_ids = array();
        $unit_ids = array(); $quantity = array(); $stock_action = array();
        $remarks = ""; $remarks_error = ""; $product_error = "";$product_names = array(); $unit_names = array(); 
        $stock_unique_ids = array(); $store_ids = array(); $store_names = array();
        $valid_stock_adjustment = ""; $form_name = "material_transfer_form"; $edit_id = ""; 
        $stock_adjustment_number = "";$stock_adjustment_id=""; 

        $from_store_id = ""; $from_store_id_error = "";$to_store_id = ""; $to_store_id_error = "";

        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
   
        if(isset($_POST['material_transfer_date'])) {
            $stock_adjustment_date = $_POST['material_transfer_date'];
            $stock_adjustment_date = trim($stock_adjustment_date);
            $stock_adjustment_date_error = $valid->valid_date($stock_adjustment_date, 'Date', '1');
            if(!empty($stock_adjustment_date_error)) {
                if(!empty($valid_stock_adjustment)) {
                    $valid_stock_adjustment = $valid_stock_adjustment." ".$valid->error_display($form_name, 'stock_adjustment_date', $stock_adjustment_date_error, 'text');
                }
                else {
                    $valid_stock_adjustment = $valid->error_display($form_name, 'stock_adjustment_date', $stock_adjustment_date_error, 'text');
                }
            }
        }
        if(isset($_POST['remarks'])) {
            $remarks = $_POST['remarks'];
            $remarks = trim($remarks);
            if(!empty($remarks)) {
                $remarks_error = $valid->common_validation($remarks, 'Remarks', '0');
            }
        }
        if(!empty($remarks_error)) {
            if(!empty($valid_stock_adjustment)) {
                $valid_stock_adjustment = $valid_stock_adjustment." ".$valid->error_display($form_name, 'remarks', $remarks_error, 'textarea');
            }
            else {
                $valid_stock_adjustment = $valid->error_display($form_name, 'remarks', $remarks_error, 'textarea');
            }
        }
        if(empty($edit_id)){
            if(isset($_POST['from_store_id'])) {
                $from_store_id = $_POST['from_store_id'];
                $from_store_id = trim($from_store_id);
                $from_store_id_error = $valid->common_validation($from_store_id, 'From store', 'select');
                if(empty($from_store_id_error)) {
                    $from_store_unique_id = "";
                    $from_store_unique_id = $obj->getTableColumnValue($GLOBALS['store_table'], 'store_id', $from_store_id, 'id');
                    if(!preg_match("/^\d+$/", $from_store_unique_id)) {
                        $from_store_id_error = "Invalid From store";
                    }
                }
                if(!empty($from_store_id_error)) {
                    if(!empty($valid_stock_adjustment)) {
                        $valid_stock_adjustment = $valid_stock_adjustment." ".$valid->error_display($form_name, 'from_store_id', $from_store_id_error, 'select');
                    }
                    else {
                        $valid_stock_adjustment = $valid->error_display($form_name, 'from_store_id', $from_store_id_error, 'select');
                    }
                }
            }
        }
        
        if(empty($from_store_id)){
            if(isset($_POST['from_store'])) {
                $from_store_id = $_POST['from_store'];
                $from_store_id = trim($from_store_id);
            }
        }

        if(empty($edit_id)){
            if(isset($_POST['to_store_id'])) {
                $to_store_id = $_POST['to_store_id'];
                $to_store_id = trim($to_store_id);
                $to_store_id_error = $valid->common_validation($to_store_id, 'To store', 'select');
                if(empty($to_store_id_error)) {
                    $from_store_unique_id = "";
                    $from_store_unique_id = $obj->getTableColumnValue($GLOBALS['store_room_table'], 'store_room_id', $to_store_id, 'id');
                    if(!preg_match("/^\d+$/", $from_store_unique_id)) {
                        $to_store_id_error = "Invalid To store";
                    }
                }
                if(!empty($to_store_id_error)) {
                    if(!empty($valid_stock_adjustment)) {
                        $valid_stock_adjustment = $valid_stock_adjustment." ".$valid->error_display($form_name, 'to_store_id', $to_store_id_error, 'select');
                    }
                    else {
                        $valid_stock_adjustment = $valid->error_display($form_name, 'to_store_id', $to_store_id_error, 'select');
                    }
                }
            }
        }
       
        if(empty($to_store)){
            if(isset($_POST['to_store'])) {
                $to_store_id = $_POST['to_store'];
                $to_store_id = trim($to_store_id);
            }
        }
        if(isset($_POST['product_id'])) {
            $product_ids = $_POST['product_id'];
            $product_ids = array_reverse($product_ids);
        }
        if(isset($_POST['unit_id'])) {
            $unit_ids = $_POST['unit_id'];
            $unit_ids = array_reverse($unit_ids);
        }
        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
            $quantity = array_reverse($quantity);
        }
        if(isset($_POST['stock_action'])) {
            $stock_action = $_POST['stock_action'];
            $stock_action = array_reverse($stock_action);
        }

        $stock_error = 0; $valid_stock = "";
        if(!empty($product_ids)) {
            for($i=0; $i < count($product_ids); $i++) {
                $product_ids[$i] = trim($product_ids[$i]);
                $product_unique_id = "";
                $product_unique_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'id');
                if(preg_match("/^\d+$/", $product_unique_id)) {
                    $product_name = "";
                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');
                    $product_names[$i] = $product_name;
                                          
                    $unit_ids[$i] = trim($unit_ids[$i]);
                    if(!empty($unit_ids[$i])) {
                        $unit_unique_id = "";
                        $unit_unique_id = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'id');
                        if(preg_match("/^\d+$/", $unit_unique_id)) {
                            $unit_name = "";
                            $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
                            $unit_names[$i] = $unit_name;
                            $quantity[$i] = trim($quantity[$i]);
                            if(!empty($quantity[$i])) {
                                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $quantity[$i]) && $quantity[$i] <= 99999999) {
                                    if(!empty($edit_id)){
                                            $stock_unique_ids[$i] = $obj->getStockUniqueID($edit_id,$from_store_id, $product_ids[$i], $unit_ids[$i]);
                                            $stock_unique_ids[$i] = $obj->getStockUniqueID($edit_id,$to_store_id, $product_ids[$i], $unit_ids[$i]);                                                
                                        }                                                                                                        

                                        $current_inward_stock = 0; $current_outward_stock = 0; $current_unit_stock = 0;
                                        $current_inward_stock = $obj->getInwardQty($edit_id,$from_store_id,$product_ids[$i],$unit_ids[$i] );
                                        $current_outward_stock = $obj->getOutwardQty($edit_id,$from_store_id,$product_ids[$i],$unit_ids[$i]);                                                            
                                        // echo $current_inward_stock;
                                        // echo "|||";
                                        // echo $current_outward_stock;
                                        // echo "---";
                                        $current_outward_stock += $quantity[$i];                                             
                                        $current_unit_stock = $current_inward_stock - $current_outward_stock;      
                                        // echo $current_unit_stock;           
                                        // echo "___";                                   
                                        if($current_unit_stock < 0) {
                                            $valid_stock = "Stock goes to Negative for ".($obj->encode_decode('decrypt', $product_name)). " Unit => ". $obj->encode_decode('decrypt',$unit_names[$i]) . " Stock => ".$current_unit_stock;
                                            $stock_error = 1;                                                                
                                        }                                                                                                                


                                        $current_inward_stock = 0; $current_outward_stock = 0; $current_unit_stock = 0;
                                        $current_inward_stock = $obj->getInwardQty($edit_id,$to_store_id,$product_ids[$i],$unit_ids[$i]);
                                        $current_outward_stock = $obj->getOutwardQty($edit_id,$to_store_id,$product_ids[$i],$unit_ids[$i]);                                                            
                                        // echo $current_inward_stock;
                                        // echo "|||";
                                        // echo $current_outward_stock;
                                        // echo "---";                                            
                                        $current_inward_stock += $quantity[$i];                                             
                                        $current_unit_stock = $current_inward_stock - $current_outward_stock;   
                                        // echo $current_unit_stock;                                                                                                                                           
                                        if($current_unit_stock < 0) {
                                            $valid_stock = "Stock goes to Negative for ".($obj->encode_decode('decrypt', $product_name)). " Brand => ". $obj->encode_decode('decrypt',$brand_names[$i]) . " Stock => ".$current_unit_stock;
                                            $stock_error = 1;                                                                
                                        } 
                                        }
                                else {
                                    $product_error = "Invalid Quantity";

                                    if(!empty($valid_stock_adjustment)) {
                                        $valid_stock_adjustment = $valid_stock_adjustment." ".$valid->row_error_display($form_name, "quantity[]", $product_error, 'text', 'product_row', ($i+1));
                                    }
                                    else {
                                        $valid_stock_adjustment = $valid->row_error_display($form_name, "quantity[]", $product_error, 'text', 'product_row', ($i+1));
                                    }
                                }
                            }
                            else {
                                $quantity[$i] = 0;
                                $total_qty += 0;
                               
                            }
                        }
                        else {
                            $product_error = "Invalid Unit in Product - ".($obj->encode_decode('decrypt', $product_name));
                        }
                    }
                    else {
                        $product_error = "Empty Unit in Product - ".($obj->encode_decode('decrypt', $product_name));
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

        if(empty($valid_stock_adjustment) && empty($product_error) && empty($stock_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $bill_company_id =$GLOBALS['bill_company_id'];
                $bill_company_details = "";
                if (!empty($bill_company_id)) {
                    $bill_company_details = $obj->BillCompanyDetails($bill_company_id, $GLOBALS['purchase_entry_table']);
                }

                $from_store_name ="";
                if(!empty($from_store_id)) {
                    $from_store_name = $obj->getTableColumnValue($GLOBALS['store_room_table'], 'store_room_id', $from_store_id, 'store_room_name');
                }
                else {
                    $from_store_id = $GLOBALS['null_value'];
                    $from_store_name = $GLOBALS['null_value'];
                }

                $to_store_name ="";
                if(!empty($to_store_id)) {
                    $to_store_name = $obj->getTableColumnValue($GLOBALS['store_room_table'], 'store_room_id', $to_store_id, 'store_room_name');
                }
                else {
                    $to_store_id = $GLOBALS['null_value'];
                    $to_store_name = $GLOBALS['null_value'];
                }
                
                if(empty($stock_adjustment_number)) {
                    $stock_adjustment_number = $GLOBALS['null_value'];
                }
                if(!empty($stock_adjustment_date)) {
                    $stock_adjustment_date = date('Y-m-d', strtotime($stock_adjustment_date));
                }
                if(!empty($product_ids)) {
                    // $product_ids = array_reverse($product_ids);
                    $product_ids = implode(",", $product_ids);
                }
                if(!empty($product_names)) {
                    // $product_names = array_reverse($product_names);
                    $product_names = implode(",", $product_names);
                }
                if(!empty($unit_ids)) {
                    // $unit_ids = array_reverse($unit_ids);
                    $unit_ids = implode(",", $unit_ids);
                }
                if(!empty($unit_names)) {
                    // $unit_names = array_reverse($unit_names);
                    $unit_names = implode(",", $unit_names);
                }
                if(!empty($quantity)) {
                    // $quantity = array_reverse($quantity);
                    $quantity = implode(",", $quantity);
                }
                if(!empty($store_ids)) {
                    // $store_ids = array_reverse($store_ids);
                    $store_ids = implode(",", $store_ids);
                }
                if(!empty($store_names)) {
                    // $store_names = array_reverse($store_names);
                    $store_names = implode(",", $store_names);
                }
                if(!empty($remarks)) {
                    $remarks = $obj->encode_decode('encrypt', $remarks);
                }else{
                    $remarks = $GLOBALS['null_value'];
                }

                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $balance =0    ;$stock_update=0;$stock_remove=0;

                if(empty($edit_id)) {
                    $action = "";
                    if(!empty($purchase_entry_number)) {
                        $action = "Material Transfer";
                    }
                    $null_value = $GLOBALS['null_value'];
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'bill_company_details', 'material_transfer_id', 'material_transfer_number', 'material_transfer_date','from_location_id','from_location_name','to_location_id','to_location_name','product_id','product_name','unit_id','unit_name','quantity','remarks','deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'",  "'".$null_value."'", "'".$null_value."'", "'".$stock_adjustment_date."'","'".$from_store_id."'","'".$from_store_name."'","'".$to_store_id."'","'".$to_store_name."'","'".$product_ids."'","'".$product_names."'","'".$unit_ids."'","'".$unit_names."'","'".$quantity."'","'".$remarks."'","'0'");

                    $purchase_insert_id = $obj->InsertSQL($GLOBALS['material_transfer_table'], $columns, $values,'material_transfer_id','material_transfer_number',$action);
        
                    if(preg_match("/^\d+$/", $purchase_insert_id)) {
                        $stock_update = 1;
                        $stock_adjustment_id = $obj->getTableColumnValue($GLOBALS['material_transfer_table'],'id',$purchase_insert_id,'material_transfer_id');
                        $stock_adjustment_number = $obj->getTableColumnValue($GLOBALS['material_transfer_table'],'material_transfer_id',$stock_adjustment_id,'material_transfer_number');                        
                        $result = array('number' => '1', 'msg' => 'Material Transfer Successfully Created');            
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $purchase_insert_id);
                    }
                }
                else
                {
                    $getMaterialTransferID = "";
                    $stock_adjustment_id = $obj->getTableColumnValue($GLOBALS['material_transfer_table'], 'material_transfer_id', $edit_id, 'material_transfer_id');
                    $stock_adjustment_number = $obj->getTableColumnValue($GLOBALS['material_transfer_table'], 'material_transfer_id', $edit_id, 'material_transfer_number');
                    $getMaterialTransferID = $obj->getTableColumnValue($GLOBALS['material_transfer_table'], 'material_transfer_id', $edit_id, 'id');

                    if(preg_match("/^\d+$/", $getMaterialTransferID)) {
                        $action = "Material Transfer Updated. Ref No. - " . $stock_adjustment_number;

                        $columns = array(
                            'created_date_time', 'creator', 'creator_name', 'bill_company_id', 'bill_company_details', 
                            'material_transfer_date', 'product_id', 'product_name', 'unit_id', 'unit_name','quantity','remarks'
                        );

                        $values = array(
                            "'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$bill_company_details."'", "'".$stock_adjustment_date."'", 
                            "'".$product_ids."'", "'".$product_names."'", "'".$unit_ids."'", "'".$unit_names."'", 
                            "'".$quantity."'","'".$remarks."'"
                        );

                        $update_id = $obj->UpdateSQL($GLOBALS['material_transfer_table'], $getMaterialTransferID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $update_id)) {
                            $stock_update = 1; $stock_remove = 1;                           
                            $result = array('number' => '1', 'msg' => 'Material Transfer Updated Successfully', 'redirection_page' => 'material_transfer.php');
                        } else {
                            $result = array('number' => '2', 'msg' => $update_id);
                        }
                    }
                }
                if($stock_remove == "1"){
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
                    if(!empty($stock_adjustment_id) && !empty($stock_adjustment_number) ) {
                        $product_ids = explode(",", $product_ids);
                        $quantity = explode(",", $quantity);
                        $unit_ids = explode(",", $unit_ids);                        
                        $index = 0;
                        for($i=0; $i < count($product_ids); $i++) {
                            if(!empty($from_store_id)) {                                                                    
                                $stock_update = $obj->StockUpdate($GLOBALS['material_transfer_table'], "Out", $stock_adjustment_id,$stock_adjustment_number, $product_ids[$i],$stock_adjustment_number, $stock_adjustment_date, $from_store_id, $unit_ids[$i], $quantity[$i],'');                                        
                            }
                            if(!empty($to_store_id)) {
                                $stock_update = $obj->StockUpdate($GLOBALS['material_transfer_table'], "In", $stock_adjustment_id,$stock_adjustment_number, $product_ids[$i],$stock_adjustment_number, $stock_adjustment_date, $to_store_id, $unit_ids[$i], $quantity[$i],'');
                            }
                        }
                    }
                }                
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }            
        }
        else {
            if(!empty($valid_stock_adjustment)) {
                $result = array('number' => '3', 'msg' => $valid_stock_adjustment);
            }
            else if(!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);
            }
            else if(!empty($valid_stock)) {
                $result = array('number' => '2', 'msg' => $valid_stock);
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
        $from_date = ""; $to_date = ""; $search_text = "";
        $show_bill = 0;$from_store ="";$to_store ="";$show_draft_bill = 0;
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }
        if(isset($_POST['show_bill'])) {
            $show_bill = $_POST['show_bill'];
        }
        if(isset($_POST['from_store_id'])) {
            $from_store = $_POST['from_store_id'];
        }
        if(isset($_POST['to_store_id'])) {
            $to_store = $_POST['to_store_id'];
        }
        if(isset($_POST['show_draft_bill'])) {
            $show_draft_bill = $_POST['show_draft_bill'];
        }

        $total_records_list = array();
        $total_records_list = $obj->getMaterialTransferList($from_date, $to_date, $from_store,$to_store,$show_bill);
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['material_transfer_number']), $search_text) !== false) ) {
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

        if(empty($view_access_error)) { ?>
    
        <table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Emtry Number</th>
                    <th>From Store</th>
                    <th>To Store</th>
                    <th>QTY</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($show_records_list)) {
                    foreach ($show_records_list as $key => $list) {
                        $index = $key + 1;
                        if (!empty($prefix)) {
                            $index = $index + $prefix;
                        }
                        ?>
                        <tr>
                            <td> <?php echo $index; ?></td>
                            <td>
                                
                                <?php
                                    if(!empty($list['material_transfer_date'])) {
                                        echo date('d-m-Y', strtotime($list['material_transfer_date']));
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(!empty($list['material_transfer_number']) && $list['material_transfer_number'] != $GLOBALS['null_value']) {
                                        echo $list['material_transfer_number'];
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(!empty($list['from_location_name']) && $list['from_location_name'] != $GLOBALS['null_value']) {
                                        echo $obj->encode_decode('decrypt',$list['from_location_name']);
                                    }
                                
                                    if(!empty($list['cancelled'])) { ?>
                                                <br><span style="color: red;">Cancelled</span>
                                        <?php	
                                    } ?>
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
                                if(!empty($list['to_location_name']) && $list['to_location_name'] != $GLOBALS['null_value']) {
                                    echo $obj->encode_decode('decrypt',$list['to_location_name']);
                                } ?>
                            </td>
                            <td>
                                <?php
                                    if(!empty($list['quantity'])) {
                                        $quantitys = explode(",",$list['quantity']);
                                        $quantity = array_sum($quantitys);
                                        echo $quantity;
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
                                <?php 
                                        ?>
                                        <div class="dropdown">
                                            <button class="btn btn-dark show-button py-1 px-2" type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <li>
                                                    <a class="dropdown-item" style="cursor:pointer;"  target="_blank" href="reports/rpt_material_transfer_a4.php?view_material_transfer_id=<?php if(!empty($list['material_transfer_id'])) { echo $list['material_transfer_id']; } ?>"><i class="fa fa-print"></i>&ensp;Print</a>
                                                </li>
                                                <?php 
                                                    if(empty($edit_access_error) && $list['deleted'] == '0') {
                                                        ?>
                                                        <li>
                                                            <a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['material_transfer_id'])) { echo $list['material_transfer_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a>
                                                        </li>
                                                        <?php
                                                    } 
                                                ?>  
                                                 <?php 
                                                    if(empty($delete_access_error) && $list['deleted'] == '0') {
                                                        ?>
                                                            <li>
                                                                <a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['material_transfer_id'])) { echo $list['material_transfer_id']; } ?>');"><i class="fa fa-trash"></i> &ensp;  Delete</a>
                                                            </li>  
                                                        <?php
                                                    } 
                                                ?>  
                                            </ul>
                                        </div>
                                        <?php
                                ?>

                            </td>
                        </tr>
                         <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5" class="text-center">Sorry! No records found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>                
    <?php }
	}

        if(isset($_REQUEST['delete_material_transfer_id'])) {
        $delete_material_transfer_id = $_REQUEST['delete_material_transfer_id'];
        $delete_material_transfer_id = trim($delete_material_transfer_id);
        $msg = "";
        if(!empty($delete_material_transfer_id)) {	
            $material_transfer_unique_id = "";
            $material_transfer_unique_id = $obj->getTableColumnValue($GLOBALS['material_transfer_table'], 'material_transfer_id', $delete_material_transfer_id, 'id');
        
            if(preg_match("/^\d+$/", $material_transfer_unique_id)) {
                $material_transfer_number = "";
                $material_transfer_number = $obj->getTableColumnValue($GLOBALS['material_transfer_table'], 'material_transfer_id', $delete_material_transfer_id, 'material_transfer_number');
            
                $action = "";
                
                $action = "Material Transfer";
                
                $stock_delete = "";
                $stock_delete = $obj->DeleteMaterialTransfer($delete_material_transfer_id);
                if($stock_delete == '1') {
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['material_transfer_table'], $material_transfer_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "Can't Delete. Stock goes to negative!";
                }
            }
            else {
                $msg = "Invalid Material Transfer";
            }
        }
        else {
            $msg = "Empty Material Transfer";
        }
        echo $msg;
        exit;	
    }   

    