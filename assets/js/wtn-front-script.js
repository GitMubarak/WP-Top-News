(function( window,$ ){
	// USE STRICT
	"use strict";

	$('.after-submit').find('#ajaxLoader').css({'display': 'none'});
	$('.after-submit').find('#mailWarning').css({'display': 'none'});
	$('.after-submit').find('#mailSuccess').css({'display': 'none'});
	$('.after-submit').find('#mailError').css({'display': 'none'});

	$('form#fappingForm').submit(function(){

		$('#wph-wrap-all').find('h3#mailWarning').hide();
		$('#wph-wrap-all').find('h3#mailSuccess').hide();
		$('#wph-wrap-all').find('h3#mailError').hide();

		var emailField = $('#fappingEmail').val();

		if(emailField !='' || emailField.length != 0){
			$('.after-submit').find('#ajaxLoader').css({'display': 'block'});
			var data = {
							action: 'flapping_email',
							email_address: emailField
						};
			$.post(add_submitter_script.ajaxurl, data, function(response){
				var result =  $.parseJSON(response);
				var status = result['status'];
				var counter = result['counter'];
				var wrongemail = result['wrongemail'];
				var emailexist = result['emailexist'];
				var currentNum = $('#wph-wrap-all').find('#emailCount').text();

				$('.after-submit').find('#ajaxLoader').css({'display': 'none'});
				
				if(status == 'success'){
					$('#wph-wrap-all').find('h3#mailSuccess').fadeIn("slow");
					$('#wph-wrap-all').find('#emailCount').html(parseInt(currentNum)+parseInt(counter));
					$('#fappingForm')[0].reset();
				} else{
					$('#wph-wrap-all').find('#mailError').fadeIn( "slow");
				}

				if(wrongemail>0){
					$('#wph-wrap-all').find('#mailWarning').html(add_submitter_script.errorP1 + ' ' + wrongemail + ' ' + add_submitter_script.nValidP2);
					$('#wph-wrap-all').find('#mailWarning').fadeIn( "slow");
				}

				if(emailexist>0){
					$('#wph-wrap-all').find('#mailWarning').html(add_submitter_script.errorP1 + ' ' + emailexist + ' ' + add_submitter_script.existP2);
					$('#wph-wrap-all').find('#mailWarning').fadeIn( "slow");
				}
			});
		} else {
			$('#wph-wrap-all').find('h3#mailError').fadeIn("slow");
		}
		return false;
	});

	$('.customer.share').on("click", function(e){
		e.preventDefault();
		var strTitle = ((typeof $(this).attr('title') !== 'undefined') ? $(this).attr('title') : add_submitter_script.shareDefaultTitle );
		var strParam = 'width=' + add_submitter_script.sharePopWidth + ',height=' + add_submitter_script.sharePopHeight + ',resizable=' + add_submitter_script.strResize;
		window.open( $(this).attr('href'), strTitle, strParam ).focus();
	});

})(window, jQuery);
