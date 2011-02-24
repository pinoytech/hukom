jQuery('document').ready(function() {
  /*
  //Validate birth date select list
  jQuery('.birth_date').change(function() {
  	jQuery('.birth_date').each(function(index) {
  		if (jQuery(this).val() != '') {
  			jQuery('#birth_date_check').val('1');	
  		}
  		else {
  			jQuery('#birth_date_check').val('');	
  		}
  	});
  });
  */
  
  /*
  //Validate marriage date select list
  jQuery('.marriage_date').change(function() {
   jQuery('.marriage_date').each(function(index) {
     if (jQuery(this).val() != '') {
       jQuery('#marriage_date_check').val('1');  
     }
     else {
       jQuery('#marriage_date_check').val(''); 
     }
   });
  });
  */

  //Append Asterisks on required fields
  jQuery('div.required').each(function(index) {
  	jQuery(this).children('label').prepend('<span>*</span>');
  });

  //Modify Field lenght
  // One field
  jQuery('.full-field').each(function(index) {
  	var parent_div_width = jQuery(this).width();
  	var label_width =  jQuery(this).children('div').children('label').width();
  	var input_width = (parent_div_width - label_width) - 30;
  	jQuery(this).children('div').children('input').css({'width' : input_width});
  });

  // Two fields
  jQuery('.two-field').each(function(index) {
  	var parent_div_width = jQuery(this).width();
  	var label = jQuery(this).children('div').children('label');

  	//Get Total width
  	label_width = 0;
  	label.each(function(index) {
  		label_width = jQuery(this).width() + label_width;
  		// console.log(label_width);
  	});

  	var input_width = ((parent_div_width - label_width) / 2) - 26;
  	jQuery(this).children('div').children('input').css({'width' : input_width});
  });

  // Three fields
  jQuery('.three-field').each(function(index) {
  	var parent_div_width = jQuery(this).width();
  	var label = jQuery(this).children('div').children('label');

  	//Get Total width
  	label_width = 0;
  	label.each(function(index) {
  		label_width = jQuery(this).width() + label_width;
  	});

  	var input_width = ((parent_div_width - label_width) / 3) - 24;
  	jQuery(this).children('div').children('input').css({'width' : input_width});
  });
  
  
  $( ".birth_date" ).datepicker({
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
    yearRange: '1900:2011',
  });
  
});

jQuery.extend(jQuery.validator.messages, {
    required: "This field is required",
    remote: "Please fix this field",
    email: "Please enter a valid email address",
    url: "Please enter a valid URL",
    date: "Please enter a valid date",
    dateISO: "Please enter a valid date (ISO)",
    number: "Please enter a valid number",
    digits: "Please enter only digits",
    creditcard: "Please enter a valid credit card number",
    equalTo: "Please enter the same value again",
    accept: "Please enter a value with a valid extension",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters"),
    minlength: jQuery.validator.format("Please enter at least {0} characters"),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}"),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}"),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}")
});
