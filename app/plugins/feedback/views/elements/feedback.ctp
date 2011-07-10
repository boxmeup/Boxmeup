<?php
	if(Configure::read('Feature.feedback'))
		echo $html->link($html->image('/feedback/img/feedback-button.gif'), array('plugin' => 'feedback', 'controller' => 'communicate', 'action' => 'index'), array('escape' => false, 'class' => 'feedback-plugin'));
?>