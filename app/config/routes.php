<?php
	Router::parseExtensions();

	/**
	 * Static pages:
	 * /slug => template name
	 */
	$static_pages = array(
		'' => 'home',
		'about' => 'about'
	);
	foreach($static_pages as $slug => $page)
		Router::connect('/'.$slug, array('controller' => 'pages', 'action' => 'display', $page));

	// Authentication
	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	
	Router::connect('/signup', array('controller' => 'users', 'action' => 'signup'));
	Router::connect('/account', array('controller' => 'users', 'action' => 'account'));

	// Admin
	Router::connect('/admin', array('controller' => 'manager', 'action' => 'index', 'admin' => true));
	Router::connect('/admin/login', array('controller' => 'users', 'action' => 'login', 'admin' => true));

	// Fallback
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
