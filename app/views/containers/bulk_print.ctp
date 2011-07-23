<?php echo $this->Html->script('views/containers/bulk_print', array('inline' => false)); ?>
<h2>Select Containers to Print Labels</h2><br/>
<table>
	<tr style="background-color: #333; color: #eee;">
		<td class="tip-s table-checkbox" title="Select All"><?php echo $this->Form->checkbox('selectall', array('label' => false, 'id' => 'container-selectall')); ?></td>
		<td>Container Name</td>
		<td>Item Count</td>
	</tr>
<?php
	echo $this->Form->create('Container', array('url' => array('controller' => 'containers', 'action' => 'bulk_print'), 'target' => empty($this->params['named']['active']) ? '_blank' : ''));
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
	echo $this->Form->submit('Print Selected Labels', array('class' => 'large blue button'));
	echo $this->Form->end();
?>