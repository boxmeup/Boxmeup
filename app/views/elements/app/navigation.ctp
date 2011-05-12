<?php
	if(!isset($active))
		$active = '';
	$menu = array(
		'containers.dashboard' => array(
			'label' => 'Dashboard',
			'link' => '/dashboard',
		),
		'containers.index' => array(
			'label' => 'My Containers',
			'link' => array('controller' => 'containers', 'action' => 'index')
		),
		'container_items.index' => array(
			'label' => 'My Items',
			'link' => array('controller' => 'container_items', 'action' => 'index')
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
	<div id="search">
	<?php
		echo $form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'find')));
		echo $form->input('query', array('label' => false, 'type' => 'text', 'div' => false));
		echo $form->submit('Search', array('div' => false));
		echo $form->end();
	?>
	</div>
	<div style="clear: both"></div>
</div>