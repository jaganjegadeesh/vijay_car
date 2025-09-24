<?php 
	$page_title = "Dashboard";
	include("include_user_check_and_files.php");


    echo $_SESSION['bill_company_id'];
?>
<?php include "header.php"; ?>
<!-- Start right Content here -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header p-2">
                            <h4 class="card-title p-3">Line Chart</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="lineChart" class="chartjs-chart" data-colors='["--vz-primary-rgb, 0.2", "--vz-primary", "--vz-info-rgb, 0.2", "--vz-info"]'></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header p-2">
                            <h4 class="card-title p-3">Bar Chart</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="bar" class="chartjs-chart" data-colors='["--vz-primary"]'></canvas>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title p-3">Pie Chart</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" class="chartjs-chart" data-colors='["--vz-primary", "--vz-light"]'></canvas>
                        </div>
                    </div>
                </div> 
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title p-3">Donut Chart</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="doughnut" class="chartjs-chart" data-colors='["--vz-primary", "--vz-light"]'></canvas>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- End Page-content -->   
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#dashboard").addClass("active");
    });
</script>  