<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->element('navigation');?>
		
		<div class="form-title">My Cases</div>
		<div class="form-holder">
			
			<div class="actions avail-button-holder">
				<?php echo $this->Html->link($this->Html->image('/img/availButton_up.png', array('border' => '0')), array('action' => 'online_legal_consultation', $id), array('class' => 'avail-button', 'escape' => false)); ?>
			</div>
			
			<table class="dashboard" cellpadding="5" cellspacing="0" >
				<tr class="label">
					<td><?php echo $this->Paginator->sort('CID', 'Legalcase.id');?></td>
					<td><?php echo $this->Paginator->sort('Legal Problem', 'Legalcase.legal_problem');?></td>
				</tr>
				<?php
                // debug($Legalcase);
				foreach ($Legalcase as $Legalcases) {
                // debug($Legalcases);
				?>
				<tr>
					<td><?php echo $Legalcases['Legalcase']['id'];?></td>
					<td><?php echo $Legalcases['Legalcase']['legal_problem'];?>
						<div>
							<table class="dashboard" cellpadding="5" cellspacing="0" >
								<tr class="label">
									<td>CDID</td>
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
									<td style="white-space:nowrap;"><?php echo $Legalcasedetail['legal_service'];?>
									    <?php
									    //Display Event Details
                                        foreach ($Legalcases['Event'] as $Event) {
                                            if ($Event['case_detail_id'] == $Legalcasedetail['id']) {
                                                echo '<br />';
                                                echo '<span class="event_details">' . date('F d, Y', strtotime($Event['start'])) . '</span>';
                                                echo '<br />';
                                                echo '<span class="event_details">' . date('h:i A', strtotime($Event['start'])) . ' - ' . date('h:i A', strtotime($Event['end'])) . '</span>';
                                            }
                                        }    
                                    
                                        //Display Reschedule for Approval
                                        if (isset($Legalcases['RequestReschedule'])) {
                                            foreach ($Legalcases['RequestReschedule'] as $RequestReschedule) {
                                                if ($RequestReschedule['case_detail_id'] == $Legalcasedetail['id']) {
                                                    echo '<br />';
                                                    echo '<span class="event_details"><nobr>(Reschedule for Approval)</nobr></span>';
                                                    break;
                                                }
                                            }
                                        }
                                        
									    ?>
									</td>
									<td><?php echo $Legalcasedetail['status'];?></td>
									<td style="white-space:nowrap;"><?php echo date('F d, Y', strtotime($Legalcasedetail['created']));?></td>
									<td>
										<?php
											$payment_option = 'mode_of_payment';
											$payment_status = '';
                                            // $action         = 'Pay Now';
											
											foreach ($Legalcases['Payment'] as $Payment) {
												if ($Payment['case_detail_id'] == $Legalcasedetail['id']) {
													echo $Payment['option'];
													$payment_option = 'bank_deposit';
													$payment_id     = $Payment['id'];
													$payment_status = $Payment['status'];
													$action         = '';
												}
											}

										?>
									</td>
									<td><?php echo ucfirst($payment_status); ?></td>
									<td class="actions">
										<?php
										
										// Check if user reached up to 'questions' form. This will trigger the 'Continue' action.
    									if ($Legalcasedetail['questions']) {
    									    if (empty($payment_status)) {
    									        echo $this->Html->link($this->Html->image('/img/paynowButton_up.png', array('class' => 'pay-now-button')), array('controller' => 'payments', 'action' => $payment_option, $Legalcases['User']['id'], $Legalcasedetail['case_id'], $Legalcasedetail['id']), array('escape' => false));
                                                echo '<br />';
    									    }
                                            
                                            $continue = false;
    									}
    									else {
    									    $continue = true;
    									}
    									
    									//Check Legal Service Type
    									switch ($Legalcasedetail['legal_service']){
    										case "Per Query":
    											$legal_service = 'perquery';
    											
    											if ($continue) {
    											    echo $this->Html->link($this->Html->image('/img/Continuebutton_up.png', array('class' => 'continue-button')), array('action' => 'legal_problem', $Legalcases['User']['id'], $Legalcasedetail['case_id'], $Legalcasedetail['id']), array('escape' => false));
                                                    echo '<br />';
    											}
    											
    											break;
    										case "Video Conference":
    											$legal_service = 'video';
    											
    											if ($continue) {
                                                    echo $this->Html->link($this->Html->image('/img/Continuebutton_up.png', array('class' => 'continue-button')), array('action' => 'letter_of_intent', $Legalcases['User']['id'], $Legalcasedetail['case_id'], $legal_service, $Legalcasedetail['id']), array('escape' => false));
                                                    echo '<br />';
                                                }
                                                
    											break;
    										case "Office Conference":
    										    $legal_service = 'office';
    										    
    										    if ($continue) {
                                                    echo $this->Html->link($this->Html->image('/img/Continuebutton_up.png', array('class' => 'continue-button')), array('action' => 'letter_of_intent', $Legalcases['User']['id'], $Legalcasedetail['case_id'], $legal_service, $Legalcasedetail['id']), array('escape' => false));
                                                    echo '<br />';
                                                }
                                                
    											break;	
    									}
										
										echo $this->Html->link($this->Html->image('/img/viewButton_up.png', array('class' => 'view-button')), array('controller' => 'legalcases', 'action' => 'summary_of_information', $Legalcases['User']['id'], $Legalcasedetail['case_id'], $Legalcasedetail['id'], 'view', $legal_service), array('escape' => false));
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

<?php $html->scriptBlock("legalcases_index();", array('inline'=>false));?>