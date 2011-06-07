<link href="/uploadify/uploadify.css" type="text/css" rel="stylesheet" />

<div id="full-content">
	<div id="main">
		<?php echo $this->element('navigation');?>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Form->create('User');?>
			<div class="form-title">Corporate/Partnership Information</div>
			<div class="form-holder form-personal-info">
				<?php
				echo $this->Form->input('User.id');
				echo $this->Form->input('User.case_id', array('type' => 'hidden', 'value' => $case_id));
				echo $this->Form->input('User.case_detail_id', array('type' => 'hidden', 'value' => $case_detail_id));
				echo $this->Form->input('CorporatePartnershipInfo.id');
				echo $this->Form->input('CorporatePartnershipInfo.user_id', array('type' => 'hidden', 'value' => $this->data['User']['id']));
				
				echo '<div class="row full-field">';
				echo $this->Form->input('CorporatePartnershipInfo.company_name', array('label' => 'Company/Partnership Name', 'class' => 'required'));
                // echo $this->Form->input('CorporatePartnershipInfo.type', array('label' => 'Type', 'type' => 'select', 'empty' => 'Select', 'class' => 'required', 'options' => $custom->list_corporation_type()));
				echo '</div>';
				
				echo '<div class="row full-field center-corp-type">';
				foreach ($custom->list_corporation_type() as $key => $value) {
				    $checked = ($value == $this->data['CorporatePartnershipInfo']['type']) ? 'checked' : '';
                    echo '<input type="radio" class="type" value="'.$value.'" name="data[CorporatePartnershipInfo][type]" '.$checked.' > '.$value.' ';
				}
				echo '</div>';
				
				echo '
				<div style="display:block;padding:4px 0 0 315px;">
					<label for="data[CorporatePartnershipInfo][type]" class="error" style="display:none">This field is required</label> 
				</div>';
				
				echo '<div class="row full-field">';
				echo $this->Form->input('CorporatePartnershipInfo.principal_office_address', array('class' => 'required'));
				echo '</div>';
				
				echo '<div class="row full-field">';
                echo $this->Form->input('CorporatePartnershipInfo.business_address', array('class' => 'required'));
				echo '</div>';
				
				echo '<div class="row full-field">';
                echo $this->Form->input('CorporatePartnershipInfo.line_of_business', array('label' => 'Line of Business', 'class' => 'required'));
				echo '</div>';
				
				echo '<div class="row full-field center-attach-fill-out">';
				
                $checked_attach   = '';
                $checked_fill_out = '';
				
			    if ('attach' == $this->data['CorporatePartnershipInfo']['attach_fill_out']) {
                    $checked_attach   = 'checked';
                    $checked_fill_out = '';
			    }
			    elseif ('fill out' == $this->data['CorporatePartnershipInfo']['attach_fill_out']) {
			        $checked_fill_out = 'checked';
			        $checked_attach   = '';
			    }
				echo '<input type="radio" class="attach_fill_out" value="attach" name="data[CorporatePartnershipInfo][attach_fill_out]" '.$checked_attach.'>*Attach the following documents
				      <input type="radio" id="fill-out-radio" class="attach_fill_out" value="fill out" name="data[CorporatePartnershipInfo][attach_fill_out]" '.$checked_fill_out.'>*Fill out the forms';
				echo '</div>';
				
				echo '
				<div style="display:block;padding:4px 0 0 315px;">
					<label for="data[CorporatePartnershipInfo][attach_fill_out]" class="error" style="display:none">This field is required</label> 
				</div>';
				?>
				
			    <div id="attach-form" class="row full-field" style="display:none">
					The following documents are required, otherwise you can fill out the forms.
					<br />
			        <ul>
			            <li>Scanned Articles of Incorporation and By-Laws</li>
			            <li>Articles of Partnership</li>
			            <li>Updated SEC General Information Sheet</li>
			        </ul>
			        
			        <div id="attach-form-file-upload-holder">
        				<input id="file_upload" name="file_upload" type="file" />
        				<p>Select a file (jpeg, pdf, word) on your computer (2MB max).</p>
        				<label id="file-upload-validate-style" for="file-upload-validate" class="error" style="display:none">Files are required to be uploaded</label> 
        				<ul id="file-list">    
        				    <?php
        					foreach ($files as $key => $value) {
        						echo '<li class="actions"><a href="' . $upload_folder . '/' . $value . '" target="_blank">' . $value . '</a>' . ' <a class="remove_file" id="' . $upload_folder . '/' . $value . '">Remove</a></li>';
        					}
        					$files_validate_value = '';
        					if ($files) {
        					    $files_validate_value = 1;
        					}
        					?>
        				</ul>
        				<input type="hidden" id="file-upload-validate" class="required" value="<?php echo $files_validate_value;?>" disabled>
                        
        			</div>
			    </div>
			    
			    <!-- Fill Out Form -->
			    <div id="fill-out-form" style="display:none">
				    <?php
				    echo '<div class="row two-field">';
                    echo $this->Form->input('CorporatePartnershipInfo.authorized_capital_stock_partnership_capital', array('label' => 'Authorized Capital Stock/Partnership Capital', 'class' => 'required'));
                    echo $this->Form->input('CorporatePartnershipInfo.no_of_shares', array('label' => 'No. of Shares','class' => 'required'));
					echo '</div>';
					
					echo '<div class="row three-field">';
                    echo $this->Form->input('CorporatePartnershipInfo.par_value', array('class' => 'required'));
                    echo $this->Form->input('CorporatePartnershipInfo.no_of_shares_subscribed', array('label' => 'No. of Share/s Subscribed', 'class' => 'required'));
                    echo $this->Form->input('CorporatePartnershipInfo.subscribed_capital', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row three-field">';
                    echo $this->Form->input('CorporatePartnershipInfo.paid_up_capital', array('class' => 'required'));
                    echo $this->Form->input('CorporatePartnershipInfo.fiscal_calendar_year', array('label' => 'Fiscal/Calendar Year', 'class' => 'required'));
                    echo $this->Form->input('CorporatePartnershipInfo.annual_meeting', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row three-field">';
                    echo $this->Form->input('CorporatePartnershipInfo.president', array('class' => 'required'));
                    echo $this->Form->input('CorporatePartnershipInfo.treasurer', array('class' => 'required'));
                    echo $this->Form->input('CorporatePartnershipInfo.secretary', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row two-field">';
                    echo $this->Form->input('CorporatePartnershipInfo.general_manager', array('class' => 'required'));
                    echo $this->Form->input('CorporatePartnershipInfo.managing_partners', array('label' => 'Managing Partners <br />(If Partnership)','class' => 'required', 'style' => 'width:235px;height:50px;'));
					echo '</div>';
					
					echo '<div class="row full-field">';
					
				    ?>
				    <div style="margin-left:250px;"><label>Board of Directors/Trustees/Partners</label></div>
                    <br />
                    <div>
    					<a id="add-board" class="form-link add-button"><img src="/img/Addbutton_up.png" border="0" /></a>
    				</div>

    				<br />
    				<br />

    				<table cellpadding="5" cellspacing="0" id="board-list" style="width:98%">
    					<tbody>
    					<tr>
    						<td>Name</td>
    						<td>Nationality</td>
    						<td>Address</td>
    						<td>Actions</td>
    					</tr>
    					</tbody>
    					<?php
    					foreach ($this->data['BoardOfDirector'] as $BoardOfDirector) {
    					?>
    					<tbody>
    						<tr class="row">
    							<td>
    								<?php echo $this->Form->input('BoardOfDirector.' .$BoardOfDirector['id']. '.user_id', array('type' => 'hidden', 'value' => $id));?>
    								<?php echo $this->Form->input('BoardOfDirector.' .$BoardOfDirector['id']. '.corporate_partnership_info_id', array('type' => 'hidden', 'value' => $BoardOfDirector['corporate_partnership_info_id']));?>
    								<?php echo $this->Form->input('BoardOfDirector.' .$BoardOfDirector['id']. '.name', array('label' => '', 'value' => $BoardOfDirector['name'], 'class' => 'required'));?>
    							</td>
    							<td><?php echo $this->Form->input('BoardOfDirector.' .$BoardOfDirector['id']. '.nationality', array('type' => 'text', 'label' => '', 'value' => $BoardOfDirector['nationality'], 'class' => 'required'));?></td>
    							<td><?php echo $this->Form->input('BoardOfDirector.' .$BoardOfDirector['id']. '.address', array('type' => 'text', 'label' => '', 'value' => $BoardOfDirector['address'], 'class' => ' required'));?></td>
    							<td><a class="board-remove form-link-red remove-button"><img src="/img/removeButton_up.png" border="0" /></a></td>
    							    
    						</tr>
    					</tbody>
    					<?php
    					}
    					?>
    				</table>

				    <?php
					echo '</div>';

					echo '<div class="row full-field">';

				    ?>
				    <div style="margin-left:270px;"><label>Stockholders/Trustees/Partners</label></div>

				    <br /><br />

				    <?php
				    echo '<span class="center-stock-type">';
					foreach ($custom->list_stockholder_type() as $key => $value) {
					    $checked = ($value == $this->data['CorporatePartnershipInfo']['stockholder_type']) ? 'checked' : '';
                        echo '<input type="radio" class="stockholder_type" value="'.$value.'" name="data[CorporatePartnershipInfo][stockholder_type]" '.$checked.' > '.$value.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					}
					echo '
					    <div class="row full-field center-attach-fill-out-em"><em>Top 10 Majority Stockholders &nbsp;&nbsp;&nbsp;&nbsp; Limited to 20-30 Stockholders</em></div>
					</span>';
				    ?>
				    
				    <label for="stockholder_type" class="error" style="display:none">Please select one</label>
				    
                    <br />
                    <div style="padding-bottom:8px;">
    					<a id="add-stock" class="form-link add-button"><img src="/img/Addbutton_up.png" border="0" /></a>
    				</div>

    				<table cellpadding="5" cellspacing="0" id="stock-list" style="width:98%">
    					<tr>
    						<td>Name</td>
    						<td>Nationality</td>
    						<td>No. of Share/Contribution</td>
    						<td>Subscribed Capital</td>
    						<td>Paid-up Capital</td>
    						<td>Actions</td>
    					</tr>
    					</tbody>
    					<?php
    					foreach ($this->data['Stockholder'] as $Stockholder) {
    					?>
    					<tbody>
    						<tr class="row">
    							<td>
    								<?php echo $this->Form->input('Stockholder.' .$Stockholder['id']. '.user_id', array('type' => 'hidden', 'value' => $id));?>
    								<?php echo $this->Form->input('Stockholder.' .$Stockholder['id']. '.corporate_partnership_info_id', array('type' => 'hidden', 'value' => $Stockholder['corporate_partnership_info_id']));?>
    								<?php echo $this->Form->input('Stockholder.' .$Stockholder['id']. '.name', array('label' => '', 'value' => $Stockholder['name'], 'class' => 'required'));?>
    							</td>
    							<td><?php echo $this->Form->input('Stockholder.' .$Stockholder['id']. '.nationality', array('label' => '', 'value' => $Stockholder['nationality'], 'class' => 'required'));?></td>
    							<td><?php echo $this->Form->input('Stockholder.' .$Stockholder['id']. '.no_of_share', array('label' => '', 'value' => $Stockholder['no_of_share'], 'class' => 'required'));?></td>
    							<td><?php echo $this->Form->input('Stockholder.' .$Stockholder['id']. '.subscribed_capital', array('label' => '', 'value' => $Stockholder['subscribed_capital'], 'class' => 'required'));?></td>
    							<td><?php echo $this->Form->input('Stockholder.' .$Stockholder['id']. '.paid_up_capital', array('label' => '', 'value' => $Stockholder['paid_up_capital'], 'class' => 'required'));?></td>
    							<td><a class="stock-remove form-link-red remove-button"><img src="/img/removeButton_up.png" border="0" /></a></td>
    						</tr>
    					</tbody>
    					<?php
    					}
    					?>
    				</table>
                    
				    <?php
					echo '</div>';
				    ?>
			    </div>
			    <?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>
			</div>
			<div class="form-holder">	
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

<table border="1" cellpadding="5" cellspacing="0" id="clone-board" class="hidden">
    <tr class="row">
		<td>
			<?php echo $this->Form->input('BoardOfDirector.xxx.user_id', array('type' => 'hidden', 'value' => $id));?>
			<?php echo $this->Form->input('BoardOfDirector.xxx.name', array('label' => '', 'class' => 'required'));?>
		</td>
		<td><?php echo $this->Form->input('BoardOfDirector.xxx.nationality', array('type' => 'text', 'label' => '', 'class' => 'required'));?></td>
		<td><?php echo $this->Form->input('BoardOfDirector.xxx.address', array('type' => 'text', 'label' => '', 'class' => ' required'));?></td>
		<td><a class="board-remove form-link-red remove-button"><img src="/img/removeButton_up.png" border="0" /></a></td>
	</tr>
</table>

<table border="1" cellpadding="5" cellspacing="0" id="clone-stock" class="hidden">
    <tr class="row">
		<td>
			<?php echo $this->Form->input('Stockholder.xxx.user_id', array('type' => 'hidden', 'value' => $id));?>
			<?php echo $this->Form->input('Stockholder.xxx.name', array('label' => '', 'class' => 'required'));?>
		</td>
		<td><?php echo $this->Form->input('Stockholder.xxx.nationality', array('type' => 'text', 'label' => '', 'class' => 'required'));?></td>
		<td><?php echo $this->Form->input('Stockholder.xxx.no_of_share', array('type' => 'text', 'label' => '', 'class' => 'required'));?></td>
		<td><?php echo $this->Form->input('Stockholder.xxx.subscribed_capital', array('type' => 'text', 'label' => '', 'class' => 'required'));?></td>
		<td><?php echo $this->Form->input('Stockholder.xxx.paid_up_capital', array('type' => 'text', 'label' => '', 'class' => 'required'));?></td>
		<td><a class="stock-remove form-link-red remove-button"><img src="/img/removeButton_up.png" border="0" /></a></td>
	</tr>
</table>

<?php echo $html->script('/uploadify/swfobject.js', array('inline'=>false));?>
<?php echo $html->script('/uploadify/jquery.uploadify.v2.1.4.min.js', array('inline'=>false));?>
<?php $html->scriptBlock("corporate_partnership_info('$id', '$case_id', '$upload_folder');", array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>