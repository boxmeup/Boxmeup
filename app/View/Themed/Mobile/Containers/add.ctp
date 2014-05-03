<?php
	echo $this->Form->create('Container', array('url' => array('controller' => 'containers', 'action' => 'add')));
	echo $this->Form->input('name', array('label' => __('Container Name'), 'class' => 'focus'));
	echo $this->Form->input('location_id', array('label' => __('Location'), 'options' => $location_list, 'empty' => '-- Unassigned --', 'class' => 'form-control'));
	echo '<br/>';
	echo $this->Form->submit(__('Add'), array('div' => false, 'data-theme' => 'b'));
	echo $this->Form->end();
?>
