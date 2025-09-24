<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['store_entry_module'];
        }
    }
	if(isset($_REQUEST['show_store_entry_id'])) { 
        $show_store_entry_id = $_REQUEST['show_store_entry_id'];
        $show_store_entry_id = trim($show_store_entry_id);
        $store_entry_date = date('Y-m-d'); $current_date = date('Y-m-d');
        
        $store_type = "";

        $store_entry_list = $obj->getTableRecords($GLOBALS['store_entry_table'], 'store_entry_id', $show_store_entry_id, '');   
        
        if(!empty($store_entry_list)) {
            foreach($store_entry_list as $data) {
                if(!empty($data['store_entry_date'])) {
                    $store_entry_date = date('Y-m-d', strtotime($data['store_entry_date']));
                }
                if(!empty($data['store_entry_number']) && $data['store_entry_number'] != $GLOBALS['null_value']) {
                    $store_entry_number = $data['store_entry_number'];
                }
                if(!empty($data['job_card_id']) && $data['job_card_id'] != $GLOBALS['null_value']) {
                    $job_card_id = $data['job_card_id'];
                }
                if(!empty($data['job_card_number']) && $data['job_card_number'] != $GLOBALS['null_value']) {
                    $job_card_number = $data['job_card_number'];
                }
                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                    $remarks = $data['remarks'];
                }
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

            }
        }

        $store_list = array();
        $store_list = $obj->getTableRecords($GLOBALS['store_room_table'], '','', '');

        $job_card_list = array();
        $job_card_list = $obj->getTableRecords($GLOBALS['job_card_table'], 'invoice_status',0);

        $unit_list = array();
        $unit_list = $obj->getTableRecords($GLOBALS['unit_table'], 'bill_company_id', $GLOBALS['bill_company_id']);

        $product_list = array();
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '');
        ?>
        <form class="poppins pd-20 redirection_form" name="store_entry_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_store_entry_id)) {  ?>
						    <div class="h5">Edit Store Entry</div>
                        <?php }else{ ?>
						    <div class="h5">Add Store Entry</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('store_entry.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_store_entry_id)) { echo $show_store_entry_id; } ?>">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-md-4 col-6 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="date" name="store_entry_date" class="form-control shadow-none" placeholder="" required="" value="<?php if(!empty($store_entry_date)) { echo $store_entry_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                    <label>Date</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="job_card_id" onchange="Javascript:HideDetails('job_card');" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <?php if(!empty($job_card_list) && empty($show_store_entry_id)) { ?>
                                            <option value="">Select Job Card</option>
                                            <?php foreach($job_card_list as $data) {
                                                $selected = "";
                                                if(!empty($job_card_id) && $job_card_id == $data['job_card_id']) {
                                                    $selected = "selected";
                                                } ?>
                                                <option value="<?php echo $data['job_card_id']; ?>" <?php echo $selected; ?>><?php echo $data['job_card_number']; ?></option>
                                        <?php  } 
                                        } else { ?>
                                            <option value="<?php if(!empty($job_card_id)) { echo $job_card_id; } ?>" selected><?php if(!empty($job_card_number)) { echo $job_card_number; } ?></option>
                                        <?php }?>
                                    </select>
                                    <label>Select Job Card</label>
                                </div>
                                <a href="Javascript:ViewJobDetails();" class="<?php if(empty($show_store_entry_id)){?>d-none<?php }?> details_element" style="font-size: 12px;font-weight: bold;">Click to view details</a>
                            </div>       
                        </div>
                        <div class="col-lg-3 col-md-4 col-12 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <textarea class="form-control" id="remarks" name="remarks" onkeydown="Javascript:KeyboardControls(this,'',150,'1');" placeholder="Remarks"><?php if(!empty($remarks)) { echo $obj->encode_decode('decrypt', $remarks); } ?> </textarea>
                                    <label>Remarks</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="store_type" id="store_type" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="getStoreType();" <?php if(!empty($show_store_entry_id)){ ?>disabled<?php } ?>>
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
                                <select class="select2 select2-danger" name="overall_store_id" onchange="GetStoreProduct();" data-dropdown-css-class="select2-danger" style="width: 100%!important;"  <?php if(!empty($show_store_entry_id)){ ?>disabled<?php } ?>>
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
                            <?php if(!empty($show_store_entry_id)){ ?>                    
                                <input type="hidden" class="form-control shadow-none" name="overall_store_id" value="<?php  if(!empty($store_ids[0])){ echo $store_ids[0]; } ?>">  
                            <?php } ?>
                        </div> 
                    </div>
                    <div class="row justify-content-center pt-3">
                        <div class="col-lg-2 col-md-3 col-12 px-lg-1 py-2 store_cover2 <?php if($store_type != '2'){ ?>d-none<?php } ?>">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="indv_store_id" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:GetStoreProduct();" >
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
                        </div> 
                        <div class="col-lg-3 col-md-3 col-12 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border chargesaction">
                                    <div class="input-group ">
                                        <select class="select2 select2-danger" name="selected_product_id" id="selected_product_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getUnit(this);">
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
                                        <!-- <div class="input-group-append">
                                            <span class="input-group-text" onclick="Javascript:CustomAddModalContent('product');" style="background-color:#f06548!important; cursor:pointer; height:100%;"><i class="fa fa-plus text-white"></i></span>
                                        </div> -->
                                    </div>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select class="select2 select2-danger" name="selected_unit_id"  id="selected_unit_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select</option>
                                    </select>
                                    <label>Unit</label>
                                </div>
                            </div>     
                        </div> 
                        <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" name="selected_quantity" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" required="">
                                    <label class="qty_cover">QTY</label>
                                </div>
                                <span class="text-danger current_stock_span"></span>
                            </div> 
                        </div>
                        <input type="hidden" name="current_stock" class="form-control shadow-none" value="">
                        <div class="col-lg-1 col-md-3 col-12 text-center py-2 px-lg-1">
                            <button class="btn btn-danger add_products_button" style="font-size:12px;" type="button" onclick="Javascript:AddStoreEntry();">
                                Add
                            </button>
                        </div> 
                    </div>
                    <div class="row justify-content-center"> 
                        <div class="col-lg-9">
                            <div class="table-responsive text-center">
                                <input type="hidden" name="product_count" value="<?php if(!empty($product_count)) { echo $product_count; } else { echo '0'; } ?>">
                                <table class="table nowrap cursor smallfnt table-bordered store_entry_table">
                                    <thead class="bg-dark smallfnt">
                                        <tr style="white-space:pre;">
                                            <th>#</th>
                                            <th class="store_cover3 <?php if($store_type != '2'){?>d-none<?php } ?>">Store Name</th>
                                            <th>Product Name</th>
                                            <th>Unit</th>
                                            <th style="width: 80px;">Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                        $total_qty = 0;
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
                                                            $current_inward_stock = $obj->getInwardQty($show_store_entry_id,$store_ids[$i],$product_ids[$i],$unit_ids[$i]);
                                                            $current_outward_stock = $obj->getOutwardQty($show_store_entry_id,$store_ids[$i],$product_ids[$i],$unit_ids[$i]);                                                            
                                                            if($current_inward_stock >= $current_outward_stock) {
                                                                $show_button = 1;
                                                            }
                                                            $total_qty = $total_qty + $quantity[$i];
                                                        ?>
                                                        <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity[$i])) { echo $quantity[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:CalcTotalQuantity();">
                                                    </th>
                                                   
                                                    <td class="text-center px-2 py-2">
                                                        <?php
                                                        $current_inward_stock = 0; $current_outward_stock = 0; $current_unit_stock = 0;
                                                        if($show_button == '1' && $can_delete == "true") {
                                                                ?>
                                                                <button class="btn btn-danger" type="button" onclick="Javascript:DeleteStoreRow('<?php if(!empty($product_count)) { echo $product_count; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
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
                                            <td colspan="<?php echo (!empty($store_type) && $store_type == '2') ? '4' : '3'; ?>" class="text-right h6 subtotal_amount"> Total : </td>
                                            <td class="text-right h6 total_qty"><?php echo $total_qty; ?></td>     
                                            <td></td>                               
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 py-3 text-center">
                            <div class="col-md-12 py-3 text-center">
                                <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent(event, 'store_entry_form', 'store_entry_changes.php', 'store_entry.php');"> Submit </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script>
                <?php if(!empty($show_store_entry_id)){ ?>
                    GetStoreProduct();
                <?php } ?>
            </script>
        </form>
	<?php
    } 

    if(isset($_REQUEST['product_row_index'])) {
        $product_id = $_REQUEST['selected_product_id'];
        $selected_unit_id = $_REQUEST['selected_unit_id'];
        $selected_quantity = $_REQUEST['selected_quantity'];
        $product_row_index = $_REQUEST['product_row_index'];
        $store_type  = $_REQUEST['store_type'];
        $store_id = $_REQUEST['store_id'];

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
                <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($selected_quantity)) { echo $selected_quantity; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:CalcTotalQuantity();">                
            </th>
            <th class="text-center px-2 py-2">
                <button class="btn btn-danger" type="button" onclick="Javascript:DeleteStoreRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
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
        $store_entry_date = ""; $store_entry_date_error = ""; $result = '';
        $valid_store = ""; $form_name = "store_entry_form";  $hsn_codes = array();

        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        $store_entry_date = $_POST['store_entry_date'];
        $store_entry_date = trim($store_entry_date);
        $store_entry_date_error = $valid->common_validation($store_entry_date, 'Entry Date', '1');
        if(!empty($store_entry_date_error)) {
            if(!empty($valid_store)) {
                $valid_store = $valid_store." ".$valid->error_display($form_name, 'store_entry_date', $store_entry_date_error, 'text');
            }
            else {
                $valid_store = $valid->error_display($form_name, 'store_entry_date', $store_entry_date_error, 'text');
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
                if(!empty($valid_store)) {
                    $valid_store = $valid_store." ".$valid->error_display($form_name, 'store_type', $store_type_error, 'select');
                }
                else {
                    $valid_store = $valid->error_display($form_name, 'store_type', $store_type_error, 'select');
                }
            }
        }    
        
        if(isset($_POST['job_card_id']))
        {
            $job_card_id = $_POST['job_card_id'];
            $job_card_id = trim($job_card_id);
            if(!empty($job_card_id)) {
                $job_card_unique_id = '';
                $job_card_unique_id = $obj->getTableColumnValue($GLOBALS['job_card_table'], 'job_card_id', $job_card_id, 'id');
                if(!preg_match("/^\d+$/", $job_card_unique_id)) {
                    $job_card_id_error = "Invalid job Card";
                }
            }
            else
            {
                $job_card_id_error ="Select the job Card ";
            }   
        }
        
        if(!empty($job_card_id_error)) {
            if(!empty($valid_store)) {
                $valid_store = $valid_store." ".$valid->error_display($form_name, 'job_card_id', $job_card_id_error, 'select');
            }
            else {
                $valid_store = $valid->error_display($form_name, 'job_card_id', $job_card_id_error, 'select');
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
            if(!empty($valid_store)) {
                $valid_store = $valid_store." ".$valid->error_display($form_name, 'remarks', $remarks_error, 'textarea');
            }
            else {
                $valid_store = $valid->error_display($form_name, 'remarks', $remarks_error, 'textarea');
            }
        }
        if(isset($_POST['product_id'])) {
            $product_ids = $_POST['product_id'];
        }
        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
        }
        if(isset($_POST['unit_id']))
        {
            $unit_ids = $_POST['unit_id'];
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
                if(!empty($valid_store)) {
                    $valid_store = $valid_store." ".$valid->error_display($form_name, 'store_id', $store_id_error, 'select');
                }
                else {
                    $valid_store = $valid->error_display($form_name, 'store_id', $store_id_error, 'select');
                }
            }
        }else{
            if(isset($_POST['store_id'])) {
                $store_ids = $_POST['store_id'];
            }
        }
        $stock_error = 0; $valid_stock = "";
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
                    $hsn_code = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'hsn_code');
                    $product_names[$i] = $product_name;
                    $hsn_codes[$i] = $hsn_code;
                    $unit_name = "";
                    $unit_ids[$i] = trim($unit_ids[$i]);
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
                    $unit_names[$i] = $unit_name; 
                    
                    $quantity[$i] = trim($quantity[$i]);
                    if(!empty($quantity[$i])) {
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $quantity[$i]) && $quantity[$i] <= 99999) {
                            $current_inward_stock = 0; $current_outward_stock = 0; $current_unit_stock = 0;
                            $current_inward_stock = $obj->getInwardQty($edit_id,$store_ids[$i],$product_ids[$i],$unit_ids[$i]);
                            $current_outward_stock = $obj->getOutwardQty($edit_id,$store_ids[$i],$product_ids[$i],$unit_ids[$i]);                                                            
                            $current_unit_stock = ($current_inward_stock - $current_outward_stock);     
                            if(($current_unit_stock- $quantity[$i]) < 0) {
                                $valid_stock = "Stock goes to Negative for ".($obj->encode_decode('decrypt', $product_names[$i])). "; Unit => ". $obj->encode_decode('decrypt',$unit_names[$i]) . " Stock => ".$current_unit_stock;
                                $stock_error = 1;                                                                
                            }                                                                                                                
                            if(!empty($edit_id)) {
                                $stock_unique_ids[$i] = $obj->getStockUniqueID($edit_id,$store_ids[$i], $product_ids[$i], $unit_ids[$i]);
                            }
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

        if(empty($valid_store) && empty($product_error) && empty($store_entry_error) && empty($stock_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $bill_company_id =$GLOBALS['bill_company_id'];
                $bill_company_details = "";
                if (!empty($bill_company_id)) {
                    $bill_company_details = $obj->BillCompanyDetails($bill_company_id, $GLOBALS['store_entry_table']);
                }
    
                if(!empty($store_entry_date)) {
                    $store_entry_date = date('Y-m-d', strtotime($store_entry_date));
                }
                if(!empty($remarks)) {
                    $remarks = $obj->encode_decode('encrypt', $remarks);
                }else{
                    $remarks = $GLOBALS['null_value'];
                }
                if(!empty($job_card_id)) {
                    $job_card_id = $job_card_id;
                    $job_card_number = $obj->getTableColumnValue($GLOBALS['job_card_table'], 'job_card_id', $job_card_id, 'job_card_number');
                }else{
                    $job_card_id = $GLOBALS['null_value'];
                    $job_card_number = $GLOBALS['null_value'];
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
                if(!empty($hsn_codes)) {
                    $hsn_codes = array_reverse($hsn_codes);
                    $hsn_codes = implode(",", $hsn_codes);
                }else{
                    $hsn_codes = $GLOBALS['null_value'];
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

                $bill_company_id = $GLOBALS['bill_company_id']; 
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $balance = 0; $stock_update = 0; $stock_remove = 0;
                if(empty($edit_id)) {
                    $action = "New Store Created. ";
                    $null_value = $GLOBALS['null_value'];
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'bill_company_details', 'store_entry_id', 'store_entry_number', 'store_entry_date','job_card_id','job_card_number','product_id', 'product_name','hsn_code', 'quantity', 'unit_id' ,'unit_name' ,'store_id','store_name','store_type','remarks','deleted');
                     $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'",  "'".$null_value."'", "'".$null_value."'", "'".$store_entry_date."'","'".$job_card_id."'","'".$job_card_number."'", "'".$product_ids."'", "'".$product_names."'","'".$hsn_codes."'","'".$quantity."'", "'".$unit_ids."'","'".$unit_names."'", "'".$store_ids."'","'".$store_name."'","'".$store_type."'","'".$remarks."'","'0'");
                     $store_insert_id = $obj->InsertSQL($GLOBALS['store_entry_table'], $columns, $values,'store_entry_id','store_entry_number',$action);
        
                    if(preg_match("/^\d+$/", $store_insert_id)) {
                        $store_entry_id = $obj->getTableColumnValue($GLOBALS['store_entry_table'],'id',$store_insert_id,'store_entry_id');
                        $store_entry_number = $obj->getTableColumnValue($GLOBALS['store_entry_table'],'id',$store_insert_id,'store_entry_number');
                        $store_balance =1;
                        $stock_update = 1;
                        $result = array('number' => '1', 'msg' => 'Store Entry Successfully Created','redirection_page' =>'store_entry.php');					
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $store_insert_id);
                    }
                }
                else
                {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['store_entry_table'], 'store_entry_id', $edit_id, 'id');
                    $store_entry_number = $obj->getTableColumnValue($GLOBALS['store_entry_table'], 'store_entry_id', $edit_id, 'store_entry_number');
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "Store Entry Updated. Bill No. - ".$store_entry_number;

                        $columns = array(); $values = array();						
                        $columns = array('creator_name','bill_company_id', 'bill_company_details', 'store_entry_date','job_card_id','job_card_number','product_id', 'product_name','hsn_code', 'quantity', 'unit_id' ,'unit_name' ,'store_id','store_name','store_type','remarks');
                        $values = array("'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'",  "'".$store_entry_date."'","'".$job_card_id."'","'".$job_card_number."'", "'".$product_ids."'", "'".$product_names."'","'".$hsn_codes."'","'".$quantity."'", "'".$unit_ids."'","'".$unit_names."'", "'".$store_ids."'","'".$store_name."'","'".$store_type."'","'".$remarks."'");
                        $store_update_id = $obj->UpdateSQL($GLOBALS['store_entry_table'], $getUniqueID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $store_update_id)) {
                            $store_entry_id = $edit_id;
                            $store_entry_number = $obj->getTableColumnValue($GLOBALS['store_entry_table'], 'store_entry_id', $edit_id, 'store_entry_number');
                            $result = array('number' => '1', 'msg' => 'Updated Successfully','redirection_page' =>'store_entry.php');
                            $store_balance =1; 
                            $stock_remove = 1;
                            $stock_update = 1;
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $store_update_id);
                        }							
                    }
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
                    if(!empty($store_entry_id) && !empty($store_entry_number) ) {
                        $product_ids = explode(",", $product_ids);
                        $quantity = explode(",", $quantity);
                        $unit_ids = explode(",", $unit_ids);                        
                        $store_ids = explode(",",$store_ids);
                        $index = 0;
                        for($i=0; $i < count($product_ids); $i++) {
                            $stock_update = $obj->StockUpdate($GLOBALS['store_entry_table'], "Out", $store_entry_id,$store_entry_number, $product_ids[$i],$store_entry_number, $store_entry_date, $store_ids[$i], $unit_ids[$i], $quantity[$i],'');
                        }
                    }
                } 

            } else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }else {
            if(!empty($valid_store)) {
                $result = array('number' => '3', 'msg' => $valid_store);
            }
            else if(!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);
            } else if(!empty($valid_stock)) {
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
         $from_date = ""; $to_date = ""; $search_text = "";  $search_job_text = ""; $job_card_id = "";
        $show_bill = 0;$show_draft_bill = 0; 
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
        if(isset($_POST['search_job_text'])) {
            $search_job_text = $_POST['search_job_text'];
        }

        if(isset($_POST['filter_job_card_id']))
        {
            $job_card_id = $_POST['filter_job_card_id'];
        }

        $total_records_list = array();
        $total_records_list = $obj->getStoreEntryList($from_date, $to_date,$show_bill,$job_card_id);
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['store_entry_number']), $search_text) !== false) ) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }
        if(!empty($search_job_text)) {
            $search_job_text = strtolower($search_job_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['job_card_number']), $search_job_text) !== false) ) {
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
                        <th>Job Card</th>
                        <th>QTY</th>
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
                                        if(!empty($list['store_entry_date'])) {
                                            echo date('d-m-Y', strtotime($list['store_entry_date']));
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['store_entry_number']) && $list['store_entry_number'] != $GLOBALS['null_value']) {
                                            echo $list['store_entry_number'];
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
                                        if(!empty($list['job_card_id']) && $list['job_card_id'] != $GLOBALS['null_value']) {
                                            $job_card_number = $obj->getTableColumnValue($GLOBALS['job_card_table'], 'job_card_id', $list['job_card_id'], 'job_card_number');
                                            if(!empty($job_card_number) && $job_card_number != $GLOBALS['null_value']) {
                                                echo $job_card_number;
                                            }
                                        }
                                    ?>
                                </td>
                                
                                <td>
                                    <?php
                                        if(!empty($list['quantity'])) {
                                            echo number_format(array_sum(explode(",", $list['quantity'])),2);
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
                                                <a class="dropdown-item" style="cursor:pointer;"  target="_blank" href="reports/rpt_store_entry_a4.php?view_store_entry_id=<?php if(!empty($list['store_entry_id'])) { echo $list['store_entry_id']; } ?>"><i class="fa fa-print"></i>&ensp;Print</a>
                                            </li>
                                            <?php 
                                                if(empty($edit_access_error) && $list['deleted'] == '0') {
                                                    ?>
                                                    <li>
                                                        <a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['store_entry_id'])) { echo $list['store_entry_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a>
                                                    </li>
                                                    <?php
                                                } 
                                            ?>  
                                                <?php 
                                                if(empty($delete_access_error) && $list['deleted'] == '0') {
                                                    ?>
                                                        <li>
                                                            <a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['store_entry_id'])) { echo $list['store_entry_id']; } ?>');"><i class="fa fa-trash"></i> &ensp;  Delete</a>
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
<?php	}
    }

    if(isset($_REQUEST['delete_store_entry_id'])) {
        $delete_store_entry_id = $_REQUEST['delete_store_entry_id'];
        $delete_store_entry_id = trim($delete_store_entry_id);
        $msg = "";
        if(!empty($delete_store_entry_id)) {	
            $store_entry_unique_id = ""; $voucher_unique_id = ""; $voucher_id = "";
            $store_entry_unique_id = $obj->getTableColumnValue($GLOBALS['store_entry_table'], 'store_entry_id', $delete_store_entry_id, 'id');
            if(preg_match("/^\d+$/", $store_entry_unique_id)) {
                $bill_number = "";
                $bill_number = $obj->getTableColumnValue($GLOBALS['store_entry_table'], 'store_entry_id', $delete_store_entry_id, 'store_entry_number');
            
                $action = "";
                $payment_delete = "";
                $payment_delete = $obj->DeleteStoreEntry($delete_store_entry_id);
                if($payment_delete == '1') {
                    $action = "Store Entry Deleted. Bill No. - ".$bill_number;
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['store_entry_table'], $store_entry_unique_id, $columns, $values, $action);


                }
                else {
                    $msg = "Can't Delete.";
                }
            }
            else {
                $msg = "Invalid Store";
            }
        }
        else {
            $msg = "Empty Store";
        }
        echo $msg;
        exit;	
    } 
?>