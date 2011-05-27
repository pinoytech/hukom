<ul>
	<li><?php echo $this->Html->link(__('List of Cases', true), array('controller' => 'legalcases', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link(__('New Case', true), array('controller' => 'legalcases', 'action' => 'online_legal_consultation', $id)); ?></li>
</ul>