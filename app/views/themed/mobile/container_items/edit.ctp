<h2>Edit Item</h2><br/>
<?php
	echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'edit')));
	echo $form->input('ContainerItem.uuid', array('type' => 'hidden'));
	echo $form->input('Container.slug', array('type' => 'hidden'));
	echo $form->input('body', array('label' => 'Item Content', 'class' => 'focus'));
	echo $form->input('quantity', array('maxlength' => 5, 'style' => 'width: 50px;'));
	echo $form->input('Container.uuid', array('options' => $containers, 'label' => 'Container'));
	echo '<br/>';
	echo $html->link('Delete Item', array('controller' => 'container_items', 'action' => 'delete', $item_uuid), array('escape' => false, 'data-role' => 'button', 'data-icon' => 'delete', 'data-inline' => true, 'data-theme' => 'a'));
	echo $form->submit('Save Item', array('class' => 'btn success', 'data-inline' => true, 'div' => false, 'data-icon' => 'check'));
	echo $form->end();
	
