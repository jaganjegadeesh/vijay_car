<?php 
	$page_title = "Day Book";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        $company_count = $obj->CompanyCount();
        if($company_count == '0') {
            header("Location:dashboard.php");
            exit;
        }
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }
    $to_date=""; $search_text = '';  $bill_type = ''; $filter_party_id = '';
    $to_date = date('Y-m-d'); $current_date = date('Y-m-d'); 
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }
    if(isset($_POST['search_text'])) {
        $search_text = $_POST['search_text'];
    }
    if(isset($_POST['filter_party_id'])) {
        $filter_party_id = $_POST['filter_party_id'];
    }
    if(isset($_POST['bill_type'])) {
        $bill_type = $_POST['bill_type'];
    }
    $party_list = array();
    $party_list = $obj->getPartyList(''); 
    $total_records_detailed_list = array();
    $total_records_detailed_list = $obj->getDayBookPaymentReportList($to_date, $filter_party_id, $bill_type);
    if(!empty($search_text)) {
        $search_text = strtolower($search_text);
        $list = array();
        if(!empty($total_records_detailed_list)) {
            foreach($total_records_detailed_list as $val) {
                if(strpos(strtolower($val['bill_number']), $search_text) !== false) {
                    $list[] = $val;
                }
            }
        }
        $total_records_detailed_list = $list;
    }
    $total_credit = 0;
    $total_debit = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php include "link_style_script.php"; ?>
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
                            <form name="stock_report_form" method="post">
                                <div class="card-header align-items-center">
                                    <div class="row p-2">   
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border">
                                                    <input type="date" id="to_date" name="to_date" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" onchange="Javascript:checkDateCheck();SubmitForm();" class="form-control shadow-none" placeholder="" required max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                    <label>Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6 text-start">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border">
                                                    <span class="fs-20"> Day : <?php echo date('l', strtotime($to_date)); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6 px-lg-1 py-lg-0 py-2">
                                            <div class="form-group">
                                                <div class="form-label-group in-border">
                                                    <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" name="filter_party_id" onchange="Javascript:SubmitForm();" style="width: 100%;">
                                                        <option value="">Select Party</option>
                                                        <?php
                                                            if(!empty($party_list)) {
                                                                foreach ($party_list as $data) {
                                                                    if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                                                        ?>
                                                                        <option value="<?php echo $data['party_id']; ?>" <?php if(!empty($filter_party_id) && $filter_party_id == $data['party_id']) { ?>selected<?php } ?>>
                                                                            <?php
                                                                                if(!empty($data['name_mobile_city']) && $data['name_mobile_city'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['name_mobile_city']);
                                                                                }
                                                                            ?>
                                                                        </option>
                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Select Party</label>
                                                </div>
                                            </div>        
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-5 px-lg-2 py-lg-0 py-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="<?php if(!empty($search_text)) { echo $search_text; } ?>" name="search_text" style="height:34px;" placeholder="Search Bill No" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:SubmitForm();">
                                                <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6 text-end">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border">
                                                    <button class="btn btn-success " style="font-size:11px;" type="button" onClick="Javascript:PrintDayBook();"> <i class="fa fa-print"></i> Print </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6 pb-2">
                                            <div class="form-group">
                                                <div class="form-label-group in-border">
                                                    <div class="input-group">
                                                        <select class="select2 select2-danger" onchange="Javascript:SubmitForm();" name="bill_type" data-dropdown-css-class="select2-danger" data-placeholder="" style="width: 100%">
                                                            <option value="">Select Bill Type</option>
                                                            <option value="Receipt" <?php if($bill_type == "Receipt") { echo 'selected'; } ?>>Receipt</option>
                                                            <option value="Voucher" <?php if($bill_type == "Voucher") { echo 'selected'; } ?>>Vouchers</option>
                                                            <option value="Purchase Entry" <?php if($bill_type == "Purchase Entry") { echo 'selected'; } ?>>Purchase Entry</option>
                                                            <option value="Invoice" <?php if($bill_type == "Invoice") { echo 'selected'; } ?>>Invoice Entry</option>
                                                        </select>
                                                        <label>Select Bill Type</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-10">
                                            <div class="table-responsive">
                                                <table class="table table-bordered nowrap cursor text-center smallfnt">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th>Type</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Cash</td>
                                                            <td>5000.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bank</td>
                                                            <td>5000.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>TMB</td>
                                                            <td>5000.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table> 
                                            </div>
                                        </div> -->
                                        <div class="col-sm-6 col-xl-8">
                                            <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                            <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered nowrap cursor text-center smallfnt">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Bill Number</th>
                                                <th>Bill Type</th>
                                                <th>Name</th>
                                                <th>Credit</th>
                                                <th>Debit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($total_records_detailed_list)){
                                                foreach($total_records_detailed_list as $val => $data){           
                                                    $index = $val + 1; ?>                                                                                                                
                                                    <tr>
                                                        <td><?php echo $index; ?></td>
                                                        <td>
                                                            <?php
                                                                if(!empty($data['bill_date']) && $data['bill_date'] != $GLOBALS['null_value']) {
                                                                    echo date('d-m-Y', strtotime($data['bill_date']));
                                                                } ?>
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($data['bill_number']) && $data['bill_number'] != $GLOBALS['null_value']) {
                                                                echo $data['bill_number'];
                                                            } else { 
                                                                echo "-"; 
                                                            } ?> 
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if(!empty($data['bill_type']) && $data['bill_type'] != $GLOBALS['null_value']){
                                                                echo  $data['bill_type'];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if(!empty($data['party_name']) && $data['party_name'] != $GLOBALS['null_value']){
                                                                echo $obj->encode_decode('decrypt', $data['party_name']);
                                                            } else {
                                                                echo '-';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if(!empty($data['credit']) && $data['credit'] != $GLOBALS['null_value']){
                                                                    $total_credit = $total_credit + $data['credit'];                                                                        
                                                                    echo number_format($data['credit'],2);
                                                                } else{
                                                                    echo '-';
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if(!empty($data['debit']) && $data['debit'] != $GLOBALS['null_value']){
                                                                    $total_debit = $total_debit + $data['debit'];
                                                                    echo number_format($data['debit'],2);
                                                                }else{
                                                                    echo '-';
                                                                }
                                                            ?>                                                    
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr class="fw-bold">
                                                    <td colspan="5" class="text-end">Total Balance</td>
                                                    <td><?php echo number_format($total_credit,2) ?></td>
                                                    <td><?php echo number_format($total_debit,2) ?></td>
                                                </tr>
                                                <tr class="fw-bold">
                                                    <td colspan="5" class="text-end">Current Balance</td>
                                                    <td>
                                                        <?php 
                                                            if($total_credit > $total_debit) {
                                                                echo number_format((float)$total_credit - (float)$total_debit,2);
                                                            } else {
                                                                echo '-';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($total_debit > $total_credit) {
                                                                echo number_format((float)$total_debit - (float)$total_credit,2);
                                                            } else {
                                                                echo '-';
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="7" style="border: 1px solid #000; text-align: center; padding: 2px 5px;">
                                                        No Records Found
                                                    </td>
                                                </tr>
                                            <?php } ?>
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
        $("#daybook").addClass("active");
        table_listing_records_filter();
    });
    function SubmitForm() {
        if(jQuery('form[name="stock_report_form"]').length > 0) {
            jQuery('form[name="stock_report_form"]').submit();
        }
    }
    function PrintDayBook() {
        var to_date = jQuery('input[name="to_date"]').val();
        var search_text = jQuery('input[name="search_text"]').val();
        var filter_party_id = jQuery('select[name="filter_party_id"]').val();
        var consignee_id = jQuery('select[name="consignee_id"]').val();
        var bill_type = jQuery('select[name="bill_type"]').val();
        var url = "reports/rpt_daybook_a4.php?to_date="+to_date+"&search_text="+search_text+"&filter_party_id="+filter_party_id+"&bill_type="+bill_type;
        window.open(url, '_blank');
    }
</script>