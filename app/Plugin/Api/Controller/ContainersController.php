<?php
App::uses('Sanitize', 'Utility');
class ContainersController extends ApiAppController {

	public $name = 'Containers';

	public $uses = array('Container');

	public function index() {
		$conditions = !empty($this->request->query['slug']) ? array('slug' => $this->request->query['slug']) : array();
		$containers = $this->Container->getApiContainers($this->getUserId(), $conditions);
		if (empty($containers)) {
			throw new NotFoundException('No containers found.');
		}
		array_walk($containers, function(&$container) {
			$container['Container']['container_item_count'] = (int)$container['Container']['container_item_count'];
		});
		$this->jsonOutput(!empty($this->request->query['slug']) ? $containers[0] : $containers);
	}

	public function add() {
		if(!$this->RequestHandler->isPost()) {
			throw new MethodNotAllowedException();
		}
		$this->Container->data = array(
			'user_id' => $this->getUserId(),
			'name' => $this->request->data['name']
		);
		$data['Container']['user_id'] = $this->getUserId();
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
		if(!$this->RequestHandler->isPut()) {
			throw new MethodNotAllowedException();
		}
		$data = $this->Container->getContainerBySlug($slug, $this->getUserId());
		if(empty($data)) {
			throw new NotFoundException('Container not found.');
		}
		if(!$this->Container->verifyUser($data['Container']['id'], $this->getUserId())) {
			throw new NotAuthorizedException('Not authorized to modify this container.');
		}
		$data['Container']['name'] = $this->request->data['name'];
		if(!$result = $this->Container->save($data)) {
			throw new BadRequestException();
		}
		unset($result['Container']['id'], $result['Container']['user_id'], $result['Container']['location_id'], $result['Location']);
		$result['Container']['container_item_count'] = (int)$result['Container']['container_item_count'];
		$this->jsonOutput($result);
	}

	public function delete($slug = null) {
		if(!$this->RequestHandler->isDelete()) {
			throw new MethodNotAllowedException();
		}
		$data = $this->Container->getContainerBySlug($slug, $this->getUserId());
		if(empty($data)) {
			throw new NotFoundException('Container not found.');
		}
		if(!$this->Container->verifyUser($data['Container']['id'], $this->getUserId())) {
			throw new ForbiddenException('Not authorized to modify this container.');
		}
		if(!$this->output = $this->Container->delete($data['Container']['id'])) {
			throw new BadRequestException('Error deleting container.');
		}
		$this->jsonOutput(array('success' => true));
	}

	public function search() {
		if(!$this->RequestHandler->isGet()) {
			throw new MethodNotAllowedException();
		}
		if(empty($this->params['url']['query'])) {
			throw new BadRequestException('You must specify a search query.');
		}
		$this->request->params['paging']['page'] = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
		$results = $this->Container->ContainerItem->searchContainers($this, $this->user_id, $this->request->query['query']);
		if(empty($results)) {
			throw new NotFoundException('No results.');
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
			'pages' => $this->request->params['paging']['ContainerItem']['pageCount'],
			'total' => $this->request->params['paging']['ContainerItem']['count']
		);
	}
}