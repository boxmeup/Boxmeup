<h2>Add New Container</h2>
<?php
	echo $form->create('Container', array('url' => array('controller' => 'containers', 'action' => 'add')));
	echo $form->input('name', array('label' => 'Container Name', 'class' => 'focus'));
	echo '<br/>';
	echo $form->submit('Add', array('div' => false, 'class' => 'btn success'));
	echo $form->end();
