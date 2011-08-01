<?php $this->viewVars['title_for_layout']="Thank You" ?>
<div id="full-content">
	<div id="main">
	    
	    <?php echo $this->element('navigation');?>
	    
	    <p>
		Thank you for you trust and confidence with E-Lawyers Online. We will make a review of your requirements and send you our
		<b>Proposed Monthly Retainer Agreement</b> through email.
	    </p>
	    
	    <div style="text-align:center;">
			<input type="button" id="home" class="back-to-case-list" />
		</div>
	</div>
</div>

<script>
$('document').ready(function() {
    $('#home').click(function() {
			window.location = '/home';
		});
    });
</script>