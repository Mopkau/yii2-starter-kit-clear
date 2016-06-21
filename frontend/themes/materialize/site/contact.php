<?php
use yii\helpers\Html;
	use yii\widgets\ActiveField;
	use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?php echo Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
	            'id' => 'contact-form',
                'options'=>[
	                'class'=>'col s12'
                ],
                'fieldClass'=> ActiveField::className(),
                'fieldConfig'=>[
	                'options'=>[
		                'class'=>'input-field col s8'
	                ]
                ],
                'enableClientValidation'=>false,
                'enableClientScript'=>false,
                'validateOnChange'=>false,
                'validateOnBlur'=>false,


            ]); ?>
		        <div class="row">
		        <?php echo $form->field($model, 'name')->textInput(['class'=>'validate'])?>
				</div>
	            <div class="row">
		            <?php echo $form->field($model, 'email')->input('email',['class'=>'validate']) ?>
	            </div>
				<div class="row">
					<?php echo $form->field($model, 'subject')->textInput(['class'=>'validate']) ?>
				</div>
	            <div class="row">
		            <?php echo $form->field($model, 'body')->textArea(['class' => 'materialize-textarea']) ?>
	            </div>

                <?php echo Html::submitButton(Yii::t('frontend', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

