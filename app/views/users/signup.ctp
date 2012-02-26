<div style="width: 250px; margin: 0 auto;">
	<h2><?php __('Join Boxmeup'); ?></h2>
<?php if(Configure::read('Feature.user_registration')) { ?>
	<?php echo $html->script('jquery.showpassword', array('inline' => true)); ?>
	<?php echo $html->script('views/users/signup', array('inline' => true)); ?>
	<?php
		echo $form->create('User', array('style' => 'width: 250px'));
		echo $form->input('email', array('style' => 'width: 250px', 'label' => __('Email Address', true)));
		echo $form->input('password', array('style' => 'width: 250px;', 'label' => __('Password', true)));
		// Simple bot circumvent
		echo '<div style="display: none">';
			echo $form->input('confirm_password');
		echo '</div>';
		echo '<br/>';
		echo $form->submit(__('Sign Up', true), array('class' => 'large green button', 'div' => false, 'style' => 'width: 260px'));
		echo $form->end();
	?>
<?php } else { ?>
	<p><?php __('User registration is temporarily unavailable.'); ?></p>
<?php } ?>
	<br/>
		<p><?php __('Already have an account?');?> <?php echo $html->link(__('Login', true) . '!', '/login'); ?></p>
</div>
