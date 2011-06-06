<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->element('navigation');?>
		
		<div class="form-title">My Cases</div>
		<div class="form-holder">
			
			<div class="actions">
				<?php echo $this->Html->link($this->Html->image('/img/availButton_up.png', array('border' => '0')), array('action' => 'online_legal_consultation', $id), array('class' => 'avail-button', 'escape' => false)); ?>
			</div>
			
			<table class="dashboard" cellpadding="5" cellspacing="0" >
				<tr class="label">
					<td><?php echo $this->Paginator->sort('Case ID', 'Legalcase.id');?></td>
					<td><?php echo $this->Paginator->sort('Legal Problem', 'Legalcase.legal_problem');?></td>
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
										
										switch ($Legalcasedetail['legal_service']){
											case "Per Query":
												$legal_service = 'perquery';
												break;
											case "Video Conference":
												$legal_service = 'video';
												break;
											case "Office Conference":
												$legal_service = 'office';
												break;	
										}
										
										echo $this->Html->link(__('View', true), array('controller' => 'legalcases', 'action' => 'summary_of_information', $Legalcases['User']['id'], $Legalcasedetail['case_id'], $Legalcasedetail['id'], 'view', $legal_service));

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
			
			<br />
            
            <p>
            	<?php
            	echo $this->Paginator->counter(array(
            	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
            	));
            	?>
        	</p>
            
            <div class="paging">
        		<?php echo $this->Paginator->prev($this->Html->image('/img/previousButton_up.png', array('border' => '0', 'align' => 'absbottom', 'class' => 'prev-button')), array('escape' => false), array(), null, array('class'=>'disabled'));?>
        	    |
        	    <?php echo $this->Paginator->numbers();?>
                |
        		<?php echo $this->Paginator->next($this->Html->image('/img/nextButton_up.png', array('border' => '0', 'align' => 'absbottom', 'class' => 'next-button')), array('escape' => false), array(), null, array('class' => 'disabled'));?>
        	</div>
		</div>
		
	</div>
</div>

<script type="text/javascript">
legalcases_index()
</script>