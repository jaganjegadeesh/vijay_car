function CustomAddModalContent(page_title) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (typeof page_title != "undefined" && page_title != "") {
					jQuery('#CustomAddModal .modal-header').find('.h4').html("");
					jQuery('#CustomAddModal .modal-header').find('.h4').html("Add "+ page_title);
					page_title = page_title.toLowerCase();
				}
				jQuery('.custom_add_modal_button').trigger("click");
				console.log(page_title);
				post_url = page_title+"_changes.php?add_custom=1&show_"+page_title+"_id="
				jQuery.ajax({
					url: post_url, success: function (result) {
						if (result != '') {
							jQuery('#CustomAddModal .modal-body').html(result);
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

function CloseCustomeModel(model) {
	if (jQuery('#CustomAddModal').length > 0) {
		jQuery('#CustomAddModal .modal-header .btn-close').trigger("click");
	}
	var page = jQuery("input[name='page_title']").val();
	var post_url = "common_changes.php?custom_model="+model+"&page="+page;
	jQuery.ajax({
		url: post_url, success: function (result) {
			if (result != '') {
				if(model == 'party') {
					if (jQuery('select[name="party_id"]').length > 0) {
						jQuery('select[name="party_id"]').empty().html(result);
					}
				}
				if(model == 'product') {
					if (jQuery('select[name="selected_product_id"]').length > 0) {
						jQuery('select[name="selected_product_id"]').empty().html(result);
					}
				}
				if(model == 'vehicle') {
					if (jQuery('select[name="vehicle_id"]').length > 0) {
						jQuery('select[name="vehicle_id"]').empty().html(result);
					}
				}
			}

		}

	});

}