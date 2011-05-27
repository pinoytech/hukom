<br />
<div>
	<?php echo $this->Html->link(__('Edit', true), array('admin' => true, 'action' => 'edit', $Legalcasedetail['Legalcasedetail']['id'])); ?>
	|
	<?php echo $this->Html->link(__('View Case Details', true), array('admin' => true, 'action' => 'index', $Legalcasedetail['Legalcase']['id'])); ?>
	|
	<?php echo $this->Html->link(__('View Cases', true), array('admin' => true, 'controller' => 'legalcases', 'action' => 'view', $Legalcasedetail['Legalcase']['id'])); ?>
</div>