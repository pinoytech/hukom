<div class="ChildrenLists form">
<?php echo $this->Form->create('Childrenlists');?>
	<fieldset>
 		<legend><?php __('Edit Child Information'); ?></legend>
	<?php
		echo $this->Form->input('ChildrenList.id', array('type' => 'text', 'readonly' => true));
		echo $this->Form->input('ChildrenList.user_id', array('type' => 'hidden'));
		echo $this->Form->input('ChildrenList.name');
        echo $this->Form->input('ChildrenList.sex', array('type' => 'select', 'options' => $custom->list_gender()));
        echo $this->Form->input('ChildrenList.birth_date');
        echo $this->Form->input('ChildrenList.school');
        echo $this->Form->input('ChildrenList.grade_year');
	?>
	</fieldset>
	
	<?php echo $this->Form->end(__('Submit', true));?>
	
	<br />
	<div>
	    <?php echo $this->Html->link(__('Back to Children List', true), array('action' => 'index', $this->data['User']['id'])); ?>
	</div>
	
</div>
<?php echo $this->element('admin_navigation'); ?>