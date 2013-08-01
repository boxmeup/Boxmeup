<div class="row">
	<div class="btn-group">
<?php
	echo $this->Html->link(__('Add Container'), array('controller' => 'containers', 'action' => 'add'), array('data-toggle' => 'modal', 'data-target' => '#layout-modal', 'class' => 'btn btn-success'));
	echo $this->Html->link(__('Edit Container'), array('controller' => 'containers', 'action' => 'edit', $container['Container']['uuid']), array('data-toggle' => 'modal', 'data-target' => '#layout-modal', 'class' => 'btn btn-primary'));
	echo $this->Html->link($this->Html->image('icons/print.png').'&nbsp;'.__('Print Label'), array('controller' => 'containers', 'action' => 'print_label', $container['Container']['uuid']), array('data-toggle' => 'tooltip', 'class' => 'btn btn-default print', 'escape' => false, 'title' => 'Print a label containing a QR code to this container.'));
	echo $this->Html->link($this->Html->image('icons/csv.png').'&nbsp;'.__('Export List'), array('controller' => 'containers', 'action' => 'export', $container['Container']['uuid']), array('data-toggle' => 'tooltip', 'class' => 'btn btn-default', 'escape' => false, 'title' => __('Export the list of items in this container to CSV')));
	echo $this->Html->link(__('Delete Container'), array('controller' => 'containers', 'action' => 'delete', $container['Container']['uuid']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete this container?'));
?>
	</div>
</div>
