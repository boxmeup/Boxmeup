<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=PT+Sans');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Nobile');
		echo $this->Html->css('main');
		echo $this->Html->css('jquery-ui-1.8.10.custom');
		echo $this->Html->script('https://www.google.com/jsapi');
		echo $this->Html->scriptBlock("google.load('jquery', '1.5.1');");
		echo $this->Html->scriptBlock("
			var WEBROOT = '$Webroot';
			$(document).ready(function() {
				window.print();
			});
		");
		echo $scripts_for_layout;
	?>
</head>
<body style="background-color: white">
	<?php echo $content_for_layout; ?>
</body>
</html>
