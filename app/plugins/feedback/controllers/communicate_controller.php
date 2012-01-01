<?php
class CommunicateController extends FeedbackAppController {

	var $name = 'Communicate';

	public $uses = array('Feedback.Feedback');

	public function index() {
		if(!empty($this->data)) {
			$this->data['Feedback']['user_id'] = $this->Auth->user('id') ? $this->Auth->user('id') : 0;
			$this->data['Feedback']['ip_address'] = $this->RequestHandler->getClientIP(true);
			$this->data['Feedback']['user_agent'] = env('HTTP_USER_AGENT');
			if(!empty($this->data['Feedback']['confirm_message'])) {
				$this->Session->setFlash('We think you\'re a bot.  :(', 'notification/error');
				$this->redirect('/'.$this->data['Feedback']['location_uri']);
			}
			if($this->Feedback->save($this->data)) {
				$this->Session->setFlash('Thank you for submitting your feedback!', 'notification/success');
				$this->redirect('/'.$this->data['Feedback']['location_uri']);
			} else {
				$this->Session->setFlash('There was an error submitting your feedback.', 'notification/error');
			}
		} else {
			$this->data['Feedback']['location_uri'] = $this->referer(null, true);
		}
		$this->set('title_for_layout', 'Submit Your Feedback');
	}

}
?>