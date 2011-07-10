<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> |
		<?php __('Boxmeup'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=PT+Sans');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Nobile');
		echo $this->Html->css('main');
		echo $this->Html->css('app');
		echo $this->Html->css('jquery-ui-1.8.10.custom');
		echo $this->Html->css('jquery.fancybox-1.3.4');
		echo $this->Html->css('/feedback/css/feedback.css');
		echo $this->Html->script('https://www.google.com/jsapi');
		echo $this->Html->scriptBlock("google.load('jquery', '1.5.1');");
		echo $this->Html->scriptBlock("google.load('jqueryui', '1.8.10');");
		echo $this->Html->scriptBlock("
			var WEBROOT = '$Webroot';
		");
		echo $this->Html->script('jquery.fancybox-1.3.4.pack');
		echo $this->Html->script('jquery.tipsy.min');
		echo $this->Html->script('app');
		echo $this->element('analytics');
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div class="fixed-header">
		<div id="header">
			<div class="container">
				<div id="logo">
					<h1><?php echo $html->link('Boxmeup', '/'); ?></h1>
				</div>
				<?php echo $this->element('app/account'); ?>
				<div style="clear: both"></div>
			</div>
		</div>
		<div class="container">
			<?php echo $this->element('app/navigation'); ?>
			<div id="submenu">
				<?php echo $this->element('app/submenu'); ?>
				<?php echo $this->element('paginate'); ?>
			</div>
			<div style="clear: both"></div>
		</div>
	</div>
	<div class="container">
		<div id="app-container" class="app-begin">
			<div id="sidebar">
				<?php echo $this->element('app/control'); ?>
				<?php echo $this->element('app/advertise'); ?>

			</div>
			<div id="app">
				<noscript>
					<div class="ui-widget">
						<div class="ui-state-error ui-corner-all" style="padding: 0pt 0.7em;">
							<p style="padding: 5px;">
								<span class="ui-icon ui-icon-alert" style="float: left; margin-right: 0.3em;"></span>
								Boxmeup works best with JavaScript enabled.
							</p>
						</div>
					</div>
				</noscript>
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
				<?php echo $content_for_layout; ?>

			</div>
			<?php echo $this->element('app/footer'); ?>
			<div style="clear: both"></div>

		</div>

	</div>
	<?php echo $this->element('feedback', array('plugin' => 'feedback')); ?>
	<?php if($beta) echo $this->Html->tag('div', '', array('class' => 'beta')); ?>
</body>
</html>
