<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 14.03.14
 * Time: 10:21.
 */
namespace common\addons\giiant\generators\crud\providers\extensions;

class PriceTypeProvider extends \schmunk42\giiant\base\Provider
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
        if($model->hasProperty('price_type')){
            $column = $this->generator->getTableSchema()->columns[$attribute];
            if (in_array($column->name, $this->columnNames)) {
                if (isset($this->widgets[$column->name])) {
                    $this->widget = $this->widgets[$column->name];
                }
                switch ($this->widget) {
                    case 'dropdownList':
                        return "\$form->field(\$model, 'price_type')->dropDownList(
                            [
                                1 => Yii::t('backend', 'Month'),
                                2 => Yii::t('backend', 'One'),
                                3 => Yii::t('backend', 'Duo'),
                            ],
                            [
                                'prompt' => Yii::t('cruds', 'Select'),
                                'disabled' => (isset(\$relAttributes) && isset(\$relAttributes['price_type'])),
                            ]
                        );";
                        break;

                }
            }

        }
    }
}
