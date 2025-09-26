<?php

    include("../include_user_check_and_files.php");
    
    $to_date = date("Y-m-d"); $from_date = date('Y-m-d', strtotime('-30 days', strtotime($to_date))); $product_id = ""; $store_id = ""; $store_room_id = ""; $party_id = ""; $category_id = ""; $brand_id = ""; $stock_type = "";  $subunit_contains = 0; $case_contains = 0; $unit_type = ""; $from = ""; $product_type = ""; $batch_code = ""; $brand = 0; $batchcode = 0;
     
    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }
    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }
    if(isset($_REQUEST['filter_store_id'])) {
        $store_id = $_REQUEST['filter_store_id'];
    }
    if(isset($_REQUEST['filter_product_id'])) {
        $product_id = $_REQUEST['filter_product_id'];
    }
    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }


    $total_records_list = array();

    $total_records_list = $obj->getStockReportList($from_date,$to_date,$product_id,$store_id);

    

    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);

    $file_name="Stock Report";
    include("rpt_header.php");
    
    $pdf->SetY($header_end);

    $bill_to_y = $pdf->GetY();

    $s_no = 1; $footer_height = 0; $height = 0; $l = 0; 
    $pdf->SetFont('Arial','B',8);
    if(empty($product_id)) {
        
        $total_pages = array(1);
        $page_number = 1;
        $last_count = 0;
        
        if(!empty($from_date)) {
            $from_date = date('d-m-Y', strtotime($from_date));
        }
        if(!empty($to_date)) {
            $to_date = date('d-m-Y', strtotime($to_date));
        }
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(190,7,'Stock Report - ( '.$from_date .' - '.$to_date.' )',1,1,'C',0);
        $pdf->SetFillColor(101,114,122);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetX(10);
        $pdf->Cell(20,8,'S.No',1,0,'C',1);
        $pdf->Cell(90,8,'Product',1,0,'C',1);
        $pdf->Cell(80,8,'Current Stock',1,1,'C',1);
        $pdf->SetFont('Arial','',8);
        $pdf->SetTextColor(0,0,0);
        
        $y_axis=$pdf->GetY();

        $s_no = "1"; $total_stock = 0; $content_height = 0;
        if(!empty($total_stock)){
            $height -= 15;
            $footer_height += 15;
        }
        $net_case_total = 0; $net_pcs_total = 0;
        $total_stock = 0;$overall_unit_stock = 0;$overall_subunit_stock = 0;
        if(!empty($total_records_list)) {
            foreach($total_records_list as $key => $data) {
                
                $index = $key + 1;  $display = ""; $display_total_stock = "";
                if($pdf->GetY() > 270){
                    $y = $pdf->GetY();
                    $pdf->SetY($y_axis);
                    $pdf->SetX(10);
                    $pdf->Cell(20,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(90,277-$y_axis,'',1,0,'C',0);
                    $pdf->Cell(80,277-$y_axis,'',1,1,'C',0);

                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(-15);
                    $pdf->SetX(10);
                    $pdf->Cell(190,6,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);
                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $l+1;

                    $file_name="Stock Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);

                    $bill_to_y = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(190,7,'Stock Report - ( '.$from_date .' - '.$to_date.' )',1,1,'C',0);
                    $pdf->SetFillColor(101,114,122);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetX(10);
                    $pdf->Cell(20,8,'S.No',1,0,'C',1);
                    $pdf->Cell(90,8,'Product',1,0,'C',1);
                    $pdf->Cell(80,8,'Current Stock',1,1,'C',1);
                    $pdf->SetFont('Arial','',8);
                    $pdf->SetTextColor(0,0,0);

                    $y_axis=$pdf->GetY();
                }

                $pdf->SetX(10);
                $pdf->Cell(20,7,$s_no,1,0,'C',0);
                
                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                    $product_name = "";
                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $data['product_id'], 'product_name');
                    $product_name = $obj->encode_decode('decrypt', $product_name);
                    $pdf->Cell(90,7,$product_name,1,0,'C',0);
                }
                else{
                    $pdf->Cell(90,7,' - ',1,0,'C',0);
                }

                $inward_unit = 0; $outward_unit = 0;
                $inward_unit = $obj->getInwardQty('',$store_id,$data['product_id'],$data['unit_id']);

                $outward_unit = $obj->getOutwardQty('',$store_id,$data['product_id'],$data['unit_id']);
                
                $current_stock_unit = 0; $current_stock_subunit = 0;
                $current_stock_unit = $inward_unit - $outward_unit;
                $current_stock_unit = number_format($current_stock_unit, 2);
                $current_stock_unit = str_replace(",", "", $current_stock_unit);
                $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'unit_name');
                $unit_name = $obj->encode_decode('decrypt',$unit_name);

                $total_stock += $current_stock_unit;
                
                $display = $current_stock_unit.' '.$unit_name;
                if(!empty($display)) {
                    $pdf->Cell(80,7, $display,1,1,'R',0);
                }
                else {
                    $pdf->Cell(80,7,' - ',1,1,'R',0);
                }
                $s_no++;
            }

            $end_y = $pdf->GetY();

            $last_page_count = $s_no - $last_count;
            
            if(($footer_height+$end_y) >= 270){
        
                $y = $pdf->GetY();
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,270-$y_axis,'',1,0,'C',0);
                $pdf->Cell(90,270-$y_axis,'',1,0,'C',0);
                $pdf->Cell(80,270-$y_axis,'',1,1,'C',0);
        
                $pdf->SetFont('Arial','B',9);
        
                $next_page = $pdf->PageNo()+1;

                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(-15);
                $pdf->SetX(10);
                $pdf->Cell(190,6,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $file_name="Stock Report";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);
                $bill_to_y = $pdf->GetY();

                $pdf->SetFont('Arial','B',8);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->SetFont('Arial','B',9);
                $pdf->Cell(190,7,'Stock Report - ( '.$from_date .' - '.$to_date.' )',1,1,'C',0);
                $pdf->SetFillColor(101,114,122);
                $pdf->SetTextColor(255,255,255);
                $pdf->SetX(10);
                $pdf->Cell(20,8,'S.No',1,0,'C',1);
                $pdf->Cell(90,8,'Product',1,0,'C',1);
                $pdf->Cell(80,8,'Current Stock',1,1,'C',1);
                $pdf->SetFont('Arial','',8);
                $pdf->SetTextColor(0,0,0);
                
                $y_axis=$pdf->GetY();

                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,($content_height-$y_axis),'',1,0);
                $pdf->Cell(90,($content_height-$y_axis),'',1,0);
                $pdf->Cell(80,($content_height-$y_axis),'',1,1);
                $pdf->SetY($content_height);
            } 
            else {
                
                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,($content_height-$y_axis),'',1,0);
                $pdf->Cell(90,($content_height-$y_axis),'',1,0);
                $pdf->Cell(80,($content_height-$y_axis),'',1,1);
            }
            
            $pdf->SetFont('Arial','B',9);
        
            $pdf->SetX(10);
            $pdf->Cell(110,8,'Total',1,0,'R',0);

            

            $pdf->SetX(120);
            $pdf->Cell(80,8,number_format($total_stock,2).' Units',1,1,'R',0);

        }
        
    }
    else if(!empty($product_id)) {
       
        $total_pages = array(1);
        $page_number = 1;
        $last_count = 0;
        $product_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'product_name');
        $inward_unit = 0; $outward_unit = 0;
        $inward_unit = $obj->getInwardQty('',$store_id,$product_id,'');

        $outward_unit = $obj->getOutwardQty('',$store_id,$product_id,'');
        
        $current_stock_unit = 0; $current_stock_subunit = 0;
        $current_stock_unit = $inward_unit - $outward_unit;
        $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'unit_name');
        $unit_name = $obj->encode_decode('decrypt',$unit_name);
        if(!empty($from_date)) {
            $from_date = date('d-m-Y', strtotime($from_date));
        }
        if(!empty($to_date)) {
            $to_date = date('d-m-Y', strtotime($to_date));
        }
       
        
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(190,7,$obj->encode_decode('decrypt', $product_name). ' ( Current stock : '.$current_stock_unit.' '. $unit_name .')',1,1,'C',0);
        $product_start_y = $pdf->GetY();
        $pdf->SetFillColor(101,114,122);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10);
        $pdf->Cell(10, 8, 'S.No', 1, 0, 'C', 1);
        $pdf->Cell(20, 8, 'Date', 1, 0, 'C', 1);
        $pdf->Cell(25, 8, 'Type ', 1, 0, 'C', 1);
        $pdf->Cell(25, 8, 'Remarks', 1, 0, 'C', 1);
        $pdf->Cell(30, 8, 'Party', 1, 0, 'C', 1);
        $pdf->Cell(30, 8, 'store', 1, 0, 'C', 1);
        $pdf->Cell(25, 8, 'Inward ('. $unit_name . ')', 1, 0, 'C', 1);
        $pdf->Cell(25, 8, 'Outward ('. $unit_name. ')', 1, 1, 'C', 1);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',8);
        $start_y = $pdf->GetY();

        $y_axis = $pdf->GetY();

        $total_inward = 0; $total_outward = 0;
        if(!empty($total_records_list)) {
            
            foreach($total_records_list as $data) {
                $inward_unit = 0; $outward_unit = 0;  
                
                if($pdf->GetY() > 270){
                    
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(-15);
                    $pdf->SetX(10);
                    $pdf->Cell(190,6,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);
                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $l+1;
                    $file_name="Stock Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);

                    
                    // $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(190,7,$obj->encode_decode('decrypt', $product_name). ' ( Current stock : '.$current_stock_unit.')',1,1,'C',0);
                    $product_start_y = $pdf->GetY();
                    $pdf->SetFillColor(101,114,122);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->SetX(10);
                    $pdf->Cell(10, 8, 'S.No', 1, 0, 'C', 1);
                    $pdf->Cell(20, 8, 'Date', 1, 0, 'C', 1);
                    $pdf->Cell(25, 8, 'Type ', 1, 0, 'C', 1);
                    $pdf->Cell(25, 8, 'Remarks', 1, 0, 'C', 1);
                    $pdf->Cell(30, 8, 'Party', 1, 0, 'C', 1);
                    $pdf->Cell(30, 8, 'store', 1, 0, 'C', 1);
                    $pdf->Cell(25, 8, 'Inward ('. $unit_name . ')', 1, 0, 'C', 1);
                    $pdf->Cell(25, 8, 'Outward ('. $unit_name. ')', 1, 1, 'C', 1);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',8);
                    $start_y = $pdf->GetY();
                    $pdf->SetFont('Arial','',8);
                    $y_axis = $pdf->GetY();
                }

                $date_y = ""; $type_y = ""; $remarks_y = ""; $party_y = ""; $store_y = ""; $case_y = ""; $inward_y = ""; $outward_y = "";  $y_array = array(); $max_y = ""; $brand_y = ""; $store_room_y = ""; 

                $pdf->SetY($start_y);
                $pdf->SetX(10);
                $pdf->MultiCell(10, 6, $s_no, 0, 'C', 0);

                $pdf->SetY($start_y);
                if(!empty($data['stock_date'])) {
                    $pdf->SetX(20);
                    $pdf->MultiCell(20, 6, date('d-m-Y', strtotime($data['stock_date'])), 0, 'C', 0);
                }
                else{
                    $pdf->SetX(20);
                    $pdf->MultiCell(20, 6,'-', 0, 'C', 0);
                }
                $date_y = $pdf->GetY();

                $pdf->SetY($start_y);
                if(!empty($data['stock_type'])) {
                    $pdf->SetX(40);
                    $pdf->MultiCell(25, 6, $data['stock_type'], 0, 'C', 0);
                }
                else{
                    $pdf->SetX(40);
                    $pdf->MultiCell(25, 6, '-', 0, 'C', 0);
                }
                $type_y = $pdf->GetY();


                $pdf->SetY($start_y);
                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                    $pdf->SetX(65);
                    $pdf->MultiCell(25, 6, $data['remarks'], 0,  'C', 0);
                    
                }
                else {
                    $pdf->SetX(65);
                    $pdf->MultiCell(25, 6, '-', 0,  'C', 0);
                }

                $remarks_y = $pdf->GetY();

                $pdf->SetY($start_y);
                if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                    $pdf->SetX(90);
                    $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $data['party_id'], 'name_mobile_city');
                    $party_name = $obj->encode_decode('decrypt', $party_name);
                    $pdf->MultiCell(30, 6, $party_name, 0, 'C', 0);
                }
                else {
                    $pdf->SetX(90);
                    $pdf->MultiCell(30, 6, '-', 0, 'C', 0);
                }
                $party_y = $pdf->GetY();


                $pdf->SetY($start_y);
                if(!empty($data['store_id']) && $data['store_id'] != $GLOBALS['null_value']) {
                    $store_name = $obj->getTableColumnValue($GLOBALS['store_room_table'],'store_room_id',$data['store_id'],'store_room_name');
                    $store_name = $obj->encode_decode('decrypt', $store_name);
                    $pdf->SetX(120);
                    $pdf->MultiCell(30, 6,  $store_name, 0, 'C', 0);
                }
                else{
                    $pdf->SetX(120);
                    $pdf->MultiCell(30, 6, '-', 0, 'C', 0);
                }
                $store_y = $pdf->GetY();

                $pdf->SetY($start_y);

                if($data['inward_unit'] != $GLOBALS['null_value'] && !empty($data['inward_unit'])) {
                    $total_inward += $data['inward_unit'];
                    $pdf->SetX(150);
                    $pdf->MultiCell(25, 6,$data['inward_unit'], 0,  'R', 0);
                } else {
                    $pdf->SetX(150);
                    $pdf->MultiCell(25, 6,'-', 0,  'C', 0);
                }
                
            
                $inward_y = $pdf->GetY();
            
                
                $pdf->SetY($start_y);
                if($data['outward_unit'] != $GLOBALS['null_value'] && !empty($data['outward_unit'])) {
                    $total_outward += $data['outward_unit'];
                    $pdf->SetX(175);
                    $pdf->MultiCell(25, 6,$data['outward_unit'], 0,  'R', 0);
                } else {
                    $pdf->SetX(175);
                    $pdf->MultiCell(25, 6,'-', 0,  'C', 0);
                }


                $outward_y = $pdf->GetY();

                $y_array = array($date_y,$type_y,$remarks_y,$party_y,$store_y,$inward_y, $outward_y);
                $max_y = max($y_array);
                $end_y = $max_y - $start_y;
                $pdf->SetY($start_y);
                $pdf->SetX(10);                
                $pdf->Cell(10, $end_y, '', 1, 0, 'C', 0);
                $pdf->Cell(20, $end_y, '', 1, 0, 'C', 0);
                $pdf->Cell(25, $end_y, '', 1, 0, 'C', 0);
                $pdf->Cell(25, $end_y, '', 1, 0, 'C', 0);
                $pdf->Cell(30, $end_y, '', 1, 0, 'C', 0);
                $pdf->Cell(30, $end_y, '', 1, 0, 'C', 0);
                $pdf->Cell(25, $end_y, '', 1, 0, 'C', 0); 
                $pdf->Cell(25, $end_y, '', 1, 1, 'C', 0);

                $start_y += $end_y;
                // $pdf->SetY($start_y);
                $s_no++;
                
                // $start_y = $pdf->GetY();

            }

            $end_y = $pdf->GetY();

            $last_page_count = $s_no - $last_count;
            
            if(($footer_height+$end_y) >= 270){
    
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(-15);
                $pdf->SetX(10);
                $pdf->Cell(190,6,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);
                $page_number += 1;
                $total_pages[] = $page_number;
                $last_count = $l+1;
                $file_name="Stock Report";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);
                
                // $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->SetFont('Arial','B',9);
                $pdf->Cell(190,7,$obj->encode_decode('decrypt', $product_name). ' ( Current stock : '.$current_stock_unit.')',1,1,'C',0);
                $product_start_y = $pdf->GetY();
                $pdf->SetFillColor(101,114,122);
                $pdf->SetTextColor(255,255,255);
                $pdf->SetFont('Arial','B',8);
                $pdf->SetX(10);
                $pdf->Cell(10, 8, 'S.No', 1, 0, 'C', 1);
                $pdf->Cell(20, 8, 'Date', 1, 0, 'C', 1);
                $pdf->Cell(25, 8, 'Type ', 1, 0, 'C', 1);
                $pdf->Cell(25, 8, 'Remarks', 1, 0, 'C', 1);
                $pdf->Cell(30, 8, 'Party', 1, 0, 'C', 1);
                $pdf->Cell(30, 8, 'store', 1, 0, 'C', 1);
                $pdf->Cell(25, 8, 'Inward ('. $unit_name . ')', 1, 0, 'C', 1);
                $pdf->Cell(25, 8, 'Outward ('. $unit_name. ')', 1, 1, 'C', 1);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetFont('Arial','',8);
                $start_y = $pdf->GetY();
                $y_axis=$pdf->GetY();

                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(10, $content_height - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(20, $content_height - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(25, $content_height - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(25, $content_height - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(30, $content_height - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(30, $content_height - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(25, $content_height - $y_axis, '', 1, 0, 'C', 0); 
                $pdf->Cell(25, $content_height - $y_axis, '', 1, 1, 'C', 0);
                $pdf->SetY($content_height);
            } 
            else {
                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);                
                $pdf->Cell(10, $content_height - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(20, $content_height - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(25, $content_height - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(25, $content_height - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(30, $content_height - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(30, $content_height - $y_axis, '', 1, 0, 'C', 0);
                $pdf->Cell(25, $content_height - $y_axis, '', 1, 0, 'C', 0); 
                $pdf->Cell(25, $content_height - $y_axis, '', 1, 1, 'C', 0);
            }

            $pdf->SetFont('Arial','B',8);
            $row_y = $pdf->GetY();
            $pdf->SetX(10);
            $pdf->Cell(140,8,'Total Stock',1,0,'R',0);

            $display_total_inward = number_format($total_inward,2). " ".$unit_name;
            $display_total_outward = number_format($total_outward,2). " ".$unit_name;

            

            if(!empty($display_total_inward)){
                $pdf->SetX(150);
                $pdf->MultiCell(25,8,$display_total_inward,0,'R',0);
            } else {
                $pdf->SetX(150);
                $pdf->Cell(25,8,' - ',0,0,'C',0);
            }

            $total_inward_y = $pdf->GetY() - $row_y;

            
            if(!empty($display_total_outward)){
                $pdf->SetY($row_y);
                $pdf->SetX(175);
                $pdf->MultiCell(25,8,$display_total_outward,0,'R',0);
            } else {
                $pdf->SetY($row_y);
                $pdf->SetX(175);
                $pdf->Cell(25,8,' - ',0,1,'C',0);
            }

            $total_outward_y = $pdf->GetY() - $row_y;

            $y_array = array($total_inward_y,$total_outward_y);
            $max_y = max($y_array);
            // $end_y = $max_y - $start_y;
            $pdf->SetY($row_y);
            $pdf->SetX(150);
            $pdf->Cell(25, $max_y, '', 1, 0, 'C', 0);
            $pdf->Cell(25, $max_y, '', 1, 1, 'C', 0);


            $pdf->SetFont('Arial','B',8);
            $pdf->SetX(10);
            $pdf->Cell(140,8,'Current Stock',1,0,'R',0);

            $display_current_stock = $total_inward - $total_outward;

            if(!empty($display_current_stock)){
                $pdf->SetX(150);
                $pdf->Cell(50,8,number_format($display_current_stock,2) . " " . $unit_name,1,1,'C',0);
            } else {
                $pdf->SetX(150);
                $pdf->Cell(50,8,' -',1,1,'C',0);
            }

            
        }
    }

    $pdf->SetFont('Arial','I',7);
    $pdf->SetY(-10);
    $pdf->SetX(10);
    $pdf->Cell(190,6,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

    $pdf_name = "Stock Report (".$from_date." to ".$to_date.").pdf";
    $pdf->Output($from, $pdf_name);
?>