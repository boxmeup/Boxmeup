<?php
	$footer_links = array(
		__('Features') => '/features',
		__('About') => '/about',
		__('Status') => 'http://status.boxmeupapp.com',
		__('API') => 'https://github.com/cjsaylor/Boxmeup/wiki/API-Documentation',
		__('Blog') => 'http://blog.boxmeupapp.com',
		__('Terms of Service') => '/terms',
		__('Privacy Policy') => '/privacy'
	);
?>
<div class="social">
	<?php echo $this->Html->link($this->Html->image('icons/facebook48.png'), 'https://www.facebook.com/boxmeup', array('escape' => false)); ?>
	<?php echo $this->Html->link($this->Html->image('icons/twitter48.png'), 'http://www.twitter.com/boxmeupapp', array('escape' => false)); ?>
	<a href="http://play.google.com/store/apps/details?id=com.boxmeup.app">
		<?php echo $this->Html->image('get_it_on_play_logo_small.png', array('alt' => 'Get it on Google Play')); ?>
	</a>
</div>
<div id="footer">
	<?php echo __('Copyright'); ?> &copy; <?php echo date('Y').' ' . $this->Html->link('Boxmeup', '/'); ?>.  <?php echo __('All rights reserved.'); ?> -
	<?php
		foreach($footer_links as $name => $link) {
			echo $this->Html->link($name, $link).'&nbsp;&nbsp;&nbsp;';
		}
	?>
</div>
