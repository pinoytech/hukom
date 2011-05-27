<div class="SpouseInfos form">
<?php echo $this->Form->create('Spouseinfos');?>
	<fieldset>
 		<legend><?php __('Edit Spouse Information'); ?></legend>
	<?php
		echo $this->Form->input('SpouseInfo.id', array('type' => 'text', 'readonly' => true));
		echo $this->Form->input('SpouseInfo.user_id', array('type' => 'hidden'));
		echo $this->Form->input('SpouseInfo.email', array('readonly' => true));
		echo $this->Form->input('SpouseInfo.first_name');
		echo $this->Form->input('SpouseInfo.middle_name');
		echo $this->Form->input('SpouseInfo.last_name');
        echo $this->Form->input('SpouseInfo.gender', array('type' => 'select', 'options' => $custom->list_gender()));
		echo $this->Form->input('SpouseInfo.birth_date');
		echo $this->Form->input('SpouseInfo.birth_place');
		echo $this->Form->input('SpouseInfo.address_ph');
		echo $this->Form->input('SpouseInfo.address_abroad');
		echo $this->Form->input('SpouseInfo.telephone_no');
		echo $this->Form->input('SpouseInfo.cellphone_no');
		echo $this->Form->input('SpouseInfo.age');
		echo $this->Form->input('SpouseInfo.citizenship');
		echo $this->Form->input('SpouseInfo.education_attained', array('type' => 'select', 'options' => $custom->list_education_attained()));
		echo $this->Form->input('SpouseInfo.school');
		echo $this->Form->input('SpouseInfo.company_work');
		echo $this->Form->input('SpouseInfo.nature_of_business');
		echo $this->Form->input('SpouseInfo.company_address');
		echo $this->Form->input('SpouseInfo.work_position');
		echo $this->Form->input('SpouseInfo.work_duration');
		echo $this->Form->input('SpouseInfo.work_status', array('type' => 'select', 'options' => $custom->list_work_status()));
	?>
	</fieldset>
	
	<?php echo $this->Form->end(__('Submit', true));?>
	
	<br />
	<div>
		<?php
		//Get Personal Info Id
		$personal_info_id = $custom->get_personal_info_id($this->data['SpouseInfo']['user_id']);
		
		echo $this->Html->link(__('Back', true), array('admin' => true, 'controller' => 'personalinfos', 'action' => 'view', $personal_info_id)); ?>
		<?php
		//Get Children Info Id
		$children_info_id = $custom->get_children_info_id($this->data['SpouseInfo']['user_id']);
		
		if(isset($children_info_id)) {
		    echo '| ' . $this->Html->link(__('Next', true), array('admin' => true, 'controller' => 'childrenlists', 'action' => 'index', $this->data['User']['id']));
		}
		else {
		    echo '| ' . $this->Html->link(__('Next', true), array('admin' => true, 'controller' => 'legalcases', 'action' => 'index', $this->data['User']['id'])); 
		}
		?>
	</div>
	
</div>
<?php echo $this->element('admin_navigation'); ?>