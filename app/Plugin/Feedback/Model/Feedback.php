<?php
class Feedback extends FeedbackAppModel {
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
}
?>