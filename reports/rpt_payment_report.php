<?php

    include("../include_user_check_and_files.php");
    
    $from = "";
    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }
    $payment_mode_list = array(); 
    $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], '', '', '');

    $bank_list = array(); 
    $bank_list = $obj->getTableRecords($GLOBALS['bank_table'], '','', '');

    $filter_party_id =""; 
    if(isset($_REQUEST['filter_party_id'])) {
        $filter_party_id = $_REQUEST['filter_party_id'];
    }

    
    $filter_bill_type="";
    if(isset($_REQUEST['filter_bill_type'])) {
        $filter_bill_type = $_REQUEST['filter_bill_type'];
    }

    $from_date = "";
    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }
    
    $to_date = "";
    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }

    $filter_payment_mode_id="";
    if(isset($_REQUEST['filter_payment_mode_id'])) {
        $filter_payment_mode_id = $_REQUEST['filter_payment_mode_id'];
    }

    $filter_bank_id="";
    if(isset($_REQUEST['filter_bank_id'])) {
        $filter_bank_id = $_REQUEST['filter_bank_id'];
    }

    
    $party_list = array();
    $party_list = $obj->getTableRecords($GLOBALS['party_table'],'','');

    // $category_list = array();
    // $category_list = $obj->getTableRecords($GLOBALS['expense_category_table'],'','','');

    $payment_list =array();
    $payment_list = $obj->getPaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_id,$filter_payment_mode_id,$filter_bank_id);
   
    if(!empty($from_date)){
        $from_date = date('d-m-Y', strtotime($from_date));
    }
    if(!empty($to_date)){
        $to_date = date('d-m-Y', strtotime($to_date));
    }

    $date_display = "";
    if(!empty($from_date) && !empty($to_date)) {
        $date_display = "(";
    }
    if(!empty($from_date)) {
        $date_display = $from_date;
    }

    if(!empty($from_date) && !empty($to_date)) {
        $date_display .= ' - ';
    }

    if(!empty($to_date)) {
        $date_display .= $to_date;
    }
    if(!empty($from_date) && !empty($to_date)) {
        $date_display .= ")";
    }

    require_once('../fpdf/fpdf.php');

    $pdf = new FPDF('P','mm','A4');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();
	$pdf->SetAutoPageBreak(false);
	
    $file_name = "Payment Report";
    include("rpt_header.php");

    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(190,7,'Payment Report '.$date_display ,1,1,'C',0);
    
    $pdf->SetFont('Arial','B',7);
    $y = $pdf->GetY();

    $pdf->SetFillColor(101,114,122);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetX(10);
    $pdf->Cell(10,8,'#',1,0,'C',1);
    $pdf->Cell(27,4,'Date',0,1,'C',1);
    $pdf->SetX(20);
    $pdf->Cell(27,4,'Bill No',0,0,'C',1);
    $pdf->SetY($y);
    $pdf->SetX(47);
    $pdf->Cell(20,8,'Payment Type',1,0,'C',1);
    $pdf->Cell(43,8,'Party Name',1,0,'C',1);
    $pdf->Cell(40,8,'Payment Mode',1,0,'C',1);
    $pdf->Cell(25,8,'Credit (Rs.)',1,0,'C',1);
    $pdf->Cell(25,8,'Debit (Rs.)',1,1,'C',1);

    $pdf->SetTextColor(0,0,0);
    $start_y = $pdf->GetY();

    $pdf->SetFont('Arial','',7);
    $s_no = "1"; 
    
    if (!empty($payment_list)) {
        $total_credit = 0; $total_debit = 0; $closing_balance=0;
        foreach ($payment_list as $data) {
            if($pdf->GetY() > 250) {
                $pdf->SetFont('Arial','B',8);
                $pdf->SetX(10);

                $pdf->Cell(140,8,'Closing Balance ',1,0,'R',0);
                if($total_credit > $total_debit) {
                    $opening_balance_credit = $total_credit-$total_debit;
                    $pdf->SetX(150);
                    $pdf->Cell(25,8,$obj->numberFormat($total_credit-$total_debit,2),1,0,'R',0);
                    $pdf->SetX(175);
                    $pdf->Cell(25,8,' ',1,0,'R',0);
                } else {
                    $opening_balance_debit = $total_debit-$total_credit;
                    $pdf->SetX(150);
                    $pdf->Cell(25,8,' ',1,0,'R',0);
                    $pdf->SetX(175);
                    $pdf->Cell(25,8,$obj->numberFormat($total_debit-$total_credit,2),1,1,'R',0);
                }
    
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(277);
                $pdf->SetX(10);
                $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();

                $file_name = "Payment Report";
                include("rpt_header.php");

                $pdf->SetFont('Arial','B',9);
                $pdf->SetX(10);
                $pdf->Cell(190,7,'Payment Report '.$date_display ,1,1,'C',0);

                $pdf->SetFont('Arial','B',7);
                $y = $pdf->GetY();
                $pdf->SetFillColor(101,114,122);
                $pdf->SetTextColor(255,255,255);
                $pdf->SetX(10);
                $pdf->Cell(10,8,'#',1,0,'C',1);
                $pdf->Cell(27,4,'Date',0,1,'C',1);
                $pdf->SetX(20);
                $pdf->Cell(27,4,'Bill No',0,0,'C',1);
                $pdf->SetY($y);
                $pdf->SetX(47);
                $pdf->Cell(20,8,'Payment Type',1,0,'C',1);
                $pdf->Cell(43,8,'Party Name',1,0,'C',1);
                $pdf->Cell(40,8,'Payment Mode',1,0,'C',1);
                $pdf->Cell(25,8,'Credit (Rs.)',1,0,'C',1);
                $pdf->Cell(25,8,'Debit (Rs.)',1,1,'C',1);
                
                $pdf->SetTextColor(0,0,0);
                $pdf->SetFont('Arial','B',8);
                $pdf->SetX(10);
                $pdf->Cell(140,8,'Opening Balance',1,0,'R',0);
                if(!empty($opening_balance_credit)) {
                    $pdf->SetX(150);
                    $pdf->Cell(25,8,$obj->numberFormat($opening_balance_credit,2),1,0,'R',0);
                    $pdf->SetX(175);
                    $pdf->Cell(25,8,'  ',1,1,'R',0);
                } else {
                    $pdf->SetX(150);
                    $pdf->Cell(25,8,'  ',1,0,'R',0);
                    $pdf->SetX(175);
                    $pdf->Cell(25,8,$obj->numberFormat($opening_balance_debit,2),1,1,'R',0);
                }
    
                $pdf->SetFont('Arial','',8);
                $start_y = $pdf->GetY();
            }

            $pdf->SetFont('Arial','',8);
            $pdf->SetX(10);
            $pdf->Cell(10,5,$s_no,0,0,'C',0);
            if(!empty($data['bill_date']) && (!empty($data['bill_number']))) {
                $bill_date = "";
                $bill_date = date('d-m-Y', strtotime($data['bill_date']));
                $bill_number = "";
                $bill_number = $data['bill_number'];
                $combine_data = $bill_date."\n".$bill_number;
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                
                $pdf->MultiCell(27, 5, $combine_data, 0, 'C', 0);
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(27, 5,'-', 0, 'C', 0);
            }
            $date_y = $pdf->GetY() - $start_y;
            $pdf->SetFont('Arial','',8);

            if(!empty($data['bill_type'])) {
                $bill_type = "";
                $bill_type = $data['bill_type'];
                $pdf->SetY($start_y);
                $pdf->SetX(47);
                $pdf->MultiCell(20, 5, $bill_type, 0, 'L', 0);
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(47);
                $pdf->MultiCell(20, 5,'-', 0, 'C', 0);
            }

            $bill_y = $pdf->GetY() - $start_y;


            if(!empty($data['party_name'] && $data['party_name'] != $GLOBALS['null_value'])){
                $party_name =html_entity_decode($obj->encode_decode('decrypt',$data['party_name']));
                if(!empty($party_name)) {
                    // $pdf->SetTextColor(10, 51, 147);
                    $pdf->SetY($start_y);
                    $pdf->SetX(67);
                    $pdf->MultiCell(43, 5, html_entity_decode($party_name,ENT_QUOTES), 0, 'L', 0);
                    $pdf->SetTextColor(0,0,0);
                } else {
                    $pdf->SetY($start_y);
                    $pdf->SetX(67);
                    $pdf->MultiCell(43, 5, '-', 0, 'C', 0);
                }
            }

            $party_y = $pdf->GetY() - $start_y;

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
                        } else if($data['bill_type'] == 'Voucher' || $data['bill_type'] == 'Expense') {
                            $amounts = explode(",", $data['debit']);
                        }
                        $amounts = array_reverse($amounts);
                    }

                    $bank_name = "";
                    if(!empty($bank_id[$i])) {
                        $bank_name =  $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id[$i], 'bank_name');
                        $bank_name = $obj->encode_decode('decrypt',$bank_name);

                        $account_number =  $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id[$i], 'account_number');
                        $account_number = $obj->encode_decode('decrypt',$account_number);
                    }
                    if(!empty($bank_name)) {
                        $pdf->SetY($start_y);
                        $pdf->SetX(110);
                        $pdf->MultiCell(40, 5, $payment_mode ." - ( ".$bank_name." ) - ( ".$account_number." )", 0, 'C', 0);
                    } else {
                        $pdf->SetY($start_y);
                        $pdf->SetX(110);
                        $pdf->MultiCell(40, 5, $payment_mode, 0, 'C', 0);
                    } 

                }
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(110);
                $pdf->MultiCell(40, 5, '-', 0, 'C', 0);
            }
            $payment_y = $pdf->GetY() - $start_y;

            $pdf->SetY($start_y);
            $pdf->SetTextColor(0,130,0);
            if(!empty($data['credit'])) {
                $pdf->SetX(150);
                $total_credit+=$data['credit'];
                $pdf->MultiCell(25, 5,$obj->numberFormat($data['credit'],2), 0, 'R', 0);
            } else {
                $pdf->SetX(150);
                $pdf->Cell(25, 5,'0.00', 0, 0,'R', 0);
            }
            $credit_y = $pdf->GetY() - $start_y;

            $pdf->SetY($start_y);
            $pdf->SetTextColor(255,0,0);
            if(!empty($data['debit'])) {
                $pdf->SetX(175);
                $total_debit+=$data['debit'];
                $pdf->MultiCell(25, 5,$obj->numberFormat($data['debit'],2), 0, 'R', 0);
            } else {
                $pdf->SetX(175);
                $pdf->Cell(25, 5,'0.00', 0, 1,'R', 0);
            }
            $pdf->SetTextColor(0,0,0);
            $debit_amount_y = $pdf->GetY() - $start_y;

            $y_array = array($date_y,$party_y,$payment_y,$credit_y);
            $max_y = max($y_array);

            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,$max_y,'',1,0,'C');
            $pdf->SetX(20);
            $pdf->Cell(27,$max_y,'',1,0,'C');
            $pdf->SetX(47);
            $pdf->Cell(20,$max_y,'',1,0,'C');
            $pdf->SetX(67);
            $pdf->Cell(43,$max_y,'',1,0,'C');
            $pdf->SetX(110);
            $pdf->Cell(40,$max_y,'',1,0,'C');
            $pdf->SetX(150);
            $pdf->Cell(25,$max_y,'',1,0,'C');
            $pdf->SetX(175);
            $pdf->Cell(25,$max_y,'',1,1,'C');

            $start_y += $max_y;
            $pdf->SetY($start_y);

            $s_no++;
        }
        
     
        $pdf->SetX(10);
        $pdf->Cell(10,265-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(20);
        $pdf->Cell(27,265-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(47);
        $pdf->Cell(20,265-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(67);
        $pdf->Cell(43,265-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(110);
        $pdf->Cell(40,265-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(150);
        $pdf->Cell(25,265-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(175);
        $pdf->Cell(25,265-$pdf->GetY(),'',1,1,'C',0);

        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10);
        $pdf->Cell(140,8,'Total',1,0,'R',0);
        if(!empty($total_credit)) {
            $pdf->SetX(150);
            $pdf->Cell(25,8,$obj->numberFormat($total_credit,2),1,0,'R',0);
        } else {
            $pdf->SetX(150);
            $pdf->Cell(25,8,' 0 ',1,0,'R',0);
        }
        if(!empty($total_debit)) {
            $pdf->SetX(175);
            $pdf->Cell(25,8,$obj->numberFormat($total_debit,2),1,1,'R',0);
        } else{
            $pdf->SetX(175);
            $pdf->Cell(25,8,' 0 ',1,1,'R',0);
        }

        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10);
        $pdf->Cell(140,8,'Current Balance',1,0,'R',0);
        if($total_credit > $total_debit) { 
            $pdf->SetX(150);
            $pdf->Cell(25,8,$obj->numberFormat($total_credit- $total_debit,2),1,0,'R',0);
        } else {
            $pdf->SetX(150);
            $pdf->Cell(25,8,' ',1,0,'R',0);
        }
        if($total_debit > $total_credit) { 
            $pdf->SetX(175);
            $pdf->Cell(25,8,$obj->numberFormat( $total_debit - $total_credit,2),1,1,'R',0);
        } else {
            $pdf->SetX(175);
            $pdf->Cell(25,8,'  ',1,1,'R',0);
        }   
    }

    $pdf->SetFont('Arial','I',7);
    $pdf->SetY(-10);
    $pdf->SetX(10);
    $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

    $pdf_name = "Payment Report( ". $date_display." ).pdf";
    $pdf->Output($from, $pdf_name);
    
?>