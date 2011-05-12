<?php
	echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid'])));
	echo $form->input('body', array('type' => 'text', 'label' => false, 'maxlength' => 100));
	echo $form->submit('Add Item');
	echo $form->end();
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
				array('controller' => 'container_items', 'action' => 'view', $item['ContainerItem']['uuid']))
			);
		}
?>
	</ul>
<?php
	}
