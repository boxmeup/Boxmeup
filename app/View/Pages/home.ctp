<div class="hero">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<h1><?php echo __('Organize your life.') ?></h1>
				<h3><?php echo __('As the amount of stuff we collect grows, the need to organize all of that stuff also grows.  Sign up with us and start organizing!'); ?></h3>
			</div>
			<div class="col-lg-4">
				<?php if(Configure::read('Feature.user_registration')) { ?>
				<?php
					echo $this->Form->create('User', array('action' => 'signup'));
					echo $this->Form->input('email', array('label' => false, 'placeholder' => __('Email Address'), 'class' => 'form-control input-lg'));
				?>
				<br>
				<?php
					echo $this->Form->input('password', array('label' => false, 'placeholder' => __('Password'), 'class' => 'form-control input-lg'));
					// Simple bot circumvent
					echo '<div style="display: none">';
						echo $this->Form->input('confirm_password');
					echo '</div>';
					echo '<br/>';
				?>
				<button type="submit" class="btn btn-success btn-block btn-lg"><?php echo __('Sign Up') ?></button>
				<?php echo $this->Form->end(); ?>
				<br>
				<p><?php echo __('Already have an account?');?> <?php echo $this->Html->link(__('Login') . '!', '/login'); ?></p>
				<?php } else { ?>
					<p><?php echo __('User registration is temporarily unavailable.'); ?></p>
				<?php } ?>
			</div>	
		</div>
	</div>
</div>
<div class="container" style="margin-bottom: 40px;">
	<div class="row">
		<div class="col-lg-4">
			<div style="text-align: center; margin-bottom: 10px;"><?php echo $this->Html->image('icons/search.png'); ?></div>
			<h2 style="text-align: center; margin-bottom: 20px;"><?php echo __('Moving'); ?></h2>
			<p><?php echo __("Can't remember where you packed your toothbrush? Use our search feature to find it!"); ?></p>
		</div>
		<div class="col-lg-4">
			<div style="text-align: center; margin-bottom: 10px;"><?php echo $this->Html->image('icons/globe.png'); ?></div>
			<h2 style="text-align: center; margin-bottom: 20px;"><?php echo __('Locations'); ?></h2>
			<p><?php echo __('Track where your containers are anywhere in the world.'); ?></p>
		</div>
		<div class="col-lg-4">
			<div style="text-align: center; margin-bottom: 10px;"><?php echo $this->Html->image('icons/iphone.png'); ?></div>
			<h2 style="text-align: center; margin-bottom: 20px;"><?php echo __('Mobile'); ?></h2>
			<p><?php echo __('Use your smartphone to scan labels to pull up a manifest anywhere.'); ?></p>
		</div>
	</div>
</div>
<br>
<div class="container text-center hidden-xs" style="margin-bottom: 40px;">
	<img src="/img/demo1.png"/>
</div>
<div class="container text-center" style="margin-bottom: 40px;">
	<img src="/img/demo-mobile1.png"/>
</div>
