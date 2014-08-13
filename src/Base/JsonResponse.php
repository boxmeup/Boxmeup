<?php

namespace Boxmeup\Web\Base;

use Symfony\Component\HttpFoundation\JsonResponse as DefaultJsonResponse;

class JsonResponse extends DefaultJsonResponse
{
    const NON_JSONP_RESPONSE_PREFIX = ")]}',\n";

    /**
	 * Set the content of the response.
	 *
	 * @param mixed $content
	 */
    public function setContent($content)
    {
        parent::setContent($content);
        $this->content = static::NON_JSONP_RESPONSE_PREFIX . $this->content;

        return $this;
    }
}
