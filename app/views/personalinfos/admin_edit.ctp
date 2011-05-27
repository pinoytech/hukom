<div class="personalinfos form">
<?php echo $this->Form->create('Personalinfos');?>
	<fieldset>
 		<legend><?php __('Edit Personal Information'); ?></legend>
	<?php
		echo $this->Form->input('PersonalInfo.id', array('type' => 'text', 'readonly' => true));
		echo $this->Form->input('PersonalInfo.user_id', array('type' => 'hidden'));
		echo $this->Form->input('PersonalInfo.email', array('readonly' => true));
		echo $this->Form->input('PersonalInfo.first_name');
		echo $this->Form->input('PersonalInfo.middle_name');
		echo $this->Form->input('PersonalInfo.last_name', array('class' => 'required'));
        echo $this->Form->input('PersonalInfo.gender', array('type' => 'select', 'options' => $custom->list_gender()));
		echo $this->Form->input('PersonalInfo.birth_date');
		echo $this->Form->input('PersonalInfo.birth_place');
		echo $this->Form->input('PersonalInfo.address_ph');
		echo $this->Form->input('PersonalInfo.address_abroad');
		echo $this->Form->input('PersonalInfo.telephone_no');
		echo $this->Form->input('PersonalInfo.cellphone_no');
		echo $this->Form->input('PersonalInfo.age');
		echo $this->Form->input('PersonalInfo.citizenship');
		echo $this->Form->input('PersonalInfo.education_attained', array('type' => 'select', 'options' => $custom->list_education_attained()));
		echo $this->Form->input('PersonalInfo.school');
		echo $this->Form->input('PersonalInfo.company_work');
		echo $this->Form->input('PersonalInfo.nature_of_business');
		echo $this->Form->input('PersonalInfo.company_address');
		echo $this->Form->input('PersonalInfo.work_position');
		echo $this->Form->input('PersonalInfo.work_duration');
		echo $this->Form->input('PersonalInfo.work_status', array('type' => 'select', 'options' => $custom->list_work_status()));
		echo $this->Form->input('PersonalInfo.civil_status', array('type' => 'select', 'options' => $custom->list_civil_status()));
		echo $this->Form->input('PersonalInfo.marriage_date');
		echo $this->Form->input('PersonalInfo.marriage_place');
		echo $this->Form->input('PersonalInfo.mothers_name', array('label' => "Mother's Name"));
		echo $this->Form->input('PersonalInfo.mothers_age', array('label' => "Mother's Age", 'class' => 'digits'));
		echo $this->Form->input('PersonalInfo.mothers_citizenship', array('label' => "Mother's Citizenship"));
		echo $this->Form->input('PersonalInfo.mothers_address', array('label' => "Mother's Address"));
		echo $this->Form->input('PersonalInfo.fathers_name', array('label' => "Father's Name"));
		echo $this->Form->input('PersonalInfo.fathers_age', array('label' => "Father's Age", 'class' => 'digits'));
		echo $this->Form->input('PersonalInfo.fathers_citizenship', array('label' => "Father's Citizenship"));
		echo $this->Form->input('PersonalInfo.fathers_address', array('label' => "Father's Address"));
	?>
	</fieldset>
	
	<?php echo $this->Form->end(__('Submit', true));?>
	
	<br />
	<div>
		<?php echo $this->Html->link(__('View', true), array('admin' => true, 'action' => 'view', $this->data['PersonalInfo']['id'])); ?>
		<?php
		//Get Spouse and Children Info Id
		$spouse_info_id   = $custom->get_spouse_info_id($this->data['PersonalInfo']['user_id']);
		$children_info_id = $custom->get_children_info_id($this->data['PersonalInfo']['user_id']);
		
		if (isset($spouse_info_id)) {
		    echo '| ' . $this->Html->link(__('Next', true), array('admin' => true, 'controller' => 'spouseinfos', 'action' => 'view', $spouse_info_id));
		}
		elseif(isset($children_info_id)) {
		    echo '| ' . $this->Html->link(__('Next', true), array('admin' => true, 'controller' => 'childrenlists', 'action' => 'index', $this->data['User']['id']));
		}
		else {
		    echo '| ' . $this->Html->link(__('Next', true), array('admin' => true, 'controller' => 'legalcases', 'action' => 'index', $this->data['User']['id'])); 
		}
		?>
	</div>
	
</div>
<?php echo $this->element('admin_navigation'); ?>

<script type="text/javascript">
jQuery('document').ready(function() {
    jQuery("#PersonalinfosAdminEditForm").validate();
});    
</script>