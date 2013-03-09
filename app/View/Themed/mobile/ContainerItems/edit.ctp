<?php
	echo $this->Form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'edit'), 'data-ajax' => 'false'));
	echo $this->Form->input('ContainerItem.uuid', array('type' => 'hidden'));
	echo $this->Form->input('Container.slug', array('type' => 'hidden'));
	echo $this->Form->input('body', array('label' => 'Item Content', 'class' => 'focus'));
	echo $this->Form->input('quantity', array('maxlength' => 5, 'style' => 'width: 50px;'));
	echo $this->Form->input('Container.uuid', array('options' => $containers, 'label' => 'Container'));
	echo '<br/>';
?>
<div class="ui-grid-a">
	<div class="ui-block-a">
<?php
	echo $this->Html->link('Delete', array('controller' => 'container_items', 'action' => 'delete', $item_uuid), array('escape' => false, 'data-role' => 'button', 'data-icon' => 'delete', 'data-theme' => 'a'));
?>
	</div>
	<div class="ui-block-b">
<?php
	echo $this->Form->submit('Save', array('class' => 'btn success', 'div' => false, 'data-icon' => 'check'));
?>
	</div>
</div>
<?php
	echo $this->Form->end();
	
