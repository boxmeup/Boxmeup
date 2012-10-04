<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> |
		<?php echo __('Boxmeup'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('https://fonts.googleapis.com/css?family=Nobile');
		echo $this->Html->css('main');
		echo $this->Html->css('app');
		echo $this->Html->css('util');
		echo $this->Html->css('jquery-ui-1.8.10.custom');
		echo $this->Html->css('jquery.fancybox-1.3.4');
		echo $this->Html->script('https://www.google.com/jsapi');
		echo $this->Html->scriptBlock("google.load('jquery', '1.7.1');");
		echo $this->Html->scriptBlock("google.load('jqueryui', '1.8.15');");
		echo $this->Html->scriptBlock("
			var WEBROOT = '$Webroot'; \n"
			. "var search_default = '" . __('Find an item...') . "';"
		);
	?>
	<script type="text/javascript">
		var BMU_CLIENT = {
			features: {
				autocomplete: <?php echo Configure::read('Feature.autocomplete') ? 'true' : 'false'; ?>
			}
		};
	</script>
	<?php
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
					<h1><?php echo $this->Html->link('Boxmeup', '/'); ?></h1>
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
				<div class="app-section">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->Session->flash('auth'); ?>
					<?php echo $content_for_layout; ?>
					<div style="clear:both"></div>
				</div>
			</div>
			<?php echo $this->element('app/footer'); ?>
			<div style="clear: both"></div>
		</div>
	</div>
</body>
</html>
