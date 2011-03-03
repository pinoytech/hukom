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
				<tr>
					<td colspan="2">-----------------------------------------------------------------------------------------------------------------------------------------</td>
				</tr>
				<?php
				//debug($Legalcase);
				foreach ($Legalcase['Legalcasedetail'] as $Legalcasedetail) {
				?>
				<tr>
					<td class="label">Legal Service:</td>
					<td><?php echo $Legalcasedetail['legal_service'];?></td>
				</tr>
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
				<tr>
					<td class="label">Status:</td>
					<td><?php echo ucfirst($Legalcasedetail['status']);?></td>
				</tr>
				<tr>
					<td class="label">Date:</td>
					<td><?php echo substr($Legalcasedetail['created'], 0, 10);?></td>
				</tr>
				
				<tr>
					<td colspan="2">-----------------------------------------------------------------------------------------------------------------------------------------</td>
				</tr>
				<?php
				}
				?>
			</table>
							
		</div>
		
		<br />
		
		<?php
		if ($type != 'view') {
		?>
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
		<?php
		}
		else {
		?>
		<table>
			<tr>
				<td>
					<input type="button" id="new-facts" value="Add new facts" />
				</td>
			</tr>
		</table>
		<?php
		}
		?>
		
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
	
	jQuery('#new-facts').click(function() {
		window.location = '/legalcases/summary_of_facts/<?php echo $id ?>/<?php echo $case_id ?>';
	});

});

</script>