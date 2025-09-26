<?php
include("include_files.php");
?>
<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
<table id="tbl_product_list" class="data-table table nowrap tablefont"
    style="margin: auto; width: 900px;display:none;">
    <thead class="thead-dark">
        <tr>
            <th>S.No</th>
            <th>Product Name</th>
            <th>Hsn Code</th>
            <th>Unit</th>
            <th>Rate</th>
            <th>Tax</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $search_text = "";
        if (isset($_REQUEST['search_text'])) {
            $search_text = $_REQUEST['search_text'];
        }

        $total_records_list = array();
        $total_records_list = $obj->getTableRecords($GLOBALS['product_table'], '', '');
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if((strpos(strtolower($obj->encode_decode('decrypt', $val['product_name'])), $search_text) !== false)) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }

        if (!empty($total_records_list)) {
            foreach ($total_records_list as $key => $data) {
                $index = $key + 1; ?>
                <tr>
                    <td class="ribbon-header" style="cursor:default;"> <?php
                        echo $index; ?>
                    </td>
                    <td> <?php 
                        if (!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                            echo $obj->encode_decode('decrypt', $data['product_name']);
                        } else {
                            echo "-";
                        }  ?>
                    </td>
                    <td> <?php
                        if (!empty($data['hsn_code']) && $data['hsn_code'] != $GLOBALS['null_value']) {
                             echo $obj->encode_decode('decrypt', $data['hsn_code']);
                        } else {
                            echo "-";
                        } ?>
                    </td>
                    <td> <?php
                        if (!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                            echo $obj->encode_decode('decrypt', $data['unit_name']);
                        } else {
                            echo "-";
                        }  ?>
                    </td>
                    <td> <?php
                        if (!empty($data['product_rate']) && $data['product_rate'] != $GLOBALS['null_value']) {
                            echo $data['product_rate'];
                        } else {
                            echo "-";
                        }  ?>
                    </td>
                    <td> <?php
                        if (!empty($data['product_tax']) && $data['product_tax'] != $GLOBALS['null_value']) {
                            echo $data['product_tax'];
                        } else {
                            echo "-";
                        }  ?>
                    </td>
                </tr>
            <?php }
        } ?>
    </tbody>
</table>

<script>
    ExportToExcel();
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_product_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        if (dl) {
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' });
        } else {
            XLSX.writeFile(wb, fn || ('product_list.' + (type || 'xlsx')));
        }
        window.open("product.php", "_self");
    }
</script>