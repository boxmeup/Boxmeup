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
		echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/css/bootstrap.min.css');
		echo $this->Html->css('//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css');
		echo $this->Html->css('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css');
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
	<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6/html5shiv.min.js"></script>
 	<![endif]-->
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					<i class="icon-list"></i>
				</button>
				<a href="/" class="navbar-brand">Boxmeup</a>
			</div>
			<div class="navbar-collapse collapse navbar-responsive-collapse">
				<?php echo $this->element('app/account'); ?>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<?php echo $this->element('app/navigation'); ?>
			</div>
			<div class="col-lg-9">
				<div class="submenu" data-spy="affix" data-offset-top="50">
					<?php echo $this->element('app/submenu'); ?>
					<div class="spacer"></div>
				</div>
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
				<div id="ajax-error" class="alert alert-danger" style="display:none"></div>
				<?php echo $content_for_layout; ?>
				<?php echo $this->element('paginate'); ?>
			</div>
		</div>
	</div>
	<div class="modal fade" id="layout-modal" data-role="dialog"></div>
	<?php
		if(Configure::read('Feature.beta')) {
			echo $this->Html->tag('div', '', array('class' => 'beta'));
		}
		echo $this->element('app/footer'); 
		echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
		echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js');
		echo $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.1/underscore-min.js');
		echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/js/bootstrap.min.js');
		echo $this->Html->script('main');
		echo $this->Html->script('app');
		echo $this->element('analytics');
		echo $scripts_for_layout;
		if (Configure::read('Feature.feedback')) {
			echo $this->element('Feedback.feedback');
		}
		
	?>
</body>
</html>
