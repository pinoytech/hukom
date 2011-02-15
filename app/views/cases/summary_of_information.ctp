<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		<?php
		// debug($User);
		?>
			<fieldset>
		 		<legend><?php __('Summary of Information'); ?></legend>
				
				<h2>Personal Information (<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'personal_info', $user_id)); ?>)</h2>
				<table class="summary-info">
					<tr>
						<td class="label">First Name</td>
						<td><?php echo $User['PersonalInfo']['first_name'];?></td>
					</tr>
					<tr>
						<td class="label">Last Name</td>
						<td><?php echo $User['PersonalInfo']['last_name'];?></td>
					</tr>
					<tr>
						<td class="label">Email</td>
						<td><?php echo $User['PersonalInfo']['email'];?></td>
					</tr>
					<tr>
						<td class="label">Gender</td>
						<td><?php echo ucfirst($User['PersonalInfo']['gender']);?></td>
					</tr>
					<tr>
						<td class="label">Birth Date</td>
						<td><?php echo $User['PersonalInfo']['birth_date'];?></td>
					</tr>
					<tr>
						<td class="label">Place of Birth</td>
						<td><?php echo $User['PersonalInfo']['birth_place'];?></td>
					</tr>
					<tr>
						<td class="label">Address (Philippines)</td>
						<td><?php echo $User['PersonalInfo']['address_ph'];?></td>
					</tr>
					<tr>
						<td class="label">Address (Abroad)</td>
						<td><?php echo $User['PersonalInfo']['address_abroad'];?></td>
					</tr>
					<tr>
						<td class="label">Telephone No.</td>
						<td><?php echo $User['PersonalInfo']['telephone_no'];?></td>
					</tr>
					<tr>
						<td class="label">Cellphone No.</td>
						<td><?php echo $User['PersonalInfo']['cellphone_no'];?></td>
					</tr>
					<tr>
						<td class="label">Age</td>
						<td><?php echo $User['PersonalInfo']['age'];?></td>
					</tr>
					<tr>
						<td class="label">Citizenship</td>
						<td><?php echo $User['PersonalInfo']['citizenship'];?></td>
					</tr>
					<tr>
						<td class="label">Education Attained</td>
						<td><?php echo $User['PersonalInfo']['education_attained'];?></td>
					</tr>
					<tr>
						<td class="label">School</td>
						<td><?php echo $User['PersonalInfo']['school'];?></td>
					</tr>
					<tr>
						<td class="label">Company/Work</td>
						<td><?php echo $User['PersonalInfo']['company_work'];?></td>
					</tr>
					<tr>
						<td class="label">Nature of Business</td>
						<td><?php echo $User['PersonalInfo']['nature_of_business'];?></td>
					</tr>
					<tr>
						<td class="label">Company Address</td>
						<td><?php echo $User['PersonalInfo']['company_address'];?></td>
					</tr>
					<tr>
						<td class="label">Work/Position</td>
						<td><?php echo $User['PersonalInfo']['work_position'];?></td>
					</tr>
					<tr>
						<td class="label">Work Duration</td>
						<td><?php echo $User['PersonalInfo']['work_duration'];?></td>
					</tr>
					<tr>
						<td class="label">Work Status</td>
						<td><?php echo ucfirst($User['PersonalInfo']['work_status']);?></td>
					</tr>
					<tr>
						<td class="label">Civil</td>
						<td><?php echo ucfirst($User['PersonalInfo']['civil_status']);?></td>
					</tr>
					<?php
					//Display not Single Details
					if ($User['PersonalInfo']['civil_status'] != 'single') {
					?>
					<tr>
						<td class="label">Date of Marriage</td>
						<td><?php echo $User['PersonalInfo']['marriage_date'];?></td>
					</tr>
					<tr>
						<td class="label">Place of Marriage</td>
						<td><?php echo $User['PersonalInfo']['marriage_place'];?></td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td class="label">Mother's Name</td>
						<td><?php echo $User['PersonalInfo']['mothers_name'];?></td>
					</tr>
					<tr>
						<td class="label">Mother's Age</td>
						<td><?php echo $User['PersonalInfo']['mothers_age'];?></td>
					</tr>
					<tr>
						<td class="label">Mother's Citizenship</td>
						<td><?php echo $User['PersonalInfo']['mothers_citizenship'];?></td>
					</tr>
					<tr>
						<td class="label">Mother's Address</td>
						<td><?php echo $User['PersonalInfo']['mothers_address'];?></td>
					</tr>
					<tr>
						<td class="label">Father's Name</td>
						<td><?php echo $User['PersonalInfo']['fathers_name'];?></td>
					</tr>
					<tr>
						<td class="label">Father's Age</td>
						<td><?php echo $User['PersonalInfo']['fathers_age'];?></td>
					</tr>
					<tr>
						<td class="label">Father's Citizenship</td>
						<td><?php echo $User['PersonalInfo']['fathers_citizenship'];?></td>
					</tr>
					<tr>
						<td class="label">Father's Address</td>
						<td><?php echo $User['PersonalInfo']['fathers_address'];?></td>
					</tr>
				</table>
				
				<?php
				//Display not Single Details
				if ($User['PersonalInfo']['civil_status'] != 'single') {
				?>
				<br />
				<h2>Spouse Information (<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'spouse_info', $user_id)); ?>)</h2>
				<table class="summary-info">
					<tr>
						<td class="label">First Name</td>
						<td><?php echo $User['SpouseInfo']['first_name'];?></td>
					</tr>
					<tr>
						<td class="label">Last Name</td>
						<td><?php echo $User['SpouseInfo']['last_name'];?></td>
					</tr>
					<tr>
						<td class="label">Email</td>
						<td><?php echo $User['SpouseInfo']['email'];?></td>
					</tr>
					<tr>
						<td class="label">Gender</td>
						<td><?php echo ucfirst($User['SpouseInfo']['gender']);?></td>
					</tr>
					<tr>
						<td class="label">Birth Date</td>
						<td><?php echo $User['SpouseInfo']['birth_date'];?></td>
					</tr>
					<tr>
						<td class="label">Place of Birth</td>
						<td><?php echo $User['SpouseInfo']['birth_place'];?></td>
					</tr>
					<tr>
						<td class="label">Address (Philippines)</td>
						<td><?php echo $User['SpouseInfo']['address_ph'];?></td>
					</tr>
					<tr>
						<td class="label">Address (Abroad)</td>
						<td><?php echo $User['SpouseInfo']['address_abroad'];?></td>
					</tr>
					<tr>
						<td class="label">Telephone No.</td>
						<td><?php echo $User['SpouseInfo']['telephone_no'];?></td>
					</tr>
					<tr>
						<td class="label">Cellphone No.</td>
						<td><?php echo $User['SpouseInfo']['cellphone_no'];?></td>
					</tr>
					<tr>
						<td class="label">Age</td>
						<td><?php echo $User['SpouseInfo']['age'];?></td>
					</tr>
					<tr>
						<td class="label">Citizenship</td>
						<td><?php echo $User['SpouseInfo']['citizenship'];?></td>
					</tr>
					<tr>
						<td class="label">Education Attained</td>
						<td><?php echo $User['SpouseInfo']['education_attained'];?></td>
					</tr>
					<tr>
						<td class="label">School</td>
						<td><?php echo $User['SpouseInfo']['school'];?></td>
					</tr>
					<tr>
						<td class="label">Company/Work</td>
						<td><?php echo $User['SpouseInfo']['company_work'];?></td>
					</tr>
					<tr>
						<td class="label">Nature of Business</td>
						<td><?php echo $User['SpouseInfo']['nature_of_business'];?></td>
					</tr>
					<tr>
						<td class="label">Company Address</td>
						<td><?php echo $User['SpouseInfo']['company_address'];?></td>
					</tr>
					<tr>
						<td class="label">Work/Position</td>
						<td><?php echo $User['SpouseInfo']['work_position'];?></td>
					</tr>
					<tr>
						<td class="label">Work Duration</td>
						<td><?php echo $User['SpouseInfo']['work_duration'];?></td>
					</tr>
					<tr>
						<td class="label">Work Status</td>
						<td><?php echo ucfirst($User['SpouseInfo']['work_status']);?></td>
					</tr>
				</table>
				<?php
				}
				?>
				
				<br />
				<h2>Children's Information (<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'children_info', $user_id)); ?>)</h2>
				<table class="summary-info">
					<tr>
						<td class="label">Number of Children</td>
						<td><?php echo $User['ChildrenInfo']['no_of_children'];?></td>
					</tr>
					<tr>
						<td class="label">Custody of Children</td>
						<td><?php echo ucfirst($User['ChildrenInfo']['custody']);?></td>
					</tr>
					<tr>
						<td class="label">List of Children</td>
						<td>
							<?php
							if (!empty($User['ChildrenList'])) {
							?>
							<table class="summary-info">
								<tr>
									<td class="label">Name</td>
									<td class="label">Sex</td>
									<td class="label">Date of Birth</td>
									<td class="label">School</td>
									<td class="label">Grade/Year</td>
								</tr>
								<?php
								foreach ($User['ChildrenList'] as $ChildrenList) {
								?>
								<tr>
									<td><?php echo $ChildrenList['name'];?></td>
									<td><?php echo $ChildrenList['sex'];?></td>
									<td><?php echo $ChildrenList['birth_date'];?></td>
									<td><?php echo $ChildrenList['school'];?></td>
									<td><?php echo $ChildrenList['grade_year'];?></td>
								</tr>
								<?php
								}
								?>
							</table>
							<?php
							}
							?>
						</td>
					</tr>
				</table>
				
				<br />
				<h2>Case Information (<?php echo $this->Html->link(__('Edit', true), array('action' => 'legal_problem', $user_id, $case_id)); ?>)</h2>
				<table class="summary-info">
					<tr>
						<td class="label">Legal Problem</td>
						<td><?php echo $Case['Case']['legal_problem'];?></td>
					</tr>
					<tr>
						<td class="label">Summary of Facts</td>
						<td><?php echo $Case['Case']['summary_of_facts'];?></td>
					</tr>
					<tr>
						<td class="label">My Objectives</td>
						<td><?php echo $Case['Case']['objectives'];?></td>
					</tr>
					<tr>
						<td class="label">My Questions</td>
						<td><?php echo $Case['Case']['questions'];?></td>
					</tr>
				</table>
			</fieldset>
				
			<table>
				<tr>
					<td>
						<?php
							echo $this->Html->link(__('Next', true), array('action' => 'online_legal_consultation_agreement', $user_id, $case_id));
						?>
					</td>
				</tr>
			</table>
	</div>
</div>