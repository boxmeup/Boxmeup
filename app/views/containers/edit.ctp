<h2><?php __('Edit Container'); ?></h2>
<br/>
<?php 
	echo $form->create('Container', array('url' => array('action' => 'edit')));
	echo $form->hidden('Container.uuid');
	echo $form->input('name', array('label' => __('Name', true)));
	echo '<br/>';
	echo $form->input('location_id', array('label' => 'Location', 'options' => $location_list, 'empty' => '-- Unassigned --'));
	echo '<br/>';
	echo $form->submit(__('Update Container', true), array('class' => 'btn primary'));
	echo $form->end();
