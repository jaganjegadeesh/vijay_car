function GetVehicleDetails() {
    var vehicle_id = jQuery('select[name="vehicle_id"]').val();
    if(vehicle_id == '') {
        jQuery('input[name="vehicle_details"]').val('');
        return false;
    }
    var post_url = "job_card_changes.php?get_vehicle_details="+vehicle_id;
    jQuery.ajax({
        url: post_url, success: function (result) {
            if (result != '') {
                if(jQuery('input[name="vehicle_details"]') .length > 0) {
                    jQuery('input[name="vehicle_details"]').val(result.trim());
                }
            }  else {
                jQuery('input[name="vehicle_details"]').val('');
            }
        }
    });
}