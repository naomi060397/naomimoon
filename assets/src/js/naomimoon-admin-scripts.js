jQuery(document).ready(function($){
	$('.color-picker').wpColorPicker();

	$(document).on("click", ".options-tab", function () {
		let id = $(this).attr('id');
		$('.options-page').removeClass('active');
		$('.options-tab').removeClass('active');
		$(this).toggleClass('active');
		$('.' + id).toggleClass('active');
	});
});