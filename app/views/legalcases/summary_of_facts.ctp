<link href="/uploadify/uploadify.css" type="text/css" rel="stylesheet" />

<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
						
		<?php echo $this->Session->flash(); ?>
		
		<div class="form-title">Summary Of Facts</div>
		<div class="form-holder">
		
			<?php echo $this->Form->create('Legalcase');?>
			<?php
				echo $this->Form->input('Legalcasedetail.id', array('type' => 'hidden'));
				echo $this->Form->input('Legalcasedetail.case_id', array('type' => 'hidden', 'value' => $case_id));
				echo $this->Form->input('Legalcasedetail.user_id', array('type' => 'hidden', 'value' => $id));
				echo $this->Form->input('Legalcasedetail.legal_service', array('type' => 'hidden', 'value' => $legal_service));
			?>
				<div>
					<p>
						Describe/Narrate from past to present the clear, complete and specific details/facts of your legal problem by answering the questions of WHO? WHY? WHEN? WHERE? WHAT? AND HOW? If you want to refer to any document, picture or video, you can scan and attach it in this form.
					</p>
					
					<p>
						Ikuwento nang malinaw, kumpleto at detalyadong pangyayari ang iyong problemang legal mula simula hanggang sa kasalukuyan sa pamamagitan ng pagsagot sa mga katanungang Sino? Bakit? Kailan? Saan? Ano? At Paano? Kung meron ka na papel, dokumento, larawan o video na kasama sa iyong katanungan, kopyahin at isama ito sa aplikasyon na ito.
					</p>
				</div>
			    <?php echo $this->Form->textarea('Legalcasedetail.summary', array('label' => false, 'class' => 'required')); ?>
				
				<div>
					<em>*You can prepare your summary of facts in Microsoft Word then copy and paste in this text area.</em>
				</div>
				<?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>
			</form>
			
			<div>
				<b>Attach Document/s:</b>&nbsp;
				<br /><br />
				<input id="file_upload" name="file_upload" type="file" />
				<br />
				<p>Select a file (jpeg, pdf, word) on your computer (2MB max).</p>
				<!-- <a href="javascript:$('#file_upload').uploadifyUpload()">Upload Files</a> -->
				
				<ul id="file-list">
					<?php
					foreach ($files as $key => $value) {
						echo '<li class="actions"><a href="' . $upload_folder . '/' . $value . '" target="_blank">' . $value . '</a>' . ' <a class="remove_file" id="' . $upload_folder . '/' . $value . '">Remove</a></li>';
					}
					?>
				</ul>
			</div>
			
			<div>
			    Voluminous documents should be sent to Suite 10-G, 10th Floor, Strata 100 Condominium, 100 F. Ortigas, Jr. Road, Ortigas Center, Pasig City, Metro Manila, Philippines c/o Atty. Marlon Valderama.
			</div>
			
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

<script type="text/javascript" src="/uploadify/swfobject.js"></script>
<script type="text/javascript" src="/uploadify/jquery.uploadify.v2.1.4.min.js"></script>

<script type="text/javascript">
jQuery('document').ready(function() {

	//jQuery Valdidate
	jQuery("#LegalcaseSummaryOfFactsForm").validate({
	});

	jQuery('#back').click(function() {
		jQuery('#goto').val('legal_problem');
		
		if (jQuery('#LegalcasedetailSummary').val() == '') {
			
			var agree=confirm("Data you provided on this form will be discarded. Do you want to continue?");
	        if (agree){                        
	           window.location = '/legalcases/legal_problem/<?php echo $id; ?>/<?php echo $case_id; ?>/<?php echo $case_detail_id; ?>';
	        }
	        else{
	           return false;
	        }
		}
		else{
			jQuery('form').submit();
		}
	});

	jQuery('#next').click(function() {
		jQuery('#goto').val('objectives_questions');
		jQuery('form').submit();
	});

	jQuery('#file_upload').uploadify({
	    'uploader'  : '/uploadify/uploadify.swf',
	    'script'    : '/uploadify/uploadify.php',
	    'cancelImg' : '/uploadify/cancel.png',
		'buttonImg' : '/img/selectButton_up.png',
		'wmode'     : 'transparent',
	    'folder'    : '<?php echo $upload_folder;?>',
	    'auto'      : true,
	    'fileExt'   : '*.jpg;*.gif;*.png;*.doc;*.docx;*.pdf',
	    'fileDesc'  : 'Image Files (JPG, GIF, PNG); Document Files (PDF, Word Doc)',
	    'sizeLimit' : 2097152,
		'onComplete' : function(event, ID, fileObj, response, data) {
				append_files(fileObj)
		    }
	});
	
	function append_files(fileObj) {
		name = fileObj.name;
		jQuery('#file-list').append('<li class="actions">'+name+' <a class="remove_file" id="'+fileObj.filePath+'" >Remove</a></li>');
	}
	
	jQuery('.remove_file').live('click', function(e) {
		var parent = jQuery(this).parent();

		jQuery.ajax({
			type: "POST", 
			url: "/legalcases/remove_file",
			data: 'file_path=' + jQuery(this).attr('id'),
			success: function(msg)
			{
				parent.empty().fadeOut();
			},
			error: function()
			{
				alert("An error occured while updating. Try again in a while");
			}
		 });
	});
});

</script>
