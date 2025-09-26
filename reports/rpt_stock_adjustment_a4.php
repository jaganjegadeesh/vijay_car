<?php
    include("../include_user_check_and_files.php");
    include("../include/number2words.php");

    $view_stock_adjustment_id = "";
    if (isset($_REQUEST['view_stock_adjustment_id'])) {
        $view_stock_adjustment_id = $_REQUEST['view_stock_adjustment_id'];
    } else {
        header("Location: ../stock_adjustment.php");
        exit;
    }
    if(isset($_REQUEST['view_stock_adjustment_id'])) { 
        $view_stock_adjustment_id = trim($_REQUEST['view_stock_adjustment_id']);
        $stock_adjustment_date = date('Y-m-d'); $current_date = date('Y-m-d');
        $from_date = date('Y-m-d', strtotime('-7 days')); $to_date = date('Y-m-d');
        $stock_adjustment_date = date('Y-m-d');$product_ids = array(); $product_names = array(); $unit_ids = array(); $unit_names = array(); $quantity = array();$stock_action = array(); $remarks = ""; $store_id = "";$product_count = 0;$store_ids = array(); $store_names = array();$total_quantity = array(); $company_details = array(); $stock_adjustment_number = "";
        $stock_adjustment_list = array(); $shade_name = array(); $supplier_name = array(); $current_store = ""; $first_store = ""; $cancelled = 0;
        $stock_adjustment_list = $obj->getAllRecords($GLOBALS['stock_adjustment_table'], 'stock_adjustment_id', $view_stock_adjustment_id);
        if(!empty($stock_adjustment_list)) {
            foreach($stock_adjustment_list as $data) {
                if(!empty($data['store_id'])) {
                    $store_ids = explode(",", $data['store_id']);
                }
                if(!empty($data['stock_adjustment_number']) && $data['stock_adjustment_number'] != $GLOBALS['null_value']) {
                    $stock_adjustment_number = $data['stock_adjustment_number'];
                }
                if(!empty($data['stock_adjustment_date'])) {
                    $stock_adjustment_date = date('Y-m-d', strtotime($data['stock_adjustment_date']));
                }
                if(!empty($data['store_name'])) {
                    $store_names = explode(",", $data['store_name']);
                    $current_store = $data['store_name']; 
                    $first_store = $store_names[0];
                }

                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                    $product_ids = $data['product_id'];
                    $product_ids = explode(",", $product_ids);
                    $product_count = count($product_ids);
                    $product_ids = array_reverse($product_ids);
                }
                if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                    $unit_ids = $data['unit_id'];
                    $unit_ids = explode(",", $unit_ids);
                    $unit_ids = array_reverse($unit_ids);
                }
                if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                    $product_names = $data['product_name'];
                    $product_names = explode(",", $product_names);
                    $product_names = array_reverse($product_names);
                }
                if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                    $unit_names = $data['unit_name'];
                    $unit_names = explode(",", $unit_names);
                    $unit_names = array_reverse($unit_names);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity = $data['quantity'];
                    $quantity = explode(",", $quantity);
                    $quantity = array_reverse($quantity);
                }
                if(!empty($data['stock_action']) && $data['stock_action'] != $GLOBALS['null_value']) {
                    $stock_action = $data['stock_action'];
                    $stock_action = explode(",", $stock_action);
                    $stock_action = array_reverse($stock_action);
                }
                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                    $remarks = $obj->encode_decode('decrypt', $data['remarks']);
                }
                if(!empty($data['bill_company_details']) && $data['bill_company_details'] != $GLOBALS['null_value']) {
                     $company_details =html_entity_decode($obj->encode_decode('decrypt',$data['bill_company_details']));
                     $company_details = explode("$$$", $company_details);
                }
                 if(!empty($data['deleted']) && $data['deleted'] != $GLOBALS['null_value']) {
                    $cancelled = $data['deleted'];
                }

            }
        }
        $company_name = "";
        $company_name = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'name');
        if(!empty($company_name) && $company_name != $GLOBALS['null_value']){
            $company_name = $obj->encode_decode('decrypt', $company_name);
        }  
        require_once('../fpdf/AlphaPDF.php');
        $pdf = new AlphaPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetTitle('Stock Adjustment');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFont('Arial', 'BI', 10);

        $height = 0;
        $display = '';
        $y2 = $pdf->GetY();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY(11);

        $file_name="Stock Adjustment";
        include("rpt_header.php");
        if($cancelled == '1') {
            if(file_exists('../include/images/cancelled.jpg')) {
                $pdf->SetAlpha(0.3);
                $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                $pdf->SetAlpha(1);
            }
        }
        $bill_to_y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetX(10);
        $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
        $pdf->Cell(90, 4, 'Stock Adjustment Date : ', 0, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetX(50);
        $pdf->Cell(20, 4,date('d-m-Y',strtotime($stock_adjustment_date)), 0, 1, 'L', 0);
        $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetX(12);

        $bill_to_y1 = $pdf->GetY();

        $pdf->SetY($bill_to_y);
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(0, 1, '', 0, 1, 'C', 0);

        $pdf->SetFont('Arial', '', 9);

        $pdf->SetX(110);
        $pdf->SetFont('Arial', 'B', 9);

        $pdf->Cell(95, 4, 'Stock Adjustment No : ', 0, 0, 'L', 0);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetX(145);
        $pdf->Cell(20, 4, $stock_adjustment_number, 0, 1, 'L', 0);
        $bill_to_y2 = $pdf->GetY();
        $y_array = array($bill_to_y1, $bill_to_y2);
        $max_bill_y = max($y_array);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

        $bill_to_y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetX(10);
        $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
        $pdf->Cell(90, 4, 'Store Room : ', 0, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetX(40);
        $pdf->Cell(20, 4,$obj->encode_decode('decrypt', $first_store), 0, 1, 'L', 0);
        $pdf->Cell(0, 2, '', 0, 1, 'L', 0);  
        
        
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->cell(0,6, '', 1, 1, 'L', 0);

        
       


        $header_height = $max_bill_y - 10;
        $address_height = $max_bill_y - $bill_to_y;
       
        
        $starting_y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(101,114,122);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetX(10);
        $pdf->Cell(15, 7, 'S.No', 1, 0, 'C', 1);
        $pdf->Cell(65, 7, 'Products', 1, 0, 'C', 1);
        $pdf->Cell(30, 7, 'Quantity', 1, 0, 'C', 1);
        $pdf->Cell(40, 7, 'Unit', 1, 0, 'C', 1);
        $pdf->Cell(40, 7, 'Stock Action', 1, 1, 'C', 1);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', '', 8);
        $product_y = $pdf->GetY();
        

        $pdf->SetFont('Arial', '', 8);
        $product_y = $pdf->GetY();

        $y_axis = $pdf->GetY();
        $s_no = 1;
        $net_amount = 0;
        $footer_height = 0;
        $footer_height += 25;
        $total_pages = array(1);
        $page_number = 1;
        $last_count = 0;
        $total_quantity = 0;
        $quantity_total = 0;
        if (!empty($view_stock_adjustment_id) && !empty($product_ids)) {
            for ($p = 0; $p < count($product_ids); $p++) {
                if($pdf->GetY() >= 265){
                    $y = $pdf->GetY();
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
                    $last_count = $p + 1;
                    $pdf->SetTitle('Stock Adjustment');
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetFont('Arial', 'BI', 10);

                    $height = 0;
                    $display = '';
                    $y2 = $pdf->GetY();
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->SetY(11);

                    $file_name="Stock Adjustment";
                    include("rpt_header.php");
                    if($cancelled == '1') {
                        if(file_exists('../include/images/cancelled.jpg')) {
                            $pdf->SetAlpha(0.3);
                            $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                            $pdf->SetAlpha(1);
                        }
                    }
                    $bill_to_y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetX(10);
                    $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                    $pdf->Cell(90, 4, 'Stock Adjustment Date : ', 0, 0, 'L', 0);
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->SetX(50);
                    $pdf->Cell(20, 4,date('d-m-Y',strtotime($stock_adjustment_date)), 0, 1, 'L', 0);
                    $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetX(12);

                    $bill_to_y1 = $pdf->GetY();

                    $pdf->SetY($bill_to_y);
                    $pdf->SetFont('Arial', 'B', 10);

                    $pdf->Cell(0, 1, '', 0, 1, 'C', 0);

                    $pdf->SetFont('Arial', '', 9);

                    $pdf->SetX(110);
                    $pdf->SetFont('Arial', 'B', 9);

                    $pdf->Cell(95, 4, 'Stock Adjustment No : ', 0, 0, 'L', 0);

                    $pdf->SetFont('Arial', '', 9);
                    $pdf->SetX(145);
                    $pdf->Cell(20, 4, $stock_adjustment_number, 0, 1, 'L', 0);
                    $bill_to_y2 = $pdf->GetY();
                    $y_array = array($bill_to_y1, $bill_to_y2);
                    $max_bill_y = max($y_array);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

                    $bill_to_y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetX(10);
                    $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                    $pdf->Cell(90, 4, 'Store Room : ', 0, 0, 'L', 0);
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->SetX(40);
                    $pdf->Cell(20, 4,$obj->encode_decode('decrypt', $first_store), 0, 1, 'L', 0);

                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->cell(0,6, '', 1, 1, 'L', 0);

                    $header_height = $max_bill_y - 10;
                    $address_height = $max_bill_y - $bill_to_y;
                
                    
                    $starting_y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->SetFillColor(101,114,122);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetX(10);
                    $pdf->Cell(15, 7, 'S.No', 1, 0, 'C', 1);
                    $pdf->Cell(65, 7, 'Products', 1, 0, 'C', 1);
                    $pdf->Cell(30, 7, 'Quantity', 1, 0, 'C', 1);
                    $pdf->Cell(40, 7, 'Unit', 1, 0, 'C', 1);
                    $pdf->Cell(40, 7, 'Stock Action', 1, 1, 'C', 1);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 8);
                    $product_y = $pdf->GetY();
                    

                    $pdf->SetFont('Arial', '', 8);
                    $product_y = $pdf->GetY();


                }
                $quantity[$p] = trim($quantity[$p]);
                $total_quantity += $quantity[$p]; 
                $stock_action[$p] = trim($stock_action[$p]);
                if(!empty($stock_action[$p])) { 
                    if($stock_action[$p] == '1') {
                       $stock_action[$p] = 'Plus';
                    }
                    else if($stock_action[$p] == '2') {
                        $stock_action[$p] = 'Minus';
                    }
                } 

                if(!empty($product_names)){
                    $product_names[$p] = trim($product_names[$p]);
                    $product_names[$p] = html_entity_decode($obj->encode_decode("decrypt", $product_names[$p]));
                }
                if(!empty($unit_names[$p])){
                    $unit_names[$p] = trim($unit_names[$p]);
                    $unit_names[$p] = $obj->encode_decode('decrypt', $unit_names[$p]);
                }
                $y = $pdf->GetY();
                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(15, 6, $s_no, 0, 0, 'L', 0);

                $pdf->SetY($product_y);
                if(!empty($product_names[$p])){
                    $pdf->SetX(25);
                    $pdf->MultiCell(65, 6, $product_names[$p], 0, 'L');
                } else {
                    $pdf->SetX(25);
                    $pdf->Cell(65, 6,' - ',0,0, 'C');
                }
                $product_name_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($quantity[$p])){
                    $pdf->SetX(90);
                    $pdf->MultiCell(30, 6,$quantity[$p], 0, 'R');
                } else {
                    $pdf->SetX(90);
                    $pdf->Cell(30, 6,' - ',0,0, 'C');
                }
                $qty_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($unit_names[$p])){
                    $pdf->SetX(120);
                    $pdf->MultiCell(40, 6,$unit_names[$p], 0, 'C');
                } else {
                    $pdf->SetX(120);
                    $pdf->Cell(40, 6,' - ',0, 0, 'C');
                }
                $unit_name_y = $pdf->GetY() - $product_y;
                
                $pdf->SetY($product_y);
                if(!empty($stock_action[$p])){
                    $pdf->SetX(160);
                    $pdf->MultiCell(40, 6,$stock_action[$p], 0, 'C');
                } else {
                    $pdf->SetX(160);
                    $pdf->Cell(40, 6,' - ',0, 0, 'C');
                }
                $stock_action_y = $pdf->GetY() - $product_y;

                $y_array = array($product_name_y, $qty_y, $unit_name_y, $stock_action_y);
                $product_max = max($y_array);
                // print_r($y_array);
                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(15,$product_max,'',1,0,'C');
                $pdf->Cell(65,$product_max,'',1,0,'C');
                $pdf->Cell(30,$product_max,'',1,0,'C');
                $pdf->Cell(40,$product_max,'',1,0,'C');
                $pdf->Cell(40,$product_max,'',1,1,'C');
                $product_y += $product_max;
                $s_no++;
            }
            
            $end_y = $pdf->GetY();
            $last_page_count = $s_no - $last_count;
            if (($footer_height + $end_y) > 270) {
                $y = $pdf->GetY();
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                // $pdf->Cell(10, 270 - $y_axis, '', 1, 0, 'C', 0);
                // $pdf->Cell(30, 270 - $y_axis, '', 1, 0, 'C', 0);
                // $pdf->Cell(30, 270 - $y_axis, '', 1, 0, 'C', 0);
                // $pdf->Cell(30, 270 - $y_axis, '', 1, 0, 'C', 0);
                // $pdf->Cell(30, 270 - $y_axis, '', 1, 0, 'C', 0);
                // $pdf->Cell(30, 270 - $y_axis, '', 1, 0, 'C', 0);
                // $pdf->Cell(30, 270 - $y_axis, '', 1, 1, 'C', 0);

                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(-15);
                $pdf->SetX(10);
                $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $pdf->SetTitle('Stock Adjustment');
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetFont('Arial', 'BI', 10);

                $height = 0;
                $display = '';
                $y2 = $pdf->GetY();
                $y = $pdf->GetY();
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetY(11);

                $file_name="Stock Adjustment";
                include("rpt_header.php");
                if($cancelled == '1') {
                    if(file_exists('../include/images/cancelled.jpg')) {
                        $pdf->SetAlpha(0.3);
                        $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                        $pdf->SetAlpha(1);
                    }
                }
                $bill_to_y = $pdf->GetY();
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetX(10);
                $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                $pdf->Cell(90, 4, 'Stock Adjustment Date : ', 0, 0, 'L', 0);
                $pdf->SetFont('Arial', '', 9);
                $pdf->SetX(50);
                $pdf->Cell(20, 4,date('d-m-Y',strtotime($stock_adjustment_date)), 0, 1, 'L', 0);
                $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetX(12);

                $bill_to_y1 = $pdf->GetY();

                $pdf->SetY($bill_to_y);
                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(0, 1, '', 0, 1, 'C', 0);

                $pdf->SetFont('Arial', '', 9);

                $pdf->SetX(110);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(95, 4, 'Stock Adjustment No : ', 0, 0, 'L', 0);

                $pdf->SetFont('Arial', '', 9);
                $pdf->SetX(145);
                $pdf->Cell(20, 4, $stock_adjustment_number, 0, 1, 'L', 0);
                $bill_to_y2 = $pdf->GetY();
                $y_array = array($bill_to_y1, $bill_to_y2);
                $max_bill_y = max($y_array);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

                $bill_to_y = $pdf->GetY();
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetX(10);
                $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                $pdf->Cell(90, 4, 'Store Room : ', 0, 0, 'L', 0);
                $pdf->SetFont('Arial', '', 9);
                $pdf->SetX(40);
                $pdf->Cell(20, 4,$obj->encode_decode('decrypt', $first_store), 0, 1, 'L', 0);
                $pdf->Cell(0, 2, '', 0, 1, 'L', 0); 

                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->cell(0,6, '', 1, 1, 'L', 0);


                $header_height = $max_bill_y - 10;
                $address_height = $max_bill_y - $bill_to_y;
            
                
                $starting_y = $pdf->GetY();
                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetFillColor(101,114,122);
                $pdf->SetTextColor(255,255,255);
                $pdf->SetX(10);
                $pdf->Cell(15, 7, 'S.No', 1, 0, 'C', 1);
                $pdf->Cell(65, 7, 'Products', 1, 0, 'C', 1);
                $pdf->Cell(30, 7, 'Quantity', 1, 0, 'C', 1);
                $pdf->Cell(40, 7, 'Unit', 1, 0, 'C', 1);
                $pdf->Cell(40, 7, 'Stock Action', 1, 1, 'C', 1);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetFont('Arial', '', 8);

                $y_axis = $pdf->GetY();
                $content_height = 269 - $footer_height;

                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(15, $content_height - $y_axis, '', 1, 0);
                $pdf->Cell(65, $content_height - $y_axis, '', 1, 0);
                $pdf->Cell(30, $content_height - $y_axis, '', 1, 0);
                $pdf->Cell(40, $content_height - $y_axis, '', 1, 0);
                $pdf->Cell(40, $content_height - $y_axis, '', 1, 1);
                $pdf->SetY($content_height);

            }
            $max_page = max($total_pages);
            $pdf->SetY($y_axis);
            $pdf->SetX(10);

            $pdf->Cell(15, 186 + $height, '', 1, 0);
            $pdf->Cell(65, 186 + $height, '', 1, 0);
            $pdf->Cell(30, 186 + $height, '', 1, 0);
            $pdf->Cell(40, 186 + $height, '', 1, 0);
            $pdf->Cell(40, 186 + $height, '', 1, 1);
                
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetX(10);

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetX(10);
            $pdf->Cell(80, 5, 'Total Qty', 1, 0, 'R', 0);
            $pdf->Cell(30, 5, $total_quantity." ", 1, 0, 'R', 0);
            $pdf->Cell(0, 5, '', 1, 1, 'R', 0);

            
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

            $pdf->SetY($line_y+15);
            $pdf->SetX(155);
            $pdf->Cell(90, 5, 'Authorized Signatory', 0, 1, 'L', 0);

            $pdf->SetFont('Arial', '', 7);
            $pdf->SetY(10);
            $pdf->SetX(10);
            $pdf->Cell(190, 270, '', 1, 0, 'C');


            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(-15);
            $pdf->SetX(10);
            $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

        }

        $pdf->OutPut('', $stock_adjustment_number);
    }
?>