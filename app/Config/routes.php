<?php

Router::parseExtensions('json');
/**
 * Static pages:
 * /slug => template name
 */
$static_pages = array(
	'' => 'home',
	'terms' => 'terms',
	'privacy' => 'privacy',
	'developer' => 'developer'
);
foreach($static_pages as $slug => $page) {
	Router::connect('/'.$slug, array('controller' => 'pages', 'action' => 'display', $page));
}

// Authentication
Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
Router::connect('/signup', array('controller' => 'users', 'action' => 'signup'));
Router::connect('/account', array('controller' => 'users', 'action' => 'account'));

// Application
Router::connect('/dashboard', array('controller' => 'containers', 'action' => 'dashboard'));
Router::connect('/forgot_login/*', array('controller' => 'users', 'action' => 'qr_login'));

// API
Router::connect('/api/containers/search/*', array('plugin' => 'api', 'controller' => 'containers', 'action' => 'search'));
Router::connect('/api/users/login', array('plugin' => 'api', 'controller' => 'users', 'action' => 'login', '[method]' => 'POST'));
// API Mapped resources
Router::mapResources(array(
	'Api.containers',
	'Api.container_items'
), array(
	'id' => '[a-z0-9-]+'
));
// API Catchall
Router::connect('/api/*', array('plugin' => 'api'));

// Fallback
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

// Route /api to documentation
Router::redirect('/api', 'https://github.com/boxmeup/Boxmeup/wiki/API-Documentation', array('status' => '302'));

require CAKE . 'Config' . DS . 'routes.php';
