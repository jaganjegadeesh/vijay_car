<?php 
	$page_title = "Party";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['party_module'];
            include("permission_check.php");
        }
    }
    $party_list = array(); $party_count = 0;
    $party_list = $obj->getTableRecords($GLOBALS['party_table'], '', '', '');
    if(!empty($party_list)){
        $party_count = count($party_list);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/creation_modulesjs"></script>
    <script type="text/javascript" src="include/js/countries.js"></script>
    <script type="text/javascript" src="include/js/district.js"></script>
    <script type="text/javascript" src="include/js/cities.js"></script>
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
                                <div class="card-header align-items-center">
                                    <form name="table_listing_form" method="post">
                                        <div class="row justify-content-end p-2">
                                            <div class="col-lg-3 col-md-4 col-6 my-1">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border">
                                                        <select name="filter_party_type" class="select2 select2-danger" style="width: 100%;" onchange="Javascript:InputBoxColor(this,'select');Javascript:table_listing_records_filter();"> 
                                                            <option value="">Select Party Type</option>
                                                            <option value="1">Purchase</option>
                                                            <option value="2">Sales</option>
                                                            <option value="3">Both</option>
                                                        </select>
                                                        <label>Party Type(*)</label>
                                                    </div>
                                                </div>        
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-12 my-1">
                                                <div class="input-group">
                                                    <input type="text" name="search_text" class="form-control" onkeyup="Javascript:table_listing_records_filter();" style="height:34px;" placeholder="Search By Name / Mob No" aria-label="Search" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                                </div>
                                            </div>
                                            <?php 
                                            if($party_count > 0) { ?>
                                                <div class="col-lg-4 col-md-2 col-9 my-1">
                                                    <button class="btn btn-success py-2 mx-2" style="font-size:12px; width:140px;" type="button" onclick="Javascript:ExcelDownload();"> <i class="fa fa-cloud-download"></i> Excel Download </button>
                                                    <button class="btn btn-primary py-2 mx-2" style="font-size:12px; width:75px;" type="button" onclick="Javascript:PrintParty('');"> <i class="fa fa-print"></i> Print </button>
                                                </div>    
                                                <?php
                                            } ?> 
                                            <div class="col-lg-2 col-md-2 col-3 my-1">
                                                <?php
                                                $add_access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $add_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($add_access_error)) { ?>
                                                    <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                                    <?php 
                                                } ?>
                                            </div>
                                            <div class="col-sm-6 col-xl-8">
                                                <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                                <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                                <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                            </div>	
                                        </div>
                                    </form>
                                </div>
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
        $("#party").addClass("active");
        table_listing_records_filter();
    });

    function ExcelDownload() {
        var search_text = ""; var url = ""; var party_type = "";
        search_text = jQuery('input[name="search_text"]').val();
        party_type = jQuery('select[name="filter_party_type"]').val();
        url = "party_download.php?search_text="+search_text+"&party_type="+party_type;
        window.open(url,'_blank');
    }
    
    function PrintParty(from) {
        var search_text = ""; var url = ""; 
        search_text = jQuery('input[name="search_text"]').val();
        party_type = jQuery('select[name="filter_party_type"]').val();
        url = "reports/rpt_party_a4.php?search_text="+search_text+"&party_type="+party_type+"&from="+from;
        window.open(url,'_blank');
    }
</script>