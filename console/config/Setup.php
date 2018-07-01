<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 23.01.2018
 * Time: 12:30
 */

namespace console\config;


use common\addons\giiant\generators\crud\providers\core\CallbackProvider;
use common\addons\giiant\generators\crud\providers\extensions\EditorProvider;
use common\addons\giiant\generators\crud\providers\extensions\PriceTypeProvider;
use common\addons\giiant\generators\crud\providers\extensions\StatusProvider;
use common\addons\giiant\generators\crud\providers\extensions\ThumbnailProvider;

use common\addons\giiant\traits\AttachTrait;
use yii\base\BootstrapInterface;

class Setup implements BootstrapInterface
{
    use AttachTrait;

    public function bootstrap($app)
    {


        \Yii::$container->set(
            CallbackProvider::class,
            [
                'activeFields'  => $this->attachConfig(),
            ]
        );

        \Yii::$container->set(
            StatusProvider::class,
            [
                'columnNames' => ['status']
            ]
        );
        \Yii::$container->set(
            ThumbnailProvider::class,
            [
                'columnNames' => ['base_path']
            ]
        );
        \Yii::$container->set(
            PriceTypeProvider::class,
            [
                'columnNames' => ['price_type']
            ]
        );
        \Yii::$container->set(
            EditorProvider::class,
            [
                'columnNames' => ['body','body_one','body_two'],
                'widget' => 'redactor'
            ]
        );
        \Yii::$container->set('schmunk42\giiant\generators\crud\providers\extensions\DateTimeProvider', [
            'columnNames' => ['date'],
        ]);
    }
}