<ul>
	<li><?php echo $this->Html->link(__('List of Cases', true), array('controller' => 'cases', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link(__('Legal Consultation Through Written Query', true), array('controller' => 'users', 'action' => 'letter_of_intent', $id)); ?></li>
</ul>