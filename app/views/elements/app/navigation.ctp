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
		'tags.index' => array(
			'label' => 'Manage Tags',
			'link' => '#'
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
		echo $form->input('category', array('options' => array('Containers', 'Items'), 'div' => false, 'label' => false));
		echo $form->end();
	?>
	</div>
	<div style="clear: both"></div>
</div>