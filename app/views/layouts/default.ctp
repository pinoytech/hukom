<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('E-Lawyers Online:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');
        echo $html->css('public');
        echo $html->css('base/jquery-ui.css');
		echo $html->script('jquery-1.5.2.min.js');
        echo $html->script('jquery-ui.js');
        echo $html->script('application.js');

        if ($this->params['action'] == 'letter_of_intent') {
			echo $html->css('fullcalendar');
	        echo $html->css('fullcalendar.print', 'stylesheet', array('media' => 'print'));
	        echo $html->script('jquery.ui.core.js');
	        echo $html->script('jquery.ui.draggable.js');
	        echo $html->script('jquery.ui.resizable.js');
	    	echo $html->script('fullcalendar.min.js');
	        echo $html->script('jquery.qtip-1.0.0-rc3.min.js');
	
        }
		else {
			echo $html->script('jquery.validate.min'); // Affects FullCalender
		}

		echo $scripts_for_layout;
	?>
	
</head>
<body>
    <!-- Header -->
    <div class="header">
    	<!-- Logo -->
        <h1><a href="/" class="logo re fl textindent">e-Lawyers Online</a></h1>
        <!-- Logo -->
        <!-- Navigation -->
        <ul class="main-nav">
        	<li><a href="#" class="home-selected" title="Home">Home</a></li>
            <li><a href="#" class="about-us" title="About Us">About Us</a></li>
            <li><a href="#" class="everyday-law" title="Everyday Law">Everyday Law</a></li>
            <li><a href="#" class="law-society" title="Law & Society">Law & Society</a></li>
            <li><a href="#" class="law-updates" title="Law Updates">Law Updates</a></li>
            <li><a href="#" class="online-legal-consultation" title="Online Legal Consultation">Online Legal Consultation</a></li>
        </ul>
        <!-- Navigation -->
	<br class="clear" />
    </div>
    <!-- Header -->

    <!-- Banner -->
    <div class="banner">
        <!-- Sub Nav -->
        <ul class="sub-nav fl">
            <li><a href="#" class="lawyers-profile-selected" title="Lawyer's Profile">Lawyer's Profile</a></li>
            <li><a href="#" class="our-services" title="Our Services">Our Services</a></li>
            <li><a href="#" class="outrageous-laws" title="Outrageous Laws & Lawsuits">Outrageous Laws & Lawsuits</a></li>
            <li><a href="#" class="lawyers-quotes" title="Lawyer's Quotes">Lawyer's Quotes</a></li>
            <li><a href="#" class="case-studies" title="Case Studies">Case Studies</a></li>
            <li><a href="#" class="elegal-news" title="E-Legal News">E-Legal News</a></li>
            <li><a href="#" class="contact-us" title="Contact Us">Contact Us</a></li>
        </ul>
        <!-- Sub Nav -->
        <!-- Canvas -->
        <div class="canvas-holder fl">
            <img src="/img/canvas.jpg" alt="canvas" title="Needs Legal Advice but lacks time to visit a Lawyer?" />
            <!-- <a href="#" class="legal-consultation fl ab textindent" title="Online Legal Consultation">Online Legal Consultation</a> -->
        </div>
        <!-- Canvas -->
    <br class="clear" />
    </div>
    <!-- Banner -->
    
    <!-- Main Wrapper -->
    <div class="wrapper">
    	
		<?php echo $content_for_layout; ?>

        <!-- Advertise Footer -->
        <div class="advertise-footer">
            <div class="left-rail-footer fl">
            	<br /><br /><br />
                Advertisement<br />Placement
            </div>
            <div class="right-rail-footer fl">
            	<br /><br /><br />
                Advertisement<br />Placement
            </div>
            <br class="clear" />
        </div>
        <!-- Advertise Footer -->
    </div>
    <!-- Main Wrapper -->

	<!-- Footer -->
    <div class="footer">
    	&copy; Copyright 2011 e-Lawyersonline. All Rights Reserved.
    </div>
    <!-- Footer -->
    <?php echo $this->element('sql_dump'); ?>
</body>
</html>