<?php
/**
 * This is the template for generating the model class of a specified table.
 */
    use yii\helpers\VarDumper;

    /* @var $this yii\web\View */
/* @var $generator yii\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $queryClassName string query class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use trntv\filekit\behaviors\UploadBehavior;
use \yii\helpers\Html;
use \yii\base\UnknownPropertyException;
use yii\db\Expression;
use trntv\filekit\widget\Upload;
use metalguardian\formBuilder\ActiveFormBuilder;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "<?= $generator->generateTableName($tableName) ?>".
 *
<?php foreach ($tableSchema->columns as $column): ?>
 * @property <?= "{$column->phpType} \${$column->name}\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
 *
<?php foreach ($relations as $name => $relation): ?>
 * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{
<?php foreach ($labels as $name => $label): ?>
    <?php if($name == 'thumbnail_path'){ ?>
    <?php echo "
    /**
    * @var array
    */
    public \$thumbnail;"
        ?>
    <?php } ?>
<?php endforeach; ?>
<?php foreach ($relations as $name => $relation){ ?>
    <?php if($name == $className.'Images'){ ?>
    <?php echo "
    /**
    * @var array
    */
    public $attachments;"
        ?>
    <?php } ?>
<?php } ?>

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '<?= $generator->generateTableName($tableName) ?>';
    }
<?php if ($generator->db !== 'db'): ?>

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('<?= $generator->db ?>');
    }
<?php endif; ?>
    /**
    * @inheritdoc
    */
    public function behaviors()
    {
    <?php echo "return [" ?>
    <?php foreach ($labels as $name => $label): ?>
        <?php if($name == 'author_id'){ ?>
            <?php echo  "
            [
             'class' => BlameableBehavior::className(),
             'createdByAttribute' => 'author_id',
             'updatedByAttribute' => 'updater_id',
            ],\n"; ?>
        <?php } ?>
        <?php if($name == 'alias'){ ?>
            <?php echo "
            [
             'class' => SluggableBehavior::className(),
             'attribute' => 'title',
             'slugAttribute' => {$name},
             ],\n"; ?>
        <?php } ?>
        <?php if($name == 'create_time'){ ?>
            <?php echo "
            [
             'class' => TimestampBehavior::className(),
             'createdAtAttribute' => 'create_time',
             'updatedAtAttribute' => 'update_time',
             'value' => new Expression('NOW()'),
            ],\n"; ?>
        <?php } ?>
        <?php if($name == 'thumbnail_path'){ ?>
            <?php echo "
            [
            'class' => UploadBehavior::className(),
            'attribute' => 'thumbnail',
            'pathAttribute' => 'thumbnail_path',
            'baseUrlAttribute' => 'thumbnail_base_url'
            ],\n"; ?>
        <?php } ?>
    <?php endforeach; ?>
    <?php foreach ($relations as $name => $relation): ?>
        <?php if($name == $className.'Images'){ ?>
            <?php echo "
            [
            'class' => UploadBehavior::className(),
            'attribute' => 'attachments',
            'multiple' => true,
            'uploadRelation' => {$className}.'Images' ?>,
            'pathAttribute' => 'path',
            'baseUrlAttribute' => 'base_url',
            'orderAttribute' => 'order',
            'typeAttribute' => 'type',
            'sizeAttribute' => 'size',
            'nameAttribute' => 'name',
            ],\n"; ?>
        <?php } ?>
    <?php endforeach; ?>

    <?php echo "];\n" ?>

    <?php echo "}\n"; ?>
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        <?= "\n            " . implode(",\n            ", $rules) . ",\n        " ?>
        <?php foreach ($labels as $name => $label): ?>
            <?php if($name == 'thumbnail_path'){ ?>
            <?php echo "[['thumbnail'], 'safe']"; ?>
            <?php }; ?>
        <?php endforeach; ?>
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
<?php foreach ($labels as $name => $label): ?>
            <?= "'$name' => " . $generator->generateString($label) . ",\n" ?>
<?php endforeach; ?>
        ];
    }

<?php if ($queryClassName): ?>
<?php
    $queryClassFullName = ($generator->ns === $generator->queryNs) ? $queryClassName : '\\' . $generator->queryNs . '\\' . $queryClassName;
    echo "\n";
?>
    /**
     * @inheritdoc
     * @return <?= $queryClassFullName ?> the active query used by this AR class.
     */
    public static function find()
    {
        return new <?= $queryClassFullName ?>(get_called_class());
    }
<?php endif; ?>

    /**
    * Access methods for the table attributes
    **/

    <?php foreach ($labels as $name => $label): ?>
<?php if($name == 'thumbnail_path'){ ?>
    <?php echo "
    public function getThumbnailImage()
    {
        return Html::img(
        Yii::\$app->glide->createSignedUrl([
        'glide/index',
        'path' => \$this->thumbnail_path,
        'w' => 200
        ], true),
        ['class' => '']);
    }";
    ?>
    <?php echo "
    public function getMainImage()
    {
        return Html::img(
        Yii::\$app->glide->createSignedUrl([
        'glide/index',
        'path' => \$this->thumbnail_path,
        'w' => 800
        ], true),
        ['class' => '']);
    }";
    ?>
    <?php echo "
    public function getThumbnailSrc()
    {
        return Yii::\$app->glide->createSignedUrl([
        'glide/index',
        'path' => \$this->thumbnail_path,
        'w' => 200
        ], true);
    }";
    ?>

    <?php echo "
    public function getMainSrc()
    {
        return Yii::\$app->glide->createSignedUrl([
        'glide/index',
        'path' => \$this->thumbnail_path,
        'w' => 800
        ], true);
    }";
    ?>
<?php }else{ ?>
    <?php echo "
    /**
    * @return string
    * @throws \yii\base\UnknownPropertyException;
    */
    public function get".ucwords($name)."()
    {
        if(!empty(\$this->{$name})){ 
            return \$this->{$name};
        }else{
            throw new UnknownPropertyException(\$this->{$name}.', пуст в записи'. \$this->id);
        }
    }
    "?>
<?php } ?>
    <?php endforeach; ?>

    /**
    * Relations
    **/
<?php foreach ($relations as $name => $relation): ?>

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getRelated<?= $name ?>()
    {
    <?= $relation[0] . "\n" ?>
    }
<?php endforeach; ?>

    /**
    * Admin form generator
    **/
<?php echo "public function getFormConfig()"; ?>
<?php echo "{\n"; ?>
<?php echo "return [\n"; ?>
<?php $disableConfigFields = [
    'id','author_id','updater_id','create_time','update_time','description','thumbnail_base_url','thumbnail_path'
]; ?>
<?php foreach ($tableSchema->columns as $column): ?>
    <?php if($column->phpType == "string" && !in_array($column->name,$disableConfigFields)){ ?>
    <?php echo "
    '{$column->name}' => [
        'type' => ActiveFormBuilder::INPUT_TEXT,
    ],"; ?>
    <?php }elseif($column->phpType == 'integer' && !in_array($column->name,$disableConfigFields)){ ?>
    <?php echo "
    '{$column->name}' => [
        'type' => ActiveFormBuilder::INPUT_DROPDOWN_LIST,
        'items' => ArrayHelper::map(Categories::find()->all(),'id','label'),
        'options' => [
        'prompt' => 'Выберите категорию',
        ],\n";?>
    <?php echo "],\n"; ?>
    <?php }elseif($column->name == 'description'){ ?>
    <?php echo "
    '{$column->name}' => [
        'type' => ActiveFormBuilder::INPUT_WIDGET,
            'widgetClass' => \yii\imperavi\Widget::className(),
            'options'=>[
                'plugins' => ['fullscreen', 'fontcolor', 'video'],
                'options'=>[
                    'minHeight' => 400,
                    'maxHeight' => 400,
                    'buttonSource' => true,
                    'convertDivs' => false,
                    'removeEmptyTags' => false,
                    'imageUpload' => Yii::\$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
                ]
            ]
    ],"; ?>
    <?php }elseif($column->name == 'thumbnail_path'){ ?>
    <?php echo "
    'thumbnail' => [
        'type' => ActiveFormBuilder::INPUT_WIDGET,
            'widgetClass' => Upload::className(),
            'options'=>[
                'url' => ['/file-storage/upload'],
                'maxFileSize' => 5000000, // 5 MiB
            ]
    ],"; ?>
    <?php } ?>

<?php endforeach; ?>
<?php echo "];"; ?>
<?php echo "}"; ?>
}
