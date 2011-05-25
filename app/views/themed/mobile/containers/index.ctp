<ul data-role="listview" data-theme="c">
<?php
	echo $html->link('Add Container', array('action' => 'add'), array('data-rel' => 'dialog', 'data-role' => 'button', 'data-transition' => 'slidedown'));
	foreach($containers as $container) {
		echo $html->tag('li',
			$html->link($container['Container']['name'],
				array('controller' => 'containers', 'action' => 'view', $container['Container']['slug'])) .
			$html->tag('span', $container['Container']['container_item_count'], array('class' => 'ui-li-count ui-btn-up-c ui-btn-corner-all'))
		);
	}
?>
</ul>
