<?php
class SlugableBehavior extends ModelBehavior {

	public function afterSave($model, $created) {
		if($created && $model->hasField('slug') && $model->hasField('name')) {
			$model->set('slug', Inflector::slug(strtolower($model->data[$model->alias]['name']), '-'));
			$model->save();
		}
		$model->afterSave($created);
		return true;
	}

}
