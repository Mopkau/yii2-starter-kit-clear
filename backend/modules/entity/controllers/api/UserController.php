<?php

namespace backend\modules\entity\controllers\api;

/**
* This is the class for REST controller "UserController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use common\models\User;
use yii\filters\Cors;
use backend\components\CustomCors;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;

class UserController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\entity\User';

    public function behaviors()
    {
    $behaviors = parent::behaviors();

        unset($behaviors['authenticator']);
        unset($behaviors['verbFilter']);
        $behaviors['corsFilter'] = [
        'class' => CustomCors::className(),
        ];
        $behaviors['authenticator'] = [
        'class' => HttpBearerAuth::className(),
        'optional' => ['login']
        ];

    return $behaviors;
    }

public function actionGetBySlug($slug){
$query = new ActiveQuery($this->modelClass);
if (($model = $query->andWhere(['slug'=>$slug])->one()) !== null) {
return $model;
} else {
throw new NotFoundHttpException('The requested page does not exist.');
}
}
}
