<?php
include("../include_files.php");
$to_date = date('Y-m-d'); $search_text = ''; $filter_party_id = ''; $consignee_id = ''; $bill_type = '';
if(isset($_REQUEST['to_date'])) {
    $to_date = $_REQUEST['to_date'];
}
if(isset($_REQUEST['search_text'])) {
    $search_text = $_REQUEST['search_text'];
}
if(isset($_REQUEST['filter_party_id'])) {
    $filter_party_id = $_REQUEST['filter_party_id'];
}
if(isset($_REQUEST['bill_type'])) {
    $bill_type = $_REQUEST['bill_type'];
}
$total_records_list = $obj->getDayBookPaymentReportList($to_date, $filter_party_id, $bill_type);
if(!empty($search_text)) {
    $search_text = strtolower($search_text);
    $list = array();
    if(!empty($total_records_list)) {
        foreach($total_records_list as $val) {
            if(strpos(strtolower($obj->encode_decode('decrypt', $val['name_mobile_city'])), $search_text) !== false) {
                $list[] = $val;
            }
        }
    }
    $total_records_list = $list;
}
        require_once('../fpdf/fpdf.php');
        $pdf = new FPDF('P','mm','A4');
        $pdf->AliasNbPages(); 
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
               
        $current_y = $pdf->GetY();
        $box_y = $pdf->GetY();
    
        $yaxis = $pdf->GetY();
                    
        $file_name="Daybook Report";
        include("rpt_header.php");
        
        $pdf->SetY($header_end);
        $pdf->SetX(10);
    
        $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(10);
        $pdf->Cell(190,6,'Daybook Report - ('.date('d-m-Y',strtotime($to_date)). ')',1,1,'C',0) ;
        
        $pdf->SetFont('Arial','B',8);
        $starty = $pdf->GetY();
        $pdf->SetX(10);
        $pdf->Cell(10,10,'S.No.',1,0,'C',0);
        $pdf->Cell(30,10,'Bill Number & Date',1,0,'C',0);
        $pdf->Cell(30,10,'Bill Type',1,0,'C',0);
        $pdf->Cell(50,10,'Party Name',1,0,'C',0);
        $pdf->Cell(35,10,'Credit',1,0,'C',0);
        $pdf->Cell(35,10,'Debit',1,1,'C',0);
        $pdf->SetFont('Arial','',7);
    
        $index = 0;
         $credit = 0; $debit = 0;
        $credit_amount = 0;
        $debit_amount = 0; $name ="";
        $total_credit = $total_debit = 0;
        if (!empty($total_records_list)) {
            foreach ($total_records_list as $key => $data) {
              
                if ($pdf->GetY() > 250) {
                    $pdf->SetFont('Arial', 'B', 7);
                    $pdf->SetX(10);
                    $pdf->Cell(120, 8, 'Total Balance', 1, 0, 'R', 0);
                    if(strlen($obj->numberFormat($total_credit,2)) <= 15) {
                        $pdf->SetFont('Arial', '', 7);
                        $pdf->Cell(35, 8, $obj->numberFormat($total_credit,2), 1, 0, 'R', 0);
                    }
                    else {
                        $pdf->SetFont('Arial', '', 5);
                        $pdf->Cell(35, 8, $obj->numberFormat($total_credit,2), 1, 0, 'R', 0);
                    }
                    if(strlen($obj->numberFormat($total_debit,2)) <= 15) {
                        $pdf->SetFont('Arial', '', 7);
                        $pdf->Cell(35, 8, $obj->numberFormat($total_debit,2), 1, 1, 'R', 0);
                    }
                    else {
                        $pdf->SetFont('Arial', '', 5);
                        $pdf->Cell(35, 8, $obj->numberFormat($total_debit,2), 1, 1, 'R', 0);
                    }
                    $next_page = $pdf->PageNo() +1;
                    $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(285);
                    $pdf->SetX(10);
                    $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                    $pdf->AddPage();
                    $yaxis = $pdf->GetY();
                    
                    $file_name="Daybook Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);
                    $pdf->SetX(10);
                
                    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetX(10);
                    $pdf->Cell(190,6,'Daybook Report - ('.date('d-m-Y',strtotime($to_date)). ')',1,1,'C',0);
                   
                    $pdf->SetFont('Arial', 'B', 8);
                    $starty = $pdf->GetY();
                    $pdf->SetX(10);
                    $pdf->Cell(10,10,'S.No.',1,0,'C',0);
                    $pdf->Cell(30,10,'Entry Number & Date',1,0,'C',0);
                    $pdf->Cell(30,10,'Bill Type',1,0,'C',0);
                    $pdf->Cell(50,10,'Party Name',1,0,'C',0);
                    $pdf->Cell(35,10,'Credit',1,0,'C',0);
                    $pdf->Cell(35,10,'Debit',1,1,'C',0);
                    $pdf->SetFont('Arial', 'B', 7);
                    $pdf->SetX(10);
                    $pdf->Cell(120, 8, 'Open Balance', 1, 0, 'R', 0);
                    if(strlen($obj->numberFormat($total_credit,2)) <= 15) {
                        $pdf->SetFont('Arial', '', 7);
                        $pdf->Cell(35, 8, $obj->numberFormat($total_credit,2), 1, 0, 'R', 0);
                    }
                    else {
                        $pdf->SetFont('Arial', '', 5);
                        $pdf->Cell(35, 8, $obj->numberFormat($total_credit,2), 1, 0, 'R', 0);
                    }
                    if(strlen($obj->numberFormat($total_debit,2)) <= 15) {
                        $pdf->SetFont('Arial', '', 7);
                        $pdf->Cell(35, 8, $obj->numberFormat($total_debit,2), 1, 1, 'R', 0);
                    }
                    else {
                        $pdf->SetFont('Arial', '', 5);
                        $pdf->Cell(35, 8, $obj->numberFormat($total_debit,2), 1, 1, 'R', 0);
                    }
                    $pdf->SetFont('Arial', '', 7);
                }
                $starty = $pdf->GetY();
                $s_no = $key + 1;
                
                $pdf->SetX(10);
                $pdf->Cell(10, 8, $s_no, 0, 0, 'C', 0);
        
                $pdf->SetX(20);
                if(!empty($data['bill_number'])) {
                    $bill_number = $data['bill_number'];
                    $pdf->Cell(30,4,$bill_number,0,1,'C',0);
                }
                $pdf->SetX(20);
                if(!empty($data['bill_date'])) {
                    $bill_date = date('d-m-Y', strtotime($data['bill_date'])); 
                    $pdf->Cell(30,4,$bill_date,0,0,'C',0);
                }
                $bill_date_y = $pdf->getY();
                $pdf->SetY($starty);
                $pdf->SetX(50);
                $pdf->Cell(30,8,'',0,0,'C',0);
                $pdf->SetX(50);
                if(!empty($data['bill_type'])) {
                    $pdf->Cell(30,8,$data['bill_type'],0,0,'C',0);
                }
               
                if (!empty($data['party_name']) && $data['party_name'] != $GLOBALS['null_value']) {
                    if(!empty($data['party_name'])){ 
                        $name =html_entity_decode($obj->encode_decode('decrypt', $data['party_name'])); 
                    }
                    $pdf->MultiCell(50, 8,$name, 0, 'C', 0);
                } else {
                    $pdf->MultiCell(50, 8,' - ', 0, 'C', 0);
                }
                
                $customer_name_y = $pdf->GetY();
                            
                $pdf->setY($starty);
                if(!empty($data['credit']) && $data['credit'] != $GLOBALS['null_value']){
                    $total_credit = $total_credit + $data['credit'];
                }
                if(!empty($data['debit']) && $data['debit'] != $GLOBALS['null_value']){
                    $total_debit = $total_debit + $data['debit'];
                }
                $pdf->SetX(130);
                $pdf->Cell(35, 8, number_format($data['credit'],2), 0, 0, 'R', 0);
                $pdf->SetX(165);
                $pdf->Cell(35, 8, number_format($data['debit'],2), 0, 1, 'R', 0);
                $final_end_y = max($bill_date_y,$customer_name_y);
                // echo $final_end_y;
                $pdf->SetY($starty);
                $pdf->Cell(10,$final_end_y - $starty, '', 1, 0, 'C', 0);
                $pdf->Cell(30,$final_end_y - $starty, '', 1, 0, 'C', 0);
                $pdf->Cell(30,$final_end_y - $starty, '', 1, 0, 'C', 0);
                $pdf->Cell(50,$final_end_y - $starty, '', 1, 0, 'C', 0);
                $pdf->Cell(35,$final_end_y - $starty, '', 1, 0, 'C', 0);
                $pdf->Cell(35,$final_end_y - $starty, '', 1, 1, 'C', 0);
            }
        }
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetX(10);
        $pdf->Cell(120, 8, 'Total Balance', 1, 0, 'R', 0);
        if(strlen($obj->numberFormat($total_credit,2)) <= 15) {
            $pdf->SetFont('Arial', '', 7);
            $pdf->Cell(35, 8, $obj->numberFormat($total_credit,2), 1, 0, 'R', 0);
        }
        else {
            $pdf->SetFont('Arial', '', 5);
            $pdf->Cell(35, 8, $obj->numberFormat($total_credit,2), 1, 0, 'R', 0);
        }
        if(strlen($obj->numberFormat($total_debit,2)) <= 15) {
            $pdf->SetFont('Arial', '', 7);
            $pdf->Cell(35, 8, $obj->numberFormat($total_debit,2), 1, 1, 'R', 0);
        }
        else {
            $pdf->SetFont('Arial', '', 5);
            $pdf->Cell(35, 8, $obj->numberFormat($total_debit,2), 1, 1, 'R', 0);
        }
        $pdf->SetX(10);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(120, 8, 'Current Balance', 1, 0, 'R', 0);
        $credit_balance = $total_credit - $total_debit;
        $debit_balance = $total_debit - $total_credit;
        
            $pdf->SetFont('Arial', '', 7);
            if ($total_credit > $total_debit) {
                $pdf->Cell(35, 8, $obj->numberFormat($credit_balance,2), 1, 0, 'R', 0);
                $pdf->Cell(35, 8, '', 1, 1, 'R', 0);
            } else if($total_credit < $total_debit) {
                $pdf->Cell(35, 8, '', 1, 0, 'R', 0);
                $pdf->Cell(35, 8, $obj->numberFormat($debit_balance,2), 1, 1, 'R', 0);
            } else {
                $pdf->Cell(35, 8, '', 1, 0, 'R', 0);
                $pdf->Cell(35, 8, '', 1, 1, 'R', 0);
            }
             
        
        
        
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(285);
        $pdf->SetX(10);
        $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
        
        $pdf->Output();
        ?> 
       