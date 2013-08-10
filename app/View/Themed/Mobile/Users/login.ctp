<?php
	echo $this->Html->script('views/users/login.mobile.js', array('inline' => false));
?>
<div style="width: 250px; margin: 0 auto;">
	<?php
		echo $this->Form->create('User', array('action' => 'login', 'data-ajax' => 'false'));
		echo $this->Form->input('email', array('style' => 'width: 250px'));
		echo $this->Form->input('password', array('style' => 'width: 250px; margin-bottom: 10px;'));
		echo $this->Html->link('Forgot password?', array('action' => 'forgot_password')).'<br/>'.'<br/>';
		echo $this->Form->submit('Login', array('class' => 'large blue button', 'div' => false, 'style' => 'width: 260px'));
		echo $this->Form->end();
	?>
	<br/>
	<p>Don't have an account? <br/> <?php echo $this->Html->link('Create one!', '/signup'); ?></p>
</div>
