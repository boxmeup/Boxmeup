<h2>Add Container Item</h2>
<?php
echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid'])));
echo $form->input('body', array('type' => 'text', 'label' => 'Item'));
echo $form->input('quantity', array('type' => 'text', 'length' => 100));
echo $form->submit('Add Item', array('div' => false, 'class' => 'small green button'));
echo $form->end();