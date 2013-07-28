<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php echo $title_for_layout; ?> |
		<?php echo __('Boxmeup'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css');
		echo $this->Html->css('app');
		if (Configure::read('Feature.feedback')) {
			echo $this->Html->css('/feedback/css/feedback.css');
		}
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
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="container">
			<a href="/" class="navbar-brand">Boxmeup</a>
			<?php echo $this->element('app/account'); ?>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<?php echo $this->element('app/navigation'); ?>
			</div>
			<div class="col-lg-9">
				<?php echo $this->element('app/submenu'); ?>
				<?php echo $this->element('paginate'); ?>
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
				<?php echo $content_for_layout; ?>
			</div>
		</div>
	</div>
	<?php
		if(Configure::read('Feature.beta')) {
			echo $this->Html->tag('div', '', array('class' => 'beta'));
		}
		echo $this->element('app/footer'); 
		echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
		echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js');
		echo $this->element('analytics');
		echo $scripts_for_layout;
		if (Configure::read('Feature.feedback')) {
			echo $this->element('Feedback.feedback');
		}
		
	?>
</body>
</html>
