<?php

    include("../include_files.php");
    include("../include/number2words.php");

    $view_salary_id = "";
    if(isset($_REQUEST['view_salary_id'])) {
        $view_salary_id = $_REQUEST['view_salary_id'];
    }
    else {
        header("Location: ../salary.php");
        exit;
    }
 
    $salary_date = date('Y-m-d');$from_date = date('Y-m-d', strtotime('-10 days')); $to_date = date('Y-m-d');
    $current_date = date('Y-m-d'); $engineer_ids = array(); $engineer_names = array(); $product_count = 0; $no_of_days = array(); $salary_per_day = array(); $ot_salary_amounts= array(); $salary_amounts= array(); $pf_amounts= array(); $esi_amounts= array(); $advance_amounts= array();  $deduction_amounts= array(); $travel_allowances= array(); $allowance_amounts= array(); $cash_to_paids= array();
    $total_amount = 0; $salary_number = ""; 
  
    if(!empty($view_salary_id)) {
        $salary_list = array();
        $salary_list = $obj->getTableRecords($GLOBALS['salary_table'], 'salary_id', $view_salary_id,'');
        if(!empty($salary_list)) {
            foreach($salary_list as $data) {
                if(!empty($data['from_date']) && $data['from_date'] != '0000-00-00') {
                    $from_date = date("d-m-Y", strtotime($data['from_date']));
                    // $from_date = date("d-m-Y", strtotime($from_date));
                }
                if(!empty($data['salary_date']) && $data['salary_date'] != '0000-00-00') {
                    $salary_date = date("d-m-Y", strtotime($data['salary_date']));
                    // $salary_date = date("d-m-Y", strtotime($salary_date));
                }
                if(!empty($data['to_date']) && $data['to_date'] != '0000-00-00') {
                    $to_date = date("d-m-Y", strtotime($data['to_date']));
                    // $to_date = date("d-m-Y", strtotime($to_date));
                }
                if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']) {
                    $engineer_ids = explode(",", $data['engineer_id']);
                }
                if(!empty($data['engineer_name']) && $data['engineer_name'] != $GLOBALS['null_value']) {
                    $engineer_names = explode(",", $data['engineer_name']);
                    // print_r($staff_names);
                }
                if(!empty($data['no_of_days']) && $data['no_of_days'] != $GLOBALS['null_value']) {
                    $no_of_days = explode(",", $data['no_of_days']);
                }
                if(!empty($data['salary_per_day']) && $data['salary_per_day'] != $GLOBALS['null_value']) {
                    $salary_per_day = explode(",", $data['salary_per_day']);
                }
                if(!empty($data['salary_amount']) && $data['salary_amount'] != $GLOBALS['null_value']) {
                    $salary_amounts = explode(",", $data['salary_amount']);
                }
                if(!empty($data['ot_salary_amount']) && $data['ot_salary_amount'] != $GLOBALS['null_value']) {
                    $ot_salary_amounts = explode(",", $data['ot_salary_amount']);
                }
                if(!empty($data['advance_amount']) && $data['advance_amount'] != $GLOBALS['null_value']) {
                    $advance_amounts = explode(",", $data['advance_amount']);
                }
                if(!empty($data['deduction_amount']) && $data['deduction_amount'] != $GLOBALS['null_value']) {
                    $deduction_amounts = explode(",", $data['deduction_amount']);
                }
                if(!empty($data['cash_to_paid']) && $data['cash_to_paid'] != $GLOBALS['null_value']) {
                    $cash_to_paids = explode(",", $data['cash_to_paid']);
                }
                if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                    $total_amount = $data['total_amount'];
                } 
                if(!empty($data['salary_number']) && $data['salary_number'] != $GLOBALS['null_value']) {
                    $salary_number = $data['salary_number'];
                } 
            }
        }
    }

    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();
	$pdf->SetAutoPageBreak(false);
	$pdf->SetTitle('Salary');

    $file_name='Salary List ('.$from_date.' to '.$to_date.')';
    include("rpt_header.php");
    $pdf->SetY($header_end);
    $pdf->SetTitle('Salary List');
    $pdf->SetFont('Arial','B',12);
    $title_y = $pdf->GetY();

    $pdf->SetFont('Arial','',10);
    $pdf->SetY($title_y);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(0,7,'Salary Date : '.$salary_date,1,1,'C',0);

    $date_y = $pdf->GetY();


    
    $pdf->SetFillColor(101,114,122);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetY($date_y);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(25,7,'Code',1,0,'C',1);
    $pdf->Cell(45,7,'Engineer Name',1,0,'C',1);
    $pdf->Cell(30,7,'Salary',1,0,'C',1);
    $pdf->Cell(25,7,'Advance',1,0,'C',1);
    $pdf->Cell(35,7,'Cash to Paid',1,0,'C',1);
    $pdf->Cell(30,7,'Signature',1,1,'C',1);

    $pdf->SetFont('Arial','',9);
    $pdf->SetTextColor(0,0,0);

    $y_axis=$pdf->GetY();

    $footer_height = 0;
    $footer_height = 10;

    $total_quantity = 0; $total_salary = 0; $s_no = 1; $start_y = ""; $second_y = ""; $daily_production_y = ""; $contractor_end_y = "";$total_pf_amounts=0; $total_esi_amounts=0; 

    $engineer_name = ""; 
    if(!empty($view_salary_id) && !empty($engineer_ids)) {
        for($p = 0; $p < count($engineer_ids); $p++) { 
            if($pdf->GetY()>260){
                $next_page_y = $pdf->GetY();

                $pdf->SetX(10);
                $pdf->SetFont('Arial','B',9);
                $next_page = 0;
                $next_page = $pdf->PageNo() + 1;
                $pdf->SetFont('Arial','I',7);
                $pdf->Cell(0,8,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetTitle('Salary');
                
                $file_name='Salary List ('.$from_date.' to '.$to_date.')';
                include("rpt_header.php");
                $pdf->SetY($header_end);
                $pdf->SetTitle('Salary List');
                $pdf->SetFont('Arial','B',12);
                $title_y = $pdf->GetY();

                $pdf->SetFont('Arial','',10);
                $pdf->SetY($title_y);
                $pdf->SetFont('Arial','B',9);
                $pdf->Cell(0,7,'Salary Date : '.$salary_date,1,1,'C',0);

                $date_y = $pdf->GetY();


                
                $pdf->SetFillColor(101,114,122);
                $pdf->SetTextColor(255,255,255);
                $pdf->SetY($date_y);
                $pdf->SetFont('Arial','B',9);
                $pdf->SetX(10);
                $pdf->Cell(25,7,'Code',1,0,'C',1);
                $pdf->Cell(45,7,'Engineer Name',1,0,'C',1);
                $pdf->Cell(30,7,'Salary',1,0,'C',1);
                $pdf->Cell(25,7,'Advance',1,0,'C',1);
                $pdf->Cell(35,7,'Cash to Paid',1,0,'C',1);
                $pdf->Cell(30,7,'Signature',1,1,'C',1);

                $pdf->SetFont('Arial','',9);
                $pdf->SetTextColor(0,0,0);

                $y_axis=$pdf->GetY();

            }

            $engineer_name = trim($engineer_names[$p]);

            if(!empty($salary_amounts[$p])){
                $salary_amounts[$p] = trim($salary_amounts[$p]);
            }

            if(!empty($advance_amounts[$p])){
                $advance_amounts[$p] = trim($advance_amounts[$p]);
            }
          
            if(!empty($deduction_amounts[$p])){
                $deduction_amounts[$p] = trim($deduction_amounts[$p]);
            }

            if(!empty($cash_to_paids[$p])){
                $cash_to_paids[$p] = trim($cash_to_paids[$p]);
            }



            $engineer_code = "";
            $engineer_code = $obj->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$engineer_ids[$p],'engineer_code');
            $engineer_code = $obj->encode_decode('decrypt',$engineer_code);

            $row_y = $pdf->GetY();

            $pdf->SetX(10);
            $pdf->Cell(25,7,$engineer_code,0,0,'C',0);
            $code_y = $pdf->GetY();

            $pdf->SetY($row_y);
            $pdf->SetX(35);
            $pdf->SetFont('Arial','',9);
            $pdf->MultiCell(45,7,html_entity_decode($obj->encode_decode('decrypt',$engineer_name),ENT_QUOTES),0,'C',0);
            $engineer_y = $pdf->GetY();

            $pdf->SetY($row_y);
            if(!empty($salary_amounts[$p])){
                $pdf->SetX(80);
                $pdf->MultiCell(30,7,$obj->numberFormat($salary_amounts[$p],2),0,'R',0);

                if(!empty($ot_salary_amounts[$p])){
                    $pdf->SetX(80);
                    $pdf->SetTextColor(128, 128, 128);
                    $pdf->SetFont('Arial','I',9);
                    $pdf->MultiCell(30,7,"OT : ". $obj->numberFormat($ot_salary_amounts[$p],2),0,'R',0);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',9);
                } 
            } else {
                $pdf->SetX(80);
                $pdf->MultiCell(30,7,'-',0,'C',0);
            }
            $salary_y = $pdf->GetY();


            $pdf->SetY($row_y);
            $pdf->SetX(110);
            
            if(!empty($advance_amounts[$p])){
                $pdf->MultiCell(25,7,$obj->numberFormat($advance_amounts[$p],2),0,'R',0);
            } else {
                $pdf->MultiCell(25,7,'-',0,'C',0);
            }
            $advance_y = $pdf->GetY();

            $pdf->SetY($row_y);
            $pdf->SetX(135);
            
            if(!empty($cash_to_paids[$p])){
                $pdf->MultiCell(35,7,$obj->numberFormat($cash_to_paids[$p],2),0,'R',0);
            } else {
                $pdf->MultiCell(35,7,'-',0,'C',0);
            }
            $paid_y = $pdf->GetY();
            
            $max_y = max(array($code_y, $engineer_y,$salary_y,$advance_y,$paid_y));

            $pdf->setY($row_y);
            $pdf->SetX(10);
            $pdf->Cell(25,($max_y - $row_y),'',1,0,'C',0);
            $pdf->Cell(45,($max_y - $row_y),'',1,0,'C',0);            
            $pdf->Cell(30,($max_y - $row_y),'',1,0,'C',0);        
            $pdf->Cell(25,($max_y - $row_y),'',1,0,'C',0);
            $pdf->Cell(35,($max_y - $row_y),'',1,0,'C',0);
            $pdf->Cell(30,($max_y - $row_y),'',1,1,'C',0);

            $s_no++;

            
        }
    }

    $end_y = $pdf->GetY();

    if(($footer_height+$end_y) >= 270){

        $y = $pdf->GetY();

        $pdf->SetY($y_axis);

        $pdf->SetX(10);
        $pdf->Cell(25,277 - $y_axis,'',1,0,'C',0);
        $pdf->Cell(45,277 - $y_axis,'',1,0,'C',0);            
        $pdf->Cell(30,277 - $y_axis,'',1,0,'C',0);        
        $pdf->Cell(25,277 - $y_axis,'',1,0,'C',0);
        $pdf->Cell(35,277 - $y_axis,'',1,0,'C',0);
        $pdf->Cell(30,277 - $y_axis,'',1,1,'C',0);


        $pdf->SetFont('Arial','B',9);

        $next_page = $pdf->PageNo()+1;

        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(-15);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

        $pdf->AddPage();

        $file_name='Salary List ('.$from_date.' to '.$to_date.')';
        include("rpt_header.php");
        $pdf->SetY($header_end);
        $pdf->SetTitle('Salary List');
        $pdf->SetFont('Arial','B',12);
        $title_y = $pdf->GetY();

        $pdf->SetFont('Arial','',10);
        $pdf->SetY($title_y);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(0,7,'Salary Date : '.$salary_date,1,1,'C',0);

        $date_y = $pdf->GetY();


        
        $pdf->SetFillColor(101,114,122);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetY($date_y);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(10);
        $pdf->Cell(25,7,'Code',1,0,'C',1);
        $pdf->Cell(45,7,'Engineer Name',1,0,'C',1);
        $pdf->Cell(30,7,'Salary',1,0,'C',1);
        $pdf->Cell(25,7,'Advance',1,0,'C',1);
        $pdf->Cell(35,7,'Cash to Paid',1,0,'C',1);
        $pdf->Cell(30,7,'Signature',1,1,'C',1);

        $pdf->SetFont('Arial','',9);
        $pdf->SetTextColor(0,0,0);

        $y_axis=$pdf->GetY();



        $content_height = 280 - $footer_height;



        $pdf->SetY($y_axis);

        $pdf->SetX(10);
        $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(45,($content_height - $y_axis),'',1,0,'C',0);            
        $pdf->Cell(30,($content_height - $y_axis),'',1,0,'C',0);        
        $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(35,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(30,($content_height - $y_axis),'',1,1,'C',0);

        $pdf->SetY($content_height);

    } else {
        $content_height = 280 - $footer_height;
        $pdf->SetY($y_axis);

        $pdf->SetX(10);

        $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(45,($content_height - $y_axis),'',1,0,'C',0);            
        $pdf->Cell(30,($content_height - $y_axis),'',1,0,'C',0);        
        $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(35,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(30,($content_height - $y_axis),'',1,1,'C',0);
        

    }

    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(125,10,'Total',1,0,'R',0);
    if(!empty($total_amount)){
        $pdf->SetX(135);
        $pdf->Cell(35,10,$obj->numberFormat($total_amount,2) ,1,0,'R',0);
        $pdf->Cell(30,10,'',1,1,'R',0);
    }else{
        $pdf->SetX(135);
        $pdf->Cell(35,10,'-' ,1,0,'C',0);
        $pdf->Cell(30,10,'',1,1,'R',0);
    }

    $pdf->SetFont('Arial', '', 7);
    $pdf->SetY(10);
    $pdf->SetX(10);
    $pdf->Cell(190, 270, '', 1, 0, 'C');

    $pdf->SetY(-15);
    $pdf->SetX(180);
    $pdf->SetFont('Arial','I',7);
    $pdf->Cell(0,8,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

    
    $pdf->Output('',$salary_number);
?>