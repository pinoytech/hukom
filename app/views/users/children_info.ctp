<script type="text/javascript">
jQuery('document').ready(function() {
	//Enable Custody
	if (jQuery('.no-of-children').val() > 0) {
		jQuery('#ChildrenInfoCustody').attr('disabled', false);
	}
	
	//Remove Asterisks
	jQuery('.remove-asterisk').each(function(index) {
			var parent_div      = jQuery(this).parent().parent();
			var parent_fieldset = jQuery(this).parent();
			// console.log(parent_fieldset.children('legend'));
			parent_div.removeClass('required');
			parent_fieldset.children('legend').addClass('put-asterisk');
	
	});

	//Put astrerisks
	jQuery('.put-asterisk').each(function(index) {
		jQuery(this).append('<span class="red-asterisks">*</span>').css({'color' : '#444444', 'font-weight' : 'bold'});
	});
	
	//Add children row to list
	jQuery('#add-child').click(function() {
		
		//Count no. of rows
		total_rows = jQuery('#child-list > tbody').size() - 1;
		
		//Modify HTML
		component_render = jQuery('#clone-row').html();
	    component_render = component_render.replace(/xxx/g, total_rows + 100);
	    component_render = component_render.replace(/Xxx/g, total_rows + 100);
			
		jQuery('#child-list')
	    .hide()
	    .append(component_render)
	    .fadeIn();
		
		//Assign no. of children
		jQuery('.no-of-children').val(total_rows + 1);
		
		//Enable Custody
		if (jQuery('.no-of-children').val() > 0) {
			jQuery('#ChildrenInfoCustody').attr('disabled', false);
		}
	
	});		
	
	//Remove Children from list
	jQuery('.child-remove').live('click', function(e) {
		var agree=confirm("Do you want to remove this item?");
        if (agree){                        
            var parentrow = $(this).parents('tr');
            e.preventDefault();
			parentrow.empty();
            parentrow.fadeOut();
			
			//Count no. of rows
			total_rows = jQuery('#child-list > tbody').size() - 1;
			
			//Assign no. of children
			jQuery('.no-of-children').val(total_rows - 1);
			
			//Disable Custody
			if (jQuery('.no-of-children').val() < 1) {
				// jQuery('#ChildrenInfoCustody').attr('disabled', true);
				jQuery('#ChildrenInfoCustody').val('empty');
			}
        }
        else{
            return false;
        }
	});
});

//Validate Form
function validate_form() {
	jQuery("#children-list-alert, #custody-alert").dialog({
		autoOpen: false,
		width: 300,
		height: 200,
        modal: true,
		resizable: false,
        buttons: {
            'OK': function() {
				jQuery(this).dialog('close');
            	// document.forms['ChildrenInfoForm'].submit();
			},
        }
	}); 
	
	
	var submit_form = true;
	
	if (jQuery('.no-of-children').val() > 0) {
		jQuery('#child-list .children-input').each(function(index) {
			if(jQuery(this).val() == '') {
				jQuery("#children-list-alert").dialog("open");
				
				submit_form = false;
				
				return false;
			}
		});
		
		if(jQuery('#ChildrenInfoCustody').val() == 'empty') {
			jQuery("#custody-alert").dialog("open");
			
			submit_form = false;
			
			return false;
		}
	}
	
	if (submit_form) {
		jQuery('#clone-row').empty();
		form.submit();
	};

	
	/*
	if(jQuery('#ChildrenInfoNoOfChildren').val() != '') {
		form.submit();
	}
	else {
		jQuery("#validate-alert").dialog("open");
	}
	*/
}
</script>

<div id="children-list-alert" class="hidden" title="Children's Information Alert">
	<p style="padding-top:20px; text-align:center;">
		Children's Information is not yet complete.
	</p>
</div>

<div id="custody-alert" class="hidden" title="Children's Custody Alert">
	<p style="padding-top:20px; text-align:center;">
		Please select Custody of Children.
	</p>
</div>

<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->element('profile_navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('User', array('onsubmit' => 'validate_form(); return false;', 'name' => 'ChildrenInfoForm'));?>
			<fieldset>
		 		<legend><?php __('Children Information'); ?></legend>
				<?php
					// echo $this->Form->input('User.id');
					echo $this->Form->input('ChildrenInfo.id');
					echo $this->Form->input('ChildrenInfo.user_id', array('type' => 'hidden', 'value' => $id));
					echo $this->Form->input('ChildrenInfo.no_of_children', array('class' => 'no-of-children', 'readonly' => true));
					$options=array('empty' => 'Select', 'with us' => 'with us', 'with you' => 'with you', 'with spouse' => 'with spouse', 'with relative' => ' with relative',); //, 'default' => $this->data['ChildrenInfo']['custody']
					echo $this->Form->input('ChildrenInfo.custody', array('type' => 'select', 'options'=>$options, 'class' => 'remove-asterisk', 'label' => 'Custody of Children', 'disabled' => true));
					// echo $this->Form->input('ChildrenInfo.custody', array('type' => 'radio', 'options'=>$options, 'class' => 'remove-asterisk', 'legend' => 'Custody of Children'));
				?>
				
				<div>
					<a id="add-child">Click here to add child</a>
				</div>
				
				<table border="1" cellpadding="5" cellspacing="0" id="child-list">
					<tbody>
					<tr>
						<td>Name</td>
						<td>Sex</td>
						<td>Date of Birth</td>
						<td>School</td>
						<td>Grade/Year</td>
						<td>Actions</td>
					</tr>
					</tbody>
					<?php
					foreach ($this->data['ChildrenList'] as $ChildrenList) {
					?>
					<tbody>
						<tr>
							<td>
								<?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.user_id', array('type' => 'hidden', 'value' => $id));?>
								<?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.children_info_id', array('type' => 'hidden', 'value' => $this->data['ChildrenInfo']['id']));?>
								<?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.name', array('label' => '', 'value' => $ChildrenList['name']));?>
							</td>
							<td><?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.sex', array('label' => '', 'type' => 'select', 'options' => array('male' => 'Male', 'female' => 'Female'), 'selected' => $ChildrenList['sex']));?></td>
							<td><?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.birth_date', array('label' => '', 'value' => $ChildrenList['birth_date'], 'minYear' => '1900', 'maxYear' => date('Y'), 'empty' => 'Select'));?></td>
							<td><?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.school', array('label' => '', 'value' => $ChildrenList['school']));?></td>
							<td><?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.grade_year', array('label' => '', 'value' => $ChildrenList['grade_year']));?></td>
							<td><a class="child-remove">Remove</td>
						</tr>
					</tbody>
					<?php
					}
					?>
				</table>
				
			</fieldset>
		
		<table>
			<tr>
				<td>
					<?php
					if ($this->data['PersonalInfo']['civil_status'] == 'single') {
						echo $this->Html->link(__('Back', true), array('action' => 'personal_info', $this->data['User']['id']));
					}
					else {
						echo $this->Html->link(__('Back', true), array('action' => 'spouse_info', $this->data['User']['id']));
					}
					?>
				</td>
				<td>
					<?php echo $this->Form->end(__('Next', true));?>
				</td>
			</tr>
		</table>
		
		<table border="1" cellpadding="5" cellspacing="0" id="clone-row" class="hidden">
			<tr>
				<td>
					<?php echo $this->Form->input('ChildrenList.xxx.user_id', array('type' => 'hidden', 'value' => $id));?>
					<?php echo $this->Form->input('ChildrenList.xxx.children_info_id', array('type' => 'hidden', 'value' => $this->data['ChildrenInfo']['id']));?>
					<?php echo $this->Form->input('ChildrenList.xxx.name', array('label' => '', 'class' => 'children-input'));?>
				</td>
				<td><?php echo $this->Form->input('ChildrenList.xxx.sex', array('label' => '', 'type' => 'select', 'options' => array('male' => 'Male', 'female' => 'Female'), 'class' => 'children-input'));?></td>
				<td><?php echo $this->Form->input('ChildrenList.xxx.birth_date', array('label' => '', 'minYear' => '1900', 'maxYear' => date('Y'), 'empty' => 'Select', 'class' => 'children-input'));?></td>
				<td><?php echo $this->Form->input('ChildrenList.xxx.school', array('label' => '', 'class' => 'children-input'));?></td>
				<td><?php echo $this->Form->input('ChildrenList.xxx.grade_year', array('label' => '', 'class' => 'children-input'));?></td>
				<td><a class="child-remove">Remove</td>
			</tr>
		</table>
		
	</div>
</div>