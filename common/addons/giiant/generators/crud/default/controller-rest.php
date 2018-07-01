<?php
/**
 * Customizable controller class.
 */
echo "<?php\n";
?>

namespace <?= $generator->controllerNs ?>\api;

/**
* This is the class for REST controller "<?= $controllerClassName ?>".
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

class <?= $controllerClassName ?> extends \yii\rest\ActiveController
{
public $modelClass = '<?= $generator->modelClass ?>';
<?php if ($generator->accessFilter): ?>
    /**
    * @inheritdoc
    */
    public function behaviors()
    {
    return ArrayHelper::merge(
    parent::behaviors(),
    [
    'access' => [
    'class' => AccessControl::className(),
    'rules' => [
    [
    'allow' => true,
    'matchCallback' => function ($rule, $action) {return \Yii::$app->user->can($this->module->id . '_' . $this->id . '_' . $action->id, ['route' => true]);},
    ]
    ]
    ]
    ]
    );
    }
<?php endif; ?>

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
