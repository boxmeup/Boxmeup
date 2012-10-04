<?php echo $this->Html->script('views/containers/bulk_print', array('inline' => false)); ?>
<h2><?php echo __('Select Containers to Print Labels'); ?></h2><br/>
<table>
	<tr style="background-color: #333; color: #eee;">
		<td class="tip-s table-checkbox" title="Select All"><?php echo $this->Form->checkbox('selectall', array('label' => false, 'id' => 'container-selectall')); ?></td>
		<td><?php echo __('Container Name'); ?></td>
		<td><?php echo __('Item Count'); ?></td>
	</tr>
<?php
	echo $this->Form->create('Container', array('url' => array('controller' => 'containers', 'action' => 'bulk_print'), 'target' => empty($this->request->params['named']['active']) ? '_blank' : ''));
	echo $this->Form->hidden('active');
	foreach($containers as $i => $container) {
?>
	<tr <?php echo $i % 2 == 0 ? 'class="alt"' : ''; ?>>
		<td class="table-checkbox"><?php echo $this->Form->checkbox("Container.slug.{$container['Container']['slug']}", array('label' => false, 'value' => '1', 'class' => 'container-checkbox')); ?></td>
		<td><?php echo $container['Container']['name']; ?></td>
		<td><?php echo $container['Container']['container_item_count']; ?></td>
	</tr>
<?php
	}
?>
</table><br/>
<?php
	echo $this->Form->submit(__('Print Selected Labels'), array('class' => 'btn primary'));
	echo $this->Form->end();
?>