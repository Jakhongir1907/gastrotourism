<?php

namespace common\modules\restaurant\models\query;

/**
 * This is the ActiveQuery class for [[\common\modules\restaurant\models\RestaurantImages]].
 *
 * @see \common\modules\restaurant\models\RestaurantImages
 */
class RestaurantImagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\RestaurantImages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\RestaurantImages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
