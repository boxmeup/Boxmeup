<?php 
	echo $this->Html->script('views/container_items/index', array('inline' => false)); 
	echo $this->Html->scriptBlock("var _PAGE = '{$this->Paginator->params['paging']['ContainerItem']['page']}'", array('inline' => false));
?>
<br/>
<?php
	echo $this->Form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add_item')));
	echo $this->Form->input('ContainerItem.body', array('type' => 'text', 'label' => false, 'class' => 'container_item_index focus', 'maxlength' => 100));
	echo $this->Html->tag('span', ' x ', array('style' => 'float: left; padding: 0 10px;'));
	echo $this->Form->input('ContainerItem.quantity', array('type' => 'text', 'label' => false, 'maxlength' => 5, 'style' => 'width: 40px; float: left'));
	echo $this->Form->input('ContainerItem.container_id', array('options' => $containers, 'empty' => __('Select a container'), 'label' => false, 'style' => 'float: left; margin-left: 5px;')).'&nbsp;';
	echo $this->Form->submit(__('Add Item'), array('div' => false, 'class' => 'btn success small', 'style' => 'float: left'));
	echo $this->Form->end();
?>
<div style="clear: both"></div>
<br/>
<div style="float: right">
	<?php echo $this->Form->input('order', array('options' => array('ContainerItem.body' => 'Item Text', 'Container.name' => 'Container Name', 'ContainerItem.modified' => 'Modified Date'), 'label' => false, 'empty' => '(Order By)', 'div' => false)); ?>
	<?php echo $this->Form->input('direction', array('options' => array('asc' => __('Ascending'), 'desc' => __('Descending')), 'label' => false, 'empty' => __('(Direction)'), 'div' => false)); ?>
	<?php echo $this->Form->submit(__('Sort'), array('div' => false, 'class' => 'btn primary small', 'id' => 'sort-button')); ?>
	<div style="clear: both"></div>
</div>
<br/>
<?php
	if(empty($container_items)) {
?>
<p>No items yet.</p>
<?php } else { ?>
		<?php
			foreach($container_items as $key => $item) {
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
					<div class="container-item-list-options">
						<?php echo $this->Html->link($this->Html->image('icons/edit.png'), array('controller' => 'container_items', 'action' => 'edit', $item['ContainerItem']['uuid']), array('escape' => false, 'class' => 'ui-modal')); ?>
						<?php echo $this->Html->link($this->Html->image('icons/delete.png'), array('controller' => 'container_items', 'action' => 'delete', $item['ContainerItem']['uuid']), array('escape' => false), 'Are you sure you want to delete this item?'); ?>
					</div>
					<div style="clear: both"></div>
				</div>
		<?php
			}
	}
