<?php
	Router::parseExtensions();
	
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));

	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
