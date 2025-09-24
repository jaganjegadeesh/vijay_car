<?php 
	$page_title = "Purchase Tax Report";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }

	$company_state = ""; $party_state = ""; $gst_option = "";$party_name="";
	function combineAndSumUp ($myArray) {
		$finalArray = Array ();
		foreach ($myArray as $nkey => $nvalue) {
			$has = false;
			$fk = false;
			foreach ($finalArray as $fkey => $fvalue) {
				if ( ($fvalue['tax_value'] == $nvalue['tax_value']) && ($fvalue['hsn_value'] == $nvalue['hsn_value']) && ($fvalue['purchase_entry_number'] == $nvalue['purchase_entry_number'])) {
					$has = true;
					$fk = $fkey;
					break;
				}
			}
			if ( $has === false ) {
				$finalArray[] = $nvalue;
			} else {
				$finalArray[$fk]['total_amount'] += $nvalue['total_amount'];
				$finalArray[$fk]['quantity_value'] += $nvalue['quantity_value'];
				$finalArray[$fk]['purchase_entry_number'] = $nvalue['purchase_entry_number'];
			}

		}

		return $finalArray;

	}

    $party_list = array();
    $party_list = $obj->getPartyList('1'); 

    $to_date = "";
    $from_date = "";
    $filter_party_id="";

    if(isset($_POST['filter_party_id'])) {
        $filter_party_id = $_POST['filter_party_id'];
    }
    
    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date("Y-m-d"); 
    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    } 


    $total_records_list = array();
    $total_records_list = $obj->GetPurchaseTaxReport($filter_party_id,$from_date,$to_date);

    if(!empty($filter_party_id)){
        $party_name =$obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$filter_party_id,'party_name');
        $party_name = $obj->encode_decode('decrypt',$party_name);
    }

    $excel_download_name ="";
    $excel_download_name = "Purchase Tax Report -".$party_name ." (".$from_date ." to ".$to_date .")";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/xlsx.full.min.js"></script>

</head>	
<body>
<?php include "header.php"; ?>
<!--Right Content-->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                        <div class="border card-box" id="table_records_cover">
                            <div class="card-header align-items-center">
                                <form name="purchase_tax_report_form" method="POST">
                                    <div class="row justify-content-end py-2 px-2 mt-3">
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-1">
                                                <div class="form-label-group in-border pb-2">
                                                    <input type="date" id="from_date" name="from_date" class="form-control shadow-none" placeholder="" value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>" onchange = "Javascript:getOverallReport();">
                                                <label>From Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-1">
                                                <div class="form-label-group in-border pb-2">
                                                    <input type="date" id="to_date" name="to_date" class="form-control shadow-none" placeholder="" value="<?php if(!empty($to_date)) { echo $to_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>" onchange = "Javascript:getOverallReport();">
                                                    <label>To Date</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border mb-0">
                                                    <select class="select2 select2-danger" name="filter_party_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onChange="Javascript:getOverallReport();">
                                                        <option value="">Select Party Name</option>
                                                        <?php
                                                        if(!empty($party_list)) {
                                                            foreach($party_list as $data) {
                                                                ?>
                                                                <option value="<?php if(!empty($data['party_id'])) { echo $data['party_id']; } ?>"<?php if(!empty($filter_party_id)){ if($filter_party_id == $data['party_id']){ echo "selected"; } } ?>>
                                                                    <?php
                                                                        if(!empty($data['name_mobile_city'])) {
                                                                            $data['name_mobile_city'] = $obj->encode_decode('decrypt', $data['name_mobile_city']);
                                                                            echo $data['name_mobile_city'];
                                                                            
                                                                        }
                                                                    ?>
                                                                </option>
                                                                    <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label>Select Party</label>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-4">
                                            <button class="btn btn-danger m-1" style="font-size:11px;" type="button" onClick="ExportToExcel()"> <i class="fa fa-download"></i> Export </button>
                                        </div>
                                    </div>                                                
                                </form>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table id='tbl_purchase_tax_list' class="table display report_table" style="width: 1000px;" >
                                        <thead>
                                            <tr style="border-top: 1px solid #000!important;cursor:pointer" >
                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3">S.No</th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3">Bill.No & Date</th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3">party Name & Identification</th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="10">Tax Details</th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3"> Charges Value </th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3">Taxable Value</th>

                                                
                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="3"> Tax Value </th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3">Total Tax Value</th>
                                                
                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="3">Total Amount</th>
                                            </tr>

                                            <tr>
                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="2"> 0% </th> 

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="2"> 5% </th> 

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="2"> 12% </th> 

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="2"> 18% </th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" colspan="2"> 28% </th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="2"> CGST </th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="2"> SGST </th>

                                                <th class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" rowspan="2"> IGST </th>

                                            </tr>

                                            <tr style="border-top:0;">
                                                <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"> Quantity</th>

                                                <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Value</th>

                                                <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">HSN & <br> Quantity</th>

                                                <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Value</th>

                                                <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">HSN & <br> Quantity</th>

                                                <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Value</th>

                                                <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">HSN & <br> Quantity</th>

                                                <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Value</th>

                                                <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">HSN & <br> Quantity</th>

                                                <th style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Value</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $index = "";

                                                if(!empty($total_records_list)) {
                                                    $net_amount = 0; $net_tax = 0; $cgst_net_tax = 0; $igst_net_tax = 0; $net_product_tax = 0; $grand_charges = 0; $grand_charges_amount = 0;$sub_total_amnt = 0;$grand_loading_charge_amount =0;$grand_loading_charges =0; $total_amount = 0; $other_charges_id = array(); $other_charges_total = 0; $other_charges_values = array(); $charges_type = array();
                                                    $charges_total = 0; $loading_charges_total = 0; $dis_pro_amt = 0; $total_product_amount = 0;
                                                    $charges_amt = 0; $dis_value = 0; $taxable_value = 0; $total_tax_value_tbl = 0; $bill_value = 0; $cgst_value_tbl = 0; $sgst_value_tbl = 0; $igst_value_tbl = 0;
                                                    $total_cgst_value = 0; $total_igst_value = 0; $total_sgst_value = 0;  $total_charges_amt = 0; $total_taxable_value = 0; $tax_value_tbl = 0; $bill_total_value = 0; $total_other_charges = 0; 
                                                    $grand_charges_amt =0; 

                                                    foreach($total_records_list as $key => $data) {

                                                        $gst_number = ""; $tax_value = array(); $final_rate = array();  $quantity_values = array(); $total_discount_amt =0;
                                                        $product_hsn_code = array(); $sub_total_amt = 0; 
                                                        $rate_values =array(); $hsn_sac = ""; $party_state = ""; $tax_option =''; $purchase_date = ""; 
                                                        $purchase_entry_number = ""; $party_name = ""; $product_discount = array(); 
                                                        $charges_values = array(); $charges_value = 0; $greater_tax = 0; $identification = "";  $charges_total = 0;
                                                        $individual_tax = array();$charges=0; $discount_value =0;$loading_charges =0; $row_amount = array();
                                                        $discounts = array(); $sub_total_savings = 0;
                                                        $index = $key + 1;
                                                        $discount_values = ''; $bill_number = "";
                                                        $discount_value = ""; $purchase_entry_number = ""; $net_total = 0; $product_ids = ""; $tax_value1 = ""; $grand_discount = 0; $sub_total = 0; $total_discount = 0; $company_state = ""; 
                                                        $final_amount =0;
                                                            if(!empty($data['purchase_entry_date'])) {
                                                            $purchase_entry_date = date('Y-m-d', strtotime($data['purchase_entry_date']));
                                                        }
                                                        if(!empty($data['purchase_entry_number']) && $data['purchase_entry_number'] != $GLOBALS['null_value']) {
                                                            $purchase_entry_number = $data['purchase_entry_number'];
                                                        }
                                                        
                                                        if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                                                            $party_id = $data['party_id'];
                                                        }
                                                        if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                                                            $final_amount = $data['total_amount'];
                                                        }
                                                        if(!empty($data['gst_option']) && $data['gst_option'] != $GLOBALS['null_value']) {
                                                            $gst_option = $data['gst_option'];
                                                        }
                                                        if(!empty($data['tax_type']) && $data['tax_type'] != $GLOBALS['null_value']) {
                                                            $tax_type = $data['tax_type'];
                                                        }
                                                        if($tax_type == 1) {
                                                            if(!empty($data['product_tax']) && $data['product_tax'] != $GLOBALS['null_value']) {
                                                                $product_tax = $data['product_tax'];
                                                                $product_tax = explode(",", $product_tax);
                                                                $tax_value = array_reverse($product_tax);
                                                                $product_tax = array_reverse($product_tax);
                                                            }
                                                        } else {
                                                            if(!empty($data['overall_tax']) && $data['overall_tax'] != $GLOBALS['null_value'])
                                                        {
                                                            $tax_value1 =$data['overall_tax'];
                                                            $overall_tax =$data['overall_tax'];
                                                        }
                                                        }
                                                        if(!empty($data['tax_option']) && $data['tax_option'] != $GLOBALS['null_value']) {
                                                            $tax_option = $data['tax_option'];
                                                        }
                                                        if(!empty($data['party_state']) && $data['party_state'] != $GLOBALS['null_value']) {
                                                            $party_state = $data['party_state'];
                                                        }

                                                        if(!empty($data['cgst_value']) && $data['cgst_value'] != $GLOBALS['null_value']) {
                                                            $cgst_value_tbl =  $data['cgst_value'];
                                                            if($data['deleted'] == '0'){
                                                                $total_cgst_value += $cgst_value_tbl;
                                                            }
                                                                
                                                        }

                                                        if(!empty($data['sgst_value']) && $data['sgst_value'] != $GLOBALS['null_value']) {
                                                            $sgst_value_tbl =  $data['sgst_value'];
                                                            if($data['deleted'] == '0'){
                                                                $total_sgst_value += $sgst_value_tbl;
                                                            }
                                                        }

                                                        if(!empty($data['igst_value']) && $data['igst_value'] != $GLOBALS['null_value']) {
                                                            $igst_value_tbl =  $data['igst_value'];
                                                            if($data['deleted'] == '0'){
                                                                $total_igst_value += $igst_value_tbl;
                                                            }
                                                            
                                                        }

                                                        if(!empty($data['total_tax_value']) && $data['total_tax_value'] != $GLOBALS['null_value']) {
                                                            $tax_value_tbl = $data['total_tax_value'];
                                                        }

                                                        if(!empty($data['amount']) && $data['amount'] != $GLOBALS['null_value']) {
                                                            $amount = $data['amount'];
                                                            $amount = explode(",", $amount);
                                                            $amount = array_reverse($amount);
                                                        }
                                                        if(!empty($data['discount']) && $data['discount'] != $GLOBALS['null_value']) {
                                                            $discount = $data['discount'];
                                                        }
                                                        if(!empty($data['discount_value']) && $data['discount_value'] != $GLOBALS['null_value']) {
                                                            $discount_value = $data['discount_value'];
                                                        }
                                                        if(!empty($data['charges']) && $data['charges'] != $GLOBALS['null_value']) {
                                                            $charges = $data['charges'];
                                                        }
                                                        if(!empty($data['charges_value']) && $data['charges_value'] != $GLOBALS['null_value']) {
                                                            $charges_value = $data['charges_value'];
                                                        }
                                                        if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                                                            $total_amount = $data['total_amount'];
                                                        }
                                                        if(!empty($data['purchase_entry_id']) && $data['purchase_entry_id'] != $GLOBALS['null_value']) {
                                                            $purchase_entry_id = $data['purchase_entry_id'];
                                                        }
                                                        if(!empty($data['total_qty']) && $data['total_qty'] != $GLOBALS['null_value']) {
                                                            $total_qty = $data['total_qty'];
                                                            $total_qty = explode(",", $total_qty);
                                                            $total_qty = array_reverse($total_qty);
                                                        }
                                                        if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                                                            $quantity = $data['quantity'];
                                                            $quantity = explode(",", $quantity);
                                                            $quantity = array_reverse($quantity);
                                                        }
                                                        if(!empty($data['charges_tax']) && $data['charges_tax'] != $GLOBALS['null_value']) {
                                                            $charges_tax = $data['charges_tax'];
                                                            $charges_tax = explode(",", $charges_tax);
                                                            $charges_tax = array_reverse($charges_tax);
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
                                                            $row_amount = $product_amount;
                                                        }
                                                        if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                                                            $product_ids = $data['product_id'];
                                                            $product_ids = explode(",", $product_ids);
                                                            $product_count = count($product_ids);
                                                            $product_ids = array_reverse($product_ids);
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
                                                            $charges_tax_array[0] = $overall_tax;
                                                        }

                                                        $company_state = $obj->getTableColumnValue($GLOBALS['company_table'],'company_id',$data['bill_company_id'],'state');
                                                        $company_state = $obj->encode_decode('decrypt',$company_state);


                                                        for($p = 0; $p < count($product_ids); $p++) { 
                                                            $row_amount[$p] = trim($row_amount[$p]);
                                                            if(!empty($row_amount[$p])){
                                                                $amount = $row_amount[$p];
                                                                $sub_total += $amount;
                                                                $sub_total_savings += $amount;
                                                                $total_product_amount = $sub_total_savings;
                                                            }
                                                        }

                                                        $overall_discount = 0;  
                                                        for($j=0;$j < count($product_ids);$j++){

                                                            if($tax_type == 2) {
                                                                if(!empty($tax_value1)){
                                                                    $tax_value[$j] = $tax_value1;
                                                                }
                                                            }


                                                            // if(!empty($tax_value[$j])){
                                                                $each_row_Amount = 0;  $overall_discount = 0;
                                                                $amount = $row_amount[$j];
                                                                $each_row_Amount = $row_amount[$j];
                                                                
                                                                if(!empty($discount_value)) {
                                                                    if(!empty($discount_value)) {
                                                                        $discount_per = (100 * $discount_value) / $sub_total_savings;
                                                                    }

                                                                    if(!empty($discount_per)) {
                                                                        $discount_amt = ($each_row_Amount * $discount_per) / 100;
                                                                        $each_row_Amount = $each_row_Amount - $discount_amt;
                                                                    }
                                                                }
                                                                
                                                                if(!empty($each_row_Amount)) {
                                                                    $each_row_Amount = number_format($each_row_Amount, 2);
                                                                    $each_row_Amount = str_replace(",", "", $each_row_Amount);
                                                                    $sub_total_amt +=$each_row_Amount;
                                                                }

                                                                $product_hsn_code = "";

                                                                if(!empty($product_ids[$j])){
                                                                    $product_hsn_code = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$j],'hsn_code');
                                                                    $product_hsn_code = $obj->encode_decode('decrypt',$product_hsn_code);
                                                                }
                                                            

                                                                $individual_tax[] = array('hsn_value' => $product_hsn_code,'tax_value' => $tax_value[$j], 'total_amount' => $each_row_Amount,'quantity_value' => $quantity[$j],'purchase_entry_number' => $purchase_entry_number);
                                                            // }
                                                        }

                                                        // print_r($individual_tax);


                                                        array_multisort(array_column($individual_tax, "purchase_entry_number"), SORT_ASC,array_column($individual_tax, "hsn_value"), SORT_ASC,array_column($individual_tax, "tax_value"), SORT_ASC, $individual_tax);

                                                        $is_per =0; $charges_amt = 0; $charges_total = 0;
                                                        $total_discount_amt = $sub_total_amt; $charges = "";
                                                    
                                                        if(!empty($charges_value)) {
                                                            if($gst_option == 1) {
                                                                $charges = trim($charges_value);
                                                            }
                                                            // echo $total_discount_amt."<br>";
                                                            if(strpos($charges, '%') !== false) {
                                                                $charges = str_replace('%', '', $charges);
                                                                $charges = trim($charges);
                                                                $charges_amt = (($charges * $total_discount_amt) / 100); 
                                                                $charges_total += $charges_amt;
                                                            }
                                                            else {
                                                                $charges_amt = $charges_value;
                                                                $charges_total += $charges_amt;
                                                            }
                                                        } 

                                                        
                                                            if(!empty($charges_total)){
                                                                // echo $sub_total_amt;
                                                                $total_product_amount = $sub_total_amt + $charges_total;
                                                                $taxable_value = $total_product_amount;
                                                            }else {
                                                                $taxable_value = $sub_total_amt;
                                                            }
                                                        
                                                        

                                                        if(!empty($prefix)) { $index = $index + $prefix; } ?>
                                                        <tr>
                                                            <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo $index; ?></td>
                                                            <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                <?php 
                                                                    if(!empty($data['purchase_entry_date'])) { 
                                                                        $purchase_entry_date = date("d-m-Y", strtotime($data['purchase_entry_date']));
                                                                    } 

                                                                    if(!empty($data['purchase_entry_number'])) {
                                                                        $purchase_entry_number = $data['purchase_entry_number'];
                                                                    }

                                                                    echo $purchase_entry_number.' <br> '.$purchase_entry_date;

                                                                    if($data['deleted'] == 1){ ?>
                                                                        <span style="color: red;"><?php echo "<br>"."Cancelled"; ?></span>
                                                                    <?php  } 
                                                                ?>
                                                            </td>
                                                            <td class="px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                <div class="w-100">
                                                                    <?php
                                                                        $party_id = "";
                                                                        if(!empty($data['party_id'])) {
                                                                            $party_name = $obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$data['party_id'],'party_name');

                                                                            echo $obj->encode_decode('decrypt',$party_name);

                                                                            $party_city = "";

                                                                            $party_city = $obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$data['party_id'],'city');

                                                                            $identification = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $data['party_id'], 'identification');
                                                                            if(!empty($identification) && $identification != $GLOBALS['null_value']) {
                                                                            }
                                                                            else{
                                                                                $identification = "";
                                                                            }
                                                                            if(!empty($identification)){

                                                                                echo ' - '.$obj->encode_decode('decrypt',$identification);

                                                                            }

                                                                        }

                                                                    ?>
                                                                </div>

                                                            </td>


                                                            <?php
                                                            $tax_amount = 0; $tax_amount1 = 0; $strtax_value = ""; $k=0; $strtax_amount = 0; $product_hsn_sac =array(); $final_array = array(); $total_tax_value = 0; $tax_total =0; $tax_plus_value1 = 0; $grand_amount = 0; $hsn_sac = array();

                                                                $final_array = combineAndSumUp($individual_tax);

                                                                $zero_per = 0; $five_per = 0; $twelve_per = 0; $eighteen_per = 0; $twenty_eight_per = 0; $zero_hsn_quantity = ""; $five_hsn_quantity = ""; $twelve_hsn_quantity = ""; $eighteen_hsn_quantity = ""; $twenty_eight_hsn_quantity = ""; $product_tax = 0; $five_percentage = 100; $twelve_percentage = 100; $eighteen_percentage = 100; $twenty_eight_percentage = 100; $hsn_sac = array();
                                                                // print_r($final_array); 
                                                                // echo "<br>";
                                                                $deleted = 0;
                                                                foreach($final_array as $tax_data) {
                                                                    $per_available=strpos($tax_data['tax_value'],'%');
                                                                    $discounted_product_amount = 0;
                                                                    $deleted = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'],'purchase_entry_number',$data['purchase_entry_number'],'deleted');
                                                                    $tax_per = 0;
                                                                    if(!empty($per_available)){
                                                                        $tax_per=str_replace("%"," ",$tax_data['tax_value']);
                                                                    }else{
                                                                        $tax_per=$tax_data['tax_value'];
                                                                    }

                                                                    $tax_per = str_replace(" ","",$tax_per);
                                                                    $dis_value = 0;
                                                                    $discounted_product_amount = $tax_data['total_amount'];
                                                                    
                                                                    if($tax_per == "0")
                                                                    { 
                                                                        if(!empty($tax_data['total_amount'])) {
                                                                            if(!empty($zero_hsn_quantity)){
                                                                                $zero_hsn_quantity.='<br>';
                                                                            }

                                                                            $zero_hsn_quantity.= $tax_data['hsn_value'].' :: '.$tax_data['quantity_value'] - $total_discount_amt;

                                                                            $zero_per+= $discounted_product_amount;

                                                                            $grand_amount += ($discounted_product_amount); 

                                                                        } 

                                                                    }

                                                                    if($tax_per == "5")

                                                                    { 

                                                                        if(!empty($tax_data['total_amount'])) {

                                                                            if(!empty($five_hsn_quantity)){

                                                                                $five_hsn_quantity.='<br>';

                                                                            }

                                                                            $five_hsn_quantity.= $tax_data['hsn_value'].' :: '.$tax_data['quantity_value']; 

                                                                            $five_per+= $discounted_product_amount;

                                                                            $product_tax+=(($discounted_product_amount*5)/$five_percentage);

                                                                            $grand_amount += ($discounted_product_amount); 
                                                                        } 
                                                                        
                                                                    }

                                                                    if($tax_per == "12"){ 
                                                                        if(!empty($tax_data['total_amount'])) {
                                                                            if(!empty($twelve_hsn_quantity)){
                                                                                $twelve_hsn_quantity.='<br>';
                                                                            }

                                                                            $twelve_hsn_quantity.= $tax_data['hsn_value'].' :: '.$tax_data['quantity_value']; 

                                                                            // echo $discounted_product_amount." / ". $charges_total;
                                                                            $twelve_per+= $discounted_product_amount;

                                                                            // echo $twelve_per."hi";

                                                                            $product_tax+=(($discounted_product_amount*12)/$twelve_percentage);

                                                                            $grand_amount += ($discounted_product_amount); 
                                                                        } 

                                                                    }

                                                                    

                                                                    if($tax_per == "18")
                                                                    { 
                                                                        if(!empty($tax_data['total_amount'])) {  
                                                                            if(!empty($eighteen_hsn_quantity)){

                                                                                $eighteen_hsn_quantity.='<br>';

                                                                            }

                                                                            $eighteen_hsn_quantity.= $tax_data['hsn_value'].' :: '.$tax_data['quantity_value'];

                                                                            $eighteen_per+= $discounted_product_amount;
                                                                            $product_tax+=(($discounted_product_amount*18)/$eighteen_percentage);

                                                                            $grand_amount += ($discounted_product_amount); 
                                                                        } 

                                                                    }

                                                                    if($tax_per == "28")
                                                                    { 

                                                                        if(!empty($tax_data['total_amount'])) {  

                                                                            if(!empty($twenty_eight_hsn_quantity)){

                                                                                $twenty_eight_hsn_quantity.='<br>';

                                                                            }

                                                                            $twenty_eight_hsn_quantity.= $tax_data['hsn_value'].' :: '.$tax_data['quantity_value'];

                                                                            $twenty_eight_per+= $discounted_product_amount;

                                                                            $product_tax+=(($discounted_product_amount*28)/$twenty_eight_percentage);

                                                                            $grand_amount += ($discounted_product_amount); 

                                                                        } 

                                                                    }

                                                                }


                                                                $percentage = 100;

                                                                if($zero_per!="0"){
                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$zero_hsn_quantity.'</td>';

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$zero_per.'</td>';

                                                                }else{

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                }

                                                                if($five_per!="0"){

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$five_hsn_quantity.'</td>';

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$five_per.'</td>';
                                                                }

                                                                else{

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                }
                                                                if($twelve_per!="0"){

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$twelve_hsn_quantity.'</td>';

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$twelve_per.'</td>';
                                                                }

                                                                else{

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                }

                                                                if($eighteen_per!="0"){

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$eighteen_hsn_quantity.'</td>';

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$eighteen_per.'</td>';

                                                                }

                                                                else{

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                }

                                                                if($twenty_eight_per!="0"){

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$twenty_eight_hsn_quantity.'</td>';

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">'.$twenty_eight_per.'</td>';

                                                                }

                                                                else{

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                    echo '<td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>';

                                                                } 

                                                                if(!empty($product_tax) && !empty($charges_values)){
                                                                    $product_tax += $charges_tax;
                                                                } ?>

                                                                <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo number_format($charges_total,2); 
                                                                if($deleted == '0'){
                                                                    $grand_charges_amt +=$charges_total;
                                                                }
                                                                ?></td> 

                                                                <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo number_format($taxable_value,2);
                                                                    if($deleted == '0'){
                                                                        $total_taxable_value += $taxable_value;
                                                                    }
                                                                ?></td>

                                                                <?php
                                                                if($company_state==$party_state){ ?>

                                                                    <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo number_format($cgst_value_tbl,2); ?></td>

                                                                    <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo number_format($sgst_value_tbl,2); ?></td>

                                                                    <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>

                                                                <?php 
                                                                    if($deleted == '0'){
                                                                        $total_tax_value += $product_tax; 
                                                                        $cgst_net_tax += $total_tax_value;
                                                                    }
                                                                }

                                                                else { ?>

                                                                    <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>

                                                                    <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"></td>

                                                                    <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo number_format($igst_value_tbl,2); ?></td>

                                                                <?php  
                                                                    if($deleted == '0'){ 
                                                                        $total_tax_value += $product_tax; 
                                                                        $igst_net_tax += $total_tax_value; 
                                                                    }
                                                                } 

                                                                ?>

                                                                <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                    <?php 
                                                                        $after_tax_amount = 0;
                                                                        echo number_format($tax_value_tbl,2);
                                                                        
                                                                        if($data['deleted'] == '0'){
                                                                            $total_tax_value_tbl += $tax_value_tbl; 
                                                                        }
                                                                    ?>
                                                                </td>

                                                                <td class="text-center px-2 py-2" style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                    <?php 
                                                                    // echo $grand_amount." / ".$tax_value_tbl."  / ".$overall_discount." / ".$charges_total;  
                                                                    $bill_value =  $final_amount; ?>
                                                                    <?php echo number_format($bill_value,2); 
                                                                    if($data['deleted'] == '0'){
                                                                        $bill_total_value += $bill_value;
                                                                    }
                                                                    ?>
                                                                </td>
                                                        </tr>

                                                        <?php

                                                        $net_amount += round($final_amount);

                                                        $net_product_tax+=$product_tax; } ?>

                                                    <tr>

                                                        <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;" colspan="13">Total</td>

                                                        <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo number_format($grand_charges_amt,2); ?></td>

                                                        <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo number_format($total_taxable_value,2); ?></td>

                                                        <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo number_format($total_cgst_value,2); ?></td>

                                                        <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo number_format($total_sgst_value,2); ?></td>

                                                        <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo number_format($total_igst_value,2); ?></td>

                                                        <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo number_format($total_tax_value_tbl,2); ?></td>

                                                        <td class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000 !important; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;"><?php echo round($bill_total_value).'.00'; ?></td>

                                                    </tr>

                                                <?php }
                                                else { ?>
                                                    <tr>
                                                        <td class="text-center" style="width: 100%;" colspan="100%">Sorry! No records found</td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if($index == 1){ ?>
                                                    <tr style="height:40px;"></tr>
                                                <?php } 
                                            ?>
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>          
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    jQuery(document).ready(function(){
        jQuery('.add_update_form_content').find('select').select2();
    });
</script>
<script>
    $(document).ready(function(){
        $("#purchasetaxreport").addClass("active");
        table_listing_records_filter();
    });
</script>
<script>
    function getOverallReport(){
        if(jQuery('form[name="purchase_tax_report_form"]').length > 0){
                jQuery('form[name="purchase_tax_report_form"]').submit();
        }
        
    }

    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_purchase_tax_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('purchase_tax_report.' + (type || 'xlsx')));
        window.open("purchase_tax_report.php","_self");
    }
</script>