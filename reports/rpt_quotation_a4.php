<?php
include("../include_user_check_and_files.php");
include("../include/number2words.php");

if(isset($_REQUEST['view_quotation_id'])) {
    $quotation_id = $_REQUEST['view_quotation_id'];
    $pdf_download_name ="";
    $pdf_download_name = "Quotation Report PDF";
    $quotation_number = ""; $quotation_date = date('d-m-Y'); $party_id = ""; $tax_option = ""; $igst_value = ''; $cgst_value = ''; $sgst_value = ''; $tax_type = ""; $overall_tax = ""; $company_state = "";$party_state = ""; $product_ids = array(); $product_names = array(); $unit_ids = array(); $unit_names = array(); $quantity = array(); $rate = array(); $product_tax = array(); $final_rate = array(); $amount = array(); $charges = ''; $charges_amount = ''; $discount = ''; $discount_amount = '';  $grand_total = "";
    $end_content = 230; $tax = ''; $cancelled = '0';
    if(!empty($quotation_id)) {
        $quotation_list = $obj->getSalesRecords('quotation', $quotation_id);
        if(!empty($quotation_list)) {
            foreach($quotation_list as $pi) {
                if(!empty($pi['quotation_number'])) {
                    $quotation_number = $pi['quotation_number'];
                }
                if(!empty($pi['party_id'])) {
                    $party_id = $pi['party_id'];
                }
                if(!empty($pi['party_details'])) {
                    $party_details = $obj->encode_decode('decrypt', $pi['party_details']);
                    $party_details = explode("<br>", $party_details);
                }
                if(!empty($pi['quotation_date'])) {
                    $quotation_date = date('d-m-Y', strtotime($quotation_date));
                }
                if(!empty($pi['vehicle_id']) && $pi['vehicle_id'] != $GLOBALS['null_value']) {
                    $vehicle_id = $pi['vehicle_id'];
                }
                if(!empty($pi['vehicle_number']) && $pi['vehicle_number'] != $GLOBALS['null_value']) {
                    $vehicle_number = $obj->encode_decode('decrypt', $pi['vehicle_number']);
                }
                if(!empty($pi['vehicle_details']) && $pi['vehicle_details'] != $GLOBALS['null_value']) {
                    $vehicle_details = $obj->encode_decode('decrypt', $pi['vehicle_details']);
                }
                if(!empty($pi['gst_option'])) {
                    $tax = $pi['gst_option'];
                }
                if(!empty($pi['tax_option'])) {
                    $tax_option = $pi['tax_option'];
                }
                if(!empty($pi['tax_type'])) {
                    $tax_type = $pi['tax_type'];
                }
                if(!empty($pi['overall_tax'])) {
                    $overall_tax = $pi['overall_tax'];
                }
                if(!empty($pi['party_state'])) {
                    $party_state = $pi['party_state'];
                }
                if(!empty($pi['cgst_value'])) {
                    $cgst_value = $pi['cgst_value'];
                }
                if(!empty($pi['sgst_value'])) {
                    $sgst_value = $pi['sgst_value'];
                }
                if(!empty($pi['igst_value'])) {
                    $igst_value = $pi['igst_value'];
                }
                if(!empty($pi['overall_tax'])) {
                    $tax_value = $pi['overall_tax'];
                    $tax_value = str_replace('%','',$tax_value);
                }
                if(!empty($pi['round_off_value'])) {
                    $round_off = $pi['round_off_value'];
                }
                if(!empty($pi['product_id'])) {
                    $product_ids = $pi['product_id'];
                    $product_ids = explode(",", $product_ids);
                    $product_ids = array_reverse($product_ids);
                }
                if(!empty($pi['product_name'])) {
                    $product_names = $pi['product_name'];
                    $product_names = explode(",", $product_names);
                    $product_names = array_reverse($product_names);
                }
                if(!empty($pi['store_name'])) {
                    $store_names = $pi['store_name'];
                    $store_names = explode(",", $store_names);
                    $store_names = array_reverse($store_names);
                }
                if(!empty($pi['unit_id'])) {
                    $unit_ids = $pi['unit_id'];
                    $unit_ids = explode(",", $unit_ids);
                    $unit_ids = array_reverse($unit_ids);
                }
                if(!empty($pi['unit_name'])) {
                    $unit_names = $pi['unit_name'];
                    $unit_names = explode(",", $unit_names);
                    $unit_names = array_reverse($unit_names);
                }
                if(!empty($pi['quantity'])) {
                    $quantity = $pi['quantity'];
                    $quantity = explode(",", $quantity);
                    $quantity = array_reverse($quantity);
                }
                if(!empty($pi['rate'])) {
                    $rate = $pi['rate'];
                    $rate = explode(",", $rate);
                    $rate = array_reverse($rate);
                }
                if(!empty($pi['product_tax'])) {
                    $product_tax = $pi['product_tax'];
                    $product_tax = explode(",", $product_tax);
                    $product_tax = array_reverse($product_tax);
                }     
                if(!empty($pi['final_rate'])) {
                    $final_rate = $pi['final_rate'];
                    $final_rate = explode(",", $final_rate);
                    $final_rate = array_reverse($final_rate);
                }      
        
                if(!empty($pi['amount'])) {
                    $amount = $pi['amount'];
                    $amount = explode(",", $amount);
                    $amount = array_reverse($amount);
                }    
        
                if(!empty($pi['charges']) && $pi['charges'] != $GLOBALS['null_value']) {
                    $charges = $pi['charges'];
                } 
                if(!empty($pi['charges_value'])) {
                    $charges_amount = $pi['charges_value'];
                }  
                if(!empty($pi['discount']) && $pi['discount'] != $GLOBALS['null_value']) {
                    $discount = $pi['discount'];
                } 
                if(!empty($pi['discount_value'])) {
                    $discount_amount = $pi['discount_value'];
                }  
                if(!empty($pi['total_tax_value'])) {
                    $tax_amount = $pi['total_tax_value'];
                } 
                
                if(!empty($pi['total_amount'])) {
                    $grand_total = $pi['total_amount'];
                }
                if(!empty($pi['deleted']) && $pi['deleted'] != $GLOBALS['null_value']) {
                    $cancelled = $pi['deleted'];
                }  
            }
        }
    }
    $company_state = $obj->getTableColumnValue($GLOBALS['company_table'], 'company_id', $GLOBALS['bill_company_id'], 'state');
    $company_state = $obj->encode_decode('decrypt',$company_state);
    $less_for_tax = 0; $less_for_inclusive = 0; $extra_no_tax = 0;
    if(!empty($charges)) {
        $end_content = $end_content - 10;
    }
    if(!empty($discount)) {
        $end_content = $end_content - 10;
    }

    if($tax == 1 ) {
        $end_content = $end_content - 10;
        if($company_state == $party_state) {
            $end_content = $end_content -5;
        }
    }

    if($tax == '1' && $tax_type != '1') {
        $less_for_tax = 3;
    }
    if($tax == '1' && $tax_option != '2') {
        $less_for_tax += 5;
        $less_for_inclusive += 5;
    }

    if($tax == '1' && $tax_option != '2') {
        $extra_no_tax += 5;
    }

    if($tax != '1') {
        $less_for_tax += 8;
        $less_for_inclusive += 5;
        $extra_no_tax += 5;
    }

    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $yaxis = $pdf->GetY();
    $file_name="Quotation";
    include("rpt_header.php");
    if($cancelled == '0'){
        include("rpt_watermark.php");
    }
    if($cancelled == '1') {
        if(file_exists('../include/images/cancelled.jpg')) {
            $pdf->SetAlpha(0.3);
            $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
            $pdf->SetAlpha(1);
        }
    } 
    

    $pdf->SetY($header_end);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(0,1,'',0,1,'L',0);
    $pdf->Cell(63,4,'Buyer : ',0,1,'L',0);
    $pdf->Cell(0,1,'',0,1,'L',0);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetX(12);
    if(!empty($party_details)){
        for($i=0;$i<count($party_details);$i++){
            if($party_details[$i]!="NULL" && $party_details[$i]!=""){
                $pdf->SetFont('Arial','',9);
                $pdf->SetX(15);
                if($i==0){
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(60,4,$party_details[$i],0,1,'L',0);
                    $pdf->Cell(0,1,'',0,1,'L',0);
                } else{
                    $party_details[$i] = trim($party_details[$i]);
                    $pdf->MultiCell(60,4,$party_details[$i],0,'L',0);
                    $pdf->Cell(0,1,'',0,1,'L',0);
                }
            }
        }
    }

    $detials_y = $pdf->GetY();
    $pdf->SetY($header_end);

    $pdf->SetFont('Arial','B',9);
    
    $pdf->Cell(0,2,'',0,1,'L',0);
    $pdf->SetX(105);
    $pdf->Cell(64,4,'Quotation No.        : '.$quotation_number,0,1,'L',0);
    $pdf->Cell(0,2,'',0,1,'L',0);
    $pdf->SetX(105);
    $pdf->Cell(64,4,'Date                        : '.$quotation_date,0,1,'L',0);
    $pdf->Cell(0,2,'',0,1,'L',0); 
    $pdf->SetX(105);
    $pdf->Cell(64,4,'Vehicle No.            : '.$vehicle_number,0,1,'L',0);
    $pdf->Cell(0,2,'',0,1,'L',0); 
    $pdf->SetX(105);
    $pdf->Cell(64,4,'Vehicle Details      : '.$vehicle_details,0,1,'L',0);
    $pdf->Cell(0,2,'',0,1,'L',0); 

    $bill_y = $pdf->GetY();

    if($detials_y > $bill_y) {
        $pdf->Line(105,$header_end,105, $detials_y);
        $pdf->SetY($detials_y);
    } else if($bill_y > $detials_y) {
        $pdf->Line(105,$header_end,105, $bill_y);
        $pdf->SetY($bill_y);
    } else {
        $pdf->Line(105,$header_end,105, $detials_y);
        $pdf->SetY($detials_y);
    }

    $current_y = $pdf->GetY();
    $box_y = $pdf->GetY();

    $pdf->SetY($yaxis);
    $pdf->SetX(10);
    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY($box_y);
    $pdf->SetX(10);
    $pdf->Cell(11,8,'S.No.',1,0,'C',0);
    $pdf->Cell(30,8,'Store',1,0,'C',0);
    $pdf->Cell(40+$less_for_inclusive,8,'Products',1,0,'C',0);
    $pdf->Cell(20+$less_for_tax,8,'Unit',1,0,'C',0);
    $pdf->Cell(20+$less_for_tax,8,'Quantity',1,0,'C',0);
    $pdf->Cell(20+$less_for_tax,8,'Rate(Rs.)',1,0,'C',0);
    if($tax == '1' && $tax_type == '1') {
        $pdf->Cell(9,8,'Tax',1,0,'C',0);
    }
    if($tax == '1' && $tax_option == '2') {
        $pdf->Cell(20,8,'Final(Rs.)',1,0,'C',0);
    }
    $pdf->Cell(20,8,'Amount(Rs.)',1,1,'C',0);
    $pdf->SetFont('Arial','',7);
    $y_axis=$pdf->GetY();

    $index = 0;
    $total_unit = $total_subunit = $quotation_subtotal = 0; $total_cal_y = 0;
    for($i = 0; $i < count($product_ids); $i++) {
        if(($pdf->GetY() >= 275) || (((count($product_ids) - (int)$i) < 4) && $pdf->GetY() >= 260) ){
            $y = $pdf->GetY();
            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            $pdf->Cell(11,278-$y_axis,'',1,0,'L',0);
            $pdf->Cell(30,278-$y_axis,'',1,0,'C',0);
            $pdf->Cell(40+$less_for_inclusive,278-$y_axis,'',1,0,'C',0);
            $pdf->Cell(20+$less_for_tax,278-$y_axis,'',1,0,'C',0);
            $pdf->Cell(20+$less_for_tax,278-$y_axis,'',1,0,'C',0);
            $pdf->Cell(20+$less_for_tax,278-$y_axis,'',1,0,'C',0);
            if($tax == '1' && $tax_type == '1') {
                $pdf->Cell(9,278-$y_axis,'',1,0,'C',0);
            }
            if($tax == '1' && $tax_option == '2') {
                $pdf->Cell(20,278-$y_axis,'',1,0,'C',0);
            }
            $pdf->Cell(20,278-$y_axis,'',1,1,'C',0);

            $pdf->SetFont('Arial','B',10);
            $next_page = $pdf->PageNo() +1;
            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(-15);
            $pdf->SetX(10);
            $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
            $pdf->SetFont('Arial','',8);
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);
            $yaxis = $pdf->GetY();
            $page_number += 1;
            $total_pages[] = $page_number;
            $file_name="Quotation";

            include("rpt_header.php");
            if($cancelled == '0'){
                include("rpt_watermark.php");
            }
            if($cancelled == '1') {
                if(file_exists('../include/images/cancelled.jpg')) {
                    $pdf->SetAlpha(0.3);
                    $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                    $pdf->SetAlpha(1);
                }
            }  
            $pdf->SetY($header_end);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(10);
            $pdf->Cell(0,1,'',0,1,'L',0);
            $pdf->Cell(63,4,'Buyer : ',0,1,'L',0);
            $pdf->Cell(0,1,'',0,1,'L',0);
            $pdf->SetFont('Arial','B',10);
            $pdf->SetX(12);
            if(!empty($party_details)){
                for($p=0;$p<count($party_details);$p++){
                    if($party_details[$p]!="NULL" && $party_details[$p]!=""){
                        $pdf->SetFont('Arial','',9);
                        $pdf->SetX(15);
                        if($p==0){
                            $pdf->SetFont('Arial','B',9);
                            $pdf->Cell(60,4,$party_details[$p],0,1,'L',0);
                            $pdf->Cell(0,1,'',0,1,'L',0);
                        } else{
                            $party_details[$p] = trim($party_details[$p]);
                            $pdf->MultiCell(60,4,$party_details[$p],0,'L',0);
                            $pdf->Cell(0,1,'',0,1,'L',0);
                        }
                    }
                }
            }

            $detials_y = $pdf->GetY();
            $pdf->SetY($header_end);

            $pdf->SetFont('Arial','B',9);
            
            $pdf->Cell(0,2,'',0,1,'L',0);
            $pdf->SetX(105);
            $pdf->Cell(64,4,'Quotation No.        : '.$quotation_number,0,1,'L',0);
            $pdf->Cell(0,2,'',0,1,'L',0);
            $pdf->SetX(105);
            $pdf->Cell(64,4,'Date                        : '.$quotation_date,0,1,'L',0);
            $pdf->Cell(0,2,'',0,1,'L',0); 
            $pdf->SetX(105);
            $pdf->Cell(64,4,'Vehicle No.            : '.$vehicle_number,0,1,'L',0);
            $pdf->Cell(0,2,'',0,1,'L',0); 
            $pdf->SetX(105);
            $pdf->Cell(64,4,'Vehicle Details      : '.$vehicle_details,0,1,'L',0);
            $pdf->Cell(0,2,'',0,1,'L',0); 

            $bill_y = $pdf->GetY();

            if($detials_y > $bill_y) {
                $pdf->Line(105,$header_end,105, $detials_y);
                $pdf->SetY($detials_y);
            } else if($bill_y > $detials_y) {
                $pdf->Line(105,$header_end,105, $bill_y);
                $pdf->SetY($bill_y);
            } else {
                $pdf->Line(105,$header_end,105, $detials_y);
                $pdf->SetY($detials_y);
            }
            $current_y = $pdf->GetY();
            $box_y = $pdf->GetY();

            $pdf->SetY($yaxis);
            $pdf->SetX(10);
            $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetY($box_y);
            $pdf->SetX(10);

            $pdf->SetFont('Arial','B',8);   
            $y=$pdf->GetY();
            $pdf->SetX(10);
            $pdf->Cell(11,8,'S.No.',1,0,'C',0);
            $pdf->Cell(30,8,'Store',1,0,'C',0);
            $pdf->Cell(40+$less_for_inclusive,8,'Products',1,0,'C',0);
            $pdf->Cell(20+$less_for_tax,8,'Unit',1,0,'C',0);
            $pdf->Cell(20+$less_for_tax,8,'Quantity',1,0,'C',0);
            $pdf->Cell(20+$less_for_tax,8,'Rate(Rs.)',1,0,'C',0);
            if($tax == '1' && $tax_type == '1') {
                $pdf->Cell(9,8,'Tax',1,0,'C',0);
            }
            if($tax == '1' && $tax_option == '2') {
                $pdf->Cell(20,8,'Final(Rs.)',1,0,'C',0);
            }
            $pdf->Cell(20,8,'Amount(Rs.)',1,1,'C',0);
            $pdf->SetFont('Arial','',8);

            $y_axis=$pdf->GetY();
        }
        $index = $i + 1;
        $pdf->Cell(11,8,$index,1,0,'C',0);
        $pdf->Cell(30,8,$obj->encode_decode('decrypt', $store_names[$i]),1,0,'L',0);
        $pdf->Cell(40+$less_for_inclusive,8,$obj->encode_decode('decrypt', $product_names[$i]),1,0,'L',0);
        $pdf->Cell(20+$less_for_tax,8,$obj->encode_decode('decrypt', $unit_names[$i]),1,0,'C',0);
        $pdf->Cell(20+$less_for_tax,8,$quantity[$i],1,0,'R',0);        
        $pdf->Cell(20+$less_for_tax,8,number_format($rate[$i],2),1,0,'R',0);
        if($tax == '1' && $tax_type == '1') {
            $pdf->Cell(9,8,$product_tax[$i],1,0,'C',0);
        }
        if($tax == '1' && $tax_option == '2') {
            $pdf->Cell(20,8,$obj->numberFormat($final_rate[$i],2),1,0,'R',0);
        }
        $pdf->Cell(20,8,number_format($amount[$i],2),1,1,'R',0);
        $quotation_subtotal += $amount[$i];

    }
    $pdf->SetFont('Arial','B',8);

   
    if($pdf->GetY() >= $end_content){
        $y = $pdf->GetY();
        $pdf->SetY($y_axis);
        $pdf->SetX(10);
        $pdf->Cell(11,278-$y_axis,'',1,0,'L',0);
        $pdf->Cell(30,278-$y_axis,'',1,0,'C',0);
        $pdf->Cell(40+$less_for_inclusive,278-$y_axis,'',1,0,'C',0);
        $pdf->Cell(20+$less_for_tax,278-$y_axis,'',1,0,'C',0);
        $pdf->Cell(20+$less_for_tax,278-$y_axis,'',1,0,'C',0);
        $pdf->Cell(20+$less_for_tax,278-$y_axis,'',1,0,'C',0);
        if($tax == '1' && $tax_type == '1') {
            $pdf->Cell(9,278-$y_axis,'',1,0,'C',0);
        }
        if($tax == '1' && $tax_option == '2') {
            $pdf->Cell(20,278-$y_axis,'',1,0,'C',0);
        }
        $pdf->Cell(20,278-$y_axis,'',1,1,'C',0);

        $pdf->SetFont('Arial','B',10);
        $next_page = $pdf->PageNo() +1;
        // $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(-15);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
        $pdf->SetFont('Arial','B',8);
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $yaxis = $pdf->GetY();
        $page_number += 1;
        $total_pages[] = $page_number;
        
        $file_name="Quotation";

        include("rpt_header.php");
        if($cancelled == '0'){
            include("rpt_watermark.php");
        }
        if($cancelled == '1') {
            if(file_exists('../include/images/cancelled.jpg')) {
                $pdf->SetAlpha(0.3);
                $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                $pdf->SetAlpha(1);
            }
        }

        $pdf->SetY($header_end);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(10);
        $pdf->Cell(0,1,'',0,1,'L',0);
        $pdf->Cell(63,4,'Buyer : ',0,1,'L',0);
        $pdf->Cell(0,1,'',0,1,'L',0);
        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(12);
        if(!empty($party_details)){
            for($p=0;$p<count($party_details);$p++){
                if($party_details[$p]!="NULL" && $party_details[$p]!=""){
                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(15);
                    if($p==0){
                        $pdf->SetFont('Arial','B',9);
                        $pdf->Cell(60,4,$party_details[$p],0,1,'L',0);
                        $pdf->Cell(0,1,'',0,1,'L',0);
                    } else{
                        $party_details[$p] = trim($party_details[$p]);
                        $pdf->MultiCell(60,4,$party_details[$p],0,'L',0);
                        $pdf->Cell(0,1,'',0,1,'L',0);
                    }
                }
            }
        }

        $detials_y = $pdf->GetY();
        $pdf->SetY($header_end);

        $pdf->SetFont('Arial','B',9);
        
        $pdf->Cell(0,2,'',0,1,'L',0);
        $pdf->SetX(105);
        $pdf->Cell(64,4,'Quotation No.        : '.$quotation_number,0,1,'L',0);
        $pdf->Cell(0,2,'',0,1,'L',0);
        $pdf->SetX(105);
        $pdf->Cell(64,4,'Date                        : '.$quotation_date,0,1,'L',0);
        $pdf->Cell(0,2,'',0,1,'L',0); 
        $pdf->SetX(105);
        $pdf->Cell(64,4,'Vehicle No.            : '.$vehicle_number,0,1,'L',0);
        $pdf->Cell(0,2,'',0,1,'L',0); 
        $pdf->SetX(105);
        $pdf->Cell(64,4,'Vehicle Details      : '.$vehicle_details,0,1,'L',0);
        $pdf->Cell(0,2,'',0,1,'L',0); 

        $bill_y = $pdf->GetY();

        if($detials_y > $bill_y) {
            $pdf->Line(105,$header_end,105, $detials_y);
            $pdf->SetY($detials_y);
        } else if($bill_y > $detials_y) {
            $pdf->Line(105,$header_end,105, $bill_y);
            $pdf->SetY($bill_y);
        } else {
            $pdf->Line(105,$header_end,105, $detials_y);
            $pdf->SetY($detials_y);
        }
        $current_y = $pdf->GetY();
        $box_y = $pdf->GetY();

        $pdf->SetY($yaxis);
        $pdf->SetX(10);
        $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
        $pdf->SetY($box_y);
        $pdf->SetFont('Arial','B',8);   
        $y=$pdf->GetY();
        $pdf->SetX(10);
        $pdf->SetFillColor(52,58,64);
       $pdf->Cell(11,8,'S.No.',1,0,'C',0);
        $pdf->Cell(30,8,'Store',1,0,'C',0);
        $pdf->Cell(40+$less_for_inclusive,8,'Products',1,0,'C',0);
        $pdf->Cell(20+$less_for_tax,8,'Unit',1,0,'C',0);
        $pdf->Cell(20+$less_for_tax,8,'Quantity',1,0,'C',0);
        $pdf->Cell(20+$less_for_tax,8,'Rate(Rs.)',1,0,'C',0);
        if($tax == '1' && $tax_type == '1') {
            $pdf->Cell(9,8,'Tax',1,0,'C',0);
        }
        if($tax == '1' && $tax_option == '2') {
            $pdf->Cell(20,8,'Final(Rs.)',1,0,'C',0);
        }
        $pdf->Cell(20,8,'Amount(Rs.)',1,1,'C',0);
        $pdf->SetFont('Arial','',8);

        $y_axis=$pdf->GetY();
    }

    $pdf->setY($end_content);
    $pdf->Line(21,$y_axis,21,$end_content);
    $pdf->Line(51,$y_axis,51,$end_content);
    $pdf->Line(91+$less_for_inclusive,$y_axis,91+$less_for_inclusive,$end_content);
    $pdf->Line(111+$extra_no_tax+$less_for_tax,$y_axis,111+$extra_no_tax+$less_for_tax,$end_content);
    $pdf->Line(131+$extra_no_tax+($less_for_tax != 0 ? ($less_for_tax*2) : 0 ),$y_axis,131+$extra_no_tax+($less_for_tax != 0 ? ($less_for_tax*2) : 0 ),$end_content);
    
    $pdf->Line(151+$extra_no_tax+($less_for_tax != 0 ? ($less_for_tax*3) : 0 ),$y_axis,151+$extra_no_tax+($less_for_tax != 0 ? ($less_for_tax*3) : 0 ),$end_content);
    if($tax == '1' && $tax_type == '1') {
        if($tax_option != '2') {
            $pdf->Line(180,$y_axis,180,$end_content);
        } else {
            $pdf->Line(160,$y_axis,160,$end_content);
        }
    }
    if($tax == '1' && $tax_option == '2') {
        $pdf->Line(180,$y_axis,180,$end_content);
    }
    $pdf->Line(200,$y_axis,200,$end_content);
 

    if(!empty($quotation_subtotal)) {
        $subtotal = $obj->numberFormat($quotation_subtotal,2);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(170,5,'Sub Total',1,0,'R',0);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(20,5,$subtotal,1,1,'R',0);
    }
    
        $total_amount_ = $quotation_subtotal;

        if(!empty($discount) && $discount != $GLOBALS['null_value']) {
            
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(170,5,'Discount ('. $discount.')',1,0,'R',0);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20,5,  '-'.$discount_amount,1,1,'R',0);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(170,5,'Discounted Total',1,0,'R',0);
                $pdf->SetFont('Arial','',8);
                $total_amount_ = (float)$total_amount_ - (float)$discount_amount;
                $pdf->Cell(20,5,number_format(((float) $total_amount_),2),1,1,'R',0);
        }
        
        if(!empty($charges) && $charges != $GLOBALS['null_value']) {
            
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(170,5,'Charges ('. $charges.')',1,0,'R',0);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20,5,  '+'.$charges_amount,1,1,'R',0);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(170,5,'After Charges Total',1,0,'R',0);
                $pdf->SetFont('Arial','',8);
                $total_amount_ = (float)$total_amount_ + (float)$charges_amount;
                $pdf->Cell(20,5,number_format(((float) $total_amount_),2),1,1,'R',0);
        }

        $tax_value1 = "";
        if($tax == 1 && $company_state == $party_state) {
            if(!empty($tax_value)){
                $tax_value1 =  $tax_value/2; 
                $tax_value1 = ' ('. $tax_value1.'%'.')';
            }
            if(!empty($cgst_value)){  
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(170,5,'CGST'.$tax_value1 ,1,0,'R',0);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20,5,$cgst_value,1,1,'R',0);
            }
            if(!empty($sgst_value)){  
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(170,5,'SGST'. $tax_value1,1,0,'R',0);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20,5,$sgst_value,1,1,'R',0);
            }
        }
        $tax_value1 = "";

        if($tax == 1 && $company_state != $party_state) {
            if(!empty($tax_value)){
                $tax_value1 = ' ('. $tax_value.'%'.')';
            }
            if(!empty($igst_value)){  
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(170,5,'IGST' .$tax_value1,1,0,'R',0);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20,5,$igst_value,1,1,'R',0);
            }
        }
        if(!empty($tax_amount) && $tax_amount != $GLOBALS['null_value'] && $tax_amount != '0.00'){  
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(170,5,'Total Tax',1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20,5,"+".$tax_amount,1,1,'R',0);
        }          
        if(!empty($round_off)){  
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(170,5,'Round Off',1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20,5,"0.".$round_off,1,1,'R',0);
        }
        if(!empty($grand_total)){
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(170,5,'Bill Total',1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20,5,number_format($grand_total,2),1,1,'R',0);
            $total_cal_y = $pdf->GetY();
            $line_y = $total_cal_y;
                $line_y = $total_cal_y;
            
            $pdf->SetY($line_y);
            // echo $total_cal_y ,"<br>", $bank_y,"<br>", $line_y;
            $line_y = $pdf->GetY();
            $pdf->Line(10,$line_y,200,$line_y);

            $pdf->SetFont('Arial','',8);
            $pdf->SetX(10);
            $pdf->Cell(40,5,'Amount (in words) :',0,0,'L',0);
            $pdf->SetX(10);
            $pdf->Cell(0,5,'E. & O.E',0,1,'R',0);
            $pdf->SetFont('Arial','B',8);
            $pdf->SetX(10);
            $pdf->Cell(190,5,getIndianCurrency(str_replace(',', '', $grand_total)).'Only',0,1,'L',0);
            $line_y = $pdf->GetY();
        }   

        $pdf->Line(10,$line_y,200,$line_y);
        $pdf->SetY($line_y);
        $pdf->SetFont('Arial','BU',9);
        // $pdf->Cell(100,2,'', 0, 1, '');
        $pdf->Cell(100,5,'Declaration', 0, 1, '');
        $pdf->SetY($line_y);
        $pdf->SetX(140);
        $pdf->SetFont('Arial','B',9);
        $pdf->MultiCell(60,7, 'For  ' . $company_details[0],0,'C',0);
        $pdf->SetFont('Arial','',8);
        $pdf->SetY(260);
        $pdf->setX(13);
        $pdf->MultiCell(90,4,'* We declare that this bill shows the actual price of the goods described and that all particulars are true and correct. ', 0, 1, '');
        $pdf->setX(13);
        $pdf->MultiCell(90,6,'* Subject to SIVAKASI jurisdiction only', 0, 1, '');
        $pdf->Cell(190,2,'', 0, 1, 'C');
        $pdf->SetY(270);
        $pdf->SetX(140);
        $pdf->Cell(45,2,'Authorised Signatory',0,1,'C',0);
        $pdf->SetFont('Arial','',7);
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->Cell(190,265,'',1,0,'C');
        $yz = $pdf ->GetY();
        $pdf->SetY(275);
        $pdf->Cell(190,5,'***This is Computer Generated bill. Hence Digital Signature is not required.***',0,1,'C',0);

        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(-15);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');


    $pdf->Output('',$pdf_download_name . '.pdf');


}