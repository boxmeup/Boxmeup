<?php

class UuidableBehavior extends ModelBehavior {

    public function beforeSave(Model $model, $options = []) {
        if(empty($model->id) && $model->hasField('uuid')) {
            $model->data[$model->alias]['uuid'] = CakeText::uuid();
        }
        return true;
    }

}
