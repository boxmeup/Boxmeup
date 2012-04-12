<?php
	$footer_links = array(
		__('Terms of Service', true) => '/terms',
		__('Privacy Policy', true) => '/privacy',
		__('Status', true) => 'http://status.boxmeupapp.com'
	);
?>
<div style="clear: both"></div>
<div class="social">
	<a href="http://play.google.com/store/apps/details?id=com.boxmeup.app">
		<?php echo $html->image('get_it_on_play_logo_small.png', array('alt' => 'Get it on Google Play')); ?>
	</a>
</div>
<div id="footer">
	Copyright &copy; <?php echo date('Y').' ' . $this->Html->link('Boxmeup', '/'); ?>.  All rights reserved. -
	<?php
		foreach($footer_links as $name => $link) {
			echo $this->Html->link($name, $link).'&nbsp;&nbsp;&nbsp;';
		}
	?>
</div>
