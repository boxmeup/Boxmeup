<?php 
	echo $html->script('views/container_items/index', array('inline' => false)); 
	echo $html->scriptBlock("var _PAGE = '{$paginator->params['paging']['ContainerItem']['page']}'", array('inline' => false));
?>
<br/>
<?php
	echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add_item')));
	echo $form->input('ContainerItem.body', array('type' => 'text', 'label' => false, 'class' => 'container_item_index focus', 'maxlength' => 100));
	echo $form->input('ContainerItem.container_id', array('options' => $containers, 'empty' => 'Select a container', 'label' => false, 'style' => 'float: left'));
	echo $form->submit('Add Item', array('div' => false, 'class' => 'small green button', 'style' => 'float: left'));
	echo $form->end();
?>
<div style="clear: both"></div>
<br/>
<div style="float: right">
	<?php echo $form->input('order', array('options' => array('ContainerItem.body' => 'Item Text', 'Container.name' => 'Container Name', 'ContainerItem.modified' => 'Modified Date'), 'label' => false, 'empty' => '(Order By)', 'div' => false)); ?>
	<?php echo $form->input('direction', array('options' => array('asc' => 'Ascending', 'desc' => 'Descending'), 'label' => false, 'empty' => '(Direction)', 'div' => false)); ?>
	<?php echo $form->submit('Sort', array('div' => false, 'class' => 'small blue button', 'id' => 'sort-button')); ?>
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
