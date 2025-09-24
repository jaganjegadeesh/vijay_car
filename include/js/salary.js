
function showSalaryRecords() {
    var check_login_session = 1; var all_errors_check = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function() { jQuery(this).remove(); });
				}

                var from_date = "";
                if(jQuery('input[name="from_date"]').length > 0) {
                    from_date = jQuery('input[name="from_date"]').val();
                    from_date = jQuery.trim(from_date);
                    if(typeof from_date == "undefined" || from_date == "" || from_date == 0) {
                        all_errors_check = 0;
                    }
                }

                var to_date = "";
                if(jQuery('input[name="to_date"]').length > 0) {
                    to_date = jQuery('input[name="to_date"]').val();
                    to_date = jQuery.trim(to_date);
                    if(typeof to_date == "undefined" || to_date == "" || to_date == 0) {
                        all_errors_check = 0;
                    }
                }

                if(parseFloat(all_errors_check) == 1) {
                    var engineer_count = 0;
                    engineer_count = jQuery('input[name="engineer_count"]').val();
                    engineer_count = parseInt(engineer_count) + 1;
                    jQuery('input[name="engineer_count"]').val(engineer_count);

                    var post_url = "salary_action_changes.php?product_row_index="+engineer_count+"&from_date="+from_date+"&to_date="+to_date;

                    jQuery.ajax({
                        url: post_url, success: function (result) {
                            result = result.trim();
                            result = result.split('$$$$$$');
                            if (jQuery('.salary_table tbody').find('tr').length > 0) {
                                jQuery('.salary_table tbody').find('tr').before(result[0]);
                            }
                            else {
                                jQuery('.salary_table tbody').append(result[0]);
                            }
                            if(result[1] != "0") {
                                if(jQuery('#view_button').length > 0) {
                                    jQuery('#view_button').addClass('d-none');
                                }
                                if(jQuery('#clear_button').length > 0) {
                                    jQuery('#clear_button').removeClass('d-none');
                                }
                                if(jQuery('input[name="from_date"]').length > 0) {
                                    jQuery('input[name="from_date"]').prop('readonly', true);
                                }
                                if(jQuery('input[name="to_date"]').length > 0) {
                                    jQuery('input[name="to_date"]').prop('readonly', true);
                                }
                                if(jQuery('input[name="salary_date"]').length > 0) {
                                    jQuery('input[name="salary_date"]').prop('readonly', true);
                                }
                            }
                          
                            SalaryTotal();
                        }
                    });
                }
                else {
                    jQuery('.salary_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Check All Details</span>');
                }
			}
			else {
				window.location.reload();
			}
		}
	});
}

function DeleteSalaryRecordRow(id_name, row_index) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('#'+id_name+row_index).length > 0) {
					jQuery('#'+id_name+row_index).remove();
				}
                if(jQuery('.'+id_name).length == 0) {
                    clearSalaryRecords();
                }
                SalaryTotal();
			}
			else {
				window.location.reload();
			}
		}
	});
}

function SalaryTotal() {
    var cash_to_paid_total = 0;
    if(jQuery('.salary_table tbody tr.salary_row').length > 0) {
        jQuery('.salary_table tbody tr.salary_row').each(function() {
           
            var cash_to_paid = 0; 
            if(jQuery(this).find('input[name="cash_to_paid[]"]').length > 0) {
                cash_to_paid = jQuery(this).find('input[name="cash_to_paid[]"]').val();
                cash_to_paid = cash_to_paid.trim();
            }

            if(price_regex.test(cash_to_paid) !== false) {
                cash_to_paid_total = parseFloat(cash_to_paid_total) + parseFloat(cash_to_paid);
                cash_to_paid_total = cash_to_paid_total.toFixed(2);
            }
        });
        
    }

    if(jQuery('.overall_salary').length > 0) {
        jQuery('.overall_salary').html(cash_to_paid_total);
    }
}


function SalaryRowCheck(obj) {
    if (jQuery(obj).closest('tr.salary_row').find('span.infos').length > 0) {
        jQuery(obj).closest('tr.salary_row').find('span.infos').remove();
    }

    var price_regex = /^[0-9]+(\.[0-9]{1,2})?$/; 
    var all_errors_check = 1;
    var deduction_amount = 0;
    var allowance_amount = 0;
    var ot_salary_amount = 0;
    var salary_amount = 0;
    var salary_input = jQuery(obj).closest('tr.salary_row').find('input[name="salary_amount[]"]');
    if (salary_input.length > 0) {
        var salary_value = salary_input.val().trim();
        if (salary_value !== "") {
            salary_amount = parseFloat(salary_value);
        } else {
            salary_amount = 0;
        }
    }
    var ot_check = 1;
    if(jQuery(obj).closest('tr.salary_row').find('input[name="ot_salary[]"]').length > 0) {
        ot_salary_amount = jQuery(obj).closest('tr.salary_row').find('input[name="ot_salary[]"]').val().trim();
        if(ot_salary_amount != "" && ot_salary_amount != 0 && price_regex.test(ot_salary_amount) == false) {
            ot_check = 0;
            jQuery(obj).closest('tr.salary_row').find('input[name="ot_salary[]"]').parent().after('<span class="infos">Invalid OT salary</span>');
        }
    }

    var no_of_days = 0;
    var days_input = jQuery(obj).closest('tr.salary_row').find('input[name="no_of_days[]"]');
    if (days_input.length > 0) {
        var days_value = days_input.val().trim();
        if (days_value !== "") {
            no_of_days = parseFloat(days_value);
        } else {
            no_of_days = 0;
        }
    }


    var advance_amount = 0;
    var advance_input = jQuery(obj).closest('tr.salary_row').find('input[name="advance_amount[]"]');
    if (advance_input.length > 0) {
        var advance_value = advance_input.val().trim();
        if (advance_value !== "") {
            if (!price_regex.test(advance_value)) {
                all_errors_check = 0;
                advance_input.after('<span class="infos">Invalid advance</span>');
            } else {
                advance_amount = parseFloat(advance_value);
            }
        } else {
            advance_amount = 0;
        }
    }



   
    deduction_amount = advance_amount;


  
    if (salary_amount !== 0) {
        if(ot_salary_amount != "" && ot_salary_amount != 0 && parseInt(ot_check) == 1) {
            salary_amount = parseFloat(salary_amount) + parseFloat(ot_salary_amount);
        }
        var net_salary = (salary_amount - deduction_amount) + allowance_amount;
        var cash_to_paid_input = jQuery(obj).closest('tr.salary_row').find('.cash_to_paid');
        var cash_to_paid_hidden_input = jQuery(obj).closest('tr.salary_row').find('input[name="cash_to_paid[]"]');
        if (cash_to_paid_input.length > 0) {
            cash_to_paid_input.text(net_salary.toFixed(2));
        }
        if (cash_to_paid_hidden_input.length > 0) {
            cash_to_paid_hidden_input.val(net_salary.toFixed(2));
        }
    }
    SalaryTotal();
}


function clearSalaryRecords() {
    if(jQuery('#view_button').length > 0) {
        jQuery('#view_button').removeClass('d-none');
    }
    if(jQuery('#clear_button').length > 0) {
        jQuery('#clear_button').addClass('d-none');
    }
   
    if(jQuery('.salary_table tbody').find('tr').length > 0) {
        jQuery('.salary_table tbody').find('tr').remove();
    }     
    if(jQuery('input[name="from_date"]').length > 0) {
        jQuery('input[name="from_date"]').prop('readonly', false);
    }
    if(jQuery('input[name="to_date"]').length > 0) {
        jQuery('input[name="to_date"]').prop('readonly', false);
    }
    if(jQuery('input[name="salary_date"]').length > 0) {
        jQuery('input[name="salary_date"]').prop('readonly', false);
    }
    SalaryTotal();
}




