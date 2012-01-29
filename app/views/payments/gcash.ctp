<link href="/uploadify/uploadify.css" type="text/css" rel="stylesheet" />

<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->Session->flash(); ?>

			<div class="form-title">Globe GCash</div>
		<div class="form-holder form-registration">
			
			<?php echo eval('?>' . SiteCopy::body('gcash_form') . '<?php '); ?>
		    
			<?php echo $this->Form->create('Payment');?>
			<?php
				echo $this->Form->input('Payment.id');
				echo $this->Form->input('Payment.user_id', array('type' => 'hidden', 'value' => $id));
				echo $this->Form->input('Payment.case_id', array('type' => 'hidden','value' => $case_id));
				echo $this->Form->input('Payment.case_detail_id', array('type' => 'hidden','value' => $case_detail_id));
				echo $this->Form->input('Payment.option', array('type' => 'hidden','value' => 'GCash'));
			
				$options=array('GCash Mobile'=>'GCash Mobile','GCash Online'=>'GCash Online','GCash Remit'=>'GCash Remit');
				echo $this->Form->input('Payment.gcash_type', array('type' => 'select', 'options'=>$options, 'label' => 'Choose Type of GCash', 'empty' => 'Select', 'class' => 'required'));
				echo $this->Form->input('Payment.cellphone_no', array('class' => 'required digits'));
				echo $this->Form->input('Payment.reference_no', array('class' => 'required'));
				echo $this->Form->input('Payment.amount', array('class' => 'required'));
			?>	
			<?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>
		
			<br />
			<table>
				<tr>
					<td>
						<input type="button" id="back" class="button-back" value="" />
					</td>
					<td>
						<input type="submit" id="next" class="button-next" value="" />
					</td>
				</tr>
			</table>
		
            <?php echo $this->Form->end();?>
		</div>
	</div>
</div>

<div id="discard_data" style="display:none; text-align:center">
    Data you provided on this form will be discarded. Do you want to continue?
</div>

<?php $html->scriptBlock("gcash_form('$id', '$case_id', '$case_detail_id');", array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>
