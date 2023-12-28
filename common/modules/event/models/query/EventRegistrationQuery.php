<?php

namespace common\modules\event\models\query;

/**
 * This is the ActiveQuery class for [[\common\modules\event\models\EventRegistration]].
 *
 * @see \common\modules\event\models\EventRegistration
 */
class EventRegistrationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\event\models\EventRegistration[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\event\models\EventRegistration|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
