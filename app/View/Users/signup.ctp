<div class="container">
	<div class="row">
		<div class="col-lg-4 col-offset-4">
			<h2><?php echo __('Join Boxmeup'); ?></h2>
			<?php if(Configure::read('Feature.user_registration')) { ?>
				<?php echo $this->Html->script('jquery.showpassword', array('inline' => true)); ?>
				<?php echo $this->Html->script('views/users/signup', array('inline' => true)); ?>
				<?php
					echo $this->Form->create('User');
					echo $this->Form->input('email', array('label' => false, 'placeholder' => __('Email Address'), 'class' => 'form-control input-large')) . '<br>';
					echo $this->Form->input('password', array('label' => false, 'placeholder' => __('Password'), 'class' => 'form-control input-large')) . '<br>';
					// Simple bot circumvent
					echo '<div style="display: none">';
						echo $this->Form->input('confirm_password');
					echo '</div>';
					echo '<br/>';
				?>
				<button type="submit" class="btn btn-success btn-block"><?php echo __('Sign Up') ?></button>
				<?php echo $this->Form->end(); ?>
			<?php } else { ?>
				<p><?php echo __('User registration is temporarily unavailable.'); ?></p>
			<?php } ?>
			<br/>
		<p><?php echo __('Already have an account?');?> <?php echo $this->Html->link(__('Login') . '!', '/login'); ?></p>
		</div>
	</div>
</div>
