<div id="full-content">
	<div id="main">

		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>

		<div class="form-title">Summary of Information</div>
		<div class="form-holder">
			<table class="summary-info">
				<?php
                // debug($Legalcasedetails);
                $i = 0;
				foreach ($Legalcasedetails as $Legalcasedetail) {
				    $i++;
				?>
				<?php if($i == 1) { ?>
                <tr>
					<td class="label"><?php echo ($auth_user_type == 'personal') ? 'My' : 'Our'; ?> Legal Problem is:</td>
					<td><?php echo $Legalcasedetail['Legalcase']['legal_problem'];?></td>
				</tr>
				<tr>
					<td colspan="2"><hr /></td>
				</tr>
				<?php } ?>
				<tr>
					<td class="label">Case Detail ID:</td>
					<td><?php echo $Legalcasedetail['Legalcasedetail']['id'];?></td>
				</tr>
				<tr>
					<td class="label">Legal Service via:</td>
					<td><?php echo $Legalcasedetail['Legalcasedetail']['legal_service'];?></td>
				</tr>
				<?php
				if (isset($Legalcasedetai['Event']['id'])) {
				    $event_id = $Legalcasedetai['Event']['id'];
                }
                else{
                    $event_id = false;
                }
				?>
				<?php
				if ($Legalcasedetail['Legalcasedetail']['legal_service'] == 'Video Conference' || $Legalcasedetail['Legalcasedetail']['legal_service'] == 'Office Conference') {
                ?>
				    <?php
					if ($Legalcasedetail['Event']['conference'] == 'video') {
					?>
		                <tr>
							<td class="label"><?php echo ucfirst($Legalcasedetail['Event']['messenger_type']);?> ID:</td>
							<td><?php echo $Legalcasedetail['Event']['messenger_username'];?></td>
						</tr>
					<?php
	                }
	                ?>					
					<tr>
						<td class="label">No. of Hours:</td>
						<td><?php echo $no_of_hours = $custom->date_difference($Legalcasedetail['Event']['start'], $Legalcasedetail['Event']['end'], 'h');;?></td>
					</tr>
					<tr>
						<td class="label">Preferred Date:</td>
						<td>
						    <?php
						    if (!empty($Legalcasedetail['Event']['start'])) {
						    ?>
						    
						    <div class="preferred-date-holder" style="margin-top: 6px;">
						    <?php echo date('F d, Y', strtotime($Legalcasedetail['Event']['start']));?>
						    </div>
						    
						    <?php
                			    if ($Legalcasedetail['Legalcasedetail']['status'] != 'Closed') {
        			        ?>
        			            <div class="reschedule-button-holder" style="margin-top: 0;">
        			                <a id="<?php echo $Legalcasedetail['Event']['id'] . "/" . $Legalcasedetail['Event']['conference'];?>" class="request_reschdule_conference"><img src="/img/ReschedButton_up.png" class="reschedule-button" border="0" ></a>
        			            </div>
                			<?php
            			        }
            			    }
            			    else {
            			        echo 'No selected schedule';
        			        }
                			?>
						</td>
					</tr>
					<tr>
						<td class="label">Preferred Time:</td>
						<td>
						    <?php
						    if (!empty($Legalcasedetail['Event']['start'])) {
						        echo date('h:i a', strtotime($Legalcasedetail['Event']['start'])) . ' to ' . date('h:i a', strtotime($Legalcasedetail['Event']['end']));
					        }
					        else {
					            echo 'No selected schedule';
					        }
						    ?>
						</td>
					</tr>
                <?php   
                }
                ?>
                
                <?php
                //Display Reschedule for Approval
			    if (isset($Legalcase['RequestReschedule']) && empty($Legalcase['Event'])) {
                    foreach ($Legalcase['RequestReschedule'] as $RequestReschedule) {
                        if ($RequestReschedule['case_detail_id'] == $Legalcasedetail['id']) {
                ?>
                            <tr>
        						<td class="label">Preferred Date:</td>
        						<td>(Reschedule for Approval)</td>
        					</tr>
        		<?php
                            break;
                        }
                    }
                }
			    ?>
                
				<tr>
					<td class="label">Summary of Facts:</td>
					<td><?php echo $Legalcasedetail['Legalcasedetail']['summary'];?></td>
				</tr>
				<tr>
					<td class="label"><?php echo ($auth_user_type == 'personal') ? 'My' : 'Our'; ?> Objectives:</td>
					<td><?php echo $Legalcasedetail['Legalcasedetail']['objectives'];?></td>
				</tr>
				<tr>
					<td class="label"><?php echo ($auth_user_type == 'personal') ? 'My' : 'Our'; ?> Questions:</td>
					<td><?php echo $Legalcasedetail['Legalcasedetail']['questions'];?></td>
				</tr>
				<tr>
					<td class="label">Attached Document/s:</td>
					<td class="actions">
				    	<?php
				    	$upload_folder = '/app/webroot/uploads/' . $Legalcasedetail['Legalcasedetail']['user_id'] . '/' . $Legalcasedetail['Legalcasedetail']['case_id'] . '/' . $Legalcasedetail['Legalcasedetail']['id'];
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
					<td><?php echo ucfirst($Legalcasedetail['Legalcasedetail']['status']);?></td>
				</tr>
				<tr>
					<td class="label">Date Created:</td>
					<td><?php echo date('F d, Y', strtotime($Legalcasedetail['Legalcasedetail']['created']));?></td>
				</tr>
				<tr>
					<td class="label">Professional Fee:</td>
					<td>Php
					<?php
					//Get Fee
                    foreach ($Legalservices as $Legalservice) {
                        if ($Legalservice['Legalservice']['name'] == $Legalcasedetail['Legalcasedetail']['legal_service']) {
                            if ($no_of_hours) {
                                echo $no_of_hours * $Legalservice['Legalservice']['fee'];
                            }
                            else {
                                echo $Legalservice['Legalservice']['fee'];
                            }
                        }
                    }
					?>
					</td>
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

        		if ($type == 'add' || $type == 'view') {
        		    
        		    if ($Legalcasedetail['Legalcasedetail']['status'] == 'Closed') {
        		    
	                    // Add new facts
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
        			    <?php echo $this->Form->create('Legalcase');?>
        			    <?php
            				echo $this->Form->input('Legalcasedetail.case_id', array('type' => 'hidden', 'value' => $case_id));
            				echo $this->Form->input('Legalcasedetail.user_id', array('type' => 'hidden', 'value' => $id));
            				echo $this->Form->input('Legalcasedetail.legal_service', array('type' => 'hidden', 'value' => $legal_service));
            			?>
                        <!-- <input type="button" id="<?php echo $new_facts_id;?>" class="new-facts-button"  /> -->
        				<input type="submit" class="new-facts-button" value=""  />
        				<?php echo $this->Form->end();?>
        			</td>
        		<?php
    		        }
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