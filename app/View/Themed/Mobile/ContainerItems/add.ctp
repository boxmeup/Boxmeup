<?php
echo $this->Form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid']), 'data-ajax' => 'false'));
echo $this->Form->input('body', array('type' => 'text', 'label' => 'Item'));
echo $this->Form->input('quantity', array('length' => 100));
echo $this->Form->submit('Add Item', array('div' => false, 'data-theme' => 'b', 'data-ajax' => 'false'));
echo $this->Form->end();