<h2><?php echo __('Edit Item'); ?></h2><br/>
<?php
	echo $this->Form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'edit')));
	echo $this->Form->input('ContainerItem.uuid', array('type' => 'hidden'));
	echo $this->Form->input('Container.slug', array('type' => 'hidden'));
	echo $this->Form->input('body', array('label' => __('Item Content'), 'class' => 'focus'));
	echo $this->Form->input('quantity', array('type' => 'text', 'maxlength' => 5, 'style' => 'width: 50px;'));
	echo $this->Form->input('Container.uuid', array('options' => $containers, 'label' => 'Container'));
	echo '<br/>';
	echo $this->Form->submit(__('Save Item'), array('class' => 'btn success'));
	echo $this->Form->end();
