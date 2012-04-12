<?php
	$footer_links = array(
		__('Features', true) => '/features',
		__('About', true) => '/about',
		__('Status', true) => 'http://status.boxmeupapp.com',
		__('API', true) => 'https://github.com/cjsaylor/Boxmeup/wiki/API-Documentation',
		__('Blog', true) => 'http://blog.boxmeupapp.com',
		__('Terms of Service', true) => '/terms',
		__('Privacy Policy', true) => '/privacy'
	);
?>
<div class="social">
	<?php echo $html->link($html->image('icons/facebook48.png'), 'https://www.facebook.com/boxmeup', array('escape' => false)); ?>
	<?php echo $html->link($html->image('icons/twitter48.png'), 'http://www.twitter.com/boxmeupapp', array('escape' => false)); ?>
	<a href="http://play.google.com/store/apps/details?id=com.boxmeup.app">
		<?php echo $html->image('get_it_on_play_logo_small.png', array('alt' => 'Get it on Google Play')); ?>
	</a>
</div>
<div id="footer">
	<?php __('Copyright'); ?> &copy; <?php echo date('Y').' ' . $this->Html->link('Boxmeup', '/'); ?>.  <?php __('All rights reserved.'); ?> -
	<?php
		foreach($footer_links as $name => $link) {
			echo $this->Html->link($name, $link).'&nbsp;&nbsp;&nbsp;';
		}
	?>
</div>
