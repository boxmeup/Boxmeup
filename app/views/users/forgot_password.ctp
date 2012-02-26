<div style="width: 250px; margin: 0 auto;">
	<h2>Password Recovery</h2>
<?php if(Configure::read('Feature.forgot_password')) { ?>
	<?php
		echo $form->create('User', array('url' => array('action' => 'forgot_password'), 'style' => 'width: 250px'));
		echo $form->input('email', array('style' => 'width: 250px')).'<br/><br/>';
		echo $form->submit('Reset Password', array('class' => 'large red button', 'div' => false, 'style' => 'width: 260px'));
		echo '<br/>';
		echo $form->end();
	?>
		<br/>
		Entering your registered email address will reset your password and send a new password to the registered email address.
<?php } else { ?>
	<p>Forgot password feature is temporarily unavailable.</p>
<?php } ?>
</div>
