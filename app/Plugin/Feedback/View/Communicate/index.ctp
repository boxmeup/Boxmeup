<h2>Feedback</h2>
<br/>
<?php
	echo $this->Form->create('Feedback', array('url' => array('plugin' => 'feedback', 'controller' => 'communicate', 'action' => 'index')));
	echo $this->Form->input('location_uri', array('type' => 'hidden'));
	echo $this->Form->input('feedback_type', array('options' => array('Bug' => 'Bug', 'Feature' => 'Feature')));
	echo $this->Form->input('title');
	echo $this->Form->input('body', array('type' => 'textarea', 'label' => false));
	// Simple bot circumvent.
	echo '<div style="display: none">';
		echo $this->Form->input('confirm_message');
	echo '</div>';
	echo $this->Form->submit('Submit Feedback', array('class' => 'medium green button'));
	echo $this->Form->end();