<?php
	echo $this->Html->link(__('Add Container'), array('controller' => 'containers', 'action' => 'add'), array('class' => 'btn success ui-modal'));
	echo $this->Html->link($this->Html->image('icons/print.png').'&nbsp; ' . __('Bulk Print'), array('controller' => 'containers', 'action' => 'bulk_print'), array('class' => 'btn primary tip-s bulk-print', 'escape' => false, 'title' => 'Print multiple labels at once'));
	echo $this->Html->link(
		$this->Html->image('icons/view_change.png') . '&nbsp; ' . __('Change View'),
		array('controller' => 'containers', 'action' => 'change_view', $container_view == 'list' ? 'grid' : 'list'),
		array('class' => 'btn tip-s change-view', 'title' => $container_view == 'list' ? __('Change to grid view') : __('Change to list view'), 'escape' => false)
	);