<?php
	$footer_links = array(
		'About' => '/about',
		'Terms of Service' => '/terms',
		'Privacy Policy' => '/privacy'
	);
?>
<div id="footer">
	Copyright &copy; <?php echo date('Y'); echo $this->Html->link('Boxmeup', '/'); ?>.  All rights reserved. - 
	<?php
		foreach($footer_links as $name => $link) {
			echo $this->Html->link($name, $link).'&nbsp;&nbsp;&nbsp;';
		}
	?>
</div>