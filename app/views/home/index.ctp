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
				?>
				<li>
					Hi, <?php echo $User['PersonalInfo']['first_name'];?> [<?php echo $this->Html->link('Logout', '/users/logout', array()); ?>]
				</li>
				<li>
					<?php echo $this->Html->link('Go to your dashboard', '/dashboard', array()); ?>
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
	            </li>
	            <li>
	                <?php echo $this->Form->input('User.password', array('class' => 'text'));?>
					<?php echo $this->Html->link('Forgot your password?', '/users/forgot_password', array('class' => 'forgot-pword fr')); ?>
	            </li>
	            <li class="fr">
					<?php echo $this->Form->end('login.jpg')?>
	            </li>
				<li><br />
	                <label>Create an<br />Account</label>
	                <a href="/users/register" class="fr">
	                    <img src="/img/sign-up.jpg" alt="create an account" title="Sign Up" />
	                </a>
	            </li>
            <?php
			}
			?>
			<li><br />
                <a href="#" class="icon-space fr">
                    <img src="/img/icon-in.jpg" alt="connect us" title="Connect Us on LinkedIn" />
                </a>
                <a href="#" class="icon-space fr">
                    <img src="/img/icon-tw.jpg" alt="follow us" title="Follow Us on Twitter" />
                </a>
                <a href="#" class="icon-space fr">
                    <img src="/img/icon-fb.jpg" alt="like us" title="Like Us on Facebook" />
                </a>
            </li>
        </ul>
        <!-- Login -->
        <!-- Advertise White -->
        <div class="advertise-white">
        	<br /><br /><br /><br /><br />
            Advertisement<br />Placement
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
		        	<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit!</h2><br />
		            Sed at massa libero, imperdiet tincidunt sem. Nam rutrum elementum lacus, a pretium dui ultricies quis. Aenean vestibulum tortor nec lacus dictum in gravida orci volutpat. 
		        </div>
		        <a href="#" class="read-more fr textindent">read more</a>
		    </div>
		</div>
		<!-- Left Main -->
		<!-- Right Main -->
		<div class="right-main fl">
			<div class="law-society-holder">
		   		<div class="law-content">
		        	<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit!</h2><br />
		            Sed at massa libero, imperdiet tincidunt sem. Nam rutrum elementum lacus, a pretium dui ultricies quis.
		        </div>
		        <a href="#" class="read-more fr textindent">read more</a>
		    </div>

		    <div class="law-updates-holder">
		   		<div class="law-content">
		        	<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit!</h2><br />
		            Sed at massa libero, imperdiet tincidunt sem. Nam rutrum elementum lacus, a pretium dui ultricies quis.
		        </div>
		        <a href="#" class="read-more fr textindent">read more</a>
		    </div>
		</div>
		<!-- Right Main -->

		<br class="clear" />
    </div>
    <!-- Right Rail --> 
</div>
<span class="clear"></span>
<!-- Main Content -->