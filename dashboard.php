<?php 
	$page_title = "Dashboard";
	include("include_user_check_and_files.php");


    $purchase_records_list = $obj->getTableRecords($GLOBALS['purchase_entry_table'],'','');
    $sales_records_list = $obj->getTableRecords($GLOBALS['invoice_table'],'','');

    $purchase_total = 0;
    $sales_total = 0;

    if (!empty($purchase_records_list)) {
        foreach ($purchase_records_list as $purchase) {
            $purchase_total += (float)str_replace(',', '',$purchase['total_amount']);
        }
    }

    if (!empty($sales_records_list)) {
        foreach ($sales_records_list as $sale) {
            $sales_total += (float)str_replace(',', '', $sale['total_amount']);
        }
    }
    $purchase_total = number_format((float)$purchase_total, 2, '.', '');
    $sales_total = number_format((float)$sales_total, 2, '.', '');
    $dataPoints = array(
        array("label" => "Purchase", "symbol" => "P", "y" => $purchase_total),
        array("label" => "Sales", "symbol" => "S", "y" => $sales_total)
    );
    $payment_list = $obj->getPaymentReportList('','','','','','');

    $credit = 0;
    $debit = 0;

    if (!empty($payment_list)) {
        foreach ($payment_list as $payment) {
            $credit += floatval($payment['credit']);
            $debit  += floatval($payment['debit']);
        }
    }
?>
<?php include "header.php"; ?>
<!-- Start right Content here -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title p-3">Purchase vs Sales</h4>
                        </div>
                        <div class="card-body">
                            <div id="purchase_sales" style="height: 320px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-6">  
                   <div class="card">
                        <div class="card-header">
                            <h4 class="card-title p-3">Payment</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" class="chartjs-chart"></canvas>
                        </div>
                    </div>
                </div> 
                
            </div>
            
        </div>
    </div>
    <!-- End Page-content -->   
<?php include "footer.php"; ?>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>   
<script>
    $(document).ready(function(){
        $("#dashboard").addClass("active");
    });
    window.onload = function() { 
        var purchaseData = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;

        var chart1 = new CanvasJS.Chart("purchase_sales", { 
            theme: "light2", animationEnabled: true, 
            // title: { text: "Purchase vs Sales" }, 
            data: [{ 
                type: "doughnut", 
                indexLabel: "{label} - ₹ {y}", 
                showInLegend: true, 
                legendText: "{label} : ₹ {y}",
                dataPoints: purchaseData
            }] 
        }); 
        chart1.render(); 
    }
</script>  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Credit', 'Debit'],
            datasets: [{
                data: [<?= $credit ?>, <?= $debit ?>],
                backgroundColor: ['#36A2EB', '#FF6384'], // blue = credit, red = debit
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let value = context.raw;
                            return context.label + ': ₹ ' + value;
                        }
                    }
                }
            }
        }
    });
</script>