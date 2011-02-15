<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('Case', array('action' => "legal_problem/$user_id"));?>
			<fieldset>
		 		<legend><?php __('My Legal Problem'); ?></legend>
				<?php
					echo $this->Form->input('Case.id');
					echo $this->Form->input('Case.user_id', array('type' => 'hidden', 'value' => $user_id));
					
					$options = array(
							'Personal' => 'Personal',
							'Family' => 'Family',
							'Property' => 'Property',
							'Contractual' => 'Contractual',
							'Business' => 'Business',
							'Work' => 'Work',
							'Legal Documents' => 'Legal Documents',
							'Special Projects/Contracts' => 'Special Projects/Contracts',
							'Anything under the sun' => 'Anything under the sun (Other Legal Services)',
						);	
						
					echo $this->Form->input('Case.legal_problem', array('type' => 'radio', 'options'=>$options, 'class' => 'remove-asterisk', 'legend' => false, ));
				?>
				
			</fieldset>
		
		<table>
			<tr>
				<td>
					<?php
						echo $this->Html->link(__('Back', true), array('controller' => 'users', 'action' => 'children_info', $user_id));
					?>
				</td>
				<td>
					<?php echo $this->Form->end(__('Next', true));?>
				</td>
			</tr>
		</table>
		
	</div>
</div>