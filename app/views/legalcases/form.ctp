<script type="text/javascript">
jQuery('document').ready(function() {
	//Remove Asterisks
	jQuery('.remove-asterisk').each(function(index) {
			var parent_div      = jQuery(this).parent().parent();
			var parent_fieldset = jQuery(this).parent();
			console.log(parent_fieldset.children('legend'));
			parent_div.removeClass('required');
			parent_fieldset.children('legend').addClass('put-asterisk');
		
	});
	
	//Put astrerisks
	jQuery('.put-asterisk').each(function(index) {
		jQuery(this).append('<span class="red-asterisks">*</span>').css({'color' : '#444444', 'font-weight' : 'bold'});
	});
});
</script>

<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->element('case_navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('Case');?>
			<fieldset>
		 		<legend><?php __('Add New Case'); ?></legend>
				<?php
					echo $this->Form->input('Case.id');
					$options=array('query'=>'Query','video'=>'Video','monthly'=>'Monthy', 'special'=>'Special');
					echo $this->Form->input('Case.type', array('type' => 'radio', 'options'=>$options, 'class' => 'remove-asterisk', 'legend' => 'Please select type of service'));					
				
					$options=array('query'=>'Query',
						'personal'=>'Personal',
						'family'=>'Family',
						'property'=>'Property',
						'business'=>'Business',
						'work'=>'Work',
						'legal_documents'=>'Legal Documents',
						'special'=>'Special/Projects/Contracts',
						'anythings'=>'Anything under the sun',
						);
					echo $this->Form->input('Case.legal_problem', array('type' => 'radio', 'options'=>$options, 'class' => 'remove-asterisk', 'legend' => 'My Legal Problem is'));					
					echo $this->Form->input('Case.summary_of_facts');
					echo $this->Form->input('CaseAttachment.file', array('type' => 'file', 'label' => 'Attach File'));
					echo $this->Form->input('Case.objectives', array('label' => 'My Objectives'));
					echo $this->Form->input('CaseQuestion.0.question', array('label' => 'Question 1'));
					echo $this->Form->input('CaseQuestion.1.question', array('label' => 'Question 2'));
					echo $this->Form->input('CaseQuestion.2.question', array('label' => 'Question 3'));
					echo $this->Form->input('CaseQuestion.3.question', array('label' => 'Question 4'));
					echo $this->Form->input('CaseQuestion.4.question', array('label' => 'Question 5'));
				?>
								
			</fieldset>
		<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>