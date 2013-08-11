<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css');
		echo $this->Html->css('//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css');
		echo $this->Html->css('main');
		if (Configure::read('Feature.feedback')) {
			echo $this->Html->css('/feedback/css/feedback.css');
		}
	?>
	<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6/html5shiv.min.js"></script>
 	<![endif]-->
</head>
<body data-spy="scroll" data-target=".dev-submenu">

	<div class="navbar navbar-static-top">
		<div class="container">
	  		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
				<i class="icon-list"></i>
			</button>
			<?php echo $this->Html->link('Boxmeup', '/', array('class' => 'navbar-brand')); ?>
			<div class="nav-collapse collapse navbar-responsive-collapse">
	    		<?php echo $this->element('nav'); ?>
	    	</div>
	    </div>
	    <div class="container">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Session->flash('auth'); ?>
		</div>
    </div>

    
	<?php echo $content_for_layout; ?>
	<?php echo $this->element('footer'); ?>
	<?php
		echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
		echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js');
		echo $this->Html->scriptBlock("
			var WEBROOT = '$Webroot';
		");
		echo $this->Html->script('main');
		echo $this->element('analytics');
		echo $scripts_for_layout;
		if (Configure::read('Feature.feedback')) {
			echo $this->element('Feedback.feedback');
		}
		if(Configure::read('Feature.beta')) {
			echo $this->Html->tag('div', '', array('class' => 'beta'));
		}
	?>
	<div class="modal fade" id="layout-modal">
  		<div class="modal-dialog">
    		<div class="modal-content">
	      		<div class="modal-body">
	        		<p>Loading content...</p>
	      		</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      			</div>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</body>
</html>
