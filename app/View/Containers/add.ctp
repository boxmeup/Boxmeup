<h2><?php echo __('Add New Container'); ?></h2>
<?php
	echo $this->Form->create('Container', array('url' => array('controller' => 'containers', 'action' => 'add')));
	echo $this->Form->input('name', array('label' => __('Container Name'), 'class' => 'focus'));
	echo '<br/>';
	echo $this->Form->submit(__('Add'), array('div' => false, 'class' => 'btn success'));
	echo $this->Form->end();
