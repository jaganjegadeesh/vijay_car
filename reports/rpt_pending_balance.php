<?php
    include("../include_user_check_and_files.php");

    
    $to_date = date('Y-m-d');  $current_date = date('Y-m-d');

    $from_date = date('Y-m-d', strtotime('-30 days', strtotime($to_date)));
    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }

    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }

    $filter_party_id ="";
    if(isset($_REQUEST['filter_party_id'])) {
        $filter_party_id = $_REQUEST['filter_party_id'];
        
    }

    $total_records_list =array();
    $total_records_list = $obj->balance_report($bill_company_id,$filter_party_id,$from_date,$to_date);

    // print_r($total_records_list);

    if(!empty($filter_party_id)) { 

        require_once('../fpdf/fpdf.php');
        $pdf = new FPDF('P','mm','A4');
        $pdf->AliasNbPages(); 
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetTitle('Pending Balance Report');
        $pdf->SetFont('Arial','B',10);

        $yaxis = $pdf->GetY();

        $file_name="Pending Balance Report";
        include("rpt_header.php");
        
        $pdf->SetY($header_end);

        $sy = $pdf->GetY();
        if(!empty($from_date)){
            $pdf->Cell(0,7,'Pending Payment Overall - ('.date('d-m-Y',strtotime($from_date))." - ".date('d-m-Y',strtotime($to_date)).')',0,1,'C',0);
        }else{
            $pdf->Cell(0,7,'Pending Payment Overall - ('.date('d-m-Y',strtotime($to_date)).')',0,1,'C',0);
        }
        $employee_name = "";
       
        if(!empty($filter_employee_id)) {
        
            $employee_name = $obj->getTableColumnValue($GLOBALS['employee_table'], 'employee_id', $filter_employee_id, 'employee_name');
            if(!empty($employee_name)) { 
                $employee_name = $obj->encode_decode('decrypt', $employee_name);
                $pdf->SetX(10);
                $pdf->Cell(0,7,$employee_name,0,1,'C',0);
            }            
        }else
        {
            if(!empty($filter_customer_id)) {
                $customer_name = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $filter_customer_id, 'customer_name');
                
                
                if(!empty($customer_name)) { 
                    $customer_name = $obj->encode_decode('decrypt', $customer_name);
                    $pdf->Cell(0,7,$customer_name,0,1,'C',0);

                }            
            }
        }
        $current_y = $pdf->GetY();
        $pdf->SetY($yaxis);
        $pdf->SetX(10);
        $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
        
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(10,8,'S.No.',1,0,'C',0);
        $pdf->Cell(20,8,'Date',1,0,'C',0);
        $pdf->Cell(25,8,'Bill No',1,0,'C',0);
        $pdf->Cell(30,8,'Type',1,0,'C',0);
        $pdf->Cell(40,8,'Payment Mode',1,0,'C',0);
        $pdf->Cell(30,8,'Credit',1,0,'C',0);
        $pdf->Cell(35,8,'Debit',1,1,'C',0);
        $pdf->SetFont('Arial','',8);

        $credit_amount = 0; $debit_amount = 0; $total =0;  $total_credit = 0; $total_debit = 0;
        $opening_balance_list = array();
        $opening_balance_list = $obj->getOpeningBalance($filter_party_id,$from_date,$to_date,$bill_company_id);
        $opening_debit = 0; $opening_credit = 0;

        $opening_debit = 0; $opening_credit = 0;
        if(!empty($opening_balance_list)) {
            foreach($opening_balance_list as $data) {
                if(!empty($data['debit'])) {
                    $opening_debit += $data['debit'];
                }

                if(!empty($data['credit'])) {
                    $opening_credit += $data['credit'];
                }
                
            }
        }
        if(!empty($data['opening_balance']))
        {
            if($data['opening_balance_type'] == 'Credit')
            {
                $opening_credit += $data['opening_balance'];
            }
            if($data['opening_balance_type'] == 'Debit')
            {
                $opening_debit += $data['opening_balance'];
            }
        }
        if(!empty($opening_debit) || !empty($opening_credit)) {
                $pdf->SetFont('Arial','B',8);
            $pdf->Cell(125,8,'Opening Balance',1,0,'R',0);
            if($opening_credit > $opening_debit) {
                $total_credit = $opening_credit - $opening_debit;
                $pdf->Cell(30,8,$obj->numberFormat($total_credit,2),1,0,'R',0); 

            }else{
                $pdf->Cell(30,8,'',1,0,'R',0); 
            }
            if($opening_debit > $opening_credit){
                $total_debit = $opening_debit - $opening_credit;
                $pdf->Cell(30,8,$obj->numberFormat($total_debit,2),1,1,'R',0);  

            }else{
                $pdf->Cell(0,8,'',1,1,'R',0); 
            } 

        }
        $pdf->SetFont('Arial','',8);

         if(!empty($total_records_list)) {
            $index = 1;
            foreach ($total_records_list as $data) {
                if($pdf->GetY()>250){
                    $pdf->AddPage();
                    $file_name="Pending Balance Report";
                    include("rpt_header.php");
                    $pdf->SetY($header_end);

                    $yaxis = $pdf->GetY();

                    $file_name="Pending Balance Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);

                    $sy = $pdf->GetY();
                    if(!empty($from_date)){
                        $pdf->Cell(0,7,'Pending Payment Overall - ('.date('d-m-Y',strtotime($from_date))." - ".date('d-m-Y',strtotime($to_date)).')',0,1,'C',0);
                    }else{
                        $pdf->Cell(0,7,'Pending Payment Overall - ('.date('d-m-Y',strtotime($to_date)).')',0,1,'C',0);
                    }
                    $employee_name = "";
                
                    if(!empty($filter_employee_id)) {
                    
                        $employee_name = $obj->getTableColumnValue($GLOBALS['employee_table'], 'employee_id', $filter_employee_id, 'employee_name');
                        
                        
                        if(!empty($employee_name)) { 
                            $employee_name = $obj->encode_decode('decrypt', $employee_name);
                            $pdf->SetX(10);
                            $pdf->Cell(0,7,$employee_name,0,1,'C',0);
                        }            
                    }else
                    {
                        if(!empty($filter_customer_id)) {
                            $customer_name = $obj->getTableColumnValue($GLOBALS['customer_table'], 'customer_id', $filter_customer_id, 'customer_name');
                            
                            
                            if(!empty($customer_name)) { 
                                $customer_name = $obj->encode_decode('decrypt', $customer_name);
                                $pdf->Cell(0,7,$customer_name,0,1,'C',0);

                            }            
                        }
                    }
                    $current_y = $pdf->GetY();
                    $pdf->SetY($yaxis);
                    $pdf->SetX(10);
                    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetX(10);
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(10,8,'S.No.',1,0,'C',0);
                    $pdf->Cell(20,8,'Date',1,0,'C',0);
                    $pdf->Cell(25,8,'Bill No',1,0,'C',0);
                    $pdf->Cell(30,8,'Type',1,0,'C',0);
                    $pdf->Cell(40,8,'Payment Mode',1,0,'C',0);
                    $pdf->Cell(30,8,'Credit',1,0,'C',0);
                    $pdf->Cell(35,8,'Debit',1,1,'C',0);
                    $pdf->SetFont('Arial','',8);
                }
                $start_y = $pdf->GetY();
                if($data['bill_type'] != 'Employee Opening Balance' && $data['bill_type'] != 'Customer Opening Balance' && $data['bill_type'] != 'Suspense Party Opening Balance'){
                    $pdf->SetX(10);
                    $pdf->Cell(10,8,$index,0,0,'C',0);
                    if(!empty($data['bill_date']))
                    {
                        $pdf->SetX(20);
                        $pdf->Cell(20,8,date('d-m-Y',strtotime($data['bill_date'])),0,0,'C',0);
                    }
                    if(!empty($data['bill_number']) && $data['bill_number'] != $GLOBALS['null_value']) {
                        $pdf->SetX(40);
                        $pdf->Cell(25, 8, trim($data['bill_number']), 0, 0, 'C', 0);
                    } else {
                        $pdf->SetX(40);
                        $pdf->Cell(25, 8, "-", 0, 0, 'C', 0);
                    }
                    if(!empty($data['bill_type']))
                    {
                        $pdf->SetX(65);
                        $pdf->MultiCell(30,8, $data['bill_type'],0,'C',0);
                    }else{
                        $pdf->SetX(65);
                        $pdf->Cell(30, 8, "-", 0, 0, 'C', 0);

                    }
                    $bill_type_y =  $pdf->GetY() - $start_y;

                    if(!empty($data['payment_mode_name']) && $data['payment_mode_name'] != $GLOBALS['null_value']) {
                        $payment_mode_name = array();
                        $payment_mode_name = explode(",", $data['payment_mode_name']);
                        $payment_mode_name = array_reverse($payment_mode_name);

                        $bank_id = explode(",",$data['bank_id']);
                        $bank_id = array_reverse($bank_id);
                        for($i=0; $i < count($payment_mode_name); $i++) {
                            $payment_mode ="";

                            $payment_mode =$obj->encode_decode("decrypt", $payment_mode_name[$i]);
                            
                            if (!empty($data['credit']) || !empty($data['debit'])) {
                                $amounts= array();
                                if($data['bill_type'] == 'Receipt'){
                                    $amounts = explode(",", $data['credit']);
                                }else if($data['bill_type'] == 'Voucher' || $data['bill_type'] == 'Expense'){
                                    $amounts = explode(",", $data['debit']);
                                }
                                $amounts = array_reverse($amounts);
                            }
                            $bank_name = "";
                            if(!empty($bank_id[$i])){
                                $bank_name =  $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id[$i], 'bank_name');
                                $bank_name = $obj->encode_decode('decrypt',$bank_name);
                            }

                            if(!empty($bank_name)){
                                $pdf->SetY($start_y);
                                $pdf->SetX(95);
                                $pdf->MultiCell(40, 4,  $payment_mode ." - ( ".$bank_name." ) -  ".$obj->numberFormat($amounts[$i],2), 0, 'C', 0);

                            }else{
                                $pdf->SetY($start_y);
                                $pdf->SetX(95);
                                $pdf->MultiCell(40, 4,  $payment_mode ." - ".$obj->numberFormat($amounts[$i],2), 0, 'C', 0);
                            }  
                            if($i < (count($payment_mode_name))-1) {
                                $pdf->SetY($start_y);
                                $pdf->SetX(95);
                                $pdf->MultiCell(40, 4, ",  <br>", 0, 'C', 0);

                            }
                            
                    }
                    }else{
                        $pdf->SetY($start_y);
                        $pdf->SetX(95);
                        $pdf->MultiCell(40, 8, '-', 0, 'C', 0);
                    } 
                    $payment_y = $pdf->GetY() - $start_y;

                    if(!empty($data['credit'] && $data['credit'] != $GLOBALS['null_value']))
                    {
                        $pdf->SetY($start_y);
                        $pdf->SetX(135);
                        $pdf->Cell(30,8,$obj->numberFormat($data['credit'],2),0,0,'R',0);
                        $total_credit += $data['credit'];
                        
                    }else{
                        $pdf->SetY($start_y);
                        $pdf->SetX(130);
                        $pdf->Cell(35,8,'0.00',0,0,'R',0);
                    }
                    if(!empty($data['debit'] && $data['debit'] != $GLOBALS['null_value']))
                    {   
                        $pdf->SetY($start_y);
                        $pdf->SetX(165);
                        $pdf->Cell(35,8,$obj->numberFormat($data['debit'],2),0,1,'R',0);
                        $total_debit += $data['debit'];
                    }else{
                        $pdf->SetY($start_y);
                        $pdf->SetX(165);
                        $pdf->Cell(35,8,'0.00',0,1,'R',0);
                    }
                    $y_array = array($bill_type_y, $payment_y);
                    // print_r(($y_array));
                    $max_y = max($y_array);
                    // echo "<br>";
                    $pdf->SetY($start_y);
                    $pdf->SetX(10);
                    $pdf->Cell(10,$max_y,'',1,0,'C',0);
                    $pdf->SetX(20);
                    $pdf->Cell(20,$max_y,'',1,0,'C',0);
                    $pdf->SetX(40);
                    $pdf->Cell(25,$max_y,'',1,0,'C',0);
                    $pdf->SetX(65);
                    $pdf->Cell(30,$max_y,'',1,0,'C',0);
                    $pdf->SetX(95);
                    $pdf->Cell(40,$max_y,'',1,0,'C',0);
                    $pdf->SetX(135);
                    $pdf->Cell(30,$max_y,'',1,0,'C',0);
                    $pdf->SetX(165);
                    $pdf->Cell(0,$max_y,'',1,1,'C',0);
                    $index++;

                }
                
            }
         }
        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10);
        $pdf->Cell(125,8,'Total',1,0,'R',0);
        if(!empty($total_credit)){ 
            $pdf->SetX(135);
            $pdf->Cell(30,8,$obj->numberFormat($total_credit,2),1,0,'R',0);
        }else{
            $pdf->SetX(135);
            $pdf->Cell(35,8,'0.00',1,0,'R',0);
        }
        if(!empty($total_debit)){ 
             $pdf->SetX(165);
            $pdf->Cell(0,8,$obj->numberFormat($total_debit,2),1,1,'R',0);
        }else{
            $pdf->SetX(165);
            $pdf->Cell(0,8,'0.00',1,1,'R',0);

        }
       
        $pdf->SetX(10);
        $pdf->Cell(125,8,'Current Total',1,0,'R',0);
        if($total_credit > $total_debit) { 
            $pdf->SetX(135);
            $pdf->Cell(30,8,$obj->numberFormat(($total_credit- $total_debit),2)." Cr",1,0,'R',0);
        }else{
            $pdf->SetX(135);
            $pdf->Cell(35,8,'0.00',1,0,'R',0);
        }

        if($total_debit > $total_credit)
        { 
            $pdf->SetX(165);
            $total_pending_amount = $total_debit - $total_credit;  
            $pdf->Cell(0,8,$obj->numberFormat($total_pending_amount,2)." Dr",1,0,'R',0);              

        }else{
            $pdf->SetX(135);
            $pdf->Cell(0,8,'0.00',1,1,'R',0);
        }

    }else{
        require_once('../fpdf/fpdf.php');
        $pdf = new FPDF('P','mm','A4');
        $pdf->AliasNbPages(); 
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        
        $yaxis = $pdf->GetY();

        $file_name="Pending Balance Report";
        include("rpt_header.php");
        
        $pdf->SetY($header_end);
            
        $current_y = $pdf->GetY();

        $pdf->SetY($yaxis);
        $pdf->SetX(10);

        $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(0,10,'Pending Payment Report - ('.date('d-m-Y').')',1,1,'C',0);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(10);
        $pdf->Cell(15,8,'S.No.',1,0,'C',0);
        $pdf->SetX(25);
        $pdf->Cell(85,8,'Party Name',1,0,'C',0);
        $pdf->SetX(110);
        $pdf->Cell(45,8,'Debit',1,0,'C',0);
        $pdf->SetX(155);
        $pdf->Cell(45,8,'Credit',1,1,'C',0);
        $pdf->SetFont('Arial','',8);

        if(!empty($total_records_list)) {
            $grand_pending = 0; $credit = 0; $debit = 0; $estimate_debit = 0; $credit_total_amount =0; $debit_total_amount =0; $grand_credit_total = 0; $grand_debit_total =0; $sno = 1;
            foreach($total_records_list as $key => $data) {
                if($pdf->GetY()>250){
                    $pdf->AddPage();
                    $yaxis = $pdf->GetY();
            
                    $file_name="Pending Balance Report";
                    include("rpt_header.php");
                    
                    $pdf->SetY($header_end);

                    $pdf->SetFont('Arial','B',11);

                    $pdf->Cell(0,10,'Pending Payment Report - ('.date('d-m-Y').')',1,1,'C',0);

                    $current_y = $pdf->GetY();
            
                    $pdf->SetY($yaxis);
                    $pdf->SetX(10);
            
                    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
                    $pdf->SetFont('Arial','B',9);

                    $pdf->SetX(10);
                    $pdf->Cell(15,8,'S.No.',1,0,'C',0);
                    $pdf->SetX(25);
                    $pdf->Cell(85,8,'Party Name',1,0,'C',0);
                    $pdf->SetX(110);
                    $pdf->Cell(45,8,'Debit',1,0,'C',0);
                    $pdf->SetX(155);
                    $pdf->Cell(45,8,'Credit',1,1,'C',0);
                    $pdf->SetFont('Arial','',8);

                }
                $index = $key + 1; $credit_total = 0; $debit_total=0;

                $z = $pdf->GetY();
                $pdf->SetX(10);
                $pdf->Cell(15,10,$index,0,0,'C',0);
                $pdf->SetX(25);
                if(!empty($data['party_name']) && $data['party_name'] != $GLOBALS['null_value']) {
                        $pdf->Cell(85,10,$obj->encode_decode('decrypt',$data['party_name']),0,0,'L',0); 

                    if(!empty($data['mobile_number']) && $data['mobile_number']!=$GLOBALS['null_value']) {
                        $pdf->Cell(85,10,"(".$obj->encode_decode('decrypt',$data['mobile_number']).")",0,0,'L',0);
                    }
                }
                if(!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 'Credit') ) {
                    $credit_total = $credit_total + $data['opening_balance'];
                    $credit = $credit + $credit_total;
                } 
                if(!empty($data['opening_balance']) && (!empty($data['opening_balance_type']) && $data['opening_balance_type'] == 'Debit') ) {
                    $debit_total = $debit_total + $data['opening_balance'];
                    $debit = $debit + $debit_total;
                }
                
                if(!empty($data['credit'])) {
                
                    $credit_total = $credit_total + $data['credit'];
                    $credit = $credit + $credit_total;
                }

                if(!empty($data['debit'])) {
                
                    $debit_total = $debit_total + $data['debit'];
                    $debit = $debit + $debit_total;
                }

                if($credit_total > $debit_total)
                {
                    $total_amount = $debit_total - $credit_total;
                }   
                else{
                    $total_amount = $credit_total - $debit_total;
                }
                if($debit_total >= $credit_total){ 
                    $total_amount = $debit_total - $credit_total;
                    $pdf->SetX(110);
                    $pdf->Cell(45,8,$obj->numberFormat(($total_amount),2),0,0,'R',0);
                    $debit_total_amount = $debit_total_amount + $total_amount; 
                }
                if($credit_total > $debit_total) { 
                    $total_amount = $credit_total  - $debit_total; 
                    $pdf->SetX(155);
                    $pdf->Cell(45,8,$obj->numberFormat(($total_amount),2),0,1,'R',0);
                    $credit_total_amount = $credit_total_amount + $total_amount; 
                }
                $pdf->SetY($z);
                $pdf->SetX(10);
                $pdf->Cell(15,8,'',1,0,'C',0);
                $pdf->SetX(25);
                $pdf->Cell(85,8,'',1,0,'C',0);
                $pdf->SetX(110);
                $pdf->Cell(45,8,'',1,0,'C',0);
                $pdf->SetX(155);
                $pdf->Cell(45,8,'',1,1,'C',0);


            }  
            $pdf->SetX(10);
            $pdf->Cell(100,8,'Total',1,0,'R',0);
            $pdf->SetX(110);
            if(!empty($debit_total_amount)) {
                $pdf->Cell(45,8,$obj->numberFormat($debit_total_amount,2),1,0,'R',0);
            }else{
                $pdf->Cell(45,8,'0.00',1,0,'R',0);
            } 
            $pdf->SetX(155);
            if(!empty($credit_total_amount)) {
                $pdf->Cell(45,8,$obj->numberFormat($credit_total_amount,2),1,1,'R',0);
            }else{
                $pdf->Cell(45,8,'0.00',1,0,'R',0);
            } 
            $pdf->SetX(10);
            $pdf->Cell(100,8,'Current Balance',1,0,'R',0);
            if(!empty($credit_total_amount || ($debit_total_amount))) {
                if($debit_total_amount > $credit_total_amount)  {
                    $pdf->SetX(110);
                    $pdf->Cell(45,8,$obj->numberFormat(($debit_total_amount-$credit_total_amount),2),1,0,'R',0);
                }else{
                    $pdf->SetX(110);
                    $pdf->Cell(45,8,'0.00',1,0,'R',0);
                } 
            }

            if(!empty($credit_total_amount || ($debit_total_amount))) {
                if($credit_total_amount > $debit_total_amount)  {
                    $pdf->SetX(155);
                    $pdf->Cell(45,8,$obj->numberFormat(($credit_total_amount-$debit_total_amount),2),1,1,'R',0);
                }else{
                    $pdf->SetX(155);
                    $pdf->Cell(45,8,'0.00',1,1,'R',0);
                }
            }
        }
    }
    $pdf->SetFont('Arial','I',7);
    $pdf->SetY(-15);
    $pdf->SetX(10);
    $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    $pdf->Output();

?>