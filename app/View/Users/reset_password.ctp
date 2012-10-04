<?php
	echo $this->Html->script('jquery.showpassword', array('inline' => false));
	echo $this->Html->script('views/users/reset_password', array('inline' => false));
?>
<h2><?php echo __('Reset Password'); ?></h2>
<?php
	echo $this->Form->create('User', array('action' => 'reset_password'));
	echo $this->Form->input('recovery_key', array('label' => __('Enter the recovery key provided by email'), 'style' => 'width: 250px'));
	echo $this->Form->input('password', array('label' => __('Enter a new password for your account')));
	echo '<br/>';
	echo $this->Form->submit(__('Reset Password'), array('class' => 'large green button'));
	echo $this->Form->end();
?>