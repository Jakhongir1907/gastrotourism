<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_versus}}`.
 */
class m200316_073029_create_food_versus_table extends Migration
{

    public $table = '{{%food_versus}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'first_food_id' => $this->string(),
            'second_food_id' => $this->string(),
            'first_likes' => $this->integer(),
            'second_likes' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
