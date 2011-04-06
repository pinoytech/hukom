<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->element('navigation');?>
		
		<div class="form-title">My Cases</div>
		<div class="form-holder">
			
			<div class="actions">
				<?php echo $this->Html->link(__('Avail Legal Service', true), array('action' => 'online_legal_consultation', $id)); ?>
			</div>
			
			<br />
			
			<table class="dashboard" cellpadding="5" cellspacing="0" >
				<tr class="label">
					<td>Case No.</td>
					<td>Legal Problem</td>
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
									<td>Payment Status</td>
									<td>Actions</td>
								</tr>
								<?php
								foreach ($Legalcases['Legalcasedetail'] as $Legalcasedetail) {
									// debug($Legalcasedetail);
								?>
								<tr>
									<td><?php echo $Legalcasedetail['id'];?></td>
									<td><?php echo $Legalcasedetail['legal_service'];?></td>
									<td><?php echo $Legalcasedetail['status'];?></td>
									<td><?php echo substr($Legalcasedetail['created'], 0, 11);?></td>
									<td>
										<?php
											$payment_option = 'mode_of_payment';
											$payment_status = '';
											$action         = 'Pay Now';
											
											if (isset($Legalcases['Payment'])) {
												foreach ($Legalcases['Payment'] as $Payment) {
													if ($Payment['case_detail_id'] == $Legalcasedetail['id']) {
														echo $Payment['option'];
														$payment_option = 'bank_deposit';
														$payment_id     = $Payment['id'];
														$payment_status = $Payment['status'];
														$action         = '';
													}
												}
											}
										?>
									</td>
									<td><?php echo ucfirst($payment_status); ?></td>
									<td class="actions">
										<?php
										
										if ($action == 'Pay Now') {
                                            echo $this->Html->link(__('Pay Now', true), array('controller' => 'payments', 'action' => $payment_option, $Legalcases['User']['id'], $Legalcasedetail['case_id'], $Legalcasedetail['id']));
                                            echo '<br />';
										}

										echo $this->Html->link(__('View', true), array('controller' => 'legalcases', 'action' => 'summary_of_information', $Legalcases['User']['id'], $Legalcasedetail['case_id'], $Legalcasedetail['id'], 'view'));

										?>
									</td>
								</tr>
								<?php
								}
								?>
							</table>
						</div>
					</td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
		
	</div>
</div>