(function($){
	if($('body').hasClass('taxonomy-category')) {
		$('#acf-form-data + h2 + .form-table tr').each((i, e) => {
    		$('.term-parent-wrap').after(e);
		});
		$('#acf-form-data + h2').remove();
	}
})(jQuery);