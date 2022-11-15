jQuery(document).ready(function($){
	$('.color-picker').wpColorPicker();

	let rows = document.querySelectorAll('tr');
	rows.forEach((row) => {
		let label = $(row).find('th').text();
		$(row).find('.wp-color-result-text').text(label);
	})

	$('.myCheckbox').prop('checked', true);

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

	$('.iris-picker-inner').on("mouseover",function() {
		$('.iris-picker-inner').on("mousemove", function() {
			let grad1 = $('.gradient-1').find('.wp-color-result').css("background-color");
			let grad2 = $('.gradient-2').find('.wp-color-result').css("background-color");
			$('.gradient-preview').find('.preview').css('background', 'linear-gradient(90deg, '+grad1+',' +grad2 );
		})
    });
});