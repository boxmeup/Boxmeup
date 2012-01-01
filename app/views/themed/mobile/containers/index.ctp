<ul data-role="listview" data-theme="c">
	<div data-role="navbar" data-type="horizontal" style="width: 100%; text-align: center" id="control-menu">
		<ul>
	<?php
		echo '<li>'.$html->link('Container', array('action' => 'add'), array('data-icon' => 'plus', 'data-rel' => 'dialog', 'data-role' => 'button', 'data-transition' => 'slidedown')).'</li>';
		echo '<li>'.$html->link('Location', array('controller' => 'locations', 'action' => 'add'), array('data-icon' => 'plus', 'data-rel' => 'dialog', 'data-role' => 'button', 'data-transition' => 'slidedown')).'</li>';
		echo '<li>'.$html->link('Search', array('controller' => 'searches', 'action' => 'find'), array('data-icon' => 'search', 'data-role' => 'button')).'</li>';
	?>
		</ul>
	</div>
	<div data-role="controlgroup" data-type="horizontal" style="width: 100%; text-align: center" id="control-menu">
		<?php echo $html->link('Scan', '#', array('data-icon' => 'grid', 'data-role' => 'button', 'style' => 'display: none;', 'class' => 'qr-scan-button')); ?>
	</div>
	<?php
	foreach($containers as $container) {
		echo $html->tag('li',
			$html->link($container['Container']['name'],
				array('controller' => 'containers', 'action' => 'view', $container['Container']['slug'])) .
			$html->tag('span', $container['Container']['container_item_count'], array('class' => 'ui-li-count ui-btn-up-c ui-btn-corner-all'))
		);
	}
?>
</ul>
