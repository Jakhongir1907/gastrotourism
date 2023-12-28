<?php

namespace common\modules\restaurant\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class RestaurantFoodsAsset extends AssetBundle
{
	public $sourcePath = '@common/modules/restaurant/assets/main';

    public $js = [
        "js/plugin.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'dosamigos\ckeditor\CKEditorAsset',
        'dosamigos\ckeditor\CKEditorWidgetAsset'
    ];
}


