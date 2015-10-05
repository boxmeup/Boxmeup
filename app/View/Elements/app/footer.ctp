<?php
	$footer_links = array(
		__('Terms of Service') => '/terms',
		__('Privacy Policy') => '/privacy'
	);
	if (Configure::read('Feature.api')) {
		$footer_links[__('API')] = '/developer';
	}
?>
<div class="footer navbar-fixed-bottom">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<a href="http://play.google.com/store/apps/details?id=com.boxmeup.app">
					<?php echo $this->Html->image('get_it_on_play_logo_small.png', array('alt' => 'Get it on Google Play')); ?>
				</a>
			</div>
			<div class="col-lg-8">
				<div class="pull-right">
					Copyright &copy; 2011-<?php echo date('Y').' ' . $this->Html->link('Boxmeup', '/'); ?>.  All rights reserved. -
					<?php
						foreach($footer_links as $name => $link) {
							echo $this->Html->link($name, $link).'&nbsp;&nbsp;&nbsp;';
						}
					?>
				</div>
			</div>
	</div>
</div>
