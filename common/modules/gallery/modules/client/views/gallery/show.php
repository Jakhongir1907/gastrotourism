<?php
/**
 * @author Izzat <i.rakhmatov@list.ru>
 * @package uzbekkonsert
 */

use common\modules\filemanager\models\Files;

$this->title = $model->title;

?>

<div class="container df pt-30 pb-30">

    <div class="df-content-870">
        <div class="row gallery">
            <?php foreach ($model->files as $file):
                /**
                 * @var Files $file
                 */
                ?>
                <div class="col-sm-3" data-src="<?=$file->thumbnails->normal['src']?>">
                    <div class="gallery-item">
                        <?php if ($file->getIsImage()): ?>
                        <img src="<?=$file->thumbnails->low['src']?>" />
                        <?php else: ?>
                            <video src="<?=$file->getSrc()?>">
                                <source src="<?=$file->getSrc()?>" />
                            </video>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="df-content-270">
        <div class="print-version-button">
            <img src="/img/icons/print-version.svg" />
            <div class="label"><?= __('Версия для печати') ?></div>
        </div>

        <?= \common\modules\post\widgets\PostsWidget::widget(['title' => __('Новости'), 'size' => 4])?>

    </div>

</div>