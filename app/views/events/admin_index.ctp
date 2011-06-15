<?php echo $this->element('admin_navigation'); ?>

<div class="dashboard index">
	<h2><?php __('Calendar');?></h2>
	
	<div id="calendar"></div>
	
	<div><a id="all_schedule" class="display_options selected">All Schedule</a></div>
	<div><a id="pending_payment" class="display_options">Pending Payment (Payment status is Pending)</a></div>
	<div><a id="no_payment_status" class="display_options">No Payment Status (Filled-up legal forms but didn't fill-up payment form) </a></div>
	<div><a id="not_active" class="display_options">Not Active (Selected a schedule but didn't fill-up legal forms)</a></div>
	
</div>

<div id="event-data-add" title="Schedule Conference" class="hidden">
    <?php
    echo $form->create('Event', array('target'=> '_parent'));
    // echo $form->input('title' , array('label' => 'ID', 'type'=>'text', 'value' => $id.'-'.$case_id, 'readonly' => true));
    echo $form->input('date', array('type'=>'text', 'readonly' => true));
	echo $form->input('type', array('options' => array('personal' => 'Personal', 'work' => 'Work', 'holiday' => 'Holiday', 'video' => 'Video Conference', 'office' => 'Office Conference')));
	echo $form->input('fullday', array('type' => 'checkbox', 'value' => '1', 'label' => 'Full Day Event'));
    echo $form->input('start', array('options' => $custom->calendar_time_select()));
    echo $form->input('end', array('options' => $custom->calendar_time_select()));
    echo $form->input('allday', array('type'=>'hidden', 'value' => 0));
    echo $form->input('user_id', array('type'=>'hidden', 'value' => $id));
    echo $form->input('case_id', array('type'=>'hidden', 'value' => $case_id));
    echo $form->input('calendar_id', array('type'=>'hidden', 'value' => $this->Session->read('Event.calendar_id')));
    ?>
</div>

<div id="event-fill-up-notice" style="display:none;" title="E-Lawyers Online Conference Calendar">
    Please select schedule from the calendar to proceed.
</div>

<div id="messenger-type-notice" style="display:none;" title="E-Lawyers Online Conference Calendar">
    Please select messenger type if Skype or Yahoo Messenger.
</div>

<div id="messenger-username-notice" style="display:none;" title="E-Lawyers Online Conference Calendar">
    Please input messenger user name or id.
</div>


<div id="event-blank" title="Schedule Conference" class="hidden">
    Please complete the conference start time and end time to proceed.
</div>

<div id="event-not-available" title="Schedule Conference" class="hidden">
    The schedule you have selected is not available. Please select another date or time to proceed.
</div>

<div id="event-date-not-allowed" title="Schedule Conference" class="hidden">
    The schedule you have selected is not allowed. Please select another date or time to proceed.
</div>

<div id="event-date-same" title="Schedule Conference" class="hidden">
    The time you have selected is invalid. The start time of your conference should NOT be greater than the end time. 
</div>

<div id="event-locked" title="Schedule Conference" class="hidden">
    You already booked a schedule.
</div>

<div id="event-after3days" title="Schedule Conference" class="hidden">
    You have selected a date within the 3-day case review period. Please select a new schedule 3 days after the original date selected.
</div>

<div id="on_time_payment" title="Schedule Conference" class="hidden">
    On-time payment confirmation has been sent.
</div>

<div id="late_payment" title="Schedule Conference" class="hidden">
    Late payment confirmation has been sent.
</div>

<div id="available" title="Schedule Conference" class="hidden">
    Schedule Reset email has been sent
</div>

<div id="not_available" title="Schedule Conference" class="hidden">
    Not Available Schedule Reset email has been sent
</div>


<?php $html->scriptBlock("calendar_dialogs();", array('inline'=>false));?>


<?php //$this->Html->scriptStart(array('inline' => false));?>
<script type="text/javascript">
$(document).ready(function() {
	load_full_calendar('/events/feed/');
	// load_full_calendar('/events/feed');

	function load_full_calendar(feed_url) {	
		//Full Calendar
		var calendar = $('#calendar').fullCalendar({
	        // events: "/events/feed",
	        events: feed_url,
			eventRender: function(event, element) {
		        element.qtip({
		            content: 'Event ID: ' + event.id + '<br />' + event.title + ' <br /> <a href="/admin/legalcasedetails/view/' + event.case_detail_id + '">View Details</a> <br /> <a id="' + event.id +'" class="on_time">On Time</a> <br /> <a id="' + event.id +'" class="late_payment">Late Payment</a> <br /> <a id="' + event.id +'" class="available">Available</a> <br /> <a id="' + event.id +'" class="not_available">Not Available </a> <br /> <a id="' + event.id +'" class="delete">Delete</a>',
					position: 'topRight',
					hide: {
						fixed: true // Make it fixed so it can be hovered over
					},
		        });
		    },
	        header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},     
	        buttonText: {
	            prev: '&lt;',
	            next: '&gt;'
	        },
			editable: false,
			allDaySlot: false,
			selectable: true,
			selectHelper: true,
			slotMinutes: 60,
			minTime: '08:00am',
			maxTime: '11:00pm',
	        dayClick: function(date, allDay, jsEvent, view) {
	            // $("#eventdata").show();
	            // $("#eventdata").load("<?php echo Dispatcher::baseUrl();?>/events/add/"+allDay+"/"+$.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm"));
	            // console.log('<?php echo date("d/m/y"); ?>');

	                            verify_event_url = "/events/verify_event/"+'false'+"/"+$.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm");
	                            add_event_url    = "/events/add_event/"+'false'+"/"+$.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm");

	                            $("#event-data-add").dialog({
	                        		autoOpen: false,
	                        		width: 400,
	                        		height: 530,
	                                modal: true,
	                        		resizable: false,
	                                buttons: {
	                                    Ok: function(data) {
	                                        // $('#EventAddForm').submit();

	                                        var input_data = [];
										
	                                        if ($('#EventStart').val() == '' || $('#EventEnd').val() == '') {
	                                            $("#event-blank").dialog("open");
	                                            return false;
	                                        }

	                                        if ($('#EventStart').val() == $('#EventEnd').val()) {
	                                            $("#event-date-same").dialog("open");
	                                            return false;
	                                        }
										
											//exploaded time - convert time for validation on the backend
											EventStart            = $('#EventStart').val().split(' ');
											EventStart_time       = EventStart[0].split(':');
											EventStart_meridian   = EventStart[1];
											EventStart_military   = convertToMilitaryTime(EventStart_meridian, EventStart_time[0], EventStart_time[1]);
											EventStart_full_value = $('#EventDate').val() + ' ' + EventStart_military + ':00';
	                                        input_data.push('EventStart=' + EventStart_full_value);

											EventEnd            = $('#EventEnd').val().split(' ');
											EventEnd_time       = EventEnd[0].split(':');
											EventEnd_meridian   = EventEnd[1];
											EventEnd_military   = convertToMilitaryTime(EventEnd_meridian, EventEnd_time[0], EventEnd_time[1]);
											EventEnd_full_value = $('#EventDate').val() + ' ' + EventEnd_military + ':00';
	                                        input_data.push('EventEnd=' + EventEnd_full_value);
                                        
											//Validate selected start time and end time
											event_hours = time_diff_military_time(EventStart_military, EventEnd_military).split(':');
										
											if (event_hours[0] <= 0) {
												$("#event-date-same").dialog("open");
												return false;
											}
										
	                                        input_data.push('EventTitle=' + $('#EventType option:selected').val());
	                                        input_data.push('EventAllday=' + $('#EventAllday').val());

	                                        input_data.push('EventUserId=' + $('#EventUserId').val());
	                                        input_data.push('EventCaseId=' + $('#EventCaseId').val());
	                                        input_data.push('EventCalendarId=' + $('#EventCalendarId').val());
	                                        input_data.push('EventConference=' + $('#EventType option:selected').val());
										
											switch ($('#EventType option:selected').val()){
												case 'personal':
												  color = 'orange'
												  break;
												case 'work':
												  color = 'green'
												  break;
												case 'holiday':
												  color = 'violet'
												  break;
												case 'video':
													color = 'red';
													break;
												case 'office':
													color = 'blue';
													break;
											}

	                                        input_data.push('EventColor=' + color);

											//assign original values 
											EventStart_value = $('#EventStart').val();
											EventEnd_value   = $('#EventEnd').val();
										
											event_input_data = input_data.join('&');

	                                        jQuery.ajax({
	                                            type: "POST",
	                                            url: verify_event_url,
	                                            data: event_input_data,
	                                            success: function(msg)
	                                            {
	                                                if (msg == 'not available') {
	                                                    $("#event-not-available").dialog("open");
	                                                    return false;
	                                                }
													else{
														//Insert Event to calendar
														jQuery.ajax({
				                                            type: "POST",
				                                            url: add_event_url,
				                                            data: event_input_data,
				                                            success: function(msg) {
				                                                calendar.fullCalendar('refetchEvents');
				                                            },
				                                            error: function() {
				                                                alert("An error occured while updating. Try again in a while");
				                                            }
				                                        });
													}
	                                            },
	                                            error: function()
	                                            {
	                                                alert("An error occured while updating. Try again in a while");
	                                            }
	                                        });

	                                        $(this).dialog('destroy');
	                                        $('#EventStart').val('');
	                                        $('#EventEnd').val('');
	                                        $('#EventAllday').val(0);

	                        			} //end Ok: function(data) {
	                                }
	                        	});

	                            $("#event-data-add").dialog("open");

	                            if (!allDay) {
	                                // alert(1)
	                                $('#EventStart').val($.fullCalendar.formatDate(date, "hh:mm tt"));
	                                $('#EventAllday').val(0);
	                            }

	                            $('#EventDate').val($.fullCalendar.formatDate(date, "yyyy-MM-dd"));

	        },
	    });
   
		
	}	
	
	$('#EventType').change(function() {
		if ($('#EventType option:selected').val() == 'holiday') {
			$('#EventFullday').attr("checked", true);
			$("#EventStart").val("08:00 am");
			$("#EventEnd").val("11:00 pm");
		};
	});

	$('#EventFullday').change(function() {
		if ($(this).is(':checked')) {
			$("#EventStart").val("08:00 am");
			$("#EventEnd").val("11:00 pm");
		}
		else {
			$("#EventStart").val("08:00 am");
			$("#EventEnd").val("08:00 am");
		}
	});

	$('.on_time').live('click', function(e) {
		//send confirmation email
		//update payment status 
		//update event status?
	
		jQuery.ajax({
            type: "POST",
            url: '/admin/events/on_time_payment/',
            data: 'event_id=' + $(this).attr('id'),
            success: function(msg) {
                $("#on_time_payment").dialog("open");
            },
            error: function() {
                alert("An error occured while updating. Try again in a while");
            }
        });
	});

	$('.late_payment').live('click', function(e) {
		jQuery.ajax({
            type: "POST",
            url: '/admin/events/late_payment/',
            data: 'event_id=' + $(this).attr('id'),
            success: function(msg) {
                $("#late_payment").dialog("open");
            },
            error: function() {
                alert("An error occured while updating. Try again in a while");
            }
        });
	});
	
	$('.available').live('click', function(e) {
		jQuery.ajax({
            type: "POST",
            url: '/admin/events/available/',
            data: 'event_id=' + $(this).attr('id'),
            success: function(msg) {
                $("#available").dialog("open");
            },
            error: function() {
                alert("An error occured while updating. Try again in a while");
            }
        });
	});
	
	$('.not_available').live('click', function(e) {
		jQuery.ajax({
            type: "POST",
            url: '/admin/events/not_available/',
            data: 'event_id=' + $(this).attr('id'),
            success: function(msg) {
                $("#not_available").dialog("open");
            },
            error: function() {
                alert("An error occured while updating. Try again in a while");
            }
        });
	});
	
	$('.delete').live('click', function(e) {
		
		var agree=confirm("Do you want to delete this scheduled conference?");
		
		if (agree){                        
			$.ajax({
	           	type: "POST",
	            url: '/admin/events/delete/',
	            data: 'event_id=' + $(this).attr('id'),
	            success: function(msg) {
					$('#calendar').fullCalendar('destroy');
					load_full_calendar('/events/feed/');
	            },
	            error: function() {
	                alert("An error occured while updating. Try again in a while");
	            }
	        });
		}
		else{
			return false;
		}

	});
	
	$('#pending_payment').click(function() {
		$('#calendar').fullCalendar('destroy');
		load_full_calendar('/events/pending_payment_feed/');
	});
	
	$('#all_schedule').click(function() {
		$('#calendar').fullCalendar('destroy');
		load_full_calendar('/events/feed/');
	})
	
	$('#not_active').click(function() {
		$('#calendar').fullCalendar('destroy');
		load_full_calendar('/events/not_active_feed/');
	})
	
	$('#no_payment_status').click(function() {
		$('#calendar').fullCalendar('destroy');
		load_full_calendar('/events/no_payment_status_feed/');
	});
		
	// 
	// $('#all_office').click(function() {
	// 	$('#calendar').fullCalendar('destroy');
	// 	load_full_calendar('/events/office_feed/');
	// })
	
	$('.display_options').click(function() {
		$('.display_options').removeClass("selected");
    	$(this).addClass("selected");
	});
});



</script>
<?php //$this->Html->scriptEnd();?>