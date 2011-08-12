<?php
	echo $this->Html->scriptBlock("
		var container_view = '$container_view'
	");
	echo $this->Html->script('views/containers/index', array('inline' => false));
	foreach($containers as $i => $container) {
?>	
		<div class="container-item-list" >
			<span class="container-item-list-quantity">
				<?php echo $container['Container']['container_item_count']; ?>
			</span>
			<p class="container-item-list-content">
				<?php echo $html->link($container['Container']['name'], array('controller' => 'containers', 'action' => 'view', $container['Container']['slug'])); ?><br/>
				<small><?php echo $time->timeAgoInWords($container['Container']['modified']); ?></small>
			</p>
			<div class="container-item-list-options">
				<?php echo $html->link($html->image('icons/edit.png'), array('controller' => 'containers', 'action' => 'edit', $container['Container']['uuid']), array('escape' => false, 'class' => 'ui-modal')); ?>
				<?php echo $html->link($html->image('icons/delete.png'), array('controller' => 'containers', 'action' => 'delete', $container['Container']['uuid']), array('escape' => false), 'Are you sure you want to delete this container?'); ?>
			</div>
			<div style="clear: both"></div>
		</div>
<?php
	}