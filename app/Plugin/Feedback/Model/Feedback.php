<?php

App::uses('HttpSocket', 'Network/Http');

class Feedback extends FeedbackAppModel {

	const GITHUB_URL = 'https://api.github.com';

	public $name = 'Feedback';

	public $useTable = 'feedback';

	public $validate = array(
		'message' => array(
			'rule' => 'notEmpty',
			'message' => 'You must add a message.'
		)
	);

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 * Creates a github issue with title and body in configured project.
	 *
	 * @param string $title
	 * @param string $body
	 * @throws BadRequestException
	 */
	public function githubIssue($type, $title, $body) {
		$socket = new HttpSocket();
		$url = static::GITHUB_URL . '/repos/' . Configure::read('Feedback.github.project') . '/issues';
		$data = json_encode(array(
			'title' => $title,
			'body' => $body,
			'labels' => array_merge(
				array($type),
				Configure::read('Feedback.github.labels')
			)
		));
		$result = $socket->post($url, $data, array(
			'header' => array(
				'Authorization' => 'token ' . Configure::read('Feedback.github.auth_token')
			)
		));
		if (!in_array((int)$result->code, array(200, 201, 202, 203, 204, 205, 206))) {
			throw new BadRequestException('Error entering feedback.');
		}
		$body = json_decode($result->body, true);
		return $body['html_url'];
	}
}