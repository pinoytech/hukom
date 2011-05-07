<div id="full-content">
	<div id="main">
				
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
				
		<div class="form-title">Dashboard</div>
		<div class="form-holder">
		    
		    <div id="calendar"></div>
		    
		    <div id="event-data-add" title="Schedule Event">
		        
		    </div>
		</div>
		
	</div>
</div>

<script type='text/javascript'>
    jQuery(document).ready(function() {
        
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
            
            dayClick: function(date, allDay, jsEvent, view) {
                // jQuery("#eventdata").show();
                // jQuery("#eventdata").load("<?php echo Dispatcher::baseUrl();?>/events/add/"+allDay+"/"+$.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm"));
                
                allDay = false;
                
                url = "<?php echo Dispatcher::baseUrl();?>/events/add/"+allDay+"/"+$.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm");
                
                var input_data = [];
                
                // alert(input_data.join(' '));
                
                /*
                calendar.fullCalendar('renderEvent',
					{
                        title: 'value.title',
                        start: jQuery('#EventStart').val(),
                        end: '',
                        allDay: ''
					},
					true // make the event "stick"
				);
                */
                
                jQuery("#event-data-add").load(url).dialog({
            		autoOpen: false,
            		width: 500,
            		height: 400,
                    modal: true,
            		resizable: false,
                    buttons: {
                        Ok: function(data) {
                            // jQuery('#EventAddForm').submit();
                            
                            if (allDay == true) {
                                jQuery('input[id*=Event]').each(function(index){
                                    input_data.push(jQuery(this).attr('id') + '=' + jQuery(this).val());
                                });
                            }
                            else {
                                input_data.push('EventTitle=' + jQuery('#EventTitle').val());
                                input_data.push('EventAllday=' + jQuery('#EventAllday').val());
                                input_data.push('EventStart=' + jQuery('#EventDate').val() + ' ' + convertToMilitaryTime(jQuery('#EventStartMeridian').val(), jQuery('#EventStartHour').val(), jQuery('#EventStartMin').val()) + ':00');
                                input_data.push('EventEnd=' + jQuery('#EventDate').val() + ' ' + convertToMilitaryTime(jQuery('#EventEndMeridian').val(), jQuery('#EventEndHour').val(), jQuery('#EventEndMin').val()) + ':00');
                            }
                            
                            // console.log(input_data.join('&'));
                            
                            jQuery.ajax({
                                type: "POST",
                                url: url,
                                data: input_data.join('&'),
                                success: function(msg)
                                {   
                                    /*    
                                    console.log(msg)                             
                                    $.each(msg, function(key, value) {
                                        
                                        calendar.fullCalendar('addEventSource',
                    						{
                                                title: value.title,
                                                start: value.start,
                                                end: value.end,
                                                allDay: value.allday
                    						}
                    					);
                                    });
                                    */
                                    
                                    // calendar.fullCalendar('addEventSource', "/events/get_feed/" + msg);
                                    // calendar.fullCalendar('addEventSource', "/events/feed");
                                    // calendar.fullCalendar('addEventSource', msg);
                                    calendar.fullCalendar('refetchEvents');
                                },
                                error: function()
                                {
                                    alert("An error occured while updating. Try again in a while");
                                }
                            });
                            
                            jQuery(this).dialog('close');
            			}
                    }
            	});
                
                jQuery("#event-data-add").dialog("open");
            },
        });
        
        
    });
</script>