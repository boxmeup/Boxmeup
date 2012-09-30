<div style="width: 250px; margin: 0 auto;">
	<h2><?php echo __('Login'); ?></h2>
	<?php
		echo $this->Form->create();
		echo $this->Form->input('email', array('style' => 'width: 250px', 'label' => __('Email Address')));
		echo $this->Form->input('password', array('style' => 'width: 250px; margin-bottom: 10px;', 'label' => __('Password')));
		echo $this->Html->link(__('Forgot password?'), array('action' => 'forgot_password')).'<br/>'.'<br/>';
		echo $this->Form->submit(__('Login'), array('class' => 'large blue button', 'div' => false, 'style' => 'width: 260px'));
		echo $this->Form->end();
	?>
	<br/>
	<p><?php echo __("Don't have an account?"); ?> <br/> <?php echo $this->Html->link(__('Create one!'), '/signup'); ?></p>
</div>
