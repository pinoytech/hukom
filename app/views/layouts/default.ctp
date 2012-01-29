<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('E-Lawyers Online:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="initial-scale=1.0">
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
            <li><a href="/static/page/about_us" class="about-us" title="About Us">About Us</a></li>
            <li><a href="/static/page/you_and_the_law" class="you-and-the-law" title="You & The Law">You & The Law</a></li>
            <li><a href="/static/page/law_and_society" class="law-society" title="Law & Society">Law & Society</a></li>
            <li><a href="/static//page/law_updates" class="law-updates" title="Law Updates">Law Updates</a></li>
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
            <li><a href="/static/page/lawyers_profile" class="lawyers-profile-selected" title="Lawyer's Profile">Lawyer's Profile</a></li>
            <li><a href="/static/page/services" class="our-services" title="Our Services">Our Services</a></li>
            <li><a href="/static/page/outrageous_laws" class="outrageous-laws" title="Outrageous Laws & Lawsuits">Outrageous Laws & Lawsuits</a></li>
            <li><a href="/static/page/lawyers_quotes" class="lawyers-quotes" title="Lawyer's Quotes">Lawyer's Quotes</a></li>
            <li><a href="/static/page/case_studies" class="case-studies" title="Case Studies">Case Studies</a></li>
            <li><a href="/static/page/elegal_news" class="elegal-news" title="E-Legal News">E-Legal News</a></li>
            <li><a href="/static/page/contact_us" class="contact-us" title="Contact Us">Contact Us</a></li>
        </ul>
        <!-- Sub Nav -->
        <!-- Canvas -->
        <div class="canvas-holder fl">
          <?php echo Advertisement::code('banner');  ?>
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
                    <?php echo Advertisement::code('lower_left_footer');  ?>
                </center>
            </div>
            <div class="right-rail-footer fl">
                <?php echo Advertisement::code('footer');  ?>
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
    
    <div id="fb-root"></div>
    <script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '<?php echo Configure::read("FB_APP_ID"); ?>', // App ID
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true  // parse XFBML
        });

        // Additional initialization code here
    };

    // Load the SDK Asynchronously
    (function(d){
        var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        d.getElementsByTagName('head')[0].appendChild(js);
    }(document));

    function fb_login() {
        FB.login(function(response) {
            if (response.authResponse) {
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me', function(response) {
                    console.log('Good to see you, ' + response.name + '.');
                    window.location = '/home';
                    /*
                    FB.logout(function(response) {
                        console.log('Logged out.');
                    });
                    */
                });
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {scope: 'email, user_about_me, user_birthday'});
    }

    function fb_logout() {
        FB.logout(function(response) {
            console.log('Logged out.');
            window.location = '/users/logout';
        });
    }
       
    </script>
    
    <?php
        // echo $this->element('sql_dump');
    ?>
</body>
</html>
