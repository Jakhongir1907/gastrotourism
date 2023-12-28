<?php
/**
 * @author Izzat <i.rakhmatov@list.ru>
 * @package uzbekkonsert
 */
?>

<div class="custom-dropdown">
    <div class="dropdown-header">
        <div class="dropdown-header-text">
            <?=$model->title?>
        </div>
        <div class="dropdown-toggler">
            <img src="/img/icons/dropdown-icon.svg" />
        </div>
    </div>
    <div class="dropdown-content">
        <div class="row gallery">
            <?php foreach ($model->files as $file): ?>
                <?php if ($file->getIsImage()): ?>
                    <div class="col-sm-3" data-src="<?=$file->thumbnails->normal['src']?>">
                        <div class="gallery-item">
                            <img src="<?=$file->thumbnails->low['src']?>" />
                        </div>
                    </div>
                <?php else: ?>
                        <div class="col-sm-6 col-sm-offset-1">
                            <div class="gallery-item">
                                <video controls width="420">
                                    <source src="<?=$file->getSrc()?>" type="video/<?=$file->type?>" />
                                </video>
                            </div>
                        </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

