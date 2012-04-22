<?php echo $html->script('jquery.showpassword', array('inline' => false)); ?>
<?php echo $html->script('views/users/account', array('inline' => false)); ?>
<h2><?php __('My Account'); ?></h2>
<?php
	echo $form->create('User', array('url' => array('action' => 'account')));
	echo $form->input('email', array('label' => __('Update Email', true)));
	echo $form->input('password', array('label' => __('Update Password (Leave blank if you do not wish to change.)', true)));
	echo '<br/>';
	echo $form->submit(__('Update Account Settings', true), array('class' => 'btn success'));
	echo $form->end();
?>
<br/><hr/><br/>
<h3><?php __('API Access'); ?></h3><br/>
<p><b><?php __('Status'); ?></b>: <?php echo !empty($api_key) ? ('<span style="color: green">' . __('Enabled', true) . '</span>') : ('<span style="color:red">' . __('Disabled', true) . '</span>'); ?></p>
<?php
	if(!empty($api_key)) {
		echo '<p><b>' . __('Api Key', true) . '</b>: ' . $api_key . '</p>';
		echo '<p><b>' . __('Secret Key', true) . '*</b>: ' . $secret_key . '</p>';
	}
?>
<br/>
<a href="https://github.com/boxmeup/Boxmeup/wiki/API-Documentation" class="btn info" target="_NEW"><?php __('Developer API Documentation'); ?></a>
<br/>
<br/>
<small>
* <?php __('For security purposes of your account, do not share your secret key with anyone.'); ?>
</small>
