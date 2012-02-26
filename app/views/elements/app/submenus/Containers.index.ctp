<?php
	echo $html->link(__('Add Container', true), array('controller' => 'containers', 'action' => 'add'), array('class' => 'btn success ui-modal'));
	echo $html->link($html->image('icons/print.png').'&nbsp; ' . __('Bulk Print', true), array('controller' => 'containers', 'action' => 'bulk_print'), array('class' => 'btn primary tip-s bulk-print', 'escape' => false, 'title' => 'Print multiple labels at once'));
	echo $html->link(
		$html->image('icons/view_change.png') . '&nbsp; ' . __('Change View', true),
		array('controller' => 'containers', 'action' => 'change_view', $container_view == 'list' ? 'grid' : 'list'),
		array('class' => 'btn tip-s change-view', 'title' => $container_view == 'list' ? __('Change to grid view', true) : __('Change to list view', true), 'escape' => false)
	);