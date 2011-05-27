<div class="personalinfos view">
<h2><?php  __('Personal Information');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('First Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['first_name']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Middle Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['middle_name']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['last_name']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Gender'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['gender']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Birth Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['birth_date']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Birth Place'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['birth_place']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address (Philippines)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['address_ph']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address (Abroad)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['address_abroad']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Telephone No.'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['telephone_no']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cellphone No.'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['cellphone_no']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Age'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['age']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Citizenship'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['citizenship']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Education Attained'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['education_attained']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('School'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['school']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Company Work'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['company_work']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nature Of Business'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['nature_of_business']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Company Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['company_address']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Work Position'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['work_position']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Work Duration'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['work_duration']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Work Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['work_status']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Civil Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['civil_status']; ?>
			&nbsp;
		</dd>
		
		<?php
		if ($PersonalInfo['PersonalInfo']['civil_status'] != 'Single') {
        ?>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Marriage Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['marriage_date']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Marriage Place'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['marriage_place']; ?>
			&nbsp;
		</dd>
		
		<?php
		}
		?>
        
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __("Mother's Name"); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['mothers_name']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __("Mother's Age"); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['mothers_age']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __("Mother's Citizenship"); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['mothers_citizenship']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __("Mother's Address"); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['mothers_address']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __("Father's Name"); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['fathers_name']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __("Father's Age"); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['fathers_age']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __("Father's Citizenship"); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['fathers_citizenship']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __("Father's Address"); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['PersonalInfo']['fathers_address']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['User']['created']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $PersonalInfo['User']['modified']; ?>
			&nbsp;
		</dd>
	</dl>

	<br />
	<div>
		<?php echo $this->Html->link(__('Edit Personal Information', true), array('admin' => true, 'action' => 'edit', $PersonalInfo['PersonalInfo']['id'])); ?>
		<?php
		//Get Spouse and Children Info Id
		$spouse_info_id   = $custom->get_spouse_info_id($PersonalInfo['PersonalInfo']['user_id']);
		$children_info_id = $custom->get_children_info_id($PersonalInfo['PersonalInfo']['user_id']);
		
		if (isset($spouse_info_id)) {
		    echo '| ' . $this->Html->link(__('Next', true), array('admin' => true, 'controller' => 'spouseinfos', 'action' => 'view', $spouse_info_id));
		}
		elseif(isset($children_info_id)) {
		    echo '| ' . $this->Html->link(__('Next', true), array('admin' => true, 'controller' => 'childrenlists', 'action' => 'index', $PersonalInfo['User']['id']));
		}
		else {
		    echo '| ' . $this->Html->link(__('Next', true), array('admin' => true, 'controller' => 'legalcases', 'action' => 'index', $PersonalInfo['User']['id'])); 
		}
		?>
	</div>
</div>
<?php echo $this->element('admin_navigation'); ?>

