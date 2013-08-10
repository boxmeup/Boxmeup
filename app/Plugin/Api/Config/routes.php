<?php

Router::mapResources(array(
	'Api.containers',
	'Api.conainer_items',
	'Api.users'
), array(
	'id' => '[a-z0-9-]+'
));
