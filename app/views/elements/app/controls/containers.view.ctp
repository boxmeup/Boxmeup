<?php
	echo $html->link('List Containers', array('controller' => 'containers', 'action' => 'index'), array('class' => 'medium blue button'));
	echo '<br/><br/>';
	echo $html->link('Delete Container', array('controller' => 'containers', 'action' => 'delete', $container['Container']['uuid']), array('class' => 'medium red button'), 'Are you sure you want to delete this container?');