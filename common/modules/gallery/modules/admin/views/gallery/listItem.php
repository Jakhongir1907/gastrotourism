<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\gallery\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$selected = [];
$file = $model->getFiles()->one();
?>

<div class="col-sm-6 col-md-4 filemanager-data">
    <div class="thumbnail">
        <div style="height:160px; width:100%; background-image: url(<?=$file ? $file->getImageSrc() : ""?>); background-repeat: no-repeat;background-size: contain; background-position: center; background-color:black;">

        </div>
        <div class="caption">

            <h3 style="text-overflow: ellipsis;width: 100%;overflow-x: hidden;white-space: nowrap;"><?=$model->title?></h3>
            <p><a href="#" class="btn btn-danger btn-sm filemanagerDeleteBtn" data-file-id="<?=$model->id?>">Удалить</a>
                <?php if(!in_array($model->id,$selected)):?>
                    <?php $unselected_classes = "display:none;";?>
                <?php else:?>
                    <?php $selected_classes = "display:none;";?>
                <?php endif;?>
                <a href="#" class="btn btn-success btn-sm selectGallery" style="<?=$selected_classes?>" data-gallery-id="<?=$model->id?>" data-gallery-title="<?=$model->title?>">Выбрать</a>
                <a href="#" class="btn btn-warning btn-sm unselectGallery" style="<?=$unselected_classes?>" data-gallery-id="<?=$model->id?>" data-gallery-title="<?=$model->title?>">Отменить</a></p>

        </div>
    </div>
</div>
