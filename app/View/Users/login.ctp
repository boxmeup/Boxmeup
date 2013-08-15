<div class="container">
	<div class="row">
		<div class="col-lg-4 col-md-offset-4">
			<h2><?php echo __('Login'); ?></h2>
			<?php
				echo $this->Form->create();
				echo $this->Form->input('email', array('label' => false, 'placeholder' => __('Email Address'), 'class' => 'form-control input-lg'));
			?>
			<br>
			<?php
				echo $this->Form->input('password', array('label' => false, 'placeholder' => __('Password'), 'class' => 'form-control input-lg')) . '<br>';
				echo $this->Html->link(__('Forgot password?'), array('action' => 'forgot_password')) . '<br> <br>';
			?>
			<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __('Login') ?></button>
			<?php echo $this->Form->end(); ?>
			<br/>
			<p><?php echo __("Don't have an account?"); ?> <br/> <?php echo $this->Html->link(__('Create one!'), '/signup'); ?></p>
		</div>
	</div>
</div>
