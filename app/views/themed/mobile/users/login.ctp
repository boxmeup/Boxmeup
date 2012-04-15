<?php
	echo $this->Html->script('views/users/login.mobile.js', array('inline' => false));
?>
<div style="width: 250px; margin: 0 auto;">
	<h2>Login</h2>
	<?php
		echo $form->create();
		echo $form->input('email', array('style' => 'width: 250px'));
		echo $form->input('password', array('style' => 'width: 250px; margin-bottom: 10px;'));
		echo $html->link('Forgot password?', array('action' => 'forgot_password')).'<br/>'.'<br/>';
		echo $form->submit('Login', array('class' => 'large blue button', 'div' => false, 'style' => 'width: 260px', 'data-ajax' => 'false'));
		echo $form->end();
	?>
	<br/>
	<p>Don't have an account? <br/> <?php echo $html->link('Create one!', '/signup'); ?></p>
</div>
