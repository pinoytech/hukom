<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
			<div class="form-title">Spouse Information</div>
			<div class="form-holder form-personal-info">
				<?php echo $this->Form->create('User');?>
				<?php
					echo $this->Form->input('User.case_id', array('type' => 'hidden', 'value' => $case_id));
					echo $this->Form->input('User.case_detail_id', array('type' => 'hidden', 'value' => $case_detail_id));
					
					echo $this->Form->input('SpouseInfo.id', array('value' => $this->data['SpouseInfo']['id']));
					echo $this->Form->input('SpouseInfo.user_id', array('type' => 'hidden', 'value' => $this->data['User']['id']));
					
					echo '<div class="row three-field">';
					echo $this->Form->input('SpouseInfo.first_name', array('class' => 'required'));
					echo $this->Form->input('SpouseInfo.middle_name', array('class' => 'required'));
					echo $this->Form->input('SpouseInfo.last_name', array('class' => 'required'));
					echo '</div>';

					echo '<div class="row full-field">';
					echo $this->Form->input('SpouseInfo.address_ph', array('label' => 'Address (Philippines)', 'class' => 'required'));
					echo '</div>';
					
					echo '<div class="row full-field">';
					echo $this->Form->input('SpouseInfo.address_abroad', array('label' => 'Address (Abroad)'));
					echo '</div>';
					
					echo '<div class="row three-field">';
					echo $this->Form->input('SpouseInfo.telephone_no', array('class' => 'required digits'));
					echo $this->Form->input('SpouseInfo.cellphone_no', array('class' => 'required digits'));
					echo $this->Form->input('SpouseInfo.email', array('class' => 'required email'));
					echo '</div>';
					
					echo '<div class="row two-field">';
					echo $this->Form->input('SpouseInfo.birth_date', array('type' => 'text', 'class' => 'required birth_date'));
					echo $this->Form->input('SpouseInfo.birth_place', array('label' => 'Place of Birth', 'class' => 'required'));
					echo '</div>';
					
					echo '<div class="row three-field">';
					if ($this->data['PersonalInfo']['gender'] == 'Male') {
						$spouse_gender = 'Female';
					}
					else {
						$spouse_gender = 'Male';
					}
					echo $this->Form->input('SpouseInfo.gender', array('readonly' => true, 'value' => $spouse_gender));
					echo $this->Form->input('SpouseInfo.age', array('class' => 'required digits'));
					echo $this->Form->input('SpouseInfo.citizenship', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row two-field">';
					echo $this->Form->input('SpouseInfo.education_attained', array('class' => 'required', 'type' => 'select', 'options' => $custom->list_education_attained(), 'empty' => 'Select One'));
                    echo $this->Form->input('SpouseInfo.school', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row two-field">';
					echo $this->Form->input('SpouseInfo.company_work', array('label' => 'Company/Work', 'class' => 'required'));
					echo $this->Form->input('SpouseInfo.nature_of_business', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row full-field">';
					echo $this->Form->input('SpouseInfo.company_address', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row three-field">';
					echo $this->Form->input('SpouseInfo.work_position', array('label' => 'Work/Position','class' => 'required'));
					echo $this->Form->input('SpouseInfo.work_duration', array('class' => 'required'));
					echo $this->Form->input('SpouseInfo.work_status', array('options' => $custom->list_work_status(),'class' => 'required', 'empty' => 'Select'));
					echo '</div>';
				?>
				<?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>
				<br />
				<table>
    				<tr>
    					<td>
    						<input type="button" id="back" class="button-back" value="" />
    					</td>
    					<td>
        				    <?php
        				    if ($case_id) {
                    		    $button_class = "button-next";
                    		    $button_id = 'next';
                    		}
                    		else {
                    		    $button_class = "button-submit";
                    		    $button_id = 'save';
                    		}
        				    ?>
                    		<input type="button" id="<?php echo $button_id;?>" class="next-save <?php echo $button_class;?>" value="" />
        				</td>
    				</tr>
    			</table>
			</div>			
		<?php echo $this->Form->end();?>
	</div>
</div>
<?php echo $html->script('form-hacks');?>

<script type="text/javascript">
spouse_info_form('<?php echo $id ?>', '<?php echo $case_id ?>', '<?php echo $case_detail_id ?>');
</script>
