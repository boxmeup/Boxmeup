<?php

class ApiAuthComponent extends Component {

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
		$requiredHeaderParams = array('token');

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
		try {
			$user = $this->controller->ApiUserApplication->getUserByToken($parsedAuthHeader['token']);
		} catch (NotFoundException $e) {
			throw new NotAuthorizedException($e->getMessage());
		}

		// Store the user information in the request
		$this->controller->request->data('User', $user);
	}

	/**
	 * Parse the BoxmeupAPI authentication header.
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
