<tr class="new-item" style="display: none">
	<td><?php echo $item['ContainerItem']['quantity']; ?></td>
	<td><?php echo Sanitize::html($item['ContainerItem']['body'], array('remove' => true)); ?></td>
	<td><?php echo $this->Time->timeAgoInWords($item['ContainerItem']['modified']); ?></td>
	<td>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Options <span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link('Edit', array('controller' => 'container_items', 'action' => 'edit', $item['ContainerItem']['uuid']), array('data-toggle' => 'modal', 'data-target' => '#layout-modal')) ?></li>
				<li class="divider"></li>
				<li><?php echo $this->Html->link('Delete', array('controller' => 'container_items', 'action' => 'delete', $item['ContainerItem']['uuid'])); ?></li>
			</ul>
		</div>
	</td>
</tr>
