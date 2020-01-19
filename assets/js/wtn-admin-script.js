(function($){
	
	// USE STRICT
	"use strict";

	/*
	$.each(safAdminScript.safIdsOfColorPicker, function( index, value ){
		$(value).wpColorPicker();
	});
	$(".wp-color-picker").wpColorPicker(
		'option',
		'change',
		function(event, ui) {
			safResetPreview();
		}
	);
		*/
	
	$('.wtn-closebtn').on('click', function(){
		this.parentElement.style.display='none';
	});

	$("form#wtn-settings-form").on('click', 'label', function(e){
		e.preventDefault();
		var $check = $(this).prev();
		
		if($check.is(':checked') === false){
			$check.prop( "checked", true );
			return false;
		}
		if($check.is(':checked') === true){
			$check.prop( "checked", false );
			return false;
		}
	});

})(jQuery);
