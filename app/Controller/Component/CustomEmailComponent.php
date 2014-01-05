<?php

use Mailgun\Mailgun;

App::uses('Component', 'Controller');

Class CustomEmailComponent extends Component {

	const SEND_OK = 200;

	public function getMailer() {
		return new Mailgun(Configure::read('Email.mailgun.api_key'));
	}

	public function send($to, $subject, $template, $data, $type = 'text') {
		$body = $this->evaluate(APP . "/View/Emails/$type/$template.ctp", $data);
		$result = $this->getMailer()->sendMessage(Configure::read('Email.mailgun.domain'), array(
			'from' => 'Boxmeup Team <no-reply@boxmeupapp.com>',
			'to' => $to,
			'subject' => $subject,
			'text' => $body
		));
		return $result->http_response_code === static::SEND_OK;
	}

	/**
	 * Get the rendered output of a ctp file.
	 * 
	 * @param string $filePath
	 * @param  array $data
	 * @return string
	 */
	protected function evaluate($filePath, $data = array()) {
		extract($data);
		ob_start();
		include $filePath;
		return ob_get_clean();
	}

}
