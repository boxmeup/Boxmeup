<?php
	echo $html->link('Back To Container', array('controller' => 'containers', 'action' => 'view', $this->data['Container']['slug']), array('class' => 'medium blue button'));
	echo '<br/><br/>';
	echo $html->link('Delete Item', array('controller' => 'container_items', 'action' => 'delete', $this->data['ContainerItem']['uuid']), array('class' => 'medium red button'), 'Are you sure you want to delete this item?');