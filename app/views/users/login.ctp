<div style="width: 250px; margin: 0 auto;">
	<h2><?php __('Login'); ?></h2>
	<?php
		echo $form->create();
		echo $form->input('email', array('style' => 'width: 250px', 'label' => __('Email Address', true)));
		echo $form->input('password', array('style' => 'width: 250px; margin-bottom: 10px;', 'label' => __('Password', true)));
		echo $html->link(__('Forgot password?', true), array('action' => 'forgot_password')).'<br/>'.'<br/>';
		echo $form->submit(__('Login', true), array('class' => 'large blue button', 'div' => false, 'style' => 'width: 260px'));
		echo $form->end();
	?>
	<br/>
	<p><?php __("Don't have an account?"); ?> <br/> <?php echo $html->link(__('Create one!', true), '/signup'); ?></p>
</div>
