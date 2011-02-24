<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->element('navigation');?>
		
		<div class="form-title">My Cases</div>
		<div class="form-holder">
			
			<div>
				<?php echo $this->Html->link(__('Add Case', true), array('action' => 'online_legal_consultation', $id)); ?>
			</div>
			
			<br />
			
			<table>
				<tr>
					<td>Case No.</td>
					<td>Status</td>
					<td>Actions</td>
				</tr>
				<?php
				foreach ($Legalcase as $Legalcases) {
				?>
				<tr>
					<td><?php echo $Legalcases['Legalcase']['id'];?></td>
					<td><?php echo ucfirst($Legalcases['Legalcase']['status']);?></td>
					<td>
						<?php echo $this->Html->link(__('Review Case', true), array('controller' => 'legalcases', 'action' => 'summary_of_information',$Legalcases['Legalcase']['user_id'], $Legalcases['Legalcase']['id'])); ?> |
						<?php echo $this->Html->link(__('Handle Case', true), array('controller' => 'legalcases', 'action' => 'handel_case', $Legalcases['Legalcase']['id'])); ?> |
						<?php echo $this->Html->link(__('Payment Options', true), array('controller' => 'legalcases', 'action' => 'payment_options', $Legalcases['Legalcase']['id'])); ?>
					</td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
		
	</div>
</div>