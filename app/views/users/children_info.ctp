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
					echo $this->Form->input('User.case_detail_id', array('type' => 'hidden', 'value' => $case_detail_id));
					
					echo $this->Form->input('ChildrenInfo.id');
					echo $this->Form->input('ChildrenInfo.user_id', array('type' => 'hidden', 'value' => $id));
					
					
					echo '<div class="row two-field">';
					echo $this->Form->input('ChildrenInfo.no_of_children', array('class' => 'no-of-children', 'readonly' => true, 'label' => 'No. of Children'));
					$options=array('with us' => 'with us', 'with you' => 'with you', 'with spouse' => 'with spouse', 'with relative' => ' with relative',); //, 'default' => $this->data['ChildrenInfo']['custody']
					echo $this->Form->input('ChildrenInfo.custody', array('type' => 'select', 'options'=>$options, 'class' => 'required', 'label' => 'Custody of Children', 'disabled' => true, 'empty' => 'Select'));
					echo '</div>';
				?>
				
				<br /><br />
				
				<div>
					<a id="add-child" class="form-link"><img src="/img/addchildButton_up.png" border="0" class="add-child-button"></a>
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
							<td><?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.sex', array('label' => '', 'type' => 'select', 'selected' => $ChildrenList['sex'], 'options' => $custom->list_gender(), 'class' => 'children-input  required'));?></td>
							<td><?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.birth_date', array('type' => 'text', 'label' => '', 'value' => $ChildrenList['birth_date'], 'class' => 'birth_date required'));?></td>
							<td><?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.school', array('label' => '', 'value' => $ChildrenList['school'], 'class' => ' required'));?></td>
							<td><?php echo $this->Form->input('ChildrenList.' .$ChildrenList['id']. '.grade_year', array('label' => '', 'value' => $ChildrenList['grade_year'], 'class' => ' required'));?></td>
							<td><a class="child-remove form-link-red"><img src="/img/removeButton_up.png" border="0" /></td>
						</tr>
					</tbody>
					<?php
					}
					?>
				</table>
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

<table border="1" cellpadding="5" cellspacing="0" id="clone-row" class="hidden">
	<tr>
		<td class="row">
			<?php echo $this->Form->input('ChildrenList.xxx.user_id', array('type' => 'hidden', 'value' => $id));?>
			<?php echo $this->Form->input('ChildrenList.xxx.children_info_id', array('type' => 'hidden', 'value' => $this->data['ChildrenInfo']['id']));?>
			<?php echo $this->Form->input('ChildrenList.xxx.name', array('label' => '', 'class' => 'children-input required'));?>
		</td>
		<td><?php echo $this->Form->input('ChildrenList.xxx.sex', array('label' => '', 'type' => 'select', 'options' => $custom->list_gender(), 'class' => 'children-input  required'));?></td>
		<td><?php echo $this->Form->input('ChildrenList.xxx.birth_date', array('type' => 'text', 'label' => '', 'class' => 'birthdate  required'));?></td>
		<td><?php echo $this->Form->input('ChildrenList.xxx.school', array('label' => '', 'class' => 'children-input  required'));?></td>
		<td><?php echo $this->Form->input('ChildrenList.xxx.grade_year', array('label' => '', 'class' => 'children-input  required'));?></td>
		<td><a class="child-remove form-link-red"><img src="/img/removeButton_up.png" border="0" /></td>
	</tr>
</table>

<?php $html->scriptBlock("children_info_form()", array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>