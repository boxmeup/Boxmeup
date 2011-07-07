<?php
	echo $this->Html->script('jquery.showpassword', array('inline' => false));
	echo $this->Html->script('views/users/reset_password', array('inline' => false));
?>
<h2>Reset Password</h2>
<?php
	echo $form->create('User', array('action' => 'reset_password'));
	echo $form->input('recovery_key', array('label' => 'Enter the recovery key provided by email', 'style' => 'width: 250px'));
	echo $form->input('password', array('label' => 'Enter a new password for your account'));
	echo '<br/>';
	echo $form->submit('Reset Password', array('class' => 'large green button'));
	echo $form->end();
?>