<?php
    include("include_user_check_and_files.php");
   
    if(isset($_REQUEST['show_upload_excel'])) {
		$show_upload_excel = $_REQUEST['show_upload_excel'];
		if(!empty($show_upload_excel) && $show_upload_excel == 1) { ?>
			<form class="py-4 poppins pd-20" name="excel_upload_form" method="POST">
                <div class="col-12 my-3">
                    <div class="excel_back_upload_details back_button">
                        <button  onclick="window.open('product.php','_self')" style="font-size:11px;color:white;padding:5px 7px;margin-left:24px;" class=" btn btn-danger" type="button"><i class="fa fa-chevron-circle-left"></i> Back</button><br>
                    </div> 
                </div>
                <div class="col-12 my-3" style="position: relative;">
                    <div class="excel_upload_details" style="display: none;">
                        <span class="excel_upload_count"></span> upload in out of <span class="excel_upload_total_count"></span>
                    </div>
                </div>
				<div class="col-lg-11">
					<div class="col-12">
                        <input type="hidden" name="upload_row_index" value="1">
						<div class="table-responsive">
							<table id="excel_upload_details_table" class="data-table table tablefont" style="margin: auto;width:1355px;">
                                <tbody>
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align: center; width: 50px;">S.No</th>
                                            <th style="text-align: center; width: 125px;">Product Name</th>
                                            <th style="text-align: center; width: 125px;">Hsn Code</th>
                                            <th style="text-align: center; width: 125px;">Unit</th>
                                            <th style="text-align: center; width: 125px;">Rate</th> 
                                            <th style="text-align: center; width: 125px;">Tax</th> 
                                        </tr>
                                    </thead>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-12 pt-3 text-center">
						<button class="btn btn-primary btnwidth submit_button" disabled type="button" onClick="Javascript:UploadExcelData(event, 'excel_upload_form');">Submit</button>
					</div>
				</div>
			</form>
            <?php			
		}
	}

    if(isset($_REQUEST['excel_row_index'])) {
        $excel_row_index = ""; $excel_row_values = ""; $sno = ""; $product_name = ""; $product_name_error = "";$hsn_code_= ""; $hsn_code_error = ""; $unit_name = ""; $unit_name_error = "";  $product_price = ""; $product_price_error = ""; $upload_type = ""; $product_tax = ""; $product_tax_error = "";

        if(isset($_REQUEST['upload_type'])){
            $upload_type = $_REQUEST['upload_type'];
        }

        $excel_row_index = $_REQUEST['excel_row_index'];
        $excel_row_index = trim($excel_row_index);

		$excel_row_values = $_REQUEST['excel_row_values'];
		$excel_row_values = trim($excel_row_values);


        if(!empty($excel_row_values)) {
            $excel_row_values = json_decode($excel_row_values);

            if($excel_row_values['0'] != "undefined" && $excel_row_values['0'] != $GLOBALS['null_value']) {
				$sno = trim($excel_row_values['0']);
			}

            if(!empty($excel_row_values['1']) && $excel_row_values['1'] != 'undefined' && $excel_row_values['1'] != $GLOBALS['null_value']){
                $excel_row_values['1']=trim($excel_row_values['1']);
                $product_name = $excel_row_values['1'];
				$product_name_error = $valid->common_validation($product_name, "Product Name", "1");          
            }

            if(!empty($excel_row_values['2']) && $excel_row_values['2'] != 'undefined' && $excel_row_values['2'] != $GLOBALS['null_value']){
                $excel_row_values['2']=trim($excel_row_values['2']);
                $hsn_code = $excel_row_values['2'];
                $hsn_code_error = $valid->valid_hsn($hsn_code,$excel_row_values['2'],0);
            }

            if(!empty($excel_row_values['3']) && $excel_row_values['3'] != 'undefined' && $excel_row_values['3'] != $GLOBALS['null_value']){
                $excel_row_values['3']=trim($excel_row_values['3']);
                $unit_name = $excel_row_values['3'];
                $unit_error = $valid->common_validation($unit_name,$excel_row_values['3'],1);
            }

            if(!empty($excel_row_values['4']) && $excel_row_values['4'] != 'undefined' && $excel_row_values['4'] != $GLOBALS['null_value']){
                $excel_row_values['4']=trim($excel_row_values['4']);
                $product_rate = $excel_row_values['4'];
                $product_rate_error = $valid->valid_price($product_rate,$excel_row_values['4'],0);
            }
            
            if(!empty($excel_row_values['5']) && $excel_row_values['5'] != 'undefined' && $excel_row_values['5'] != $GLOBALS['null_value']){
                $excel_row_values['5']=trim($excel_row_values['5']);
                $product_tax = $excel_row_values['5'];
                $product_tax_error = $valid->valid_number($product_tax,$excel_row_values['5'],0);
            }
        }
        $row_id = date("dmyhis")."_".$excel_row_index;

        ?>
    
        <tr id="<?php if(!empty($row_id)) { echo $row_id; } ?>" class="excel_row">
            <td style="width: 10px; text-align: center;">
                <?php if(!empty($sno)) { echo $sno; } ?>
                <input type="hidden" name="excel_upload_type" value="<?php if(!empty($upload_type)) { echo $upload_type; } ?>" placeholder="excel_upload_type">
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="product_names" value="<?php if(!empty($product_name)) { echo $product_name; } ?>" placeholder="Product Name">
                <?php if(!empty($product_name_error)) { ?>
                <span class="infos"><?php $product_name_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="hsn_codes" value="<?php if(!empty($hsn_code)) { echo $hsn_code; } ?>" placeholder="Hsn Code" >
                <?php if(!empty($hsn_code_error)) { ?>
                <span class="infos"><?php $hsn_code_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="unit_names" value="<?php if(!empty($unit_name)) { echo $unit_name; } ?>" placeholder="Unit Name">
                <?php if(!empty($unit_name_error)) { ?>
                <span class="infos"><?php $unit_name_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="product_rates" value="<?php if(!empty($product_rate)) { echo $product_rate; } ?>" placeholder="Product Rate">
                <?php if(!empty($product_rate_error)) { ?>
                <span class="infos"><?php $product_rate_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="product_taxs" value="<?php if(!empty($product_tax)) { echo $product_tax; } ?>" placeholder="Product Tax">
                <?php if(!empty($product_tax_error)) { ?>
                <span class="infos"><?php $product_tax_error; ?></span>
                <?php } ?>
            </td>
            <td class="excel_upload_status" style="width: 50px;"></td>
        </tr>
        <?php
    }

    if(isset($_REQUEST['product_name'])) {
        $excel_upload_type=""; $excel_upload_error = ""; 
        $product_names= ""; $product_names_error = "";$hsn_codes = ""; $hsn_codes_error = ""; $unit_names = ""; $unit_names_error = ""; $product_rates = ""; $product_rates_error = ""; $product_taxs = 0; $product_taxs_error = ""; 
        
        
        if(isset($_REQUEST['excel_upload_type'])){
            $excel_upload_type = $_REQUEST['excel_upload_type'];
        }

        if(isset($_REQUEST['product_name'])){
            $product_names = $_REQUEST['product_name'];

            $product_names = trim($product_names);
            $product_names = str_replace("_____","#",$product_names);
            $product_names = str_replace("____","+",$product_names);
            $product_names = str_replace("___","&",$product_names);
            $product_names = str_replace("__",'"',$product_names);
            $product_names = str_replace("_","'",$product_names);

            if(empty($product_names)){
                $product_names_error = "Enter the Product Name";
            }

            if(!empty($product_names_error) ) {
                if(!empty($excel_upload_error)) {
                    $excel_upload_error = $excel_upload_error." ".$product_names_error;
                }
                else {
                    $excel_upload_error = $product_names_error;
                }
            }
        }

        if (isset($_REQUEST['hsn_code'])) {
            $hsn_codes = trim($_REQUEST['hsn_code']);

            $hsn_codes_error = $valid->valid_hsn($hsn_codes,'Hsn Code',0);

            if(!empty($hsn_codes_error) ) {
                if(!empty($excel_upload_error)) {
                    $excel_upload_error = $excel_upload_error." ".$hsn_codes_error;
                }
                else {
                    $excel_upload_error = $hsn_codes_error;
                }
            }
        }

        if (isset($_REQUEST['unit_name'])) {
            $unit_names = trim($_REQUEST['unit_name']);

            $unit_names_error = $valid->common_validation($unit_names,'Unit',1);

            if(!empty($unit_names_error) ) {
                if(!empty($excel_upload_error)) {
                    $excel_upload_error = $excel_upload_error." ".$unit_names_error;
                }
                else {
                    $excel_upload_error = $unit_names_error;
                }
            }
        }

        if (isset($_REQUEST['product_rate'])) {
            $product_rates = trim($_REQUEST['product_rate']);

            $product_rates_error = $valid->valid_price($product_rates,'Product Rate',0);

            if(!empty($product_rates_error) ) {
                if(!empty($excel_upload_error)) {
                    $excel_upload_error = $excel_upload_error." ".$product_rates_error;
                }
                else {
                    $excel_upload_error = $product_rates_error;
                }
            }
        }

        if(isset($_REQUEST['product_tax'])){
            $product_taxs = $_REQUEST['product_tax'];
            $product_taxs = trim($product_taxs);
        
            if(!empty($product_taxs)){
                $product_taxs = str_replace('%','',$product_taxs);
                if($product_taxs != '0' && $product_taxs != "5" && $product_taxs != "12" && $product_taxs != "18" && $product_taxs != "28"){
                    $product_taxs_error = "Invalid Tax";
                }
            } 
            
            if(!empty($tax_error)) {
                if(!empty($excel_upload_error)) {
                   $excel_upload_error = $excel_upload_error."<br>".$tax_error;
                }
                else {
                    $excel_upload_error = $tax_error;
                }
            }    
        }

        $result = ""; 
        if(empty($excel_upload_error)) {
            $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
            $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
            $bill_company_id = $GLOBALS['bill_company_id'];
            $null_value = $GLOBALS['null_value']; 

             if(!empty($unit_names)) {
                $lower_case_name = "";
                $lower_case_name = strtolower($unit_names);
                $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                $unit_names = $obj->encode_decode('encrypt',$unit_names);
                // $bill_company_id = $GLOBALS['bill_company_id'];

                $prev_unit_id = "";	
				if(!empty($lower_case_name)) {
                    $prev_unit_id = ""; $unit_error = "";
                    if(!empty($lower_case_name)) {
                        $prev_unit_id = $obj->getTableColumnValue($GLOBALS['unit_table'],'lower_case_name',$lower_case_name,'unit_id');
                    }
					if(empty($prev_unit_id)) {						
                        $action = ""; $unit_insert_id = "";
                        if(!empty($unit_names)) {
                            $action = "New unit Created. Name - ".$obj->encode_decode('decrypt', $unit_names);
                        }

                        $null_value = $GLOBALS['null_value'];
                        $columns = array();$values = array();
                        $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id',  'unit_id', 'unit_name', 'lower_case_name', 'deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$unit_names."'", "'".$lower_case_name."'", "'0'");
                        $unit_insert_id = $obj->InsertSQL($GLOBALS['unit_table'], $columns, $values, 'unit_id', '', $action);		
                        if(preg_match("/^\d+$/", $unit_insert_id)) {
                            $unit_id = $obj->getTableColumnValue($GLOBALS['unit_table'], 'id', $unit_insert_id, 'unit_id');

                            $product_unit_id = $unit_id;
                        }
                    }
                    else {
                        $product_unit_id = $prev_unit_id;
                    }
                }
            }

            if(!empty($product_names)){
                $lower_case_name = strtolower($product_names);
                $product_names = $obj->encode_decode('encrypt', $product_names);
                $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                if(!empty($hsn_codes)){
                    $hsn_codes = $obj->encode_decode('encrypt', $hsn_codes);
                }


                $prev_product_id = ""; $prev_product_name = "";$product_error = ""; 
                if(!empty($lower_case_name) && $lower_case_name != $GLOBALS['null_value']) {
                    $prev_product_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'lower_case_name', $lower_case_name, 'product_id');
                    if(!empty($prev_product_id)) {
                        $prev_product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $prev_product_id, 'product_name');
                        $prev_product_name =$obj->encode_decode('decrypt',$prev_product_name);
                        $product_error = "This Product Name already exists in ".$prev_product_name;
                    }
                }

  
                if(empty($prev_product_id)) {						
                    $action = "";
                    if(!empty($product_names)) {
                        $action = "New Product Created. Name - ".$obj->encode_decode('decrypt', $product_names);
                    }

                    $product_insert_id = ""; $null_value = $GLOBALS['null_value'];
                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id','product_name','lower_case_name','hsn_code','unit_id', 'unit_name', 'product_rate','product_id', 'product_tax','deleted');

                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'",  "'".$product_names."'", "'".$lower_case_name."'",  "'".$hsn_codes."'", "'".$product_unit_id."'", "'".$unit_names."'","'".$product_rates."'", "'".$null_value."'", "'".$product_taxs."'","'0'");
                    $product_insert_id = $obj->InsertSQL($GLOBALS['product_table'], $columns, $values,'product_id','', $action);

                    if(preg_match("/^\d+$/", $product_insert_id)) {
                        $result = 1;
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $product_insert_id);
                    }
                }
                else {
                    if($excel_upload_type == "2"){
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $prev_product_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            
                            if(!empty($item_name)) {
                                $action = "Product Updated. Name - ".$item_name;
                            }

                            $columns = array(); $values = array();						
                            $columns = array( 'creator_name', 'bill_company_id','product_name','lower_case_name','hsn_code','unit_id', 'unit_name', 'product_rate','product_id', 'product_tax', 'deleted');

                            $values = array("'".$creator_name."'", "'".$bill_company_id."'",   "'".$product_names."'", "'".$lower_case_name."'",  "'".$hsn_codes."'", "'".$product_unit_id."'", "'".$unit_names."'","'".$product_rates."'", "'".$null_value."'", "'".$product_taxs."'","'0'");

                            $product_update_id = $obj->UpdateSQL($GLOBALS['product_table'], $getUniqueID, $columns, $values, $action);
                            $result = $product_update_id;
                        }
                        else{
                            $result = $product_error;
                        }
                    }
                    else {
                        echo $excel_upload_error = $product_error;
                    }
                }
            }

           echo  $result; exit;
        } else{
            echo  $excel_upload_error;
        }
    }

    ?>

   