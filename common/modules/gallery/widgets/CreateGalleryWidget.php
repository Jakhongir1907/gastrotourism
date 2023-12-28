<?php
/**
 * @author Izzat <i.rakhmatov@list.ru>
 */

namespace common\modules\gallery\widgets;


use common\modules\gallery\models\Gallery;
use yii\bootstrap\Widget;

class CreateGalleryWidget extends Widget {

    public function init() {

    }

    public function run() {
        $model = new Gallery();

        echo $this->render('create_gallery', [
            'model' => $model,
        ]);

    }

}