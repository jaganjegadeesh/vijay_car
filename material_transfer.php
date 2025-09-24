<?php 
	$page_title = "Material Transfer";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        $company_count = $obj->CompanyCount();
        if(empty($company_count)) {
            header("Location:dashboard.php");
            exit;
        }
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['material_transfer_module'];
            include("permission_check.php");
        }
    }
    $material_transfer_list = array();
    $material_transfer_list = $obj->getTableRecords($GLOBALS['material_transfer_table'], '', '', '');

    $store_list = array();
    $store_list = $obj->getTableRecords($GLOBALS['store_room_table'], '', '', '');

    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d');$current_date = date('Y-m-d');

    $cancelled_bill = array(); $cancelled_count = 0;
    $cancelled_bill = $obj->getAllRecords($GLOBALS['material_transfer_table'], 'deleted', 1);
    $cancelled_count = count($cancelled_bill);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
        <?php 
        include "link_style_script.php"; ?>
        <script type="text/javascript" src="include/js/keyboard_control.js"></script>
        <script type="text/javascript" src="include/js/material_transfer.js"></script>
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
                            <form name="table_listing_form" method="post">
                                <div class="border card-box" id="table_records_cover">
                                    <div class="card-header align-items-center">
                                        <div class="row justify-content-end p-2">
                                            <div class="col-lg-2 col-md-2 col-6">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                        <input type="date" class="form-control shadow-none" name="from_date" onchange="Javascript:checkDateCheck();table_listing_records_filter();" value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>From Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                        <input type="date" class="form-control shadow-none" name="to_date" onchange="Javascript:checkDateCheck();table_listing_records_filter();" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>To Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                        <select name="from_store_id" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2-danger" onchange="Javascript:table_listing_records_filter();show_to_store(this.value);">
                                                            <option value="">Select</option>
                                                            <?php
                                                                if(!empty($store_list)) {
                                                                    foreach($store_list as $data) { ?>
                                                                        <option value="<?php if(!empty($data['store_room_id'])) { echo $data['store_room_id']; } ?>">
                                                                            <?php
                                                                                if(!empty($data['store_room_name'])) {
                                                                                    echo $obj->encode_decode('decrypt', $data['store_room_name']);
                                                                                }
                                                                            ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                        <label>From store</label>
                                                    </div>
                                                </div>        
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6">
                                                <div class="form-group pb-2">
                                                    <div class="form-label-group in-border">
                                                        <select name="to_store_id" id="to_store_id" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2-danger" onchange="Javascript:table_listing_records_filter();">
                                                            <option value="">Select</option>
                                                            <?php
                                                                if(!empty($store_list)) {
                                                                    foreach($store_list as $data) { ?>
                                                                        <option value="<?php if(!empty($data['store_room_id'])) { echo $data['store_room_id']; } ?>">
                                                                            <?php
                                                                                if(!empty($data['store_room_name'])) {
                                                                                    echo $obj->encode_decode('decrypt', $data['store_room_name']);
                                                                                }
                                                                            ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                        <label>To store</label>
                                                    </div>
                                                </div>        
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-4 text-end">
                                                <?php if($cancelled_count > 0) { ?>          
                                                        <button class="btn btn-dark poppins" id='show_button' style="font-size:11px;" type="button" onclick="Javascript:assign_bill_value();">Inactive Bill</button>
                                                <?php } ?> 
                                                <?php $add_access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $add_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($add_access_error)) { ?>
                                                    <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-6 col-xl-8">
                                                <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                                <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                                <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                                <input type="hidden" name='show_bill' value="0" id='show_bill'>                                                                                        
                                            </div>	
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
        $("#materialtransfer").addClass("active");
        table_listing_records_filter();
    });
</script>