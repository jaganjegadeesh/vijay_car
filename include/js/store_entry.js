function getStoreType() {
    var store_type = "";
    if (jQuery('select[name="store_type"]').length > 0) {
        store_type = jQuery('select[name="store_type"]').val();
    }

    if (store_type == '1') {
        jQuery('.store_cover1').removeClass('d-none');
        jQuery('.store_cover2').addClass('d-none');
        jQuery('.store_cover3').addClass('d-none');
        jQuery('.store_data').addClass('d-none');
        $('.subtotal_amount').attr('colspan', 3);

        if (jQuery('select[name="overall_store_id"]').length > 0) {
            jQuery('select[name="overall_store_id"]').val('').trigger('change');
        }
    }
    else if (store_type == '2') {
        jQuery('.store_cover1').addClass('d-none');
        jQuery('.store_cover2').removeClass('d-none');
        jQuery('.store_cover3').removeClass('d-none');
        jQuery('.store_data').removeClass('d-none');
        if (jQuery('select[name="indv_store_id"]').length > 0) {
            jQuery('select[name="indv_store_id"]').val('').trigger('change');
        }
        $('.subtotal_amount').attr('colspan', 4);
    }
}

function GetStoreProduct() {
    var store_type = "";
    if (jQuery('select[name="store_type"]').length > 0) {
        store_type = jQuery('select[name="store_type"]').val();
    }

    var store_id = "";
    if (store_type == '1') {
        if (jQuery('select[name="overall_store_id"]').length > 0) {
            store_id = jQuery('select[name="overall_store_id"]').val();
        }
    }
    else if (store_type == '2') {
        if (jQuery('select[name="indv_store_id"]').length > 0) {
            store_id = jQuery('select[name="indv_store_id"]').val();
        }
    }
    if(store_id == '') {
        return false;
    }
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var post_url = "bill_changes.php?GetStoreProduct=" + store_id;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (jQuery('select[name="selected_product_id"]').length > 0) {
                            jQuery('select[name="selected_product_id"]').html(result);
                            jQuery('select[name="selected_product_id"]').val('').trigger('change');
                        }
                    }
                });
            }
        }
    });

}
function getUnit(selectElement) {

    var store_type = "";
    if (jQuery('select[name="store_type"]').length > 0) {
        store_type = jQuery('select[name="store_type"]').val();
    }

    var store_id = "";
    if (store_type == '1') {
        if (jQuery('select[name="overall_store_id"]').length > 0) {
            store_id = jQuery('select[name="overall_store_id"]').val();
        }
    }
    else if (store_type == '2') {
        if (jQuery('select[name="indv_store_id"]').length > 0) {
            store_id = jQuery('select[name="indv_store_id"]').val();
        }
    }
    if(selectElement.value == '') {
        if (jQuery('input[name="selected_quantity"]').length > 0) {
            jQuery('input[name="selected_quantity"]').val('');
        }
        if (jQuery('input[name="current_stock"]').length > 0) {
            jQuery('input[name="current_stock"]').val('');
        }   
        if(jQuery('.current_stock_span').length > 0) {
            jQuery('.current_stock_span').html('');
        }
        return false;
    }
    var current_stock = 0;
    current_stock = selectElement.options[selectElement.selectedIndex].getAttribute('data-currnet_stock');

    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                var post_url = "bill_changes.php?get_unit=" + selectElement.value + "&store_id=" + store_id;
                jQuery.ajax({
                    url: post_url, success: function (product_unit) {
                        $product_rate = ""; unit = ""; split_array = "";

                        if (product_unit != '') {
                            split_array = product_unit.split("$$$");
                            split_array[0] = jQuery.trim(split_array[0]);
                            split_array[1] = jQuery.trim(split_array[1]);

                        }
                        if (jQuery('#selected_unit_id').length > 0) {
                            jQuery('#selected_unit_id').html(split_array[0]);
                        }
                        if (jQuery('input[name="selected_quantity"]').length > 0) {
                            jQuery('input[name="selected_quantity"]').focus();
                        }
                        if (jQuery('input[name="current_stock"]').length > 0) {
                            jQuery('input[name="current_stock"]').val(current_stock);
                        }
                        if(jQuery('.current_stock_span').length > 0) {
                            jQuery('.current_stock_span').html("Current Stock : " + current_stock);
                        }
                    }
                });

            }
            else {
                window.location.reload();
            }
        }
    });
}

function AddStoreEntry() {
    var check_login_session = 1; var all_errors_check = 1; var form_name = 'store_entry_form';
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }

                var store_type = ""; var to_store_id = "";
                if (jQuery('select[name="store_type"]').length > 0) {
                    store_type = jQuery('select[name="store_type"]').val();
                    store_type = jQuery.trim(store_type);
                    if (typeof store_type == "undefined" || store_type == "" || store_type == 0) {
                        all_errors_check = 0;
                        throwerrormsg('store_type', 'select', 'Select Store Type', form_name);

                    }
                }
                if (store_type == '1') {
                    if (jQuery('select[name="overall_store_id"]').is(":visible")) {
                        if (jQuery('select[name="overall_store_id"]').length > 0) {
                            store_id = jQuery('select[name="overall_store_id"]').val();
                            store_id = jQuery.trim(store_id);
                            if (typeof store_id == "undefined" || store_id == "" || store_id == 0) {
                                all_errors_check = 0;
                                throwerrormsg('overall_store_id', 'select', 'Select Store', form_name);
                            }
                        }
                    } else {
                        if (jQuery('input[name="overall_store_id"]').length > 0) {
                            store_id = jQuery('input[name="overall_store_id"]').val();
                            store_id = jQuery.trim(store_id);
                            if (typeof store_id == "undefined" || store_id == "" || store_id == 0) {
                                all_errors_check = 0;
                                throwerrormsg('overall_store_id', 'select', 'Select Store', form_name);
                            }
                        }
                    }

                }
                else {
                    if (jQuery('select[name="indv_store_id"]').is(":visible")) {
                        if (jQuery('select[name="indv_store_id"]').length > 0) {
                            store_id = jQuery('select[name="indv_store_id"]').val();
                            store_id = jQuery.trim(store_id);
                            if (typeof store_id == "undefined" || store_id == "" || store_id == 0) {
                                all_errors_check = 0;
                                throwerrormsg('indv_store_id', 'select', 'Select Store', form_name);
                            }
                        }
                    } else {
                        if (jQuery('input[name="indv_store_id"]').length > 0) {
                            store_id = jQuery('input[name="indv_store_id"]').val();
                            store_id = jQuery.trim(store_id);
                            if (typeof store_id == "undefined" || store_id == "" || store_id == 0) {
                                all_errors_check = 0;
                                throwerrormsg('indv_store_id', 'select', 'Select Store', form_name);
                            }
                        }
                    }
                }
                
                var selected_product_id = "";
                if (jQuery('select[name="selected_product_id"]').length > 0) {
                    selected_product_id = jQuery('select[name="selected_product_id"]').val();
                    selected_product_id = jQuery.trim(selected_product_id);
                    if (typeof selected_product_id == "undefined" || selected_product_id == "" || selected_product_id == 0) {
                        all_errors_check = 0;
                        throwerrormsg('selected_product_id', 'select', 'Select Item', form_name);
                    }
                }

                var selected_quantity = 0; var current_stock = 0;
                if (jQuery('input[name="current_stock"]').length > 0) {
                    current_stock = jQuery('input[name="current_stock"]').val();
                    current_stock = jQuery.trim(current_stock);
                    if (typeof current_stock == "undefined" || current_stock == "" || current_stock == 0) {
                        current_stock = 0;
                    }
                }
                if (jQuery('input[name="selected_quantity"]').length > 0) {
                    selected_quantity = jQuery('input[name="selected_quantity"]').val();
                    selected_quantity = jQuery.trim(selected_quantity);
                    if (typeof selected_quantity == "undefined" || selected_quantity == "" || selected_quantity == 0) {
                        all_errors_check = 0;
                        throwerrormsg('selected_quantity', 'input', 'Enter qty', form_name);
                    } else if(!jQuery.isNumeric(selected_quantity)) {
                        all_errors_check = 0;
                        throwerrormsg('selected_quantity', 'input', 'Enter valid qty', form_name);
                    }
                    if (parseFloat(selected_quantity) > parseFloat(current_stock)) {
                        all_errors_check = 0;
                        throwerrormsg('selected_quantity', 'input', 'Enter valid qty', form_name);
                    }
                }


                var selected_unit_id = "";
               
                if (jQuery('select[name="selected_unit_id"]').length > 0) {
                    selected_unit_id = jQuery('select[name="selected_unit_id"]').val();
                    selected_unit_id = jQuery.trim(selected_unit_id);
                    if (typeof selected_unit_id == "undefined" || selected_unit_id == "" || selected_unit_id == 0) {
                        all_errors_check = 0;
                        throwerrormsg('selected_unit_id', 'select', 'Select Unit', form_name);
                    }
                }

                if (parseFloat(all_errors_check) == 1) {
                    var add = 1;
                    if (jQuery('input[name="product_id[]"]').length > 0) {
                        jQuery('.store_entry_table tbody').find('tr').each(function () {
                            var prev_product_id = ""; var prev_store_id = ""; var prev_unit_id = "";
                            prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
                            prev_store_id = jQuery(this).find('input[name="store_id[]"]').val();
                            prev_unit_id = jQuery(this).find('input[name="unit_id[]"]').val();
                            if (store_type == '2') {
                                if (prev_product_id == selected_product_id && prev_store_id == store_id && prev_unit_id == selected_unit_id) {
                                    add = 0;
                                }
                            } else {
                                if (prev_product_id == selected_product_id && prev_unit_id == selected_unit_id) {
                                    add = 0;
                                }
                            }
                        });
                    }
                    if (parseFloat(add) == 1) {
                        var product_count = 0;
                        product_count = jQuery('input[name="product_count"]').val();
                        product_count = parseInt(product_count) + 1;
                        jQuery('input[name="product_count"]').val(product_count);

                        var post_url = "store_entry_changes.php?product_row_index=" + product_count + "&selected_product_id=" + selected_product_id + "&selected_unit_id=" + selected_unit_id + "&selected_quantity=" + selected_quantity + "&store_type=" + store_type + "&store_id=" + store_id;
                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.store_entry_table tbody').find('tr').length > 0) {
                                    jQuery('.store_entry_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.store_entry_table tbody').append(result);
                                }
                                if (jQuery('select[name="from_store_id"]').length > 0) {
                                    jQuery('select[name="from_store_id"]').attr('disabled', true);
                                    if (jQuery('input[name="from_store"]').length > 0) {
                                        if (from_store_id != "") {
                                            jQuery('input[name="from_store"]').attr('disabled', false);
                                            jQuery('input[name="from_store"]').val(from_store_id);
                                        }
                                    }
                                }
                                if (jQuery('select[name="to_store_id"]').length > 0) {
                                    jQuery('select[name="to_store_id"]').attr('disabled', true);
                                    if (jQuery('input[name="to_store"]').length > 0) {
                                        if (to_store_id != "") {
                                            jQuery('input[name="to_store"]').attr('disabled', false);
                                            jQuery('input[name="to_store"]').val(to_store_id);
                                        }
                                    }
                                }
                                if (jQuery('input[name="selected_quantity"]').length > 0) {
                                    jQuery('input[name="selected_quantity"]').val('');
                                }
                                if (jQuery('select[name="selected_product_id"]').length > 0) {
                                    jQuery('select[name="selected_product_id"]').val('').trigger('change');
                                }
                                
                                if (jQuery('select[name="selected_unit_id"]').length > 0) {
                                    jQuery('select[name="selected_unit_id"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="store_type"]').length > 0) {
                                    jQuery('select[name="store_type"]').attr('disabled', true);
                                    jQuery('input[name="store_type"]').val(store_type);
                                }
                                if(jQuery('.current_stock_span').length > 0) {
                                    jQuery('.current_stock_span').html('');
                                }
                                CalcTotalQuantity();
                            }
                        });
                    }
                    else {
                        jQuery('.store_entry_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">This Product Already Exists</span>');
                    }
                }
                else {
                    jQuery('.store_entry_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Check All Details</span>');
                }
            }
            else {
                window.location.reload();
            }
        }
    });

}                        

function DeleteStoreRow(row_index, id_name) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('#' + id_name + row_index).length > 0) {
                    jQuery('#' + id_name + row_index).remove();
                }
                if (id_name == 'product_row') {
                    var product_count = 0;
                    product_count = jQuery('input[name="product_count"]').val();
                    product_count = parseInt(product_count) - 1;
                    jQuery('input[name="product_count"]').val(product_count);
                    if (product_count == 0) {
                        if (jQuery('select[name="store_type"]').length > 0) {
                            jQuery('select[name="store_type"]').attr('disabled', false);
                        }
                    }
                }
                CalcTotalQuantity();
            }
            else {
                window.location.reload();
            }
        }
    });
}

function CalcTotalQuantity() {
    var total_qty = 0;
    if (jQuery('input[name="quantity[]"]').length > 0) {
        jQuery('input[name="quantity[]"]').each(function() {
            var quantity = 0;
            quantity = jQuery(this).val();
            quantity = jQuery.trim(quantity);
            if(typeof quantity != "undefined" && quantity != "" && jQuery.isNumeric(quantity)) {
                total_qty = parseFloat(total_qty) + parseFloat(quantity);
            }
        });
    }
    if(jQuery('.total_qty').length > 0) {
        jQuery('.total_qty').html(total_qty);
    }  
}

function ViewJobDetails() {

	if (jQuery('select[name="job_card_id"]').length > 0) {
		type_id = jQuery('select[name="job_card_id"]').val();
	}
	var post_url = "bill_changes.php?view_job_card_details=" + type_id;
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = result.trim();
			// if(jQuery('.details_modal_button').length > 0) {
			//     jQuery('.details_modal_button').trigger('click');
			// }
			var modal = new bootstrap.Modal(document.getElementById('ViewDetailsModal'));
			modal.show();
			if (jQuery('#ViewDetailsModal').length > 0) {
				if (jQuery('#ViewDetailsModal').find('.modal-title').length > 0) {
					jQuery('#ViewDetailsModal').find('.modal-title').html(' Details');
				}
				if (jQuery('#ViewDetailsModal').find('.modal-body').length > 0) {
					jQuery('#ViewDetailsModal').find('.modal-body').html(result);
				}

			}
		}
	});
}
