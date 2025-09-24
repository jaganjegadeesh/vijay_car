<?php
	include("include_files.php");

	if(isset($_REQUEST['show_company_id'])) { 
        $show_company_id = $_REQUEST['show_company_id'];
        $show_company_id = trim($show_company_id);
      
        $name = ""; $address = ""; $country = "India"; $state = "Tamil Nadu"; $district = ""; $tax = "";
        $city = ""; $pincode = ""; $gst_number = ""; $mobile_number = ""; $logo = "";$watermark = ""; $email = "";
        if(!empty($show_company_id)) {
            $company_list = array();
            $company_list = $obj->getTableRecords($GLOBALS['company_table'], 'company_id', $show_company_id,'');
			if(!empty($company_list)) {
				foreach($company_list as $data) {
					if(!empty($data['name'])) {
						$name = html_entity_decode($obj->encode_decode('decrypt', $data['name']));
					}
					if(!empty($data['address'])) {
						$address = $obj->encode_decode('decrypt', $data['address']);
					}
					if(!empty($data['state'])) {
						$state = $obj->encode_decode('decrypt', $data['state']);
					} 
                    if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
						$district = $obj->encode_decode('decrypt', $data['district']);
					} 
                    if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
						$city = $obj->encode_decode('decrypt', $data['city']);
					}                     
					if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']) {
						$gst_number = $obj->encode_decode('decrypt', $data['gst_number']);
					}
                    if(!empty($data['pincode']) && $data['pincode'] != $GLOBALS['null_value']) {
						$pincode = $obj->encode_decode('decrypt', $data['pincode']);
					} 
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
						$mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
					}
                    if(!empty($data['logo']) && $data['logo'] != $GLOBALS['null_value']) {
                        $logo = $data['logo'];
					}
                    if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
                        $email = $obj->encode_decode('decrypt', $data['email']);
					}
                    if(!empty($data['tax']) && $data['tax'] != $GLOBALS['null_value']) {
                        $tax = $data['tax'];
					}
                    if(!empty($data['watermark']) && $data['watermark'] != $GLOBALS['null_value']) {
                        $watermark = $data['watermark'];
					}
                    if(!empty($data['hsn_code']) && $data['hsn_code'] != $GLOBALS['null_value']) {
                        $hsn_code = $data['hsn_code'];
                    }
                     if(!empty($data['gst']) && $data['gst'] != $GLOBALS['null_value']) {
                        $gst = $data['gst'];
                    }
				}
            }
        } 

        $target_dir = $obj->image_directory();?>

        <form class="poppins pd-20" name="company_form" method="POST">
			<div class="card-header ">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<?php if(empty($show_company_id)) { ?>
                            <div class="h5">Add company</div>
                        <?php } else { ?>
                            <div class="h5">Edit company</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('company.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3 justify-content-center">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_company_id)) { echo $show_company_id; } ?>">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" id="company_name" name="company_name" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',40,1);" value="<?php if(!empty($name)) { echo $name; } ?>" placeholder="">
                                    <label>Company Name<span class="text-danger">*</span></label>
                                </div>
                                <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" id="mobile_number" name="mobile_number" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'mobile_number',10,'1');" value="<?php if(!empty($mobile_number)) { echo $mobile_number; } ?>" placeholder="">
                                    <label>Contact Number<span class="text-danger">*</span></label>
                                </div>
                                <div class="new_smallfnt">Numbers Only (only 10 digits)</div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <textarea class="form-control" id="address" name="address" onkeydown="Javascript:KeyboardControls(this,'',150,'1')"; placeholder="Enter Your Address"><?php if(!empty($address)) { echo $address; } ?></textarea>
                                    <label>Address<span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" id="email" name="email" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'email',25,1);" placeholder="" value="<?php if(!empty($email)) { echo $email; } ?>">
                                    <label>Email<span class="text-danger">*</span></label>
                                </div>
                                <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <div class="w-100" style="display:none;">

                                        <select class="select2 select2-danger" name="country" id="country" onchange="Javascript:getCountries('company',this.value,'','','');" data-dropdown-css-class="select2-danger" style="width: 100%;">

                                            <option>India</option>

                                        </select>

                                    </div>

                                    <select class="select2 select2-danger" data-dropdown-css-class="select2-danger"  style="width: 100%;" name="state" onchange="Javascript:getStates('company',this.value,'','');">

                                        <option value="">Select State</option>

                                    </select>

                                    <label>Select State<span class="text-danger">*</span></label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select name="district" class="select2 select2-danger" data-dropdown-css-class="select2-danger"  style="width: 100%;" onchange="Javascript:getDistricts('company',this.value,'');">

                                        <option value="">Select District</option>

                                    </select>
                                    <label>Select District</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select name="city" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getCities('company','',this.value);">

                                        <option>Select City</option>

                                    </select>
                                    <label>Select City</label>
                                </div>
                            </div>        
                        </div>
                         <div class="col-lg-4 col-md-4 col-12 pb-3 d-none" id="others_city_cover">
                            <div class="form-group mb-1">
                                <div class="form-label-group in-border">
                                    <input type="text" id="others_city" name="others_city" class="form-control shadow-none" value="" onkeydown="Javascript:KeyboardControls(this,'text',30,1);">
                                    <label>Others city <span class="text-danger">*</span></label>
                                </div>
                                <div class="new_smallfnt">Text Only(Max Char: 30)</div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" id="pincode" name="pincode" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',6,'');" onkeyup="Javascript:InputBoxColor(this,'text');" value="<?php if(!empty($pincode)) { echo $pincode; } ?>">

                                    <label>Pincode</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 py-2 px-lg-1">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" id="gst_number" name="gst_number" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'',16,'1');" placeholder="" value="<?php if(!empty($gst_number)){echo $gst_number;} ?>">
                                    <label>GST Number</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12 px-lg-1">
                    <div class="row mx-0">
                        <div id="logo_cover" class="form-group">
                            <div class="image-upload text-center">
                                <label for="logo">   
                                    <div class="logo_list row">
                                        <div class="col-12">
                                            <div class="cover">
                                                <?php if(!empty($logo) && file_exists($target_dir.$logo)) { ?>
                                                    <button type="button" onclick="Javascript:delete_upload_image_before_save(this, 'logo', '<?php if(!empty($logo)) { echo $logo; } ?>');" class="btn btn-danger"><i class="fa fa-close"></i></button>
                                                    <img id="logo_preview" src="<?php echo $target_dir.$logo; ?>" style="max-width: 100%; max-height: 150px;" />
                                                    <input type="hidden" name="logo_name[]" value="<?php if(!empty($logo)) { echo $logo; } ?>">
                                                <?php } else { ?>
                                                    <img id="logo_preview" src="images/cloudupload.png" style="max-width: 150px;" />
                                                <?php } ?>
                                            </div>
                                        </div>    
                                        <div class="text-center smallfnt">(Upload jpg, Png Format Less than 2MB)</div>
                                    </div>
                                    <input type="file" name="logo" id="logo" style="display: none;" accept="image/*" />
                                </label>
                            </div>
                            <div class="logo_container" style="display: none;">
                                <canvas id="logo_canvas"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        <div id="watermark_cover" class="form-group">
                            <div class="image-upload text-center">
                                <label for="watermark">   
                                    <div class="watermark_list row">
                                        <div class="col-12">
                                            <div class="cover">
                                                <?php if(!empty($watermark) && file_exists($target_dir.$watermark)) { ?>
                                                    <button type="button" onclick="Javascript:delete_upload_image_before_save(this, 'watermark', '<?php if(!empty($watermark)) { echo $watermark; } ?>');" class="btn btn-danger"><i class="fa fa-close"></i></button>
                                                    <img id="watermark_preview" src="<?php echo $target_dir.$watermark; ?>" style="max-width: 100%; max-height: 150px;" />
                                                    <input type="hidden" name="watermark_name[]" value="<?php if(!empty($watermark)) { echo $watermark; } ?>">
                                                <?php } else { ?>
                                                    <img id="watermark_preview" src="images/cloudupload.png" style="max-width: 150px;" />
                                                <?php } ?>
                                            </div>
                                        </div>    
                                        <div class="text-center smallfnt">(Upload jpg, Png Format Less than 2MB)</div>
                                    </div>
                                    <input type="file" name="watermark" id="watermark" style="display: none;" accept="image/*" />
                                </label>
                            </div>
                            <div class="watermark_container" style="display: none;">
                                <canvas id="watermark_canvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark submit_button" type="button" onClick="Javascript:SaveModalContent(event, 'company_form', 'company_changes.php', 'company.php');"> 
                        Submit
                    </button>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    getCountries('company','<?php if(!empty($country)) { echo $country; } ?>', '<?php if(!empty($state)) { echo $state; } ?>', '<?php if(!empty($district)) { echo $district; } ?>', '<?php if(!empty($city)) { echo $city; } ?>');
                    jQuery('.add_update_form_content').find('select').select2();
                });
            </script>

            <script type="text/javascript" src="include/js/image_upload.js"></script>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 

    if(isset($_POST['company_name'])) {	
        $name = ""; $name_error = ""; $address = ""; $address_error = ""; $hsn_code = ""; $hsn_code_error = "";
        $gst_number = ""; $gst_number_error = ""; $city = ""; $city_error = ""; $district = ""; $district_error = "";
        $state = ""; $state_error = ""; $pincode = ""; $pincode_error = ""; $mobile_number = ""; $mobile_number_error = "";
        $others_city = ""; $others_city_error = ""; $logo_name = array(); $logo = ""; $watermark_name = array(); $watermark = "";
        $valid_company = ""; $form_name = "company_form"; $edit_id = ""; $tax = ""; $tax_error = ""; $email = ""; $email_error = "";

        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        $name = $_POST['company_name'];
        $name = trim($name);
        if(!empty($name) && strlen($name) > 50) {
            $name_error = "Only 50 characters allowed";
        }
        else {
            $name_error = $valid->valid_company_name($name,'name','1');
        }
        if(empty($name_error) && empty($edit_id)) {
            $company_list = array(); $company_count = 0;
            $company_list = $obj->getTableRecords($GLOBALS['company_table'], '', '','');
            if(!empty($company_list)) {
                $company_count = count($company_list);
            }

        }
        if(!empty($name_error)) {
            if(!empty($valid_company)) {
                $valid_company = $valid_company." ".$valid->error_display($form_name, "company_name", $name_error, 'text');
            }
            else {
                $valid_company = $valid->error_display($form_name, "company_name", $name_error, 'text');
            }
        }
        if(isset($_POST['email'])) {
            $email = $_POST['email'];
            $email = trim($email);
        }
        $email_error = $valid->valid_email($email, "Email", "1", "8");
        if (!empty($email_error)) {
            if (!empty($valid_company)) {
                $valid_company = $valid_company . " " . $valid->error_display($form_name, 'email', $email_error, 'text');
            } else {
                $valid_company = $valid->error_display($form_name, 'email', $email_error, 'text');
            }
        }
        if(isset($_POST['address'])) {
            $address = $_POST['address'];
            $address = preg_replace('/\s+/', ' ', $address);
            $address = trim($address);
            if(!empty($address) && strlen($address) > 150) {
                $address_error = "Only 150 characters allowed";
            }
            else {
                $address_error = $valid->valid_address($address,'address','1');
            }
            if(!empty($address_error)) {
                if(!empty($valid_company)) {
                    $valid_company = $valid_company." ".$valid->error_display($form_name, "address", $address_error, 'textarea');
                }
                else {
                    $valid_company = $valid->error_display($form_name, "address", $address_error, 'textarea');
                }
            }
        }
        if(isset($_POST['state'])) {
            $state = $_POST['state'];
            $state = trim($state);
            if(!empty($state)) {
                $state_error = $valid->common_validation($state,'State','select');
            }else{
                $state_error = "Select the State";
            }
            if(!empty($state_error)) {
                if(!empty($valid_company)) {
                    $valid_company = $valid_company." ".$valid->error_display($form_name, "state", $state_error, 'select');
                }
                else {
                    $valid_company = $valid->error_display($form_name, "state", $state_error, 'select');
                }
            }
        }


        if(isset($_POST['district'])) {
            $district = $_POST['district'];
            $district = trim($district);
            // if(!empty($district)) {
            //     $district_error = $valid->common_validation($district,'District','select');
            // }else{
            //     $district_error = "Select the District";
            // }
            // if(!empty($district_error)) {
            //     if(!empty($valid_company)) {
            //         $valid_company = $valid_company." ".$valid->error_display($form_name, "district", $district_error, 'select');
            //     }
            //     else {
            //         $valid_company = $valid->error_display($form_name, "district", $district_error, 'select');
            //     }
            // }
        }

        if(isset($_POST['city'])) {
            $city = $_POST['city'];
            $city = trim($city);
            if(!empty($city)) {
                $city_error = $valid->common_validation($city,'City','select');
            }
            if(!empty($city_error)) {
                if(!empty($valid_company)) {
                    $valid_company = $valid_company." ".$valid->error_display($form_name, "city", $city_error, 'select');
                }
                else {
                    $valid_company = $valid->error_display($form_name, "city", $city_error, 'select');
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
                            $others_city_error = $valid->valid_text($others_city,'City','1');
                        }
                        if(!empty($others_city_error)) {
                            if(!empty($valid_company)) {
                                $valid_company = $valid_company." ".$valid->error_display($form_name, "others_city", $others_city_error, 'text');
                            }
                            else {
                                $valid_company = $valid->error_display($form_name, "others_city", $others_city_error, 'text');
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
        if(empty($city) || $others_city){
            // $city_error = $valid->common_validation($city,'City','select');
            if(!empty($city_error)) {
                if(!empty($valid_company)) {
                    $valid_company = $valid_company." ".$valid->error_display($form_name, "city", $city_error, 'select');
                }
                else {
                    $valid_company = $valid->error_display($form_name, "city", $city_error, 'select');
                }
            }
        }
        if(isset($_POST['pincode'])) {
            $pincode = $_POST['pincode'];
            $pincode = trim($pincode);
            if(!empty($pincode)) {
                $pincode_error = $valid->valid_pincode($pincode, "Pincode", "0");
                if(!empty($pincode_error)) {
                    if(!empty($valid_company)) {
                        $valid_company = $valid_company." ".$valid->error_display($form_name, "pincode", $pincode_error, 'text');
                    }
                    else {
                        $valid_company = $valid->error_display($form_name, "pincode", $pincode_error, 'text');
                    }
                }
            }
        }

        if(isset($_POST['mobile_number'])) {
            $mobile_number = $_POST['mobile_number'];
            $mobile_number = trim($mobile_number);
            $mobile_number_error = $valid->valid_mobile_number($mobile_number, "Mobile Number", "1");
            if(!empty($mobile_number_error)) {
                if(!empty($valid_company)) {
                    $valid_company = $valid_company." ".$valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
                }
                else {
                    $valid_company = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
                }
            }
        }

        if(isset($_POST['gst_number'])) {
            $gst_number = $_POST['gst_number'];
            $gst_number = trim($gst_number);
        
            $gst_number_error = $valid->valid_gst_number($gst_number, "GST Number", '0');
            if(!empty($gst_number_error)) {
                if(!empty($valid_company)) {
                    $valid_company = $valid_company." ".$valid->error_display($form_name, "gst_number", $gst_number_error, 'text');
                }
                else {
                    $valid_company = $valid->error_display($form_name, "gst_number", $gst_number_error, 'text');
                }
            }
        }


        if(isset($_POST['logo_name'])) {
            $logo_name = $_POST['logo_name'];	
        }
        if(isset($_POST['watermark_name'])) {
            $watermark_name = $_POST['watermark_name'];	
        }
        $result = ""; $lower_case_name = "";
        if(empty($valid_company)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            // echo $check_user_id_ip_address;
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                if(!empty($logo_name) && is_array($logo_name)) {
                    $logo = implode("$$$", $logo_name);
                }
                else if(!empty($logo_name)) {
                    $logo = $logo_name;
                }
            
                if(empty($logo)) {
                    $logo = $GLOBALS['null_value'];
                }
                if(!empty($watermark_name) && is_array($watermark_name)) {
                    $watermark = implode("$$$", $watermark_name);
                }
                else if(!empty($watermark_name)) {
                    $watermark = $watermark_name;
                }
            
                if(empty($watermark)) {
                    $watermark = $GLOBALS['null_value'];
                }
                $company_details = "";

                if(!empty($name)) {
                    $company_details = $name;
                    $name = htmlentities($name,ENT_QUOTES);
                    $lower_case_name = strtolower($name);   
                    $name = $obj->encode_decode('encrypt', $name);
                    $lower_case_name = htmlentities($lower_case_name,ENT_QUOTES);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                }

                if(!empty($address)) {
                    if(!empty($company_details)) {
                        $company_details = $company_details."$$$". $address;
                    }
                    $address = htmlentities($address,ENT_QUOTES);
                    $address = $obj->encode_decode('encrypt', $address);
                }
                else {
                    $address = $GLOBALS['null_value'];
                }
                if(!empty($email)) {
                   
                    $email = $obj->encode_decode('encrypt', $email);
                }
                else {
                    $email = $GLOBALS['null_value'];
                }
                if(!empty($city)) {
                    if(!empty($company_details)) {
                        $company_details = $company_details."$$$".$city;
                    }
                    $city = $obj->encode_decode('encrypt', $city);
                }
                else {
                    $city = $GLOBALS['null_value'];
                }
                if(!empty($pincode)) {
                    if(!empty($company_details) && !empty($city)) {
                        $company_details = $company_details." - ".$pincode;
                    }
                    $pincode = $obj->encode_decode('encrypt', $pincode);
                }
                else {
                    $pincode = $GLOBALS['null_value'];
                }
                if(!empty($district)) {
                    if(!empty($company_details)) {
                        $company_details = $company_details."$$$".$district;
                    }
                    $district = $obj->encode_decode('encrypt', $district);
                }
                else {
                    $district = $GLOBALS['null_value'];
                }
                if(!empty($state)) {
                    if(!empty($company_details)) {
                        $company_details = $company_details."$$$".$state;
                    }
                    $state = $obj->encode_decode('encrypt', $state);
                }
                else {
                    $state = $GLOBALS['null_value'];
                }
                if(!empty($mobile_number)) {
                    if(!empty($company_details)) {
                        $company_details = $company_details."$$$ Mobile :".$mobile_number;
                    }
                    $mobile_number = $obj->encode_decode('encrypt', $mobile_number);
                }
                else {
                    $mobile_number = $GLOBALS['null_value'];
                }
                if(!empty($gst_number)) {
                    if(!empty($company_details)) {
                        $company_details = $company_details."$$$ GST No :".$gst_number;
                    }
                    $gst_number = $obj->encode_decode('encrypt', $gst_number);
                }
                else {
                    $gst_number = $GLOBALS['null_value'];
                } 
                if(empty($others_city)) {
                    $others_city = $GLOBALS['null_value'];
                }
                if(!empty($company_details)) {
                    $company_details = $obj->encode_decode('encrypt',$company_details);
                }
                $image_copy = 0; $prev_logo = ""; $prev_watermark = "";
                if(!empty($edit_id)) {		
					$prev_watermark = $obj->getTableColumnValue($GLOBALS['company_table'], 'company_id', $edit_id, 'watermark');
					$prev_logo = $obj->getTableColumnValue($GLOBALS['company_table'], 'company_id', $edit_id, 'logo');
                }


                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];

                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);

                if(empty($edit_id)) {
                    if(empty($prev_company_id)) {
                        $action = "";
                        if(!empty($name)) {
                            $action = "New company Created. Name - ".($obj->encode_decode('decrypt', $name));
                        }

                        $check_company = array(); $company_count = 0;
                        $check_company = $obj->getTableRecords($GLOBALS['company_table'], '', '','');
                        if(!empty($check_company)) {
                            $company_count = count($check_company);
                        }
                        $primary_company = 0;
                        if(empty($company_count)) {
                            $primary_company = 1;
                        }

                        $null_value = $GLOBALS['null_value'];
                        $columns = array();$values = array();

                        $columns = array('created_date_time', 'creator', 'creator_name', 'company_id', 'name', 'lower_case_name', 'address', 'state', 'district', 'city', 'pincode', 'others_city', 'gst_number', 'mobile_number', 'company_details', 'logo','watermark', 'email', 'primary_company','deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$name."'", "'".$lower_case_name."'", "'".$address."'", "'".$state."'", "'".$district."'", "'".$city."'", "'".$pincode."'","'".$others_city."'", "'".$gst_number."'", "'".$mobile_number."'", "'".$company_details."'", "'".$logo."'", "'".$watermark."'", "'".$email."'", "'".$primary_company."'", "'0'");
                        $company_insert_id = $obj->InsertSQL($GLOBALS['company_table'], $columns, $values,'company_id', '', $action);	
                                         
                        if(preg_match("/^\d+$/", $company_insert_id)) {
                            $image_copy = 1;
                            $company_id = $obj->getTableColumnValue($GLOBALS['company_table'], 'id', $company_insert_id, 'company_id');
                            if(empty($company_count) && !empty($company_id)) {
                                $_SESSION['bill_company_id'] = $company_id;
                            }
                            $result = array('number' => '1', 'msg' => 'Company Successfully Created');
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $company_insert_id);
                        }
                    }
                    else {
                        if(!empty($company_error)) {
                            $result = array('number' => '2', 'msg' => $company_error);
                        } 
                    }	
                }
                else {
                    if(empty($prev_company_id) || $prev_company_id == $edit_id) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['company_table'], 'company_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($name)) {
                                $action = "company Updated. Name - ".($obj->encode_decode('decrypt', $name));
                            }
                            $columns = array(); $values = array();						
                            $columns = array('creator_name', 'name', 'lower_case_name', 'address', 'state', 'district', 'city', 'pincode', 'others_city', 'gst_number', 'mobile_number', 'company_details', 'logo','watermark', 'email');
                            $values = array("'".$creator_name."'", "'".$name."'", "'".$lower_case_name."'", "'".$address."'", "'".$state."'", "'".$district."'", "'".$city."'", "'".$pincode."'","'".$others_city."'", "'".$gst_number."'", "'".$mobile_number."'", "'".$company_details."'", "'".$logo."'", "'".$watermark."'", "'".$email."'");
                            $company_update_id = $obj->UpdateSQL($GLOBALS['company_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $company_update_id)) {
                                $image_copy = 1;
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');					
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $company_update_id);
                            }							
                        }
                    }
                    else {

                        $result = array('number' => '2', 'msg' => $company_error);

                    }

                }	

                if(!empty($image_copy) && $image_copy == 1) {
					$target_dir = $obj->image_directory(); $temp_dir = $obj->temp_image_directory();
					if(!empty($logo)) {				
						if(file_exists($temp_dir.$logo)) {   
							if(!empty($prev_logo)) {		
								if(file_exists($target_dir.$prev_logo)) {   
									unlink($target_dir.$prev_logo);
								}
							}
							copy($temp_dir.$logo, $target_dir.$logo);
						}
						else {
							if($logo == $GLOBALS['null_value']) {
								if(!empty($prev_logo) && file_exists($target_dir.$prev_logo)) {   
									unlink($target_dir.$prev_logo);
								}
							}
						}
					}
                    if(!empty($watermark)) {				
						if(file_exists($temp_dir.$watermark)) {   
							if(!empty($prev_watermark)) {		
								if(file_exists($target_dir.$prev_watermark)) {   
									unlink($target_dir.$prev_watermark);
								}
							}
							copy($temp_dir.$watermark, $target_dir.$watermark);
						}
						else {
							if($watermark == $GLOBALS['null_value']) {
								if(!empty($prev_watermark) && file_exists($target_dir.$prev_watermark)) {   
									unlink($target_dir.$prev_watermark);
								}
							}
						}
					}
					$obj->clear_temp_image_directory();
				}
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_company)) {
                $result = array('number' => '3', 'msg' => $valid_company);
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
        $total_records_list = array();
        $total_records_list = $obj->getTableRecords($GLOBALS['company_table'],'','','DESC'); 
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
                <?php  include("pagination.php"); ?> 
            </div>
        <?php  } ?>
        
            <table class="table nowrap cursor text-center smallfnt">
                <thead class="bg-light">
                    <tr>
                        <th>S.No</th>
                        <th>Company Name</th>
                        <th>Mobile</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($show_records_list)) {
                        foreach($show_records_list as $key => $list) {
                            $index = $key + 1;
                            if(!empty($prefix)) { $index = $index + $prefix; } ?>
                            <td><?php echo $index; ?></td>
                            <td>
                                <?php  if(!empty($list['name']) && $list['name'] != $GLOBALS['null_value']) {
                                    echo html_entity_decode($obj->encode_decode('decrypt', $list['name']));
                                } ?>
                            </td>
                            <td>
                                <?php if(!empty($list['mobile_number']) && $list['mobile_number'] != $GLOBALS['null_value']) {
                                    echo $obj->encode_decode('decrypt', $list['mobile_number']);
                                }
                                else {
                                    echo '-';
                                } ?>
                            </td>
                            <td>
                                <?php if(!empty($list['city']) && $list['city'] != $GLOBALS['null_value']) {
                                    echo $obj->encode_decode('decrypt', $list['city']);
                                }
                                else {
                                    echo '-';
                                } ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" role="button" class="btn btn-dark show-button py-1 px-2"  id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <li> <a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['company_id'])) { echo $list['company_id']; } ?>');"><i class="fa fa-pencil" aria-hidden="true"></i> &ensp;Edit</a></li>
                                    </ul>
                                </div> 
                            </td>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="5" class="text-center">Sorry! No records found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table> 
                      
		<?php	
	}
    ?>