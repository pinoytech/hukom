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
  '/img/paynowButton_up.png',
  '/img/paynowButton_down.png',
  '/img/viewButton_up.png',
  '/img/viewButton_down.png',
  '/img/addchildButton_up.png',
  '/img/addchildButton_down.png',
  '/img/Continuebutton_down.png',
  '/img/Continuebutton_up.png',
  '/img/ReschedButton_down.png',
  '/img/ReschedButton_up.png',
  '/img/addNewFactsButton_up.png',
  '/img/addNewFactsButton_down.png',
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
		$("#reject-alert").dialog({
			autoOpen: false,
			width: 300,
			height: 200,
			modal: true,
			resizable: false,
      buttons: {
				Ok: function() {
        	$(this).dialog('close');
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
				$("#end-user-form").dialog({
					autoOpen: false,
					width: 800,
					height: 600,
			    modal: true,
					resizable: false,
			    buttons: {
						'I agree': function() {
			      	$('#agree-checker').val(1);
							document.forms['UserRegisterForm'].submit();
						},
						"I reject": function() {
							$('#agree-checker').val(''); 
							$("#reject-alert").dialog("open");
					  }
					}
				}); 

				if($('#agree-checker').val() != '') {
					form.submit();
				}
				else {
					$("#end-user-form").dialog("open");
				}
			}
			
		});
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
		
		$('.add-child-button').mouseover(function() {
		  $(this).attr('src', '/img/addchildButton_down.png');
		}).mouseout(function(){
		  $(this).attr('src', '/img/addchildButton_up.png');
		});
		
	});
}

function legalcases_index() {
	$(document).ready(function() {
		$('.avail-button > img').mouseover(function() {
		  $(this).attr('src', '/img/availButton_down.png');
		}).mouseout(function(){
		  $(this).attr('src', '/img/availButton_up.png');
		});

		$('.prev-button').mouseover(function() {
		  $(this).attr('src', '/img/previousButton_down.png');
		}).mouseout(function(){
		  $(this).attr('src', '/img/previousButton_up.png');
		});

		$('.next-button').mouseover(function() {
		  $(this).attr('src', '/img/nextButton_down.png');
		}).mouseout(function(){
		  $(this).attr('src', '/img/nextButton_up.png');
		});
		
		$('.pay-now-button').mouseover(function() {
		  $(this).attr('src', '/img/paynowButton_down.png');
		}).mouseout(function(){
		  $(this).attr('src', '/img/paynowButton_up.png');
		});
		
		$('.view-button').mouseover(function() {
		  $(this).attr('src', '/img/viewButton_down.png');
		}).mouseout(function(){
		  $(this).attr('src', '/img/viewButton_up.png');
		});
		
		$('.continue-button').mouseover(function() {
		  $(this).attr('src', '/img/Continuebutton_down.png');
		}).mouseout(function(){
		  $(this).attr('src', '/img/Continuebutton_up.png');
		});
				
	});
}

function online_legal_consultation_form() {
	$(document).ready(function() {
		$("#LegalcaseOnlineLegalConsultationForm").validate({
			rules: {
				"data[Legalcase][legal_service]" : {
					required: true
				}
			}
		});	
	
		var legal_service_tabs = $('#legal-service-descriptions');
		
		legal_service_tabs.tabs();
				
		$('.legal_service_type').click(function() {
				
				switch($(this).val())
				{
				case 'Per Query':
				  legal_service_tabs.tabs({ selected: 0 });
				  break;
				case 'Video Conference':
				  legal_service_tabs.tabs({ selected: 1 });
				  break;
				case 'Office Conference':
				  legal_service_tabs.tabs({ selected: 2 });
				  break;				
				case 'Monthly Retainer':
				  legal_service_tabs.tabs({ selected: 3 });
				  break;				
				case 'Case/Project Retainer':
				  legal_service_tabs.tabs({ selected: 4 });
				  break;				
				default:
				  legal_service_tabs.tabs({ selected: 0 });
				}
		});
		
	});
}

function redirect_form(action, id, case_id, case_detail_id) {
  window.location = '/users/' + action + '/' + id + '/' + case_id + '/' + case_detail_id;
}

function legal_problem_form(action, id, case_id, case_detail_id, legal_problem) {
	$(document).ready(function() {
		//Assign radio value
		jQuery('.legal_problem_radio').filter('[value="' + legal_problem + '"]').attr('checked', true);
		
		if (legal_problem) {
			if (legal_problem == 'Others' || legal_problem == 'Single Proprietorship' || legal_problem == 'Corporation Partnership' || legal_problem == 'Unregistered Business, Joint Venture, Consortium etc') {
				$('#my_business_is').show();
			}
			else if (legal_problem != 'Personal' && legal_problem != 'Family' && legal_problem != 'Property' && legal_problem != 'Contractual' && legal_problem != 'Work' && legal_problem != 'Legal Documents' && legal_problem != 'Special Projects/Contracts') {
				$('#anything_under').show();
				$('#anything_under').children('input').attr('disabled', false);
				$('#anything_under').children('input').val(legal_problem);
				jQuery('.legal_problem_radio').filter('[value="Anything under the sun"]').attr('checked', true);
			}
		}

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

function scope_of_monthly_legal_service_form(action, id, case_id) {
	$(document).ready(function() {
		$("#LegalcaseScopeOfMonthlyLegalServiceForm").validate({
			rules: {
				"data[Legalcase][monthly_scope][]" : {
					required: true
				}
			},
			submitHandler: function(form) {
				form.submit();
			}
		});	
		
		//Submit button logic
		$('#back').click(function() {
			window.location = '/users/' + action + '/' + id + '/' + case_id;
		});
		
	});
}

function summary_of_facts_form(id, case_id, case_detail_id, upload_folder) {
	$('document').ready(function() {

    $('.remove-button').mouseover(function() {
  	  $(this).attr('src', '/img/removeButton_down.png');
  	}).mouseout(function(){
  	  $(this).attr('src', '/img/removeButton_up.png');
  	});

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
    
    uploadify_init(upload_folder);
		
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

//Initialize Uploadify
function uploadify_init(upload_folder) {
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
}

function append_files(fileObj) {
	name = fileObj.name;
	$('#file-list').append('<li class="actions"><a href="'+fileObj.filePath+'" target="_blank">'+name+'</a> <a class="remove_file" id="'+fileObj.filePath+'" ><img src="/img/removeButton_up.png" class="remove-button" border="0" align="absbottom"></a></li>');
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

function summary_of_information_form(id, case_id, case_detail_id, event_id) {
	$('document').ready(function() {
		//jQuery Valdidate
		$("#LegalcaseSummaryOfFactsForm").validate();

		$('#back').click(function() {
			window.location = '/legalcases/objectives_questions/' + id + '/' + case_id + '/' + case_detail_id;
		});

		$('#next').click(function() {
			window.location = '/legalcases/online_legal_consultation_agreement/' + id + '/' + case_id + '/' + case_detail_id;
		});

		
	  $('#back-to-case-index').click(function() {
			window.location = '/legalcases/index/' + id;
		});
		
		//New Facts - Per Query
		$('#new-facts').click(function() {
		  //Third paramater is Legalservice.id (after case_id)
      // window.location = '/legalcases/summary_of_facts/' + id + '/' + case_id + '/1/new_facts';
      window.location = '/legalcases/legal_problem/' + id + '/' + case_id;
		});
		
		//New Facts for Video and Office
		$('#new-video-conference').click(function() {
			window.location = '/legalcases/letter_of_intent/' + id + '/' + case_id + '/video/new_facts';
		});
		
		$('#new-office-conference').click(function() {
			window.location = '/legalcases/letter_of_intent/' + id + '/' + case_id + '/office/new_facts';
		});
		
		//Reschedule Conference Form Controller
		$('.request_reschdule_conference').click(function() {
			window.location = '/legalcases/request_reschedule_conference/' + id + '/' + case_id + '/' + case_detail_id + '/' + $(this).attr('id');
		});
		
		$('.reschedule-button').mouseover(function() {
		  $(this).attr('src', '/img/ReschedButton_down.png');
		}).mouseout(function(){
		  $(this).attr('src', '/img/ReschedButton_up.png');
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
				  	'Proceed Payment': function() {
							// Save Paypal details to Payment
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
						},
						'Pay Later': function() {
							window.location = '/dashboard/';
						},
					}
				});

			  $('#' + option_value + '_holder').dialog("open");
			
			}
		});

		// $('#payment-instructions').tabs();
		
		//Change tabs on select of radio button
		var payment_instructions_tabs = $('#payment-instructions');
		payment_instructions_tabs.tabs();
				
		$('.option_radio').click(function() {
				switch($(this).val())
				{
				case 'bank_deposit':
				  payment_instructions_tabs.tabs({ selected: 0 });
				  break;
				case 'paypal':
				  payment_instructions_tabs.tabs({ selected: 1 });
				  break;
				case 'gcash':
				  payment_instructions_tabs.tabs({ selected: 2 });
				  break;				
				case 'smartmoney':
				  payment_instructions_tabs.tabs({ selected: 3 });
				  break;				
			  case 'check_cash':
				  payment_instructions_tabs.tabs({ selected: 4 });
				  break;
				default:
				  payment_instructions_tabs.tabs({ selected: 0 });
				}
		});
		
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

    uploadify_init(upload_folder);

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
			window.location = '/payments/bank_deposit/' + id + '/' + case_id + '/' + case_detail_id + '/' + payment_id;
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

function check_cash_form(id, case_id, case_detail_id) {
	$('document').ready(function() {
		//jQuery Valdidate
		$("#PaymentCheckCashForm").validate();

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

function corporate_partnership_info(id, case_id, upload_folder) {
	$('document').ready(function() {
		//jQuery Valdidate
		$("#UserCorporatePartnershipInfoForm").validate({
			rules: {
				"data[CorporatePartnershipInfo][type]" : { //Radio Button Validation
					required: true
				},
				"data[CorporatePartnershipInfo][attach_fill_out]" : { //Radio Button Validation
					required: true
				}
			},	    
			submitHandler: function(form) {
				
				if ($('.stockholder_type:checked').val() == 'Publicly Listed') {
					stock_list_total_rows = $('#stock-list > tbody').size() - 1;
					if (stock_list_total_rows > 10) {
						alert('Top 10 Majority Stockholders only submit');
						return false;
					}
				}
								
				// $('form').submit();				
				form.submit();
			}
		});

		//Submit button logic
		$('#back').click(function() {
			$('#goto').val('corporate_partnership_representative_info');

			if ($('#CorporatePartnershipInfoId').val() == '') {
				
				var agree=confirm("Data you provided on this form will be discarded. Do you want to continue?");
     		if (agree){                        
         	window.location = '/users/corporate_partnership_representative_info/' + id + '/' + case_id;
        }
        else{
        	return false;
        }
			}
			else{
				$('form').submit();
			}
		});

		//Submit button logic
		$('#back').click(function() {
			$('#goto').val('corporate_partnership_representative_info');
			$('form').submit();
		});

		$('#next').click(function() {
			$('#goto').val('legal_problem');
			$('form').submit();
		});

		$('#save').click(function() {
			$('#goto').val('legalcases');
			$('form').submit();
		});

		//Attach Fill Out Form
		if ($('.attach_fill_out:checked').val() == 'attach') {
			$('#attach-form').show();
		}

		if ($('.attach_fill_out:checked').val() == 'fill out') {
			$('#fill-out-form').show();
		}
		
		//Disable fill-out-form fields to avoid validation when attach-form is selected
		var fill_out_form  = $('#fill-out-form');
		var fill_out_radio = $('#fill-out-radio');
		var initial        = fill_out_radio.is(":checked");
		fill_out_form_inputs = fill_out_form.find("input, textarea").attr("disabled", !initial);
	    // fill_out_radio.click(function() {
	        // fill_out_form_inputs.attr("disabled", !this.checked);
	    // });

		function remove_row(element) {
			var parentrow = element;
			parentrow.remove();
		}

		$('.attach_fill_out').change(function() {
	    if ($(this).val() == 'attach') {
				$('#attach-form').show();
	      $('#fill-out-form').hide();

	      //remove board w/ no data
        $('#board-list tbody tr.row td div input.required').each(function(index) {
        	if ($(this).val() == '') {
          	remove_row($(this).parents('tbody'));
					}
				});

				$('#stock-list tbody tr.row td div input.required').each(function(index) {
        	if ($(this).val() == '') {
          	remove_row($(this).parents('tbody'));
					}
				});

        $('#fill-out-form').find("input, textarea").attr("disabled", true);
        $('#file-upload-validate').attr("disabled", false);
	    }

	    if ($(this).val() == 'fill out') {
        // alert(fill_out_form_inputs);
        $('#fill-out-form').show();
        $('#attach-form').hide();
        fields_arranger();
				add_board();
        add_stock();
        $('#fill-out-form').find("input, textarea").attr("disabled", false);
        $('#file-upload-validate').attr("disabled", true);
	    }
	    
	    // If Stock Corporation or Non Stock Corporation - disable Managing Partners field
  		if ($('.type:checked').val() == 'Stock Corporation' || $('.type:checked').val() == 'Non-Stock') {
        // console.log(1);
  			$('#CorporatePartnershipInfoManagingPartners').attr("disabled", true);
  		}
  		else {
        // console.log(2);
  		  $('#CorporatePartnershipInfoManagingPartners').attr("disabled", false);
  		}
  		
  		$('.type').change(function() {
  		  if ($(this).val() == 'Stock Corporation' || $(this).val() == 'Non-Stock') {
    			$('#CorporatePartnershipInfoManagingPartners').attr("disabled", true);
    			$('#CorporatePartnershipInfoManagingPartners').val('');
    		}
    		else {
    		  $('#CorporatePartnershipInfoManagingPartners').attr("disabled", false);
    		}
  		});
  		
	  });

    // Uploadify
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
       append_files(fileObj);
       $('#file-upload-validate').val(1);
      }
    });
		
		//Remove Files
		$('.remove_file').live('click', function(e) {
			var parent = $(this).parent();

			$.ajax({
				type: "POST", 
				url: "/legalcases/remove_file",
				data: 'file_path=' + $(this).attr('id'),
				success: function(msg) {
					parent.remove().fadeOut();
				},
				error: function() {
					alert("An error occured while updating. Try again in a while");
				}
			});

			// toggle_file_upload_validate();
			total_files = $('#file-list > li').size() - 1;
	 		
			if (total_files < 1) {
	 			$('#file-upload-validate').val('');
	 		}
		});

	  function add_board() {
	  	//Count no. of rows
			total_rows = $('#board-list > tbody').size() - 1;
			// alert(total_rows);

			//Modify HTML
			component_render = $('#clone-board').html();
			component_render = component_render.replace(/xxx/g, total_rows + 100);
			component_render = component_render.replace(/Xxx/g, total_rows + 100);

			$('#board-list').append(component_render);
	  }

	  //Add board row to list
		$('#add-board').live('click', function(e) {
	   	add_board();
		});		

		//Remove board from list
		$('.board-remove').live('click', function(e) {
			var agree=confirm("Do you want to remove this item?");
	    if (agree){                        
	      remove_row($(this).parents('tbody'));
	    }
	    else{
	    	return false;
	    }
		});

		function add_stock() {
			//Count no. of rows
			total_rows = $('#stock-list > tbody').size();
      // console.log(total_rows);
			//Check stockholder_type
      if ($('.stockholder_type:checked').val() == 'Publicly Listed') {
      	if (total_rows > 10) {
        	alert('Top 10 Majority Stockholders only');
          return false;
				}
    	}

    	if ($('.stockholder_type:checked').val() == 'Not Publicly Listed') {
				if (total_rows > 30) {
        	alert('Limited to 20-30 Stockholders only');
          return false;
				}
    	}

			//Modify HTML
			component_render = $('#clone-stock').html();
			component_render = component_render.replace(/xxx/g, total_rows + 100);
			component_render = component_render.replace(/Xxx/g, total_rows + 100);

			$('#stock-list').append(component_render);
		}

		//Add Stock row to list
		$('#add-stock').live('click', function(e) {
			//if not selected any radio buttons
			if (!$('.stockholder_type').is(":checked")) {
		  	alert('Please select Stockholders Type');
		    return false;
			}
			
			add_stock();
		});

		//Remove Stock from list
		$('.stock-remove').live('click', function(e) {
			var agree=confirm("Do you want to remove this item really?");
			if (agree){                        
	    	remove_row($(this).parents('tbody'));
			}
	    else{
	    	return false;
			}
		});

	});	
}

function confirm_request_reschedule_conference(){ 
  
}


function request_reschedule_conference(id, case_id, case_detail_id, total_time) {  
	$(document).ready(function() {
	  
	  $("#reschedule_warning").dialog({
  		autoOpen: false,
  		width: 450,
  		height: 250,
  		modal: true,
  		resizable: false,
  		buttons: {
  		  Continue: function() {
  			  document.forms['LegalcaseRequestRescheduleConferenceForm'].submit();
  			},
  			Cancel: function() {
  				$(this).dialog("close");
  			},
  		}
    });		

		//jQuery Valdidate
		$("#LegalcaseRequestRescheduleConferenceForm").validate({
	    submitHandler: function(form) {
	      
        time_diffrence = (time_diff_military_time(convert_to_military_time($("#LegalcaseStart").val()), convert_to_military_time($("#LegalcaseEnd").val())));
    	  time_diffrence_split = time_diffrence.split(':');

    	  if (time_diffrence_split[0] != total_time) {
          alert("You're allowed to select " + total_time + " hour(s) only.");
    	  }
    	  else
    	  {
    	     $("#reschedule_warning").dialog("open");
    	  }
		  			  
        // form.submit();
		  }
		});
		
	});	
}

function convert_to_military_time(time) {
  switch(time) {
  	case '08:00 am':
  	  value = '8:00'
  	  break;
    case '09:00 am':
  	  value = '9:00'
  	  break;
    case '10:00 am':
  	  value = '10:00'
  	  break;	  
    case '11:00 am':
  	  value = '11:00'
  	  break;
    case '12:00 pm':
  	  value = '12:00'
  	  break;
    case '01:00 pm':
  	  value = '13:00'
  	  break;
    case '02:00 pm':
  	  value = '14:00'
  	  break;
    case '03:00 pm':
  	  value = '15:00'
  	  break;
    case '04:00 pm':
  	  value = '16:00'
  	  break;
    case '05:00 pm':
  	  value = '17:00'
  	  break;
    case '06:00 pm':
  	  value = '18:00'
  	  break;
    case '07:00 pm':
  	  value = '19:00'
  	  break;
    case '08:00 pm':
  	  value = '20:00'
  	  break;
    case '09:00 pm':
  	  value = '21:00'
  	  break;
    case '10:00 pm':
  	  value = '22:00'
  	  break;
    case '11:00 pm':
  	  value = '23:00'
  	  break;
	}
	
	return value;
}

function calendar_dialogs() {
	$('document').ready(function() {
		//Dialog Messages
		$("#event-fill-up-notice, #messenger-type-notice, #messenger-username-notice, #event-blank, #event-after3days, #event-date-not-allowed, #event-date-same, #event-locked, #event-not-available, #on_time_payment, #late_payment, #available, #not_available, #already_selected_schedule, #reschedule_successful, #event_no_hours_not_equal").dialog({
			autoOpen: false,
			width: 450,
			height: 200,
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