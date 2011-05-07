<div id="full-content">
	<div id="main">
				
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
				
		<div class="form-title">Dashboard</div>
		<div class="form-holder">
		    
		    <div id="calendar"></div>
		    
		    <div id="eventdata"></div>
		</div>
		
	</div>
</div>

<script type='text/javascript'>
    jQuery(document).ready(function() {
        jQuery("#eventdata").hide();
        
        jQuery('#calendar').fullCalendar({
            events: "/events/feed",
            
            dayClick: function(date, allDay, jsEvent, view) {
                jQuery("#eventdata").show();
                jQuery("#eventdata").load("<?php echo Dispatcher::baseUrl();?>/events/add/"+allDay+"/"+$.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm"));
            },
        });
    });
</script>