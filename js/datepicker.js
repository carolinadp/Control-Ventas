(function ($) {
  'use strict';
	$(function () {
		//default date range picker
		$('.daterange').daterangepicker({
			autoApply:true
		});
		//date time picker
		$('.datetime').daterangepicker({
      singleDatePicker: true,
			timePicker: true,
      minDate:new Date(),
			locale: {
				format: 'YYYY/MM/DD HH:mm'
			}
		});
		//single date
    $('.date').daterangepicker({
			singleDatePicker: true,
      minDate:new Date(),
      locale: {
				format: 'YYYY/MM/DD'
			}
    });
	});
})(jQuery);
