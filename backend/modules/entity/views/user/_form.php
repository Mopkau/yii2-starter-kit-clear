<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
* @var yii\web\View $this
* @var common\models\entity\User $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
    'id' => 'User',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-danger',
    'fieldConfig' => [
             'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
             'horizontalCssClasses' => [
                 'label' => 'col-sm-2',
                 #'offset' => 'col-sm-offset-4',
                 'wrapper' => 'col-sm-8',
                 'error' => '',
                 'hint' => '',
             ],
         ],
    ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            

<!-- attribute auth_key -->
			<?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

<!-- attribute access_token -->
			<?= $form->field($model, 'access_token')->textInput(['maxlength' => true]) ?>

<!-- attribute password_hash -->
			<?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

<!-- attribute email -->
			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<!-- attribute status -->
			<?= $form->field($model, 'status')->dropDownList(
                            [
                                1 => Yii::t('backend', 'Active'),
                                0 => Yii::t('backend', 'Disable'),
                            ],
                            [
                                'prompt' => Yii::t('cruds', 'Select'),
                                'disabled' => (isset($relAttributes) && isset($relAttributes['status'])),
                            ]
                        ); ?>

<!-- attribute logged_at -->
			<?= $form->field($model, 'logged_at')->textInput() ?>

<!-- attribute username -->
			<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

<!-- attribute oauth_client -->
			<?= $form->field($model, 'oauth_client')->textInput(['maxlength' => true]) ?>

<!-- attribute oauth_client_user_id -->
			<?= $form->field($model, 'oauth_client_user_id')->textInput(['maxlength' => true]) ?>

<!-- attribute attachments -->
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                    'encodeLabels' => false,
                    'items' => [ 
                        [
    'label'   => Yii::t('models', 'User'),
    'content' => $this->blocks['main'],
    'active'  => true,
],
                    ]
                 ]
    );
    ?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?= Html::submitButton(
        '<span class="glyphicon glyphicon-check"></span> ' .
        ($model->isNewRecord ? Yii::t('cruds', 'Create') : Yii::t('cruds', 'Save')),
        [
        'id' => 'save-' . $model->formName(),
        'class' => 'btn btn-success'
        ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>

