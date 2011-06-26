<div class="container-item-list new-item" style="display: none">
	<span class="container-item-list-quantity">
		<?php echo $item['ContainerItem']['quantity']; ?>
	</span>
	<p class="container-item-list-content">
		<?php echo Sanitize::html($item['ContainerItem']['body'], array('remove' => true)); ?>
		<br/><small><?php echo $time->timeAgoInWords($item['ContainerItem']['modified']); ?></small>
	</p>
	<div class="container-item-list-options" style="display: none">
		<?php echo $html->link($html->image('icons/edit.png'), array('controller' => 'container_items', 'action' => 'edit', $item['ContainerItem']['uuid']), array('escape' => false, 'class' => 'ui-modal')); ?>
		<?php echo $html->link($html->image('icons/delete.png'), array('controller' => 'container_items', 'action' => 'delete', $item['ContainerItem']['uuid']), array('escape' => false), 'Are you sure you want to delete this item?'); ?>
	</div>
	<div style="clear: both"></div>
</div>