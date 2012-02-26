<?php
	Router::parseExtensions();
	Router::mapResources('api');
	
	/**
	 * Static pages:
	 * /slug => template name
	 */
	$static_pages = array(
		'' => 'home',
		'about' => 'about',
		'features' => 'features',
		'terms' => 'terms',
		'privacy' => 'privacy'
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

	// Application
	Router::connect('/dashboard', array('controller' => 'containers', 'action' => 'dashboard'));
	Router::connect('/forgot_login/*', array('controller' => 'users', 'action' => 'qr_login'));

	// Feedback plugin
	Router::connect('/feedback', array('plugin' => 'feedback', 'controller' => 'communicate', 'action' => 'index'));

	// Fallback
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
