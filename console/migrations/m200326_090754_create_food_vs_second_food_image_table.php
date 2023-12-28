<?php

use yii\db\Migration;

class m200326_090754_create_food_vs_second_food_image_table extends Migration
{

    public $table = '{{%food_vs_second_food_image}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'food_vs_id' => $this->integer(),
            'file_id' => $this->integer(),
            'sort' => $this->integer()
        ]);

        $this->createIndex(
            "idx-food_vs_second_food_image-food_vs_id",
            $this->table,
            'food_vs_id'
        );

        $this->createIndex(
            "idx-food_vs_second_food_image-file_id",
            $this->table,
            'file_id'
        );

        $this->addForeignKey(
            "fk-food_vs_second_food_image-food_vs_id",
            $this->table,
            'food_vs_id',
            '{{%food_vs}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            "fk-food_vs_second_food_image-file_id",
            $this->table,
            'file_id',
            '{{%files}}',
            'file_id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk-food_vs_second_food_image-food_vs_id", $this->table);
        $this->dropForeignKey("fk-food_vs_second_food_image-file_id", $this->table);
        $this->dropIndex("idx-food_vs_second_food_image-food_vs_id", $this->table);
        $this->dropIndex("idx-food_vs_second_food_image-file_id", $this->table);

        $this->dropTable($this->table);
    }
}
