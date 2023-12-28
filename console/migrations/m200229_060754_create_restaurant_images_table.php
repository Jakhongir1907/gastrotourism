<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%restaurant_images}}`.
 */
class m200229_060754_create_restaurant_images_table extends Migration
{

    public $table = '{{%restaurant_images}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'restaurant_id' => $this->integer(),
            'file_id' => $this->integer(),
            'sort' => $this->integer()
        ]);

        $this->createIndex(
            "idx-restaurant_images-restaurant_id",
            $this->table,
            'restaurant_id'
        );

        $this->createIndex(
            "idx-restaurant_images-file_id",
            $this->table,
            'file_id'
        );

        $this->addForeignKey(
            "fk-restaurant_images-restaurant_id",
            $this->table,
            'restaurant_id',
            '{{%restaurant}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            "fk-restaurant_images-file_id",
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
        $this->dropForeignKey("fk-restaurant_images-restaurant_id", $this->table);
        $this->dropForeignKey("fk-restaurant_images-file_id", $this->table);
        $this->dropIndex("idx-restaurant_images-restaurant_id", $this->table);
        $this->dropIndex("idx-restaurant_images-file_id", $this->table);

        $this->dropTable($this->table);
    }
}
