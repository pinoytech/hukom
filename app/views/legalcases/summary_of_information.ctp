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
					<td colspan="2">---------------------------------------------------------------------------------------------------------------------------------------------------</td>
				</tr>
				<?php
				//debug($Legalcase);
				foreach ($Legalcase['Legalcasedetail'] as $Legalcasedetail) {
				?>
				<tr>
					<td class="label">Legal Service via:</td>
					<td><?php echo $Legalcasedetail['legal_service'];?></td>
				</tr>
				<?php
				if ($Event) {
                ?>
					<?php
					if ($Event['Event']['conference'] == 'video') {
					?>
		                <tr>
							<td class="label"><?php echo ucfirst($Event['Event']['messenger_type']);?> ID:</td>
							<td><?php echo $Event['Event']['messenger_username'];?></td>
						</tr>
					<?php
	                }
	                ?>					
					<tr>
						<td class="label">No. of Hours:</td>
						<td><?php echo $no_of_hours;?></td>
					</tr>
					<tr>
						<td class="label">Preferred Date:</td>
						<td><?php echo date('F d, Y', strtotime($Event['Event']['start']));?></td>
					</tr>
					<tr>
						<td class="label">Preferred Time:</td>
						<td><?php echo date('h:i a', strtotime($Event['Event']['start'])) . ' to ' . date('h:i a', strtotime($Event['Event']['end']));?></td>
					</tr>
                <?php
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
					<td class="label">Date:</td>
					<td><?php echo substr($Legalcasedetail['created'], 0, 10);?></td>
				</tr>
				<tr>
					<td class="label">Professional Fee:</td>
					<td>Php <?php echo $fee;?></td>
				</tr>
				<tr>
					<td colspan="2">---------------------------------------------------------------------------------------------------------------------------------------------------</td>
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
        		?>
        			<td>
        				<input type="button" id="new-facts" value="Add new facts" />
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

<?php $html->scriptBlock("summary_of_information_form('$id', '$case_id', '$case_detail_id');", array('inline'=>false));?>