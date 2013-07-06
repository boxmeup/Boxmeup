<?php
	echo $this->Html->scriptBlock("
		var container_view = '$container_view'
	");
	echo $this->Html->script('views/containers/index', array('inline' => false));
	echo $this->Html->scriptBlock("var _PAGE = '{$this->Paginator->params['paging']['Container']['page']}'", array('inline' => false));
?>
<div style="float: right">
	<?php
		echo $this->Form->select('Location.uuid', $location_list, array('empty' => __('All Locations')));
	?>
	<?php echo $this->Form->input('order', array('options' => array('Container.name' => 'Container Name', 'Container.modified' => 'Modified Date'), 'label' => false, 'empty' => '(Order By)', 'div' => false)); ?>
	<?php echo $this->Form->input('direction', array('options' => array('asc' => __('Ascending'), 'desc' => __('Descending')), 'label' => false, 'empty' => __('(Direction)'), 'div' => false)); ?>
	<?php echo $this->Form->submit(__('Sort'), array('div' => false, 'class' => 'btn primary small', 'id' => 'sort-button')); ?>
</div>
<div style="clear: both">&nbsp;</div>
<?php
	if(empty($containers)) {
		echo '<p>' . __('No containers for this location.') . '</p>';
	}
	foreach($containers as $i => $container) {
?>	
		<div class="container-item-list" >
			<span class="container-item-list-quantity">
				<?php echo $container['Container']['container_item_count']; ?>
			</span>
			<p class="container-item-list-content">
				<?php echo $this->Html->link($container['Container']['name'], array('controller' => 'containers', 'action' => 'view', $container['Container']['slug'])); ?><br/>
				<?php if(!empty($container['Location']['uuid'])) { ?>
					@ <?php echo $this->Html->link($container['Location']['name'], array('controller' => 'containers', 'action' => 'index', 'location' => $container['Location']['uuid'])); ?><br/>
				<?php } ?>
				
				<small><?php echo $this->Time->timeAgoInWords($container['Container']['modified']); ?></small>
			</p>
			<div class="container-item-list-options">
				<?php echo $this->Html->link($this->Html->image('icons/edit.png'), array('controller' => 'containers', 'action' => 'edit', $container['Container']['uuid']), array('escape' => false, 'class' => 'ui-modal')); ?>
				<?php echo $this->Html->link($this->Html->image('icons/delete.png'), array('controller' => 'containers', 'action' => 'delete', $container['Container']['uuid']), array('escape' => false), __('Are you sure you want to delete this container?')); ?>
			</div>
			<div style="clear: both"></div>
		</div>
<?php
	}
