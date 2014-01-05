<div class="container">
	<div class="row">
		<div class="col-lg-4 col-md-offset-4">
			<h2><?php echo __('Reset Password'); ?></h2>
			<?php
				echo $this->Form->create('User', array('action' => 'reset_password'));
				echo $this->Form->input('recovery_key', array('label' => __('Enter the recovery key provided by email'), 'class' => 'form-control input-lg'));
				echo $this->Form->input('password', array('label' => __('Enter a new password for your account'), 'class' => 'form-control input-lg'));
			?>
			<br>
			<button type="submit" class="btn btn-lg btn-default btn-block"><?php echo __('Reset Password') ?></button>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
