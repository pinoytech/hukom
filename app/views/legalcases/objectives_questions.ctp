<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('Legalcase');?>
		
		<?php
		echo $this->Form->input('Legalcasedetail.id', array('type' => 'hidden'));
		echo $this->Form->input('Legalcasedetail.case_id', array('type' => 'hidden', 'value' => $case_id));
		echo $this->Form->input('Legalcasedetail.user_id', array('type' => 'hidden', 'value' => $id));
		?>
		
		<div class="form-title"><?php echo ($auth_user_type == 'personal') ? 'My' : 'Our'; ?> Objectives/Ang Mga Gusto <?php echo ($auth_user_type == 'personal') ? 'ko' : 'namin'; ?>:</div>
		<div class="form-holder">
			<?php
			echo $this->Form->textarea('Legalcasedetail.objectives', array('label' => false, 'class' => 'required'));
			?>
			<div>
				<em>*You can prepare your list of objectives in Microsoft Word then copy and paste in this text area.</em>
			</div>
		</div>
		
		<div class="form-title"><?php echo ($auth_user_type == 'personal') ? 'My' : 'Our'; ?> Questions/Ang (mga) Tanong <?php echo ($auth_user_type == 'personal') ? 'ko' : 'namin'; ?>:</div>
		<div class="form-holder">
		<?php
		echo $this->Form->textarea('Legalcasedetail.questions', array('label' => false, 'class' => 'required'));
		?>
			<div>
				<em>*You can prepare your list of questions from Microsoft Word then copy and paste to this text area.</em>
			</div>
			
		    <?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>

    		<br />
            <table>
    			<tr>
    				<td>
    					<input type="submit" id="back" class="button-back" value="" />
    				</td>
    				<td>
    					<input type="submit" id="next" class="button-next" value="" />
    				</td>
    			</tr>
    		</table>
    		
		</div>	
	
		<?php echo $this->Form->end();?>
	</div>
</div>

<?php $html->scriptBlock("objectives_questions_form('$id', '$case_id', '$case_detail_id');", array('inline'=>false));?>
