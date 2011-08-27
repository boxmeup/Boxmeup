<h2>Edit Item</h2><br/>
<?php
	echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'edit')));
	echo $form->input('ContainerItem.uuid', array('type' => 'hidden'));
	echo $form->input('Container.slug', array('type' => 'hidden'));
	echo $form->input('body', array('label' => 'Item Content', 'class' => 'focus'));
	echo $form->input('quantity', array('type' => 'text', 'maxlength' => 5, 'style' => 'width: 50px;'));
	echo $form->input('Container.uuid', array('options' => $containers, 'label' => 'Container'));
	echo '<br/>';
	echo $form->submit('Save Item', array('class' => 'btn success'));
	echo $form->end();
