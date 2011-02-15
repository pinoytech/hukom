<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('Case', array('url' => "objectives_questions/$user_id"));?>
		<?php
		echo $this->Form->input('Case.id');
		echo $this->Form->input('Case.user_id', array('type' => 'hidden', 'value' => $user_id));
		?>
			<fieldset>
		 		<legend><?php __('My Ojectives'); ?></legend>
				<?php
					echo $this->Form->input('Case.objectives', array('label' => false));
					?>
			</fieldset>
		
			<fieldset>
		 		<legend><?php __('My Questions'); ?></legend>
				<?php
					echo $this->Form->input('Case.questions', array('label' => false));
					?>
			</fieldset>
			
		<table>
			<tr>
				<td>
					<?php
						echo $this->Html->link(__('Back', true), array('action' => 'summary_of_facts', $user_id, $this->data['Case']['id']));
					?>
				</td>
				<td>
					<?php echo $this->Form->end(__('Next', true));?>
				</td>
			</tr>
		</table>
		
	</div>
</div>