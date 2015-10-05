<?php

$config = array(
	'Env' => array(
		'debug' => getenv('DEBUG'),
		'salt' => getenv('SALT'),
		'cipher' => getenv('CIPHER'),
		'Db' => array(
			'default' => array(
				'persistent' => false,
				'host' => getenv('MYSQL_HOST_URL'),
				'login' => getenv('MYSQL_USER'),
				'password' => getenv('MYSQL_PASSWORD'),
				'database' => getenv('MYSQL_DATABASE')
			)
		),
		'Sphinx' => array(
			'server' => getenv('SPHINX_HOST_URL') ?: 'sphinx',
			'port' => getenv('SPHINX_PORT') ?: 9312
		),
		'Email' => array(
			'mailgun' => array(
				'domain' => getenv('MAILGUN_DOMAIN'),
				'api_key' => getenv('MAILGUN_API_KEY')
			)
		),
		'Analytics' => array(
			'tracking_code' => 'UA-6305561-5'
		),
		'Feature' => array(
			'api' => false,
			'mobile' => true,
			'analytics' => getenv('GA_ANALYTICS'),
			'feedback' => false,
			'user_registration' => true,
			'bulk_export' => true,
			'forgot_password' => true,
			'autocomplete' => true,
			'https_redirect' => false,
			'beta' => getenv('BETA')
		)
	)
);
