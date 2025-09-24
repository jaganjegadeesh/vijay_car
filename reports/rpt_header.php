<?php
    $pdf->SetTitle($file_name);
 
    $pdf->SetFont('Arial','B',9);
    
    $company_logo = "";
    $company_logo = $obj->getTableColumnValue($GLOBALS['company_table'],'primary_company','1','logo');
    
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


    $pdf->Cell(190,7,$file_name,1,1,'C',0);
    $y = $pdf->GetY(); 
    $pdf->SetFont('Arial','B',8);
    
    $pdf->SetY($y);
    $pdf->SetX(50);

    if (!empty($company_details)) {
        for ($c = 0; $c < count($company_details); $c++) {
            $company_details[$c] = trim($company_details[$c]);
            if (!empty($company_details[$c]) && $company_details[$c] != $GLOBALS['null_value']) {
                
                if ($c === 0) {  // Corrected comparison
                    $pdf->SetFont('Arial', 'B', 11);
                    $pdf->MultiCell(110, 7, $company_details[$c], 0, 'C');
                    $rt = $pdf->gety();
                } elseif (strpos($company_details[$c], "GST") !== false) {
                    $pdf->sety($y);
                    $pdf->setx(164);
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->Cell(35, 5, $company_details[$c], 0, 1, 'R', 0);
                } else {
                    $pdf->SetFont('Arial', '', 8);
                    // $pdf->sety($rt);
                    $pdf->SetX(50);
                    $pdf->MultiCell(110, 4, $company_details[$c], 0, 'C');
                    $end_y =$pdf->GetY();
                }
            }
        }
    }

    if(!empty($company_logo)) {
        if(file_exists('../include/images/upload/'.$company_logo)){
            $pdf->Image('../include/images/upload/'.$company_logo,15,20,20,20);
        }
    }
    if($end_y < 42){
        $end_y = 42;
    }
    $pdf->SetY(10);
    $pdf->SetX(10);
    $pdf->Cell(190,($end_y - 10),'',1,1,'C');
    $header_end = $pdf->GetY();


    $pdf->SetY($header_end);

         

?>