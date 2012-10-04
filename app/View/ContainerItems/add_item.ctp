<h2><?php echo __('Add Container Item'); ?></h2>
<?php
echo $this->Form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add_item')));
echo $this->Form->input('ContainerItem.body', array('type' => 'text', 'label' => 'Item'));
echo $this->Form->input('ContainerItem.container_id', array('options' => $containers, 'label' => 'Container', 'empty' => __('Select a container')));
echo $this->Form->input('quantity', array('type' => 'text', 'length' => 100));
echo '<br/>';
echo $this->Form->submit(__('Add Item'), array('div' => false, 'class' => 'btn success'));
echo $this->Form->end();