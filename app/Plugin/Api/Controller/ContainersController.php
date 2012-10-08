<?php
App::import('Sanitize', 'Utility');
class ContainersController extends ApiAppController {

	public $name = 'Containers';

	public $uses = array('Container');

	public function index() {
		$conditions = !empty($this->request->query['slug']) ? array('slug' => $this->request->query['slug']) : array();
		$containers = $this->Container->getApiContainers($this->ApiUser->getUserId($this->request->data['ApiUser']['api_key']), $conditions);
		if (empty($containers)) {
			throw new NotFoundException('No containers found.');
		}
		$this->jsonOutput($containers);
	}

	public function add() {
		if(!$this->RequestHandler->isPost()) {
			throw new MethodNotAllowedException();
		}
		$this->Container->data = array(
			'user_id' => $this->ApiUser->getUserId($this->request->data['ApiUser']['api_key']),
			'name' => $this->request->data['name']
		);
		$data['Container']['user_id'] = $this->ApiUser->getUserId($this->request->data['ApiUser']['api_key']);
		$data['Container']['name'] = $this->request->data['name'];
		$result = $this->Container->save($data);
		if(!$result) {
			throw new BadRequestException(json_encode($this->Containter->validationErrors));
		}
		$this->jsonOutput(array(
			'uuid' => $result['Container']['uuid'],
			'slug' => $result['Container']['slug']
		));
	}

	public function edit($slug = null) {
		if(!$this->RequestHandler->isPost()) {
			$this->setError(405, 'Resource method supports POST only.');
			return false;
		}
		$data = $this->Container->getContainerBySlug($slug, $this->user_id);
		if(empty($data)) {
			$this->setError(404, 'Container not found.');
			return false;
		}
		if(!$this->Container->verifyUser($data['Container']['id'], $this->user_id)) {
			$this->setError(401, 'Not authorized to modify this container.');
			return false;
		}
		$data['Container']['name'] = $this->params['form']['name'];
		if(!$this->output = $this->Container->save($data)) {
			$this->setError(406, $this->Container->validationErrors);
			return false;
		}
		unset($this->output['Container']['id'], $this->output['Container']['user_id'], $this->output['Container']['location_id'], $this->output['Location']);
	}

	public function delete($slug = null) {
		if(!$this->RequestHandler->isDelete()) {
			$this->setError(405, 'Resource method supports DELETE only.');
			return false;
		}
		$data = $this->Container->getContainerBySlug($slug, $this->user_id);
		if(empty($data)) {
			$this->setError(404, 'Container not found.');
			return false;
		}
		if(!$this->Container->verifyUser($data['Container']['id'], $this->user_id)) {
			$this->setError(401, 'Not authorized to modify this container.');
			return false;
		}
		if(!$this->output = $this->Container->delete($data['Container']['id'])) {
			$this->setError(400, 'Error deleting container.');
			return false;
		}
	}

	public function search() {
		if(!$this->RequestHandler->isGet()) {
			$this->setError(405, 'Resource method supports GET only.');
			return false;
		}
		if(empty($this->params['url']['query'])) {
			$this->setError(406, "You must specify a search query.");
			return false;
		}
		$this->params['named']['page'] = !empty($this->params['url']['page']) ? $this->params['url']['page'] : 1;
		$results = $this->Container->ContainerItem->searchContainers($this, $this->user_id, $this->params['url']['query']);
		if(empty($results)) {
			$this->setError(404, 'No results found.');
			return false;
		}
		// Format results
		foreach($results as $key => $result) {
			unset(
				$results[$key]['ContainerItem']['id'],
				$results[$key]['ContainerItem']['container_id'],
				$results[$key]['Container']['id'],
				$results[$key]['Container']['user_id'],
				$results[$key]['Container']['location_id']
			);
		}
		$this->output = array(
			'search' => $results,
			'pages' => $this->params['paging']['ContainerItem']['pageCount'],
			'total' => $this->params['paging']['ContainerItem']['count']
		);
	}
}