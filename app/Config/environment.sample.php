<?php

$config = array(
	'Env' => array(
		'debug' => 2,
		'salt' => '',
		'cipher' => '',
		'Db' => array(
			'default' => array(
				'persistent' => false,
				'host' => 'localhost',
				'login' => 'root',
				'password' => 'root',
				'database' => 'boxmeup'
			)
		),
		'Feature' => array(
			'api' => true,
			'mobile' => true,
			'analytics' => false,
			'feedback' => true,
			'user_registration' => true,
			'bulk_export' => true,
			'forgot_password' => true,
			'autocomplete' => true,
			'https_redirect' => true,
			'beta' => true
		)
	)
);
