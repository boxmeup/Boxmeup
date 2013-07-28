<?php
	if(!isset($active))
		$active = '';
	$menu = array(
		'containers.dashboard' => array(
			'label' => __('Dashboard'),
			'link' => '/dashboard',
		),
		'containers.index' => array(
			'label' => __('My Containers'),
			'link' => array('controller' => 'containers', 'action' => 'index')
		),
		'container_items.index' => array(
			'label' => __('My Items'),
			'link' => array('controller' => 'container_items', 'action' => 'index')
		),
		'locations.index' => array(
			'label' => __('My Locations'),
			'link' => array('controller' => 'locations', 'action' => 'index')
		)
	);
?>
<div class="well well-small col-lg-2" style="position:fixed">
	<ul class="nav nav-pills nav-stacked">
	<?php
		foreach($menu as $path => $link) {
			echo $this->Html->tag('li', $this->Html->link($link['label'], $link['link']), array('class' => $path == $active ? 'active' : ''));
		}
	?>
	</ul>
</div>
