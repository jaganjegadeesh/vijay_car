<?php
include("../include_files.php");
include("../include/number2words.php");



$view_voucher_id = "";
if (isset($_REQUEST['view_voucher_id'])) {
    $view_voucher_id = $_REQUEST['view_voucher_id'];
} else {
    header("Location: ../salary_voucher.php");
    exit;
}

$voucher_number ="";$voucher_id="";$from_date="";$to_date = "";$engineer_type_id ="";$engineer_id ="";$engineer_name = "";$no_of_days ="";$salary_amount = "";$advance_amount =""; $deduction_amount ="";$allowance_amount ="";$salary_received =""; $deduction_amount =0;$pf_amounts =0;$esi_amounts =0;$advance_amounts =0;$allowance_amount=0; $ot_salary=0;$salary_amounts=0;
$amounts =0; $ot_hours=0;

$total_ot_salary=0;
require_once('../fpdf/fpdf.php');
$pdf = new FPDF('P', 'mm', [80, 150]);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);

$file_name = 'Salary Voucher';

    $pdf->SetFont('Arial','B',9);
    
    $company_logo = "";
    $company_logo = $obj->getTableColumnValue($GLOBALS['company_table'],'primary_company','1','logo');
    
    $company_list = array(); $company_details = "";
    $company_list = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'company_details');
    if(!empty($company_list)){
        $company_details =html_entity_decode($obj->encode_decode('decrypt',$company_list));
        $company_details = explode("$$$", $company_details);
    }
    $bill_company_id = $GLOBALS['bill_company_id'];
    
    $pdf->SetY(7);
    $pdf->SetX(7);
    $pdf->SetFont('Arial','B',9);


    $pdf->Cell(66,6,$file_name,1,1,'C',0);
    $y = $pdf->GetY(); 
    $pdf->SetFont('Arial','B',8);
    
    $pdf->SetY($y);
    $pdf->SetX(7);

    if (!empty($company_details)) {
        for ($c = 0; $c < count($company_details); $c++) {
            $company_details[$c] = trim($company_details[$c]);
            if (!empty($company_details[$c]) && $company_details[$c] != $GLOBALS['null_value']) {
                
                if ($c === 0) {  // Corrected comparison
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->MultiCell(0, 7, $company_details[$c], 0, 'C');
                    $rt = $pdf->gety();
                }else {
                    $pdf->SetFont('Arial', '', 8);
                    // $pdf->sety($rt);
                    $pdf->SetX(7);
                    $pdf->MultiCell(0, 4, $company_details[$c], 0, 'C');
                    $end_y =$pdf->GetY();
                }
            }
        }
    }

    if($end_y < 42){
        $end_y = 42;
    }
    $pdf->SetY(7);
    $pdf->SetX(7);
    $pdf->Cell(66,($end_y - 5),'',1,1,'C');
    $header_end = $pdf->GetY();

    $pdf->SetY($header_end);

if (!empty($view_voucher_id)) {
    $salary_voucher_list = $obj->getTableRecords($GLOBALS['salary_voucher_table'], 'voucher_id', $view_voucher_id, '');
    if (!empty($salary_voucher_list)) {
        foreach ($salary_voucher_list as $data) {
            $pdf->SetTitle('Salary Voucher');
            $pdf->SetFont('Arial', 'B','9');
            $pdf->SetY($header_end);
            $pdf->SetX(7);
            $pdf->Cell(66, 7, 'Salary for '.date("d-m-Y", strtotime($data['from_date']))." to ".date("d-m-Y", strtotime($data['to_date'])), 1, 1, 'C', 0);
            $start_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B','8');

            if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']){
              $engineer_name_code="";
              $engineer_name_code=$obj->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$data['engineer_id'],'engineer_name');

                $engineer_name_code=$obj->encode_decode('decrypt',$engineer_name_code);
                if(!empty($engineer_name_code)){
                    $pdf->SetX(7);
                    $pdf->MultiCell(0, 5,"Engineer : ". $engineer_name_code, 0, 'L', 0); 
                }else{
                    $engineer_name_code="";
                    $engineer_name_code=$obj->encode_decode('decrypt',$data['engineer_name']);
                    $pdf->SetX(7);
                    $pdf->MultiCell(0, 5,"Engineer : ". $engineer_name_code, 0, 'L', 0);  
                }

            }
           
            $balance_y = $pdf->GetY();
            if(!empty($data['no_of_days']) && $data['no_of_days'] != $GLOBALS['null_value']){
                $pdf->SetX(7);
                $pdf->Cell(30, 5,"Days : ". $data['no_of_days'], 0,1, 'L', 0);
            }else{
                $pdf->SetX(7);
                $pdf->Cell(30, 5,'', 0,1, 'L', 0);
                $data['no_of_days'] = 0;
            }

            $balance_advance_amount = 0;
            if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']) {
                $balance_advance_amount = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $data['engineer_id'], 'advance_amount');
                if(!empty($balance_advance_amount) && $balance_advance_amount != $GLOBALS['null_value']) {
                    $pdf->SetY($balance_y);
                    $pdf->SetX(35);
                    $pdf->Cell(35,5,'Bal.Adv : Rs.'.$balance_advance_amount,0,1,'R');
                }
            }

            $end_y = $pdf->GetY();
            $pdf->SetY($start_y);
            $pdf->SetX(7);
            $pdf->Cell(66, ($end_y - $start_y), '', 1, 1, 'C');


            // Salary Details Table
            $pdf->SetX(7);
            $pdf->Cell(30, 6, "Particulars", 1, 0, 'C');
            $pdf->Cell(18, 6, "Earnings", 1, 0, 'C');
            $pdf->Cell(18, 6, "Deduction", 1, 1, 'C');

            // Salary Row
            $salary_y = $pdf->GetY(); 
            $pdf->SetX(7);
            $pdf->Cell(30, 10, "Salary", 0, 1, 'L');
            if(!empty($data['ot_salary_amount']) && $data['ot_salary_amount'] != $GLOBALS['null_value']){
                $total_ot_salary=$data['ot_salary_amount'];
                $ot_hrs_label = "";
                if(!empty($data['ot_hours']) && $data['ot_hours'] != $GLOBALS['null_value']) {
                    $ot_hrs_label = "(Hrs: ".$data['ot_hours'].")";
                }
                $pdf->SetX(7);
                $pdf->Cell(30, 10,"OT Wages".$ot_hrs_label, 0, 1, 'L');
            }
            $salary_end_y = $pdf->GetY(); 
            
            $pdf->SetY($salary_y);
            $pdf->SetX(7);
            $pdf->Cell(30, ($salary_end_y - $salary_y), '', 1, 1, 'C');
        
            $pdf->SetY($salary_y);
           
           
            if(!empty($data['salary_amount']) && $data['salary_amount'] != $GLOBALS['null_value']){
                $salary_amounts =$data['salary_amount'] - $total_ot_salary;
                $pdf->SetX(37); 
                $pdf->Cell(18, 10,number_format($salary_amounts,2), 0, 1, 'R');
            }
            if(!empty($total_ot_salary) && $total_ot_salary != $GLOBALS['null_value']){
            
                $pdf->SetX(37); 
                $pdf->Cell(18, 10,number_format($total_ot_salary,2), 0, 1, 'R');
                
            } 
            
            $salary_amt_end_y = $pdf->GetY(); 
            
            $grosspay_y = $pdf->GetY(); 
            $pdf->SetY($salary_y);
            $pdf->SetX(37);
            $pdf->Cell(18, ($salary_amt_end_y - $salary_y), '', 1, 1, 'C');
            $pdf->SetY($salary_y);
            $pdf->SetX(55);
            $pdf->Cell(18, ($salary_amt_end_y - $salary_y + 6), '', 1, 1, 'C');

           
            $pdf->SetY($grosspay_y);
            $pdf->SetX(7); 
            $pdf->Cell(30, 6, "Gross Pay", 1, 1, 'L');
            $grosspay_y_end_y = $pdf->GetY(); 
            
            $pdf->SetY($grosspay_y);
            $pdf->SetX(37); 
            $pdf->Cell(18, 6,number_format($salary_amounts + $total_ot_salary,2), 1, 1, 'R');
                
            $salary_amt_end_y = $pdf->GetY(); 
            
            $salary_amt_end_y = $pdf->GetY(); 
           
            if(!empty($data['advance_amount']) && $data['advance_amount'] != $GLOBALS['null_value']){
                $pdf->SetX(7);
                $pdf->Cell(30, 7, "Advance Amt", 1, 0, 'L');
                $pdf->Cell(18, 7,'', 1, 0, 'R');
            }
            
            if(!empty($data['advance_amount']) && $data['advance_amount'] != $GLOBALS['null_value']){
                // $pdf->SetX(57); 
                $pdf->Cell(18, 7,number_format($data['advance_amount'],2), 1, 1, 'R');
            }

            if(!empty($data['deduction_amount'])){
                $pdf->SetX(7); 
                $pdf->Cell(48, 6, "Total ded.", 1, 0, 'L');
                
                $deduction_y_end_y = $pdf->GetY(); 
            }
            
            $deduction_y = $pdf->GetY();
         
            if(!empty($data['deduction_amount'])){
                $pdf->SetY($deduction_y);
                $pdf->SetX(55); 
                $pdf->Cell(18, 6,number_format($data['deduction_amount'],2) , 1, 1, 'R');
            }

            $pdf->SetX(7); 
            $pdf->Cell(66, 6, "NET PAY Rs.". number_format($data['salary_received'],2), 1, 1, 'C');
            $pdf->SetFont('helvetica', 'B','7');
            $pdf->SetX(7); 
            $pdf->MultiCell(66, 6,"Rupees - ". getIndianCurrency($data['salary_received']) . ' Only', 1, 'L');
        }
    }
}

$pdf->Output('','Salary Voucher');
