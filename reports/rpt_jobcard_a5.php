<?php
    include("../include_user_check_and_files.php");
    include("../include/number2words.php");
     $view_job_card_id = "";
    if (isset($_REQUEST['view_job_card_id'])) {
        $view_job_card_id = $_REQUEST['view_job_card_id'];
        $view_job_card_id = trim($view_job_card_id);
    } else {
        header("Location: ../job_card.php");
        exit;
    }

    $job_card_date = date('Y-m-d'); $current_date = date('Y-m-d'); $job_card_number = ""; $party_id = ""; $department_id = ""; $engineer_id = ""; $vehicle_no = "";
    $vehicle_id = ""; $work_details = ""; $cancelled = 0; $department_name = "";
    
    if(isset($_REQUEST['view_job_card_id'])) { 
        $job_card_list =  array();
        $job_card_list = $obj->getTableRecords($GLOBALS['job_card_table'], 'job_card_id', $view_job_card_id, '');   
        if(!empty($job_card_list)) {
            foreach($job_card_list as $data) {
                if(!empty($data['job_card_date'])) {
                    $job_card_date = date('Y-m-d', strtotime($data['job_card_date']));
                }
                if(!empty($data['job_card_number']) && $data['job_card_number'] != $GLOBALS['null_value']) {
                    $job_card_number = $data['job_card_number'];
                }
                if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                    $party_id = $data['party_id'];
                }
                if(!empty($data['department_id']) && $data['department_id'] != $GLOBALS['null_value']) {
                    $department_id = $data['department_id'];
                }
                if(!empty($data['department_name']) && $data['department_name'] != $GLOBALS['null_value']) {
                    $department_name = $data['department_name'];
                }
                if(!empty($data['engineer_id']) && $data['engineer_id'] != $GLOBALS['null_value']) {
                    $engineer_id = $data['engineer_id'];
                    $engineer_id = explode(",", $engineer_id);
                    $product_count = count($engineer_id);
                    $engineer_id = array_reverse($engineer_id);
                }
                if(!empty($data['vehicle_id']) && $data['vehicle_id'] != $GLOBALS['null_value']) {
                    $vehicle_id = $data['vehicle_id'];
                }
                if(!empty($data['vehicle_no']) && $data['vehicle_no'] != $GLOBALS['null_value']) {
                    $vehicle_no = $data['vehicle_no'];
                }
                if(!empty($data['vehicle_details']) && $data['vehicle_details'] != $GLOBALS['null_value']) {
                    $vehicle_details = $data['vehicle_details'];
                }
                if(!empty($data['work_details']) && $data['work_details'] != $GLOBALS['null_value']) {
                    $work_details = $data['work_details'];
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
        $pdf = new AlphaPDF('P', 'mm', 'A5');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetTitle('Job Card');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFont('Arial', 'BI', 10);
        $height = 0;
        $display = '';
        $y2 = $pdf->GetY();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY(11);
        $file_name="Job Card";
        $company_list = array(); $company_details = "";
        $company_list = $obj->getTableColumnValue($GLOBALS['company_table'], 'primary_company', '1', 'company_details');
        if(!empty($company_list)){
            $company_details =html_entity_decode($obj->encode_decode('decrypt',$company_list));
            $company_details = explode("$$$", $company_details);
        }
        $party_name = "";
        $party_name =  $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'name_mobile_city');
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
        if($cancelled == '1') {
            if(file_exists('../include/images/cancelled.jpg')) {
                $pdf->SetAlpha(0.3);
                $pdf->Image('../include/images/cancelled.jpg',45,85,55,55);
                $pdf->SetAlpha(1);
            }
        }
        $bill_to_y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetX(10);
        $pdf->Cell(0, 1, '', 0, 1, 'L', 0);
        $pdf->Cell(40, 4, 'Job Card Date : ', 0, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetX(35);
        $pdf->Cell(20, 4,date('d-m-Y',strtotime($job_card_date)), 0, 1, 'L', 0);
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
        $pdf->SetX(105);
        $pdf->Cell(20, 4, $job_card_number, 0, 1, 'L', 0);
        $bill_to_y2 = $pdf->GetY();
        $y_array = array($bill_to_y1, $bill_to_y2);
        $max_bill_y = max($y_array);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->cell(0, ($max_bill_y - $bill_to_y), '', 1, 1, 'L', 0);
        $pdf->cell(0,5, '', 0, 1, 'L', 0);

        $page_number = 1;

        $pdf->SetFont('Arial', 'B', 10); 
        $pdf->setX(20);
        $pdf->cell(30, 8, 'Party Name', 0, 0, 'L', 0);
        $pdf->setX(50);
        $pdf->cell(20, 8, ':', 0, 0, 'R', 0);
        $pdf->setX(70);
        $pdf->SetFont('Arial', '', 10); 
        $pdf->MultiCell(0, 8, ''.$obj->encode_decode('decrypt', $party_name), 0, 'L', 0);

        $pdf->setX(20);
        $pdf->SetFont('Arial', 'B', 10); 
        $pdf->cell(30, 8, 'Deparment Name', 0, 0, 'L', 0);
        $pdf->setX(50);
        $pdf->cell(20, 8, ':', 0, 0, 'R', 0);
        $pdf->setX(70);
        $pdf->SetFont('Arial', '', 10); 
        $pdf->MultiCell(0, 8, ''.$obj->encode_decode('decrypt', $department_name), 0, 'L', 0);

        if(!empty($engineer_id) && $engineer_id != $GLOBALS['null_value']) {
            $engineer_names = array();
            for($i = 0; $i < count($engineer_id); $i++){
                $engineer_name = $obj->getTableColumnValue($GLOBALS['engineer_table'], 'engineer_id', $engineer_id[$i], 'engineer_name');
                $engineer_names[$i] = $obj->encode_decode('decrypt',$engineer_name);
            }
            $pdf->setX(20);
            $pdf->SetFont('Arial', 'B', 10); 
            $pdf->cell(30, 8, 'Engineer Name', 0, 0, 'L', 0);
            $pdf->setX(50);
            $pdf->cell(20, 8, ':', 0, 0, 'R', 0);
            $pdf->setX(70);
            $pdf->SetFont('Arial', '', 10); 
            $pdf->MultiCell(0, 8, ''. implode(',', $engineer_names), 0, 'L', 0);
        }

        $pdf->setX(20);
        $pdf->SetFont('Arial', 'B', 10); 
        $pdf->cell(30, 8, 'Vechicle No', 0, 0, 'L', 0);
        $pdf->setX(50);
        $pdf->cell(20, 8, ':', 0, 0, 'R', 0);
        $pdf->setX(70);
        $pdf->SetFont('Arial', '', 10); 
        $pdf->MultiCell(0, 8, ''.$obj->encode_decode('decrypt', $vehicle_no), 0, 'L', 0);

        $pdf->setX(20);
        $pdf->SetFont('Arial', 'B', 10); 
        $pdf->cell(30, 8, 'Vechicle Details', 0, 0, 'L', 0);
        $pdf->setX(50);
        $pdf->cell(20, 8, ':', 0, 0, 'R', 0);
        $pdf->setX(70);
        $pdf->SetFont('Arial', '', 10); 
        $pdf->MultiCell(0, 8, ''.$obj->encode_decode('decrypt', $vehicle_details), 0, 'L', 0);
        if(!empty($work_details)){
            $pdf->SetFont('Arial', 'B', 10); 
            $pdf->setX(20);
            $pdf->cell(30, 8, 'Work Details', 0, 0, 'L', 0);
            $pdf->setX(50);
            $pdf->cell(20, 8, ':', 0, 0, 'R', 0);
            $pdf->setX(70);
            $pdf->SetFont('Arial', '', 10); 
            $pdf->MultiCell(0, 8, ''.$obj->encode_decode('decrypt', $work_details), 0, 'L', 0);
        }


        $pdf->SetFont('Arial', '', 7);
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->Cell(0, 190, '', 1, 0, 'C');

        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(-10);
        $pdf->SetX(10);
        $pdf->Cell(0,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');




        $pdf->OutPut('', $job_card_number);
    }
?>