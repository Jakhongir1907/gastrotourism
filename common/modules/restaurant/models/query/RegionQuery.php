<?php

namespace common\modules\restaurant\models\query;

use common\modules\langs\components\QueryBehavior;
use common\modules\restaurant\models\Region;

/**
 * This is the ActiveQuery class for [[\common\modules\restaurant\models\Region]].
 *
 * @see \common\modules\restaurant\models\Region
 */
class RegionQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            'lang' => [
                'class' => QueryBehavior::className(),
                'alias' => Region::tableName()
            ],
        ];
    }

    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\Region[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\Region|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
