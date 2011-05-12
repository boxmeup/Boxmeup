<div style="width: 250px; margin: 0 auto;">
	<h2>Login</h2>
	<?php
		echo $form->create();
		echo $form->input('email', array('style' => 'width: 200px'));
		echo $form->input('password', array('style' => 'width: 200px; margin-bottom: 10px;'));
		echo $html->link('Forgot password?', array('action' => 'forgot_password')).'<br/>'.'<br/>';
		echo $form->submit('Login', array('class' => 'large blue button', 'div' => false, 'style' => 'width: 200px'));
		echo $form->end();
	?>
	<br/>
	<p>Don't have an account? <?php echo $html->link('Create one!', '/signup'); ?></p>
</div>
