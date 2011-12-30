<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>

		<div class="form-title">Initial Legal Assessment</div>
		<div class="form-holder form-initial-assessment">
		    
		    <p>
		        This initial legal assessment/study page is only for a general knowledge of the law and limited assessment of your legal problem/question FREE OF CHARGE based on the general and incomplete facts given to E-Lawyers Online. You agree not to copy, reproduce or otherwise publish our initial assessment without E-Lawyers Online consent. This assessment shall not be construed as lawyer-client relationship between you and E-Lawyers Online and the same is for personal information purposes only. If you want a complete and extensive assessment of your legal problem/question or complete and extensive legal advice, please select from any of our five (5) kinds of online legal services.
		    </p>
		    
		    <p>
		        (Itong paunang pantantiya o pag-aaral na pahina ay para lang sa malawak na kaalaman sa batas at limitadong pantantiya at pagsusuri ng iyong problemang legal o katanungan na WALANG BAYAD base sa hindi detalyadong paglalahad ng mga pangyayari na iyong binigay sa E-Lawyers Online. Ikaw ay pumapayag na ang paunang pagsusuri na ito ay hindi kokopyahin o ilalathala kaninuman ng walang nakasulat na pahintulot ng E-Lawyers Online. Ang paunang pagsusuri na ito ay hindi nangangahulugan ng pagkakaroon ng relasyon bilang abogado at kliyente sa pagitan mo at ng E-Lawyers Online at ang mga ito ay para sa iyong kaalaman lamang. Kung gusto mo ng kumpleto at malawakang pagsusuri o pag-aaral ng iyong probleman legal o kumpleto at malawakang paying legal, maaring pumili ka sa mga limang (5) online serbisyo namin.)
		    </p>
		    
		    <p>Our Online Legal Services</p>
		    
		    <ul>
		        <li>Legal Advice by E-Mail</li>
		        <li>Video Conference with Lawyer</li>
		        <li>Office Conference with Lawyer</li>
		        <li>Monthly Retainer</li>
		        <li>Case/Project Retainer</li>
		    </ul>
	    </div>
	    
	    <br />
	    
	    <div class="form-title">Initial Legal Assessment Form</div>
		<div class="form-holder form-initial-assessment">
	    
			<p>
                Please enter your complete details:
            </p>
            
            <p>
                Note: Details field has a maximum of 400 characters
			</p>

			<?php //echo $this->Form->create('Legalcase', array('onsubmit' => "confirm_request_reschedule_conference(); return false;"));?>
			<?php echo $this->Form->create('Legalcases');?>
			<?php
				echo $this->Form->input('InitialAssessment.first_name', array('type' => 'text', 'class' => 'required'));
				echo $this->Form->input('InitialAssessment.last_name', array('type' => 'text', 'class' => 'required'));
				echo $this->Form->input('InitialAssessment.email', array('type' => 'text', 'class' => 'required email'));
				echo $this->Form->input('InitialAssessment.details', array('type' => 'textarea', 'class' => 'required', 'maxlength' => 400));
			?>	

			<input type="submit" class="button-submit" value="">
	        <?php echo $this->Form->end();?>
		</div>
	</div>
</div>

<!-- <div id="reschedule_warning" title="Request Reschedule Conference" class="hidden">
    Please be informed that your request for re-scheduling of your video/office conference will automatically open your original schedule to other clients and E-Lawyers Online shall not guarantee its availability on the said date again upon submission of your request. If you are sure of your request for re-scheduling, please click “Continue”.
</div> -->

<?php //$html->scriptBlock("request_reschedule_conference('$id', '$case_id', '$case_detail_id', '$total_time');", array('inline'=>false));?>
<?php $html->scriptBlock('initial_legal_assessment_form();', array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>
