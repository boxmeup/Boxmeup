<h2>Edit Item</h2><br/>
<?php
	echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'edit')));
	echo $form->input('ContainerItem.uuid', array('type' => 'hidden'));
	echo $form->input('Container.slug', array('type' => 'hidden'));
	echo $form->input('body', array('label' => 'Item Content', 'class' => 'focus'));
	echo $form->input('quantity', array('maxlength' => 5, 'style' => 'width: 50px;'));
	echo $form->input('Container.uuid', array('options' => $containers, 'label' => 'Container'));
	echo '<br/>';
?>
<div class="ui-grid-a">
	<div class="ui-block-a">
<?php
	echo $html->link('Delete Item', array('controller' => 'container_items', 'action' => 'delete', $item_uuid), array('escape' => false, 'data-role' => 'button', 'data-icon' => 'delete', 'data-theme' => 'a'));
?>
	</div>
	<div class="ui-block-b">
<?php
	echo $form->submit('Save Item', array('class' => 'btn success', 'div' => false, 'data-icon' => 'check'));
?>
	</div>
</div>
<?php
	echo $form->end();
	
