<?php
	echo $form->create();
	echo $form->input('email');
	echo $form->input('password');
	echo $form->submit('Login', array('class' => 'large blue button', 'div' => false));
	echo $form->end();