<!-- Main Content -->
<div class="main-content">
	<!-- Left Rail -->
    <div class="left-rail fl">
    	<!-- Login -->
        <ul class="login-holder">
			<?php
			if (isset($_SESSION['Auth']) && isset($_SESSION['Auth']['User']) && strlen($_SESSION['Auth']['User']['username']) > 0) { 
				$current_user = $_SESSION['Auth']['User']['username'];
			?>
				<?php
				// If logged in
				if (isset($current_user)) {
          //var_dump($user);
				?>
				<li>
					Hi, <?php echo $User['PersonalInfo']['first_name'];?>
					[<a <?php echo (isset($user) ? 'onclick="javascript:fb_logout();"' : 'href="/users/logout"') ?>>Logout</a>]
				</li>
				<li>
					<?php echo $this->Html->link('Go to your cases', '/legalcases/index/'.$auth_user_id, array()); ?>
				</li>
				<?php
				}
				?>
			<?php
			}
			else {
			?>
            	<li>
					<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'login'))); ?>
	                <?php echo $this->Form->input('User.username', array('label' => 'Email', 'class' => 'text'));?>
	                <div class="spacer_five_pxl"></div>
	                <?php echo $this->Form->input('User.password', array('class' => 'text'));?>
					<?php echo $this->Html->link('Forgot your password?', '/users/forgot_password', array('class' => 'forgot-pword fr')); ?>
	            </li>
	            <li class="fr">
					<?php echo $this->Form->end('login.jpg')?>
	            </li>
				<li>
	                <label>Create an<br />Account</label>
	                <a href="/register" class="fr">
	                    <img src="/img/sign-up.jpg" alt="create an account" title="Sign Up" />
	                </a>
	            </li>
	            <li>
	                <div class="spacer_five_pxl"></div>
	                <center>
	                    OR&nbsp;
    					<a onclick="javascript:fb_login();">
    					    <img src="/img/facebook-login-button.png" alt="Login w/ Facebook" title="Login w/ Facebook" />
    					</a>
					</center>
	            </li>
            <?php
			}
			?>
			<li>
                <a href="http://www.linkedin.com/groups?gid=3995143&trk=hb_side_g" target="_blank" class="icon-space fr">
                    <img src="/img/icon-in.jpg" alt="connect us" title="Connect Us on LinkedIn" />
                </a>
                <a href="http://twitter.com/#!/ELawyersOnline" target="_blank" class="icon-space fr">
                    <img src="/img/icon-tw.jpg" alt="follow us" title="Follow Us on Twitter" />
                </a>
                <a href="http://www.facebook.com/E.Lawyers.Online" target="_blank" class="icon-space fr">
                    <img src="/img/icon-fb.jpg" alt="like us" title="Like Us on Facebook" />
                </a>
            </li>
        </ul>
        <!-- Login -->
        <!-- Advertise White -->
        <div class="advertise-white">
            <br />
            <div>OUR ONLINE<br/>LEGAL SERVICES</div>
            <ul id="consultation-services">
                <li>
                    <?php echo $this->Html->link("&raquo;Initial Legal Assessment", array('controller' => 'legalcases', 'action' => 'initial_assessment'), array('escape' => false)); ?>
                <li>
                    <?php echo $this->Html->link("&raquo;Legal Advice By E-mail", array('controller' => 'legalcases', 'action' => 'online_legal_consultation', $auth_user_id, 'from' => 'home', 'legal_service' => 'Per Query'), array('escape' => false)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link("&raquo;Video Conference w/ a Lawyer", array('controller' => 'legalcases', 'action' => 'online_legal_consultation', $auth_user_id, 'from' => 'home', 'legal_service' => 'Video Conference'), array('escape' => false)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link("&raquo;Office Conference w/ a Lawyer", array('controller' => 'legalcases', 'action' => 'online_legal_consultation', $auth_user_id, 'from' => 'home', 'legal_service' => 'Office Conference'), array('escape' => false)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link("&raquo;Monthly Retainer", array('controller' => 'legalcases', 'action' => 'online_legal_consultation', $auth_user_id, 'from' => 'home', 'legal_service' => 'Monthly Retainer'), array('escape' => false)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link("&raquo;Per Case/Project Retainer", array('controller' => 'legalcases', 'action' => 'online_legal_consultation', $auth_user_id, 'from' => 'home', 'legal_service' => 'Case or Project Retainer'), array('escape' => false)); ?>
                </li>
            </ul>
        </div>
        <!-- Advertise White -->
    </div>
    <!-- Left Rail -->
    <!-- Right Rail -->
    <div class="right-rail fl">
		<!-- Left Main -->
		<div class="left-main fl">
			<div class="everyday-holder">
		   		<div class="everyday-content">
		   		    <?php echo SiteCopy::excerpt('everyday_law'); ?>
		        </div>
		        <a href="/pages/everyday_law" class="read-more fr textindent">read more</a>
		    </div>
		</div>
		<!-- Left Main -->
		<!-- Right Main -->
		<div class="right-main fl">
			<div class="law-society-holder">
		   		<div class="law-content">
		   		    <?php echo SiteCopy::excerpt('law_and_society'); ?>
		        </div>
		        <a href="static/page/law_and_society" class="read-more fr textindent">read more</a>
		    </div>
		    <div class="law-updates-holder">
		   		<div class="law-content">
                    <?php echo SiteCopy::excerpt('law_updates'); ?>
		        </div>
		        <a href="/pages/law_updates" class="read-more fr textindent">read more</a>
		    </div>
		</div>
		<!-- Right Main -->

		<br class="clear" />
    </div>
    <!-- Right Rail --> 
</div>
<span class="clear"></span>
<!-- Main Content -->
