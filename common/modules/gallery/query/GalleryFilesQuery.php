<?php

namespace common\modules\gallery\query;

/**
 * This is the ActiveQuery class for [[\common\modules\gallery\models\GalleryFiles]].
 *
 * @see \common\modules\gallery\models\GalleryFiles
 */
class GalleryFilesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\gallery\models\GalleryFiles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\gallery\models\GalleryFiles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
