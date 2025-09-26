<?php 
	include("include_files.php");

    if(isset($_REQUEST['get_party_state'])) {
        $party_id = $_REQUEST['get_party_state'];
        $party_state = "";
        if(!empty($party_id)) {
            $party_state = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'state');
            $party_state =$obj->encode_decode('decrypt',$party_state);
        }
        echo $party_state;
    }

    if(isset($_REQUEST['get_unit'])) {
		$get_unit_product_id = ""; $purchase_price = "";
		$get_unit_product_id = $_REQUEST['get_unit'];
		$store_id = $_REQUEST['store_id'];


		
		if(!empty($get_unit_product_id)) {
			$unit_id=""; $subunit_id = "";
			$unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$get_unit_product_id,'unit_id');

			?>
            <option value="">Select</option>
            <option value="<?php echo $unit_id ?>" selected>
                <?php
                    if(!empty($unit_id)) {
                        
                        $unit_name = "";
                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
                        if(!empty($unit_name)) {
                            $unit_name = $obj->encode_decode('decrypt', $unit_name);
                            echo $unit_name;
                        }
                    }
                ?>
            </option>
            <?php
		}
		 ?>
        $$$
        <?php 
           if(!empty($purchase_price) && $purchase_price != $GLOBALS['null_value']){
                echo $purchase_price;
            }
	}

    if(isset($_REQUEST['selected_unit'])) {
        $selected_unit_id = "";$selected_product_id = ""; $quantity = 0; $total_quantity = 0;$unit_id =""; $purchase_rate = 0;
        $selected_product_id = $_REQUEST['product_id'];
        $selected_unit_type = $_REQUEST['selected_unit'];
        $quantity = $_REQUEST['quantity'];
        $purchase_rate = $_REQUEST['rate'];

        if(empty($quantity)){
            $quantity =0;
        }
        $total_quantity = $quantity;
        $amount ="";
        if(!empty($total_quantity) && !empty($purchase_rate))
        {
            $amount = $total_quantity * $purchase_rate;
            $amount = number_format($amount, 2);
            $amount = str_replace(',' ,'',$amount);
        }

        echo $amount;

    }

    if(isset($_REQUEST['view_party_details'])) {
        $type_id = $_REQUEST['view_party_details'];
        $type_id = trim($type_id);
        $type = $_REQUEST['details_type'];
        $type = trim($type);
        $details_list = array();
        if(!empty($type)) {
            $details_list = $obj->getTableRecords($GLOBALS[$type.'_table'], $type.'_id', $type_id);
            
            if(!empty($details_list)) {
                foreach($details_list as $data) {
                    if(!empty($data[$type.'_name']) && $data[$type.'_name'] != $GLOBALS['null_value']) {
                        $name = $obj->encode_decode('decrypt', $data[$type.'_name']);
                    }
                    if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
                        $address = $obj->encode_decode('decrypt', $data['address']);
                    }
                    if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                        $city = $obj->encode_decode('decrypt', $data['city']);
                    }
                    if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
                        $district = $obj->encode_decode('decrypt', $data['district']);
                    }
                    if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
                        $state = $obj->encode_decode('decrypt', $data['state']);
                    }
                    if(!empty($data['pincode']) && $data['pincode'] != $GLOBALS['null_value']) {
                        $pincode = $obj->encode_decode('decrypt', $data['pincode']);
                    }
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                        $mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
                    }
                    if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
                        $email = $obj->encode_decode('decrypt', $data['email']);
                    }
                    if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
                        $identification = $obj->encode_decode('decrypt', $data['identification']);
                    }
                }	
            }

            ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Name </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($name)){ echo ": " .$name; }?> </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Phone Number </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($mobile_number)){ echo ": " .$mobile_number; }?> </div>
                </div>
            </div>
            <?php if(!empty($email) && ($email != 'NULL')){ ?>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-lg-12 col-xl-12 d-flex">
                        <div class="col-lg-4 col-xl-4 col-sm-6"><b>Email </b></div>
                        <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($email)){ echo ": " .$email; }?> </div>
                    </div>
                </div> <?php
            } ?>
            <?php if(!empty($address) && ($address != 'NULL')){ ?>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-lg-12 col-xl-12 d-flex">
                        <div class="col-lg-4 col-xl-4 col-sm-6"><b>Address </b></div>
                        <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($address)){ echo ": " .$address; }?> </div>
                    </div>
                </div> <?php
            } 
            if(!empty($city) && ($city != 'NULL')){ ?>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-lg-12 col-xl-12 d-flex">
                        <div class="col-lg-4 col-xl-4 col-sm-6"><b>City </b></div>
                        <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($city)){ echo ": " .$city; }?> </div>
                    </div>
                </div> <?php
            } ?>
            <?php if(!empty($district) && ($district != 'NULL')){ ?>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-lg-12 col-xl-12 d-flex">
                        <div class="col-lg-4 col-xl-4 col-sm-6"><b>District </b></div>
                        <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($district)){ echo ": " .$district; }?> </div>
                    </div>
                </div> <?php
            } ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>State </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($state)){ echo ": " .$state; }?> </div>
                </div>
            </div>
            <?php if(!empty($identification) && ($identification != 'NULL')){ ?>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-lg-12 col-xl-12 d-flex">
                        <div class="col-lg-4 col-xl-4 col-sm-6"><b>Identification </b></div>
                        <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($identification)){ echo ": " .$identification; }?> </div>
                    </div>
                </div> <?php
            }  
        
        }
    }

    if(isset($_REQUEST['GetStoreProduct'])) {
        $store_id = $_REQUEST['GetStoreProduct'];
        $product_list = array();
        if(!empty($store_id)) {
            $product_list = $obj->getStockReportList('','','',$store_id);
            ?>
            <option value="">Select</option>
            <?php
            if(!empty($product_list)) {
                foreach($product_list as $data) {
                    $product_id = $data['product_id'];
                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
                    $product_name = $obj->encode_decode('decrypt', $product_name);
                    $inward_unit = 0; $outward_unit = 0;
                    $inward_unit = $obj->getInwardQty('',$store_id,$data['product_id'],$data['unit_id']);

                    $outward_unit = $obj->getOutwardQty('',$store_id,$data['product_id'],$data['unit_id']);
                    
                    $current_stock_unit = 0;
                    $current_stock_unit = $inward_unit - $outward_unit;
                    
                    ?>
                    <option value="<?php echo $product_id; ?>" data-currnet_stock="<?php echo $current_stock_unit; ?>"><?php echo $product_name; ?></option>
                    <?php
                }
            }
        }
    }

    if(isset($_REQUEST['view_job_card_details'])) {
        $job_card_id = $_REQUEST['view_job_card_details'];
        $job_card_id = trim($job_card_id);
        $job_card_list = array();
        if(!empty($job_card_id)) {
            $job_card_list = $obj->getTableRecords($GLOBALS['job_card_table'], 'job_card_id', $job_card_id);
            
            if(!empty($job_card_list)) {
                foreach($job_card_list as $data) {
                    if(!empty($data['job_card_number']) && $data['job_card_number'] != $GLOBALS['null_value']) {
                        $job_card_number =  $data['job_card_number'];
                    }
                    if(!empty($data['vehicle_no']) && $data['vehicle_no'] != $GLOBALS['null_value']) {
                        $vehicle_number =  $obj->encode_decode('decrypt',$data['vehicle_no']);
                    }
                    if(!empty($data['party_name_mobile_city']) && $data['party_name_mobile_city'] != $GLOBALS['null_value']) {
                        $customer_name = $obj->encode_decode('decrypt', $data['party_name_mobile_city']);
                    }
                    if(!empty($data['department_name']) && $data['department_name'] != $GLOBALS['null_value']) {
                        $department_name = $obj->encode_decode('decrypt', $data['department_name']);
                    }
                    if(!empty($data['job_card_date']) && $data['job_card_date'] != $GLOBALS['null_value']) {
                        $job_card_date =  $data['job_card_date'];
                        $job_card_date = date('d-m-Y', strtotime($job_card_date));
                    }
                }	
            } ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Date of Entry </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($job_card_date)){ echo ": " .$job_card_date; }?> </div>
                </div>
            </div>
            <?php if(!empty($department_name) && ($department_name != 'NULL')){ ?>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-lg-12 col-xl-12 d-flex">
                        <div class="col-lg-4 col-xl-4 col-sm-6"><b>Department </b></div>
                        <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($department_name)){ echo ": " .$department_name; }?> </div>
                    </div>
                </div> <?php
            } ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Job Card Number </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($job_card_number)){ echo ": " .$job_card_number; }?> </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Vehicle Number </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($vehicle_number)){ echo ": " .$vehicle_number; }?> </div>
                </div>
            </div>
            <?php if(!empty($customer_name) && ($customer_name != 'NULL')){ ?>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-lg-12 col-xl-12 d-flex">
                        <div class="col-lg-4 col-xl-4 col-sm-6"><b>Customer Name </b></div>
                        <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($customer_name)){ echo ": " .$customer_name; }?> </div>
                    </div>
                </div> <?php
            } ?>
            
            <?php if(!empty($address) && ($address != 'NULL')){ ?>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-lg-12 col-xl-12 d-flex">
                        <div class="col-lg-4 col-xl-4 col-sm-6"><b>Address </b></div>
                        <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($address)){ echo ": " .$address; }?> </div>
                    </div>
                </div> <?php
            } ?>
            
            <?php
        }
    }

    if(isset($_REQUEST['GetVehicleHistory'])) {
        $vehicle_id = $_REQUEST['GetVehicleHistory'];
        $sales_list = $obj->getVehicleHistory($vehicle_id);
        $store_data = array();
        if(!empty($sales_list)) { ?>
            <div class="col-12 col-lg-12 h2 text-dark p-3">Job Details :</div>
            <table class="table table-bordered nowrap cursor text-center smallfnt">
                <thead class="bg-light">
                    <th>#</th>
                    <th>Entry Date</th>
                    <th>Job Card Number</th>
                    <th>Department</th>
                    <th>Engineer</th>
                    <th>Details</th>
                </thead>
                <tbody>
                    <?php foreach($sales_list as $key => $list) { ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td>
                                <?php if(!empty($list['job_card_date'])) {
                                    echo date('d-m-Y', strtotime($list['job_card_date']));
                                }?>
                            </td>
                            <td>
                                <?php if(!empty($list['job_card_number'])) {
                                    echo $list['job_card_number'];
                                } ?>
                            </td>
                            <td>
                                <?php if(!empty($list['department_name'])) {
                                    echo $obj->encode_decode('decrypt',$list['department_name']);
                                } ?>
                            </td>
                            <td>
                                <?php if(!empty($list['engineer_id'])) {
                                    $engineer = explode(',',$list['engineer_id']);
                                    $name = array();
                                    for($e=0;$e<count($engineer);$e++) {
                                        $name[$e] = $obj->getTableColumnValue($GLOBALS['engineer_table'],'engineer_id',$engineer[$e],'engineer_name');
                                        $name[$e] = $obj->encode_decode('decrypt',$name[$e]);
                                    }
                                    $engineer_name = implode(', <br>',$name);
                                    if(!empty($engineer_name)) {
                                        echo $engineer_name;
                                    }
                                } ?>
                            </td>
                            <td>
                                <?php if(!empty($list['work_details'])) {
                                    echo $obj->encode_decode('decrypt',$list['work_details']);
                                } ?>
                            </td>
                        </tr>
                    <?php $store_data = array_merge($list['store_details']);
                } ?>
                </tbody>
            </table>
            <?php if(!empty($store_data)) { ?>
                <br><br>
                <div class="col-12 col-lg-12 h2 text-dark p-3">Store Entry Details :</div>

                <table class="table table-bordered nowrap cursor text-center smallfnt">
                    <thead class="bg-light">
                        <th>#</th>
                        <th>Entry Date</th>
                        <th>Store Entry Number</th>
                        <th>Job Card Number</th>
                        <th>Quantity</th>
                    </thead>
                    <tbody>
                        <?php foreach($store_data as $index => $data) {?>
                            <tr>
                                <td><?php echo $index+1;?></td>
                                <td>
                                    <?php if(!empty($data['store_entry_date'])) {
                                        echo date('d-m-Y', strtotime($data['store_entry_date']));
                                    }?>
                                </td>
                                <td>
                                    <?php if(!empty($data['store_entry_number'])) {
                                        echo $data['store_entry_number'],"<br>";
                                    } ?>
                                    <a style="cursor:pointer;" href="reports/rpt_store_entry_a5.php?view_store_entry_id=<?php if(!empty($data['store_entry_id'])) { echo $data['store_entry_id']; } ?>" class="fs-10 text-primary" target="_blank">View <img src="images/pupil.gif" alt="Show" width="15"></a>
                                </td>
                                <td>
                                    <?php if(!empty($data['job_card_number'])) {
                                        echo $data['job_card_number'];
                                    } ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($data['quantity'])) {
                                            echo number_format(array_sum(explode(",", $data['quantity'])),2);
                                        }
                                        else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }
        }
    }