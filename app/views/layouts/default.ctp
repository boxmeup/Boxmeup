<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> |
		<?php __('Boxmeup'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('main');
		echo $this->Html->script('https://www.google.com/jsapi');
		echo $this->Html->scriptBlock("google.load('jquery', '1.4');");
		echo $this->Html->scriptBlock("
			var WEBROOT = '$Webroot';
		");
		//echo $this->Javascript->link('util.base');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $html->link('Boxmeup.com', '/'); ?></h1>
		</div>
		<?php echo $this->element('account'); ?>
		<nav id="menu">
			<ul>
				<li><?php echo $html->link('Home', '/'); ?></li>
				<li><?php echo $html->link('About', '/about'); ?></li>
			</ul>
		</nav>
		<div id="content">
			<?php echo $this->element('error'); ?>
			<?php echo $content_for_layout; ?>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>