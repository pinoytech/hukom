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
						echo '<li class="actions"><a href="' . $upload_folder . '/' . $value . '" target="_blank">' . $value . '</a>' . ' <a class="remove_file" id="' . $upload_folder . '/' . $value . '"><img src="/img/removeButton_up.png" class="remove-button" border="0" align="absbottom"></a></li>';
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
				    <?php
				    //Disable back button on New Facts
                    if (!$this->Session->read('new_facts')) {
                    ?>
                    <td>
                        <input type="button" id="back" class="button-back" value="" />
                    </td>
                    <?php
                    }
                    ?>
					<td>
						<input type="button" id="next" class="button-next" value="" />
					</td>
				</tr>
			</table>			
        <?php echo $this->Form->end();?>
	</div>
</div>

<?php echo $html->script('/uploadify/swfobject.js', array('inline'=>false));?>
<?php echo $html->script('/uploadify/jquery.uploadify.v2.1.4.min.js', array('inline'=>false));?>
<?php $html->scriptBlock("summary_of_facts_form('$id', '$case_id', '$case_detail_id', '$upload_folder');", array('inline'=>false));?>
