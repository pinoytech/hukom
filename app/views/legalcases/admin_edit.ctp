<div class="users form">
<?php echo $this->Form->create('Legalcase');?>
	<fieldset>
 		<legend><?php __('Edit Case'); ?></legend>
	<?php
		echo $this->Form->input('Legalcase.id', array('type' => 'text', 'readonly' => true));
		echo $this->Form->input('Legalcase.user_id', array('type' => 'hidden'));
		echo $this->Form->input('Legalcase.confirmed', array('type' => 'hidden'));
		echo '<div><label>Username</label>' . $this->data['User']['username'] . '</div>';
		$options = array(
			'Personal' => 'Personal',
			'Family' => 'Family',
			'Property' => 'Property',
			'Contractual' => 'Contractual',
			'Business' => 'Business',
			'Single Proprietorship' => 'Single Proprietorship',
			'Corporation Partnership' => 'Corporation Partnership',
			'Unregistered Business, Joint Venture, Consortium etc' => 'Unregistered Business, Joint Venture, Consortium etc',
			'Others' => 'Others',
			'Work' => 'Work',
			'Legal Documents' => 'Legal Documents',
			'Special Projects/Contracts' => 'Special Projects/Contracts',	
			);
		if (!in_array($this->data['Legalcase']['legal_problem'], $options)) {
			$options[$this->data['Legalcase']['legal_problem']] = $this->data['Legalcase']['legal_problem'];
		}
		// debug($options);
		echo $this->Form->input('Legalcase.legal_problem', array('type' => 'select', 'options' => $options));
		
		$options = array('active' => 'active', 'not active' => 'not active');
		echo $this->Form->input('Legalcase.status', array('type' => 'select', 'options' => $options));
	?>
	</fieldset>
	
	<?php echo $this->Form->end(__('Submit', true));?>
	
	
</div>
<?php echo $this->element('admin_navigation'); ?>