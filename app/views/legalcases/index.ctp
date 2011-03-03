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
			
			<table class="dashboard" cellpadding="5" cellspacing="0" >
				<tr class="label">
					<td>Case No.</td>
					<td>Legal Problem</td>
					<td>Actions</td>
				</tr>
				<?php
				// debug($Legalcase);
				foreach ($Legalcase as $Legalcases) {
				?>
				<tr>
					<td><?php echo $Legalcases['Legalcase']['id'];?></td>
					<td><?php echo $Legalcases['Legalcase']['legal_problem'];?>
						<div>
							<table class="dashboard" cellpadding="5" cellspacing="0" >
								<tr class="label">
									<td>Details ID</td>
									<td>Legal Service</td>
									<td>Status</td>
									<td>Date</td>
									<td>Payment Option</td>
									<td>Actions</td>
								</tr>
								<?php
								foreach ($Legalcases['Legalcasedetail'] as $Legalcasedetail) {
									// debug($Legalcasedetail);
								?>
								<tr>
									<td><?php echo $Legalcasedetail['id'];?></td>
									<td><?php echo $Legalcasedetail['legal_service'];?></td>
									<td><?php echo ucfirst($Legalcasedetail['status']);?></td>
									<td><?php echo substr($Legalcasedetail['created'], 0, 11);?></td>
									<td>
										<?php
											$payment_option = 'mode_of_payment';
											$payment_id_or_case_detail_id = $Legalcasedetail['id'];
											
											if (isset($Legalcases['Bankdeposit'])) {
												foreach ($Legalcases['Bankdeposit'] as $Bankdeposit) {
													if ($Bankdeposit['case_detail_id'] == $Legalcasedetail['id']) {
														echo 'Bank Deposit';
														$payment_option = 'bank_deposit';
														$payment_id_or_case_detail_id = $Bankdeposit['id'];
													}
												}
											}
										?>
									</td>
									<td>
										<?php
										if ($Legalcasedetail['status'] == 'pending') {
											echo $this->Html->link(__('Payment Options', true), array('controller' => 'payments', 'action' => $payment_option, $Legalcases['User']['id'], $Legalcasedetail['case_id'], $payment_id_or_case_detail_id)); 
										}
										?>
									</td>
								</tr>
								<?php
								}
								?>
							</table>
						</div>
					</td>
					<td>
						<?php echo $this->Html->link(__('View', true), array('controller' => 'legalcases', 'action' => 'summary_of_information',$Legalcases['Legalcase']['user_id'], $Legalcases['Legalcase']['id'], 'all', 'view')); ?>
					</td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
		
	</div>
</div>