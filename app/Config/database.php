<?php

class DATABASE_CONFIG {

	public function __construct() {
		foreach (Configure::read('Env.Db') as $name => $options) {
			$this->$name = array(
				'datasource' => 'Database/Mysql',
				'persistent' => $options['persistent'] ?: false,
				'host' => $options['host'],
				'login' => $options['login'],
				'password' => $options['password'],
				'database' => $options['database']
			);
		}
	}

}
