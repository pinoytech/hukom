<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<div class="form-title">Summary of Information</div>
		<div class="form-holder">
			<table class="summary-info">
				<tr>
					<td class="label">My Legal Problem is:</td>
					<td><?php echo $Legalcase['Legalcase']['legal_problem'];?></td>
				</tr>
				
				<?php
				//debug($Legalcase);
				foreach ($Legalcase['Legalcasedetail'] as $Legalcasedetail) {
				?>
				<tr>
					<td class="label">Summary of Facts:</td>
					<td><?php echo $Legalcasedetail['summary'];?></td>
				</tr>
				<tr>
					<td class="label">My Objectives:</td>
					<td><?php echo $Legalcasedetail['objectives'];?></td>
				</tr>
				<tr>
					<td class="label">My Questions:</td>
					<td><?php echo $Legalcasedetail['questions'];?></td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="2">-----------------------------------------------------------------------------------------------------------------------------------------</td>
				</tr>
			</table>
							
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

<script type="text/javascript">
jQuery('document').ready(function() {

	//jQuery Valdidate
	jQuery("#LegalcaseSummaryOfFactsForm").validate({});

	jQuery('#back').click(function() {
		window.location = '/legalcases/objectives_questions/<?php echo $id ?>/<?php echo $case_id ?>/<?php echo $case_detail_id ?>';
        
	});

	jQuery('#next').click(function() {
		window.location = '/legalcases/online_legal_consultation_agreement/<?php echo $id ?>/<?php echo $case_id ?>/<?php echo $case_detail_id ?>';
	});

});

</script>