<h2>Edit Container</h2>
<br/>
<?php 
	echo $form->create('Container', array('url' => array('action' => 'edit')));
	echo $form->hidden('Container.uuid');
	echo $form->input('name', array('label' => 'Container Name'));
	echo '<br/>';
	echo $form->submit('Update Container', array('class' => 'btn primary'));
	echo $form->end();
