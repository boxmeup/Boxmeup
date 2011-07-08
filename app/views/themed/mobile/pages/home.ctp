<h2 style="text-align: center">
Welcome to Boxmeup
<?php echo $html->image('generic-box.png', array('style' => 'padding-top: 20px;')); ?>
</h2>
<?php
	echo $html->link('Sign Up', '/signup', array('data-role' => 'button', 'data-ajax' => 'false'));
	echo $html->link('Log In', '/login', array('data-role' => 'button', 'data-ajax' => 'false'));
	echo $html->link('QR Login', '#', array('data-role' => 'button', 'data-ajax' => 'false', 'style' => 'display: none;', 'class' => 'qr-scan-button'));
