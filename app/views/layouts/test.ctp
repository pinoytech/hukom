<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('public');
		echo $html->css('base/jquery-ui.css');
		echo $html->script('jquery-1.5.2.min.js');
        // echo $html->script('jquery-ui.min');
        echo $html->script('jquery-ui.js');
        echo $html->script('jquery.validate.min');
		
		//Fullcalendar
		echo $html->css('fullcalendar');
		echo $html->css('fullcalendar.print');
        echo $html->script('jquery.ui.core.js');
        echo $html->script('jquery.ui.draggable.js');
        echo $html->script('jquery.ui.resizable.js');
        echo $html->script('fullcalendar.min.js');
		
		echo $scripts_for_layout;
	?>
</head>
<body>
<div id='calendar'></div>
</body>
</html>