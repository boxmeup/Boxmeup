<?php
	echo $html->link('Add Container', array('controller' => 'containers', 'action' => 'add'), array('class' => 'small green button ui-modal'));
	echo $html->link($html->image('icons/print.png').'&nbsp; Bulk Print', array('controller' => 'containers', 'action' => 'bulk_print'), array('class' => 'small blue button tip-s bulk-print', 'escape' => false, 'title' => 'Print multiple labels at once'));