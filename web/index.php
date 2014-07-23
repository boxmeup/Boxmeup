<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';

require __DIR__ . '/../config/' . (getenv('DEBUG') ? 'dev.php' : 'prod.php');

$app->run();
