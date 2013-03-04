<h2><?php echo __('My Account'); ?></h2>
<?php
	echo $this->Form->create('User', array('url' => array('action' => 'account')));
	echo $this->Form->input('email', array('label' => __('Update Email')));
	echo $this->Form->input('password', array('label' => __('Update Password (Leave blank if you do not wish to change.)')));
	echo '<br/>';
	echo $this->Form->submit(__('Update Account Settings'), array('data-theme' => 'b'));
	echo $this->Form->end();
?>