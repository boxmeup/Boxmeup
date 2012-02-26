<h2><?php __('Add New Container', true); ?></h2>
<?php
	echo $form->create('Container', array('url' => array('controller' => 'containers', 'action' => 'add')));
	echo $form->input('name', array('label' => __('Container Name', true), 'class' => 'focus'));
	echo '<br/>';
	echo $form->submit(__('Add', true), array('div' => false, 'class' => 'btn success'));
	echo $form->end();
