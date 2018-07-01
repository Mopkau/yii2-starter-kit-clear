<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 14.03.14
 * Time: 10:21.
 */
namespace common\addons\giiant\generators\crud\providers\extensions;

class ThumbnailProvider extends \schmunk42\giiant\base\Provider
{
    public $widget = 'upload';
    public $widgets = [];

    public function activeField($attribute)
    {
        if (!isset($this->generator->getTableSchema()->columns[$attribute])) {
            return;
        }

        $modelClass = $this->generator->modelClass;
        $model = new $modelClass;
        if($model->hasProperty('thumbnail')){
            $column = $this->generator->getTableSchema()->columns[$attribute];
            if (in_array($column->name, $this->columnNames)) {
                if (isset($this->widgets[$column->name])) {
                    $this->widget = $this->widgets[$column->name];
                }
                switch ($this->widget) {
                    case 'upload':
                        $this->generator->requires[] = 'trntv/yii2-file-kit';
                        return "\$form->field(\$model, 'thumbnail')->widget(trntv\\filekit\\widget\\Upload::className(),
                    [
                        'url' => [ '/file-storage/upload'],
                        'maxFileSize' => 5000000,
                    ]
                    )";
                        break;

                }
            }

        }
    }
}
