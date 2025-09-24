<?php 
	$page_title = "Salary Voucher"; 
    include("include_user_check_and_files.php");
    $page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['salary_voucher_module'];
            include("permission_check.php");
        }
    }

    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d');$current_date = date('Y-m-d');

   
    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }

  
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }

    $engineer_id ="";
    if(isset($_POST['engineer_id'])) {
        $engineer_id = $_POST['engineer_id'];   
    }

    $engineer_list = array();
    $engineer_list = $obj->EngineerList();

    $total_records_list = array();
    $total_records_list = $obj->SalariedEngineerList($from_date,$to_date,$engineer_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    
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
                                <form name="salary_voucher_form" method="post">
                                    <div class="row justify-content-end p-2">   
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border">
                                                    <input type="date" name="from_date" class="form-control shadow-none" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>" onchange="Javascript:checkDateCheck();getsalaryVoucher();">
                                                    <label>From Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border">
                                                    <input type="date" name="to_date" class="form-control shadow-none" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>" onchange="Javascript:checkDateCheck();getsalaryVoucher();">
                                                    <label>To Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border mb-0">
                                                    <select name="engineer_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getsalaryVoucher();"> 
                                                    <option value="">Select</option>
                                                        <?php
                                                            if(!empty($engineer_list)) {
                                                                foreach($engineer_list as $data) {
                                                                    if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']) {
                                                                        ?>
                                                                        <option value="<?php echo $data['engineer_id'] ; ?>" <?php if(!empty($engineer_id) && $engineer_id == $data['engineer_id']) { ?>selected<?php } ?>>
                                                                            <?php
                                                                                if(!empty($data['engineer_name']) && $data['engineer_name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['engineer_name']);

                                                                                    if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']) {
                                                                                        $engineer_code="";
                                                                                        $engineer_code=$obj->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$data['engineer_id'],'engineer_code');
                                                                                        if(!empty($engineer_code)){
                                                                                            $engineer_code = $obj->encode_decode('decrypt',$engineer_code);
                                                                                            echo " - (".$engineer_code.")";
                                                                                        }
                                                                                    }
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
                                    
                                        <div class="col-sm-6 col-xl-8">
                                            <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                            <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                        </div>	
                                    </form>
                                </div>
                            </div>
                            
                                <?php
                                $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_action = $view_action;
                                    include('permission_action.php');
                                }
                                if(empty($access_error)) { 
                                    ?>
                                    <table class="table nowrap cursor text-center smallfnt">
                                        <thead class="bg-light border">
                                            <tr class="border">
                                                <th>S.No</th>
                                                <th>Salary Voucher Date</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                                <th>Voucher Number</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if(!empty($total_records_list)) {
                                                    foreach($total_records_list as $key => $list) {
                                                        $index = $key + 1;
                                                        if(!empty($prefix)) { $index = $index + $prefix; }
                                            ?>
                                                        <tr >
                                                            <td><?php echo $index; ?></td>
                                                            <td>
                                                                <?php
                                                                    if(!empty($list['salary_date'])) {
                                                                    echo date('d-m-Y', strtotime($list['salary_date']));
                                                                    }
                                                                ?>    
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if(!empty($list['from_date'])) {
                                                                    echo date('d-m-Y', strtotime($list['from_date']));
                                                                    }
                                                                ?>    
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if(!empty($list['to_date'])) {
                                                                    echo date('d-m-Y', strtotime($list['to_date']));
                                                                    }
                                                                ?>    
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if(!empty($list['voucher_number']) && $list['voucher_number']!=$GLOBALS['null_value']) {
                                                                        echo $list['voucher_number'];
                                                                    }
                                                                ?>  
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if(!empty($list['engineer_name']) && $list['engineer_name']!=$GLOBALS['null_value']) {
                                                                        echo $obj->encode_decode('decrypt', $list['engineer_name']);

                                                                        if(!empty($list['engineer_id']) && $list['engineer_id'] != $GLOBALS['null_value']) {
                                                                            $engineer_code="";
                                                                            $engineer_code=$obj->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$list['engineer_id'],'engineer_code');
                                                                            if(!empty($engineer_code)){
                                                                                $engineer_code = $obj->encode_decode('decrypt',$engineer_code);
                                                                                echo " - (".$engineer_code.")";
                                                                            }
                                                                        }

                                                                    }
                                                                ?> 
                                                            </td> 
                                                            <td>
                                                            <?php if(!empty($list['salary_received']) && $list['salary_received'] != $GLOBALS['null_value']){
                                                                    echo $list['salary_received']; 
                                                                    
                                                            } ?>
                                                            </td>
                                                            <td> 
                                                                <?php 
                                                                    $access_error = "";
                                                                    if(!empty($login_staff_id)) {
                                                                        $permission_action = $view_action;
                                                                        include('permission_action.php');
                                                                    }
                                                                    if(empty($access_error)) {
                                                                ?> 
                                                                    <a class="pe-2" target="_blank" href="reports/rpt_salary_voucher_3inch.php?view_voucher_id=<?php if(!empty($list['voucher_id'])) { echo $list['voucher_id']; } ?>"><i class="fa fa-print"></i> </a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                            <?php 
                                                    }
                                                } 
                                                else {
                                            ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">Sorry! No records found</td>
                                                    </tr>
                                            <?php 
                                                } 
                                            ?>
                                        </tbody>
                                    </table>   
                                <?php	
                                }  
                            ?>
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
        $("#salaryvoucher").addClass("active");
       
    });
</script>
<script type="text/javascript">
    function getsalaryVoucher() {
        if(jQuery('form[name="salary_voucher_form"]').length > 0) {
            jQuery('form[name="salary_voucher_form"]').submit();
        }
    }
    
</script>
