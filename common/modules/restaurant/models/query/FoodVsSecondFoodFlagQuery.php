<?php

namespace common\modules\restaurant\models\query;

/**
 * This is the ActiveQuery class for [[\common\modules\restaurant\models\FoodVsSecondFoodFlag]].
 *
 * @see \common\modules\restaurant\models\FoodVsSecondFoodFlag
 */
class FoodVsSecondFoodFlagQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\FoodVsSecondFoodFlag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\FoodVsSecondFoodFlag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
