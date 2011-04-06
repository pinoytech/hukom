<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
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

		echo $this->Html->css('cake.generic');
		
		echo $this->Html->css('generic');
        
        echo $this->Html->script('jquery-1.4.4.min');
        
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header" class="position-relative">
			<h1><?php echo $this->Html->link(__('E-Lawyers Online', true), 'http://e-laywersonline.com'); ?></h1>
		
			<div class="login">
			<?php  if (isset($_SESSION['Auth']) && isset($_SESSION['Auth']['User']) && strlen($_SESSION['Auth']['User']['username']) > 0) { 
			 $current_user = $_SESSION['Auth']['User']['username']; 
						if (isset($current_user)) {
						 	
							//echo "<div class='userlogged' onclick='redirectNow()'>Welcome " . "<a href='/Users/profile' class='nostyle'>" .$_SESSION['Auth']['User']['username'] . "</a>" . "</div>"; 
							//echo "<div class='userlogged' onclick='redirectNow()'>Welcome " . $_SESSION['Auth']['User']['username'] . "</div>"; 
						}
						//echo  "<a href='Users/logout'>logout</a>";
						echo "Welcome " . $_SESSION['Auth']['User']['username'] . " | ".$this->Html->link(__('Logout', true), array('admin' => true, 'controller' => 'users', 'action' => 'logout'));
			       }
				   else {  //if ( $session->read('Auth.User.username') == '' ) {			   	
					 	if (substr($_SERVER["REQUEST_URI"],7,5) != 'login') {
							//echo "<a href='Users/login'>login</a>&nbsp;";
							echo $this->Html->link(__('Login', true), array('admin' => true, 'controller' => 'users', 'action' => 'login'));
					 	}
					 
				   }
			?>
			</div>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>