<?php 
    class Stock_functions extends Creation_functions{

        public function StockUpdate($page_table,$in_out_type,$bill_unique_id,$bill_unique_number,$product_id,$remarks, $stock_date, $store_id, $unit_id, $quantity,$party_id) {
            $bill_company_id = $GLOBALS['bill_company_id'];

            $stock_unique_id = ""; 

            if(empty($store_id) ) {
                $store_id = $GLOBALS['null_value'];
            }
            if(empty($unit_id) || $unit_id == $GLOBALS['null_value']) {
                $unit_id = $this->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'unit_id');
            }
            $inward_unit = 0; $outward_unit = 0; 

            if($in_out_type == "In") {
                $inward_unit = $quantity;
            }
            else if($in_out_type == "Out") {
                $outward_unit = $quantity;
            }
            
            $created_date_time = $GLOBALS['create_date_time_label']; 
            $creator = $GLOBALS['creator'];
            $creator_name = $this->encode_decode('encrypt', $GLOBALS['creator_name']);
        
            $stock_action = ""; 
            if($in_out_type == "In") {
                $stock_action = $GLOBALS['stock_action_plus'];
            }
            else if($in_out_type == "Out") {
                $stock_action = $GLOBALS['stock_action_minus'];
            }
            
            $stock_type = "";
            if($page_table == $GLOBALS['purchase_entry_table']) {
                $stock_type = "Purchase Entry";
            } elseif($page_table == $GLOBALS['product_table']){
                $stock_type = "Opening Stock";
            } elseif($page_table == $GLOBALS['store_entry_table']){
                $stock_type = "Store Entry";
            } 
            else if($page_table == $GLOBALS['job_card_table']) {
                $stock_type = "Job Card";
            }
             else if($page_table == $GLOBALS['stock_adjustment_table']) {
                $stock_type = "Stock Adjustment";
            }
            else if($page_table == $GLOBALS['material_transfer_table']) {
                $stock_type = "Material Transfer";
            }
            else {
                $stock_type = "Others";
            }

            if(empty($bill_unique_number)) {
                $bill_unique_number = $GLOBALS['null_value'];
            }
            
            $stock_unique_id = $this->getStockUniqueID($bill_unique_id,$store_id, $product_id, $unit_id);

            if(preg_match("/^\d+$/", $stock_unique_id)) {
                $action = "Updated Successfully!";
                $columns = array(); $values = array();
                $columns = array( 'creator_name', 'stock_date', 'inward_unit',  'outward_unit',  'stock_action', 'bill_unique_number', 'remarks','party_id');
                $values = array("'".$creator_name."'", "'".$stock_date."'","'".$inward_unit."'",  "'".$outward_unit."'",  "'".$stock_action."'", "'".$bill_unique_number."'", "'".$remarks."'","'".$party_id."'");
                $stock_update_id = $this->UpdateSQL($GLOBALS['stock_table'], $stock_unique_id, $columns, $values, $action);
            }
            else {
                $action = "Inserted Successfully!";
                $columns = array(); $values = array();
                $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id' ,'stock_date', 'store_id', 'product_id', 'unit_id', 'inward_unit','outward_unit', 'stock_type', 'stock_action', 'bill_unique_id', 'bill_unique_number', 'remarks', 'party_id','deleted');
                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'" ,"'".$stock_date."'", "'".$store_id."'",  "'".$product_id."'", "'".$unit_id."'", "'".$inward_unit."'", "'".$outward_unit."'", "'".$stock_type."'", "'".$stock_action."'", "'".$bill_unique_id."'", "'".$bill_unique_number."'", "'".$remarks."'", "'".$party_id."'", "'0'");
                $stock_update_id = $this->InsertSQL($GLOBALS['stock_table'], $columns, $values,'', '', $action);
            }
    
        }

        public function getStockUniqueID($bill_unique_id,$store_id, $product_id, $unit_id){
            $where = ""; $select_query = ""; $list = array(); $unique_id = "";
            if(!empty($bill_unique_id)) {
                if(!empty($where)) {
                    $where = $where." bill_unique_id = '".$bill_unique_id."' AND ";
                }
                else {
                    $where = " bill_unique_id = '".$bill_unique_id."' AND ";
                }
            }
            
            if(!empty($store_id)) {
                if(!empty($where)) {
                    $where = $where." store_id = '".$store_id."' AND ";
                }
                else {
                    $where = " store_id = '".$store_id."' AND ";
                }
            }
                                
            if(!empty($product_id)) {
                if(!empty($where)) {
                    $where = $where." product_id = '".$product_id."' AND ";
                }
                else {
                    $where = " product_id = '".$product_id."' AND ";
                }
            }
            if(!empty($unit_id)) {
                if(!empty($where)) {
                    $where = $where." unit_id = '".$unit_id."' AND ";
                }
                else {
                    $where = " unit_id = '".$unit_id."' AND ";
                }
            }
                         
            if(!empty($where)) {
                $select_query = "SELECT id FROM ".$GLOBALS['stock_table']." WHERE ".$where." deleted = '0'";
                $list = $this->getQueryRecords('',$select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $unique_id = $data['id'];
                    }
                }
            }
            return $unique_id;
        }

        public function PrevStockList($bill_unique_id) {
            $select_query = ""; $list = array();
            $select_query = "SELECT * FROM ".$GLOBALS['stock_table']." WHERE bill_unique_id = '".$bill_unique_id."' AND deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
            return $list;
        }

        public function DeletePurchaseInvoice($bill_unique_id) {
            $purchase_entry_list = array(); $store_id = array();  $product_id = array(); $unit_id =array();
            $material_type = "";$gsm = $reel = $reelno = $quantity = array();
            $purchase_entry_list = $this->getTableRecords($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $bill_unique_id, '');
            if(!empty($purchase_entry_list)) {
                foreach($purchase_entry_list as $data) {
                    if(!empty($data['store_id'])) {
                        $store_id = $data['store_id'];
                        $store_id = explode(",", $store_id);
                    }
                   
                    if(!empty($data['product_id'])) {
                        $product_id = $data['product_id'];
                        $product_id = explode(",", $product_id);
                    }
                    if(!empty($data['unit_id'])) {
                        $unit_id = $data['unit_id'];
                        $unit_id = explode(",", $unit_id);
                    }
                    if(!empty($data['quantity'])) {
                        $quantity = $data['quantity'];
                        $quantity = explode(",", $quantity);
                    }                                        
                }
            }
            $can_delete = 1;
            if(!empty($product_id)){
                $index=0;
                for($i=0; $i < count($product_id); $i++) {
                    if(!empty($product_id[$i])) {
                        $current_inward_stock = 0; $current_outward_stock = 0;
                        $current_inward_stock = $this->getInwardQty($bill_unique_id,$store_id[$i],$product_id[$i],$unit_id[$i]);

                        $current_outward_stock = $this->getOutwardQty($bill_unique_id,$store_id[$i],$product_id[$i],$unit_id[$i]);

                        if($current_inward_stock < $current_outward_stock) {
                            $can_delete = 0;
                        }
                    }
                }
            }
            $prev_list = array();
            if($can_delete == '1'){
                $prev_list = $this->PrevStockList($bill_unique_id);
                if(!empty($prev_list)) {
                    foreach($prev_list as $data) {
                        $stock_id = ""; 
                        if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                            $stock_id = $data['id'];
                        }
                        if(preg_match("/^\d+$/", $stock_id)) {
                            $columns = array(); $values = array();
                            $columns = array('deleted');
                            $values = array("'1'");
                            $stock_update_id = $this->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');

                            if(preg_match("/^\d+$/", $stock_update_id)) {
                            }
                        }
                    }
                }
            }
            return $can_delete;
        }

        public function getInwardQty($bill_unique_id,$store_id,$product_id,$unit_id) {
            $where = ""; $select_query = ""; $list = array(); $inward_unit = 0;

            if(!empty($bill_unique_id)) {
                if(!empty($where)) {
                    $where = $where." bill_unique_id != '".$bill_unique_id."' AND ";
                }
                else {
                    $where = " bill_unique_id != '".$bill_unique_id."' AND ";
                }
            }
            
            if(!empty($store_id)) {
                if(!empty($where)) {
                    $where = $where." store_id = '".$store_id."' AND ";
                }
                else {
                    $where = " store_id = '".$store_id."' AND ";
                }
            }
            if(!empty($product_id)) {
                if(!empty($where)) {
                    $where = $where." product_id = '".$product_id."' AND ";
                }
                else {
                    $where = " product_id = '".$product_id."' AND ";
                }
            }                                          
            if(!empty($unit_id)) {
                if(!empty($where)) {
                    $where = $where." unit_id = '".$unit_id."' AND ";
                }
                else {
                    $where = " unit_id = '".$unit_id."' AND ";
                }
            }
            if(!empty($where)) {
                $select_query = "SELECT SUM(inward_unit) as inward_unit FROM ".$GLOBALS['stock_table']." WHERE ".$where." deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            else
            {
                $select_query = "SELECT SUM(inward_unit) as inward_unit FROM ".$GLOBALS['stock_table']." WHERE  deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            // echo $select_query;
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['inward_unit']) && $data['inward_unit'] != $GLOBALS['null_value']) {
                        $inward_unit = $data['inward_unit'];
                    }
                }
            }
            return $inward_unit;
        } 
               
        public function getOutwardQty($bill_unique_id,$store_id,$product_id,$unit_id) {
            $where = ""; $select_query = ""; $list = array(); $outward_unit = 0;

            if(!empty($bill_unique_id)) {
                if(!empty($where)) {
                    $where = $where." bill_unique_id != '".$bill_unique_id."' AND ";
                }
                else {
                    $where = " bill_unique_id != '".$bill_unique_id."' AND ";
                }
            }
            
            if(!empty($store_id)) {
                if(!empty($where)) {
                    $where = $where." store_id = '".$store_id."' AND ";
                }
                else {
                    $where = " store_id = '".$store_id."' AND ";
                }
            }
            if(!empty($product_id)) {
                if(!empty($where)) {
                    $where = $where." product_id = '".$product_id."' AND ";
                }
                else {
                    $where = " product_id = '".$product_id."' AND ";
                }
            }                                          
            if(!empty($unit_id)) {
                if(!empty($where)) {
                    $where = $where." unit_id = '".$unit_id."' AND ";
                }
                else {
                    $where = " unit_id = '".$unit_id."' AND ";
                }
            }
            if(!empty($where)) {
                $select_query = "SELECT SUM(outward_unit) as outward_unit FROM ".$GLOBALS['stock_table']." WHERE ".$where." deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            else
            {
                $select_query = "SELECT SUM(outward_unit) as outward_unit FROM ".$GLOBALS['stock_table']." WHERE  deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['outward_unit']) && $data['outward_unit'] != $GLOBALS['null_value']) {
                        $outward_unit = $data['outward_unit'];
                    }
                }
            }
            return $outward_unit;
        } 


        public function DeleteProduct($bill_unique_id) {
            $product_list = array(); $store_id = array();  $product_id = array(); $unit_id =array();
            $quantity = array();
            $product_list = $this->getTableRecords($GLOBALS['product_table'], 'product_id', $bill_unique_id, '');
            if(!empty($product_list)) {
                foreach($product_list as $data) {
                    if(!empty($data['store_room_id'])) {
                        $store_id = $data['store_room_id'];
                        $store_id = explode(",", $store_id);
                    }
                   
                    if(!empty($data['product_id'])) {
                        $product_id = $data['product_id'];
                    }
                    if(!empty($data['unit_id'])) {
                        $unit_id = $data['unit_id'];
                    }
                    if(!empty($data['quantity'])) {
                        $quantity = $data['quantity'];
                        $quantity = explode(",", $quantity);
                    }                                        
                }
            }
            $can_delete = 1;
            if(!empty($product_id)){
                $index=0;
                for($i=0; $i < count($store_id); $i++) {
                    if(!empty($store_id[$i])) {
                        $current_inward_stock = 0; $current_outward_stock = 0;
                        $current_inward_stock = $this->getInwardQty($bill_unique_id,$store_id[$i],$product_id,$unit_id);

                        $current_outward_stock = $this->getOutwardQty($bill_unique_id,$store_id[$i],$product_id,$unit_id);

                        if($current_inward_stock < $current_outward_stock) {
                            $can_delete = 0;
                        }
                    }
                }
            }
            $prev_list = array();
            if($can_delete == '1'){
                $prev_list = $this->PrevStockList($bill_unique_id);
                if(!empty($prev_list)) {
                    foreach($prev_list as $data) {
                        $stock_id = ""; 
                        if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                            $stock_id = $data['id'];
                        }
                        if(preg_match("/^\d+$/", $stock_id)) {
                            $columns = array(); $values = array();
                            $columns = array('deleted');
                            $values = array("'1'");
                            $stock_update_id = $this->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');

                            if(preg_match("/^\d+$/", $stock_update_id)) {
                            }
                        }
                    }
                }
            }
            return $can_delete;
        }

        public function DeleteStoreEntry($bill_unique_id) {
            $store_entry_list = array(); $store_id = array();  $product_id = array(); $unit_id =array(); $quantity = array();
            $store_entry_list = $this->getTableRecords($GLOBALS['store_entry_table'], 'store_entry_id', $bill_unique_id, '');
            $can_delete = 1;
            if(!empty($store_entry_list)) {
                foreach($store_entry_list as $data) {
                    if(!empty($data['job_card_id'])) {
                        $job_card_id = $data['job_card_id'];
                        $job_card_list = $this->getTableRecords($GLOBALS['job_card_table'], 'job_card_id', $job_card_id);
                        $invoice_delete = $job_card_list[0]['invoice_status'];
                        $estimate_delete = $job_card_list[0]['estimate_status'];
                        $quotation_delete = $job_card_list[0]['quotation_status'];
                        if($quotation_delete == '0' && $estimate_delete == '0' && $invoice_delete == '0' && empty($store_delete))  {} else {
                            $can_delete = 0;
                        }
                    }
                    if(!empty($data['store_id'])) {
                        $store_id = $data['store_id'];
                        $store_id = explode(",", $store_id);
                    }
                   
                    if(!empty($data['product_id'])) {
                        $product_id = $data['product_id'];
                        $product_id = explode(",", $product_id);
                    }
                    if(!empty($data['unit_id'])) {
                        $unit_id = $data['unit_id'];
                        $unit_id = explode(",", $unit_id);
                    }
                    if(!empty($data['quantity'])) {
                        $quantity = $data['quantity'];
                        $quantity = explode(",", $quantity);
                    }                                        
                }
            }
            if($can_delete == '1'){
                if(!empty($product_id)){
                    $index=0;
                    for($i=0; $i < count($product_id); $i++) {
                        if(!empty($product_id[$i])) {
                            $current_inward_stock = 0; $current_outward_stock = 0;
                            $current_inward_stock = $this->getInwardQty($bill_unique_id,$store_id[$i],$product_id[$i],$unit_id[$i]);

                            $current_outward_stock = $this->getOutwardQty($bill_unique_id,$store_id[$i],$product_id[$i],$unit_id[$i]);

                            if($current_inward_stock < $current_outward_stock) {
                                $can_delete = 0;
                            }
                        }
                    }
                }
            }
            $prev_list = array();
            if($can_delete == '1'){
                $prev_list = $this->PrevStockList($bill_unique_id);
                if(!empty($prev_list)) {
                    foreach($prev_list as $data) {
                        $stock_id = ""; 
                        if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                            $stock_id = $data['id'];
                        }
                        if(preg_match("/^\d+$/", $stock_id)) {
                            $columns = array(); $values = array();
                            $columns = array('deleted');
                            $values = array("'1'");
                            $stock_update_id = $this->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');

                            if(preg_match("/^\d+$/", $stock_update_id)) {
                            }
                        }
                    }
                }
            }
            return $can_delete;
        }

        public function getMaterialTransferList($from_date, $to_date, $from_store,$to_store,$show_bill) {
            $list = array(); $select_query = ""; $where = "";
            $bill_company_id = $GLOBALS['bill_company_id'];
            if(!empty($bill_company_id)) {
                $where = "bill_company_id = '".$bill_company_id."' ";
            }
            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where." AND material_transfer_date >= '".$from_date."'";
                }
                else {
                    $where = "material_transfer_date >= '".$from_date."'";
                }
            }
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where." AND material_transfer_date <= '".$to_date."'";
                }
                else {
                    $where = "material_transfer_date <= '".$to_date."'";
                }
            }
            if(!empty($from_store)){
                if(!empty($where)) {
                    $where = $where." AND from_location_id = '".$from_store."'";
                }
                else {
                    $where = "from_location_id = '".$from_store."'";
                }
            }
            if(!empty($to_store)){
                if(!empty($where)) {
                    $where = $where." AND to_location_id = '".$to_store."'";
                }
                else {
                    $where = "to_location_id = '".$to_store."'";
                }
            }
            
            if($show_bill == '0' || $show_bill == '1'){
                if(!empty($where)) {
                    $where = $where." AND deleted = '".$show_bill."' ";
                }
                else {
                    $where = "deleted = '".$show_bill."' ";
                }
            }
            if(!empty($where)) {
                $select_query = "SELECT * FROM ".$GLOBALS['material_transfer_table']." WHERE ".$where." ORDER BY id DESC";    
            }
            else{
                $select_query = "SELECT * FROM ".$GLOBALS['material_transfer_table']." WHERE deleted = '0' ORDER BY id DESC";
            }
            
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['material_transfer_table'], $select_query);
            }
            return $list;
        }

        public function DeleteMaterialTransfer($bill_unique_id) {
            $material_transfer_list = array(); $product_id = array(); $unit_ids = array();
            $store_ids = '';          
            $material_transfer_list = $this->getTableRecords($GLOBALS['material_transfer_table'], 'material_transfer_id', $bill_unique_id, '');
            if(!empty($material_transfer_list)) {
                foreach($material_transfer_list as $data) {
                    if(!empty($data['product_id'])) {
                        $product_id = $data['product_id'];
                        $product_id = explode(",", $product_id);
                    }
                    if(!empty($data['unit_id'])) {
                        $unit_ids = $data['unit_id'];
                        $unit_ids = explode(",", $unit_ids);
                    }
                    if(!empty($data['to_location_id'])) {
                        $store_ids = $data['to_location_id'];
                    }
                                                                                                                                      
                }

            }
            $can_delete = 1;
            if(!empty($product_id)){
                for($i=0; $i < count($product_id); $i++) {
                    if(!empty($product_id[$i])) {
                        $current_inward_stock = 0; $current_outward_stock = 0; $current_unit_stock = 0;
                        
                        $current_inward_stock = $this->getInwardQty($bill_unique_id,$store_ids,$product_id[$i],$unit_ids[$i]);
                        $current_outward_stock = $this->getOutwardQty($bill_unique_id,$store_ids,$product_id[$i],$unit_ids[$i]);                                                                                            
                    
                        if($current_inward_stock < $current_outward_stock) {
                            $can_delete = 0;
                        }
                    }
                }
            }
            $prev_list = array();
            if($can_delete == '1'){
                $prev_list = $this->PrevStockList($bill_unique_id);
                if(!empty($prev_list)) {
                    foreach($prev_list as $data) {
                        $stock_id = ""; 
                        if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                            $stock_id = $data['id'];
                        }                        
                        if(preg_match("/^\d+$/", $stock_id)) {
                            $columns = array(); $values = array();
                            $columns = array('deleted');
                            $values = array("'1'");
                            $stock_update_id = $this->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');
                            
                            if(preg_match("/^\d+$/", $stock_update_id)) {
                            }
                        }
                    }
                }
            }
            return $can_delete;
        }

        public function getStockAdjustmentList($from_date, $to_date,$show_bill,$product_id,$store_id) {
			$list = array(); $select_query = ""; $where = "";

			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND stock_adjustment_date >= '".$from_date."'";
				}
				else {
					$where = "stock_adjustment_date >= '".$from_date."'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND stock_adjustment_date <= '".$to_date."'";
				}
				else {
					$where = "stock_adjustment_date <= '".$to_date."'";
				}
			}
			if($show_bill == '0' || $show_bill == '1'){
				if(!empty($where)) {
					$where = $where." AND deleted = '".$show_bill."' ";
				}
				else {
					$where = "deleted = '".$show_bill."' ";
				}
			}
			if(!empty($product_id)) {
                if(!empty($where)) {
                    $where = $where." AND FIND_IN_SET('".$product_id."', product_id)";
                }
                else {
                    $where = " FIND_IN_SET('".$product_id."', product_id)";
                }
            }
			if(!empty($store_id)) {
                if(!empty($where)) {
                    $where = $where." AND FIND_IN_SET('".$store_id."', store_id)";
                }
                else {
                    $where = " FIND_IN_SET('".$store_id."', store_id)";
                }
            }
			if(!empty($filter_number)) {
                if(!empty($where)) {
                    $where = $where." AND  stock_adjustment_number = '".$filter_number."' ";
                }
                else {
                    $where = " stock_adjustment_number = '".$filter_number."' ";
                }
            }

			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['stock_adjustment_table']." WHERE ".$where." ORDER BY id DESC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['stock_adjustment_table']." WHERE  deleted = '0' ORDER BY id DESC";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['stock_adjustment_table'], $select_query);
			}
			return $list;
		}

        public function DeleteStockAdjustment($bill_unique_id) {
            $stock_adjustment_list = array(); $product_id = array(); $stock_action = array(); $unit_ids = array(); $store_ids = array();
            $stock_adjustment_list = $this->getTableRecords($GLOBALS['stock_adjustment_table'], 'stock_adjustment_id', $bill_unique_id, '');
            if(!empty($stock_adjustment_list)) {
                foreach($stock_adjustment_list as $data) {
                    if(!empty($data['product_id'])) {
                        $product_id = $data['product_id'];
                        $product_id = explode(",", $product_id);
                    }
                    if(!empty($data['stock_action'])) {
                        $stock_action = $data['stock_action'];
                        $stock_action = explode(",", $stock_action);
                    }                   
                    if(!empty($data['unit_id'])) {
                        $unit_ids = $data['unit_id'];
                        $unit_ids = explode(",", $unit_ids);
                    }
                    if(!empty($data['store_id'])) {
                        $store_ids = $data['store_id'];
                        $store_ids = explode(",", $store_ids);
                    }                                                                                                                 
                }
            }
            $can_delete = 1;
            if(!empty($product_id)){
                for($i=0; $i < count($product_id); $i++) {
                    if(!empty($product_id[$i])) {
                        $current_inward_stock = 0; $current_outward_stock = 0; 
                        
                        $current_inward_stock = $this->getInwardQty($bill_unique_id,$store_ids[$i],$product_id[$i],$unit_ids[$i]);
                        $current_outward_stock = $this->getOutwardQty($bill_unique_id,$store_ids[$i],$product_id[$i],$unit_ids[$i]);                                                                                            
                        if($current_inward_stock < $current_outward_stock) {
                            $can_delete = 0;
                        }
                    }
                }
            }
            $prev_list = array();
            if($can_delete == '1'){
                $prev_list = $this->PrevStockList($bill_unique_id);
                if(!empty($prev_list)) {
                    foreach($prev_list as $data) {
                        $stock_id = ""; 
                        if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                            $stock_id = $data['id'];
                        }
                        if(preg_match("/^\d+$/", $stock_id)) {
                            $columns = array(); $values = array();
                            $columns = array('deleted');
                            $values = array("'1'");
                            $stock_update_id = $this->UpdateSQL($GLOBALS['stock_table'], $stock_id, $columns, $values, '');
    
                            if(preg_match("/^\d+$/", $stock_update_id)) {
                            }
                        }
                    }
                }
            }
            return $can_delete;
        }
    }