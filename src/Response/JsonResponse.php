<?php

namespace Boxmeup\Web\Response;

use Symfony\Component\HttpFoundation\JsonResponse as DefaultJsonResponse;

class JsonResponse extends DefaultJsonResponse
{
	const NON_JSONP_RESPONSE_PREFIX = ")]}',\n";

	/**
	 * Set the data to be returned as the response.
	 *
	 * @param array $data
	 * @return Boxmeup\Web\Response\JsonResponse
	 * @throws \InvalidArgumentException
	 */
	public function setData($data = []) {
		parent::setData($data);
		$this->data = static::NON_JSONP_RESPONSE_PREFIX . $this->data;
		return $this->update();
	}
}
