<h2>Add Location</h2>
<div class="left-form">
<?php
	echo $this->Form->create('Location', array('url' => array('controller' => 'locations', 'action' => 'add')));
	echo $this->Form->input('name');
	echo '<br/>';
	echo $this->Form->input('address');
	echo '<br/>';
	echo $this->Form->submit('Save', array('class' => 'btn success map-save btn-inline')).'&nbsp;&nbsp;';
	echo $this->Form->end();
?>
</div>
<div style="clear: both"></div>