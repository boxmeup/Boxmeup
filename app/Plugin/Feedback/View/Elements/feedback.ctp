<?php
	echo $this->Html->link($this->Html->image('/feedback/img/feedback-button.gif'), array('plugin' => 'feedback', 'controller' => 'communicate', 'action' => 'index'), array('escape' => false, 'class' => 'feedback-plugin'));
?>