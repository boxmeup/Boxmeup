<?php
	echo $this->Html->scriptBlock("
		var container_view = '$container_view'
	");
	echo $this->Html->script('views/containers/index', array('inline' => false));
	foreach($containers as $i => $container) {
		$link_contents = $html->image('generic-box.png');
		$link_contents.= $html->tag('br');
		$link_contents.= $html->tag('div', $container['Container']['name'], array('class' => 'container-name'));
		$link_contents.= $html->tag('br');
		$link_contents.= "Items: {$container['Container']['container_item_count']}";
		echo $html->link(
			$link_contents,
			array('controller' => 'containers', 'action' => 'view', $container['Container']['slug']),
			array('class' => 'container-box', 'escape' => false)
		);
	}
