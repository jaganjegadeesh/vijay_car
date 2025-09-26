<?php
    include("../include_user_check_and_files.php");
    include("../include/number2words.php");

    $view_material_transfer_id = "";
    if (isset($_REQUEST['view_material_transfer_id'])) {
        $view_material_transfer_id = $_REQUEST['view_material_transfer_id'];
        $view_material_transfer_id = trim($view_material_transfer_id);
    } else {
        header("Location: ../material_transfer.php");
        exit;
    }
    if(isset($_REQUEST['view_material_transfer_id'])) { 
        $material_transfer_date = date('Y-m-d'); $current_date = date('Y-m-d');$material_transfer_number = "";$from_location_ids = "";$from_location_names = "";$to_location_ids = "";$to_location_names = ""; $unit_id = "";$unit_names = array();$quantity = array();$total_quantity = array();$unit_ids = array();
        $material_transfer_list = array();
        $material_transfer_list = $obj->getTableRecords($GLOBALS['material_transfer_table'], 'material_transfer_id', $view_material_transfer_id, '');
        if(!empty($material_transfer_list)) {
            foreach($material_transfer_list as $data) {
                if(!empty($data['from_location_id'])) {
                    $from_store_ids = $data['from_location_id'];
                }
                if(!empty($data['to_location_id'])) {
                    $to_store_ids = $data['to_location_id'];
                }                
                if(!empty($data['material_transfer_date'])) {
                    $material_transfer_date = date('Y-m-d', strtotime($data['material_transfer_date']));
                }
                if(!empty($data['material_transfer_number']) && $data['material_transfer_number'] != $GLOBALS['null_value']) {
                    $material_transfer_number = $data['material_transfer_number'];
                }
                if(!empty($data['from_location_id']) && $data['from_location_id'] != $GLOBALS['null_value']) {
                    $from_location_ids = $data['from_location_id'];
                }
                if(!empty($data['to_location_id']) && $data['to_location_id'] != $GLOBALS['null_value']) {
                    $to_location_ids = $data['to_location_id'];
                }
                if(!empty($data['from_location_name']) && $data['from_location_name'] != $GLOBALS['null_value']) {
                    $from_location_names =$obj->encode_decode('decrypt',$data['from_location_name']);
                }
                if(!empty($data['to_location_name']) && $data['to_location_name'] != $GLOBALS['null_value']) {
                    $to_location_names =$obj->encode_decode('decrypt',$data['to_location_name']);
                }

                if(!empty($data['store_name'])) {
                    $store_names = explode(",", $data['store_name']);
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
                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                    $remarks = $obj->encode_decode('decrypt', $data['remarks']);
                }
                if(!empty($data['bill_company_details']) && $data['bill_company_details'] != $GLOBALS['null_value']) {
                     $company_details =html_entity_decode($obj->encode_decode('decrypt',$data['bill_company_details']));
                     $company_details = explode("$$$", $company_details);
                }
            }
        }
        $company_name = "";
        $company_name = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'name');
        if(!empty($company_name) && $company_name != $GLOBALS['null_value']){
            $company_name = $obj->encode_decode('decrypt', $company_name);
        } 

        
        require_once('../fpdf/AlphaPDF.php');
        $pdf = new AlphaPDF('P', 'mm', 'A5');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetTitle('Material Transfer');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFont('Arial', 'BI', 10);

        $height = 0;
        $display = '';
        $y2 = $pdf->GetY();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY(11);

        $file_name="Material Transfer";
        $company_list = array(); $company_details = "";
        $company_list = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'company_details');
        if(!empty($company_list)){
            $company_details =html_entity_decode($obj->encode_decode('decrypt',$company_list));
            $company_details = explode("$$$", $company_details);
        }

        $bill_company_id = $GLOBALS['bill_company_id'];
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,$file_name,1,1,'C',0);
        $y = $pdf->GetY(); 
        $pdf->SetFont('Arial','B',8);
    
        $pdf->SetY($y);
        $pdf->SetX(50);

        if (!empty($company_details)) {
            for ($i = 0; $i < count($company_details); $i++) {
                $company_details[$i] = trim($company_details[$i]);
                if (!empty($company_details[$i]) && $company_details[$i] != $GLOBALS['null_value']) {
                    
                    $company_details[$i] = str_replace("<br>"," ",$company_details[$i]);
                    if ($i === 0) {  // Corrected comparison
                        $pdf->SetFont('Arial', 'B', 11);
                        $pdf->MultiCell(50, 7, html_entity_decode($company_details[$i]), 0, 'C');
                        $rt = $pdf->gety();
                    } elseif (strpos($company_details[$i], "GST") !== false) {
                        $pdf->sety($y);
                        $pdf->setx(104);
                        $pdf->SetFont('Arial', 'B', 8);
                        $pdf->Cell(35, 5, html_entity_decode($company_details[$i]), 0, 1, 'R', 0);
                    } else {
                        $pdf->SetFont('Arial', '', 8);
                        // $pdf->sety($rt);
                        $pdf->SetX(50);
                        $pdf->MultiCell(50, 4, html_entity_decode($company_details[$i]), 0, 'C');
                        $end_y =$pdf->GetY();
                    }
                }
            }
        }
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->Cell(0,($end_y - 10),'',1,1,'C');
        $header_end = $pdf->GetY();
        $pdf->SetY($header_end);

        $bill_to_y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetX(10);
        $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
        $pdf->Cell(40, 4, 'Material Transfer Date : ', 0, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetX(50);
        $pdf->Cell(20, 4,date('d-m-Y',strtotime($material_transfer_date)), 0, 1, 'L', 0);
        $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetX(12);

        $bill_to_y1 = $pdf->GetY();

        $pdf->SetY($bill_to_y);
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(0, 1, '', 0, 1, 'C', 0);

        $pdf->SetFont('Arial', '', 9);

        $pdf->SetX(82);
        $pdf->SetFont('Arial', 'B', 9);

        $pdf->Cell(40, 4, 'Material Transfer No : ', 0, 0, 'L', 0);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetX(117);
        $pdf->Cell(20, 4, $material_transfer_number, 0, 1, 'L', 0);
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
        $pdf->Cell(40, 4, 'From Store : ', 0, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetX(50);
        $pdf->Cell(20, 4,$from_location_names, 0, 1, 'L', 0);
        $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetX(12);
        $bill_to_y1 = $pdf->GetY();

        $pdf->SetY($bill_to_y);
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(0, 1, '', 0, 1, 'C', 0);

        $pdf->SetFont('Arial', '', 9);

        $pdf->SetX(82);
        $pdf->SetFont('Arial', 'B', 9);

        $pdf->Cell(40, 4, 'To Store : ', 0, 0, 'L', 0);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetX(117);
        $pdf->Cell(20, 4, $to_location_names, 0, 1, 'L', 0);
        $bill_to_y2 = $pdf->GetY();
        $y_array = array($bill_to_y1, $bill_to_y2);
        $max_bill_y = max($y_array);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);
        $header_height = $max_bill_y - 10;
        $address_height = $max_bill_y - $bill_to_y;

        $starting_y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(101,114,122);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetX(10);
        $pdf->Cell(15, 7, 'S.No', 1, 0, 'C', 1);
        $pdf->Cell(50, 7, 'Product', 1, 0, 'C', 1);
        $pdf->Cell(30, 7, 'Quantity', 1, 0, 'C', 1);
        $pdf->Cell(0, 7, 'Unit', 1, 1, 'C', 1);
        $pdf->SetTextColor(0,0,0);
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
        $quantity_total = 0;
         if (!empty($view_material_transfer_id) && !empty($product_ids)) {
            for ($p = 0; $p < count($product_ids); $p++) {
                if ($pdf->GetY() >= 180) {
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 9);
                    $next_page = $pdf->PageNo() + 1;
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(-10);
                    $pdf->SetX(10);
                    $pdf->Cell(0,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);
                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $p + 1;
                    $pdf->SetTitle('Material Transfer');
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetFont('Arial', 'BI', 10);

                    $height = 0;
                    $display = '';
                    $y2 = $pdf->GetY();
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->SetY(11);

                    $file_name="Material Transfer";
                    $company_list = array(); $company_details = "";
                    $company_list = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'company_details');
                    if(!empty($company_list)){
                        $company_details =html_entity_decode($obj->encode_decode('decrypt',$company_list));
                        $company_details = explode("$$$", $company_details);
                    }

                    $bill_company_id = $GLOBALS['bill_company_id'];
                    $pdf->SetY(10);
                    $pdf->SetX(10);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(0,7,$file_name,1,1,'C',0);
                    $y = $pdf->GetY(); 
                    $pdf->SetFont('Arial','B',8);
                
                    $pdf->SetY($y);
                    $pdf->SetX(50);

                    if (!empty($company_details)) {
                        for ($i = 0; $i < count($company_details); $i++) {
                            $company_details[$i] = trim($company_details[$i]);
                            if (!empty($company_details[$i]) && $company_details[$i] != $GLOBALS['null_value']) {
                                
                                $company_details[$i] = str_replace("<br>"," ",$company_details[$i]);
                                if ($i === 0) {  // Corrected comparison
                                    $pdf->SetFont('Arial', 'B', 11);
                                    $pdf->MultiCell(50, 7, html_entity_decode($company_details[$i]), 0, 'C');
                                    $rt = $pdf->gety();
                                } elseif (strpos($company_details[$i], "GST") !== false) {
                                    $pdf->sety($y);
                                    $pdf->setx(104);
                                    $pdf->SetFont('Arial', 'B', 8);
                                    $pdf->Cell(35, 5, html_entity_decode($company_details[$i]), 0, 1, 'R', 0);
                                } else {
                                    $pdf->SetFont('Arial', '', 8);
                                    // $pdf->sety($rt);
                                    $pdf->SetX(50);
                                    $pdf->MultiCell(50, 4, html_entity_decode($company_details[$i]), 0, 'C');
                                    $end_y =$pdf->GetY();
                                }
                            }
                        }
                    }
                    $pdf->SetY(10);
                    $pdf->SetX(10);
                    $pdf->Cell(0,($end_y - 10),'',1,1,'C');
                    $header_end = $pdf->GetY();
                    $pdf->SetY($header_end);

                    $bill_to_y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetX(10);
                    $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                    $pdf->Cell(40, 4, 'Material Transfer Date : ', 0, 0, 'L', 0);
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->SetX(50);
                    $pdf->Cell(20, 4,date('d-m-Y',strtotime($material_transfer_date)), 0, 1, 'L', 0);
                    $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetX(12);

                    $bill_to_y1 = $pdf->GetY();

                    $pdf->SetY($bill_to_y);
                    $pdf->SetFont('Arial', 'B', 10);

                    $pdf->Cell(0, 1, '', 0, 1, 'C', 0);

                    $pdf->SetFont('Arial', '', 9);

                    $pdf->SetX(82);
                    $pdf->SetFont('Arial', 'B', 9);

                    $pdf->Cell(40, 4, 'Material Transfer No : ', 0, 0, 'L', 0);

                    $pdf->SetFont('Arial', '', 9);
                    $pdf->SetX(117);
                    $pdf->Cell(20, 4, $material_transfer_number, 0, 1, 'L', 0);
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
                    $pdf->Cell(40, 4, 'From Store : ', 0, 0, 'L', 0);
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->SetX(50);
                    $pdf->Cell(20, 4,$from_location_names, 0, 1, 'L', 0);
                    $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetX(12);
                    $bill_to_y1 = $pdf->GetY();

                    $pdf->SetY($bill_to_y);
                    $pdf->SetFont('Arial', 'B', 10);

                    $pdf->Cell(0, 1, '', 0, 1, 'C', 0);

                    $pdf->SetFont('Arial', '', 9);

                    $pdf->SetX(82);
                    $pdf->SetFont('Arial', 'B', 9);

                    $pdf->Cell(40, 4, 'To Store : ', 0, 0, 'L', 0);

                    $pdf->SetFont('Arial', '', 9);
                    $pdf->SetX(117);
                    $pdf->Cell(20, 4, $to_location_names, 0, 1, 'L', 0);
                    $bill_to_y2 = $pdf->GetY();
                    $y_array = array($bill_to_y1, $bill_to_y2);
                    $max_bill_y = max($y_array);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);
                    $header_height = $max_bill_y - 10;
                    $address_height = $max_bill_y - $bill_to_y;

                    $starting_y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->SetFillColor(101,114,122);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetX(10);
                    $pdf->Cell(15, 7, 'S.No', 1, 0, 'C', 1);
                    $pdf->Cell(50, 7, 'Product', 1, 0, 'C', 1);
                    $pdf->Cell(30, 7, 'Quantity', 1, 0, 'C', 1);
                    $pdf->Cell(0, 7, 'Unit', 1, 1, 'C', 1);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 8);
                    $product_y = $pdf->GetY();
                }
                $quantity[$p] = trim($quantity[$p]);
                $quantity_total += $quantity[$p]; 

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
                    $pdf->MultiCell(50, 6, $product_names[$p], 0, 'L');
                } else {
                    $pdf->SetX(25);
                    $pdf->Cell(50, 6,' - ',0,0, 'C');
                }
                $product_name_y = $pdf->GetY() - $product_y;


                $pdf->SetY($product_y);
                if(!empty($quantity[$p])){
                    $pdf->SetX(75);
                    $pdf->MultiCell(30, 6,$quantity[$p], 0, 'R');
                } else {
                    $pdf->SetX(75);
                    $pdf->Cell(30, 6,' - ',0,0, 'C');
                }
                $qty_y = $pdf->GetY() - $product_y;
                
                $pdf->SetY($product_y);
                if(!empty($unit_names[$p])){
                    $pdf->SetX(105);
                    $pdf->MultiCell(0, 6,$unit_names[$p], 0, 'C');
                } else {
                    $pdf->SetX(105);
                    $pdf->Cell(0, 6,' - ',0, 0, 'C');
                }
                $unit_name_y = $pdf->GetY() - $product_y;

                $y_array = array($product_name_y, $qty_y, $unit_name_y);
                $product_max = max($y_array);

                $pdf->SetY($product_y);
                $pdf->Cell(15,$product_max,'',1,0,'C');
                $pdf->Cell(50,$product_max,'',1,0,'C');
                $pdf->Cell(30,$product_max,'',1,0,'C');
                $pdf->Cell(0,$product_max,'',1,1,'C');

                $product_y += $product_max;
                $s_no++;
            }
        
            
            $end_y = $pdf->GetY();
            $last_page_count = $s_no - $last_count;
            if (($footer_height + $end_y) > 195) {
                $y = $pdf->GetY();
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                // $pdf->Cell(8, 190 - $y_axis, '', 1, 0, 'C', 0);
                // $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
                // $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
                // $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
                // $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
                // $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
                // $pdf->Cell(0, 190 - $y_axis, '', 1, 1, 'C', 0);
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(-10);
                $pdf->SetX(10);
                $pdf->Cell(0,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $pdf->SetTitle('Material Transfer');
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetFont('Arial', 'BI', 10);

                $height = 0;
                $display = '';
                $y2 = $pdf->GetY();
                $y = $pdf->GetY();
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetY(11);

                $file_name="Material Transfer";
                $company_list = array(); $company_details = "";
                $company_list = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'company_details');
                if(!empty($company_list)){
                    $company_details =html_entity_decode($obj->encode_decode('decrypt',$company_list));
                    $company_details = explode("$$$", $company_details);
                }

                $bill_company_id = $GLOBALS['bill_company_id'];
                $pdf->SetY(10);
                $pdf->SetX(10);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(0,7,$file_name,1,1,'C',0);
                $y = $pdf->GetY(); 
                $pdf->SetFont('Arial','B',8);
            
                $pdf->SetY($y);
                $pdf->SetX(50);

                if (!empty($company_details)) {
                    for ($i = 0; $i < count($company_details); $i++) {
                        $company_details[$i] = trim($company_details[$i]);
                        if (!empty($company_details[$i]) && $company_details[$i] != $GLOBALS['null_value']) {
                            
                            $company_details[$i] = str_replace("<br>"," ",$company_details[$i]);
                            if ($i === 0) {  // Corrected comparison
                                $pdf->SetFont('Arial', 'B', 11);
                                $pdf->MultiCell(50, 7, html_entity_decode($company_details[$i]), 0, 'C');
                                $rt = $pdf->gety();
                            } elseif (strpos($company_details[$i], "GST") !== false) {
                                $pdf->sety($y);
                                $pdf->setx(104);
                                $pdf->SetFont('Arial', 'B', 8);
                                $pdf->Cell(35, 5, html_entity_decode($company_details[$i]), 0, 1, 'R', 0);
                            } else {
                                $pdf->SetFont('Arial', '', 8);
                                // $pdf->sety($rt);
                                $pdf->SetX(50);
                                $pdf->MultiCell(50, 4, html_entity_decode($company_details[$i]), 0, 'C');
                                $end_y =$pdf->GetY();
                            }
                        }
                    }
                }
                $pdf->SetY(10);
                $pdf->SetX(10);
                $pdf->Cell(0,($end_y - 10),'',1,1,'C');
                $header_end = $pdf->GetY();
                $pdf->SetY($header_end);

                $bill_to_y = $pdf->GetY();
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetX(10);
                $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                $pdf->Cell(40, 4, 'Material Transfer Date : ', 0, 0, 'L', 0);
                $pdf->SetFont('Arial', '', 9);
                $pdf->SetX(50);
                $pdf->Cell(20, 4,date('d-m-Y',strtotime($material_transfer_date)), 0, 1, 'L', 0);
                $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetX(12);

                $bill_to_y1 = $pdf->GetY();

                $pdf->SetY($bill_to_y);
                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(0, 1, '', 0, 1, 'C', 0);

                $pdf->SetFont('Arial', '', 9);

                $pdf->SetX(82);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(40, 4, 'Material Transfer No : ', 0, 0, 'L', 0);

                $pdf->SetFont('Arial', '', 9);
                $pdf->SetX(117);
                $pdf->Cell(20, 4, $material_transfer_number, 0, 1, 'L', 0);
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
                $pdf->Cell(40, 4, 'From Store : ', 0, 0, 'L', 0);
                $pdf->SetFont('Arial', '', 9);
                $pdf->SetX(50);
                $pdf->Cell(20, 4,$from_location_names, 0, 1, 'L', 0);
                $pdf->Cell(0, 2, '', 0, 1, 'L', 0);

                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetX(12);
                $bill_to_y1 = $pdf->GetY();

                $pdf->SetY($bill_to_y);
                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(0, 1, '', 0, 1, 'C', 0);

                $pdf->SetFont('Arial', '', 9);

                $pdf->SetX(82);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(40, 4, 'To Store : ', 0, 0, 'L', 0);

                $pdf->SetFont('Arial', '', 9);
                $pdf->SetX(117);
                $pdf->Cell(20, 4, $to_location_names, 0, 1, 'L', 0);
                $bill_to_y2 = $pdf->GetY();
                $y_array = array($bill_to_y1, $bill_to_y2);
                $max_bill_y = max($y_array);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);
                $header_height = $max_bill_y - 10;
                $address_height = $max_bill_y - $bill_to_y;

                $starting_y = $pdf->GetY();
                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetFillColor(101,114,122);
                $pdf->SetTextColor(255,255,255);
                $pdf->SetX(10);
                $pdf->Cell(15, 7, 'S.No', 1, 0, 'C', 1);
                $pdf->Cell(50, 7, 'Product', 1, 0, 'C', 1);
                $pdf->Cell(30, 7, 'Quantity', 1, 0, 'C', 1);
                $pdf->Cell(0, 7, 'Unit', 1, 1, 'C', 1);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetFont('Arial', '', 8);

                $y_axis = $pdf->GetY();
                $content_height = 199 - $footer_height;

                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(15, $content_height - $y_axis, '', 1, 0);
                $pdf->Cell(50, $content_height - $y_axis, '', 1, 0);
                $pdf->Cell(30, $content_height - $y_axis, '', 1, 0);
                $pdf->Cell(0, $content_height - $y_axis, '', 1, 1);
                $pdf->SetY($content_height);
            }

            $max_page = max($total_pages);
            $pdf->SetY($y_axis);
            $pdf->SetX(10);

            $pdf->Cell(15, 105 + $height, '', 1, 0);
            $pdf->Cell(50, 105 + $height, '', 1, 0);
            $pdf->Cell(30, 105 + $height, '', 1, 0);
            $pdf->Cell(0, 105 + $height, '', 1, 1);

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetX(10);
            $pdf->Cell(65, 5, 'Total Qty', 1, 0, 'R', 0);
            $pdf->Cell(30, 5, $quantity_total." ", 1, 0, 'R', 0);
            $pdf->Cell(0, 5, '', 1, 1, 'R', 0);


            $line_y = $pdf->GetY();

            $pdf->SetFont('Arial', 'BU', 8);
            $pdf->SetX(10);
            $pdf->SetY($line_y);
            $pdf->SetX(30);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetY($line_y+2);
            $pdf->SetX(100);
            $pdf->MultiCell(40, 5,html_entity_decode($company_name), 0, 'L', 0);
            $pdf->SetFont('Arial', '', 9);

            $pdf->SetY($line_y+15);
            $pdf->SetX(100);
            $pdf->Cell(60, 5, 'Authorized Signatory', 0, 1, 'L', 0);

            $pdf->SetFont('Arial', '', 7);
            $pdf->SetY(10);
            $pdf->SetX(10);
            $pdf->Cell(0, 190, '', 1, 0, 'C');

            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(-10);
            $pdf->SetX(10);
            $pdf->Cell(0,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    

        }


        $pdf->OutPut('', $material_transfer_number);
        
    }


?>