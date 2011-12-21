<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>

		<div class="form-title">Legal Initial Assessment</div>
		<div class="form-holder form-initial-assessment">
			<p>
                Please enter your details
			</p>

			<?php //echo $this->Form->create('Legalcase', array('onsubmit' => "confirm_request_reschedule_conference(); return false;"));?>
			<?php echo $this->Form->create('Legalcases');?>
			<?php
				echo $this->Form->input('InitialAssessment.first_name', array('type' => 'text', 'class' => 'required'));
				echo $this->Form->input('InitialAssessment.last_name', array('type' => 'text', 'class' => 'required'));
				echo $this->Form->input('InitialAssessment.email', array('type' => 'text', 'class' => 'required required'));
				echo $this->Form->input('InitialAssessment.details', array('type' => 'textarea', 'class' => 'required'));
			?>	

			<input type="submit" class="button-submit" value="">
	        <?php echo $this->Form->end();?>
		</div>
	</div>
</div>

<!-- <div id="reschedule_warning" title="Request Reschedule Conference" class="hidden">
    Please be informed that your request for re-scheduling of your video/office conference will automatically open your original schedule to other clients and E-Lawyers Online shall not guarantee its availability on the said date again upon submission of your request. If you are sure of your request for re-scheduling, please click “Continue”.
</div> -->

<?php //$html->scriptBlock("request_reschedule_conference('$id', '$case_id', '$case_detail_id', '$total_time');", array('inline'=>false));?>
<?php $html->scriptBlock('initial_legal_assessment_form();', array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>
