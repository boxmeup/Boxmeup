<?php
	echo $this->Html->link($this->Html->image('/feedback/img/feedback-button.png'), array('plugin' => 'feedback', 'controller' => 'communicate', 'action' => 'index'), array('escape' => false, 'class' => 'feedback-plugin hidden-sm', 'data-toggle' => 'modal', 'data-target' => '#layout-modal'));
?>
