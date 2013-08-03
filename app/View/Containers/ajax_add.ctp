<tr class="new-item" style="display: none">
	<td><?php echo $item['ContainerItem']['quantity']; ?></td>
	<td><?php echo Sanitize::html($item['ContainerItem']['body'], array('remove' => true)); ?></td>
	<td><?php echo $this->Time->timeAgoInWords($item['ContainerItem']['modified']); ?></td>
	<td>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="icon-gear"></i> <span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a data-toggle="modal" data-target="#layout-modal" href="<?php echo Router::url(array('controller' => 'container_items', 'action' => 'edit', $item['ContainerItem']['uuid'])) ?>"><i class="icon-edit"></i> <?php echo __('Edit') ?></a></li>
				<li class="divider"></li>
				<li><a href="<?php echo Router::url(array('controller' => 'container_items', 'action' => 'delete', $item['ContainerItem']['uuid'])) ?>"><i class="icon-remove"></i> <?php echo __('Delete') ?></a></li>
			</ul>
		</div>
	</td>
</tr>
