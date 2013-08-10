<?php

Router::mapResources(array(
	'Api.containers',
	'Api.conainer_items',
	'Api.locations',
	'Api.users'
), array(
	'id' => '[a-z0-9-]+'
));
