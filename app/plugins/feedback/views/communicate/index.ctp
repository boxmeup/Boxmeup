<h2>Feedback</h2>
<br/>
<?php
	echo $form->create('Feedback', array('url' => array('plugin' => 'feedback', 'controller' => 'communicate', 'action' => 'index')));
	echo $form->input('location_uri', array('type' => 'hidden'));
	echo $form->input('feedback_type', array('options' => array('bug' => 'Bug', 'feature' => 'Feature')));
	echo $form->input('message');
	echo $form->submit('Submit Feedback', array('class' => 'medium green button'));
	echo $form->end();