<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['product_module'];
        }
    }
	if(isset($_REQUEST['show_product_id'])) { 
        $add_custom = 0;
        if(isset($_REQUEST['add_custom'])) {
            $add_custom = $_REQUEST['add_custom'];
        }

        $show_product_id = $_REQUEST['show_product_id'];
        $show_product_id = trim($show_product_id); 
        $to_date = date('Y-m-d');
        $entry_date = date('Y-m-d');     
        $product_name = ""; $hsn_code = ""; $unit_id = ""; $product_rate = ""; $product_tax= ""; $store_room_ids = array(); $stock_dates = array();  $product_row_index = 0; $store_room_names = array(); $quantitys = array();  $product_id = "";  
        if(!empty($show_product_id)) {
            $product_list = array();
            $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $show_product_id, '');
              if(!empty($product_list)) {
                foreach($product_list as $data) {
                    if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                        $product_id = $data['product_id'];
                    } 
                    if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                        $product_name = $obj->encode_decode('decrypt',$data['product_name']);
                    } 
                    if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                        $unit_id = $data['unit_id'];
                    } 
                    if(!empty($data['hsn_code']) && $data['hsn_code'] != $GLOBALS['null_value']) {
                        $hsn_code = $obj->encode_decode('decrypt',$data['hsn_code']);
                    } 
                    if(!empty($data['product_rate']) && $data['product_rate'] != $GLOBALS['null_value']) {
                        $product_rate = $data['product_rate'];
                    }
                    if(!empty($data['product_tax']) && $data['product_tax'] != $GLOBALS['null_value']) {
                        $product_tax = $data['product_tax'];
                    }
                    if(!empty($data['stock_date']) && $data['stock_date'] != $GLOBALS['null_value']) {
                        $stock_dates = explode(",", $data['stock_date']);
                    } 
                    if(!empty($data['store_room_id']) && $data['store_room_id'] != $GLOBALS['null_value']) {
                        $store_room_ids = explode(",", $data['store_room_id']);
                        $product_row_index = count($store_room_ids);
                    }
                    if(!empty($data['store_room_name']) && $data['store_room_name'] != $GLOBALS['null_value']) {
                        $store_room_names = explode(",", $data['store_room_name']);
                    } 
                    if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                        $quantitys = explode(",", $data['quantity']);
                    } 
                }
            }
        }
        $unit_list = array();
        $unit_list = $obj->getTableRecords($GLOBALS['unit_table'], '', '', '');
        $store_room_list = array();
        $store_room_list = $obj->getTableRecords($GLOBALS['store_room_table'], '', '', '');
        ?>
        <form class="poppins pd-20" name="product_form" method="POST">
            <?php if(empty($add_custom) && $add_custom == 0) { ?>
                <div class="card-header">
                    <div class="row p-2">
                        <div class="col-lg-8 col-md-8 col-8 align-self-center">
                            <div class="h5">Add Product</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-4">
                            <button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('product.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_product_id)) { echo $show_product_id; } ?>">
                <input type="hidden" name="add_custom" value="<?php if(!empty($add_custom)) { echo $add_custom; } ?>">
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="product_name" value="<?php if(!empty($product_name)) { echo $product_name; } ?>" name="product_name" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'',100,1);" placeholder="" required>
                            <label>Product Name</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="hsn_code" name="hsn_code"  value="<?php if(!empty($hsn_code)) { echo $hsn_code; } ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" placeholder="" required>
                            <label>HSN Code</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger"  name="unit_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Unit</option>
                                <?php
                                    if(!empty($unit_list)) {
                                        foreach($unit_list as $data) {
                                            if(!empty($data['unit_id'])) {?>
                                                <option value="<?php echo $data['unit_id']; ?>" <?php if(!empty($unit_id) && $data['unit_id'] == $unit_id) { ?>selected<?php } ?>>
                                                <?php
                                                    if(!empty($data['unit_name'])) {
                                                        $data['unit_name'] = $obj->encode_decode('decrypt', $data['unit_name']);
                                                        echo $data['unit_name'];
                                                    } 
                                                ?>
                                                                        
                                                </option>
                                            <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Select Unit</label>
                        </div>
                    </div>    
                </div>
                <div class="col-lg-2 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="product_rate" name="product_rate" value="<?php if(!empty($product_rate)) { echo $product_rate; } ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" placeholder="" required>
                            <label>Rate</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger"  name="product_tax" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Tax</option>
                                <option value="0" <?php if($product_tax == '0'){ ?>selected<?php } ?>>0%</option>
                                <option value="5" <?php if($product_tax == '5'){ ?>selected<?php } ?>>5%</option>
                                <option value="12" <?php if($product_tax == '12'){ ?>selected<?php } ?>>12%</option>
                                <option value="18" <?php if($product_tax == '18'){ ?>selected<?php } ?>>18%</option>
                                <option value="28" <?php if($product_tax == '28'){ ?>selected<?php } ?>>28%</option>
                            </select>
                            <label>Select Tax</label>
                        </div>
                    </div>    
                </div>
            </div> 
            <div class="row justify-content-center p-3">
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group pb-2">
                        <div class="form-label-group in-border">
                            <input type="date" class="form-control shadow-none" name="stock_date" id="stock_date" placeholder="" required="" value="<?php if(!empty($entry_date)) { echo $entry_date; } ?>"max="<?php if(!empty($to_date)) { echo $to_date; } ?>">
                            <label>Stock Date</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="store_room_id" id="store_room_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Store Room</option>
                                <?php
                                    if(!empty($store_room_list)) {
                                        foreach($store_room_list as $data) {
                                            if(!empty($data['store_room_id'])) {?>
                                                <option value="<?php echo $data['store_room_id']; ?>" <?php if(!empty($store_room_id) && $data['store_room_id'] == $store_room_id) { ?>selected<?php } ?>>
                                                <?php
                                                    if(!empty($data['store_room_name'])) {
                                                        $data['store_room_name'] = $obj->encode_decode('decrypt', $data['store_room_name']);
                                                        echo $data['store_room_name'];
                                                    } 
                                                ?>                     
                                                </option>
                                            <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Select Store</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text"  name="quantity" id="quantity" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" placeholder="" required="">
                            <label>QTY</label>
                        </div>
                    </div> 
                </div>
                <!-- <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" name="row_unit_id" id="row_unit_id" style="width: 100%;">
                                <option value="">Select Unit</option>
                                <?php
                                    if(!empty($unit_list)) {
                                        foreach($unit_list as $data) {
                                            if(!empty($data['unit_id'])) {?>
                                                <option value="<?php echo $data['unit_id']; ?>" <?php if(!empty($unit_id) && $data['unit_id'] == $unit_id) { ?>selected<?php } ?>>
                                                <?php
                                                    if(!empty($data['unit_name'])) {
                                                        $data['unit_name'] = $obj->encode_decode('decrypt', $data['unit_name']);
                                                        echo $data['unit_name'];
                                                    } 
                                                ?>                                              
                                                </option>
                                            <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Unit</label>
                        </div>
                    </div>        
                </div> -->
                <div class="col-lg-1 col-md-3 col-6 px-lg-1  py-2">
                    <button class="btn btn-danger py-2" style="font-size:12px; width:100%;" type="button" onclick="Javascript:AddProductDetails();">Add</button>
                </div>
                <div class="col-lg-9">
                    <div class="table-responsive text-center">
                        <input type="hidden" name="product_count" value="<?php if(!empty($product_row_index)) { echo $product_row_index; } else { echo "0"; } ?>">
                        <table class="table nowrap cursor smallfnt w-100 table-bordered added_product_table">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th>Stock Date</th>
                                    <th>Store</th>
                                    <th>QTY</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(!empty($store_room_ids)) {
                                        for($i=0; $i < count($store_room_ids); $i++) { ?>
                                        <tr class="product_row" id="product_row<?php echo $product_row_index; ?>">
                                            <th class="sno text-center px-2 py-2">
                                                <?php if(!empty($product_row_index)) { echo $product_row_index; } ?>
                                            </th>
                                            <th class="text-center px-2 py-2">
                                                <?php
                                                    if(!empty($stock_dates[$i])) {
                                                        echo date('d-M-Y', strtotime($stock_dates[$i]));
                                                    }
                                                ?>
                                                <input type="hidden" name="stock_dates[]" value="<?php if(!empty($stock_dates[$i])) { echo $stock_dates[$i]; } ?>">
                                            </th>
                                             <th class="text-center px-2 py-2">
                                                <?php
                                                    if(!empty($store_room_names[$i]) && $store_room_names[$i] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $store_room_names[$i]);
                                                    }
                                                ?>
                                                <input type="hidden" name="store_room_ids[]" value="<?php if(!empty($store_room_ids[$i])) { echo $store_room_ids[$i]; } ?>">
                                            </th>
                                            <th class="text-center px-2 py-2" style="width: 20%;">
                                                <input type="text" name="quantitys[]" class="form-control shadow-none" value="<?php if(!empty($quantitys[$i])) { echo $quantitys[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',5,'');">
                                                
                                            </th>
                                            <th class="text-center px-2 py-2">
                                                <?php 
                                                    $show_button = 0;$can_delete = 'true';  
                                                    $current_inward_stock = 0; $current_outward_stock = 0; $current_unit_stock = 0;
                                                    $current_inward_stock = $obj->getInwardQty($show_product_id,$store_room_ids[$i],$show_product_id,$unit_id);
                                                    $current_outward_stock = $obj->getOutwardQty($show_product_id,$store_room_ids[$i],$show_product_id,$unit_id);                                                            
                                                    if($current_inward_stock >= $current_outward_stock) {
                                                        $show_button = 1;
                                                    }
                                                    $current_inward_stock = 0; $current_outward_stock = 0; $current_unit_stock = 0;
                                                    if($show_button == '1' && $can_delete == "true") {
                                                            ?>
                                                            <button class="btn btn-danger" type="button" onclick="Javascript:DeleteCreationRow('product', '<?php echo $product_row_index; ?>');"><i class="fa fa-trash"></i></button>
                                                            <?php
                                                    }else{
                                                        ?>
                                                            <span class="text-danger" style="font-weight:bold!important;">Can't Delete</span>                                                                     
                                                        <?php
                                                    }        
                                                ?>
                                            </th>
                                        </tr>

                                        <?php 
                                            $product_row_index--;
                                        }
                                    }
                                ?>
                            </tbody> 
                        </table>
                    </div>
                </div>    
                <div class="col-md-12 pt-3 text-center">
                     <button class="btn btn-dark submit_button" type="button" onClick="Javascript:SaveModalContent(event,'product_form', 'product_changes.php', 'product.php');">Submit
                    </button>
                </div>
            </div>  
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 
    if(isset($_POST['edit_id'])) {
        $edit_id = ""; $product_name = ""; $product_name_error = ""; $hsn_code = ""; $hsn_code_error = ""; $unit_id = ""; $unit_id_error = ""; $product_rate = ""; $product_rate_error = ""; $product_tax = ""; $product_tax_error = ""; $form_name = "product_form";  $valid_product = ""; $stock_dates = array(); $store_room_ids = array(); $store_room_names = array(); $quantitys = array(); $product_row_error = ""; $store_room_names = array(); $stock_unique_ids = array(); $unit_name = "";
        if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
		}
         $add_custom = 0;
        if(isset($_POST['add_custom'])) {
            $add_custom = $_POST['add_custom'];
        }
        if(isset($_POST['product_name'])) {
            $product_name = $_POST['product_name'];
            $product_name = trim($product_name);
            $product_name_error = $valid->valid_product_name($product_name, 'Product Name', '1','50');
            if(!empty($product_name_error)) {
                if(!empty($valid_product)) {
                    $valid_product = $valid_product." ".$valid->error_display($form_name, 'product_name', $product_name_error, 'text');
                }
                else {
                    $valid_product = $valid->error_display($form_name, 'product_name', $product_name_error, 'text');
                }
            }
        }

        if(isset($_POST['hsn_code'])){
            $hsn_code =  $_POST['hsn_code'];
            $hsn_code_error = $valid->valid_hsn($hsn_code, 'Hsn Code', '0');
            if(!empty($hsn_code_error)) {
                if(!empty($valid_product)) {
                    $valid_product = $valid_product." ".$valid->error_display($form_name, 'hsn_code', $hsn_code_error, 'text');
                }
                else {
                    $valid_product = $valid->error_display($form_name, 'hsn_code', $hsn_code_error, 'text');
                }
            }
        }

        if(isset($_POST['unit_id'])) {
            $unit_id = $_POST['unit_id'];
            $unit_id = trim($unit_id);
            $unit_id_error = $valid->common_validation($unit_id, 'Unit', 'select');
            if(empty($unit_id_error)) {
                $unit_unique_id = "";
                $unit_unique_id = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'id');
                if(!preg_match("/^\d+$/", $unit_unique_id)) {
                    $unit_id_error = "Invalid Unit";
                }
            }
            if(!empty($unit_id_error)) {
                if(!empty($valid_product)) {
                    $valid_product = $valid_product." ".$valid->error_display($form_name, 'unit_id', $unit_id_error, 'select');
                }
                else {
                    $valid_product = $valid->error_display($form_name, 'unit_id', $unit_id_error, 'select');
                }
            }
        }

        if(isset($_POST['product_rate'])){
            $product_rate = $_POST['product_rate'];
            $product_rate = trim($product_rate);
            $product_rate_error = $valid->valid_price($product_rate, 'Product Rate', 0);
            if(!empty($product_rate)){
                if($product_rate > 99999){
                    $product_rate_error .= "Max Value 999999 Only";
                }
            }
            if(!empty($product_rate_error)) {
                if(!empty($valid_product)) {
                    $valid_product = $valid_product." ".$valid->error_display($form_name, 'product_rate', $product_rate_error, 'text');
                }
                else {
                    $valid_product = $valid->error_display($form_name, 'product_rate', $product_rate_error, 'text');
                }
            }
        }

        if(isset($_POST['product_tax'])){
            $product_tax = $_POST['product_tax'];
            $product_tax = trim($product_tax);
            $product_tax_error = $valid->valid_number($product_tax, 'Product Tax', '0');
            if(!empty($product_tax_error)) {
                if(!empty($valid_product)) {
                    $valid_product = $valid_product." ".$valid->error_display($form_name, 'product_tax', $product_tax_error, 'select');
                }
                else {
                    $valid_product = $valid->error_display($form_name, 'product_tax', $product_tax_error, 'select');
                }
            }
        }
        if(isset($_POST['stock_dates'])) {
            $stock_dates = $_POST['stock_dates'];
        }

        if(isset($_POST['store_room_ids'])) {
            $store_room_ids = $_POST['store_room_ids'];
        }

        if(isset($_POST['quantitys'])) {
            $quantitys = $_POST['quantitys'];
        }

        if(!empty($store_room_ids) && empty($product_row_error)) {
            for($i=0; $i < count($store_room_ids); $i++) {
                $store_room_ids[$i] = trim($store_room_ids[$i]);
                if(!empty($store_room_ids[$i])) {
                    $store_room_name = ""; 
                    $store_room_name = $obj->getTableColumnValue($GLOBALS['store_room_table'], 'store_room_id', $store_room_ids[$i], 'store_room_name');
                    $store_room_names[$i] = $store_room_name;
                    if(!empty($stock_dates[$i])) {
                        $quantitys[$i] = trim($quantitys[$i]);
                       
                         if(!empty($edit_id)) {
                            if(!empty($store_room_ids[$i])) {
                                $stock_unique_ids[$i] = $obj->getStockUniqueID($edit_id,$store_room_ids[$i],$edit_id,$unit_id);
                            }
                        }
                        if(!empty($quantitys[$i])) {
                            if(!preg_match("/^[0-9]+(\\.[0-9]+)?$/",$quantitys[$i])) {
                                $product_row_error = "Invalid Quantity - ".($obj->encode_decode('decrypt', $store_room_name));
                            }
                        }
                        else {
                            $product_row_error = "Empty Quantity in  - ".($obj->encode_decode('decrypt', $store_room_name));
                        }
                    }
                    else {
                        $product_row_error = "Stock Date is empty  - ".($obj->encode_decode('decrypt', $store_room_name));
                    }
                }
                else {
                    $product_row_error = "Select Store Room Name";
                }
                $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
                $current_inward_stock = 0; $current_outward_stock = 0; $current_unit_stock = 0;
                $current_inward_stock = $obj->getInwardQty($edit_id,$store_room_ids[$i],$edit_id,$unit_id);
                $current_outward_stock = $obj->getOutwardQty($edit_id,$store_room_ids[$i],$edit_id,$unit_id);
                if(!empty($quantitys[$i])){
                    $current_inward_stock = $current_inward_stock + $quantitys[$i];
                }
                $current_unit_stock = $current_inward_stock - $current_outward_stock;     
                if($current_unit_stock < 0) {
                    $valid_stock = "Stock goes to Negative for ".($obj->encode_decode('decrypt', $store_room_names[$i])). " Unit => ". $obj->encode_decode('decrypt',$unit_name) . " Stock => ".$current_unit_stock;
                    $stock_error = 1;                                                                
                }    
            }
        }

        $result = "";
		if(empty($valid_product)&& empty($product_row_error)) {
            $check_user_id_ip_address = "";
            $check_user_id_ip_address = $obj->check_user_id_ip_address();
             if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $lower_case_name = "";$unit_name = ""; 
                if(!empty($product_name)) {
                    $lower_case_name = strtolower($product_name);
                    $product_name = $obj->encode_decode('encrypt', $product_name);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);

                } 
                else {
                    $product_name = $GLOBALS['null_value'];
                    $lower_case_name = $GLOBALS['null_value'];
                } 
                if(!empty($unit_id)){
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
                }
                else {
                    $unit_id = $GLOBALS['null_value'];
                    $unit_name = $GLOBALS['null_value'];
                } 
                if(!empty($hsn_code)){
                    $hsn_code = $obj->encode_decode('encrypt', $hsn_code);
                }

                if(!empty($stock_dates)) {
					$stock_dates = implode(",", $stock_dates);
				}
                else {
                    $stock_dates = $GLOBALS['null_value'];
                }

                if(!empty($store_room_ids)) {
					$store_room_ids = implode(",", $store_room_ids);
				}
                else {
                    $store_room_ids = $GLOBALS['null_value'];
                } 

                if(!empty($quantitys)) {
					$quantitys = implode(",", $quantitys);
				}
                else {
                    $quantitys = $GLOBALS['null_value'];
                } 

				if(!empty($store_room_names)) {
					$store_room_names = implode(",", $store_room_names);
				}

                $prev_product_id = ""; $product_error = "";
                if(!empty($lower_case_name)) {
                    $prev_product_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'lower_case_name', $lower_case_name, 'product_id');
                    if(!empty($prev_product_id)) {
                        $product_error = "This Product name already exists";
                    }
                }
                $bill_company_id = $GLOBALS['bill_company_id'];
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $update_stock = 0;  $stock_remove = 0;
                if(empty($edit_id)) {
                    if(empty($prev_product_id)) {						
                        $action = "";
                        if(!empty($product_name)) {
                            $action = "New Product Created - ".$obj->encode_decode("decrypt",$product_name);
                        }
                        $null_value = $GLOBALS['null_value'];
                        $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'product_id', 'product_name', 'lower_case_name','hsn_code','unit_id', 'unit_name','product_rate', 'product_tax', 'stock_date', 'store_room_id', 'store_room_name', 'quantity', 'deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'","'".$null_value."'", "'".$product_name."'",  "'".$lower_case_name."'","'".$hsn_code."'", "'".$unit_id."'", "'".$unit_name."'", "'".$product_rate."'", "'".$product_tax."'","'".$stock_dates."'", "'".$store_room_ids."'", "'".$store_room_names."'", "'".$quantitys."'", "'0'");
                        $product_insert_id = $obj->InsertSQL($GLOBALS['product_table'], $columns, $values,'product_id','', $action);
                        if(preg_match("/^\d+$/", $product_insert_id)) {
                            $product_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'id', $product_insert_id, 'product_id');
                            $update_stock = 1;						
                            if(!empty($add_custom) && $add_custom == 1) { 
                                $result = array('number' => '1', 'msg' => 'Product Successfully Created', 'addcustom'=>'product');
                            } else { 			
                                $result = array('number' => '1', 'msg' => 'Product Successfully Created','product_id' => $product_id);
                            }		
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $product_insert_id);
                        }
                    }
                    else {
                        if(!empty($product_error)) {
                            $result = array('number' => '2', 'msg' => $product_error);
                        }
                    }
                }
                else {
                    if(empty($prev_product_id) || $prev_product_id == $edit_id) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($product_name)) {
                                $action = "Product Updated - ".$obj->encode_decode("decrypt",$product_name);
                            }
                        
                            $columns = array(); $values = array();						
                            $columns = array('creator_name','product_name', 'lower_case_name', 'hsn_code','unit_id', 'unit_name','product_rate', 'product_tax', 'stock_date', 'store_room_id', 'store_room_name', 'quantity',);
                            $values = array("'".$creator_name."'", "'".$product_name."'",  "'".$lower_case_name."'","'".$hsn_code."'", "'".$unit_id."'", "'".$unit_name."'", "'".$product_rate."'", "'".$product_tax."'","'".$stock_dates."'", "'".$store_room_ids."'", "'".$store_room_names."'", "'".$quantitys."'");
                            $entry_update_id = $obj->UpdateSQL($GLOBALS['product_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $entry_update_id)) {
                                $update_stock = 1;	
                                $stock_remove = 1;
                                $product_id = $edit_id;							
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');	
				
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $entry_update_id);
                            }							
                        }
                    }
                    else {
                        if(!empty($product_error)) {
                            $result = array('number' => '2', 'msg' => $product_error);
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
                $stock_date = ""; $store_id = ""; $quantity = "";
                if(!empty($update_stock) && $update_stock == 1) {
                    if(!empty($store_room_ids) && !empty($quantitys) && !empty($stock_dates)) {
                        $stock_date = explode(",", $stock_dates);
                        $store_id = explode(",", $store_room_ids);  
                        $quantity = explode(",", $quantitys);
                        $remarks =  'Opening Stock';
                        for($i=0; $i < count($store_id); $i++) {
                            $stock_update = "";
                            $stock_update =  $obj->StockUpdate($GLOBALS['product_table'],'In', $product_id,$GLOBALS['null_value'], $product_id, 'Opening Stock', $stock_date[$i], $store_id[$i], $unit_id, $quantity[$i], $GLOBALS['null_value']);
                        }
                    }
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }	

        }else {
			if(!empty($valid_product)) {
				$result = array('number' => '3', 'msg' => $valid_product);
			}else if(!empty($product_row_error)) {
                $result = array('number' => '2', 'msg' => $product_row_error);
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
        }
        
        $total_records_list = array();
        $total_records_list = $obj->getTableRecords($GLOBALS['product_table'],'','','DESC');
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if((strpos(strtolower($obj->encode_decode('decrypt', $val['product_name'])), $search_text) !== false) ) {
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
?>
        <?php if($total_pages > $page_limit) { ?>
            <div class="pagination_cover mt-3"> 
                <?php
                    include("pagination.php");
                ?> 
            </div> 
        <?php } ?>
        <?php
            $view_access_error = "";
            if(!empty($login_staff_id)) {
                $permission_action = $view_action;
                include('permission_action.php');
            }
            if(empty($view_access_error)) {  ?>
                <table class="table nowrap cursor text-center smallfnt">
                    <thead class="bg-light">
                        <tr>
                            <th>S.No</th>
                            <th>Product Name</th>
                            <th>Unit</th>
                            <th>Rate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php 
                            if(!empty($show_records_list)) {
                                foreach($show_records_list as $key => $list) {
                                    $index = $key + 1;
                                    if(!empty($prefix)) { $index = $index + $prefix; }  ?>
                                    <tr>
                                         <td>
                                            <?php echo $index; ?>
                                        </td>
                                        <td>
                                            <?php
                                                if(!empty($list['product_name']) && $list['product_name'] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt', $list['product_name']);
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if(!empty($list['unit_name']) && $list['unit_name'] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt', $list['unit_name']);
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if(!empty($list['product_rate']) && $list['product_rate'] != $GLOBALS['null_value']) {
                                                    echo $list['product_rate'];
                                                }else{
                                                    echo "-";
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
                                                    <a href="#" role="button" class="btn btn-dark show-button poppins" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                    <?php 
                                                        $edit_access_error = "";
                                                        if(!empty($login_staff_id)) {
                                                            $permission_action = $edit_action;
                                                            include('permission_action.php');
                                                        }
                                                        if(empty($edit_access_error)) {
                                                    ?> 
                                                        <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['product_id'])) { echo $list['product_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                                        <?php } ?>  
                                                        <?php 
                                                            $delete_access_error = "";
                                                            if(!empty($login_staff_id)) {
                                                                $permission_action = $delete_action;
                                                                include('permission_action.php');
                                                            }
                                                            if(empty($delete_access_error)) { 
                                                                $linked_count = 0;
                                                                // $linked_count = $obj->GetProductLinkedCount($list['product_id']); 
                                                                if($linked_count > 0) { ?>
                                                                <li><a class="dropdown-item text-secondary" ><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                                <?php 
                                                                    }
                                                                    else {
                                                                ?> 
                                                                <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['product_id'])) { echo $list['product_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                                        
                                                                <?php 
                                                                }
                                                            } 
                                                        ?>  
                                                    </ul>
                                                </div> 
                                            </td>
                                        <?php } ?>
                                    </tr>
                               <?php }
                            } else{ ?>
                                <tr>
                                    <td colspan="5" class="text-center">Sorry! No records found</td>
                                </tr>
                           <?php }?>
                    </tbody>
                </table>     

           <?php }
        ?>
        
		          
		<?php	
	}

    if(isset($_REQUEST['product_row_index'])) {
        $selected_stock_date = ""; $product_row_index = ""; $selected_store_room_id = ""; $selected_quantity = ""; $selected_row_unit_id = "";
        $product_row_index = $_REQUEST['product_row_index'];
        $selected_stock_date = $_REQUEST['selected_stock_date'];
        $selected_store_room_id = $_REQUEST['selected_store_room_id'];
        $selected_quantity = $_REQUEST['selected_quantity'];
        $quantity = $_REQUEST['selected_quantity']; 
        ?>
        <tr class="product_row" id="product_row<?php echo $product_row_index; ?>">
            <th class="sno text-center px-2 py-2"><?php if(!empty($product_row_index)) { echo $product_row_index; } ?></th>
            <th class="text-center px-2 py-2">
                <?php
                    if(!empty($selected_stock_date)) {
                        echo date('d-M-Y', strtotime($selected_stock_date));
                    }
                ?>
                <input type="hidden" name="stock_dates[]" value="<?php if(!empty($selected_stock_date)) { echo $selected_stock_date; } ?>">
            </th>
            
            <th class="text-center px-2 py-2">
                <?php
                    $store_room_name = "";
                    $store_room_name = $obj->getTableColumnValue($GLOBALS['store_room_table'], 'store_room_id', $selected_store_room_id, 'store_room_name');
                    if($store_room_name != $GLOBALS['null_value']) {
                        echo $obj->encode_decode('decrypt', $store_room_name);
                    }
                ?>
                <input type="hidden" name="store_room_ids[]" value="<?php if(!empty($selected_store_room_id)) { echo $selected_store_room_id; } ?>">
            </th>
            <th class="text-center px-2 py-2" style="width: 20%;">
                <input type="text" name="quantitys[]" class="form-control shadow-none" value="<?php if(!empty($selected_quantity)) { echo $selected_quantity; } ?>" onfocus="Javascript:KeyboardControls(this,'number',5,'');">
                
            </th>

            <th class="text-center px-2 py-2">
                <button class="btn btn-danger" type="button" onclick="Javascript:DeleteCreationRow('product', '<?php echo $product_row_index; ?>');"><i class="fa fa-trash"></i></button>
            </th>
        </tr>
        <?php
    }

    
    if(isset($_REQUEST['delete_product_id'])) {
        $delete_product_id = $_REQUEST['delete_product_id'];
        $delete_product_id = trim($delete_product_id);
        $msg = "";
        if(!empty($delete_product_id)) {	
            $product_unique_id = ""; $voucher_unique_id = ""; $voucher_id = "";
            $product_unique_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $delete_product_id, 'id');
            if(preg_match("/^\d+$/", $product_unique_id)) {
                $product_name = "";
                $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $delete_product_id, 'product_name');
            
                $action = "";
                $product_delete = "0";
                $product_delete = $obj->DeleteProduct($delete_product_id);
                if($product_delete == '1') {
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['product_table'], $product_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "Can't Delete.";
                }
            }
            else {
                $msg = "Invalid Product";
            }
        }
        else {
            $msg = "Empty Product";
        }
        echo $msg;
        exit;	
    } 

    if(isset($_REQUEST['check_product_count'])){
        $check_product_count = $_REQUEST['check_product_count'];
    
        $product_list = array();
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '','');
        
        if(!empty($product_list)){
            echo $product_count = count($product_list);
        }
    }

    if(isset($_REQUEST['clear_product_tables'])) {
        $clear_product_tables = $_REQUEST['clear_product_tables'];
        if(!empty($clear_product_tables) && $clear_product_tables == 1) {
            $clear_records = 1;
            $tables = array($GLOBALS['product_table']);
            $clear_records = $obj->setClearTableRecords($tables);
            echo $clear_records;
            exit;
        }
    }
    ?>

    