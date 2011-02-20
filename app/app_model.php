<?php
class AppModel extends Model {
	public $actsAs = array('Containable', 'UuidModel.Uuidable');
}
