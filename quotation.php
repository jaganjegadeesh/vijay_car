<?php 
	$page_title = "Quotation";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        $company_count = $obj->CompanyCount();
        if(empty($company_count)) {
            header("Location:dashboard.php");
            exit;
        }
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['quotation_module'];
            include("permission_check.php");
        }
    }
    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d');$current_date = date('Y-m-d');$material_type="";

    $cancelled_bill = ""; $cancelled_count = 0;
    $cancelled_bill = $obj->getAllRecords($GLOBALS['quotation_table'], 'deleted', 1);
    $cancelled_count = count($cancelled_bill);

    $party_list = array();
    $party_list = $obj->getPartyList('2'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/keyboard_control.js"></script>
    <script type="text/javascript" src="include/js/payment.js"></script>
    <script type="text/javascript" src="include/js/common.js"></script>
    <script type="text/javascript" src="include/js/sales.js"></script>
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
                        <div class="border card-box" id="table_records_cover">
                            <form name="table_listing_form" method="post">
                                <div class="card-header align-items-center">
                                    <div class="row justify-content-end p-2">   
                                        <div class="col-lg-2 col-md-3 col-6">
                                            <div class="form-group pb-2">
                                                <div class="form-label-group in-border">
                                                    <input type="date" name="from_date" class="form-control shadow-none" placeholder="" onchange="Javascript:checkDateCheck();table_listing_records_filter();" value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>" required="">
                                                    <label>From Date</label>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6">
                                            <div class="form-group pb-2">
                                                <div class="form-label-group in-border">
                                                    <input type="date" class="form-control shadow-none" placeholder="" required="" name="to_date" onchange="Javascript:checkDateCheck();table_listing_records_filter();" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                    <label>To Date</label>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6 px-lg-1 py-lg-0 py-2">
                                            <div class="form-group">
                                                <div class="form-label-group in-border">
                                                    <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" name="filter_party_id" onchange="Javascript:table_listing_records_filter();" style="width: 100%;">
                                                        <option value="">Select Party</option>
                                                        <?php
                                                            if(!empty($party_list)) {
                                                                foreach ($party_list as $data) {
                                                                    if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                                                        ?>
                                                                        <option value="<?php echo $data['party_id']; ?>" <?php if(!empty($party_id) && $party_id == $data['party_id']) { ?>selected<?php } ?>>
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
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search_text" style="height:34px;" placeholder="Search No" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();">
                                                <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                            </div>
                                        </div>
                                        <?php if(!empty($cancelled_count)) { ?>                                    
                                            <div class="col-lg-2 col-md-8 col-4 text-end px-lg-1 px-1 py-lg-0 py-2 align-self-center">
                                                <button class="btn btn-dark float-end" id='show_button' style="font-size:11px;" type="button" onclick="Javascript:assign_bill_value();">Inactive Bill</button>
                                            </div>                                    
                                        <?php  } ?>
                                        <div class="col-lg-1 col-md-8 col-3 text-end px-2 px-lg-2 align-self-center">
                                            <?php
                                                $add_access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $add_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($add_access_error)) { 
                                                    ?>
                                                        <button class="btn btn-danger " style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>   
                                                    <?php 
                                                }
                                            ?>                                            
                                        </div>
                                        <div class="col-sm-6 col-xl-8">
                                            <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                            <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                            <input type="hidden" name='show_bill' value="0" id='show_bill'>                                        
                                        </div>	
                                    </div>
                                </div>
                            </form>
                            <div id="table_listing_records"></div>
                        </div>
                    </div>   
                </div>
            </div>  
        </div>
    </div>          
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#quotation").addClass("active");
        table_listing_records_filter();
    });
</script>