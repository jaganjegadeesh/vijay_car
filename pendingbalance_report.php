<?php 
	$page_title = "Pending Balance Report";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }
    
    $filter_party_id =""; 
    $bill_company_id =$GLOBALS['bill_company_id'];

    $to_date = date('Y-m-d');  $current_date = date('Y-m-d');

    $from_date = date('Y-m-d', strtotime('-30 days', strtotime($to_date)));
    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }

    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }

    $filter_party_id ="";
    if(isset($_POST['filter_party_id'])) {
        $filter_party_id = $_POST['filter_party_id'];
        
    }

    $party_list = array();
    $party_list = $obj->getTableRecords($GLOBALS['party_table'],'','','');

    $total_records_list =array();
    $total_records_list = $obj->balance_report($bill_company_id,$filter_party_id,$from_date,$to_date);
    

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
                        <div class="card">
                            <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                            <div class="border card-box bg-white" id="table_records_cover">
                                <form name="pending_balance_report_form" method="POST">
                                    <div class="row  px-2 my-3">
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border mb-0">
                                                    <select class="select2 select2-danger" name="filter_party_id" data-dropdown-css-class="select2-danger"  style="width: 100%;" onchange="Javascript:getReport();">
                                                        <option value="">Select</option>
                                                        <?php
                                                            if(!empty($party_list)) {
                                                                foreach($party_list as $data) {
                                                                    ?>
                                                                    <option value="<?php if(!empty($data['party_id'])) { echo $data['party_id']; } ?>" <?php if(!empty($filter_party_id)){ if($filter_party_id == $data['party_id']){ echo "selected"; } } ?>>
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
                                                    <label>Party Name</label>
                                                </div>
                                            </div>        
                                        </div>
                                        <?php if(!empty($filter_party_id)){ ?>
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-1">
                                                <div class="form-label-group in-border pb-2">
                                                    <input type="date" id="from_date" name="from_date" class="form-control shadow-none" onchange="Javascript:getReport();checkDateCheck();" value="<?php if(!empty($from_date)){ echo $from_date; }?>" placeholder="" required="" max="<?php if(!empty($current_date)){ echo $current_date; }?>">
                                                    <label>From Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php  } ?>
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-1">
                                                <div class="form-label-group in-border pb-2">
                                                    <input type="date" id="to_date" name="to_date" class="form-control shadow-none"  onchange="Javascript:getReport();checkDateCheck();"  value="<?php if(!empty($to_date)){ echo $to_date; }?>" placeholder="" required="" max="<?php if(!empty($current_date)){ echo $current_date; }?>">
                                                    <label>To Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-12">
                                            <button class="btn btn-primary py-2 " style="font-size:12px; width:75px;" type="button" onClick="window.open('reports/rpt_pending_balance.php?filter_party_id=<?php echo $filter_party_id; ?>&from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>')"> <i class="fa fa-print"></i> Print </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row m-0">
                                <div class="table-responsive">
                                    <?php if(!empty($filter_party_id)) { ?>
                                        <table cellpadding="0" cellspacing="0" class="table display report_table no_number_Format" style="width: 100%; border:solid 1px black;margin: 0 2px;">
                                            <thead class="smallfnt">
                                                <tr>
                                                    <th colspan="7" style="border-top: 1px solid #000!important; border-left: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 3px; font-size: 13px;">
                                                        Pending Payment Overall - <?php echo "( ".date('d-m-Y', strtotime($from_date)) ." - " .date('d-m-Y', strtotime($to_date))." )"; ?> <br>
                                                        <?php
                                                            $party_name = "";
                                                            if(!empty($filter_party_id)) {
                                                                $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $filter_party_id, 'name_mobile_city');
                                                                
                                                                if(!empty($party_name)) { 
                                                                    $party_name = $obj->encode_decode('decrypt', $party_name);
                                                                    echo $party_name; 
                                                                }            
                                                            }
                                                            
                                                            
                                                        ?>
                                                    </th>
                                                </tr>
                                                <tr >
                                                    <th style="border-top: 1px solid #000!important; border-left: 1px solid #000!important; border-bottom: 1px solid #000!important; border-right: 1px solid #000!important; text-align: center; padding: 3px; font-size: 13px;">S.No</th>
                                                    <th style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Date</th>
                                                    <th style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Bill No</th>
                                                    <th style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Type</th>
                                                    <th style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Payment Mode</th>
                                                    <th style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Credit</th>
                                                    <th style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Debit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $credit_amount = 0; $debit_amount = 0; $total =0;  $total_credit = 0;
                                                    $total_debit = 0;
                                                        $opening_balance_list = array();
                                                        $opening_balance_list = $obj->getOpeningBalance($filter_party_id,$from_date,$to_date,$bill_company_id);

                                                        $opening_debit = 0; $opening_credit = 0;
                                                        if(!empty($opening_balance_list)) {
                                                            foreach($opening_balance_list as $data) {
                                                                if(!empty($data['debit'])) {
                                                                    $opening_debit += $data['debit'];
                                                                }

                                                                if(!empty($data['credit'])) {
                                                                    $opening_credit += $data['credit'];
                                                                }
                                                                
                                                            }
                                                        }
                                                        if(!empty($data['opening_balance']))
                                                        {
                                                            if($data['opening_balance_type'] == 'Credit')
                                                            {
                                                                $opening_credit += $data['opening_balance'];
                                                            }
                                                            if($data['opening_balance_type'] == 'Debit')
                                                            {
                                                                $opening_debit += $data['opening_balance'];
                                                            }
                                                        }
                                                        ?>
                                                        <tr>
                                                            <th colspan="5" style="text-align: right; border: 1px solid #000; padding: 5px 10px; white-space: inherit;">
                                                                Opening Balance
                                                            </th>
                                                            <th style="text-align: right; border: 1px solid #000; padding: 5px 10px; white-space: inherit;">
                                                                <?php
                                                            
                                                                    if($opening_credit > $opening_debit) {
                                                                        $total_credit = $opening_credit - $opening_debit;
                                                                        echo $obj->numberFormat($total_credit, 2);
                                                                    } 
                                                                ?>
                                                            </th>
                                                            <th style="text-align: right; border: 1px solid #000; padding: 5px 10px; white-space: inherit;">
                                                                <?php
                                                                    if($opening_debit > $opening_credit){
                                                                        $total_debit = $opening_debit - $opening_credit;
                                                                        echo $obj->numberFormat($total_debit, 2);
                                                                    } 
                                                                ?>
                                                            </th>
                                                        </tr>
                                                    <?php
                                                    if(!empty($total_records_list)) { ?>
                                                    <tbody>
                                                        <?php
                                                            $index = 1;
                                                            foreach ($total_records_list as $data) {
                                                                if($data['bill_type'] != 'Party Opening Balance'){
                                                                    ?>
                                                        
                                                                    <tr style="cursor:pointer">
                                                                        <td style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2"><?php echo $index; ?></td>
                                                                        <td  style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                            <?php echo date('d-m-Y', strtotime($data['bill_date'])); ?>
                                                                        </td>
                                                                        <td style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                            <?php echo $data['bill_number']; 
                                                                            ?>
                                                                        </td>
                                                                        <td style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                            <?php echo $data['bill_type']; ?>
                                                                        </td>
                                                                        
                                                                        
                                                                        <td style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="">
                                                                            <?php if(!empty($data['payment_mode_name']) && $data['payment_mode_name'] != $GLOBALS['null_value']) {
                                                                                $payment_mode_name = array();
                                                                                $payment_mode_name = explode(",", $data['payment_mode_name']);
                                                                                $payment_mode_name = array_reverse($payment_mode_name);

                                                                                $bank_id = explode(",",$data['bank_id']);
                                                                                $bank_id = array_reverse($bank_id);
                                                                                for($i=0; $i < count($payment_mode_name); $i++) {
                                                                                    $payment_mode ="";

                                                                                    $payment_mode =$obj->encode_decode("decrypt", $payment_mode_name[$i]);
                                                                                    
                                                                                    if (!empty($data['credit']) || !empty($data['debit'])) {
                                                                                        $amounts= array();
                                                                                        if($data['bill_type'] == 'Receipt'){
                                                                                            $amounts = explode(",", $data['credit']);
                                                                                        }else if($data['bill_type'] == 'Voucher' || $data['bill_type'] == 'Expense' || $data['bill_type'] == 'Advance Voucher'){
                                                                                            $amounts = explode(",", $data['debit']);
                                                                                        }
                                                                                        $amounts = array_reverse($amounts);
                                                                                    }
                                                                                    $bank_name = "";
                                                                                    if(!empty($bank_id[$i])){
                                                                                        $bank_name =  $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id[$i], 'bank_name');
                                                                                        $bank_name = $obj->encode_decode('decrypt',$bank_name);
                                                                                    }

                                                                                    if(!empty($bank_name)){
                                                                                        echo $payment_mode ." - ( ".$bank_name." ) - ".$obj->numberFormat($amounts[$i],2) ;
                                                                                    }else{
                                                                                        echo $payment_mode ." - ".$obj->numberFormat($amounts[$i],2) ;

                                                                                    }  
                                                                                    if($i < (count($payment_mode_name))-1) {
                                                                                    echo ", <br>";

                                                                                    }
                                                                                }
                                                                            }else{
                                                                                echo "-";
                                                                            } ?>
                                                                        </td>
                                                                        <td style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-end text-success px-2 py-2">
                                                                            <?php
                                                                                if(!empty($data['credit'] && $data['credit'] != $GLOBALS['null_value']))
                                                                                {
                                                                                    echo $obj->numberFormat($data['credit'], 2);
                                                                                    $total_credit += $data['credit'];
                                                                                    
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td style="border: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-end text-danger px-2 py-2">
                                                                            <?php
                                                                                if(!empty($data['debit'] && $data['debit'] != $GLOBALS['null_value']))
                                                                                {   echo $obj->numberFormat($data['debit'], 2);
                                                                                    $total_debit += $data['debit'];
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                            
                                                                    <?php $index++;
                                                                }
                                                                
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="5" style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 12px; vertical-align: middle; height: 30px;">Total</th>
                                                            <th class="sales_total" style="border: 1px solid #000; width: 100px; text-align: right; padding: 2px 10px; font-size: 12px; vertical-align: middle; height: 30px;"><?php if(!empty($total_credit)){ echo $obj->numberFormat($total_credit,2); } ?></th>
                                                            <th class="receipt_total" style="border: 1px solid #000; width: 100px; text-align: right; padding: 2px 10px; font-size: 12px; vertical-align: middle; height: 30px;"><?php if(!empty($total_debit)){ echo $obj->numberFormat($total_debit,2); } ?></th>
                                                        </tr>
                                                        <tr style="color:red;">
                                                            <th class="text-center px-2 py-2" colspan="5" style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Total</th>
                                                            <td style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;" class="text-right px-2 py-credit_amount2"><?php if($total_credit > $total_debit) { echo $obj->numberFormat(($total_credit- $total_debit),2)." Cr"; } ?>
                                                            <td style="border: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;font-weight:bold;" class="text-right px-2 py-2"> <?php if($total_debit > $total_credit){ 
                                                                $total_pending_amount = $total_debit - $total_credit; echo $obj->numberFormat($total_pending_amount,2)." Dr"; } ?></td>
                                                            
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                <?php } else { ?>
                                                    <tr>
                                                        <td colspan="6" style="border: 1px solid #000; text-align: center; padding: 2px 5px;">
                                                            No Records Found
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } 
                                    else {  ?>
                                        <table cellpadding="0" cellspacing="0" class="table display report_table no_$obj->numberFormat" style="width: 100%; border:solid 1px black;margin: 0 2px;">
                                            <thead>
                                                <tr>
                                                    <th colspan="4" style="border-left: 1px solid #000; border-top: 1px solid #000!important; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Pending Payment Report - <?php echo date('d-m-Y'); ?> </th>
                                                </tr>
                                                <tr>
                                                    <th style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 43px; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">S.No</th>
                                                    <th style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Party Name</th>
                                                    <th style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 100px; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Debit</th>
                                                    <th style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 100px; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Credit</th>
                                                </tr>
                                            </thead>
                                            <?php if(!empty($total_records_list)) {
                                                ?> 
                                            <tbody>
                                                <?php
                                                    $grand_pending = 0; $credit = 0; $debit = 0; $estimate_debit = 0; $credit_total_amount =0; $debit_total_amount =0; $grand_credit_total = 0; $grand_debit_total =0; $sno = 1;
                                                    // print_r($total_records_list);
                                                    foreach($total_records_list as $key => $data) 
                                                    {      
                                                        $index = $key + 1; $credit_total = 0; $debit_total=0;
                                                    
                                                    
                                                            ?>
                                                            <tr>
                                                                <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 43px; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;"><?php echo $sno; ?></td>
                                                                <td style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; padding: 2px 10px; font-size: 13px;  cursor: pointer; vertical-align: middle; height: 30px;" onClick="Javascript:showpartyList('<?php echo $data['party_id']; ?>');">
                                                                    <?php
                                                                        if(!empty($data['party_name']) && $data['party_name'] != $GLOBALS['null_value']) {
                                                                            echo $obj->encode_decode('decrypt',$data['party_name']); 
                                                                            if(!empty($data['party_mobile_number']) && $data['party_mobile_number']!=$GLOBALS['null_value']) {
                                                                                echo "(".$obj->encode_decode('decrypt',$data['party_mobile_number']).")"; 
                                                                            }

                                                                        }
                                                                    ?>
                                                                </td>
                                                                <?php 
                                                                    // echo $data['opening_balance']." ".$data['opening_balance_type'];
                                                                    if(!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 'Credit') ) {
                                                                        $credit_total = $credit_total + $data['opening_balance'];
                                                                        $credit = $credit + $credit_total;
                                                                    } 
                                                                    if(!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 'Debit') ) {
                                                                        $debit_total = $debit_total + $data['opening_balance'];
                                                                        $debit = $debit + $debit_total;
                                                                    }
                                                                    
                                                                    if(!empty($data['credit'])) {
                                                                    
                                                                        $credit_total = $credit_total + $data['credit'];
                                                                        $credit = $credit + $credit_total;
                                                                    }

                                                                    if(!empty($data['debit'])) {
                                                                    
                                                                        $debit_total = $debit_total + $data['debit'];
                                                                        $debit = $debit + $debit_total;
                                                                    }

                                                                    if($credit_total > $debit_total)
                                                                    {
                                                                        $total_amount = $debit_total - $credit_total;
                                                                    }   
                                                                    else{
                                                                        $total_amount = $credit_total - $debit_total;
                                                                    }

                                                                ?>

                                                                <td class="column1" style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 100px; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                    <?php 
                                                                    if($debit_total >= $credit_total){ $total_amount = $debit_total - $credit_total;echo $obj->numberFormat(($total_amount),2); $debit_total_amount = $debit_total_amount + $total_amount; }?>
                                                                </td>
                                                                <td class="column1" style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 100px; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                                    <?php if($credit_total > $debit_total) { $total_amount = $credit_total  -$debit_total; echo $obj->numberFormat(($total_amount),2); $credit_total_amount = $credit_total_amount + $total_amount; }?>
                                                                </td>
                                                            </tr>
                                                        <?php $sno++; 
                                                        // }

                                                        ?>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                    <th colspan="2" style="border: 1px solid #000; padding: 2px 10px; font-size: 13px; text-align: right; vertical-align: middle; height: 30px;"></th>
                                                    <th class="column1_total" style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; width: 15%; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                        <?php 
                                                        if(!empty($debit_total_amount)) {
                                                                echo $obj->numberFormat(($debit_total_amount),2);
                                                            } 
                                                        ?>
                                                    </th>
                                                    <th class="column1_total" style="border: 1px solid #000; width: 15%; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                        <?php
                                                        if(!empty($credit_total_amount)) {
                                                                echo $obj->numberFormat($credit_total_amount,2);
                                                        } 
                                                        ?>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" style="border: 1px solid #000; padding: 2px 10px; font-size: 13px; text-align: right; vertical-align: middle; height: 30px;">Total</th>
                                                    <th class="column1_total" style="border: 1px solid #000; width: 15%; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                        <?php 
                                                        if(!empty($credit_total_amount || ($debit_total_amount))) {
                                                            if($debit_total_amount > $credit_total_amount)  {
                                                                echo $obj->numberFormat(($debit_total_amount-$credit_total_amount),2);
                                                            }
                                                        } 
                                                        ?>
                                                    </th>
                                                    <th class="column1_total" style="border: 1px solid #000; width: 15%; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">
                                                        <?php 
                                                            if(!empty($credit_total_amount || ($debit_total_amount))) {
                                                                if($credit_total_amount > $debit_total_amount)  {
                                                                    echo $obj->numberFormat(($credit_total_amount-$debit_total_amount),2);
                                                                }
                                                            } 
                                                        ?>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="4" style="border: 1px solid #000; padding: 2px 5px; text-align: center;">
                                                        No Records Found
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
           
    <?php include "footer.php"; ?>       
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#pending_balance_report").addClass("has-active");
        $("#report").addClass("has-active");
        table_listing_records_filter();
    });
    function getReport(){
        if(jQuery('form[name="pending_balance_report_form"]').length > 0){
            jQuery('form[name="pending_balance_report_form"]').submit();
        } 
    }
    function showpartyList(party_id) {
        if(jQuery('select[name="filter_party_id"]').length > 0) {
            jQuery('select[name="filter_party_id"]').val(party_id);
        }
        
        getReport();
    }
</script>