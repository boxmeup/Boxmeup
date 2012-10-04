<div style="width: 250px; margin: 0 auto;">
	<h2><?php echo __('Password Recovery'); ?></h2>
<?php if(Configure::read('Feature.forgot_password')) { ?>
	<?php
		echo $this->Form->create('User', array('url' => array('action' => 'forgot_password'), 'style' => 'width: 250px'));
		echo $this->Form->input('email', array('style' => 'width: 250px', 'label' => __('Email Address'))).'<br/><br/>';
		echo $this->Form->submit(__('Reset Password'), array('class' => 'large red button', 'div' => false, 'style' => 'width: 260px'));
		echo '<br/>';
		echo $this->Form->end();
	?>
		<br/>
		<?php echo __('Entering your registered email address will reset your password and send a new password to the registered email address.'); ?>
<?php } else { ?>
	<p><?php echo __('Forgot password feature is temporarily unavailable.'); ?></p>
<?php } ?>
</div>
