
<?php
if (!$dialog) {
?>
<div id="full-content">
	<div id="main">
				
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
				
		<div class="form-title">Dashboard</div>
		<div class="form-holder">
		    
		    <div id="calendar"></div>
		    
		    <!-- <div id="event-data-add" title="Schedule Conference"> -->
		        
		    </div>
		</div>
		
	</div>
</div>
<?php
}
else {
?>
<div id="calendar"></div>		    
<!-- <div id="event-data-add" title="Schedule Conference"> -->
<?php
}
?>

<div id="event-data-add" title="Schedule Conference" class="hidden">
    <?php
    echo $form->create('Event', array('target'=> '_parent'));
    echo $form->input('title' , array('label' => 'User', 'type'=>'text', 'value' => $custom->get_first_last_name($id), 'readonly' => true));
    echo $form->input('date', array('type'=>'text', 'readonly' => true));
    echo $form->input('start', array('type'=>'text', 'readonly' => true, 'value' => '08:00 am'));
    echo $form->input('end', array('type'=>'text', 'readonly' => true));
    echo $form->input('allday', array('type'=>'hidden', 'value' => 0));
    echo $form->input('user_id', array('type'=>'hidden', 'value' => $id));
    echo $form->input('case_id', array('type'=>'hidden', 'value' => $case_id));
    echo $form->input('calendar_id', array('type'=>'hidden', 'value' => $this->Session->read('Event.calendar_id')));
    ?>
</div>

<div id="event-blank" title="Schedule Conference" class="hidden">
    Start Time and End Time is required.
</div>

<div id="event-not-available" title="Schedule Conference" class="hidden">
    Sorry, the time you have selected is not available. Please select another time or another date from the calendar.
</div>

<div id="event-date-not-allowed" title="Schedule Conference" class="hidden">
    The date you have selected is not allowed. Please select the date today or onwards.
</div>

<div id="event-date-same" title="Schedule Conference" class="hidden">
    The time you have selected is not valid. Start Time must be greater then End Time.
</div>

<div id="event-locked" title="Schedule Conference" class="hidden">
    You have already booked a schedule.
</div>

<div id="event-after3days" title="Schedule Conference" class="hidden">
     The date you have selected is not allowed. Please select a date 3 days from now.
</div>



<script type='text/javascript'>
jQuery(document).ready(function() {
    
	/*
    $('#EventStart, #EventEnd').timepicker({
        ampm: true,
        showMinute: false,
        hourMin: 8,
        hourMax: 18
    });
	*/
    
    jQuery("#event-blank").dialog({
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
    
    jQuery("#event-not-available").dialog({
		autoOpen: false,
		width: 450,
		height: 150,
        modal: true,
		resizable: false,
		buttons: {
			Ok: function() {
				$(this).dialog("close");
			}
		}
    });
    
    jQuery("#event-date-not-allowed").dialog({
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
    
    jQuery("#event-date-same").dialog({
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
    
    jQuery("#event-locked").dialog({
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
    
    jQuery("#event-after3days").dialog({
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
    
    jQuery("#eventdata").hide();
    
    var calendar = jQuery('#calendar').fullCalendar({
        events: "/events/feed",

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
            // jQuery("#eventdata").show();
            // jQuery("#eventdata").load("<?php echo Dispatcher::baseUrl();?>/events/add/"+allDay+"/"+$.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm"));
            // console.log('<?php echo date("d/m/y"); ?>');

            jQuery.ajax({
                type: "POST",
                url: '/events/check_lock',
                data: 'case_id=<?php echo $case_id;?>&date_clicked='+$.fullCalendar.formatDate(date, "yyyy-MM-dd"),
                success: function(msg)
                {      
                    if (msg == 'locked') {
                        jQuery("#event-locked").dialog("open");
                    }
                    else if (msg == 'after3days') {
                        jQuery("#event-after3days").dialog("open");
                    }
                    else if (!msg) {
						
						// console.log((Date.parse($.fullCalendar.formatDate(date, "MMM d, yyyy"))));
						// console.log(Date.parse("May 27, 2011"));
						// console.log(Date.parse("<?php echo date('M j, Y');?>"));
						
                        if ( Date.parse( $.fullCalendar.formatDate(date, "MMM d, yyyy")) < Date.parse("<?php echo date('M j, Y');?>")) {
                            jQuery("#event-date-not-allowed").dialog("open");
                        }
                        else {                    
                            // allDay = false;    
                            url    = "<?php echo Dispatcher::baseUrl();?>/events/add/"+'false'+"/"+$.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm");

                            // jQuery("#event-data-add").load(url).dialog({
                            jQuery("#event-data-add").dialog({
                        		autoOpen: false,
                        		width: 250,
                        		height: 230,
                                modal: true,
                        		resizable: false,
                                buttons: {
                                    Ok: function(data) {
                                        // jQuery('#EventAddForm').submit();

                                        var input_data = [];

                                        if (jQuery('#EventStart').val() == '' || jQuery('#EventEnd').val() == '') {
                                            jQuery("#event-blank").dialog("open");
                                            return false;
                                        }

                                        if (jQuery('#EventStart').val() == jQuery('#EventEnd').val()) {
                                            jQuery("#event-date-same").dialog("open");
                                            return false;
                                        }

                                        input_data.push('EventTitle=' + jQuery('#EventTitle').val());
                                        input_data.push('EventAllday=' + jQuery('#EventAllday').val());
                                        // input_data.push('EventStart=' + jQuery('#EventDate').val() + ' ' + convertToMilitaryTime(jQuery('#EventStartMeridian').val(), jQuery('#EventStartHour').val(), jQuery('#EventStartMin').val()) + ':00');
                                        // input_data.push('EventEnd=' + jQuery('#EventDate').val() + ' ' + convertToMilitaryTime(jQuery('#EventEndMeridian').val(), jQuery('#EventEndHour').val(), jQuery('#EventEndMin').val()) + ':00');

                                        //exploaded time
                                        EventStart          = jQuery('#EventStart').val().split(' ');
                                        EventStart_time     = EventStart[0].split(':');
                                        EventStart_meridian = EventStart[1];

                                        input_data.push('EventStart=' + jQuery('#EventDate').val() + ' ' + convertToMilitaryTime(EventStart_meridian, EventStart_time[0], EventStart_time[1]) + ':00');

                                        EventEnd          = jQuery('#EventEnd').val().split(' ');
                                        EventEnd_time     = EventEnd[0].split(':');
                                        EventEnd_meridian = EventEnd[1];

                                        input_data.push('EventEnd=' + jQuery('#EventDate').val() + ' ' + convertToMilitaryTime(EventEnd_meridian, EventEnd_time[0], EventEnd_time[1]) + ':00');

                                        input_data.push('EventUserId=' + jQuery('#EventUserId').val());
                                        input_data.push('EventCaseId=' + jQuery('#EventCaseId').val());
                                        input_data.push('EventCalendarId=' + jQuery('#EventCalendarId').val());


                                        jQuery.ajax({
                                            type: "POST",
                                            url: url,
                                            data: input_data.join('&'),
                                            success: function(msg)
                                            {   
                                                if (msg == 'not available') {
                                                    jQuery("#event-not-available").dialog("open");
                                                    return false;
                                                }

                                                calendar.fullCalendar('refetchEvents');
                                            },
                                            error: function()
                                            {
                                                alert("An error occured while updating. Try again in a while");
                                            }
                                        });

                                        jQuery(this).dialog('close');
                                        jQuery('#EventStart').val('');
                                        jQuery('#EventEnd').val('');
                                        jQuery('#EventAllday').val(0);
                        			} //end Ok: function(data) {
                                }
                        	});

                            jQuery("#event-data-add").dialog("open");

                            if (!allDay) {
                                // alert(1)
                                jQuery('#EventStart').val($.fullCalendar.formatDate(date, "hh:mm tt"));
                                jQuery('#EventAllday').val(0);
                            }

                            jQuery('#EventDate').val($.fullCalendar.formatDate(date, "yyyy-MM-dd"));

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
    
});
</script>