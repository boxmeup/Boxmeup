<h2><?php echo __('Add Container Item'); ?></h2>
<?php
echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add_item')));
echo $form->input('ContainerItem.body', array('type' => 'text', 'label' => 'Item'));
echo $form->input('ContainerItem.container_id', array('options' => $containers, 'label' => 'Container', 'empty' => __('Select a container', true)));
echo $form->input('quantity', array('type' => 'text', 'length' => 100));
echo '<br/>';
echo $form->submit(__('Add Item', true), array('div' => false, 'class' => 'btn success'));
echo $form->end();