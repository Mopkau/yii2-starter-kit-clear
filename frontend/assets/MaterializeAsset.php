<?php
	/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MaterializeAsset extends AssetBundle
{
    public $sourcePath = '@bower/materialize/dist';

    public $css = [
		'css/materialize.min.css'
    ];

    public $js = [
		'js/materialize.min.js'
    ];

	public $publishOptions = [
		'only' => [
			'fonts/',
			'css/',
		    'js',
		    'font'
		]
	];

	public $depends = [
		'yii\web\YiiAsset',
	];

}
