<?php
	echo $this->Html->script('jquery.popupWindow', array('inline' => false));
	echo $this->Html->scriptBlock("
		$(function() {
			$('.print').popupWindow({
				height:350,
				width:400,
				top:100,
				left:100
			});
		});
	", array('inline' => false));
	echo $this->Html->script('views/containers/view', array('inline' => false));
?>
<h2><?php echo $container['Container']['name']; ?></h2>
<p>
<?php
	if(!empty($container['Location']['name'])) {
		echo '@ ' . $this->Html->link($container['Location']['name'], array('controller' => 'locations', 'action' => 'edit', $container['Location']['uuid'])) . '&nbsp;';
		if($container['Location']['is_mappable']) {
			echo '<small>(' . $this->Html->link('View Map', 'http://maps.google.com/maps?q=' . urlencode($container['Location']['address']), array('target' => '_NEW')) . ')</small>';
		}
	}
?>
</p>
<?php
	echo $this->Form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid']), 'class' => 'form-inline', 'autocomplete' => 'off'));
	echo $this->Form->hidden('Container.uuid', array('value' => $container['Container']['uuid']));
	echo $this->Form->input('body', array('type' => 'text', 'label' => false, 'class' => 'container_view_add focus form-control', 'maxlength' => 100, 'style' => 'width: 300px', 'div' => false));
	echo $this->Html->tag('span', ' x ', array('style' => 'padding: 0 10px;'));
	echo $this->Form->input('quantity', array('type' => 'text', 'label' => false, 'class' => 'form-control', 'maxlength' => 5, 'style' => 'width: 40px', 'div' => false));
?>
	<button type="submit" class="btn btn-success"><?php echo __('Add Item') ?></button>
<?php
	echo $this->Form->end();
?>
<br>
<?php
	if(empty($container_items)):
		echo $this->Html->tag('p', __('No items yet.'), array('class' => 'alert alert-info no-items'));
	else:
?>
<table class="table table-hover item-container">
	<thead>
		<tr>
			<th><?php echo __('Quantity') ?></th>
			<th><?php echo __('Description') ?></th>
			<th><?php echo __('Last Modified') ?></th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php
		foreach($container_items as $key => $item):
?>
		<tr>
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
<?php
		endforeach;
?>
	</tbody>
</table>
<?php
	endif;
