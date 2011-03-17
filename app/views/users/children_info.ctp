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
						
		<?php echo $this->Session->flash(); ?>
		
		<?php //echo $this->Form->create('User', array('onsubmit' => 'validate_form(); return false;', 'name' => 'ChildrenInfoForm'));?>
		
			<div class="form-title">Children Information</div>
			<div class="form-holder form-personal-info">
				<?php echo $this->Form->create('User');?>
				<?php
					echo $this->Form->input('User.case_id', array('type' => 'hidden', 'value' => $case_id));
					
					echo $this->Form->input('ChildrenInfo.id');
					echo $this->Form->input('ChildrenInfo.user_id', array('type' => 'hidden', 'value' => $id));
					
					echo '<div class="row two-field">';
					echo $this->Form->input('ChildrenInfo.no_of_children', array('class' => 'no-of-children', 'readonly' => true));
					$options=array('with us' => 'with us', 'with you' => 'with you', 'with spouse' => 'with spouse', 'with relative' => ' with relative',); //, 'default' => $this->data['ChildrenInfo']['custody']
					echo $this->Form->input('ChildrenInfo.custody', array('type' => 'select', 'options'=>$options, 'class' => 'required', 'label' => 'Custody of Children', 'disabled' => true, 'empty' => 'Select'));
					echo '</div>';
				?>
				
				<br /><br />
				
				<div>
					<a id="add-child" class="form-link">Click here to add a child</a>
				</div>
				
				<br />
				
				<table cellpadding="5" cellspacing="0" id="child-list">
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
						<tr class="row">
							<td>
								<?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.user_id', array('type' => 'hidden', 'value' => $id));?>
								<?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.children_info_id', array('type' => 'hidden', 'value' => $this->data['ChildrenInfo']['id']));?>
								<?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.name', array('label' => '', 'value' => $ChildrenList['name'], 'class' => 'required'));?>
							</td>
							<td><?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.sex', array('label' => '', 'type' => 'select', 'selected' => $ChildrenList['sex'], 'options' => $list_gender, 'class' => 'children-input  required'));?></td>
							<td><?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.birth_date', array('type' => 'text', 'label' => '', 'value' => $ChildrenList['birth_date'], 'class' => 'birth_date required'));?></td>
							<td><?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.school', array('label' => '', 'value' => $ChildrenList['school'], 'class' => ' required'));?></td>
							<td><?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.grade_year', array('label' => '', 'value' => $ChildrenList['grade_year'], 'class' => ' required'));?></td>
							<td><a class="child-remove form-link-red">Remove</td>
						</tr>
					</tbody>
					<?php
					}
					?>
				</table>
				<?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>
				</form>		
		</div>
		<br />
		<table>
			<tr>
				<td>
					<input type="button" id="back" value="Back" />
				</td>
				<td>
					<input type="button" id="next" value="Next" />
				</td>
			</tr>
		</table>
		
	</div>
</div>

<table border="1" cellpadding="5" cellspacing="0" id="clone-row" class="hidden">
	<tr>
		<td class="row">
			<?php echo $this->Form->input('ChildrenList.xxx.user_id', array('type' => 'hidden', 'value' => $id));?>
			<?php echo $this->Form->input('ChildrenList.xxx.children_info_id', array('type' => 'hidden', 'value' => $this->data['ChildrenInfo']['id']));?>
			<?php echo $this->Form->input('ChildrenList.xxx.name', array('label' => '', 'class' => 'children-input required'));?>
		</td>
		<td><?php echo $this->Form->input('ChildrenList.xxx.sex', array('label' => '', 'type' => 'select', 'options' => $list_gender, 'class' => 'children-input  required'));?></td>
		<td><?php echo $this->Form->input('ChildrenList.xxx.birth_date', array('type' => 'text', 'label' => '', 'class' => 'birthdate  required'));?></td>
		<td><?php echo $this->Form->input('ChildrenList.xxx.school', array('label' => '', 'class' => 'children-input  required'));?></td>
		<td><?php echo $this->Form->input('ChildrenList.xxx.grade_year', array('label' => '', 'class' => 'children-input  required'));?></td>
		<td><a class="child-remove form-link-red">Remove</td>
	</tr>
</table>

<?php echo $html->script('form-hacks');?>

<script type="text/javascript">
jQuery('document').ready(function() {
	//Enable Custody
	if (jQuery('.no-of-children').val() > 0) {
		jQuery('#ChildrenInfoCustody').attr('disabled', false);
	}
	
	
	//Add children row to list
	jQuery('#add-child').live('click', function(e) {
		
		//Count no. of rows
		total_rows = jQuery('#child-list > tbody').size() - 1;
		// alert(total_rows);
		
		//Modify HTML
		component_render = jQuery('#clone-row').html();
		component_render = component_render.replace(/xxx/g, total_rows + 100);
		component_render = component_render.replace(/Xxx/g, total_rows + 100);

		jQuery('#child-list')
	    // .hide()
	    .append(component_render).find("tr:last").find(".birthdate").datepicker({
		    dateFormat: 'yy-mm-dd',
		    changeMonth: true,
		    changeYear: true,
		    yearRange: '1900:2011',
		  })
	    // .fadeIn();
		
		if (jQuery('.no-of-children').val()) {
			no_of_children = jQuery('.no-of-children').val();
		}
		else {
			no_of_children = 0;
		}
		
		//Assign no. of children
		jQuery('.no-of-children').val(parseInt(no_of_children) + 1);
		
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
			
			//Assign no. of children
			jQuery('.no-of-children').val(jQuery('.no-of-children').val() - 1);
			
			//Disable Custody
			if (jQuery('.no-of-children').val() < 1) {
				jQuery('#ChildrenInfoCustody').attr('disabled', true);
				jQuery('#ChildrenInfoCustody').val('empty');
			}
        }
        else{
            return false;
        }
	});
	
	//jQuery Valdidate
	jQuery("#UserChildrenInfoForm").validate({
		messages: {
			
		}
	});
	
	jQuery.extend(jQuery.validator.messages, {
	    required: "Required",
	});
	
	//Submit button logic
	jQuery('#back').click(function() {
		jQuery('#goto').val('personal_info');
		jQuery('form').submit();
	});
	
	jQuery('#next').click(function() {
		jQuery('#goto').val('legal_problem');
		jQuery('form').submit();
	});
	
});

</script>