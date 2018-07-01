<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 14.03.14
 * Time: 10:21.
 */
namespace common\addons\giiant\generators\crud\providers\extensions;

class StatusProvider extends \schmunk42\giiant\base\Provider
{
    public $widget = 'dropdownList';
    public $widgets = [];

    public function activeField($attribute)
    {
        if (!isset($this->generator->getTableSchema()->columns[$attribute])) {
            return;
        }

        $modelClass = $this->generator->modelClass;
        $model = new $modelClass;
        if($model->hasProperty('status')){
            $column = $this->generator->getTableSchema()->columns[$attribute];
            if (in_array($column->name, $this->columnNames)) {
                if (isset($this->widgets[$column->name])) {
                    $this->widget = $this->widgets[$column->name];
                }
                switch ($this->widget) {
                    case 'dropdownList':
                        return "\$form->field(\$model, 'status')->dropDownList(
                            [
                                1 => Yii::t('backend', 'Active'),
                                0 => Yii::t('backend', 'Disable'),
                            ],
                            [
                                'prompt' => Yii::t('cruds', 'Select'),
                                'disabled' => (isset(\$relAttributes) && isset(\$relAttributes['status'])),
                            ]
                        );";
                        break;

                }
            }

        }
    }
}
