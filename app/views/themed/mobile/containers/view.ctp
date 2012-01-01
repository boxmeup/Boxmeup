<div data-role="navbar" data-type="horizontal" style="width: 100%; text-align: center" id="control-menu">
	<ul>
<?php
	echo '<li>'.$html->link('Add Item', array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid']), array('data-rel' => 'dialog', 'data-role' => 'button', 'data-transition' => 'slidedown')).'</li>';
	echo '<li>'.$html->link('Edit Container', array('controller' => 'containers', 'action' => 'edit', $container['Container']['uuid']), array('data-rel' => 'dialog', 'data-role' => 'button', 'data-transition' => 'slidedown')).'</li>';
?>
	</ul>
</div>
<?php
	echo $html->tag('div', '', array('style' => 'clear: both'));
	if(empty($container_items))
		echo $html->tag('p', __('No items yet.', true));
	else {
?>
	<br/>
	<ul data-role="listview" data-theme="c">
<?php
		foreach($container_items as $key => $item) {
			echo $html->tag('li', $html->link($item['ContainerItem']['body'],
				array('controller' => 'container_items', 'action' => 'edit', $item['ContainerItem']['uuid'])) .
				$html->tag('span', $item['ContainerItem']['quantity'], array('class' => 'ui-li-count ui-btn-up-c ui-btn-corner-all'))
			);
		}
?>
	</ul>
<?php
	}
