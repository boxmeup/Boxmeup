<?php echo $this->Html->script('jquery.showpassword', array('inline' => false)); ?>
<?php echo $this->Html->script('views/users/account', array('inline' => false)); ?>
<h2><?php echo __('My Account'); ?></h2>
<?php
	echo $this->Form->create('User', array('url' => array('action' => 'account')));
	echo $this->Form->input('email', array('label' => __('Update Email')));
	echo $this->Form->input('password', array('label' => __('Update Password (Leave blank if you do not wish to change.)')));
	echo '<br/>';
	echo $this->Form->submit(__('Update Account Settings'), array('class' => 'btn success'));
	echo $this->Form->end();
?>
<?php if (Configure::read('Feature.api')) : ?>
	<br/><hr/><br/>
	<h3><?php echo __('API Access'); ?></h3><br/>
	<p><b><?php echo __('Status'); ?></b>: <?php echo !empty($api_key) ? ('<span style="color: green">' . __('Enabled') . '</span>') : ('<span style="color:red">' . __('Disabled') . '</span>'); ?></p>
	<?php
		if(!empty($api_key)) {
			echo '<p><b>' . __('Api Key') . '</b>: ' . $api_key . '</p>';
			echo '<p><b>' . __('Secret Key') . '*</b>: ' . $secret_key . '</p>';
		}
	?>
	<br/>
	<a href="https://github.com/boxmeup/Boxmeup/wiki/API-Documentation" class="btn info" target="_NEW"><?php echo __('Developer API Documentation'); ?></a>
	<br/>
	<br/>
	<small>
	* <?php echo __('For security purposes of your account, do not share your secret key with anyone.'); ?>
	</small>
<?php endif; ?>