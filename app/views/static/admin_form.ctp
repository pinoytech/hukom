<?php //$this->TinyMce->editor('advanced'); ?>
<script type="text/javascript">
tinyMCE.init({
  // General options
  mode : "textareas",
  theme : "advanced",
  plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,codeprotect",

  // Theme options
  theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
  theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
  theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
  theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_statusbar_location : "bottom"
});
</script>

<div class="posts form">
    
	<div>
		<?php echo $this->Html->link(__('Add Site Copy or Everyday Law Article', true), array('admin' => true, 'action' => 'add')); ?>
	</div>
	<br />

<?php echo $this->Form->create('SiteCopy', array('url' => array('admin' => true, 'controller' => 'static', 'action' => 'form')));?>
	<fieldset>
 		<legend><?php __('Add Site Copy'); ?></legend>
        <?php
            echo $this->Form->input('id');
            echo $this->Form->input('title');
            echo $this->Form->input('slug');
            echo $this->Form->input('type', array('type' => 'select', 'options' => array('page' => 'Page', 'everyday_law' => 'Everyday Law')));
            echo $this->Form->input('body', array('style' => 'height:300px;'));
            echo $this->Form->input('excerpt', array('style' => 'height:300px;'));
            echo $this->Form->input('published', array('type' => 'checkbox', 'value' => '1', 'label' => 'Publish'));
            // echo $this->Form->input('post_to_facebook', array('type' => 'checkbox'));
        ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php echo $this->element('admin_navigation'); ?>
<?php
if(!$this->data){
    $html->scriptBlock("create_slug();", array('inline'=>false));
}
?>