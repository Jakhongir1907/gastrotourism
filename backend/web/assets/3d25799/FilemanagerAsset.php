<?php

namespace common\modules\filemanager\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FilemanagerAsset extends AssetBundle
{
    public $sourcePath = '@common/modules/filemanager/assets';

    public $js = [
        "plugin.js",
        'cropperjs/cropper.js',
        'themes/cropper/theme.js',
    ];

    public $css = [
        "plugin.js",
        'cropperjs/cropper.css',
        'themes/cropper/theme.css'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'dosamigos\ckeditor\CKEditorAsset',
        'dosamigos\ckeditor\CKEditorWidgetAsset',
    ];
}


