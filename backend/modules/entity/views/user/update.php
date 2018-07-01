<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\entity\User $model
*/

$this->title = Yii::t('models', 'User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Edit');
?>
<div class="giiant-crud user-update">

    <h1>
        <?= Yii::t('models', 'User') ?>
        <small>
                        <?= $model->id ?>
        </small>
    </h1>


    <hr />

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
