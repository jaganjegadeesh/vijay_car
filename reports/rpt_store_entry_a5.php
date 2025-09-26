<?php 
    include("../include_user_check_and_files.php");
    $view_store_entry_id = "";
    if (isset($_REQUEST['view_store_entry_id'])) {
        $view_store_entry_id = $_REQUEST['view_store_entry_id'];
    } else {
        header("Location: ../store_entry.php");
        exit;
    }
    if(isset($_REQUEST['view_store_entry_id'])) { 
        $store_entry_date = date('Y-m-d'); $current_date = date('Y-m-d');$store_entry_number = ""; $job_card_id = ""; $job_card_number = "";
        $remarks = ""; $store_store_ids = ""; $store_store_names = ""; $store_type = "";  $store_ids = array(); $unit_names = array();$quantity = array();$total_quantity = array();$unit_ids = array(); $product_ids = array(); $product_names = array(); $product_count = 0; $store_names = array();
        $store_entry_list = array();  $overall_store = ""; $overall_store_name = "";
        $store_entry_list = $obj->getTableRecords($GLOBALS['store_entry_table'], 'store_entry_id', $view_store_entry_id, '');
        if(!empty($store_entry_list)) {
            foreach($store_entry_list as $data) {
                if(!empty($data['store_entry_date'])) {
                    $store_entry_date = date('Y-m-d', strtotime($data['store_entry_date']));
                }
                if(!empty($data['store_entry_number']) && $data['store_entry_number'] != $GLOBALS['null_value']) {
                    $store_entry_number = $data['store_entry_number'];
                }
                if(!empty($data['job_card_id']) && $data['job_card_id'] != $GLOBALS['null_value']) {
                    $job_card_id = $data['job_card_id'];
                }
                if(!empty($data['job_card_number']) && $data['job_card_number'] != $GLOBALS['null_value']) {
                    $job_card_number = $data['job_card_number'];
                }
                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                    $remarks = $data['remarks'];
                }
                if(!empty($data['store_id']) && $data['store_id'] != $GLOBALS['null_value']) {
                    $store_store_ids = $data['store_id'];
                }
                if(!empty($data['store_name']) && $data['store_name'] != $GLOBALS['null_value']) {
                    $store_store_names = $data['store_name'];
                }          
                if(!empty($data['store_type']) && $data['store_type'] != $GLOBALS['null_value']) {
                    $store_type = $data['store_type'];
                }
                if(!empty($data['store_id']) && $data['store_id'] != $GLOBALS['null_value']) {
                    $store_ids = $data['store_id'];
                    $store_ids = explode(",", $store_ids);
                    $store_ids = array_reverse($store_ids);
                }         
                 if(!empty($data['store_name']) && $data['store_name'] != $GLOBALS['null_value']) {
                    $store_names = $data['store_name'];
                    $store_names = explode(",", $store_names);
                    $overall_store = $data['store_name']; 
                    $overall_store_name = $store_names[0];
                    $store_names = array_reverse($store_names);
                }         
                
                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                    $product_ids = $data['product_id'];
                    $product_ids = explode(",", $product_ids);
                    $product_count = count($product_ids);
                    $product_ids = array_reverse($product_ids);
                }
                if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                    $product_names = $data['product_name'];
                    $product_names = explode(",", $product_names);
                    $product_names = array_reverse($product_names);
                }
                if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                    $unit_ids = $data['unit_id'];
                    $unit_ids = explode(",", $unit_ids);
                    $unit_ids = array_reverse($unit_ids);
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

            }
        }
        $company_name = "";
        $company_name = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'name');
        if(!empty($company_name) && $company_name != $GLOBALS['null_value']){
            $company_name = $obj->encode_decode('decrypt', $company_name);
        } 
        $company_list = array(); $company_details = "";
        $company_list = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'company_details');
        if(!empty($company_list)){
            $company_details =html_entity_decode($obj->encode_decode('decrypt',$company_list));
            $company_details = explode("$$$", $company_details);
        }

        require_once('../fpdf/AlphaPDF.php');
        $pdf = new AlphaPDF('P', 'mm', 'A5');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetTitle('Store Entry');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFont('Arial', 'BI', 10);

        $height = 0;
        $display = '';
        $y2 = $pdf->GetY();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY(11);

        $file_name="Store Entry";
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

        if($store_type == "1"){
           $bill_to_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(10);
            $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
            $pdf->Cell(40, 4, 'Store Entry Date : ', 0, 0, 'L', 0);
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetX(50);
            $pdf->Cell(20, 4,date('d-m-Y',strtotime($store_entry_date)), 0, 1, 'L', 0);
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

            $pdf->Cell(40, 4, 'Job Card No : ', 0, 0, 'L', 0);

            $pdf->SetFont('Arial', '', 9);
            $pdf->SetX(117);
            $pdf->Cell(20, 4, $job_card_number, 0, 1, 'L', 0);
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
            $pdf->Cell(40, 4, 'Store Room : ', 0, 0, 'L', 0);
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetX(50);
            $pdf->Cell(20, 4,$obj->encode_decode('decrypt', $overall_store_name), 0, 1, 'L', 0);
            $pdf->Cell(0, 1, '', 0, 1, 'L', 0);  
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->cell(0,6, '', 1, 1, 'L', 0);

        }else{
            $bill_to_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(10);
            $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
            $pdf->Cell(40, 4, 'Store Entry Date : ', 0, 0, 'L', 0);
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetX(50);
            $pdf->Cell(20, 4,date('d-m-Y',strtotime($store_entry_date)), 0, 1, 'L', 0);
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

            $pdf->Cell(40, 4, 'Job Card No : ', 0, 0, 'L', 0);

            $pdf->SetFont('Arial', '', 9);
            $pdf->SetX(117);
            $pdf->Cell(20, 4, $job_card_number, 0, 1, 'L', 0);
            $bill_to_y2 = $pdf->GetY();
            $y_array = array($bill_to_y1, $bill_to_y2);
            $max_bill_y = max($y_array);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

        }

       
        $header_height = $max_bill_y - 10;
        $address_height = $max_bill_y - $bill_to_y;

        // if($store_type  ==  "1"){

        // }

        $starting_y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(101,114,122);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetX(10);
        $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
        if($store_type == "1"){
             $pdf->Cell(50, 7, 'Product', 1, 0, 'C', 1);
            $pdf->Cell(40, 7, 'Unit', 1, 0, 'C', 1);
            $pdf->Cell(0, 7, 'Quantity', 1, 1, 'C', 1);

        }else{
            $pdf->Cell(35, 7, 'Store Name', 1, 0, 'C', 1);
            $pdf->Cell(40, 7, 'Product Name', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'Unit', 1, 0, 'C', 1);
            $pdf->Cell(0, 7, 'Quantity', 1, 1, 'C', 1);
        }
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
        if (!empty($view_store_entry_id) && !empty($product_ids)) {
            for ($p = 0; $p < count($product_ids); $p++) {
                if ($pdf->GetY() >= 190) {
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 9);
                    $next_page = $pdf->PageNo() + 1;
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(-15);
                    $pdf->SetX(10);
                    $pdf->Cell(0,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);
                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $p + 1;
                    $pdf->SetTitle('Store Entry');
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetFont('Arial', 'BI', 10);

                    $height = 0;
                    $display = '';
                    $y2 = $pdf->GetY();
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->SetY(11);
                    $file_name="Store Entry";
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

                    if($store_type == "1"){
                        $bill_to_y = $pdf->GetY();
                        $pdf->SetFont('Arial', 'B', 9);
                        $pdf->SetX(10);
                        $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                        $pdf->Cell(40, 4, 'Store Entry Date : ', 0, 0, 'L', 0);
                        $pdf->SetFont('Arial', '', 9);
                        $pdf->SetX(50);
                        $pdf->Cell(20, 4,date('d-m-Y',strtotime($store_entry_date)), 0, 1, 'L', 0);
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

                        $pdf->Cell(40, 4, 'Job Card No : ', 0, 0, 'L', 0);

                        $pdf->SetFont('Arial', '', 9);
                        $pdf->SetX(117);
                        $pdf->Cell(20, 4, $job_card_number, 0, 1, 'L', 0);
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
                        $pdf->Cell(40, 4, 'Store Room : ', 0, 0, 'L', 0);
                        $pdf->SetFont('Arial', '', 9);
                        $pdf->SetX(50);
                        $pdf->Cell(20, 4,$obj->encode_decode('decrypt', $overall_store_name), 0, 1, 'L', 0);
                        $pdf->Cell(0, 1, '', 0, 1, 'L', 0);  
                        $pdf->SetY($bill_to_y);
                        $pdf->SetX(10);
                        $pdf->cell(0,6, '', 1, 1, 'L', 0);

                    }else{
                        $bill_to_y = $pdf->GetY();
                        $pdf->SetFont('Arial', 'B', 9);
                        $pdf->SetX(10);
                        $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                        $pdf->Cell(40, 4, 'Store Entry Date : ', 0, 0, 'L', 0);
                        $pdf->SetFont('Arial', '', 9);
                        $pdf->SetX(50);
                        $pdf->Cell(20, 4,date('d-m-Y',strtotime($store_entry_date)), 0, 1, 'L', 0);
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

                        $pdf->Cell(40, 4, 'Job Card No : ', 0, 0, 'L', 0);

                        $pdf->SetFont('Arial', '', 9);
                        $pdf->SetX(117);
                        $pdf->Cell(20, 4, $job_card_number, 0, 1, 'L', 0);
                        $bill_to_y2 = $pdf->GetY();
                        $y_array = array($bill_to_y1, $bill_to_y2);
                        $max_bill_y = max($y_array);
                        $pdf->SetY($bill_to_y);
                        $pdf->SetX(10);
                        $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

                    }

                
                    $header_height = $max_bill_y - 10;
                    $address_height = $max_bill_y - $bill_to_y;

                    // if($store_type  ==  "1"){

                    // }

                    $starting_y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->SetFillColor(101,114,122);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetX(10);
                    $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
                    if($store_type == "1"){
                        $pdf->Cell(50, 7, 'Product', 1, 0, 'C', 1);
                        $pdf->Cell(40, 7, 'Unit', 1, 0, 'C', 1);
                        $pdf->Cell(0, 7, 'Quantity', 1, 1, 'C', 1);

                    }else{
                        $pdf->Cell(35, 7, 'Store Name', 1, 0, 'C', 1);
                        $pdf->Cell(40, 7, 'Product Name', 1, 0, 'C', 1);
                        $pdf->Cell(25, 7, 'Unit', 1, 0, 'C', 1);
                        $pdf->Cell(0, 7, 'Quantity', 1, 1, 'C', 1);
                    }
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
                if(!empty($store_names[$p])){
                    $store_names[$p] = trim($store_names[$p]);
                    $store_names[$p] = $obj->encode_decode('decrypt', $store_names[$p]);
                }
                $y = $pdf->GetY();
                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(10, 6, $s_no, 0, 0, 'L', 0);

                if($store_type == "1"){
                     $pdf->SetY($product_y);
                    if(!empty($product_names[$p])){
                        $pdf->SetX(20);
                        $pdf->MultiCell(50, 6, $product_names[$p], 0, 'L');
                    } else {
                        $pdf->SetX(20);
                        $pdf->Cell(50, 6,' - ',0,0, 'C');
                    }
                    $product_name_y = $pdf->GetY() - $product_y;

                    $pdf->SetY($product_y);
                    if(!empty($unit_names[$p])){
                        $pdf->SetX(70);
                        $pdf->MultiCell(40, 6,$unit_names[$p], 0, 'C');
                    } else {
                        $pdf->SetX(70);
                        $pdf->Cell(40, 6,' - ',0, 0, 'C');
                    }
                    $unit_name_y = $pdf->GetY() - $product_y;


                    $pdf->SetY($product_y);
                    if(!empty($quantity[$p])){
                        $pdf->SetX(110);
                        $pdf->MultiCell(0, 6,$quantity[$p], 0, 'R');
                    } else {
                        $pdf->SetX(110);
                        $pdf->Cell(0, 6,' - ',0,0, 'C');
                    }
                    $qty_y = $pdf->GetY() - $product_y;
                    $y_array = array($product_name_y, $qty_y, $unit_name_y);

                }else{
                    $pdf->SetY($product_y);
                    if(!empty($store_names[$p])){
                        $pdf->SetX(20);
                        $pdf->MultiCell(35, 6, $store_names[$p], 0, 'L');
                    } else {
                        $pdf->SetX(20);
                        $pdf->Cell(35, 6,' - ',0,0, 'C');
                    }
                    $store_name_y = $pdf->GetY() - $product_y;

                    $pdf->SetY($product_y);
                    if(!empty($product_names[$p])){
                        $pdf->SetX(55);
                        $pdf->MultiCell(40, 6, $product_names[$p], 0, 'L');
                    } else {
                        $pdf->SetX(40);
                        $pdf->Cell(55, 6,' - ',0,0, 'C');
                    }
                    $product_name_y = $pdf->GetY() - $product_y;

                    $pdf->SetY($product_y);
                    if(!empty($unit_names[$p])){
                        $pdf->SetX(95);
                        $pdf->MultiCell(25, 6,$unit_names[$p], 0, 'C');
                    } else {
                        $pdf->SetX(95);
                        $pdf->Cell(25, 6,' - ',0, 0, 'C');
                    }
                    $unit_name_y = $pdf->GetY() - $product_y;

                    $pdf->SetY($product_y);
                    if(!empty($quantity[$p])){
                        $pdf->SetX(120);
                        $pdf->MultiCell(0, 6,$quantity[$p], 0, 'R');
                    } else {
                        $pdf->SetX(120);
                        $pdf->Cell(0, 6,' - ',0,0, 'C');
                    }
                    $qty_y = $pdf->GetY() - $product_y;

                    $y_array = array($store_name_y, $product_name_y, $qty_y, $unit_name_y);

                }

                $product_max = max($y_array);
                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(10,$product_max,'',1,0,'C');
                if($store_type == "1"){
                    $pdf->Cell(50,$product_max,'',1,0,'C');
                    $pdf->Cell(40,$product_max,'',1,0,'C');
                    $pdf->Cell(0,$product_max,'',1,1,'C');
                    
                }else{
                    $pdf->Cell(35,$product_max,'',1,0,'C');
                    $pdf->Cell(40,$product_max,'',1,0,'C');
                    $pdf->Cell(25,$product_max,'',1,0,'C');
                    $pdf->Cell(0,$product_max,'',1,1,'C');
                }
                
                $product_y += $product_max;
                $s_no++;

            }   
        }
        $end_y = $pdf->GetY();
        $last_page_count = $s_no - $last_count;
        if (($footer_height + $end_y) > 195) {
            $y = $pdf->GetY();
            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(-15);
            $pdf->SetX(10);
            $pdf->Cell(0,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);
            $pdf->SetTitle('Store Entry');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFont('Arial', 'BI', 10);
            $height = 0;
            $display = '';
            $y2 = $pdf->GetY();
            $y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetY(11);

            
            $file_name="Store Entry";
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

            if($store_type == "1"){
                $bill_to_y = $pdf->GetY();
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetX(10);
                $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                $pdf->Cell(40, 4, 'Store Entry Date : ', 0, 0, 'L', 0);
                $pdf->SetFont('Arial', '', 9);
                $pdf->SetX(50);
                $pdf->Cell(20, 4,date('d-m-Y',strtotime($store_entry_date)), 0, 1, 'L', 0);
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

                $pdf->Cell(40, 4, 'Job Card No : ', 0, 0, 'L', 0);

                $pdf->SetFont('Arial', '', 9);
                $pdf->SetX(117);
                $pdf->Cell(20, 4, $job_card_number, 0, 1, 'L', 0);
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
                $pdf->Cell(40, 4, 'Store Room : ', 0, 0, 'L', 0);
                $pdf->SetFont('Arial', '', 9);
                $pdf->SetX(50);
                $pdf->Cell(20, 4,$obj->encode_decode('decrypt', $overall_store_name), 0, 1, 'L', 0);
                $pdf->Cell(0, 1, '', 0, 1, 'L', 0);  
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->cell(0,6, '', 1, 1, 'L', 0);

            }else{
                $bill_to_y = $pdf->GetY();
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetX(10);
                $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
                $pdf->Cell(40, 4, 'Store Entry Date : ', 0, 0, 'L', 0);
                $pdf->SetFont('Arial', '', 9);
                $pdf->SetX(50);
                $pdf->Cell(20, 4,date('d-m-Y',strtotime($store_entry_date)), 0, 1, 'L', 0);
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

                $pdf->Cell(40, 4, 'Job Card No : ', 0, 0, 'L', 0);

                $pdf->SetFont('Arial', '', 9);
                $pdf->SetX(117);
                $pdf->Cell(20, 4, $job_card_number, 0, 1, 'L', 0);
                $bill_to_y2 = $pdf->GetY();
                $y_array = array($bill_to_y1, $bill_to_y2);
                $max_bill_y = max($y_array);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);

            }

        
            $header_height = $max_bill_y - 10;
            $address_height = $max_bill_y - $bill_to_y;

            // if($store_type  ==  "1"){

            // }

            $starting_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(101,114,122);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetX(10);
            $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
            if($store_type == "1"){
                $pdf->Cell(50, 7, 'Product', 1, 0, 'C', 1);
                $pdf->Cell(40, 7, 'Unit', 1, 0, 'C', 1);
                $pdf->Cell(0, 7, 'Quantity', 1, 1, 'C', 1);

            }else{
                $pdf->Cell(35, 7, 'Store Name', 1, 0, 'C', 1);
                $pdf->Cell(40, 7, 'Product Name', 1, 0, 'C', 1);
                $pdf->Cell(25, 7, 'Unit', 1, 0, 'C', 1);
                $pdf->Cell(0, 7, 'Quantity', 1, 1, 'C', 1);
            }
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial', '', 8);
            $y_axis = $pdf->GetY();
            if($store_type == "1"){
                $content_height = 198 - $footer_height;
            }else{
                $content_height = 197 - $footer_height;

            }
            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            $pdf->Cell(10, $content_height - $y_axis, '', 1, 0);
            if($store_type == "1"){
                $pdf->Cell(50, $content_height - $y_axis, '', 1, 0);
                $pdf->Cell(40, $content_height - $y_axis, '', 1, 0);
                $pdf->Cell(0, $content_height - $y_axis, '', 1, 1);

            }else{
                 $pdf->Cell(35, $content_height - $y_axis, '', 1, 0);
                $pdf->Cell(40, $content_height - $y_axis, '', 1, 0);
                $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
                $pdf->Cell(0, $content_height - $y_axis, '', 1, 1);
            }
           
            
            $pdf->SetY($content_height);
        }
        $max_page = max($total_pages);
        $pdf->SetY($y_axis);
        $pdf->SetX(10);

        if($store_type == "1"){
            $pdf->Cell(10, 105 + $height, '', 1, 0);
            $pdf->Cell(50, 105 + $height, '', 1, 0);
            $pdf->Cell(40, 105 + $height, '', 1, 0);
            $pdf->Cell(0, 105 + $height, '', 1, 1);

        }else{
            $pdf->Cell(10, 110 + $height, '', 1, 0);
            $pdf->Cell(35, 110 + $height, '', 1, 0);
            $pdf->Cell(40, 110 + $height, '', 1, 0);
            $pdf->Cell(25, 110 + $height, '', 1, 0);
            $pdf->Cell(0, 110 + $height, '', 1, 1);

        }
      

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(10);
        if($store_type == "1"){
            $pdf->Cell(100, 5, 'Total Qty', 1, 0, 'R', 0);
            $pdf->Cell(0, 5, $quantity_total." ", 1, 1, 'R', 0);

        }else{
            $pdf->Cell(110, 5, 'Total Qty', 1, 0, 'R', 0);
            $pdf->Cell(0, 5, $quantity_total." ", 1, 1, 'R', 0);
        }
        
      

        $line_y = $pdf->GetY();

            $pdf->SetFont('Arial', 'BU', 8);
            $pdf->SetX(10);
            $pdf->SetY($line_y);
            $pdf->SetX(30);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetY($line_y+2);
            $pdf->SetX(15);
            $remarks_y = $pdf->GetY();
            $pdf->MultiCell(40, 6,'Remarks  :  '.$obj->encode_decode('decrypt', $remarks),  0, 'L', 0);
            $pdf->SetY($remarks_y);
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
    

        $pdf->OutPut('', $store_entry_number);


        
    }

?>