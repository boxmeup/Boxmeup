<?php
	echo $html->link('Add Container', array('controller' => 'containers', 'action' => 'add'), array('class' => 'btn success ui-modal'));
	echo $html->link($html->image('icons/print.png').'&nbsp; Bulk Print', array('controller' => 'containers', 'action' => 'bulk_print'), array('class' => 'btn primary tip-s bulk-print', 'escape' => false, 'title' => 'Print multiple labels at once'));
	echo $html->link(
		$html->image('icons/view_change.png') . '&nbsp; Change View',
		array('controller' => 'containers', 'action' => 'change_view', $container_view == 'list' ? 'grid' : 'list'),
		array('class' => 'btn tip-s change-view', 'title' => $container_view == 'list' ? 'Change to grid view' : 'Change to list view', 'escape' => false)
	);