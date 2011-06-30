<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->Session->flash(); ?>

		<div class="form-title">Request to Reschedule Conference</div>
		<div class="form-holder form-request-reschedule-conference">
			<p>
                Please select date and fill-up notes.
			</p>
				    
			<?php echo $this->Form->create('Legalcase');?>
			<?php
				echo $this->Form->input('Legalcase.id');
				echo $this->Form->input('Legalcase.user_id', array('type' => 'hidden', 'value' => $id));
				echo $this->Form->input('Legalcase.case_id', array('type' => 'hidden','value' => $case_id));
				echo $this->Form->input('Legalcase.case_detail_id', array('type' => 'hidden','value' => $case_detail_id));
				echo $this->Form->input('Legalcase.event_id', array('type' => 'hidden','value' => $event_id));
				echo $this->Form->input('Legalcase.date', array('class' => 'required birth_date',));
				echo $this->Form->input('Legalcase.notes', array('type' => 'textarea', 'class' => 'required'));
			?>	

            <input type="hidden" id="agree-checker">
			<input type="submit" class="button-submit" value="">
	        <?php echo $this->Form->end();?>
		</div>
	</div>
</div>

<?php $html->scriptBlock("request_reschedule_conference('$id', '$case_id', '$case_detail_id');", array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>