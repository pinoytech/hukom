<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<div class="form-title">Client's Letter of Intent</div>
		<div class="form-holder">
		
		    <?php echo $this->Form->create('User', array('onsubmit' => 'redirect(); return false;')); ?>
				<p>
					<?php echo date('F d, Y');?>
				</p>
				
				<p>
					I, <b><?php echo $user_full_name;?></b>, with registered e-mail address of <b><?php echo $email;?></b>, of legal age, hereby intends to obtain from E-Lawyers Online your service of online legal consultation via 
					<b><?php echo $legal_service; ?></b> 
					<?php
					if ($conference == 'video') {
					?>
					through <input type="radio" name="messenger_type" value="skype" /> <b>Skype</b> or <input type="radio" name="messenger_type" value="yahoo" /> <b>Yahoo Messenger</b> using <input type="text" name="messenger_username"> as my user name
					<?php
					}
					?>
					on <em>(check calendar for available schedule)</em> <input type="text" id="event_date" value="<?php echo $event_date;?>" size="15" readonly /><a id="open-calendar"><img src="/img/Calendar-32.png" width="16" style="vertical-align:text-top;"></a> from <input type="text" id="event_start" value="<?php echo $event_start;?>" size="10" readonly /> to <input type="text" id="event_end" value="<?php echo $event_end;?>" size="10" readonly /> for <input type="text" id="event_hours" value="<?php echo $event_hours;?>" size="2" readonly /> no. of hours.
				</p>
				
				<p>
				    I agree to pay the amount of <b>Php <input type="hidden" id="conference_fee_orig" value="<?php echo $conference_fee;?>" /> <input type="text" id="conference_fee" size="8" readonly /></b> as professional fee. I undertake to pay the same within 24 hours from submission of this letter of intent and I understand that my failure to pay within the said period shall entitle E-Lawyers Online to open the said schedule for other clients. I expressly acknowledge that the said fee is for the full payment for the duration of the number of hour/s of consultation requested and any unused time (video or office conference) shall be considered forfeited in favor of E-Lawyers Online. For this purpose, I am providing you my personal information, the summary of the facts of my legal problem including documents (if any), my objective, my questions and my acceptance of your Online Legal Consultation Agreement.  
				</p>
				
				<p>
					Respectfully submitted.
				</p>				
				<br />
			    <input type="submit" class="button-submit" value="" />			  
				
				<input type="hidden" id="event_input_data">
				
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>

<div id="event-calendar" class="hidden" title="E-Lawyers Online Conference Calendar">
	<div id="calendar"></div>
</div>

<div id="event-data-add" title="Schedule Conference" class="hidden">
    <?php
    echo $form->create('Event', array('target'=> '_parent'));
    echo $form->input('title' , array('label' => 'ID', 'type'=>'text', 'value' => $id.'-'.$case_id, 'readonly' => true));
    echo $form->input('date', array('type'=>'text', 'readonly' => true));
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

<script type="text/javascript">
function redirect(){
	
	$("#event-fill-up-notice, #messenger-type-notice, #messenger-username-notice").dialog({
		autoOpen: false,
		width: 350,
		height: 150,
        modal: true,
		resizable: false,
		buttons: {
			Ok: function() {
				$(this).dialog("close");
			}
		}
    });
    
	var messenger_values = '';

	<?php
	if ($conference == 'video') {
	?>
		if (!$('input[name="messenger_type"]').is(":checked")) {
	        $("#messenger-type-notice").dialog("open");
	        return false;
	    }

		if (!$('input[name="messenger_username"]').val()) {
	        $("#messenger-username-notice").dialog("open");
	        return false;
	    }

		var messenger_values = '&messenger_type=' + $('input[name="messenger_type"]:checked').val() + '&messenger_username=' + $('input[name="messenger_username"]').val();
	<?php
	}
	?>

    if (!$('#event_date').val()) {
        $("#event-fill-up-notice").dialog("open");
        return false;
    }
	
	//Save Event Data
	jQuery.ajax({
        type: "POST",
        url: '/events/add_event',
        data: $('#event_input_data').val() + messenger_values,
        success: function(msg) {   
			if (msg) {
				<?php
			    if ($auth_user_type == 'personal') {
			        $profile_action = 'personal_info';
			    }
			    elseif ($auth_user_type == 'corporation') {
			        $profile_action = 'corporate_partnership_representative_info';
			    }
			    ?>
			
				window.location = '/users/<?php echo $profile_action; ?>/<?php echo "$id/$case_id"?>';
			}
        },
        error: function() {
            alert("An error occured while updating. Try again in a while");
        }
    });
	
}

$(document).ready(function() {
	
	$("#open-calendar").click(function() {        
        // var url = '<?php echo Dispatcher::baseUrl();?>/events/calendar_dialog/<?php echo "$id/$case_id"?>';
        // $("#event-calendar").load(url).dialog({
	
        $("#event-calendar").dialog({
            autoOpen: false,
    		width: 850,
    		height: 750,
            modal: true,
    		resizable: false,
			buttons: {
				Ok: function() {
					$(this).dialog("close");
				}
			},
    		close: function() {
				
				$('#calendar').empty();
				
                /*
				jQuery.ajax({
                    type: "POST",
                    url: '/events/get_info',
                    success: function(msg)
                    {
                        $.each(msg, function(key, value) {
                            if (value.id) {                            
                                $('#event_date').val(value.date);
                                $('#event_start').val(value.start);
                                $('#event_end').val(value.end);
                                $('#event_hours').val(value.no_of_hours);
                                $('#conference_fee').val((value.no_of_hours * $('#conference_fee_orig').val()).toFixed(2));
                            }
                        });
                    }
                });
				*/
            },
			open: function() {
				//Full Calendar
				var calendar = $('#calendar').fullCalendar({
			        events: "/events/feed",
					eventRender: function(event, element) {
				        element.qtip({
				            content: 'ID: ' + event.title + '<br />' + 'Time: ' + $.fullCalendar.formatDate(event.start, "hh:mm") + ' - ' + $.fullCalendar.formatDate(event.end, "hh:mm")
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

			            jQuery.ajax({
			                type: "POST",
			                url: '/events/check_lock',
			                data: 'case_id=<?php echo $case_id;?>&date_clicked='+$.fullCalendar.formatDate(date, "yyyy-MM-dd"),
			                success: function(msg)
			                {      
			                    if (msg == 'locked') {
			                        $("#event-locked").dialog("open");
			                    }
			                    else if (msg == 'after3days') {
			                        $("#event-after3days").dialog("open");
			                    }
			                    else if (msg == 'ok') {

									// console.log((Date.parse($.fullCalendar.formatDate(date, "MMM d, yyyy"))));
									// console.log(Date.parse("May 27, 2011"));
									// console.log(Date.parse("<?php echo date('M j, Y');?>"));

			                        if ( Date.parse( $.fullCalendar.formatDate(date, "MMM d, yyyy")) < Date.parse("<?php echo date('M j, Y');?>")) {
			                            $("#event-after3days").dialog("open");
			                        }
			                        else {                    
			                            // allDay = false;    
			                            verify_event_url = "<?php echo Dispatcher::baseUrl();?>/events/verify_event/"+'false'+"/"+$.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm");

			                            $("#event-data-add").dialog({
			                        		autoOpen: false,
			                        		width: 250,
			                        		height: 230,
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
													
			                                        input_data.push('EventTitle=' + $('#EventTitle').val());
			                                        input_data.push('EventAllday=' + $('#EventAllday').val());

			                                        input_data.push('EventUserId=' + $('#EventUserId').val());
			                                        input_data.push('EventCaseId=' + $('#EventCaseId').val());
			                                        input_data.push('EventCalendarId=' + $('#EventCalendarId').val());
			                                        input_data.push('EventConference=' + '<?php echo $conference;?>');
													<?php
													//Assign Event Colors
													switch ($conference){
														case "video":
															$color = 'red';
															break;
														case "office":
															$color = 'blue';
															break;	
													}
													?>
			                                        input_data.push('EventColor=' + '<?php echo $color;?>');
			                                        input_data.push('EventStatus=' + 'not active');

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
															else {				
																
																//Test code. Hour must have leading zero to work on Firefox and Safari
																// $('#calendar').fullCalendar('renderEvent', {
																	// title : 'test',
																    // start : "2011-06-04 08:00:00",
																    // end   : "2011-06-04 09:00:00",											
																	// allDay : false,
																	// color : 'yellow',
																// }, true);
																
																//Assign data to intent form																
																$('#event_date').val($.fullCalendar.formatDate(date, "MMM d, yyyy"));
																$('#event_start').val(EventStart_value);
								                                $('#event_end').val(EventEnd_value);
								                                $('#event_hours').val(event_hours[0]);
								                                $('#conference_fee').val((event_hours[0] * $('#conference_fee_orig').val()).toFixed(2));
																$('#event_input_data').val(event_input_data);
																
																// console.log(EventStart_full_value);
																// console.log(EventEnd_full_value);
																																
																//Render events on calendar and make it stick
																calendar.fullCalendar('renderEvent', {
																	title : $('#EventTitle').val(),
																	start : EventStart_full_value,
																	end   : EventEnd_full_value,											
																	allDay : false,
																	color : '<?php echo $color;?>',
																}, true);																																
															}
															
			                                                // calendar.fullCalendar('refetchEvents');
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

			                        }
			                    } // end - if !msg
			                },
			                error: function()
			                {
			                    alert("An error occured while updating. Try again in a while");
			                }
			            });
			        },
			    });
			
			} //open: - end
        });
        
        $("#event-calendar").dialog("open");
    });
    
    //Dialog Messages
	$("#event-blank, #event-after3days, #event-date-not-allowed, #event-date-same, #event-locked, #event-not-available").dialog({
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
</script>