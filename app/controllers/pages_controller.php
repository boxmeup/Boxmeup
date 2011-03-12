<?php
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	var $name = 'Pages';

/**
 * Default helper
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html');

/**
 * This controller does not use a model
 *
 * @var array
 * @access public
 */
	var $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
	function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count)
			$this->redirect('/');

		$page = $subpage = $title_for_layout = null;

		$page = $path[0];
		if(isset($path[1]))
			$subpage = $path[1];
		
		if (!empty($path[$count - 1]))
			$title_for_layout = $page === 'home' ? 'Boxmeup.com' : Inflector::humanize($path[$count - 1]);
		
		if($this->Auth->user() && $page === 'home')
			$this->redirect(array('controller' => 'containers', 'action' => 'index'));

		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
}
