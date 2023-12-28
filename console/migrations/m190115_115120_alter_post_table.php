<?php

use yii\db\Migration;

/**
 * Class m190115_115120_alter_post_table
 */
class m190115_115120_alter_post_table extends Migration
{

    const TABLE = '{{%post}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'isBlog', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(self::TABLE, 'isBlog');
    }

}
