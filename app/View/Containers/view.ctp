<?php
	echo $this->Html->script('jquery.popupWindow', array('inline' => false));
	echo $this->Html->scriptBlock("
		$(function() {
			$('.print').popupWindow({
				height:350,
				width:400,
				top:100,
				left:100
			});
		});
	", array('inline' => false));
	echo $this->Html->script('views/containers/view', array('inline' => false));
?>
<h2 style="float: left;"><?php echo $container['Container']['name']; ?></h2>
<?php 
	echo $this->Html->link(__('Edit Name or Location'), array('action' => 'edit', $container['Container']['uuid']), array('class' => 'ui-modal btn primary', 'style' => 'margin-left: 20px;')); 
?>
<div style="clear: both">&nbsp;</div>
<p>
<?php
	if(!empty($container['Location']['name'])) {
		echo '@ ' . $this->Html->link($container['Location']['name'], array('controller' => 'locations', 'action' => 'edit', $container['Location']['uuid'])) . '&nbsp;';
		if($container['Location']['is_mappable']) {
			echo '<small>(' . $this->Html->link('View Map', 'http://maps.google.com/maps?q=' . urlencode($container['Location']['address']), array('target' => '_NEW')) . ')</small>';
		}
	} else {
		echo $this->Html->link('Assign a Location', array('action' => 'edit', $container['Container']['uuid']), array('class' => 'ui-modal btn primary', 'style' => 'margin-left: 20px;'));
	}
?>
</p>
<div class="alert-message error ajax-error" style="display: none">
	<a href="#" class="close">x</a>
	<span class="error-msg"></span>
</div>
<?php
	echo $this->Form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid'])));
	echo $this->Form->hidden('Container.uuid', array('value' => $container['Container']['uuid']));
	echo $this->Form->input('body', array('type' => 'text', 'label' => false, 'class' => 'container_view_add focus', 'maxlength' => 100));
	echo $this->Html->tag('span', ' x ', array('style' => 'float: left; padding: 0 10px;'));
	echo $this->Form->input('quantity', array('type' => 'text', 'label' => false, 'maxlength' => 5, 'style' => 'width: 40px; float: left'));
	echo $this->Form->submit(__('Add Item'), array('div' => false, 'class' => 'btn success', 'style' => 'float: left; margin-left: 5px;'));
	echo $this->Form->end();
	echo $this->Html->tag('div', '', array('style' => 'clear: both'));
?>
	<div id="item-container">
<?php
	if(empty($container_items))
		echo $this->Html->tag('p', __('No items yet.'), array('class' => 'no-items'));
	else {
		foreach($container_items as $key => $item) {
?>
			<div class="container-item-list" >
				<span class="container-item-list-quantity">
					<?php echo $item['ContainerItem']['quantity']; ?>
				</span>
				<p class="container-item-list-content">
					<?php echo Sanitize::html($item['ContainerItem']['body'], array('remove' => true)); ?>
					<br/><small><?php echo $this->Time->timeAgoInWords($item['ContainerItem']['modified']); ?></small>
				</p>
				<div class="container-item-list-options">
					<?php echo $this->Html->link($this->Html->image('icons/edit.png'), array('controller' => 'container_items', 'action' => 'edit', $item['ContainerItem']['uuid']), array('escape' => false, 'class' => 'ui-modal')); ?>
					<?php echo $this->Html->link($this->Html->image('icons/delete.png'), array('controller' => 'container_items', 'action' => 'delete', $item['ContainerItem']['uuid']), array('escape' => false), __('Are you sure you want to delete this item?')); ?>
				</div>
				<div style="clear: both"></div>
			</div>
<?php
		}
	}
?>
	</div>
