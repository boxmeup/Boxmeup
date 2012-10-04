<div style="width: 250px; margin: 0 auto;">
	<h2><?php echo __('Join Boxmeup'); ?></h2>
<?php if(Configure::read('Feature.user_registration')) { ?>
	<?php echo $this->Html->script('jquery.showpassword', array('inline' => true)); ?>
	<?php echo $this->Html->script('views/users/signup', array('inline' => true)); ?>
	<?php
		echo $this->Form->create('User', array('style' => 'width: 250px'));
		echo $this->Form->input('email', array('style' => 'width: 250px', 'label' => __('Email Address')));
		echo $this->Form->input('password', array('style' => 'width: 250px;', 'label' => __('Password')));
		// Simple bot circumvent
		echo '<div style="display: none">';
			echo $this->Form->input('confirm_password');
		echo '</div>';
		echo '<br/>';
		echo $this->Form->submit(__('Sign Up'), array('class' => 'large green button', 'div' => false, 'style' => 'width: 260px'));
		echo $this->Form->end();
	?>
<?php } else { ?>
	<p><?php echo __('User registration is temporarily unavailable.'); ?></p>
<?php } ?>
	<br/>
		<p><?php echo __('Already have an account?');?> <?php echo $this->Html->link(__('Login') . '!', '/login'); ?></p>
</div>
