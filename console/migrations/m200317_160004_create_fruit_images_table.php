<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_images}}`.
 */
class m200317_160004_create_fruit_images_table extends Migration
{
    public $table = '{{%fruit_images}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'fruit_id' => $this->integer(),
            'file_id' => $this->integer(),
            'sort' => $this->integer()
        ]);

        $this->createIndex(
            "idx-fruit_images-fruit_id",
            $this->table,
            'fruit_id'
        );

        $this->createIndex(
            "idx-fruit_images-file_id",
            $this->table,
            'file_id'
        );

        $this->addForeignKey(
            "fk-fruit_images-fruit_id",
            $this->table,
            'fruit_id',
            '{{%fruit}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            "fk-fruit_images-file_id",
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
        $this->dropForeignKey("fk-fruit_images-fruit_id", $this->table);
        $this->dropForeignKey("fk-fruit_images-file_id", $this->table);
        $this->dropIndex("idx-fruit_images-fruit_id", $this->table);
        $this->dropIndex("idx-fruit_images-file_id", $this->table);

        $this->dropTable($this->table);
    }
}
