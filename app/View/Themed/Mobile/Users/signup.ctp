<?php if(Configure::read('Feature.user_registration')) { ?>
	<?php
		echo $this->Form->create('User', array('action' => 'signup', 'data-ajax' => 'false'));
		echo $this->Form->input('email', array('label' => __('Email Address')));
		echo $this->Form->input('password', array('label' => __('Password')));
		// Simple bot circumvent
		echo '<div style="display: none">';
			echo $this->Form->input('confirm_password');
		echo '</div>';
		echo '<br/>';
		echo $this->Form->submit(__('Sign Up'), array('class' => 'button', 'div' => false));
		echo $this->Form->end();
	?>
<?php } else { ?>
	<p><?php echo __('User registration is temporarily unavailable.'); ?></p>
<?php } ?>
	<br/>
	<p><?php echo __('Already have an account?');?> <?php echo $this->Html->link(__('Login') . '!', '/login'); ?></p>

