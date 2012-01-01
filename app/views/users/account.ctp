<?php echo $html->script('jquery.showpassword', array('inline' => false)); ?>
<?php echo $html->script('views/users/account', array('inline' => false)); ?>
<h2>My Account</h2>
<?php
	echo $form->create('User', array('url' => array('action' => 'account')));
	echo $form->input('email', array('label' => 'Update Email'));
	echo $form->input('password', array('label' => 'Update Password (Leave blank if you do not wish to change.)'));
	echo '<br/>';
	echo $form->submit('Update Account Settings', array('class' => 'btn success'));
	echo $form->end();
?>
<br/><hr/><br/>
<h3>API Access</h3><br/>
<p><b>Status</b>: <?php echo !empty($api_key) ? '<span style="color: green">Enabled</span>' : '<span style="color:red">Disabled</span>'; ?></p>
<?php
	if(!empty($api_key)) {
		echo '<p><b>Api Key</b>: ' . $api_key . '</p>';
		echo '<p><b>Secret Key*</b>: ' . $secret_key . '</p>';
	}
?>
<br/>
<a href="https://github.com/cjsaylor/Boxmeup/wiki/API-Documentation" class="btn info" target="_NEW">Developer API Documentation</a>
<br/>
<br/>
<small>
* For security purposes of your account, do not share your secret key with anyone.
</small>
