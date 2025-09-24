<?php
    include("../include_files.php");
    $search_text = "";
    if(isset($_REQUEST['search_text'])) {
        $search_text = $_REQUEST['search_text'];
    }

    $from = "";
    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }

    $party_type = "";
    if(isset($_REQUEST['party_type'])) {
        $party_type = $_REQUEST['party_type'];
    }

    $total_records_list = $obj->GetScreenPartyList($GLOBALS['bill_company_id'],$party_type);

    
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

    $file_name="Party List";
    include("rpt_header.php");
    $pdf->SetY($header_end);
    $pdf->SetTitle('Party List');
    $pdf->SetFont('Arial','B',12);
    
    
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(10,7,'S.No',1,0,'C');
    $pdf->SetX(20);
    $pdf->Cell(25,7,'Name',1,0,'C');
    $pdf->SetX(45);
    $pdf->Cell(20,7,'Mobile No.',1,0,'C');
    $pdf->SetX(65);
    $pdf->Cell(25,7,'Identification',1,0,'C');
    $pdf->SetX(90);
    $pdf->Cell(35,7,'Address',1,0,'C');
    $pdf->SetX(125);
    $pdf->Cell(25,7,'State',1,0,'C');
    $pdf->SetX(150);
    $pdf->Cell(25,7,'District',1,0,'C');
    $pdf->SetX(175);
    $pdf->Cell(25,7,'City',1,1,'C');
    $pdf->SetFont('Arial','',8);

    $start_y = $pdf->GetY();
    $y_axis=$pdf->GetY();

    $footer_height = 0;

    if(!empty($total_records_list)) {
        foreach($total_records_list as $key => $list) {
            if($pdf->GetY() > 270) {
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(-15);
                $pdf->SetX(10);
                $pdf->Cell(190,6,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $file_name="Party List";
                include("rpt_header.php");
                $pdf->SetY($header_end);
                $pdf->SetTitle('Party List');

                $pdf->SetFont('Arial','B',9);
                $pdf->SetX(10);
                $pdf->Cell(10,7,'S.No',1,0,'C');
                $pdf->SetX(20);
                $pdf->Cell(25,7,'Name',1,0,'C');
                $pdf->SetX(45);
                $pdf->Cell(20,7,'Mobile No.',1,0,'C');
                $pdf->SetX(65);
                $pdf->Cell(25,7,'Identification',1,0,'C');
                $pdf->SetX(90);
                $pdf->Cell(35,7,'Address',1,0,'C');
                $pdf->SetX(125);
                $pdf->Cell(25,7,'State',1,0,'C');
                $pdf->SetX(150);
                $pdf->Cell(25,7,'District',1,0,'C');
                $pdf->SetX(175);
                $pdf->Cell(25,7,'City',1,1,'C');
                $pdf->SetFont('Arial','',8);


                $start_y = $pdf->GetY();
            }
            $key = $key + 1;

            $name_y = ""; $id_y = ""; $address_y = ""; $state_y = ""; $district_y = ""; $city_y = "";
            $y_array = array(); $max_y = "";
            
            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,7,$key,0,0,'C');

            if(!empty($list['party_name'])) {
                $list['party_name'] = html_entity_decode($obj->encode_decode('decrypt',$list['party_name']));
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(25,7,$list['party_name'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(25,7,'-',0,'C');
            }
            $name_y = $pdf->GetY() - $start_y;

            if(!empty($list['mobile_number']) && $list['mobile_number'] != $GLOBALS['null_value']) {
                $list['mobile_number'] = $obj->encode_decode('decrypt',$list['mobile_number']);
                $pdf->SetY($start_y);
                $pdf->SetX(45);
                $pdf->Cell(20,7,$list['mobile_number'],0,0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(45);
                $pdf->Cell(20,7,'-',0,0,'C');
            }

            if(!empty($list['identification']) && $list['identification'] != $GLOBALS['null_value']) {
                $list['identification'] = html_entity_decode($obj->encode_decode('decrypt',$list['identification']));
                $pdf->SetY($start_y);
                $pdf->SetX(65);
                $pdf->MultiCell(25,7,$list['identification'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(65);
                $pdf->MultiCell(25,7,'-',0,'C');
            }
            $id_y = $pdf->GetY() - $start_y;

            if(!empty($list['address']) && $list['address'] != $GLOBALS['null_value']) {
                $list['address'] = html_entity_decode($obj->encode_decode('decrypt',$list['address']));
                $pdf->SetY($start_y);
                $pdf->SetX(90);
                $pdf->MultiCell(35,7,$list['address'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(90);
                $pdf->MultiCell(35,7,'-',0,'C');
            }
            $address_y = $pdf->GetY() - $start_y;

            if(!empty($list['state'])) {
                $list['state'] = $obj->encode_decode('decrypt',$list['state']);
                $pdf->SetY($start_y);
                $pdf->SetX(125);
                $pdf->MultiCell(25,7,$list['state'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(125);
                $pdf->MultiCell(25,7,'-',0,'C');
            }
            $state_y = $pdf->GetY() - $start_y;

            if(!empty($list['district']) && $list['district'] != $GLOBALS['null_value']) {
                $list['district'] = $obj->encode_decode('decrypt',$list['district']);
                $pdf->SetY($start_y);
                $pdf->SetX(150);
                $pdf->MultiCell(25,7,$list['district'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(150);
                $pdf->MultiCell(25,7,'-',0,'C');
            }
            $district_y = $pdf->GetY() - $start_y;

            if(!empty($list['city']) && $list['city'] != $GLOBALS['null_value']) {
                $list['city'] = $obj->encode_decode('decrypt',$list['city']);
                $pdf->SetY($start_y);
                $pdf->SetX(175);
                $pdf->MultiCell(25,7,$list['city'],0,'C');
            }
            else {
                $pdf->SetY($start_y);
                $pdf->SetX(175);
                $pdf->MultiCell(25,7,'-',0,'C');
            }
            $city_y = $pdf->GetY() - $start_y;

            $y_array = array($name_y, $id_y, $address_y, $state_y, $district_y, $city_y);
            $max_y = max($y_array);

            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,$max_y,'',1,0,'C');
            $pdf->SetX(20);
            $pdf->Cell(25,$max_y,'',1,0,'C');
            $pdf->SetX(45);
            $pdf->Cell(20,$max_y,'',1,0,'C');
            $pdf->SetX(65);
            $pdf->Cell(25,$max_y,'',1,0,'C');
            $pdf->SetX(90);
            $pdf->Cell(35,$max_y,'',1,0,'C');
            $pdf->SetX(125);
            $pdf->Cell(25,$max_y,'',1,0,'C');
            $pdf->SetX(150);
            $pdf->Cell(25,$max_y,'',1,0,'C');
            $pdf->SetX(175);
            $pdf->Cell(25,$max_y,'',1,1,'C');

            $start_y += $max_y;
        }
    }

    $end_y = $pdf->GetY();

    if(($footer_height+$end_y) >= 270){

        $y = $pdf->GetY();

        $pdf->SetY($y_axis);

        $pdf->SetX(10);
        $pdf->Cell(10,277-$y_axis,'',1,0,'C');
        $pdf->SetX(20);
        $pdf->Cell(25,277-$y_axis,'',1,0,'C');
        $pdf->SetX(45);
        $pdf->Cell(20,277-$y_axis,'',1,0,'C');
        $pdf->SetX(65);
        $pdf->Cell(25,277-$y_axis,'',1,0,'C');
        $pdf->SetX(90);
        $pdf->Cell(35,277-$y_axis,'',1,0,'C');
        $pdf->SetX(125);
        $pdf->Cell(25,277-$y_axis,'',1,0,'C');
        $pdf->SetX(150);
        $pdf->Cell(25,277-$y_axis,'',1,0,'C');
        $pdf->SetX(175);
        $pdf->Cell(25,277-$y_axis,'',1,1,'C');


        $pdf->SetFont('Arial','B',9);

        $next_page = $pdf->PageNo()+1;

        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(-15);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

        $pdf->AddPage();

        $file_name="Party List";
        include("rpt_header.php");
        $pdf->SetY($header_end);
        $pdf->SetTitle('Party List');

        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(10);
        $pdf->Cell(10,7,'S.No',1,0,'C');
        $pdf->SetX(20);
        $pdf->Cell(25,7,'Name',1,0,'C');
        $pdf->SetX(45);
        $pdf->Cell(20,7,'Mobile No.',1,0,'C');
        $pdf->SetX(65);
        $pdf->Cell(25,7,'Identification',1,0,'C');
        $pdf->SetX(90);
        $pdf->Cell(35,7,'Address',1,0,'C');
        $pdf->SetX(125);
        $pdf->Cell(25,7,'State',1,0,'C');
        $pdf->SetX(150);
        $pdf->Cell(25,7,'District',1,0,'C');
        $pdf->SetX(175);
        $pdf->Cell(25,7,'City',1,1,'C');
        $pdf->SetFont('Arial','',8);
        $y_axis=$pdf->GetY();


        $content_height = 280 - $footer_height;



        $pdf->SetY($y_axis);

        $pdf->SetX(10);
        $pdf->Cell(10,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(20,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(35,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(25,($content_height - $y_axis),'',1,1,'C');

        $pdf->SetY($content_height);

    } else {
        $content_height = 280 - $footer_height;
        $pdf->SetY($y_axis);

        $pdf->SetX(10);

        $pdf->Cell(10,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(20,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(35,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(25,($content_height - $y_axis),'',1,0,'C');
        $pdf->Cell(25,($content_height - $y_axis),'',1,1,'C');
        

    }

    $pdf->SetFont('Arial','I',7);
    $pdf->SetY(-15);
    $pdf->SetX(10);
    $pdf->Cell(190,6,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

    
    $pdf->Output($from,'Party List.pdf');
?>