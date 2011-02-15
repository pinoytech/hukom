<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('Case', array('url' => "summary_of_facts/$user_id"));?>
			<fieldset>
		 		<legend><?php __('Summary of Facts'); ?></legend>
				<?php
					echo $this->Form->input('Case.id');
					echo $this->Form->input('Case.user_id', array('type' => 'hidden', 'value' => $user_id));
					echo $this->Form->input('Case.summary_of_facts', array('label' => false));
				?>
				
			</fieldset>
		
		<table>
			<tr>
				<td>
					<?php
						echo $this->Html->link(__('Back', true), array('action' => 'legal_problem', $user_id, $this->data['Case']['id']));
					?>
				</td>
				<td>
					<?php echo $this->Form->end(__('Next', true));?>
				</td>
			</tr>
		</table>
		
	</div>
</div>