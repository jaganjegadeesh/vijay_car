<?php 
	$page_title = "Attendance Report";
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

    $engineer_id = ""; $attendance = 0;
    $from_date = date('Y-m-d'); $to_date = date('Y-m-d'); $current_date = date('Y-m-d');
    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }
    if(isset($_POST['engineer_id'])) {
        $engineer_id = $_POST['engineer_id'];
    }
    if(isset($_POST['attendance'])) {
        $attendance = $_POST['attendance'];
    }
    $engineer_list = array();
    $engineer_list = $obj->getTableRecords($GLOBALS['engineer_table'], '', '', '');
    

    $total_records_list = array();
    $total_records_list = $obj->getEngineerAttendanceList($from_date, $to_date,$engineer_id);

    $attendance_records_list = array();
    $attendance_records_list = $obj->getAttendanceList($from_date, $to_date);


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
                        <form name="attendance_report_form" method="post">
                            <div class="card-header align-items-center">
                                <div class="row p-2">   
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border">
                                                <input type="date"  id="from_date" name="from_date" class="form-control shadow-none" placeholder="" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" onchange="Javascript:getReport();checkDateCheck();" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                <label>From Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border">
                                                <input type="date"  id="to_date" name="to_date" class="form-control shadow-none" placeholder=""  value="<?php if(!empty($to_date)) { echo $to_date; } ?>" onchange="Javascript:getReport();checkDateCheck()" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                <label>To Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="attendance" value="<?php if(!empty($attendance)){ echo $attendance;}else{ echo "0"; } ?>">
                                    <?php  if($attendance =='1'){ ?>
                                   
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="form-group mb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select name ="engineer_id" onchange="Javascript:getReport();" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($engineer_list)) {
                                                            foreach($engineer_list as $data) {
                                                                if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['engineer_id']; ?>" <?php if(!empty($engineer_id) && $engineer_id == $data['engineer_id']) { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['engineer_name']) && $data['engineer_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['engineer_name']);
                                                                            }
                                                                            if(!empty($data['engineer_code']) && $data['engineer_code'] != $GLOBALS['null_value']) {
                                                                                echo " - ".$obj->encode_decode('decrypt', $data['engineer_code']);
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Select Engineer</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-12 ms-auto text-end">
                                        <a class="btn btn-success" style="font-size:11px;" href="reports/rpt_attendance_report.php?engineer_id=<?php if(!empty($engineer_id)) { echo $engineer_id; } ?>&from_date=<?php if(!empty($from_date)) { echo $from_date; } ?>&to_date=<?php if(!empty($to_date)) { echo $to_date; } ?>" target="_blank" > <i class="fa fa-print"></i> Print </a>

                                        <a class="btn btn-success " style="font-size:11px;" href="reports/rpt_attendance_report.php?engineer_id=<?php if(!empty($engineer_id)) { echo $engineer_id; } ?>&from_date=<?php if(!empty($from_date)) { echo $from_date; } ?>&to_date=<?php if(!empty($to_date)) { echo $to_date; } ?>&from=D" target="_blank" > <i class="fa fa-download"></i> PDF </a>

                                        <button class="btn btn-danger m-1" style="font-size:11px;" type="button" onclick="ExportToExcel();"> <i class="fa fa-download"></i> Export </button>  
                                    </div> 
                                    <?php } ?>
                                    <form name="table_listing_form" method="post">
                                        <div class="col-sm-6 col-xl-8">
                                            <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                            <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                        </div>	
                                    </form>
                                </div>
                            </div>
                            </form>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table nowrap cursor table-bordered text-center smallfnt" id= "tbl_attendance_report">
                                    <?php if($attendance =='1'){ ?>
                                        <thead class="bg-light">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Engineer</th>
                                                <th>Attendance</th>
                                                <th>Salary</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $total_quantity = 0; $sno = 1;
                                                if(!empty($total_records_list)) { 
                                                    foreach($total_records_list as $key => $data) { 

                                                        ?>
                                                            <tr>
                                                                <td><?php echo $sno++; ?></td>
                                                                <td >
                                                                        <?php 
                                                                    if(!empty($data['attendance_date'])){
                                                                        echo date('d-m-Y', strtotime($data['attendance_date']));
                                                                    }
                                                                    ?> 
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        if(!empty($data['engineer_name'])  && $data['engineer_name'] != $GLOBALS['null_value']){
                                                                            echo $obj->encode_decode('decrypt', $data['engineer_name']);

                                                                           if(!empty($data['engineer_id'])){
                                                                              $engineer_code = "";
                                                                              $engineer_code = $obj->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$data['engineer_id'],'engineer_code');
                                                                               $engineer_code = $obj->encode_decode('decrypt',$engineer_code);
                                                                               echo " - ".$engineer_code;
                                                                           }
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                    if(!empty($data['present_status']) && $data['present_status'] != $GLOBALS['null_value']){
                                                                        if($data['present_status'] == 'PP'){
                                                                             echo "Full Day Present";
                                                                        }else if($data['present_status'] == 'AP' || $data['present_status'] == 'PA'){
                                                                            echo "Half Day Present";
                                                                        }else{
                                                                            echo "Absent";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>  
                                                                <td>
                                                                    <?php 
                                                                        if(!empty($data['daily_salary'] && $data['daily_salary'] != $GLOBALS['null_value'])){
                                                                            echo $data['daily_salary'];
                                                                        }else{
                                                                            echo "-";
                                                                        }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                    
                                                        <?php
                                                    }
                                                }else{
                                                    ?>
                                                    <tr> <th colspan="8"> Sorry! No records found </th> </tr>
                                                    <?php
                                                }
                                            ?>
                                        </tbody>
                                        <?php }else{ ?>
                                            <thead class="bg-light">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>No Of Engineer</th>
                                                <th>No Of Present</th>
                                                <th>No Of Absent</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                $total_quantity = 0; $sno = 1;$total_engineer = 0;$psp_count =0 ;$psa_count =0 ;$pa_count =0 ;$ap_count =0 ;
                                                if(!empty($attendance_records_list)) { 
                                                    foreach($attendance_records_list as $key => $data) {
                                                        if(!empty($data['psp_count']) && $data['psp_count'] != $GLOBALS['null_value']){
                                                            $psp_count = $data['psp_count'];
                                                        }else{
                                                            $psp_count = 0;
                                                        }

                                                        if(!empty($data['psa_count']) && $data['psa_count'] != $GLOBALS['null_value']){
                                                            $psa_count = $data['psa_count'];
                                                        }else{
                                                            $psa_count = 0;
                                                        }
                                                        if(!empty($data['pa_count']) && $data['pa_count'] != $GLOBALS['null_value']){
                                                            $pa_count = $data['pa_count'];
                                                        }else{
                                                            $pa_count = 0;
                                                        }
                                                         if(!empty($data['ap_count']) && $data['ap_count'] != $GLOBALS['null_value']){
                                                            $ap_count = $data['ap_count'];
                                                        }else{
                                                            $ap_count = 0;
                                                        }
                                                      
                                                        ?>
                                                            <tr onclick="Javascript:ShowAttendance('<?php if(!empty($data['attendance_date']) && $data['attendance_date'] != $GLOBALS['null_value']) { echo $data['attendance_date']; } ?>');" style="cursor:pointer!important;">
                                                                <td><?php echo $sno++; ?></td>
                                                                <td >
                                                                        <?php 
                                                                    if(!empty($data['attendance_date'])){
                                                                        echo date('d-m-Y', strtotime($data['attendance_date']));
                                                                    }
                                                                    ?> 
                                                                </td>

                                                                <td>
                                                                    <?php 
                                                                    if(!empty($psp_count) || !empty($psa_count) || !empty($pa_count) || !empty($ap_count)){
                                                                      echo $psp_count + $psa_count + $pa_count + $ap_count;
                                                                    }else{
                                                                      echo "0";
                                                                    }
                                                                    ?>
                                                                </td>  
                                                                
                                                                <td>
                                                                    <?php 
                                                                    if(!empty($psp_count) || !empty($pa_count) || !empty($ap_count)){
                                                                      echo $psp_count + $pa_count + $ap_count;
                                                                    }else{
                                                                        echo "0";
                                                                    }
                                                                    ?>
                                                                </td>  

                                                                <td>
                                                                    <?php 
                                                                    if(!empty($psa_count)){
                                                                        echo $psa_count;
                                                                    }else{
                                                                        echo "0";
                                                                    }
                                                                    ?>
                                                                </td>  
                                                            </tr>
                                                        <?php
                                                    }
                                                }else{
                                                    ?>
                                                    <tr> <th colspan="8"> Sorry! No records found </th> </tr>
                                                    <?php
                                                }
                                            ?>
                                        </tbody>
                                            <?php } ?>
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
        $("#attendancereport").addClass("active");
    });
</script>
<script type="text/javascript">
    function getReport(){
        if(jQuery('form[name="attendance_report_form"]').length > 0){
            jQuery('form[name="attendance_report_form"]').submit();

        }  
    }
    function ShowAttendance(date) {
        if(jQuery('input[name="attendance"]').length > 0) {
            jQuery('input[name="attendance"]').val('1');
        }
        if(jQuery('input[name="from_date"]').length > 0) {
            jQuery('input[name="from_date"]').val(date);
        }
        if(jQuery('input[name="to_date"]').length > 0) {
            jQuery('input[name="to_date"]').val(date);
        }
      
        jQuery('.engineer_id').remove('d-none');
        getReport();
    }
</script>
<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_attendance_report');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('attendance_report.' + (type || 'xlsx')));
        window.open("attendance_report.php","_self");
    }
</script>