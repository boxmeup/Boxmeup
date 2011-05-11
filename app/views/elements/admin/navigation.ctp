<?php
	if(!isset($active))
		$active = '';
	$menu = array(
		'users.index' => array(
			'label' => 'Users',
			'link' => '/admin/users',
		),
		'containers.index' => array(
			'label' => 'Containers',
			'link' => array('controller' => 'containers', 'action' => 'index', 'admin' => true)
		),
		'container_items.index' => array(
			'label' => 'Items',
			'link' => array('controller' => 'container_items', 'action' => 'index', 'admin' => true)
		)
	);
?>
<div id="navigation">
	<ul>
	<?php
		foreach($menu as $path => $link) {
			echo $this->Html->tag('li', $this->Html->link($link['label'], $link['link']), array('class' => $path == $active ? 'active' : ''));
		}
	?>
	</ul>
	<div style="clear: both"></div>
</div>