<?php 
	$page_title = "Purchase Report";
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

    $to_date = "";
    $from_date = "";
    $filter_party_id=""; 
    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date("Y-m-d"); 

    if(isset($_POST['filter_party_id'])) {
        $filter_party_id = $_POST['filter_party_id'];
    }
    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }

    $current_date = date("Y-m-d");

    
   
    $party_list = array();
    $party_list =  $obj->getPartyList('1');
    

    $party_name ="";
    if(!empty($filter_party_id)){
        $party_name =$obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$filter_party_id,'party_name');
        $party_name = $obj->encode_decode('decrypt',$party_name);
    }

    $total_records_list = array();
    $total_records_list = $obj->GetPurchaseEntryReport($GLOBALS['bill_company_id'],$filter_party_id,$from_date, $to_date);

    $excel_name = "";
    $excel_name = "Purchase Report( ".date('d-m-Y',strtotime($from_date ))." to ".date('d-m-Y',strtotime($to_date )).")";
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
                                <form name="purchase_report_form" method="POST">
                                    <div class="row justify-content-end p-2">   
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-1">
                                                <div class="form-label-group in-border pb-2">
                                                    <input type="date" id="from_date" name="from_date" class="form-control shadow-none" placeholder="" value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>" onchange = "Javascript:checkDateCheck();getOverallReport();">
                                                <label>From Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-1">
                                                <div class="form-label-group in-border pb-2">
                                                    <input type="date" id="to_date" name="to_date" class="form-control shadow-none" placeholder="" value="<?php if(!empty($to_date)) { echo $to_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>" onchange = "Javascript:checkDateCheck();getOverallReport();">
                                                    <label>To Date</label>
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border mb-0">
                                                    <select class="select2 select2-danger" name="filter_party_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onChange="Javascript:getOverallReport();">
                                                        <option value="">Select Party </option>
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
                                        <div class="col-lg-4 col-6">
                                            <button class="btn btn-success m-1" style="font-size:11px;" type="button" onClick="window.open('reports/rpt_purchase_report_a4.php?filter_party_id=<?php echo $filter_party_id; ?>&from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>')"> <i class="fa fa-print"></i> Print </button>
                                            <button class="btn btn-danger m-1" style="font-size:11px;" type="button" onClick="ExportToExcel()"> <i class="fa fa-download"></i> Export </button>  
                                        </div> 
                                    </div>
                                    <div class="col-sm-6 col-xl-8">
                                        <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                        <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                        <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered nowrap cursor text-center smallfnt" id="tbl_sales_list">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Bill Number</th>
                                                <th>Date</th>
                                                <th>Party Name</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $grand_amount = 0; $total_amount = 0;

                                                if(!empty($total_records_list)) {
                                                    $index = 1;
                                                    foreach($total_records_list as $data) { 
                                                        $total_amount = $data['total_amount'];
                                                        ?>
                                                        <tr style="cursor:pointer;">
                                                
                                                            <td class="text-center px-2 py-2"><?php echo $index; ?></td>
                                                            <td  class="text-center px-2 py-2">
                                                                <?php 
                                                                if(!empty($data['purchase_entry_number'])) {
                                                                
                                                                echo $data['purchase_entry_number']."<br>";
                                                                }
                                                                
                                                                if (!empty($data['deleted'])) {
                                                                    ?>
                                                                    <br><span style="color: red;">Cancelled</span>
                                                                    <?php
                                                                }

                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if(!empty($data['purchase_entry_date']))
                                                                    {
                                                                        echo date('d-m-Y',strtotime($data['purchase_entry_date']));   
                                                                    }
                                                                ?>
                                                            </td>
                                                            
                                                            <td> 
                                                                <?php
                                                                    if(!empty($data['party_name_mobile_city']) && ($data['party_name_mobile_city'] != $GLOBALS['null_value'])) {
                                                                        $name = $data['party_name_mobile_city'];
                                                                        $name = $obj->encode_decode('decrypt',$name);
                                                                        echo $name;
                                                                    }
                                                            
                                                                    ?>
                                                            </td>
                                                            
                                                            <td class="px-2 py-2" style="text-align: right;">
                                                                <?php if(!empty($total_amount)) { echo $obj->numberFormat($total_amount,2); } ?>
                                                            </td>
                                                        
                                                                <?php 
                                                                    $index++; 
                                                                    if($data['deleted'] == '0'){ 
                                                                        $grand_amount+=$total_amount; 
                                                                    }
                                                                ?>
                                                        </tr>
                                                        <?php
                                                    } ?>
                                                    <tr>
                                                        <th class="text-right" colspan="4" style="text-align: right;" >Total</th>
                                                        <th class="mr-5" style="text-align: right;margin: 30px 40px;"><?php echo $obj->numberFormat($grand_amount,2); ?></th>
                                                    </tr>
                                                    <?php 
                                                } else { ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">Sorry! No records found</td>
                                                    </tr>								
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
        $("#purchasereport").addClass("active");
        table_listing_records_filter();
    });
</script>

<script type="text/javascript">
    function getOverallReport() {
        var from_date = ""; var to_date = ""; var party_id = "";
        if(jQuery('input[name="from_date"]').length > 0) {
            from_date =jQuery('input[name="from_date"]').val();
        }
        if(jQuery('input[name="to_date"]').length > 0) {
            to_date = jQuery('input[name="to_date"]').val();
        }
        if(jQuery('select[name="filter_party_id"]').length > 0) {
            party_id = jQuery('select[name="filter_party_id"]').val();
        }
        from_date = from_date.split("-");
        to_date = to_date.split("-");
        var date1 = new Date(from_date[2] + "-" + from_date[1] + "-" + from_date[0]);
        var date2 = new Date(to_date[2] + "-" + to_date[1] + "-" + to_date[0]);
        // if (date1 < date2) {
        //     if(jQuery('form[name="purchase_report_form"]').length > 0){
        //         jQuery('form[name="purchase_report_form"]').submit();
        //     }
        // }
        // else if (party_id != "") {
        //     if(jQuery('form[name="purchase_report_form"]').length > 0){
        //         jQuery('form[name="purchase_report_form"]').submit();
        //     }
        // }
        // else if(view_type != ""){
            if(jQuery('form[name="purchase_report_form"]').length > 0){
                jQuery('form[name="purchase_report_form"]').submit();
            }
        // }
        // else if(date1 > date2){
        //     if(jQuery('.table-responsive table').length > 0){
        //         jQuery('.table-responsive table').html('No Records found');
        //     }
        // }        
    }
</script>
<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_sales_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        window.open("purchase_report.php","_self");
    }
</script>