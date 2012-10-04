<?php
	echo $this->Html->link('Back To Container', array('controller' => 'containers', 'action' => 'view', $this->request->data['Container']['slug']), array('class' => 'medium blue button'));
	echo '<br/><br/>';
	echo $this->Html->link('Delete Item', array('controller' => 'container_items', 'action' => 'delete', $this->request->data['ContainerItem']['uuid']), array('class' => 'medium red button'), 'Are you sure you want to delete this item?');