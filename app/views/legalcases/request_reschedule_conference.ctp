<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->Session->flash(); ?>

		<div class="form-title">Request to Reschedule Conference</div>
		<div class="form-holder form-request-reschedule-conference">
			<p>
                Please select date and fill-up notes.
			</p>
				    
			<?php //echo $this->Form->create('Legalcase', array('onsubmit' => "confirm_request_reschedule_conference(); return false;"));?>
			<?php echo $this->Form->create('Legalcase');?>
			<?php
				echo $this->Form->input('Legalcase.id');
				echo $this->Form->input('Legalcase.user_id', array('type' => 'hidden', 'value' => $id));
				echo $this->Form->input('Legalcase.case_id', array('type' => 'hidden','value' => $case_id));
				echo $this->Form->input('Legalcase.case_detail_id', array('type' => 'hidden','value' => $case_detail_id));
				echo $this->Form->input('Legalcase.event_id', array('type' => 'hidden','value' => $event_id));
				echo $this->Form->input('Legalcase.date', array('class' => 'required birth_date',));
				echo $form->input('Legalcase.start', array('options' => $custom->calendar_time_select()));
                echo $form->input('Legalcase.end', array('options' => $custom->calendar_time_select()));
				echo $this->Form->input('Legalcase.notes', array('type' => 'textarea', 'class' => 'required'));
			?>	

			<input type="submit" class="button-submit" value="">
	        <?php echo $this->Form->end();?>
		</div>
	</div>
</div>

<div id="reschedule_warning" title="Request Reschedule Conference" class="hidden">
    Please be informed that your request for re-scheduling of your video/office conference will automatically open your original schedule to other clients and e-lawyers online shall not guarantee its availability on the said date again upon submission of your request. If you are sure of your request for re-scheduling, please click “Continue”.
</div>

<?php $html->scriptBlock("request_reschedule_conference('$id', '$case_id', '$case_detail_id', '$total_time');", array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>