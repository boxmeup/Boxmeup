<div class="stat stat-first">
	<h4><?php echo __('Locations'); ?></h4>
	<span class="stat-value"><?php echo number_format($total_locations); ?></span>
	<?php echo $this->Html->link(__('View Your Locations'), array('controller' => 'locations', 'action' => 'index'), array('class' => 'stat-view')); ?>
</div>
<div class="stat">
	<h4><?php echo __('Containers'); ?></h4>
	<span class="stat-value"><?php echo number_format($total_containers); ?></span>
	<?php echo $this->Html->link(__('View Your Containers'), array('controller' => 'containers', 'action' => 'index'), array('class' => 'stat-view')); ?>
</div>
<div class="stat">
	<h4><?php echo __('Items'); ?></h4>
	<span class="stat-value"><?php echo number_format($total_container_items); ?></span>
	<?php echo $this->Html->link(__('View Your Items'), array('controller' => 'container_items', 'action' => 'index'), array('class' => 'stat-view')); ?>
</div>
<div style="clear: both">&nbsp;</div>
<?php
	echo $this->GChart->start('containers_trend');
	echo $this->GChart->visualize('containers_trend', $container_graph);
?>
<?php if(!empty($recent_items)) {
	echo $this->Html->tag('h2', __('Recent Items')).$this->Html->tag('br');
	foreach($recent_items as $item) {
?>
<div class="container-item-list" >
	<span class="container-item-list-quantity">
		<?php echo $item['ContainerItem']['quantity']; ?>
	</span>
	<p class="container-item-list-content">
		<?php echo Sanitize::html($item['ContainerItem']['body'], array('remove' => true)); ?><br/>
		<?php echo $this->Html->link($item['Container']['name'], array('controller' => 'containers', 'action' => 'view', $item['Container']['slug'])); ?><br/>
		<small><?php echo $this->Time->timeAgoInWords($item['ContainerItem']['modified']); ?></small>
	</p>
	<div style="clear: both"></div>
</div>
<?php
	}
}
