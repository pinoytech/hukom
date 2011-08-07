<div id="full-content">
	<div id="main">

		<?php echo $this->element('navigation');?>

		<?php echo $this->Session->flash(); ?>

		<div class="form-title">Client's Letter of Intent</div>
		<div class="form-holder">

		        <?php				
                if ($auth_user_type == 'personal') {
                    $profile_action = 'personal_info';
                }
                elseif ($auth_user_type == 'corporation') {
                    $profile_action = 'corporate_partnership_representative_info';
                }

                echo $this->Form->create('Legalcase');
				echo $this->Form->input('Legalcase.user_id', array('type' => 'hidden', 'value' => $id));				
				echo $this->Form->input('Legalcase.case_id', array('type' => 'hidden', 'value' => $case_id));				
				?>
				<p>
					<?php echo date('F d, Y');?>
				</p>

				<p>
					I, <b><?php echo $user_full_name;?></b>, with registered e-mail address of <b><?php echo $email;?></b>, of legal age, of which I am a:
					
					<div>
					    <input type="radio" class="client_type" value="new" name="data[Legalcase][client_type]"><span class="label">New client</span> - (those who are newly registered and have not completed fill-up forms)
    					<br />
    					<input type="radio" class="client_type" value="old" name="data[Legalcase][client_type]"><span class="label">Old client</span> - (those who are already registered and filled-up forms)
    					
    					<div style="display:block;padding-left:300px;">
        					<label for="data[Legalcase][client_type]" class="error" style="display:none">Please select client type</label> 
        				</div>
        				<br />
					</div>			
					
				</p>
				
				<p>
				    hereby intends to obtain from E-Lawyers Online your service for handling my:
				    
				    <div>
					    <input type="radio" class="handle_type" value="case" name="data[Legalcase][handle_type]"><span class="label">Case</span> - (those which are not yet filed in court or in government agencies or project not yet started)
					        <div id="case_container">
					            <input type="radio" class="case_type" value="new" name="data[Legalcase][case_project_type]"><span class="label">New Case</span> - (those which are not yet filed in court or in government agencies or project not yet started)
					                <div id="new_case_old">
					                    <b>Is the "New Case" previously submitted to E-Lawyers Online for Consultation?</b><br /><br />
					                    <input type="radio" class="new_case_old_type" name="data[Legalcase][new_pending_type]" value="yes">YES <input type="radio" class="new_case_old_type" name="data[Legalcase][new_pending_type]" value="no">NO
					                    <div id="new_case_old_type_yes">
					                        Case ID: <select name="data[Legalcase][mother_case_id]">
					                        <?php
					                        foreach ($case_id_list as $key => $value) {
					                        ?>
					                            <option value="<?php echo $key ;?>"><?php echo $value ;?></option>
					                        <?php
					                        }
					                        ?>
					                        </select>
					                    </div>
					                    
					                    <div style="display:block;padding-left:100px;">
                        					<label for="data[Legalcase][new_pending_type]" class="error" style="display:none">Please select yes or no</label> 
                        				</div>
					                    
					                </div>
					            <br />
					            <input type="radio" class="case_type" value="pending" name="data[Legalcase][case_project_type]"><span class="label">Pending Case</span> - (those which are already filed in court or government agencies or project already started)
					                <div id="pending_case_new">
					                    *Case Title: <input type="text" name="data[Legalcase][case_title]" class="required">
					                    <br />
					                    *Case Number: <input type="text" name="data[Legalcase][case_no]" class="required">
					                    <br />
					                    *Agency or Court Filed: <input type="text" name="data[Legalcase][court_filed]" class="required">
					                    <br />
					                    Branch Number: <input type="text" name="data[Legalcase][branch_no]">
					                </div>
					                
					                <div id="pending_case_old">
					                    <b>Is the "Pending Case" previously submitted to E-Lawyers Online for Consultation?</b><br /><br />
					                    <input type="radio" class="pending_case_old_type" name="data[Legalcase][new_pending_type]" value="yes">YES <input type="radio" class="pending_case_old_type" name="data[Legalcase][new_pending_type]" value="no">NO
					                    <div id="pending_case_old_type_yes">
					                        Case ID: <select name="data[Legalcase][mother_case_id]">
					                            <?php
    					                        foreach ($case_id_list as $key => $value) {
    					                        ?>
    					                            <option value="<?php echo $key ;?>"><?php echo $value ;?></option>
    					                        <?php
    					                        }
    					                        ?>
					                        </select>
					                    </div>
					                    <div id="pending_case_old_type_no">
    					                    *Case Title: <input type="text" name="data[Legalcase][case_title]" class="required">
    					                    <br />
    					                    *Case Number: <input type="text" name="data[Legalcase][case_no]" class="required">
    					                    <br />
    					                    *Agency or Court Filed: <input type="text" name="data[Legalcase][court_filed]" class="required">
    					                    <br />
    					                    Branch Number: <input type="text" name="data[Legalcase][branch_no]">
					                    </div> 
					                    
					                    <div style="display:block;padding-left:100px;">
                        					<label for="data[Legalcase][new_pending_type]" class="error" style="display:none">Please select yes or no</label> 
                        				</div>
					                    
					                </div>      
					                        
				                <div style="display:block;padding-left:300px;">
                					<label for="data[Legalcase][case_project_type]" class="error" style="display:none">Please select case type</label> 
                				</div>
					            
					        </div>
    					<br />
    					<input type="radio" class="handle_type" value="project" name="data[Legalcase][handle_type]"><span class="label">Project</span> - (those which are already filed in court or government agencies or project already started)
    					    <div id="project_container">
					            <input type="radio" class="project_type" value="new" name="data[Legalcase][case_project_type]"><span class="label">New Project</span> - (those which are not yet filed in court or in government agencies or project not yet started)
					            <div id="new_project_old">
					                <b>Is the "New Project" previously submitted to E-Lawyers Online for Consultation?</b><br /><br />
				                    <input type="radio" class="new_project_old_type" name="data[Legalcase][new_pending_type]" value="yes">YES <input type="radio" class="new_project_old_type" name="data[Legalcase][new_pending_type]" value="no">NO
				                    <div id="new_project_old_type_yes">
				                        Case ID: <select name="data[Legalcase][mother_case_id]">
				                            <?php
					                        foreach ($case_id_list as $key => $value) {
					                        ?>
					                            <option value="<?php echo $key ;?>"><?php echo $value ;?></option>
					                        <?php
					                        }
					                        ?>
				                        </select>
				                    </div>
				                    
				                    <div style="display:block;padding-left:100px;">
                    					<label for="data[Legalcase][new_pending_type]" class="error" style="display:none">Please select yes or no</label> 
                    				</div>
				                    
				                </div>
					            <br />
					            <input type="radio" class="project_type" value="pending" name="data[Legalcase][case_project_type]"><span class="label">Pending Project</span> - (those which are already filed in court or government agencies or project already started)
					                <div id="pending_project_new">
					                    *Project Title/Name: <input type="text" name="data[Legalcase][project_title]" class="required">
					                    <br />
					                    *Location: <input type="text" name="data[Legalcase][location]" class="required">
					                </div>
					                
					                <div id="pending_project_old">
					                    <b>Is the "Pending Project" previously submitted to E-Lawyers Online for Consultation?</b><br /><br />
					                    <input type="radio" class="pending_project_old_type" name="data[Legalcase][new_pending_type]" value="yes">YES <input type="radio" class="pending_project_old_type" name="data[Legalcase][new_pending_type]" value="no">NO
					                    <div id="pending_project_old_type_yes">
					                        Case ID: <select name="data[Legalcase][mother_case_id]">
					                            <?php
    					                        foreach ($case_id_list as $key => $value) {
    					                        ?>
    					                            <option value="<?php echo $key ;?>"><?php echo $value ;?></option>
    					                        <?php
    					                        }
    					                        ?>
					                        </select>
					                    </div>
					                    <div id="pending_project_old_type_no">
    					                    *Project Title/Name: <input type="text" name="data[Legalcase][project_title]" class="required">
    					                    <br />
    					                    *Location: <input type="text" name="data[Legalcase][location]" class="required">
					                    </div> 
					                    
					                    <div style="display:block;padding-left:100px;">
                        					<label for="data[Legalcase][new_pending_type]" class="error" style="display:none">Please select yes or no</label> 
                        				</div>
					                    
					                </div>
					                
				                <div style="display:block;padding-left:300px;">
                					<label for="data[Legalcase][case_project_type]" class="error" style="display:none">Please select case type</label> 
                				</div>
					            
					        </div>
					    
				        <div style="display:block;padding-left:300px;">
        					<label for="data[Legalcase][handle_type]" class="error" style="display:none">Please select handle type</label> 
        				</div>
					    <br />
					    
					</div>
					
				</p>
				
				<p>
				    I/we agree to pay the amount of professional fee agreed upon under such terms and conditions of our case/project retainer agreement. 
                    For this purpose, I am providing you my/our personal information and the list of scope of services I/we require.
				</p>
				
				<p>
					Respectfully submitted.
				</p>				
				<br />
			    <input type="submit" class="button-submit" value="" />
			    
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>
<script type="text/javascript">
$('document').ready(function() {
	//jQuery Valdidate
    $("#LegalcaseLetterOfIntentForm").validate({
		rules: {
			"data[Legalcase][client_type]" : {
				required: true
			},
			"data[Legalcase][handle_type]" : {
				required: true
			},
			"data[Legalcase][case_project_type]" : {
				required: true
			},
            // "data[Legalcase][new_pending_type]" : {
            //  required: true
            // }

		},
		submitHandler: function(form) {
			form.submit();
		}
	});
    
    $('.handle_type').attr('disabled', true);
    
    case_container_hide();
    project_container_hide();
    new_case_old_hide();
    pending_case_old_hide();
    new_project_old_hide();
    pending_project_old_hide();
    
    $('.client_type').click(function() {
        
        case_container_hide();
        project_container_hide();
        new_case_old_hide();
        pending_case_old_hide();
        new_project_old_hide();
        pending_project_old_hide();
        
        $('.handle_type').attr('disabled', false);
        $('.handle_type').attr('checked', false);
        $('.case_type').attr('checked', false);
        $('.project_type').attr('checked', false);
    });
    
    //Case/Project Toggle
    $('.handle_type').click(function() {
        
        if ($(this).val() == 'case') {
            $('#case_container').show();
            project_container_hide();
            $('.project_type').attr('checked', false);
            
            new_project_old_hide();
        }
        else if ($(this).val() == 'project') {
            $('#project_container').show();
            case_container_hide();
            new_case_old_hide();
            pending_case_old_hide();
            $('.case_type').attr('checked', false);
        }
        
    });
    
    //Case Toggle
    $('.case_type').click(function() {
        if ($(this).val() == 'pending') {
            if ($('.client_type:checked').val() == 'new'){
                $('#pending_case_new').show();
                $('#pending_case_new input').attr('disabled', false);
            }
            else { //old client

                $('#pending_case_new').hide();
                $('#pending_case_new input').val('');
                $('#pending_case_new input').attr('disabled', true);
                
                new_case_old_hide();
                //No
                $('#pending_case_old').show();
                $('#pending_case_old input').attr('disabled', false);
                
            }
        }
        else { //new case
            if ($('.client_type:checked').val() == 'new'){
                $('#pending_case_new').hide();
                $('#pending_case_new input').val('');
                $('#pending_case_new input').attr('disabled', true);
                
                $('#new_case_old').hide();
                // $('#new_case_old input').val('');
                $('#new_case_old input').attr('disabled', true);
            }
            else { //old client
                //Yes
                $('#new_case_old').show();
                $('#new_case_old input').attr('disabled', false);
                
                pending_case_old_hide();
            }
        };
    });
    
    //Project Toggle
    $('.project_type').click(function() {
        if ($(this).val() == 'pending') {
            if ($('.client_type:checked').val() == 'new'){
                $('#pending_project_new').show();
                $('#pending_project_new input').attr('disabled', false);
            }
            else { //old client
                new_project_old_hide();
                $('#pending_project_old').show();
            }
        }
        else { //new case
            if ($('.client_type:checked').val() == 'new'){
                $('#pending_project_new').hide();
                $('#pending_project_new input').val('');
                $('#pending_project_new input').attr('disabled', true);
            }
            else { //old client
                $('#new_project_old').show();
                $('#new_project_old input').attr('disabled', false);
                
                pending_project_old_hide();
            }
        };
    });
    
    //Old Client New Case Type Toggle
    $('.new_case_old_type').click(function() {

        if ($(this).val() == 'yes') {
            $('#new_case_old_type_yes').show();
            $('#new_case_old_type_yes select').attr('disabled', false);
        }
        else {
            $('#new_case_old_type_yes').hide();
            $('#new_case_old_type_yes select').attr('disabled', true);
        }
    });
    
    //Old Client Pending Case Type Toggle
    $('.pending_case_old_type').click(function() {
        if ($(this).val() == 'yes') {
            $('#pending_case_old_type_yes').show();
            $('#pending_case_old_type_yes select').attr('disabled', false);
            
            $('#pending_case_old_type_no').hide();
            $('#pending_case_old_type_no input').val('');
            $('#pending_case_old_type_no input').attr('disabled', true);
        }
        else {
            $('#pending_case_old_type_yes').hide();
            $('#pending_case_old_type_yes select').attr('disabled', true);
            
            $('#pending_case_old_type_no').show();
            $('#pending_case_old_type_no input').attr('disabled', false);
        }
    })
    
    //Old Client New Project Type Toggle
    $('.new_project_old_type').click(function() {
        if ($(this).val() == 'yes') {
            $('#new_project_old_type_yes').show();
            $('#new_project_old_type_yes select').attr('disabled', false);
        }
        else {
            $('#new_project_old_type_yes').hide();
            $('#new_project_old_type_yes select').attr('disabled', true);
        }
    });
    
    //Old Client Pending Project Type Toggle
    $('.pending_project_old_type').click(function() {
        if ($(this).val() == 'yes') {
            $('#pending_project_old_type_yes').show();
            $('#pending_project_old_type_yes select').attr('disabled', false);
            
            $('#pending_project_old_type_no').hide();
            $('#pending_project_old_type_no input').val('');
            $('#pending_project_old_type_no input').attr('disabled', true);
        }
        else {
            $('#pending_project_old_type_yes').hide();
            $('#pending_project_old_type_yes select').attr('disabled', true);
            
            $('#pending_project_old_type_no').show();
            $('#pending_project_old_type_no input').attr('disabled', false);
        }
    })
        
    function case_container_hide() {
        $('#case_container').hide();
        $('#pending_case_new').hide();
        $('#pending_case_new input').val('');
        $('#pending_case_new input').attr('disabled', true);
    }
    
    function project_container_hide() {
        $('#project_container').hide();
        $('#pending_project_new').hide();
        $('#pending_project_new input').val('');
        $('#pending_project_new input').attr('disabled', true);
    }
    
    function new_case_old_hide(){
        //Yes
        $('#new_case_old').hide();
        $('#new_case_old input').attr('checked', false);
        $('#new_case_old input').attr('disabled', true);
        
        $('#new_case_old_type_yes').hide();
        $('#new_case_old_type_yes select').attr('disabled', true);
    }
    
    function pending_case_old_hide() {
        $('#pending_case_old').hide();
        $('#pending_case_old input').attr('checked', false);
        
        $('#pending_case_old_type_yes').hide();
        $('#pending_case_old_type_yes select').attr('disabled', true);
        
        $('#pending_case_old_type_no').hide();
        $('#pending_case_old_type_no input').val('');
        $('#pending_case_old_type_no input').attr('disabled', true);
    }
    
    function new_project_old_hide(){
        //Yes
        $('#new_project_old').hide();
        $('#new_project_old input').attr('checked', false);
        $('#new_project_old input').attr('disabled', true);
        
        $('#new_project_old_type_yes').hide();
        $('#new_project_old_type_yes select').attr('disabled', true);
    }
    
    function pending_project_old_hide() {
        $('#pending_project_old').hide();
        $('#pending_project_old input').attr('checked', false);
        $('#pending_project_old_type_yes').hide();
        $('#pending_project_old_type_yes select').attr('disabled', true);
        
        
        $('#pending_project_old_type_no').hide();
        $('#pending_project_old_type_no input').val('');
        $('#pending_project_old_type_no input').attr('disabled', true);
    }
});
</script>

<?php echo $html->script('jquery.validate.min', array('inline'=>false));?>

