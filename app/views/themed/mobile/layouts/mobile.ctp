<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<!--<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />-->
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('http://code.jquery.com/mobile/1.0a4/jquery.mobile-1.0a4.min.css');
		echo $this->Html->script('https://www.google.com/jsapi');
		echo $this->Html->scriptBlock("google.load('jquery', '1.5.2');");
		echo $this->Html->script('http://code.jquery.com/mobile/1.0a4/jquery.mobile-1.0a4.min.js');
		echo $this->Html->script('app.mobile');
		echo $scripts_for_layout;
	?>

</head>
<body>
	<div data-role="page" data-theme="<?php echo Configure::read('Site.jquery_mobile_theme'); ?>" id="<?php echo $mobile_page_id; ?>">
		<div data-role="header" data-position="inline">
		<?php
		if($this->name == 'Containers' && $this->action == 'index' && !empty($User))
			echo $html->link('Logout', array('controller' => 'users', 'action' => 'logout'), array('data-icon' => 'delete', 'class' => 'ui-btn-right no-ajax'));
		else if($this->name !== 'Pages' && $this->action !== 'home')
			echo $html->link('Home', '/', array('data-iconpos' => 'notext', 'data-icon' => 'home', 'class' => 'ui-btn-right no-ajax'))
		?>
		<h1><?php echo $title_for_layout; ?></h1>
		</div>
		<div data-role="content">
			<?php echo $content_for_layout; ?>
			<br/>
			<?php echo $this->element('paginate'); ?>
		</div>
	</div>
</body>
</html>
