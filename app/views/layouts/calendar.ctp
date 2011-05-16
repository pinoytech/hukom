<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('E-Lawyers Online:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
        echo $html->css('base/jquery-ui.css');
		echo $html->script('jquery-1.5.2.min.js');
        echo $html->script('jquery-ui.js');        
        
    	echo $html->css('fullcalendar');
        echo $html->css('fullcalendar.print', 'stylesheet', array('media' => 'print'));
        echo $html->script('jquery.ui.core.js');
        echo $html->script('jquery.ui.draggable.js');
        echo $html->script('jquery.ui.resizable.js');
        echo $html->script('fullcalendar.min.js');
        
        echo $html->script('jquery-ui-timepicker-addon.js');
        
        echo $scripts_for_layout;
	?>
	
	
</head>
<body>    	
	<?php echo $content_for_layout; ?>
</body>
</html>