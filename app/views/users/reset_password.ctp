<?php
	echo $this->Html->script('jquery.showpassword', array('inline' => false));
	echo $this->Html->script('views/users/reset_password', array('inline' => false));
?>
<h2><?php __('Reset Password'); ?></h2>
<?php
	echo $form->create('User', array('action' => 'reset_password'));
	echo $form->input('recovery_key', array('label' => __('Enter the recovery key provided by email', true), 'style' => 'width: 250px'));
	echo $form->input('password', array('label' => __('Enter a new password for your account', true)));
	echo '<br/>';
	echo $form->submit(__('Reset Password', true), array('class' => 'large green button'));
	echo $form->end();
?>