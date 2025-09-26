<?php 
	$page_title = "Store Entry";
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
            $permission_module = $GLOBALS['store_entry_module'];
            include("permission_check.php");
        }
    }
    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d');$current_date = date('Y-m-d');$material_type="";

    $cancelled_bill = ""; $cancelled_count = 0;
    $cancelled_bill = $obj->getAllRecords($GLOBALS['store_entry_table'], 'deleted', 1);
    $cancelled_count = count($cancelled_bill);

    $store_list = array();
    $store_list = $obj->getTableRecords($GLOBALS['store_room_table'], '','', '');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
        <?php 
        include "link_style_script.php"; ?>
        <script type="text/javascript" src="include/js/keyboard_control.js"></script>
        <script type="text/javascript" src="include/js/creation_module.js"></script>
        <script type="text/javascript" src="include/js/common.js"></script>
        <script type="text/javascript" src="include/js/store_entry.js"></script>
        <script type="text/javascript" src="include/js/payment.js"></script>
        <script type="text/javascript" src="include/js/add_modules.js"></script>
        <script type="text/javascript" src="include/js/product.js"></script>
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
                                                <div class="form-group pb-1">
                                                    <div class="form-label-group in-border pb-1">
                                                        <input type="date" name="from_date" class="form-control shadow-none" placeholder="" onchange="Javascript:checkDateCheck();table_listing_records_filter();" value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>" required="">
                                                        <label>From Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6">
                                                <div class="form-group pb-1">
                                                    <div class="form-label-group in-border pb-1">
                                                        <input type="date" class="form-control shadow-none" placeholder="" required="" name="to_date" onchange="Javascript:checkDateCheck();table_listing_records_filter();" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>To Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            
                                            <div class="col-lg-2 col-md-3 col-6 mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search_text" style="height:34px;" placeholder="Search Entry No" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();">
                                                    <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search_job_text" style="height:34px;" placeholder="Search Job No" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();">
                                                    <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                                </div>
                                            </div>
                                            <?php if(!empty($cancelled_count)) { ?>                                    
                                                <div class="col-lg-2 col-md-8 col-3 text-end align-self-center">
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
        $("#storeentry").addClass("active");
        table_listing_records_filter();
    });
</script>