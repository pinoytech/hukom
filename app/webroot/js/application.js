jQuery.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
}

jQuery([
  '/img/backButton_up.png',
  '/img/backButton_down.png',
  '/img/nextButton_up.png',
  '/img/nextButton_down.png',
  '/img/submitButton_up.png',
  '/img/submitButton_down.png',
  '/img/homeButton_up.png',
  '/img/homeButton_down.png',
  '/img/resetButton_up.png',
  '/img/resetButton_down.png',
  '/img/selectButton_up.png',
  '/img/selectButton_down.png',
  '/img/removeButton_up.png',
  '/img/removeButton_down.png',
  '/img/Addbutton_up.png',
  '/img/Addbutton_down.png',
  '/img/availButton_up.png',
  '/img/previousButton_down.png',
  '/img/previousButton_up.png',
  '/img/nextButton_down.png',
  '/img/nextButton_up.png',
]).preload();

function login_form() {
	$(document).ready(function() {
		$("#UserLoginForm").validate();
	});
}

function forgot_password_form() {
	$('document').ready(function() {
		//jQuery Valdidate
		$("#UserForgotPasswordForm").validate();
	});
}

function register_form() {
	$(document).ready(function() {
		jQuery("#reject-alert").dialog({
			autoOpen: false,
			width: 300,
			height: 200,
	        modal: true,
			resizable: false,
	        buttons: {
	            Ok: function() {
	            	jQuery(this).dialog('close');
				}
	        }
		});
	
		//jQuery Valdidate
		jQuery("#UserRegisterForm").validate({
			rules: {
				"data[User][password_confirm]": {
					equalTo: '#UserPassword'
				},
			},
			submitHandler: function(form) {
				check_end_user();
			}
		});
	});
}

function check_end_user() {
	$(document).ready(function() {
		jQuery("#end-user-form").dialog({
			autoOpen: false,
			width: 800,
			height: 600,
	    modal: true,
			resizable: false,
	    buttons: {
				'I agree': function() {
	      	jQuery('#agree-checker').val(1);
					document.forms['UserRegisterForm'].submit();
				},
				"I reject": function() {
					jQuery('#agree-checker').val(''); 
					jQuery("#reject-alert").dialog("open");
			  }
			}
		}); 
	
		if(jQuery('#agree-checker').val() != '') {
			form.submit();
		}
		else {
			jQuery("#end-user-form").dialog("open");
		}
	});
}

function personal_info_form() {
	$(document).ready(function() {
		//jQuery Valdidate
		jQuery("#UserPersonalInfoForm").validate({
		    submitHandler: function(form) {
			
				if (jQuery('#PersonalInfoCivilStatus').val() == 'Married' || jQuery('#PersonalInfoCivilStatus').val() == 'Divorced/Annulled'){
                    
				    if (jQuery('#PersonalInfoMarriageDate').val() == '' || jQuery('#PersonalInfoMarriagePlace').val() == '') {
				       alert('Marriage Date and Marriage Place must not be empty');
				       return false;
				    }
				}
			
				form.submit();
			}
		});
	
		//Disable Marriage Fields
		if (jQuery('#PersonalInfoCivilStatus').val() == '' || jQuery('#PersonalInfoCivilStatus').val() == 'Single' || jQuery('#PersonalInfoCivilStatus').val() == 'Living In') {
			bool = true;
		}
		else {
			bool = false;
		}
		jQuery('.marriage_date').attr('disabled', bool);
		jQuery('#PersonalInfoMarriagePlace').attr('disabled', bool);
	
		jQuery('#PersonalInfoCivilStatus').change(function(){
			if (jQuery(this).val() == 'Single' || jQuery(this).val() == '' || jQuery(this).val() == 'Living In') {
				bool = true;
				jQuery('#PersonalInfoMarriagePlace').val('');
				jQuery('#PersonalInfoMarriageDate').val('');
			}
			else{
				bool = false;
			}
			jQuery('.marriage_date').attr('disabled', bool);
			jQuery('#PersonalInfoMarriagePlace').attr('disabled', bool);
		
		});
	
	});
}

function spouse_info_form(id, case_id, case_detail_id) {
	$(document).ready(function() {
		//jQuery Valdidate
		jQuery("#UserSpouseInfoForm").validate();
	
		//Submit button logic
		jQuery('#back').click(function() {
			jQuery('#goto').val('personal_info');
		
			// alert(jQuery('#SpouseInfoId').val());
		
			if (jQuery('#SpouseInfoId').val() == '') {
			
				var agree=confirm("Data you provided on this form will be discarded. Do you want to continue?");
		        if (agree){                        
		           window.location = '/users/personal_info/' + id +'/' + case_id + '/' + case_detail_id;
		        }
		        else{
		           return false;
		        }
			}
			else{
				jQuery('form').submit();
			}
		});

		jQuery('.next-save').click(function() {
			jQuery('#goto').val('children_info');
			jQuery('form').submit();
		});
	});
}

function children_info_form() {
	$(document).ready(function() {
		//Enable Custody
		if (jQuery('.no-of-children').val() > 0) {
			jQuery('#ChildrenInfoCustody').attr('disabled', false);
		}
	
		//Add children row to list
		jQuery('#add-child').live('click', function(e) {
		
			//Count no. of rows
			total_rows = jQuery('#child-list > tbody').size() - 1;
			// alert(total_rows);
		
			//Modify HTML
			component_render = jQuery('#clone-row').html();
			component_render = component_render.replace(/xxx/g, total_rows + 100);
			component_render = component_render.replace(/Xxx/g, total_rows + 100);

			jQuery('#child-list')
		    // .hide()
		    .append(component_render).find("tr:last").find(".birthdate").datepicker({
			    dateFormat: 'yy-mm-dd',
			    changeMonth: true,
			    changeYear: true,
			    yearRange: '1900:2011',
			  })
		    // .fadeIn();
		
			if (jQuery('.no-of-children').val()) {
				no_of_children = jQuery('.no-of-children').val();
			}
			else {
				no_of_children = 0;
			}
		
			//Assign no. of children
			jQuery('.no-of-children').val(parseInt(no_of_children) + 1);
		
			//Enable Custody
			if (jQuery('.no-of-children').val() > 0) {
				jQuery('#ChildrenInfoCustody').attr('disabled', false);
			}
	
		});		
	
		//Remove Children from list
		jQuery('.child-remove').live('click', function(e) {
			var agree=confirm("Do you want to remove this item?");
	    if (agree){                        
				var parentrow = $(this).parents('tr');
		    e.preventDefault();
				parentrow.empty();
		    parentrow.fadeOut();

				//Assign no. of children
				jQuery('.no-of-children').val(jQuery('.no-of-children').val() - 1);

				//Disable Custody
				if (jQuery('.no-of-children').val() < 1) {
					jQuery('#ChildrenInfoCustody').attr('disabled', true);
					jQuery('#ChildrenInfoCustody').val('empty');
				}
			}
	    else{
	    	return false;
	    }
		});
	
		//jQuery Valdidate
		jQuery("#UserChildrenInfoForm").validate();
	
		jQuery.extend(jQuery.validator.messages, {
		    required: "Required",
		});
	
		//Submit button logic
		jQuery('#back').click(function() {
			jQuery('#goto').val('personal_info');
			jQuery('form').submit();
		});
	
		jQuery('#next').click(function() {
			jQuery('#goto').val('legal_problem');
			jQuery('form').submit();
		});
	
		jQuery('#save').click(function() {
			jQuery('#goto').val('profilesave');
			jQuery('form').submit();
		});
	});
}

function legalcases_index() {
	$(document).ready(function() {
		jQuery('.avail-button > img').mouseover(function() {
		  jQuery(this).attr('src', '/img/availButton_down.png');
		}).mouseout(function(){
		  jQuery(this).attr('src', '/img/availButton_up.png');
		});

		jQuery('.prev-button').mouseover(function() {
		  jQuery(this).attr('src', '/img/previousButton_down.png');
		}).mouseout(function(){
		  jQuery(this).attr('src', '/img/previousButton_up.png');
		});

		jQuery('.next-button').mouseover(function() {
		  jQuery(this).attr('src', '/img/nextButton_down.png');
		}).mouseout(function(){
		  jQuery(this).attr('src', '/img/nextButton_up.png');
		});
	});
}

function online_legal_consultation_form() {
	$(document).ready(function() {
		jQuery("#LegalcaseOnlineLegalConsultationForm").validate({
			rules: {
				"data[Legalcase][legal_service]" : {
					required: true
				}
			}
		});	
	
		jQuery('#legal-service-descriptions').tabs();
	});
}

function redirect_form(action, id, case_id, case_detail_id) {
	window.location = '/users/' + action + '/' + id + '/' + case_id + '/' + case_detail_id;
}

function legal_problem_form(action, id, case_id, case_detail_id, legal_problem) {
	$(document).ready(function() {
		//Assign radio value
		jQuery('.legal_problem_radio').filter('[value="' + legal_problem + '"]').attr('checked', true);

		jQuery("#LegalcaseLegalProblemForm").validate({
			rules: {
				"data[Legalcase][legal_problem]" : {
					required: true
				}
			},
			submitHandler: function(form) {
			
				if (jQuery('.legal_problem_radio:checked').val() == 'Business'){
					if (!jQuery('#my_business_is input').is(":checked")){
						alert('Please select business type');
						return false;
					}
					
				}
			
				if (jQuery('.legal_problem_radio:checked').val() == 'Anything under the sun'){
				
					if (jQuery('#anything_under').children('input').val() == ''){
						alert('Please input data on Other Legal Services field');
						return false;
					}
				}

				form.submit();
			}
		});
	
		//Submit button logic
		jQuery('#back').click(function() {
			window.location = '/users/' + action + '/' + id + '/' + case_id + '/' + case_detail_id;
		});

		jQuery('#next').click(function() {
			jQuery('form').submit();
		});
	
		jQuery('.legal_problem_radio').click(function() {
			if (jQuery(this + ':checked')){
				if (jQuery(this).val() == 'Anything under the sun'){
					jQuery('#anything_under').show();
					jQuery('#anything_under').children('input').attr('disabled', false);
				}
				else {
					jQuery('#anything_under').children('input').val('');
					jQuery('#anything_under').children('input').attr('disabled', true);				
				}
			
				if (jQuery(this).val() == 'Business'){
					jQuery('#my_business_is').show();
				}
			}		
		});
	
	});
}

function summary_of_facts_form(id, case_id, case_detail_id, upload_folder) {
	$('document').ready(function() {

		//jQuery Valdidate
		$("#LegalcaseSummaryOfFactsForm").validate();

		$('#back').click(function() {
			$('#goto').val('legal_problem');

			if ($('#LegalcasedetailSummary').val() == '') {

				var agree=confirm("Data you provided on this form will be discarded. Do you want to continue?");
		        if (agree){                        
		           window.location = '/legalcases/legal_problem/' + id + '/' + case_id + '/' + case_detail_id;
		        }
		        else{
		           return false;
		        }
			}
			else{
				$('form').submit();
			}
		});

		$('#next').click(function() {
			$('#goto').val('objectives_questions');
			$('form').submit();
		});

		$('#file_upload').uploadify({
			'uploader'  : '/uploadify/uploadify.swf',
			'script'    : '/uploadify/uploadify.php',
			'cancelImg' : '/uploadify/cancel.png',
			'buttonImg' : '/img/selectButton_up.png',
			'wmode'     : 'transparent',
			'folder'    : upload_folder,
			'auto'      : true,
			'fileExt'   : '*.jpg;*.gif;*.png;*.doc;*.docx;*.pdf',
			'fileDesc'  : 'Image Files (JPG, GIF, PNG); Document Files (PDF, Word Doc)',
			'sizeLimit' : 2097152,
			'onComplete' : function(event, ID, fileObj, response, data) {
				append_files(fileObj)
			}
		});
	});
	
	$('.remove_file').live('click', function(e) {
		var parent = $(this).parent();

		$.ajax({
			type: "POST", 
			url: "/legalcases/remove_file",
			data: 'file_path=' + $(this).attr('id'),
			success: function(msg)
			{
				parent.empty().fadeOut();
			},
			error: function()
			{
				alert("An error occured while updating. Try again in a while");
			}
		 });
	});
}

function append_files(fileObj) {
	name = fileObj.name;
	$('#file-list').append('<li class="actions">'+name+' <a class="remove_file" id="'+fileObj.filePath+'" >Remove</a></li>');
}

function objectives_questions_form(id, case_id, case_detail_id) {
	$('document').ready(function() {

		//jQuery Valdidate
		$("#LegalcaseObjectivesQuestionsForm").validate();

		$('#back').click(function() {
			$('#goto').val('summary_of_facts');

			if ($('#LegalcasedetailObjectives').val() == '' || $('#LegalcasedetailQuestions').val() == '') {
				var agree=confirm("Data you provided on this form will be discarded. Do you want to continue?");
		    
				if (agree){                        
		    	window.location = '/legalcases/summary_of_facts/' + id + '/' + case_id + '/' + case_detail_id;
		    }
		    else{
		    	return false;
				}
			}
			else{
				$('form').submit();
			}
		});

		$('#next').click(function() {
			$('#goto').val('summary_of_information');
			$('form').submit();
		});

	});
}

function summary_of_information_form(id, case_id, case_detail_id) {
	$('document').ready(function() {
		//jQuery Valdidate
		$("#LegalcaseSummaryOfFactsForm").validate();

		$('#back').click(function() {
			window.location = '/legalcases/objectives_questions/' + id + '/' + case_id + '/' + case_detail_id;
		});

		$('#next').click(function() {
			window.location = '/legalcases/online_legal_consultation_agreement/' + id + '/' + case_id + '/' + case_detail_id;
		});

		$('#new-facts').click(function() {
			window.location = '/legalcases/summary_of_facts/' + id + '/' + case_id;
		});

	  $('#back-to-case-index').click(function() {
			window.location = '/legalcases/index/' + id;
		});
	});
}

function online_legal_consulation_agreement_form(id, case_id, case_detail_id) {
	$('document').ready(function() {
		//$('#UserRegisterForm').	

		$("#reject-alert").dialog({
			autoOpen: false,
			width: 350,
			height: 150,
	    modal: true,
			resizable: false,
	    buttons: {
	    	Ok: function() {
	    		$(this).dialog('close');
				}
	    }
		});

		$('#check_end_user').click(function() {
			if($('#accept').is(":checked")){
				window.location = '/payments/mode_of_payment/' + id + '/' + case_id + '/' + case_detail_id;
				return false;
			}

			if($('#reject').is(":checked")){
				$("#reject-alert").dialog("open");
			}

			if($('.terms:not(:checked)')){
				$("#reject-alert").dialog("open");
			}

		});

		$('#accept').click(function() {
			if($('#accept').is(":checked")){
				$('#reject').attr('checked', false);
			}
		});

		$('#reject').click(function() {
			if($('#reject').is(":checked")){
				$('#accept').attr('checked', false);
			}
		});
	});
}

function mode_of_payment_form(id, case_id, case_detail_id, payment_option) {
	$('document').ready(function() {
		//Assign radio value
		$('.option_radio').filter('[value="' + payment_option + '"]').attr('checked', true);

		$("#PaymentModeOfPaymentForm").validate({
			rules: {
				"data[Payment][option]" : {
					required: true
				}
			},
			submitHandler: function(form) {
				option_value = $('.option_radio:checked').val();

			  $('#' + option_value + '_holder').dialog({
					autoOpen: false,
					width: 800,
					height: 600,
				  modal: true,
					resizable: false,
				  buttons: {
				  	'Pay Later': function() {
							window.location = '/dashboard/';
						},
						'Proceed Payment': function() {
							if (option_value == 'paypal') {
								$.ajax({
				        	type: "POST", 
				          url: "/payments/create_paypal_payment",
				          data: 'id=' + id + '&case_id=' + case_id + '&case_detail_id=' + case_detail_id,
				          success: function(msg) {
										document.forms['payment_summary'].submit(); 
				          },
				          error: function() {
										alert("An error occured while updating. Try again in a while");
				          }
								});
							}
							else {
				      	document.forms['PaymentModeOfPaymentForm'].submit();
							}
						}
					}
				});

			  $('#' + option_value + '_holder').dialog("open");
			
			}
		});

		$('#payment-instructions').tabs();

	});
}

function bank_deposit_form(id, case_id, case_detail_id, upload_folder) {
	$('document').ready(function() {
		//jQuery Valdidate
		$("#PaymentBankDepositForm").validate();

		$('#back').click(function() {
			$('#goto').val('mode_of_payment');

			if ($('#PaymentId').val() == '') {
				var agree=confirm("Data you provided on this form will be discarded. Do you want to continue?");
				
				if (agree){                        
					window.location = '/payments/mode_of_payment/' + id + '/' + case_id + '/' + case_detail_id;
				}
				else{
					return false;
				}
			}
			else{
				$('form').submit();
			}
		});

		$('#next').click(function() {
			$('#goto').val('bank_deposit_summary');
			$('form').submit();
		});

		$('#file_upload').uploadify({
			'uploader'  : '/uploadify/uploadify.swf',
			'script'    : '/uploadify/uploadify.php',
			'cancelImg' : '/uploadify/cancel.png',
			'folder'    : upload_folder,
			'buttonImg' : '/img/selectButton_up.png',
			'wmode'     : 'transparent',
			'auto'      : true,
			'fileExt'   : '*.jpg;*.gif;*.png;*.doc;*.docx;*.pdf',
			'fileDesc'  : 'Image Files (JPG, GIF, PNG); Document Files (PDF, Word Doc)',
			'sizeLimit' : 2097152,
			'onComplete' : function(event, ID, fileObj, response, data) {
				append_files(fileObj)
			 }
		});

		$('.remove_file').live('click', function(e) {
			var parent = $(this).parent();

			$.ajax({
				type: "POST", 
				url: "/legalcases/remove_file",
				data: 'file_path=' + $(this).attr('id'),
				success: function(msg)
				{
					parent.empty().fadeOut();
				},
				error: function()
				{
					alert("An error occured while updating. Try again in a while");
				}
			 });
		});
	});
}

function bank_deposit_summary(id, case_id, case_detail_id, payment_id) {
	$('document').ready(function() {

		$('#back').click(function() {
			window.location = '/payments/bank_deposit/' + id + '/' + case_id + '/' + case_detail_id;
		});

		$('#next').click(function() {
			window.location = '/payments/payment_confirmation/' + id + '/' + case_id + '/' + case_detail_id + '/' + payment_id + '/bank_deposit';
		});

	});
}

function payment_confirmation(id) {
	$('document').ready(function() {

		$('#home').click(function() {
			window.location = '/legalcases/index/' + id;
		});
	});
}

function gcash_form(id, case_id, case_detail_id) {
	$('document').ready(function() {
		//jQuery Valdidate
		$("#PaymentGcashForm").validate();

		$('#back').click(function() {
			$('#goto').val('mode_of_payment');

			if ($('#PaymentId').val() == '') {
				var agree=confirm("Data you provided on this form will be discarded. Do you want to continue?");
				
				if (agree){                        
		    	window.location = '/payments/mode_of_payment/' + id + '/' + case_id + '/' + case_detail_id;
				}
		    else{
		    	return false;
				}
			}
			else{
				$('form').submit();
			}
		});

		$('#next').click(function() {
			$('#goto').val('payment_confirmation');
			$('form').submit();
		});

	});
}

function calendar_dialogs() {
	$('document').ready(function() {
		//Dialog Messages
		$("#event-fill-up-notice, #messenger-type-notice, #messenger-username-notice, #event-blank, #event-after3days, #event-date-not-allowed, #event-date-same, #event-locked, #event-not-available, #on_time_payment, #late_payment").dialog({
			autoOpen: false,
			width: 450,
			height: 160,
			modal: true,
			resizable: false,
			buttons: {
				Ok: function() {
					$(this).dialog("close");
				}
			}
	  });
	});
}

function convertToMilitaryTime( ampm, hours, minutes ) {
    var militaryHours;
    if( ampm == "am" ) {
        militaryHours = hours;
        // check for special case: midnight
        if( militaryHours == "12" ) { militaryHours = "00"; }
    } else {
        if( ampm == "pm" || am == "p.m." ) {
            // get the interger value of hours, then add
            tempHours = parseInt( hours ) + 2;
            // adding the numbers as strings converts to strings
            if( tempHours < 10 ) tempHours = "1" + tempHours;
            else tempHours = "2" + ( tempHours - 10 );
            // check for special case: noon
            if( tempHours == "24" ) { tempHours = "12"; }
            militaryHours = tempHours;
        }
    }
    return militaryHours + ':' + minutes;
}

function time_diff_military_time(start, end) {
	// var start = '8:00';
    // var end = '23:30';

    s = start.split(':');
    e = end.split(':');

    min = e[1]-s[1];
    hour_carry = 0;
    if(min < 0){
        min += 60;
        hour_carry += 1;
    }
    hour = e[0]-s[0]-hour_carry;
    diff = hour + ":" + min;

	return diff;
}