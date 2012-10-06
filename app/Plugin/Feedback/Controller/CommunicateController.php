<?php
class CommunicateController extends FeedbackAppController {

	var $name = 'Communicate';

	public $uses = array('Feedback.Feedback');

	public function index() {
		if(!empty($this->request->data)) {
			$this->request->data['Feedback']['user_id'] = $this->Auth->user('id') ? $this->Auth->user('id') : 0;
			$this->request->data['Feedback']['ip_address'] = $this->RequestHandler->getClientIP(true);
			$this->request->data['Feedback']['user_agent'] = env('HTTP_USER_AGENT');
			if(!empty($this->request->data['Feedback']['confirm_message'])) {
				$this->Session->setFlash('We think you\'re a bot.  :(', 'notification/error');
				$this->redirect('/'.$this->request->data['Feedback']['location_uri']);
			}
			if($this->Feedback->save($this->request->data)) {
				$this->Session->setFlash('Thank you for submitting your feedback!', 'notification/success');
				$this->redirect('/'.$this->request->data['Feedback']['location_uri']);
			} else {
				$this->Session->setFlash('There was an error submitting your feedback.', 'notification/error');
			}
		} else {
			$this->request->data['Feedback']['location_uri'] = $this->referer(null, true);
		}
		$this->set('title_for_layout', 'Submit Your Feedback');
	}

}
?>