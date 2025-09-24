function GetVehicles(page) {
    var party_id = '';
    if(jQuery('select[name="party_id"]').length > 0) {
        party_id = jQuery('select[name="party_id"]').val();
    }
    if(party_id != '') {
        var check_login_session = 1; var all_errors_check = 1;
        var post_url = "dashboard_changes.php?check_login_session=1";
        jQuery.ajax({
            url: post_url, success: function (check_login_session) {
                if (check_login_session == 1) {
                    var post_url = "sales_bill_changes.php?get_party_vehicle="+ party_id + "&page=" + page;
                    jQuery.ajax({
                        url: post_url, success: function (result) {
                            if(jQuery('select[name="vehicle_id"]').length > 0) {
                                jQuery('select[name="vehicle_id"]').empty().html(result);
                                jQuery('select[name="vehicle_id"]').trigger('change');
                            }
                        }
                    });
                }
            }
        });
    } else {
        if(jQuery('select[name="vehicle_id"]').length > 0) {
            jQuery('select[name="vehicle_id"]').empty().html("<option value = ''>Select Vehicle</option>");
            jQuery('select[name="vehicle_id"]').trigger('change');
        }
    }
}

function ChangeVehicle(selectElement) {
    vehicle_details = selectElement.options[selectElement.selectedIndex].getAttribute('data-vehicle_datails');
    var party_id = '';
    if($("input[name='vehicle_details'").length > 0) {
        $("input[name='vehicle_details'").val(vehicle_details);
    }
    if(jQuery('select[name="party_id"]').length > 0) {
        party_id = jQuery('select[name="party_id"]').val();
    }
    var check_login_session = 1; var all_errors_check = 1;
        var post_url = "dashboard_changes.php?check_login_session=1";
        jQuery.ajax({
            url: post_url, success: function (check_login_session) {
                if (check_login_session == 1) {
                    post_url = "sales_bill_changes.php?product_row_vehicle_id="+ selectElement.value + "&party_id="+party_id;
                    jQuery.ajax({
                        url: post_url, success: function (result) {
                            if (jQuery('.sales_table tbody').length > 0) {
                                jQuery('.sales_table tbody').empty().html(result);
                            }
                            CalcTotalAmount();
                        }
                    });
                }
            }
        });

}

function CalcTotalAmount() {

    var total_amount = 0;
    var amount = 0;

    if (jQuery('.sales_table tbody').find('tr').length > 0) {
        jQuery('.sales_table tbody').find('tr').each(function() {
            amount = 0;
            var quantity = $(this).find('input[name="quantity[]"]').val() || 0;
            var rate = $(this).find('input[name="rate[]"]').val() || 0;
            amount = parseFloat(quantity) * parseFloat(rate);
            $(this).find(".amount").html(amount.toFixed(2));
            total_amount += parseFloat(amount);
            if($(this).find("input[name='amount[]']").length > 0) {
                $(this).find("input[name='amount[]']").val(amount);
            }
        });
    }

    if($(".sub_total").length > 0) {
        $(".sub_total").html(total_amount.toFixed(2));
    }
    if($("input[name='sub_total']").length > 0) {
        $("input[name='sub_total']").val(total_amount);
    }
    getGST();
    calTotal();
    getRateByTaxOption();

}


function checkDiscount() {
    var sub_total = 0; var discounted_total = 0;
    var discount = ""; var discount_value = 0;
    if (jQuery('input[name="discount"]').length > 0) {
        discount = jQuery('input[name="discount"]').val();
        discount = discount.trim();
    }

    if (jQuery('.sub_total').length > 0) {
        sub_total = jQuery('.sub_total').html();
        sub_total = sub_total.replace(/ /g, '');
        sub_total = sub_total.trim();
    }
    if (discount != "" && discount != 0 && typeof discount != "undefined") {
        if (discount.indexOf('%') != -1) {
            discount = discount.replace('%', '');
            discount = discount.trim();
            if ((price_regex.test(discount) == false) || (parseFloat(discount) < 0) || (parseFloat(discount) >= 100)) {
                if (jQuery('.discount_value').length > 0) {
                    jQuery('.discount_value').html('<span class="text-danger">Invalid</span>');
                }
            }
            else {
                discount_value = (parseFloat(sub_total) * parseFloat(discount)) / 100;
                discount_value = (Math.round(discount_value * 100) / 100).toFixed(2);
            }
        }
        else {
            if ((price_regex.test(discount) == false) || (parseFloat(discount) < 0) || (parseFloat(discount) >= parseFloat(sub_total))) {
                if (jQuery('.discount_value').length > 0) {
                    jQuery('.discount_value').html('<span class="text-danger">Invalid</span>');
                }
            }
            else {
                discount_value = parseFloat(discount);
                discount_value = discount_value.toFixed(2);
            }
        }
        if (discount_value != "" && discount_value != 0 && typeof discount_value != "undefined" && price_regex.test(discount_value) == true) {
            if (jQuery('.discount_value').length > 0) {
                jQuery('.discount_value').html(discount_value);
            }
            discounted_total = parseFloat(sub_total) - parseFloat(discount_value);
            discounted_total = discounted_total.toFixed(2);
            if (typeof discounted_total != "undefined" && discounted_total != "" && discounted_total != 0 && price_regex.test(discounted_total) == true) {
                if (jQuery('.discounted_total').length > 0) {
                    jQuery('.discounted_total').html(discounted_total);
                }
                if (jQuery('.charges_sub_total').length > 0) {
                    jQuery('.charges_sub_total').html(discounted_total);
                }
                if (jQuery('.taxable_amount').length > 0) {
                    jQuery('.taxable_amount').html(discounted_total);
                }
                if (jQuery('.overall_total').length > 0) {
                    jQuery('.overall_total').html(discounted_total);
                }
                if (jQuery('.input[name="overall_total"]').length > 0) {
                    jQuery('.input[name="overall_total"]').html(discounted_total);
                }
                if (jQuery('.tax_total_amount').length > 0) {
                    jQuery('.tax_total_amount').html(discounted_total);
                }
            }
        }
        else {
            if (jQuery('.discounted_total').length > 0) {
                jQuery('.discounted_total').html('');
            }
            if (jQuery('.taxable_amount').length > 0) {
                jQuery('.taxable_amount').html(discounted_total);
            }
            if (jQuery('.charges_sub_total').length > 0) {
                jQuery('.charges_sub_total').html('');
            }
            if (jQuery('.cgst_value').length > 0) {
                jQuery('.cgst_value').html('');
            }
            if (jQuery('.sgst_value').length > 0) {
                jQuery('.sgst_value').html('');
            }
            if (jQuery('.igst_value').length > 0) {
                jQuery('.igst_value').html('');
            }
            if (jQuery('.total_tax_value').length > 0) {
                jQuery('.total_tax_value').html('');
            }
            if (jQuery('.round_off').length > 0) {
                jQuery('.round_off').html('');
            }
            if (jQuery('.overall_total').length > 0) {
                jQuery('.overall_total').html('');
            }
        }
    }
    else {
        if (jQuery('.discount_value').length > 0) {
            jQuery('.discount_value').html('');
        }
        if (jQuery('.discounted_total').length > 0) {
            jQuery('.discounted_total').html(sub_total);
        }
        if (jQuery('.taxable_amount').length > 0) {
            jQuery('.taxable_amount').html(sub_total);
        }
        if (jQuery('.charges_sub_total').length > 0) {
            jQuery('.charges_sub_total').html(sub_total);
        }

        if (jQuery('.overall_total').length > 0) {
            jQuery('.overall_total').html(sub_total);
        }
    }

    CheckCharges();

}

function CheckCharges() {
    var sub_total = 0;

    if (jQuery('.discounted_total').length > 0) {
        sub_total = jQuery('.discounted_total').html();
        sub_total = sub_total.trim();
    }
    else {
        if (jQuery('.sub_total').length > 0) {
            sub_total = jQuery('.sub_total').html();
            sub_total = sub_total.trim();
        }
    }
    var total_amount = 0;
    if (price_regex.test(sub_total) !== false) {
        total_amount = sub_total;
        var charges_count = 0;
        charges_count = jQuery('input[name="charges_count"]').val();
        charges_count = parseInt(charges_count);

        if (jQuery('.charges_row').length > 0) {
            jQuery('.charges_row').each(function () {
                if (jQuery(this).find('span.infos').length > 0) {
                    jQuery(this).find('span.infos').remove();
                }
                var charges_value = 0; var charges_check = 1;
                if (jQuery(this).find('input[name="charges_value[]"]').length > 0) {
                    charges_value = jQuery(this).find('input[name="charges_value[]"]').val();

                    charges_value = charges_value.trim();
                    if (charges_value != "" && charges_value != 0 && typeof charges_value != "undefined" && charges_value != null) {

                        if (charges_value.indexOf('%') != -1) {
                            charges_value = charges_value.replace('%', '');
                            charges_value = charges_value.trim();
                            if (price_regex.test(charges_value) == false) {
                                charges_check = 0;
                            }
                            else {
                                charges_value = (parseFloat(total_amount) * parseFloat(charges_value)) / 100;
                                charges_value = charges_value.toFixed(2);
                            }
                        }
                        else {
                            if (price_regex.test(charges_value) == false) {
                                charges_check = 0;
                            }
                            else {
                                charges_value = parseFloat(charges_value);
                                charges_value = charges_value.toFixed(2);
                            }
                        }
                    }
                    else {
                        charges_check = 2;
                        if (jQuery(this).find('.charges_total').length > 0) {
                            jQuery(this).find('.charges_total').html('');
                        }
                        if (jQuery(this).find('.charges_sub_total').length > 0) {
                            jQuery(this).find('.charges_sub_total').html(total_amount, 2);
                        }

                    }
                }
                if (parseInt(charges_check) == 1) {
                    
                    total_amount = parseFloat(total_amount) + parseFloat(charges_value);
                    total_amount = total_amount.toFixed(2);
                    if (jQuery(this).find('.charges_total').length > 0) {
                        jQuery(this).find('.charges_total').html(charges_value, 2);
                    }
                    if (jQuery(this).find('.charges_sub_total').length > 0) {
                        jQuery(this).find('.charges_sub_total').html(total_amount, 2);
                    }
                    if (jQuery(this).find('.tax_total_amount').length > 0) {
                        jQuery(this).find('.tax_total_amount').html(total_amount, 2);
                    }

                }

            });
        }
    }
    if (price_regex.test(total_amount) !== false) {
        if (jQuery('.overall_total').length > 0) {
            jQuery('.overall_total').html(total_amount);
            checkGST();
        }
        if ($('input[name="overall_total"]').length > 0) {
            $('input[name="overall_total"]').val(total_amount);
        }
        if (jQuery('.total_amount').length > 0) {
            jQuery('.total_amount').html(total_amount);
        }
        if (jQuery('.taxable_amount').length > 0) {
            jQuery('.taxable_amount').html(total_amount);
        }
        if (jQuery('.tax_total_amount').length > 0) {
            jQuery('.tax_total_amount').html(total_amount);
        }
    }
}

function CheckRoundOff(obj) {

    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var option = 1;
                if (jQuery('#flexCheckDefault1').prop('checked') == false) {
                    option = 2;
                }
                if (jQuery(obj).parent().find('input[type="checkbox"]').length > 0) {
                    jQuery(obj).parent().find('input[type="checkbox"]').val(option);
                }
                if (option == 1) {
                    if ($("#round_off_div").length > 0) {
                        $("#round_off_div").addClass("d-none");
                    }
                    autoRoundOff();

                } else {
                    if ($("#round_off_div").length > 0) {
                        $("#round_off_div").removeClass("d-none");
                    }
                    if ($(".overall_totalround_off").length > 0) {
                        original_amount = $(".overall_totalround_off").val();
                    }
                    if ($(".overall_total").length > 0) {
                        $(".overall_total").html(original_amount);
                    }
                    CalRoundOff();
                }

            }
            else {
                window.location.reload();
            }
        }
    });
}

function autoRoundOff() {
    var round_off = "";
    if (jQuery('input[name="round_off"]').length > 0) {
        round_off = jQuery('input[name="round_off"]').val();
    }
    if (round_off == '1') {

        var overall_total = 0; var total = 0;
        if (jQuery('.overall_total').length > 0) {
            overall_total = jQuery('.overall_total').html();
            overall_total = overall_total.replace(/ /g, '');
            overall_total = overall_total.trim();

            if (typeof overall_total != "undefined" && overall_total != "" && overall_total != 0) {
                if (price_regex.test(overall_total) == true) {
                    total = parseFloat(total) + parseFloat(overall_total);
                    var decimal = ""; var round_off = '';
                    var numbers = total.toString().split('.');
                    if (typeof numbers[1] != 'undefined') {
                        decimal = numbers[1];
                    }

                    if (decimal != "" && decimal != 00) {
                        if (decimal.length == 1) {
                            decimal = decimal + '0';
                        }
                        if (parseFloat(decimal) >= 50) {
                            var round_off = 0;
                            round_off = 100 - parseFloat(decimal);

                            if (typeof round_off != 'undefined' && round_off != '' && round_off != 0) {
                                if (round_off.toString().length == 1) {
                                    round_off = "0.0" + round_off;
                                }
                                else {
                                    round_off = "0." + round_off;
                                }
                                // jQuery('.round_off').html(round_off);
                                total = parseFloat(total) + parseFloat(round_off);
                            }
                        }
                        else {
                            decimal = "0." + decimal;
                            // jQuery('.round_off').html('- '+decimal);
                            total = parseFloat(total) - parseFloat(decimal);
                        }
                        total = total.toFixed(2);
                    }
                    else {
                        total = total.toFixed(2);
                        // jQuery('.round_off').html('0.00');
                    }
                }
            }
        }
        if (typeof total != "undefined" && total != "" && total != 0 && price_regex.test(total) == true) {
            if (jQuery('.overall_total').length > 0) {
                jQuery('.overall_total').html(total);
            }
        }
    }
}

function CalRoundOff() {
    var round_off_ckd = ""; var round_off_type = 0; var round_off_value = ""; var overall_total = 0; var final_total = 0;

    if ($('input[name="round_off"]').length > 0) {
        round_off_ckd = $('input[name="round_off"]').val();
    }

    if ($('select[name="round_off_type"]').length > 0) {
        round_off_type = $('select[name="round_off_type"]').val();
    }
    if ($('input[name="round_off_value"]').length > 0) {
        round_off_value = $('input[name="round_off_value"]').val();
    }

    if ($('input[name="overall_total"]').length > 0) {
        overall_total = $('input[name="overall_total"]').val();
    }
    if (typeof (round_off_ckd) != undefined) {
        if (typeof (round_off_type) != undefined && round_off_type != "" && round_off_type != 0 && typeof (round_off_value) != undefined && round_off_value != "" && round_off_value != 0 && typeof (overall_total) != undefined && overall_total != "" && overall_total != 0) {
            // round_off_value = input.toString().padStart(2, '0')
            if (round_off_value.length == 1) {
                // round_off_value = "." + round_off_value + "0";
                round_off_value = ".0" + round_off_value;
            } else {
                round_off_value = "." + round_off_value;
            }
            if (round_off_type == 1) {
                final_total = (parseFloat(overall_total) + (parseFloat(round_off_value))).toFixed(2);
            } else if (round_off_type == 2) {
                final_total = (parseFloat(overall_total) - (parseFloat(round_off_value))).toFixed(2);
            } else {
                final_total = parseFloat(overall_total).toFixed(2);
            }
        } else {
            final_total = parseFloat(overall_total).toFixed(2);
        }
    } else {
        final_total = parseFloat(overall_total).toFixed(2);
    }
    if (typeof (round_off_type) != undefined && round_off_type != "" && round_off_type != 0) {
        if ($('.overall_total').length > 0) {
            $('.overall_total').html(final_total);
        }

    }
    autoRoundOff();
}

function ShowGST(obj, gst_option) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var option = 1;
                if (jQuery('#gst_option').prop('checked') == false) {
                    jQuery('#gst_option').val(0);
                    option = 0;
                }
                else {
                    jQuery('#gst_option').val(1)
                }
                if (jQuery(obj).parent().find('input[type="checkbox"]').length > 0) {
                    jQuery(obj).parent().find('input[type="checkbox"]').val(option);
                }

                if (option == 1) {
                    if (jQuery('.tax_cover').length > 0) {
                        jQuery('.tax_cover').removeClass("d-none");
                    }
                    if (jQuery('.tax_cover1').length > 0) {
                        jQuery('.tax_cover1').removeClass("d-none");
                    }
                    if (jQuery('.tax_cover2').length > 0) {
                        jQuery('.tax_cover2').removeClass("d-none");
                    }
                }
                else {
                    if (jQuery('.tax_cover2').length > 0) {
                        jQuery('.tax_cover2').addClass("d-none");
                    }
                    if (jQuery('.tax_cover').length > 0) {
                        jQuery('.tax_cover').addClass("d-none");
                        jQuery('.tax_cover1').addClass("d-none");
                        jQuery('.tax_cover2').addClass("d-none");
                    }
                }
                addChargesTax();
                getGST();
                getRateByTaxOption();
            }
            else {
                window.location.reload();
            }
        }
    });
}

function changeChargesTax() {
    $('select[name="charges_tax[]"]').html('<option value="">Select Tax</option>');
}

function addChargesTax() {
    var gst_option = 0; var tax_type = 0; var overall_tax = 0;

    if ($('#gst_option').length > 0) {
        gst_option = $('#gst_option').val();
    }

    if ($('select[name="overall_tax"]').length > 0) {
        overall_tax = $('select[name="overall_tax"]').val();
    }

    if ($('select[name="tax_type"]').length > 0) {
        tax_type = $('select[name="tax_type"]').val();
    }


    if (gst_option == 1) {
        if (tax_type == 2) {
            jQuery('select[name="charges_tax[]"]').each(function () {

                $(this).html('<option value="">Select Tax</option>');

            });
        }
    }

    jQuery('.div_charges').each(function () {
        var div_this = $(this);
        var hidden_charges = $(this).find('#hidden_charges').val().replace('%', '');
        hidden_charges = hidden_charges + "%";
        $(this).find('select[name="charges_tax[]"]').html('<option value="">Select Tax</option>');
        if (typeof (tax_type) != undefined && tax_type == "2") {
            if ($(this).find('select[name="charges_tax[]"] option').filter(function () {
                return $(this).val() == overall_tax;
            }).length === 0) {
                $(this).find('select[name="charges_tax[]"]').append(`<option value="${overall_tax}">${overall_tax}</option>`);
            }

            if (overall_tax == hidden_charges) {
                $(this).find('select[name="charges_tax[]"]').val(overall_tax);
            }

        } else {
            jQuery('select[name="product_tax[]"]').each(function () {
                var product_tax = 0;
                product_tax = $(this).val();
                if ($(div_this).find('select[name="charges_tax[]"] option').filter(function () {
                    return $(this).val() == product_tax;
                }).length === 0) {
                    $(div_this).find('select[name="charges_tax[]"]').append(`<option value="${product_tax}">${product_tax}</option>`);
                }

                if (product_tax == hidden_charges) {
                    $(div_this).find('select[name="charges_tax[]"]').val(product_tax);
                }
            });
        }
    });
}
function getGST() {
    if (jQuery('span.infos').length > 0) {
        jQuery('span.infos').remove();
    }
    var gst_option = ""; var tax_option = ""; var tax_type = ""; var tax_value = "";
    if (jQuery('input[name="gst_option"]').length > 0) {
        gst_option = jQuery('input[name="gst_option"]').val();
        gst_option = jQuery.trim(gst_option);
    }
    if (jQuery('select[name="tax_option"]').length > 0) {
        tax_option = jQuery('select[name="tax_option"]').val();
        tax_option = jQuery.trim(tax_option);
    }
    if (jQuery('select[name="tax_type"]').length > 0) {
        tax_type = jQuery('select[name="tax_type"]').val();
        tax_type = jQuery.trim(tax_type);
    }
    if (jQuery('select[name="overall_tax"]').length > 0) {
        tax_value = jQuery('select[name="overall_tax"]').val();
        tax_value = jQuery.trim(tax_value);
    }
    var company_state = "";
    if (jQuery('input[name="company_state"]').length > 0) {
        company_state = jQuery('input[name="company_state"]').val();
        company_state = jQuery.trim(company_state);
    }
    var party_state = "";
    if (jQuery('input[name="party_state"]').length > 0) {
        party_state = jQuery('input[name="party_state"]').val();
        party_state = jQuery.trim(party_state);
    }
    var store_type = "";
    if (jQuery('select[name="store_type"]').length > 0) {
        store_type = jQuery('select[name="store_type"]').val();
        store_type = jQuery.trim(store_type);
    }
    if (gst_option == 1) {
        if (jQuery('.charges_tax').length > 0) {
            jQuery('.charges_tax').removeClass('d-none');
        }
        if (parseInt(tax_type) == 1) {
            $(".subtotal_amount").attr('colspan', 8);

            if (jQuery('.tax_cover2').length > 0) {
                jQuery('.tax_cover2').addClass('d-none');
            }
            if (jQuery('.tax_element').length > 0) {
                jQuery('.tax_element').removeClass('d-none');
            }
        }
        else {
            $(".subtotal_amount").attr('colspan', 7);
            if (jQuery('.tax_element').length > 0) {
                jQuery('.tax_element').addClass('d-none');
            }

            if (jQuery('.tax_cover2').length > 0) {
                jQuery('.tax_cover2').removeClass('d-none');
            }

            // addChargesTax();
        }
    }
    else {
        $(".subtotal_amount").attr('colspan', 7);

        if (parseInt(tax_type) == 1) {
            if (jQuery('.tax_element').length > 0) {
                jQuery('.tax_element').addClass('d-none');
            }
        }
        if (jQuery('.charges_tax').length > 0) {
            jQuery('.charges_tax').addClass('d-none');
        }
    }

    // $(".subtotal_amount").attr('colspan', 5);
    if (parseInt(gst_option) == 1) {
        if (company_state == party_state) {
            if (jQuery('.cgst').length > 0) {
                jQuery('.cgst').removeClass('d-none');
            }
            if (jQuery('.sgst').length > 0) {
                jQuery('.sgst').removeClass('d-none');
            }
            if (jQuery('.igst').length > 0) {
                jQuery('.igst').addClass('d-none');
            }
            if (parseInt(tax_type) == 2) {
                tax_value = tax_value.replace('%', '');
                list = parseFloat(tax_value) / 2;
                if (jQuery('.cgst_tax_value').length > 0) {
                    jQuery('.cgst_tax_value').html("CGST@" + list)
                }
                if (jQuery('.sgst_tax_value').length > 0) {
                    jQuery('.sgst_tax_value').html("SGST@" + list)
                }
            }
            else {
                if (jQuery('.cgst_tax_value').length > 0) {
                    jQuery('.cgst_tax_value').html("CGST@")
                }
                if (jQuery('.sgst_tax_value').length > 0) {
                    jQuery('.sgst_tax_value').html("SGST@")
                }
            }
        }
        else {
            if (jQuery('.cgst').length > 0) {
                jQuery('.cgst').addClass('d-none');
            }
            if (jQuery('.sgst').length > 0) {
                jQuery('.sgst').addClass('d-none');
            }
            if (jQuery('.igst').length > 0) {
                jQuery('.igst').removeClass('d-none');
            }
            if (parseInt(tax_type) == 2) {
                tax_value = tax_value.replace('%', '');
                list = parseFloat(tax_value);
                if (jQuery('.igst_tax_value').length > 0) {
                    jQuery('.igst_tax_value').html("IGST@" + list)
                }
            }
            else {
                if (jQuery('.igst_tax_value').length > 0) {
                    jQuery('.igst_tax_value').html("IGST@")
                }
            }

        }
        if (jQuery('.total_tax_value').length > 0) {
            jQuery('.total_tax_value').removeClass('d-none');
        }
        if (jQuery('.total_tax').length > 0) {
            jQuery('.total_tax').removeClass('d-none');
        }
        if (jQuery('.total_tax_amt').length > 0) {
            jQuery('.total_tax_amt').removeClass('d-none');
        }
        if (parseInt(tax_option) == 2) {
            if (jQuery('.inclusiv_final_rate').length > 0) {
                jQuery('.inclusiv_final_rate').removeClass('d-none');
            }
        }
        else {
            if (jQuery('.inclusiv_final_rate').length > 0) {
                jQuery('.inclusiv_final_rate').addClass('d-none');
            }

        }


    }
    else {
        if (jQuery('.cgst').length > 0) {
            jQuery('.cgst').addClass('d-none');
        }
        if (jQuery('.sgst').length > 0) {
            jQuery('.sgst').addClass('d-none');
        }
        if (jQuery('.igst').length > 0) {
            jQuery('.igst').addClass('d-none');
        }
        if (jQuery('.total_tax').length > 0) {
            jQuery('.total_tax').addClass('d-none');
        }
        if (jQuery('.total_tax_amt').length > 0) {
            jQuery('.total_tax_amt').addClass('d-none');
        }
        if (jQuery('.inclusiv_final_rate').length > 0) {
            jQuery('.inclusiv_final_rate').addClass('d-none');
        }
    }

    checkGST();
}
function checkGST() {
    var gst_option = ""; var tax_type = ""; var tax_option = ""; var cgst_value = 0; var sgst_value = 0; var igst_value = 0;
    var total_tax_value = 0; var greater_tax = 0; var str_tax = 0; var overall_tax_value = 0; var total_value = 0;
    if (jQuery('.cgst_value').length > 0) {
        jQuery('.cgst_value').html('');
    }
    if (jQuery('.sgst_value').length > 0) {
        jQuery('.sgst_value').html('');
    }
    if (jQuery('.igst_value').length > 0) {
        jQuery('.igst_value').html('');
    }
    if (jQuery('.total_tax_value').length > 0) {
        jQuery('.total_tax_value').html('');
    }
    if (jQuery('.round_off').length > 0) {
        jQuery('.round_off').html('');
    }
    if (jQuery('.overall_total').length > 0) {
        jQuery('.overall_total').html('');
    }
    if (jQuery('input[name="gst_option"]').length > 0) {
        gst_option = jQuery('input[name="gst_option"]').val();
        gst_option = jQuery.trim(gst_option);
    }
    if (jQuery('select[name="tax_type"]').length > 0) {
        tax_type = jQuery('select[name="tax_type"]').val();
        tax_type = jQuery.trim(tax_type);
    }
    if (jQuery('select[name="tax_option"]').length > 0) {
        tax_option = jQuery('select[name="tax_option"]').val();
        tax_option = jQuery.trim(tax_option);
    }
    var sub_total = 0;
    if (jQuery('.sub_total').length > 0) {
        sub_total = jQuery('.sub_total').html();
        sub_total = jQuery.trim(sub_total);
    }

    var charges_sub_total = 0;
    if (jQuery('.charges_sub_total').is(":visible")) {
        if (jQuery('.charges_sub_total').length > 0) {
            charges_sub_total = jQuery('.charges_sub_total').last().html();
            charges_sub_total = jQuery.trim(charges_sub_total);
        }
    }
    else if (jQuery('.discounted_total').is(":visible")) {
        if (jQuery('.discounted_total').length > 0) {
            charges_sub_total = jQuery('.discounted_total').html();
            charges_sub_total = jQuery.trim(charges_sub_total);
        }
    }
    else {
        if (jQuery('.sub_total').length > 0) {
            charges_sub_total = jQuery('.sub_total').html();
            charges_sub_total = jQuery.trim(charges_sub_total);
        }
    }
    var company_state = "";
    if (jQuery('input[name="company_state"]').length > 0) {
        company_state = jQuery('input[name="company_state"]').val();
        company_state = jQuery.trim(company_state);
    }
    var party_state = "";
    if (jQuery('input[name="party_state"]').length > 0) {
        party_state = jQuery('input[name="party_state"]').val();
        party_state = jQuery.trim(party_state);
    }
    if (parseInt(gst_option) == 1) {
        if (parseInt(tax_type) == 1) {
            if (jQuery('.product_row').length > 0) {
                jQuery('.product_row').each(function () {
                    var amount = 0; var discount = ""; var discounted_amount = 0; var tax_percentage = ""; var tax = "";
                    var tax_value = 0;
                    amount = jQuery(this).find('input[name="amount[]"]').val();
                    amount = amount.replace(/ /g, '');
                    amount = amount.trim();
                    if (jQuery(this).find('select[name="product_tax[]"]').length > 0) {
                        tax_percentage = jQuery(this).find('select[name="product_tax[]"]').val();
                        tax_percentage = tax_percentage.trim();
                        tax = tax_percentage.replace('%', '');
                        tax = tax.trim();
                    }


                    str_tax = greater_tax;
                    if (amount != "" && amount != 0 && typeof amount != "undefined" && price_regex.test(amount) == true) {
                        if (jQuery('input[name="discount"]').length > 0) {
                            discount = jQuery('input[name="discount"]').val();
                            discount = discount.trim();
                        }

                        if (discount != "" && discount != 0 && typeof discount != "undefined") {
                            if (discount.indexOf('%') != -1) {
                                discount = discount.replace('%', '');
                                discount = discount.trim();
                                if ((price_regex.test(discount) == true) && (parseFloat(discount) > 0) && (parseFloat(discount) <= 100)) {
                                    discounted_amount = amount - ((parseFloat(amount) * parseFloat(discount)) / 100);
                                    discounted_amount = discounted_amount.toFixed(2);
                                }
                            }
                            else {
                                if ((price_regex.test(discount) == true) && (parseFloat(discount) > 0) && (parseFloat(discount) <= parseFloat(sub_total))) {
                                    var discount_percent = "";
                                    discount_percent = (discount / sub_total) * 100;
                                    discounted_amount = amount - ((parseFloat(amount) * parseFloat(discount_percent)) / 100);
                                    discounted_amount = discounted_amount.toFixed(2);
                                }
                            }
                        }
                        else {
                            discounted_amount = amount;
                        }

                        if (discounted_amount != "" && discounted_amount != 0 && typeof discounted_amount != "undefined" && price_regex.test(discounted_amount) == true) {
                            tax_value = (parseFloat(discounted_amount) * parseFloat(tax)) / 100;
                            total_tax_value = parseFloat(total_tax_value) + parseFloat(tax_value);
                        }
                    }
                });

                if (jQuery('.charges_row').length > 0) {
                    var charges_value = "";
                    jQuery('.charges_row').each(function () {
                        charges_total = jQuery(this).find('.charges_total').html();
                        charges_tax = jQuery(this).find('select[name="charges_tax[]"]').val();
                        var charges_tax_total = 0;
                        if (charges_total != "" && charges_total != 0 && typeof charges_total != "undefined" && price_regex.test(charges_total) == true && charges_tax != "" && charges_tax != 0) {
                            charges_tax = charges_tax.replace('%', '');
                            charges_tax_total = (parseFloat(charges_total) * parseFloat(charges_tax)) / 100;
                            total_tax_value = parseFloat(total_tax_value) + parseFloat(charges_tax_total);
                        }

                    });
                }
                overall_tax_value += total_tax_value;

                overall_tax_value = overall_tax_value.toFixed(2);

                if (overall_tax_value != "" && overall_tax_value != 0 && typeof overall_tax_value != "undefined" && price_regex.test(overall_tax_value) == true) {
                    if (company_state == party_state) {
                        cgst_value = parseFloat(overall_tax_value) / 2;
                        cgst_value = cgst_value.toFixed(2);
                        sgst_value = parseFloat(overall_tax_value) / 2;
                        sgst_value = sgst_value.toFixed(2);
                        if (jQuery('.cgst_value').length > 0) {
                            jQuery('.cgst_value').html(cgst_value);
                        }
                        if (jQuery('.sgst_value').length > 0) {
                            jQuery('.sgst_value').html(sgst_value);
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').html(overall_tax_value);
                        }
                        if (jQuery('.cgst_value').length > 0) {
                            jQuery('.cgst_value').parent().find('td:first').html('CGST :');
                        }
                        if (jQuery('.sgst_value').length > 0) {
                            jQuery('.sgst_value').parent().find('td:first').html('SGST :');
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').parent().find('td:first').html('Total Tax :');
                        }
                    }
                    else {
                        igst_value = overall_tax_value;
                        if (jQuery('.igst_value').length > 0) {
                            jQuery('.igst_value').html(igst_value);
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').html(overall_tax_value);
                        }
                        if (jQuery('.igst_value').length > 0) {
                            jQuery('.igst_value').parent().find('td:first').html('IGST :');
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').parent().find('td:first').html('Total Tax :');
                        }
                    }
                }
            }
        }
        else if (parseInt(tax_type) == 2) {
            var overall_tax = ""; var tax_percentage = "";
            if (jQuery('select[name="overall_tax"]').length > 0) {
                overall_tax = jQuery('select[name="overall_tax"]').val();
            }
            if (overall_tax != 0 && overall_tax != "" && typeof overall_tax != "undefined") {
                overall_tax = overall_tax.trim();
                tax_percentage = overall_tax;
                overall_tax = overall_tax.replace('%', '');
                overall_tax = overall_tax.trim();


                if (jQuery('.discounted_total').length > 0) {
                    charges_sub_total = jQuery('.discounted_total').html();
                    charges_sub_total = jQuery.trim(charges_sub_total);
                }
                // alert(charges_sub_total);
                if (charges_sub_total != "" && charges_sub_total != 0 && typeof charges_sub_total != "undefined" && price_regex.test(charges_sub_total) == true) {
                    overall_tax_value = (parseFloat(charges_sub_total) * parseFloat(overall_tax)) / 100;
                    overall_tax_value = overall_tax_value.toFixed(2);
                }

                if (jQuery('.charges_row').length > 0) {
                    var charges_value = "";
                    jQuery('.charges_row').each(function () {
                        charges_total = jQuery(this).find('.charges_total').html();
                        charges_tax = jQuery(this).find('select[name="charges_tax[]"]').val();
                        charges_tax = charges_tax.replace('%', '');
                        var charges_tax_total = 0;
                        if (charges_total != "" && charges_total != 0 && typeof charges_total != "undefined" && price_regex.test(charges_total) == true && charges_tax != "" && charges_tax != 0) {
                            charges_tax_total = (parseFloat(charges_total) * parseFloat(charges_tax)) / 100;
                            total_tax_value = parseFloat(total_tax_value) + parseFloat(charges_tax_total);
                            charges_sub_total = parseFloat(charges_sub_total) + parseFloat(charges_total);
                        }

                    });
                }
                overall_tax_value = parseFloat(overall_tax_value) + parseFloat(total_tax_value);
                overall_tax_value = overall_tax_value.toFixed(2);
                
                if (overall_tax_value != "" && typeof overall_tax_value != "undefined" && price_regex.test(overall_tax_value) == true) {
                    if (company_state == party_state) {
                        overall_tax = parseFloat(overall_tax) / 2;
                        cgst_value = parseFloat(overall_tax_value) / 2;
                        cgst_value = cgst_value.toFixed(2);
                        sgst_value = parseFloat(overall_tax_value) / 2;
                        sgst_value = sgst_value.toFixed(2);
                        if (jQuery('.cgst_value').length > 0) {
                            jQuery('.cgst_value').html(cgst_value);
                        }
                        if (jQuery('.sgst_value').length > 0) {
                            jQuery('.sgst_value').html(sgst_value);
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').html(overall_tax_value);
                        }
                        if (jQuery('.cgst_value').length > 0) {
                            jQuery('.cgst_value').parent().find('td:first').html('CGST(' + overall_tax + '%) :');
                        }
                        if (jQuery('.sgst_value').length > 0) {
                            jQuery('.sgst_value').parent().find('td:first').html('SGST(' + overall_tax + '%) :');
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').parent().find('td:first').html('Total Tax(' + tax_percentage + ') :');
                        }
                    }
                    else {
                        igst_value = overall_tax_value;
                        if (jQuery('.igst_value').length > 0) {
                            jQuery('.igst_value').html(igst_value);
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').html(overall_tax_value);
                        }
                        if (jQuery('.igst_value').length > 0) {
                            jQuery('.igst_value').parent().find('td:first').html('IGST(' + tax_percentage + ') :');
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').parent().find('td:first').html('Total Tax(' + tax_percentage + ') :');
                        }
                    }
                }
            }
        }

        if (overall_tax_value != "" && overall_tax_value != 0 && typeof overall_tax_value != "undefined" && price_regex.test(overall_tax_value) == true) {
            if (charges_sub_total != "" && charges_sub_total != 0 && typeof charges_sub_total != "undefined" && price_regex.test(charges_sub_total) == true) {
                total_value = parseFloat(charges_sub_total) + parseFloat(overall_tax_value);
                total_value = total_value.toFixed(2);

                if (jQuery('.tax_total_amount').length > 0) {
                    jQuery('.tax_total_amount').html(total_value);
                }

                if (jQuery('.overall_total').length > 0) {
                    jQuery('.overall_total').html(total_value);
                }
                if (jQuery('input[name="overall_total"]').length > 0) {
                    jQuery('input[name="overall_total"]').val(total_value);
                }
                CalRoundOff();
            }
        }
        else {
            if (charges_sub_total != "" && charges_sub_total != 0 && typeof charges_sub_total != "undefined" && price_regex.test(charges_sub_total) == true) {

                if (jQuery('.tax_total_amount').length > 0) {
                    jQuery('.tax_total_amount').html(total_value);
                }
            }

            if (jQuery('.overall_total').length > 0) {
                jQuery('.overall_total').val(total_value);
            }
            if (jQuery('input[name="overall_total"]').length > 0) {
                jQuery('input[name="overall_total"]').val(total_value);
            }

            CalRoundOff();
        }
    }
    else {
        if (charges_sub_total != "" && charges_sub_total != 0 && typeof charges_sub_total != "undefined" && price_regex.test(charges_sub_total) == true) {

            if (jQuery('.overall_total').length > 0) {
                jQuery('.overall_total').html(charges_sub_total);
            }
            if (jQuery('input[name="overall_total"]').length > 0) {
                jQuery('input[name="overall_total"]').val(charges_sub_total);
            }
            CalRoundOff();
        }
        else {
            if (jQuery('.overall_total').length > 0) {
                jQuery('.overall_total').html(charges_sub_total);
            }
            if (jQuery('input[name="overall_total"]').length > 0) {
                jQuery('input[name="overall_total"]').val(charges_sub_total);
            }

            CalRoundOff();
        }
    }
}
function getRateByTaxOption() {
    var tax_option = "";
    if (jQuery('select[name="tax_option"]').length > 0) {
        tax_option = jQuery('select[name="tax_option"]').val();
        tax_option = jQuery.trim(tax_option);
    }
    var tax_type = "";
    if (jQuery('select[name="tax_type"]').length > 0) {
        tax_type = jQuery('select[name="tax_type"]').val();
    }

    var gst_option = "";
    if (jQuery('input[name="gst_option"]').length > 0) {
        gst_option = jQuery('input[name="gst_option"]').val();
    }


    if (gst_option == '1') {
        if (jQuery('.product_row').length > 0) {
            jQuery('.product_row').each(function () {

                var final_rate = "";
                if (jQuery(this).find('input[name="rate[]"]').length > 0) {
                    final_rate = jQuery(this).find('input[name="rate[]"]').val();
                    final_rate = jQuery.trim(final_rate);
                }

                var rate = 0; var tax = "";
                if (typeof tax_option != "undefined" && tax_option != null && tax_option != "") {

                    if (tax_type == '1') {
                        if (jQuery(this).find('select[name="product_tax[]"]').length > 0) {
                            var tax = jQuery(this).find('select[name="product_tax[]"]').val();
                            if (typeof tax != "undefined" && tax != null && tax != "") {
                                tax = tax.replace("%", "");
                                tax = jQuery.trim(tax);
                            }
                        }
                    }
                    else {
                        if (jQuery('select[name="overall_tax"]').length > 0) {
                            var tax = jQuery('select[name="overall_tax"]').val();
                            if (typeof tax != "undefined" && tax != null && tax != "") {
                                tax = tax.replace("%", "");
                                tax = jQuery.trim(tax);
                            }
                        }
                    }
                    if (price_regex.test(final_rate) == true) {
                        if (price_regex.test(tax) == true) {
                            if (tax_option == 2) {
                                rate = (parseFloat(final_rate) * 100) / (parseFloat(tax) + 100);
                            }
                            else if (tax_option == 1) {

                                rate = final_rate;
                            }
                        }
                    }
                    if (typeof rate != "undefined" && rate != null && rate != "") {
                        if (price_regex.test(rate) == true) {
                            var product_price = 0;
                            product_price = rate;
                            rate = parseFloat(rate)
                            rate = rate.toFixed(2);
                            if (jQuery(this).find('input[name="final_rate[]"]').length > 0) {
                                jQuery(this).find('input[name="final_rate[]"]').val(rate);
                            }
                            if (jQuery(this).find('.final_rate').length > 0) {
                                jQuery(this).find('.final_rate').html("Final Rate : " + rate);
                            }
                            var discount = 0;

                            var quantity = "";
                            if (jQuery(this).find('input[name="quantity[]"]').length > 0) {
                                quantity = jQuery(this).find('input[name="quantity[]"]').val();
                                quantity = jQuery.trim(quantity);
                                if (price_regex.test(quantity) == true && price_regex.test(product_price) == true) {
                                    var amount = "";
                                    if (tax_type == '1') {
                                        if (tax_option == 1) {
                                            amount = (parseFloat(quantity) * parseFloat(rate));
                                            amount = amount.toFixed(2);
                                        } else {
                                            amount = (parseFloat(quantity) * parseFloat(rate));
                                            amount = amount.toFixed(2);
                                        }
                                    } else {
                                        if (tax_option == 1) {
                                            amount = (parseFloat(quantity) * parseFloat(rate));
                                            amount = amount.toFixed(2);
                                        } else {
                                            amount = (parseFloat(quantity) * parseFloat(rate));
                                            amount = amount.toFixed(2);
                                        }
                                    }
                                    
                                    if (jQuery(this).find('.amount').length > 0) {

                                        jQuery(this).find('.amount').html(amount);
                                    }
                                    if (jQuery(this).find('input[name="amount[]"]').length > 0) {

                                        jQuery(this).find('input[name="amount[]"]').val(amount);
                                    }
                                }
                            }
                        }
                    }
                }
            });
        }

    } else {
        if (jQuery('.product_row').length > 0) {
            jQuery('.product_row').each(function () {


                var final_rate = "";
                var quantity = jQuery(this).find('input[name="quantity[]"]').val();
                if (jQuery(this).find('input[name="rate[]"]').length > 0) {
                    final_rate = jQuery(this).find('input[name="rate[]"]').val();
                    final_rate = jQuery.trim(final_rate);
                }

                if (typeof final_rate != "undefined" && final_rate != null && final_rate != "") {
                    if (price_regex.test(final_rate) == true) {
                        var product_price = 0;
                        product_price = final_rate;
                        final_rate = parseFloat(final_rate)
                        final_rate = final_rate.toFixed(2);
                        if (jQuery(this).find('input[name="final_rate[]"]').length > 0) {
                            jQuery(this).find('input[name="final_rate[]"]').val(final_rate);
                        }
                        if (jQuery(this).find('.final_rate').length > 0) {
                            jQuery(this).find('.final_rate').html("Final Rate : " + final_rate);
                        }
                        var discount = 0;

                        var quantity = "";
                        if (jQuery(this).find('input[name="quantity[]"]').length > 0) {
                            quantity = jQuery(this).find('input[name="quantity[]"]').val();
                            quantity = jQuery.trim(quantity);
                            if (price_regex.test(quantity) == true && price_regex.test(product_price) == true) {
                                var amount = "";
                                amount = (parseFloat(quantity) * parseFloat(final_rate));
                                amount = amount.toFixed(2);
                                if (jQuery(this).find('.amount').length > 0) {

                                    jQuery(this).find('.amount').html(amount);
                                }
                                if (jQuery(this).find('input[name="amount[]"]').length > 0) {

                                    jQuery(this).find('input[name="amount[]"]').val(amount);
                                }
                            }
                        }
                    }
                }
            });
        }
    }
    calTotal();

}

function getPartyState(party_id) {
    var post_url = "bill_changes.php?get_party_state=" + party_id;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            if (jQuery('input[name="party_state"]').length > 0) {
                jQuery('input[name="party_state"]').val(result);
            }
        }
    });
}

function calTotal() {
    SnoCalculation();
    if (jQuery('.sub_total').length > 0) {
        jQuery('.sub_total').html('');
    }
    if (jQuery('.discounted_total').length > 0) {
        jQuery('.discounted_total').html('');
    }
    if (jQuery('.extra_charges_total').length > 0) {
        jQuery('.extra_charges_total').html('');
    }
    // if (jQuery('.cgst_value').length > 0) {
    //     jQuery('.cgst_value').html('');
    // }
    // if (jQuery('.sgst_value').length > 0) {
    //     jQuery('.sgst_value').html('');
    // }
    // if (jQuery('.igst_value').length > 0) {
    //     jQuery('.igst_value').html('');
    // }
    // if (jQuery('.total_tax_value').length > 0) {
    //     jQuery('.total_tax_value').html('');
    // }
    if (jQuery('.round_off').length > 0) {
        jQuery('.round_off').html('');
    }
    if (jQuery('.overall_total').length > 0) {
        jQuery('.overall_total').html('');
    }
    var gst_option = 0;
    if (jQuery('input[name="gst_option"]').length > 0) {
        gst_option = jQuery('input[name="gst_option"]').val();
        gst_option = jQuery.trim(gst_option);
    }

    var tax_type = 0;
    if (jQuery('select[name="tax_type"]').length > 0) {
        tax_type = jQuery('select[name="tax_type"]').val();
        tax_type = tax_type.trim();
    }

    var tax_option = 0;
    if (jQuery('select[name="tax_option"]').length > 0) {
        tax_option = jQuery('select[name="tax_option"]').val();
        tax_option = tax_option.trim();
    }

    var overall_tax = "";
    if (jQuery('input[name="overall_tax"]').length > 0) {
        overall_tax = jQuery('input[name="overall_tax"]').val();
        overall_tax = overall_tax.trim();
    }

    var amount_total = 0;
    if (jQuery('.product_row').length > 0) {

        jQuery('.product_row').each(function () {
            var final_rate = 0; var selected_quantity = ""; var amount = 0;

            if (jQuery(this).find('input[name="rate[]"]').length > 0) {
                final_rate = jQuery(this).find('input[name="rate[]"]').val();
                final_rate = jQuery.trim(final_rate);
            }
            if (jQuery(this).find('input[name="quantity[]"]').length > 0) {
                selected_quantity = jQuery(this).find('input[name="quantity[]"]').val();
                selected_quantity = jQuery.trim(selected_quantity);
            }
            var amount = "";

            if (selected_quantity != "" && selected_quantity != 0 && typeof final_rate != "undefined" && price_regex.test(final_rate) == true) {
                amount = parseFloat(selected_quantity) * parseFloat(final_rate);
                amount = amount.toFixed(2);
                if (jQuery(this).find('input[name="amount[]"]').length > 0) {
                    amount = jQuery(this).find('input[name="amount[]"]').val();
                }
            }
            // }
            amount = amount.replace(/ /g, '');
            amount = amount.trim();
            if (typeof amount != "undefined" && amount != "" && amount != 0 && price_regex.test(amount) == true) {
                if (price_regex.test(amount) == true) {
                    amount_total = parseFloat(amount_total) + parseFloat(amount);
                }
            }
        });

        if (typeof amount_total != "undefined" && amount_total != "" && amount_total != 0 && price_regex.test(amount_total) == true) {
            amount_total = amount_total.toFixed(2);

            var charges_sub_total = 0;
            if (jQuery('.charges_sub_total').is(":visible")) {
                if (jQuery('.charges_sub_total').length > 0) {
                    charges_sub_total = jQuery('.charges_sub_total').last().html();
                    charges_sub_total = jQuery.trim(charges_sub_total);
                }
            }
            else {
                charges_sub_total = amount_total;
            }

            if (jQuery('.sub_total').length > 0) {
                jQuery('.sub_total').html(amount_total);
            }
            if (jQuery('.discounted_total').length > 0) {
                jQuery('.discounted_total').html(amount_total);
            }

            if (jQuery('.charges_sub_total').length > 0) {
                jQuery('.charges_sub_total').html(amount_total);
            }
            if (jQuery('.overall_total').length > 0) {
                jQuery('.overall_total').html(amount_total);
            }
            if (jQuery('.taxable_amount').length > 0) {
                jQuery('.taxable_amount').html(amount_total);
            }
            if (jQuery('.tax_total_amount').length > 0) {
                jQuery('.tax_total_amount').html(amount_total);
            }
        }
    }
    else {
        if (jQuery('.overall_total').length > 0) {
            jQuery('.overall_total').html('');
        }
    }
    checkDiscount();
}

function ProductRowCheck(obj) {
    if (jQuery(obj).parent().parent().find('span.infos').length > 0) {
        jQuery(obj).parent().parent().find('span.infos').remove();
    }

    var selected_content = ""; var selected_unit_type = ""; var selected_quantity = ""; var total_qty = ""; var quantity_check = 1; quantity_error = 1; var unit_type_check = 1; content_error = 1; content_check = 1;
    var selected_per = ""; material_type = "";
    if (jQuery(obj).closest('tr').find('input[name="quantity[]"]').length > 0) {
        selected_quantity = jQuery(obj).closest('tr').find('input[name="quantity[]"]').val();
        selected_quantity = jQuery.trim(selected_quantity);
        if (typeof selected_quantity == "undefined" || selected_quantity == "" || selected_quantity == 0) {
            quantity_check = 0;
        }
        else if (price_regex.test(selected_quantity) == false) {
            quantity_error = 0;
        }
        else if (parseFloat(selected_quantity) > 99999) {
            quantity_error = 0;
        }
    }

    if (parseFloat(quantity_error) == 0) {
        if (jQuery(obj).closest('tr').find('input[name="quantity[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="quantity[]"]').after('<span class="infos">Invalid Quantity</span>');
        }
    }


    var rate_check = 1; var rate_error = 1; var final_rate_error = 1; var final_rate_check = 1;

    var gst_option = "";
    if (jQuery('input[name="gst_option"]').length > 0) {
        gst_option = jQuery('input[name="gst_option"]').val();
        gst_option = gst_option.trim();
    }

    var tax_type = "";
    if (jQuery('select[name="tax_type"]').length > 0) {
        tax_type = jQuery('select[name="tax_type"]').val();
        tax_type = tax_type.trim();
    }

    var tax_option = 0;
    if (jQuery('select[name="tax_option"]').length > 0) {
        tax_option = jQuery('select[name="tax_option"]').val();
        tax_option = tax_option.trim();
    }

    var overall_tax = "";
    if (jQuery('input[name="overall_tax"]').length > 0) {
        overall_tax = jQuery('input[name="overall_tax"]').val();
        overall_tax = overall_tax.trim();
    }

    var selected_rate = "";
    if (jQuery(obj).closest('tr').find('input[name="rate[]"]').length > 0) {
        selected_rate = jQuery(obj).closest('tr').find('input[name="rate[]"]').val();
        selected_rate = jQuery.trim(selected_rate);
        if (typeof selected_rate == "undefined" || selected_rate == "" || selected_rate == 0) {
            rate_check = 0;
        }
        else if (price_regex.test(selected_rate) == false) {
            rate_error = 0;
        }
        else if (parseFloat(selected_rate) > 99999) {
            rate_error = 0;
        }
    }

    var product_tax = "";
    if (jQuery(obj).closest('tr').find('select[name="product_tax[]"]').length > 0) {
        product_tax = jQuery(obj).closest('tr').find('select[name="product_tax[]"]').val();
        product_tax = jQuery.trim(product_tax);
    }

    var overall_tax = "";
    if (jQuery('select[name="overall_tax"]').length > 0) {
        overall_tax = jQuery('select[name="overall_tax"]').val();
        overall_tax = jQuery.trim(overall_tax);
    }



    if (parseFloat(rate_error) == 0) {
        if (jQuery(obj).closest('tr').find('input[name="rate[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="rate[]"]').after('<span class="infos">Invalid rate</span>');
        }
    }

    var final_rate = "";
    if (parseFloat(rate_check) == 1 && parseFloat(rate_error) == 1) {
        final_rate = selected_rate;

        if (parseInt(gst_option) == 1) {
            var tax = "";
            if (tax_type == 1) {
                tax = product_tax
            }
            else {
                tax = overall_tax;
            }
            if (parseInt(tax_option) == 2) {
                if (tax != 0 && tax != "" && typeof tax != "undefined") {
                    tax = tax.replace('%', '');
                    tax = tax.trim();
                    final_price = (parseFloat(final_rate) * 100) / (100 + parseFloat(tax));
                    final_rate = final_price.toFixed(2);
                }
            }
            else {
                if (tax != 0 && tax != "" && typeof tax != "undefined") {
                    tax = tax.replace('%', '');
                    tax = tax.trim();
                    final_price = (parseFloat(final_rate) * 100) / 100;
                    final_rate = final_price.toFixed(2);
                }
            }
        }

        if (jQuery(obj).closest('tr').find('.final_rate').length > 0) {
            jQuery(obj).closest('tr').find('.final_rate').html("Final Rate : " + final_rate);
        }
        if (jQuery(obj).closest('tr').find('input[name="final_rate[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="final_rate[]"]').val(final_rate);
        }

    }
    else {
        if (jQuery(obj).closest('tr').find('.final_rate').length > 0) {
            jQuery(obj).closest('tr').find('.final_rate').html('');
        }
        if (jQuery(obj).closest('tr').find('input[name="final_rate[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="final_rate[]"]').val('');
        }
    }

    var amount = "";
    if (final_rate != '' && selected_quantity != '') {
        amount = (parseFloat(final_rate) * parseFloat(selected_quantity));
        amount = amount.toFixed(2);
    }
    if (jQuery(obj).closest('tr').find('.amount').length > 0) {
        jQuery(obj).closest('tr').find('.amount').html(amount);
    }
    if (jQuery(obj).closest('tr').find('input[name="amount[]"]').length > 0) {
        jQuery(obj).closest('tr').find('input[name="amount[]"]').val(amount);
    }
    checkDiscount();
    calTotal();
}