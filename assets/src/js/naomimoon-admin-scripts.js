jQuery(document).ready(function($){
	$('.color-picker').wpColorPicker();

	$(document).on("click", ".options-tab", function () {
		let id = $(this).attr('id');
		$('.options-page').removeClass('active');
		$('.options-tab').removeClass('active');
		$(this).toggleClass('active');
		$('.' + id).toggleClass('active');
	});

	$(document).on("click", "#reset-color-options", function () {
		if (confirm("Are you sure you want to reset to the default color scheme?") == true) {
			$('.color-picker.wp-color-picker').val('');
		} else {
			return false;
		}
	});

});