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
					<?php echo $legal_service; ?> for <input type="text" id="event_hours" value="<?php echo $event_hours;?>" size="5" readonly /> no. of hours on<br /> <em>(check calendar for available schedule)</em> <input type="text" id="event_date" value="<?php echo $event_date;?>" size="15" readonly /><a id="open-calendar"><img src="/img/Calendar-32.png" width="16" style="vertical-align:text-top;"></a> from <input type="text" id="event_start" value="<?php echo $event_start;?>" size="10" readonly /> to <input type="text" id="event_end" value="<?php echo $event_end;?>" size="10" readonly />.
				</p>
				
				<p>
				    I agree to pay the amount of <b>Php <input type="hidden" id="conference_fee_orig" value="<?php echo $conference_fee;?>" /> <input type="text" id="conference_fee" value="<?php echo $conference_fee;?>" readonly /></b> as professional fee. I undertake to pay the same within 24 hours from submission of this letter of intent and I understand that my failure to pay within the said period shall entitle E-Lawyers Online to defer the review of my case and/or defer sending the written answer to my query/ies. I expressly acknowledge that the said fee is for the full payment for the subject matter of my query and to no other, and in case I failed to complete the facts or documents as requested, the partial written answer to my query/ies shall be considered as full performance of E-Lawyers Online’s obligation and the fees thereof forfeited in favor of E-Lawyers Online. For this purpose, I am providing you my personal information, the summary of the facts of my legal problem including documents (if any), my objective, my questions and my acceptance of your Online Legal Consultation Agreement. 
				</p>
				
				<p>
					Respectfully submitted.
				</p>				
				<br />
			    <input type="submit" class="button-submit" value="" />
			    
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>

<div id="event-calendar" style="display:none;" title="E-Lawyers Online Conference Calendar"></div>

<div id="event-fill-up-notice" style="display:none;" title="E-Lawyers Online Conference Calendar">
    Please select schedule from the calendar to proceed.
</div>


<script type="text/javascript">
function redirect(){
    
    jQuery("#event-fill-up-notice").dialog({
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
    
    if (!jQuery('#event_date').val()) {
        $("#event-fill-up-notice").dialog("open");
        return false;
    }
    
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

jQuery(document).ready(function() {
    // jQuery("#event-calendar").dialog("open");

    jQuery("#open-calendar").click(function() {
        
        var url = '<?php echo Dispatcher::baseUrl();?>/events/calendar_dialog/<?php echo "$id/$case_id"?>';

        jQuery("#event-calendar").load(url).dialog({
            autoOpen: false,
    		width: 850,
    		height: 700,
            modal: true,
    		resizable: false,
    		close: function() {
                jQuery.ajax({
                    type: "POST",
                    url: '/events/get_info',
                    success: function(msg)
                    {
    
                        $.each(msg, function(key, value) {
                            if (value.id) {                            
                                jQuery('#event_date').val(value.date);
                                jQuery('#event_start').val(value.start);
                                jQuery('#event_end').val(value.end);
                                jQuery('#event_hours').val(value.no_of_hours);
                                jQuery('#conference_fee').val((value.no_of_hours * jQuery('#conference_fee_orig').val()).toFixed(2));
                            }
                        });
                    }
                });
            }
        });
        
        jQuery("#event-calendar").dialog("open");
    });
    
    
});
</script>