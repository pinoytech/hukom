<div class="users form">
<?php echo $this->Form->create('Legalcasedetail');?>
	<fieldset>
 		<legend><?php __('Edit Case Details of Case ID '. $this->data['Legalcasedetail']['case_id']); ?></legend>
	<?php
		echo $this->Form->input('Legalcasedetail.id', array('type' => 'text', 'readonly' => true));
		echo $this->Form->input('Legalcasedetail.case_id', array('type' => 'text', 'readonly' => true, 'label' => 'Case ID'));
		echo $this->Form->input('Legalcasedetail.user_id', array('type' => 'hidden'));
		echo $this->Form->input('Legalcasedetail.closed', array('type' => 'hidden'));
		echo $this->Form->input('User.username', array('readonly' => true));
		
		$options = $Legalservices;
		echo $this->Form->input('Legalcasedetail.legal_service', array('type' => 'select', 'options' => $options));
		
		echo $this->Form->input('Legalcasedetail.summary', array('type' => 'textarea'));
		echo $this->Form->input('Legalcasedetail.objectives', array('type' => 'textarea'));
		echo $this->Form->input('Legalcasedetail.questions', array('type' => 'textarea'));
		echo $this->Form->input('Legalcasedetail.monthly_scope', array('type' => 'textarea'));
		
		$options = array('Pending' => 'Pending', 'For Review' => 'For Review', 'Incomplete' => 'Incomplete', 'Closed' => 'Closed');
		echo $this->Form->input('Legalcasedetail.status', array('type' => 'select', 'options' => $options));
	?>
	</fieldset>
	
	<?php echo $this->Form->end(__('Submit', true));?>
	
	<br />
	<div>
		<?php echo $this->Html->link(__('Back to Case List', true), array('admin' => true, 'action' => 'index', $this->data['Legalcasedetail']['case_id'])); ?>
	</div>
	
</div>
<?php echo $this->element('admin_navigation'); ?>