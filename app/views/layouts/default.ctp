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
        echo $html->script('jquery.cycle.all.min.js');

        if ($this->params['action'] == 'letter_of_intent' || $this->params['action'] == 'reschedule_conference') {
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
	<script type="text/javascript">
	$('document').ready(function() {
	    $('.canvas-holder').cycle({
   			fx: 'fade', 
   			speed: 1000,
        });

	    $('.right-rail-footer').cycle({
   			fx: 'fade', 
   			speed: 1000,
        });

   	});
    </script>
</head>
<body>
    <!-- Header -->
    <div class="header">
    	<!-- Logo -->
        <h1><a href="/" class="logo re fl textindent">e-Lawyers Online</a></h1>
        <!-- Logo -->
        <!-- Navigation -->
        <ul class="main-nav">
        	<li><a href="/home" class="home-selected" title="Home">Home</a></li>
            <li><a href="/pages/about_us" class="about-us" title="About Us">About Us</a></li>
            <li><a href="/pages/everyday_law" class="everyday-law" title="Everyday Law">Everyday Law</a></li>
            <li><a href="/pages/law_and_society" class="law-society" title="Law & Society">Law & Society</a></li>
            <li><a href="/pages/law_updates" class="law-updates" title="Law Updates">Law Updates</a></li>
            <li><a href="/legalcases/index/<?php echo $auth_user_id;?>" class="online-legal-consultation" title="Online Legal Consultation">Online Legal Consultation</a></li>
        </ul>
        <!-- Navigation -->
	<br class="clear" />
    </div>
    <!-- Header -->

    <!-- Banner -->
    <div class="banner">
        <!-- Sub Nav -->
        <ul class="sub-nav fl">
            <li><a href="/pages/lawyers_profile" class="lawyers-profile-selected" title="Lawyer's Profile">Lawyer's Profile</a></li>
            <li><a href="/pages/services" class="our-services" title="Our Services">Our Services</a></li>
            <li><a href="/pages/outrageous_laws" class="outrageous-laws" title="Outrageous Laws & Lawsuits">Outrageous Laws & Lawsuits</a></li>
            <li><a href="/pages/lawyers_quotes" class="lawyers-quotes" title="Lawyer's Quotes">Lawyer's Quotes</a></li>
            <li><a href="/pages/case_studies" class="case-studies" title="Case Studies">Case Studies</a></li>
            <li><a href="/pages/elegal_news" class="elegal-news" title="E-Legal News">E-Legal News</a></li>
            <li><a href="/pages/contact_us" class="contact-us" title="Contact Us">Contact Us</a></li>
        </ul>
        <!-- Sub Nav -->
        <!-- Canvas -->
        <div class="canvas-holder fl">
            <a href="/legalcases/index/<?php $auth_user_id;?>"><img src="/img/banner_1.png" alt="canvas" title="Needs Legal Advice but lacks time to visit a Lawyer?" /></a>
            <a href="/legalcases/index/<?php $auth_user_id;?>"><img src="/img/banner_2.png" alt="canvas" title="Needs Legal Advice but lacks time to visit a Lawyer?" /></a>
            <a href="/legalcases/index/<?php $auth_user_id;?>"><img src="/img/banner_3.png" alt="canvas" title="Needs Legal Advice but lacks time to visit a Lawyer?" /></a>
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
                <center>
                    <script type="text/javascript"><!--
                    google_ad_client = "ca-pub-9098289255033755";
                    /* Left Upper Add */
                    google_ad_slot = "9159887380";
                    google_ad_width = 180;
                    google_ad_height = 150;
                    //-->
                    </script>
                    <script type="text/javascript"
                    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                    </script>
                </center>
            </div>
            <div class="right-rail-footer fl">
                <a href="/pages/services"><img src="/img/e-Lawyers_597x150.jpg" alt="canvas" title="Cashsense" /></a>
                <a href="/pages/services"><img src="/img/e-Lawyers_597x150_eWallet.jpg" alt="canvas" title="Cashsense" /></a>
            </div>
            <br class="clear" />
        </div>
        <!-- Advertise Footer -->
    </div>
    <!-- Main Wrapper -->

	<!-- Footer -->
    <div class="footer">
    	&copy; Copyright 2011 e-Lawyersonline. All Rights Reserved. Powered by <a href="http://www.etgdes.com/" target="_blank">ETG Design Solutions</a>.
    </div>
    <!-- Footer -->
    
    <script type="text/javascript">

     var _gaq = _gaq || [];
     _gaq.push(['_setAccount', 'UA-21143225-1']);
     _gaq.push(['_trackPageview']);

     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();

    </script>
    <?php //echo $this->element('sql_dump'); ?>
</body>
</html>
