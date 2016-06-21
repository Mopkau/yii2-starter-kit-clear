<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\widgets\ActiveField;

	/* @var $this yii\web\View */
	/* @var $form yii\widgets\ActiveForm */
	/* @var $model \frontend\modules\user\models\SignupForm */

	$this->title = Yii::t ( 'frontend' , 'Signup' );
	$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<div class="site-signup">
	<h1><?php echo Html::encode ( $this->title ) ?></h1>

	<div class="row">
		<?php $form = ActiveForm::begin ( [
			'id'                     => 'form-signup' ,
			'options'                => [
				'class' => 'col s12' ,
			] ,
			'fieldClass'             => ActiveField::className () ,
			'fieldConfig'            => [
				'options' => [
					'class' => 'input-field col s8' ,
				] ,
			] ,
			'enableClientValidation' => FALSE ,
			'enableClientScript'     => FALSE ,
			'validateOnChange'       => FALSE ,
			'validateOnBlur'         => FALSE ,

		] ); ?>
		<?php echo $form->field ( $model , 'username' ) ?>
		<?php echo $form->field ( $model , 'email' ) ?>
		<?php echo $form->field ( $model , 'password' )->passwordInput () ?>
	</div>
	<div class="row">
		<?php echo Html::submitButton ( Yii::t ( 'frontend' , 'Signup' ) , [
			'class' => 'btn btn-primary' ,
			'name'  => 'signup-button' ,
		] ) ?>
	</div>

	<div class="row">
		<h2><?php echo Yii::t ( 'frontend' , 'Sign up with' ) ?>:</h2>
		<?php echo yii\authclient\widgets\AuthChoice::widget ( [
			'baseAuthUrl' => [ '/user/sign-in/oauth' ] ,
		] ) ?>
	</div>

	<?php ActiveForm::end (); ?>
</div>
</div>
</div>
