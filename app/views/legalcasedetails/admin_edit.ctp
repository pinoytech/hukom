<div class="users form">
<?php echo $this->Form->create('Legalcasedetail');?>
	<fieldset>
 		<legend><?php __('Edit Case Details of Case No.'. $this->data['Legalcasedetail']['case_id']); ?></legend>
	<?php
		echo $this->Form->input('Legalcasedetail.id', array('type' => 'text', 'readonly' => true));
		echo $this->Form->input('Legalcasedetail.case_id', array('type' => 'text', 'readonly' => true));
		echo $this->Form->input('Legalcasedetail.user_id', array('type' => 'hidden'));
		echo $this->Form->input('Legalcasedetail.confirmed', array('type' => 'hidden'));
		echo $this->Form->input('User.username', array('readonly' => true));
		
		$options = $Legalservices;
		echo $this->Form->input('Legalcasedetail.legal_service', array('type' => 'select', 'options' => $options));
		
		$options = array('pending' => 'pending', 'confirmed' => 'confirmed', 'closed' => 'closed');
		echo $this->Form->input('Legalcasedetail.status', array('type' => 'select', 'options' => $options));
		
		echo $this->Form->input('Legalcasedetail.summary', array('type' => 'textarea'));
		echo $this->Form->input('Legalcasedetail.objectives', array('type' => 'textarea'));
		echo $this->Form->input('Legalcasedetail.questions', array('type' => 'textarea'));
		
	?>
	</fieldset>
	
	<?php echo $this->Form->end(__('Submit', true));?>
	
	<br />
	<div>
		<?php echo $this->Html->link(__('Edit', true), array('admin' => true, 'action' => 'edit', $this->data['Legalcasedetail']['id'])); ?>
		|
		<?php echo $this->Html->link(__('View Case Details List', true), array('admin' => true, 'action' => 'index', $this->data['Legalcasedetail']['case_id'])); ?>
		|
		<?php echo $this->Html->link(__('View Case', true), array('admin' => true, 'controller' => 'legalcases', 'action' => 'view', $this->data['Legalcasedetail']['case_id'])); ?>
	</div>
	
</div>
<?php echo $this->element('admin_navigation'); ?>