<div id="full-content">
  <div id="main">

    <?php echo $this->Session->flash(); ?>
      <div style="float:left; width:49%;">
        <div class="form-title">Login</div>
        <div class="form-holder form-login">
        <?php
        echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'login')));
        echo $this->Form->input('User.username', array('label' => 'Email', 'class' => 'required email'));
        echo $this->Form->input('User.password', array('value' => '', 'class' => 'required'));
        echo $this->Form->end('login.jpg');
        ?>
        
        <br />
        <p>
        OR
        </p>
        
        <p>
            <a onclick="javascript:fb_login();">
			    <img src="/img/facebook-login-button.png" alt="Login w/ Facebook" title="Login w/ Facebook" />
			</a>
		</p>
		
        <p>
        <?php echo $this->Html->link(__('Forgot your password?', true), array('action' => 'forgot_password')); ?>
        </p>
        </div>
      </div>

      <div style="float:right; width:49%;">
        <div class="form-title">Sign Up</div>
        <div class="form-holder form-login">
            <p>
              No Account Yet? Sign-up <?php echo $this->Html->link(__('Here', true), array('action' => 'register')); ?>
            </p>
        </div>
      </div>

  </div>
</div>

<?php $html->scriptBlock("login_form();", array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>
