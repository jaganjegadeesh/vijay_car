<?php
include("../include_user_check_and_files.php");
include("../include/number2words.php");


    $filter_party_id = "";
    if(isset($_REQUEST['filter_party_id'])) {
        $filter_party_id = $_REQUEST['filter_party_id'];
    }

    $from_date = "";
    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }
    
    $to_date = "";
    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }

    
    $total_records_list = array();
    $total_records_list = $obj->GetPurchaseEntryReport($GLOBALS['bill_company_id'],$filter_party_id,$from_date, $to_date);

    $from_date = date('d-m-Y',strtotime($from_date));
    $to_date = date('d-m-Y',strtotime($to_date));
    
    $pdf_download_name ="";
    $pdf_download_name = "Purchase Report PDF -"." (".$from_date ." to ".$to_date .")";

    require_once('../fpdf/fpdf.php');
    $pdf = new FPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $yaxis = $pdf->GetY();

    $file_name="Purchase Report";
    include("rpt_header.php");
    
    $pdf->SetY($header_end);
           
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(0,7.5,'Purchase Report ('.$from_date.' - '.$to_date.')',0,1,'C',0);

    $current_y = $pdf->GetY();
    $box_y = $pdf->GetY();

    $pdf->SetY($yaxis);
    $pdf->SetX(10);

    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY($box_y);
    $pdf->SetX(10);
    $pdf->Cell(10,8,'S.No.',1,0,'C',0);
    $pdf->Cell(35,8,'Bill Number',1,0,'C',0);
    $pdf->Cell(35,8,'Date',1,0,'C',0);
    $pdf->Cell(60,8,'Party Name',1,0,'C',0);
    $pdf->Cell(50,8,'Amount',1,1,'C',0);
    $pdf->SetFont('Arial','',8);
    $y_axis = $pdf->GetY();

    $footer_height = 0;
    $footer_height = 10;

    $index = 0; $grand_amount = 0;
    if(!empty($total_records_list)) {
        $product_count = 0; $quantity = ""; 
        foreach($total_records_list as $key => $data) {
            if($pdf->GetY()>265){
                $closing_balance = $grand_amount;
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(140,8,'Closing Balance',1,0,'R',0);
                $pdf->Cell(50,8,$obj->numberFormat($closing_balance,2),1,1,'R',0);

                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(-15);
                $pdf->SetX(10);
                $pdf->Cell(190,6,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);
                $yaxis = $pdf->GetY();

                $file_name="Purchase Report";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);
                    
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(0,7.5,'Purchase Report - ('.$from_date.' - '.$to_date.')',0,1,'C',0);
                $current_y = $pdf->GetY();
                $box_y = $pdf->GetY();


                $pdf->SetY($yaxis);
                $pdf->SetX(10);

                $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
                $pdf->SetFont('Arial','B',10);
                $pdf->SetX(10);
                $pdf->Cell(10,8,'S.No.',1,0,'C',0);
                $pdf->Cell(35,8,'Bill Number',1,0,'C',0);
                $pdf->Cell(35,8,'Date',1,0,'C',0);
                $pdf->Cell(60,8,'Party Name',1,0,'C',0);
                $pdf->Cell(50,8,'Amount',1,1,'C',0);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(140,8,'Opening Balance',1,0,'R',0);
                $pdf->Cell(50,8,$obj->numberFormat($closing_balance,2),1,1,'R',0);
                $pdf->SetFont('Arial','',8);
            }            

            $index = $key + 1;
           

            if(!empty($prefix)) { $index = $index + $prefix; }

            $start_y = $pdf->GetY();                

            $pdf->SetX(10);
            $pdf->Cell(10,7,$index,0,0,'C',0);
        
            if(!empty($data['purchase_entry_number'])) {
                $pdf->SetX(20);
                $pdf->MultiCell(35,4,$data['purchase_entry_number'],0,'C',0);
            }
            $pdf->SetTextColor(255,0,0);
            if (($data['deleted']) == '1') {
                $pdf->SetX(20);
                $pdf->Cell(35,4,'Cancelled',0,1,'C',0);   
            } else {
                $pdf->Cell(35,0,'',0,1,'C',0);
            }
            $pdf->SetTextColor(0,0,0);
            $no_end = $pdf->GetY();

            $pdf->SetY($start_y);

            if(!empty($data['purchase_entry_date'])) {
                $pdf->SetX(55);
                $pdf->MultiCell(35,7,date('d-m-Y',strtotime($data['purchase_entry_date'])),0,'C',0);
            }
            $date_end = $pdf->GetY();

            $pdf->SetY($start_y);   

            if(!empty($data['party_id'])) {
                $party_name =$obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$data['party_id'],'name_mobile_city');
                $party_name = $obj->encode_decode('decrypt',$party_name);
                $pdf->SetX(90);
                $pdf->MultiCell(60,7,($party_name),0,'C',0);
            }
            
            $qty_end =$pdf->GetY();
            $pdf->SetY($start_y); 

            if(!empty($data['total_amount'])) 
            { 
                $pdf->SetX(150);
                $pdf->MultiCell(50,7,$obj->numberFormat($data['total_amount'], 2),0,'R',0);
                if($data['deleted'] == '0'){
                    $grand_amount += $data['total_amount'];
                }
            }
            $amt_end =$pdf->GetY();

            $max_y = max(array($date_end,$amt_end,$qty_end,$no_end));
            $pdf->SetY($start_y);                            
            $pdf->SetX(10);
            $pdf->Cell(10,($max_y-$start_y),'',1,0,'C',0);
            $pdf->Cell(35,($max_y-$start_y),'',1,0,'C',0);
            $pdf->Cell(35,($max_y-$start_y),'',1,0,'C',0);
            $pdf->Cell(60,($max_y-$start_y),'',1,0,'C',0);
            $pdf->Cell(50,($max_y-$start_y),'',1,1,'C',0);
        }
    }

    $end_y = $pdf->GetY();

    if(($footer_height+$end_y) >= 270){

        $y = $pdf->GetY();

        $pdf->SetY($y_axis);

        $pdf->SetX(10);
        $pdf->Cell(10,(277 - $y_axis),'',1,0,'C',0);
        $pdf->Cell(35,(277 - $y_axis),'',1,0,'C',0);
        $pdf->Cell(35,(277 - $y_axis),'',1,0,'C',0);
        $pdf->Cell(60,(277 - $y_axis),'',1,0,'C',0);
        $pdf->Cell(50,(277 - $y_axis),'',1,1,'C',0);


        $pdf->SetFont('Arial','B',9);

        $next_page = $pdf->PageNo()+1;

        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(-15);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

        $pdf->AddPage();

        $file_name="Purchase Report";
        include("rpt_header.php");
        
        $pdf->SetY($header_end);
            
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7.5,'Purchase Report ('.$from_date.' - '.$to_date.')',0,1,'C',0);

        $current_y = $pdf->GetY();
        $box_y = $pdf->GetY();

        $pdf->SetY($yaxis);
        $pdf->SetX(10);

        $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetY($box_y);
        $pdf->SetX(10);
        $pdf->Cell(10,8,'S.No.',1,0,'C',0);
        $pdf->Cell(35,8,'Bill Number',1,0,'C',0);
        $pdf->Cell(35,8,'Date',1,0,'C',0);
        $pdf->Cell(60,8,'Party Name',1,0,'C',0);
        $pdf->Cell(50,8,'Amount',1,1,'C',0);
        $pdf->SetFont('Arial','',8);
        $y_axis = $pdf->GetY();


        $content_height = 280 - $footer_height;



        $pdf->SetY($y_axis);

        $pdf->SetX(10);
        $pdf->Cell(10,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(35,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(35,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(60,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(50,($content_height - $y_axis),'',1,1,'C',0);

        $pdf->SetY($content_height);

    } else {
        $content_height = 280 - $footer_height;
        $pdf->SetY($y_axis);

        $pdf->SetX(10);

        $pdf->Cell(10,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(35,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(35,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(60,($content_height - $y_axis),'',1,0,'C',0);
        $pdf->Cell(50,($content_height - $y_axis),'',1,1,'C',0);
        

    }

    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(140,8,'Total',1,0,'R',0);
    $pdf->Cell(50,8,$obj->numberFormat($grand_amount,2),1,1,'R',0);

    $pdf->SetFont('Arial','I',7);
    $pdf->SetY(-15);
    $pdf->SetX(10);
    $pdf->Cell(190,6,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

    $pdf->Output('',$pdf_download_name . '.pdf');

?>