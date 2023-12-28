<?php

namespace common\modules\restaurant\models\query;

use common\modules\langs\components\QueryBehavior;
use common\modules\restaurant\models\Food;

/**
 * This is the ActiveQuery class for [[\common\modules\restaurant\models\Food]].
 *
 * @see \common\modules\restaurant\models\Food
 */
class FoodQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            'lang' => [
                'class' => QueryBehavior::className(),
                'alias' => Food::tableName()
            ],
        ];
    }

    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\Food[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\Food|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
