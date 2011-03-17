<?php
	echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'edit')));
	echo $form->input('ContainerItem.uuid', array('type' => 'hidden'));
	echo $form->input('Container.uuid', array('type' => 'hidden'));
	echo $form->input('Container.slug', array('type' => 'hidden'));
	echo $form->input('body');
	echo $form->submit('Save', array('class' => 'medium green button'));
	echo $form->end();