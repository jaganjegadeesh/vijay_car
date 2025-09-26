<?php 
	$page_title = "Product";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    $product_list = array(); $product_count = 0;
    $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '', '');
    if(!empty($product_list)){
        $product_count = count($product_list);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php include "link_style_script.php"; ?>
     <script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
    <script type="text/javascript" src="include/js/product_upload.js"></script>
    <script type="text/javascript" src="include/js/keyboard_controls.js"></script>
    <script type="text/javascript" src="include/js/creation_module.js"></script>
</head>	
<body>
<?php include "header.php"; ?>

<!--Right Content-->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                        <div class="border card-box" id="table_records_cover">
                            <div class="card-header align-items-center">
                                <form name="table_listing_form" method="post">
                                    <div class="row justify-content-end p-2">   
                                        <div class="col-lg-3 col-md-3 col-6">
                                            <div class="input-group">
                                                <input type="text" name="search_text" class="form-control" style="height:34px;" placeholder="Search By Product Name" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();">
                                                <span class="input-group-text" style="height:34px;" id="basic-addon2" onclick="Javascript:table_listing_records_filter();"><i class="bi bi-search"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-6">
                                            <?php if (count($product_list) > 0) { ?>
                                                <button class="btn btn-success float-right mx-lg-1" style="font-size:11px;" type="button" id="download_product" onClick="ExcelDownload();"> <i class="fa fa-download"></i> Download </button>
                                            <?php } ?>
                                                <button class="btn btn-dark float-right mx-lg-1" style="font-size:11px;" type="button" id="product_upload_excel" onClick="Javascript:ProductUploadCheck('product');"> <i class="fa fa-upload"></i> Upload </button>
                                                <button class="btn btn-warning float-right mx-lg-1" style="font-size:11px;" type="button" id="download_template" onClick="window.open('product_template.php','_self');"> <i class="fa fa-file"></i> Template </button>
                                                <input type="file" name="product_excel_upload" id="product_excel_upload" style="display: none;" accept=".xls,.xlsx" onChange="Javascript:getExcelData(this,'product');">
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6 text-end">
                                            <button class="btn btn-danger" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>   
                                        </div>
                                        
                                        <div class="col-sm-6 col-xl-8">
                                            <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                            <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                            <input type="hidden" name="upload_type" value="">
                                        </div>	
                                    </div>
                                </form>
                                <div class="row add_update_excel_form_content_excel   align-items-cente"></div>
                            </div>
                            <div id="table_listing_records"></div>
                        </div>
                    </div>   
                </div>
            </div>  
        </div>
    </div>          
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#product").addClass("active");
        table_listing_records_filter();
    });
    function ExcelDownload() {
        var search_text = ""; var url = ""; 
        search_text = jQuery('input[name="search_text"]').val();
        url = "product_download.php?search_text="+search_text;
        window.open(url,'_self');
    }
</script>