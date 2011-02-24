<div class="users form">
<?php echo $this->Form->create('Legalcase');?>
	<fieldset>
 		<legend><?php __('Edit Case'); ?></legend>
	<?php
		echo $this->Form->input('Legalcase.id');
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
		$options = array('pending' => 'pending', 'confirmed' => 'confirmed', 'closed' => 'closed');
		echo $this->Form->input('Legalcase.status', array('type' => 'select', 'options' => $options));
	?>
	</fieldset>
	
	<fieldset>
 		<legend><?php __('Edit Summary Information'); ?></legend>
	<?php
		// debug($this->data['Legalcasedetail']);
		foreach ($this->data['Legalcasedetail'] as $Legalcasedetail) {
			echo $this->Form->input('Legalcasedetail.' . $Legalcasedetail['id'] . '.id', array('value' => $Legalcasedetail['id'], 'type' => 'text', 'readonly' => 'true'));
			echo $this->Form->input('Legalcasedetail.' . $Legalcasedetail['id'] . '.summary', array('value' => $Legalcasedetail['summary']));
			echo $this->Form->input('Legalcasedetail.' . $Legalcasedetail['id'] . '.objectives', array('value' => $Legalcasedetail['objectives']));
			echo $this->Form->input('Legalcasedetail.' . $Legalcasedetail['id'] . '.questions', array('value' => $Legalcasedetail['questions']));
		}
	?>
	</fieldset>
	
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php echo $this->element('admin_navigation'); ?>