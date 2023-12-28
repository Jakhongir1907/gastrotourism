<?php

namespace common\modules\partner\models\query;

/**
 * This is the ActiveQuery class for [[\common\modules\partner\models\Partner]].
 *
 * @see \common\modules\partner\models\Partner
 */
class PartnerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\partner\models\Partner[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\partner\models\Partner|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
