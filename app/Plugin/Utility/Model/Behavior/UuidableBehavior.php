<?php
class UuidableBehavior extends ModelBehavior {

    public function beforeSave(Model $model) {
        if(empty($model->id) && $model->hasField('uuid')) {
            $model->data[$model->alias]['uuid'] = String::uuid();
        }
        return true;
    }
    
}
