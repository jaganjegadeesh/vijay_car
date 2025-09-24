<?php 
	$page_title = "Stock Report";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        $company_count = $obj->CompanyCount();
        if($company_count == '0') {
            header("Location:dashboard.php");
            exit;
        }
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }
    $from_date=""; $to_date="";
    $from_date = date('Y-m-d', strtotime('-7 days')); $to_date = date('Y-m-d'); $current_date = date('Y-m-d');

    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }
    $product_id ="";
    if(isset($_POST['filter_product_id'])) {
        $product_id = $_POST['filter_product_id'];
    }
    $store_id ="";
    if(isset($_POST['filter_store_id'])) {
        $store_id = $_POST['filter_store_id'];
    }

    $store_list = array();
    $store_list = $obj->getTableRecords($GLOBALS['store_room_table'], '','', '');
    $product_list = array();
    $product_list = $obj->getTableRecords($GLOBALS['product_table'], '','', '');

    $total_records_list = array();

    $total_records_list = $obj->getStockReportList($from_date,$to_date,$product_id,$store_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
</head>	
<body>
<?php include "header.php"; ?>
<!--Right Content-->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                        <div class="border card-box" id="table_records_cover">
                            <div class="card-header align-items-center">
                                <form name="stock_report_form" method="post">
                                    <div class="row justify-content-end p-2">   
                                        <?php if(!empty($product_id)){ ?>
                                            <div class="col-lg-2 col-md-4 col-6 py-2 px-lg-1">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border">
                                                        <input type="date" id="from_date" name="from_date" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" onchange="checkDateCheck();getReport();" class="form-control shadow-none" placeholder="" required max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>From Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-6 py-2 px-lg-1">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border">
                                                        <input type="date" id="to_date" name="to_date" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" onchange="Javascript:checkDateCheck();getReport();" class="form-control shadow-none" placeholder="" required max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>To Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } ?>
                                        <div class="col-lg-2 col-md-4 col-6 py-2 px-lg-1 product">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border mb-0">
                                                    <select name="filter_product_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                        <option value="">Select</option>
                                                        <?php
                                                            if(!empty($product_list)) {
                                                                foreach($product_list as $data) {
                                                                    if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                                                                        ?>
                                                                        <option value="<?php echo $data['product_id']; ?>" <?php if(!empty($product_id) && $product_id == $data['product_id']) { ?>selected<?php } ?>>
                                                                            <?php
                                                                                if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['product_name']);
                                                                                }
                                                                            ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Select Product</label>
                                                </div>
                                            </div> 
                                        </div> 
                                        <div class="col-lg-2 col-md-4 col-6 store py-2 px-lg-1">
                                            <div class="form-group mb-2">
                                                <div class="form-label-group in-border mb-0">
                                                    <select class="select2 select2-danger"  data-dropdown-css-class="select2-danger" style="width: 100%;" name="filter_store_id" onchange="Javascript:getReport();" id="filter_store_id">
                                                        <option value="">Select </option>
                                                        <?php
                                                            if (!empty($store_list)) {
                                                                foreach ($store_list as $data) {
                                                                    if (!empty($data['store_room_id'])) {
                                                                        ?>
                                                                        <option value="<?php echo $data['store_room_id']; ?>" <?php if (!empty($store_id) && $data['store_room_id'] == $store_id) { ?>selected<?php } ?>>
                                                                            <?php if (!empty($data['store_room_name'])) { echo  $obj->encode_decode('decrypt', $data['store_room_name']); }
                                                                            ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Select Store</label>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-12 text-end">
                                            <button class="btn btn-success m-1" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-print"></i> Print </button>
                                            <button class="btn btn-danger m-1" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-download"></i> Export </button>  
                                        </div> 
                                        <div class="col-sm-6 col-xl-8">
                                            <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                            <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                        </div>	
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <?php if(empty($product_id)) { ?>
                                        <table class="table table-bordered nowrap cursor text-center smallfnt" id="tbl_stock_report">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th colspan="4" class="text-center fw-bold">Product Overall Stock <?php if(!empty($from_date)){ echo " ( " .date('d-m-Y',strtotime($from_date )) ." to ". date('d-m-Y',strtotime($to_date )). " )"; }?></th>
                                                </tr>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Product Name</th>
                                                    <th>Current Stock</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $total_stock = 0; $sno = 1;
                                                    if(!empty($total_records_list)) { 
                                                        foreach($total_records_list as $key => $data) {
                                                            $inward_unit = 0; $outward_unit = 0;
                                                            $inward_unit = $obj->getInwardQty('',$store_id,$data['product_id'],$data['unit_id']);

                                                            $outward_unit = $obj->getOutwardQty('',$store_id,$data['product_id'],$data['unit_id']);
                                                            
                                                            $current_stock_unit = 0; $current_stock_subunit = 0;
                                                            $current_stock_unit = $inward_unit - $outward_unit;
                                                            $current_stock_unit = number_format($current_stock_unit, 2);
                                                            $current_stock_unit = str_replace(",", "", $current_stock_unit);
                                                            $unit_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'unit_name');
                                                            $unit_name = $obj->encode_decode('decrypt',$unit_name);
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $sno++; ?></td>
                                                                <td onclick="Javascript:ShowStockProduct('<?php if(!empty($data['product_id'])) { echo $data['product_id']; } ?>');" style="cursor:pointer!important;">
                                                                    <?php
                                                                        $product_name = "";
                                                                        if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                                                                            $product_name = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$data['product_id'],'product_name');
                                                                            echo $obj->encode_decode('decrypt', $product_name);
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        echo $current_stock_unit.' '.$unit_name;
                                                                        $total_stock += $current_stock_unit;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php 
                                                        } 
                                                        ?>
                                                        <tr class="fw-bold">
                                                            <th colspan="2" class="text-end">Total</th>
                                                            <th><?php echo $total_stock; ?> Units</th>
                                                        </tr>
                                                        <?php
                                                    }  
                                                    else {
                                                ?>
                                                        <tr>
                                                            <td colspan="3" class="text-center">Sorry! No records found</td>
                                                        </tr>
                                                <?php 
                                                    } 
                                                ?>
                                            </tbody>
                                        </table> 
                                    <?php } else { ?>
                                        <table class="table table-bordered nowrap text-center smallfnt" id="tbl_stock_report">
                                                <thead style="font-size:13px!important;font-weight:bold!important;">
                                                    <tr style="vertical-align:middle!important;">
                                                        <th colspan="11" style="font-size:18px;">
                                                            <?php if(!empty($product_id)) {
                                                                $product_name = "";
                                                                $product_name = $obj->GetTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
                                                                echo 'Product - '.$obj->encode_decode('decrypt', $product_name);
                                                            } ?>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-success" style="vertical-align:middle!important;">
                                                        <th>S.No</th>
                                                        <th>Date / Bill no</th>
                                                        <th>Type</th>
                                                        <th>Store</th>
                                                        <th>Party</th>
                                                        <th>Inward Unit</th>
                                                        <th>Outward Unit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_inward = 0; $total_outward = 0;
                                                        $total_product_stock = 0;
                                                        if(!empty($total_records_list)) { 
                                                            foreach($total_records_list as $key => $data) {
                                                                $stock_unit_name = $obj->GetTableColumnValue($GLOBALS['unit_table'],'unit_id',$data['unit_id'],'unit_name');
                                                                $stock_unit_name = $obj->encode_decode("decrypt", $stock_unit_name); ?>
                                                                <tr>
                                                                    <th><?php echo $key+1; ?></th>
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['stock_date'])) {
                                                                                echo date('d-m-Y', strtotime($data['stock_date']));
                                                                                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                                                                                echo "<br>".$data['remarks'];
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['stock_type'])) {
                                                                                echo $data['stock_type'];
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['store_id']) && $data['store_id'] != $GLOBALS['null_value']) {
                                                                                $store_name = "";
                                                                                $store_name = $obj->getTableColumnValue($GLOBALS['store_room_table'],'store_room_id',$data['store_id'],'store_room_name');
                                                                                $store_name = $obj->encode_decode('decrypt',$store_name);
                                                                                echo $store_name;
                                                                            }
                                                                            else {
                                                                                echo '-';
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                                                                                $party_name = "";
                                                                                $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $data['party_id'], 'name_mobile_city');
                                                                                
                                                                                if(!empty($party_name) && $party_name != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $party_name);
                                                                                }
                                                                                else {
                                                                                    echo '-';
                                                                                }
                                                                            }
                                                                            else {
                                                                                echo '-';
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if($data['inward_unit'] != $GLOBALS['null_value'] && !empty($data['inward_unit'])) {
                                                                                $total_inward += $data['inward_unit'];
                                                                                echo $data['inward_unit'] . " ".$stock_unit_name;
                                                                            } else {
                                                                                echo '-';
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if($data['outward_unit'] != $GLOBALS['null_value'] && !empty($data['outward_unit'])) {
                                                                                $total_outward += $data['outward_unit'];
                                                                                echo $data['outward_unit']. " ".$stock_unit_name;
                                                                            } else {
                                                                                echo '-';
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                </tr>
                                                            <?php } ?>
                                                            <tr>
                                                                <td colspan="5" class="text-end">Total</td>
                                                                <td><?php if(!empty($total_inward)) { echo number_format($total_inward,2). " ".$stock_unit_name; } else { echo "-"; } ?> </td>
                                                                <td><?php if(!empty($total_outward)) { echo number_format($total_outward,2). " ".$stock_unit_name; } else { echo "-"; } ?> </td>
                                                            </tr>
                                                            <?php if(!empty($total_inward) || !empty($total_outward)) {
                                                                $total_product_stock = $total_inward - $total_outward; ?>
                                                                <tr>
                                                                    <td colspan="5" class="text-end">Current Stock</td>
                                                                    <td colspan="2"><?php echo number_format($total_product_stock,2)." ".$stock_unit_name; ?></td>
                                                                </tr>
                                                            <?php } 
                                                            }
                                                        else { ?>
                                                            <tr>
                                                                <td colspan="8" class="text-center">Sorry! No records found</td>
                                                            </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>          
<!--Right Content End-->
<?php include "footer.php"; ?>
<script src="include/select2/js/select2.min.js"></script>
<script src="include/select2/js/select.js"></script>
<script>
    $(document).ready(function(){
        $("#currentstockreport").addClass("active");
        // table_listing_records_filter();
    });
    function getReport() {
        if(jQuery('form[name="stock_report_form"]').length > 0) {
            jQuery('form[name="stock_report_form"]').submit();
        }
    }
    function ShowStockProduct(product_id) {
        if(jQuery('select[name="filter_product_id"]').length > 0) {
            jQuery('select[name="filter_product_id"]').val(product_id).trigger('change');
        }
    }
</script>