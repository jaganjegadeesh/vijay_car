<?php 
	$page_title = "Job Card Report";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $vehicle_list = $obj->getTableRecords($GLOBALS['vehicle_table'],'','');

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
                            <div class="card-header align-items-center">
                                <div class="row justify-content-end p-2">   
                                    <div class="col-lg-4 col-md-3 col-6 p-2">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select class="select2 select2-danger" onchange="GetVehicleHistory(this.value);" name="vehicle_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option value="">Select Vehicle</option>    
                                                    <?php if(!empty($vehicle_list)) {
                                                        foreach($vehicle_list as $list) { ?>
                                                            <option value="<?php if(!empty($list['vehicle_id'])) { echo $list['vehicle_id']; } ?>"><?php if(!empty($list['vehicle_no'])) { echo $obj->encode_decode('decrypt', $list['vehicle_no']); } ?></option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                                <label>Select Vehicle</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-8 col-8 col-md-3 text-end">
                                        <button class="btn btn-success" onclick="PrintHistory()"><i class="fa fa-print"></i> Print</button>
                                    </div>
                                     
                                    <form name="table_listing_form" method="post">
                                        <div class="col-sm-6 col-xl-8">
                                            <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                            <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                        </div>	
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive job_card_history">
                                    
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
    $(document).ready(function(){
        $("#jobcardreport").addClass("active");
        table_listing_records_filter();
    });
    function PrintHistory() {
        var vehicle_id = $("select[name='vehicle_id']").val();
        url = "reports/rpt_vehicle_history.php?vehicle_id="+vehicle_id;
        window.open(url,'_blank');
    }
</script>