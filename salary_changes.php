<?php
	include("include_files.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['salary_module'];
        }
    }

	if(isset($_REQUEST['show_salary_id'])) { 
        $show_salary_id = "";
        $show_salary_id = $_REQUEST['show_salary_id'];

        $salary_date = date('Y-m-d');$from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d'); $current_date = date('Y-m-d');
        $salary_future_date = date('Y-m-d', strtotime('+7 days')); $engineer_ids = array(); $engineer_names = array(); $product_count = 0;$engineer_count=0; $advance_amounts = array(); $ot_salary_amounts =array();$no_of_days_working =array();$cash_to_paids =array();$remarks =array();$total_amounts ="";
       
        if(!empty($show_salary_id)) {
            $salary_list = array();
            $salary_list = $obj->getTableRecords($GLOBALS['salary_table'], 'salary_id', $show_salary_id, '');
            if(!empty($salary_list)) {
                foreach($salary_list as $data) {
                    if(!empty($data['salary_date']) && $data['salary_date'] != '0000-00-00') {
                        $salary_date = date("Y-m-d", strtotime($data['salary_date']));
                    }
                    if(!empty($data['from_date']) && $data['from_date'] != '0000-00-00') {
                        $from_date = date("Y-m-d", strtotime($data['from_date']));
                    }
                    if(!empty($data['to_date']) && $data['to_date'] != '0000-00-00') {
                        $to_date = date("Y-m-d", strtotime($data['to_date']));
                    }
                    if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']) {
                        $engineer_ids = explode(",", $data['engineer_id']);
                        $engineer_count = count($engineer_ids);
                    }
                    if(!empty($data['engineer_name']) && $data['engineer_name'] != $GLOBALS['null_value']) {
                        $engineer_names = explode(",", $data['engineer_name']);
                    }
                    if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                        $remarks = explode(",", $data['remarks']);
                    }
                    if(!empty($data['no_of_days']) && $data['no_of_days'] != $GLOBALS['null_value']) {
                        $no_of_days_working = explode(",", $data['no_of_days']);
                    }
                    if(!empty($data['salary_per_day']) && $data['salary_per_day'] != $GLOBALS['null_value']) {
                        $salary_per_day = explode(",", $data['salary_per_day']);
                    }
                    if(!empty($data['ot_salary_amount']) && $data['ot_salary_amount'] != $GLOBALS['null_value']) {
                        $ot_salary_amounts = explode(",", $data['ot_salary_amount']);
                    }
                    if(!empty($data['salary_amount']) && $data['salary_amount'] != $GLOBALS['null_value']) {
                        $salary_amounts = explode(",", $data['salary_amount']);
                    }
                    if(!empty($data['advance_amount']) && $data['advance_amount'] != $GLOBALS['null_value']) {
                        $advance_amounts = explode(",", $data['advance_amount']);
                    }
                    if(!empty($data['cash_to_paid']) && $data['cash_to_paid'] != $GLOBALS['null_value']) {
                        $cash_to_paids = explode(",", $data['cash_to_paid']);
                    }
                    if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                        $total_amounts = $data['total_amount'];
                    }
                }
            }
        }
        ?>
        <form class="poppins pd-20 redirection_form" name="salary_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(empty($show_salary_id)) { ?>
                            <div class="h5">Add Salary</div>
                        <?php } else if(!empty($show_salary_id)) { ?>
                            <div class="h5">Edit Salary</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="window.open('salary.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_salary_id)) { echo $show_salary_id; } ?>">
                <div class="col-lg-2 col-md-4 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="salary_date" class="form-control shadow-none" value="<?php if(!empty($salary_date)) { echo $salary_date; } ?>" max="<?php if(!empty($salary_future_date)) { echo $salary_future_date; } ?>" <?php if(!empty($show_salary_id)){?> readonly <?php } ?>>
                            <label>Salary Date</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="from_date" class="form-control shadow-none" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>" <?php if(!empty($show_salary_id)){?> readonly <?php } ?>>
                            <label>From Date</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="to_date" class="form-control shadow-none" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>" <?php if(!empty($show_salary_id)){?> readonly <?php } ?>>
                            <label>To Date</label>
                        </div>
                    </div>
                </div>
                <?php if(empty($show_salary_id)){ ?>
                <div class="col-lg-2 col-md-4 col-6 py-2">
                    <button class="btn btn-success" style="font-size:11px;" id="view_button" type="button" onclick="javascript:showSalaryRecords();"> <i class="fa fa-eye"></i> View </button>   
                
                    <button class="btn btn-danger d-none" id="clear_button"  style="font-size:11px;" type="button" onclick="javascript:clearSalaryRecords();"><i class="fa fa-trash"></i>&ensp; Clear </button>  
                </div>
                <?php } ?>
                <input type="hidden" name="engineer_count" value="<?php if(!empty($engineer_count)) { echo $engineer_count; } else { echo '0'; } ?>">
                <div class="table-responsive responsive2">
                    <table class="table text-center smallfnt table-bordered salary_table ">
                        <thead class="bg-light">
                            <tr>
                                <th>Code</th>
                                <th style="width:200px;">Engineer</th>
                                <th style="width:100px;">Days</th>
                                <th style="width:100px;">Salary</th>
                                <th >Advance</th>
                                <th>Cash To Paid</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($show_salary_id)) {
                               for($i=0; $i < count($engineer_ids); $i++) { ?>
                                    <tr class="salary_row" id="salary_row<?php if(!empty($engineer_count)) { echo $engineer_count; } ?>">
                                        <td class="sno d-none"><?php echo $engineer_count; ?></td>
                                        <td class="text-center">
                                            <?php 
                                            if(!empty($engineer_ids[$i]) && $engineer_ids[$i] != $GLOBALS['null_value']){
                                            $engineer_code =0;
                                            $engineer_code =$obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $engineer_ids[$i], 'engineer_code');
                                            if(!empty($engineer_code) && $engineer_code !=$GLOBALS['null_value']){
                                                echo $obj->encode_decode('decrypt',$engineer_code);
                                            }else{
                                                echo " - ";
                                            }
                                        }  ?></td>
                                        <td class="text-center">
                                            <?php 
                                                if(!empty($engineer_names[$i]) && $engineer_names[$i] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt',$engineer_names[$i])."<br>";
                                                }
                                            ?>
                                            
                                            <textarea class="form-control mt-3" name="remarks[]" placeholder="Remarks" value="<?php if(!empty($remarks[$i])){ echo $remarks[$i] ; } ?>"></textarea>
                                            <input name="engineer_id[]" type="hidden" value="<?php if(!empty($engineer_ids[$i])){ echo $engineer_ids[$i] ; } ?>">
                                        
                                        </td>
                                        <td class="text-center ">
                                            <?php  
                                                $daily_salary = 0;
                                                $from =""; $to ="";$days ="";
                                                $from = date("Y-m-d", strtotime(str_replace("-", "/", $from_date)));
                                                $to = date("Y-m-d", strtotime(str_replace("-", "/", $to_date)));
                                                $days = (strtotime($to_date) - strtotime($from_date)) / (60 * 60 * 24) + 1;
                                                if(!empty($no_of_days_working[$i])){
                                                    echo "No of Days: ".$days."<br>";  
                                                    echo "Present Days: ".$no_of_days_working[$i]."<br>";    
                                                }else{
                                                    echo "No of Days: ".$days."<br>";  
                                                    echo "Present Days: 0 <br>"; 
                                                }
                                            ?>
                                            <input name="no_of_days[]" type="hidden" value="<?php if(!empty($no_of_days_working[$i])){ echo $no_of_days_working[$i] ;}else{ echo "0"; }  ?>" onkeyup="javascript:SalaryRowCheck(this);">
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if(!empty($salary_amounts[$i]) && $salary_amounts[$i] != $GLOBALS['null_value']){
                                                    echo $salary_amounts[$i];
                                                }
                                                $engineer_salary = 0; $ot_salary = 0;
                                                if(!empty($ot_salary_amounts[$i]) && $ot_salary_amounts[$i] != $GLOBALS['null_value']){
                                                    echo '<br>'.'<span style="font-style:italic;">(OT : '.$obj->numberFormat($ot_salary_amounts[$i], 2).')</span>';
                                                }
                                                if(!empty($ot_salary_amounts[$i]) && $ot_salary_amounts[$i] != $GLOBALS['null_value']) {
                                                    ?>
                                                    <input type="hidden" name="ot_salary[]" value="<?php echo $ot_salary_amounts[$i]; ?>">
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                    <div class="form-group">
                                                        <div class="form-label-group in-border">
                                                            <input type="text" name="ot_salary[]" class="form-control shadow-none mx-auto text-center my-2" value="" onfocus="Javascript:KeyboardControls(this,'number',9,'');" onkeyup="Javascript:SalaryRowCheck(this);">
                                                            <label class="px-0">OT Salary</label>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                            <input name="salary_amount[]" type="hidden" value="<?php if(!empty($salary_amounts[$i])){ echo $salary_amounts[$i]; }else{
                                                echo "0" ;
                                            } ?>" onkeyup="javascript:SalaryRowCheck(this);">
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                $engineer_advance = 0;
                                                $engineer_advance = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $engineer_ids[$i], 'advance_amount');
                                                if(!empty($engineer_advance) && $engineer_advance != $GLOBALS['null_value']) {
                                                    ?>
                                                    <input type="text" name="advance_amount[]" class="form-control mx-auto" placeholder="Enter" style="width:100px;" value="<?php if(!empty($advance_amounts[$i]) && $advance_amounts[$i] != $GLOBALS['null_value']){ echo $advance_amounts[$i]; }  ?>" onfocus="Javascript:KeyboardControls(this,'number','','');"  onkeyup="javascript:SalaryRowCheck(this)">
                                                    <span class="text-danger font-italic"><?php echo $obj->numberFormat($engineer_advance, 2); ?></span>
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                    <input type="hidden" name="advance_amount[]" value="">
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="cash_to_paid text-center"><?php if(!empty($cash_to_paids[$i])){ echo $cash_to_paids[$i] ;}else{ echo "0"; } ?></span>
                                            <input type="hidden" name="cash_to_paid[]" class="form-control " placeholder="Enter" style="width:100px;" value="<?php if(!empty($cash_to_paids[$i])){ echo $cash_to_paids[$i] ;}else{ echo "0"; } ?>">  
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-danger" type="button" onclick="Javascript:DeleteSalaryRecordRow('salary_row', '<?php if(!empty($engineer_count)) { echo $engineer_count; } ?>');"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php   
                                    $engineer_count --;
                                    }
                                }
                                ?>
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold">
                                <td colspan="5" class="text-end">Total</td>
                                <td class="overall_salary"><?php if(!empty($total_amounts) && $total_amounts != $GLOBALS['null_value']){ echo $total_amounts;}?></td>
                                <td></td>
                            <tr>
                        </tfoot>        
                    </table>  
                </div>
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark template_button submit_button" type="button" onClick="Javascript:SaveModalContent(event, 'salary_form', 'salary_changes.php', 'salary.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 
    
    if(isset($_POST['edit_id'])) {
        $salary_date = ""; $salary_date_error = ""; $from_date = ""; $from_date_error = ""; $to_date = ""; $to_date_error = "";
        $engineer_ids = array(); $engineer_name = array();
        $no_of_days = array(); $salary_amount = array(); $advance_amount = array(); $advance_amount_error = ""; $salary_error = "";$remarks = array(); $remarks_error =""; $ot_salary = array();
        $edit_id = ""; $valid_salary = ""; $form_name = "salary_form"; $current_date = date("Y-m-d"); 
        $salary_future_date = date('Y-m-d', strtotime('+7 days'));

        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        if(isset($_POST['salary_date'])) {
            $salary_date = $_POST['salary_date'];
            $salary_date = trim($salary_date);
            $salary_date_error = $valid->valid_date($salary_date, "Date", "1");
            if(empty($salary_date_error)) {
                if($salary_date > $salary_future_date) {
                    $salary_date_error = "Selected Date Not allowed";
                }
            }
            if(!empty($salary_date_error)) {
                if(!empty($valid_salary)) {
                    $valid_salary = $valid_salary." ".$valid->error_display($form_name, 'salary_date', $salary_date_error, 'text');
                }
                else {
                    $valid_salary = $valid->error_display($form_name, 'salary_date', $salary_date_error, 'text');
                }
            }
        }

        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
            $from_date = trim($from_date);
            $from_date_error = $valid->valid_date($from_date, "Date", "1");
            if(!empty($from_date_error)) {
                if(!empty($valid_salary)) {
                    $valid_salary = $valid_salary." ".$valid->error_display($form_name, 'from_date', $from_date_error, 'text');
                }
                else {
                    $valid_salary = $valid->error_display($form_name, 'from_date', $from_date_error, 'text');
                }
            }
        }

        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
            $to_date = trim($to_date);
            $to_date_error = $valid->valid_date($to_date, "Date", "1");
            if(!empty($to_date_error)) {	
                if(!empty($valid_salary)) {
                    $valid_salary = $valid_salary." ".$valid->error_display($form_name, 'to_date', $to_date_error, 'text');
                }
                else {
                    $valid_salary = $valid->error_display($form_name, 'to_date', $to_date_error, 'text');
                }
            }
        }

       
        if(isset($_POST['engineer_id'])) {
            $engineer_ids = $_POST['engineer_id'];
            $engineer_ids = array_reverse($engineer_ids);
        }
        if(isset($_POST['remarks'])) {
            $remarks = $_POST['remarks'];
            $remarks = array_reverse($remarks);
        }
        if(isset($_POST['no_of_days'])) {
            $no_of_days = $_POST['no_of_days'];
            $no_of_days = array_reverse($no_of_days);
        }
        if(isset($_POST['salary_amount'])) {
            $salary_amount = $_POST['salary_amount'];
            $salary_amount = array_reverse($salary_amount);
        }
        if(isset($_POST['ot_salary'])) {
            $ot_salary = $_POST['ot_salary'];
            $ot_salary = array_reverse($ot_salary);
        }
        if(isset($_POST['advance_amount'])) {
            $advance_amount = $_POST['advance_amount'];
            $advance_amount = array_reverse($advance_amount);
        }
        

        $engineer_worked_days=array(); $total_salaries=array(); $deduction_amounts = array(); $engineer_salary=array(); $daily_salaries=array(); $ot_salaries=array(); $whole_engineer_salary=0; $voucher_engineer_ids =array(); $voucher_engineer_names=array();$voucher_advance_amount=array(); $voucher_deduction_amount=array(); $voucher_salary_received=array(); 
        $voucher_engineer_working_days=array(); 
        $voucher_deduction_amounts =array();

        if(!empty($engineer_ids)) {
            for($i=0; $i < count($engineer_ids); $i++) {
                $deduction_amount = 0;
                $engineer_ids[$i] = trim($engineer_ids[$i]);  
                $voucher_engineer_ids[$i] = trim($engineer_ids[$i]);  
                if(!empty($engineer_ids[$i])) {

                    $engineer_name = "";
                    $engineer_name = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $engineer_ids[$i], 'engineer_name');
                    $engineer_names[$i] = $engineer_name;
                    $voucher_engineer_names[$i] = $engineer_name;

                    $engineer_working_days=0;
                   
                    if(!empty($no_of_days[$i])){
                        $engineer_worked_days[$i] = $no_of_days[$i];
                    }else{
                        $engineer_worked_days[$i] = 0;
                    }

                    if(!empty($no_of_days[$i])){
                        $voucher_engineer_working_days[$i] = $no_of_days[$i];
                    }else{
                        $voucher_engineer_working_days[$i] = 0; 
                    }
                    
                    $daily_salary = 0;
                    $daily_salary = $obj->getTableColumnValue($GLOBALS['attendance_table'], 'engineer_id', $engineer_ids[$i], 'daily_salary');
                    $daily_salaries[$i] = $daily_salary;
                    if(!empty($salary_amount[$i])){
                        $salary_amount[$i] = trim($salary_amount[$i]);  
                    }else{
                        $salary_amount[$i] = 0;  
                    }
                    $total_salaries[$i] = $salary_amount[$i];
                  
                    $voucher_engineer_names[$i] = $engineer_name;

                    $ot_salaries[$i] = 0; 
                    $voucher_ot_salaries[$i] = 0;
                    if(!empty($ot_salary[$i]) && $ot_salary[$i] != $GLOBALS['null_value']) {
                        $ot_salaries[$i] = $ot_salary[$i];
                        $voucher_ot_salaries[$i] = $ot_salary[$i];
                    }
                    

                    $remarks[$i] = trim($remarks[$i]);
                    if(!empty($remarks[$i]) && $remarks[$i] != $GLOBALS['null_value']) {
                        $remarks_error = $valid->valid_address($remarks[$i], 'Remarks', '', '');
                        if(!empty($remarks_error)){
                            $valid_salary = $valid_salary." ".$valid->row_error_display($form_name, 'remarks[]', $remarks_error, 'textarea', 'salary_row', ($i+1));
                        }
                    }else{
                        $remarks[$i] ="";
                    }


                    $advance_amount[$i] = trim($advance_amount[$i]);
                    if(!empty($advance_amount[$i])) {
                        $advance_amount_error = $valid->valid_price($advance_amount[$i], 'Advance', '', '');
                        if(empty($advance_amount_error)) {
                            $table_advance_amount = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $engineer_ids[$i], 'advance_amount');
                            if($table_advance_amount == $GLOBALS['null_value'] || empty($table_advance_amount)) {
                                $advance_amount_error = "No pending Advance ".$table_advance_amount." ID : ".$engineer_ids[$i];
                            }
                            else if($table_advance_amount < $advance_amount[$i]) {
                                $advance_amount_error = "Max Amnt : ".$table_advance_amount;
                            }
                        }
                        if(!empty($advance_amount_error)){
                            $valid_salary = $valid_salary." ".$valid->row_error_display($form_name, 'advance_amount[]', $advance_amount_error, 'text', 'salary_row', ($i+1));
                        }
                        else{
                            $deduction_amount +=$advance_amount[$i];
                        }
                        
                    }else{
                        $advance_amount[$i] = 0;
                    }
                    if(!empty($advance_amount[$i])){
                        $voucher_advance_amount[$i] = $advance_amount[$i];
                    }else{
                        $voucher_advance_amount[$i] = 0;
                    }
                    
                    $deduction_amounts[$i] = trim($deduction_amount);
                    if(empty($deduction_amounts[$i])){
                        $deduction_amounts[$i] = 0;
                    }
                    if(!empty($deduction_amount)){
                       $voucher_deduction_amounts[$i] = $deduction_amount;
                    }else{
                        $voucher_deduction_amounts[$i] = 0;
                    }
                   
                    

                    $engineer_salary[$i] = $total_salaries[$i];
                   

                    if(!empty($engineer_salary[$i]) || !empty($deduction_amounts[$i])){
                        $engineer_salary_amounts[$i] = ($engineer_salary[$i] - $deduction_amounts[$i]) + $ot_salaries[$i];
                        $whole_engineer_salary += $engineer_salary_amounts[$i];
                        $salary_received[$i] = $engineer_salary_amounts[$i];
                    }

                    if(empty($engineer_salary_amounts[$i])){
                        $engineer_salary_amounts[$i] = 0;
                    }
                }

            }
        }
        else {
            $salary_error = "Select Engineer";
        }
    
        if(!empty($edit_id)){
            $select_query = "";
            $select_query = "SELECT engineer_id,id,advance_amount,voucher_id from ".$GLOBALS['salary_voucher_table']." where salary_id='".$edit_id."' AND deleted='0' ";
            $salary_voucher_list = array();
            $salary_voucher_list = $obj->getQueryRecords("", $select_query);
            foreach($salary_voucher_list as $data){
                if(!empty($engineer_ids)){
                    if(!in_array($data['engineer_id'], $engineer_ids)){
                        $columns = array("deleted");
                        $values = array("'1'");
                        $stock_update_id = $obj->UpdateSQL($GLOBALS['salary_voucher_table'], $data['id'], $columns, $values, '');
                        $payment_unique_id = "";
                        $payment_unique_id = $obj->getTableColumnValue($GLOBALS['payment_table'], 'bill_id', $data['voucher_id'],'id');

                        if(preg_match("/^\d+$/", $payment_unique_id)) {
                            $action = "Payment Deleted.";
                        
                            $columns = array(); $values = array();
                            $columns = array('deleted');
                            $values = array("'1'");
                            $msg = $obj->UpdateSQL($GLOBALS['payment_table'], $payment_unique_id, $columns, $values, $action);
                        }

                        if(!empty($data['advance_amount']) && $data['advance_amount'] != $GLOBALS['null_value']) {
                            $engineer_unique_id = "";
                            $engineer_unique_id = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $data['engineer_id'], 'id');
                            $original_advance_amount = 0;
                            $original_advance_amount = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $data['engineer_id'], 'advance_amount');
                            if(!empty($original_advance_amount) && $original_advance_amount != $GLOBALS['null_value']) {
                                $original_advance_amount = $original_advance_amount + $data['advance_amount'];
                            }
                            else {
                                $original_advance_amount = $data['advance_amount'];
                            }
                            if(preg_match("/^\d+$/", $engineer_unique_id)) {
                                $columns = array(); $values = array();
                                $columns = array('advance_amount');
                                $values = array("'".$original_advance_amount."'");
                                $engineer_update_id = $obj->UpdateSQL($GLOBALS['engineer_table'], $engineer_unique_id, $columns, $values, '');
                            }
                        }
                    }
                }
            }

            $attendance_query = "";
            $attendance_query = "SELECT engineer_id,id from ".$GLOBALS['attendance_table']." where salary_id='".$edit_id."' AND deleted='0' ";
            $salary_attendance_list = array();
            $salary_attendance_list = $obj->getQueryRecords("", $attendance_query);
            foreach($salary_attendance_list as $list){
				if(!empty($engineer_ids)){
					if(!in_array($list['engineer_id'], $engineer_ids)){
						$columns = array("salary_id", "is_salaried");
						$values = array("'".$GLOBALS['null_value']."'","'0'");
						$attendance_update_id = $obj->UpdateSQL($GLOBALS['attendance_table'], $list['id'], $columns, $values, '');
					}
				}
            }

            
        }
        
        $result = "";
        if(empty($valid_salary) && empty($salary_error)) {
           
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                if(!empty($salary_date)) {
                    $salary_date = date('Y-m-d', strtotime($salary_date));
                }
                if(!empty($engineer_ids)) {
                    $engineer_ids = array_reverse($engineer_ids);
                    $engineer_ids = implode(",", $engineer_ids);
                }
                if(!empty($engineer_names)) {
                    $engineer_names = array_reverse($engineer_names);
                    $engineer_names = implode(",", $engineer_names);
                }
                if(!empty($remarks)) {
                    $remarks = array_reverse($remarks);
                    $remarks = implode(",", $remarks);
                }else{
                    $remarks = $GLOBALS['null_value'];

                }
                if(!empty($engineer_worked_days)) {
                    $engineer_worked_days = array_reverse($engineer_worked_days);
                    $engineer_worked_days = implode(",", $engineer_worked_days);
                }else{
                    $engineer_worked_days = $GLOBALS['null_value'];

                }
                
                if(!empty($ot_salaries)) {
                    $ot_salaries = array_reverse($ot_salaries);
                    $ot_salaries = implode(",", $ot_salaries);
                }else{
                    $ot_salaries = $GLOBALS['null_value'];

                }
                if(!empty($total_salaries)) {
                    $total_salaries = array_reverse($total_salaries);
                    $total_salaries = implode(",", $total_salaries);
                }else{
                    $total_salaries = $GLOBALS['null_value'];

                }
                if(!empty($daily_salaries)) {
                    $daily_salaries = array_reverse($daily_salaries);
                    $daily_salaries = implode(",", $daily_salaries);
                }
                else{
                    $daily_salaries = $GLOBALS['null_value'];

                }
                if(!empty($advance_amount)) {
                    $advance_amount = array_reverse($advance_amount);
                    $advance_amount = implode(",", $advance_amount);
                }
                else{
                    $advance_amount = $GLOBALS['null_value'];

                }
                
                if(!empty($engineer_salary)) {
                    $engineer_salary = array_reverse($engineer_salary);
                    $engineer_salary = implode(",", $engineer_salary);
                }
                else{
                    $engineer_salary = $GLOBALS['null_value'];

                }
                if(!empty($deduction_amounts)) {
                    $deduction_amounts = array_reverse($deduction_amounts);
                    $deduction_amounts = implode(",", $deduction_amounts);
                }
                else{
                    $deduction_amounts = $GLOBALS['null_value'];

                }

                if(!empty($engineer_salary_amounts)) {
                    $engineer_salary_amounts = array_reverse($engineer_salary_amounts);
                    $engineer_salary_amounts = implode(",", $engineer_salary_amounts);
                }else{
                    $engineer_salary_amounts = 0;
                }

                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $bill_company_id =$GLOBALS['bill_company_id'];
               
                if(empty($edit_id)){
                        
                        $action = "";
                    
                        if(!empty($engineer_names)) {
                            $action = "New Salary Created. Name - ".($engineer_names);
                        }

                        $null_value = $GLOBALS['null_value'];
                        $columns = array(); $values = array();
                        $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'salary_id', 'salary_number','salary_date','from_date','to_date', 'engineer_id', 'engineer_name', 'remarks','no_of_days', 'salary_per_day', 'ot_salary_amount','salary_amount','advance_amount','deduction_amount','cash_to_paid','total_amount ','deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$null_value."'","'".$salary_date."'","'".$from_date."'","'".$to_date."'", "'".$engineer_ids."'","'".$engineer_names."'", "'".$remarks."'", "'".$engineer_worked_days."'", "'".$daily_salaries."'","'".$ot_salaries."'","'".$total_salaries."'","'".$advance_amount."'","'".$deduction_amounts."'","'".$engineer_salary_amounts."'","'".$whole_engineer_salary."'", "'0'");
    
                        $salary_insert_id = $obj->InsertSQL($GLOBALS['salary_table'], $columns, $values,'salary_id','salary_number', $action);

                        if(preg_match("/^\d+$/", $salary_insert_id)) {							
                            $result = array('number' => '1', 'msg' => 'Salary Successfully Created');	
                            
                            $salary_number ="";
                            $salary_number = $obj->getTableColumnValue($GLOBALS['salary_table'],'id',$salary_insert_id,'salary_number');

                            $salary_id =""; $salary_voucher_ids = array(); $salary_voucher_numbers = array();
                            $salary_id = $obj->getTableColumnValue($GLOBALS['salary_table'],'id',$salary_insert_id,'salary_id');
                        
                            if(!empty($voucher_engineer_ids)){
                                for($i=0;$i < count($voucher_engineer_ids);$i++) {
                                //    if(!empty($salary_received[$i])){
                                    $action ="";
                                    // if(!empty($engineer_names)) {
                                        $action = "New Salary Voucher Created";
                                    // }
    
                                    $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id','voucher_id','voucher_number', 'salary_id', 'salary_number','salary_date','from_date','to_date','engineer_id', 'engineer_name','no_of_days' ,'salary_amount','ot_salary_amount','advance_amount','deduction_amount','salary_received','deleted');
                                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'","'".$null_value."'","'".$null_value."'", "'".$salary_id."'", "'".$salary_number."'","'".$salary_date."'","'".$from_date."'","'".$to_date."'", "'".$voucher_engineer_ids[$i]."'","'".$voucher_engineer_names[$i]."'","'".$voucher_engineer_working_days[$i]."'","'".$salary_amount[$i]."'","'".$voucher_ot_salaries[$i]."'","'".$voucher_advance_amount[$i]."'","'".$voucher_deduction_amounts[$i]."'","'".$salary_received[$i]."'","'0'");

                                    $salary_voucher_insert_id = $obj->InsertSQL($GLOBALS['salary_voucher_table'], $columns, $values,'voucher_id','voucher_number', $action);

                                    if(preg_match("/^\d+$/", $salary_voucher_insert_id)) {		
                                        $balance = 1;

                                        $salary_voucher_number ="";
                                        $salary_voucher_number = $obj->getTableColumnValue($GLOBALS['salary_voucher_table'],'id',$salary_voucher_insert_id,'voucher_number');
                                        $salary_voucher_numbers[] = $salary_voucher_number;

                                        $salary_voucher_id =""; 
                                        $salary_voucher_id = $obj->getTableColumnValue($GLOBALS['salary_voucher_table'],'id',$salary_voucher_insert_id,'voucher_id');
                                        $salary_voucher_ids[] = $salary_voucher_id;
                                        
                                        $salarie_engineer_list=array();
                                        $salarie_engineer_list=$obj->SalariedEngineer($voucher_engineer_ids[$i],$salary_id,$from_date,$to_date,$voucher_advance_amount[$i], '');

                                    }
                                // }

                                }
                            }                   
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $salary_insert_id);
                        }
                }else{
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['salary_table'], 'salary_id', $edit_id, 'id');
                    
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "";
                        if(!empty($engineer_names)) {
                            $action = "Salary Updated. Date - ".$engineer_names;
                        }
    
                        $columns = array(); $values = array();
                        $columns = array('creator_name','from_date','to_date','salary_date','engineer_id', 'engineer_name', 'remarks','no_of_days', 'salary_per_day', 'ot_salary_amount','salary_amount','advance_amount','deduction_amount','cash_to_paid','total_amount');
                        $values = array("'".$creator_name."'","'".$from_date."'","'".$to_date."'","'".$salary_date."'", "'".$engineer_ids."'","'".$engineer_names."'", "'".$remarks."'", "'".$engineer_worked_days."'", "'".$daily_salaries."'","'".$ot_salaries."'","'".$total_salaries."'","'".$advance_amount."'","'".$deduction_amounts."'","'".$engineer_salary_amounts."'","'".$whole_engineer_salary."'");
                        $salary_update_id = $obj->UpdateSQL($GLOBALS['salary_table'], $getUniqueID, $columns, $values, $action);
                        if(preg_match("/^\d+$/", $salary_update_id)) {
                            $update_attendance = 1;
                            $salary_id = $edit_id;
                            $result = array('number' => '1', 'msg' => 'Updated Successfully');

                            $salary_number ="";
                            $salary_number = $obj->getTableColumnValue($GLOBALS['salary_table'],'salary_id',$salary_id,'salary_number');

                        
                            if(!empty($voucher_engineer_ids)){
                                for($i=0;$i < count($voucher_engineer_ids);$i++) {
                                    // if(!empty($salary_received[$i])){
                                        $getSalaryVoucherUniqueID = "";
                                        $getSalaryVoucherUniqueID = $obj->GetSalaryVoucherUniqueID($voucher_engineer_ids[$i], $salary_id);
                                        $original_advance = 0;
                                        $original_advance = $obj->getOriginalAdvance($voucher_engineer_ids[$i], $salary_id);
                                        $action ="";
                                        // if(!empty($engineer_names)) {
                                            $action = "Salary Voucher Updated";
                                        // }
                                        $columns = array('salary_number','salary_date','from_date','to_date','engineer_id', 'engineer_name','no_of_days' ,'salary_amount','ot_salary_amount','advance_amount','deduction_amount','salary_received');
                                        $values = array( "'".$salary_number."'","'".$salary_date."'","'".$from_date."'","'".$to_date."'",  "'".$voucher_engineer_ids[$i]."'","'".$voucher_engineer_names[$i]."'","'".$voucher_engineer_working_days[$i]."'","'".$salary_amount[$i]."'","'".$voucher_ot_salaries[$i]."'","'".$voucher_advance_amount[$i]."'","'".$voucher_deduction_amounts[$i]."'","'".$salary_received[$i]."'");

                                        $salary_voucher_updated_id = $obj->UpdateSQL($GLOBALS['salary_voucher_table'], $getSalaryVoucherUniqueID, $columns, $values, $action);
                                    
                                        if(preg_match("/^\d+$/", $salary_voucher_updated_id)) {	
                                            $balance = 1;
                                            
                                            $salary_voucher_number ="";
                                            $salary_voucher_number = $obj->getTableColumnValue($GLOBALS['salary_voucher_table'],'id',$getSalaryVoucherUniqueID,'voucher_number');
                                            $salary_voucher_numbers[] = $salary_voucher_number;

                                            $salary_voucher_id =""; 
                                            $salary_voucher_id = $obj->getTableColumnValue($GLOBALS['salary_voucher_table'],'id',$getSalaryVoucherUniqueID,'voucher_id');
                                            $salary_voucher_ids[] = $salary_voucher_id;
                                            
                                            $salarie_engineer_list=array();
                                            $salarie_engineer_list=$obj->SalariedEngineer($voucher_engineer_ids[$i],$salary_id,$from_date,$to_date,$voucher_advance_amount[$i], $original_advance);
                                        }

                                    // }
                                }
                            }                  
                        } 
                        else {
                            $result = array('number' => '2', 'msg' => $salary_update_id);
                        }
                    }
                }

                if(!empty($balance) && $balance == 1) {
                    $credit  = 0; $debit = 0; $bill_type ="Salary Voucher";
                    
                    if(!empty($voucher_engineer_ids)){
                        for($i = 0; $i < count($voucher_engineer_ids); $i++) {
                            $bill_id = ""; $bill_number = "";
                            $bill_id = $salary_voucher_ids[$i];
                            $bill_date = $salary_date;
                            $bill_number = $salary_voucher_numbers[$i];

                            $debit = $salary_received[$i];
                            $credit = 0;

                            $party_type = '4'; 

                            $update_balance ="";
                            $update_balance = $obj->UpdateBalance($bill_company_id,$bill_id,$bill_number,$bill_date,$bill_type,$voucher_engineer_ids[$i],$voucher_engineer_names[$i],$party_type,'','','','','','',$credit,$debit);
                        }
                    } 
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_salary)) {
                $result = array('number' => '3', 'msg' => $valid_salary);
            }
            else if(!empty($salary_error)) {
                $result = array('number' => '2', 'msg' => $salary_error);
            }
        }
    
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;
    }   


    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title']; 
        $search_text = "";

        $from_date ="";
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }

        $to_date ="";
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }

        $total_records_list = array();
        $total_records_list = $obj->EngineerSalaryList($from_date,$to_date,'','');
        $total_pages = 0;	
        $total_pages = count($total_records_list);
        
        $page_start = 0; $page_end = 0;
        if(!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
            if($total_pages > $page_limit) {
                if($page_number) {
                    $page_start = ($page_number - 1) * $page_limit;
                    $page_end = $page_start + $page_limit;
                }
            }
            else {
                $page_start = 0;
                $page_end = $page_limit;
            }
        }

        $show_records_list = array();
        if(!empty($total_records_list)) {
            foreach($total_records_list as $key => $val) {
                if($key >= $page_start && $key < $page_end) {
                    $show_records_list[] = $val;
                }
            }
        }
        
        $prefix = 0;
        if(!empty($page_number) && !empty($page_limit)) {
            $prefix = ($page_number * $page_limit) - $page_limit;
        }
        ?>
        <?php if($total_pages > $page_limit) { ?>
            <div class="pagination_cover mt-3"> 
                <?php
                    include("pagination.php");
                ?> 
            </div> 
        <?php } ?>
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
                        <th>Salary Date</th>
                        <th>Salary From Date</th>
                        <th>Salary To Date</th>
                        <th>Total Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(!empty($show_records_list)) {
                            foreach($show_records_list as $key => $list) {
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
                                       <?php if(!empty($list['total_amount']) && $list['total_amount'] != $GLOBALS['null_value']){
                                             echo $list['total_amount']; 
                                            
                                       } ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $edit_access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $edit_action;
                                            include('permission_action.php');
                                        }
                                        $delete_access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $delete_action;
                                            include('permission_action.php');
                                        }
                                        if(empty($edit_access_error) || empty($delete_access_error)){ ?>
                                        <div class="dropdown">
                                           <a href="#" role="button" id="dropdownMenuLink1" class="btn btn-dark show-button" class="btn btn-dark show-button poppins" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                              
                                                <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['salary_id'])) { echo $list['salary_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a></li>
                                                <li><a class="dropdown-item" target="_blank" href="reports/rpt_salary_a4.php?view_salary_id=<?php if(!empty($list['salary_id'])) { echo $list['salary_id']; } ?>"><i class="fa fa-print"></i> &ensp; Print </a></li>
                                            </ul>
                                        </div> 
                                        <?php } ?>
                                    </td>
                                </tr>
                    <?php 
                            }
                        } 
                        else {
                    ?>
                            <tr>
                                <td colspan="8" class="text-center">Sorry! No records found</td>
                            </tr>
                    <?php 
                        } 
                    ?>
                </tbody>
            </table>   
         <?php	
        }  
	}
    ?>