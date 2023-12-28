<?php

use yii\db\Migration;

/**
 * Class m200311_221531_alter_food_table
 */
class m200311_221531_alter_food_table extends Migration
{

    public $table = '{{%food}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'type', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'type');
    }
}
