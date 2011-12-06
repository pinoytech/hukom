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
	                <a href="/register" class="fr">
	                    <img src="/img/sign-up.jpg" alt="create an account" title="Sign Up" />
	                </a>
	            </li>
            <?php
			}
			?>
			<li><br />
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
            <center>
                <script type="text/javascript"><!--
                google_ad_client = "ca-pub-9098289255033755";
                /* Left Lower Add */
                google_ad_slot = "0230079627";
                google_ad_width = 200;
                google_ad_height = 200;
                //-->
                </script>
                <script type="text/javascript"
                src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                </script>
            </center>
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
		        	<h2>Annulment of Marriage, in the Philippines!</h2>
		        	<br />
		        	<em>ATTY.! Ayaw pumayag pumirma ng mister ko sa agreement para sa annulment ng kasal namin! Paano gagawin ko? </em>
		        	<br />
		        	<br />
		        	This is a common misconception among Filipinos regarding the legal concept of marriage and annulment here in the Philippines. My answer is that you cannot do that here in the Philippines. We sometimes encounter or hear this discussion from our relatives, friends and acquaintance with troubled marriages giving the notion that it is allowed under Philippine law for the parties to simply agree on the &#8220;hiwalayan&#8221; or dissolution of their marriage. To state it again, this is not allowed under Philippine law.
		        </div>
		        <a href="/pages/everyday_law" class="read-more fr textindent">read more</a>
		    </div>
		</div>
		<!-- Left Main -->
		<!-- Right Main -->
		<div class="right-main fl">
			<div class="law-society-holder">
		   		<div class="law-content">
		            <h2>You, Facebook and the Law...</h2>
		            <br />
		            <br />
		            <em>&quot;Atty., my officemate commented in my Facebook account that &quot;I&#8217;m a whore!&quot;, can I sue her? </em>
		        </div>
		        <a href="/pages/law_and_society" class="read-more fr textindent">read more</a>
		    </div>

		    <div class="law-updates-holder">
		   		<div class="law-content">
		        	<h2>Can  your text message or e-mail message be used as evidence in court?</h2>
		        	<br />
                      Before  the advent of computer age, we have been familiar with the use of documentary...

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
