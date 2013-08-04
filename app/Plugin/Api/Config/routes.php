<?php

Router::mapResources(array(
	'Api.containers',
	'Api.conainer_items'
), array(
	'id' => '[a-z0-9-]+'
));
