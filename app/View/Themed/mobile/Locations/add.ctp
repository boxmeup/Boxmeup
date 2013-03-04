<?php
	echo $this->Form->create('Location', array('url' => array('controller' => 'locations', 'action' => 'add')));
	echo $this->Form->input('name');
	echo '<br/>';
	echo $this->Form->input('address');
	echo '<br/>';
	echo $this->Form->submit('Add', array('div' => false, 'data-theme' => 'b'));
	echo $this->Form->end();