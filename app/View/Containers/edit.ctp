<h2><?php echo __('Edit Container'); ?></h2>
<br/>
<?php 
	echo $this->Form->create('Container', array('url' => array('action' => 'edit')));
	echo $this->Form->hidden('Container.uuid');
	echo $this->Form->input('name', array('label' => __('Name')));
	echo '<br/>';
	echo $this->Form->input('location_id', array('label' => 'Location', 'options' => $location_list, 'empty' => '-- Unassigned --'));
	echo '<br/>';
	echo $this->Form->submit(__('Update Container'), array('class' => 'btn primary'));
	echo $this->Form->end();
