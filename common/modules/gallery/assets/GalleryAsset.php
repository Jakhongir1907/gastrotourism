<?php
/**
 * @author Izzat <i.rakhmatov@list.ru>
 */

namespace common\modules\gallery\assets;


use yii\web\AssetBundle;

class GalleryAsset extends AssetBundle {

    public $sourcePath = '@common/modules/gallery/assets';

    public $js = [
        'plugin.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'dosamigos\ckeditor\CKEditorAsset',
        'dosamigos\ckeditor\CKEditorWidgetAsset'
    ];

}