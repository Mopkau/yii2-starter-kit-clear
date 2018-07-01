<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 14.03.14
 * Time: 10:21.
 */
namespace common\addons\giiant\generators\crud\providers\extensions;

class EditorProvider extends \schmunk42\giiant\base\Provider
{
    public $widget = 'ckeditor';
    public $widgets = [];

    public function activeField($attribute)
    {
        if (!isset($this->generator->getTableSchema()->columns[$attribute])) {
            return;
        }

        $column = $this->generator->getTableSchema()->columns[$attribute];

        if (in_array($column->name, $this->columnNames)) {
            if (isset($this->widgets[$column->name])) {
                $this->widget = $this->widgets[$column->name];
            }

            switch ($this->widget) {
                case 'redactor':
                    $this->generator->requires[] = 'asofter/yii2-imperavi-redactor';
                    return "\$form->field(\$model, '{$attribute}')->widget(\\yii\\imperavi\\Widget::className(),[
                    'plugins' => [
                        'fullscreen',
                        'fontcolor',
                        'video',
                        'imagemanager',

                    ],
                    'options' => [
                        'minHeight' => 400,
                        'maxHeight' => 400,
                        'buttonSource' => TRUE,
                        'convertDivs' => FALSE,
                        'removeEmptyTags' => FALSE,
                        'imageUpload' => Yii::\$app->urlManager->createUrl([ '/file-storage/upload-imperavi']),
                        'imageManagerJson' => '/backend/web/site/images-lib',
                        'imageResizable'=> true
                    ],
                    ])";
                    break;
                case 'aceHTML':
                    $this->generator->requires[] = 'trntv/aceeditor';

                    return "\$form->field(\$model, '{$attribute}')->widget(\\trntv\\aceeditor\\AceEditor::className(), ['mode' => 'html', 'theme' => 'twilight'])";
                    break;
                case 'aceLESS':
                    $this->generator->requires[] = 'trntv/aceeditor';

                    return "\$form->field(\$model, '{$attribute}')->widget(\\trntv\\aceeditor\\AceEditor::className(), ['mode' => 'less', 'theme' => 'twilight'])";
                    break;
                case 'aceJS':
                    $this->generator->requires[] = 'trntv/aceeditor';

                    return "\$form->field(\$model, '{$attribute}')->widget(\\trntv\\aceeditor\\AceEditor::className(), ['mode' => 'javascript', 'theme' => 'twilight'])";
                    break;
                default:
                    $this->generator->requires[] = '2amigos/yii2-ckeditor-widget';

                    return <<<EOS
\$form->field(\$model, '{$attribute}')->widget(
    \dosamigos\ckeditor\CKEditor::className(),
    [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]
)
EOS;
            }
        }
    }
}