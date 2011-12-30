<?php echo $html->docType('xhtml-strict'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?php __('E-Lawyers Online: '); ?><?php echo $title_for_layout; ?></title>
<meta name="viewport" content="initial-scale=1.0">
<?php
  echo $html->charset('UTF-8');
  echo $html->meta('icon');
  echo $html->css('mobile');
  echo $html->script('jquery-1.5.2.min.js');
  echo $html->script('application.js');
  echo $html->script('jquery.validate.min');
  echo $scripts_for_layout;
?>
</head>

<body>
    <!-- Header -->
    <div class="header">
    	<!-- Logo -->
        <a href="/" class="logo re fl textindent">e-Lawyers Online</a>
        <!-- Logo -->
        <!-- Navigation -->
        <!-- <ul class="main-nav">
            <li><a href="/home" class="home-selected" title="Home">Home</a></li>
            <li><a href="/pages/about_us" class="about-us" title="About Us">About Us</a></li>
            <li><a href="/pages/everyday_law" class="everyday-law" title="Everyday Law">Everyday Law</a></li>
            <li><a href="/pages/law_and_society" class="law-society" title="Law & Society">Law & Society</a></li>
            <li><a href="/pages/law_updates" class="law-updates" title="Law Updates">Law Updates</a></li>
            <li><a href="/legalcases/index/<?php echo $auth_user_id;?>" class="online-legal-consultation" title="Online Legal Consultation">Online Legal Consultation</a></li>
        </ul> -->
        <!-- Navigation -->
	<br class="clear" />
    </div>
    <!-- Header -->
    
    <div class="banner">
    </div>
    
    <!-- Main Wrapper -->
    <div class="wrapper">
    	
		<?php echo $content_for_layout; ?>

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
</body>
</html>