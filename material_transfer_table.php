<?php
	include("include_files.php");

    if(isset($_REQUEST['from_store_id'])){
		$from_store_id = "";
		$from_store_id = $_REQUEST['from_store_id'];

		$store_list = array();
        $select_query = "";
        $select_query ="SELECT * FROM ".$GLOBALS['store_room_table']." WHERE store_room_id !='".$from_store_id."' AND deleted ='0'  ";
        $store_list = $obj->getQueryRecords($GLOBALS['store_room_table'],$select_query);
       
		if(!empty($store_list)){ 
            ?>
			<option value="">Select</option>
			<?php
            $count = count($store_list);
			foreach($store_list as $data){
				if($data['store_room_id'] != $from_store_id){
					$store_id = ""; $store_name = "";
					if(!empty($data['store_room_id'])){
						$store_id = $data['store_room_id'];
					}
					if(!empty($data['store_name'])){
						$store_name = $data['store_name'];
					}
                    ?>

					<option value="<?php if(!empty($data['store_room_id'])) { echo $data['store_room_id']; } ?>" <?php if($count == '1'){ ?>selected<?php } ?>>
						<?php
							if(!empty($data['store_room_name'])) {
								$data['store_room_name'] = $obj->encode_decode('decrypt', $data['store_room_name']);
								echo $data['store_room_name'];
							}
						?>
					</option>

				<?php }
				
			} ?>
			<?php 
		}
	}  


    if(isset($_REQUEST['product_row_index'])) {
        $product_row_index = $_REQUEST['product_row_index'];
        $product_id = $_REQUEST['selected_product_id'];
        $unit_id = $_REQUEST['selected_unit_id'];
        $quantity = $_REQUEST['selected_quantity'];
        $stock_action = $_REQUEST['selected_stock_action'];
        $store_id = $_REQUEST['selected_store_id'];
        ?>
        <tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
            <td class="text-center px-2 py-3 sno"><?php if(!empty($product_row_index)) { echo $product_row_index; } ?></td>
            <td>
                <?php
                    if(!empty($product_id)) {
                        $product_name = "";
                        $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
                        if(!empty($product_name) && $product_name != $GLOBALS['null_value']) {
                            echo $obj->encode_decode('decrypt', $product_name);
                        }
                    }
                ?>
                <input type="hidden" name="product_id[]" value="<?php if(!empty($product_id)) { echo $product_id; } ?>">
            </td>
            <td>
                <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity)) { echo $quantity; }else{ echo "0"; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:CalcTotalQuantity();" style="width: 100px;">
            </td>
            <td>
                <?php
                    if(!empty($unit_id)) {
                        $unit_name = "";
                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
                        if(!empty($unit_name) && $unit_name != $GLOBALS['null_value']) {
                            echo $obj->encode_decode('decrypt', $unit_name);
                        }
                    }
                ?>
                <input type="hidden" name="unit_id[]" value="<?php if(!empty($unit_id)) { echo $unit_id; } ?>">
            </td>
            <td>
                <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
        <?php
    }