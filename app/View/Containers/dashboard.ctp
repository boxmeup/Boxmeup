<div class="row">
	<div class="col-lg-3 panel panel-primary">
		<div class="panel-heading"><?php echo __('Locations'); ?></div>
		<h2 style="text-align: center"><?php echo number_format($total_locations); ?></h2>
	</div>
	<div class="col-lg-3 col-offset-1 panel panel-primary">
		<div class="panel-heading"><?php echo __('Containers'); ?></div>
		<h2 style="text-align: center"><?php echo number_format($total_containers); ?></h2>
	</div>
	<div class="col-lg-3 col-offset-1 panel panel-primary">
		<div class="panel-heading"><?php echo __('Items'); ?></div>
		<h2 style="text-align: center"><span class="stat-value"><?php echo number_format($total_container_items); ?></h2>
	</div>
</div>

<h4><?php echo __('Recent Items') ?></h4>
<?php if(!empty($recent_items)): ?>
	
	<table class="table table-striped">
		<tbody>
	<?php foreach($recent_items as $item): ?>
		<tr>
			<td><?php echo $item['ContainerItem']['quantity']; ?></td>
			<td><?php echo Sanitize::html($item['ContainerItem']['body'], array('remove' => true)); ?></td>
			<td><?php echo $this->Html->link($item['Container']['name'], array('controller' => 'containers', 'action' => 'view', $item['Container']['slug'])); ?></td>
			<td><?php echo $this->Time->timeAgoInWords($item['ContainerItem']['modified']); ?></td>
		</tr>
	<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<div class="alert alert-info"><?php echo __('No recent items.') ?></div>
<?php endif;
