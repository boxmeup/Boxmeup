<?php
	echo $this->Html->scriptBlock('
		if(mobileApp.isAndroid()) {
			BoxmeupAndroid.clearHistory();
		}
	');
?>
<h2 style="text-align: center">
Welcome to Boxmeup
<?php echo $this->Html->image('generic-box.png', array('style' => 'padding-top: 20px;', 'width' => '64', 'height' => '64')); ?>
</h2>
<?php
	echo $this->Html->link('Sign Up', '/signup', array('data-role' => 'button', 'data-ajax' => 'false'));
	echo $this->Html->link('Log In', '/login', array('data-role' => 'button', 'data-ajax' => 'false'));
	echo $this->Html->link('QR Login', '#', array('data-role' => 'button', 'data-ajax' => 'false', 'style' => 'display: none;', 'class' => 'qr-scan-button'));
