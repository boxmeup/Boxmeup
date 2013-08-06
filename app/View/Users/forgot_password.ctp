<div class="container">
	<div class="row">
		<div class="col-lg-4 col-offset-4">
			<h2><?php echo __('Password Recovery'); ?></h2>
		<?php if(Configure::read('Feature.forgot_password')) { ?>
			<?php
				echo $this->Form->create('User', array('url' => array('action' => 'forgot_password')));
				echo $this->Form->input('email', array('placeholder' =>  __('Email Address'), 'label' => false, 'class' => 'form-control input-large')).'<br/><br/>';
			?>
			<button type="submit" class="btn btn-default btn-block"><?php echo __('Reset Password') ?></button>
			<?php
				echo '<br/>';
				echo $this->Form->end();
			?>
				<br/>
				<?php echo __('Entering your registered email address will reset your password and send a new password to the registered email address.'); ?>
		<?php } else { ?>
			<p><?php echo __('Forgot password feature is temporarily unavailable.'); ?></p>
		<?php } ?>
		</div>
	</div>
</div>
