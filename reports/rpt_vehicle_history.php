<?php 
    include("../include_files.php");
    if(isset($_REQUEST['vehicle_id'])) {
        $vehicle_id = $_REQUEST['vehicle_id'];
        $vehicle_no = $obj->getTableColumnValue($GLOBALS['vehicle_table'],'vehicle_id',$vehicle_id,'vehicle_no');
        $vehicle_no = $obj->encode_decode('decrypt',$vehicle_no);
        $vehicle_details = $obj->getTableColumnValue($GLOBALS['vehicle_table'],'vehicle_id',$vehicle_id,'vehicle_details');
        $vehicle_details = $obj->encode_decode('decrypt',$vehicle_details);
        $sales_list = $obj->getVehicleHistory($vehicle_id);
        $store_data = array();
        if(!empty($sales_list)) {

            require_once('../fpdf/fpdf.php');
            $pdf = new FPDF('P','mm','A4');
            $pdf->AliasNbPages(); 
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);
            $yaxis = $pdf->GetY();
            $file_name="Vehicle History";
            include("rpt_header.php");
            $yaxis = $pdf->GetY();
            $pdf->SetFont('Arial','IB',12);

            $pdf->Cell(90,10,'Vehicle no :  ' . $vehicle_no ,0,0,'L',0);
            $pdf->Cell(90,10,'Vehicle details :  ' . $vehicle_details ,0,1,'R',0);
            $pdf->SetY($yaxis);
            $pdf->Cell(0,10,'',1,1,'L',0);

            $pdf->SetFont('Arial','IB',18);

            $pdf->Cell(0,20,'Job Details :',1,1,'L',0);
            $pdf->SetFont('Arial','B',10);

            $pdf->SetX(10);
            $pdf->Cell(10,8,'S.No.',1,0,'C',0);
            $pdf->Cell(25,8,'Date',1,0,'C',0);
            $pdf->Cell(25,8,'Job Number',1,0,'C',0);
            $pdf->Cell(40,8,'Department',1,0,'C',0);
            $pdf->Cell(50,8,'Engineer',1,0,'C',0);
            $pdf->Cell(40,8,'Details',1,1,'C',0);
            $pdf->SetFont('Arial','',8);
            $y_axis = $pdf->GetY();
            foreach($sales_list as $key => $list) {
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->MultiCell(10,8,$key+1,0,'C',0);
                $pdf->SetY($y_axis);
                $pdf->SetX(20);
                $pdf->MultiCell(25,8,date('d-m-Y', strtotime($list['job_card_date'])),0,'C',0);
                $pdf->SetY($y_axis);
                $pdf->SetX(45);
                $pdf->MultiCell(25,8,$list['job_card_number'],0,'C',0);
                $pdf->SetY($y_axis);
                $pdf->SetX(70);
                $pdf->MultiCell(40,8,$obj->encode_decode('decrypt',$list['department_name']),0,'C',0);
                $engineer_name = '';
                if(!empty($list['engineer_id'])) {
                    $engineer = explode(',',$list['engineer_id']);
                    $name = array();
                    for($e=0;$e<count($engineer);$e++) {
                        $name[$e] = $obj->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$engineer[$e],'engineer_name');
                        $name[$e] = $obj->encode_decode('decrypt',$name[$e]);
                    }
                    $engineer_name = implode(', ',$name);
                }
                $pdf->SetY($y_axis);
                $pdf->SetX(110);
                $pdf->MultiCell(50,8,$engineer_name,0,'C',0);
                $engineer_y = $pdf->GetY();
                $pdf->SetY($y_axis);
                $pdf->SetX(160);
                $pdf->MultiCell(40,8,$obj->encode_decode('decrypt',$list['work_details']),0,'C',0);
                $work_details_y = $pdf->GetY();



                if($engineer_y > $work_details_y) {
                    $pdf->SetY($y_axis);
                    $height = $engineer_y-$y_axis;
                    $pdf->Cell(10,$height,'',1,0,'C',0);
                    $pdf->Cell(25,$height,'',1,0,'C',0);
                    $pdf->Cell(25,$height,'',1,0,'C',0);
                    $pdf->Cell(40,$height,'',1,0,'C',0);
                    $pdf->Cell(50,$height,'',1,0,'C',0);
                    $pdf->Cell(40,$height,'',1,0,'C',0);
                    $y_axis = $engineer_y;
                } else {
                    $pdf->SetY($y_axis);
                    $height = $work_details_y-$y_axis;
                    $pdf->Cell(10,$height,'',1,0,'C',0);
                    $pdf->Cell(25,$height,'',1,0,'C',0);
                    $pdf->Cell(25,$height,'',1,0,'C',0);
                    $pdf->Cell(40,$height,'',1,0,'C',0);
                    $pdf->Cell(50,$height,'',1,0,'C',0);
                    $pdf->Cell(40,$height,'',1,1,'C',0);
                    $y_axis = $work_details_y;
                }
                $store_data = array_merge($list['store_details']);
                
            }
            if(!empty($store_data)) {
                $pdf->SetFont('Arial','IB',18);

                $pdf->Cell(0,20,'Store Entry Details :',1,1,'L',0);
                $pdf->SetFont('Arial','B',10);

                $pdf->SetX(10);
                $pdf->Cell(15,8,'S.No.',1,0,'C',0);
                $pdf->Cell(35,8,'Date',1,0,'C',0);
                $pdf->Cell(50,8,'Store Entry Number',1,0,'C',0);
                $pdf->Cell(50,8,'Job Card Number',1,0,'C',0);
                $pdf->Cell(40,8,'Total Qty',1,1,'C',0);
                $pdf->SetFont('Arial','',8);
                $y_axis = $pdf->GetY();
                foreach($store_data as $index => $data) {
                    $pdf->SetY($y_axis);
                    $pdf->SetX(10);
                    $pdf->MultiCell(15,8,$index+1,0,'C',0);
                    $pdf->SetY($y_axis);
                    $pdf->SetX(25);
                    $pdf->MultiCell(35,8,date('d-m-Y', strtotime($data['store_entry_date'])),0,'C',0);
                    $pdf->SetY($y_axis);
                    $pdf->SetX(60);
                    $pdf->MultiCell(50,8,$data['store_entry_number'],0,'C',0);
                    $pdf->SetY($y_axis);
                    $pdf->SetX(110);
                    $pdf->MultiCell(50,8,$data['job_card_number'],0,'C',0);
                    $total_qty =number_format(array_sum(explode(",", $data['quantity'])),2);
                    $pdf->SetY($y_axis);
                    $pdf->SetX(160);
                    $pdf->MultiCell(40,8,$data['job_card_number'],0,'C',0);

                    $pdf->SetY($y_axis);
                    $pdf->Cell(15,8,'',1,0,'C',0);
                    $pdf->Cell(35,8,'',1,0,'C',0);
                    $pdf->Cell(50,8,'',1,0,'C',0);
                    $pdf->Cell(50,8,'',1,0,'C',0);
                    $pdf->Cell(40,8,'',1,1,'C',0);
                    $y_axis = $pdf->GetY();
                }
            }

            $pdf->Output('', 'vehicle_history.pdf');


        }
    }