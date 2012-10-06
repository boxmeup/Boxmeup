<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('https://fonts.googleapis.com/css?family=PT+Sans');
		echo $this->Html->css('https://fonts.googleapis.com/css?family=Nobile');
		echo $this->Html->css('main');
		echo $this->Html->css('util');
		echo $this->Html->css('jquery-ui-1.8.10.custom');
		echo $this->Html->css('jquery.fancybox-1.3.4');
		if (Configure::read('Feature.feedback')) {
			echo $this->Html->css('/feedback/css/feedback.css');
		}
		echo $this->Html->script('https://www.google.com/jsapi');
		echo $this->Html->scriptBlock("google.load('jquery', '1.7.1');");
		echo $this->Html->scriptBlock("google.load('jqueryui', '1.8.15');");
		echo $this->Html->scriptBlock("
			var WEBROOT = '$Webroot';
		");
		echo $this->Html->script('jquery.fancybox-1.3.4.pack');
		echo $this->Html->script('main');
		echo $this->element('analytics');
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="header">
		<div class="container">
			<div id="logo">
				<h1><?php echo $this->Html->link('Boxmeup', '/'); ?></h1>
			</div>
			<?php echo $this->element('account'); ?>
			<div style="clear: both"></div>
		</div>
	</div>
	<div class="container">
		<?php echo $this->element('navigation'); ?>
		<div id="main">
			<div id="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
				<?php echo $content_for_layout; ?>
			</div>
			<div style="clear: both"></div>
		</div>
		<?php echo $this->element('footer'); ?>
	</div>
	<?php
		if (Configure::read('Feature.feedback')) {
			echo $this->element('Feedback.feedback');
		}
	?>
</body>
</html>