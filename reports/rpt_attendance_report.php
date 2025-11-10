<?php

    include("../include_user_check_and_files.php");
    
    $to_date = ""; $from_date = "";
   $engineer_id = ""; $ordering = ""; $from = ""; 
    

    if(isset($_REQUEST['engineer_id'])) {
        $engineer_id = $_REQUEST['engineer_id'];
    }
    
    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }

    if(!empty($from_date)) {
        $from_date = date('d-m-Y', strtotime($from_date));
    }
    if(!empty($to_date)) {
        $to_date = date('d-m-Y', strtotime($to_date));
    }

  
    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }
    
    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }

    $total_records_list = array();

    $total_records_list = array();
    $total_records_list = $obj->getEngineerAttendanceList($from_date, $to_date,$engineer_id);

    $company_name = array(); $company_details = "";
    $company_list =$obj ->getTableRecords($GLOBALS['company_table'],'','','');
    if(!empty($company_list)){
        foreach ($company_list as $details){
            if(!empty($details['name'])){
                $company_name =$details['name'];
                $company_name =$obj->encode_decode('decrypt',$company_name);
            }
            if(!empty($details['address'])){
                $company_address =$details['address'];
            }
            if(!empty($details['company_details'])){
                $company_details =$details['company_details'];
                $company_details = $obj->encode_decode('decrypt',$company_details);
                $company_details = explode("<br>", $company_details);
            }
        }
    }

    if(!empty($from_date)){
        $from_date = date('d-m-Y', strtotime($from_date));
    }
    if(!empty($to_date)){
        $to_date = date('d-m-Y', strtotime($to_date));
    }
    $date_display ="";
    if($from_date == $to_date){
        $date_display = '( '.$from_date.' )';
    }
    else{
        $date_display = '('.$from_date . ' to '. $to_date . ')';
    }
    require_once('../fpdf/fpdf.php');

    $pdf = new FPDF('P','mm','A4');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
	$pdf->SetTitle('Attendance Report');
    $pdf->SetFont('Arial','B',9);
	$pdf->SetY(10);
    $pdf->SetX(10);
    $pdf->SetFont('Arial','B',8);
    if(!empty($total_records_list)) {
        
        $pdf->SetFont('Arial','B',9); $engineer_name = "";
        
        $pdf->SetX(10);
        $pdf->Cell(190,7,'Attendance Report '.$date_display ,1,1,'C',0);
        $file_name="";
        include("rpt_header.php");
        
        $pdf->SetY($header_end);

        $pdf->SetFillColor(52,58,64);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetX(10);
        $pdf->Cell(10,8,'#',1,0,'C',1);
        $pdf->Cell(20,8,'Date',1,0,'C',1);
        $pdf->Cell(80,8,'Engineer',1,0,'C',1);
        $pdf->Cell(40,8,'Attendance',1,0,'C',1);
        $pdf->Cell(40,8,'Salary',1,1,'C',1);
        $pdf->SetTextColor(0,0,0);
        $start_y = $pdf->GetY();

        $pdf->SetFont('Arial','',7);
        $s_no = "1"; $total_quantity = 0;

        foreach($total_records_list as $key => $data) {
            $index = $key + 1; 
            if($pdf->GetY() > 270){
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(-15);
                $pdf->SetX(10);
                $pdf->Cell(190,6,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetFillColor(52,58,64);
                $pdf->SetTextColor(255,255,255);
                $pdf->SetFont('Arial','B',9);
                $pdf->SetX(10);
                $pdf->Cell(10,8,'#',1,0,'C',1);
                $pdf->Cell(20,8,'Date',1,0,'C',1);
                $pdf->Cell(80,8,'Engineer',1,0,'C',1);
                $pdf->Cell(40,8,'Attendance',1,0,'C',1);
                $pdf->Cell(40,8,'Salary',1,1,'C',1);
                $pdf->SetTextColor(0,0,0);

                $pdf->SetFont('Arial','',8);
                $start_y = $pdf->GetY();
            }
            

            $pdf->SetFont('Arial','',8);

            $pdf->SetX(10);
            $pdf->Cell(10,5,$s_no,0,0,'C',0);
    
            if(!empty($data['attendance_date'])) {
                $attendance_date = "";
                $attendance_date = date('d-m-Y', strtotime($data['attendance_date']));
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(20, 5, $attendance_date, 0, 'L', 0);
            }
            else{
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(20, 5,'-', 0, 'L', 0);
            }
            $date_y = $pdf->GetY() - $start_y;

            $engineer_type_y = $pdf->GetY() - $start_y;
             $engineer_code = "";
            if(!empty($data['engineer_name'] && $data['engineer_name'] != $GLOBALS['null_value'])){
                $engineer_names = $obj->encode_decode('decrypt',$data['engineer_name']);
                if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']){
                    $engineer_code = $obj->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$data['engineer_id'],'engineer_code');
                    $engineer_code = $obj->encode_decode('decrypt',$engineer_code);
                }
               
                $pdf->SetY($start_y);
                $pdf->SetX(40);
                $pdf->MultiCell(80, 5, html_entity_decode($engineer_names." - ".$engineer_code,ENT_QUOTES), 0, 'L', 0);
            }
            else{
                $pdf->SetY($start_y);
                $pdf->SetX(40);
                $pdf->MultiCell(80, 5, '-', 0, 'L', 0);
            }
            $engineer_y = $pdf->GetY() - $start_y;


            $pdf->SetY($start_y);

            if(!empty($data['present_status']) && $data['present_status'] != $GLOBALS['null_value']){
                $pdf->SetX(120);

                if($data['present_status'] == 'PP'){
                     $pdf->MultiCell(40, 5,'Full Day Present', 0, 'L', 0);

                }else if($data['present_status'] == 'AP' || $data['present_status'] == 'PA'){
                    $pdf->MultiCell(40, 5,'Half Day Present', 0, 'L', 0);

                }else{
                    $pdf->MultiCell(40, 5,'Absent', 0, 'L', 0);

                }
            }
            $attendance_y = $pdf->GetY() - $start_y;
            $pdf->SetY($start_y);

            if(!empty($data['daily_salary'])  && $data['daily_salary'] != $GLOBALS['null_value']){
                $pdf->SetX(160);
                $pdf->Cell(40,5,$data['daily_salary'],0,0,'C',0);
            }else{
                $pdf->SetX(160);
                $pdf->Cell(40,5,"-",0,0,'C',0);
            }

            $pdf->SetY($start_y);
         

            $y_array = array($date_y,$attendance_y, $engineer_y,$engineer_type_y);
            $max_y = max($y_array);

            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,$max_y,'',1,0,'C');
            $pdf->SetX(20);
            $pdf->Cell(20,$max_y,'',1,0,'C');
            $pdf->SetX(40);
            $pdf->Cell(80,$max_y,'',1,0,'C');
            $pdf->SetX(120);
            $pdf->Cell(40,$max_y,'',1,0,'C');
            $pdf->SetX(160);
            $pdf->Cell(40,$max_y,'',1,1,'C');
           
            
            $start_y += $max_y;
            $pdf->SetY($start_y);

            $s_no++;
        }
     
        $pdf->SetX(10);
        $pdf->Cell(10,280-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(20);
        $pdf->Cell(20,280-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(40);
        $pdf->Cell(80,280-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(120);
        $pdf->Cell(40,280-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(160);
        $pdf->Cell(40,280-$pdf->GetY(),'',1,1,'C',0);
    

        $pdf->SetFont('Arial','B',8);
    }
    $pdf->SetFont('Arial','I',7);
    $pdf->SetY(-15);
    $pdf->SetX(10);
    $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

    $pdf_name = "Attendance Report( $date_display ).pdf";
    $pdf->Output($from, $pdf_name);
?>