<?php 
	echo $this->Html->script('views/container_items/index', array('inline' => false)); 
	echo $this->Html->scriptBlock("var _PAGE = '{$this->Paginator->params['paging']['ContainerItem']['page']}'", array('inline' => false));
?>
<br/>
<?php
	echo $this->Form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add_item'), 'class' => 'form-inline'));
	echo $this->Form->input('ContainerItem.body', array('type' => 'text', 'label' => false, 'class' => 'container_item_index focus', 'maxlength' => 100, 'class' => 'form-control', 'style' => 'width: 300px', 'div' => false));
	echo $this->Html->tag('span', ' x ', array('style' => 'padding: 0 10px;'));
	echo $this->Form->input('ContainerItem.quantity', array('type' => 'text', 'label' => false, 'maxlength' => 5, 'class' => 'form-control', 'style' => 'width: 40px;', 'div' => false));
	echo $this->Form->input('ContainerItem.container_id', array('options' => $containers, 'empty' => __('Select a container'), 'label' => false, 'style' => 'margin-left: 5px; width: 150px', 'class' => 'form-control', 'div' => false)).'&nbsp;';
?>
<button type="submit" class="btn btn-success"><?php echo __('Add Item') ?></button>
<?php
	echo $this->Form->end();
?>
<br/>
<?php if(empty($container_items)): ?>
<p>No items yet.</p>
<?php else: ?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th><?php echo __('Quantity') ?></th>
				<th><?php echo __('Container Name') ?></th>
				<th><?php echo __('Body') ?></th>
				<th><?php echo __('Last Modified') ?></th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($container_items as $key => $item): ?>
			<tr>
				<td><?php echo $item['ContainerItem']['quantity']; ?></td>
				<td><?php echo $this->Html->link($item['Container']['name'], array('controller' => 'containers', 'action' => 'view', $item['Container']['slug'])); ?></td>
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
	<?php endforeach ?>
		</tbody>
	</table>
<?php endif; ?>
