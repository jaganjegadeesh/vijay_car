<?php
include("include_files.php");

if(isset($_REQUEST['product_row_index'])) {
   
    $product_row_index = $_REQUEST['product_row_index'];
    $product_row_index = trim($product_row_index);

    $from_date = $_REQUEST['from_date'];
    $from_date = trim($from_date);

    $to_date = $_REQUEST['to_date'];
    $to_date = trim($to_date);

    
    $engineer_salary_list=array();
    $engineer_salary_list=$obj->EngineerSalaryDetails($from_date,$to_date);
 
    $ot_salary = 0; $sno = 1;

    if(!empty($engineer_salary_list)) {
        foreach($engineer_salary_list as $key => $data) { 
            $engineer_working_days = 0;$days =0;

            if(!empty($data['engineer_id']) && !empty($from_date) && !empty($to_date)){
                $engineer_working_days = $obj->EngineerWorkingDays($data['engineer_id'],'',$from_date,$to_date);
                // if(!empty($engineer_working_days)){
                //     $engineer_working_days = number_format($engineer_working_days, 1);
                // }else{
                //     $engineer_working_days = 0;
                // }
                // $engineer_working_days = str_replace(",", "", $engineer_working_days);
               
            }

            $engineer_salary = 0; $ot_salary = 0;
            if(!empty($data['engineer_id']) && !empty($from_date) && !empty($to_date)){
                $engineer_salary = $obj->CalculateSalary($from_date, $to_date, $data['engineer_id']);
            }

            $index = $key + 1;
            if(!empty($engineer_salary)) {
                ?>
                <tr class="salary_row" id="salary_row<?php if(!empty($index)) { echo $index; } ?>">
                    <td class="sno d-none"><?php echo $index; ?></td>
                    <td class="text-center">
                        <?php 
                            if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']){
                                $engineer_code =0;
                                $engineer_code =$obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $data['engineer_id'], 'engineer_code');
                                if(!empty($engineer_code) && $engineer_code !=$GLOBALS['null_value']){
                                    echo $obj->encode_decode('decrypt',$engineer_code);
                                }else{
                                    echo " - ";
                                }
                            }  
                        ?>
                    </td>
                    <td class="text-center">
                        <?php
                            if(!empty($data['engineer_name']) && $data['engineer_name'] != $GLOBALS['null_value']) {
                                $data['engineer_name'] = $obj->encode_decode('decrypt', $data['engineer_name']);
                                echo $data['engineer_name']."<br>";
                            }
                        ?>

                        <textarea class="form-control mt-3" name="remarks[]" placeholder="Remarks"></textarea>
                        <input name="engineer_id[]" type="hidden" value="<?php if(!empty($data['engineer_id'])){ echo $data['engineer_id'] ; } ?>">
                    
                    </td>
                    <td class="text-center" style="width:150px;">
                        <?php 
                            
                            $daily_salary = 0;
                            if(!empty($data['engineer_id']) && !empty($from_date) && !empty($to_date)){
                                $from =""; $to ="";$days ="";
                                $from = date("Y-m-d", strtotime(str_replace("-", "/", $from_date)));
                                $to = date("Y-m-d", strtotime(str_replace("-", "/", $to_date)));
                                $days = (strtotime($to_date) - strtotime($from_date)) / (60 * 60 * 24) + 1;
                
                                echo "No of Days: ".$days."<br>";  
                                echo "Present Days: ".$engineer_working_days."<br>";   
                                
                                $daily_salary = $obj->getTableColumnValue($GLOBALS['attendance_table'], 'engineer_id', $data['engineer_id'], 'daily_salary');
                            }
                        ?>
                        <input name="no_of_days[]" type="hidden" value="<?php if(!empty($engineer_working_days)){ echo $engineer_working_days ;}  ?>">
                    </td>
                    <td class="text-center">
                        <?php
                            if(!empty($data['engineer_id']) && !empty($from_date) && !empty($to_date)){
                                echo $obj->numberFormat($engineer_salary, 2);
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
                        <input name="salary_amount[]" type="hidden" value="<?php if(!empty($engineer_salary)){ echo $engineer_salary; } ?>">
                    </td>
                    <td class="text-center">
                        <?php
                            $advance_amount =0;
                            $advance_amount =$obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $data['engineer_id'], 'advance_amount');
                            if(!empty($advance_amount) && $advance_amount !=$GLOBALS['null_value']){ ?>
                                <input type="text" name="advance_amount[]" class="form-control " placeholder="Enter" style="width:100px;" value="" onfocus="Javascript:KeyboardControls(this,'number','','');"  onkeyup="javascript:SalaryRowCheck(this)">
                                <span class="text-danger"><?php echo "Advance : Rs.".$advance_amount; ?></span> 
                        <?php } else {
                            echo "-"; ?>
                            <input type="hidden" name="advance_amount[]" value="">
                        <?php } ?>
                    </td>
                    <td class="text-center">
                        <?php
                        
                        if (empty($engineer_salary)) {
                            $engineer_salary = 0;
                        }
                        
                        if(empty($ot_salary) || $ot_salary == $GLOBALS['null_value']) {
                            $ot_salary = 0;
                        }
                      
                        $net_salary = $engineer_salary + $ot_salary;

                        if(empty($net_salary)){
                            $net_salary = 0 ;
                        }
                        ?>
                        <span class="cash_to_paid text-center"><?php if(!empty($net_salary)){ echo $net_salary ; }else{
                            echo "0";
                        } ?></span>
                        <input type="hidden" name="cash_to_paid[]" class="form-control " placeholder="Enter" style="width:100px;" value="<?php if(!empty($net_salary)){ echo $net_salary ;} ?>">  
                    </td>
                    <td class="text-center">
                        <button class="btn btn-danger" type="button" onclick="Javascript:DeleteSalaryRecordRow('salary_row', '<?php if(!empty($index)) { echo $index; } ?>');"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <?php
            }
        } ?>
        $$$$$$
            <?php
            echo '1'; ?>
    <?php }
    else {
        ?>
        <tr>
            <td colspan="7" class="text-center no_record" id="no_record">No Records Found</td>
        </tr>
        $$$$$$
        <?php
        echo '0';
    }
} ?>



