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

// API
Router::connect('/api/users/:action/*', array('plugin' => 'api', 'controller' => 'users'));
Router::connect('/api/:controller', array('plugin' => 'api', 'action' => 'index', '[method]' => 'GET'));
Router::connect('/api/:controller', array('plugin' => 'api', 'action' => 'add', '[method]' => 'POST'));
Router::connect('/api/:controller/*', array('plugin' => 'api', 'action' => 'edit', '[method]' => 'PUT'));
Router::connect('/api/:controller/*', array('plugin' => 'api', 'action' => 'delete', '[method]' => 'DELETE'));
Router::connect('/api/containers/search/*', array('plugin' => 'api', 'controller' => 'containers', 'action' => 'search'));
// API Catchall
Router::connect('/api/*', array('plugin' => 'api'));

// Fallback
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

// Route /api to documentation
Router::redirect('/api', 'https://github.com/boxmeup/Boxmeup/wiki/API-Documentation', array('status' => '302'));

require CAKE . 'Config' . DS . 'routes.php';
