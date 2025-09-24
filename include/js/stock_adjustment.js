function GetStoreProduct() {
    var store_id = "";
	if (jQuery('select[name="selected_store_id"]').length > 0) {
		store_id = jQuery('select[name="selected_store_id"]').val();
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

    var store_id = "";
    if (jQuery('select[name="selected_store_id"]').length > 0) {
		store_id = jQuery('select[name="selected_store_id"]').val();
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


function AddStockProducts(form_name) {
    var check_login_session = 1; var all_errors_check = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function() { jQuery(this).remove(); });
				}

                var store_id = "";
                if(jQuery('select[name="selected_store_id"]').is(":visible")) {
                    if(jQuery('select[name="selected_store_id"]').length > 0) {
                        store_id = jQuery('select[name="selected_store_id"]').val();
                        store_id = jQuery.trim(store_id);
                        if(typeof store_id == "undefined" || store_id == "" || store_id == 0) {
                            all_errors_check = 0;
                            throwerrormsg('selected_store_id', 'select', 'store',form_name );                            
                        }
                    }
                }

                var selected_product_id = "";
                if(jQuery('select[name="selected_product_id"]').is(":visible")) {
                    if(jQuery('select[name="selected_product_id"]').length > 0) {
                        selected_product_id = jQuery('select[name="selected_product_id"]').val();
                        selected_product_id = jQuery.trim(selected_product_id);
                        if(typeof selected_product_id == "undefined" || selected_product_id == "" || selected_product_id == 0) {
                            all_errors_check = 0;
                            throwerrormsg('selected_product_id', 'select', 'Product',form_name );                            
                        }
                    }
                }
                var selected_unit_id = "";
                
                if(jQuery('select[name="selected_unit_id"]').length > 0) {
                    selected_unit_id = jQuery('select[name="selected_unit_id"]').val();
                    selected_unit_id = jQuery.trim(selected_unit_id);
                    if(typeof selected_unit_id == "undefined" || selected_unit_id == "" || selected_unit_id == 0) {
                        all_errors_check = 0;
                        throwerrormsg('selected_unit_id', 'select', 'Unit',form_name );                        
                    }
                }

                var selected_quantity = "";
                if(jQuery('input[name="selected_quantity"]').length > 0) {
                    selected_quantity = jQuery('input[name="selected_quantity"]').val();
                    selected_quantity = jQuery.trim(selected_quantity);
                    if(typeof selected_quantity == "undefined" || selected_quantity == "") {
                        all_errors_check = 0;
                        throwerrormsg('selected_quantity', 'input', 'Qty',form_name );                        
                    }
                    else if(price_regex.test(selected_quantity) == false) {
                        all_errors_check = 0;
                        throwerrormsg('selected_quantity', 'input', 'Qty',form_name );                                                
                    }
                    else if(parseFloat(selected_quantity) > 99999) {
                        all_errors_check = 0;
                        throwerrormsg('selected_quantity', 'input', 'Qty',form_name );                                                
                    }
                }


                var selected_stock_action = "";
                if(jQuery('select[name="selected_stock_action"]').length > 0) {
                    selected_stock_action = jQuery('select[name="selected_stock_action"]').val();
                    selected_stock_action = jQuery.trim(selected_stock_action);
                    if(typeof selected_stock_action == "undefined" || selected_stock_action == "" || selected_stock_action == 0) {
                        all_errors_check = 0;
                            throwerrormsg('selected_stock_action', 'select', 'Action',form_name );                        
                    }
                }

                if(parseFloat(all_errors_check) == 1) {
                    var add = 1;
                    if(selected_product_id != "") {
                        if(jQuery('input[name="product_id[]"]').length > 0) {
                            jQuery('.stock_adjustment_table tbody').find('tr').each(function () {
                                var prev_product_id = ""; var prev_unit_id = "";
                                prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
								if(jQuery(this).find('input[name="unit_id[]"]').length > 0) {
                                   var prev_unit_id = jQuery(this).find('input[name="unit_id[]"]').val();
                                }                                
                                
                                if (prev_product_id == selected_product_id &&  prev_unit_id == selected_unit_id ) {
                                    add = 0;
                                }                                        
                            });
                        }
                    }
                    if(parseFloat(add) == 1) {
                        var product_count = 0;
                        product_count = jQuery('input[name="product_count"]').val();
                        product_count = parseInt(product_count) + 1;
                        jQuery('input[name="product_count"]').val(product_count);

                        var post_url = "stock_adjustment_table.php?product_row_index="+product_count+"&selected_product_id="+selected_product_id+"&selected_unit_id="+selected_unit_id+"&selected_quantity="+selected_quantity+"&selected_stock_action="+selected_stock_action+"&selected_store_id="+store_id;

                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.stock_adjustment_table tbody').find('tr').length > 0) {
                                    jQuery('.stock_adjustment_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.stock_adjustment_table tbody').append(result);
                                }
                            
                                if(jQuery('select[name="selected_store_id"]').length > 0) {
                                    jQuery('select[name="selected_store_id"]').attr('disabled', true);
                                    if(jQuery('input[name="selected_store_id"]').length > 0) {
                                        if(store_id != "") {
                                            jQuery('input[name="selected_store_id"]').attr('disabled', false);
                                            jQuery('input[name="selected_store_id"]').val(store_id);
                                        }
                                    }
                                }
                               
                                if(jQuery('select[name="selected_product_id"]').length > 0) {
                                    jQuery('select[name="selected_product_id"]').val('').trigger('change').select2('open');
                                }
                                if(jQuery('select[name="selected_unit_id"]').length > 0) {
                                    jQuery('select[name="selected_unit_id"]').val('').trigger('change');
                                }
                                if(jQuery('input[name="selected_quantity"]').length > 0) {
                                    jQuery('input[name="selected_quantity"]').val('');
                                }
                                if(jQuery('select[name="selected_stock_action"]').length > 0) {
                                    jQuery('select[name="selected_stock_action"]').val('').trigger('change');
                                }
                                removestock(); CalcTotalQuantity();
                            }
                        });
                    }
                    else {
                        jQuery('.stock_adjustment_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product Already Exists</span>');
                    }
                }
                else {
                    jQuery('.stock_adjustment_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check Product Details</span>');
                }
			}
			else {
				window.location.reload();
			}
		}
	});
}
function removestock(){
	if (jQuery('.current_stock_span').length > 0) {
		jQuery('.current_stock_span').html('');
	}    
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
function DeleteRow(row_index, id_name) {
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
                    if(product_count == 0){
                        if (jQuery('select[name="selected_store_id"]').length > 0) {
                            jQuery('select[name="selected_store_id"]').attr('disabled',false);
                        }                                                                                        
                    }
                }
                SnoCalculation();  CalcTotalQuantity();       
            }
            else {
                window.location.reload();
            }
        }
    });
}

function SnoCalculation() {
    if (jQuery('.sno').length > 0) {
        var row_count = 0;
        row_count = jQuery('.sno').length;
        if (typeof row_count != "undefined" && row_count != null && row_count != 0 && row_count != "") {
            var j = 1;
            var sno = document.getElementsByClassName('sno');
            for (var i = row_count - 1; i >= 0; i--) {
                sno[i].innerHTML = j;
                j = parseInt(j) + 1;
            }
        }
    }
}