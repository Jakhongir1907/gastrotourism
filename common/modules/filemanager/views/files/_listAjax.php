<?php
/**
 * @var $selected;
 * @var $data;
 * @var $relation_name;
 */
$selected_classes = "";
$unselected_classes = "";
?>
<div class="col-sm-3 col-md-3 filemanager-data" style="height: 300px;">
    <div class="thumbnail">

        <?php
        if (!in_array($model->type, [
            'jpg',
            'jpeg',
            'png',
            'bmp',
            'webp',
            'gif',
            'jpf',
            'mp4', 'mov', 'mkv', 'ogm', 'webm', 'wmv', 'flv'
        ])):
            if (in_array($model->type, ['doc', 'docx', 'rtf'])): ?>
                <i class='fa fa-file-word' style="font-size: 160px; margin-left: 36px;"></i>
            <?php elseif (in_array($model->type, ['ppt', 'pptx'])) : ?>
                <i class='fa fa-file-exel' style="font-size: 160px; margin-left: 36px;"></i>
            <?php elseif (in_array($model->type, ['pdf'])): ?>
                <i class='fa fa-file-pdf' style="font-size: 160px; margin-left: 36px;"></i>
            <?php else: ?>
                <i class='fa fa-file-alt' style="font-size: 160px; margin-left: 36px;"></i>
            <?php endif; ?>
        <?php else: ?>
            <div style="height:100px; width:100%; background-image: url(<?=$model->getImageSrc()?>); background-repeat: no-repeat;background-size: contain; background-position: center; background-color:black;"></div>
        <?php endif; ?>

    </div>
    <div class="row col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <?php
        if($model->isVideo){
            $sizes = $model->converterStatus;
            foreach ($sizes as $size=>$per){
                if($per == 100){
                    echo "<span class='label label-success'>";
                        echo $size;
                    echo "</span>";
                }
                else{
                    echo "<span class='label label-danger'>";
                        echo $size.":".$per;
                    echo "</span>";
                }
            }
        }
        ?>
    </div>
    <div class="caption">

        <h3 style="text-overflow: ellipsis;width: 100%;overflow-x: hidden;white-space: nowrap;"><?=$model->title?></h3>
        <p style="text-overflow: ellipsis;width: 100%;overflow-x: hidden;white-space: nowrap;"><?=$model->description?></p>
        <p style="display: flex;">
            <?php if(!in_array($model->file_id,$selected)):?>
                <?php $unselected_classes = "display:none;";?>
            <?php else:?>
                <?php $selected_classes = "display:none;";?>
            <?php endif;?>
        <a href="#" class="btn btn-success btn-xs filemanagerSelectBtn" style="<?=$selected_classes?>; padding: 5px; font-size: 12px" data-file-id="<?=$model->file_id?>" data-file-title="<?=$model->title?>" data-file-url="<?=$model->src?>" data-file-type="<?=$model->type?>">Выбрать</a>
            <a href="#" class="btn btn-warning btn-xs filemanagerunSelectBtn" style="<?=$unselected_classes?>; padding: 5px; font-size: 12px;" data-file-id="<?=$model->file_id?>" data-file-title="<?=$model->title?>"  data-file-url="<?=$model->src?>" data-file-type="<?=$model->type?>">Отменить</a>
            <a href="#" class="btn btn-danger btn-xs filemanagerDeleteBtn" data-file-id="<?=$model->file_id?>" style="padding: 5px; font-size: 12px;">Удалить</a>
        </p>

    </div>
</div>
