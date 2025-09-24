<?php

include("include_files.php");

if (isset($_REQUEST['get_city'])) {
	$district = $_REQUEST['get_district'];

	if (!empty($district)) {
		$district = $obj->encode_decode("encrypt", $district);
	}
	$city = "";
	$list = array();
	$list = $obj->getOtherCityList($district);
	foreach ($list as $data) {
		if (!empty($data['city'])) {
			$data['city'] = $obj->encode_decode("decrypt", $data['city']);
			if (!empty($city)) {
				$city = $city . "," . trim($data['city']);
			} else {
				$city = $data['city'];
			}
		}
	}
	if (!empty($city)) {
		echo trim($city);
	}
	exit;
}

if (isset($_REQUEST['others_city'])) {
	$other_city = $_REQUEST['others_city'];
	$selected_district_index = $_REQUEST['selected_district'];
	$form_name = $_REQUEST['form_name'];

	if ($other_city == '1') {
		?>
		<div class="form-group">
			<div class="form-label-group in-border">
				<input type="text" id="others_city" name="others_city" class="form-control shadow-none" value=""
					onkeydown="Javascript:KeyboardControls(this,'text',30,1);">
				<label>Others city <span class="text-danger">*</span></label>
			</div>
			<div class="new_smallfnt">Text Only (Max Char : 30)</div>
		</div>
	<?php
	}
}

if(isset($_REQUEST['custom_model'])) {
	$custom_model = $_REQUEST['custom_model'];
	$list = array(); $options = ''; $page = $_REQUEST['page'];
	if($custom_model == 'party') {
		$options = "<option value=''>Select Party</option>";
		if($page == "Purchase Entry") {
			$list = $obj->getPartyList('1');
		} else {
			$list = $obj->getPartyList('2');
		}
		if(!empty($list)) {
			foreach($list as $data) {
				$options = $options . "<option value='". $data['party_id'] . "'>". $obj->encode_decode('decrypt', $data['name_mobile_city']) ."</option>";
			}
		}
	} else if($custom_model == 'product') {
		$options = "<option value=''>Select Product</option>";
		$list = $obj->getTableRecords($GLOBALS['product_table'], '','');
		if(!empty($list)) {
			foreach($list as $data) {
				$options = $options . "<option value='". $data['product_id'] . "'>". $obj->encode_decode('decrypt', $data['product_name']) ."</option>";
			}
		}
	} else if($custom_model == 'vehicle') {
		$options = "<option value=''>Select Vehicle</option>";
		$list = $obj->getTableRecords($GLOBALS['vehicle_table'], '','');
		if(!empty($list)) {
			foreach($list as $data) {
				$options = $options . "<option value='". $data['vehicle_id'] . "'>". $obj->encode_decode('decrypt', $data['vehicle_no']) ."</option>";
			}
		}
	}
	

	echo $options;
}