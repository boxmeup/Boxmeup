<?php
class UuidableBehavior extends ModelBehavior {

	public function afterSave($model, $created) {
		if($created && $model->hasField('uuid')) {
			$model->set('uuid', String::uuid());
			$model->save();
		}
		$model->afterSave($created);
		return true;
	}

}