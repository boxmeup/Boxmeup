<script type="text/javascript">
$('document').ready(function() {
	$('#container-delete').bind('click', function(e) {
		return confirm("Are you sure you want to delete this container?");
	});
});
</script>
<?php
	$slug = $container['Container']['slug'];
	echo $this->Html->scriptBlock("
		if(mobileApp.isAndroid()) {
			BoxmeupAndroid.setCurrentContainerSlug('$slug');
		}
	");
?>
<div data-role="navbar" data-type="horizontal" style="width: 100%; text-align: center" id="control-menu">
	<ul>
<?php
	echo '<li>'.$this->Html->link('Edit', array('controller' => 'containers', 'action' => 'edit', $container['Container']['uuid']), array('data-rel' => 'dialog', 'data-role' => 'button', 'data-transition' => 'slidedown', 'data-icon' => 'edit')).'</li>';
	echo '<li>'.$this->Html->link('Delete', array('controller' => 'containers', 'action' => 'delete', $container['Container']['uuid']), array('id' => 'container-delete', 'data-role' => 'button', 'data-theme' => 'a', 'data-icon' => 'delete')).'</li>';
?>
	</ul>
</div>
<?=$this->Html->link('Add Item', array('controller' => 'container_items', 'action' => 'add', $container['Container']['uuid']), array('data-role' => 'button', 'data-icon' => 'add'));?>
<?php
	echo $this->Html->tag('div', '', array('style' => 'clear: both'));
	if(empty($container_items))
		echo $this->Html->tag('p', __('No items yet.'));
	else {
?>
	<br/>
	<ul data-role="listview" data-theme="c">
<?php
		foreach($container_items as $key => $item) {
			echo $this->Html->tag('li', $this->Html->link($item['ContainerItem']['body'],
				array('controller' => 'container_items', 'action' => 'edit', $item['ContainerItem']['uuid'])) .
				$this->Html->tag('span', $item['ContainerItem']['quantity'], array('class' => 'ui-li-count ui-btn-up-c ui-btn-corner-all'))
			);
		}
?>
	</ul>
<?php
	}
