<?php 
	echo $html->script('views/container_items/index', array('inline' => false)); 
	echo $html->scriptBlock("var _PAGE = '{$paginator->params['paging']['ContainerItem']['page']}'", array('inline' => false));
?>
<br/>
<?php
	echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add_item')));
	echo $form->input('ContainerItem.body', array('type' => 'text', 'label' => false, 'class' => 'container_item_index focus', 'maxlength' => 100));
	echo $html->tag('span', ' x ', array('style' => 'float: left; padding: 0 10px;'));
	echo $form->input('ContainerItem.quantity', array('type' => 'text', 'label' => false, 'maxlength' => 5, 'style' => 'width: 40px; float: left'));
	echo $form->input('ContainerItem.container_id', array('options' => $containers, 'empty' => __('Select a container', true), 'label' => false, 'style' => 'float: left; margin-left: 5px;')).'&nbsp;';
	echo $form->submit(__('Add Item', true), array('div' => false, 'class' => 'btn success small', 'style' => 'float: left'));
	echo $form->end();
?>
<div style="clear: both"></div>
<br/>
<div style="float: right">
	<?php echo $form->input('order', array('options' => array('ContainerItem.body' => 'Item Text', 'Container.name' => 'Container Name', 'ContainerItem.modified' => 'Modified Date'), 'label' => false, 'empty' => '(Order By)', 'div' => false)); ?>
	<?php echo $form->input('direction', array('options' => array('asc' => __('Ascending', true), 'desc' => __('Descending', true)), 'label' => false, 'empty' => __('(Direction)', true), 'div' => false)); ?>
	<?php echo $form->submit(__('Sort', true), array('div' => false, 'class' => 'btn primary small', 'id' => 'sort-button')); ?>
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
						<?php echo $html->link($item['Container']['name'], array('controller' => 'containers', 'action' => 'view', $item['Container']['slug'])); ?><br/>
						<small><?php echo $time->timeAgoInWords($item['ContainerItem']['modified']); ?></small>
					</p>
					<div class="container-item-list-options">
						<?php echo $html->link($html->image('icons/edit.png'), array('controller' => 'container_items', 'action' => 'edit', $item['ContainerItem']['uuid']), array('escape' => false, 'class' => 'ui-modal')); ?>
						<?php echo $html->link($html->image('icons/delete.png'), array('controller' => 'container_items', 'action' => 'delete', $item['ContainerItem']['uuid']), array('escape' => false), 'Are you sure you want to delete this item?'); ?>
					</div>
					<div style="clear: both"></div>
				</div>
		<?php
			}
	}
