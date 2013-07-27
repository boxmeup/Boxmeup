<p>&nbsp;</p>
<div style="width: 650px; margin-left: 10px; float: left;">
	<?php echo $this->Html->image('hero1.jpg'); ?>
</div>
<div style="float: left; width: 250px;">
	<h2><?php echo __('Organize your life.'); ?></h2><br/>
	<?php if(Configure::read('Feature.user_registration')) { ?>
	<?php echo $this->Html->script('jquery.showpassword', array('inline' => true)); ?>
	<?php echo $this->Html->script('views/users/signup', array('inline' => true)); ?>
	<?php
		echo $this->Form->create('User', array('action' => 'signup', 'style' => 'width: 250px'));
		echo $this->Form->input('email', array('style' => 'width: 250px', 'label' => __('Email Address')));
		echo $this->Form->input('password', array('style' => 'width: 250px;', 'label' => __('Password')));
		// Simple bot circumvent
		echo '<div style="display: none">';
			echo $this->Form->input('confirm_password');
		echo '</div>';
		echo '<br/>';
		echo $this->Form->submit(__('Sign Up'), array('class' => 'large green button', 'div' => false, 'style' => 'width: 260px'));
		echo $this->Form->end();
	?>
<?php } else { ?>
	<p><?php echo __('User registration is temporarily unavailable.'); ?></p>
<?php } ?>
	<br/>
		<p><?php echo __('Already have an account?');?> <?php echo $this->Html->link(__('Login') . '!', '/login'); ?></p>
	<br/>
</div>
<div style="clear: both;  border-bottom: 1px solid #ccc; margin: 0 50px 20px 50px;">&nbsp;</div>
<div style="width: 900px; margin: 0 auto;">
	<div style="width: 250px; float: left; padding: 10px 20px;">
		<div style="text-align: center; margin-bottom: 10px;"><?php echo $this->Html->image('icons/search.png'); ?></div>
		<h2 style="text-align: center; margin-bottom: 20px;"><?php echo __('Moving'); ?></h2>
		<p><?php echo __("Can't remember where you packed your toothbrush? Use our search feature to find it!"); ?></p>
	</div>
	<div style="width: 250px; float: left; padding: 10px 20px;">
		<div style="text-align: center; margin-bottom: 10px;"><?php echo $this->Html->image('icons/globe.png'); ?></div>
		<h2 style="text-align: center; margin-bottom: 20px;"><?php echo __('Locations'); ?></h2>
		<p><?php echo __('Track where your packages are anywhere in the world.'); ?></p>
	</div>
	<div style="width: 250px; float: left; padding: 10px 20px;">
		<div style="text-align: center; margin-bottom: 10px;"><?php echo $this->Html->image('icons/iphone.png'); ?></div>
		<h2 style="text-align: center; margin-bottom: 20px;"><?php echo __('Mobile'); ?></h2>
		<p><?php echo __('Use your smartphone to scan labels to pull up a manifest anywhere.'); ?></p>
	</div>
</div>
