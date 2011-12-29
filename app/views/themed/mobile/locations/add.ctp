<h2>Add Location</h2>
<div class="left-form">
<?php
	echo $form->create('Location', array('url' => array('controller' => 'locations', 'action' => 'add')));
	echo $form->input('name');
	echo '<br/>';
	echo $form->input('address');
	echo '<br/>';
	echo $form->submit('Save', array('class' => 'btn success map-save btn-inline')).'&nbsp;&nbsp;';
	echo $form->end();
?>
</div>
<div style="clear: both"></div>