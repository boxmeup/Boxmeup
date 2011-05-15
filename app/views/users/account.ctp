<?php echo $html->script('jquery.showpassword', array('inline' => false)); ?>
<?php echo $html->script('views/users/account', array('inline' => false)); ?>
<h2>My Account</h2>
<?php
	echo $form->create('User', array('url' => array('action' => 'account')));
	echo $form->input('email', array('label' => 'Update Email'));
	echo $form->input('password', array('label' => 'Update Password (Leave blank if you do not wish to change.)'));
	echo '<br/>';
	echo $form->submit('Update Account Settings', array('class' => 'large green button'));
	echo $form->end();
