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
	echo $html->link('Edit', array('action' => 'edit', $container['Container']['uuid']), array('class' => 'ui-modal small blue button', 'style' => 'margin-left: 20px;')); 
?>
<div style="clear: both">&nbsp;</div>
<div class="ui-widget ui-notification ajax-error" style="display: none">
	<div class="ui-state-error ui-corner-all" style="padding: 0pt 0.7em; margin-bottom: 10px;">
		<p style="padding: 5px;">
			<span class="ui-icon ui-icon-alert" style="float: left; margin-right: 0.3em;"></span>
			<strong>Error: </strong><span class="ui-error-message"></span>
		</p>
	</div>
</div>
<?php
	echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid'])));
	echo $form->hidden('Container.uuid', array('value' => $container['Container']['uuid']));
	echo $form->input('body', array('type' => 'text', 'label' => false, 'class' => 'container_view_add focus', 'maxlength' => 100));
	echo $html->tag('span', ' x ', array('style' => 'float: left; padding: 0 10px;'));
	echo $form->input('quantity', array('type' => 'text', 'label' => false, 'maxlength' => 5, 'style' => 'width: 40px; float: left'));
	echo $form->submit('Add Item', array('div' => false, 'class' => 'small green button', 'style' => 'float: left; margin-left: 5px;'));
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
					<?php echo $html->link($html->image('icons/delete.png'), array('controller' => 'container_items', 'action' => 'delete', $item['ContainerItem']['uuid']), array('escape' => false), 'Are you sure you want to delete this item?'); ?>
				</div>
				<div style="clear: both"></div>
			</div>
<?php
		}
	}
?>
	</div>
