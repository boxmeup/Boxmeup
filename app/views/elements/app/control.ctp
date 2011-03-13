<?php
	$control_links = array(
		'container_index' => array(
			array(
				'link' => array('controller' => 'containers', 'action' => 'add'),
				'label' => 'Add New Container',
				'class' => 'small green button'
			)
		),
		'container_add' => array(
			array(
				'link' => array('controller' => 'containers', 'action' => 'index'),
				'label' => 'List Containers',
				'class' => 'small blue button'
			)
		),
		'container_view' => array(
			array(
				'link' => array('controller' => 'containers', 'action' => 'index'),
				'label' => 'List Containers',
				'class' => 'small blue button'
			),
			array(
				'link' => array('controller' => 'containers', 'action' => 'edit', isset($container_uuid) ? $container_uuid : ''),
				'label' => 'Edit Container',
				'class' => 'small orange button'
			),
			array(
				'link' => array('controller' => 'containers', 'action' => 'delete', isset($container_uuid) ? $container_uuid : ''),
				'label' => 'Delete Container',
				'class' => 'small red button'
			)
		)
	)
?>
<div id="control">
	<?php
		if(isset($controls)) {
			foreach($control_links[$controls] as $key => $control)
				echo $html->link($control['label'], $control['link'], array('class' => $control['class'])).'<br/>';
		}
	?>
</div>