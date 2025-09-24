<?php 
    $page_title = "Salary"; 
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
            $permission_module = $GLOBALS['product_module'];
            include("permission_check.php");
        }
    }

    $from_date = date('Y-m-d', strtotime('-10 days')); 
    $to_date = date("Y-m-d");
    $current_date = date("Y-m-d");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script src="include/js/salary.js"></script>
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
                                            <div class="col-lg-2 col-md-3 col-6 py-2 px-lg-1">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border">
                                                        <input type="date" id="from_date" value="<?php if(!empty($from_date)){ echo $from_date; } ?>" name="from_date" onchange="Javascript:table_listing_records_filter();" class="form-control shadow-none" max="<?php if(!empty($current_date)) { echo $current_date; } ?>" placeholder="" required>
                                                        <label>From Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 py-2 px-lg-1">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border">
                                                        <input type="date" id="to_date" value="<?php if(!empty($to_date)){ echo $to_date; } ?>" name="to_date" onchange="Javascript:table_listing_records_filter();" class="form-control shadow-none" max="<?php if(!empty($current_date)) { echo $current_date; } ?>" placeholder="" required>
                                                        <label>To Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-3">
                                                <?php
                                                    $add_access_error = "";
                                                    if(!empty($login_staff_id)) {
                                                        $permission_action = $add_action;
                                                        include('permission_action.php');
                                                    }
                                                    if(empty($add_access_error)) { 
                                                        ?>
                                                        <button class="btn btn-danger float-end" style="font-size:11px; width:80px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                                        <?php 
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-sm-6 col-xl-8">
                                                <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                                <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                                <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
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
        $("#salary").addClass("active");
        table_listing_records_filter();
    });
</script>