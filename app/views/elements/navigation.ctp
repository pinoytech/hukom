<div class="dashboard-navigation">
    <?php
    if ($auth_user_type == 'personal') {
        $profile_action = 'personal_info';
    }
    elseif ($auth_user_type == 'corporation') {
        $profile_action = 'corporate_partnership_representative_info';
    }
    ?>
	<?php echo $this->Html->link(__('Profile', true), array('controller' => 'users', 'action' => $profile_action, $id)); ?> | 
	<?php echo $this->Html->link(__('My Cases', true), array('controller' => 'legalcases', 'action' => 'index', $id)); ?> | 
  <?php //var_dump($facebook_user); ?>  
  <?php //echo $this->Html->link('Logout', '/users/logout', array()); ?>
  <a <?php echo ($facebook_user ? 'onclick="javascript:fb_logout();"' : 'href="/users/logout"') ?>>Logout</a>
</div>

<div>&nbsp;</div>
