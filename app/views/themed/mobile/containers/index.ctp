<ul data-role="listview" data-theme="c">
<?php
	foreach($containers as $container) {
		echo $html->tag('li',
			$html->link($container['Container']['name'],
				array('controller' => 'containers', 'action' => 'view', $container['Container']['slug'])));
	}
?>
</ul>
