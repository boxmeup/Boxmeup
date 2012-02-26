<?php
	echo $html->script('jquery.popupWindow', array('inline' => false));
	echo $html->scriptBlock("
		$(document).ready(function() {
			$('.print').popupWindow({
				height:350,
				width:400,
				top:100,
				left:100
			});
		});
	");
	echo $html->script('views/containers/view', array('inline' => false));
?>
<h2 style="float: left;"><?php echo $container['Container']['name']; ?></h2>
<?php 
	echo $html->link(__('Edit Name or Location', true), array('action' => 'edit', $container['Container']['uuid']), array('class' => 'ui-modal btn primary', 'style' => 'margin-left: 20px;')); 
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
	echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid'])));
	echo $form->hidden('Container.uuid', array('value' => $container['Container']['uuid']));
	echo $form->input('body', array('type' => 'text', 'label' => false, 'class' => 'container_view_add focus', 'maxlength' => 100));
	echo $html->tag('span', ' x ', array('style' => 'float: left; padding: 0 10px;'));
	echo $form->input('quantity', array('type' => 'text', 'label' => false, 'maxlength' => 5, 'style' => 'width: 40px; float: left'));
	echo $form->submit(__('Add Item', true), array('div' => false, 'class' => 'btn success', 'style' => 'float: left; margin-left: 5px;'));
	echo $form->end();
	echo $html->tag('div', '', array('style' => 'clear: both'));
?>
	<div id="item-container">
<?php
	if(empty($container_items))
		echo $html->tag('p', __('No items yet.', true), array('class' => 'no-items'));
	else {
		foreach($container_items as $key => $item) {
?>
			<div class="container-item-list" >
				<span class="container-item-list-quantity">
					<?php echo $item['ContainerItem']['quantity']; ?>
				</span>
				<p class="container-item-list-content">
					<?php echo Sanitize::html($item['ContainerItem']['body'], array('remove' => true)); ?>
					<br/><small><?php echo $time->timeAgoInWords($item['ContainerItem']['modified']); ?></small>
				</p>
				<div class="container-item-list-options">
					<?php echo $html->link($html->image('icons/edit.png'), array('controller' => 'container_items', 'action' => 'edit', $item['ContainerItem']['uuid']), array('escape' => false, 'class' => 'ui-modal')); ?>
					<?php echo $html->link($html->image('icons/delete.png'), array('controller' => 'container_items', 'action' => 'delete', $item['ContainerItem']['uuid']), array('escape' => false), __('Are you sure you want to delete this item?', true)); ?>
				</div>
				<div style="clear: both"></div>
			</div>
<?php
		}
	}
?>
	</div>
