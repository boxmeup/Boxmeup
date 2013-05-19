<?php
	echo $this->Html->link(__('List Containers'), array('controller' => 'containers', 'action' => 'index'), array('class' => 'btn primary'));
	echo $this->Html->link(__('Add Container'), array('controller' => 'containers', 'action' => 'add'), array('class' => 'btn success ui-modal'));
	echo $this->Html->link(__('Delete Container'), array('controller' => 'containers', 'action' => 'delete', $container['Container']['uuid']), array('class' => 'btn danger'), 'Are you sure you want to delete this container?');
	echo $this->Html->link($this->Html->image('icons/print.png').'&nbsp;'.__('Print Label'), array('controller' => 'containers', 'action' => 'print_label', $container['Container']['uuid']), array('class' => 'btn primary tip-s print', 'escape' => false, 'title' => 'Print a label containing a QR code to this container.'));
	echo $this->Html->link($this->Html->image('icons/csv.png').'&nbsp;'.__('Export List'), array('controller' => 'containers', 'action' => 'export', $container['Container']['uuid']), array('class' => 'btn primary tip-s', 'escape' => false, 'title' => 'Export the list of items in this container to CSV'));
