<?php
	Router::parseExtensions();

	/**
	 * Static pages:
	 * /slug => template name
	 */
	$static_pages = array(
		'' => 'home',
	);
	foreach($static_pages as $slug => $page)
		Router::connect('/'.$slug, array('controller' => 'pages', 'action' => 'display', $page));

	// Authentication
	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/admin/login', array('controller' => 'users', 'action' => 'login', 'admin' => true));
	Router::connect('/signup', array('controller' => 'users', 'action' => 'signup'));



	// Fallback
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
