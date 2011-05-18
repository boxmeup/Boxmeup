<?php
	echo $html->link('Add Item', array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid']), array('data-rel' => 'dialog', 'data-role' => 'button', 'data-transition' => 'slidedown'));
//	echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid'])));
//	echo $form->input('body', array('type' => 'text', 'label' => false, 'maxlength' => 100));
//	echo $form->submit('Add Item');
//	echo $form->end();
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
