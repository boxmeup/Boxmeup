<?php
App::import('lib', 'LazyModel.LazyModel');
class AppModel extends LazyModel {
	public $actsAs = array('Containable', 'Utility.Uuidable', 'Utility.Sluggable');
}
