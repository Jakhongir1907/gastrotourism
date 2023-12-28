<?php

use yii\db\Migration;

/**
 * Class m200326_074656_alter_table_food_vs_table
 */
class m200326_104656_alter_food_vs_table extends Migration
{

    public $table = '{{%food_vs}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn($this->table, 'first_food_picture');
        $this->dropColumn($this->table, 'second_food_picture');
        $this->dropColumn($this->table, 'first_food_flag');
        $this->dropColumn($this->table, 'second_food_flag');

        $this->addColumn($this->table, 'title', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200326_074656_alter_table_food_vs_table cannot be reverted.\n";

        return false;
    }

}
