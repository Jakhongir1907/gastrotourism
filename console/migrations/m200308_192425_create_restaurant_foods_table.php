<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%restaurant_foods}}`.
 */
class m200308_192425_create_restaurant_foods_table extends Migration
{

    public $table = '{{%restaurant_foods}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'restaurant_id' => $this->integer(),
            'food_id' => $this->integer(),
            'sort' => $this->integer(),
            'top' => $this->integer()->defaultValue(0)->notNull(),
        ]);

        $this->createIndex(
            'idx-restaurant_foods-restaurant_id',
            $this->table,
            'restaurant_id'
        );

        $this->createIndex(
            'idx-restaurant_foods-food_id',
            $this->table,
            'food_id'
        );

        $this->addForeignKey(
            'fk-restaurant_foods-restaurant_id-restaurant-id',
            $this->table,
            'restaurant_id',
            'restaurant',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-restaurant_foods-food_id-food-id',
            $this->table,
            'food_id',
            'food',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-restaurant_foods-restaurant_id-restaurant-id',
            $this->table
        );

        $this->dropForeignKey(
            'fk-restaurant_foods-food_id-food-id',
            $this->table
        );

        $this->dropIndex(
            'idx-restaurant_foods-restaurant_id',
            $this->table
        );

        $this->dropIndex(
            'idx-restaurant_foods-food_id',
            $this->table
        );

        $this->dropTable($this->table);
    }
}
