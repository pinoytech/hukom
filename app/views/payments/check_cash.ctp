<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->Session->flash(); ?>

			<div class="form-title">Check/Cash Pick up</div>
			<div class="form-holder form-registration">
			    
			<p>
			    You have chosen to pay through Check/Cash Pick up, please fill-out ALL the fields below:
			</p>
			
			<?php echo $this->Form->create('Payment');?>
			<?php
				echo $this->Form->input('Payment.id');
				echo $this->Form->input('Payment.user_id', array('type' => 'hidden', 'value' => $id));
				echo $this->Form->input('Payment.case_id', array('type' => 'hidden','value' => $case_id));
				echo $this->Form->input('Payment.case_detail_id', array('type' => 'hidden','value' => $case_detail_id));
				echo $this->Form->input('Payment.option', array('type' => 'hidden','value' => 'Check/Cash Pick up'));

				echo $this->Form->input('Payment.check_cash_date_of_pick_up', array('type' => 'text', 'class' => 'required birth_date', 'label' => 'Date of Pick up'));
                echo $this->Form->input('Payment.check_cash_address', array('class' => 'required', 'style' => 'width:158px; height:100px;', 'label' => 'Address'));
				echo $this->Form->input('Payment.check_cash_contact_person', array('class' => 'required', 'label' => 'Contact Person'));
				echo $this->Form->input('Payment.telephone_no', array('class' => 'required digits', 'label' => 'Telephone No.'));
				echo $this->Form->input('Payment.cellphone_no', array('class' => 'required digits', 'label' => 'Cellphone No.'));
                // echo $this->Form->input('Payment.cellphone_no', array('class' => 'required', 'label' => 'Cellphone No.'));
			?>
			<?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>
            
                <br />
                <p>
    			    Please make all checks payments payable to Atty. Marlon Valderama
    			</p>
    			
				<br />
    			<table>
    				<tr>
    					<td>
    						<input type="button" id="back" class="button-back" value="" />
    					</td>
    					<td>
    						<input type="button" id="next" class="button-next" value="" />
    					</td>
    				</tr>
    			</table>
				
				<?php echo $this->Form->end();?>
			</div>

	</div>
</div>

<?php $html->scriptBlock("check_cash_form('$id', '$case_id', '$case_detail_id');", array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>
