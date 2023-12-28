<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_images}}`.
 */
class m200311_190804_create_food_images_table extends Migration
{
    public $table = '{{%food_images}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'food_id' => $this->integer(),
            'file_id' => $this->integer(),
            'sort' => $this->integer()
        ]);

        $this->createIndex(
            "idx-food_images-food_id",
            $this->table,
            'food_id'
        );

        $this->createIndex(
            "idx-food_images-file_id",
            $this->table,
            'file_id'
        );

        $this->addForeignKey(
            "fk-food_images-food_id",
            $this->table,
            'food_id',
            '{{%food}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            "fk-food_images-file_id",
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
        $this->dropForeignKey("fk-food_images-food_id", $this->table);
        $this->dropForeignKey("fk-food_images-file_id", $this->table);
        $this->dropIndex("idx-food_images-food_id", $this->table);
        $this->dropIndex("idx-food_images-file_id", $this->table);

        $this->dropTable($this->table);
    }
}
