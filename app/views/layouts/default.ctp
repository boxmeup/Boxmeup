<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> |
		<?php __('Boxmeup.com'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=PT+Sans');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Nobile');
		echo $this->Html->css('main');
		echo $this->Html->script('https://www.google.com/jsapi');
		echo $this->Html->scriptBlock("google.load('jquery', '1.4');");
		echo $this->Html->scriptBlock("
			var WEBROOT = '$Webroot';
		");
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="header">
		<div class="container">
			<div id="logo">
				<h1><?php echo $html->link('Boxmeup', '/'); ?></h1>
			</div>
			<?php echo $this->element('account'); ?>
			<div style="clear: both"></div>
		</div>
	</div>
	<div class="container">
		<?php echo $this->element('navigation'); ?>
		<div id="main">
			<div id="content">
				<?php echo $this->element('error'); ?>
				<?php echo $content_for_layout; ?>
			</div>
			<div style="clear: both"></div>
		</div>
		<?php echo $this->element('footer'); ?>
	</div>
</body>
</html>