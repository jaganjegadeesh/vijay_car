<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['party_module'];
        }
    }

	if(isset($_REQUEST['show_party_id'])) { 
        $show_party_id = $_REQUEST['show_party_id'];
        $show_party_id = trim($show_party_id);

        $add_custom = 0;
        if(isset($_REQUEST['add_custom'])) {
            $add_custom = $_REQUEST['add_custom'];
        }

        $country = "India";$state = "";$district = "";$city = "";$party_name = "";$mobile_number = "";$address = "";$pincode = "";$product_id="";$product_name="";$opening_balance = "";$opening_balance_type = "";$pincode = ""; $state = "Tamil Nadu";$identification = "";$party_type = "";$reference = "";
        
        if(!empty($show_party_id)){
            $party_list = array();
            $party_list = $obj->getTableRecords($GLOBALS['party_table'],'party_id',$show_party_id,'');
            if(!empty($party_list)) {
                foreach($party_list as $data){ 
                    if(!empty($data['party_type'] && $data['party_type'] != $GLOBALS['null_value'])){
                        $party_type = $data['party_type'];
                    }
                    if(!empty($data['party_name']) && $data['party_name'] != $GLOBALS['null_value']){
                        $party_name = $obj->encode_decode("decrypt",$data['party_name']);
                        $party_name = html_entity_decode($party_name);
                    }
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']){
                        $mobile_number = $obj->encode_decode("decrypt",$data['mobile_number']);
                    }
                    if(!empty($data['pincode']) && $data['pincode'] != $GLOBALS['null_value']){
                        $pincode = $obj->encode_decode("decrypt",$data['pincode']);
                    }
                    if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']){
                        $state = $obj->encode_decode("decrypt",$data['state']);
                    }
                    if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']){
                        $district = $obj->encode_decode("decrypt",$data['district']);
                    }
                    if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']){
                        $city = $obj->encode_decode("decrypt",$data['city']);
                    }
                    if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']){
                        $address = $obj->encode_decode("decrypt",$data['address']);
                        $address = html_entity_decode($address);
                    }
                    if(!empty($data['opening_balance']) && $data['opening_balance'] != $GLOBALS['null_value']){
                        $opening_balance = $data['opening_balance'];
                    }
                    if(!empty($data['opening_balance_type']) && $data['opening_balance_type'] != $GLOBALS['null_value']){
                        $opening_balance_type = $data['opening_balance_type'];
                    }
                    if(!empty($data['party_details']) && $data['party_details'] != $GLOBALS['null_value']) {
                        $party_details = $obj->encode_decode('decrypt', $data['party_details']);
                    }
                    if(!empty($data['pincode']) && $data['pincode'] != $GLOBALS['null_value']){
                        $pincode = $obj->encode_decode("decrypt",$data['pincode']);
                    }
                    if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']){
                        $identification = $obj->encode_decode("decrypt",$data['identification']);
                    }
                    if(!empty($data['vehicle_details']) && $data['vehicle_details'] != $GLOBALS['null_value']) {
                        $vehicle_details = $obj->encode_decode('decrypt', $data['vehicle_details']);
                    }
                    if(!empty($data['vehicle_number']) && $data['vehicle_number'] != $GLOBALS['null_value']){
                        $vehicle_number = $obj->encode_decode("decrypt",$data['vehicle_number']);
                    }
                }
            }
        }


        $linked_party = 0;
        if(!empty($show_party_id)){
            $linked_party = $obj->PaymentlinkedParty($show_party_id);
        }

        ?>
        <form class="poppins pd-20 redirection_form" name="party_form" method="POST">
            <?php if(empty($add_custom) && $add_custom == 0) { ?>
                <div class="card-header">
                    <div class="row p-2">
                        <div class="col-lg-8 col-md-8 col-8 align-self-center">
                            <?php if(!empty($show_party_id)){ ?>
                                <div class="h5">Edit Party</div>
                                <?php
                            }else{ ?>
                                <div class="h5">Add Party</div>
                                <?php
                            } ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-4">
                            <button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('party.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_party_id)) { echo $show_party_id; } ?>">
                <input type="hidden" name="add_custom" value="<?php if(!empty($add_custom)) { echo $add_custom; } ?>">
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="party_type" class="select2 select2-danger" style="width: 100%;" onchange="Javascript:InputBoxColor(this,'select');"> 
                                <option value="">Select Party Type</option>
                                <option value="1" <?php if(!empty($party_type) && $party_type == '1'){ ?>selected<?php } ?>>Purchase</option>
                                <option value="2" <?php if(!empty($party_type) && $party_type == '2'){ ?>selected<?php } ?>>Customer</option>
                                <option value="3" <?php if(!empty($party_type) && $party_type == '3'){ ?>selected<?php } ?>>Both</option>
                            </select>
                            <label>Party Type(*)</label>
                        </div>
                    </div>        
                </div>

                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="name" class="form-control shadow-none" value="<?php if(!empty($party_name)){echo $party_name;} ?>"  onkeydown="Javascript:KeyboardControls(this,'text',50,1);"  required>
                            <label>Party Name(*)</label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="mobile_number" name="mobile_number" maxlength="10" class="form-control shadow-none" required value="<?php if(!empty($mobile_number)){echo $mobile_number;} ?>" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'mobile_number',10,'');">
                            <label>Mobile Number(*)</label>
                        </div>
                        <div class="new_smallfnt">Numbers Only (only 10 digits)</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address" onkeydown="Javascript:KeyboardControls(this,'',150,'');InputBoxColor(this,'text');" > <?php if(!empty($address)){echo $address;} ?></textarea>
                            <label>Address</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                           <div class="w-100" style="display:none;">
                                <select class="select2 select2-danger" name="country" id="country" onchange="Javascript:getCountries('party',this.value,'','','');" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option>India</option>
                                </select>
                            </div>
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger"  style="width: 100%;" name="state" onchange="Javascript:getStates('party',this.value,'','');">
                                <option value="">Select State</option>
                            </select>
                            <label>Select State(*)</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="district" class="select2 select2-danger" data-dropdown-css-class="select2-danger"  style="width: 100%;" onchange="Javascript:getDistricts('party',this.value,'');">
                                <option value="">Select District</option>
                            </select>
                            <label>Select District</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="city" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getCities('party','',this.value);">
                                <option>Select City</option>
                            </select>
                            <label>Select City</label>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2 d-none" id="others_city_cover">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border">
                            <input type="text" id="others_city" name="others_city" class="form-control shadow-none" value="<?php if(!empty($others_city)){echo $others_city;} ?>"onkeydown="Javascript:KeyboardControls(this,'text',30,1);">
                            <label>Others city (*)</label>
                        </div>
                        <div class="new_smallfnt">Text Only(Max Char: 30)</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="pincode" class="form-control shadow-none" value="<?php if(!empty($pincode)){echo $pincode;} ?>" required onfocus="Javascript:KeyboardControls(this,'mobile_number',6,'');" maxlength="6">
                            <label>Pincode</label>
                        </div>
                        <div class="new_smallfnt">Numbers Only (only 6 digits)</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="identification" name="identification" class="form-control shadow-none" required  value="<?php if(!empty($identification)){echo $identification;} ?>" onkeydown="Javascript:KeyboardControls(this,'',50,'');InputBoxColor(this,'text');">
                            <label>Identification</label>
                        </div>
                    </div>
                </div>
                <?php /*
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="vehicle_number" name="vehicle_number" class="form-control shadow-none" required  value="<?php if(!empty($vehicle_number)){echo $vehicle_number;} ?>" onkeydown="Javascript:KeyboardControls(this,'',50,'');InputBoxColor(this,'');">
                            <label>Vehicle Number</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="vehicle_details" name="vehicle_details" class="form-control shadow-none" required  value="<?php if(!empty($vehicle_details)){echo $vehicle_details;} ?>" maxlength="100" onkeydown="Javascript:KeyboardControls(this,'',100,'');InputBoxColor(this,'');">
                            <label>Vehicle Details</label>
                        </div>
                    </div>
                </div>
                */ ?>
                <div class="col-lg-3 col-md-4 col-6 py-2 px-lg-1 <?php echo (!empty($linked_party)) ? 'pe-none' : 'pe-auto'; ?>">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" id="opening_balance" name="opening_balance" class="form-control shadow-none" required  value="<?php if(!empty($opening_balance)){echo $opening_balance;} ?>" onfocus="Javascript:KeyboardControls(this,'number',8,1);" maxlength="8">
                                <label>Opening Balance</label>
                                <div class="input-group-append" style="width:40%!important;">
                                  <select name="opening_balance_type" class="select2 select2-danger"  style="width: 100%;" onchange="Javascript:InputBoxColor(this,'select');">
                                    <option value="">Select</option>
                                    <option value="Credit" <?php if(!empty($opening_balance_type) && $opening_balance_type == "Credit"){ ?>selected<?php } ?> <?php if(!empty($opening_balance_type) && $opening_balance_type == 'Debit') { ?>disabled="disabled"<?php } ?>>Credit</option>
                                    <option value="Debit" <?php if(!empty($opening_balance_type) && $opening_balance_type == "Debit"){ ?>selected<?php } ?> <?php if(!empty($opening_balance_type) && $opening_balance_type == 'Credit') { ?>disabled="disabled"<?php } ?>>Debit</option>
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-danger submit_button" type="button"  onClick="Javascript:SaveModalContent(event,'party_form', 'party_changes.php', 'party.php');">
                        Submit
                    </button>
                </div>
            </div>
             <script type="text/javascript">
                getCountries('party','<?php if(!empty($country)) { echo $country; } ?>', '<?php if(!empty($state)) { echo $state; } ?>', '<?php if(!empty($district)) { echo $district; } ?>', '<?php if(!empty($city)) { echo $city; } ?>');
            </script>
             <script type="text/javascript">                
				jQuery(document).ready(function(){
					jQuery('select').select2();
				});

            </script>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 

    if(isset($_POST['edit_id'])) {	
        $name = ""; $name_error = "";  $mobile_number = ""; $mobile_number_error = ""; $district = ""; $district_error = ""; $others_city = ""; $others_city_error = "";   $opening_balance = "";$opening_balance_error = "";$pincode_error = ""; $pincode = ""; $opening_balance_type = "";$opening_balance_type_error = "";$identification = ""; $identification_error = ""; $address = ""; $address_error = ""; $state = ""; $state_error = ""; $city = ""; $city_error = "";$party_error="";$valid_party = ""; $form_name = "party_form"; $party_type = ""; $party_type_error = ""; $vehicle_details = ""; $vehicle_details_error = ""; $vehicle_number = ""; $vehicle_number_error = "";
        
        $edit_id = ""; $add_custom = 0;
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        if(isset($_POST['add_custom'])) {
            $add_custom = $_POST['add_custom'];
        }
        if(isset($_POST['party_type'])){
            $party_type = $_POST['party_type'];
            $party_type = trim($party_type);

            if(empty($party_type)){
                $party_type_error = "Select Party Type";
            }
            if(!empty($party_type_error)){
                if(!empty($valid_party)){
                    $valid_party = $valid_party." ".$valid->error_display($form_name,'party_type',$party_type_error,'select');
                }
                else{
                    $valid_party = $valid->error_display($form_name,'party_type',$party_type_error,'select');
                }
            }
        }

        if(isset($_POST['name'])){
            $name = $_POST['name'];
            $name = trim($name);
        
            if(!empty($name) && strlen($name) > 50) {
                $name_error = "Only 50 characters allowed";
            }
            if(empty($name)){
                $name_error = "Enter the name";
            }
            else {
                $name_error = $valid->valid_name_text($name,'name','1','50');
            }
            if(!empty($name_error)) {
                $valid_party = $valid->error_display($form_name, "name", $name_error, 'text');			
            }
        }
    
        if(isset($_POST['mobile_number'])) {
            $mobile_number = $_POST['mobile_number'];
            $mobile_number = trim($mobile_number);
            $mobile_number_error = $valid->valid_mobile_number($mobile_number, "Mobile number", "1");
            if(!empty($mobile_number_error)) {
                if(!empty($valid_party)) {
                    $valid_party = $valid_party." ".$valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
                }
                else {
                    $valid_party = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
                }
            }
        }

        if(isset($_POST['address'])) {
            $address = $_POST['address'];
            $address = trim($address);
            if(!empty($address)) {
                if(strlen($address) > 150) {
                    $address_error = "Only 150 characters allowed";
                }
                else {
                    $address_error = $valid->valid_address($address, "address", "0","150");   
                }
            }  
            if(!empty($address_error)) {
                if(!empty($valid_party)) {
                    $valid_party = $valid_party." ".$valid->error_display($form_name, "address", $address_error, 'textarea');
                }
                else {
                    $valid_party = $valid->error_display($form_name, "address", $address_error, 'textarea');
                }
            }  
        }

        if(isset($_POST['state'])) {
            $state = $_POST['state'];
            $state = trim($state);
            if(empty($state)){
                $state_error = "Select the state";
            }else{
                $state_error = $valid->common_validation($state,'State','select');
            }
            if(!empty($state_error)) {
                if(!empty($valid_party)) {
                    $valid_party = $valid_party." ".$valid->error_display($form_name, "state", $state_error, 'select');
                }
                else {
                    $valid_party = $valid->error_display($form_name, "state", $state_error, 'select');
                }
            }
        }

        if(isset($_POST['district'])) {
            $district = $_POST['district'];
            $district = trim($district);
            if(!empty($district)){
                $district_error = $valid->common_validation($district,'District','');
                if(!empty($district_error)) {
                    if(!empty($valid_party)) {
                        $valid_party = $valid_party." ".$valid->error_display($form_name, "district", $district_error, 'select');
                    }
                    else {
                        $valid_party = $valid->error_display($form_name, "district", $district_error, 'select');
                    }
                }
            }
        }

        if(isset($_POST['city'])) {
            $city = $_POST['city'];
            $city = trim($city);
            if(!empty($city)){
                $city_error = $valid->common_validation($city,'City','');
                if(!empty($city_error)) {
                    if(!empty($valid_party)) {
                        $valid_party = $valid_party." ".$valid->error_display($form_name, "city", $city_error, 'select');
                    }
                    else {
                        $valid_party = $valid->error_display($form_name, "city", $city_error, 'select');
                    }
                }
                else{
                    if(isset($_POST['others_city']))
                    {
                        $others_city = $_POST['others_city'];
                        $others_city = trim($others_city);
                        if(!empty($city) && $city == "Others") {
                            if(!empty($others_city) && strlen($others_city) > 30) {
                                $others_city_error = "Only 30 characters allowed";
                            }
                            else {
                                $others_city_error = $valid->valid_text($others_city,'City','0','30');
                            }
                            if(!empty($others_city_error)) {
                                if(!empty($valid_party)) {
                                    $valid_party = $valid_party." ".$valid->error_display($form_name, "others_city", $others_city_error, 'text');
                                }
                                else {
                                    $valid_party = $valid->error_display($form_name, "others_city", $others_city_error, 'text');
                                }
                            }
                            else {
                                $city = $others_city;
                                $city = trim($city);
                            }
                        }
                    }
                }
            }
        }

        if(isset($_POST['pincode'])){
            $pincode = $_POST['pincode'];
            if(!empty($pincode)) {
                $pincode_error = $valid->valid_pincode($pincode, "Pincode", "0");
                if(!empty($pincode_error)) {
                    if(!empty($valid_party)) {
                        $valid_party = $valid_party." ".$valid->error_display($form_name, "pincode", $pincode_error, 'text');
                    }
                    else {
                        $valid_party = $valid->error_display($form_name, "pincode", $pincode_error, 'text');
                    }
                }
            } 
        }

        if(isset($_POST['identification'])) {
            $identification = $_POST['identification'];
            $identification = trim($identification);
            if(!empty($identification)) {
                if(strlen($identification) > 50) {
                    $identification_error = "Only 50 characters allowed";
                }
                else {
                    $identification_error = $valid->valid_address($identification, "identification", "0","30");    
                }  
            }
            if(!empty($identification_error)) {
                if(!empty($valid_party)) {
                    $valid_party = $valid_party." ".$valid->error_display($form_name, "identification", $identification_error, 'text');
                }
                else {
                    $valid_party = $valid->error_display($form_name, "identification", $identification_error, 'text');
                }
            }
        }
    
        // if(isset($_POST['vehicle_number'])){
        //     $vehicle_number = $_POST['vehicle_number'];
        //     if(!empty($vehicle_number)) {
        //         $vehicle_number_error = $valid->valid_text_number($vehicle_number, "Vehicle Number", "0");
        //         if(!empty($vehicle_number_error)) {
        //             if(!empty($valid_party)) {
        //                 $valid_party = $valid_party." ".$valid->error_display($form_name, "vehicle_number", $vehicle_number_error, 'text');
        //             }
        //             else {
        //                 $valid_party = $valid->error_display($form_name, "vehicle_number", $vehicle_number_error, 'text');
        //             }
        //         }
        //     } 
        // }

        // if(isset($_POST['vehicle_details'])){
        //     $vehicle_details = $_POST['vehicle_details'];
        //     if(!empty($vehicle_details)) {
        //         $vehicle_details_error = $valid->valid_text_number($vehicle_details, "Vehicle Details", "0");
        //         if(!empty($vehicle_details_error)) {
        //             if(!empty($valid_party)) {
        //                 $valid_party = $valid_party." ".$valid->error_display($form_name, "vehicle_details", $vehicle_details_error, 'text');
        //             }
        //             else {
        //                 $valid_party = $valid->error_display($form_name, "vehicle_details", $vehicle_details_error, 'text');
        //             }
        //         }
        //     } 
        // }

        if(isset($_POST['opening_balance'])){
            $opening_balance = $_POST['opening_balance'];
            if(!empty($opening_balance)){
            
                if($opening_balance > 999999){
                    $opening_balance_error = "Only 6 digits allowed";
                }
                else{
                    $opening_balance_error = $valid->valid_number($opening_balance,"opening balance",'0','');
                }
            }
        }

        if(isset($_POST['opening_balance_type'])){
            $opening_balance_type = $_POST['opening_balance_type'];
            if(!empty($opening_balance) && empty($opening_balance_error)){
                if(empty($opening_balance_type)){
                    $opening_balance_type_error = "Select opening balance type";
                }
                if(!empty($opening_balance_type_error)){
                    if(!empty($valid_party)) {
                        $valid_party = $valid_party." ".$valid->error_display($form_name, "opening_balance_type", $opening_balance_type_error, 'select');
                    }
                    else {
                        $valid_party = $valid->error_display($form_name, "opening_balance_type", $opening_balance_type_error, 'select');
                    }
                }
            }
        }

        if(!empty($opening_balance_type) && empty($opening_balance)){
            $opening_balance_error = "Enter opening balance as type is selected";
        }
        if(!empty($opening_balance_error)){
            if(!empty($valid_party)) {
                $valid_party = $valid_party." ".$valid->error_display($form_name, "opening_balance_type", $opening_balance_error, 'select');
            }
            else {
                $valid_party = $valid->error_display($form_name, "opening_balance_type", $opening_balance_error, 'select');
            }
        }
   
        $result = "";
        if(empty($valid_party)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $bill_company_id =$GLOBALS['bill_company_id'];
    
                $name_mobile_city = ""; $party_details = ""; $lower_case_name=""; $product_name="";
                if(!empty($name)) {
                    $name = htmlentities($name, ENT_QUOTES);
                    $lower_case_name = strtolower($name);
                    $lower_case_name = htmlentities($lower_case_name, ENT_QUOTES);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                }
                if(!empty($name)) {
                    $name_mobile_city = $name;
                    $party_details = $name;
                    $name = $obj->encode_decode('encrypt', $name);
                }
               
                if(!empty($pincode)) {
                    $pincode = $obj->encode_decode('encrypt', $pincode);
                } else {
                    $pincode = $GLOBALS['null_value'];
                }
                if(!empty($address)) {
                    if(!empty($party_details)) {
                        $party_details = $party_details."<br>".$address;
                    }
                    $address = $obj->encode_decode('encrypt', $address);
                }
                else {
                    $address = $GLOBALS['null_value'];
                }
                if(!empty($city)) {
                    if(!empty($party_details)) {
                        $party_details = $party_details."<br>".$city;
                    }
                }
                if(!empty($district)) {
                    if(!empty($party_details)) {
                        $party_details = $party_details."<br>".$district."(Dist.)";
                    }
                }
                if(!empty($state)) {
                    if(!empty($party_details)) {
                        $party_details = $party_details."<br>".$state;
                    }
                    $state = $obj->encode_decode('encrypt', $state);
                }
                if(!empty($mobile_number)) {
                    $mobile_number = str_replace(" ", "", $mobile_number);

                    if(!empty($party_details)) {
                        $party_details = $party_details."<br>"."Mobile : ".$mobile_number;
                    }
                    if(!empty($name_mobile_city)) {
                        $name_mobile_city = $name_mobile_city." (".$mobile_number.")";
                        if(!empty($city)) {
                            $name_mobile_city = $name_mobile_city." - ".$city;
                        }
                       
                    }
                   
                    $mobile_number = $obj->encode_decode('encrypt', $mobile_number);
                }else {
                    $mobile_number = $GLOBALS['null_value'];
                }
                if(!empty($name_mobile_city)){
                    $name_mobile_city = $obj->encode_decode('encrypt', $name_mobile_city);
                }
                if(!empty($identification)) {
                    if(!empty($party_details)) {
                        $party_details = $party_details."<br>".$identification;
                    }
                    $identification = $obj->encode_decode('encrypt', $identification);
                }
                else {
                    $identification = $GLOBALS['null_value'];
                }
                if(!empty($city)) {
                    $city = $obj->encode_decode('encrypt', $city);
                }
                else{
                    $city = $GLOBALS['null_value'];
                }
               
                if(!empty($district)) {
                    $district = $obj->encode_decode('encrypt', $district);
                }
                else{
                    $district = $GLOBALS['null_value'];
                }

                // if(!empty($vehicle_number)) {
                //     $vehicle_number = $obj->encode_decode('encrypt', $vehicle_number);
                // }
                // else{
                //     $vehicle_number = $GLOBALS['null_value'];
                // }

                // if(!empty($vehicle_details)) {
                //     $vehicle_details = $obj->encode_decode('encrypt', $vehicle_details);
                // }
                // else{
                //     $vehicle_details = $GLOBALS['null_value'];
                // }

                if(empty($party_type)){
                    $party_type = $GLOBALS['null_value'];
                }
                if(!empty($party_details)) {
                    $party_details = $obj->encode_decode('encrypt', $party_details);
                }

                $prev_party_id = ""; $party_error = "";	$prev_party_name ="";
                if(!empty($mobile_number)) {
                    $prev_party_id = $obj->PartyMobileExists($mobile_number);
                    if(!empty($prev_party_id) && $prev_party_id != $edit_id) {
                        $prev_party_name = $obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$prev_party_id,'party_name');
                        $prev_party_name = $obj->encode_decode("decrypt",$prev_party_name);
                        $party_error = "This Mobile Number is already exist in ".$prev_party_name;
                        
                    }
                }
                
                
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);                
                $balance = 0;
                if(empty($edit_id)) {
                    if(empty($prev_party_id)) {
                        $action = "";
                        if(!empty($name_mobile_city)) {
                            $action = "New party Created. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                        }
                        $null_value = $GLOBALS['null_value'];
                        $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id','party_type', 'party_id', 'party_name', 'mobile_number', 'name_mobile_city', 'address','state', 'district', 'city', 'party_details','lower_case_name','pincode','opening_balance','opening_balance_type','others_city','identification','deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$party_type."'", "'".$null_value."'", "'".$name."'", "'".$mobile_number."'", "'".$name_mobile_city."'", "'".$address."'","'".$state."'", "'".$district."'", "'".$city."'", "'".$party_details."'","'".$lower_case_name."'","'".$pincode."'","'".$opening_balance."'","'".$opening_balance_type."'","'".$others_city."'","'".$identification."'","'0'");
                        $party_insert_id = $obj->InsertSQL($GLOBALS['party_table'], $columns, $values, 'party_id', '', $action);
                        if(preg_match("/^\d+$/", $party_insert_id)) {	
                            $balance = 1;
                            $party_id = "";
                            $party_id = $obj->getTableColumnValue($GLOBALS['party_table'], 'id', $party_insert_id, 'party_id');
                            
                            if(!empty($add_custom) && $add_custom == 1) { 
                                $result = array('number' => '1', 'msg' => 'Party Successfully Created', 'addcustom'=>'party');
                            } else { 			
                                $result = array('number' => '1', 'msg' => 'Party Successfully Created','party_id' => $party_id);
                            }
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $party_insert_id);
                        }
                    
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $party_error);
                    }
                }
                else {
                    if(empty($prev_party_id) || $prev_party_id == $edit_id) {
                        $getUniqueID = ""; $party_id =$edit_id;
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($name_mobile_city)) {
                                $action = "party Updated. Details - ".$obj->encode_decode('decrypt', $name_mobile_city);
                            }
                        
                            $columns = array(); $values = array();						
                            $columns = array('creator_name','party_type', 'party_name', 'mobile_number', 'name_mobile_city', 'address','state',  'district', 'city', 'party_details','lower_case_name','opening_balance','opening_balance_type','others_city','identification');
                            $values = array("'".$creator_name."'","'".$party_type."'", "'".$name."'", "'".$mobile_number."'", "'".$name_mobile_city."'", "'".$address."'", "'".$state."'", "'".$district."'", "'".$city."'", "'".$party_details."'","'".$lower_case_name."'","'".$opening_balance."'","'".$opening_balance_type."'","'".$others_city."'","'".$identification."'");
                            $user_update_id = $obj->UpdateSQL($GLOBALS['party_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $user_update_id)) {	
                                $balance = 1;
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');	
                                $party_id = $edit_id;
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $user_update_id);
                            }							
                        }
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $party_error);
                    }
                }    
                if(!empty($balance) && $balance == 1 && !empty($opening_balance) && ($opening_balance != $GLOBALS['null_value'])) {
                    $credit  = 0; $debit = 0; $bill_type ="Party Opening Balance";
                    $bill_id = $party_id;
                    $bill_date = date("Y-m-d");;
                    $bill_number =  $GLOBALS['null_value'];

                    if(!empty($edit_id)) {
                        $date = $obj->getTableColumnValue($GLOBALS['payment_table'], 'bill_id', $bill_id, 'bill_date');
                        if(!empty($date)) {
                            $bill_date = $date;
                        }
                    }

                    if(!empty($opening_balance_type) && $opening_balance_type == "Credit") {
                        $credit = $opening_balance;
                        $debit = 0;
                    }
                    else if(!empty($opening_balance_type) && $opening_balance_type == "Debit") {
                        $debit = $opening_balance;
                        $credit = 0;
                    }
                    else {
                        $credit = 0;
                        $debit = 0;
                    }
                    
                    $update_balance ="";
                    $update_balance = $obj->UpdateBalance($bill_company_id,$bill_id,$bill_number,$bill_date,$bill_type,$party_id,$name,$party_type,$GLOBALS['null_value'],$GLOBALS['null_value'],$GLOBALS['null_value'],$GLOBALS['null_value'],$opening_balance,$opening_balance_type,$credit,$debit);
                        
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_party)) {
                $result = array('number' => '3', 'msg' => $valid_party);
            }
        }
        
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;
    }

    
    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title'];

        $search_text = "";
		if(isset($_POST['search_text'])) {
		   $search_text = $_POST['search_text'];
		}

        $filter_party_type = "";
		if(isset($_POST['filter_party_type'])) {
		   $filter_party_type = $_POST['filter_party_type'];
		}

        $total_records_list = array();
        $total_records_list = $obj->GetScreenPartyList($GLOBALS['bill_company_id'],$filter_party_type);
        

        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if(strpos(strtolower($obj->encode_decode('decrypt', $val['name_mobile_city'])), $search_text) !== false) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }
        
        $total_pages = 0;	
        $total_pages = count($total_records_list);
        
        $page_start = 0; $page_end = 0;
        if(!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
            if($total_pages > $page_limit) {
                if($page_number) {
                    $page_start = ($page_number - 1) * $page_limit;
                    $page_end = $page_start + $page_limit;
                }
            }
            else {
                $page_start = 0;
                $page_end = $page_limit;
            }
        }
    
        $show_records_list = array();
        if(!empty($total_records_list)) {
            foreach($total_records_list as $key => $val) {
                if($key >= $page_start && $key < $page_end) {
                    $show_records_list[] = $val;
                }
            }
        }
        
        $prefix = 0;
        if(!empty($page_number) && !empty($page_limit)) {
            $prefix = ($page_number * $page_limit) - $page_limit;
        } 
         if($total_pages > $page_limit) { ?>
            <div class="pagination_cover mt-3"> 
                <?php include("pagination.php"); ?> 
            </div> 
        <?php } ?>
        <?php
            $access_error = "";
            if(!empty($login_staff_id)) {
                $permission_action = $view_action;
                include('permission_action.php');
            }
            if(empty($access_error)) {  ?>
        
		<table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr style="white-space:pre;">
                    <th>S.No</th>
                    <th>Party Type</th>
                    <th>Party Name</th>
                    <th>Mobile</th>
                    <th>State</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        if(!empty($show_records_list)) { 
                            foreach($show_records_list as $key => $data) {
                                $index = $key + 1;
                                if(!empty($prefix)) { $index = $index + $prefix; } 
                    ?>
                                <tr>
                                    <td class="ribbon-header" style="cursor:default;">   
                                        <?php  echo $index; ?>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['party_type'])) {
                                                if($data['party_type'] == 1) { echo "Purchase"; }
                                                else if($data['party_type'] == 2) { echo "Customer"; }
                                                else if($data['party_type'] == 3) { echo "Both"; }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['party_name'])) {
                                                $data['party_name'] = $obj->encode_decode('decrypt', $data['party_name']);
                                                echo $data['party_name'];
                                            }
                                        ?>
                                        <div class="w-100 py-2">
                                            Creator :
                                            <?php
                                                if(!empty($data['creator_name'])) {
                                                    $data['creator_name'] = $obj->encode_decode('decrypt', $data['creator_name']);
                                                    echo $data['creator_name'];
                                                }
                                            ?>                                        
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['mobile_number']) && $data['mobile_number'] != "NULL") {
                                                $data['mobile_number'] = $obj->encode_decode('decrypt', $data['mobile_number']);
                                                echo $data['mobile_number'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['state'])) {
                                                $data['state'] = $obj->encode_decode('decrypt', $data['state']);
                                                echo $data['state'];
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $edit_access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $edit_action;
                                            include('permission_action.php');
                                        }
                                        $delete_access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $delete_action;
                                            include('permission_action.php');
                                        }
                                        if(empty($edit_access_error) || empty($delete_access_error)){ ?>
                                        <div class="dropdown">
                                           <a href="#" role="button" id="dropdownMenuLink1" class="btn btn-dark show-button" class="btn btn-dark show-button poppins" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                              
                                                <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['party_id'])) { echo $data['party_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a></li>
                                                
                                                    <?php 
                                                       
                                                if(empty($delete_access_error)) {
                                                    $linked_count = 0;
                                                    // $linked_count = $obj->GetPartyLinkedCount($data['party_id']); 
                                                    if($linked_count > 0) {
                                                    ?>                             
                                                <li><a class="dropdown-item text-secondary" href="#"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                <?php 
                                                    }
                                                    else {
                                                ?>
                                                <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['party_id'])) { echo $data['party_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                            
                                                <?php 
                                                        }
                                                    } 
                                                ?>
                                            </ul>
                                        </div> 
                                        <?php } ?>
                                    </td>
                                </tr>
                    <?php 
                            } 
                        }  
                        else {
                    ?>
                            <tr>
                                <td colspan="6" class="text-center">Sorry! No records found</td>
                            </tr>
                    <?php 
                        } 
                    ?>
                </tbody>
        </table>   
                      
		<?php	
        }
	}

    if(isset($_REQUEST['delete_party_id'])) {
        $delete_party_id = $_REQUEST['delete_party_id'];
        $msg = "";
        if(!empty($delete_party_id)) {
            $party_unique_id = "";
            $party_unique_id = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $delete_party_id, 'id');
            if(preg_match("/^\d+$/", $party_unique_id)) {
                $party_name = "";
                $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $delete_party_id, 'party_name');

                $action = "";
                if(!empty($party_name)) {
                    $action = "Party Deleted. Name - " . $obj->encode_decode('decrypt', $party_name);
                }
                $linked_count = "";
                $linked_count = 0;
                // $linked_count = $obj->GetPartyLinkedCount($delete_party_id);
                if(empty($linked_count)) {
                    $columns = array();
                    $values = array();
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['party_table'], $party_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "This Party is associated with other screens";
                }
            }
        }
        echo $msg;
        exit;
    }

?>