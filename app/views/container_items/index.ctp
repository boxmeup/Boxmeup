<?php
	echo $form->create('ContainerItem', array('url' => array('controller' => 'container_items', 'action' => 'add_item')));
	echo $form->input('ContainerItem.body', array('type' => 'text', 'label' => false, 'style' => 'float: left'));
	echo $form->input('ContainerItem.container_id', array('options' => $containers, 'empty' => 'Select a container', 'label' => false, 'style' => 'float: left'));
	echo $form->submit('Add Item', array('div' => false, 'class' => 'small green button', 'style' => 'float: left'));
	echo $form->end();
?>
<div style="clear: both"></div>
<br/>
<?php
	if(empty($container_items)) {
?>
<p>No items yet.</p>
<?php } else { ?>
<table style="width: 100%">
	<thead>
		<?php
			echo $html->tableHeaders(array(
				$paginator->sort('Item', 'ContainerItem.body'),
				$paginator->sort('Container', 'Container.name'),
				$paginator->sort('Modified', 'ContainerItem.modified')
			));
		?>
	</thead>
	<tbody>
		<?php
			foreach($container_items as $key => $item) {
				echo $html->tableCells(array(
					$item['ContainerItem']['body'],
					$html->link($item['Container']['name'], array('controller' => 'containers', 'action' => 'view', $item['Container']['slug'])),
					$time->niceShort($item['ContainerItem']['modified']),
					$html->link($html->image('icons/edit.png'), array('controller' => 'container_items', 'action' => 'edit', $item['ContainerItem']['uuid']), array('escape' => false, 'class' => 'ui-modal')).' '.
					$html->link($html->image('icons/delete.png'), array('controller' => 'container_items', 'action' => 'delete', $item['ContainerItem']['uuid']), array('escape' => false), 'Are you sure you want to delete this item?')
				), array('class' => 'alternate'));
			}
		?>
	</tbody>
</table>
<?php } ?>