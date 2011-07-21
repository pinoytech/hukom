<?php
// debug($Payment); exit;
?>
<div class="cases index">
	<h2><?php __('Request Reschedule Conference List');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><nobr><?php echo $this->Paginator->sort('Username', 'User.username');?></nobr></th>
			<th><nobr><?php echo $this->Paginator->sort('User ID');?></nobr></th>
			<th><nobr><?php echo $this->Paginator->sort('Case ID');?></nobr></th>
			<th><nobr><?php echo $this->Paginator->sort('Case Detail ID');?></nobr></th>
			<th><nobr><?php echo $this->Paginator->sort('Event ID');?></nobr></th>
			<th><nobr><?php echo $this->Paginator->sort('Conference');?></nobr></th>
			<th><nobr><?php echo $this->Paginator->sort('Date');?></nobr></th>
			<th><nobr><?php echo $this->Paginator->sort('Start Time');?></nobr></th>
			<th><nobr><?php echo $this->Paginator->sort('End Time');?></nobr></th>
			<th><nobr><?php echo $this->Paginator->sort('Notes');?></nobr></th>
			<th><nobr><?php echo $this->Paginator->sort('created');?></nobr></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
    // debug($RequestReschedules);
	foreach ($RequestReschedules as $RequestReschedule):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $RequestReschedule['RequestReschedule']['id']; ?>&nbsp;</td>
		<td><?php echo $RequestReschedule['User']['username']; ?>&nbsp;</td>
		<td><?php echo $RequestReschedule['RequestReschedule']['user_id']; ?>&nbsp;</td>
		<td><?php echo $RequestReschedule['RequestReschedule']['case_id']; ?>&nbsp;</td>
		<td><?php echo $RequestReschedule['RequestReschedule']['case_detail_id']; ?>&nbsp;</td>
		<td><?php echo $RequestReschedule['RequestReschedule']['event_id']; ?>&nbsp;</td>
		<td><?php echo $RequestReschedule['RequestReschedule']['conference']; ?>&nbsp;</td>
		<td><nobr><?php echo date('F d, Y', strtotime($RequestReschedule['RequestReschedule']['date'])); ?>&nbsp;</nobr></td>
		<td><nobr><?php echo $RequestReschedule['RequestReschedule']['start']; ?>&nbsp;</nobr></td>
		<td><nobr><?php echo $RequestReschedule['RequestReschedule']['end']; ?>&nbsp;</nobr></td>
		<td><?php echo $RequestReschedule['RequestReschedule']['notes']; ?>&nbsp;</td>
		<td><?php echo $RequestReschedule['RequestReschedule']['created']; ?>&nbsp;</td>
		<td class="actions">
		    
		    <?php
		    if ($RequestReschedule['RequestReschedule']['messenger_type']) {

                $messenger_values = ':'. $RequestReschedule['RequestReschedule']['messenger_type'] .':'. $RequestReschedule['RequestReschedule']['messenger_username'];
		    }
		    else {

		        $messenger_values = null;
		    }
		    ?>
		    
			<a href="#" class="open-calendar" id="<?php echo $RequestReschedule['RequestReschedule']['event_id'] .':'. $RequestReschedule['RequestReschedule']['user_id'] .':'. $RequestReschedule['RequestReschedule']['case_id'] .':'. $RequestReschedule['RequestReschedule']['case_detail_id'] .':'. $RequestReschedule['RequestReschedule']['conference'] . $messenger_values; ?>">Calendar</a>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete_request_reschedule_conference', $RequestReschedule['RequestReschedule']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $RequestReschedule['RequestReschedule']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<?php echo $this->element('admin_navigation'); ?>


<div id="event-calendar" class="hidden" title="E-Lawyers Online Conference Calendar">
	<div id="calendar"></div>
</div>

<div id="event-data-add" title="Schedule Conference" class="hidden">
    <?php
    echo $form->create('Event', array('target'=> '_parent'));
    echo $form->input('title' , array('label' => 'ID', 'type'=>'text', 'readonly' => true));
    echo $form->input('date', array('type'=>'text', 'readonly' => true));
    echo $form->input('start', array('options' => $custom->calendar_time_select()));
    echo $form->input('end', array('options' => $custom->calendar_time_select()));
    echo $form->input('allday', array('type'=>'hidden', 'value' => 0));
    echo $form->input('event_id', array('type'=>'text'));
    echo $form->input('user_id', array('type'=>'text'));
    echo $form->input('case_id', array('type'=>'text'));
    echo $form->input('case_detail_id', array('type'=>'text'));
    echo $form->input('conference', array('type'=>'text'));
    echo $form->input('messenger_type', array('type'=>'text'));
    echo $form->input('messenger_username', array('type'=>'text'));
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

<div id="already_selected_schedule" title="Schedule Conference" class="hidden">
    You have already selected a schedule. Close the calendar and re-open to change your selected schedule. 
</div>


<?php $html->scriptBlock("calendar_dialogs();", array('inline'=>false));?>

<?php //$this->Html->scriptStart(array('inline' => false));?>
<script type="text/javascript">

$(document).ready(function() {
	
	$(".open-calendar").click(function() {        
	    request_ids = $(this).attr('id').split(':');
	    
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
            },
			open: function() {
                //Full Calendar
        		var calendar = $('#calendar').fullCalendar({
        	        // events: "/events/feed",
        	        events: '/events/feed/',
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
        	                            add_event_url    = "/events/reschedule_event/"+'false'+"/"+$.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm");

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

        	                                        input_data.push('EventTitle=' + $('#EventTitle').val());
        	                                        input_data.push('EventAllday=' + $('#EventAllday').val());

        	                                        input_data.push('EventUserId=' + $('#EventUserId').val());
        	                                        input_data.push('EventCaseId=' + $('#EventCaseId').val());
        	                                        input_data.push('EventCaseDetailId=' + $('#EventCaseDetailId').val());
        	                                        input_data.push('EventConference=' + $('#EventConference').val());
        	                                        input_data.push('messenger_type=' + $('#EventMessengerType').val());
        	                                        input_data.push('messenger_username=' + $('#EventMessengerUsername').val());
        	                                        input_data.push('EventCalendarId=' + $('#EventCalendarId').val());
        	                                        input_data.push('old_event_id=' + $('#EventEventId').val());

        											switch ($('#EventConference').val()){
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
                                                    
                                                    // console.log(event_input_data);
                                                    
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
                                        $('#EventTitle').val(request_ids[1] + '-' + request_ids[2]);
                                        $('#EventEventId').val(request_ids[0]);
                                        $('#EventUserId').val(request_ids[1]);
                                        $('#EventCaseId').val(request_ids[2]);
                                        $('#EventCaseDetailId').val(request_ids[3]);
                                        $('#EventConference').val(request_ids[4]);
                                        
                                        if (request_ids[5]) {
                                            $('#EventMessengerType').val(request_ids[5]);
                                        }
                                        else {
                                            $('#EventMessengerType').val('');
                                        }
                                        
                                        if (request_ids[6]) {
                                            $('#EventMessengerUsername').val(request_ids[6]);
                                        }
                                        else {
                                            $('#EventMessengerUsername').val('');
                                        }
                                        

        	        },
        	    });
            } //Open End
        }); //Dialog End
        
        $("#event-calendar").dialog("open");
    });
});
</script>
