<?php

namespace Boxmeup\Web\Base;

use Silex\Application as SilexApplication;

class Application extends SilexApplication
{
	use \Silex\Application\SecurityTrait;
	use \Silex\Application\UrlGeneratorTrait;

	public function json($data = [], $status = 200, array $headers = []) {
		return new JsonResponse($data, $status, $headers);
	}

}
