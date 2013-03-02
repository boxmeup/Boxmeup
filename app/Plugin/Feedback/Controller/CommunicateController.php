<?php
class CommunicateController extends FeedbackAppController {

	var $name = 'Communicate';

	public $uses = array('Feedback.Feedback');

	public function index() {
		if(!empty($this->request->data)) {
			if(!empty($this->request->data['Feedback']['confirm_message'])) {
				$this->Session->setFlash('We think you\'re a bot.  :(', 'notification/error');
				$this->redirect('/'.$this->request->data['Feedback']['location_uri']);
			}
			$body = $this->request->data['Feedback']['body'] . "\n\n"
				. "```\n"
				. 'User Agent: ' . env('HTTP_USER_AGENT') . "\n"
				. 'App Location: ' . $this->referer(null, true) . "\n"
				. $this->Auth->user('id')
				. "\n```";
			try {
				$result = $this->Feedback->githubIssue(
					$this->request->data['Feedback']['feedback_type'],
					$this->request->data['Feedback']['title'],
					$body
				);
				$this->Session->setFlash('Thank you for submitting your feedback!<br>' . "<a href=\"$result\">View My Issue</a>", 'notification/success');
				$this->redirect('/'.$this->request->data['Feedback']['location_uri']);
			} catch (BadRequestException $e) {
				$this->Session->setFlash('There was an error submitting your feedback.', 'notification/error');
			}
			$this->request->data['Feedback']['location_uri'] = $this->referer(null, true);
		}
		$this->set('title_for_layout', 'Submit Your Feedback');
	}

}
