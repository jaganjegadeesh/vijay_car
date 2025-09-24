var number_regex = /^\d+$/;
var price_regex = /^(\d*\.)?\d+$/;
var percentage_regex = /^(?:\d{1,2}(?:\.\d{1,2})?)%?$/;
var letter_regex = /^[a-zA-Z\s ]+$/;
var name_regex = /^(?=.*[a-zA-Z])[a-zA-Z\s&\-.']+$/;
var text_no_regex = /^(?=.*[a-zA-Z0-9])[a-zA-Z0-9\s&\-.']+$/;
var product_regex = /^(?=.*[a-zA-Z])[^?!<>$+=`~_|?;^{}]*$/;

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
function addCreationDetails(name, characters) {
    var check_login_session = 1; var all_errors_check = 1; var error = 1; var letters_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }
                var creation_name = "";
                var format = regex;
                var name_variable = "";

                

                name_variable = name.toLowerCase();
                name_variable = name_variable.trim();
                name_variable = name_variable.replace("_", " ");
                if (jQuery('input[name="' + name + '_name"]').is(":visible")) {
                    if (jQuery('input[name="' + name + '_name"]').length > 0) {
                        creation_name = jQuery('input[name="' + name + '_name"]').val();
                        creation_name = creation_name.trim();
                        creation_name = creation_name.replace('&', "@@@");
                        if(creation_name == 'reel_size'){
                            format = '/\d+(\.\d+)?\s*"/g';
                        }
                        if (typeof creation_name == "undefined" || creation_name == "" || creation_name == 0 || creation_name == null) {
                            all_errors_check = 0;
                        }
                        else if (format.test(creation_name) == false) {
                            letters_check = 0;
                        }
                        else if (creation_name.length > parseInt(characters)) {
                            error = 0;
                        }
                    }
                }
                if (parseInt(all_errors_check) == 1) {
                    if (parseInt(letters_check) == 1 || name == "gsm" || name == "reel_size") {
                        if (parseInt(error) == 1) {
                            var add = 1;
                            if (creation_name != "") {
                                if (jQuery('input[name="' + name + '_names[]"]').length > 0) {
                                    jQuery('.added_' + name + '_table tbody').find('tr').each(function () {
                                        var prev_creation_name = jQuery(this).find('input[name="' + name + '_names[]"]').val().toLowerCase();
                                        var current_creation_name = creation_name.toLowerCase();
                                        if (prev_creation_name == current_creation_name) {
                                            add = 0;
                                        }
                                    });
                                }
                            }
                            if (add == 1) {
                                var count = jQuery('input[name="' + name + '_count"]').val();
                                count = parseInt(count) + 1;
                                jQuery('input[name="' + name + '_count"]').val(count);
                                var post_url = name + "_changes.php?" + name + "_row_index=" + count + "&selected_" + name + "_name=" + creation_name;
                                console.log(post_url);
                                jQuery.ajax({
                                    url: post_url, success: function (result) {
                                        if (jQuery('.added_' + name + '_table tbody').find('tr').length > 0) {
                                            jQuery('.added_' + name + '_table tbody').find('tr:first').before(result);
                                        }
                                        else {
                                            jQuery('.added_' + name + '_table tbody').append(result);
                                        }
                                        if (jQuery('input[name="' + name + '_name"]').length > 0) {
                                            jQuery('input[name="' + name + '_name"]').val('').focus();
                                        }
                                        SnoCalculation();
                                    }
                                });
                            }
                            else {
                                jQuery('.added_' + name + '_table').before('<div class="infos w-100 text-danger text-center mb-3" style="font-size: 15px;">This ' + name_variable + ' already Exists</div>');
                            }
                        }
                        else {
                            jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;">Only ' + characters + ' Characters allowed</div>');
                        }
                    }
                    else {
                        jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;color:red;">Invalid Characters</div>');
                        jQuery('input[name="' + name + '_name"]').val('');
                    }
                }
                else {
                    jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;">Please check field values</div>');
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}
function DeleteCreationRow(id_name, row_index) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('#' + id_name + '_row' + row_index).length > 0) {
                    jQuery('#' + id_name + '_row' + row_index).remove();
                }
                SnoCalculation();
            }
            else {
                window.location.reload();
            }
        }
    });
}
function addCreationFormDetails(name, characters) {
    var check_login_session = 1; var all_errors_check = 1; var error = 1; var letters_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }
                var creation_name = "";
                var format = regex;
                if (name == 'film_size' || name == 'film_micron') {
                    format = number_regex;
                }
                var name_variable = "";
                name_variable = name.toLowerCase();
                name_variable = name_variable.trim();
                name_variable = name_variable.replace("_", " ");
                if (jQuery('input[name="' + name + '_name"]').is(":visible")) {
                    if (jQuery('input[name="' + name + '_name"]').length > 0) {
                        var creation_name = "";
                        if (jQuery('input[name="' + name + '_name"]').length > 0) {
                            creation_name = jQuery('input[name="' + name + '_name"]').val();
                            creation_name = jQuery.trim(creation_name);
                            if (typeof creation_name == "undefined" || creation_name == "" || creation_name == 0) {
                                all_errors_check = 0;
                                showerrormsg(name + '_name', 'input', 'Store Room Name', name + '_form');
                            }
                        }

                        var creation_location = "";
                        if (jQuery('input[name="' + name + '_location"]').length > 0) {
                            creation_location = jQuery('input[name="' + name + '_location"]').val();
                            creation_location = jQuery.trim(creation_location);
                            if (typeof creation_location == "undefined" || creation_location == "" || creation_location == 0) {
                                all_errors_check = 0;
                                showerrormsg(name + '_location', 'input', 'Store Room Location', name + '_form');
                            }
                        }
                        // if (parseInt(all_errors_check) == 1 && parseInt(letters_check) == 1 && parseInt(error) == 1) {
                        if (parseInt(all_errors_check) == 1) {
                            var add = 1;
                            if (creation_name != "") {
                                if (jQuery('input[name="' + name + '_names[]"]').length > 0) {
                                    jQuery('.added_' + name + '_table tbody').find('tr').each(function () {
                                        var prev_creation_name = jQuery(this).find('input[name="' + name + '_names[]"]').val().toLowerCase();
                                        var current_creation_name = creation_name.toLowerCase();
                                        if (prev_creation_name == current_creation_name) {
                                            add = 0;
                                        }
                                    });
                                }
                            }

                            if (add == 1) {
                                var count = parseInt(jQuery('input[name="' + name + '_count"]').val()) + 1;
                                jQuery('input[name="' + name + '_count"]').val(count);

                                jQuery.ajax({
                                    url: name + "_changes.php",
                                    type: "POST",
                                    data: {
                                        [name + "_row_index"]: count,
                                        ["selected_" + name + "_name"]: creation_name,
                                        ["selected_" + name + "_location"]: creation_location
                                    },
                                    success: function (result) {
                                        var tbody = jQuery('.added_' + name + '_table tbody');
                                        if (tbody.find('tr').length > 0) {
                                            tbody.find('tr:first').before(result);
                                        } else {
                                            tbody.append(result);
                                        }
                                        jQuery('input[name="' + name + '_name"]').val('').focus();
                                        jQuery('input[name="' + name + '_location"]').val('');
                                        SnoCalculation();
                                    }
                                });
                            } else {
                                jQuery('.added_' + name + '_table').before('<div class="infos w-100 text-danger text-center mb-3" style="font-size: 15px;">This ' + name_variable + ' already Exists</div>');
                            }
                        } else {
                            jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;">Check all field values</div>');
                        }
                    }
                }
                else {
                    jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;">Please check all field values</div>');
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}

function show_sub_unit(raw_material_type) {
    if (raw_material_type == "3") {
        if ($("select[name='sub_unit_id']").length > 0) {
            $("select[name='sub_unit_id']").addClass("d-none")
        }
        if ($("input[name='sub_unit_contains']").length > 0) {
            $("input[name='sub_unit_contains']").addClass("d-none")
        }
    }
    else {
        if ($("select[name='sub_unit_id']").length > 0) {
            $("select[name='sub_unit_id']").removeClass("d-none")
        }
        if ($("input[name='sub_unit_contains']").length > 0) {
            $("input[name='sub_unit_contains']").removeClass("d-none")
        }
    }
}

function AddOutsourcePartyCooly() {
	var check_login_session = 1; var all_errors_check = 1; var unit_sub_error = 1; form_name = 'outsource_party_form';
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}

                var seleted_item_id = "";
				if ($('form[name="outsource_party_form"]').find('select[name="seleted_item_id"]').is(":visible")) {
					if ($('form[name="outsource_party_form"]').find('select[name="seleted_item_id"]').length > 0) {
						seleted_item_id = $('form[name="outsource_party_form"]').find('select[name="seleted_item_id"]').val();
						seleted_item_id = jQuery.trim(seleted_item_id);
						if (typeof seleted_item_id == "undefined" || seleted_item_id == "" || seleted_item_id == 0) {
							all_errors_check = 0;
						}
					}
				}

				var selected_work_type = "";
				if ($('form[name="outsource_party_form"]').find('select[name="selected_work_type"]').is(":visible")) {
					if ($('form[name="outsource_party_form"]').find('select[name="selected_work_type"]').length > 0) {
						selected_work_type = $('form[name="outsource_party_form"]').find('select[name="selected_work_type"]').val();
						selected_work_type = jQuery.trim(selected_work_type);
						if (typeof selected_work_type == "undefined" || selected_work_type == "" || selected_work_type == 0) {
							all_errors_check = 0;
						}
					}
				}


				var selected_quantity = "";
				if (jQuery('input[name="selected_quantity"]').length > 0) {
					selected_quantity = jQuery('input[name="selected_quantity"]').val();
					selected_quantity = jQuery.trim(selected_quantity);
					if (typeof selected_quantity == "undefined" || selected_quantity == "") {
						all_errors_check = 0;
					}
					else if (price_regex.test(selected_quantity) == false) {
						all_errors_check = 0;
					}
					else if (parseFloat(selected_quantity) > 99999) {
						all_errors_check = 0;
					}
				}

                var selected_cooly = "";
				if (jQuery('input[name="selected_cooly"]').length > 0) {
					selected_cooly = jQuery('input[name="selected_cooly"]').val();
					selected_cooly = jQuery.trim(selected_cooly);
					if (typeof selected_cooly == "undefined" || selected_cooly == "") {
						all_errors_check = 0;
					}
					else if (price_regex.test(selected_cooly) == false) {
						all_errors_check = 0;
					}
					else if (parseFloat(selected_cooly) > 99999) {
						all_errors_check = 0;
					}
				}

				if (parseFloat(all_errors_check) == 1) {
					var add = 1;
                    if (jQuery('input[name="append_product_id[]"]').length > 0) {
                        if (jQuery('input[name="append_work_type[]"]').length > 0) {
                            if (jQuery('input[name="append_quantity[]"]').length > 0) {
                                jQuery('.cooly_table tbody').find('tr').each(function () {
                                    var append_product_id = ""; var append_work_type = ""; var append_quantity = "";
                                    append_product_id = jQuery(this).find('input[name="append_product_id[]"]').val();
                                    append_work_type = jQuery(this).find('input[name="append_work_type[]"]').val();
                                    append_quantity = jQuery(this).find('input[name="append_quantity[]"]').val();
                                    if (append_product_id == seleted_item_id && append_work_type == selected_work_type) {
                                        add = 0;
                                    }
                                });
                            }
                        }
                    }

					if (parseFloat(add) == 1) {
						product_count = jQuery('.product_row').length + 1;
						jQuery('input[name="product_count"]').val(product_count);
						var post_url = "outsource_party_changes.php?product_row_index=" + product_count + "&selected_work_type=" + selected_work_type + "&selected_quantity=" + selected_quantity+ "&selected_cooly=" + selected_cooly+ "&seleted_item_id=" + seleted_item_id;
						jQuery.ajax({
							url: post_url, success: function (result) {
								if (jQuery('.cooly_table tbody').find('tr').length > 0) {
									jQuery('.cooly_table tbody').find('tr:first').before(result);
								}
								else {
									jQuery('.cooly_table tbody').append(result);
								}

								if (selected_work_type != "") {
									if (jQuery('select[name="selected_work_type"]').length > 0) {
										jQuery('select[name="selected_work_type"]').val('').trigger('change');
									}
								}

                                if (seleted_item_id != "") {
									if (jQuery('select[name="seleted_item_id"]').length > 0) {
										jQuery('select[name="seleted_item_id"]').val('').trigger('change');
									}
								}

								if (jQuery('input[name="selected_quantity"]').length > 0) {
									jQuery('input[name="selected_quantity"]').val('');
								}

                                if (jQuery('input[name="selected_cooly"]').length > 0) {
									jQuery('input[name="selected_cooly"]').val('');
								}

								SnoCalculation();

							}
						});
					}
					else {
						jQuery('.cooly_table').before('<span class="infos w-50 text-center mb-3 fw-bold" style="font-size: 15px;">This Item & Work type Already Exists</span>');
					}
				}
				else {
					if (all_errors_check == 0) {
						jQuery('.cooly_table').before('<span class="infos w-50 text-center mb-3 fw-bold" style="font-size: 15px;">Check Item & Qty Details</span>');
					}
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}

function addEngineerFormDetails() {
    var check_login_session = 1; var all_errors_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }
                
                var engineer_code = "";
                if (jQuery('input[name="selected_engineer_code"]').is(":visible")) {
                    if (jQuery('input[name="selected_engineer_code"]').length > 0) {
                        engineer_code = jQuery('input[name="selected_engineer_code"]').val();
                        engineer_code = jQuery.trim(engineer_code);
                        if (typeof engineer_code == "undefined" || engineer_code == "" || engineer_code == 0) {
                            all_errors_check = 0;
                        }
                        else if (text_no_regex.test(engineer_code) == false) {
                            all_errors_check = 0;
                        }
                    }
                }

                var engineer_name = "";
                if (jQuery('input[name="selected_engineer_name"]').is(":visible")) {
                    if (jQuery('input[name="selected_engineer_name"]').length > 0) {
                        engineer_name = jQuery('input[name="selected_engineer_name"]').val();
                        engineer_name = jQuery.trim(engineer_name);
                        if (typeof engineer_name == "undefined" || engineer_name == "" || engineer_name == 0) {
                            all_errors_check = 0;
                        }
                        else if (letter_regex.test(engineer_name) == false) {
                            all_errors_check = 0;
                        }
                    }
                }

                var mobile_number = "";
                if (jQuery('input[name="selected_mobile_number"]').is(":visible")) {
                    if (jQuery('input[name="selected_mobile_number"]').length > 0) {
                        mobile_number = jQuery('input[name="selected_mobile_number"]').val();
                        mobile_number = jQuery.trim(mobile_number);
                        if (typeof mobile_number == "undefined" || mobile_number == "" || mobile_number == 0) {
                            all_errors_check = 0;
                        }
                        else if (price_regex.test(mobile_number) == false) {
                            all_errors_check = 0;
                        }
                    }
                }


                var salary = "";
                if (jQuery('input[name="selected_salary"]').is(":visible")) {
                    if (jQuery('input[name="selected_salary"]').length > 0) {
                        salary = jQuery('input[name="selected_salary"]').val();
                        salary = jQuery.trim(salary);
                        if (typeof salary == "undefined" || salary == "" || salary == 0) {
                            all_errors_check = 0;
                        }
                        else if (price_regex.test(salary) == false) {
                            all_errors_check = 0;
                        }
                        else if (parseFloat(salary) > 99999) {
                            all_errors_check = 0;
                        }
                    }
                }

                if (parseInt(all_errors_check) == 1) {
                    var add = 1;
                    if (jQuery('input[name="engineer_name[]"]').length > 0) {
                        if (jQuery('input[name="engineer_code[]"]').length > 0) {
                            if (jQuery('input[name="engineer_mobile_number[]"]').length > 0) {
                                jQuery('.added_engineer_table tbody').find('tr').each(function () {
                                    var prev_engineer_name = jQuery(this).find('input[name="engineer_name[]"]').val();
                                    var prev_engineer_code = jQuery(this).find('input[name="engineer_code[]"]').val();
                                    var prev_mobile_number = jQuery(this).find('input[name="engineer_mobile_number[]"]').val();
                                    if (prev_engineer_name == engineer_name && prev_engineer_code == engineer_code && prev_mobile_number == mobile_number) {
                                        add = 0;
                                    }
                                });
                            }
                        }
                    }

                    if (parseFloat(add) == 1) {
						engineer_count = jQuery('.engineer_row').length + 1;
						jQuery('input[name="engineer_count"]').val(engineer_count);
						var post_url = "engineer_changes.php?engineer_row_index=" + engineer_count + "&engineer_name=" + engineer_name + "&engineer_code=" + engineer_code+ "&engineer_mobile_number=" + mobile_number+ "&engineer_salary=" + salary;
						jQuery.ajax({
							url: post_url, success: function (result) {
								if (jQuery('.added_engineer_table tbody').find('tr').length > 0) {
									jQuery('.added_engineer_table tbody').find('tr:first').before(result);
								}
								else {
									jQuery('.added_engineer_table tbody').append(result);
								}

								if (jQuery('input[name="selected_engineer_name"]').length > 0) {
									jQuery('input[name="selected_engineer_name"]').val('');
								}

                                if (jQuery('input[name="selected_engineer_code"]').length > 0) {
									jQuery('input[name="selected_engineer_code"]').val('');
								}

                                if (jQuery('input[name="selected_mobile_number"]').length > 0) {
									jQuery('input[name="selected_mobile_number"]').val('');
								}

                                if (jQuery('input[name="selected_salary"]').length > 0) {
									jQuery('input[name="selected_salary"]').val('');
								}

								SnoCalculation();

							}
						});
					} else {
                        jQuery('added_engineer_table').before('<div class="infos w-100 text-danger text-center mb-3" style="font-size: 15px;">This Engineer Name, Code & Mobile Number already Exists</div>');
                    }
                } else {
                    jQuery('.added_engineer_table').before('<span class="infos w-50 text-center mb-3 fw-bold" style="font-size: 15px;">Check Engineer Details</span>');
					
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}


function addVehicleFormDetails() {
    var check_login_session = 1; var all_errors_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }
                
                var vehicle_no = "";
                if (jQuery('input[name="vehicle_no"]').is(":visible")) {
                    if (jQuery('input[name="vehicle_no"]').length > 0) {
                        vehicle_no = jQuery('input[name="vehicle_no"]').val();
                        vehicle_no = jQuery.trim(vehicle_no);
                        if (typeof vehicle_no == "undefined" || vehicle_no == "" || vehicle_no == 0) {
                            all_errors_check = 0;
                        }
                        else if (text_no_regex.test(vehicle_no) == false) {
                            all_errors_check = 0;
                        }
                    }
                }

                var vehicle_details = "";
                if (jQuery('input[name="vehicle_detail"]').is(":visible")) {
                    if (jQuery('input[name="vehicle_detail"]').length > 0) {
                        vehicle_details = jQuery('input[name="vehicle_detail"]').val();
                        vehicle_details = jQuery.trim(vehicle_details);
                        if (typeof vehicle_details == "undefined" || vehicle_details == "" || vehicle_details == 0) {
                            all_errors_check = 0;
                        }
                        else if (text_no_regex.test(vehicle_details) == false) {
                            all_errors_check = 0;
                        }
                    }
                }

                if (parseInt(all_errors_check) == 1) {
                    var add = 1;
                    if (jQuery('input[name="vehicle_nos[]"]').length > 0) {
                        jQuery('.added_vehicle_table tbody').find('tr').each(function () {
                            var prev_vehicle_no = jQuery(this).find('input[name="vehicle_nos[]"]').val().toLowerCase();
                            vechicle_nos= "";
                            vehicle_nos = vehicle_no.toLowerCase();
                            prev_vehicle_no = jQuery.trim(prev_vehicle_no);
                            if (prev_vehicle_no == vehicle_nos) {
                                add = 0;
                            }
                        });
                    }

                    if (parseFloat(add) == 1) {
						vehicle_count = jQuery('.vehicle_row').length + 1;
						jQuery('input[name="vehicle_count"]').val(vehicle_count);
						var post_url = "vehicle_changes.php?vehicle_row_index=" + vehicle_count + "&selected_vehicle_no=" + vehicle_no + "&selected_vehicle_details=" + vehicle_details;
						jQuery.ajax({
							url: post_url, success: function (result) {
								if (jQuery('.added_vehicle_table tbody').find('tr').length > 0) {
									jQuery('.added_vehicle_table tbody').find('tr:first').before(result);
								}
								else {
									jQuery('.added_vehicle_table tbody').append(result);
								}

								if (jQuery('input[name="vehicle_no"]').length > 0) {
									jQuery('input[name="vehicle_no"]').val('');
								}

                                if (jQuery('input[name="vehicle_detail"]').length > 0) {
									jQuery('input[name="vehicle_detail"]').val('');
								}
								SnoCalculation();

							}
						});
					} else {
                        jQuery('.added_vehicle_table').before('<div class="infos w-100 text-danger text-center mb-3" style="font-size: 15px;">This Vehicle Number already Exists</div>');
                    }
                } else {
                    jQuery('.added_vehicle_table').before('<span class="infos w-50 text-center mb-3 fw-bold" style="font-size: 15px;">Check All Fields In Vehicle</span>');
					
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}

function AddProductDetails(){

    var check_login_session = 1; var all_errors_check = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function() { jQuery(this).remove(); });
				}

                var stock_date = "";
                if(jQuery('input[name="stock_date"]').is(":visible")) {
                    if(jQuery('input[name="stock_date"]').length > 0) {
                        stock_date = jQuery('input[name="stock_date"]').val();
                        stock_date = jQuery.trim(stock_date);
                        if(typeof stock_date == "undefined" || stock_date == "" || stock_date == 0) {
                            all_errors_check = 0;
                            showerrormsg('stock_date', 'input', 'Stock Date','product_form');
                        }
                    }
                }

                var store_room_id = "";
                if(jQuery('select[name="store_room_id"]').is(":visible")) {
                    if(jQuery('select[name="store_room_id"]').length > 0) {
                        store_room_id = jQuery('select[name="store_room_id"]').val();
                        store_room_id = jQuery.trim(store_room_id);
                        if(typeof store_room_id == "undefined" || store_room_id == "" || store_room_id == 0) {
                            all_errors_check = 0;
                            showerrormsg('store_room_id', 'select', 'Store Room','product_form');
                        }
                    }
                }

                var quantity = "";
                if(jQuery('input[name="quantity"]').length > 0) {
                    quantity = jQuery('input[name="quantity"]').val();
                    quantity = jQuery.trim(quantity);
                    if(typeof quantity == "undefined" || quantity == "" || quantity == 0) {
                        all_errors_check = 0;
                        showerrormsg('quantity', 'input', 'Quantity','product_form');

                    }
                    else if(price_regex.test(quantity) == false) {
                        all_errors_check = 0;
                    }
                    else if(parseFloat(quantity) > 99999) {
                        all_errors_check = 0;
                    }
                }

                if(parseFloat(all_errors_check) == 1) {
                    var add = 1;
                    if(store_room_id != "") {
                        if(jQuery('input[name="store_room_ids[]"]').length > 0) {
                            jQuery('.added_product_table tbody').find('tr').each(function() {
                                var prev_store_room_id = jQuery(this).find('input[name="store_room_ids[]"]').val();
                                var store_room_ids = "", row_unit_ids = "";
                                store_room_ids = jQuery.trim(store_room_id).toLowerCase();
                                prev_store_room_id = jQuery.trim(prev_store_room_id).toLowerCase();
                                if(prev_store_room_id == store_room_ids) {
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
                        var post_url = "product_changes.php?product_row_index="+product_count+"&selected_stock_date="+stock_date+"&selected_store_room_id="+store_room_id+"&selected_quantity="+quantity;
                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.added_product_table tbody').find('tr').length > 0) {
                                    jQuery('.added_product_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.added_product_table tbody').append(result);
                                }
								
								if(store_room_id != "") {
									if(jQuery('select[name="store_room_id"]').length > 0) {
										jQuery('select[name="store_room_id"]').val('').trigger('change');
									}
								}
							
								if(jQuery('input[name="quantity"]').length > 0) {
                                    jQuery('input[name="quantity"]').val('');
                                }
								SnoCalculation();
                            }
                        });



                    }else {
                        jQuery('.added_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Store Room Name is Already Exists</span>');
                    }


                }else {
                    jQuery('.added_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check all field values</span>');
                }
            }else {
				window.location.reload();
			}
        }
    });
}