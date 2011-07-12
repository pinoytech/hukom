<div id="full-content">
	<div id="main">

		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>

		<div class="form-title">Summary of Information</div>
		<div class="form-holder">
			<table class="summary-info">
				<tr>
					<td class="label"><?php echo ($auth_user_type == 'personal') ? 'My' : 'Our'; ?> Legal Problem is:</td>
					<td><?php echo $Legalcase['Legalcase']['legal_problem'];?></td>
				</tr>
				<tr>
					<td colspan="2"><hr /></td>
				</tr>
				<?php
                // debug($Legalcase);
				foreach ($Legalcase['Legalcasedetail'] as $Legalcasedetail) {
				?>
				<tr>
					<td class="label">Case Detail ID:</td>
					<td><?php echo $Legalcasedetail['id'];?></td>
				</tr>
				<tr>
					<td class="label">Legal Service via:</td>
					<td><?php echo $Legalcasedetail['legal_service'];?></td>
				</tr>
				<?php
				if (isset($Event['Event']['id'])) {
				    $event_id = $Event['Event']['id'];
                }
                else{
                    $event_id = false;
                }
				?>

				<?php
				//From Closed Confirmation Email
				if ($Legalcase['Event']) {
					foreach ($Legalcase['Event'] as $Event) {
						if ($Event['case_detail_id'] == $Legalcasedetail['id']) {
                ?>
					<?php
					if ($Event['conference'] == 'video') {
					?>
		                <tr>
							<td class="label"><?php echo ucfirst($Event['messenger_type']);?> ID:</td>
							<td><?php echo $Event['messenger_username'];?></td>
						</tr>
					<?php
	                }
	                ?>					
					<tr>
						<td class="label">No. of Hours:</td>
						<td><?php echo $custom->date_difference($Event['start'], $Event['end'], 'h');;?></td>
					</tr>
					<tr>
						<td class="label">Preferred Date:</td>
						<td>
						    <?php echo date('F d, Y', strtotime($Event['start']));?>
						    <?php
                			if ($Legalcasedetail['status'] != 'Closed') {
        			        ?>
                                <input type="button" class="request_reschdule_conference" id="<?php echo $Event['conference'];?>" value="Request to Reschedule Conference" />
                			<?php
            			    }
                			?>
						</td>
					</tr>
					<tr>
						<td class="label">Preferred Time:</td>
						<td><?php echo date('h:i a', strtotime($Event['start'])) . ' to ' . date('h:i a', strtotime($Event['end']));?></td>
					</tr>
                <?php
						}
					}
                }
                ?>

				<tr>
					<td class="label">Summary of Facts:</td>
					<td><?php echo $Legalcasedetail['summary'];?></td>
				</tr>
				<tr>
					<td class="label"><?php echo ($auth_user_type == 'personal') ? 'My' : 'Our'; ?> Objectives:</td>
					<td><?php echo $Legalcasedetail['objectives'];?></td>
				</tr>
				<tr>
					<td class="label"><?php echo ($auth_user_type == 'personal') ? 'My' : 'Our'; ?> Questions:</td>
					<td><?php echo $Legalcasedetail['questions'];?></td>
				</tr>
				<tr>
					<td class="label">Attached Document/s:</td>
					<td class="actions">
				    	<?php
				    	$upload_folder = '/app/webroot/uploads/' . $Legalcasedetail['user_id'] . '/' . $Legalcasedetail['case_id'] . '/' . $Legalcasedetail['id'];
						$files = $custom->show_files($upload_folder);
                        // echo debug($files);
						
                        foreach ($files as $key => $value) {
                            echo '<a href="' . $upload_folder . '/' . $value . '" target="_blank">' . $value . '</a><br />';
                        }
                        
						?>    					
					</td>
				</tr>
				<tr>
					<td class="label">Status:</td>
					<td><?php echo ucfirst($Legalcasedetail['status']);?></td>
				</tr>
				<tr>
					<td class="label">Date Created:</td>
					<td><?php echo date('F d, Y', strtotime($Legalcasedetail['created']));?></td>
				</tr>
				<tr>
					<td class="label">Professional Fee:</td>
					<td>Php <?php echo $fee;?></td>
				</tr>
				<tr>
					<td colspan="2"><hr /></td>
				</tr>
				<?php
				}
				?>
			</table>
			
			<br />

    		<table>
    			<tr>
                <?php
        		if ($type == 'view') {
        		?>
    		        <td>
        				<input type="button" id="back-to-case-index" class="back-to-case-list" />
        			</td>
        		<?php
        		}
        		elseif ($type == 'add') {
	
					if ($legal_service == 'video') {
						$new_facts_id = 'new-video-conference';
					}
					elseif ($legal_service == 'office') {
						$new_facts_id = 'new-office-conference';
					}
					else {
						$new_facts_id = 'new-facts';
					}
        		?>
        			<td>
        				<input type="button" id="<?php echo $new_facts_id;?>" value="Add new facts" />
        			</td>
        		<?php
        	    }
				elseif ($type == 'reschedule') {
        		?>
        			<td>
                        <input type="button" id="next" class="button-next" />
                    </td>
        		<?php
        	    }
        		else {
        		?>
                    <td>
                        <input type="button" id="back" class="button-back" />
                    </td>
                    <td>
                        <input type="button" id="next" class="button-next" />
                    </td>
        		<?php
        		}
                ?>
            	</tr>
    		</table>
		</div>
	</div>
</div>

<?php $html->scriptBlock("summary_of_information_form('$id', '$case_id', '$case_detail_id', '$event_id');", array('inline'=>false));?>