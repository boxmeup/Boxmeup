<h2><?php echo __('Add Container Item'); ?></h2>
<?php
echo $this->Form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid'])));
echo $this->Form->input('body', array('type' => 'text', 'label' => 'Item'));
echo $this->Form->input('quantity', array('length' => 100));
echo $this->Form->submit(__('Add Item'), array('div' => false, 'class' => 'small green button'));
echo $this->Form->end();