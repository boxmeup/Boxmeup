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
<h2><?php echo $container['Container']['name']; ?></h2>
<br/>
<?php
	echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid'])));
	echo $form->input('body', array('type' => 'text', 'label' => false, 'class' => 'container_view_add focus', 'maxlength' => 100));
	echo $form->submit('Add Item', array('div' => false, 'class' => 'small green button', 'style' => 'float: left'));
	echo $form->end();
	echo $html->tag('div', '', array('style' => 'clear: both'));
	if(empty($container_items))
		echo $html->tag('p', __('No items yet.', true));
	else {
		foreach($container_items as $key => $item) {
?>
			<div class="container-item-list" >
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
