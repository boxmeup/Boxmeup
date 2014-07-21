<?php

namespace Boxmeup\Web;

use Boxmeup\Web\Response\JsonResponse;

class Application extends \Silex\Application
{
	use \Silex\Application\SecurityTrait;

	public function json($data = [], $status = 200, array $headers = []) {
		return new JsonResponse($data, $status, $headers);
	}

}
