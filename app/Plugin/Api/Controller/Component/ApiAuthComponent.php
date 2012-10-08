<?php

class ApiAuthComponent extends Component {

	const TIMESTAMP_THRESHOLD = 60;
	const AUTHENTICATION_HEADER = 'Authentication';
	const AUTHENTICATION_TYPE = 'BoxmeupAPI';

	/**
	 * Controller.
	 *
	 * @var Controller
	 */
	protected $controller;

	/**
	 * List of views in current controller allowed to skip authentication.
	 *
	 * @var array
	 */
	protected $allowed = array();
	
	/**
	 * Startup process.
	 *
	 * @param Controller $controller
	 * @return boolean
	 */
	public function startup(Controller $controller) {
		$this->controller = $controller;

		if ($this->isAllowed() || $this->controller->name === 'CakeError') {
			return true;
		}
		$this->authenticate();
		return true;
	}

	/**
	 * Sets a view within the current controller to skip authentication checks.
	 *
	 * @param mixed $allowable String or array of views that should bypass authentication.
	 * @return void
	 */
	public function allow($allowable) {
		$this->allowed = array_merge($this->allowed, (array)$allowable);
	}

	/**
	 * Determines if the current view is allowed to bypass authentication.
	 *
	 * @return boolean
	 */
	protected function isAllowed() {
		return in_array($this->controller->view, $this->allowed);
	}

	/**
	 * Current authorization method utilizing HMAC scheme.
	 *
	 * @param Controller $controller
	 * @return void
	 */
	protected function authenticate() {
		$requiredHeaderParams = array('api_key', 'now', 'hash');

		// Parse authentication headers
		$authHeader = CakeRequest::header(static::AUTHENTICATION_HEADER);
		if (empty($authHeader)) {
			throw new NotAuthorizedException('Missing authentication header');
		}
		$parsedAuthHeader = (array)$this->parseAuthenticationHeader($authHeader);
		if (array_diff($requiredHeaderParams, array_keys($parsedAuthHeader)) !== array()) {
			throw new NotAuthorizedException('Missing header authentication parameters.');
		}

		// Check API key
		$userSecretKey = $this->controller->ApiUser->getSecretKey($parsedAuthHeader['api_key']);
		if (empty($userSecretKey)) {
			throw new NotAuthorizedException('Invalid api key.');
		}

		// Validate time
		if (!$this->isValidTime($parsedAuthHeader['now'])) {
			throw new NotAuthorizedException('[now] parameter is not within threshold.');
		}

		$params = $this->controller->request->isGet() ?
			$this->controller->request->query :
			$this->controller->data;
		ksort($params);

		// Validate hash code
		$encodedParams = version_compare(PHP_VERSION, '5.4.0', '>=') ?
			http_build_query($params, null, null, PHP_QUERY_RFC3986) :
			str_replace('+', '%20', http_build_query($params)); // 5.3 hack
		$code = sha1(
			'/' . $this->controller->request->url . '?' .
			$encodedParams .
			$parsedAuthHeader['now'] .
			$userSecretKey
		);
		if ($code !== $parsedAuthHeader['hash']) {
			throw new NotAuthorizedException('HMAC code signature does not match expected signature.');
		}

		// Store the parner into the request to be reused by the app
		$this->controller->request->data('ApiUser.api_key', $parsedAuthHeader['api_key']);
	}

	/**
	 * Determines if passed timestamp is within threshold.
	 *
	 * @param integer $timestamp
	 * @return boolean
	 */
	protected function isValidTime($timestamp) {
		return abs(time() - $timestamp) <= static::TIMESTAMP_THRESHOLD;
	}

	/**
	 * Parse the ZumbaAPI authentication header.
	 *
	 * @param string $header
	 * @return array
	 */
	protected function parseAuthenticationHeader($header) {
		$subject = substr($header, strlen(static::AUTHENTICATION_TYPE) + 1);
		$commaTokens = explode(',', $subject);
		$headers = array();
		foreach ($commaTokens as $token) {
			$keyValue = explode('=', $token);
			if (count($keyValue) === 2) {
				$headers[strtolower(trim($keyValue[0]))] = trim($keyValue[1]);
			}
		}

		return $headers;
	}
	
}

class NotAuthorizedException extends ForbiddenException {

	/**
	 * Not authenticated error (401).
	 *
	 * @param string $message
	 * @param integer $code
	 */
	public function __construct($message, $code = 401) {
		parent::__construct($message, $code);
	}

}