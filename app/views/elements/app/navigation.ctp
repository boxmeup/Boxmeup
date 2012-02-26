<?php
	if(!isset($active))
		$active = '';
	$menu = array(
		'containers.dashboard' => array(
			'label' => __('Dashboard', true),
			'link' => '/dashboard',
		),
		'containers.index' => array(
			'label' => __('My Containers', true),
			'link' => array('controller' => 'containers', 'action' => 'index')
		),
		'container_items.index' => array(
			'label' => __('My Items', true),
			'link' => array('controller' => 'container_items', 'action' => 'index')
		),
		'locations.index' => array(
			'label' => __('My Locations', true),
			'link' => array('controller' => 'locations', 'action' => 'index')
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