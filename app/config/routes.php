<?php
	Router::parseExtensions();
	
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/admin/login', array('controller' => 'users', 'action' => 'login', 'admin' => true));

	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
