<?php
	$footer_links = array(
		'Features' => '/features',
		'About' => '/about',
		'Blog' => 'http://blog.boxmeupapp.com',
		'Terms of Service' => '/terms',
		'Privacy Policy' => '/privacy'
	);
?>
<div class="social">
	<?php echo $html->link($html->image('icons/facebook48.png'), 'https://www.facebook.com/boxmeup', array('escape' => false)); ?>
	<?php echo $html->link($html->image('icons/twitter48.png'), 'http://www.twitter.com/boxmeupapp', array('escape' => false)); ?>
	<a href="http://market.android.com/details?id=com.boxmeup.app">
		<img src="http://www.android.com/images/brand/45_avail_market_logo1.png" alt="Available in Android Market" />
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
