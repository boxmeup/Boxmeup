<?php

class AppModel extends Model {
	public $actsAs = array(
		'Containable',
		'Utility.Uuidable',
		'Utility.Sluggable' => array(
			'label' => 'name',
			'separator' => '-'
		)
	);
}
