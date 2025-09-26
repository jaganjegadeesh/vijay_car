<?php
    include("../include_user_check_and_files.php");
    $search_text = ""; $filter_party_id = "";  $from_date ="";  $to_date = ""; $show_bill = "";
    if(isset($_REQUEST['search_text'])) {
        $search_text = $_REQUEST['search_text'];
    }
    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }
    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }
    if(isset($_REQUEST['filter_party_id'])) {
        $filter_party_id = $_REQUEST['filter_party_id'];
    }
    if(isset($_REQUEST['show_bill'])) {
        $show_bill = $_REQUEST['show_bill'];
    }

    $total_records_list = array();
    $total_records_list = $obj->getJobCardList($from_date, $to_date,'',$filter_party_id);
    // print_r($total_records_list);
    
    if(!empty($search_text)) {
        $search_text = strtolower($search_text);
        $list = array();
        if(!empty($total_records_list)) {
            foreach($total_records_list as $val) {
                if( (strpos(strtolower($val['job_card_number']), $search_text) !== false) ) {
                    $list[] = $val;
                }
            }
        }
        $total_records_list = $list;
    }
    $company_name = "";
    $company_name = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'name');
    if(!empty($company_name) && $company_name != $GLOBALS['null_value']){
        $company_name = $obj->encode_decode('decrypt', $company_name);
    } 

    require_once('../fpdf/fpdf.php');
    $pdf = new FPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);

    $file_name="Jobcard List";
    include("rpt_header.php");
    $pdf->SetY($header_end);
    $pdf->SetTitle('Jobcard List');
    $pdf->SetFont('Arial','B',12);
    
    $pdf->SetFillColor(101,114,122);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(10,7,'S.No',1,0,'C',1);
    $pdf->Cell(20,7,'Date',1,0,'C',1);
    $pdf->Cell(25,7,'Job Number',1,0,'C',1);
    $pdf->Cell(35,7,'Party',1,0,'C',1);
    $pdf->Cell(35,7,'Department',1,0,'C',1);
    $pdf->Cell(40,7,'Engineer',1,0,'C',1);
    $pdf->Cell(25,7,'Vehicle No',1,1,'C',1);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',8);
    $start_y = $pdf->GetY();
    $y_axis=$pdf->GetY();
    $footer_height = 0; $total_amount = 0; $index=1; $total_amount = 0;
    $total_pages = array(1);
    $page_number = 1;
    $last_count = 0;
    if(!empty($total_records_list)) {
        foreach($total_records_list as $key => $list) {
            if($pdf->GetY() > 270) {
                $pdf->SetFont('Arial','I',7);
                $pdf->SetFont('Arial', 'B', 9);
                $next_page = $pdf->PageNo() + 1;
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(-15);
                $pdf->SetX(10);
                $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $page_number += 1;
                $total_pages[] = $page_number;
                $last_count = $key + 1;
                $file_name="Jobcard List";
                include("rpt_header.php");
                $pdf->SetY($header_end);
                $pdf->SetTitle('Jobcard List');
                $pdf->SetFont('Arial','B',12);
                $pdf->SetFillColor(101,114,122);
                $pdf->SetTextColor(255,255,255);
                $pdf->SetFont('Arial','B',9);
                $pdf->SetX(10);
                $pdf->Cell(10,7,'S.No',1,0,'C',1);
                $pdf->Cell(20,7,'Date',1,0,'C',1);
                $pdf->Cell(25,7,'Job Number',1,0,'C',1);
                $pdf->Cell(35,7,'Party',1,0,'C',1);
                $pdf->Cell(35,7,'Department',1,0,'C',1);
                $pdf->Cell(40,7,'Engineer',1,0,'C',1);
                $pdf->Cell(25,7,'Vehicle No',1,1,'C',1);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetFont('Arial','',8);
                $start_y = $pdf->GetY();
            }
            $key = $key + 1;
            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,7,$index,0,0,'C');
            $pdf->SetY($start_y);
            if(!empty($list['job_card_date'])) {
                $list['job_card_date'] = date('d-m-Y', strtotime($list['job_card_date']));
                $pdf->SetX(20);
                $pdf->MultiCell(20,7,$list['job_card_date'],0,'C');
            }else{
                $pdf->SetX(20);
                $pdf->MultiCell(20,7,'-',0,'C');
            }
            $jobcard_date_y = $pdf->GetY() - $start_y;

            $pdf->SetY($start_y);
            if(!empty($list['job_card_number']) && $list['job_card_number'] != $GLOBALS['null_value']) {
                $pdf->SetX(40);
                $pdf->MultiCell(25,7,$list['job_card_number'],0,'C');
            }else{
                $pdf->SetX(40);
                $pdf->MultiCell(25,7,'-',0,'C');
            }
            $jobcard_number_y = $pdf->GetY() - $start_y;

            $pdf->SetY($start_y);
            if(!empty($list['party_name_mobile_city']) && $list['party_name_mobile_city'] != $GLOBALS['null_value']) {
                $pdf->SetX(65);
                $pdf->MultiCell(35,7,$obj->encode_decode('decrypt', $list['party_name_mobile_city']),0,'C');
            }else{
                $pdf->SetX(65);
                $pdf->MultiCell(35,7,'-',0,'C');
            }
            $party_y = $pdf->GetY() - $start_y;

            $pdf->SetY($start_y);
            if(!empty($list['department_name']) && $list['department_name'] != $GLOBALS['null_value']) {
                $pdf->SetX(100);
                $pdf->MultiCell(35,7,$obj->encode_decode('decrypt', $list['department_name']),0,'C');
            }else{
                $pdf->SetX(100);
                $pdf->MultiCell(35,7,'-',0,'C');
            }
            $department_y = $pdf->GetY() - $start_y;

            $pdf->SetY($start_y);
            if(!empty($list['engineer_id']) && $list['engineer_id'] != $GLOBALS['null_value']) {
                $engineer_names = array();
                $engineer_id = $list['engineer_id'];
                $engineer_id = explode(",", $engineer_id);
                $engineer_id = array_reverse($engineer_id);
                for($i = 0; $i < count($engineer_id); $i++){
                    $engineer_name = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $engineer_id[$i], 'engineer_name');
                    $engineer_names[$i] = $obj->encode_decode('decrypt',$engineer_name);
                }
                $pdf->SetX(135);
                $pdf->MultiCell(40,7, implode(',', $engineer_names),0,'C');

            }else{
                $pdf->SetX(135);
                $pdf->MultiCell(40,7,'-',0,'C');
            }
            $engineer_name_y = $pdf->GetY() - $start_y;

            $pdf->SetY($start_y);
            if(!empty($list['vehicle_no']) && $list['vehicle_no'] != $GLOBALS['null_value']) {
                $pdf->SetX(175);
                $pdf->MultiCell(25,7,$obj->encode_decode('decrypt', $list['vehicle_no']),0,'C');
            }else{
                $pdf->SetX(175);
                $pdf->MultiCell(25,7,'-',0,'C');
            }
            $vehicle_no_y = $pdf->GetY() - $start_y;

            $y_array = array($jobcard_date_y, $party_y, $department_y, $engineer_name_y, $vehicle_no_y);
            $max_y = max($y_array);

            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,$max_y,'',1,0,'C');
            $pdf->Cell(20,$max_y,'',1,0,'C');
            $pdf->Cell(25,$max_y,'',1,0,'C');
            $pdf->Cell(35,$max_y,'',1,0,'C');
            $pdf->Cell(35,$max_y,'',1,0,'C');
            $pdf->Cell(40,$max_y,'',1,0,'C');
            $pdf->Cell(25,$max_y,'',1,1,'C');
            $start_y += $max_y;
            $index++;

        }
        $end_y = $pdf->GetY();
        $last_page_count = $index - $last_count;
        if(($footer_height+$end_y) >= 270){
            $y = $pdf->GetY();
            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(-15);
            $pdf->SetX(10);
            $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);
            $file_name="Jobcard List";
            include("rpt_header.php");
            $pdf->SetY($header_end);
            $pdf->SetTitle('Jobcard List');
            $pdf->SetFont('Arial','B',12);
            
            $pdf->SetFillColor(101,114,122);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(10);
            $pdf->Cell(10,7,'S.No',1,0,'C',1);
            $pdf->Cell(20,7,'Date',1,0,'C',1);
            $pdf->Cell(25,7,'Job Number',1,0,'C',1);
            $pdf->Cell(35,7,'Party',1,0,'C',1);
            $pdf->Cell(35,7,'Department',1,0,'C',1);
            $pdf->Cell(40,7,'Engineer',1,0,'C',1);
            $pdf->Cell(25,7,'Vehicle No',1,1,'C',1);
            $pdf->SetTextColor(0,0,0);
             $y_axis=$pdf->GetY();


            $content_height = 260 - $footer_height;
            $pdf->SetY($y_axis);

            $pdf->SetX(10);
            $pdf->Cell(10,($content_height - $y_axis),'',1,0,'C');
            $pdf->Cell(20,($content_height - $y_axis),'',1,0,'C');
            $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C');
            $pdf->Cell(35,($content_height - $y_axis),'',1,0,'C');
            $pdf->Cell(35,($content_height - $y_axis),'',1,0,'C');
            $pdf->Cell(40,($content_height - $y_axis),'',1,0,'C');
            $pdf->Cell(25,($content_height - $y_axis),'',1,1,'C');
            $pdf->SetY($content_height);

        }else{
            $content_height = 260 - $footer_height;
            $pdf->SetY($y_axis);

            $pdf->SetX(10);

            $pdf->Cell(10,($content_height - $y_axis),'',1,0,'C');
            $pdf->Cell(20,($content_height - $y_axis),'',1,0,'C');
            $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C');
            $pdf->Cell(35,($content_height - $y_axis),'',1,0,'C');
            $pdf->Cell(35,($content_height - $y_axis),'',1,0,'C');
            $pdf->Cell(40,($content_height - $y_axis),'',1,0,'C');
            $pdf->Cell(25,($content_height - $y_axis),'',1,1,'C');
        }
        $line_y = $pdf->GetY();
        $pdf->Line(10, $line_y, 200, $line_y);

        $pdf->SetFont('Arial', 'BU', 8);
        $pdf->SetX(10);

        $pdf->SetY($line_y);
        $pdf->SetX(155);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetY($line_y+2);
        $pdf->SetX(160);
        $pdf->Cell(90, 5,$company_name, 0, 1, 'L', 0);
        $pdf->SetFont('Arial', '', 9);

        $pdf->SetY($line_y+17);
        $pdf->SetX(155);
        $pdf->Cell(90, 5, 'Authorized Signatory', 0, 1, 'L', 0);

        $pdf->SetFont('Arial', '', 7);
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->Cell(190, 275, '', 1, 0, 'C');


        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(-10);
        $pdf->SetX(10);
        $pdf->Cell(190,6,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    }



    $pdf->Output('','Jobcard List.pdf');


?>