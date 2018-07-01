<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 05.06.2018
 * Time: 19:44
 */

namespace common\addons\giiant\traits;


use yii\db\ActiveRecord;

trait AttachTrait
{
    public function attachConfig(){
        $attachmentsUpload = function ($attribute, $model, $generator) {
            /* @var $model ActiveRecord*/
            if(!$model->hasProperty($attribute)){
                return;
            }
            $generator->requires[] = 'trntv/yii2-file-kit';
            return "\$form->field(\$model, '{$attribute}')->widget(trntv\\filekit\\widget\\Upload::className(),
                    [
                        'url' => [ '/file-storage/upload'],
                        'sortable' => true,
                        'maxFileSize' => 10000000, // 10 MiB
                        'maxNumberOfFiles' => 10,
                    ]
                    )";
        };

        $activeFields = [
            '.attachments' => $attachmentsUpload,
            //'.thumbnail' => $attachmentsUpload,
            //'.attachments' => $attachmentsUpload,
        ];

        return $activeFields;
    }
}