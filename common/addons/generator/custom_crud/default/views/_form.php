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
use metalguardian\formBuilder\ActiveFormBuilder;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form \metalguardian\formBuilder\ActiveFormBuilder; */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

<?php echo "<?php \$form = ActiveFormBuilder::begin(); ?>"; ?>

<?php echo "<?= \$form->renderForm(\$model, \$model->getFormConfig()) ?>";?>

<?php echo '<div class="form-group">'; ?>
        <?php echo "<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>"; ?>
<?php echo "</div>"; ?>

<?php echo "<?php ActiveFormBuilder::end(); ?>"; ?>

</div>
