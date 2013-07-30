<?php
	echo $this->Html->scriptBlock("
		var container_view = '$container_view'
	");
	echo $this->Html->script('views/containers/index', array('inline' => false));
	echo $this->Html->scriptBlock("var _PAGE = '{$this->Paginator->params['paging']['Container']['page']}'", array('inline' => false));
?>

<?php if(empty($containers)): ?>
	<p><?php __('No containers for this location.') ?></p>
<?php else: ?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th><?php echo __('Quantity') ?></th>
				<th><?php echo __('Title') ?></th>
				<th><?php echo __('Last Modified') ?></th>
				<th>&nbsp;</th>
		</thead>
		<tbody>
			<?php foreach ($containers as $container): ?>
			<tr>
				<td><?php echo $container['Container']['container_item_count'] ?></td>
				<td><?php echo $this->Html->link($container['Container']['name'], array('controller' => 'containers', 'action' => 'view', $container['Container']['slug'])) ?></td>
				<td><?php echo $this->Time->timeAgoInWords($container['Container']['modified']) ?></td>
				<td>
					<div class="btn-group pull-right">
  						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Options <span class="caret"></span></button>
  							<ul class="dropdown-menu">
    							<li><?php echo $this->Html->link('View', array('controller' => 'containers', 'action' => 'view', $container['Container']['slug'])) ?></li>
    							<li><?php echo $this->Html->link('Edit', array('controller' => 'containers', 'action' => 'edit', $container['Container']['uuid']), array('data-toggle' => 'modal', 'data-target' => '#layout-modal')) ?></li>
    							<li class="divider"></li>
    							<li><?php echo $this->Html->link('Delete', array('controller' => 'containers', 'action' => 'delete', $container['Container']['uuid'])) ?></li>
  							</ul>
					</div>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
