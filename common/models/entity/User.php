<?php

namespace common\models\entity;

use Yii;
use \common\models\entity\base\User as BaseUser;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 */
class User extends BaseUser
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
                                            ]
        );
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // define order of columns for Giiant generator
        $scenarios['form'] = [];
        $scenarios['crud'] = [];

        return $scenarios;
    }


}
