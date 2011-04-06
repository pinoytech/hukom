<div class="dashboard index">
	<h2><?php __('Dashboard');?></h2>
	
	<table class="custom-inside" cellpadding="5" cellspacing="0" >
		<tr class="label">
			<td><?php echo $this->Paginator->sort('Case ID', 'Legalcase.id');?></td>
			<td><?php echo $this->Paginator->sort('Username', 'User.username');?></td>
			<td><?php echo $this->Paginator->sort('Legal Problem', 'Legalcase.legal_problem');?></td>
		</tr>
		<?php
        // debug($Legalcase);
		foreach ($Legalcase as $Legalcases) {
		?>
		<tr>
			<td><?php echo $Legalcases['Legalcase']['id'];?></td>
			<td><?php echo $Legalcases['User']['username'];?></td>
			<td><?php echo $Legalcases['Legalcase']['legal_problem'];?>
			    
			    <div style="position:relative;top:-18px;">
    			    <div style="position:absolute;top:0;right:0;">
    			        <?php echo $this->Html->link(__('Unhide Cases', true), '#', array('class' => 'unhide_cases', 'id' => $Legalcases['Legalcase']['id'])); ?>
    			    </div>
			    </div>
			    
				<div style="padding-top: 10px;">
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
							if ($Legalcasedetail['is_hidden'] != 1) {
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
							<td>
							    <?php echo $this->Html->link(__('Export Case', true), array('action' => 'case_export_xls', $Legalcasedetail['id'])); ?>
							    <br />

							    <?php echo $this->Html->link(__('Export Personal Info', true), array('action' => 'personalinfo_export_xls', $Legalcasedetail['user_id'])); ?>
							    <br />
							    
							    <?php echo $this->Html->link(__('Export Spouse Info', true), array('action' => 'spouseinfo_export_xls', $Legalcasedetail['user_id'])); ?>
						        <br />
						        
						        <?php echo $this->Html->link(__('Export Children Info', true), array('action' => 'childreninfo_export_xls', $Legalcasedetail['user_id'])); ?>
						        <br />
						        
						        <?php echo $this->Html->link(__('Hide', true), '#', array('class' => 'hide_case', 'id' => $Legalcasedetail['id'])); ?>
							</td>
						</tr>
						<?php
					        }
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
	
	<p>
    	<?php
    	echo $this->Paginator->counter(array(
    	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    	));
    	?>
	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	    |
	    <?php echo $this->Paginator->numbers();?>
        |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	
</div>
<?php echo $this->element('admin_navigation'); ?>

<script type="text/javascript">
jQuery('document').ready(function() {	
	
	jQuery('.hide_case').click(function() {
	    var agree=confirm("Do you want to hide this case?");
        if (agree){                        
            var parentrow = jQuery(this).parent().parent();
            // console.log(parentrow);
            jQuery.ajax({
    			type: "POST", 
    			url: "/admin/dashboard/hide_case",
    			data: 'id=' + jQuery(this).attr('id'),
    			success: function(msg)
    			{
                    parentrow.empty().fadeOut();
    			},
    			error: function()
    			{
    				alert("An error occured while updating. Try again in a while");
    			}
    		 });
        }
        else{
            return false;
        }
	});
	
	jQuery('.unhide_cases').click(function() {
	    var agree=confirm("Do you want to unhide all cases?");
        if (agree){                        
            jQuery.ajax({
    			type: "POST", 
    			url: "/admin/dashboard/unhide_cases",
    			data: 'id=' + jQuery(this).attr('id'),
    			success: function(msg)
    			{
    			    window.location = document.URL;
    			},
    			error: function()
    			{
    				alert("An error occured while updating. Try again in a while");
    			}
    		 });
        }
        else{
            return false;
        }
	});
	
});
</script>