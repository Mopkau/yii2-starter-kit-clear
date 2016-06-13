<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

<?php echo "<?php \$form = \metalguardian\formBuilder\ActiveFormBuilder::begin(); ?>"; ?>

<?php echo "<?= \$form->renderForm(\$model, \$model->getFormConfig()) ?>";?>

<?php echo '<div class="form-group">'; ?>
        <?php echo "<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>"; ?>
<?php echo "</div>"; ?>

<?php echo "<?php \metalguardian\formBuilder\ActiveFormBuilder::end(); ?>"; ?>

</div>
