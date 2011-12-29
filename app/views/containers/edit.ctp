<h2>Edit Container</h2>
<br/>
<?php 
	echo $form->create('Container', array('url' => array('action' => 'edit')));
	echo $form->hidden('Container.uuid');
	echo $form->input('name', array('label' => 'Name'));
	echo $form->input('location_id', array('label' => 'Location', 'options' => $location_list, 'empty' => '-- Unassigned --'));
	echo '<br/>';
	echo $form->submit('Update Container', array('class' => 'btn primary'));
	echo $form->end();
